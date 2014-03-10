<?php
session_start();
ini_set('max_execution_time', 300); 
if(isset($_POST['username'])&&(strlen($_POST['username'])>1)&&(strlen($_POST['password'])>1)) {
$username = $_POST['username'];
$password = $_POST['password']; 
$server = $_POST['server'];
$mailbox_server = "{".$server."}";
$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die("<h1> Invalid login</h1>");
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$_SESSION['server'] = $server;
header("Location:mailbox.php?mailbox=INBOX");
}
else 
header("location: index.php");
?>