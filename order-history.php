<?php 
session_start();
error_reporting(0);
include('includes/config.php');

$gprice = number_format($_SESSION['tp'], 2, '.', '');


unset($_SESSION['cart']);
unset($_SESSION['coupon_code']);

//  $gprice=intval($_GET['pri']);
?>

<style>
    
    .rating {
  float:left;
}

/* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
 follow these rules. Every browser that supports :checked also supports :not(), so
 it doesn’t make the test unnecessarily selective */
.rating:not(:checked) > input {
  position:absolute;
  top:-9999px;
  clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
  float:right;
  width:1em;
  padding:0 .1em;
  overflow:hidden;
  white-space:nowrap;
  cursor:pointer;
  font-size:200%;
  line-height:1.2;
  color:#ddd;
  text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
  content: '★ ';
}

.rating > input:checked ~ label {
  color: #f70;
  text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
}
.rtn{
float: left;
width: 100%;
}
.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
  color: gold;
  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
  color: #ea0;
  text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > label:active {
  position:relative;
  top:2px;
  left:2px;
}

.checked{
color: orange;
}
</style>

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

	    <title>Order History</title>
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

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	<script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<!-- ============================================== HEADER : END ============================================== -->



<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
		<?php
		$ret=mysqli_query($con,"select category.categoryName as catname,subCategory.subcategory as subcatname,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid' ");
			while ($rw=mysqli_fetch_array($ret)) {

?>
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
			<?php }?>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<!-- <?php 
//$pid= $_GET['pid']
?> -->



		
		




<div class="body-content outer-top-xs">
	<div class="container">
		<div class="col-md-6">

		<?php $query=mysqli_query($con,"select productId from orders where userId='".$_SESSION['id']."' and paymentMethod is not null order by id DESC");

$cnt=1;
$num=mysqli_num_rows($query);

