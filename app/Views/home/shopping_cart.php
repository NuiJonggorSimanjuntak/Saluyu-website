<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>
<section class="py-6">
    <div class="container">
        <div class="row justify-content-center">
            <?php if ($total == 0) : ?>
                <div class="untree_co-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center pt-5">
                                <span class="display-3 thankyou-icon text-primary" style="font-size: 20pc;">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check mb-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                                        <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
                                    </svg>
                                </span>
                                <p class="lead mb-5">Keranjang belanja Anda kosong</p>
                                <p><a href="<?= base_url('/'); ?>" class="btn btn-sm btn-outline-primary">Belanja Sekarang</a></p>
                            </div>
                        </div>
                    </div>
                    <div></div>
                </div>
            <?php else : ?>
                <main>
                    <div class="container-fluid px-4 mb-4">
                        <h3 class="mt-3 mb-3" style="font-weight: bold;"><?= $title; ?></h3>
                        <?php if (session()->getFlashdata('empty')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <h2 class="h5 text-red">
                                    <?= session()->getFlashdata('empty') ?>
                                </h2>
                            </div>
                        <?php endif; ?>
                        <div class="card">
                            <form method="post" action="<?= base_url('formulir'); ?>">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Pilih</th>
                                                <th style="width: 15%; text-align: center;">Image</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th style="text-align: center; width: 8%;">Quantity</th>
                                                <th>Total</th>
                                                <th style="text-align: center;">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($catalog as $ctg) : ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <input type="hidden" name="rowid<?= $i; ?>" value="<?= $ctg['rowid']; ?>">
                                                        <input type="checkbox" name="active<?= $i; ?>" class="custom-control-input user-switch" id="userSwitch<?= $ctg['id']; ?>" data-id="<?= $ctg['id']; ?>" checked>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <img src="<?= base_url('img_product/' . $ctg['image']); ?>" alt="Image" class="img-fluid" style="width: 20%; height: auto;">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="name<?= $i; ?>" class="form-control text-center quantity-amount" value="<?= $ctg['name']; ?>">
                                                        <h2 class="h5 text-black">
                                                            <span id="" data-price=""><?= $ctg['name']; ?></span>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <span id="price<?= $i; ?>" data-price="<?= $ctg['price']; ?>"><?= 'Rp ' . number_format($ctg['price'], 0, ',', '.') . ',00'; ?></span>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity<?= $i; ?>" class="form-control text-center quantity-amount" value="<?= $ctg['qty']; ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" id="quantity<?= $i; ?>" oninput="calculateAmount(<?= $i; ?>)">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount<?= $i; ?>" class="form-control" data-price="<?= $ctg['subtotal']; ?>" id="amount<?= $i; ?>" value="<?= 'Rp ' . number_format($ctg['subtotal'], 0, ',', '.') . ',00'; ?>" readonly style="text-align: center; width: 60%;">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="<?= base_url('remove_catalog/' . $ctg['rowid']); ?>" class="btn btn-black btn-sm"><label for="" style="color: red;">X</label></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>

                                                <script>
                                                    function formatCurrency(amount) {
                                                        return '' + new Intl.NumberFormat('id-ID', {
                                                            style: 'currency',
                                                            currency: 'IDR'
                                                        }).format(amount);
                                                    }

                                                    function calculateAmount($i) {
                                                        var price = parseFloat(document.getElementById('price' + $i).dataset.price);
                                                        var quantityInput = document.getElementById('quantity' + $i);
                                                        var quantity = quantityInput.value;
                                                        var amount = price * quantity;
                                                        amount = Math.max(0, amount);

                                                        if (quantity <= 0) {
                                                            var confirmation = confirm('Jumlah tidak boleh kurang dari 1. Apakah Anda yakin ingin menghapus item ini?');
                                                            if (confirmation) {
                                                                window.location.href = '<?= base_url('remove_catalog/' . $ctg['rowid']); ?>';
                                                            } else {
                                                                quantityInput.value = 1;
                                                            }
                                                            return;
                                                        }
                                                        console.log(amount);
                                                        document.getElementById('amount' + $i).value = formatCurrency(amount);
                                                    }

                                                    function calculateSubtotal() {
                                                        var price = parseFloat(document.getElementById('price' + $i).dataset.price);

                                                        console.log(price);
                                                        document.getElementById('subtotal').value = subtotal;
                                                    }
                                                </script>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <?php if ($total != 0) : ?>
                                        <div class="row justify-content-end">
                                            <div class="col-" style="width: 200px;">
                                                <div class="form-group mb-2">
                                                    <strong class="text-black">
                                                        <input type="hidden" name="subtotal" id="subtotal" value="<?= 'Rp ' . number_format($total, 0, ',', '.') . ',00'; ?>" readonly class="form-control" style="text-align: center; width: 100%;">
                                                    </strong>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-outline-secondary" style="color: #000; border-color: #000;">Proceed To Checkout</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>