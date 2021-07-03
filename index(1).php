<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Dynamic Cart 

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
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


?>


<style>
    .rating {
        float: left;
    }

    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
 follow these rules. Every browser that supports :checked also supports :not(), so
 it doesn’t make the test unnecessarily selective */
    .rating:not(:checked)>input {
        position: absolute;
        top: -9999px;
        clip: rect(0, 0, 0, 0);
    }

    .rating:not(:checked)>label {
        float: right;
        width: 1em;
        padding: 0 .1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 200%;
        line-height: 1.2;
        color: #ddd;
        text-shadow: 1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0, 0, 0, .5);
    }

    .rating:not(:checked)>label:before {
        content: '★ ';
    }

    .rating>input:checked~label {
        color: #f70;
        text-shadow: 1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0, 0, 0, .5);
    }

    .rtn {
        float: left;
        width: 100%;
    }

    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: gold;
        text-shadow: 1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0, 0, 0, .5);
    }

    .rating>input:checked+label:hover,
    .rating>input:checked+label:hover~label,
    .rating>input:checked~label:hover,
    .rating>input:checked~label:hover~label,
    .rating>label:hover~input:checked~label {
        color: #ea0;
        text-shadow: 1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0, 0, 0, .5);
    }

    .rating>label:active {
        position: relative;
        top: 2px;
        left: 2px;
    }

    .checked {
        color: orange;
    }

    .action {
        margin-bottom: 10px;
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

    <title>Softly Software</title>

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
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

</head>

<body class="cnt-home">

    <?php include('sidecontact.php')?>

    <!-- ===== HEADER ===== -->
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
        <?php include('includes/menu-bar.php');?>
    </header>

    <style>
        #return-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgb(0, 0, 0);
            background: #1FD4E4;
            width: 50px;
            height: 50px;
            display: block;
            text-decoration: none;
            -webkit-border-radius: 35px;
            -moz-border-radius: 35px;
            border-radius: 35px;
            display: none;
            -webkit-transition: all 0.3s linear;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        #return-to-top i {
            color: #fff;
            margin: 0;
            position: relative;
            left: 16px;
            top: 13px;
            font-size: 19px;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        #return-to-top:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        #return-to-top:hover i {
            color: #fff;
            top: 5px;
        }

        .wishlist {
            background: #a8a8a8;
            padding: 8px 10px 10px !important;
            /*margin-left: 10px;*/
            color: #fff !important;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        .wishlist:hover {
            background: #1FD4E4;
        }
    </style>

    <!-- ====== HEADER : END ====== -->

    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container homepage-container">
                <div class="">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="main-content">
                                <!-- ===== SECTION – HERO === -->
                                <div id="hero" class="homepage-slider3">
                                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                        <div class="full-width-slider">
                                            <div class="item"
                                                style="background-image: url(assets/images/sliders/movie-reel.png);">


                                                <!-- /.container-fluid -->
                                            </div><!-- /.item -->
                                        </div><!-- /.full-width-slider -->

                                        <div class="full-width-slider">
                                            <div class="item full-width-slider"
                                                style="background-image: url(assets/images/sliders/History-of-Audiobooks.jpg);">
                                            </div>
                                        </div>

                                        <div class="full-width-slider">
                                            <div class="item full-width-slider"
                                                style="background-image: url(assets/images/sliders/software.png);">
                                            </div>
                                        </div>
                                        <!-- /.full-width-slider -->
                                    </div><!-- /.owl-carousel -->
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>


                <!-- === SECTION – HERO : END === -->

                <!-- ==== INFO BOXES ========= -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green"><span id="icon"></span>&nbsp;Order Online
                                            </h4>
                                        </div>
                                    </div>
                                    <h6 class="text">365 days a year</h6>
                                </div>
                            </div><!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading orange"><span id="icon"><i
                                                        class="icon fa fa-truck"></i></span>&nbsp;free shipping</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">On all orders</h6>
                                </div>
                            </div><!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading red"><span id="icon"></i></span>&nbsp;DVD Sale
                                            </h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Buy 1, Get 1 50% off </h6>
                                </div>
                            </div><!-- .col -->
                        </div><!-- /.row -->
                    </div><!-- /.info-boxes-inner -->
                </div><!-- /.info-boxes -->
                <!-- ===== INFO BOXES : END ===== -->

            </div><!-- /.homebanner-holder -->
        </div><!-- /.row -->
        <div class="clearfix"></div>
        <br>

        <!-- == SCROLL TABS == -->
        <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
            <div class="more-info-tab clearfix">
                <ul class="nav nav-tabs nav-tab-line " id="new-products-1">
                    <li class=""><a href="#all" data-toggle="tab">All</a></li>
                    <li><a href="#software" data-toggle="tab">SOFTWARE</a></li>
                    <li><a href="#dvds" data-toggle="tab">DVDS</a></li>
                    <li><a href="#audio" data-toggle="tab">AUDIOBOOKS</a></li>
                </ul><!-- /.nav-tabs -->
            </div>

            <!-- New Section -->
            <div class="container">
                <div class="row">
                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <?php
            							$ret=mysqli_query($con,"select * from products order by id DESC LIMIT 10");
            							while ($row=mysqli_fetch_array($ret)) 
            							{
            								# code...
            
            							?>


                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-center">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <?php echo htmlentities($row['productName']);?></a></h3>
                                                    
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <div class="">
                                                        <?php 
                                        				 	$pid=$row['id'];
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
                                                    </div>
                                                        <span class="price">
                                                            GBP <?php echo htmlentities($row['productPrice']);?>
                                                        </span>
                                                    </div><!-- /.product-price -->
                                                </div><!-- /.product-info -->


                                                <?php if($row['productAvailability']=='In Stock'){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a>

                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </div>
                                                <?php } else {?>

                                                <div class="action" style="color:red">Out of Stock &nbsp;

                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>



                                                </div>
                                                <?php } ?>

                                                
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <?php } ?>

                                </div><!-- /.home-owl-carousel -->
                            </div><!-- /.product-slider -->
                        </div>
                        <!--Here was DVDS and Software-->
                        
                        
                        <div class="tab-pane" id="dvds">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php
                                        $ret=mysqli_query($con,"select * from products where category=12 order by RAND(id) LIMIT 10");
                                          while ($row=mysqli_fetch_array($ret)) 
                                          {
                                          ?>


                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                width="200" height="300" alt=""></a>
                                                    </div>
                        
                        
                                                </div>
                        
                        
                                                <div class="product-info text-center">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                    </h3>
                                                    <div class=""></div>
                                                    <div class="description"></div>
                        
                                                    <div class="product-price">
                                                        <div class="">
                                                        <?php 
                                        				 	$pid=$row['id'];
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
                                                    </div>
                                                        <span class="price">
                                                            GBP <?php echo htmlentities($row['productPrice']);?> </span>
                                                        <!--<span class="price-before-discount">GBP <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>-->
                        
                                                    </div>
                        
                                                </div>
                                                <?php if($row['productAvailability']=='In Stock'){?>
                                                <div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a>
                                                        <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                         </a>
                                                        
                                                        </div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                <?php } ?>
                                            </div>
                        
                                        </div>
                                    </div>
                                    <?php } ?>
                        
                        
                                </div>
                            </div>
                        </div>

                        
                        <!--software-->
                        <div class="tab-pane" id="software">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php
                        				$ret=mysqli_query($con,"select * from products where category=14 order by id DESC LIMIT 10");
                        					while ($row=mysqli_fetch_array($ret)) 
                        					{
                        						# code...
                        			?>
                        
                        
                                    <div class="item item-carousel">
                                        <div class="products">
                        
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                width="200" height="300" alt=""></a>
                                                    </div><!-- /.image -->
                                                </div><!-- /.product-image -->
                        
                        
                                                <div class="product-info text-center">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                    </h3>
                                                    <div class=""></div>
                                                    <div class="description"></div>
                        
                                                    <div class="product-price">
                                                        <div class="">
                                                        <?php 
                                        				 	$pid=$row['id'];
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
                                                    </div>
                                                        <span class="price">
                                                            GBP <?php echo htmlentities($row['productPrice']);?>
                                                        </span>
                        
                                                        
                                                    </div><!-- /.product-price -->
                                                </div>
                        
                                                <!-- /.product-info -->
                                                <?php if($row['productAvailability']=='In Stock'){?>
                                                <div class="action">
                                                    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">
                                                        Add to Cart</a>
                        
                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock &nbsp;
                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </div><!-- /.product -->
                        
                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <?php } ?>
                        
                        
                                </div><!-- /.home-owl-carousel -->
                            </div><!-- /.product-slider -->
                        </div>
                                                
                        
                        
                        <!--Audio Books-->
                        
                        
                        <div class="tab-pane" id="audio">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                    <?php
                        				$ret=mysqli_query($con,"select * from products where category=13 order by id DESC LIMIT 10");
                        					while ($row=mysqli_fetch_array($ret)) 
                        					{
                        						# code...
                        			?>
                        
                        
                                    <div class="item item-carousel">
                                        <div class="products">
                        
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                width="200" height="300" alt=""></a>
                                                    </div><!-- /.image -->
                                                </div><!-- /.product-image -->
                        
                        
                                                <div class="product-info text-center">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                    </h3>
                                                    <div class=""></div>
                                                    <div class="description"></div>
                        
                                                    <div class="product-price">
                                                        
                                                        <div class="">
                                                            <?php 
                                            				 	$pid=$row['id'];
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
                                                        </div>
                                                        
                                                        <span class="price">
                                                            GBP <?php echo htmlentities($row['productPrice']);?>
                                                        </span>
                                                    </div><!-- /.product-price -->
                                                </div>
                        
                                                <!-- /.product-info -->
                                                <?php if($row['productAvailability']=='In Stock'){?>
                                                <div class="action">
                                                    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">
                                                        Add to Cart</a>
                        
                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock &nbsp;
                                                    <a class="wishlist"
                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                        title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </div><!-- /.product -->
                        
                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <?php } ?>
                        
                        
                                </div><!-- /.home-owl-carousel -->
                            </div><!-- /.product-slider -->
                        </div>
                                            
                  
                    </div>
                </div>
            </div>
        </div>        






        <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="tab-pane" id="">
                        <div class="product-slider">
                            <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                                <?php
                    				$ret=mysqli_query($con,"select * from products order by RAND() LIMIT 15");
                    					while ($row=mysqli_fetch_array($ret)) 
                    					{
                    						# code...
                    			?>


                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                    <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        width="200" height="300" alt=""></a>
                                            </div><!-- /.image -->
                                        </div><!-- /.product-image -->


                                        <div class="product-info text-center">
                                            <h3 class="name"><a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                            </h3>
                                            <div class=""></div>
                                            <div class="description"></div>

                                            <div class="product-price">
                                                <div class="">
                                                        <?php 
                                        				 	$pid=$row['id'];
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
                                                    </div>
                                                <span class="price">
                                                    GBP <?php echo htmlentities($row['productPrice']);?>
                                                </span>
                                                    
                                            </div><!-- /.product-price -->
                                        </div>

                                        <!-- /.product-info -->
                                        <?php if($row['productAvailability']=='In Stock'){?>
                                        <div class="action">
                                            <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                class="lnk btn btn-primary">
                                                Add to Cart</a>

                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </div>
                                        <?php } else {?>
                                        <div class="action" style="color:red">Out of Stock &nbsp;
                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div><!-- /.item -->
                            <?php } ?>


                        </div><!-- /.home-owl-carousel -->
                    </div><!-- /.product-slider -->
                </div>
            </div>
            </div>    
        </div>    
            
  












        <!-- == TABS == -->
        <div class="sections prod-slider-small outer-top-small">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <section class="section">
                        <h3 class="section-title" style="color:#1FD4E4 !important;">Featured Products</h3>
                        <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme"
                            data-item="2">

                            <?php
                                $ret=mysqli_query($con,"select * from products where featured = 'Yes' order by id LIMIT 8");
                                while ($row=mysqli_fetch_array($ret)) 
                                {
                                ?>



                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                        src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        width="250" height="300"></a>
                                            </div><!-- /.image -->
                                        </div><!-- /.product-image -->


                                        <div class="product-info ">
                                                    
                                            <h3 class="name"><a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                            </h3>
                                            <div class="">
                                                <?php 
                                				 	$pid=$row['id'];
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






                                            </div>
                                            <div class="description"></div>

                                            <div class="product-price">
                                                <span class="price">
                                                    GBP <?php echo htmlentities($row['productPrice']);?> </span>
                                                <!--<span class="price-before-discount">GBP <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>-->

                                            </div>

                                        </div>
                                        <?php if($row['productAvailability']=='In Stock'){?>
                                        <div class="action"><a
                                                href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                class="lnk btn btn-primary">Add to Cart</a>

                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>


                                        </div>
                                        <?php } else {?>
                                        <div class="action" style="color:red">Out of Stock &nbsp;
                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php }?>


                        </div>
                    </section>
                </div>
                <div class="col-md-5">
                    <section class="section">
                        <h3 class="section-title" style="color:#1FD4E4;">New Products</h3>
                        <div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme"
                            data-item="2">
                            <?php
                            $ret=mysqli_query($con,"select * from products order by id DESC LIMIT 10");
                            while ($row=mysqli_fetch_array($ret)) 
                            {
                            ?>



                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                        src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                        width="250" height="300"></a>
                                            </div><!-- /.image -->
                                        </div><!-- /.product-image -->


                                        <div class="product-info ">
                                            
                                            <h3 class="name"><a
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                            </h3>
                                            <div class="">
                                                <?php 
				 	$pid=$row['id'];
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




                                            </div>
                                            <div class="description"></div>

                                            <div class="product-price">
                                                <span class="price">
                                                    GBP <?php echo htmlentities($row['productPrice']);?> </span>
                                                <!--<span class="price-before-discount">GBP <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>-->
                                            </div>

                                        </div>
                                        <?php if($row['productAvailability']=='In Stock'){?>
                                        <div class="action"><a
                                                href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                class="lnk btn btn-primary">Add to Cart</a>


                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>


                                        </div>

                                        <?php } else {?>
                                        <div class="action" style="color:red">Out of Stock
                                            <a class="wishlist"
                                                href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                title="Wishlist">
                                                <i class="icon fa fa-heart"></i>
                                            </a>
                                        </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php }?>



                        </div>
                    </section>

                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        


    </div>
    </div>
    <?php include('includes/footer.php');?>

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

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
        $(document).ready(function () {
            $(".changecolor").switchstylesheet({
                seperator: "color"
            });
            $('.show-theme-options').click(function () {
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function () {
            $('.show-theme-options').delay(2000).trigger('click');
        });



        //button

        $(window).scroll(function () {
            if ($(this).scrollTop() >= 50) {
                // If page is scrolled more than 50px
                $("#return-to-top").fadeIn(200); // Fade in the arrow
            } else {
                $("#return-to-top").fadeOut(200); // Else fade out the arrow
            }
        });
        $("#return-to-top").click(function () {
            // When arrow is clicked
            $("body,html").animate({
                    scrollTop: 0 // Scroll to top of body
                },
                500
            );
        });
    </script>
    <!-- For demo purposes – can be removed on production : End -->



</body>

</html>