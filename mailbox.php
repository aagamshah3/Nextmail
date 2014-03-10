<?php
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
if(isset($_GET['mailbox']))
    $mailbox=$_GET['mailbox'];
else
    $mailbox="INBOX";
$mailbox_server = "{".$server."}".$mailbox; //set in headers/header.php
$mbox = imap_open($mailbox_server, $username, $password, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'))or die(imap_last_error());

$check = imap_check($mbox);
?>
            <div data-role="content">
                <ul data-role="listview" data-divider-theme="d" data-inset="true">
                    <li data-role="list-divider" role="heading">
                        <?php echo $mailbox?>
                    </li>



<?php   
if ($check->Nmsgs != 0){
	$total=$check->Nmsgs;
	if($total>40)
	$total=$total-20; // Display only latest 20 mails
	else
	$total=1;//Display all mails
	$overviews = imap_fetch_overview($mbox,"{$total}:{$check->Nmsgs}");
	$overviews = array_reverse($overviews);             
    foreach($overviews as $overview){
	 if($overview->seen==0)
	 $seenid='id="unseen"';
	 else
	 $seenid='id="seen"';
?>
                    <li data-theme="c">
                        <a <?php echo " ".$seenid." " ?> href="viewmail.php?mail_id=<?php echo $overview->uid?>&mailbox=<?php echo $mailbox?>" data-transition="slide">
                           <?php 
						  
						   if(!isset($overview->subject))
								echo "No Subject";
								else
								echo $overview->subject;
								
							?>

                        </a>
                        <?php for($i=0;$i<5;$i=$i+1) echo "&nbsp;";?>
                        <span class="sender">From : <?php echo $overview->from?> | On : <?php echo $overview->date ?></span>
                    </li>
					
<?php
    }
	}
	else{
	imap_close($mbox);
    echo '  <li data-theme="c"> No Message to Display </li>';
	}
	?>






                </ul>
            </div>

<?php 
include_once("footer.php");
?>