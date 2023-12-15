<?php

namespace App\Controllers;

use App\Models\ModelCatalog;
use App\Models\ModelKategori;
use App\Models\ModelSales;
use Dompdf\Dompdf;
use Dompdf\Options;

class Admin extends BaseController
{
    protected $modelCatalog, $db, $builder, $modelKategori, $modelSales, $cart;

    public function __construct()
    {
        $this->cart = \Config\Services::cart();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('catalog');
        $this->modelCatalog = new ModelCatalog();
        $this->modelKategori = new ModelKategori();
        $this->modelSales = new ModelSales();
    }

    public function transaksi()
    {
        $query = $this->modelSales->select('sales.id, users.name as user_name, pesanan, subtotal, tgl_pesanan, invoice, keterangan, admin.name as admin_name')
            ->join('users', 'users.id = sales.id_user')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->join('users as admin', 'admin.id = sales.admin', 'left')
            ->findAll();

        $data = [
            'title'     => 'Daftar Transaksi',
            'data'      => $query
        ];

        return view('admin/transaksi', $data);
    }

    public function detail_transaksi($id)
    {

        $query = $this->modelSales->select('sales.id, name, telephone, address, email, pesanan, subtotal, tgl_pesanan, invoice, keterangan')
            ->join('users', 'users.id = sales.id_user')
            ->find($id);

        $items = explode(', ', $query['pesanan']);
        $resultArray = [];
        foreach ($items as $item) {
            list($name, $quantityString) = explode('[', $item);
            $quantity = rtrim($quantityString, ']');
            $price = $this->modelCatalog->where('name_product', $name)->first()['price'];

            $resultArray[] = [
                'name_product'  => $name,
                'quantity'      => (int)$quantity,
                'price'         => (int)$price,
                'total'         => $price * (int)$quantity,
            ];
        }
        $data = [
            'title'    => 'Detail Pemesanan',
            'data'     => $resultArray,
            'customer' => $query
        ];
        return view('admin/detail_transaksi', $data);
    }

    public function hapus_transaksi($id)
    {
        $this->modelSales->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Transaksi berhasil dihapus');
        return redirect()->to('transaksi');
    }

    public function print($id)
    {
        $query = $this->modelSales->select('sales.id, name, telephone, address, pesanan, subtotal, tgl_pesanan, invoice, keterangan')
            ->join('users', 'users.id = sales.id_user')
            ->find($id);

        $items = explode(', ', $query['pesanan']);
        $resultArray = [];
        foreach ($items as $item) {
            list($name, $quantityString) = explode('[', $item);
            $quantity = rtrim($quantityString, ']');
            $price = $this->modelCatalog->where('name_product', $name)->first()['price'];
            $resultArray[] = [
                'name_product'  => $name,
                'quantity'      => (int)$quantity,
                'price'         => (int)$price,
                'total'         => $price * (int)$quantity,
            ];
        }

        $data = [
            'customer'      => $query,
            'data'          => $resultArray,
            'total_harga'   => $this->request->getVar('subtotal'),
            'dp'            => $this->request->getVar('dp'),
            'diskon'        => $this->request->getVar('diskon'),
            'sisa'          => $this->request->getVar('sisa'),
        ];

        $options = new Options();
        $options->set('isPhpEnabled', true);
        $pdf = new Dompdf($options);

        $view = view('admin/print', $data);

        $pdf->loadHtml($view);
        $pdf->setPaper('A3', 'portrait');
        $pdf->render();
        $output = $pdf->output();
        $filePath = FCPATH . 'invoice/';
        $fileName = "invoice_" . $query['name'] . '_' . $query['tgl_pesanan'] . '.pdf';
        file_put_contents($filePath . $fileName, $output);

        $invoice = [
            'id'         => $id,
            'invoice'    => $fileName,
            'keterangan' => 'sukses',
            'admin'      => user()->id
        ];
        $this->modelSales->save($invoice);

        session()->setFlashdata('pesan', 'invoice berhasil dicetak dan disimpan di ' . $filePath . $fileName);
        return redirect()->to('transaksi');
    }
}
