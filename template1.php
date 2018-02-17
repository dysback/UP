<?php
  require_once("cPanel.php");
  $today = new DateTime("today");
  $today2 = new DateTime("today");
  $today2->sub(new DateInterval("P2D"));
  $today9 = new DateTime("today");
  $today9->sub(new DateInterval("P8D"));
  $tId = "1";
?>
<script>
  $("#depo-span").hide();
  design = 1;
</script>
<form method="POST" class="form1" action="Paycheck.php">
    <table class="midpad" style="margin-top: 20px;">

                <!--div class="form1">
                    <table-->
                        <tr>
                            <td><input type="text" name="company" placeholder="Company name here" value="" class="very-wide" /></td>
                            <td class="t1" rowspan="2">Earnings statement</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="company_address" placeholder="Company address here" value="" class="very-wide" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="border2">
                      <!--thead-->
                        <tr class="header1 border2all">
                          <td style="width: 370px;">Employee name / address </td>
                          <td style="width: 130px;">SSN</td>
                          <td style="width: 180px;">REPORTING PERIOD</td>
                          <td style="width: 130px;">PAY DATE</td>
                          <td style="width: 130px;">#<input type="text" style="background-color: #444; color: #fff" name="stub_number" placeholder="" value="10015" /></td>
                        </tr>
                      <!--/thead-->
                        <tbody>
                            <tr>
                                <td class="border2all">
                                    <input type="Text" name="employee_name" placeholder="Employee name here" class="wide" />
                                    <input type="Text" name="employee_address" placeholder="Employee address here" class="wide" />
                                </td>
                                <td class="border2all" ><input type="Text" id="ssn" name="ssn" placeholder="xxx-xx-1234" /></td>
                                <td class="border2all" ><input type="Text" id="reporting_period" name="reporting_period" placeholder="10/31/2017 - 11/06/2017" class="semi-wide" /></td>
                                <td class="border2all" ><input type="Text" id="pay_date" name="pay_date" value="<?php echo $today->format("m/d/Y"); ?>" placeholder="<?php echo $today->format("m/d/Y"); ?>" /></td>
                                <td class="border2all" >Employee #<br /><input type="Text" name="employee_id" placeholder="123" /></td>
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
                                <!--td><input type="Text" name="rate" value="11.2" /></td>
                                <td><input type="Text" name="hours" value="40" /></td>
                                <td class="border2R">448.00</td-->

                                <td><input type="number" step="0.01" min="0" id="rate" name="rate" value="11.2" /></td>
                                <td><input type="number" step="0.01" min="0" id="hours" name="hours" value="40" /></td>
                                <td><input type="number" step="0.01" min="0" class="current_pay1" id="current_pay" name="current_pay" value="448.00" class="noedit1" readonly="readonly" /></td>


                                <td>
                                  <span class="t2">Statutory Deductions</span>
                                    <br />Fica - Medicare
                                    <br />Fica - Social Security
                                    <br />Federal Tax
                                    <br /><span id="stax" style="visibility: hidden;" >State Tax W/H</span>
                                    <br /><span id="sditax" style="visibility: hidden;" >CALIFORNIA SDI TAX</span>
                                </td>

                                <td>
                                    <br /><input type="number" class="noedit1 right fica_mc1" readonly="readonly" name="fica_mc" id="fica_mc" />
                                    <br /><input type="number" class="noedit1 right fica_ss1" readonly="readonly" name="fica_ss" id="fica_ss" />
                                    <br /><input type="number" class="noedit1 right fica_tax1" readonly="readonly" name="fica_tax" id="fica_tax" />
                                    <br /><input type="number" class="noedit1 right fica_stax1" readonly="readonly" name="fica_stax" id="fica_stax" />
                                    <br /><input type="number" class="noedit1 right fica_sditax1" readonly="readonly" name="fica_sditax" id="fica_sditax" />
                                </td>
                                <td>
                                    <br /><input type="number" class="noedit1 right ficay_mc1" readonly="readonly" name="ficay_mc" id="ficay_mc" />
                                    <br /><input type="number" class="noedit1 right ficay_ss1" readonly="readonly" name="ficay_ss" id="ficay_ss" />
                                    <br /><input type="number" class="noedit1 right ficay_tax1" readonly="readonly" name="ficay_tax" id="ficay_tax" />
                                    <br /><input type="number" class="noedit1 right ficay_stax1" readonly="readonly" name="ficay_stax" id="ficay_stax" />
                                    <br /><input type="number" class="noedit1 right ficay_sditax1" readonly="readonly" name="ficay_sditax" id="ficay_sditax" />
                                </td>





                                <!--td>
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
                                </td-->
                            </tr>
                        </tbody>
                    </table>
                    <table class="border2LR border2bottom gray2 gray2">
                      <tbody>
                            <tr style="text-align: center" class="low center t2">
                                <td style="background-color: #fff; ">YTD GROSS</td>
                                <td style="background-color: #fff; ">YTD DEDUCTIONS</td>
                                <td style="background-color: #fff; ">YTD NET PAY</td>
                                <td style="background-color: #fff; ">TOTAL</td>
                                <td style="background-color: #fff; ">DEDUCTIONS</td>
                                <td style="background-color: #fff; ">NET PAY</td>
                            </tr>
                            <tr style="text-align: center" class="center">
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="ytd_gross" id="ytd_gross" /></td>
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="ytd_deductions" id="ytd_deductions" /></td>
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="ytd_net_pay" id="ytd_net_pay" /></td>
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="total" id="total" /></td>
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="deductions" id="deductions" /></td>
                                <td style="background-color: #fff; "><input type="number" class="noedit right" readonly="readonly" name="net_pay" id="net_pay" /></td>
                            </tr>

                            <!--tr class="low center">
                                <td><input type="text" class="ro" name="ytd_gross" placeholder="xxx-xx-1234" /></td>
                                <td><input type="text" class="ro" name="ytd_deductions" placeholder="xxx-xx-1234" /></td>
                                <td><input type="text" class="ro" name="ytd_net_pay" placeholder="xxx-xx-1234" /></td>
                                <td><input type="text" class="ro" name="total" placeholder="xxx-xx-1234" /></td>
                                <td><input type="text" class="ro" name="deductions" placeholder="xxx-xx-1234" /></td>
                                <td><input type="text" class="ro" name="net_pay" placeholder="xxx-xx-1234" /></td>
                            </tr-->
                        </tbody>

                    </table>
                    <div id="deposit-slip">
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
                                      <td><span id="dep_stub_number">1243</span></td>
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
                    <div id="additional-checks"></div>

                </div>
</form>
