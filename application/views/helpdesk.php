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
    <style>
        /* START TOOLTIP STYLES */
        [tooltip] {
            position: relative;
            /* opinion 1 */
        }


        /* Applies to all tooltips */
        [tooltip]::before,
        [tooltip]::after {
            text-transform: none;
            /* opinion 2 */
            font-size: .9em;
            /* opinion 3 */
            line-height: 1;
            user-select: none;
            pointer-events: none;
            position: absolute;
            display: none;
            opacity: 0;
        }

        [tooltip]::before {
            content: '';
            border: 5px solid transparent;
            /* opinion 4 */
            z-index: 1001;
            /* absurdity 1 */
        }

        [tooltip]::after {
            content: attr(tooltip);
            /* magic! */

            /* most of the rest of this is opinion */
            font-family: Helvetica, sans-serif;
            text-align: center;

            /* 
            Let the content set the size of the tooltips 
            but this will also keep them from being obnoxious
            */
            min-width: 3em;
            max-width: 21em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 1ch 1.5ch;
            border-radius: .3ch;
            box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
            background: #333;
            color: #fff;
            z-index: 1000;
            /* absurdity 2 */
        }

        /* Make the tooltips respond to hover */
        [tooltip]:hover::before,
        [tooltip]:hover::after {
            display: block;
        }

        /* don't show empty tooltips */
        [tooltip='']::before,
        [tooltip='']::after {
            display: none !important;
        }

        /* FLOW: DOWN */
        [tooltip][flow^="down"]::before {
            top: 100%;
            border-top-width: 0;
            border-bottom-color: #333;
        }

        [tooltip][flow^="down"]::after {
            top: calc(100% + 5px);
        }

        [tooltip][flow^="down"]::before,
        [tooltip][flow^="down"]::after {
            left: 50%;
            transform: translate(-50%, .5em);
        }

        /* KEYFRAMES */
        @keyframes tooltips-vert {
            to {
                opacity: .9;
                transform: translate(-50%, 0);
            }
        }

        @keyframes tooltips-horz {
            to {
                opacity: .9;
                transform: translate(0, -50%);
            }
        }

        /* FX All The Things */
        [tooltip]:not([flow]):hover::before,
        [tooltip]:not([flow]):hover::after,
        [tooltip][flow^="up"]:hover::before,
        [tooltip][flow^="up"]:hover::after,
        [tooltip][flow^="down"]:hover::before,
        [tooltip][flow^="down"]:hover::after {
            animation: tooltips-vert 300ms ease-out forwards;
        }
    </style>
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
                    <!-- <li class="nav-item">
                        <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="<?= base_url() ?>pages/dashboard.html">
                            <i class="fa fa-chart-pie opacity-6  me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="<?= base_url() ?>pages/profile.html">
                            <i class="fa fa-user opacity-6  me-1"></i>
                            Profile
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link me-2 font-weight-bolder" href="<?= base_url('Auth') ?>">
                            <i class="fas fa-key opacity-6  me-1"></i>
                            Sign In
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 font-weight-bolder" href="<?= base_url() ?>Welcome/tracking">
                            <i class="fas fa-search opacity-6  me-1"></i>
                            Tracking
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-lg-block d-none">
                    <li class="nav-item">
                        <a href="javascript:;" class="btn btn-sm mb-0 me-1 bg-gradient-light" data-bs-toggle="modal" data-bs-target="#versionLog">Version <?php $query = $this->db->query("SELECT * FROM tb_version_log WHERE status_version='UP'")->row();
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
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                        <p class="text-lead text-white">Describe your needs about ICT Helpdesk.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n30 mt-md-n11 mt-n30 justify-content-center">
                <div class="col-xl-8 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Choose your request form</h5>
                        </div>
                        <div class="row px-xl-5 px-sm-4 px-3">
                            <div class="col-3 ms-auto px-1">
                                <span tooltip="Troubleshooting" flow="down"><a class="btn btn-outline-light w-100 btn1" href="javascript:;" onclick="showForm1(this)">
                                        <img src="<?= base_url() ?>assets/img/icons8-tools-64.png" alt="" style="height:2em">
                                    </a></span>
                            </div>
                            <div class="col-3 px-1">
                                <span tooltip="Email Request" flow="down"><a class="btn btn-outline-light w-100 btn2" href="javascript:;" onclick="showForm2()">
                                        <img src="<?= base_url() ?>assets/img/icons8-envelope-64.png" alt="" style="height:2em">
                                    </a></span>
                            </div>
                            <div class="col-3 me-auto px-1">
                                <span tooltip="Asset Request" flow="down"><a class="btn btn-outline-light w-100 btn3" href="javascript:;" onclick="showForm3()">
                                        <img src="<?= base_url() ?>assets/img/icons8-ssd-64.png" alt="" style="height:2em">
                                    </a></span>
                            </div>
                            <div class="mt-2 position-relative text-center">
                                <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                    ___
                                </p>
                            </div>
                        </div>
                        <!-- Body Trouble Shooting -->
                        <div class="card-body" id="troubleshooting">
                            <p class="text-sm mt-3 mb-3 text-center">Fill up the <a href="javascript:;" class="text-dark font-weight-bolder">Trouble Shooting</a> form</p>
                            <form role="form" action="<?= site_url('Welcome/saveTicketTS') ?>" method="post" id="formTS">
                                <div class="mb-3">
                                    <!-- <input type="text" class="form-control" placeholder="Ticket" aria-label="Ticket" name="ticket-1" id="ticket-1" onkeydown="event.preventDefault()"> -->
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ticket" aria-label="Ticket" name="ticket" id="ticket-1" onkeydown="event.preventDefault()" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2">Ticket Number</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="exampleFormControlSelect1">Select Email</label> -->
                                    <select class="form-control emailTS" id="exampleFormControlSelect1" onchange="completeData()" name="email" required>
                                        <option value="" selected class="bg-secondary">Request From ...</option>
                                        <?php foreach ($row as $data) { ?>
                                            <option value="<?= $data['user_email'] ?>"><?= $data['user_email'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="SBU" aria-label="SBU" name="sbu" id="sbu" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Dept" aria-label="Dept" name="dept" id="dept" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="status" value="WAITING">
                                <input type="hidden" class="form-control" name="complain" value="TS">
                                <input type="hidden" class="form-control" name="user" id="user">
                                <div class="form-group">
                                    <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Information.." name="information" required maxlength="120"></textarea>
                                </div>
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="Yes" id="flexCheckDefault" name="checkbox">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the to send me<a href="javascript:;" class="text-dark font-weight-bolder"> Email notification</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2 ts-submit">Submit</button>
                                    <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2 ts-loading buttonload"> <i class="fa fa-spinner fa-spin"></i> Loading</button>
                                </div>
                                <cite>
                                    <p class="text-sm mt-3 mb-0">*To monitor the ticket, please <a href="<?= base_url('Auth') ?>" class="text-dark font-weight-bolder">Sign in</a></p>
                                </cite>
                            </form>
                        </div>
                        <!-- Body Email Request -->
                        <div class="card-body" id="emailrequest" style="display:none">
                            <p class="text-sm mt-3 mb-3 text-center">Fill up the <a href="javascript:;" class="text-dark font-weight-bolder">Email Request</a> form</p>
                            <form role="form" action="<?= site_url('Welcome/saveTicketER') ?>" method="post" id="emailrequestForm">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ticket" aria-label="Ticket" name="ticket" id="ticket-2" onkeydown="event.preventDefault()" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2">Ticket Number</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="exampleFormControlSelect1">Select Email</label> -->
                                    <select class="form-control emailER" id="exampleFormControlSelect1" onchange="completeData2()" name="email" required>
                                        <option value="" selected class="bg-secondary" selected disabled>Request From ...</option>
                                        <?php foreach ($row as $data) { ?>
                                            <option value="<?= $data['user_email'] ?>"><?= $data['user_email'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="SBU" aria-label="SBU" name="sbu" id="sbu2" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Dept" aria-label="Dept" name="dept" id="dept2" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="status" value="WAITING">
                                <input type="hidden" class="form-control" name="complain" value="ER">
                                <input type="hidden" class="form-control" name="user" id="user2">
                                <div class="col text-center mb-3">
                                    <cite>___ General Information __</cite>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" name="firstname" id="firstname" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" name="lastname" id="lastname">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Phone Number" aria-label="Phone Number" name="phone" id="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="SBU" aria-label="SBU" name="infosbu" id="infosbu">
                                        </div> -->
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1" name="infosbu" id="infosbu" required>
                                                <option value="" selected class="bg-secondary" disabled>SBU ...</option>
                                                <?php foreach ($rowsbu as $data) { ?>
                                                    <option value="<?= $data['nama_sbu'] ?>"><?= $data['nama_sbu'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1" name="infodept" id="infodept" required>
                                                <option value="" selected class="bg-secondary" disabled>Departement ...</option>
                                                <?php foreach ($rowdept as $data) { ?>
                                                    <option value="<?= $data['nama_dept'] ?>"><?= $data['nama_dept'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Position" aria-label="Position" name="position" id="position" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="Yes" id="flexCheckDefault" name="checkbox">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the to send me<a href="javascript:;" class="text-dark font-weight-bolder"> Email notification</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2 btnER">Submit</button>
                                    <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2 btnER-loading buttonload"> <i class="fa fa-spinner fa-spin"></i> Loading</button>
                                </div>
                                <cite>
                                    <p class="text-sm mt-3 mb-0">*To monitor the ticket, please <a href="<?= base_url('Auth') ?>" class="text-dark font-weight-bolder">Sign in</a></p>
                                </cite>
                            </form>
                        </div>
                        <!-- Body Asset Request -->
                        <div class="card-body" id="assetrequest" style="display:none">
                            <p class="text-sm mt-3 mb-3 text-center">Fill up the <a href="javascript:;" class="text-dark font-weight-bolder">Asset Request</a> form</p>
                            <form role="form" action="<?= site_url('Welcome/saveTicketAR') ?>" method="post" id="formAR">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Ticket" aria-label="Ticket" name="ticket" id="ticket-3" onkeydown="event.preventDefault()" aria-describedby="basic-addon2"> <span class="input-group-text" id="basic-addon2">Ticket Number</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="exampleFormControlSelect1">Select Email</label> -->
                                    <select class="form-control emailAR" id="exampleFormControlSelect1" onchange="completeData3()" name="email" required>
                                        <option value="" selected class="bg-secondary" selected disabled>Request From ...</option>
                                        <?php foreach ($row as $data) { ?>
                                            <option value="<?= $data['user_email'] ?>"><?= $data['user_email'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="SBU" aria-label="SBU" name="sbu" id="sbu3" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Dept" aria-label="Dept" name="dept" id="dept3" onkeydown="event.preventDefault()">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" name="status" value="WAITING">
                                <input type="hidden" class="form-control" name="complain" value="AR">
                                <input type="hidden" class="form-control" name="user" id="user3">
                                <div class="col text-center mb-3">
                                    <cite>___ General Information __</cite>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1" name="typeasset" id="typeasset" required>
                                                <option value="" selected class="bg-secondary" disabled>Type of Request ...</option>
                                                <option value="Laptop">Laptop</option>
                                                <option value="Printer">Printer</option>
                                                <option value="Scanner">Scanner</option>
                                                <option value="Monitor">Monitor</option>
                                                <option value="SparePart">Spare Part</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <input type="number" class="form-control" placeholder="QTY" aria-label="QTY" min="1" name="qty" id="qty" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <label for="exampleFormControlSelect1">Select Email</label> -->
                                            <select class="form-control" id="exampleFormControlSelect1" name="unittype" required>
                                                <option value="" selected class="bg-secondary" selected disabled>Type of units ...</option>
                                                <?php foreach ($rowgood as $data) { ?>
                                                    <option value="<?= $data['satuan_name'] ?>"><?= $data['satuan_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Additional Information.." name="addinformation" onkeydown="return /[a-zA-Z0-9 @]/i.test(event.key)" maxlength="120"></textarea>
                                </div>
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" value="Yes" id="flexCheckDefault" name="checkbox">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the to send me<a href="javascript:;" class="text-dark font-weight-bolder"> Email notification</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2 btnAR-submit">Submit</button>
                                    <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2 btnAR-loading buttonload"> <i class="fa fa-spinner fa-spin"></i> Loading</button>
                                </div>
                                <cite>
                                    <p class="text-sm mt-3 mb-0">*To monitor the ticket, please <a href="<?= base_url('Auth') ?>" class="text-dark font-weight-bolder">Sign in</a></p>
                                </cite>
                            </form>
                        </div>
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
                    <!--<a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Version 2.01
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        About Us
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Team
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Products
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Blog
                    </a>
                    <a href="javascript:;" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                        Pricing
                    </a> -->
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
                        <?php foreach ($rowversion as $dtversion) { ?>
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
        function showForm1() {
            $("#troubleshooting").show();
            $("#emailrequest").hide();
            $("#assetrequest").hide();
        }

        function showForm2() {
            $("#troubleshooting").hide();
            $("#emailrequest").show();
            $("#assetrequest").hide();

            var lbl = "ICT-ER";
            var where = "ER";
            var tgl = new Date();
            var tahun = tgl.getFullYear();
            var bulan = tgl.getMonth() + 1;
            var periode = bulan + "/" + tahun;
            // console.log(bulan);

            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getTicket',
                method: 'POST',
                data: {
                    lbl: lbl,
                    periode: periode,
                    where: where
                },
                success: function(data) {
                    $("#ticket-2").val(data);
                }
            })
        }

        function showForm3() {
            $("#troubleshooting").hide();
            $("#emailrequest").hide();
            $("#assetrequest").show();

            var lbl = "ICT-AR";
            var where = "AR";
            var tgl = new Date();
            var tahun = tgl.getFullYear();
            var bulan = tgl.getMonth() + 1;
            var periode = bulan + "/" + tahun;

            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getTicket',
                method: 'POST',
                data: {
                    lbl: lbl,
                    periode: periode,
                    where: where
                },
                success: function(data) {
                    $("#ticket-3").val(data);
                }
            })
        }

        // GEnerate no ticket
        // Trouble Shooting
        function generateNo1() {
            var lbl = "ICT-TS";
            var where = "TS";
            var tgl = new Date();
            var tahun = tgl.getFullYear();
            var bulan = tgl.getMonth() + 1;
            var periode = bulan + "/" + tahun;
            // console.log(lbl + "/" + bulan + "/" + tahun);

            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getTicket',
                method: 'POST',
                data: {
                    lbl: lbl,
                    periode: periode,
                    where: where
                },
                success: function(data) {
                    $("#ticket-1").val(data);
                }
            })
        }

        window.onload = generateNo1;


        // Completing Data User
        function completeData() {
            var email = $(".emailTS").find(":selected").val();

            $(".emailTS").removeClass("is-invalid");
            // console.log(email);
            $(".emailTS").addClass("is-valid");
            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getUser',
                method: 'post',
                data: {
                    email: email
                },
                dataType: 'json',
                success: function(response) {
                    var leng = response.length;
                    if (leng > 0) {
                        var sbu = response[0].nama_sbu;
                        var dept = response[0].kode_dept;
                        var user = response[0].user_name;

                        // console.log(user);
                        $("#sbu").val(sbu);
                        $("#dept").val(dept);
                        $("#user").val(user);
                        var isisbu = $("#sbu").val();
                        var isidept = $("#dept").val();
                        if (isisbu == "") {
                            $("#sbu").addClass('is-invalid');
                            $("#sbu").removeClass('is-valid');
                        } else {
                            $("#sbu").addClass('is-valid');
                            $("#sbu").removeClass('is-invalid');
                        };
                        if (isidept == "") {
                            $("#dept").addClass('is-invalid');
                            $("#dept").removeClass('is-valid');
                        } else {
                            $("#dept").addClass('is-valid');
                            $("#dept").removeClass('is-invalid');
                        };

                    }
                }
            })
        }

        // Completing Data User Email Request
        function completeData2() {
            var email = $(".emailER").find(":selected").val();
            // console.log(email);
            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getUser',
                method: 'post',
                data: {
                    email: email
                },
                dataType: 'json',
                success: function(response) {
                    var leng = response.length;
                    if (leng > 0) {
                        var sbu = response[0].nama_sbu;
                        var dept = response[0].kode_dept;
                        var user = response[0].user_name;
                        var usrdept = response[0].user_dept;

                        if (usrdept != "DEPT010") {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops !',
                                text: 'Only For HR !',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('.emailER').addClass('is-invalid');
                            $('.btnER').attr('disabled', true);
                        } else {
                            $('.emailER').removeClass('is-invalid');
                            $('.btnER').attr('disabled', false);
                        }

                        // console.log(user);
                        $("#sbu2").val(sbu);
                        $("#dept2").val(dept);
                        $("#user2").val(user);
                        var isisbu = $("#sbu2").val();
                        var isidept = $("#dept2").val();
                        if (isisbu == "") {
                            $("#sbu2").addClass('is-invalid');
                            $("#sbu2").removeClass('is-valid');
                        } else {
                            $("#sbu2").addClass('is-valid');
                            $("#sbu2").removeClass('is-invalid');
                        };
                        if (isidept == "") {
                            $("#dept2").addClass('is-invalid');
                            $("#dept2").removeClass('is-valid');
                        } else {
                            $("#dept2").addClass('is-valid');
                            $("#dept2").removeClass('is-invalid');
                        };

                    }
                }
            })
        }


        // Completing Data User ASSET Request
        function completeData3() {
            var email = $(".emailAR").find(":selected").val();
            // console.log(email);
            $.ajax({
                url: '<?= base_url() ?>index.php/Welcome/getUser',
                method: 'post',
                data: {
                    email: email
                },
                dataType: 'json',
                success: function(response) {
                    var leng = response.length;
                    if (leng > 0) {
                        var sbu = response[0].nama_sbu;
                        var dept = response[0].nama_dept;
                        var user = response[0].user_name;

                        // console.log(user);
                        $("#sbu3").val(sbu);
                        $("#dept3").val(dept);
                        $("#user3").val(user);
                        var isisbu = $("#sbu3").val();
                        var isidept = $("#dept3").val();
                        if (isisbu == "") {
                            $("#sbu3").addClass('is-invalid');
                            $("#sbu3").removeClass('is-valid');
                        } else {
                            $("#sbu3").addClass('is-valid');
                            $("#sbu3").removeClass('is-invalid');
                        };
                        if (isidept == "") {
                            $("#dept3").addClass('is-invalid');
                            $("#dept3").removeClass('is-valid');
                        } else {
                            $("#dept3").addClass('is-valid');
                            $("#dept3").removeClass('is-invalid');
                        };

                    }
                }
            })
        }


        // Phone
        $(document).ready(function() {
            $("#phone").inputmask('(+62)-9999-9999-999');
            var email = $(".emailTS").val();
            // TOmbol Loading Trouble shooting Hide
            $(".ts-loading").hide();
            $(".ts-submit").show();

            // Form Trouble Shooting on submit
            $("#formTS").on("submit", function() {
                if (email == "0") {
                    $(".emailTS").addClass("is-invalid");
                    return false;
                } else {
                    $(".emailTS").removeClass("is-invalid");
                    $(".emailTS").addClass("is-valid");
                    $(".ts-loading").show();
                    $(".ts-submit").hide();
                }
            });

            // Tombol Loading Email Req Hide
            $(".btnER-loading").hide();
            $(".btnER").show();

            // Form Email Request on Submit
            $("#emailrequestForm").on("submit", function() {
                $(".btnER-loading").show();
                $(".btnER").hide();
            });

            // Tombol Loading Aset Request Hide
            $(".btnAR-submit").show();
            $(".btnAR-loading").hide();

            // Form Aset Request on Submit
            $("#formAR").on("submit", function() {
                $(".btnAR-submit").hide();
                $(".btnAR-loading").show();

            });
        })
    </script>
</body>

</html>