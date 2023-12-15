<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>
<section class="py-6">
    <div class="container">
        <div class="row justify-content-center">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-3 mb-3" style="font-weight: bold;"><?= $title; ?></h3>
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th>Nama</th>
                                            <th>Pesanan</th>
                                            <th>Total Harga</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th style="text-align: center;">Invoice</th>
                                            <th style="text-align: center;">Status</th>
                                            <th>Admin</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $dt) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++; ?></td>
                                                <td><?= $dt['user_name']; ?></td>
                                                <td><?= $dt['pesanan']; ?></td>
                                                <td><?= 'Rp. ' . number_format($dt['subtotal'], 0, ',', '.') . ',00' ?></td>
                                                <td><?= $dt['tgl_pesanan']; ?></td>
                                                <td style="text-align: center;">
                                                    <button href="" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-info-<?= $dt['id']; ?>">[Lihat]</button>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if ($dt['keterangan'] == 'sukses') : ?>
                                                        <i class="fas fa-circle-check" style="color: green;"></i>
                                                    <?php else : ?>
                                                        <i class="fas fa-circle-xmark" style="color: red;"></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $dt['admin_name']; ?></td>
                                                <td style="text-align: center;">
                                                    <?php if (empty($dt['keterangan'])) : ?>
                                                        <a class="btn btn-outline-primary btn-sm" href="<?= base_url('detail_transaksi/' . $dt['id']); ?>" style="text-decoration: none;"><i class="fas fa-edit"></i> Detail</a>
                                                    <?php endif; ?>
                                                    <form action="<?= base_url('hapus_transaksi/' . $dt['id']); ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- modal invoice -->
                                            <div class="modal fade" id="modal-info-<?= $dt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-primary">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Invoice</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: center;">
                                                            <?php if (!empty($dt['invoice'])) : ?>
                                                                <iframe src="<?= base_url('invoice/' . $dt['invoice']); ?>" width="100%" height="380px" style="border: none;"></iframe>
                                                            <?php else : ?>
                                                                <p>Invoice Belum Ada!</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>