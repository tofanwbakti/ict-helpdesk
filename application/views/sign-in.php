<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>argon/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>argon/assets/img/favicon.png">
    <!-- SweetAlert2 -->
    <link href="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.css" rel="stylesheet">
    <title>
        <?= $title ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>argon/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>argon/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>argon/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>argon/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- Recaptcha -->
    <?= $script_captcha; ?>
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
                            ICT Helpdesk
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= site_url('Welcome') ?>">
                                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                        Input Helpdesk
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link me-2" href="../pages/profile.html">
                                        <i class="fa fa-user opacity-6 text-dark me-1"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="../pages/sign-up.html">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Sign Up
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="<?= site_url('Welcome/tracking') ?>">
                                        <i class="fas fa-search opacity-6  me-1"></i>
                                        Tracking
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block d-none">
                                <li class="nav-item">
                                    <!-- <a href="javascript:;" class="btn btn-sm mb-0 me-1 btn-primary">Version 2.02</a> -->
                                    <a href="javascript:;" class="btn btn-sm mb-0 me-1 btn-primary" data-bs-toggle="modal" data-bs-target="#versionLog">Version <?php $query = $this->db->query("SELECT * FROM tb_version_log WHERE status_version='UP'")->row();
                                                                                                                                                                echo $query->no_version; ?></a>
                                    <!-- Version 2.01 -->
                                    <!-- Ganti Seluruh tampilan dan proses -->
                                    <!-- Version 2.02 -->
                                    <!-- Tambah menu Print Report di masing-masing halaman layanan -->
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your valid information to sign in</p>
                                </div>
                                <div class="card-body" id="bodySignIn">
                                    <form role="form" action="<?= site_url('Auth/proceed') ?>" method="post">
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" id="email" onblur="checkEmail();">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="Password">
                                        </div>
                                        <div class="mb-3">
                                            <?= $captcha ?>
                                        </div>
                                        <!-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div> -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" name="login">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        ICT Bias Mandiri Group
                                        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">© 2023</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Version Log -->
    <div class="modal fade" id="versionLog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Version Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <?php
                        $this->db->select('*');
                        $this->db->order_by('tb_version_log.seq_no', "ASC");
                        $rowversion = $this->db->get('tb_version_log')->result_array();
                        foreach ($rowversion as $dtversion) { ?>
                            <dt class="col-sm-3">Version <?= $dtversion['no_version'] ?></dt>
                            <?php
                            echo "<dd class='col-sm-9'>";
                            $detail = $this->db->query("SELECT * FROM tb_version_log_detail WHERE no_version='" . $dtversion['no_version'] . "'")->result_array();
                            foreach ($detail as $valversion) {
                                echo "<p>" . $valversion['activity_version'] . "</p>";
                            }
                            echo "</dd>";
                            ?>
                        <?php } ?>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn bg-gradient-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>argon/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>argon/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>argon/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>argon/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>argon/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <!-- Sweet Alert2 -->
    <script src="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.js" type="text/javascript"></script>
    <!-- Jquery -->
    <script src="<?php echo base_url() ?>assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script>
        function checkEmail() {
            jQuery.ajax({
                url: "<?= base_url(); ?>Auth/checkDbEmail",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    if (data == "0") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops !',
                            text: 'Email unknown !',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                },
                error: function() {}
            });
        }
    </script>
</body>

</html>