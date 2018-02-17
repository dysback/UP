<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pay Stub Generator</title>
	<!--<link rel="icon" href="favicon.png">-->
	<link href="favicon.ico?v=2" rel="icon" type="image/x-icon" />
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>

	<link href="/css/stub.css" rel="stylesheet" type="text/css">


	<!-- Core JS files -->
	<script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
	<!-- /core JS files -->
	<script type="text/javascript" src="../assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="../assets/js/plugins/ui/drilldown.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/wizards/stepy.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>

	<script type="text/javascript" src="assets/js/plugins/forms/styling/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.js"></script>
	<!-- Theme JS files -->
	<script type="text/javascript" src="../assets/js/core/app.js"></script>
	<!-- /theme JS files -->
	<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>

	<script type="text/javascript" src="/js/lscript.js"></script>
	<script type="text/javascript" src="/js/lib.js"></script>
	<script type="text/javascript" src="/js/calc.js"></script>
<!--	<script type="text/javascript" src="/js/taxes.js"></script> -->
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Stub Generator</a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>
		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a href="#">Home</a></li>
				<li><a href="#">Generate Your Stub</a></li>
				<li><a href="#">Resend My Stubs</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">FAQ's</a></li>
				<li><a href="#">Support</a></li>
			</ul>
<!--
			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/image.png" alt="">
						<span>Victoria</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
						<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
-->
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Simple panel -->
				<div class="panel panel-flat">

					<div class="panel-body">

						<form class="stepy-basic" action="#">
							<fieldset title="Step 1">
								<legend class="text-semibold">Select template</legend>
								<div id="step-1" class="">

									<div id="slider-nav" class="slider-nav">
										<div><img id="select-temp" src="/img/paycheck1.PNG" /></div>
										<!--div><img src="/img/paycheck2.PNG" /></div-->
									</div>

								</div>
							</fieldset>
							<fieldset title="2">
								<legend class="text-semibold">Enter info</legend>
								<div id="step-2" class="">
            					</div>
							</fieldset>
							<fieldset title="3">
								<legend class="text-semibold">Prewiev stubs</legend>
								<div id="step-3" class="">
            					</div>
							</fieldset>
							<fieldset title="4">
								<legend class="text-semibold">Download</legend>

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
																	<label>Country:</label>
																	<select data-placeholder="Select your country" class="select" name="country">
																		<option></option>
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
													</fieldset>
												</div>
											</div>

										</div>


							</fieldset>
							<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
						</form>
					</div>
				</div>
				<!-- /simple panel -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2017. <a href="#">Paycheck stub generator</a> by <a href="mailto:damir.zelenika@gmail.com" target="_blank">dy</a>
	</div>
	<!-- /footer -->

</body>
</html>
