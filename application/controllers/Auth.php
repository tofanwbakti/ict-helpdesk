<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_yeslogin();
		$this->load->model('M_Auth');
	}
	public function index()
	{
		$data = array(
			'title'		=> "ICT Helpdesk - Sign In",
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
		);
		// $this->load->view('welcome_message');
		$this->load->view('sign-in', $data);
	}

	#Proses validasi Id Karyawan pada Tambah Karyawan
	public function checkDbEmail()
	{
		$email = $this->input->post('email');
		if ($email != '') {
			$cek = $this->db->query("SELECT * FROM tb_login WHERE email='$email'");
			if ($cek->num_rows() > 0) {
				echo "1";
			} else {
				echo "0";
			}
		}
	}

	// Proceed Login
	public function proceed()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('M_Auth');
			if (!empty($post['g-recaptcha-response'])) {
				$query_login = $this->M_Auth->login($post);
				if ($query_login->num_rows() > 0) {
					$row = $query_login->row();
					$param = array(
						'email' 	=> $row->email,
					);
					$this->session->set_userdata($param);
					$this->session->set_flashdata('flash', 'successfully');
					redirect('Dashboard');
				} else {
					$this->session->set_flashdata('flash_error', 'failed');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('flash_error', 'failed');
				redirect('Auth');
			}
		}
	}


	// update data ketika session expired
	function sessionOff()
	{
		$email = array('email' => $this->fungsi->user_login()->user_email);

		$data = array(
			'time_login' => gmdate("G:i:s", time() + 60 * 60 * 7),
			'date_login' => gmdate("Y-m-d", time() + 60 * 60 * 7),
			'status' => "OFF"
		);

		redirect('Auth');
	}
}
