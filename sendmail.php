<?php
include_once("header.php");
session_start();
$username = $_SESSION['username'];
$to = $_POST['to'];
$from = $username;
$body = $_POST['body'];
$subject = $_POST['subject'];
$header = "From: $from";
mail($to,$subject, $body,$header) or die("Mail Failed");
?>
<div class="content">
<h3> Mail Sent! </h3>
to <?php echo $to ?>
<br />
<br />
There isn't much to do on this page, consider going back to the inbox.
</div>
<?php include_once("footer.php"); ?>