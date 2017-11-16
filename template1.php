<?php require_once("cpanel.php"); ?>
                <div class="form1">
                    <table>
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
                      <thead>
                        <tr class="header1 border2all">
                          <td style="width: 370px;">Employee name / address </td>
                          <td style="width: 130px;">SSN</td>
                          <td style="width: 180px;">REPORTING PERIOD</td>
                          <td style="width: 130px;">PAY DATE</td>
                          <td style="width: 130px;">#<input type="text" style="background-color: #444" name="stub_number" placeholder="" value="10015" /></td>
                        </tr>
                      </thead>
                        <tbody>
                            <tr>
                                <td class="border2all">
                                    <input type="Text" name="employee_name" placeholder="Employee name here" class="wide" />
                                    <input type="Text" name="employee_address" placeholder="Employee address here" class="wide" />
                                </td>
                                <td class="border2all" ><input type="Text" name="ssn" placeholder="xxx-xx-1234" /></td>
                                <td class="border2all" ><input type="Text" name="reporting_period" placeholder="10/31/2017 - 11/06/2017" class="semi-wide" /></td>
                                <td class="border2all" ><input type="Text" name="pay_date" placeholder="11/08/2017" /></td>
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
                                <td><input type="Text" name="rate" value="11.2" /></td>
                                <td><input type="Text" name="hours" value="40" /></td>
                                <td class="border2R">448.00</td>
                                <td><span class="t2">Statutory Deductions</span>
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
                </div>
