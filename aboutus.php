<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<style>
    .about {
    padding: 130px 0;
}

.about .heading h2 {
    font-size: 30px;
    font-weight: 700;
    margin: 0;
    padding: 0;

}

.about .heading h2 span {
    color: #F24259;
}

.about .heading p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.7;
    color: #999999;
    margin: 20px 0 60px;
    padding: 0;
}

.about h3 {
    font-size: 25px;
    font-weight: 700;
    margin: 0;
    padding: 0;
}

.about p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.7;
    color: #999999;
    margin: 20px 0 15px;
    padding: 0;
}

.about h4 {
    font-size: 15px;
    font-weight: 500;
    margin: 8px 0;
}

.about h4 i {
    color: #F24259;
    margin-right: 10px;
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
	    <title>About Us</title>
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
    <body class="cnt-home">
	
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


<section class="about" id="about">
            <div class="container">
                <div class="heading text-center">
                    <h2>About
                        <span>Us</span></h2>
                    <p>Softly Software is a UK based media company providing a fast and efficient service to all. 
                        <br>
                      
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="https://i.ibb.co/qpz1hvM/About-us.jpg" alt="about" class="img-fluid" width="100%">
                    </div>
                    <div class="col-lg-6">
                        <h3>Great Products and Fantastic Customer Service  </h3>
                        <p>
						Here at Softly Software we cater for a wide range of customers specialising in the reproduction, and distribution of:
						<ol> 
						<li>DVDs</li>
						<li>Audiobooks</li>
						<li>Software</li>
						</ol>
						We pride ourselves on offering a reliable, affordable, and friendly service and are always keen to learn what our customers think.
						So, good or bad, drop us a message and give us your thoughts! We look forward to hearing from you:)

						
			
						</p>
                        
                    </div>
                </div>
            </div>
        </section>








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
