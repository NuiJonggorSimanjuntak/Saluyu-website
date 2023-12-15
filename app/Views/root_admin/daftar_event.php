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
                        <div class="card mb-4 col-6">
                            <div class="card-body">
                                <button class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#modal-add"><span><i class="fas fa-plus"></i> Tambah Event</span></button>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th style="text-align: center;">Gambar</th>
                                            <th style="text-align: center; width: 35%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($event as $e) : ?>
                                            <tr style="text-align: center;">
                                                <td><?= $i++ . '.'; ?></td>
                                                <td style="width: 50%;">
                                                    <img src="<?= base_url('img_product/' . $e['gambar']); ?>" alt="Image" class="img-fluid">
                                                </td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $e['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                    <form action="" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal Add -->
                                            <div class="modal fade" id="modal-edit-<?= $e['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 30%;">
                                                    <div class="modal-content card-primary card-outline">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><label for="" style="color: black;">
                                                                    <h3>Form Tambah</h3>
                                                                </label></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('change_event/' . $e['id']) ?>" method="post" enctype="multipart/form-data">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-m-12">
                                                                        <div class="col-auto mb-2">
                                                                            <label for="gambar">
                                                                                <h6>Upload gambar</h6>
                                                                            </label>
                                                                            <input type="file" style="font-size: 15px; height: 10%;" class="form-control form-control-lg <?php if (session('errors.gambar')) : ?>is-invalid<?php endif ?>" id="image" name="gambar" onchange="previewImg()">
                                                                            <label class="custom-file-label" for="image"></label>
                                                                            <img src="/img_product/default.jpg" class="img-thumbnail img-preview" style="width: 100%;">
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.gambar'); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-pt-5">
                                                                        <div class="d-flex justify-content-between">
                                                                            <button type="submit" value="Simpan" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Simpan
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <!-- Modal Add -->
                                        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 30%;">
                                                <div class="modal-content card-primary card-outline">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><label for="" style="color: black;">
                                                                <h3>Form Tambah</h3>
                                                            </label></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('save_event') ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-m-12">
                                                                    <div class="col-auto mb-2">
                                                                        <label for="gambar">
                                                                            <h6>Upload gambar</h6>
                                                                        </label>
                                                                        <input type="file" style="font-size: 15px; height: 10%;" class="form-control form-control-lg <?php if (session('errors.gambar')) : ?>is-invalid<?php endif ?>" id="image" name="gambar" onchange="previewImg()">
                                                                        <label class="custom-file-label" for="image"></label>
                                                                        <img src="/img_product/default.jpg" class="img-thumbnail img-preview" style="width: 100%;">
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.gambar'); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-pt-5">
                                                                    <div class="d-flex justify-content-between">
                                                                        <button type="submit" value="Simpan" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Simpan
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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