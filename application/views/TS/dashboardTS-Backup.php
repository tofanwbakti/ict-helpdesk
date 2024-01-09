<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Trouble Shooting</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Trouble Shooting</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search Ticket...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <img src="<?= base_url() . "/assets/avatar/" . $this->fungsi->user_login()->avatar; ?>" class="avatar avatar-sm me-3">
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
                    <a href="<?= site_url('Troubleshoot/signout') ?>" class="nav-link text-white p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Sign Out">
                        <i class="fa fa-sign-out cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
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
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    // $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $today);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-primary text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> today's tickets";
                                    ?>
                                    <!-- <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    since yesterday -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">To Start</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status', "WAITING");
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    // $lastmonth = date("Y-m", strtotime("-1 month", strtotime($today)));
                                    $this->db->like('update_tgl', $today);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status', "WAITING");
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-danger text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> today's ticket";
                                    ?>
                                    <!-- <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    since last week -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">In Progress</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status!=', "WAITING");
                                    $this->db->where('status!=', "FINISH");
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $today);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status!=', "WAITING");
                                    $this->db->where('status!=', "FINISH");
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-success text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> today's tickets";
                                    ?>
                                    <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    since last quarter -->
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-success text-center rounded-circle">
                                <i class="fas fa-ticket-alt text-lg opacity-10" aria-hidden="true"></i>
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Completed</p>
                                <h5 class="font-weight-bolder">
                                    <?php

                                    $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $tahun);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status', "FINISH");
                                    $this->db->from('tb_helpdesk');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $today = gmdate("Y-m-d", time() + 60 * 60 * 7);
                                    $this->db->like('update_tgl', $today);
                                    $this->db->where('jenis_komplain', 'TS');
                                    $this->db->where('status', "FINISH");
                                    $this->db->from('tb_helpdesk');
                                    echo "<span class='text-warning text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> today's tickets";
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-warning text-center rounded-circle">
                                <i class="fas fa-ticket-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
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
                        <button class="btn btn-primary ms-auto btn-custom proposeBA" data-bs-toggle="modal" data-bs-target="#proposeBA">
                            <span class="btn-icon"><i class="fas fa-file-signature"></i></span>
                            <span class="btn-text ms-1"> Propose Berita Acara</span>
                        </button>
                        <button class="btn btn-dark ms-1  btn-custom">
                            <span class="btn-icon"><i class="fas fa-calendar-alt"></i></span>
                            <span class="btn-text ms-1"> Search..</span>
                        </button>
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
                                <th class="text-center text-secondary opacity-7"><i class="fas fa-cog"></i></th>
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
                                }  ?>
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
                                        <p class="text-xs text-secondary mb-0"><?= $data['departemen'] ?></p>
                                    </td>
                                    <td class="text-sm">
                                        <!-- <h6 class="mb-0 text-xs"></h6> -->
                                        <h6 class="text-xs font-weight-bold mb-0"><?= $data['no_ticket'] ?></h6>
                                        <p class="text-xs text-secondary mb-0"><?= $data['jenis_komplain'] . " - " . $step; ?></p>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-secondary text-xs font-weight-bold"><?= date("d-M-Y", strtotime($data['update_tgl'])) ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs track" data-bs-toggle="modal" data-bs-target="#exampleModalLong" data-ticket="<?= $data['no_ticket'] ?>">
                                            <i class="fas fa-eye" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Track"></i>
                                        </a>
                                        <?php $alamat =  explode('/', $data['no_ticket']) ?>
                                        <a href="<?= site_url('ReportPdf/printTrack/') . encrypt_url($alamat[0]) . '/' . $alamat[1] . '/' . encrypt_url($alamat[2]) . '/' . $alamat[3] ?>" class="text-danger font-weight-bold text-xs track" data-ticket="<?= $data['no_ticket'] ?>" target="_blank" style="margin-left:5px">
                                            <i class="fas fa-print" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle text-center"> <?php if ($data['status'] != "FINISH") { ?>
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs task" data-bs-toggle="modal" data-bs-target="#updateTask" data-ticket="<?= $data['no_ticket'] ?>" data-email="<?= $data['email'] ?>" data-nama="<?= $data['nama'] ?>" data-info="<?= $data['informasi'] ?>" data-complain="<?= $data['jenis_komplain'] ?>">
                                                <i class="fas fa-tools" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Update Task"></i>
                                            </a>
                                        <?php }
                                                                            $this->db->where('no_ticket', $data['no_ticket']);
                                                                            $query = $this->db->get('tb_berita_acara')->result();
                                                                            foreach ($query as $value) {
                                                                                echo "<a href='" . site_url('BeritaAcara/formBA/' . $value->no_ba) . "' class='text-secondary font-weight-bold text-xs' style='margin-left:5px'><i class='fas fa-file-signature track' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Berita Acara'></i></a>";
                                                                            }
                                                                            // if ($query->num_rows() > 0) {
                                                                            //     echo "<a href='' class='text-secondary font-weight-bold text-xs' style='margin-left:5px' data-bs-toggle='modal' data-bs-target='#addItemBA'><i class='fas fa-file-signature'></i></a>";
                                                                            // }
                                        ?>
                                        <!-- <a href="" class="text-secondary font-weight-bold text-xs" style="margin-left:5px"><i class="fas fa-file-signature"></i></a> -->
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
                                <th class="text-xs"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-tools"></i> Need an Action ?</h3>
                        <p class="mb-0 tiket"></p>
                        <p class="mb-0 problem"></p>
                    </div>
                    <hr class="horizontal dark">
                    <form action="<?= site_url('Troubleshoot/updateTask') ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body pb-3" id="bodyAksi">
                            <input type="hidden" class="form-control" id="noticket" name="noticket">
                            <input type="hidden" class="form-control" id="email" name="email">
                            <input type="hidden" class="form-control" id="nama" name="nama">
                            <input type="hidden" class="form-control" id="jenis_complain" name="complain">
                            <div class="form-group">
                                <label for="recipient-status" class="col-form-label">Status Update :</label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control" id="recipient-status" name="status" onchange="buttonOn()">
                                    <option value="0" selected disabled> Pick one..</option>
                                    <option value="PROCESSING">IN PROGRESS</option>
                                    <option value="FINISH">COMPLETION</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Info / Message:</label>
                                <textarea class="form-control" id="message-text" name="info" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo-upload" class="col-form-label">Supporting Picture</label>
                                <input type="file" class="form-control" id="photo-upload" name="filePhoto">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0 submit" disabled>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

