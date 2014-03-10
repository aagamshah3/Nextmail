<?php
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$uid = $_GET['mail_id'];
$mailbox = $_GET['mailbox'];
$mailbox_server = "{".$server."}".$mailbox;
$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die(imap_last_error());
$overview = imap_fetch_overview($mbox, $uid, FT_UID) or die(imap_last_error());
if(!isset($overview[0]->subject))
$subject="No Subject";
else
$subject=$overview[0]->subject;
$param= "'".$uid."','".$subject."'";
echo "<script>";
echo "function caller() { finalCall(".$param.");} </script>"
?>

            <div data-role="content">
			<?php
			if($mailbox=="INBOX"){
			?>
			<div class="ui-grid-a">
	<div class="ui-block-a"><select id="tag" name="tag" data-inline="true" data-mini="true" data-theme="c"" data-icon="plus">
								<option value="Today">Select Tag</option>
								<option value="Today">Today</option>
								<option value="Tomorrow">Tomorrow</option>
								<option value="One Week">One Week</option>
				</select></div>
					<div class="ui-block-b"><a data-role="button" data-inline="true"  data-mini="true" data-theme="c" onclick="caller();" data-icon="check" data-iconpos="right">
                    Save Tag
                </a>	</div>

</div>
<?php
}
?>
                        <div class="email-headers">
			<b> Subject : </b>	<?php  if(!isset($overview[0]->subject))
								echo "No Subject";
								else
								echo $overview[0]->subject; ?><br />
                        <b> From : </b> <?php echo $overview[0]->from ?> <br />
                        <b> To : </b> <?php 
						 if(!isset($overview[0]->to))
								echo "";
								else
								echo $overview[0]->to;
						 
						?><br />
                        </div>
                            
                        <div class="email-body">
					<pre><?php echo getBody($uid, $mbox); ?></pre>
                         </div>
              <a data-role="button" data-inline="true" href="reply.php?mail_id=<?php echo $uid?>&mailbox=<?php echo $mailbox?>" data-icon="back" data-iconpos="right">
                    Reply
                </a>
                <a data-role="button" data-inline="true" href="forward.php?mail_id=<?php echo $uid?>&mailbox=<?php echo $mailbox?>" data-icon="forward" data-iconpos="right">
                    Forward
                </a>
                <a data-role="button" data-inline="true" data-theme="c" href="delete.php?mail_id=<?php echo $uid?>&mailbox=<?php echo $mailbox?>" data-icon="delete" data-iconpos="right">
                    Delete
                </a>
            </div>
<script>
function finalCall(uid,subject) {
saveToDo(uid, subject, document.getElementById("tag").value)
}
</script>

<?php

include_once("footer.php");
?>