<?php


ini_set("display_errors", 1);
require('fpdf/fpdf.php');
require("lib.php");
require("fpdf_lib.php");



if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "download") {
    

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



    $pdf->Output("test.pdf", "D"); 


//    echo "R:" . print_r($_REQUEST, true);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="css/stub.css">    
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>  
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/swm/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />
    <link href="/swm/dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
    <link href="/swm/dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
    <script src="https://use.fontawesome.com/ea3b0355a0.js"></script>


  </head>
  <body style="width: 1000px;">


    <div id="smartwizard">
        <ul>
            <li><a href="#step-1">Select template<br /><small>1</small></a></li>
            <li><a href="#step-2">Enter info<br /><small>2</small></a></li>
            <li><a href="#step-3">Prewiev stubs<br /><small>3</small></a></li>
            <li><a href="#step-4">Download<br /><small>4</small></a></li>
        </ul>
    </div>



    <div id="slider-nav" class="slider-nav">
        <div><img src="/img/paycheck1.PNG" /></div>
        <div><img src="/img/paycheck1.PNG" /></div>
        <div><img src="/img/paycheck1.PNG" /></div>
    </div>
    
    
            <div>
            <div id="step-1" class="">
                Step 1 Content
            </div>
            <div id="step-2" class="">
                Step 2 Content
            </div>
            <div id="step-3" class="">
                Step 3 Content
            </div>
            <div id="step-4" class="">
                Step 4 Content
            </div>
        </div>

    
    
    
<button id="test">klik</button>    
    <div class="slider-for">

    <form method="POST" action="Paycheck.php">
    
        <table>
            <tr>
                <td><input type="text" name="company" placeholder="Company name here" value="<?php echo request("company"); ?>" /></td>
                <td>#<input type="text" name="stub_number" value="1243" /></td>
            </tr>
            <tr>
                <td><input type="text" name="company_address" placeholder="Company address here" value="<?php echo request("company_address"); ?>" /></td>
                <td>Earnings statement</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>        
        </table>

        <table class="border top-radius">
            <tbody>
                <tr>
                    <th rowspan="2">Employee name / address
                        <br /><input type="Text" name="employee_name" placeholder="Employee name here" />
                        <br /><input type="Text" name="employee_address" placeholder="Employee address here" />
                    </th>
                    <th>SSN</th>
                    <th>REPORTING PERIOD</th>
                    <th>PAY DATE</th>
                    <th>EMPLOYEE ID</th>
                </tr>
                <tr>
                    <th><input type="Text" name="ssn" placeholder="xxx-xx-1234" /></th>
                    <th><input type="Text" name="reporting_period" placeholder="10/31/2017 - 11/06/2017" /></th>
                    <th><input type="Text" name="pay_date" placeholder="11/08/2017" /></th>
                    <th><input type="Text" name="employee_id" placeholder="123" /></th>
                </tr>

            </tbody>
        </table>

        <table class="border">
            <thead>
                <tr>
                    <th>Income</th>
                    <th>RATE</th>
                    <th>HOURS</th>
                    <th>CURRENT PAY</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL</th>
                    <th>YTD TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gross Earnings</td>
                    <td><input type="Text" name="rate" value="11.2" /></td>
                    <td><input type="Text" name="hours" value="40" /></td>
                    <td>448.00</td>
                    <td>Statutory Deductions 	
                        <br />Fica - Medicare 		
                        <br />Fica - Social Security 		
                        <br />Federal Tax
                        <br />State Tax</td>
                    <td>
                        <br /><input type="text" class="ro" name="fica_mc"  />
                        <br /><input type="text" class="ro" name="fica_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_ftax" placeholder="xxx-xx-1234" />
                    </td>
                    <td>
                        <br /><input type="text" class="ro" name="ficay_mc"  />
                        <br /><input type="text" class="ro" name="ficay_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_ftax" placeholder="xxx-xx-1234" />
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border bottom-radius">
            <thead>
                <tr>
                    <th>YTD GROSS</th>
                    <th>YTD DEDUCTIONS</th>
                    <th>YTD NET PAY</th>
                    <th>TOTAL</th>
                    <th>DEDUCTIONS</th>
                    <th>NET PAY</th>
                </tr>

            </thead>

            <tbody>
                <tr>
                    <td><input type="text" class="ro" name="ytd_gross" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_net_pay" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="total" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="net_pay" placeholder="xxx-xx-1234" /></td>
                </tr>
            </tbody>

        </table>
        <br />
        <button name="action" value="download">Download</button>
    
    </form>
    
    <form method="POST" action="Paycheck.php">
    
        <table>
            <tr>
                <td><input type="text" name="company" placeholder="Company name here" value="<?php echo request("company"); ?>" /></td>
                <td>#<input type="text" name="stub_number" value="1243" /></td>
            </tr>
            <tr>
                <td><input type="text" name="company_address" placeholder="Company address here" value="<?php echo request("company_address"); ?>" /></td>
                <td>Earnings statement</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>        
        </table>

        <table class="border top-radius">
            <tbody>
                <tr>
                    <th rowspan="2">Employee name / address
                        <br /><input type="Text" name="employee_name" placeholder="Employee name here" />
                        <br /><input type="Text" name="employee_address" placeholder="Employee address here" />
                    </th>
                    <th>SSN</th>
                    <th>REPORTING PERIOD</th>
                    <th>PAY DATE</th>
                    <th>EMPLOYEE ID</th>
                </tr>
                <tr>
                    <th><input type="Text" name="ssn" placeholder="xxx-xx-1234" /></th>
                    <th><input type="Text" name="reporting_period" placeholder="10/31/2017 - 11/06/2017" /></th>
                    <th><input type="Text" name="pay_date" placeholder="11/08/2017" /></th>
                    <th><input type="Text" name="employee_id" placeholder="123" /></th>
                </tr>

            </tbody>
        </table>

        <table class="border">
            <thead>
                <tr>
                    <th>Income</th>
                    <th>RATE</th>
                    <th>HOURS</th>
                    <th>CURRENT PAY</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL</th>
                    <th>YTD TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gross Earnings</td>
                    <td><input type="Text" name="rate" value="11.2" /></td>
                    <td><input type="Text" name="hours" value="40" /></td>
                    <td>448.00</td>
                    <td>Statutory Deductions 	
                        <br />Fica - Medicare 		
                        <br />Fica - Social Security 		
                        <br />Federal Tax
                        <br />State Tax</td>
                    <td>
                        <br /><input type="text" class="ro" name="fica_mc"  />
                        <br /><input type="text" class="ro" name="fica_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_ftax" placeholder="xxx-xx-1234" />
                    </td>
                    <td>
                        <br /><input type="text" class="ro" name="ficay_mc"  />
                        <br /><input type="text" class="ro" name="ficay_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_ftax" placeholder="xxx-xx-1234" />
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border bottom-radius">
            <thead>
                <tr>
                    <th>YTD GROSS</th>
                    <th>YTD DEDUCTIONS</th>
                    <th>YTD NET PAY</th>
                    <th>TOTAL</th>
                    <th>DEDUCTIONS</th>
                    <th>NET PAY</th>
                </tr>

            </thead>

            <tbody>
                <tr>
                    <td><input type="text" class="ro" name="ytd_gross" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_net_pay" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="total" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="net_pay" placeholder="xxx-xx-1234" /></td>
                </tr>
            </tbody>

        </table>
        <br />
        <button name="action" value="download">Download</button>
    
    </form>
    
    <form method="POST" action="Paycheck.php">
    
        <table>
            <tr>
                <td><input type="text" name="company" placeholder="Company name here" value="<?php echo request("company"); ?>" /></td>
                <td>#<input type="text" name="stub_number" value="1243" /></td>
            </tr>
            <tr>
                <td><input type="text" name="company_address" placeholder="Company address here" value="<?php echo request("company_address"); ?>" /></td>
                <td>Earnings statement</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>        
        </table>

        <table class="border top-radius">
            <tbody>
                <tr>
                    <th rowspan="2">Employee name / address
                        <br /><input type="Text" name="employee_name" placeholder="Employee name here" />
                        <br /><input type="Text" name="employee_address" placeholder="Employee address here" />
                    </th>
                    <th>SSN</th>
                    <th>REPORTING PERIOD</th>
                    <th>PAY DATE</th>
                    <th>EMPLOYEE ID</th>
                </tr>
                <tr>
                    <th><input type="Text" name="ssn" placeholder="xxx-xx-1234" /></th>
                    <th><input type="Text" name="reporting_period" placeholder="10/31/2017 - 11/06/2017" /></th>
                    <th><input type="Text" name="pay_date" placeholder="11/08/2017" /></th>
                    <th><input type="Text" name="employee_id" placeholder="123" /></th>
                </tr>

            </tbody>
        </table>

        <table class="border">
            <thead>
                <tr>
                    <th>Income</th>
                    <th>RATE</th>
                    <th>HOURS</th>
                    <th>CURRENT PAY</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL</th>
                    <th>YTD TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gross Earnings</td>
                    <td><input type="Text" name="rate" value="11.2" /></td>
                    <td><input type="Text" name="hours" value="40" /></td>
                    <td>448.00</td>
                    <td>Statutory Deductions 	
                        <br />Fica - Medicare 		
                        <br />Fica - Social Security 		
                        <br />Federal Tax
                        <br />State Tax</td>
                    <td>
                        <br /><input type="text" class="ro" name="fica_mc"  />
                        <br /><input type="text" class="ro" name="fica_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="fica_ftax" placeholder="xxx-xx-1234" />
                    </td>
                    <td>
                        <br /><input type="text" class="ro" name="ficay_mc"  />
                        <br /><input type="text" class="ro" name="ficay_ss" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_tax" placeholder="xxx-xx-1234" />
                        <br /><input type="text" class="ro" name="ficay_ftax" placeholder="xxx-xx-1234" />
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="border bottom-radius">
            <thead>
                <tr>
                    <th>YTD GROSS</th>
                    <th>YTD DEDUCTIONS</th>
                    <th>YTD NET PAY</th>
                    <th>TOTAL</th>
                    <th>DEDUCTIONS</th>
                    <th>NET PAY</th>
                </tr>

            </thead>

            <tbody>
                <tr>
                    <td><input type="text" class="ro" name="ytd_gross" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="ytd_net_pay" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="total" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="deductions" placeholder="xxx-xx-1234" /></td>
                    <td><input type="text" class="ro" name="net_pay" placeholder="xxx-xx-1234" /></td>
                </tr>
            </tbody>

        </table>
        <br />
        <button name="action" value="download">Download</button>
    
    </form>
    </div>
    
  </body>
  <script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
  <script type="text/javascript" src="/swm/dist/js/jquery.smartWizard.min.js"></script>
  <script src="js/script.js"></script>
</html>

