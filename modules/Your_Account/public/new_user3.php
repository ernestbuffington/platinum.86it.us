<?php

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke     		*/
/* ============================================                         		*/
/*                                                                      		*/
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                     		*/
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                		*/
/*                                                                      		*/
/* Contact author: escudero@phpnuke.org.br                              		*/
/* International Support Forum: http://ravenphpscripts.com/forum76.html 		*/
/*                                                                      		*/
/* This program is free software. You can redistribute it and/or modify 		*/
/* it under the terms of the GNU General Public License as published by 		*/
/* the Free Software Foundation; either version 2 of the License.       		*/
/*                                                                      		*/
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion	*/
/*********************************************************************************/

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
echo '          <!-- Spam Warning Start -->
      	<script type="text/javascript" language="JavaScript">
		<!--
		// Spam warning
		function spamwarn_question()
		{
			if (confirm("' . _SPAMWARN . '"))
			{
				document.getElementsByName("user_viewemail")[0].checked = true;
				return true;
			}
			else
			{
				document.getElementsByName("user_viewemail")[1].checked = true;
				return false;
			}
		}
		//-->
		</script>
        <!-- Spam Warning End -->';
    title(_USERREGLOGIN);
    OpenTable();
    echo "<table align='center' cellpadding='3' cellspacing='3' border='0'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'><strong>"._REGNEWUSER."</strong></td></tr>\n";
    echo "<form action='modules.php?name=$module_name' method='post'>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._NICKNAME.":<br>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_username' size='15' maxlength='".$ya_config['nick_max']."'>&nbsp;<font class='tiny'>"._REQUIRED."</font><br><font class='tiny'>("._YA_NICKLENGTH.")</font></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UREALNAME.":<br>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_realname' size='40' maxlength='60'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._EMAIL.":<br>"._REQUIRED."</td><td bgcolor='$bgcolor1'><input type='text' name='ya_user_email' size='40' maxlength='255'>&nbsp;<font class='tiny'>"._REQUIRED."</font></td></tr>\n";
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
// Start add - Birthday MOD
	$s_b_day = '<span class="genmed">Day&nbsp</span><select name="b_day" size="1" 

class="gensmall"> 
		<option value="0">&nbsp;-&nbsp;</option> 
		<option value="1">&nbsp;1&nbsp;</option>
		<option value="2">&nbsp;2&nbsp;</option>
		<option value="3">&nbsp;3&nbsp;</option>
		<option value="4">&nbsp;4&nbsp;</option>
		<option value="5">&nbsp;5&nbsp;</option>
		<option value="6">&nbsp;6&nbsp;</option>
		<option value="7">&nbsp;7&nbsp;</option>
		<option value="8">&nbsp;8&nbsp;</option>
		<option value="9">&nbsp;9&nbsp;</option>
		<option value="10">&nbsp;10&nbsp;</option>
		<option value="11">&nbsp;11&nbsp;</option>
		<option value="12">&nbsp;12&nbsp;</option>
		<option value="13">&nbsp;13&nbsp;</option>
		<option value="14">&nbsp;14&nbsp;</option>
		<option value="15">&nbsp;15&nbsp;</option>
		<option value="16">&nbsp;16&nbsp;</option>
		<option value="17">&nbsp;17&nbsp;</option>
		<option value="18">&nbsp;18&nbsp;</option>
		<option value="19">&nbsp;19&nbsp;</option>
		<option value="20">&nbsp;20&nbsp;</option>
		<option value="21">&nbsp;21&nbsp;</option>
		<option value="22">&nbsp;22&nbsp;</option>
		<option value="23">&nbsp;23&nbsp;</option>
		<option value="24">&nbsp;24&nbsp;</option>
		<option value="25">&nbsp;25&nbsp;</option>
		<option value="26">&nbsp;26&nbsp;</option>
		<option value="27">&nbsp;27&nbsp;</option>
		<option value="28">&nbsp;28&nbsp;</option>
		<option value="29">&nbsp;29&nbsp;</option>
		<option value="30">&nbsp;30&nbsp;</option>
		<option value="31">&nbsp;31&nbsp;</option>
	  	</select>&nbsp;&nbsp;';
	$s_b_md = '<span class="genmed">Month&nbsp</span><select name="b_md" size="1" 

class="gensmall"> 
     		<option value="0">&nbsp;-&nbsp;</option> 
		<option value="1">&nbsp;January&nbsp;</option>
		<option value="2">&nbsp;February&nbsp;</option>
		<option value="3">&nbsp;March&nbsp;</option>
		<option value="4">&nbsp;Apri&nbsp;</option>
		<option value="5">&nbsp;May&nbsp;</option>
		<option value="6">&nbsp;June&nbsp;</option>
		<option value="7">&nbsp;July&nbsp;</option>
		<option value="8">&nbsp;August&nbsp;</option>
		<option value="9">&nbsp;September&nbsp;</option>
		<option value="10">&nbsp;October&nbsp;</option>
		<option value="11">&nbsp;November&nbsp;</option>
		<option value="12">&nbsp;December&nbsp;</option>
		</select>&nbsp;&nbsp;';
	$s_b_day= str_replace("value=\"".$b_day."\">", "value=\"".$b_day."\" SELECTED>" ,$s_b_day);
	$s_b_md = str_replace("value=\"".$b_md."\">", "value=\"".$b_md."\" SELECTED>" ,$s_b_md);
	$s_b_year = '<span class="genmed">Year&nbsp</span><input type="text" class="post" 

