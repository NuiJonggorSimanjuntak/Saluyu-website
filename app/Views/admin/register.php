<?= $this->extend('template/template'); ?>

<?= $this->section('page-content'); ?>
<div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url(); ?>style/images/bg-01.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50" style="width: 30%;">
            <span class="input100" style="color: white;">
                Account Register
            </span>
            <span style="color: red;"><?= view('Myth\Auth\Views\_message_block') ?></span>
            <form action="<?= url_to('register') ?>" method="post" class="login100-form validate-form p-b-33 p-t-5">
                <?= csrf_field() ?>
                <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.email') ?>">
                    <input class="input100 <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" type="email" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email'); ?>">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.username') ?>">
                    <input class="input100 <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" type="text" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username'); ?>">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Nama Lengkap">
                    <input class="input100 <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>" type="text" name="name" placeholder="Nama Lengkap" value="<?= old('name'); ?>">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Telepon">
                    <input class="input100 <?php if (session('errors.telephone')) : ?>is-invalid<?php endif ?>" type="number" name="telephone" placeholder="Telepon" value="<?= old('telephone'); ?>">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Alamat">
                    <input class="input100 <?php if (session('errors.address')) : ?>is-invalid<?php endif ?>" type="text" name="address" placeholder="Alamat" value="<?= old('address'); ?>">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.password') ?>">
                    <input class="input100 <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" type="password" name="password" placeholder="<?= lang('Auth.repeatPassword') ?>" value="<?= old('password'); ?>" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?= lang('Auth.repeatPassword') ?>">
                    <input class="input100 <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" type="password" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" value="<?= old('pass_confirm'); ?>" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        <?= lang('Auth.register') ?>
                    </button>
                </div>
            </form>
            <p  style="color: white;"><?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>"  style="color: white;"><?=lang('Auth.signIn')?></a></p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>