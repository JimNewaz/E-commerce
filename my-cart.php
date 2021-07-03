<?php
session_start();
error_reporting(0);
include('includes/config.php');

$test=uniqid();

if (isset($_POST['submit'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
		// 			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// Code for Remove a Product from Cart
if (isset($_POST['remove_code'])) {

	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['remove_code'] as $key) {

			unset($_SESSION['cart'][$key]);
		}
		// 			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if (isset($_POST['ordersubmit'])) {
	// if (isset($_POST['code'])) {
	// 	$_SESSION['coupon_code'] = $_POST['code'];
	// }
	if (strlen($_SESSION['login']) == 0) {
		header("Location:login.php?location=" . urlencode($_SERVER['REQUEST_URI']));
		// header('location:login.php');
	} else {
		$quantity = $_POST['quantity'];
		$pdd = $_SESSION['pid'];
		$value = array_combine($pdd, $quantity);
        $final_price= $_SESSION['tp'];
        
		foreach ($value as $qty => $val34) {
			$status = "in Process";
			mysqli_query($con, "insert into orders(userId,productId,quantity,orderStatus,un_id,final_price) values('" . $_SESSION['id'] . "','$qty','$val34','$status','$test','$final_price')");
			$last_id = mysqli_insert_id($con);
			$remark = "None";
			$query = mysqli_query($con, "insert into ordertrackhistory(orderId,status,remark) values('$last_id','$status','$remark')");
		}
		
	}

	header('location:payment-method.php');
}



// code for billing address updation
//Not Necessary Now
if (isset($_POST['update'])) {
	$baddress = $_POST['billingaddress'];
	$bstate = $_POST['bilingstate'];
	$bcity = $_POST['billingcity'];
	$bpincode = $_POST['billingpincode'];
	$query = mysqli_query($con, "update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='" . $_SESSION['id'] . "'");
	if ($query) {
		echo "<script>alert('Billing Address has been updated');</script>";
	}
}


// code for Shipping address updation
if (isset($_POST['shipupdate'])) {
	$saddress = $_POST['shippingaddress'];
	$sstate = $_POST['shippingstate'];
	$scity = $_POST['shippingcity'];
	$spincode = $_POST['shippingpincode'];
	$contactno = $_POST['contactno'];
	$query = mysqli_query($con, "update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode',contactno='$contactno' where id='" . $_SESSION['id'] . "'");
	if ($query) {
		echo "<script>alert('Shipping Address has been updated');</script>";
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

	<title>My Cart</title>
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



	<!-- ============================================== HEADER ============================================== -->
	<header class="header-style-1">
		<?php include('includes/top-header.php'); ?>
		<?php include('includes/main-header.php'); ?>
		<?php include('includes/menu-bar.php'); ?>
	</header>
	<!-- ============================================== HEADER : END ============================================== -->
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="#">Home</a></li>
					<li class='active'>Shopping Cart</li>
				</ul>
			</div><!-- /.breadcrumb-inner -->
		</div><!-- /.container -->
	</div><!-- /.breadcrumb -->

	<div class="body-content outer-top-xs">
		<div class="container">
			<div class="row inner-bottom-sm">
				<div class="shopping-cart">
					<div class="col-md-12 col-sm-12 shopping-cart-table ">
						<div class="table-responsive">
							<form name="cart" method="post">
								<?php
								if (!empty($_SESSION['cart'])) {
								?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="cart-romove item">Remove</th>
												<!--<th class="cart-description item">Image</th>-->
												<th class="cart-product-name item">Product Name</th>
												<th class="cart-qty item">Quantity</th>
												<!--<th class="cart-sub-total item">Item Price</th>-->
												<!--<th class="cart-sub-total item">Shipping</th>-->
												<th class="cart-total last-item">Item Price</th>
											</tr>
										</thead><!-- /thead -->
										<tfoot>
											<tr>
												<td colspan="4">
													<div class="shopping-cart-btn">
														<span class="">
															<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
															<input type="submit" name="submit" value="Update Cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
														</span>
													</div><!-- /.shopping-cart-btn -->
												</td>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$pdtid = array();
											$sql = "SELECT * FROM products WHERE id IN(";
											foreach ($_SESSION['cart'] as $id => $value) {
												$sql .= $id . ",";
											}
											$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
											$query = mysqli_query($con, $sql);

											$totalprice = 0;
											$totalqunty = 0;
											$totalshipping = 0;
											$discount = 0;
											$price_arr = [];
											if (!empty($query)) {
												while ($row = mysqli_fetch_array($query)) {
													if ($row['category'] == 12) {
														array_push($price_arr, (float) $row['productPrice']);
														$number_of_rows = mysqli_num_rows($query);
														if ($number_of_rows == 3) {
															$min = min($price_arr);
															$discount = $min;
														} elseif ($number_of_rows == 2) {
															$min = min($price_arr);
															$discount = $min - (50 / 100 * $min);
														} else {
															$discount = 0;
														}
													}
													$quantity = $_SESSION['cart'][$row['id']]['quantity'];

													$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge'];

													$subshipping = $_SESSION['cart'][$row['id']]['quantity'] * $row['shippingCharge'];

													$totalprice += $subtotal;
													$totalshipping += $subshipping;
													$_SESSION['qnty'] = $totalqunty += $quantity;

													array_push($pdtid, $row['id']);

													// $_SESSION['tp'] = $totalprice;
													//print_r($_SESSION['pid'])=$pdtid;exit;
											?>

													<tr>
														<td class="romove-item">
															<input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']); ?>" />
														</td>
														<!--<td class="cart-image">-->

														<!--</td>-->
														<td class="cart-product-name-info">
															<div class="row">
																<div class="col-sm-4">
																	<!--<a class="entry-thumbnail" href="detail.html">-->
																	<img class="entry-thumbnail" src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>" alt="" width="114" height="146">
																	<!--</a>-->
																</div>
																<div class="col-sm-8" style="margin-top:50px;">
																	<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd = $row['id']); ?>"><?php echo $row['productName'];
																																															$_SESSION['sid'] = $pd;
																																															?></a></h4>
																	<div class="row">
																		<div class="col-sm-4">
																			<div class="">
																				<?php
																				$pid = $row['id'];
																				$sel = "select round(AVG(r.ratting),1) as rr from ratting r
                        join products p ON r.pid = p.id WHERE r.pid='$pid' AND r.isapproved='1'";

																				$rs = mysqli_query($con, $sel);
																				$rss = mysqli_fetch_array($rs);
																				?>

																				<?php
																				$i = 1;
																				while ($i <= 5) {

																					if ($i <= $rss['rr']) {

																						echo '<span class="fa fa-star checked"></span>';
																					} else {

																						echo '<span class="fa fa-star"></span>';
																					}
																					$i++;
																				}

																				?>



																			</div>
																		</div>
																		<div class="col-sm-8">
																			<?php $rt = mysqli_query($con, "select * from ratting where pid='$pid'");
																			$num = mysqli_num_rows($rt); {
																			?>
																				<div class="reviews">
																					( <?php echo htmlentities($num); ?> Reviews )
																				</div>
																			<?php } ?>
																		</div>
																	</div><!-- /.row -->

																</div>
															</div>




														</td>
														<td class="cart-product-quantity">
															<div class="quant-input">
																<div class="arrows">
																	<div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
																	<div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
																</div>
																<input type="text" class="edit-items" max="3" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">

															</div>
														</td>
														<!--<td class="cart-product-sub-total">-->
														<!--<span class="cart-sub-total-price">-->
														<?php
														//echo ""." ".$row['productPrice']; 
														?>
														<!--</span>-->
														<!--</td>-->

														<!--<td class="cart-product-sub-total">-->
														<!--<span class="cart-sub-total-price">-->
														<?php
														//echo ""." ".$row['shippingCharge'];
														?>
														<!--</span>-->
														<!--</td>-->

														<td class="cart-product-grand-total">
															<span class="cart-grand-total-price">
																<?php
																echo number_format(($_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice']), 2, '.', '');
																//+$row['shippingCharge']
																?>
															</span>
														</td>
													</tr>

											<?php }
											}
											$_SESSION['pid'] = $pdtid;
											?>

										</tbody><!-- /tbody -->
									</table><!-- /table -->

						</div>
					</div><!-- /.shopping-cart-table -->

					<!-- <div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
<?php
									$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
									while ($row = mysqli_fetch_array($query)) {
?>

<div class="form-group">
					    <label class="info-title" for="Billing Address">Billing Address<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billingAddress']; ?></textarea>
					  </div>



						<div class="form-group">
					    <label class="info-title" for="Billing State ">Billing State  <span>*</span></label>
			 <input type="text" class="form-control unicase-form-control text-input" id="bilingstate" name="bilingstate" value="<?php echo $row['billingState']; ?>" required>
					  </div>
					  <div class="form-group">
					    <label class="info-title" for="Billing City">Billing City <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="billingcity" name="billingcity" required="required" value="<?php echo $row['billingCity']; ?>" >
					  </div>
 <div class="form-group">
					    <label class="info-title" for="Billing Pincode">Billing Pincode <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billingPincode']; ?>" >
					  </div>


					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
			
					<?php } ?>
		
						</div>
					
					</td>
				</tr>
		</tbody>
	</table>
</div> -->

					<div class="col-md-8 col-sm-12 estimate-ship-tax">
						<!--	<table class="table table-bordered">-->
						<!--		<thead>-->
						<!--			<tr>-->
						<!--				<th>-->
						<!--					<span class="estimate-title">Shipping Address</span>-->
						<!--				</th>-->
						<!--			</tr>-->
						<!--		</thead>-->
						<!--		<tbody>-->
						<!--				<tr>-->
						<!--					<td>-->
						<!--						<div class="form-group">-->
						<?php
									$query = mysqli_query($con, "select * from users where id='" . $_SESSION['id'] . "'");
									while ($row = mysqli_fetch_array($query)) {
						?>

							<!--           <div class="form-group">-->
							<!--<label class="info-title" for="Shipping Address">Shipping Address<span>*</span></label>-->
							<!--<textarea class="form-control unicase-form-control text-input"  name="shippingaddress" required="required">-->
							<?php
										//echo $row['shippingAddress'];
							?>
							<!--  </textarea>-->
							<!--</div>-->



							<!--		<div class="form-group">-->
							<!--	    <label class="info-title" for="Billing State ">Shipping State  <span>*</span></label>-->
							<!--<input type="text" class="form-control unicase-form-control text-input" id="shippingstate" name="shippingstate" value="-->
							<?php
										// echo $row['shippingState'];
							?>
							<!--" -->
							<!--required>-->
							<!--</div>-->
							<!--<div class="form-group">-->
							<!--  <label class="info-title" for="Billing City">Shipping City <span>*</span></label>-->
							<!--  <input type="text" class="form-control unicase-form-control text-input" id="shippingcity" name="shippingcity" required="required" value="-->
							<?php
										// echo $row['shippingCity'];
							?>
							<!--" -->
							<!--  >-->
							<!--</div>-->

							<!--<div class="form-group">-->
							<!--   <label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>-->
							<!--   <input type="text" class="form-control unicase-form-control text-input" id="shippingpincode" name="shippingpincode" required="required" value="-->
							<?php
										//echo $row['shippingPincode'];
							?>
							<!--" -->
							<!--  >-->
							<!--</div>-->

							<!--<div class="form-group">-->
							<!--    <label class="info-title" for="Contact No.">Contact No. <span>*</span></label>-->
							<!--    <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" value="-->
							<?php
										//echo $row['contactno'];
							?>
							<!--"-->
							<!--    maxlength="20">-->
							<!--</div>-->

							<!--<button type="submit" name="shipupdate" class="btn-upper btn btn-primary checkout-page-button">Update</button>-->
						<?php
									}
						?>


						<!--						</div>-->

						<!--					</td>-->
						<!--				</tr>-->
						<!--		</tbody>-->
						<!--	</table>-->
					</div>



					<div class="col-md-4 col-sm-12 cart-shopping-total">
						<!--Shipping Charge-->



						<table class="table table-bordered">
							<thead>
								<tr>
									<th>
									    <div class="cart-grand-total" style="color:black; font-weight:200;">

										
											Total<span class="inner-left-md">

												<!--<?php echo number_format($tmp_final_price, 2, '.', ''); ?>-->
												
												<?php  echo number_format($totalprice, 2, '.', ''); ?>

											</span>


										</div>

										<hr>
										<div class="cart-grand-total" style="color:black; font-weight:200;">

											<?php
											$get_charge = "select shippingCharge from products where id='$pd'";
											$run_p = mysqli_query($con, $get_charge);
											while ($row = mysqli_fetch_array($run_p)) {
												$charge = $row['shippingCharge'];

											?>
											<?php } ?>

											Shipping Charge<span class="inner-left-md">

												<?php echo number_format($_SESSION['tp'] = "$totalshipping", 2, '.', ''); ?>

											</span>


										</div>

										<hr>
										<div class="cart-grand-total" style="color:black; font-weight:200;">

											Discount<span class="inner-left-md">
												<?php echo number_format("$discount", 2, '.', ''); ?> 
											</span>


										</div>

										<hr>
										<div class="cart-grand-total" style="color:black; font-weight:200;">

											<!-- Discount<span class="inner-left-md">
												<?php echo $discount; ?>
											</span> -->
											<?php
											$coupn = "select code from coupon where status=1";
											$c_oupon = mysqli_query($con, $coupn);
											while ($row = mysqli_fetch_assoc($c_oupon)) {
												$code = $row['code'];

											?>
											<?php } ?>
											<!-- <form action="" method="post"> -->
												<input type="text" class="form-control" name="code" id="code" placeholder="Enter Coupon Code">
												
												<button type="submit" name="apply" id="applyy" class="btn btn-info btn-block" style="margin-top:10px;">Apply</button>
											<!-- </form> -->


										</div>
										<?php
										$check_code = $_SESSION['coupon_code'];
										if($check_code != "" && $check_code == 'SAVE5') {
											
										?>
											<div class="cart-grand-total">
												Deduct Amount:
												<span class="inner-left-md" id="d_total">
												<?php
												$deduct_tmp_final_price = $totalprice - $discount;
												$deduct_amount = (5 / 100 * $tmp_final_price);
												// echo $deduct_amount;
												echo number_format("$deduct_amount", 2, '.', '');
												?>

												</span>
												<input type="hidden" id="d_total_hide">
											</div>
										<?php }
											if($check_code != "" && $check_code != 'SAVE5'){
										?>
											<div class="cart-grand-total">
												<span class="text-danger">INVALID CODE</span>
											</div>
										<?php } ?>

										<hr>
										<div class="cart-grand-total">
											Grand Total<span class="inner-left-md" id="s_total">
												<?php

												$code = $_SESSION['coupon_code'];
												$tmp_final_price = $totalprice - $discount;
												if (isset($code) && $code == 'SAVE5') {
													$final_price = $tmp_final_price - (5 / 100 * $tmp_final_price);
												} else {
													$final_price = $tmp_final_price;
												}
												// $final_price = $totalprice - $discount;
												echo number_format($_SESSION['tp'] = "$final_price", 2, '.', '');
												
												
												?>
											</span>
											<input type="hidden" id="g_total" value="<?php echo $final_price; ?>">
											<span id="after_discount"></span>
										</div>
									</th>
								</tr>
							</thead><!-- /thead -->
							<tbody>
								<tr>
									<td>
										<div class="cart-checkout-btn pull-right">
											<button type="submit" name="ordersubmit" class="btn btn-primary">PROCEED TO CHEKOUT</button>

										</div>
									</td>
								</tr>
							</tbody><!-- /tbody -->
						</table>
					<?php } else {
									echo "Your shopping Cart is empty";
								} ?>
					</div>
				</div>
			</div>
			</form>
			
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
		$("#d_panel").hide();
		$("#invalid_code").hide();
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

		document.getElementsByClassName('edit-items')[0].oninput = function() {
			var max = parseInt(this.max);

			if (parseInt(this.value) > max) {
				this.value = max;
			}
		}

		var after_code = localStorage.getItem('code');

		if (after_code != null && after_code == 'SAVE5') {
			$("#invalid_code").hide();
			var total = localStorage.getItem("total");
			$("#d_total_hide").val(total);
			var deduction = localStorage.getItem("deduction");
			$("#d_panel").show(500);
			$("#d_total_hide").val(deduction);
			$("#d_total").text(deduction);
			var final_price = parseFloat(total) - parseFloat(deduction);
			$("#s_total").html(final_price);
		}


		$(document).on("click", "#apply", function() {
			var code = $("#code").val();
			if (code == 'SAVE5') {
				$("#invalid_code").hide();
				var total = $("#g_total").val();
				$("#d_total_hide").val(total);
				var deduction = (5 / 100 * parseFloat(total));
				$("#d_panel").show(500);
				$("#d_total_hide").val(deduction);
				$("#d_total").text(deduction);
				var final_price = parseFloat(total) - parseFloat(deduction);
				$("#s_total").html(final_price);

				localStorage.setItem("code", code);
				localStorage.setItem("total", total);
				localStorage.setItem("deduction", deduction);
				localStorage.setItem("final_price", final_price);
			} else {
				$("#d_panel").hide();
				$("#invalid_code").show();
			}

		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>

</html>