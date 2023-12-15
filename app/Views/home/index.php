<?= $this->extend('template/index'); ?>

<?= $this->section('page-content'); ?>
<section class="py-6">
	<div class="container px-4 px-lg-5 mt-5">
		<div class="col-md-12 mb-4">
			<form action="" method="post">
				<div class="input-group">
					<select name="id_kategori" id="kategoriSelect" class="form-control form-select" aria-label="Default select example" style="background: gainsboro;">
						<option selected disabled>Kategori</option>
						<?php foreach ($catalog as $k) : ?>
							<option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
						<?php endforeach; ?>
					</select>
					<input type="text" class="form-control form-control-lg" placeholder="Keyword pencarian.." name="keyword" style="margin-right: 1%; width: 60%;">
					<div class="input-group-append">
						<button type="submit" class="btn btn-lg btn-default" name="">
							<i class="fa fa-search"></i>
						</button>
					</div>
					<script>
						document.getElementById('kategoriSelect').addEventListener('change', function() {
							var selectedValue = this.value;
							var baseUrl = '<?= base_url('/'); ?>';
							window.location.href = baseUrl + '?id_kategori=' + selectedValue;
						});
					</script>
				</div>
			</form>
		</div>
		<?php foreach ($kategori as $k) : ?>
			<h1><?= $k['kategori']; ?></h1>
			<br>
			<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
				<?php foreach ($allCatalogs[$k['kategori']] as $c) : ?>
					<div class="col mb-5">
						<div class="card h-100">
							<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
							<img class="card-img-top" src="<?= base_url('img_product/' . $c['image_product']); ?>" alt="..." width="450" height="300" />
							<div class="card-body p-4">
								<div class="text-center">
									<h5 class="fw-bolder"><?= $c['name_product']; ?></h5>
									<div class="d-flex justify-content-center small text-warning mb-2">
										<div class="bi-star-fill"></div>
										<div class="bi-star-fill"></div>
										<div class="bi-star-fill"></div>
										<div class="bi-star-fill"></div>
										<div class="bi-star-fill"></div>
									</div>
									<?= 'Rp. ' . number_format($c['price'], 0, ',', '.') . ',00' ?>
								</div>
							</div>
							<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
								<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?= base_url('cart/' . $c['id']); ?>">Add to cart</a></div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?= $this->endSection(); ?>