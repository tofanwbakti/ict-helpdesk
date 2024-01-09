<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>argon/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>argon/assets/img/favicon.png">
    <title>
        <?= $title ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <link href="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- My Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/mycss.css">
    <?= $script_captcha; ?>

</head>

<body class="">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="<?= base_url() ?>pages/dashboard.html">
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
                        <a class="nav-link me-2" href="<?= base_url('Auth') ?>">
                            <i class="fas fa-key opacity-6  me-1"></i>
                            Sign In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="<?= base_url() ?>Welcome">
                            <i class="fas fa-ticket-alt opacity-6  me-1"></i>
                            New Ticket
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                    <li class="nav-item">
                        <a href="javascript:;" class="btn btn-sm mb-0 me-1 bg-gradient-light">Version 2.01</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <!-- <p class="text-lead text-white">Describe your needs about ICT Helpdesk.</p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-lg-n30 mt-md-n11 mt-n30 justify-content-center">
                <div class="col-xl-6 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mb-3">
                        <div class="card-header text-center pt-4">
                            <h5 class="mb-3">Approval Process</h5>
                            <hr class="horizontal dark">
                            <p class="text-sm mt-3 mb-5 text-center">Please complete the user data</p>
                            <!-- <form action="<?= site_url('Welcome/saveApv') ?>" method="post"> -->
                            <div class="col-12 ms-auto px-1 mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="noba" id="noba" aria-describedby="basic-addon2" value=<?= $noba ?> onkeydown="event.preventDefault()"> <span class="input-group-text" id="basic-addon2">BA Number</span>
                                </div>
                            </div>
                            <div class="col-12 ms-auto px-1 mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type.." aria-label="Type.." name="email" id="email" aria-describedby="basic-addon2" onblur="checkApv()"> <span class="input-group-text" id="basic-addon2">Email</span>
                                </div>
                            </div>
                            <div class="col-12 ms-auto px-1 mb-3">
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Type.." aria-label="Code" name="code" id="code" aria-describedby="basic-addon2" onchange="checkCode()"> <span class="input-group-text" id="basic-addon2">Verification Code</span>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                
                            </div> -->
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded mt-4 submit" disabled>Submit</button>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-8 mb-4 mx-auto text-center"> -->
            </div>
            <div class="col-lg-8 mx-auto text-center mb-4">
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-dribbble"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-twitter"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-instagram"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-pinterest"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-github"></span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script> Dev by Creative ICT Team.
                </p>
            </div>
        </div>
        </div>
    </footer>

    <!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" type="text/javascript"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <!-- Sweet Alert2 -->
    <script src="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("#email").val("");
            $("#code").val("");

        })

        function checkApv() {
            var noba = $("#noba").val();
            var email = $("#email").val();
            // console.log(noba);

            $.ajax({
                url: "<?= base_url('index.php/Welcome/checkApv') ?>",
                method: "POST",
                data: {
                    email: email,
                    noba: noba
                },
                success: function(data) {
                    if (data == "ada") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops !',
                            text: 'Berita Acara has been approved !',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        // console.log(data);
                        $("#code").attr("disabled", true);
                    } else {
                        $("#code").attr("disabled", false);
                        // console.log(data);
                    }
                }
            })
        }

        function checkCode() {
            var email = $("#email").val();
            var code = $("#code").val();
            $.ajax({
                url: "<?= base_url('index.php/Welcome/checkCode') ?>",
                method: "POST",
                data: {
                    email: email,
                    code: code
                },
                success: function(data) {
                    if (data == "ada") {
                        // console.log(data);

                        $(".submit").attr("disabled", false);
                    } else {

                        $(".submit").attr("disabled", true);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops !',
                            text: 'The data is invalid !',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            })
        }

        $(document).on("click", ".submit", function() {
            var noba = $("#noba").val();
            var email = $("#email").val();
            var code = $("#code").val();
            $.ajax({
                url: "<?= base_url('index.php/Welcome/saveApv') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    email: email,
                    code: code,
                    noba: noba,
                },
                success: function(data) {}

            })
            Swal.fire(
                'Good job!',
                'Activity completed !',
                'success'
            );
            $("#email").val("");
            $("#code").val("");
            $(".submit").attr("disabled", true);
            // return false();
        })
    </script>
</body>

</html>