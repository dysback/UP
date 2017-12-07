<?php
  require_once "cPanel.php";
 ?>
                <form method="POST" action="Paycheck.php">
                    <table>
                        <tr>
                            <td><input type="text" name="company" placeholder="Company name here" value="" /></td>
                            <td>#<input type="text" name="stub_number" value="1243" /></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="company_address" placeholder="Company address here" value="" /></td>
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
                            <tr style="height: 180px; vertical-align: top;">
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
                </form>
