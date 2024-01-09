<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Email Request Form</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Email Request Form</h6>
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
                        <p class="mb-0 h3">Email Request Form</p>
                        <!-- <button class="btn btn-primary btn-sm ms-auto modalAdd" data-bs-toggle="modal" data-bs-target="#addItemBA">Add Item</button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-0 text-sm">Request Number </p>
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
                    $this->db->join('tb_helpdesk', 'tb_helpdesk.no_ticket=tb_berita_acara.no_ticket', 'left');
                    $this->db->where('tb_berita_acara.no_ba', $noba);
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
                        echo "<hr class='horizontal dark'>";
                        echo "<p class='text-sm'>The information given in this form is reliable and trusted.</p>";
                        echo "<p class='mb-3 h4'>General Information :</p>";
                        $this->db->select('*');
                        $this->db->where('no_ticket', $data->no_ticket);
                        // echo "<div class='row'>";
                        $hasil = $this->db->get('tb_helpdesk')->result();
                        foreach ($hasil as $key) {
                            $info_rf = explode(";", $key->informasi);
                            echo "<table class='table table-borderless table-sm'>
                                <tr>
                                    <td class='col-md-2'>First Name</td>
                                    <td class='col-md-1'>:</td>
                                    <td>" . $info_rf[0] . "</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>:</td>
                                    <td>" . $info_rf[1] . "</td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td>:</td>
                                    <td>" . $info_rf[5] . "</td>
                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td>:</td>
                                    <td>" . $info_rf[4] . "</td>
                                </tr>
                                <tr>
                                    <td>SBU</td>
                                    <td>:</td>
                                    <td>" . $info_rf[3] . "</td>
                                </tr>
                                <tr>
                                    <td>Phone No.</td>
                                    <td>:</td>
                                    <td>" . $info_rf[2] . "</td>
                                </tr>
                            </table>";
                        }
                    }
                    ?>

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

                        <a href="<?php $link = explode("/", $noba);
                                    echo site_url('ReportPdf/generate_formRF/') . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) ?>" class="btn btn-outline-secondary btn-sm ms-auto" target="_blank"><i class="fas fa-print"></i> Print</a>
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
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block" data-bs-toggle="modal" data-bs-target="#askApproval">Ask Approval</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block refresh">Refresh </a>
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

                        </ul>
                    </div>
                </div>
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
                    <form action="<?= site_url('BeritaAcara/ask_Approval_ERF') ?>" method="post" enctype="multipart/form-data" id="formBA">
                        <div class="card-body pb-3">
                            <input type="hidden" class="form-control" id="NoBa" name="NoBa" value="<?= $noba ?>">
                            <?php $this->db->select('SUM(approver) as total');
                            $this->db->where('no_ba', $noba);
                            $sumBA = $this->db->get('tb_berita_acara')->row()->total;

                            echo "<input type='hidden' class='form-control' id='sumdoc' name='sumdoc' value='" . $sumBA . " '>";

                            ?>
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

        // tampil_data();
        timeline();
    })

    $(document).click(".refresh", function() {
        timeline();
    });

    function timeline() {
        var noba = $("#NoBa").val();
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