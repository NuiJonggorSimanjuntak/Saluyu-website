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
            <?php if (session()->getFlashdata('same')) : ?>
                <div class="alert alert-warning" role="alert">
                    <?= session()->getFlashdata('same') ?>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-body">
                    <button class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#modal-add"><span><i class="fas fa-plus"></i> Tambah Menu</span></button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Menu</th>
                                <th>Url</th>
                                <th style="text-align: center;">Aktif</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($submenu as $sm) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $sm['title']; ?></td>
                                    <td><?= $sm['menu']; ?></td>
                                    <td><?= $sm['url']; ?></td>
                                    <td style="text-align: center;">
                                        <form id="form<?= $sm['id']; ?>" action="<?= base_url('active/' . $sm['id']); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" name="active" class="custom-control-input active-switch" id="activeSwitch<?= $sm['id']; ?>" data-id="<?= $sm['id']; ?>" <?= ($sm['active'] == '1') ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="activeSwitch<?= $sm['id']; ?>"></label>
                                            </div>
                                        </form>

                                        <script>
                                            document.querySelectorAll('.active-switch').forEach(activeSwitch => {
                                                activeSwitch.addEventListener('change', function() {
                                                    const formId = `form${this.getAttribute('data-id')}`;
                                                    const form = document.getElementById(formId);
                                                    this.value = this.checked ? '1' : null;
                                                    if (form) {
                                                        form.submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    </td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $sm['id']; ?>"><i class="fas fa-edit"></i> Edit</button>
                                        <form action="<?= base_url('delete_submenu/' . $sm['id']); ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modal-edit-<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
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
                                            <form action="<?= base_url('change_submenu/' . $sm['id']) ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-m-12">
                                                            <div class="col-auto mb-2">
                                                                <label for="title">
                                                                    <h6>Judul</h6>
                                                                </label>
                                                                <input type="text" name="title" class="form-control <?php if (session('errors.title')) : ?>is-invalid<?php endif ?>" id="title" title="title" value="<?= old('title', $sm['title']); ?>" autofocus>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.title'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="menu_id">
                                                                    <h6>Menu</h6>
                                                                </label>
                                                                <select name="menu_id" id="menu_id" class="form-control custom-select <?php if (session('errors.menu_id')) : ?>is-invalid<?php endif  ?>">
                                                                    <option selected disabled>--Pilih--</option>
                                                                    <?php foreach ($menu as $m) : ?>
                                                                        <option value="<?= $m['id']; ?>" <?= (old('menu_id', $sm['menu_id']) == $m['id']) ? 'selected' : ''; ?>><?= $m['description']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.menu_id'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="url">
                                                                    <h6>Url</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.url')) : ?>is-invalid<?php endif ?>" id="   " name="url" value="<?= old('url', $sm['url']); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.url'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <input type="checkbox" value="1" class="form-check-input" id="active" name="active" <?= ($sm['active'] == '1') ? 'checked' : ''; ?>>
                                                                <label for="active">
                                                                    <h6>Aktif?</h6>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-pt-5">
                                                            <div class="d-flex justify-content-between">
                                                                <button type="submit" value="Simpan" class="btn bg-success float-right"><i class="fas fa-save"></i> Simpan
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
                                            <form action="<?= base_url('save_submenu') ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-m-12">
                                                            <div class="col-auto mb-2">
                                                                <label for="title">
                                                                    <h6>Judul</h6>
                                                                </label>
                                                                <input type="text" name="title" class="form-control <?php if (session('errors.title')) : ?>is-invalid<?php endif ?>" id="title" title="title" value="<?= old('title'); ?>" autofocus>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.title'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="menu_id">
                                                                    <h6>Menu</h6>
                                                                </label>
                                                                <select name="menu_id" id="menu_id" class="form-control custom-select <?php if (session('errors.menu_id')) : ?>is-invalid<?php endif  ?>">
                                                                    <option selected disabled>--Pilih--</option>
                                                                    <?php foreach ($menu as $m) : ?>
                                                                        <option value="<?= $m['id']; ?>" <?= (old('menu_id') == $m['id']) ? 'selected' : ''; ?>><?= $m['description']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.menu_id'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <label for="url">
                                                                    <h6>Url</h6>
                                                                </label>
                                                                <input type="text" class="form-control <?php if (session('errors.url')) : ?>is-invalid<?php endif ?>" id="   " name="url" value="<?= old('url'); ?>">
                                                                <div class="invalid-feedback">
                                                                    <?= session('errors.url'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto mb-2">
                                                                <input type="checkbox" value="1" class="form-check-input" id="active" name="active" checked>
                                                                <label for="active">
                                                                    <h6>Aktif?</h6>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-pt-5">
                                                            <div class="d-flex justify-content-between">
                                                                <button type="submit" value="Simpan" class="btn bg-success float-right"><i class="fas fa-save"></i> Simpan
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