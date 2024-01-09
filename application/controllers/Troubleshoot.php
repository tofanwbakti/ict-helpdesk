<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Troubleshoot extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_nologin();
		$this->load->model('M_Troubleshoot');
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
			'title'		=> "ICT Helpdesk - Trouble Shooting",
			'captcha'	=> $this->recaptcha->getWidget(),
			'script_captcha' => $this->recaptcha->getScriptTag(),
			'row'		=> $this->M_Troubleshoot->getDataTicket($tahun),
			'rowtix'		=> $this->M_Troubleshoot->getNoTicket($tahun),
			// 'rowuser'	=> $this->M_Troubleshoot->getUser()
		);
		$this->template->load('template', 'TS/dashboardTS', $data);
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
					echo "<p>" . $data['note_ticket'] . "</p>";

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


	public function updateTask()
	{
		$email 	= $this->input->post('email', TRUE);
		$nama 	= $this->input->post('nama', TRUE);
		$noticket 	= $this->input->post('noticket', TRUE);
		$info 		= $this->input->post('info', TRUE);
		$status 	= $this->input->post('status', TRUE);
		$tipecomplain 	= $this->input->post('complain', TRUE);
		$tgl        = gmdate("Y-m-d", time() + 60 * 60 * 7);
		$today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$user 		= $this->fungsi->user_login()->user_email;


		if ($status == "PROCESSING") {
			$aktifitas = "proceed";
			$step = "IN PROGRESS";
		} else if ($status == "FINISH") {
			$aktifitas = "finished";
			$step = "COMPLETED";
		}

		$config['upload_path']		= './uploads/'; //lokasi folder penyimpanan
		$config['allowed_types']   	= 'jpeg|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name']		= $noticket . '_' . $status; //penamaan file
		$config['max_size']			= 5120; //maksimal ukuran 5 Mb
		$config['overwrite']		= TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!empty($_FILES['filePhoto']['name'])) {
			if ($this->upload->do_upload('filePhoto')) {
				$gbr 	= $this->upload->data();
				$gambar	= $gbr['file_name'];
				$data = array(
					'status' => $status,
					'update_tgl' => $today
				);

				$where  = array('no_ticket' => $noticket);

				// History Disimpan setelah user mulai input tiket
				$datahist = array(
					'no_ticket'     => $noticket,
					'status'        => $status,
					'tgl_ticket'    => $tgl,
					'aktifitas'     => $aktifitas,
					'note_ticket'   => $info,
					'tgl_input'     => $today,
					'email_input'	=> $user,
					'foto_problem'	=> $gambar
				);
			} else {
				$error =  $this->upload->display_errors();
				echo print_r($error);
			}
		} else {
			$data = array(
				'status' => $status,
				'update_tgl' => $today
			);

			$where  = array('no_ticket' => $noticket);

			// History Disimpan setelah user mulai input tiket
			$datahist = array(
				'no_ticket'     => $noticket,
				'status'        => $status,
				'tgl_ticket'    => $tgl,
				'aktifitas'     => $aktifitas,
				'note_ticket'   => $info,
				'tgl_input'     => $today,
				'email_input'	=> $user,
				'foto_problem'	=> "no-image.png"
			);
		}

		$this->M_Troubleshoot->updateTask('tb_helpdesk', $data, $where);
		if ($this->db->affected_rows()) {
			$this->M_Troubleshoot->addHistoryHelpdesk($datahist, 'tb_helpdesk_history');
			if ($status == "PROCESSING") {

				$this->send($email, $nama, $noticket, $step, $info, $today, $tipecomplain, $user); // Eksekusi Fungsi kirim email   
			} else {
				$this->send2($email, $nama, $noticket, $step, $info, $today, $tipecomplain, $user); // Eksekusi Fungsi kirim email   

			}
			$this->session->set_flashdata('flash', 'complete');
			redirect('Troubleshoot');
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('Troubleshoot');
		}
	}

	// update Task
	public function OldupdateTask()
	{
		$noticket 	= $this->input->post('noticket', TRUE);
		$info 		= $this->input->post('info', TRUE);
		$status 	= $this->input->post('status', TRUE);
		$tgl        = gmdate("Y-m-d", time() + 60 * 60 * 7);
		$today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$user 		= $this->fungsi->user_login()->user_email;
		if ($status == "PROCESSING") {
			$aktifitas = "process";
		} else if ($status == "FINISH") {
			$aktifitas = "finish";
		}

		$config['upload_path']		= './uploads/'; //lokasi folder penyimpanan
		$config['allowed_types']   	= 'jpeg|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
		$config['file_name']		= $noticket . '_' . $status; //penamaan file
		$config['max_size']			= 5120; //maksimal ukuran 5 Mb
		$config['overwrite']		= TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!empty($_FILES['file-photo']['name'])) {
			if ($this->upload->do_upload('file-photo')) {
				$gbr 	= $this->upload->data();
				$gambar	= $gbr['file_name'];
				$data = array(
					'status' => $status
				);

				$where  = array('no_ticket' => $noticket);

				// History Disimpan setelah user mulai input tiket
				$datahist = array(
					'no_ticket'     => $noticket,
					'status'        => $status,
					'tgl_ticket'    => $tgl,
					'aktifitas'     => $aktifitas,
					'note_ticket'   => $info,
					'tgl_input'     => $today,
					'email_input'	=> $user,
					'foto_problem'	=> $gambar
				);
			} else {
				$error =  $this->upload->display_errors();
				echo print_r($error);
			}
		} else {
			$data = array(
				'status' => $status
			);

			$where  = array('no_ticket' => $noticket);

			// History Disimpan setelah user mulai input tiket
			$datahist = array(
				'no_ticket'     => $noticket,
				'status'        => $status,
				'tgl_ticket'    => $tgl,
				'aktifitas'     => $aktifitas,
				'note_ticket'   => $info,
				'tgl_input'     => $today,
				'email_input'	=> $user,
				'foto_problem'	=> "no-image.png"
			);
		}

		$this->M_Troubleshoot-- > updateTask('tb_helpdesk', $data, $where);
		if ($this->db->affected_rows()) {
			$this->M_Helpdesk->addHistoryHelpdesk($datahist, 'tb_helpdesk_history');
			$this->session->set_flashdata('flash', 'complete');
			redirect('Troubleshoot');
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('Troubleshoot');
		}
	}

	// Propose Berita Acara
	public function proposeBA()
	{
		$noba		= $this->input->post('NoBa', TRUE);
		$noticket 	= $this->input->post('noticket-BA', TRUE);
		// $pecah = explode("/", $value->no_ba);
		// $link =	encrypt_url($pecah[0]) . '/' . $pecah[1] . '/' . encrypt_url($pecah[2]) . '/' . encrypt_url($pecah[3]);

		// $approver 	= $this->input->post('approver');
		// $approver2 = implode(",", $this->input->post('approver'));

		$info		= $this->input->post('infoBA', TRUE);

		// $today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		// $user 		= $this->fungsi->user_login()->user_email;

		$dataBa = array(
			'no_ba'			=> $noba,
			'no_ticket'		=> $noticket,
			'notes'			=> $info,
			'create_by'		=> $this->fungsi->user_login()->user_email,
			'approver'		=> '0',
			'status_ba'		=> "WAITING",
			'input_date'	=> gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7)
		);

		$data = array(
			'doc_ba' => "Y"
		);

		$where  = array('no_ticket' => $noticket);

		$this->M_Troubleshoot->proposeBA($dataBa, 'tb_berita_acara');
		if ($this->db->affected_rows()) {
			// $this->sendBA($approver2, $noticket, $noba, $recomendation);
			$this->M_Troubleshoot->updateTask('tb_helpdesk', $data, $where);
			$this->session->set_flashdata('flash', 'complete');
			// redirect('Troubleshoot');
			redirect('BeritaAcara/formBA/' . $noba);
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			// redirect('Troubleshoot');
			redirect('BeritaAcara/formBA/' . $noba);
		}

		// echo $noba . "<br>" . $noticket . "<br>" . $approver2 . "<br>" . $info . "<br>" . $equipment . "<br>" . $serial . "<br>" . $condition . "<br>" . $recomendation . "<br>" . count($approver);

	}

	// Generate No Berita Acara
	// Generate no Ticket 
	public function getNoBeritaAcara()
	{
		$period		= $this->input->post("period", TRUE);
		$labeltahun	= gmdate("m/Y", time() + 60 * 60 * 7);
		$lbdeft		= "BA/" . $labeltahun;

		$query = $this->db->query("SELECT MAX(no_ba) as maxKode FROM tb_berita_acara WHERE no_ba LIKE '%$lbdeft' LIMIT 1");
		$row = $query->row_array();
		$kode = $row['maxKode'];
		$nourut = (int)substr($kode, 0, 4);
		$nourut++;
		// $kodebaru = 'IBA' . $periode . '-' . sprintf("%04s", $nourut);
		$kodebaru = sprintf("%04s", $nourut) . '/' . 'ICT-BA' . '/' . $labeltahun;
		echo $kodebaru;

		return $kodebaru;
	}

	// Check Reuse Berita Acara Number
	public function checkBA()
	{
		$notix = $this->input->post('notix');
		if ($email != '') {
			$cek = $this->db->query("SELECT * FROM tb_berita_acara WHERE no_ticket='$notix'");
			if ($cek->num_rows() > 0) {
				echo "1";
			} else {
				echo "0";
			}
		}
	}

	// Searching Ticket
	public function searchTix_Cat()
	{
		$category = $this->input->post('category', true);
		$selectdate = $this->input->post('daterange', TRUE);
		$daterange = explode(" to ", $this->input->post('daterange', TRUE));
		if (empty($daterange[1])) {
			$akhir = "0";
		} else {
			$akhir = $daterange[1];
		}

		// echo $category . '<br>' . var_dump($daterange);
		// echo $category . '<br>' . $daterange[0] . '<br>' .  $akhir;

		$tahun = gmdate("Y-m", time() + 60 * 60 * 7);
		$data = array(
			'title'		=> "ICT Helpdesk - Trouble Shooting",
			'row'		=> $this->M_Troubleshoot->getDataTicketFiltered($daterange[0], $akhir, $category),
			'rowtix'	=> $this->M_Troubleshoot->getNoTicketFiltered($daterange[0], $akhir, $category),
			'category'	=> $category,
			'awal' => $daterange[0],
			'akhir'	=> $akhir,
			// 'rowuser'	=> $this->M_Troubleshoot->getUser()
		);
		$this->template->load('template', 'TS/dashboardTS-filtered', $data);
	}




	// // EMAIL NOTIF UNTUK IN PROGRESS
	public function send($email, $nama, $noticket, $step, $info, $today, $tipecomplain, $user)
	{

		if ($tipecomplain == "TS") {
			$isiemail = "Request Detail :" . $info;
		} else if ($tipecomplain == "ER") {
			$pecah = explode(";", $info);
			$isiemail = "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
		} else if ($tipecomplain == "AR") {
			$pecah = explode(";", $info);
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
		$this->email->cc($user);
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
									
					.button {
						padding: 8px 12px;
						border: 1px solid #673de6;
						border-radius: 2px;
						font-family: Helvetica, Arial, sans-serif;
						font-size: 14px;
						color: #ffffff; 
						text-decoration: none;
						font-weight: bold;
						display: inline-block;  
					}
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
							<span style="font-family:"Century Gothic",sans-serif">Dear ' . $nama . '</span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Good Morning, <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">Thank you for your patience. Your request is currently in progress. Our ICT team is diligently working on it, and we will keep you updated on any developments.<o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">In the meantime, you can track the status of your request using the ticket reference number periode.</span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Reference Number :  <strong>' . $noticket . '</strong></span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> ' . $isiemail . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Status : ' . $step . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Date : ' . date("d-m-Y H:i:s", strtotime($today)) . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:10.0pt">Use the reference number to tracking your ticket.</p>
							<a class="button" href="http://localhost:8080/ict-helpdesk/Welcome/tracking/" target="_blank" style="background:#673de6;color: #ffffff;border-radius:5px">
								Tracking your ticket here           
							</a>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>

							
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Thank you very much.</span>
								<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif">
									<o:p></o:p>
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

	// // EMAIL NOTIF UNTUK FNINSH
	public function send2($email, $nama, $noticket, $step, $info, $today, $tipecomplain, $user)
	{

		if ($tipecomplain == "TS") {
			$isiemail = $info;
		} else if ($tipecomplain == "ER") {
			$pecah = explode(";", $info);
			$isiemail = "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
		} else if ($tipecomplain == "AR") {
			$pecah = explode(";", $info);
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
		$this->email->cc($user);
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
					.button {
						padding: 8px 12px;
						border: 1px solid #673de6;
						border-radius: 2px;
						font-family: Helvetica, Arial, sans-serif;
						font-size: 14px;
						color: #ffffff; 
						text-decoration: none;
						font-weight: bold;
						display: inline-block;  
					}
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
							<span style="font-family:"Century Gothic",sans-serif">Dear ' . $nama . '</span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Good Morning, <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">We are pleased to inform you that your job request has been successfully complete.<o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">Our team has worked diligently to address your request, and we are excited to share the following update :</span>
							<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Reference Number :  <strong>' . $noticket . '</strong></span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Request Details : ' . $isiemail . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Status : ' . $step . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif"> Completion Date : ' . date("d-m-Y H:i:s", strtotime($today)) . '</span><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:10.0pt">Use the reference number to tracking your ticket.</p>
							<a class="button" href="http://localhost:8080/ict-helpdesk/Welcome/tracking/" target="_blank" style="background:#673de6;color: #ffffff;border-radius:5px">
								Tracking your ticket here           
							</a>
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Thank you very much.</span>
								<span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif">
									<o:p></o:p>
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
