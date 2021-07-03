<?php
session_start();
error_reporting(0);

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require_once "vendor/autoload.php";

include('includes/config.php');




if (strlen($_SESSION['login']) == 0) {
	header('location:login.php');
} else {

		mysqli_query($con, "update orders set paymentMethod='PAYPAL' where userId='".$_SESSION['id']."' and paymentMethod is null");
		unset($_SESSION['cart']);
		unset($_SESSION['coupon_code']);
		
		
	    $user_id = $_SESSION['id'];
	    $query = mysqli_query($con, "select email,name from users where id=$user_id");
	
        //  Email After Purchasing 

        while($row = mysqli_fetch_assoc($query))
        {
            $to_email = $row['email'];
            $to_name = $row['name'];
            
            $body="Your order has been received successfully.
     		I will notify you again when your order has been shipped.
     		King regards, Kelly";
            $subject = "Softly Software Order Received";
            $headers = "From: sales@softlysoftware.co.uk" . "\r\n" .
            "CC: somebodyelse@example.com";
    
    		$send=mail($to_email,$subject,$body,$headers);
    		   
    		if($send)
    		{
    		    header('location:order-confirmation.php?un='.$un);
    		}else{
    		    echo 'Message could not be sent.';
    		}
        }
    	
	
	
	
	       

// 	while ($row = mysqli_fetch_assoc($query)) {
// 		$to_email = $row['email'];
// 		$to_name = $row['name'];
	    

// 		$mail = new PHPMailer(true);
// 		$mail->isSMTP();
// 		$mail->Host = 'mail.softlysoftware.co.uk';
// 		$mail->SMTPAuth = true;
// 		$mail->Username = 'test@softlysoftware.co.uk';
// 		$mail->Password = 'wQY[o-$,&A$v';
// 		$mail->SMTPSecure = 'ssl';
// 		$mail->Port = 465;


// 		$mail->From = "sales@softlysoftware.co.uk";
// 		$mail->FromName = "Automated Email";

// 		$mail->addAddress($to_email, $to_name);

// 		$mail->isHTML(true);

// 		$mail->Subject = "Softly Software Order Received";
// 		$mail->Body = "Your order has been received successfully.
// 		I will notify you again when your order has been shipped.
// 		King regards, Kelly";

// 		if (!$mail->send()) {
// 			echo 'Message could not be sent.';
// 			echo 'Mailer Error: ' . $mail->ErrorInfo;
// 		} else {
// 			header('location:order-history.php');
// 		}

// 	}
}
?>