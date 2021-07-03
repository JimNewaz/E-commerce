<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Europe/Boston'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

?>


	<?php
	if (isset($_GET['del'])) {
		mysqli_query($con, "delete from ratting where id = '" . $_GET['id'] . "'");
		$_SESSION['delmsg'] = "Product deleted !!";
	}
	?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Category</title>
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	</head>

	<body>
		<?php include('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Product Reviews</h3>
								</div>
								<div class="module-body table">


									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Product ID</th>
												<th>Product Name</th>
												<th> Name</th>
												<th>Ratting </th>
												<th>Review</th>
												<th>Time</th>
												<th>Status</th>
												<th>Remove</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>

											<?php
											$sel = "SELECT * FROM ratting";
											$rs = $con->query($sel);
											$cnt = 1;

											while ($row = $rs->fetch_assoc()) {
												$pid = $row['pid'];
												$queryy = mysqli_query($con, "select p.productName from products p join orders o on p.id=o.productId where p.id=$pid ORDER BY o.id DESC");
												$roww = mysqli_fetch_array($queryy);
											?>

												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo $row['pid']; ?></td>
													<td><?php echo $roww['productName']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['ratting']; ?></td>
													<td> <?php echo $row['review']; ?></td>
													<td><?php echo $row['reviewdate']; ?></td>
													<td><?php if ($row['isapproved'] == '1') { ?>
															<a href="notap.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Approved</a>
														<?php  } else { ?>
															<a href="ap.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Not Approved</a>
														<?php } ?>
													</td>
													<td>
														<a href="feedback.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
													</td>
												</tr>
												<?php $cnt = $cnt + 1;  ?>
											<?php } ?>
									</table>



								</div>
							</div>
						</div>
						<!--/.content-->
					</div>
					<!--/.span9-->
				</div>
			</div>
			<!--/.container-->
		</div>
		<!--/.wrapper-->

		<?php include('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function() {
				$('.datatable-1').dataTable({
					"lengthMenu": [
						[100, -1],
						[100, "All"],
					]
				});
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
<?php } ?>