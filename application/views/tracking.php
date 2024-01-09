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
                        <a href="javascript:;" class="btn btn-sm mb-0 me-1 bg-gradient-light" data-bs-toggle="modal" data-bs-target="#versionLog">Version
                            <?php $query = $this->db->query("SELECT * FROM tb_version_log WHERE status_version='UP'")->row();
                            echo $query->no_version; ?></a>
                        <!-- <a href="javascript:;" class="btn btn-sm mb-0 me-1 bg-gradient-light">Version 2.02</a> -->
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
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mb-3">
                        <div class="card-header text-center pt-4">
                            <h5>Tracking your ticket</h5>
                            <!-- <form action="" method="post"> -->
                            <div class="col-12 ms-auto px-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Ticket" aria-label="Ticket" name="ticket" id="ticket" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2">Ticket Number</span>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <!-- Body Trouble Shooting -->
                        <div class="card-body " id="trackingBody">
                            <!-- <div class="container"> -->
                            <ul class="timeline">

                                <!-- <li>
                                    <div class="timeline-time">
                                        <span class="date">today</span>
                                        <span class="time">04:20</span>
                                    </div>


                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>


                                    <div class="timeline-body">
                                        <div class="timeline-header">
                                            <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt></span>
                                            <span class="username"><a href="javascript:;">John Smith</a> <small></small></span>
                                        </div>
                                        <div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                                                Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
                                            </p>
                                        </div>
                                        <div class="timeline-likes">
                                            <div class="stats-right">
                                                <span class="stats-text">259 Shares</span>
                                                <span class="stats-text">21 Comments</span>
                                            </div>
                                        </div>
                                    </div>

                                </li> -->
                            </ul>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mx-auto text-center">
                </div>
                <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
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

    <div class="modal" id="modal-loading" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="loading-spinner mb-2"></div>
                    <div>Loading</div>
                </div>
            </div>
        </div>
    </div>


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
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
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
    <script src="<?= base_url() ?>assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Sweet Alert2 -->
    <script src="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.js" type="text/javascript"></script>
    <!-- Input Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?= base_url() ?>assets/js/myscript.js"></script>
    <script>
        $("#ticket").keypress(function(e) {
            var key = e.which;
            var ticket = $("#ticket").val();
            if (key == 13) {
                // console.log(ticket);
                jQuery.ajax({
                    url: "<?= base_url(); ?>Welcome/checkDbTicket",
                    data: 'noticket=' + $("#ticket").val(),
                    type: "POST",
                    success: function(data) {
                        if (data == "0") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops !',
                                text: 'Ticket unknown !',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            $(".timeline").html(data);
                            // console.log(data);
                            // var dataItems = "";
                            // $.each(response, function(index, item) {
                            //     dataItems += index + ";" + item + "\n";
                            //     console.log(dataItems);
                            // })                            
                        }

                    },
                    error: function() {}
                });
            }
        })

        $("#ticket").focusout(function(e) {

            var ticket = $("#ticket").val();

            // console.log(ticket);

        })
    </script>
</body>

</html>