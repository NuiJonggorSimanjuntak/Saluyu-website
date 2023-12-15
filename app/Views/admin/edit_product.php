<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>

<footer class="footer-section">
    <div class="container relative">

        <div class="sofa-img">
            <img src="images/sofa.png" alt="Image" class="img-fluid">
        </div>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-8">
                <div class="subscription-form">
                    <form action="<?= base_url('change_product/' . $product['id']) ?>" method="post" enctype="multipart/form-data" class="col-md-6">
                        <?= csrf_field(); ?>
                        <div class="col-auto mb-4">
                            <label for="id_product">
                                <h3>ID Produk</h3>
                            </label>
                            <input type="text" class="form-control <?php if (session('errors.id_product')) : ?>is-invalid<?php endif ?>" id="id_product" name="id_product" value="<?= old('id_product', $product['id_product']); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= session('errors.id_product'); ?>
                            </div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="name_product">
                                <h3>Nama Produk</h3>
                            </label>
                            <input type="text" class="form-control <?php if (session('errors.name_product')) : ?>is-invalid<?php endif ?>" id="name_product" name="name_product" value="<?= old('name_product', $product['name_product']); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= session('errors.name_product'); ?>
                            </div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="price">
                                <h3>Harga Produk</h3>
                            </label>
                            <input type="number" class="form-control <?php if (session('errors.price')) : ?>is-invalid<?php endif ?>" id="price" name="price" value="<?= old('price', $product['price']); ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.name_product'); ?>
                            </div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="description">
                                <h3>Deskripsi Produk</h3>
                            </label>
                            <input type="text" class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="description" name="description" value="<?= old('description', $product['description']); ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.description'); ?>
                            </div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="description">
                                <h3>Kategori</h3>
                            </label>
                            <select name="kategori" class="form-control custom-select <?php if (session('errors.kategori')) : ?>is-invalid<?php endif  ?>">
                                <option selected disabled>--Pilih--</option>
                                <?php foreach ($kategori as $ktg) : ?>
                                    <option value="<?= $ktg['id']; ?>" <?= (old('kategori', $product['id_kategori']) == $ktg['id']) ? 'selected' : ''; ?>><?= $ktg['kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.kategori'); ?></div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="description">
                                <h3>Stock</h3>
                            </label>
                            <select name="stock" id="stock" class="form-control custom-select <?php if (session('errors.stock')) : ?>is-invalid<?php endif  ?>">
                                <option selected disabled>--Pilih--</option>
                                <option value="Stock" <?= (old('stock', $product['stock']) == 'Stock') ? 'selected' : ''; ?>>Stock</option>
                                <option value="Non Stock" <?= (old('stock', $product['stock']) == 'Non Stock') ? 'selected' : ''; ?>>Non Stock</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.stock'); ?></div>
                        </div>
                        <div class="col-auto mb-4" style="display: none;" id="inputqty">
                            <label for="qty">
                                <h3>Jumlah Barang</h3>
                            </label>
                            <input type="number" class="form-control <?php if (session('errors.qty')) : ?>is-invalid<?php endif ?>" id="qty" name="qty" value="<?= old('qty', $product['qty']); ?>">
                            <div class="invalid-feedback">
                                <?= session('errors.qty'); ?>
                            </div>
                        </div>
                        <div class="col-auto mb-4">
                            <label for="image_product">
                                <h3>Upload gambar</h3>
                            </label>
                            <input type="file" class="form-control form-control-lg <?php if (session('errors.image_product')) : ?>is-invalid<?php endif ?>" id="image" name="image_product" onchange="previewImg()">
                            <label class="custom-file-label" for="image"><?= $product['image_product']; ?></label>
                            <img src="/img_product/<?= $product['image_product']; ?>" class="img-thumbnail img-preview">
                            <div class="invalid-feedback">
                                <?= session('errors.image_product'); ?>
                            </div>
                        </div>

                        <div class="ccol-auto mb-4">
                            <button class="btn btn-primary" type="submit">
                                <span class="fa fa-save"> Ubah</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="subscription-form">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-12" method="post">
                            <div class="site-blocks-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th class="product-thumbnail">ID Produk</th>
                                            <th class="product-name">Nama Product</th>
                                            <th class="product-price">Harga Produk</th>
                                            <th class="product-quantity">Deskripsi</th>
                                            <th class="product-total">Gambar</th>
                                            <th class="product-remove">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                        <?php foreach ($catalog as $ctg) : ?>
                                            <tr>
                                                <td class="poduct-name">
                                                    <h2 class="h5 text-black"><?= $i++; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= $ctg['id_product']; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= $ctg['name_product']; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= $ctg['price']; ?></h2>
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?= $ctg['description']; ?></h2>
                                                </td>
                                                <td class="product-thumbnail">
                                                    <img src="<?= base_url('img_product/' . $ctg['image_product']); ?>" alt="Image" class="img-fluid">
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('edit_product/' . $ctg['id']); ?>" class="badge bg-warning" style="font-size: 1em;"><i class="fas fa-edit"></i>Edit</a>
                                                    <form action="<?= base_url('delete_product/' . $ctg['id']); ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="badge bg-danger" onclick="return confirm('apakah anda yakin')" style="font-size: 1em;"><span><i class="fas fa-trash-alt"></i>Hapus</span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?= $pager->links('catalog', 'paginations') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
                <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

                <ul class="list-unstyled custom-social">
                    <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>

            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Knowledge base</a></li>
                            <li><a href="#">Live chat</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Our team</a></li>
                            <li><a href="#">Leadership</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Nordic Chair</a></li>
                            <li><a href="#">Kruzo Aero</a></li>
                            <li><a href="#">Ergonomic Chair</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</footer>

<?= $this->endSection(); ?>