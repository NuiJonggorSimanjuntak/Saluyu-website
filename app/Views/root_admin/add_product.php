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
                        <div class="col-sm-12">
                            <?php if (session()->getFlashdata('same')) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <?= session()->getFlashdata('same') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <button class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#modal-add"><span><i class="fas fa-plus"></i> Tambah Product</span></button>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No.</th>
                                            <th>ID Produk</th>
                                            <th>Nama Product</th>
                                            <th>Harga Produk</th>
                                            <th>Deskripsi</th>
                                            <th style="text-align: center; width: 10%;">Gambar</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                        <?php foreach ($catalog as $ctg) : ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++; ?></td>
                                                <td><?= $ctg['id_product']; ?></td>
                                                <td><?= $ctg['name_product']; ?></td>
                                                <td><?= $ctg['price']; ?></td>
                                                <td><?= $ctg['description']; ?></td>
                                                <td style="text-align: center; width: 20%; height: auto;">
                                                    <img src="<?= base_url('img_product/' . $ctg['image_product']); ?>" alt="Image" class="img-fluid">
                                                </td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-outline-warning btn-sm" style="font-size: 1em;" data-toggle="modal" data-target="#modal-edit-<?= $ctg['id']; ?>"><i class="fas fa-edit"></i>Edit</button>
                                                    <form action="<?= base_url('delete_product/' . $ctg['id']); ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')" style="font-size: 1em;"><span><i class="fas fa-trash-alt"></i>Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modal-edit-<?= $ctg['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 40%;">
                                                    <div class="modal-content card-primary card-outline">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><label for="" style="color: black;">
                                                                    <h3>Form Edit</h3>
                                                                </label></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('change_product/' . $ctg['id']) ?>" method="post" enctype="multipart/form-data">
                                                            <?= csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-m-12">
                                                                        <div class="col-auto mb-2">
                                                                            <label for="id_product">
                                                                                <h6>ID Produk</h6>
                                                                            </label>
                                                                            <input type="text" class="form-control <?php if (session('errors.id_product')) : ?>is-invalid<?php endif ?>" id="id_product" name="id_product" value="<?= old('id_product', $ctg['id_product']); ?>" readonly>
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.id_product'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="name_product">
                                                                                <h6>Nama Produk</h6>
                                                                            </label>
                                                                            <input type="text" class="form-control <?php if (session('errors.name_product')) : ?>is-invalid<?php endif ?>" id="name_product" name="name_product" value="<?= old('name_product', $ctg['name_product']); ?>" autofocus>
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.name_product'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="price">
                                                                                <h6>Harga Produk</h6>
                                                                            </label>
                                                                            <input type="number" class="form-control <?php if (session('errors.price')) : ?>is-invalid<?php endif ?>" id="price" name="price" value="<?= old('price', $ctg['price']); ?>">
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.name_product'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="description">
                                                                                <h6>Deskripsi Produk</h6>
                                                                            </label>
                                                                        <textarea class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="description" name="description"><?= old('description', $ctg['description']); ?></textarea>
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.description'); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="description">
                                                                                <h6>Kategori</h6>
                                                                            </label>
                                                                            <select name="kategori" class="form-control custom-select <?php if (session('errors.kategori')) : ?>is-invalid<?php endif  ?>">
                                                                                <option selected disabled>--Pilih--</option>
                                                                                <?php foreach ($kategori as $ktg) : ?>
                                                                                    <option value="<?= $ktg['id']; ?>" <?= (old('kategori', $ctg['id_kategori']) == $ktg['id']) ? 'selected' : ''; ?>><?= $ktg['kategori']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <div class="invalid-feedback"><?= session('errors.kategori'); ?></div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="stock">
                                                                                <h6>Stock</h6>
                                                                            </label>
                                                                            <select name="stock" id="edit-stock-<?= $ctg['id']; ?>" class="form-control custom-select <?php if (session('errors.stock')) : ?>is-invalid<?php endif; ?>">
                                                                                <option selected disabled>--Pilih--</option>
                                                                                <option value="Stock" <?= ($ctg['stock'] == 'Stock') ? 'selected' : ''; ?>>Stock</option>
                                                                                <option value="Non Stock" <?= ($ctg['stock'] == 'Non Stock') ? 'selected' : ''; ?>>Non Stock</option>
                                                                            </select>
                                                                            <div class="invalid-feedback"><?= session('errors.stock'); ?></div>
                                                                        </div>
                                                                        <div class="col-auto mb-2" id="edit-inputqty-<?= $ctg['id']; ?>" style="display: none;">
                                                                            <label for="qty">
                                                                                <h6>Jumlah Barang</h6>
                                                                            </label>
                                                                            <input type="number" class="form-control <?php if (session('errors.qty')) : ?>is-invalid<?php endif; ?>" id="qty" name="qty" value="<?= old('qty', $ctg['qty']); ?>">
                                                                            <div class="invalid-feedback"><?= session('errors.qty'); ?></div>
                                                                        </div>
                                                                        <div class="col-auto mb-2">
                                                                            <label for="image_product">
                                                                                <h6>Upload gambar</h6>
                                                                            </label>
                                                                            <input type="file" class="form-control form-control-lg <?php if (session('errors.image_product')) : ?>is-invalid<?php endif ?>" id="image<?= $ctg['id']; ?>" name="image_product" onchange="previewImage('<?= $ctg['id']; ?>')">
                                                                            <label class="custom-file-label<?= $ctg['id']; ?>" for="image"><?= $ctg['image_product']; ?></label><br>
                                                                            <img src="/img_product/<?= $ctg['image_product']; ?>" class="img-thumbnail img-preview<?= $ctg['id']; ?>" id="previewImage<?= $ctg['id']; ?>" style="width: 100%;">
                                                                            <div class="invalid-feedback">
                                                                                <?= session('errors.image_product'); ?>
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
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    var editStockSelect = document.getElementById("edit-stock-<?= $ctg['id']; ?>");
                                                    var editInputQty = document.getElementById("edit-inputqty-<?= $ctg['id']; ?>");

                                                    toggleQtyInput();

                                                    editStockSelect.addEventListener("change", function() {
                                                        toggleQtyInput();
                                                    });

                                                    function toggleQtyInput() {
                                                        var selectedStock = editStockSelect.value;
                                                        editInputQty.style.display = (selectedStock === "Stock") ? "block" : "none";
                                                    }
                                                });
                                            </script>
                                        <?php endforeach; ?>

                                        <!-- Modal Add -->
                                        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-add-label" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 40%;">
                                                <div class="modal-content card-primary card-outline">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><label for="" style="color: black;">
                                                                <h3>Form Tambah</h3>
                                                            </label></h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('save_product') ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-m-12">
                                                                    <div class="col-auto mb-2">
                                                                        <label for="id_product">
                                                                            <h6>ID Produk</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control <?php if (session('errors.id_product')) : ?>is-invalid<?php endif ?>" id="id_product" name="id_product" value="<?= $id_product; ?>" readonly>
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.id_product'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="name_product">
                                                                            <h6>Nama Produk</h6>
                                                                        </label>
                                                                        <input type="text" class="form-control <?php if (session('errors.name_product')) : ?>is-invalid<?php endif ?>" id="name_product" name="name_product" value="<?= old('name_product'); ?>" autofocus>
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.name_product'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="price">
                                                                            <h6>Harga Produk</h6>
                                                                        </label>
                                                                        <input type="number" class="form-control <?php if (session('errors.price')) : ?>is-invalid<?php endif ?>" id="price" name="price" value="<?= old('price'); ?>">
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.name_product'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="description">
                                                                            <h6>Deskripsi Produk</h6>
                                                                        </label>
                                                                        <textarea class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="description" name="description"><?= old('description'); ?></textarea>
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.description'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="description">
                                                                            <h6>Kategori</h6>
                                                                        </label>
                                                                        <select name="kategori" class="form-control custom-select <?php if (session('errors.kategori')) : ?>is-invalid<?php endif  ?>">
                                                                            <option selected disabled>--Pilih--</option>
                                                                            <?php foreach ($kategori as $ktg) : ?>
                                                                                <option value="<?= $ktg['id']; ?>" <?= (old('kategori') == $ktg['id']) ? 'selected' : ''; ?>><?= $ktg['kategori']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                        <div class="invalid-feedback"><?= session('errors.kategori'); ?></div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="description">
                                                                            <h6>Stock</h6>
                                                                        </label>
                                                                        <select name="stock" id="stock" class="form-control custom-select <?php if (session('errors.stock')) : ?>is-invalid<?php endif  ?>">
                                                                            <option selected disabled>--Pilih--</option>
                                                                            <option value="Stock" <?= (old('stock') == 'Stock') ? 'selected' : ''; ?>>Stock</option>
                                                                            <option value="Non Stock" <?= (old('stock') == 'Non Stock') ? 'selected' : ''; ?>>Non Stock</option>
                                                                        </select>
                                                                        <div class="invalid-feedback"><?= session('errors.stock'); ?></div>
                                                                    </div>
                                                                    <div class="col-auto mb-2" style="display: none;" id="inputqty">
                                                                        <label for="qty">
                                                                            <h6>Jumlah Barang</h6>
                                                                        </label>
                                                                        <input type="number" class="form-control <?php if (session('errors.qty')) : ?>is-invalid<?php endif ?>" id="qty" name="qty" value="<?= old('qty'); ?>">
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.qty'); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto mb-2">
                                                                        <label for="image_product">
                                                                            <h6>Upload gambar</h6>
                                                                        </label>
                                                                        <input type="file" style="font-size: 15px; height: 10%;" class="form-control form-control-lg <?php if (session('errors.image_product')) : ?>is-invalid<?php endif ?>" id="image" name="image_product" onchange="previewImg()">
                                                                        <label class="custom-file-label" for="image"></label>
                                                                        <img src="/img_product/default.jpg" class="img-thumbnail img-preview" style="width: 100%;">
                                                                        <div class="invalid-feedback">
                                                                            <?= session('errors.image_product'); ?>
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
                                <div style="text-align: center;">
                                    <?= $pager->links('catalog', 'paginations') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
    </div>
</section>
<script>
    function previewImage(id) {
        var input = document.getElementById('image' + id);
        var preview = document.getElementById('previewImage' + id);
        var label = document.querySelector('.custom-file-label' + id);

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
            label.innerHTML = input.files[0].name;
        }
    }
</script>
<?= $this->endSection(); ?>