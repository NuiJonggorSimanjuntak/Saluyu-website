<?php

namespace App\Controllers;

use App\Models\ModelCatalog;
use App\Models\ModelUser;
use App\Models\ModelSales;

class Home extends BaseController
{
    protected $modelCatalog, $modelUser, $cart, $modelSales, $db;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->db = \Config\Database::connect();
        $this->modelCatalog = new ModelCatalog();
        $this->modelUser = new ModelUser();
        $this->modelSales = new ModelSales();
    }

    public function index()
    {
        $catalog = $this->db->table('catalog_kategori')->select('id, kategori')->get()->getResultArray();
        $id_kategori = intval($this->request->getVar('id_kategori'));
        $keyword = $this->request->getVar('keyword');

        if ($id_kategori) {
            $cat = $this->db->table('catalog_kategori')->select('id, kategori')
                ->where('id', $id_kategori)
                ->get()->getResultArray();
        } else {
            $cat = $this->db->table('catalog_kategori')->select('id, kategori')->get()->getResultArray();
        }

        $allCatalogs = [];

        foreach ($cat as $kategoriItem) {
            $query = $this->modelCatalog
                ->select('catalog.id, name_product, image_product, price, id_kategori, kategori')
                ->join('catalog_kategori', 'catalog_kategori.id = catalog.id_kategori')
                ->where('id_kategori', $kategoriItem['id']);

            if ($keyword) {
                $query->like('name_product', $keyword);
            }

            $produk = $query->findAll();

            $allCatalogs[$kategoriItem['kategori']] = $produk;
        }

        $data = [
            'title'         => 'Home',
            'kategori'      => $cat,
            'allCatalogs'   => $allCatalogs,
            'catalog'       => $catalog,
        ];

        return view('Home/index', $data);
    }


    public function cart($id)
    {
        $query = $this->modelCatalog->getCatalog()->find($id);

        $data = [
            'id'      => $id,
            'qty'     => 1,
            'price'   => $query['price'],
            'name'    => $query['name_product'],
            'image'    => $query['image_product'],
        ];
        $this->cart->insert($data);

        return redirect()->back();
    }

    public function catalog()
    {
        $currentPage = $this->request->getVar('page_catalog') ? $this->request->getVar('page_catalog') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $query = $this->modelCatalog->getCatalogKeyword($keyword);
        } else {
            $query = $this->modelCatalog->getCatalog();
        }

        $data = [
            'title'         => 'Katalog',
            'catalog'       => $query->paginate('20', 'catalog'),
            'pager'         => $this->modelCatalog->pager,
            'currentPage'   => $currentPage
        ];

        return view('home/catalog', $data);
    }

    public function shopping_cart()
    {
        $catalog = $this->cart->contents();
        $data = [
            'title'   => 'Keranjang',
            'catalog' => $catalog,
            'total'   => $this->cart->total(),
        ];

        $data['json_encode'] = json_encode($data['total']);

        return view('home/shopping_cart', $data);
    }

    public function remove_catalog($id)
    {
        $this->cart->remove($id);
        return redirect()->to('shopping_cart');
    }

    public function add_cart($id)
    {
        $query = $this->modelCatalog->getCatalog()->find($id);

        $data = [
            'id'      => $id,
            'qty'     => 1,
            'price'   => $query['price'],
            'name'    => $query['name_product'],
            'image'   => $query['image_product']
        ];
        $this->cart->insert($data);

        return redirect()->to('shopping_cart');
    }

    public function remove_cart($id)
    {
        $item = $this->cart->getItem($id);
        if ($item) {
            $new_qty = $item['qty'] - 1;

            if ($new_qty <= 0) {
                $this->cart->remove($id);
            } else {
                $data = array(
                    'rowid' => $item['rowid'],
                    'qty' => $new_qty
                );
                $this->cart->update($data);
            }
        }

        return redirect()->back();
    }

    public function formulir()
    {
        $jumlahItem = $this->cart->contents();

        $totalbelanja = $this->cart->total();

        for ($i = 1; $i <= count($jumlahItem); $i++) {
            $id = $this->request->getVar('rowid' . $i);
            $qty = $this->request->getVar('quantity' . $i);
            $this->cart->update(array(
                'rowid'   => $id,
                'qty'     => (int)$qty,
            ));
        }

        $data['items'] = [];

        $productSelected = false;

        for ($i = 1; $i <= count($jumlahItem); $i++) {
            $activeKey = 'active' . $i;
            $nameKey = 'name' . $i;
            $quantityKey = 'quantity' . $i;
            $amountKey = 'amount' . $i;

            $activeValue = $this->request->getVar($activeKey);

            if ($activeValue === 'on') {
                $productSelected = true;

                $nameValue = $this->request->getVar($nameKey);
                $quantityValue = $this->request->getVar($quantityKey);
                $amountValue = $this->request->getVar($amountKey);

                $data['items'][] = [
                    'name' => $nameValue,
                    'quantity' => $quantityValue,
                    'amount' => $amountValue,
                ];
            }
        }

        if ($productSelected) {
            $data['totalAmount'] = 'Rp ' . number_format($this->cart->total(), 0, ',', '.');
            $data['title'] = 'Checkout';
            return view('home/formulir', $data);
        } else {
            session()->setFlashdata('empty', 'Product Belum Dipilih !!!');
            return redirect()->back();
        }
    }

    public function hubungi()
    {
        $cartContents = $this->cart->contents();
        $itemCount = count($cartContents);
        $products = [];
        for ($i = 1; $i <= $itemCount; $i++) {
            $nameKey = 'itemName' . $i;
            $quantityKey = 'itemQuantity' . $i;
            $product = [
                'name_product'  => $this->request->getVar($nameKey),
                'quantity'      => $this->request->getVar($quantityKey),
            ];

            $products[] = $product;
        }
        $totalbelanja = $this->request->getVar('totalbelanja');

        $cart = $this->cart->contents();
        $combinedOrders = '';

        foreach ($cart as $crt) {
            $combinedOrders .= $crt['name'] . '[' . $crt['qty'] . '], ';
        }

        $combinedOrders = rtrim($combinedOrders, ', ');
        $dataTambahan = [
            'id_user'        => user()->id,
            'subtotal'       => $this->cart->total(),
            'tgl_pesanan'    => date('Y-m-d'),
            'pesanan' => $combinedOrders,
        ];

        $this->modelSales->save($dataTambahan);
        $this->cart->destroy();

        $phoneNumber = '+6287719356202';
        $message = json_encode($products);
        $text = json_decode($message, true);
        $textView = "Nama: " . user()->name . "\n";
        $textView .= "Hp: " . user()->telephone . "\n\n";
        $textView .= "Nama Produk: " . "\n";
        foreach ($text as $product) {
            $textView .= $product['name_product'] . ":" . $product['quantity'] . "\n";
        }
        $textView .= "Total Harga: " . $totalbelanja . "\n\n";
        $textView .= "Saya Tertarik dengan produk ini.";

        $whatsappUrl = $this->generateWhatsappUrl($phoneNumber, $textView);
        $wa['whatsappUrl'] = $whatsappUrl;
        $wa['title'] = '';
        return view('home/order', $wa);
    }

    private function generateWhatsappUrl($phoneNumber, $message)
    {
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$phoneNumber}&text=" . rawurlencode($message);
        return $whatsappUrl;
    }

    public function warning()
    {
        return view('warning');
    }
}
