<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Infinity Brew</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?= base_url('templateLogin') ?>/fonts/material-icon/css/material-design-iconic-font.min.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="<?= base_url('templateLogin') ?>/css/style.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body>
    <?php $gagal = session()->getFlashdata('gagal');
    if (!empty($gagal)) { ?>
        <div class="swalDefaultError"></div>
    <?php } ?>
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure>
                            <img src="<?= base_url('templateLogin') ?>/images/login.svg" alt="sing up image" />
                        </figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Masuk</h2>

                        <?= form_open('Login/cekLogin') ?>
                        <div class="form-group">
                            <label for=""><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" placeholder="Email" class="form-control" autofocus required />
                        </div>
                        <div class="form-group">
                            <label for=""><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" placeholder="Password" class="form-control" required />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" class="form-submit" value="Masuk" />
                        </div>
                        <?= form_close() ?>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS Login -->
    <script href="<?= base_url('templateLogin') ?>/vendor/jquery/jquery.min.js"></script>
    <script href="<?= base_url('templateLogin') ?>/js/main.js"></script>


    <!-- jQuery AdminLTE -->
    <script src="<?= base_url('template') ?>/plugins/jquery/jquery.min.js">
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('template') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <!--AdminLTE App -->
    <script src="<?= base_url('template') ?>/dist/js/adminlte.min.js">
    </script>
    <!-- SweetAlert -->
    <script src="<?= base_url('template') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top',
                width: '400px',
                padding: '10px 20px 15px',
                showConfirmButton: false,
                timer: 5000
            });

            $('.swalDefaultSuccess').show(function() {
                Toast.fire({
                    icon: 'success',
                    title: '<?= (session()->getFlashdata('pesan')) ?>'
                })
            });

            $('.swalDefaultError').show(function() {
                Toast.fire({
                    icon: 'error',
                    title: '<?= (session()->getFlashdata('gagal')) ?>'
                })
            });

        });
    </script>
    <script src="<?= base_url('template') ?>/plugins/sweetalert2/myscript.js"></script>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>