<?php

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
     echo "CNBYA protection";
     exit;
}

    include_once("header.php");
//**Start** Password Strength Meter for loading dynamically of js and css //DH//
addJSToHead('includes/jquery/lib/jquery.validate.js','file');
addJSToHead('includes/jquery/lib/jquery.pstrength-min.1.2.js','file');
//**END** Password Strength Meter for loading dynamically of jquery and css //DH// 

    title(_USERREGLOGIN);
    OpenTable();
    echo "<table align='center' cellpadding='3' cellspacing='3' border='0'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'><strong>"._REGNEWUSER."</strong></td></tr>\n";
    echo "<form action='modules.php?name=$module_name' method='post'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":</td><td bgcolor='$bgcolor1'><input type='text' name='ya_username' size='15' maxlength='".$ya_config['nick_max']."'>&nbsp;<font class='tiny'>"._REQUIRED."</font><br><font class='tiny'>("._YA_NICKLENGTH.")</font></td></tr>\n";
// menelaos: by request: added realname to the registration form
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":<br>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_realname' size='40' maxlength='60'></td></tr>\n";

    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email' size='40' maxlength='255'>&nbsp;<font class='tiny'>"._REQUIRED."</font></td></tr>\n";
        echo security_code(array(3,4,6,7), 'stacked')."\n";
        echo '<input type="hidden" name="random_num" value="'.$random_num.'" />';
    // menelaos: added configurable doublecheck email routine
    if ($ya_config['doublecheckemail']==1) {
	echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEEMAIL.":</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email2' size='40' maxlength='255'></td></tr>\n";
    } else {
	echo "<input type='hidden' name='ya_user_email2' value='ya_user_email'>\n";
    }
 /*****[BEGIN]******************************************
 [ Mod:     coRpSE Nuke Honeypot					  ]
 ******************************************************/
	echo "<input type='hidden' name='loadtime' value=".time().">\n";
	echo "<tr id=\"noninfo\"><td bgcolor='$bgcolor2'><div class=\"textbold\"><font color=\"FF0000\">(Don't Answer!)</font><br>What is 2 + 2?:</td><td bgcolor='$bgcolor1'><input name=\"addition\" type=\"text\" size=\"10\"> <span class='tiny'>"._REQUIRED."</span>
	</td></tr>";
	echo"<script type=\"text/javascript\"> 
    var e = document.getElementById('noninfo'); 
    e.parentNode.removeChild(e); 
</script>";
echo "<script type=\"text/javascript\" />
    function blink(selector){
        $(selector).fadeOut('slow', function(){
            $(this).fadeIn('slow', function(){
                blink(this);
            });
        });
    }
    $(function() {
        blink('#blink');
    });
</script>";
   echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\" id=\"blink\"><font color=\"FF0000\">A n t i B o t: *</font></div></td><td bgcolor='$bgcolor1'><input name=\"company\" type=\"text\" size=\"23\" value=\"Delete All Of This Text!\"> <span class='tiny'>"._REQUIRED."</span>
	</td></tr>";
/*****[END]********************************************
 [ Mod:     coRpSE Nuke Honeypot           			  ]
 ******************************************************/

	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE (need = '2') OR (need = '3') ORDER BY pos");
	    while ($sqlvalue = $db->sql_fetchrow($result)) {
	      $t = $sqlvalue[fid];
		  $value2 = explode("::", $sqlvalue[value]);
		  if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
		  if (count($value2) == 1) { 
			echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
			echo "<input type='text' name='nfield[$t]' size='20' maxlength='$sqlvalue[size]'>\n";
			} else {
			echo "<tr><td bgcolor='$bgcolor2'>$name_exit</td><td bgcolor='$bgcolor3'>";
			echo "<select name='nfield[$t]'>\n";
				for ($i = 0; $i<count($value2); $i++) {
				echo "<option value=\"".trim($value2[$i])."\">".trim($value2[$i])."</option>\n";
				}
		  	echo "</select>";
		  }
			if (($sqlvalue[need]) > 1) echo"&nbsp;<font class='tiny'>"._REQUIRED."</font>";
		  	echo "</td></tr>\n";	  
	    }

    echo "<tr><td bgcolor='$bgcolor2'>"._PASSWORD.":</td><td bgcolor='$bgcolor1'><input type='password' name='user_password' size='10' maxlength='".$ya_config['pass_max']."'><br><font class='tiny'>("._BLANKFORAUTO.")</font><br><font class='tiny'>("._YA_PASSLENGTH.")</font></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEPASSWORD.":</td><td bgcolor='$bgcolor1'><input type='password' name='user_password2' size='10' maxlength='".$ya_config['pass_max']."'><br><font class='tiny'>("._BLANKFORAUTO.")</font><br><font class='tiny'>("._YA_PASSLENGTH.")</font></td></tr>\n";
