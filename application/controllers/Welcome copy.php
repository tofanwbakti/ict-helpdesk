<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('template');
		$this->load->model('M_Helpdesk');
	}
	public function index()
	{
		// $this->load->view('welcome_message');
		$data = array(
			'title' 	=> 'ICT Helpdesk',
			'row'		=> $this->M_Helpdesk->loadEmailUser(),
			'rowsbu'	=> $this->M_Helpdesk->loadSbu(),
			'rowdept' 	=> $this->M_Helpdesk->loadDept(),
			'rowgood'	=> $this->M_Helpdesk->loadGoods()
		);
		$this->load->view('helpdesk', $data);
	}

	// Generate no Ticket 
	public function getTicket()
	{
		$lbl 		= $this->input->post('lbl', TRUE);
		$periode 	= $this->input->post('periode', TRUE);
		$where 		= $this->input->post('where', TRUE);
		$tgl     	= gmdate("Y-m", time() + 60 * 60 * 7);

		$query = $this->db->query("SELECT MAX(no_ticket) as maxKode FROM tb_helpdesk WHERE jenis_komplain='$where' AND update_tgl LIKE '$tgl%' LIMIT 1");
		$row = $query->row_array();
		$kode = $row['maxKode'];
		$nourut = (int)substr($kode, 0, 4);
		$nourut++;
		$kodebaru = sprintf("%04s", $nourut) . '/' . $lbl . '/' . $periode;
		echo $kodebaru;

		return $kodebaru;
	}

	// Get User untuk form 
	public function getUser()
	{
		// POST data
		$postData = $this->input->post();

		// get data
		$data = $this->M_Helpdesk->getUser($postData);

		echo json_encode($data);
	}

	// Save Ticket Trouble Shooting
	public function saveTicketTS()
	{
		$noticket 		= $this->input->post('ticket', TRUE);
		$email 			= $this->input->post('email', TRUE);
		$sbu 			= $this->input->post('sbu', TRUE);
		$dept 			= $this->input->post('dept', TRUE);
		$status 		= $this->input->post('status', TRUE);
		$tipecomplain 	= $this->input->post('complain', TRUE);
		$user 			= $this->input->post('user', TRUE);
		$information 	= $this->input->post('information', TRUE);
		$checkbox 		= $this->input->post('checkbox', TRUE);
		$today      	= gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$tgl        	= gmdate("Y-m-d", time() + 60 * 60 * 7);
		// $status     = "WAITING";
		if ($tipecomplain == "TS") {
			$complain 	= "Trouble Shooting";
		} else if ($tipecomplain == "ER") {
			$complain 	= "Email Request";
		} else if ($tipecomplain == "AR") {
			$complain 	= "Asset Request";
		}

		$data = array(
			'no_ticket'		=> $noticket,
			'nama'			=> $user,
			'email'			=> $email,
			'sbu'			=> $sbu,
			'departemen'	=> $dept,
			'jenis_komplain' => $tipecomplain,
			'informasi'		=> $information,
			'status'		=> $status,
			'input_tgl'		=> $today,
			'update_tgl'	=> $today
		);

		// History Disimpan setelah user mulai input tiket
		$datahist = array(
			'no_ticket'     => $noticket,
			'status'        => $status,
			'tgl_ticket'    => $tgl,
			'aktifitas'     => 'started',
			'note_ticket'   => $information,
			'tgl_input'     => $today,
			'email_input'   => $email,
			'foto_problem'	=> "no-image.png"

		);

		$this->M_Helpdesk->saveTicketTS($data, 'tb_helpdesk');
		if ($this->db->affected_rows()) {
			if ($checkbox ==  "Yes") {
				$this->send($user, $noticket, $status, $email, $information, $complain, $tipecomplain); // Eksekusi Fungsi kirim email   
			}
			$this->M_Helpdesk->addHistoryHelpdesk($datahist, 'tb_helpdesk_history');
			$this->session->set_flashdata('flash', 'successfully');
			redirect('Welcome');
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('Welcome');
		}
	}

	// Save Ticket Email Request
	public function saveTicketER()
	{
		$noticket 		= $this->input->post('ticket', TRUE);
		$email 			= $this->input->post('email', TRUE);
		$sbu 			= $this->input->post('sbu', TRUE);
		$dept 			= $this->input->post('dept', TRUE);
		$status 		= $this->input->post('status', TRUE);
		$tipecomplain 	= $this->input->post('complain', TRUE);
		$user 			= $this->input->post('user', TRUE);
		$firstname 		= $this->input->post('firstname', TRUE);
		if ($this->input->post('lastname', TRUE) == "") {
			$lastname = "-";
		} else {
			$lastname = $this->input->post('lastname', TRUE);
		};
		$phone 			= $this->input->post('phone', TRUE);
		$infosbu		= $this->input->post('infosbu', TRUE);
		$infodept		= $this->input->post('infodept', TRUE);
		$position		= $this->input->post('position', TRUE);
		$information	= $firstname . ";" . $lastname . ";" . $phone . ";" . $infosbu . ";" . $infodept . ";" . $position;
		$checkbox 		= $this->input->post('checkbox', TRUE);
		$today      	= gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$tgl        	= gmdate("Y-m-d", time() + 60 * 60 * 7);
		// $status     = "WAITING";
		if ($tipecomplain == "TS") {
			$complain 	= "Trouble Shooting";
		} else if ($tipecomplain == "ER") {
			$complain 	= "Email Request";
		} else if ($tipecomplain == "AR") {
			$complain 	= "Asset Request";
		}

		$data = array(
			'no_ticket'		=> $noticket,
			'nama'			=> $user,
			'email'			=> $email,
			'sbu'			=> $sbu,
			'departemen'	=> $dept,
			'jenis_komplain' => $tipecomplain,
			'informasi'		=> $information,
			'status'		=> $status,
			'input_tgl'		=> $today,
			'update_tgl'	=> $today
		);

		// History Disimpan setelah user mulai input tiket
		$datahist = array(
			'no_ticket'     => $noticket,
			'status'        => $status,
			'tgl_ticket'    => $tgl,
			'aktifitas'     => 'started',
			'note_ticket'   => $information,
			'tgl_input'     => $today,
			'email_input'   => $email,
			'foto_problem'	=> "no-image.png"

		);

		$this->M_Helpdesk->saveTicketTS($data, 'tb_helpdesk');
		if ($this->db->affected_rows()) {
			if ($checkbox ==  "Yes") {
				$this->send($user, $noticket, $status, $email, $information, $complain, $tipecomplain); // Eksekusi Fungsi kirim email   
			}
			$this->M_Helpdesk->addHistoryHelpdesk($datahist, 'tb_helpdesk_history');
			$this->session->set_flashdata('flash', 'successfully');
			redirect('Welcome');
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('Welcome');
		}
	}

	// Save Ticket Asset Request
	public function saveTicketAR()
	{
		$noticket 		= $this->input->post('ticket', TRUE);
		$email 			= $this->input->post('email', TRUE);
		$sbu 			= $this->input->post('sbu', TRUE);
		$dept 			= $this->input->post('dept', TRUE);
		$status 		= $this->input->post('status', TRUE);
		$tipecomplain 	= $this->input->post('complain', TRUE);
		$user 			= $this->input->post('user', TRUE);
		$typeasset 		= $this->input->post('typeasset', TRUE);
		$qty 			= $this->input->post('qty', TRUE);
		$unittype		= $this->input->post('unittype', TRUE);
		$addinformation	= $this->input->post('addinformation', TRUE);
		$information	= $typeasset . ";" . $qty . ";" . $unittype . ";" . $addinformation;
		$checkbox 		= $this->input->post('checkbox', TRUE);
		$today      	= gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$tgl        	= gmdate("Y-m-d", time() + 60 * 60 * 7);
		// $status     = "WAITING";
		if ($tipecomplain == "TS") {
			$complain 	= "Trouble Shooting";
		} else if ($tipecomplain == "ER") {
			$complain 	= "Email Request";
		} else if ($tipecomplain == "AR") {
			$complain 	= "Asset Request";
		}

		$data = array(
			'no_ticket'		=> $noticket,
			'nama'			=> $user,
			'email'			=> $email,
			'sbu'			=> $sbu,
			'departemen'	=> $dept,
			'jenis_komplain' => $tipecomplain,
			'informasi'		=> $information,
			'status'		=> $status,
			'input_tgl'		=> $today,
			'update_tgl'	=> $today
		);

		// History Disimpan setelah user mulai input tiket
		$datahist = array(
			'no_ticket'     => $noticket,
			'status'        => $status,
			'tgl_ticket'    => $tgl,
			'aktifitas'     => 'started',
			'note_ticket'   => $information,
			'tgl_input'     => $today,
			'email_input'   => $email,
			'foto_problem'	=> "no-image.png"

		);

		$this->M_Helpdesk->saveTicketTS($data, 'tb_helpdesk');
		if ($this->db->affected_rows()) {
			if ($checkbox ==  "Yes") {
				$this->send($user, $noticket, $status, $email, $information, $complain, $tipecomplain); // Eksekusi Fungsi kirim email   
			}
			$this->M_Helpdesk->addHistoryHelpdesk($datahist, 'tb_helpdesk_history');
			$this->session->set_flashdata('flash', 'successfully');
			redirect('Welcome');
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('Welcome');
		}
	}

	// TRACKING PAGE
	public function tracking()
	{
		$data = array(
			'title' 	=> 'ICT Helpdesk - Tracking',
			// 'row'		=> $this->M_Helpdesk->loadEmailUser(),
			// 'rowsbu'	=> $this->M_Helpdesk->loadSbu(),
			// 'rowdept' 	=> $this->M_Helpdesk->loadDept(),
			// 'rowgood'	=> $this->M_Helpdesk->loadGoods()
		);
		$this->load->view('tracking', $data);
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
								<span class='time'>" . date('d-m-y', strtotime($data['tgl_input'])) . "</span>
							</div>

							<div class='timeline-icon'>
								<a href='javascript:;'>&nbsp;</a>
							</div>

							<div class='timeline-body'>
								<div class='timeline-header'>
									<span class='userimage'><img src=" . base_url() . "assets/avatar/" . $data['avatar'] . " alt></span>
									<span class='username'><a href='javascript:;'>" . strtoupper($data['user_name']) . "</a> <small></small></span>
									
								</div>
								<div>";
					if ($data['jenis_komplain'] == "ER") {
						echo "<p>Firstname : " . $detail[0] . " </br> Lastname: " . $detail[1] . " </br> Phone : " . $detail[2] . " </br> SBU : " . $detail[3] . " </br> Departemen : " . $detail[4] . " </br> Position : " . $detail[5] . "</p>";
					} else if ($data['jenis_komplain'] == "AR") {
						echo "<p>Request Type : " . $detail[0] . " <br> Quantity : " . $detail[1] . " " . $detail[2] . " <br> Information : " . $detail[3] . "</p>";
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
		// POST data
		// $postData = $this->input->post();

		// // get data
		// $data = $this->M_Helpdesk->getDbTicket($postData);

		// echo json_encode($data);
	}


	// ?Dashboard

	public function dashboard()
	{
		$data = array(
			'title'	=>	'ICT Helpdesk - Dashboard',

		);
		$this->template->load('template', 'dashboard', $data);
	}


	// // EMAIL NOTIF UNTUK TERLAMBAT
	public function send($user, $noticket, $status, $email, $information, $complain, $tipecomplain)
	{

		if ($tipecomplain == "TS") {
			$isiemail = $information;
		} else if ($tipecomplain == "ER") {
			$pecah = explode(";", $information);
			$isiemail = "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
		} else if ($tipecomplain == "AR") {
			$pecah = explode(";", $information);
			$isiemail = "Type of Assets : " . $pecah[0] . "<br> Quantity : " . $pecah[1] . " " . $pecah[2] . "<br> Additional Info : " . $pecah[3];
		}

		// Konfigurasi email
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.zoho.com',
			'smtp_user' => 'ict-helpdesk@biasmandirigroup.id',  // Email
			'smtp_pass'   => '4yo#Indonesia8154',  // Password
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];

		// Load library email dan konfigurasinya
		$this->load->library('email', $config);

		// Email Content
		$this->email->from($config['smtp_user'], 'Ict Helpdesk Notification');
		$this->email->to($email);
		$this->email->cc('tofan.bakti@biasmandirigroup.id');
		$this->email->subject('Notification New Ticket Input No. ' . $noticket);
		$this->email->message('
		<html>
			<head><meta name="Microsoft Theme 2.00" content="Studio 011"><META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=us-ascii"><meta name=Generator content="Microsoft Word 15 (filtered medium)">
				<style>
				/* Font Definitions */
				@font-face
					{font-family:"Cambria Math";
					panose-1:2 4 5 3 5 4 6 3 2 4;}
				@font-face
					{font-family:Calibri;
					panose-1:2 15 5 2 2 2 4 3 2 4;}
				@font-face
					{font-family:"Century Gothic";
					panose-1:2 11 5 2 2 2 2 2 2 4;}
				/* Style Definitions */
				p.MsoNormal, li.MsoNormal, div.MsoNormal
					{margin:0cm;
					margin-bottom:.0001pt;
					font-size:12.0pt;
					font-family:"Arial",sans-serif;
					color:black;}
				
				</style>
			</head>
			<body>

				<table class=MsoTableTheme border=0 cellspacing=0 cellpadding=0 width=0 style="width:895.45pt;border-collapse:collapse;border:none">
					<tr style="height:33.65pt">
						<td width=1194 style="width:895.45pt;background:#aba6ab;padding:0cm 5.4pt 0cm 5.4pt;height:33.65pt">
							<p class=MsoNormal>
							<b><u><span style="font-size:18.0pt;font-family:"Calibri",sans-serif;color:white">ICT Helpdesk</span></u></b>
							<b><u><span style="font-size:16.0pt;font-family:"Calibri",sans-serif;color:white"><o:p></o:p></span></u></b>
							</p>
						</td>
					</tr>
					<tr style="height:26.95pt">
						<td width=1194 valign=top style="width:895.45pt;padding:0cm 5.4pt 0cm 5.4pt;height:26.95pt">
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">Dear ' . $user . '</span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Good Morning, <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">Thank you for your reaching out to your ICT Support Team.<o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">We confirm an opened support ticket below: Today you have been finished input on ICT Helpdesk Application with Ticket Number ' . $noticket . ', about <strong><span style="font-family:"Century Gothic",sans-serif">' . $complain . '</span></strong> current status is ' . $status . '.  The detail information is: </span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Reference Number :' . $noticket . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Request Details :' . $isiemail . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Status :' . $status . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Date :' . $status . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Thank you, we will follow up your ticket as soon as possible.</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p>
								</span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Respectfully yours.</span>
							</p>
							<p class=MsoNormal><span style="font-size:11.0pt;font-family:"Calibri",sans-serif;color:#3B3838"><o:p>&nbsp;</o:p></span></p>
						</td>
					</tr>
					<tr style="height:26.95pt">
						<td width=1194 valign=top style="width:895.45pt;padding:0cm 5.4pt 0cm 5.4pt;height:26.95pt">
							<p class=MsoNormal>
								<span style="font-size:11.0pt;font-family:"Century Gothic",sans-serif">ICT Team <o:p></o:p></span>
								<span style="font-size:11.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:11.0pt;font-family:"Century Gothic",sans-serif"><a href="#">Login ICT-Helpdesk App</a><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-size:11.5pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p><p class=MsoNormal><span style="font-size:11.5pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
						</td>
					</tr>
				</table>
			</body>
		</html>');

		//Send Email
		$this->email->send();
	}
}
