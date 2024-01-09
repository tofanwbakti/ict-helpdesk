<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterData extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		$this->load->model('M_Masterdata');
		$this->load->model('M_Helpdesk');
	}

	// Proses Logout start
	function signout()
	{
		// $this->session->set_flashdata('flash', 'finished');
		$this->session->sess_destroy();
		//$url=base_url('');
		redirect('Auth');
	}


	public function dataUser()
	{
		$data = array(
			'title'		=> "ICT Helpdesk - Data User",
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'row'		=> $this->M_Masterdata->getDataUser(),
			'rowavatar'	=> $this->M_Masterdata->getAvatar(),
			'rowsbu'	=> $this->M_Helpdesk->loadSbu(),
			'rowdept' 	=> $this->M_Helpdesk->loadDept(),
		);
		$this->template->load('template', 'masterdata/datauser', $data);
	}

	// Update Picture
	public function updatePicture()
	{
		$email 	= $this->input->post('email', TRUE);

		$nama	= substr($email, 0, -20);
		$result = preg_replace("/[^a-zA-Z0-9]/", "", $nama);
		// $nama	= $this->fungsi->user_login()->user_id;
		$today  = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$config['upload_path']		= './assets/avatar/'; //lokasi folder penyimpanan
		$config['allowed_types']   	= 'jpeg|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name']		= $result . '-avatar'; //penamaan file
		// $config['max_size']			= 5120; //maksimal ukuran 5 Mb
		$config['max_size']			= 250; //maksimal ukuran 250 KB
		$config['overwrite']		= TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!empty($_FILES['filePhoto']['name'])) {
			if ($this->upload->do_upload('filePhoto')) {
				$gbr 	= $this->upload->data();
				$gambar	= $gbr['file_name'];
				$data = array(
					'avatar' => $gambar,
				);

				$where  = array('user_email' => $email);
			} else {
				$error =  $this->upload->display_errors();
				echo print_r($error);
			}
		}
		$this->M_Masterdata->updatePicture($data, $where, 'tb_user');
		$this->session->set_flashdata('flash', 'complete');
		redirect('MasterData/dataUser');
	}

	// Update Password
	public function updatePassword()
	{
		$email 	= $this->input->post('email', TRUE);
		$newpass = sha1($this->input->post('newpass', TRUE));
		// echo $newpass . ' / ' . $email;

		$data = array('password' => $newpass);
		$where = array('email' => $email);
		$this->M_Masterdata->updatePassword($data, $where, 'tb_login');
		$this->session->set_flashdata('flash', 'complete');
		redirect('MasterData/dataUser');
	}
	// Update Level
	public function updateLevel()
	{
		$email 	= $this->input->post('email', TRUE);
		$level = $this->input->post('level', TRUE);
		// echo $newpass . ' / ' . $email;

		$data = array('level' => $level);
		$where = array('email' => $email);
		$this->M_Masterdata->updateLevel($data, $where, 'tb_login');
		$this->session->set_flashdata('flash', 'complete');
		redirect('MasterData/dataUser');
	}
	// Update UserInfo
	public function updateUserInfo()
	{
		$email 	= $this->input->post('email', TRUE);
		$sbu 	= $this->input->post('sbu', TRUE);
		$dept 	= $this->input->post('dept', TRUE);
		// echo $newpass . ' / ' . $email;

		$data = array(
			'user_sbu' => $sbu,
			'user_dept' => $dept
		);
		$where = array('user_email' => $email);
		$this->M_Masterdata->updateLevel($data, $where, 'tb_user');
		$this->session->set_flashdata('flash', 'complete');
		redirect('MasterData/dataUser');
	}
}