/*****[BEGIN]******************************************
 [ Mod:     coRpSE Nuke Honeypot					  ]
 ******************************************************/
echo "<tr><td bgcolor='$bgcolor1' colspan='2' width='100%'><p align=\"center\" id=\"countdown-1\"><strong>Antibot wait</strong>, please don't click \"Continue\" for 15 second(s)</p>
<script type=\"text/javascript\">
    var countdown = document.getElementById('countdown-1'),
    passed    = 0,
    seconds   = 15;
 
function countdownTimer() {
        // If the total amount of time passed matches or is greater than the amount of time
        // we expect to stay idle for then we can probably assume the person using the form
        // is a human not a stupid BOT
        if (passed >= seconds) {
                countdown.innerHTML = '<strong>All done! You can click \"Continue\" at anytime!</strong>';
 
                // Clear the countdown interval
                clearInterval(itv);
                return;
        }
 
        var wait = seconds - passed,
            wait = (wait < 10) ? ('0' + wait) : wait;
 
        // Update the total number of seconds remaining until the countdown is done
        countdown.innerHTML = '<strong>Antibot wait</strong>, please don\'t click \"Continue\" for ' + wait + ' second(s)';
 
        // Increment the total amount of time passed
        passed++;
}
 
// Start the countdown timer
var itv = setInterval(countdownTimer, 1000);
</script></td></tr>";
/*****[END]********************************************
 [ Mod:     coRpSE Nuke Honeypot           			  ]
 ******************************************************/
    echo "<input type='hidden' name='op' value='new_confirm'>\n";
    echo "<tr><td align='right' bgcolor='$bgcolor1' colspan='2'><input type='submit' value='"._YA_CONTINUE."'></td></tr>\n";
    echo "</form></table>\n";
    echo "<br>\n";
    echo ""._YOUWILLRECEIVE."<br><br>\n";
    echo ""._COOKIEWARNING."<br>\n";
    echo ""._ASREGUSER."<br>\n";
    echo "<ul>\n";
    echo "<li>"._ASREG1."\n";
    echo "<li>"._ASREG2."\n";
    echo "<li>"._ASREG3."\n";
    echo "<li>"._ASREG4."\n";
    echo "<li>"._ASREG5."\n";
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
        if ((!ereg("[.]",$file) AND file_exists("themes/$file/theme.php"))) { $thmcount++; }
    }
    closedir($handle);
    if ($thmcount > 1) { echo "<li>"._ASREG6."\n"; }
    $sql = "SELECT custom_title FROM ".$prefix."_modules WHERE active='1' AND view='1' AND inmenu='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $custom_title = $row[custom_title];
        if ($custom_title != "") { echo "<li>"._ACCESSTO." $custom_title\n"; }
    }
    $sql = "SELECT title FROM ".$prefix."_blocks WHERE active='1' AND view='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $b_title = $row[title];
        if ($b_title != "") { echo "<li>"._ACCESSTO." $b_title\n"; }
    }
    if (is_active("Journal")) { echo "<li>"._CREATEJOURNAL."\n"; }
    if ($my_headlines == 1) { echo "<li>"._READHEADLINES."\n"; }
    echo "<li>"._ASREG7."\n";
    echo "</ul>\n";
    echo ""._REGISTERNOW."<br>\n";
    echo ""._WEDONTGIVE."<br><br>\n";
    echo "<center><font class='content'>[ <a href='modules.php?name=$module_name'>"._USERLOGIN."</a> | <a href='modules.php?name=$module_name&op=pass_lost'>"._PASSWORDLOST."</a> ]</font></center>\n";
    CloseTable();
    include_once("footer.php");

?>
