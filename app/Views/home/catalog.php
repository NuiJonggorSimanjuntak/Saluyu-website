<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Keyword pencarian.." name="keyword" style="margin-right: 1%;">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default" name="">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($catalog as $ctg) : ?>
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="<?= base_url('cart/' . $ctg['id']); ?>">
                        <img src="<?= base_url('img_product/' . $ctg['image_product']); ?>" class="img-fluid product-thumbnail">
                        <h3 class="product-title"><?= $ctg['name_product']; ?></h3>
                        <strong class="product-price"><?= 'Rp. ' . number_format($ctg['price'], 0, ',', '.') . ',00' ?></strong>
                        <span class="icon-cross">
                            <img src="<?= base_url(); ?>/images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
            <?= $pager->links('catalog', 'paginations') ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>