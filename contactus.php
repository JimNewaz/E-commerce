<?php
session_start();
error_reporting(0);
include('includes/config.php');



    $msg="";
	if(isset($_POST['submit'])) {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];

		mysqli_query($con,"insert into contact_us(name,email,subject,message) values('$name','$email','$subject','$message')");
		$msg="Thanks for contacting us";
		
		$body="Hi $name, Thanks for contacting us.We will get back to you soon.
        Visit Us https://www.gamestocker.co.uk";
        $subject1 = "Contact Confirmation";
        $headers = "From: noreply@gamestocker.com" . "\r\n" .
        "CC: somebodyelse@example.com";

		mail($email,$subject1,$body,$headers);
  }



?>

<style>
    .box{
        margin-top:50px;
    }

</style>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">
	    <title> Contact Us</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
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

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	</head>
    
	
<header class="header-style-1">

	<!-- == TOP MENU == -->
<?php include('includes/top-header.php');?>
<!-- == TOP MENU : END == -->
<?php include('includes/main-header.php');?>
	<!-- == NAVBAR == -->
<?php include('includes/menu-bar.php');?>
<!-- == NAVBAR : END == -->

</header>

<body class="cnt-home">

<section>
<div class="col-md-3">

</div>
<div class="col-md-6"> 
                <div class="box" >
                    <div class="box-header">
                        <center>
                            <h2>Contact Us</h2>
                            <p class="text-muted">
                                If you have any question please feel free to contact Us 
                            </p>
                        </center>
                    </div> 
                    <!-- box Header close -->
                    
                    <!-- Form -->
                    <form class="" action="mailer.php" method="POST"> 
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required=" " class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Email</label>							
                            <input type="text" name="email" required=" " class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" required=" " class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Messages</label>
                            <textarea name="message" class="form-control" required=" "></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="submit" >
                                <i class="fa fa-user-md"></i> Send Message 
                            </button>
							<span>
							<?php echo $msg;?>
							</span>
                        </div>
                    </form>
                </div>
            </div> <!-- Col-md-9 End -->
        </div>
    </div> <!-- Content end -->

<div class="col-md-3">
    
</div>

</section>


<div class="clearfix"></div>





















<?php include('includes/footer.php');?>
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
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
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


