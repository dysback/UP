<?php
require("lib.php");
$today = new DateTime("today");
?>
<!--
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
-->
                <table class="midpad" style="margin-top: 20px;">
                    <tr>
                        <td><span style="font-size: 20px; color: #09c;font-weight: 600"><?php echo request("company");  ?></span></td>
                        <td style="text-align: right;"><span style="color: #09c;"># </span><?php echo request("stub_number");  ?></td>
                    </tr>
                    <tr>
                        <td><span style="font-size: 16px; color: #09c;font-weight: 600"><?php echo request("company_address");  ?></span></td>
                        <td  style="text-align: right;"><span style="font-size: 20px; color: #09c;font-weight: 600">EARNINGS STATEMENT</span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>



<!--
                <table class="border top-radius">
                    <tbody>
                        <tr>
                            <th rowspan="2">Employee name / address
                                <br /><?php echo request("employee_name"); ?>
                                <br /><?php echo request("employee_address"); ?>
                            </th>
                            <th>SSN</th>
                            <th>REPORTING PERIOD</th>
                            <th>PAY DATE</th>
                            <th>EMPLOYEE ID</th>
                        </tr>
                        <tr>
                            <th><?php echo request("ssn"); ?></th>
                            <th><?php echo request("reporting_period"); ?></th>
                            <th><?php echo request("pay_date"); ?></th>
                            <th><?php echo request("employee_id"); ?></th>
                        </tr>

                    </tbody>
                </table>
-->

                <table class="border top-radius blues hebo">
                    <tbody>
                        <tr class="midpad" style="height: 20px;">
                            <th rowspan="2" style="width: 35%; text-align: left; "><span style="font-weight: 600; font-size: 16px; margin: 2px 2px 0px 7px;" id="c-e">Employee name / address</span>
                                <br /><span class="grays" style="padding-left: 10px; "><?php echo request("employee_name"); ?></span>
                                <br /><span class="grays" style="padding-left: 10px; "><?php echo request("employee_address"); ?></span>
                            </th>
                            <th style="width: 15%">SSN</th>
                            <th style="width: 20%">REPORTING PERIOD</th>
                            <th style="width: 15%">PAY DATE</th>
                            <th style="width: 15%"><span id="c-eID">EMPLOYEE ID</span></th>
                        </tr>
                        <tr class="minipad">
                            <th><span class="grays"><?php echo request("ssn"); ?></span></th>
                            <th><span class="grays"><?php echo request("reporting_period"); ?></span></th>
                            <th><span class="grays"><?php echo request("pay_date"); ?></span></th>
                            <th><span class="grays"><?php echo request("employee_id"); ?></span></th>
                        </tr>

                    </tbody>
                </table>

                <table class="border grays">
                    <thead>
                        <tr style="font-size: 16px;" class="midpad">
                            <th>INCOME</th>
                            <th>RATE</th>
                            <th>HOURS</th>
                            <th>CURRENT PAY</th>
                            <th>DEDUCTIONS</th>
                            <th>TOTAL</th>
                            <th>YTD TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="grays" style="height: 180px; vertical-align: top; text-transform: uppercase;">
                            <td><span style="font-size: 14px; font-weight: 600;">Gross Earnings</span></td>
                            <td style="text-align: right; "><?php echo request("rate"); ?></td>
                            <td style="text-align: right; "><?php echo request("hours"); ?></td>
                            <td style="text-align: right; "><?php echo request("current_pay"); ?></td>
                            <td class="blues"><span style="font-size: 14px; font-weight: 600;">Statutory Deductions</span>
                              <br />Fica - Medicare
                              <br />Fica - Social Security
                              <br />Federal Tax
                              <br /><span id="stax" <?php echo request("fica_stax") ? '': 'style="visibility: hidden;"'; ?> >State Tax</span>
                              <br /><span id="sditax" <?php echo request("fica_sditax") ? '': 'style="visibility: hidden;"'; ?> >CALIFORNIA SDI TAX</span>

                            </td>
                            <td style="text-align: right; ">
                                <br /><?php echo request("fica_mc"); ?>
                                <br /><?php echo request("fica_ss"); ?>
                                <br /><?php echo request("fica_tax"); ?>
                                <br /><?php echo request("fica_stax"); ?>
                                <br /><?php echo request("fica_sditax"); ?>
                            </td>
                            <td style="text-align: right; ">
                              <br /><?php echo request("ficay_mc"); ?>
                              <br /><?php echo request("ficay_ss"); ?>
                              <br /><?php echo request("ficay_tax"); ?>
                              <br /><?php echo request("ficay_stax"); ?>
                              <br /><?php echo request("ficay_sditax"); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>


<!--
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
                            <td><?php echo request("employee_id"); ?></td>
                            <td><?php echo request("employee_id"); ?></td>
                            <td>448.00</td>
                            <td>Statutory Deductions
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
-->
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
                            <td style="text-align: center; "><?php echo request("ytd_gross"); ?></td>
                            <td style="text-align: center; "><?php echo request("ytd_deductions"); ?></td>
                            <td style="text-align: center; "><?php echo request("ytd_net_pay"); ?></td>
                            <td style="text-align: center; "><?php echo request("total"); ?></td>
                            <td style="text-align: center; "><?php echo request("deductions"); ?></td>
                            <td style="text-align: center; "><?php echo request("net_pay"); ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php if(request("deposit") == "on") { ?>
                <div id="deposit-slip" style="display: block;">
                  <table class="border top-radius bottom-radius minipad grays" style="height: 120px;">
                      <tbody>
                          <tr>
                            <td style="padding: 20px 10px 0px 10px; width: 60%; text-align: left; vertical-align:bottom; ">
                              <div style="border: 2px solid #09e; padding: 5px; width: 100%; ">
                                <span style="font-size: 16px; font-weight:600;" class="blues">PAY </span>
                                <span style="font-size: 16px; font-weight:600;" class="dep_pay">....</span>
                              </div>
                              <table>
                                <tr>
                                  <td style="width: 150px;" class="blues">TO THE ORDER OF:</td>
                                  <td>
                                    <span class="depo_en" >Employee name</span><br />
                                    <span class="depo_esa">Employee street address</span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                            <td style="padding-right:10px;" >
                              <table>
                                <tr class="blues" style="border-bottom: 1px solid">
                                  <td style="border-right: 1px solid">CHECK DATE</td>
                                  <td>CHECK NUMBER</td>
                                </tr>
                                <tr class="grays">
                                  <td><span id="dep_paydate"><?php echo $today->format("m/d/Y"); ?></span></td>
                                  <td><span id="dep_stub_number"><?php echo request("stub_number") ?></span></td>
                                </tr>
                                <tr>
                                  <td colspan="2" style="border-bottom: 2px solid #09c; ">
                                  <span class="blues">THIS IS NOT A CHECK</span><br />
                                  <span class="grays" style="border: 1px solid;">NON-NEGOTIABLE</span><br />
                                  <span class="blues">VOID</span>
                                  <td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                      </tbody>
                  </table>
                </div>
              <?php } ?>
