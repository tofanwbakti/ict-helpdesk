<?php
// Pengecekan apakah sudah login
function cek_yeslogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('email');
    if ($user_session) {
        redirect ('Dashboard');
    }
}

// pengecekan jika user belum login 
// maka user akan di redirect ke halaman login atau controller Auth
function cek_nologin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('email');
    if (!$user_session) {
        redirect ('Auth');
    }
}