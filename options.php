<?php
include_once("header.php");
$mailbox_server = "{".$server."}";
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$mbox = imap_open($mailbox_server,$username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die("[Debug 1]: ".imap_last_error());
$list_mailbox = imap_listmailbox($mbox,"{".$server."}", "*") or die("[Debug 2]: ".imap_last_error());
?>

            <div data-role="content">
                <ul data-role="listview" data-divider-theme="a" data-inset="false">
                    <li data-role="list-divider" role="heading">
                        Options
                    </li>
                    <li data-theme="e">
                        <a href="new.php" data-transition="slide">
                            Compose New Mail
                        </a>
                    </li>
                    <li data-role="list-divider" role="heading">
                        Mail Boxes
                    </li>
<?php
if (is_array($list_mailbox)) {
    foreach ($list_mailbox as $val) {
?>
                    <li data-theme="d">
                        <?php $temp = explode("}",imap_utf7_decode($val));
                              $mailbox_name = $temp[1];
                        ?>
                        <a href="mailbox.php?mailbox=<?php echo $mailbox_name?>" data-transition="slide">
                               <?php echo $mailbox_name?>
                        </a>
                    </li>
  <?php 
}} else { ?>
                    <li data-theme="e">
                        <a href="#page1" data-transition="slide">
                            <?php    echo "imap_list failed: " . imap_last_error();?>
                        </a>
                    </li>
<?php }
?>
                    <li data-role="list-divider" role="heading">
                        Settings
                    </li>

                    <li data-theme="d">
                        <a href="logout.php" data-transition="slide">
                            Logout
                        </a>
                    </li>
                    <li data-theme="d">
                        <a href="about.php" data-transition="slide">
                            About
                        </a>
                    </li>
                </ul>
            </div>


<?php 
include_once("footer.php");
?>