<?php
session_start();
error_reporting(0);
include('includes/config.php');
 $cid=intval($_GET['cid']);

//   $cid=12;
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
// COde for Wishlist
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','".$_GET['pid']."')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
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


    .list-unstyled li {
        display: inline;

    }

    .cap {
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        color: #FFFFFF;
        font-size: 18px;
        font-family: 'FjallaOneRegular';
        padding: 15px 17px;
        text-transform: uppercase;
        background: #333333;
    }
    
    .product-info{
        height:110px;
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

    <title>Softly Software | Category</title>

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

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

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
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row outer-bottom-sm'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="side-menu animate-dropdown outer-bottom-xs">
                            <div class="head" style="text-align:center">Category</div>
                            <nav class="yamm megamenu-horizontal" role="navigation">

                                <ul class="nav">
                                    <li class="dropdown menu-item">
                                        <?php $sql=mysqli_query($con,"select id,subcategory from subcategory where categoryid='$cid' Order By subcategory");

                                        while($row=mysqli_fetch_array($sql))
                                        {
                                            ?>
                                        <a href="sub-category.php?scid=<?php echo $row['id'];?>&cid=<?php echo $cid;?>"
                                            class="dropdown-toggle"><i class=""></i>
                                            <?php echo $row['subcategory'];?></a>
                                        <?php }?>

                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div><!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->
                    <div class="sidebar-module-container">
                        <h3 class="section-title">shop by</h3>
                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                            <div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
                                <div class="widget-header m-t-20">
                                    <h4 class="widget-title">Category</h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">
                                    <?php $sql=mysqli_query($con,"select id,categoryName from category");
                                    while($row=mysqli_fetch_array($sql))
                                    {
                                        ?>
                                    <div class="accordion">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                <a href="category.php?cid=<?php echo $row['id'];?>"
                                                    class="accordion-toggle collapsed">
                                                    <?php echo $row['categoryName'];?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->




                            <!-- ============================================== COLOR: END ============================================== -->

                        </div><!-- /.sidebar-filter -->
                    </div><!-- /.sidebar-module-container -->
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <!-- ============ SECTION – HERO ======== -->

                    <div id="category" class="category-carousel hidden-xs">
                        <div class="container-fluid">
                            <div class="cap">
                                <?php $sql=mysqli_query($con,"select categoryName  from category where id='$cid'");
                                while($row=mysqli_fetch_array($sql))
                                {
                                    $cat=$row['categoryName'];
                                    ?>

                                <div class="excerpt hidden-sm hidden-md">
                                    <?php echo htmlentities($cat);?>
                                </div>

                                <?php if($cat=='DVDS')
                                {
                                echo ' 
                                    <div class="container-fluid">
                                            <div class="cap">
                                                <div class="excerpt hidden-sm hidden-md">
                                                    <img src="img/buy.png" >
                                                </div>
                                            </div>
                                    </div>';
                                }else{
                                    
                                }
                            
                                ?>
                                <?php } ?>

                            </div><!-- /.caption -->
                        </div><!-- /.container-fluid -->






                        <!--</div>-->
                    </div>

                    <div class="search-result-container" style="text-align:center">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product  inner-top-vs">
                                    <div class="row">
                                        <?php 
                                            $results_per_page = 18; 
                                            $sql="SELECT * FROM products WHERE category=$cid";
                                            $result = mysqli_query($con, $sql);
                                            $number_of_results = mysqli_num_rows($result);
                                        
                                            $number_of_pages = ceil($number_of_results/$results_per_page);
                                            
                                            if (!isset($_GET['page'])) {
                                                $page = 1;
                                              } else {
                                                $page = $_GET['page'];
                                              }

                                            $this_page_first_result = ($page-1)*$results_per_page;  
                                            

                                            $sql="SELECT * FROM products WHERE category=$cid LIMIT $this_page_first_result,$results_per_page";
                                            $result = mysqli_query($con, $sql);

                                            while($row = mysqli_fetch_array($result)) {
                                                
                                          ?>

                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                                    src="assets/images/blank.gif"
                                                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                    alt="" width="200" height="300"></a>
                                                        </div><!-- /.image -->
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-center">
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
                                                                GBP <?php echo htmlentities($row['productPrice']);?>
                                                            </span>
                                                            <!--<span class="price-before-discount">GBP 
										  //   <?php 
										  //   echo htmlentities($row['productPriceBeforeDiscount']);
										     ?></span>-->

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled" style="text-align:center">

                                                                <li class="add-cart-button btn-group">

                                                                    <?php if($row['productAvailability']=='In Stock'){?>

                                                                    <a
                                                                        href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
                                                                        <button class="btn btn-primary"
                                                                            type="button">Add to Cart</button></a>
                                                                    <?php } else {?>
                                                                    <span style="color:red;">Out of Stock</span>
                                                                    <?php } ?>

                                                                </li>

                                                                <li class="lnk wishlist">
                                                                    <a class="add-to-cart"
                                                                        href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"
                                                                        title="Wishlist">
                                                                        <i class="icon fa fa-heart"></i>
                                                                    </a>
                                                                </li>


                                                            </ul>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div>
                                            </div>
                                        </div>






                                        <?php      

                                             }
                                            // for ($page=1;$page<=$number_of_pages;$page++) {
                                            //     echo '<a class="btn btn-primary" href="category.php?cid='.$cid.'&page=' . $page . '">' . $page . '</a> ';
                                            //   }

                                        ?>





                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9" >
                                <?php
                                            
                                            $current_page=$_GET['page'];
                                            $x="";
                                            
                            
                                            for($page=1;$page<=$number_of_pages;$page++) {
                                              if($page==$current_page) { 
                                                 $x.= "<strong><a style='background-color:#1FD4E4; margin-top:10px;' class='btn btn-primary' href='".$self."?cid=$cid&page=".$page."'>".$page."</a></strong>&nbsp;&nbsp;";
                                              } 
                                              else if ($page>100 && $page!=$number_of_pages) {
                                                 $x.=" ";
                                                 
                                                 
                                                 if($current_page<$number_of_pages)
                                                 {  
                                                     for(;$page<=$number_of_pages;$page++)
                                                     {
                                                        $x.="<a class='btn btn-primary' style='margin-top:10px;' href='category.php?cid=$cid&page=".$page."'>".$page."</a>&nbsp;&nbsp;";
                                                        // $x++;
                                                        // $current_page++;
                                                     }
                                                 }
                                                 
                                              }
                                              else {
                                                 $x.= "<a class='btn btn-primary' style='margin-top:10px;' href='category.php?cid=$cid&page=".$page."'>".$page."</a>&nbsp;&nbsp;";
                                              }
                                            }
                                            echo $x;
                                            
                                            
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
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
    </script>
    <!-- For demo purposes – can be removed on production : End -->



</body>

</html>