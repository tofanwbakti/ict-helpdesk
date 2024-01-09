<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Search</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Search Ticket</h6>
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

<div class="card shadow-lg mx-4">
    <?php foreach ($row as $data) { ?>

        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
            <a href="javascript:;" class="d-block">
                <img src="<?= base_url() ?>/assets/img/kit/pro/anastasia.jpg" class="img-fluid border-radius-lg">
            </a>
        </div>

        <div class="card-body pt-2">
            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                <?php if ($data['jenis_komplain'] == "TS") {
                    echo "Trouble Shooting";
                } else if ($data['jenis_komplain'] == "ER") {
                    echo "Email Request";
                } else {
                    echo "Asset / Spare Part Request";
                } ?>
            </span>
            <a href="javascript:;" class="card-title h5 d-block text-darker">
                <?= $notix ?>
            </a>
            <p class="card-description mb-4">
                <?php if ($data['jenis_komplain'] == "TS") {
                    echo $data['informasi'];
                } else if ($data['jenis_komplain'] == "ER") {
                    $pecah = explode(";", $data['informasi']);
                    echo "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
                } else {
                    $pecah = explode(";", $data['informasi']);
                    echo "Type of Assets : " . $pecah[0] . "<br> Quantity : " . $pecah[1] . " " . $pecah[2] . "<br> Additional Info : " . $pecah[3];
                } ?>
            </p>
            <div class="author align-items-center">
                <img src="<?= base_url('assets/avatar/') . $data['avatar'] ?>" alt="..." class="avatar shadow">
                <div class="name ps-3">
                    <span><?= $data['nama'] ?></span>
                    <div class="stats">
                        <small>submitted on <?= date("d F Y", strtotime($data['input_tgl'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
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