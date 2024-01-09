<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportPdf extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek_nologin();
        $this->load->library('pdf');
    }

    // Print Track history
    public function printTrack()
    {
        $alamat1 = decrypt_url($this->uri->segment(3));
        $alamat2 = $this->uri->segment(4);
        $alamat3 = decrypt_url($this->uri->segment(5));
        $alamat4 = $this->uri->segment(6);
        $noticket =  $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;

        $this->db->select('*');
        $this->db->from('tb_helpdesk_history');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk_history.email_input', 'left');
        $this->db->join('tb_departemen', 'tb_departemen.id_dept=tb_user.user_dept', 'left');
        // $this->db->join('tb_helpdesk', 'tb_helpdesk.email=tb_helpdesk_history.email_input', 'left');
        $this->db->like('tb_helpdesk_history.no_ticket', $noticket);
        $this->db->order_by('tb_helpdesk_history.seq_no', "ASC");
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Tracking Helpdesk / History Ticket');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(270, 7, 'Tracking Helpdesk / History Ticket no. ' . $noticket, 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User Name', 1, 0, 'C', 1);
        $pdf->Cell(15, 8, 'Sbu', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(80, 8, 'Note', 1, 0, 'C', 1);
        $pdf->Cell(25, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Activity', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {
            $subtix = substr($data->no_ticket, 9, 2);
            if ($data->aktifitas == "started") {
                $step = "TO START";
                // if ($subtix = "ER") {
                //     $pecah = explode(";", $data->note_ticket);
                //     $labelnote = "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
                // } else if ($subtix == "AR") {
                //     $pecah = explode(";", $data->note_ticket);
                //     $labelnote = "Type of Assets : " . $pecah[0] . "<br> Quantity : " . $pecah[1] . " " . $pecah[2] . "<br> Additional Info : " . $pecah[3];
                // } else if ($subtix == "TS") {
                //     $labelnote = $data->note_ticket;
                // }
            } else if ($data->aktifitas == "proceed") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "finished") {
                $step = "COMPLETED";
            }

            $cellWidth = 80; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data->note_ticket) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data->note_ticket);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data->note_ticket, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->user_name, 1, 0, 'J');
            $pdf->Cell(15, ($line * $cellHeight), $data->user_sbu, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->kode_dept, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $data->note_ticket, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(25, ($line * $cellHeight), date('d-m-Y', strtotime($data->tgl_input)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }

    // Print BERITA ACARA By ID
    public function generate_formBA()
    {
        $alamat1 = decrypt_url($this->uri->segment(3));
        $alamat2 = $this->uri->segment(4);
        $alamat3 = decrypt_url($this->uri->segment(5));
        $alamat4 = decrypt_url($this->uri->segment(6));
        $noba =  $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;

        // echo $noba;

        $this->db->select('*');
        $this->db->from('tb_berita_acara');
        $this->db->where('no_ba', $noba);
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Times', '', 10);
        $pdf->SetTitle('ICT Helpdesk');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Times', 'B', 20);
        $pdf->Cell(190, 7, 'ICT BERITA ACARA ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);

        foreach ($result as $data) {
            $cellWidth1 = 170; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data->notes) < $cellWidth1) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data->notes);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung detail untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth1 - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data->notes, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }
            // Head
            // $pdf->Cell(190, 7, '', 0, 1, 'R');
            $pdf->Cell(190, 7, '', 0, 1, 'R');
            // $pdf->SetFont('Arial', 'I', 9);
            $pdf->Cell(140, 5, 'No. : ', 0, 0, 'R');
            $pdf->SetFont('', 'U');
            $pdf->Cell(50, 5, $noba, 0, 1, 'R');
            $pdf->SetFont('', '');
            $pdf->Cell(140, 5, 'Date : ', 0, 0, 'R');
            $pdf->SetFont('', 'U');
            $pdf->Cell(50, 5, date("d-M-Y", strtotime($data->input_date)), 0, 1, 'R');
            $pdf->Image(base_url('assets/img/confidential.png'), 170, 32, 30, 5);
            $pdf->SetFont('', '');
            $pdf->Cell(190, 14, 'ICT Team carried the inspection of the following equipment listed as follows:', 0, 1, 'J');

            // Table Item Baerita acara
            $pdf->SetLeftMargin('10'); // set left margin
            // $pdf->Cell(190, 7, '', 0, 1, 'J');
            $pdf->SetFillColor(156, 156, 156);
            $pdf->SetLineWidth(.3);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Equipment', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Serial Number', 1, 0, 'C', 1);
            $pdf->Cell(60, 8, 'Condition', 1, 0, 'C', 1);
            $pdf->Cell(60, 8, 'Recommendation', 1, 1, 'C', 1);

            $this->db->select('*');
            $this->db->where('no_ba_detail', $data->no_ba);
            $hasil = $this->db->get('tb_berita_acara_detail')->result();
            $no = 1;
            foreach ($hasil as $detail) {

                $cellWidth = 60; //lebar sel
                $cellHeight = 5; //tinggi sel satu baris normal

                //periksa apakah teksnya melibihi kolom?
                if ($pdf->GetStringWidth($detail->condition_detail) < $cellWidth) {
                    //jika tidak, maka tidak melakukan apa-apa
                    $line = 1;
                } else {
                    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                    //dengan memisahkan teks agar sesuai dengan lebar sel
                    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                    $textLength = strlen($detail->condition_detail);    //total panjang teks
                    $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                    $startChar  = 0;        //posisi awal karakter untuk setiap baris
                    $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                    $textArray  = array();    //untuk menampung detail untuk setiap baris
                    $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                    while ($startChar < $textLength) { //perulangan sampai akhir teks
                        //perulangan sampai karakter maksimum tercapai
                        while (
                            $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                        ) {
                            $maxChar++;
                            $tmpString = substr($detail->condition_detail, $startChar, $maxChar);
                        }
                        //pindahkan ke baris berikutnya
                        $startChar = $startChar + $maxChar;
                        //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                        array_push($textArray, $tmpString);
                        //reset variabel penampung
                        $maxChar = 0;
                        $tmpString = '';
                    }
                    //dapatkan jumlah baris
                    $line = count($textArray);
                }
                $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
                $pdf->Cell(30, ($line * $cellHeight), $detail->equipment_detail, 1, 0, 'J');
                $pdf->Cell(30, ($line * $cellHeight), $detail->sn_detail, 1, 0, 'J');
                // $pdf->Cell(40, ($line * $cellHeight), $detail->condition_detail, 1, 0, 'J');
                //memanfaatkan MultiCell sebagai ganti Cell
                //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
                //ingat posisi x dan y sebelum menulis MultiCell
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                $pdf->MultiCell($cellWidth, $cellHeight, $detail->condition_detail, 1);

                //kembalikan posisi untuk sel berikutnya di samping MultiCell 
                //dan offset x dengan lebar MultiCell
                $pdf->SetXY($xPos + $cellWidth, $yPos);
                $pdf->Cell(60, ($line * $cellHeight), $detail->recommendation, 1, 1, 'J');
            }
            $pdf->Cell(190, 7, '', 0, 1, 'R');
            $pdf->Cell(15, ($line * $cellHeight), 'Notes :', 0, 0, 'J');
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->SetFont('', 'U');
            $pdf->MultiCell($cellWidth1, $cellHeight, $data->notes, 0);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth1, $yPos);
            $pdf->Cell(2, ($line * $cellHeight), '', 0, 1, 'J');
        }

        $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(80, 40, 'Request Party:', 0, 0, 'C');
        $pdf->Cell(80, 40, 'Inspected By:', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->Cell(80, 5, 'Name : ___________________', 0, 0, 'C');
        $pdf->Cell(80, 5, 'ALVIN DEBIYAN MELSTIN', 0, 1, 'C');
        // $pdf->Image(base_url('assets/img/inspected.png'), 113, 155, 35, 10);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(80, 5, 'Position : ___________________', 0, 0, 'C');
        $pdf->Cell(80, 5, 'ICT Technician', 0, 1, 'C');

        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(80, 40, 'Checked & Reviewed by:', 0, 0, 'C');
        $pdf->Cell(80, 40, 'Approve By:', 0, 1, 'C');
        // $ceked = $this->db->query("SELECT * FROM tb_berita_acara_history WHERE no_ba='$data->no_ba' AND user_input='tofan.bakti@biasmandirigroup.id' AND activity='Approval'");
        // if ($ceked->num_rows() > 0) {
        //     $pdf->Image(base_url('assets/img/checked.png'), 30, 205, 40, 13);
        // }
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->Cell(80, 5, 'Tofan W. Bakti', 0, 0, 'C');
        $pdf->Cell(80, 5, 'Ritz R. Villadiego', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        // $apved = $this->db->query("SELECT * FROM tb_berita_acara_history WHERE no_ba='$data->no_ba' AND user_input='ritz@biasmandirigroup.id' AND activity='Approval'");
        // if ($apved->num_rows() > 0) {
        //     $pdf->Image(base_url('assets/img/approved.png'), 110, 205, 40, 13);
        // }

        $pdf->Cell(80, 5, 'ICT Development Manager', 0, 0, 'C');
        $pdf->Cell(80, 5, 'Head of Research and Development Division', 0, 1, 'C');


        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }
    // Print BERITA ACARA By ID
    public function generate_formRF()
    {
        $alamat1 = decrypt_url($this->uri->segment(3));
        $alamat2 = $this->uri->segment(4);
        $alamat3 = decrypt_url($this->uri->segment(5));
        $alamat4 = decrypt_url($this->uri->segment(6));
        $noba =  $alamat1 . '/' . $alamat2 . '/' . $alamat3 . '/' . $alamat4;

        // echo $noba;

        $this->db->select('*');
        $this->db->from('tb_berita_acara');
        $this->db->where('no_ba', $noba);
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('P'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Times', '', 10);
        $pdf->SetTitle('ICT Helpdesk');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Times', 'B', 20);
        $pdf->Cell(190, 7, 'ICT EMAIL REQUEST FORM ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);

        foreach ($result as $data) {
            $cellWidth1 = 170; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data->notes) < $cellWidth1) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data->notes);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung detail untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth1 - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data->notes, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }
            // Head
            // $pdf->Cell(190, 7, '', 0, 1, 'R');
            $pdf->Cell(190, 7, '', 0, 1, 'R');
            // $pdf->SetFont('Arial', 'I', 9);
            $pdf->Cell(140, 5, 'No. : ', 0, 0, 'R');
            $pdf->SetFont('', 'U');
            $pdf->Cell(50, 5, $noba, 0, 1, 'R');
            $pdf->SetFont('', '');
            $pdf->Cell(140, 5, 'Date : ', 0, 0, 'R');
            $pdf->SetFont('', 'U');
            $pdf->Cell(50, 5, date("d-M-Y", strtotime($data->input_date)), 0, 1, 'R');
            $pdf->Image(base_url('assets/img/confidential.png'), 170, 32, 30, 5);
            $pdf->SetFont('', '');
            $pdf->Cell(190, 14, 'This information given in this form is reliable and trusted', 0, 1, 'J');

            // Table Item Baerita acara
            $pdf->SetLeftMargin('10'); // set left margin
            // $pdf->Cell(190, 7, '', 0, 1, 'J');
            $pdf->SetFillColor(156, 156, 156);
            $pdf->SetLineWidth(.0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(190, 6, 'GENERAL INFORMATION', 0, 1, 'L', 1);
            $pdf->Cell(190, 5, '', 0, 1, 'L', false);
            $pdf->SetFont('Arial', '', 10);
            $this->db->select('*');
            $this->db->where('no_ticket', $data->no_ticket);
            $hasil = $this->db->get('tb_helpdesk')->result();
            foreach ($hasil as $detail) {
                $info_rf = explode(";", $detail->informasi);
                $pdf->Cell(20, 6, 'First Name', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[0], 0, 0, 'L', false);
                $pdf->Cell(20, 6, 'Last Name', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[1], 0, 1, 'L', false);
                $pdf->Cell(20, 6, 'Position', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[5], 0, 0, 'L', false);
                $pdf->Cell(20, 6, 'Department', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[4], 0, 1, 'L', false);
                $pdf->Cell(20, 6, 'SBU', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[3], 0, 0, 'L', false);
                $pdf->Cell(20, 6, 'Phone No.', 0, 0, 'L', false);
                $pdf->Cell(5, 6, ':', 0, 0, 'C', false);
                $pdf->Cell(60, 6, $info_rf[2], 0, 1, 'L', false);
                # code...
            }
            // Notes Form
            $pdf->Cell(190, 7, '', 0, 1, 'R');
            $pdf->Cell(15, ($line * $cellHeight), 'Notes :', 0, 0, 'J');
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->SetFont('', 'U');
            $pdf->MultiCell($cellWidth1, $cellHeight, $data->notes, 0);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth1, $yPos);
            $pdf->Cell(2, ($line * $cellHeight), '', 0, 1, 'J');
        }

        $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(80, 40, 'Submitted By:', 0, 0, 'C');
        $pdf->Cell(80, 40, 'Processed By:', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->Cell(80, 5, 'Name : ' . $detail->nama, 0, 0, 'C');
        $pdf->Cell(80, 5, 'Tofan W. Bakti', 0, 1, 'C');
        // $pdf->Image(base_url('assets/img/inspected.png'), 113, 155, 35, 10);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(80, 5, 'Date : ' . date("d-M-Y", strtotime($detail->input_tgl)), 0, 0, 'C');
        $pdf->Cell(80, 5, 'ICT Manager', 0, 1, 'C');

        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(80, 40, 'Approved by:', 0, 0, 'C');
        $pdf->Cell(80, 40, 'Approve By:', 0, 1, 'C');
        // $ceked = $this->db->query("SELECT * FROM tb_berita_acara_history WHERE no_ba='$data->no_ba' AND user_input='tofan.bakti@biasmandirigroup.id' AND activity='Approval'");
        // if ($ceked->num_rows() > 0) {
        //     $pdf->Image(base_url('assets/img/checked.png'), 30, 205, 40, 13);
        // }
        $pdf->SetFont('Arial', 'B', 9);
        // $pdf->Cell(190, 7, '', 0, 1, 'C');
        $pdf->Cell(80, 5, 'Inggrid Mamahit', 0, 0, 'C');
        $pdf->Cell(80, 5, 'Ritz R. Villadiego', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 9);
        // $apved = $this->db->query("SELECT * FROM tb_berita_acara_history WHERE no_ba='$data->no_ba' AND user_input='ritz@biasmandirigroup.id' AND activity='Approval'");
        // if ($apved->num_rows() > 0) {
        //     $pdf->Image(base_url('assets/img/approved.png'), 110, 205, 40, 13);
        // }

        $pdf->Cell(80, 5, 'Director of Finance & Admin', 0, 0, 'C');
        $pdf->Cell(80, 5, 'Head of Research and Development Division', 0, 1, 'C');


        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }

    // Print Report Trouble Shooting
    public function printReportTs()
    {


        $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        // $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        // $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.input_tgl', $tahun);
        $this->db->where('tb_helpdesk.jenis_komplain', "TS");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Troubleshooting');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Troubleshooting ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(55, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Status', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {

            if ($data->status == "WAITING") {
                $step = "TO START";
                // if ($subtix = "ER") {
                //     $pecah = explode(";", $data->note_ticket);
                //     $labelnote = "First Name : " . $pecah[0] . "<br> Lastname : " . $pecah[1] . "<br> Phone : " . $pecah[2] . "<br> SBU : " . $pecah[3] . "<br> Departement : " . $pecah[4] . "<br> Position : " . $pecah[5];
                // } else if ($subtix == "AR") {
                //     $pecah = explode(";", $data->note_ticket);
                //     $labelnote = "Type of Assets : " . $pecah[0] . "<br> Quantity : " . $pecah[1] . " " . $pecah[2] . "<br> Additional Info : " . $pecah[3];
                // } else if ($subtix == "TS") {
                //     $labelnote = $data->note_ticket;
                // }
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 55; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data->informasi) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data->informasi);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data->informasi, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $data->informasi, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */

    }

    // Print Report Trouble Shooting Filtered by Date
    public function printReportTs_Filtered()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        // $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        // $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        if ($akhir == "0") {
            $this->db->like('tb_helpdesk.input_tgl', $awal);
        } else {
            $this->db->where('tb_helpdesk.input_tgl BETWEEN "' . $awal . '"AND"' . $akhir . '"');
        }
        $this->db->where('tb_helpdesk.jenis_komplain', "TS");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Troubleshooting');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Troubleshooting ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(55, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Status', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {

            if ($data->status == "WAITING") {
                $step = "TO START";
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 55; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($data->informasi) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($data->informasi);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($data->informasi, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $data->informasi, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }

    // Print Report Email Request
    public function printReportEr()
    {

        $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        // $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        // $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.input_tgl', $tahun);
        $this->db->where('tb_helpdesk.jenis_komplain', "ER");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Email Request');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Email Request ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        // $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(95, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Activity', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {
            $pecah = explode(";", $data->informasi);
            $info = "First Name : " . $pecah[0] . ";    Lastname : " . $pecah[1] . "; 
Phone : " . $pecah[2] . "; SBU : " . $pecah[3] . "; 
Departement : " . $pecah[4] . "; Position : " . $pecah[5];

            if ($data->status == "WAITING") {
                $step = "TO START";
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 95; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($info) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($info);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($info, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            // $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $info, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */

    }

    // Print Report Email Request Filtered By Date
    public function printReportEr_Filtered()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        if ($akhir == "0") {
            $this->db->like('tb_helpdesk.input_tgl', $awal);
        } else {
            $this->db->where('tb_helpdesk.input_tgl BETWEEN "' . $awal . '"AND"' . $akhir . '"');
        }
        // $this->db->where('tb_helpdesk');
        $this->db->where('tb_helpdesk.jenis_komplain', "ER");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Email Request');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Email Request ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        // $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        // $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(135, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Activity', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {
            $pecah = explode(";", $data->informasi);
            $info = "First Name : " . $pecah[0] . ";    Lastname : " . $pecah[1] . ";   Phone : " . $pecah[2] . "; 
SBU : " . $pecah[3] . "; Departement : " . $pecah[4] . "; Position : " . $pecah[5];

            if ($data->status == "WAITING") {
                $step = "TO START";
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 135; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($info) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($info);    //total panjang teks
                $errMargin  = 10;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($info, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            // $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            // $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $info, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1);
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }


    public function printReportAr()
    {
        $tahun = gmdate("Y-m", time() + 60 * 60 * 7);
        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        // $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        // $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        $this->db->like('tb_helpdesk.input_tgl', $tahun);
        $this->db->where('tb_helpdesk.jenis_komplain', "AR");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Asset Request');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Asset Request ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        // $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(95, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Status', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {
            $pecah = explode(";", $data->informasi);
            $info = "Asset Type : " . $pecah[0] . ";    Qty : " . $pecah[1] . " " . $pecah[2] . "; 
Additional Info : " . $pecah[3];

            if ($data->status == "WAITING") {
                $step = "TO START";
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 95; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($info) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($info);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($info, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            // $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $info, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }

    // Print Report Asset Request Filtered By Date
    public function printReportAr_Filtered()
    {
        $awal = $this->uri->segment(3);
        $akhir = $this->uri->segment(4);

        $this->db->select('*');
        $this->db->from('tb_helpdesk');
        $this->db->join('tb_user', 'tb_user.user_email=tb_helpdesk.email', 'left');
        $this->db->join('tb_sbu', 'tb_sbu.nama_sbu=tb_helpdesk.sbu', 'left');
        // $this->db->join('tb_departemen', 'tb_departemen.kode_dept=tb_helpdesk.departemen', 'left');
        if ($akhir == "0") {
            $this->db->like('tb_helpdesk.input_tgl', $awal);
        } else {
            $this->db->where('tb_helpdesk.input_tgl BETWEEN "' . $awal . '"AND"' . $akhir . '"');
        }
        // $this->db->where('tb_helpdesk');
        $this->db->where('tb_helpdesk.jenis_komplain', "AR");
        $this->db->order_by('tb_helpdesk.seq_no', 'ASC');
        $result = $this->db->get()->result();

        /* TEMPLATE  HEADER */ // harus dipakai di setiap bentuk laporan
        $pdf = new PDF('L'); //Landscape
        $pdf->AddPage();
        /* /. TEMPLATE  HEADER */
        /*Content*/
        //Title Page
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTitle('ICT Helpdesk | Asset Request');

        // JUDUL FORM & No PEngajuan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(270, 7, 'Asset Request ', 0, 1, 'C');
        // $pdf->Cell(190, 7, $status, 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        // Table
        // Table Header
        $pdf->SetLeftMargin('10'); // set left margin
        $pdf->Cell(270, 7, '', 0, 1, 'J');
        $pdf->SetFillColor(158, 156, 156);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, 'No', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'No Tiket', 1, 0, 'C', 1);
        $pdf->Cell(35, 8, 'User', 1, 0, 'C', 1);
        $pdf->Cell(40, 8, 'Sbu', 1, 0, 'C', 1);
        // $pdf->Cell(40, 8, 'Department', 1, 0, 'C', 1);
        $pdf->Cell(95, 8, 'Information', 1, 0, 'C', 1);
        $pdf->Cell(27, 8, 'Tgl ', 1, 0, 'C', 1);
        $pdf->Cell(30, 8, 'Status', 1, 1, 'C', 1);

        // Table Body
        $no = 1;
        foreach ($result as $data) {
            $pecah = explode(";", $data->informasi);
            $info = "Asset Type : " . $pecah[0] . ";    Qty : " . $pecah[1] . " " . $pecah[2] . "; 
Additional Info : " . $pecah[3];

            if ($data->status == "WAITING") {
                $step = "TO START";
            } else if ($data->status == "PROCESSING") {
                $step = "IN PROGRESS";
            } else if ($data->aktifitas == "FINISH") {
                $step = "COMPLETED";
            }

            $cellWidth = 95; //lebar sel
            $cellHeight = 5; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($info) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($info);    //total panjang teks
                $errMargin  = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar  = 0;        //posisi awal karakter untuk setiap baris
                $maxChar    = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray  = array();    //untuk menampung data untuk setiap baris
                $tmpString  = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($info, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', false);
            $pdf->Cell(40, ($line * $cellHeight), $data->no_ticket, 1, 0, 'J');
            $pdf->Cell(35, ($line * $cellHeight), $data->nama, 1, 0, 'J');
            $pdf->Cell(40, ($line * $cellHeight), $data->sbu, 1, 0, 'J');
            // $pdf->Cell(40, ($line * $cellHeight), $data->departemen, 1, 0, 'J');
            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $info, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            // $pdf->Cell(60, ($line * $cellHeight), $data->informasi, 1, 0, 'J');
            $pdf->Cell(27, ($line * $cellHeight), date('d-m-Y', strtotime($data->input_tgl)), 1, 0, 'J');
            $pdf->Cell(30, ($line * $cellHeight), $step, 1, 1, 'J');
        }
        # TEMPLATE FOOTER dan output */ // harus dipakai di setiap bentuk laporan
        $pdf->AliasNbPages();
        $pdf->Output();
        # /. TEMPLATE FOOTER dan output */
    }
}