while($row=mysqli_fetch_array($query))
{
		$pid = $row['productId'];
?>
		
		
		<?php } ?>
		
		
		</div>
		
		
	<div class="body-content outer-top-xs">
    <div class="container">
      <div class="row inner-bottom-sm">
        <div class="shopping-cart">
          <div class="col-md-12 col-sm-12 shopping-cart-table ">
            <table class='table table-bordered'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Image</th>
                    <th scope='col'>Product Name</th>
                    <th scope='col'>Quantity</th>
                    <th scope='col'>Price</th>
                    <th scope='col'>Shipping</th>
                    <th scope='col'>Order Date</th>
                    <th scope='col'>Action</th>
                    <th scope='col'>Feedback</th>
                    <!--<th scope='col'>Total</th>-->
                    <th scope='col'>Total Including Discount </th>
                  </tr>
                  
                </thead>

                <tbody>
                <h3>Latest Order</h3>
                
            <!-- Unique Id -->

            <?php 
            $ret=mysqli_query($con,"SELECT DISTINCT(un_id) as d FROM orders");
            $num=mysqli_num_rows($ret);
            
            if($num>0)
            {
              while ($row=mysqli_fetch_array($ret)) 
              {
                $date=$row['d'];              
                // echo $date  ;
              }            

            }

          

          $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid, orders.final_price as ofinal from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.un_id='$date' and orders.paymentMethod is not null ");
            
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
                // echo $total;
              $deci=number_format($total, 2, '.', '');
              
              
            
    		
              

              echo "               
                
                  <tr>                    
                    <td>$cnt</td>
                    <td>
                    <img src='admin/productimages/$p_id/$img' alt='' width='84' height='146'>                    
                    </td>
                    ";
                    
                    echo "
                    <td class='cart-product-name-info'><h4 class='cart-product-description'><a href='product-details.php?pid=$pro_id'>$pname</a></h4>
                       ";
                       
                       
                        $pid=$row['opid'];
				 	
    					$sel="select round(AVG(r.ratting),1) as rr from ratting r
                            join products p ON r.pid = p.id WHERE r.pid='$pid' AND r.isapproved='1'";
                            
    					$rs=mysqli_query($con,$sel);
    					$rss=mysqli_fetch_array($rs);
    					
    					$i = 1;
                            while ($i <= 5) {
                                            
                              if ($i <= $rss['rr']) {
                                                
                                 echo '<span class="fa fa-star checked"></span>';
                                  }else {
                                               
                                    echo '<span class="fa fa-star"></span>';
                                            }
                                      $i++;
                                        }
                       
                       
                       
                       
                    
                    echo "
                    </td>
                    ";        
                    
                    echo "
                    <td>$qty</td>
                    <td>$price</td>
                    <td>$shipping</td>
                    
                    <td>$odate</td>
                    <td>
                    <a href='track-order.php?oid=$o_id' target='_blank' title='Track order'>
                    Track</td>
                    ";
                    
                   
                    
                    echo"
                    <td>
                    ";
                    ?>
                    
                         <!--<a href='product_feedback.php?pid=<?php echo $pro_id ?>' class='btn btn-primary'>Feedback</a>-->
                         
                         <?php 
								        $test="select * from ratting where user_id='".$_SESSION['id']."' and pid=$pro_id";
								        $run=mysqli_query($con,$test);
								        $num=mysqli_num_rows($run);
								        
								        while($row=mysqli_fetch_array($run))
								            {
								                $status=$row['status'];
								                $id=$row['pid'];
								                $un=$row['un_id'];
								            }
								        
								      
								    ?>
								    
								    <?php 
								        
								        if($status='yes' && $id==$pro_id )
								        {
								            
								     ?>
								        <a href="javascript:void(0);" class="btn btn-primary"
    										onClick="popUpWindow('product_feedback.php?pid=<?php echo $p_id; ?>');"
    										title="Feedback" disabled >
    										Feedback
									    	</a>
								            
								    <?php
								        }else{
								            ?>
    								        <a href="javascript:void(0);" class="btn btn-primary"
    										onClick="popUpWindow('product_feedback.php?pid=<?php echo $p_id;?>');"
    										title="Feedback">
    										Feedback
									    	</a>
								            
								    <?php
								        }
								    ?>
                         
                         
                    <?php
                        echo"
                    </td>
                    ";
                    
                    

                    $cnt=$cnt+1;
                    
            }
                if($count>0)
                {
                    // $cntt = $cnt/2;
                    
                    echo "
                    <td rowspan='$cnt'><b> $gprice </b></td>
                    </tr>
                    ";
                }else{
                    echo "
                    
                    </tr>
                    ";
                }
                    
                   
            ?>
            
                    
          </tbody>
            
        </table>
          
          
		
		
		  
		
		
		
		
		
