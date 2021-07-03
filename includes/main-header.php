<?php
session_start();
if (isset($_POST['apply'])) {
	$code = $_POST['code'];
	$_SESSION['coupon_code'] = $code;
}

if (isset($_Get['action'])) {
	if (!empty($_SESSION['cart'])) {
		foreach ($_POST['quantity'] as $key => $val) {
			if ($val == 0) {
				unset($_SESSION['cart'][$key]);
			} else {
				$_SESSION['cart'][$key]['quantity'] = $val;
			}
		}
	}
}
?>
<div class="main-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 logo-holder">
				<!-- ========= LOGO ========= -->
				<div class="logo">
					<p class="lg">SOFTLY<span class="ld">SOFTWARE</span></p>

				</div>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 top-search-holder">
				<!-- <div class="search-area">
		<form class="form-inline" name="search" method="post" action="search-result.php">
				<input class="form-control mr-sm-2" type="search" name="product" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-primary my-2 my-sm-0 sr" type="submit"><i class="fa fa-search"></i></button>
		</form>
	</div> -->
				<!-- ==== SEARCH AREA : END ==== -->
			</div>
			<!-- /.top-search-holder -->



			<!-- ========== SHOPPING CART DROPDOWN ======= -->

			<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
				<?php
				if (!empty($_SESSION['cart'])) {
				?>
					<div class="dropdown dropdown-cart">
						<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
							<div class="items-cart-inner">
								<div class="total-price-basket">
									<span class="lbl"></span>
									<span class="total-price">
										<span class="sign">GBP </span>
										<span class="value">
										<?php
							$sql = "SELECT * FROM products WHERE id IN(";
							foreach ($_SESSION['cart'] as $id => $value) {
								$sql .= $id . ",";
							}
							$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
							$query = mysqli_query($con, $sql);
							$totalprice = 0;
							$totalqunty = 0;
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
											$discount = $min-(50 / 100 * $min);
										}else{
											$discount = 0;
										}
									}
									$quantity = $_SESSION['cart'][$row['id']]['quantity'];
									$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge'];
									$totalprice += $subtotal;
								}
							}

						$code = $_SESSION['coupon_code'];
						if ($code != "" && $code == 'SAVE5') {
							$gbp_tmp_final_price = $totalprice - $discount;
							$gbp_final_price = $gbp_tmp_final_price - (5 / 100 * $gbp_tmp_final_price);
						} else {
							$gbp_final_price = $totalprice - $discount;
						}
						echo $_SESSION['tp'] = "$gbp_final_price"; 

							?>
										</span>
									</span>
								</div>
								<div class="basket">
									<i class="glyphicon glyphicon-shopping-cart"></i>
								</div>
								<div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty']; ?></span></div>

							</div>
						</a>
						<ul class="dropdown-menu">

							<?php
							$sql = "SELECT * FROM products WHERE id IN(";
							foreach ($_SESSION['cart'] as $id => $value) {
								$sql .= $id . ",";
							}
							$sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
							$query = mysqli_query($con, $sql);
							$total_price = 0;
							$totalqunty = 0;
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
											$discount = $min-(50 / 100 * $min);
										}else{
											$discount = 0;
										}
									}
									$quantity = $_SESSION['cart'][$row['id']]['quantity'];
									$subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge'];
									$total_price += $subtotal;
									$_SESSION['qnty'] = $totalqunty += $quantity;

							?>


									<li>
										<div class="cart-item product-summary">
											<div class="row">
												<div class="col-xs-4">
													<div class="image">
														<a href="product-details.php?pid=<?php echo $row['id']; ?>"><img src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>" width="35" height="50" alt=""></a>
													</div>
												</div>
												<div class="col-xs-7" style="float:right;">

													<h3 class="name"><a href="product-details.php?pid=<?php echo $row['id']; ?>"><?php echo $row['productName']; ?></a></h3>
													<div class="price" style="float:right;">GBP <?php echo ($row['productPrice'] + $row['shippingCharge']); ?>
														<!--*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>-->
													</div>
												</div>

											</div>
										</div><!-- /.cart-item -->

								<?php }
							} ?>
								<div class="clearfix"></div>
								<hr>

								<div class="clearfix cart-total">
									<div class="pull-right">

										<span class="text">Total :</span><span class='price'>GBP <?php
										$code = $_SESSION['coupon_code'];
										if($code != "" && $code == 'SAVE5'){
											$tmp_final_price = $total_price-$discount;
											$final_price = $tmp_final_price-(5/100* $tmp_final_price);
										} else{
											$final_price = $total_price - $discount;

										}
										echo $_SESSION['tp'] = "$final_price"; 
										?></span>

									</div>

									<div class="clearfix"></div>

									<a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
								</div><!-- /.cart-total-->


									</li>
						</ul><!-- /.dropdown-menu-->
					</div><!-- /.dropdown-cart -->
				<?php } else { ?>
					<div class="dropdown dropdown-cart">
						<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
							<div class="items-cart-inner">
								<div class="total-price-basket">
									<span class="lbl"></span>
									<span class="total-price">
										<span class="sign">GBP </span>
										<span class="value">00.00</span>
									</span>
								</div>
								<div class="basket">
									<i class="glyphicon glyphicon-shopping-cart"></i>
								</div>
								<div class="basket-item-count"><span class="count">0</span></div>

							</div>
						</a>
						<ul class="dropdown-menu">
							<li>
								<div class="cart-item product-summary">
									<div class="row">
										<div class="col-xs-12">
											Your Shopping Cart is Empty.
										</div>

									</div>
								</div><!-- /.cart-item -->


								<hr>

								<div class="clearfix cart-total">

									<div class="clearfix"></div>

									<a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shopping</a>
								</div><!-- /.cart-total-->


							</li>
						</ul><!-- /.dropdown-menu-->
					</div>
				<?php } ?>




				<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
			</div><!-- /.top-cart-row -->
		</div><!-- /.row -->

	</div><!-- /.container -->

</div>