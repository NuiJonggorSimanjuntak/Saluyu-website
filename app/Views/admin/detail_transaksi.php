<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div style="padding-bottom: 1pc">
                                <label for="nama" style="font-weight: bold; display: inline-block; width: 100px; padding-bottom: 5px;">Nama</label>
                                <span>:</span>
                                &#160;<?= $customer['name']; ?>
                                <br>
                                <label for="alamat" style="font-weight: bold; display: inline-block; width: 100px; padding-bottom: 5px;">Alamat</label>
                                <span>:</span>
                                &#160;<?= $customer['address']; ?>
                                <br>
                                <label for="email" style="font-weight: bold; display: inline-block; width: 100px; padding-bottom: 5px;">Email</label>
                                <span>:</span>
                                &#160;<?= $customer['email']; ?>
                                <br>
                                <label for="no_telp" style="font-weight: bold; display: inline-block; width: 100px; padding-bottom: 5px;">No. Telp</label>
                                <span>:</span>
                                &#160;<?= $customer['telephone']; ?>
                            </div>
                            <form action="<?= base_url('print/' . $customer['id']) ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width: 5%;">No.</th>
                                            <th class="product-thumbnail">Nama Barang</th>
                                            <th class="product-name">Harga</th>
                                            <th class="product-price" style="width: 13%; text-align: center;">Jumlah Barang</th>
                                            <th class="product-quantity" style="width: 20%; text-align: center;">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $dt) : ?>
                                            <tr>
                                                <td class="poduct-name" style="text-align: center;">
                                                    <h2 class="h5 text-black"><?= $i++ . '.'; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= $dt['name_product']; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= 'Rp. ' . number_format($dt['price'], 0, ',', '.') . ',00' ?></h2>
                                                </td>
                                                <td class="product-name" style="text-align: center;">
                                                    <h2 class="h5 text-black"><?= $dt['quantity']; ?></h2>
                                                </td>
                                                <td class="product-name" style="text-align: center;">
                                                    <h2 class="h5 text-black"><?= 'Rp. ' . number_format($dt['total'], 0, ',', '.') . ',00' ?></h2>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <tbody>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th style="text-align: end;">Total Harga</th>
                                            <td class="product-name" style="text-align: center;">
                                                <h2 class="h5 text-black"><?= 'Rp. ' . number_format($customer['subtotal'], 0, ',', '.') . ',00' ?></h2>
                                                <input type="hidden" value="<?= $customer['subtotal']; ?>" id="subtotal" name="subtotal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th style="text-align: end;">Bayar/DP</th>
                                            <td style="text-align: center;">
                                                <input type="number" style="text-align: center;" value="<?= old('db', '0'); ?>" id="db" name="dp">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th style="text-align: end;">Diskon</th>
                                            <td style="text-align: center;">
                                                <input type="number" style="text-align: center;" value="<?= old('diskon', '0'); ?>" id="diskon" name="diskon" onclick="calculateBayar()">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <th style="text-align: end;">Sisa</th>
                                            <td style="text-align: center;">
                                                <input type="text" style="text-align: center;" value="<?= old('sisa', '0'); ?>" id="sisa" name="sisa" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td style="text-align: center;">
                                                <button type="submit" class="btn btn-outline-primary btn-sm" style="font-size: 1em;"><span><i class="fas fa-file-invoice"></i> Invoice</span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function formatCurrency(sisa) {
        return '' + new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(sisa);
    }

    function calculateBayar() {
        var dp = document.getElementById('db').value;
        var diskon = document.getElementById('diskon').value;
        var subtotal = document.getElementById('subtotal').value;
        var sisa = subtotal - diskon - dp;
        sisa = Math.max(0, sisa);

        document.getElementById('sisa').value = formatCurrency(sisa);
    }
</script>
<?= $this->endSection(); ?>