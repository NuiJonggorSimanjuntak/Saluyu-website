<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">
            <?php if (!empty(user()->username)) : ?>
                <?= user()->username; ?>
                <span>.</span>
            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('/'); ?>">Home</a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="<?= base_url('catalog'); ?>">Catalog</a></li> -->

                <?php if (logged_in()) : ?>
                    <?php
                    $modelMenu = new \App\Models\ModelMenu();
                    $menuQuery = $modelMenu->getMenu()->findAll();
                    $title = '';
                    ?>
                    <?php foreach ($menuQuery as $m) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <?= $m['description']; ?></a>
                            <?php
                            $modelSubmenu = new \App\Models\ModelSubMenu();
                            $subMenuQuery = $modelSubmenu->getSubMenu()
                                ->where('menu_id', $m['id'])
                                ->where('active', 1)
                                ->findAll();
                            ?>
                            <?php if (!empty($subMenuQuery)) : ?>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach ($subMenuQuery as $s) : ?>
                                        <li><a class="dropdown-item" href="<?= base_url($s['url']); ?>"><?= $s['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php if (!in_groups('admin') && logged_in()) : ?>
                <form class="d-flex" action="<?= base_url('/shopping_cart'); ?>">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <?php
                        $cart = \Config\Services::cart();
                        $cartData = $cart->contents();
                        ?>
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= count($cartData); ?></span>
                    </button>
                </form> 
            <?php endif; ?>
            <?php if (logged_in()) : ?>
                <form class="d-flex" action="<?= base_url('logout'); ?>" method="get" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                    <button class="btn btn-outline-dark" style="margin-left: 3px;" type="submit">
                        <i class="far fa-user"></i>
                        Keluar
                    </button>
                </form>
            <?php elseif (!logged_in()) : ?>
                <form class="d-flex" action="<?= base_url('login'); ?>">
                    <button class="btn btn-outline-dark" style="margin-left: 3px;" type="submit">
                        <i class="far fa-user"></i>
                        Masuk
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</nav>