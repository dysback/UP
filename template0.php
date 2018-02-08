<?php
  require_once "cPanel.php";
  $today = new DateTime("today");
  $today2 = new DateTime("today");
  $today2->sub(new DateInterval("P2D"));
  $today9 = new DateTime("today");
  $today9->sub(new DateInterval("P8D"));

 ?>
                <form method="POST" action="Paycheck.php">
                    <table class="midpad" style="margin-top: 20px;">
                        <tr>
                            <td><input type="text" name="company" placeholder="Company name here" style="width:500px; font-size:16px;" /></td>
<<<<<<< HEAD
                            <td style="text-align: right; color: #09c;"># <input type="text" name="stub_number" id="stub_number" value="1243" /></td>
=======
                            <td style="text-align: right; color: #09c;"># <input type="text" name="stub_number" value="1243" /></td>
>>>>>>> 92f77e99fc89b462484a68aa02361f9ade770a87
                        </tr>
                        <tr>
                            <td><input type="text" name="company_address" placeholder="Company address here" style="width:500px; font-size:16px;" /></td>
                            <td  style="text-align: right;"><span style="font-size: 20px; color: #09c;font-weight: 600">EARNINGS STATEMENT</span></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="border top-radius blues hebo">
                        <tbody>
                            <tr class="midpad" style="height: 20px;">
                                <th rowspan="2" style="width: 35%; text-align: left; "><span style="font-weight: 600; font-size: 16px; margin: 2px 2px 0px 7px;"" id="c-e">Employee name / address</span>
                                    <input type="text" id="employee_name" name="employee_name" placeholder="Employee name here" style="width: 95%; margin: 7px 2px 2px 7px;" />
                                    <input type="text" id="employee_address" name="employee_address" placeholder="Employee address here" style="width: 95%; margin: 0px 2px 2px 7px;"" />
                                </th>
                                <th style="width: 15%">SSN</th>
                                <th style="width: 20%">REPORTING PERIOD</th>
                                <th style="width: 15%">PAY DATE</th>
                                <th style="width: 15%"><span id="c-eID">EMPLOYEE ID</span></th>
                            </tr>
                            <tr class="minipad">
                                <th><input type="text" name="ssn" id="ssn" placeholder="xxx-xx-1234" /></th>
                                <th><input type="text"  name="reporting_period" id="reporting_period" style="width: 170px;"
                                                        value="<?php echo $today9->format("m/d/Y"); ?> - <?php echo $today2->format("m/d/Y"); ?>"
                                                        placeholder="<?php echo $today9->format("m/d/Y"); ?> - <?php echo $today2->format("m/d/Y"); ?>" /></th>
                                <th><input type="text" name="pay_date" id="pay_date" value="<?php echo $today->format("m/d/Y"); ?>" placeholder="<?php echo $today->format("m/d/Y"); ?>" /></th>
                                <th><input type="text" name="employee_id" placeholder="123" /></th>
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
                            <tr style="height: 180px; vertical-align: top; text-transform: uppercase;">
                                <td><span style="font-size: 14px; font-weight: 600;">Gross Earnings</span></td>
                                <td><input type="number" step="0.01" min="0" id="rate" name="rate" value="11.2" /></td>
                                <td><input type="number" step="0.01" min="0" id="hours" name="hours" value="40" /></td>
                                <td><input type="number" step="0.01" min="0" id="current_pay" name="current_pay" value="448.00" class="noedit" readonly="readonly" /></td>
                                <td class="blues"><span style="font-size: 14px; font-weight: 600;">Statutory Deductions</span>
                                  <br />Fica - Medicare
                                  <br />Fica - Social Security
                                  <br />Federal Tax
                                  <br /><span id="stax" style="visibility: hidden;" >State Tax</span>
                                  <br /><span id="sditax" style="visibility: hidden;" >CALIFORNIA SDI TAX</span>

                                </td>
                                <td>
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="fica_mc" id="fica_mc" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="fica_ss" id="fica_ss" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="fica_tax" id="fica_tax" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="fica_stax" id="fica_stax" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="fica_sditax" id="fica_sditax" />
                                </td>
                                <td>
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="ficay_mc" id="ficay_mc" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="ficay_ss" id="ficay_ss" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="ficay_tax" id="ficay_tax" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="ficay_stax" id="ficay_stax" />
                                    <br /><input type="number" class="noedit right" readonly="readonly" name="ficay_sditax" id="ficay_sditax" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="border bottom-radius">
                        <thead>
                            <tr style="font-size: 16px;" class="midpad">
                                <th>YTD GROSS</th>
                                <th>YTD DEDUCTIONS</th>
                                <th>YTD NET PAY</th>
                                <th>TOTAL</th>
                                <th>DEDUCTIONS</th>
                                <th>NET PAY</th>
                            </tr>

                        </thead>

                        <tbody>
                            <tr style="text-align: center">
                                <td><input type="number" class="noedit right" readonly="readonly" name="ytd_gross" id="ytd_gross" /></td>
                                <td><input type="number" class="noedit right" readonly="readonly" name="ytd_deductions" id="ytd_deductions" /></td>
                                <td><input type="number" class="noedit right" readonly="readonly" name="ytd_net_pay" id="ytd_net_pay" /></td>
                                <td><input type="number" class="noedit right" readonly="readonly" name="total" id="total" /></td>
                                <td><input type="number" class="noedit right" readonly="readonly" name="deductions" id="deductions" /></td>
                                <td><input type="number" class="noedit right" readonly="readonly" name="net_pay" id="net_pay" /></td>
                            </tr>
                        </tbody>

                    </table>
                    <div id="deposit-slip">
                      <table class="border top-radius bottom-radius minipad grays" style="height: 120px;">
                          <tbody>
                              <tr>
                                <td style="padding: 20px 10px 0px 10px; width: 60%; text-align: left; vertical-align:bottom; ">
                                  <div style="border: 2px solid #09e; padding: 5px; width: 100%; ">
<<<<<<< HEAD
                                    <span style="font-size: 16px; font-weight:600;" class="blues">PAY </span>
                                    <span style="font-size: 16px; font-weight:600;" class="dep_pay">....</span>
=======
                                    <span style="font-size: 16px; font-weight:600;" class="blues">PAY</span>....
>>>>>>> 92f77e99fc89b462484a68aa02361f9ade770a87
                                  </div>
                                  <table>
                                    <tr>
                                      <td style="width: 150px;" class="blues">TO THE ORDER OF:</td>
                                      <td>
<<<<<<< HEAD
                                        <span class="depo_en" >Employee name</span><br />
                                        <span class="depo_esa">Employee street address</span>
=======
                                        Employee name<br />
                                        Employee street address
>>>>>>> 92f77e99fc89b462484a68aa02361f9ade770a87
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
<<<<<<< HEAD
                                      <td><span id="dep_paydate"><?php echo $today->format("m/d/Y"); ?></span></td>
                                      <td><span id="dep_stub_number">1243</span></td>
=======
                                      <td>12/09/2017</td>
                                      <td>10215</td>
>>>>>>> 92f77e99fc89b462484a68aa02361f9ade770a87
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
<<<<<<< HEAD
                    <div id="additional-checks"></div>
=======
>>>>>>> 92f77e99fc89b462484a68aa02361f9ade770a87
                </form>
