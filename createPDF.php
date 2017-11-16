<?php
require_once 'fpdf/fpdf.php';
require_once "lib.php";
require_once "fpdf_lib.php";

function createPDF($filename = 'doc.pdf', $output = 'F') {
    return createType1($filename, $output);
}

function createType1($filename, $output) {
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetTopMargin(3);
    $pdf->SetLeftMargin(4);
    $pdf->SetFont('Arial','B', 14);
    $pdf->SetDrawColor(0, 128, 192);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->SetFillColor(0, 128, 192);
    $pdf->SetXY(4, 5);


    $pdf->Cell(100, 3, request("company"));
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 9);
    $pdf->Cell(100, 3,"#" . request("stub_number"), "", 1, "R");
    $pdf->SetTextColor(0, 128, 192);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(100, 8, request("company_address"));
    $pdf->SetFont('Arial','B', 14);
    $pdf->Cell(100, 8,"EARNINGS STATEMENT", "", 1, "R");


    $pdf->SetFont('Arial','', 11);
    $pdf->Cell(77, 7,"EMPLOYEE NAME / ADDRESS", 0, 0, 'C');
    $pdf->SetFont('Arial','', 7);
    $pdf->Cell(25, 7,"SSN", 1, 0, 'C');
    $pdf->Cell(45, 7,"REPORTING PERIOD", 1, 0, 'C');
    $pdf->Cell(25, 7,"PAY DATE",1, 0, 'C');
    $pdf->Cell(30, 7,"EMPLOYEE ID", "B", 1, "C");
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 9);
    $pdf->MultiCell(77, 6, request("employee_name") . "\r\n" . request("employee_address"), 'RB', 'L');
    $pdf->SetXY(81, 23);
    $pdf->Cell(25, 12,request("ssn"), 1, 0, 'C');
    $pdf->Cell(45, 12, request("reporting_period"), 1, 0, 'C');
    $pdf->Cell(25, 12, request("pay_date"), 1, 0, 'C');
    $pdf->Cell(30, 12, request("employee_id"), "B", 1, "C");


    $pdf->SetTextColor(0, 128, 192);
    $pdf->SetDrawColor(0, 128, 192);
    $pdf->SetLineWidth(.3);
    $pdf->RoundedRect(4, 16, 202, 80, 4, '1324', 'D');

    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial','', 11);
    $pdf->Cell(36, 7, "INCOME", 1, 0, 'L', 1);
    $pdf->Cell(22, 7, "RATE", 1, 0, 'C', 1);
    $pdf->Cell(20, 7, "HOURS", 1, 0, 'C', 1);
    $pdf->Cell(26, 7, "CURRENT PAY", 1, 0, 'C', 1);
    $pdf->Cell(50, 7, "DEDUCTIONS", 1, 0, 'C', 1);
    $pdf->Cell(24, 7, "TOTAL", 1, 0, 'C', 1);
    $pdf->Cell(24, 7, "YTD_TOTAL", 1, 1, 'C', 1);

    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 9);
    $pdf->Cell(36, 7, "Gross Earnings", 0, 0, 'L');
    $pdf->Cell(22, 7, request("rate"), 0, 0, 'C');
    $pdf->Cell(20, 7, request("hours"), 0, 0, 'C');
    $pdf->Cell(26, 7, request("hours") * request("rate"), 0, 0, 'C');
    $pdf->SetTextColor(0, 128, 192);
    $pdf->MultiCell(50, 7, "STATUTORY DEDUCTIONS\nFICA - MEDICARE\nFICA - SOCIAL SECURITY\nFEDERAL TAX\nSTATE TAX W/H\n\n", 0, 'L');
    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetXY(150, 42);
    $pdf->MultiCell(24, 7, "\n" . request("fica_mc") . "\n" . request("fica_ss")
                        . "\n" . request("fica_tax") . "\n" . request("fica_ftax"), 0, 'R');
    $pdf->SetXY(180, 42);
    $pdf->Multicell(24, 7, "\n" . request("ficay_mc") . "\n" . request("ficay_ss")
                        . "\n" . request("ficay_tax") . "\n" . request("ficay_ftax"), 0, 'R');
    $pdf->SetXY(4, 82);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial','', 11);
    $pdf->Cell(33.6, 7, "YTD GROSS", 1, 0, 'C', 1);
    $pdf->Cell(33.6, 7, "YTD DEDUCTIONS", 1, 0, 'C', 1);
    $pdf->Cell(33.6, 7, "YTD NET PAY", 1, 0, 'C', 1);
    $pdf->Cell(33.6, 7, "TOTAL", 1, 0, 'C', 1);
    $pdf->Cell(33.7, 7, "DEDUCTIONS", 1, 0, 'C', 1);
    $pdf->Cell(33.7, 7, "NET PAY", 1, 1, 'C', 1);

    $pdf->SetTextColor(128, 128, 128);

    $pdf->Cell(33.6, 7, request("ytd_gross"), 0, 0, 'C', 0);
    $pdf->Cell(33.6, 7, request("ytd_deductions"), 0, 0, 'C', 0);
    $pdf->Cell(33.6, 7, request("ytd_net_pay"), 0, 0, 'C', 0);
    $pdf->Cell(33.6, 7, request("total"), 0, 0, 'C', 0);
    $pdf->Cell(33.7, 7, request("deductions"), 0, 0, 'C', 0);
    $pdf->Cell(33.7, 7, request("net_pay"), 0, 1, 'C', 0);


    if($output == "F") {
      try {
        @$pdf->Output($filename, $output);
      } catch (Exception $e)
      {
        writeLog("PDF creation exception: " . print_r($e, true));
      }
      if(file_exists($filename)) {
        writeLog("PDF $filename created");
        return $filename;
      } else {
        writeLog("PDF $filename creation failed");
        return false;
      }
    }
}
