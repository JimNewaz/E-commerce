<?php
session_start();
error_reporting(0);
include('includes/config.php');

// $gprice = $_SESSION['tp'];


// $test=$_GET['un'];


if (strlen($_SESSION['login']) == 0) {
	header('location:login.php');
} else {
	if (isset($_POST['submit'])) {

		mysqli_query($con, "update orders set paymentMethod='" . $_POST['paymethod'] . "' where userId='" . $_SESSION['id'] . "' and paymentMethod is null ");
		unset($_SESSION['cart']);
		unset($_SESSION['coupon_code']);
		header('location:order-history.php');
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="MediaCenter, Template, eCommerce">
		<meta name="robots" content="all">


		<!--Paypal-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />


		<title>Game Stocker | Payment Method</title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/green.css">
		<link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">
		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	</head>

	<body class="cnt-home">


		<header class="header-style-1">
			<?php include('includes/top-header.php'); ?>
			<?php include('includes/main-header.php'); ?>
			<?php include('includes/menu-bar.php'); ?>
		</header>
		<div class="breadcrumb">
			<div class="container">
				<div class="breadcrumb-inner">
					<ul class="list-inline list-unstyled">
						<li><a href="home.html">Home</a></li>
						<li class='active'>Payment Method</li>
					</ul>
				</div><!-- /.breadcrumb-inner -->
			</div><!-- /.container -->
		</div><!-- /.breadcrumb -->

		<div class="body-content outer-top-bd">
			<div class="container">
				<div class="checkout-box faq-page inner-bottom-sm">
					<div class="row">
						<div class="col-md-12">
							<h2>Pay With Paypal</h2>

							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<div id="paypal-button-container"></div>
								</div>
							</div>
							<!-- Set up a container element for the button -->
						</div>
					</div><!-- /.row -->
				</div><!-- /.checkout-box -->
			</div><!-- /.container -->
		</div><!-- /.body-content -->
		<?php include('includes/footer.php'); ?>
		<script src="assets/js/jquery-1.11.1.min.js"></script>

		<script src="assets/js/bootstrap.min.js"></script>

		<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>

		<script src="assets/js/echo.min.js"></script>
		<script src="assets/js/jquery.easing-1.3.min.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<script src="assets/js/jquery.rateit.min.js"></script>
		<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
		<script src="assets/js/bootstrap-select.min.js"></script>
		<script src="assets/js/wow.min.js"></script>
		<script src="assets/js/scripts.js"></script>

		<!-- For demo purposes – can be removed on production -->

		<!--<script src="switchstylesheet/switchstylesheet.js"></script>-->

		<script>
// 			$(document).ready(function() {
// 				$(".changecolor").switchstylesheet({
// 					seperator: "color"
// 				});
// 				$('.show-theme-options').click(function() {
// 					$(this).parent().toggleClass('open');
// 					return false;
// 				});
// 			});

// 			$(window).bind("load", function() {
// 				$('.show-theme-options').delay(2000).trigger('click');
// 			});
		</script>
		<!-- For demo purposes – can be removed on production : End -->




		<!--<script src="assets/js/payment.js"></script>-->

		<!-- Include the PayPal JavaScript SDK -->
		<!-- <script src="https://www.paypal.com/sdk/js?client-id=test&currency=GBP"></script> -->
		<script src="https://www.paypal.com/sdk/js?client-id=ARdFgTjn-3p9v9EAz7sIyzx3dB3b_7wiM3454WMs2n9S_LO5p-dyo8EdQk5tlx7REydLVjk3Met-o1QL&currency=GBP"></script>
		<?php
		if ($code != "" && $code == 'SAVE5') {
			$tmp_final_price = $total_price - $discount;
			$final_price = $tmp_final_price - (5 / 100 * $tmp_final_price);
		} else {
			$final_price = $total_price - $discount;
			
		}
		?>
		<script>
			var js_variable = '<?php echo number_format("$final_price", 2, '.', ''); ?>';
           

			// Render the PayPal button into #paypal-button-container
			paypal.Buttons({

				// Set up the transaction
				createOrder: function(data, actions) {
					return actions.order.create({
						purchase_units: [{
							amount: {
								value: js_variable
							}
						}]
					});
				},

				// Finalize the transaction
				onApprove: function(data, actions) {
					return actions.order.capture().then(function(details) {
						// location.reload("get-paypal-transaction.php");
						window.location.href = "get-paypal-transaction.php";
						// Show a success message to the buyer
						// alert('Transaction completed by ' + details.payer.name.given_name + '!');
					});
				}


			}).render('#paypal-button-container');
		</script>

	</body>

	</html>
<?php } ?>