<!-- Modal Propose Berita Acara-->
<div class="modal fade" id="proposeBA" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-file-signature"></i> Propose Berita acara ?</h3>
                        <p class="mb-0 noBA"></p>
                    </div>
                    <hr class="horizontal dark">

                    <form action="<?= site_url('Troubleshoot/proposeBA') ?>" method="post" enctype="multipart/form-data" id="formBA">
                        <div class="card-body pb-3">
                            <input type="hidden" class="form-control" id="NoBa" name="NoBa" onkeydown="event.preventDefault()">
                            <!-- <div class="form-group">
                            </div> -->
                            <div id="form1">
                                <div class="form-group">
                                    <label for="recipient-status" class="col-form-label">Select Ticket Number</label>
                                    <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                    <select class="form-control" id="noticket-BA" name="noticket-BA" onchange="checkBA()">
                                        <option value="0" selected> Pick one..</option>
                                        <?php foreach ($rowtix as $dttix) {
                                            echo "<option value='" . $dttix['no_ticket'] . "'>" . $dttix['no_ticket'] . "</option>";
                                        } ?>
                                    </select>
                                </div>
                                <!-- <div class="field">
                                    <label class="col-form-label">Select Some Approver</label>
                                    <div class="control">
                                        <select class="form-control" name="approver[]" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple required>
                                            <?php //foreach ($rowuser as $dtuser) {
                                            //echo "<option value='" . $dtuser['user_email'] . "'>" . $dtuser['user_name'] . "</option>";
                                            //} 
                                            ?>

                                        </select>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Notes:</label>
                                    <textarea class="form-control" id="message-textBA" name="infoBA"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded mt-4 submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ITEM  Berita Acara-->
