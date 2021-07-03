<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Code for User login


if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' and password='$password'");
	$num = mysqli_fetch_array($query);


	if ($num > 0 && $num['user_status'] == 0) {
		$redirect = $_GET['location'];
		if ($redirect != null || $redirect != '') {
			$arr = explode('/', $redirect);
			$extra = $arr[1];
		} else {
			$extra = "my-cart.php";
		}
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['id'];
		$_SESSION['username'] = $num['name'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
		exit();
	} else {
		$extra = "login.php";
		$email = $_POST['email'];

		$_SESSION['errmsg'] = "Invalid email id or password";
		header("location:https://www.softlysoftware.co.uk/login.php");


		// Email Check
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}

		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		$log = mysqli_query($con, "insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		$_SESSION['errmsg'] = "Invalid email id or Password";
		header("location:https://$host$uri/$extra");
		exit();
	}
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

	<title>Softly Software | Sign-in </title>

	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Customizable CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/green.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css">
	<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
	<link href="assets/css/lightbox.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/rateit.css">
	<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

	<!-- Demo Purpose Only. Should be removed in production -->
	<link rel="stylesheet" href="assets/css/config.css">

	<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
	<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
	<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
	<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
	<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
	<!-- Demo Purpose Only. Should be removed in production : END -->


	<!-- Icons/Glyphs -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<script type="text/javascript">
		function valid() {
			if (document.register.password.value != document.register.confirmpassword.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.register.confirmpassword.focus();
				return false;
			}
			return true;
		}
	</script>
	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>



</head>

<body class="cnt-home">



	<!-- ====== HEADER ======= -->
	<header class="header-style-1">

		<!-- ===== TOP MENU ===== -->
		<?php include('includes/top-header.php'); ?>
		<!-- === TOP MENU : END ==== -->
		<?php include('includes/main-header.php'); ?>
		<!-- ==== NAVBAR ====== -->
		<?php include('includes/menu-bar.php'); ?>
		<!-- == NAVBAR : END === -->

	</header>

	<!-- ==== HEADER : END ====== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="home.html">Home</a></li>
					<li class='active'>Login</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content outer-top-bd">
		<div class="container">
			<div class="sign-in-page inner-bottom-sm">
				<div class="row">
					<!-- Sign-in -->
					<div class="col-md-3"></div>

					<div class="col-md-6 col-sm-5 sign-in" style="border:1px solid #DDDDDD; padding: 20px;">
						<h4 class="">Sign in</h4>
						<p class="">Hello, Welcome to your account.</p>
						<?php
						$redirect = $_GET['location'];
						if ($redirect != null || $redirect != '') {
							$extra = "register.php?location=" . urlencode($_GET['location']);
						?>
							<a href="<?php echo $extra; ?>" class="forgot-password pull-left">Don't have any account? Click Here</a> <br>
						<?php } else { ?>
							<a href="register.php" class="forgot-password pull-left">Don't have any account? Click Here</a> <br>
						<?php
							}
						?>
						<form class="register-form outer-top-xs" method="post">
							<span style="color:red;">
								<?php
								echo htmlentities($_SESSION['errmsg']);
								?>
								<?php
								echo htmlentities($_SESSION['errmsg'] = "");
								?>
							</span>
							<div class="form-group">
								<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
								<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">

							</div>
							<div class="form-group">
								<label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
								<input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
							</div>
							<div class="radio outer-xs">
								<a href="recover_email.php" class="forgot-password pull-right">Forgot your Password?</a> <br>
								<!--<a href="register.php" class="forgot-password pull-right">Don't have any account? Click Here</a> <br>-->
							</div>
							<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Login</button>
						</form>


					</div>



					<div class="col-md-3"></div>
				</div><!-- /.row -->
			</div>

		</div>
	</div>
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

	<script src="switchstylesheet/switchstylesheet.js"></script>

	<script>
		$(document).ready(function() {
			$(".changecolor").switchstylesheet({
				seperator: "color"
			});
			$('.show-theme-options').click(function() {
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
			$('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->



</body>

</html>