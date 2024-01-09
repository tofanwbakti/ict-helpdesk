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
                        <p class="mb-0">Change Password</p>
                    </div>
                </div>
                <div class="card-body">
                    <!-- <p class="text-uppercase text-sm">User Information</p> -->
                    <input class="form-control" type="hidden" name="iduser" id="iduser" value="<?= $this->fungsi->user_login()->login_id ?>">

                    <div class=" form-group">
                        <label for="example-text-input" class="form-control-label">New Password</label>
                        <input class="form-control" type="password" name="newPass" id="newPass" required>
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Confirm Password</label>
                        <input class="form-control" type="password" name="konfPass" id="konfPass" onblur="triggerMatch()" required>
                    </div>
                    <div class="form-check form-check-info text-start">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Show Password
                        </label>
                    </div>
                    <hr class="horizontal dark">
                    <button class="btn btn-primary btn-sm ms-auto btn-submit">Submit</button>

                </div>
            </div>
            <div class="col-md-2"></div>
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

        function triggerMatch() {
            if ($("#newPass").val() != $("#konfPass").val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops !',
                    text: 'Confirmation Password not match !',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#konfPass").focus();
                $("#konfPass").addClass("is-invalid");
                $("#konfPass").removeClass("is-valid");
                $("#newPass").addClass("is-invalid");
                $("#newPass").removeClass("is-valid");
                $(".btn-submit").attr('disabled', true);
                return false;
            } else {
                $("#konfPass").removeClass("is-invalid");
                $("#konfPass").addClass("is-valid");
                $("#newPass").removeClass("is-invalid");
                $("#newPass").addClass("is-valid");
                $(".btn-submit").attr('disabled', false);

            }
        }

        $(document).ready(function() {
            $("#flexCheckDefault").change(function() {
                var cb = $("#flexCheckDefault").prop('checked');
                if (cb) {
                    $("#newPass").prop("type", "text");
                    $("#konfPass").prop("type", "text");
                } else {
                    $("#newPass").prop("type", "password");
                    $("#konfPass").prop("type", "password");
                }
            })
        })

        $(".btn-submit").click(function() {
            var iduser = $("#iduser").val();
            var npas = $("#newPass").val();
            var kpas = $("#konfPass").val();

            if (npas == "" || kpas == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops !',
                    text: 'Form required !',
                    showConfirmButton: false,
                    timer: 2000
                })
                $("#konfPass").addClass("is-invalid");
                $("#konfPass").removeClass("is-valid");
                $("#newPass").addClass("is-invalid");
                $("#newPass").removeClass("is-valid");
            } else {
                $.ajax({
                    url: "<?= base_url() ?>index.php/Dashboard/resetPassword",
                    method: "POST",
                    data: {
                        iduser: iduser,
                        password: npas,
                    },
                    success: function(data) {

                    }
                })
                Swal.fire(
                    'Good job!',
                    'Reset Password Success !',
                    'success'
                );
                $("#konfPass").val("");
                $("#newPass").val("");
                $("#newPass").removeClass("is-valid");
                $("#konfPass").removeClass("is-valid");
            }
        })
    </script>