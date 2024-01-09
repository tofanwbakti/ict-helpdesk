<div class="flashOkLogin" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control caritix" id="caritix" name="caritix" placeholder="Search Ticket...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <img src="<?= base_url() . "assets/avatar/" . $this->fungsi->user_login()->avatar; ?>" class="avatar avatar-sm me-3">
                        <span class="d-sm-inline d-none"><?= $this->fungsi->user_login()->user_name; ?></span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <!-- <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> -->
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="<?= site_url('Dashboard/signout') ?>" class="nav-link text-white p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Sign Out">
                        <i class="fa fa-sign-out cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= gmdate("F", time() + 60 * 60 * 7) ?> Tix</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    // $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $lastmonth);
                                    // $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-primary text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> tickets last month";
                                    ?>
                                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    since yesterday -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="All Ticket">
                                <i class="fas fa-ticket-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Troubleshoot</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $lastmonth);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-danger text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> tickets last month";
                                    ?>
                                    <!-- <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    since last week -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Trouble Shooting">
                                <i class="fas fa-tools text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Email Reqs.</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'ER');
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $lastmonth);
                                    $this->db->where('jenis_komplain', 'ER');
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-success text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> tickets last month";
                                    ?>
                                    <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    since last quarter -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email Request">
                                <i class="fas fa-envelope-open-text text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Asset Reqs.</p>
                                <h5 class="font-weight-bolder">
                                    <?php

                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'AR');
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $lastmonth);
                                    $this->db->where('jenis_komplain', 'AR');
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-warning text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> tickets last month";
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-hdd text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Ticket overview</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <!-- <span class="font-weight-bold">4% more</span> in 2021 -->
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active" style="background-image: url('<?= base_url() ?>assets/img/carousel-1.jpg');background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                </div>
                                <p>“Live as if you were to die tomorrow. Learn as if you were to live forever.” </p>
                                <h5 class="text-white mb-1">Mahatma Gandhi</h5>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('<?= base_url() ?>assets/img/carousel-2.jpg');background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                </div>
                                <p>“Wisdom is not a product of schooling but of the lifelong attempt to acquire it.”</p>
                                <h5 class="text-white mb-1">Albert Einstein</h5>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('<?= base_url() ?>assets/img/carousel-3.jpg');background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-trophy text-dark opacity-10"></i>
                                </div>
                                <p>"The most complete gift of God is a life base on knowledge."</p>
                                <h5 class="text-white mb-1">Ali ibn Abu Tholib</h5>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2"><?= gmdate("F", time() + 60 * 60 * 7) ?>'s Ticket List</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Request By</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Info</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ticket No.</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                <th class="text-secondary opacity-7"><i class="fas fa-history"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($row as $data) {
                                if ($data['status'] == "WAITING") {
                                    $step = "<span class='badge bg-gradient-danger'>TO START</span>";
                                } else if ($data['status'] == "PROCESSING") {
                                    $step = "<span class='badge bg-gradient-warning'>IN PROGRESS</span>";
                                } else if ($data['status'] == "FINISH") {
                                    $step = "<span class='badge bg-gradient-success'>COMPLETED</span>";
                                } ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-xs"><?= $no++ ?></h6>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="<?= base_url('assets/avatar/') . $data['avatar'] ?>" class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?= $data['nama'] ?></h6>
                                                <p class="text-xs text-secondary mb-0"><?= $data['email'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $data['user_sbu'] ?></p>
                                        <p class="text-xs text-secondary mb-0"><?= $data['kode_dept'] ?></p>
                                    </td>
                                    <td class="text-sm">
                                        <!-- <h6 class="mb-0 text-xs"></h6> -->
                                        <h6 class="text-xs font-weight-bold mb-0"><?= $data['no_ticket'] ?></h6>
                                        <p class="text-xs text-secondary mb-0"><?= $data['jenis_komplain'] . " - " . $step; ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= date("d-M-Y", strtotime($data['update_tgl'])) ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <!-- <a href="javascript:;" class="text-secondary font-weight-bold text-xs track" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Track">
                                            <i class="fas fa-eye"></i>
                                        </a> -->
                                        <a href="<?= $data['no_ticket'] ?>" class="text-secondary font-weight-bold text-xs track" data-bs-toggle="modal" data-bs-target="#exampleModalLong" data-ticket="<?= $data['no_ticket'] ?>">
                                            <i class="fas fa-eye" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Track"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-xs">No</th>
                                <th class="text-xs">Request By</th>
                                <th class="text-xs">User Info</th>
                                <th class="text-xs">Ticket No.</th>
                                <th class="text-xs">Date</th>
                                <th class="text-xs"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!--  -->
    <!-- <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> -->
</div>


<!-- Modal Tracking -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"><i class="fas fa-history"></i> Ticket History </h3>
                    </div>
                </div>
                <div class="card-body pb-3 m-3" id="bodyAksi">
                    <ul class="timeline">
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn bg-gradient-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $("#caritix").keypress(function(e) {
        var key = e.which;
        var ticket = $("#caritix").val();
        if (key == 13) {
            // console.log(ticket);

            jQuery.ajax({
                url: "<?= base_url(); ?>Dashboard/cariTicket",
                data: 'noticket=' + $("#caritix").val(),
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
                        return false;
                    } else {
                        // $(".timeline").html(data);
                        var linkz = "<?= base_url('Dashboard/searchTicket/') ?>" + ticket;
                        // console.log(linkz);
                        window.location.href = linkz;
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

    // Track Button
    $(document).on("click", ".track", function() {
        var tix = $(this).data('ticket');

        // console.log("TRACK");

        jQuery.ajax({
            url: "<?= base_url(); ?>Dashboard/checkDbTicket",
            data: 'noticket=' + tix,
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
    })
</script>