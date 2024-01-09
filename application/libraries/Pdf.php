<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH . '/third_party/fpdf181/pdf.php';
// include_once APPPATH . '/third_party/fpdf17/pdf.php';
class Pdf extends FPDF
{

    function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }

    function Header()
    {
        // Header Page
        $img = base_url('/assets/img/logomark.png');
        $phone = "P : (+62) 778 422265";
        $web = "www.biasmandirigroup.id";
        $alamat = "Komplek Sentosa Purnama Jaya";
        $alamat2 = "Blok B no 9-11, Jl. Yos Sudarso,";
        $alamat2 = "Batu Ampar - Batam, Indonesia 29432";
        global $title;
        $lebar = $this->w;
        $this->SetFont('Arial', 'B', 10);
        $w = $this->GetStringWidth($title);

        $this->Image($img, 20, 10, 80);
        // $this->Image($img, 30, 10, 25);
        // setting jenis font yang akan digunakan
        // $this->Cell(190,7,'Bias Mandiri Group',0,1,'R');
        // $this->Cell(190,7,$alamat,0,1,'R');
        // $this->Cell(190,7,$alamat2,0,1,'R');
        $this->SetFont('Arial', '', 10);
        $this->Cell($this->GetX() + $lebar - $this->GetStringWidth($phone) + 4, 5, $phone, 0, 1, 'R');
        $this->Cell($this->GetX() + $lebar - $this->GetStringWidth($web) + 10, 5, $web, 0, 1, 'R');
        $this->Cell($this->GetX() + $lebar - $this->GetStringWidth($alamat) + 22, 5, $alamat, 0, 1, 'R');
        $this->Cell($this->GetX() + $lebar - $this->GetStringWidth($alamat2) + 31, 7, $alamat2, 0, 1, 'R');
        $this->Ln();
        $this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 20, $this->GetY());
        $this->Ln(5);
    }


    function Footer()
    {
        $this->SetY(-15);
        $lebar = $this->w;
        $this->SetFont('Arial', 'I', 8);
        $this->line($this->GetX(), $this->GetY(), $this->GetX() + $lebar - 20, $this->GetY());
        $this->SetY(-15);
        $this->SetX(0);
        $this->Ln(1);
        $hal = 'Page : ' . $this->PageNo() . '/{nb}';
        $this->Cell($this->GetStringWidth($hal), 10, $hal);
        $datestring = "Year: %Y Month: %m Day: %d - %h:%i %a";
        $tanggal  = 'ICT Helpdesk | Print : ' . gmdate('d-m-Y  H:i', time() + 60 * 60 * 7) . ' ';
        $this->Cell($lebar - $this->GetStringWidth($hal) - $this->GetStringWidth($tanggal) - 20);
        $this->Cell($this->GetStringWidth($tanggal), 10, $tanggal);
    }
}
