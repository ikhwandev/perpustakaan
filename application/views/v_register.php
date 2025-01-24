<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER AREA</title>
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/style.css'; ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script type="text/javascript" src="<?= base_url() . 'assets/js/bootstrap.js'; ?>"></script>
    <script type="text/javascript" src="<?= base_url() . 'assets/js/bootstrap.bundle.min.js'; ?>"></script>
    <script type="text/javascript" src="<?= base_url() . 'assets/js/jquery.js'; ?>"></script>
</head>

<body>
    <div class="wrapper mx-auto col-sm-4 ">
        <div class="logo">
            <img src="<?= base_url() . 'assets/img/icon.png'; ?>" alt="">
        </div>
        <div class="text-center mt-2 name">
            REGISTER
        </div>
        <form class="mt-2" method="post" action="<?= base_url('auth/registration')?>">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="name" placeholder="Username" value="<?= set_value('name')?>">
            </div>
            <div>
                 <small class="text-danger"><?= form_error('name')?></small>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-envelope"></span>
                <input type="text" name="email" placeholder="Email" value="<?= set_value('email')?>">
            </div>
            <div>
                 <small class="text-danger"><?= form_error('email')?></small>
            </div>
            <div class="form-group row">
                <div class="col justify-content-md-center m-2 form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password1" placeholder="Password">
                </div>
                <div class="col justify-content-md-center m-2 form-field d-flex align-items-center">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password2" placeholder="Repeat Password">
                </div>
            </div>
            <div> 
                <small class="text-danger"><?= form_error('password1')?></small>
            </div>
            <button type="submit" value="" class="btn mt-2">REGISTER</button>
        </form>
        <div class="text-center fs-6 mt-2">
            <div class="row justify-content-md-center">
                <div class="col-md-auto"><a href="<?= base_url('auth')?>">Back To Login Area</a></div>
                <div class="col-md-auto"><small>or</small></div>
                <div class="col-md-auto"><a href="<?= base_url('auth/forgotPassword')?>">Forgot Password</a></div>
            </div>    
        
        
        </div>
    </div>
</body>

</html>