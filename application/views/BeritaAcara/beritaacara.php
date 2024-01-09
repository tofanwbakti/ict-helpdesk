<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Berita Acara</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Berita Acara</h6>
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
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 h3">Form Berita Acara</p>
                        <?php
                        // $cekapv = $this->db->query("SELECT * FROM tb_berita_acara WHERE no_ba='$noba'")->result();
                        // foreach ($cekapv as $val) {
                        //     if ($val->approver != '0') {
                        //         echo "<button class='btn btn-secondary btn-sm ms-auto modalAdd disabled' >Add Item</button>";
                        //     } else {
                        //         echo "<button class='btn btn-primary btn-sm ms-auto modalAdd' data-bs-toggle='modal' data-bs-target='#addItemBA'>Add Item</button>";
                        //     }
                        // }
                        ?>
                        <button class="btn btn-primary btn-sm ms-auto modalAdd" data-bs-toggle="modal" data-bs-target="#addItemBA">Add Item</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-0 text-sm">Berita Acara Number </p>
                        </div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-5">
                            <u>
                                <p class="mb-0 text-sm h6"> <?= $noba ?> </p>
                            </u>
                        </div>
                    </div>
                    <?php $this->db->select('*');
                    $this->db->from('tb_berita_acara');
                    $this->db->where('no_ba', $noba);
                    $result = $this->db->get()->result();
                    foreach ($result as $data) {
                        echo "<div class='row'>
                        <div class='col-md-4'><p class='mb-0 text-sm'>Ticket Number </p></div>
                        <div class='col-md-1'>:</div>
                        <div class='col-md-5'><u><p class='mb-0 text-sm'> " . $data->no_ticket . " </p></u></div>
                        </div>
                        <div class='row'>
                        <div class='col-md-4'><p class='mb-0 text-sm'>Date </p></div>
                        <div class='col-md-1'>:</div>
                        <div class='col-md-5'><u><p class='mb-0 text-sm'> " . date("d-m-Y", strtotime($data->input_date)) . " </p></u></div>
                        </div>";
                        // echo "<p class='mb-0'>Date :  " . date("d-m-Y", strtotime($data->input_date)) . " </p>";
                    }
                    ?>

                    <hr class="horizontal dark">
                    <p class="text-sm">ICT Team carried the inspection of the following equipment listed as follows:</p>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th> -->
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Equipment</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">SN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Condition</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Recommendation</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tableItem">
                                    <!-- <tr>
                                        <td></td>
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
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Notes :</p>
                    <div class="row">
                        <div class="col-md-12">
                            <u>
                                <p class='mb-0 text-sm'> <?= $data->notes ?></p>
                            </u>

                            <!-- <div class="form-group">
                                <input class="btn btn-primary-outline" type="button" value="Submit">
                            </div> -->
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <!-- <a href="<?= site_url('ReportPdf/generate_formBA/') . $noba ?>" class="btn btn-outline-secondary btn-sm ms-auto" target="_blank"><i class="fas fa-print"></i> Print</a> -->
                        <a href="<?php $link = explode("/", $noba);
                                    echo site_url('ReportPdf/generate_formBA/') . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) ?>" class="btn btn-outline-secondary btn-sm ms-auto" target="_blank"><i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="<?= base_url() ?>/assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            <a href="javascript:;">
                                <img src="<?= base_url() ?>/assets/img/BMGLogo.png" class="rounded-circle img-fluid border border-2 border-white">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <!-- Cek apakah sudah ada item BA atau informasi BS sudah lengkap -->
                        <?php
                        // $cek = $this->db->query("SELECT * FROM tb_berita_acara_detail WHERE no_ba_detail='$noba'");
                        // if ($cek->num_rows() > 0) {
                        //     echo "<a href='javascript:;' class='btn btn-sm btn-info mb-0 d-none d-lg-block' data-bs-toggle='modal' data-bs-target='#askApproval'>Ask Approval</a>";
                        // } else {
                        //     echo "<a href='javascript:;' class='btn btn-sm btn-secondary mb-0 d-none d-lg-block' >Ask Approval</a>";
                        // }
                        ?>
                        <!-- End Cek -->
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block AskApv" data-bs-toggle="modal" data-bs-target="#askApproval">Ask Approval</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block" onclick="timeline()">Refresh </a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <hr class="horizontal dark">
                                <h4>Timeline</h4>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="text-center mt-4"> -->
                    <div class="mt-4">
                        <ul class="timeline2">
                            <!-- <li>
                                <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                                <a href="#" class="float-right">21 March, 2014</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal ADD ITEM  Berita Acara-->
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
                            <!-- <input type="text" class="form-control" id="itemID" name="itemID"> -->
                            <input type="hidden" class="form-control" id="noba" name="noba" value="<?= $noba ?>">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Equipment Type</label>
                                    <input type="text" class="form-control" id="equipment-type" name="equipment" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Serial Number</label>
                                    <input type="text" class="form-control" id="serial" name="serial" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Condition</label>
                            <input type="text" class="form-control" id="condition" name="condition" required>
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Recommendation</label>
                            <input type="text" class="form-control" id="recomendation" name="recomendation" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded mt-4 simpan">Submit</button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDIT ITEM  Berita Acara-->
