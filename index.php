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
								<div id="step-4" class="">
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
