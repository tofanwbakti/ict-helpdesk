<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.png">
    <title>
        <?= $title ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->
    <script src="<?= base_url() ?>assets/js/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- Data Tables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.dataTables.min.css">
    <!-- SweetAlert2 -->
    <link href="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Multi Select -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- My Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/mycss.css">

    <style>
        tfoot input {
            width: 100%;
            padding: 1px;
            box-sizing: border-box;
            text-indent: 10px;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- <div class="min-height-300 bg-primary position-absolute w-100"></div> -->
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" <?= site_url('Dashboard') ?>" target="_blank">
                <img src="<?= base_url() ?>assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">ICT HelpDesk</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('Dashboard') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('Troubleshoot') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Trouble Shooting</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('EmailReq') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Email Request</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('AssetReq') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Asset Request</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('Dashboard/profile') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('Dashboard/changePassword') ?>">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Change Password</span>
                    </a>
                </li>
                <?php if (($this->fungsi->user_login()->level == "DEVELOPER") || ($this->fungsi->user_login()->level == "ADMIN")) { ?>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master Data</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= site_url('MasterData/dataUser') ?>">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <!-- <i class="ni ni-single-02 text-danger text-sm opacity-10"></i> -->
                                <i class="fas fa-user-cog text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Data User</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-plain shadow-none" id="sidenavCard">
                <img class="w-50 mx-auto" src="<?= base_url() ?>assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
                <div class="card-body text-center p-3 w-100 pt-0">
                    <div class="docs-info">
                        <h6 class="mb-0">Need help?</h6>
                        <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
                    </div>
                </div>
            </div>
            <a href="<?= base_url('assets/BUKU PETUNJUK PENGGUNAAN APLIKASI ICT HELPDESK.pdf') ?>" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
            <!-- <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> -->
            <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                    document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i>
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">ICT Team</a>

            </div>
        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg  max-height-vh-100 h-100">
        <?= $contents ?>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Configuration</h5>
                    <p>Create your own comfortable .</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto dark" type="checkbox" id="dark-version" name="dark-version" onclick="darkMode(this)">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>
    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <!-- Sweet Alert2 -->
    <script src="<?php echo base_url() ?>assets/sweetalert2-10.15.6/package/dist/sweetalert2.min.js" type="text/javascript"></script>
    <!-- multi Select -->
    <!-- Include Choices JavaScript (latest) -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Or versioned -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
    <script src="<?= base_url() ?>assets/js/myscript.js"></script>



    <script>
        new DataTable('#example', {
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        let column = this;
                        let title = column.footer().textContent;

                        // Create input element
                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.footer().replaceChildren(input);

                        // Event listener for user input
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
            }
        });

        var mins = 15 * 60; //second 
        var active = setTimeout("logout()", (mins * 1000)); //active minutes
        function logout() {
            location = '<?= base_url(); ?>Dashboard/signout'; // <-- put your controller function here to destroy the session object and redirect the user to the login page.
        }

        // MultiSelect
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
        });

        // Theme switch Dark || Light
    </script>

    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
        // Data variable
        <?php
        $tahun = gmdate("Y", time() + 60 * 60 * 7);
        // GLOBAL
        $this->db->like('update_tgl', $tahun . "-01");
        $this->db->from('tb_helpdesk');
        $data1 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-02");
        $this->db->from('tb_helpdesk');
        $data2 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-03");
        $this->db->from('tb_helpdesk');
        $data3 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-04");
        $this->db->from('tb_helpdesk');
        $data4 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-05");
        $this->db->from('tb_helpdesk');
        $data5 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-06");
        $this->db->from('tb_helpdesk');
        $data6 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-07");
        $this->db->from('tb_helpdesk');
        $data7 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-08");
        $this->db->from('tb_helpdesk');
        $data8 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-09");
        $this->db->from('tb_helpdesk');
        $data9 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-10");
        $this->db->from('tb_helpdesk');
        $data10 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-11");
        $this->db->from('tb_helpdesk');
        $data11 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-12");
        $this->db->from('tb_helpdesk');
        $data12 = $this->db->count_all_results();

        // DATA CHART TROUBLE SHOOTING
        $this->db->like('update_tgl', $tahun . "-01");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS1 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-02");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS2 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-03");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS3 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-04");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS4 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-05");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS5 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-06");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS6 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-07");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS7 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-08");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS8 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-09");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS9 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-10");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS10 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-11");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS11 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-12");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "TS");
        $dataTS12 = $this->db->count_all_results();

        // DATA CHART ASSET REQUEST
        $this->db->like('update_tgl', $tahun . "-01");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR1 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-02");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR2 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-03");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR3 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-04");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR4 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-05");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR5 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-06");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR6 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-07");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR7 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-08");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR8 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-09");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR9 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-10");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR10 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-11");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR11 = $this->db->count_all_results();

        $this->db->like('update_tgl', $tahun . "-12");
        $this->db->from('tb_helpdesk');
        $this->db->where('jenis_komplain', "AR");
        $dataAR12 = $this->db->count_all_results();
        ?>
        // End data Variable
        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Total",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [<?= $data1 ?>, <?= $data2 ?>, <?= $data3 ?>, <?= $data4 ?>, <?= $data5 ?>, <?= $data6 ?>, <?= $data7 ?>, <?= $data8 ?>, <?= $data9 ?>, <?= $data10 ?>, <?= $data11 ?>, <?= $data12 ?>],
                        maxBarThickness: 6
                    },
                    {
                        label: "Troubleshoot", //TROUBLE SHOOTING
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#d92926",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [<?= $dataTS1 ?>, <?= $dataTS2 ?>, <?= $dataTS3 ?>, <?= $dataTS4 ?>, <?= $dataTS5 ?>, <?= $dataTS6 ?>, <?= $dataTS7 ?>, <?= $dataTS8 ?>, <?= $dataTS9 ?>, <?= $dataTS10 ?>, <?= $dataTS11 ?>, <?= $dataTS12 ?>],
                        maxBarThickness: 6
                    },
                    {
                        label: "Asset Reqs.", //ASSET REQUEST
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#ff8d00",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [<?= $dataAR1 ?>, <?= $dataAR2 ?>, <?= $dataAR3 ?>, <?= $dataAR4 ?>, <?= $dataAR5 ?>, <?= $dataAR6 ?>, <?= $dataAR7 ?>, <?= $dataAR8 ?>, <?= $dataAR9 ?>, <?= $dataAR10 ?>, <?= $dataAR11 ?>, <?= $dataAR12 ?>],
                        maxBarThickness: 6

                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        $(function() {
            var url = window.location;
            // for single sidebar menu
            $('ul.navbar-nav a').filter(function() {
                return this.href == url;
            }).addClass('active');
        });

        $(".track").hover(function() {
            $(this).addClass('text-info');
        }).mouseleave(function() {
            $(this).removeClass('text-info');
        });
        $(".fa-tools").hover(function() {
            $(this).addClass('fa-spin');
            $(this).addClass('text-danger');
        }).mouseleave(function() {
            $(this).removeClass('text-danger');
            $(this).removeClass('fa-spin');
        });
    </script>
    <!-- Github buttons -->
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
    <script async defer src="<?= base_url() ?>assets/js/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url() ?>assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>