<?php
require("lib.php");
?>
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
