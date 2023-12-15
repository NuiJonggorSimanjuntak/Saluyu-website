<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>

<div class="untree_co-section">
    <div class="container">
        <form action="<?= base_url('hubungi') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Detail Pemesanan</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">Nama Depan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_fname')) : ?>is-invalid<?php endif ?>" id="c_fname" name="c_fname" value="<?= old('c_fname'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_fname'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Nama Belakang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_lname')) : ?>is-invalid<?php endif ?>" id="c_lname" name="c_lname" value="<?= old('c_lname'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_lname'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_address')) : ?>is-invalid<?php endif ?>" id="c_address" name="c_address" placeholder="Street address" value="<?= old('c_address'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_address'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">RT / RW <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_state_country')) : ?>is-invalid<?php endif ?>" id="c_state_country" name="c_state_country" value="<?= old('c_state_country'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_state_country'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_postal_zip')) : ?>is-invalid<?php endif ?>" id="c_postal_zip" name="c_postal_zip" value="<?= old('c_postal_zip'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_postal_zip'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php if (session('errors.c_email_address')) : ?>is-invalid<?php endif ?>" id="c_email_address" name="c_email_address" value="<?= old('c_email_address'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_email_address'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Telepon<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  <?php if (session('errors.c_phone')) : ?>is-invalid<?php endif ?>" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?= old('c_phone'); ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.c_phone'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Kupon Kode</h2>
                            <div class="p-3 p-lg-5 border bg-white">

                                <label for="c_code" class="text-black mb-3">Masukkan Kode Mu</label>
                                <div class="input-group w-75 couponcode-wrap">
                                    <input type="text" class="form-control me-2" id="c_code" placeholder="Kupon Kode" aria-label="Coupon Code" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-black btn-sm" type="button" id="button-addon2">Terapkan</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Pesanan</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Produk</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($items as $item) : ?>
                                            <tr>
                                                <td><?= $item['name'] ?> <strong class="mx-2">x</strong> <?= $item['quantity'] ?></td>
                                                <td><?= $item['amount'] ?></td>
                                                <input type="hidden" name="itemName<?= $i; ?>" value="<?= $item['name'] ?>">
                                                <input type="hidden" name="itemQuantity<?= $i; ?>" value="<?= $item['quantity'] ?>">
                                                <input type="hidden" name="itemAmount<?= $i; ?>" value="<?= $item['amount'] ?>">
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Total Belanja</strong></td>
                                            <td class="text-black"><?= $totalAmount . ',00'; ?></td>
                                            <input type="hidden" name="totalbelanja" value="<?= $totalAmount . ',00'; ?>">
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Total Pesanan</strong></td>
                                            <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transfer Bank</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Nama Bank</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Virtual Account</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Dana Logo No <br> Gopay No</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-black btn-lg py-3 btn-block" type="submit">Silahkan Hubungi Admin</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>