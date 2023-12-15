<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>
<div class="card m-4">
    <div id="layoutSidenav_content">
        <div class="untree_co-section">
            <div class="container">
                <form action="<?= base_url('hubungi') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row" style="justify-content: center;">
                        <div class="col-md-6">
                            <h3 class="mt-3 mb-3" style="font-weight: bold;"><?= $title; ?></h3>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <h2 class="h3 mb-3 text-black">Kupon</h2>
                                    <div class="p-3 p-lg-5 border" style="background: #363636; border-radius: 20px;">
                                        <label for="c_code" class="text-white mb-3">Masukkan Kode Mu</label>
                                        <div class="input-group couponcode-wrap">
                                            <input type="text" class="form-control me-2" id="c_code" placeholder="Kupon Kode" aria-label="Coupon Code" aria-describedby="button-addon2">
                                            <div class="input-group-append" style="width: 90px;">
                                                <button class="btn btn-outline-secondary text-white" type="button" id="button-addon2">Terapkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <h2 class="h3 text-black">Pesanan</h2>
                                    <div class="p-3 p-lg-5 border" style="background: #b9bbb6; border-radius: 20px;">
                                        <table class="table">
                                            <thead>
                                                <th class="text-white">Produk</th>
                                                <th class="text-white">Total</th>  
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($items as $item) : ?>
                                                    <tr class="text-white">
                                                        <td><?= $item['name'] ?> <strong class="mx-2">x</strong> <?= $item['quantity'] ?></td>
                                                        <td><?= $item['amount'] ?></td>
                                                        <input type="hidden" name="itemName<?= $i; ?>" value="<?= $item['name'] ?>">
                                                        <input type="hidden" name="itemQuantity<?= $i; ?>" value="<?= $item['quantity'] ?>">
                                                        <input type="hidden" name="itemAmount<?= $i; ?>" value="<?= $item['amount'] ?>">
                                                    </tr>
                                                    <?php $i++ ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td class="text-white font-weight-bold"><strong>Total Belanja</strong></td>
                                                    <td class="text-white"><?= $totalAmount . ',00'; ?></td>
                                                    <input type="hidden" name="totalbelanja" value="<?= $totalAmount . ',00'; ?>">
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="p-3 mb-3">
                                            <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transfer Bank</a></h3>

                                            <div class="collapse" id="collapsebank">
                                                <div class="py-2">
                                                    <p class="mb-0">Nama Bank</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3 mb-3">
                                            <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Virtual Account</a></h3>

                                            <div class="collapse" id="collapsecheque">
                                                <div class="py-2">
                                                    <p class="mb-0">Dana Logo No <br> Gopay No</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-outline-secondary btn-lg py-3 btn-block text-white border" type="submit">Silahkan Hubungi Admin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>