<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?><?= base_url(); ?>bootstrap/assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>bootstrap/css/styles1.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>bootstrap/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navigation-->
    <?= $this->include('template/navbar'); ?>
    <!-- Header-->
    <?= $this->include('template/header'); ?>
    <!-- Section-->
    <?= $this->renderSection('page-content'); ?>
    <!-- Footer-->
    <?= $this->include('template/footer'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>bootstrap/js/scripts1.js"></script>
    <script src="<?= base_url(); ?>bootstrap/js/scripts.js"></script>
    <script src="<?= base_url(); ?>bootstrap/js/datatables-simple-demo.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function previewImg() {
            const image = document.querySelector('#image');
            const label = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            label.textContent = image.files[0].name;

            const fileImage = new FileReader();
            fileImage.readAsDataURL(image.files[0]);

            fileImage.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var stockSelect = document.getElementById("stock");
            var inputQty = document.getElementById("inputqty");
            toggleQtyInput();
            stockSelect.addEventListener("change", function() {
                toggleQtyInput();
            });

            function toggleQtyInput() {
                var selectedStock = stockSelect.value;
                console.log("Selected Stock:", selectedStock);
                inputQty.style.display = (selectedStock === "Stock") ? "block" : "none";
            }
        });
    </script>
</body>

</html>