<?php
require_once 'fpdf/fpdf.php';
require_once "lib.php";
require_once "fpdf_lib.php";

function createPDF($filename = 'doc.pdf', $output = 'F', $design = 0) {
    return createType1($filename, $output, $design);
}

function createType1($filename, $output, $design) {
    $pdf = new PDF();
    printArecord($pdf, array( "rperiod"   => request("reporting_period"),
                              "paydate"   => request("pay_date"),
                              "hours"     => request("hours"),
                              "deposit"   => request("deposit"),
                            ));
    $paydates = request("paydate");
    if(is_array($paydates)) {
        foreach ($paydates as $key => $value) {
        printArecord($pdf, array( "rperiod"   => request("rperiod")[$key],
                                  "paydate"   => request("paydate")[$key],
                                  "hours"     => request("hrs")[$key],
                                  "deposit"   => request("dslip")[$key],
                                ));
      }
    }

    if($output == "F") {
      try {
        $pdf->Output($filename, $output);
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

function printArecord($pdf, $rq) {
  $hours = $rq["hours"];
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
  $pdf->Cell(45, 12, $rq["rperiod"], 1, 0, 'C');
  $pdf->Cell(25, 12, $rq["paydate"], 1, 0, 'C');
  $pdf->Cell(30, 12, request("employee_id"), "B", 1, "C");


  $pdf->SetTextColor(0, 128, 192);
  $pdf->SetDrawColor(0, 128, 192);
  $pdf->SetLineWidth(.3);
  $pdf->RoundedRect(4, 16, 202, 80, 4, '1324', 'D');

  $pdf->SetTextColor(255, 255, 255);
  $pdf->SetFont('Arial','', 10);
  $pdf->Cell(36, 7, "INCOME", 1, 0, 'L', 1);
  $pdf->Cell(22, 7, "RATE", 1, 0, 'C', 1);
  $pdf->Cell(20, 7, "HOURS", 1, 0, 'C', 1);
  $pdf->Cell(26, 7, "CURRENT PAY", 1, 0, 'C', 1);
  $pdf->Cell(50, 7, "DEDUCTIONS", 1, 0, 'C', 1);
  $pdf->Cell(24, 7, "TOTAL", 1, 0, 'C', 1);
  $pdf->Cell(24, 7, "YTD  TOTAL", 1, 1, 'C', 1);

  $pdf->SetTextColor(128, 128, 128);
  $pdf->SetFont('Arial','', 10);
  $pdf->Cell(36, 7, "Gross Earnings", 0, 0, 'L');
  $pdf->Cell(22, 7, request("rate"), 0, 0, 'C');
  $pdf->Cell(20, 7, $hours, 0, 0, 'C');
  $pdf->Cell(26, 7, $hours * request("rate"), 0, 0, 'C');
  $pdf->SetTextColor(0, 128, 192);
  $strTax = "STATUTORY DEDUCTIONS\nFICA - MEDICARE\nFICA - SOCIAL SECURITY\nFEDERAL TAX";
  if(request("fica_stax")) {
    $strTax .= "\nSTATE TAX W/H";
  }
  if(request("fica_sditax")) {
    $strTax .= "\nCALIFORNIA SDI TAX";
  }

  $pdf->MultiCell(50, 6, $strTax, 0, 'L');
  $pdf->SetTextColor(128, 128, 128);
  $pdf->SetXY(150, 42);
  $pdf->MultiCell(24, 6, "\n" . request("fica_mc") . "\n" . request("fica_ss")
                      . "\n" . request("fica_tax") . "\n" . request("fica_stax") . "\n" . request("fica_sditax"), 0, 'R');
  $pdf->SetXY(180, 42);
  $pdf->Multicell(24, 6, "\n" . request("ficay_mc") . "\n" . request("ficay_ss")
                      . "\n" . request("ficay_tax") . "\n" . request("ficay_stax") . "\n" . request("ficay_sditax"), 0, 'R');
  $pdf->SetXY(4, 82);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->SetFont('Arial','', 10);
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
  //$pdf->SetDrawColor(0, 128, 192);
  //$pdf->SetLineWidth(.3);



  if($rq["deposit"]) {
    $pdf->SetDash(1, 1);
    $pdf->SetDrawColor(128, 128, 128);
    $pdf->Line(2, 102, 207, 102);
    $pdf->SetDash();
    $pdf->SetDrawColor(0, 128, 192);
    $pdf->RoundedRect(4, 108, 202, 30, 4, '1324', 'D');

    $pdf->setXY(30, 97);
    $pdf->SetFont('Arial', 'B',  13);
    $pdf->Cell(100, 10,"8<");

    $pdf->setXY(10, 116);

    $pdf->SetFont('Arial','B',  11);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(8, 10," PAY", 'LTB', 0, 'L');

    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 11);
    $net_pay = request("net_pay");
    $pdf->Cell(110, 10," **" . floor($net_pay) . "** DOLLARS AND **" . (int)(($net_pay - floor($net_pay)) * 100) . "** CENTS", 'RTB', 0, 'C');

    $pdf->setXY(10, 127);
    $pdf->SetFont('Arial','', 10);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(100, 10,"TO THE ORDER OF:");


    $pdf->setXY(52, 127);
    $pdf->SetFont('Arial','', 9);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(100, 5, request("employee_name"), 0, 2);
    $pdf->Cell(100, 5, request("employee_address"));


    $pdf->setXY(135, 110);
    $pdf->SetFont('Arial','', 9);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(32, 5, "CHECK DATE", 'BR', 0, 'C');
    $pdf->Cell(32, 5, "CHECK NUMBER", 'B', 0, 'C');

    $pdf->setXY(135, 115);
    $pdf->SetFont('Arial','', 8);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(32, 5, request("pay_date"), 'R', 0, 'C');
    $pdf->Cell(32, 5, request("stub_number"), '', 0, 'C');

    $pdf->setXY(150, 120);
    $pdf->SetFont('Arial','', 8);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(35, 5, "THIS IS NOT A CHECK", 0, 2, 'C');

    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 9);
    $pdf->Cell(35, 5, "NON NEGOTIABLE", 1, 2, 'C');

    $pdf->SetTextColor(0, 128, 192);
    $pdf->SetFont('Arial','', 11);
    $pdf->Cell(35, 5, "VOID", 0, 2, 'C');
  }

}

function printArecord1($pdf, $rq) {
  $hours = $rq["hours"];
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
  $pdf->Cell(45, 12, $rq["rperiod"], 1, 0, 'C');
  $pdf->Cell(25, 12, $rq["paydate"], 1, 0, 'C');
  $pdf->Cell(30, 12, request("employee_id"), "B", 1, "C");


  $pdf->SetTextColor(0, 128, 192);
  $pdf->SetDrawColor(0, 128, 192);
  $pdf->SetLineWidth(.3);
  $pdf->RoundedRect(4, 16, 202, 80, 4, '1324', 'D');

  $pdf->SetTextColor(255, 255, 255);
  $pdf->SetFont('Arial','', 10);
  $pdf->Cell(36, 7, "INCOME", 1, 0, 'L', 1);
  $pdf->Cell(22, 7, "RATE", 1, 0, 'C', 1);
  $pdf->Cell(20, 7, "HOURS", 1, 0, 'C', 1);
  $pdf->Cell(26, 7, "CURRENT PAY", 1, 0, 'C', 1);
  $pdf->Cell(50, 7, "DEDUCTIONS", 1, 0, 'C', 1);
  $pdf->Cell(24, 7, "TOTAL", 1, 0, 'C', 1);
  $pdf->Cell(24, 7, "YTD  TOTAL", 1, 1, 'C', 1);

  $pdf->SetTextColor(128, 128, 128);
  $pdf->SetFont('Arial','', 10);
  $pdf->Cell(36, 7, "Gross Earnings", 0, 0, 'L');
  $pdf->Cell(22, 7, request("rate"), 0, 0, 'C');
  $pdf->Cell(20, 7, $hours, 0, 0, 'C');
  $pdf->Cell(26, 7, $hours * request("rate"), 0, 0, 'C');
  $pdf->SetTextColor(0, 128, 192);
  $strTax = "STATUTORY DEDUCTIONS\nFICA - MEDICARE\nFICA - SOCIAL SECURITY\nFEDERAL TAX";
  if(request("fica_stax")) {
    $strTax .= "\nSTATE TAX W/H";
  }
  if(request("fica_sditax")) {
    $strTax .= "\nCALIFORNIA SDI TAX";
  }

  $pdf->MultiCell(50, 6, $strTax, 0, 'L');
  $pdf->SetTextColor(128, 128, 128);
  $pdf->SetXY(150, 42);
  $pdf->MultiCell(24, 6, "\n" . request("fica_mc") . "\n" . request("fica_ss")
                      . "\n" . request("fica_tax") . "\n" . request("fica_stax") . "\n" . request("fica_sditax"), 0, 'R');
  $pdf->SetXY(180, 42);
  $pdf->Multicell(24, 6, "\n" . request("ficay_mc") . "\n" . request("ficay_ss")
                      . "\n" . request("ficay_tax") . "\n" . request("ficay_stax") . "\n" . request("ficay_sditax"), 0, 'R');
  $pdf->SetXY(4, 82);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->SetFont('Arial','', 10);
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
  //$pdf->SetDrawColor(0, 128, 192);
  //$pdf->SetLineWidth(.3);



  if($rq["deposit"]) {
    $pdf->SetDash(1, 1);
    $pdf->SetDrawColor(128, 128, 128);
    $pdf->Line(2, 102, 207, 102);
    $pdf->SetDash();
    $pdf->SetDrawColor(0, 128, 192);
    $pdf->RoundedRect(4, 108, 202, 30, 4, '1324', 'D');

    $pdf->setXY(30, 97);
    $pdf->SetFont('Arial', 'B',  13);
    $pdf->Cell(100, 10,"8<");

    $pdf->setXY(10, 116);

    $pdf->SetFont('Arial','B',  11);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(8, 10," PAY", 'LTB', 0, 'L');

    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 11);
    $net_pay = request("net_pay");
    $pdf->Cell(110, 10," **" . floor($net_pay) . "** DOLLARS AND **" . (int)(($net_pay - floor($net_pay)) * 100) . "** CENTS", 'RTB', 0, 'C');

    $pdf->setXY(10, 127);
    $pdf->SetFont('Arial','', 10);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(100, 10,"TO THE ORDER OF:");


    $pdf->setXY(52, 127);
    $pdf->SetFont('Arial','', 9);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(100, 5, request("employee_name"), 0, 2);
    $pdf->Cell(100, 5, request("employee_address"));


    $pdf->setXY(135, 110);
    $pdf->SetFont('Arial','', 9);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(32, 5, "CHECK DATE", 'BR', 0, 'C');
    $pdf->Cell(32, 5, "CHECK NUMBER", 'B', 0, 'C');

    $pdf->setXY(135, 115);
    $pdf->SetFont('Arial','', 8);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(32, 5, request("pay_date"), 'R', 0, 'C');
    $pdf->Cell(32, 5, request("stub_number"), '', 0, 'C');

    $pdf->setXY(150, 120);
    $pdf->SetFont('Arial','', 8);
    $pdf->SetTextColor(0, 128, 192);
    $pdf->Cell(35, 5, "THIS IS NOT A CHECK", 0, 2, 'C');

    $pdf->SetTextColor(128, 128, 128);
    $pdf->SetFont('Arial','', 9);
    $pdf->Cell(35, 5, "NON NEGOTIABLE", 1, 2, 'C');

    $pdf->SetTextColor(0, 128, 192);
    $pdf->SetFont('Arial','', 11);
    $pdf->Cell(35, 5, "VOID", 0, 2, 'C');
  }

}
