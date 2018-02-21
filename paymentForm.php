<?php
require("lib.php");
print_r(Config::$TRANSACTION_AMOUNT);
$deps = 0;
$nos = request("nos");
if(request("deposit")) {
  $deps++;
}
if(request("dslip")) {
  $deps += count($_REQUEST["dslip"]);
}

//die("D: $deps");

 ?>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-6">
													<fieldset>
														<legend class="text-semibold"><i class="icon-reading position-left"></i> Personal details</legend>

														<div class="form-group">
															<label>Card Number:</label>
															<input type="text" class="form-control" name="cardNumber" id="cardNumber" maxlength="19" placeholder="xxxx-xxxx-xxxx-xxxx">
														</div>

														<div class="form-group">
															<label>Expiration Date:</label>
															<input type="text" class="form-control" name="date" id="date" maxlength="5" placeholder="yy/MM">
														</div>

														<div class="form-group">
															<label>cvc:</label>
															<input type="text" class="form-control" name="cvc" maxlength="cvc" placeholder="XXX">
														</div>


														<div class="form-group">
															<label>Your message:</label>
															<textarea rows="5" cols="5" class="form-control" name="message" placeholder="Enter your message here"></textarea>
														</div>
													</fieldset>
												</div>

												<div class="col-md-6">
													<fieldset>
														<legend class="text-semibold"><i class="icon-truck position-left"></i> Shipping details</legend>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>First name:</label>
																	<input type="text" placeholder="Your first name" class="form-control" name="pfirstname">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label>Last name:</label>
																	<input type="text" placeholder="Your last namev" class="form-control" name="plastname">
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Email:</label>
																	<input type="text" placeholder="your.email@domain.com" class="form-control" name="email">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label>Phone #:</label>
																	<input type="text" placeholder="+99-99-9999-9999" class="form-control" name="phone">
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="col-lg-3 control-label">Country:</label>
																	<select data-placeholder="Select your country" class="select form-control" name="country">
																		<!--option></option-->
																		<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
																		<option value="Cambodia">Cambodia</option>
																		<option value="Cameroon">Cameroon</option>
																		<option value="Canada">Canada</option>
																		<option value="Cape Verde">Cape Verde</option>
																	</select>
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label>State/Province:</label>
																	<input type="text" placeholder="Bayern" class="form-control" name="state">
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label>ZIP code:</label>
																	<input type="text" placeholder="1031" class="form-control" name="zip">
																</div>
															</div>

															<div class="col-md-3">
																<div class="form-group">
																	<label>City:</label>
																	<input type="text" placeholder="Munich" class="form-control" name="city">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label>Address line:</label>
																	<input type="text" placeholder="Ring street 12" class="form-control" name="street">
																</div>
															</div>
														</div>
														<hr />
														<h5>Order detail</h5>
														<table>
															<thead>
																<tr>
																	<th>description</th>
																	<th>qty</th>
																	<th>amount</th>

																</tr>
															</thead>

															<tr>
																<td>Stub download<br />Item price: $<?php echo Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"]; ?></td>
																<td style="text-align: right"><?php echo $nos - $deps; ?></td>
																<td style="text-align: right"><?php echo Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"] * ($nos - $deps); ?></td>
															</tr>
															<tr>
																<td>Stub Download with slip<br />Item price: $<?php echo Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"] + Config::$TRANSACTION_AMOUNT["AMOUNT_SLIP"]; ?></td>
																<td style="text-align: right"><?php echo $deps; ?></td>
																<td style="text-align: right"><?php echo $deps * (Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"] + Config::$TRANSACTION_AMOUNT["AMOUNT_SLIP"]); ?></td>
															</tr>
															<tr>
																<td  style="font-weight: bold;">Total</td>
																<td></td>
																<td style="text-align: right; font-weight: bold;">$<?php echo Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"] * ($nos - $deps) +
                                $deps * (Config::$TRANSACTION_AMOUNT["AMOUNT_PAYCHECK"] + Config::$TRANSACTION_AMOUNT["AMOUNT_SLIP"]); ?></td>
															</tr>
														</table>

													</fieldset>

												</div>

											</div>

										</div>