style="width: 50px" name="b_year" size="4" maxlength="4" value="' . $b_year . '" />&nbsp;&nbsp;'; 
$s_birthday .=$s_b_day;
$s_birthday .=$s_b_md;
$s_birthday .=$s_b_year;
// End add - Birthday MOD
    echo "<tr><td bgcolor='$bgcolor2'>"._PASSWORD.":</td><td bgcolor='$bgcolor1'><input type='password' name='user_password' size='10' maxlength='".$ya_config['pass_max']."'><br><font class='tiny'>("._BLANKFORAUTO.")</font><br><font class='tiny'>("._YA_PASSLENGTH.")</font></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._RETYPEPASSWORD.":</td><td bgcolor='$bgcolor1'><input type='password' name='user_password2' size='10' maxlength='".$ya_config['pass_max']."'><br><font class='tiny'>("._BLANKFORAUTO.")</font><br><font class='tiny'>("._YA_PASSLENGTH.")</font></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._UFAKEMAIL.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='femail' size='40' maxlength='255'><br>"._EMAILPUBLIC."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YOURHOMEPAGE.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_website' size='40' maxlength='255'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YICQ.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_icq' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YAIM.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_aim' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YYIM.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_yim' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YMSNM.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_msnm' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YLOCATION.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_from' size='30' maxlength='100'></td></tr>\n";
// Start add - Birthday MOD
    echo "<td bgcolor='$bgcolor2'>Birthday<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'>".$s_birthday."</td></tr>\n";
// End add - Birthday MOD
    echo "<tr><td bgcolor='$bgcolor2'>"._YOCCUPATION.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_occ' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._YINTERESTS.":<br>"._OPTIONAL."</td><td bgcolor='$bgcolor1'><input type='text' name='user_interests' size='30' maxlength='100'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>Gender:</span></td>";
    echo "<td bgcolor='$bgcolor1'>"; 
    echo '<input type="radio" name="gender" value="0" checked=\"checked\"/> 
	      None Specified</span>&nbsp;&nbsp; 
	      <input type="radio" name="gender" value="1" /> 
	      Male</span>&nbsp;&nbsp;
	      <input type="radio" name="gender" value="2"/> 
	      Female</span></td>
	</tr>';
    echo "<tr><td bgcolor='$bgcolor2'>"._RECEIVENEWSLETTER."</td><td bgcolor='$bgcolor1'><select name='newsletter'><option value='1' selected>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
/*****[START]***** Email Spam Warning - sgtmudd *****/
	echo '<tr><td><label for="user_viewemail">' . _ALWAYSSHOWEMAIL . ': *</label></td><td><input type="radio" name="user_viewemail" value="1" onclick="return spamwarn_question();" />' . _YES . '&nbsp;&nbsp;<input type="radio" name="user_viewemail" value="0" checked="checked" />' . _NO . '</td></tr>';
/*****[END]***** Email Spam Warning - sgtmudd *******/
/*
    echo "<tr><td bgcolor='$bgcolor2'>"._ALWAYSSHOWEMAIL.":</td><td bgcolor='$bgcolor1'><select name='user_viewemail'><option value='1' selected>"._YES."</option><option value='0'>"._NO."</option></select></td></tr>\n";
*/
// Reported by MrFluffy
    echo "<tr><td bgcolor='$bgcolor2'>"._HIDEONLINE.":</td><td bgcolor='$bgcolor1'><select name='user_allow_viewonline'><option value='0'>"._YES."</option><option value='1' selected>"._NO."</option></select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FORUMSTIME."</td><td bgcolor='$bgcolor1'><select name='user_timezone'>";
    $utz = date("Z");
    $utz = round($utz/3600);
    for ($i=-12; $i<13; $i++) {
        if ($i == 0) {
            $dummy = "GMT";
        } else {
            if (!ereg("-", $i)) { $i = "+$i"; }
            $dummy = "GMT $i "._HOURS."";
        }
        if ($utz == $i) {
            echo "<option name=\"user_timezone\" value=\"$i\" selected>$dummy</option>";
        } else {
            echo "<option name=\"user_timezone\" value=\"$i\">$dummy</option>";
        }
    }
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><strong>"._FORUMSDATE.":</strong><br>"._FORUMSDATEMSG."</strong></td><td bgcolor='$bgcolor1'><input type='text' name='user_dateformat' value='Y-m-d, H:i:s' size='15' maxlength='14'></td></tr>\n";
//    echo "<tr><td bgcolor='$bgcolor2'><strong>"._SIGNATURE.":</strong><br>"._OPTIONAL."<br>"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea wrap='virtual' cols='50' rows='5' name='user_sig'></textarea><br>"._255CHARMAX."</td></tr>\n";
//    echo "<tr><td bgcolor='$bgcolor2'><strong>"._EXTRAINFO.":</strong><br>"._OPTIONAL."<br>"._NOHTML."</td><td bgcolor='$bgcolor1'><textarea wrap='virtual' cols='50' rows='5' name='bio'></textarea><br>"._CANKNOWABOUT."</td></tr>\n";
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

    echo "<tr><td align='center' bgcolor='$bgcolor1' colspan='2'>\n";
        echo security_code(array(3,4,6,7), 'stacked')."\n";
        echo '<input type="hidden" name="random_num" value="'.$random_num.'" /><br>';
    echo "<input type='submit' value='"._YA_CONTINUE."'></form></table>\n";
    echo "<br>\n";
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
    echo _REGISTERNOW."<br>\n";
    echo _WEDONTGIVE."<br><br></td></tr>\n";
    CloseTable();
    include_once("footer.php");

?>
