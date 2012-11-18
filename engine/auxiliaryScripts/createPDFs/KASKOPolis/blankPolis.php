<?php
error_reporting(0);
require_once('../FPDF/tfpdf.php');
require('../FPDF/makefont/makefont.php');

//MakeFont('c:\\Windows\\Fonts\\comic.ttf','cp1251');


class PDF extends tFPDF
{
// Page header
    function Header()
    {
        // Logo
        if ($_GET['background'] == 'borderOnly')
        {
            $this->Image('border.png',0,0, 216, 280);
        }
        elseif ($_GET['background'] != 'none')
        {
            $this->Image('background.png',0,0, 216, 280);
        }

        // Arial bold 10
        $this->AddFont('DejaVu','','ARIALNB.TTF',true);
        $this->SetFont('DejaVu','',10);
        // Title
        $this->SetDrawColor(0);
        // Line break
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        //$this->SetY(-15);
        // Arial italic 8
        //$this->SetFont('Arial','I',8);
        // Page number
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}



$pdf = new PDF('P', 'mm','Letter');







$pdf->Output();