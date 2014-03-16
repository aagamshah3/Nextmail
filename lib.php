<?php
function getBody($uid, $imap) {
    $body = get_part($imap, $uid, "TEXT/HTML");
    // if HTML body is empty, try getting text body
    if ($body == "") {
        $body = get_part($imap, $uid, "TEXT/PLAIN");
    }
    return $body;
}
 
function get_part($imap, $uid, $mimetype, $structure = false, $partNumber = false) {
    if (!$structure) {
           $structure = imap_fetchstructure($imap, $uid, FT_UID);
    }
    if ($structure) {
        if ($mimetype == get_mime_type($structure)) {
            if (!$partNumber) {
                $partNumber = 1;
            }
            $text = imap_fetchbody($imap, $uid, $partNumber, FT_UID);
            switch ($structure->encoding) {
                case 3: return imap_base64($text);
                case 4: return imap_qprint($text);
                default: return $text;
           }
       }
 
        // multipart
        if ($structure->type == 1) {
            foreach ($structure->parts as $index => $subStruct) {
                $prefix = "";
                if ($partNumber) {
                    $prefix = $partNumber . ".";
                }
                $data = get_part($imap, $uid, $mimetype, $subStruct, $prefix . ($index + 1));
               if ($data) {
                    return $data;
                }
            }
        }
    }
    return false;
}
 
function get_mime_type($structure) {
    $primaryMimetype = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
 
    if ($structure->subtype) {
       return $primaryMimetype[(int)$structure->type] . "/" . $structure->subtype;
    }
    return "TEXT/PLAIN";
}
/*
newLimits(Current Upper Limit, Current Lower Limit, Max Upper Bound i.e Total Messages)
returns array of size 6
array[0] is FLAG to indicate which button(s)[Prev, Next] to display
array[1] is Next(Button) Lower Limit
array[2] is Next(Button) Upper Limit
array[3] is Previous(Button) Lower Limit
array[4] is Previous(Button) Upper Limit
array[5] is Max Upper Bound i.e Total Messages
*/
function newLimits($ll,$ul,$mub) {
$f = 3;// Both "Next" and "Previous" Buttons - Normal Case 
/*
Normal Case
*/
$nul = $ll - 1;
$nll = $nul - 20;

$pll = $ul + 1;
$pul = $pll + 20;

/*
Special Cases
*/
if ($ul == $mub) { // Latest 20 are currently being displayed, So NO "Previous" Button
$pul=0;$pll=0;
$f=1;//Only "Next" Button Case
	if($ll < 20) {
	$nul=0;$nll=0;
	$f=4;// Show NO Buttons - As there are less than 20 mails.
	}
}
else if($nul < 1) { // Reached the LAST(NOT LATEST) 20 (or less) messages, So No "Next" Button
$nul=0;$nll=0;
$f=2; //Only "Previous" Button Case
}
else if($nll < 1) { //Reached the Second Last 20 Messages and there are less than 20 messages to show 
$nll = 1;
}

return array($f,$nll,$nul,$pll,$pul,$mub); 
}

/*
The "Previous" Button will show the 20 mails(ideal case) received BEFORE the latest 20 mails (already displayed)
The "Next" Button will show the 20 mails that were received AFTER the current 20 mails being displayed. 
*/
function displayButtons($flag, $mailbox) {
$nll = $flag[1];
$nul = $flag[2];
$pll = $flag[3];
$pul = $flag[4];
if($flag[0]==1){ // Only Next Button [Current Case: Latest 20 Mails Case]
echo '<a data-role="button" href="mailbox.php?mailbox='.$mailbox.'&&ul='.$nul.'&&ll='.$nll.'" data-icon="arrow-r" data-iconpos="right" >
                    Next
                </a>';
}
else if($flag[0]==2){// Only Previous Button [Current Case: Last 20 Mails Case]
echo '<a data-role="button" href="mailbox.php?mailbox='.$mailbox.'&&ul='.$pul.'&&ll='.$pll.'" data-icon="arrow-l" data-iconpos="left" >
                    Previous
                </a>';
}
else if($flag[0]==3){ // Both Buttons [Normal Case]
echo '<div class="ui-grid-a">';
echo '<div class="ui-block-a"><a data-role="button" href="mailbox.php?mailbox='.$mailbox.'&&ul='.$pul.'&&ll='.$pll.'" data-icon="arrow-l" data-iconpos="left" >
                    Previous
                </a></div>';
echo'<div class="ui-block-b"><a data-role="button" href="mailbox.php?mailbox='.$mailbox.'&&ul='.$nul.'&&ll='.$nll.'" data-icon="arrow-r" data-iconpos="right" >
                    Next
                </a></div></div>';
	


}

}

