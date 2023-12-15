<?php

namespace App\Controllers;

use App\Models\ModelCatalog;
use App\Models\ModelKategori;
use App\Models\ModelSales;
use App\Models\ModelUsers;
use App\Models\ModelMenu;
use App\Models\ModelSubMenu;
use Myth\Auth\Entities\User;
use Dompdf\Dompdf;
use Dompdf\Options;

class RootAdmin extends BaseController
{
    protected $modelCatalog, $db, $builder, $modelKategori, $modelSales, $cart, $modelUsers, $config, $auth, $modelMenu, $modelSubMenu;

    public function __construct()
    {
        $this->config = config('Auth');
        $this->auth   = service('authentication');
        $this->cart = \Config\Services::cart();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('catalog');
        $this->modelCatalog = new ModelCatalog();
        $this->modelKategori = new ModelKategori();
        $this->modelSales = new ModelSales();
        $this->modelUsers = new ModelUsers();
        $this->modelMenu = new ModelMenu();
        $this->modelSubMenu = new ModelSubMenu();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_catalog') ? $this->request->getVar('page_catalog') : 1;
        
        $query = $this->modelCatalog->getCatalog();
        $kategori = $this->modelKategori->getKategori()->findAll();
        
        $idProductTerakhir = $query->orderBy('id', 'desc')->first();

        // dd($query->orderBy('id', 'desc')->first(), $idProductTerakhir);

        if ($idProductTerakhir === null) {
            $kodeTerakhir = "";
        } else {
            $kodeTerakhir = $query->orderBy('id', 'desc')->first()['id_product'];
        }

        $awalan = "M";
        $tengah = "PU";

        $nomorBaru = ($kodeTerakhir == "") ? 1 : (int) substr($kodeTerakhir, -3) + 1;
        $nomorBaruFormatted = sprintf('%03d', $nomorBaru);

        $kodeBaru = $awalan . '-' . $tengah . '-' . $nomorBaruFormatted;

        $data = [
            'title'         => 'Tambah Barang',
            'catalog'       => $query->paginate('10', 'catalog'),
            'pager'         => $this->modelCatalog->pager,
            'currentPage'   => $currentPage,
            'kategori'      => $kategori,
            'id_product'    => $kodeBaru
        ];

        return view('root_admin/add_product', $data);
    }

