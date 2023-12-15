<?= $this->extend('template/template'); ?>

<?= $this->section('page-content'); ?>
<div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url(); ?>style/images/bg-01.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
            <span class="input100" style="color: white;">
                Account Login
            </span>
            <span style="color: red;"><?= view('Myth\Auth\Views\_message_block') ?></span>
            <form action="<?= url_to('login') ?>" method="post" class="login100-form validate-form p-b-33 p-t-5">
                <?= csrf_field() ?>
                <?php if ($config->validFields === ['email']) : ?>
                    <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.email') ?>">
                        <input class="input100 <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="email" name="email" placeholder="<?= lang('Auth.email') ?>">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                <?php else : ?>
                    <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.emailOrUsername') ?>">
                        <input class="input100 <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" type="text" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                <?php endif; ?>
                <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.password') ?>">
                    <input class="input100 <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" name="password" placeholder="<?= lang('Auth.password') ?>">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>
                <?php if ($config->allowRemembering) : ?>
                    <div class="wrap-input100 validate-input" style="margin-left: 37px;">
                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                        <?= lang('Auth.rememberMe') ?>
                    </div>
                <?php endif; ?>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        <?= lang('Auth.loginAction') ?>
                    </button>
                </div>
            </form>
            <?php if ($config->allowRegistration || $config->activeResetter) : ?>
                <div class="d-flex flex-row">
                    <?php if ($config->allowRegistration) : ?>
                        <p style="margin-right: 34%;"><a href="<?= site_url('register') ?>" style="color: white;"><?= lang('Auth.needAnAccount') ?></a></p>
                    <?php endif; ?>
                    <?php if ($config->activeResetter) : ?>
                        <p><a href="<?= site_url('forgot') ?>" style="color: white;"><?= lang('Auth.forgotYourPassword') ?></a></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>