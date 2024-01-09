<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		$this->load->model('M_Dashboard');
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


	public function index()
	{
		$tahun = gmdate("Y-m", time() + 60 * 60 * 7);
		$data = array(
			'title'		=> "ICT Helpdesk - Dashboard",
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'row'		=> $this->M_Dashboard->getDataTicket($tahun)
		);
		$this->template->load('template', 'dashboard', $data);
	}

	public function profile()
	{
		$data = array(
			'title'		=> "ICT Helpdesk - Profile",
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'rowsbu'	=> $this->M_Helpdesk->loadSbu(),
			'rowdept' 	=> $this->M_Helpdesk->loadDept(),
			// 'row'		=> $this->M_Dashboard->getDataTicket($tahun)
		);
		$this->template->load('template', 'profile', $data);
	}

	// CariTix / Cari Ticket
	public function cariTicket()
	{
		$caritix = $this->input->post('noticket', TRUE);
		$cek = $this->db->query("SELECT * FROM tb_helpdesk WHERE no_ticket='$caritix' ");
		if ($cek->num_rows() > 0) {
			echo "1";
		} else {
			echo "0";
		}
	}

	// Page Change Password
	public function changePassword()
	{
		$data = array(
			'title'		=> "ICT Helpdesk - Profile",
			// 'captcha'	=> $this->recaptcha->getWidget(),
			// 'script_captcha' => $this->recaptcha->getScriptTag(),
			// 'rowsbu'	=> $this->M_Helpdesk->loadSbu(),
			// 'rowdept' 	=> $this->M_Helpdesk->loadDept(),
			// 'row'		=> $this->M_Dashboard->getDataTicket($tahun)
		);
		$this->template->load('template', 'changepassword', $data);
	}

	// ResetPassword
	public function resetPassword()
	{
		$iduser = $this->input->post('iduser', TRUE);
		$pass	= sha1($this->input->post('password', TRUE));

		$reset = $this->db->query("UPDATE tb_login SET password='$pass' WHERE login_id='$iduser' ");

		return $reset;
	}

	// Page Search Ticket
	public function searchTicket()
	{
		$alamat1 = $this->uri->segment(3);
		$alamat2 = $this->uri->segment(4);
		$alamat3 = $this->uri->segment(5);
		$alamat4 = $this->uri->segment(6);
		$noticket =  $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;

		$data = array(
			'title'		=> "ICT Helpdesk - Search Ticket",
			'row'		=> $this->M_Dashboard->searchTicket($noticket),
			'notix'		=> $noticket
		);
		$this->template->load('template', 'searchticket', $data);
	}

	// Get DB Ticket
	public function checkDbTicket()
	{
		$noticket = $this->input->post('noticket', TRUE);
		if ($noticket != '') {
			// $cek = $this->db->query("SELECT * FROM tb_helpdesk_history 
			// WHERE no_ticket='$noticket'");
			$this->db->select('*');
			$this->db->from('tb_helpdesk_history');
			$this->db->join('tb_helpdesk', 'tb_helpdesk.no_ticket=tb_helpdesk_history.no_ticket', 'left');
			$this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk_history.email_input', 'left');
			$this->db->order_by('tb_helpdesk_history.seq_no', "DESC");
			$this->db->where('tb_helpdesk_history.no_ticket', $noticket);
			$cek = $this->db->get();
			$row = $cek->result_array();
			if ($cek->num_rows() > 0) {
				foreach ($row as $data) {
					$detail = explode(";", $data['note_ticket']);
					echo "<li>
							<div class='timeline-time'>
								<span class='date'>" . date('l', strtotime($data['tgl_input'])) . "</span>
								<span class='time' style='margin-right:5px'>" . date('d-m-y', strtotime($data['tgl_input'])) . "</span>
							</div>

							<div class='timeline-icon'>
								<a href='javascript:;'>&nbsp;</a>
							</div>

							<div class='timeline-body' style='margin-left:115px'>
								<div class='timeline-header'>
									<span class='userimage'><img src=" . base_url() . "assets/avatar/" . $data['avatar'] . " alt></span>
									<span class='username'><a href='javascript:;'>" . strtoupper($data['user_name']) . "</a> <small></small></span>
									
								</div>
								<div>";
					if (($data['aktifitas'] == "started") && ($data['jenis_komplain'] == "ER")) {
						echo "<p>Firstname : " . $detail[0] . " </br> Lastname: " . $detail[1] . " </br> Phone : " . $detail[2] . " </br> SBU : " . $detail[3] . " </br> Departemen : " . $detail[4] . " </br> Position : " . $detail[5] . "</p>";
					} else if (($data['aktifitas'] == "started") && ($data['jenis_komplain'] == "AR")) {
						$detail = explode(";", $data['note_ticket']);
						echo "<p>Type Asset : " . $detail[0] . " </br> Quantity: " . $detail[1] . " " . $detail[2] . " </br> Additional Info : " . $detail[3] . "</p>";
					} else {
						echo "<p>" . $data['note_ticket'] . "</p>";
					}

					if ($data['foto_problem'] != "no-image.png") {
						echo "<p class='m-t-20'>
									<img src=" . base_url() . "uploads/" . $data['foto_problem'] . " alt='' height='150px'>
								</p>";
					}
					echo "
								</div>
								
								<div class='timeline-likes'>
									<div class='stats-right'>
									<span class='fa-stack fa-fw stats-icon'>
										<i class='fa fa-circle fa-stack-2x text-danger'></i>
										<i class='fas fa-history fa-stack-1x fa-inverse t-plus-1'></i>
									</span>
										<span class='stats-text'>" . date('H:i:s', strtotime($data['tgl_input'])) . "</span>
									</div>
									<div class='stats'>
										
										<span class='fa-stack fa-fw stats-icon'>
											<i class='fa fa-circle fa-stack-2x text-primary'></i>
											<i class='fa fa-thumbs-up fa-stack-1x fa-inverse'></i>
										</span>
										<span class='stats-total'>" . strtoupper($data['aktifitas']) . "</span>
									</div>
								</div>					
							</div>

						</li>";
				}
			} else {
				echo "0";
			}
		}
	}
}
