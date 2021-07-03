<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

include_once 'include/config.php';
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  $oid = intval($_GET['oid']);
  if (isset($_POST['submit2'])) {
    $status = $_POST['status'];
    $remark = $_POST['remark']; //space char

    $query = mysqli_query($con, "update ordertrackhistory set status='$status', remark='$remark' where orderId='$oid'");
    $sql1 = mysqli_query($con, "update orders set orderStatus='$status' where id='$oid'");

    $sql = mysqli_query($con, "select userId from orders where id='$oid'");
    $row = mysqli_fetch_array($sql);
    $user_id = $row['userId'];

    $user_sql = mysqli_query($con, "select * from users where id='$user_id'");
    $user_row = mysqli_fetch_array($user_sql);
    $msg = "Order Status:" . $status . ".";
    
    $to_email = $user_row['email'];
    $to_name = $user_row['name'];
    
    //Sent order
    $body="Hi '$to_name', We are pleased to share that your order Status is:" . $status . ".";
 		
 		
    //  Cancel Order
    $body1="Hi '$to_name', Unfortunately your order Status is:" . $status . ".";
    
    $subject = "Order Updated";
    $headers = "From: sales@softlysoftware.co.uk" . "\r\n" .
        "CC: somebodyelse@example.com";
     
     
    if($status == 'in Process')
    {
        echo "<script>alert('Order updated sucessfully...');</script>";
    }else if($status == 'Sent'){
        mail($to_email,$subject,$body,$headers);
        echo "<script>alert('Order updated sucessfully...');</script>";
    }else{
        mail($to_email,$subject,$body1,$headers);
        echo "<script>alert('Order updated sucessfully...');</script>";
    }
    

//     $to_email = $user_row['email'];
//     $to_name = $user_row['name'];

//     $mail = new PHPMailer(true);
// 	$mail->isSMTP();
// 	$mail->Host = 'mail.softlysoftware.co.uk';
// 	$mail->SMTPAuth = true;
// 	$mail->Username = 'test@softlysoftware.co.uk';
// 	$mail->Password = 'wQY[o-$,&A$v';
// 	$mail->SMTPSecure = 'ssl';
// 	$mail->Port = 465;


// 	$mail->From = "sales@softlysoftware.co.uk";
// 	$mail->FromName = "Automated Email";

//     $mail->addAddress($to_email, $to_name);

//     $mail->isHTML(true);

//     $mail->Subject = "Order Updated";
//     $mail->Body = $msg;

//     if (!$mail->send()) {
//       echo 'Message could not be sent.';
//       echo 'Mailer Error: ' . $mail->ErrorInfo;
//     } else {
//       echo "<script>alert('Order updated sucessfully...');</script>";
//     }
  }

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
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Update Order</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="anuj.css" rel="stylesheet" type="text/css">
  </head>

  <body>

    <div style="margin-left:50px;">
      <form name="updateticket" id="updateticket" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr height="50">
            <td colspan="2" class="fontkink2" style="padding-left:0px;">
              <div class="fontpink2"> <b>Update Order !</b></div>
            </td>

          </tr>
          <tr height="30">
            <td class="fontkink1"><b>order Id:</b></td>
            <td class="fontkink"><?php echo $oid; ?></td>
          </tr>
          <?php
          $ret = mysqli_query($con, "SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
          while ($row = mysqli_fetch_array($ret)) {
          ?>



            <tr height="20">
              <td class="fontkink1"><b>At Date:</b></td>
              <td class="fontkink"><?php echo $row['postingDate']; ?></td>
            </tr>
            <tr height="20">
              <td class="fontkink1"><b>Status:</b></td>
              <td class="fontkink"><?php echo $row['status']; ?></td>
            </tr>
            <tr height="20">
              <td class="fontkink1"><b>Remark:</b></td>
              <td class="fontkink"><?php echo $row['remark']; ?></td>
            </tr>


            <tr>
              <td colspan="2">
                <hr />
              </td>
            </tr>
          <?php } ?>

          <?php
          $st = 'Sent';
          $pt = 'Cancel';
          $rt = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
          while ($num = mysqli_fetch_array($rt)) {
            $currrentSt = $num['orderStatus'];
          }
          if ($st == $currrentSt) { ?>
            <tr>
              <td colspan="2"><b>
                  Product Sent </b></td>
            <?php } else if ($pt == $currrentSt) {
            ?>
              <td colspan="2"><b>
                  Product Canceled </b></td>
            <?php } else { ?>
            <tr height="50">
              <td class="fontkink1">Status: </td>
              <td class="fontkink"><span class="fontkink1">
                  <select name="status" class="fontkink" required="required">
                    <option value="">Select Status</option>
                    <option value="in Process">In Process</option>
                    <option value="Sent">Sent</option>
                    <option value="Cancel">Cancel Order</option>
                  </select>
                </span></td>
            </tr>

            <tr style=''>
              <td class="fontkink1">Remark:</td>
              <td class="fontkink" align="justify"><span class="fontkink">
                  <textarea cols="50" rows="7" name="remark" required="required"></textarea>
                </span></td>
            </tr>
            <tr>
              <td class="fontkink1">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="fontkink"> </td>
              <td class="fontkink"> <input type="submit" name="submit2" value="update" size="40" style="cursor: pointer;" /> &nbsp;&nbsp;
                <input name="Submit2" type="submit" class="txtbox4" value="Close this Window " onClick="return f2();" style="cursor: pointer;" />
              </td>
            </tr>
          <?php } ?>
        </table>
      </form>
    </div>

  </body>

  </html>
<?php } ?>