<div class="modal fade" id="editItemBA" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-file-signature"></i> Update Item Berita acara ?</h3>
                        <p class="mb-0 noBA"></p>
                    </div>
                    <hr class="horizontal dark">

                    <!-- <form action="<?= site_url('Troubleshoot/proposeBA') ?>" method="post" enctype="multipart/form-data" id="formBA"> -->
                    <div class="card-body" id="bodyEdit">
                        <div class="row">
                            <input type="hidden" class="form-control" id="itemid" name="itemid">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Equipment Type</label>
                                    <input type="text" class="form-control" id="equipment_edit" name="equipment" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="equipment-type" class="col-form-label">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_edit" name="serial" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Condition</label>
                            <input type="text" class="form-control" id="condition_edit" name="condition" required>
                        </div>
                        <div class="form-group">
                            <label for="equipment-type" class="col-form-label">Recommendation</label>
                            <input type="text" class="form-control" id="recommendation_edit" name="recomendation" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded mt-4 update">Submit</button>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Item BA -->
<div class="modal fade" id="deleteItemBA" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6> -->
                <h4 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-file-signature"></i> Delete Item Berita acara ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="bodyDelete">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="text-gradient text-danger mt-4">You should read this!</h4>
                    <p>This activity will deleting item of berita acara</p>
                </div>
                <input type="hidden" class="form-control" id="itemid_delete" name="itemid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white delete">Ok, Got it</button>
                <button type="button" class="btn btn-dark ml-auto" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="askApproval" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-primary text-gradient"> <i class="fas fa-file-signature"></i> Asking for Approval ?</h3>
                    </div>
                    <hr class="horizontal dark">
                    <form action="<?= site_url('BeritaAcara/ask_Approval') ?>" method="post" enctype="multipart/form-data" id="formBA">
                        <div class="card-body pb-3">
                            <input type="hidden" class="form-control" id="NoBa" name="NoBa" value="<?= $noba ?>">
                            <div class="field">
                                <label class="col-form-label">Select Some Approver</label>
                                <div class="control">
                                    <select class="form-control" name="approver[]" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple required>
                                        <?php foreach ($rowuser as $dtuser) {
                                            echo "<option value='" . $dtuser['user_email'] . "'>" . $dtuser['user_name'] . "</option>";
                                        } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded mt-4">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.3.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        tampil_data();
        timeline();
    })

    function timeline() {
        var noba = $("#noba").val();
        console.log(noba);
        $.ajax({
            type: "GET",
            url: "<?= base_url('index.php/BeritaAcara/get_data_history') ?>",
            dataType: "JSON",
            data: {
                noba: noba
            },
            success: function(data) {
                var html = "";
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<li style="font-size:12px">' +
                        // '<a  href="https://www.totoprayogo.com/#">' + data[i].activity + '</a>' +
                        '<a href="javascript:;" class="float-right">' + data[i].input_date + '</a>' +
                        '<br><a  href="javascript:;">' + data[i].activity + '</a>' +
                        '<p style="font-size:12px">Carried out by : ' + data[i].user_input + ' </p>' +
                        '</li>';
                }
                $(".timeline2").html(html);
            }
        })
    }

    function tampil_data() {
        var noba = $("#noba").val();
        // console.log(noba);
        $.ajax({
            type: "GET",
            url: "<?= base_url('index.php/BeritaAcara/get_data_item') ?>",
            dataType: "JSON",
            data: {
                noba: noba
            },
            success: function(data) {
                var html = "";
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<tr><td><div class="d-flex px-2"><div class="my-auto"><h6 class="mb-0 text-xs">' + data[i].equipment_detail + '</h6></div></div></td>' +
                        '<td><p class="text-xs font-weight-bold mb-0">' + data[i].sn_detail + '</p></td>' +
                        '<td><p class="text-xs font-weight-bold mb-0">' + data[i].condition_detail + '</p></td>' +
                        '<td><p class="text-xs font-weight-bold mb-0">' + data[i].recommendation + '</p></td>' +
                        '<td class="align-middle">' +
                        '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="dropdownMenuButton">' +
                        '<i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>' +
                        '</button>' +
                        '<ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">' +
                        '<li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-bs-target="#editItemBA" id="item_edit" data-id="' + data[i].item_id + '" data-eqp="' + data[i].equipment_detail + '" data-sn="' + data[i].sn_detail + '" data-cond="' + data[i].condition_detail + '" data-recom="' + data[i].recommendation + '"><i class="fas fa-edit text-danger"></i> Edit</a></li>' +
                        '<li><a class="dropdown-item border-radius-md" href="javascript:;" data-bs-toggle="modal" data-bs-target="#deleteItemBA" id="item_delete" data-id="' + data[i].item_id + '"><i class="fas fa-trash text-danger"></i> Delete</a></li>' +
                        '</ul>' +
                        '</td>' +
                        '</tr>';
                }
                $("#tableItem").html(html);
            }
        })
    }

    // function askApprover() {
    //     var noba = $("#noba").val();
    //     // console.log(noba);
    //     $.ajax({
    //         url: "<?= base_url('index.php/BeritaAcara/get_ask_apv') ?>",
    //         type: "POST",
    //         // dataType: "JSON",
    //         data: {
    //             noba: noba
    //         },
    //         success: function(data) {
    //             if (data == 1) {
    //                 $(".AskApv").addClass('btn-info');
    //                 $(".AskApv").removeClass('btn-secondary');
    //                 $(".AskApv").attr('disabled', false);
    //             } else {
    //                 $(".AskApv").removeClass('btn-info');
    //                 $(".AskApv").addClass('btn-secondary');
    //                 $(".AskApv").attr('disabled', true);

    //             }
    //         }
    //     })
    // }

    // Function Add Item
    $(".simpan").on("click", function() {
        var noba = $("#noba").val();
        var equipment = $("#equipment-type").val();
        var sn = $("#serial").val();
        var condition = $("#condition").val();
        var recom = $("#recomendation").val();
        if (equipment == "" || sn == "" || condition == "" || recom == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'Complete your form !',
                showConfirmButton: false,
                timer: 2000
            });
        } else {

            $("#addItemBA").modal('hide');
            $("#equipment-type").val("");
            $("#serial").val("");
            $("#condition").val("");
            $("#recomendation").val("");

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/BeritaAcara/add_Item_BA",
                dataType: "JSON",
                data: {
                    noba: noba,
                    equipment: equipment,
                    sn: sn,
                    condition: condition,
                    recom: recom
                },
                success: function(data) {

                }
            })
            Swal.fire(
                'Good job!',
                'Activity completed!',
                'success'
            )
            tampil_data();
            return false;
        }
    })

    // FUnction Show Item into Form
    $(document).on("click", "#item_edit", function() {
        var id = $(this).data('id');
        var equipment = $(this).data('eqp');
        var sn = $(this).data('sn')
        var condition = $(this).data('cond');
        var recom = $(this).data('recom');
        // console.log(equipment);

        $("#bodyEdit #itemid").val(id);
        $("#bodyEdit #equipment_edit").val(equipment);
        $("#bodyEdit #serial_edit").val(sn);
        $("#bodyEdit #condition_edit").val(condition);
        $("#bodyEdit #recommendation_edit").val(recom);
    })

    // Function Edit Item
    $(".update").on("click", function() {
        var itemid = $("#itemid").val();
        var equipment = $("#equipment_edit").val();
        var sn = $("#serial_edit").val();
        var condition = $("#condition_edit").val();
        var recom = $("#recommendation_edit").val();
        if (equipment == "" || sn == "" || condition == "" || recom == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'Complete your form !',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $("#editItemBA").modal('hide');
            $("#equipment-edit").val("");
            $("#serial_edit").val("");
            $("#condition_edit").val("");
            $("#recommendation_edit").val("");

            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>index.php/BeritaAcara/update_Item_BA",
                dataType: "JSON",
                data: {
                    itemid: itemid,
                    equipment: equipment,
                    sn: sn,
                    condition: condition,
                    recom: recom
                },
                success: function(data) {

                }
            })
            Swal.fire(
                'Good job!',
                'Activity completed!',
                'success'
            )
            tampil_data();
            return false;
        }
    })

    // Show item to delete form
    $(document).on("click", "#item_delete", function() {
        var id = $(this).data('id');
        $("#bodyDelete #itemid_delete").val(id)
    })

    $(".delete").on("click", function() {
        var itemid = $("#itemid_delete").val();
        console.log(itemid);
        $("#deleteItemBA").modal('hide');
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/BeritaAcara/delete_Item_BA",
            dataType: "JSON",
            data: {
                itemid: itemid,
            },
            success: function(data) {

            }
        })
        Swal.fire(
            'Good job!',
            'Activity completed!',
            'success'
        )
        tampil_data();
        return false;
    })

    // Cari Ticket
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
</script>