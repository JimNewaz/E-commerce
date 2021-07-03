<?php
session_start();
include_once 'includes/config.php';
$oid = intval($_GET['oid']);
?>
<script language="javascript" type="text/javascript">
  function f2() {
    window.close();
  }
  ser

  function f3() {
    window.print();
  }
</script>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Order Tracking Details</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link href="anuj.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <div class="box">
      <h1 style="text-align:center; color:#1FD4E4;">
        <b>Order Tracking Details</b>
      </h1>
      <br>
      <hr>

      <?php
      $ret = mysqli_query($con, "SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
      $row = mysqli_fetch_array($ret);
      if ($ret->num_rows > 0) {
        if ($row['status'] == 'Sent') {
      ?>
          <h3 style="text-align:center; color:green;">Product Sent Successfully</h3>
          <br>
          <hr>
        <?php
        } elseif ($row['status'] == 'Cancel') {
        ?>
          <h3 style="text-align:center; color:red;">Order Has been Cancelled.</h3>
          <br>
          <hr>
        <?php
        } else {
        ?>
          <h3 style="text-align:center; color:red;">Order Has Not Been Processed Yet</h3>
          <br>
          <hr>

        <?php
        }
        ?>
      <?php
      } else {
      ?>
        <h3 style="text-align:center; color:red;">Order Has Not Been Processed Yet</h3>
        <br>
        <hr>
      <?php } ?>

      <table class="table">
        <thead>
          <tr>
            <th>Order Id</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Order Remark</th>

          </tr>
        </thead>
        <tbody>
          <tr class="info">
            <td>
              <?php echo $oid; ?>
            </td>
            <td>
              <?php if (isset($row['postingDate'])) {
                echo $row['postingDate'];
              } else {
                echo '';
              }
              ?>
            </td>
            <td>
              <?php if (isset($row['status'])) {
                echo $row['status'];
              } else {
                echo '';
              }
              ?>
            </td>

            <td>
              <?php if (isset($row['remark'])) {
                echo $row['remark'];
              } else {
                echo '';
              }
              ?>
            </td>

          </tr>

        </tbody>
      </table>
    </div>
  </div>
</body>

</html>