    public function save_product()
    {
        $stock = $this->request->getVar('stock');
        $rules = [
            'id_product'        => [
                'rules'         => 'required|is_unique[catalog.id_product]',
                'errors'        => [
                    'required'  => 'ID Product harus diisi.',
                    'is_unique' => 'ID Product sudah digunakan'
                ]
            ],
            'name_product'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Product harus diisi.',
                ]
            ],
            'price' => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Harga harus diisi.',
                ]
            ],
            'description'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Description harus diisi.',
                ]
            ],
            'kategori'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Kategori Barang harus dipilih.',
                ]
            ],
            'stock'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Stock Barang harus dipilih.',
                ]
            ],
            'image_product' => [
                'rules' => 'max_size[image_product,3000]|is_image[image_product]|mime_in[image_product,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang dipilih bukan gambar',
                    'mime_in'  => 'Yang dipilih bukan gambar',
                ]
            ]

        ];

        if ($stock == 'Stock') {
            $rules = [
                'qty'        => [
                    'rules'         => 'required',
                    'errors'        => [
                        'required'  => 'Quantity Product harus diisi.',
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('image_product');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img_product', $namaImage);
        }

        $data = [
            'id_product'    => $this->request->getVar('id_product'),
            'name_product'  => $this->request->getVar('name_product'),
            'price'         => $this->request->getVar('price'),
            'description'   => $this->request->getVar('description'),
            'id_kategori'   => $this->request->getVar('kategori'),
            'stock'         => $stock,
            'qty'           => $this->request->getVar('qty'),
            'image_product' => $namaImage
        ];

        if ($stock == 'Stock') {
            $data['qty'] = $this->request->getVar('qty');
        } else {
            $data['qty'] = '~';
        }

        $this->modelCatalog->save($data);

        session()->setFlashdata('pesan', 'Produk berhasil ditambahkan');

        return redirect()->to('add_product');
    }

    public function delete_product($id)
    {
        $data = $this->modelCatalog->find($id);
        $namaImage = $data['image_product'];

        if ($namaImage != 'default.jpg') {
            unlink('img_product/' . $namaImage);
        }

        $this->builder->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Produk berhasil dihapus');
        return redirect()->to('add_product');
    }

    public function edit_product($id)
    {
        $currentPage = $this->request->getVar('page_catalog') ? $this->request->getVar('page_catalog') : 1;
        $query = $this->modelCatalog->getCatalog()->find($id);
        $data = $this->modelCatalog->getCatalog();

        $kategori = $this->modelKategori->getKategori()->findAll();
        $data = [
            'title'         => 'Edit Barang',
            'catalog'       => $data->paginate('10', 'catalog'),
            'product'       => $query,
            'pager'         => $this->modelCatalog->pager,
            'currentPage'   => $currentPage,
            'kategori'      => $kategori
        ];
        // dd($data);
        return view('root_admin/edit_product', $data);
    }

    public function change_product($id)
    {
        $stock = $this->request->getVar('stock');
        $rules = [
            'id_product'        => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'ID Product harus diisi.',
                ]
            ],
            'name_product'      => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Nama Product harus diisi.',
                ]
            ],
            'price'             => [
                'rules'             => 'required',
                'errors'        => [
                    'required'  => 'Harga harus diisi.',
                ]
            ],
            'description'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Description harus diisi.',
                ]
            ],
            'kategori'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Kategori Barang harus dipilih.',
                ]
            ],
            'stock'       => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => 'Stock Barang harus dipilih.',
                ]
            ],
            'image_product'     => [
                'rules'         => 'max_size[image_product,3000]|is_image[image_product]|mime_in[image_product,image/jpg,image/jpeg,image/png]',
                'errors'        => [
                    'max_size'  => 'Ukuran gambar terlalu besar',
                    'is_image'  => 'Yang dipilih bukan gambar',
                    'mime_in'   => 'Yang dipilih bukan gambar',
                ]
            ]

        ];

        if ($stock == 'Stock') {
            $rules = [
                'qty'        => [
                    'rules'         => 'required',
                    'errors'        => [
                        'required'  => 'Quantity Product harus diisi.',
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('image_product');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img_product', $namaImage);
        }
        $data = [
            'id'            => $id,
            'id_product'    => $this->request->getVar('id_product'),
            'name_product'  => $this->request->getVar('name_product'),
            'price'         => $this->request->getVar('price'),
            'description'   => $this->request->getVar('description'),
            'id_kategori'   => $this->request->getVar('kategori'),
            'stock'         => $stock,
        ];

        if ($stock == 'Stock') {
            $data['qty'] = $this->request->getVar('qty');
        } else {
            $data['qty'] = '~';
        }

        $dataLama = $this->modelCatalog->getCatalog()->where('id', $id)->first();


        if ($namaImage != 'default.jpg' && $namaImage != $dataLama['image_product']) {
            $data['image_product'] = $namaImage;
        }

        if (
            $dataLama['id'] === $data['id'] &&
            $dataLama['id_product'] === $data['id_product'] &&
            $dataLama['name_product'] === $data['name_product'] &&
            $dataLama['price'] === $data['price'] &&
            $dataLama['description'] === $data['description'] &&
            $dataLama['id_kategori'] === $data['id_kategori'] &&
            $dataLama['stock'] === $data['stock'] &&
            $dataLama['qty'] === $data['qty'] &&
            $dataLama['image_product'] === $namaImage
        ) {
            session()->setFlashdata('same', 'Tidak produk yang diubah');
            return redirect()->route('add_product');
        }

        $this->modelCatalog->save($data);

        session()->setFlashdata('pesan', 'Produk berhasil diubah');

        return redirect()->to('add_product');
    }

    public function daftar_user()
    {
        $query = $this->modelUsers->getUsers()->findAll();

        $role = $this->db->table('auth_groups')->select('id, name, description')->get()->getResultArray();
        $data = [
            'title' => 'Daftar User',
            'users' => $query,
            'role'  => $role
        ];
        return view('root_admin/daftar_user', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getVar('active');
        if ($status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        $data = [
            'id'     => $id,
            'active' => $status
        ];

        $this->modelUsers->save($data);
        session()->setFlashdata('pesan', '');
        return redirect()->to('daftar_user');
    }

    public function save_user()
    {
        $users = model(ModelUsers::class);
        $rules = [
            'username' => [
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[30]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'alpha_numeric_space' => 'Username hanya dapat berisi karakter alfanumerik dan spasi.',
                    'min_length' => 'Username harus memiliki panjang minimal 1 karakter.',
                    'max_length' => 'Username tidak boleh lebih dari 30 karakter.',
                    'is_unique' => 'Username sudah digunakan oleh pengguna lain. Silakan pilih username lain.'
                ]
            ],

            'email'    => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Masukkan alamat email yang valid.',
                    'is_unique' => 'Email sudah digunakan oleh pengguna lain. Silakan gunakan email lain.'
                ]
            ],

            'password' => [
                'rules' => 'required|strong_password',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'strong_password' => 'Password harus mengandung minimal 8 karakter dan memenuhi syarat keamanan.'
                ]
            ],

            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu (role).'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        $role = $this->request->getVar('role');
        // dd($role);
        if (!empty($role)) {
            $users = $users->withGroup($role);
        }

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent      = $activator->send($user);

            if (!$sent) {
                return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
            }
            return redirect()->route('admin/daftarUsers')->with('message', lang('Auth.activationSuccess'));
        }

        session()->setFlashdata('pesan', 'Users berhasil ditambahkan');

        return redirect()->route('daftar_user');
    }

    public function update_user($id)
    {
        $users = model(ModelUsers::class);
        $user = $users->find($id);

        $rules = [
            'username' => [
                'rules' => 'required|alpha_numeric_space|min_length[1]|max_length[30]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'alpha_numeric_space' => 'Username hanya dapat berisi karakter alfanumerik dan spasi.',
                    'min_length' => 'Username harus memiliki panjang minimal 1 karakter.',
                    'max_length' => 'Username tidak boleh lebih dari 30 karakter.',
                ]
            ],

            'email'    => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Masukkan alamat email yang valid.',
                ]
            ],

            'password' => [
                'rules' => 'required|strong_password',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'strong_password' => 'Password harus mengandung minimal 8 karakter dan memenuhi syarat keamanan.'
                ]
            ],

            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih salah satu (role).'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user->fill($this->request->getPost($allowedPostFields));

        $role = $this->request->getVar('role');

        $q = [
            'user_id'   => $id,
            ' group_id' => $role,
        ];

        $this->db->table('auth_groups_users')->where('user_id', $id)->update($q);

        if (!$users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        session()->setFlashdata('pesan', 'Users berhasil diubah');

        return redirect()->route('daftar_user');
    }

    public function hapus_user($id)
    {
        // dd($id);
        $this->db->table('users')->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Users berhasil dihapus');
        return redirect()->to('daftar_user');
    }

    public function daftar_menu()
    {
        $query = $this->db->table('auth_permissions')->select('id, name, description')->get()->getResultArray();
        $data = [
            'title' => 'Menu Management',
            'menu'  => $query
        ];

        return view('root_admin/daftar_menu', $data);
    }

    public function save_menu()
    {
        $rules = [
            'name' => [
                'rules' => 'required|is_unique[auth_permissions.name]',
                'errors' => [
                    'required' => 'Nama menu harus diisi.',
                    'is_unique' => 'Nama menu sudah ada.'
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama menu harus diisi.',
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];

        $this->db->table('auth_permissions')->insert($data);

        session()->setFlashdata('pesan', 'Menu berhasil ditambahkan');

        return redirect()->route('daftar_menu');
    }

    public function change_menu($id)
    {
        $rules = [
            'name' => [
                'rules' => 'required|is_unique[auth_permissions.name,id,' . $id . ']',
                'errors' => [
                    'required' => 'Nama menu harus diisi.',
                    'is_unique' => 'Nama menu sudah ada.'
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi menu harus diisi.',
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'      => $id,
            'name'        => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
        ];

        $this->db->table('auth_permissions')->where('id', $id)->update($data);

        session()->setFlashdata('pesan', 'Menu berhasil ditambahkan');

        return redirect()->route('daftar_menu');
    }

    public function delete_menu($id)
    {
        $this->db->table('auth_permissions')->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Menu berhasil dihapus');
        return redirect()->to('daftar_menu');
    }

    public function daftar_submenu()
    {
        $query = $this->modelSubMenu->getSubMenu()->findAll();

        $menu = $this->db->table(' auth_permissions')->select('*')->get()->getResultArray();
        $data = [
            'title'   => 'Daftar Sub Menu',
            'submenu' => $query,
            'menu'    => $menu
        ];

        return view('root_admin/daftar_submenu', $data);
    }

    public function save_submenu()
    {
        $rules = [
            'title' => [
                'rules' => 'required|is_unique[sub_menu.title]',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah ada.'
                ],
            ],
            'menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu harus dipilih.',
                ],
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url harus diisi.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'menu_id' => $this->request->getVar('menu_id'),
            'title' => $this->request->getVar('title'),
            'url' => $this->request->getVar('url'),
            'active' => $this->request->getVar('active'),
        ];

        $this->modelSubMenu->save($data);

        session()->setFlashdata('pesan', 'SubMenu berhasil ditambahkan');

        return redirect()->route('daftar_submenu');
    }

    public function change_submenu($id)
    {
        $rules = [
            'title' => [
                'rules' => 'required|is_unique[sub_menu.title,id,' . $id . ']',
                'errors' => [
                    'required' => 'Judul harus diisi.',
                    'is_unique' => 'Judul sudah ada.'
                ],
            ],
            'menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu harus dipilih.',
                ],
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url harus diisi.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'       => $id,
            'menu_id'  => $this->request->getVar('menu_id'),
            'title'    => $this->request->getVar('title'),
            'url'      => $this->request->getVar('url'),
            'active'   => $this->request->getVar('active'),
        ];

        $dataLama = $this->modelSubMenu->select('*')->find($id);
        if (
            $dataLama['id'] === $data['id'] &&
            $dataLama['menu_id'] === $data['menu_id'] &&
            $dataLama['title'] === $data['title'] &&
            $dataLama['url'] === $data['url'] &&
            $dataLama['active'] === $data['active']
        ) {
            session()->setFlashdata('same', 'Tidak SubMenu yang diubah');
            return redirect()->route('daftar_submenu');
        }

        $this->modelSubMenu->save($data);

        session()->setFlashdata('pesan', 'SubMenu berhasil ditambahkan');

        return redirect()->route('daftar_submenu');
    }

    public function delete_submenu($id)
    {
        $this->modelSubMenu->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'SubMenu berhasil dihapus');
        return redirect()->to('daftar_submenu');
    }

    public function active($id)
    {
        $data = [
            'id'     => $id,
            'active' => $this->request->getVar('active')
        ];
        $this->modelSubMenu->save($data);

        session()->setFlashdata('pesan', 'Aktif');

        return redirect()->route('daftar_submenu');
    }

    public function daftar_event()
    {
        $query = $this->db->table('event')->select('*')->get()->getResultArray();
        $data = [
            'title' => 'Daftar Event',
            'event' => $query
        ];

        return view('root_admin/daftar_event', $data);
    }

    public function save_event()
    {
        $rules = [
            'gambar' => [
                'rules' => 'max_size[gambar,3000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang dipilih bukan gambar',
                    'mime_in'  => 'Yang dipilih bukan gambar',
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $fileImage = $this->request->getFile('gambar');

        if ($fileImage->getError() == 4) {
            $namaImage = 'default.jpg';
        } else {
            $namaImage = $fileImage->getName();
            $fileImage->move('img_product', $namaImage);
        }

        $data = [
            'gambar' => $namaImage,
        ];

        $this->db->table('event')->insert($data);

        session()->setFlashdata('pesan', 'Event berhasil ditambahkan');

        return redirect()->route('daftar_event');
    }
}