<div class="modal fade" id="addItemBA" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-file-signature"></i> Add Item Berita acara ?</h3>
                        <p class="mb-0 noBA"></p>
                    </div>
                    <hr class="horizontal dark">

                    <!-- <form action="<?= site_url('Troubleshoot/proposeBA') ?>" method="post" enctype="multipart/form-data" id="formBA"> -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Equipment Type</label>
                                    <input type="text" class="form-control" id="equipment-type" name="equipment">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Serial Number</label>
                                    <input type="text" class="form-control" id="serial" name="serial">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Condition</label>
                            <input type="text" class="form-control" id="condition" name="condition">
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Recommendation</label>
                            <input type="text" class="form-control" id="recomendation" name="recomendation">
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm">Save Item</button>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Equipment</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Condition</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Recommendation</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-xs">Spotify</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">$2,500</p>
                                        </td>
                                        <td>
                                            <span class="badge badge-dot me-4">
                                                <i class="bg-info"></i>
                                                <span class="text-dark text-xs">working</span>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-xs">60%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="dropdownMenuButton">
                                                <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    $(document).on("click", ".task", function() {
        var tix = $(this).data('ticket');
        var email = $(this).data('email');
        var nama = $(this).data('nama');
        var info = $(this).data('info');
        var complain = $(this).data('complain');

        $("#bodyAksi #noticket").val(tix);
        $("#bodyAksi #email").val(email);
        $("#bodyAksi #nama").val(nama);
        $("#bodyAksi #jenis_complain").val(complain);
        $(".problem").html('<p class="mb-0 problem">Problem : ' + info + '</p>');
        $(".tiket").html('<p class="mb-0 tiket">Updating progress of the ticket no. ' + tix + '</p>');

        $(".submit").attr('disabled', true);
        $("#recipient-status").val('');
        $("#message-text").val('');
        $("#photo-upload").val('');

        // console.log(tix, status);
    })

    function buttonOn() {
        var status = $("#recipient-status").val();
        if (status == "0") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'Status is not changes !',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $(".submit").attr('disabled', false);
        }
    };

    // Track Button
    $(document).on("click", ".track", function() {
        var tix = $(this).data('ticket');

        jQuery.ajax({
            url: "<?= base_url(); ?>Troubleshoot/checkDbTicket",
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

    // 
    $(document).on("click", ".proposeBA", function() {
        var period = (new Date).getFullYear() + '-' + (new Date).getMonth + 1;
        $.ajax({
            url: '<?= base_url() ?>index.php/Troubleshoot/getNoBeritaAcara',
            method: 'POST',
            data: {
                // lbl: lbl,
                period: period,
                // where: where
            },
            success: function(data) {
                $(".noBA").html('<p class="mb-0 tiket">Berita Acara No. ' + data + '</p>');
                $("#NoBa").val(data);
            }
        })
    })

    // Check BA
    function checkBA() {
        jQuery.ajax({
            url: "<?= base_url(); ?>TroubleShoot/checkBA",
            data: 'notix=' + $("#noticket-BA").val(),
            type: "POST",
            success: function(data) {
                if (data == 1) {
                    console.log(data);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops !',
                        text: 'Ticket is Used !',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            },
            error: function() {}
        });
    }
    // Validasi Form 
    $("#formBA").submit(function(e) {
        e.preventDefault();
        var tixBA = $("#noticket-BA").val();
        // var approver = $("#choices-multiple-remove-button").val();
        var message = $("#message-textBA").val();
        // console.log(tixBA, approver);

        if (tixBA == "0" || message == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'Complete your form !',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            this.submit();
        }
    })
</script>