<?php 
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$uid = $_GET['mail_id'];
$mailbox = $_GET['mailbox'];
$mailbox_server = "{".$server."}".$mailbox; //set in headers/header.php
$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die("[Debug 1]: ".imap_last_error());
imap_delete($mbox, $uid, FT_UID) or die("[Debug 3]: ".imap_last_error());
header("location:mailbox.php");
?>
