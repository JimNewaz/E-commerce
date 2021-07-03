<style>
    .a{
	height:450px;
	width:458px;
	max-width:100%;
    max-height:100%;
}
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

.btn-disabled,
.btn-disabled[disabled] {
  opacity: .4;
  cursor: default !important;
  pointer-events: none;
}
</style>
<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
					echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
		}
	}
}
$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
echo "<script>alert('Product added in wishlist');</script>";
header('location:my-wishlist.php');

}
}



?>
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
	    <title>Product Details</title>
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

	<!-- ============================================== TOP MENU ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== TOP MENU : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- ============================================== NAVBAR ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== NAVBAR : END ============================================== -->

</header>

<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<?php
			$ret=mysqli_query($con,"select category.categoryName as catname,subCategory.subcategory as subcatname,products.productName as pname from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
			while ($rw=mysqli_fetch_array($ret)) {

			?>


			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li><?php echo htmlentities($rw['catname']);?></a></li>
				<li><?php echo htmlentities($rw['subcatname']);?></li>
				<li class='active'><?php echo htmlentities($rw['pname']);?></li>
			</ul>
			<?php }?>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->



<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product outer-bottom-sm '>
			<!-- <div class='col-md-3 sidebar'>
				<div class="sidebar-module-container"> -->
					<!-- ============CATEGORY========= -->
					<!-- <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
						<h3 class="section-title">Category</h3>
							<div class="sidebar-widget-body m-t-10">
								<div class="accordion"> -->
		           				<!-- <?php $sql=mysqli_query($con,"select id,categoryName  from category");
								while($row=mysqli_fetch_array($sql))
								{
								?> -->
	    					<!-- <div class="accordion-group">
								<div class="accordion-heading">
									<a href="category.php?cid=<?php echo $row['id'];?>"  class="accordion-toggle collapsed">
									<?php echo $row['categoryName'];?>
									</a>
								</div> -->
	          
	        				<!-- </div>
	        					<?php } ?>
	    			</div>
				</div>
			</div> -->
	<!-- ============================================== CATEGORY : END ============================================== -->					<!-- ============================================== HOT DEALS ============================================== -->
<!-- <div class="sidebar-widget hot-deals wow fadeInUp">
	<h3 class="section-title">hot deals</h3>
		<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
								   <?php
						$ret=mysqli_query($con,"select * from products order by rand() limit 4 ");
						while ($rws=mysqli_fetch_array($ret)) {

						?>

								        
					<div class="item">
					<div class="products">
						<div class="hot-deal-wrapper">
							<div class="image">
								<img src="admin/productimages/<?php echo htmlentities($rws['id']);?>/<?php echo htmlentities($rws['productImage1']);?>"  width="200" height="334" alt="">
							</div>
							
						</div>
						

						<div class="product-info text-left m-t-20">
							<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($rws['id']);?>"><?php echo htmlentities($rws['productName']);?></a></h3>
							<div class="rating rateit-small"></div>

							<div class="product-price">	
								<span class="price">
									GBP. <?php echo htmlentities($rws['productPrice']);?>
								</span>
									
							    <span class="price-before-discount">GBP.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>					
							
							</div>
							
						</div>

						<div class="cart clearfix animate-effect">
							<div class="action">
								
								<div class="add-cart-button btn-group">
									<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<?php if($row['productAvailability']=='In Stock'){?>
										<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
							<button class="btn btn-primary" type="button">Add to cart</button></a>
								<?php } else {?>
							<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
															
								</div>
								
							</div> -->
							<!-- /.action -->
						<!-- </div> -->
						<!-- /.cart -->
					<!-- </div>	
					</div>		
					<?php } ?>         -->
						
	    
    <!-- </div> -->
	<!-- /.sidebar-widget -->
<!-- </div> -->

<!--  COLOR: END  -->
				<!-- </div>
			</div> -->
			<!-- /.sidebar -->
<?php 
$ret=mysqli_query($con,"select * from products where id='$pid'");
while($row=mysqli_fetch_array($ret))
{

?>


<div class='col-md-12'>
	<div class="row wow fadeInUp">
		<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
            <div class="product-item-holder size-big single-product-gallery small-gallery">
                
                <div id="owl-single-product">
                    <div class="single-product-gallery-item" id="slide1">
                        
                        <img class="a" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="370" height="350" />
                          
                    </div>
                    <!-- /.single-product-gallery-item -->
            

                    <div class="single-product-gallery-item" id="slide2">
                        
                                      <?php
                        $pid=$row['id'];
						$t ="select productImage2 from products where id=$pid";
						$runnn= mysqli_query($con, $t);
						$st=mysqli_fetch_array($runnn);
						

						if(!($st['productImage2'])){
							echo'<a href="/" class="btn-disabled" disabled="disabled"><img class="a" width="370" height="350" src="https://media.istockphoto.com/vectors/no-image-available-sign-vector-id922962354?k=6&m=922962354&s=612x612&w=0&h=_KKNzEwxMkutv-DtQ4f54yA5nc39Ojb_KPvoV__aHyU="</a>';
						}else{										
										
					?> 
                        
                         <img class="a" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>"width="370" height="350" />
                        <?php } ?>
                    </div><!-- /.single-product-gallery-item -->

                    <div class="single-product-gallery-item" id="slide3">
                        
                         <?php
                        $pid=$row['id'];
						$t ="select productImage3 from products where id=$pid";
						$runnn= mysqli_query($con, $t);
						$st=mysqli_fetch_array($runnn);
						

						if(!($st['productImage3'])){
							echo'<a href="/" class="btn-disabled" disabled="disabled"><img class="a" width="370" height="350" src="https://media.istockphoto.com/vectors/no-image-available-sign-vector-id922962354?k=6&m=922962354&s=612x612&w=0&h=_KKNzEwxMkutv-DtQ4f54yA5nc39Ojb_KPvoV__aHyU="</a>';
						}else{										
										
					?> 
                        
                        <img class="a" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>" width="370" height="350"/>
                        <?php } ?>
                    </div>
                </div><!-- /.single-product-slider -->
            

                <div class="single-product-gallery-thumbs gallery-thumbs">
                    <div id="owl-single-product-thumbnails">
                        <div class="item">
                            <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
                                    
            						<img class="" width="85" height="85" alt="" src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"/>
            						
                            </a>
                            
                        </div>

                        <div class="item">
                            <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                        
                                   <?php
                        $pid=$row['id'];
						$t ="select productImage2 from products where id=$pid";
						$runnn= mysqli_query($con, $t);
						$st=mysqli_fetch_array($runnn);
						

						if(!($st['productImage2'])){
							echo'<a href="/" class="btn-disabled" disabled="disabled"><img class="" width="85" height="85" src="https://media.istockphoto.com/vectors/no-image-available-sign-vector-id922962354?k=6&m=922962354&s=612x612&w=0&h=_KKNzEwxMkutv-DtQ4f54yA5nc39Ojb_KPvoV__aHyU="</a>';
						}else{										
										
					?> 
                        
						 <img class="" width="85" height="85" alt="" src="admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($st['productImage2']);?>" 
						 data-echo="admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($st['productImage2']);?>"/> 
                    
                    <?php } ?>
					
					            
                            </a>
                        </div>
                <div class="item">
                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide3"> 
                        
                        <?php
                        $pid=$row['id'];
						$t ="select productImage3 from products where id=$pid";
						$runnn= mysqli_query($con, $t);
						$st=mysqli_fetch_array($runnn);
						

						if(!($st['productImage3'])){
							echo'<a href="/" class="btn-disabled" disabled="disabled"><img class="" width="85" height="85" src="https://media.istockphoto.com/vectors/no-image-available-sign-vector-id922962354?k=6&m=922962354&s=612x612&w=0&h=_KKNzEwxMkutv-DtQ4f54yA5nc39Ojb_KPvoV__aHyU="</a>';
						}else{										
										
					?> 
                        
						 <img class="" width="85" height="85" alt="" src="admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($st['productImage3']);?>" 
						 data-echo="admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($st['productImage3']);?>"/> 
                    
                    <?php } ?>
                    </a>
                </div>
            </div><!-- /#owl-single-product-thumbnails -->
        </div>
    </div>
</div>     			

<div class='col-sm-6 col-md-7 product-info-block'>
	<div class="product-info">
		<h1><?php echo htmlentities($row['productName']);?></h1>
                <?php $rt=mysqli_query($con,"select * from ratting where pid='$pid'");
                $num=mysqli_num_rows($rt);
                {
                ?>		
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<!--<div class="rating rateit-small"></div>-->
										<?php 
											$pid=$_GET['pid'];
											$sel="SELECT ROUND(AVG(ratting),1) as r FROM ratting WHERE pid='$pid' AND isapproved='1'";
											$rs=mysqli_query($con,$sel);
								 			$rss=mysqli_fetch_array($rs);
										?>
										
										<?php 
								
								    
								    $i = 1;
                                    while ($i <= 5) {
                                        
                                        if ($i <= $rss['r']) {
                                            
                                            echo '<span class="fa fa-star checked"></span>';
                                        }else {
                                           
                                        echo '<span class="fa fa-star"></span>';
                                        }
                                        $i++;
                                    }
								    
																			    ?>
									
									
												

										<?php 
								// 		for($j=1;$j<=5-intval($rss['r']);$j++)
								// 		{
										?>
										
									<?php  
								// 	} 
									?>
												
                                            
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">(<?php echo htmlentities($num);?> Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->
							
<?php } ?>

                            <div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Add To Wishlist :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<div class="favorite-button m-t-0">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">
											    <i class="fa fa-heart"></i>
											</a>
											
											</a>
										</div>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>
                            
                            <hr>
                    
                            <div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Condition :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php echo htmlentities($row['procondition']);?></span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>

                            
                            
							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">
											    <?php if($row['productAvailability']=='Out of Stock')
											{
												echo '<span style="color:red;">Out Of Stock</span>';
											}
											else
											{
												echo htmlentities($row['productAvailability']);
											}

											?>
											    
											    
											    
											    
											    
											    <?php 
											 //   echo htmlentities($row['productAvailability']);
											    
											    
											    ?>
											</span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>



<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Product Brand :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php echo htmlentities($row['productCompany']);?></span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>


<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Shipping Charge :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value"><?php if($row['shippingCharge']==0)
											{
												echo "Free";
											}
											else
											{
												echo htmlentities($row['shippingCharge']);
											}

											?></span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div>

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">GBP <?php echo htmlentities($row['productPrice']);?></span>
											<!--<span class="price-strike">GBP <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>-->
										</div>
									</div>




									<!--<div class="col-sm-6">-->
									<!--	<div class="favorite-button m-t-10">-->
									<!--		<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist">-->
									<!--		    <i class="fa fa-heart"></i>-->
									<!--		</a>-->
											
									<!--		</a>-->
									<!--	</div>-->
									<!--</div>-->

								</div><!-- /.row -->
							</div><!-- /.price-container -->

	




							<div class="quantity-container info-container">
								<div class="row">
									
									<div class="col-sm-1">
										<span class="label">Qty :</span>
									</div>
									
									<div class="col-sm-2">
									    <?php if($row['productAvailability']=='In Stock'){?>
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient">
												  <span class="ir">
												  <i class="icon fa fa-sort-asc"></i>
												  </span>
												  </div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1" class="edit-items" max="3">
								                
							              </div>
							              
													<?php } else {?>
                                        
														<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient">
												  <span class="ir">
												  <i class="icon fa fa-sort-asc"></i>
												  </span>
												  </div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <fieldset disabled> <input type="text" value="0" disabled="disabled">  </filedset>
							              </div>

										<?php } ?>
							            </div>
									    
									   
									    
									    
									    
									    
										<!--<div class="cart-quantity">-->
										<!--	<div class="quant-input">-->
								  <!--              <div class="arrows">-->
								  <!--                <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>-->
								  <!--                <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>-->
								  <!--              </div>-->
								  <!--              <input type="text" value="1">-->
							            <!--  </div>-->
							            <!--</div>-->
									</div>

									<div class="col-sm-7" style="margin-left:-7px;">
<?php if($row['productAvailability']=='In Stock'){?>
										<a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
													<?php } else {?>
							<div class="action">
							    <!--Out of Stock-->
							    
							    
							    </div>
					<?php } ?>
									</div>

									
								</div><!-- /.row -->
								<p style="font-size:10px; color:ash;">*You can select upto 3</p>
							</div><!-- /.quantity-container -->

							
							<div class="container">
								<div class="row">
									<div class="payment">										
										<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYEyryIy3wP0Goweujxksnag20MVSx9HPeM-kPyAA57Ff-Vm4kRo8PxvcgKQYViimR3Q&usqp=CAU" width="300px" alt="">
									</div>
								</div>
							</div>
							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->

				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?php echo $row['productDescription'];?></p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
										<h4 class="title">Customer Reviews</h4>
										<hr>
									</div>	
										
										<?php
											$pid=$_GET['pid'];
											$sel="SELECT * FROM ratting where pid='$pid' AND isapproved='1'";
											$rs=$con->query($sel);
											while($row=$rs->fetch_assoc()){
											?>
											<div class="row">
											    
												<div class="col-md-12">
												    
												<h4><?php echo $row['name']; ?></h4>
												<p>
												<?php for($i=1;$i<=$row['ratting'];$i++){ ?>
												<span class="fa fa-star checked"></span>
												<?php  }?>

												<?php for($j=1;$j<=5-$row['ratting'];$j++) {?>
											<span class="fa fa-star "></span>
												<?php  } ?>
											</p>

											<p><?php echo $row['review'] ?></p>
											<br>
                                            <h6><?php echo $row['reviewdate'];      ?></h6>
											<hr/>
												</div>
											</div>
                                            
                                            
											<?php  } ?>		
											
											
											
											
											
											
											
											
											
											
											
                                          
										
										
							        </div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

				

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
					
				</div><!-- /.product-tabs -->
				
				
		<?php $cid=$row['category'];
			$subcid=$row['subCategory']; } ?>
				<!-- === UPSELL PRODUCTS ====== -->


<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div>

</div>
</div>
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
		
	    document.getElementsByClassName('edit-items')[0].oninput = function () {
        var max = parseInt(this.max);

        if (parseInt(this.value) > max) {
            this.value = max; 
        }
    }
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>