<div class="row inner-bottom-sm">
	<div class="shopping-cart">
		<div class="col-md-12 col-sm-12 shopping-cart-table ">

			<div class="table-responsive">
				<form name="cart" method="post">
					<br><br>
					
			
					<table class="table table-bordered">
						<thead>
							<tr>
								<th class="cart-romove item">#</th>
								<th class="cart-description item">Image</th>
								<th class="cart-product-name item">Product Name</th>

								<th class="cart-qty item">Quantity</th>
								<th class="cart-sub-total item">Price</th>
								<th class="cart-sub-total item">Shipping</th>
								<th class="cart-total item">Total Including Discount</th>
								
								<th class="cart-description item">Order Date</th>
								<th class="cart-total item">Action</th>
								<th class="cart-total last-item">Feedback</th>

							</tr>
						</thead><!-- /thead -->

						<tbody>
							<h3>Previous Orders</h3>
							<?php $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid, orders.final_price as ofinal from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.un_id!='$date' and orders.paymentMethod is not null ");
                                $cnt=1;
                                if($num>0){
                                while($row=mysqli_fetch_array($query))
                                {
                                   $proid=$row['proid'];
                                   $opid=$row['opid'];
                                ?>
							<tr>
								<td><?php echo $cnt;?></td>
								<td class="cart-image">
									<a class="entry-thumbnail">
										<img src="admin/productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>"
											alt="" width="84" height="146">
									</a>
								</td>
								<td class="cart-product-name-info">
									<h4 class='cart-product-description'><a
											href="product-details.php?pid=<?php echo $row['opid'];?>">
											<?php echo $row['pname'];?></a></h4>

									<?php 
						
                    				 	$pid=$row['opid'];
                    				 	
                    					$sel="select round(AVG(r.ratting),1) as rr from ratting r
                                            join products p ON r.pid = p.id WHERE r.pid='$pid' AND r.isapproved='1'";
                                            
                    					$rs=mysqli_query($con,$sel);
                    					$rss=mysqli_fetch_array($rs);
                    				    ?>
                    
                    									<?php 
                    					$i = 1;
                                            while ($i <= 5) {
                                                            
                                              if ($i <= $rss['rr']) {
                                                                
                                                 echo '<span class="fa fa-star checked"></span>';
                                                  }else {
                                                               
                                                    echo '<span class="fa fa-star"></span>';
                                                            }
                                                      $i++;
                                                        }
                    								    
                    				 ?>

								</td>
								<td class="cart-product-quantity">
									<?php echo $qty=$row['qty']; ?>
								</td>
								<td class="cart-product-sub-total"><?php echo $price=$row['pprice']; ?> </td>
								<td class="cart-product-sub-total"><?php echo $shippcharge=$row['shippingcharge']; ?>
								</td>
								<!--<td class="cart-product-grand-total"><?php echo number_format(($qty*$price)+$shippcharge, 2, '.', '');?></td>-->
								<td> <?php echo $ofinal=$row['ofinal']; ?></td>
								<!--<td class="cart-product-sub-total"><?php echo $row['paym']; ?>  </td>-->

								<td class="cart-product-sub-total"><?php echo $row['odate']; ?> </td>

								<td>
									<a href="javascript:void(0);"
										onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']);?>');"
										title="Track order">
										Track
										</a>
								</td>

								<td>
								    <?php 
								        $test="select * from ratting where user_id='".$_SESSION['id']."' and pid=$proid";
								        $run=mysqli_query($con,$test);
								        $num=mysqli_num_rows($run);
								        
								        while($row=mysqli_fetch_array($run))
								            {
								                $status=$row['status'];
								                $id=$row['pid'];
								                $un=$row['un_id'];
								            }
								        
								      
								    ?>
								    
								    <?php 
								        
								        if($status='yes' && $id==$proid )
								        {
								            
								     ?>
								        <a href="javascript:void(0);" class="btn btn-primary"
    										onClick="popUpWindow('product_feedback.php?pid=<?php echo $opid; ?>');"
    										title="Feedback" disabled>
    										Feedback
									    	</a>
								            
								    <?php
								        }else{
								            ?>
    								        <a href="javascript:void(0);" class="btn btn-primary"
    										onClick="popUpWindow('product_feedback.php?pid=<?php echo $opid;?>');"
    										title="Feedback">
    										Feedback
									    	</a>
								            
								            <?php
								        }
								    ?>
								    
								    
								</td>



							</tr>
							<?php $cnt=$cnt+1;} ?>
							<?php }else{ ?>
							<tr>
								<td colspan="10" align="center">
									<h4>No Result Found</h4>
								</td>
							</tr>
							<?php	}?>
						</tbody>
					</table>

			</div>
		</div>

	</div><!-- /.shopping-cart -->
	<div class="col-md-12" style="text-align:center;"><a href="my-account.php" class="btn btn-primary" >Go Back to My Account</a></div>
</div> <!-- /.row -->

</form>

</div><!-- /.container -->

</div><!-- /.body-content -->


	



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
	
	<!--<script src="switchstylesheet/switchstylesheet.js"></script>-->
	
	<script>
// 		$(document).ready(function(){ 
// 			$(".changecolor").switchstylesheet( { seperator:"color"} );
// 			$('.show-theme-options').click(function(){
// 				$(this).parent().toggleClass('open');
// 				return false;
// 			});
// 		});

// 		$(window).bind("load", function() {
// 		   $('.show-theme-options').delay(2000).trigger('click');
// 		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>