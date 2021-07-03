<?php
session_start();
error_reporting(0);
include('include/config.php');

if(isset($_POST['submit']))
{
$email=$_POST['email'];
$query=mysqli_query($con,"insert into subscriber (email) values('$email')");

}


// Email

include('includes/config.php');

$result="";
//get data from form  
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$to = "sales@softlysoftware.co.uk";
$subject = "New Subcription";
$txt =" Email = " . $email;
$headers = "From: noreply@softlysoftware.co.uk" . "\r\n" .
"CC: somebodyelse@example.com";
$body="Hi $email, Thanks for subcribing us. Please visit out site https://www.softlysoftware.co.uk/ to checkout more.";


if($email!=NULL){
    mail($to,$subject,$txt,$headers);
    $result="Thanks For subscribing";
    mail($email,$subject,$body,$headers);
}
//redirect
 header('Location:../includes/thanks_sub.php');

?>




<style>
    .tt:hover{
        color:#1FD4E4;
    }
</style>
<footer id="footer" class="footer color-bg">
	  <div class="links-social inner-top-sm">      
        <div class="container">
            <div class="row">
            	<div class="col-xs-12 col-sm-6 col-md-4">
                     <!-- === CONTACT INFO === -->
                    <div class="contact-info">                       
                        <div class="contact-timing">
                            <div class="module-heading">
                                <h4 class="module-title">DISCOVER US</h4>
                            </div><!-- /.module-heading -->

                            <ul class="toggle-footer" style="">
                                    <div class="media-body">
                                        <h6>
                                        <a href="aboutus.php" style=" color:#666666;"><span class="tt">About Us</span></a></h6>
                                    </div>  

                                    <div class="media-body">
                                        <h6><a href="privacypolicy.php" style="text-decoration: none; color:#666666;"><span class="tt">Privacy Policy</span></a></h6>
                                    </div>      
                                    
                                    <div class="media-body">
                                        <h6><a href="termsandconditions.php" style="text-decoration: none; color:#666666;"><span class="tt">Terms and Conditions</span></a></h6>
                                    </div>  
                            </ul>

                        </div><!-- /.module-body -->

                        
                    </div><!-- /.contact-info -->
                </div>
           
            
            	<div class="col-xs-12 col-sm-6 col-md-4">
            		 
                    <div class="row">
  <div class="col-8">
  <div class="module-heading">
		<h4 class="module-title text-center">JOIN NEWSLETTER</h4>
	</div><!-- /.module-heading -->
	<?=$result;?>
    <div class="form-group mb-0">
      <form action="" method="post">     
                     <div class="input-email input-icon">
                        <input class="form-control" type="email" name="email" required placeholder="Enter your email" required>
                    </div>
                    <br>
                    <div class="col-4">
                        <div class="form-group mb-0">
                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
                
    </div>
  </div>
 

 
        
	
        
</div>
<!-- ============================================================= CONTACT TIMING : END ============================================================= -->            	</div><!-- /.col -->

            	<div class="col-xs-12 col-sm-6 col-md-4">
            		 <!-- ============================================================= INFORMATION============================================================= -->
<div class="contact-information" style="float:right;">
	<div class="module-heading">
		<h4 class="module-title">CONTACT INFORMATION</h4>
	</div><!-- /.module-heading -->

	
        <ul class="toggle-footer" style="">
            <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <p>
                    High Street <br> 
                    Kirton <br>
                    Boston <br>
                    Lincolnshire <br>
                    PE20 1ED <br>
                    United Kingdom
                    
                    
                    
                    </p>
                </div>
           

              <li class="media">
                <div class="pull-left">
                     <span class="icon fa-stack fa-lg">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="media-body">
                    <span><a href="mailto:sales@gamestocker.co.uk">Sales@gamestocker.co.uk</a></span>
                </div>
            </li>
              
            </ul>
    
</div><!-- /.contact-timing -->
<!-- === INFORMATION : END == -->            	</div><!-- /.col -->




            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.links-social -->

    

    