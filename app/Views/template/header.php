<header>
    <div class="container py-5">
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $db = \Config\Database::connect();
                    $event = $db->table('event')->select('*')->get()->getResultArray();
                    $active = true;
                    ?>
                    <?php foreach ($event as $key => $e) : ?>
                        <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                            <img src="<?= base_url('img_product/' . $e['gambar']); ?>" class="d-block w-100" alt="Slide <?php echo $key + 1; ?>">
                        </div>
                        <?php $active = false; ?>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <script>
                $(document).ready(function() {
                    $('#myCarousel').carousel({
                        interval: 5000
                    });
                });
            </script>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</header>