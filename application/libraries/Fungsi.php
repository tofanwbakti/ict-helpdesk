<?php

class Fungsi
{

    protected $CI;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('M_Auth');
        $user_email = $this->ci->session->userdata('email'); //email adalah session yang di dapat dari controller Auth
        $user_data = $this->ci->M_Auth->get($user_email)->row();
        return $user_data;
    }
}
