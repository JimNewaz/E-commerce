<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

$id=$_GET['id'];

$upd="UPDATE ratting SET isapproved='0' WHERE id='$id'";
$con->query($upd);

header("location:feedback.php");

}
?>