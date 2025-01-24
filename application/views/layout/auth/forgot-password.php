<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title;?></title>
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/style.css'; ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script type="text/javascript" src="<?= base_url() . 'assets/js/jquery.js'; ?>"></script>
    <script type="text/javascript" src="<?= base_url() . 'assets/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript" src="<?= base_url() . 'assets/js/bootstrap.bundle.min.js'; ?>"></script>
</head>

<body>
    <div class="wrapper">
        <?= $this->session->flashdata('pesan_regist') ;?>
        <div class="logo">
            <img src="<?= base_url() . 'assets/img/icon.png'; ?>" alt="">
        </div>
        <div class="text-center mt-4 name">
            <h6>Forgot your Password ?</h6>
        </div>
        <form class="p-4 mt-4" method="post" action="<?= base_url('auth/forgotPassword')?>">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="email" placeholder="Email">
            </div>
            <div>
                <small class="text-danger"><?= form_error('email')?></small>
            </div>
            <button type="submit" value="" class="btn mt-3">Reset Password</button>
        </form>
        <div class="text-center">
            <a href="<?= base_url('auth') ?>" class="small">Back to Login</a>
        </div>
    </div>
</body>

</html>