<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
    
	$pid=intval($_GET['id']);

   $query=mysqli_query($con,"select id from products where id='$pid'");
	$result=mysqli_fetch_array($query);
	$productid=$result['id'];
	$dir="productimages/$productid";

	if(is_dir($dir)){
		$pimage = $result['productImage2'];
		unlink($dir.'/'.$pimage);
	}

	$sql=mysqli_query($con, "UPDATE products set productImage2 = null WHERE id='$pid'");
    header("location:edit-products.php?id=$pid");

}
?>