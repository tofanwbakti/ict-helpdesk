<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">User Profile</h6>
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

<div class="card shadow-lg mx-4 ">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="<?= base_url() . "/assets/avatar/" . $this->fungsi->user_login()->avatar; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        <?= $this->fungsi->user_login()->user_name; ?>
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <?= $this->fungsi->user_login()->user_email; ?>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto" style="display: none;">Settings</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email address</label>
                                <input class="form-control" type="email" value="<?= $this->fungsi->user_login()->user_email; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">User name</label>
                                <input class="form-control" type="text" value="<?= $this->fungsi->user_login()->user_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">SBU</label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control" id="recipient-status" name="sbu">
                                    <option value="0" selected value="<?= $this->fungsi->user_login()->kode ?>"> <?= $this->fungsi->user_login()->nama_sbu ?></option>
                                    <?php foreach ($rowsbu as $dtsbu) {
                                        echo "<option value='" . $dtsbu['kode'] . "'>" . $dtsbu['nama_sbu'] . "</option>";
                                        # code...
                                    } ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <!-- <input type="text" class="form-control" value="Creative Tim"> -->
                                <select class="form-control" id="recipient-status" name="department">
                                    <option value="0" selected value="<?= $this->fungsi->user_login()->id_dept ?>"> <?= $this->fungsi->user_login()->kode_dept ?></option>
                                    <?php foreach ($rowdept as $dtdept) {
                                        echo "<option value='" . $dtdept['id_dept'] . "'>" . $dtdept['kode_dept'] . "</option>";
                                        # code...
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <!-- <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <input class="form-control" type="text" value="New York">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Country</label>
                                <input class="form-control" type="text" value="United States">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Postal code</label>
                                <input class="form-control" type="text" value="437300">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">About me</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">About me</label>
                                <input class="form-control" type="text" value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source.">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <!-- <div class="card card-profile">
                <img src="<?= base_url() ?>/assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            <a href="javascript:;">
                                <img src="<?= base_url() ?>/assets/img/team-2.jpg" class="rounded-circle img-fluid border border-2 border-white">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i class="ni ni-collection"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i class="ni ni-email-83"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">22</span>
                                    <span class="text-sm opacity-8">Friends</span>
                                </div>
                                <div class="d-grid text-center mx-4">
                                    <span class="text-lg font-weight-bolder">10</span>
                                    <span class="text-sm opacity-8">Photos</span>
                                </div>
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">89</span>
                                    <span class="text-sm opacity-8">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h5>
                            Mark Davis<span class="font-weight-light">, 35</span>
                        </h5>
                        <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Bucharest, Romania
                        </div>
                        <div class="h6 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

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
</script>