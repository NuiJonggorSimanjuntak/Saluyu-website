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
                                <button class="btn btn-outline-info btn-sm mb-3" data-toggle="modal" data-target="#modal-add"><span><i class="fas fa-plus"></i> Tambah User</span></button>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th style="text-align: center;">Aktif</th>
                                            <th style="text-align: center;">Role</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++; ?></td>
                                                <td><?= $user->username; ?></td>
                                                <td><?= $user->email; ?></td>
                                                <td style="text-align: center;">
                                                    <form id="form<?= $user->userid; ?>" action="<?= base_url('updateStatus/' . $user->userid); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <?php if ($user->username !== user()->username) : ?>
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input type="checkbox" name="active" class="custom-control-input user-switch" id="userSwitch<?= $user->userid; ?>" data-userid="<?= $user->userid; ?>" <?= ($user->active == '1') ? 'checked' : ''; ?>>
                                                                <label class="custom-control-label" for="userSwitch<?= $user->userid; ?>"></label>
                                                            </div>
                                                        <?php endif; ?>
                                                    </form>

                                                    <script>
                                                        document.querySelectorAll('.user-switch').forEach(userSwitch => {
                                                            userSwitch.addEventListener('change', function() {
                                                                const formId = `form${this.getAttribute('data-userid')}`;
                                                                const form = document.getElementById(formId);

                                                                if (form) {
                                                                    form.submit();
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </td>
                                                <td style="text-align: center;"><?= $user->role; ?></td>
                                                <td style="text-align: center;">
                                                    <!-- <a href="<?= base_url('detail_user/' . $user->userid); ?>" class="badge bg-info" style="text-decoration: none;"><i class="fas fa-circle-info"></i> Detail</a> -->
                                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $user->userid; ?>"><i class="fas fa-edit"></i> Edit</button>
                                                    <?php if ($user->username !== user()->username) : ?>
                                                        <form action="<?= base_url('hapus_user/' . $user->userid); ?>" method="post" class="d-inline">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')"><span><i class="fas fa-trash-alt"></i> Hapus</span></button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modal-edit-<?= $user->userid; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                                <div class="modal-dialog col-md-3">
                                                    <div class="modal-content card-primary card-outline">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><label for="" style="color: black;">
                                                                    <h3>Form Edit</h3>
                                                                </label></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('update_user/' . $user->userid) ?>" method="post" enctype="multipart/form-data">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-m-12">
                                                                        <div class="col-auto mb-2">
                                                                            <label for="id_product">
                                                                                <h6>Username</h6>
                                                                            </label>
                                                                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" value="<?= old('username', $user->username); ?>" autofocus>
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.username'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="name_product">
                                                                                <h6>Email</h6>
                                                                            </label>
                                                                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" value="<?= old('email', $user->email); ?>">
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.email'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="description">
                                                                                <h6>Role</h6>
                                                                            </label>
                                                                            <select name="role" id="role" class="form-control custom-select <?php if (session('errors.role')) : ?>is-invalid<?php endif  ?>">
                                                                                <option selected disabled>--Pilih--</option>
                                                                                <?php foreach ($role as $r) : ?>
                                                                                    <option value="<?= $r['id']; ?>" <?= (old('role', $user->role) == $r['name']) ? 'selected' : ''; ?>><?= $r['description']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <div class="invalid-feedback"><?= session('errors.role'); ?></div>
                                                                        </div>
                                                                        <div class="col-auto mb-2 password-input-container">
                                                                            <label for="name_product">
                                                                                <h6>Kata Sandi</h6>
                                                                            </label>
                                                                            <div class="input-group">
                                                                                <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" value="<?= old('password'); ?>">
                                                                                <div class="input-group-append">
                                                                                    <button class="btn bg-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.password'); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-pt-5">
                                                                        <div class="d-flex justify-content-between">
                                                                            <button type="submit" value="Simpan" class="btn btn-outline-warning float-right"><i class="fas fa-save"></i> Ubah
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
                                            <div class="modal-dialog col-md-3">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><label for="" style="color: black;">
                                                                <h3>Form Tambah</h3>
                                                            </label></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('save_user') ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-m-12">
                                                                    <div class="col-auto mb-2">
                                                                        <label for="id_product">
                                                                            <h6>Username</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" value="<?= old('username'); ?>" autofocus>
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.username'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="name_product">
                                                                            <h6>Email</h6>
                                                                        </label>
                                                                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="   " name="email" value="<?= old('email'); ?>">
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.email'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="description">
                                                                            <h6>Role</h6>
                                                                        </label>
                                                                        <select name="role" id="role" class="form-control custom-select <?php if (session('errors.role')) : ?>is-invalid<?php endif  ?>">
                                                                            <option selected disabled>--Pilih--</option>
                                                                            <?php foreach ($role as $r) : ?>
                                                                                <option value="<?= $r['name']; ?>" <?= (old('role') == $r['name']) ? 'selected' : ''; ?>><?= $r['description']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <div class="invalid-feedback"><?= session('errors.role'); ?></div>
                                                                    </div>
                                                                    <div class="col-auto mb-2 password-input-container">
                                                                        <label for="name_product">
                                                                            <h6>Kata Sandi</h6>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" value="<?= old('password'); ?>">
                                                                            <div class="input-group-append">
                                                                                <button class="btn bg-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.password'); ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-pt-5">
                                                                    <div class="d-flex justify-content-between">
                                                                        <button type="submit" value="Simpan" class="btn btn-outline-primary float-right"><i class="fas fa-save"></i> Simpan
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