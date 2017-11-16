<?php
require("lib.php");
?>

<div class="form1">
    <table>
        <tr>
            <td><?php echo request("company");  ?></td>
            <td class="t1" rowspan="2">Earnings statement</td>
        </tr>
        <tr>
            <td><?php echo request("company_address");  ?></td>

        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>

    <table class="border2">
      <thead>
        <tr class="header1 border2all">
          <td style="width: 370px;">Employee name / address </td>
          <td style="width: 130px;">SSN</td>
          <td style="width: 180px;">REPORTING PERIOD</td>
          <td style="width: 130px;">PAY DATE</td>
          <td style="width: 130px;">#<?php echo request("stub_number");  ?></td>
        </tr>
      </thead>
        <tbody>
            <tr>
                <td class="border2all">
                    <?php echo request("employee_name"); ?><br />
                    <?php echo request("employee_address"); ?>
                </td>
                <td class="border2all center" ><?php echo request("ssn"); ?></td>
                <td class="border2all center" ><?php echo request("reporting_period"); ?></td>
                <td class="border2all center" ><?php echo request("pay_date"); ?></td>
                <td class="border2all center" >Employee #<br /><?php echo request("employee_id"); ?></td>
            </tr>

        </tbody>
    </table>

    <table>
        <tbody>

          <tr class="border2LR low t2">
              <td>Income</td>
              <td>RATE</td>
              <td>HOURS</td>
              <td>CURRENT PAY</td>
              <td>DEDUCTIONS</td>
              <td>TOTAL</td>
              <td>YTD TOTAL</td>
          </tr>



            <tr class="gray border2all top" style="height: 300px;" >
                <td>Gross Earnings</td>
                <td><?php echo request("rate"); ?></td>
                <td><?php echo request("hours"); ?></td>
                <td class="border2R">448.00</td>
                <td><span class="t2">Statutory Deductions</span>
                    <br />Fica - Medicare
                    <br />Fica - Social Security
                    <br />Federal Tax
                    <br />State Tax</td>
                <td>
                    <br /><?php echo request("fica_mc"); ?>
                    <br /><?php echo request("fica_ss"); ?>
                    <br /><?php echo request("fica_tax"); ?>
                    <br /><?php echo request("fica_ftax"); ?>
                </td>
                <td>
                  <br /><?php echo request("ficay_mc"); ?>
                  <br /><?php echo request("ficay_ss"); ?>
                  <br /><?php echo request("ficay_tax"); ?>
                  <br /><?php echo request("ficay_ftax"); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="border2LR border2bottom gray2 gray2">
      <tbody>
            <tr class="low center t2">
                <td>YTD GROSS</td>
                <td>YTD DEDUCTIONS</td>
                <td>YTD NET PAY</td>
                <td>TOTAL</td>
                <td>DEDUCTIONS</td>
                <td>NET PAY</td>
            </tr>

            <tr class="low center">
                <td><?php echo request("ytd_gross"); ?></td>
                <td><?php echo request("ytd_deductions"); ?></td>
                <td><?php echo request("ytd_net_pay"); ?></td>
                <td><?php echo request("total"); ?></td>
                <td><?php echo request("deductions"); ?></td>
                <td><?php echo request("net_pay"); ?></td>
            </tr>
        </tbody>

    </table>
    <br />
</div>




<table>
    <tr>
        <td><?php echo request("company");  ?></td>
        <td>#<?php echo request("stub_number");  ?></td>
    </tr>
    <tr>
        <td><?php echo request("company_address");  ?></td>
        <td>Earnings statement</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>
