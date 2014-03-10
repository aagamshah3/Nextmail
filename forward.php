<?php 
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$uid = $_GET['mail_id'];
$mailbox = $_GET['mailbox'];
$mailbox_server = "{".$server."}".$mailbox; //set in headers/header.php


$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die("[Debug 1]: ".imap_last_error());




$overview = imap_fetch_overview($mbox, $uid, FT_UID) or die("[Debug 2]: ".imap_last_error());
$body = imap_body($mbox, $uid, FT_UID) or die("[Debug 3]: ".imap_last_error());


?>
           <div data-role="content">
                <form action="sendmail.php" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput6">
                                To
                            </label>
                            <input name="to" id="textinput6" placeholder="To" value="" type="email" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput7">
                                Subject
                            </label>
                            <input name="subject" id="textinput7" placeholder="Subject" value="Re: <?php  if(!isset($overview->subject))
								echo "No Subject";
								else
								echo $overview->subject;
								?>" type="text" />
                        </fieldset>
                    </div>
                    <input data-icon="check" data-iconpos="left" value="Send!" type="submit" />
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textarea1">
                            </label>
                           
<?php echo '<textarea rows=20 name="body" id="textarea1" placeholder="" value="'.getBody($uid, $mbox).'"></textarea>'; ?>
                            
                        </fieldset>
                    </div>
                </form>
            </div>
<?php
include_once("footer.php");
?>