<?php
session_start();
error_reporting(0);
include('includes/config.php');

// $date=$_GET['un'];

if (strlen($_SESSION['login']) == 0) {
	header('location:login.php');
} else {
        
        $q="select un_id from orders order by un_id DESC LIMIT 1";
        $r=mysqli_query($con,$q);
        $ro=mysqli_fetch_array($r);
        $unique=$ro['un_id'];
        
        // echo $unique;
        
	    $user_id = $_SESSION['id'];
	    
	    $query = mysqli_query($con, "select email,name from users where id=$user_id");
	    $user_email =$_SESSION['email'];
	    
	    while($row = mysqli_fetch_assoc($query))
        {
            $user_email = $row['email'];
            $user_name = $row['name'];
        }
        
        
        
	    $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid, orders.final_price as ofinal from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.un_id='$unique' ");
            
          $count=mysqli_num_rows($query);
          $cnt=1;
          while($row=mysqli_fetch_array($query))
            {
              $pro_id=$row['opid'];
              $img=$row['pimg1'];
              $pname=$row['pname'];
              $p_id=$row['proid'];
              $qty=$row['qty'];
              $price=$row['pprice'];
              $shipping=$row['shippingcharge'];
              $odate=$row['odate'];
              $o_id=$row['orderid'];
                  
              
              $total=($qty*$price)+$shipping;
            
              $gprice=$row['ofinal'];
              $deci=number_format($total, 2, '.', ''); 
              
              
                $to_email="sales@softlysoftware.co.uk";
                $body="A new order has placed by $user_email. 
                Product Id=$pro_id, 
                product Name=$pname,
                quanity=$qty";
                $subject = "Softly Software Order Received";
                $headers = "From: noreply@softlysoftware.co.uk" . "\r\n" .
                "CC: somebodyelse@example.com";
    
    		    $send=mail($to_email,$subject,$body,$headers);
    		   
    		if($send)
    		{
    		    header('location:order-history.php');
    		}else{
    		    echo 'Message could not be sent.';
    		}
              
              
              
            }
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
    		    header('location:order-history.php');
    		}else{
    		    echo 'Message could not be sent.';
    		}
        }
    	
}
?>