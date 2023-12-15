<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?><section class="py-6">
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
                    <button class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#modal-add"><span><i class="fas fa-plus"></i> Tambah Menu</span></button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Menu</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($menu as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $m['description']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="" class="btn btn-outline-info btn-sm" style="text-decoration: none;"><i class="fas fa-circle-info"></i> Detail</a>
                                        <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $m['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <form action="<?= base_url('delete_menu/' . $m['id']); ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modal-edit-<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                    <div class="modal-dialog" style="max-width: 30%;">
                                        <div class="modal-content card-primary card-outline">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><label for="" style="color: black;">
                                                        <h3>Form Edit</h3>
                                                    </label></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('change_menu/' . $m['id']) ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-m-12">
                                                            <div class="col-auto mb-2">
                                                                <label for="name">
                                                                    <h6>Name</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" id="name" name="name" value="<?= old('name', $m['name']); ?>" autofocus>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.name'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="description">
                                                                    <h6>Description</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="   " name="description" value="<?= old('description', $m['description']); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.description'); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-pt-5">
                                                            <div class="d-flex justify-content-between">
                                                                <button type="submit" value="Simpan" class="btn btn-outline-warning btn-sm"><i class="fas fa-save"></i> Ubah
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
                                            <form action="<?= base_url('save_menu') ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-m-12">
                                                            <div class="col-auto mb-2">
                                                                <label for="name">
                                                                    <h6>Name</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" id="name" name="name" value="<?= old('name'); ?>" autofocus>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.name'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="description">
                                                                    <h6>Description</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="   " name="description" value="<?= old('description'); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.description'); ?>
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
<script>
    document.querySelectorAll("#togglePassword").forEach(function(button) {
        button.addEventListener("click", function() {
            var passwordInput = this.closest(".modal").querySelector("#password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
</script>
<?= $this->endSection(); ?>