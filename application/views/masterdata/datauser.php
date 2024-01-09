<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Master Data User</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Data User</h6>
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
                    <a href="<?= site_url('MasterData/signout') ?>" class="nav-link text-white p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Sign Out">
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
                                <p class="text-sm mb-0 text-uppercase font-weight-bold"><?= gmdate("F", time() + 60 * 60 * 7) ?> Users</p>
                                <h5 class="font-weight-bolder">
                                    <?php
                                    $this->db->join('tb_login', 'tb_login.email=tb_user.user_email', 'left');
                                    // $this->db->where('tb_login.status', 'AKTIF');
                                    $this->db->from('tb_user');
                                    echo $this->db->count_all_results();
                                    ?>
                                </h5>
                                <p class="mb-0">
                                    <?php
                                    $this->db->join('tb_login', 'tb_login.email=tb_user.user_email', 'left');
                                    $this->db->where('tb_login.status !=', 'AKTIF');
                                    $this->db->from('tb_user');
                                    echo "<span class='text-primary text-sm font-weight-bolder'>" . $this->db->count_all_results() . "</span> users inactive";

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
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">User List</h6>
                        <button class="btn btn-primary btn-sm ms-auto"><i class="fas fa-user-plus m-2"></i> Add New</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Info</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Level</th>
                                <th class="text-center text-secondary opacity-7"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($row as $data) { ?>
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
                                                <h6 class="mb-0 text-xs"><?= $data['user_name'] ?></h6>
                                                <p class="text-xs text-secondary mb-0"><?= $data['user_email'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $data['user_sbu'] ?></p>
                                        <p class="text-xs text-secondary mb-0"><?= $data['kode_dept'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $data['level'] ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs task" data-bs-toggle="modal" data-bs-target="#updateTask" data-email="<?= $data['user_email'] ?>">
                                            <i class="fas fa-tools" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Update Task"></i>
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
                                <th class="text-xs">Level</th>
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

                    <div class="card-body pb-3" id="bodyAksi">
                        <div class="row px-xl-5 px-sm-4 px-3">
                            <div class="col-3 ms-auto px-1">
                                <a class="btn btn-outline-light w-100 btn1" href="javascript:;" onclick="showForm1(this)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change Picture">
                                    <img src="<?= base_url() ?>assets/img/camera.png" alt="" style="height:2em">
                                </a>
                            </div>
                            <div class="col-3 me-auto px-1">
                                <a class="btn btn-outline-light w-100 btn3" href="javascript:;" onclick="showForm3()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change Level">
                                    <img src="<?= base_url() ?>assets/img/set-up.png" alt="" style="height:2em">
                                </a>
                            </div>
                            <div class="col-3 px-1">
                                <a class="btn btn-outline-light w-100 btn2" href="javascript:;" onclick="showForm2()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change Password">
                                    <img src="<?= base_url() ?>assets/img/server.png" alt="" style="height:2em">
                                </a>
                            </div>
                            <div class="col-3 me-auto px-1">
                                <a class="btn btn-outline-light w-100 btn4" href="javascript:;" onclick="showForm4()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change User Info">
                                    <img src="<?= base_url() ?>assets/img/personal-information.png" alt="" style="height:2em">
                                </a>
                            </div>
                            <hr class="horizontal dark">
                        </div>
                        <form action="<?= site_url('MasterData/updatePicture') ?>" method="post" enctype="multipart/form-data" id="avatarForm">
                            <input type="hidden" class="form-control" id="email" name="email">
                            <div class="form-group">
                                <label for="photo-upload" class="col-form-label">Change Picture</label>
                                <input type="file" class="form-control" id="photo-upload" name="filePhoto" onchange="return validasiFile()">
                                <span class="text-muted" style="font-size: 12px;"><cite>*max 200Kb, format file jpg | jpeg | png</cite></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0 submit" disabled>Submit</button>
                            </div>
                        </form>
                        <!-- Password Form -->
                        <form action="<?= site_url('MasterData/updatePassword') ?>" method="post" id="passwordForm">
                            <input type="hidden" class="form-control" id="email" name="email">
                            <div class="form-group">
                                <label for="newpass" class="col-form-label">New Password</label>
                                <input type="password" class="form-control" id="newpass" name="newpass" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmpass" class="col-form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmpass" name="confirmpass" onchange="triggerMatch()" required>
                            </div>
                            <div class="form-check form-check-info text-start">
                                <input class="form-check-input showPass" type="checkbox">
                                <label class="form-check-label" for="flexCheckDefault" id="showPass">Show password
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0 submit" disabled>Submit</button>
                            </div>
                            <!-- <span class="text-center" style="font-size: 15px;">All activity report will send to email user. </span> -->
                        </form>
                        <!-- Level Form -->
                        <form action="<?= site_url('MasterData/updateLevel') ?>" method="post" id="levelForm" style="display:none">
                            <input type="hidden" class="form-control" id="email" name="email">
                            <div class="form-group">
                                <label for="recipient-status" class="col-form-label">Level Update :</label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control" id="recipient-status" name="level" onchange="buttonOn()">
                                    <option value="0" selected disabled> Pick one..</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="TECHNICIAN">TECHNICIAN</option>
                                    <option value="USER">USER</option>
                                    <option value="MANAGER">MANAGER</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0 submit" disabled>Submit</button>
                            </div>
                        </form>

                        <!-- User Info Form -->
                        <form action="<?= site_url('MasterData/updateUserInfo') ?>" method="post" id="userInfoForm" style="display:none">
                            <input type="hidden" class="form-control" id="email" name="email">
                            <div class="form-group">
                                <label for="recipient-status" class="col-form-label">SBU:</label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control" id="recipient-sbu" name="sbu" onchange="deptOn()">
                                    <option value="0" selected disabled> Pick one..</option>
                                    <?php foreach ($rowsbu as $dtsbu) {
                                        echo "<option value='" . $dtsbu['kode'] . "' > " . $dtsbu['nama_sbu'] . "</option>";
                                        # code...
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-dept" class="col-form-label">Department </label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control dept" id="recipient-dept" name="dept" onchange="buttonOn()" disabled>
                                    <option value="0" selected disabled> Pick one..</option>
                                    <?php foreach ($rowdept as $dtdept) {
                                        echo "<option value='" . $dtdept['id_dept'] . "' > " . $dtdept['nama_dept'] . "</option>";
                                        # code...
                                    } ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-50 mt-4 mb-0 submit" disabled>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script>
    $(document).on("click", ".task", function() {
        $("#recipient-status").val('');
        $("#passwordForm").hide();
        $("#levelForm").hide();
        $("#userInfoForm").hide();
        $("#avatarForm").show();

        var email = $(this).data('email');

        $("#bodyAksi #email").val(email);
    })

    function showForm1() {
        $("#avatarForm").show();
        $("#passwordForm").hide();
        $("#levelForm").hide();
        $("#userInfoForm").hide();
        $(".submit").attr('disabled', true);
    }

    function showForm2() {
        $("#avatarForm").hide();
        $("#passwordForm").show();
        $("#levelForm").hide();
        $("#userInfoForm").hide();
        $(".submit").attr('disabled', true);
    }

    function showForm3() {
        $("#avatarForm").hide();
        $("#passwordForm").hide();
        $("#levelForm").show();
        $("#userInfoForm").hide();
        $(".submit").attr('disabled', true);
    }

    function showForm4() {
        $("#avatarForm").hide();
        $("#passwordForm").hide();
        $("#levelForm").hide();
        $("#userInfoForm").show();
        $(".submit").attr('disabled', true);
    }

    function buttonOn() {
        var status = $("#recipient-status").val();
        if (status == "0") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'No Activity Selected !',
                showConfirmButton: false,
                timer: 2000
            });
        } else {
            $(".submit").attr('disabled', false);
        }
    };

    function deptOn() {
        if (status == "0") {
            Swal.fire({
                icon: 'warning',
                title: 'Oops !',
                text: 'No SBU Selected !',
                showConfirmButton: false,
                timer: 2000
            });
            $(".dept").attr('disabled', true);
        } else {
            $(".dept").attr('disabled', false);
        }
    }

    // Validasi File
    function validasiFile() {
        var inputFile = document.getElementById('photo-upload');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var file_size = $('#photo-upload')[0].files[0].size;
        if (!ekstensiOk.exec(pathFile)) {
            // alert('Silakan upload file yang memiliki ekstensi .pdf');
            // $("#loaderIcon").hide();
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "File not permitted!",
                showConfirmButton: false,
                timer: 3000,
            });
            inputFile.value = '';
            return false;
        } else if (file_size > 200000) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "File exceeds limit!",
                showConfirmButton: false,
                timer: 3000,
            });
            inputFile.value = '';
            return false;
        }
        $(".submit").attr('disabled', false);
        return true;
    }

    // Hide/Show Password
    $(document).ready(function() {

        $(".showPass").click(function() {
            if ($(this).is(':checked')) {
                $("#newpass").attr('type', 'text');
                $("#confirmpass").attr('type', 'text');
            } else {
                $("#newpass").attr('type', 'password');
                $("#confirmpass").attr('type', 'password');
            }
        })
    })

    // Check Match Password
    function triggerMatch() {
        if ($("#newpass").val() == $("#confirmpass").val()) {
            $(".submit").attr('disabled', false);

        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Dismatch Password!",
                showConfirmButton: false,
                timer: 3000,
            });
            $(".submit").attr('disabled', true);

        }
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