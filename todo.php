<?php
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$mailbox="INBOX";
$mailbox_server = "{".$server."}".$mailbox; //set in headers/header.php
$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die(imap_last_error());

$check = imap_check($mbox);
?>


            <div data-role="content">
                <ul data-role="listview" data-divider-theme="d" data-inset="true" id="today">
				
                    <li data-role="list-divider" role="heading">
                        Today
                    </li>

				</ul>

				<ul data-role="listview" data-divider-theme="d" data-inset="true" id="tomorrow">
                    <li data-role="list-divider" role="heading" >
                        Tomorrow
                    </li>

                </ul>
				  <ul data-role="listview" data-divider-theme="d" data-inset="true" id="oneweek">
                    <li data-role="list-divider" role="heading" >
                        In A Week
                    </li>

                </ul>
            </div>

<?php 
include_once("footer.php");
?>