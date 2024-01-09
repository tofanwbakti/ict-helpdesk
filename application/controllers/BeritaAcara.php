<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BeritaAcara extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// cek_nologin();
		$this->load->model('M_BeritaAcara');
		$this->load->model('M_Troubleshoot');
	}

	// Proses Logout start
	function signout()
	{
		// $this->session->set_flashdata('flash', 'finished');
		$this->session->sess_destroy();
		//$url=base_url('');
		redirect('Auth');
	}


	// BERITA ACARA
	public function formBA()
	{
		$alamat1 = $this->uri->segment(3);
		$alamat2 = $this->uri->segment(4);
		$alamat3 = $this->uri->segment(5);
		$alamat4 = $this->uri->segment(6);
		// $alamat1 = decrypt_url($this->uri->segment(3));
		// $alamat2 = $this->uri->segment(4);
		// $alamat3 = decrypt_url($this->uri->segment(5));
		// $alamat4 = decrypt_url($this->uri->segment(6));
		$noba =   $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;
		$data = array(
			'title'		=> "ICT Helpdesk - Berita Acara",
			'noba' 		=> $noba,
			// 'captcha'	=> $this->recaptcha->getWidget(),
			// 'script_captcha' => $this->recaptcha->getScriptTag(),
			// 'row'		=> $this->M_Troubleshoot->getDataTicket($tahun),
			'rowuser'	=> $this->M_Troubleshoot->getUser()
		);
		$this->template->load('template', 'BeritaAcara/beritaacara', $data);
	}

	// Load Data Item
	public function get_data_item()
	{
		$noba	= $this->input->get('noba');
		$data	= $this->M_BeritaAcara->get_BA_bynoba($noba);
		echo json_encode($data);
	}

	// Load Data Item
	public function get_ask_apv()
	{
		$noba	= $this->input->get('noba');
		if ($noba != '') {
			$cek = $this->db->query("SELECT * FROM tb_berita_acara_detail WHERE no_ba_detail='$noba'");
			if ($cek->num_rows() > 0) {
				echo "1";
			} else {
				echo "0";
			}
		}
	}

	// Load Data History Berita Acara
	public function get_data_history()
	{
		$noba	= $this->input->get('noba');
		$data	= $this->M_BeritaAcara->get_historyBA_bynoba($noba);
		echo json_encode($data);
	}

	// Generate no Item ID 
	public function genItem_ID()
	{
		// $period		= $this->input->post("periode", TRUE);
		// $labeltahun	= gmdate("m/Y", time() + 60 * 60 * 7);

		$query = $this->db->query("SELECT MAX(item_id) as maxKode FROM tb_berita_acara_detail LIMIT 1");
		$row = $query->row_array();
		$kode = $row['maxKode'];
		$nourut = (int)substr($kode, 5, 3);
		$nourut++;
		$kodebaru = 'ITEM-' . sprintf("%03s", $nourut);
		echo $kodebaru;

		return $kodebaru;
	}

	//  Add Item to Tabel BA
	public function add_Item_BA()
	{
		$itemid		= $this->genItem_ID();
		$noba		= $this->input->post('noba', TRUE);
		$equipment	= $this->input->post('equipment', TRUE);
		$serial		= $this->input->post('sn', TRUE);
		$condition	= $this->input->post('condition', TRUE);
		$recom		= $this->input->post('recom', TRUE);
		$today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$user 		= $this->fungsi->user_login()->user_email;

		$hasil = $this->db->query("INSERT INTO tb_berita_acara_detail (item_id,no_ba_detail,equipment_detail,sn_detail,condition_detail,recommendation,create_by_detail,input_date)VALUES('$itemid','$noba','$equipment','$serial','$condition','$recom','$user','$today')");

		return $hasil;
	}

	//  Update Item to Tabel BA
	public function update_Item_BA()
	{
		$itemid		= $this->input->post('itemid', TRUE);
		$equipment	= $this->input->post('equipment', TRUE);
		$serial		= $this->input->post('sn', TRUE);
		$condition	= $this->input->post('condition', TRUE);
		$recom		= $this->input->post('recom', TRUE);

		$hasil = $this->db->query("UPDATE tb_berita_acara_detail SET equipment_detail='$equipment',sn_detail='$serial',condition_detail='$condition',recommendation='$recom' WHERE item_id='$itemid'");

		return $hasil;
	}

	//  Update Item to Tabel BA
	public function delete_Item_BA()
	{
		$itemid		= $this->input->post('itemid', TRUE);

		$hasil = $this->db->query("DELETE FROM tb_berita_acara_detail WHERE item_id='$itemid'");

		return $hasil;
	}

	function get_barang()
	{
		$itemid = $this->input->get('id');
		$data = $this->M_BeritaAcara->get_item_by_kode($itemid);
		echo json_encode($data);
	}

	// Ask Approval for BA
	public function ask_Approval()
	{
		$this->load->helper('string');
		$noba		= $this->input->post('NoBa', TRUE);
		$link		= explode("/", $noba);
		$approver 	= $this->input->post('approver');
		$apv 		= implode(",", $this->input->post('approver'));
		$code		= random_string('nozero', 6);

		$today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$user 		= $this->fungsi->user_login()->user_email;
		$user_name	= $this->fungsi->user_login()->user_name;
		// echo $noba . ' / ' . $apv . ' / ' . count($approver);

		// echo random_string('nozero', 6);

		$data = array('approver' => count($approver),);

		$where = array('no_ba' => $noba);

		// Array untuk table berita acara history
		$datahistory = array(
			'no_ba'		=> $noba,
			'activity'	=> "Ask Aproval",
			'user_input' => $user,
			'input_date' => $today
		);

		$dataapprover = array(
			'no_ba'		=> $noba,
			'approver'	=> $apv,
			'code'		=> $code,
		);

		$this->M_BeritaAcara->ask_Approval($data, $where, 'tb_berita_acara');
		if ($this->db->affected_rows()) {
			$this->sendBA($apv, $noba, $user_name, $code);
			// simpan data history berita acara
			$this->M_BeritaAcara->save_history_BA($datahistory, 'tb_berita_acara_history');
			// simpan data approver & code verifikasi
			$this->M_BeritaAcara->save_approver($dataapprover, 'tb_berita_acara_approver');
			$this->session->set_flashdata('flash', 'complete');
			redirect('BeritaAcara/formBA/' . $noba);
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('BeritaAcara/formBA/' . $noba);
		}
	}


	// // EMAIL NOTIF UNTUK IN PROGRESS
	public function sendBA($apv,  $noba, $user_name, $code)
	{
		$link = explode("/", $noba);
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
		$this->email->to($apv);
		// $this->email->cc($user);
		$this->email->subject('Approval Berita Acara Requested ' . $noba);
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
					font-size:10.0pt;
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
							<span style="font-family:"Century Gothic",sans-serif">Dear Sir/Madam, </span>
							<span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Good Day to you, <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">This is a system generated request for berita acara No. <strong>' . $noba . '</strong><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">This approval request is submitted by ' . $user_name . '</span>
							<span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>

							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:20.0pt;letter-spacing: 3px;">' . $code . '</p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">Kindly input the verification code to the form approval.</span></p>
							<p class=MsoNormal>Click the button below to process the approval request.</p>
							<p  class=MsoNormal><a class="button" href="http://localhost:8080/ict-helpdesk/Welcome/approval/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) . '" target="_blank" style="background:#673de6;color: #ffffff;border-radius:5px">
								Approval           
							</a></p>
														
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:10.0pt">To review the berita acara please click <a href="http://localhost:8080/ict-helpdesk/ReportPdf/generate_formBA/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) . '" target="_blank" >here</a>.</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif">If you need help, or you have any other questions, feel free to email ICT department.</span></p>
							
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

	// EMAIL REQUEST FORM
	// BERITA ACARA
	public function formRF()
	{
		$alamat1 = decrypt_url($this->uri->segment(3));
		$alamat2 = $this->uri->segment(4);
		$alamat3 = decrypt_url($this->uri->segment(5));
		$alamat4 = decrypt_url($this->uri->segment(6));

		$noba = $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;
		// echo $noba . "<br>";
		// echo "$alamat1/$alamat2/$alamat3/$alamat4";
		$data = array(
			'title'		=> "ICT Helpdesk - Berita Acara",
			'noba' 		=>  $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4,
			'rowuser'	=> $this->M_Troubleshoot->getUser(),
			// 'rowdocba'		=> $this->M_BeritaAcara->get_Sum_DocBa($noba)
		);
		$this->template->load('template', 'BeritaAcara/emailrequestform', $data);
	}

	// Ask Approval for Email RF
	public function ask_Approval_ERF()
	{
		$this->load->helper('string');
		$noba		= $this->input->post('NoBa', TRUE);
		$sumdoc		= $this->input->post('sumdoc', TRUE);
		$link		= explode("/", $noba);
		$approver 	= $this->input->post('approver');
		$apv 		= implode(",", $this->input->post('approver'));
		$code		= random_string('nozero', 6);
		$docba		= floatval($sumdoc) + count($approver);

		$today      = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
		$user 		= $this->fungsi->user_login()->user_email;
		$user_name	= $this->fungsi->user_login()->user_name;
		// echo $noba . ' / ' . $apv . ' / ' . count($approver) . ' / ' . $docba . ' / ';

		// echo random_string('nozero', 6);

		$data = array('approver' => $docba,);

		$where = array('no_ba' => $noba);

		// Array untuk table berita acara history
		$datahistory = array(
			'no_ba'		=> $noba,
			'activity'	=> "Ask Aproval",
			'user_input' => $user,
			'input_date' => $today
		);

		$dataapprover = array(
			'no_ba'		=> $noba,
			'approver'	=> $apv,
			'code'		=> $code,
		);

		$this->M_BeritaAcara->ask_Approval($data, $where, 'tb_berita_acara');
		if ($this->db->affected_rows()) {
			$this->sendERF($apv, $noba, $user_name, $code); // kirim parameter untuk notifikasi email
			// simpan data history berita acara
			$this->M_BeritaAcara->save_history_BA($datahistory, 'tb_berita_acara_history');
			// simpan data approver & code verifikasi
			$this->M_BeritaAcara->save_approver($dataapprover, 'tb_berita_acara_approver');
			$this->session->set_flashdata('flash', 'complete');
			redirect('BeritaAcara/formRF/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]));
		} else {
			$this->session->set_flashdata('flash_error', 'failed');
			redirect('BeritaAcara/formRF/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]));
		}
	}

	// // EMAIL NOTIF UNTUK IN PROGRESS
	public function sendERF($apv,  $noba, $user_name, $code)
	{
		$link = explode("/", $noba);
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
		$this->email->to($apv);
		// $this->email->cc($user);
		$this->email->subject('Approval Berita Acara Requested ' . $noba);
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
					font-size:10.0pt;
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
							<span style="font-family:"Century Gothic",sans-serif">Dear Sir/Madam, </span>
							<span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
								<span style="font-family:"Century Gothic",sans-serif">Good Day to you, <o:p></o:p></span>
							</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">This is a system generated request for berita acara No. <strong>' . $noba . '</strong><o:p>&nbsp;</o:p></span></p>
							<p class=MsoNormal>
							<span style="font-family:"Century Gothic",sans-serif">This approval request is submitted by ' . $user_name . '</span>
							<span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"> <o:p></o:p></span>
							</p>

							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:20.0pt;letter-spacing: 3px;">' . $code . '</p>
							<p class=MsoNormal><span style="font-family:"Century Gothic",sans-serif">Kindly input the verification code to the form approval.</span></p>
							<p class=MsoNormal>Click the button below to process the approval request.</p>
							<p  class=MsoNormal><a class="button" href="http://localhost:8080/ict-helpdesk/Welcome/approval/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) . '" target="_blank" style="background:#673de6;color: #ffffff;border-radius:5px">
								Approval           
							</a></p>
														
							<p class=MsoNormal><span style="font-size:14.0pt;font-family:"Century Gothic",sans-serif"><o:p>&nbsp;</o:p></span></p>
							<p style="font-size:10.0pt">To review the berita acara please click <a href="http://localhost:8080/ict-helpdesk/ReportPdf/generate_formRF/' . encrypt_url($link[0]) . '/' . $link[1] . '/' . encrypt_url($link[2]) . '/' . encrypt_url($link[3]) . '" target="_blank" >here</a>.</p>
							<p class=MsoNormal><span style="font-size:10.0pt;font-family:"Century Gothic",sans-serif">If you need help, or you have any other questions, feel free to email ICT department.</span></p>
							
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
