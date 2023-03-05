<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}

include_once 'header.php';
//**Start** Password Strength Meter for loading dynamically of js and css //DH//
addJSToHead('includes/jquery/lib/jquery.validate.js','file');
addJSToHead('includes/jquery/lib/jquery.pstrength-min.1.2.js','file');
//**END** Password Strength Meter for loading dynamically of jquery and css //DH// 
echo '<!-- Spam Warning Start -->
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
$next = '';
if ($ya_config['requireadmin'] == 1) {
	title(_USERAPPLOGIN);
	$next = _WAITAPPROVAL . '<br /><br />';
} else {
	title(_USERREGLOGIN);
	if ($ya_config['useactivate'] == 1) $next = _YOUWILLRECEIVE . '<br /><br />';
}
OpenTable();
echo '<form id="newUser" class="cmxform" action="modules.php?name=' . $module_name . '" method="post">';
if (!empty($errormsg)) {
	echo '<p><strong>Input Errors:</strong> ' . $errormsg . '</p>';
} else {
	$ya_username = '';
	$ya_realname = '';
	$ya_user_email = '';
	$ya_user_email2 = '';
	$user_password2 = '';
	$user_password = '';
}
echo '<fieldset><legend><strong>' . _REGNEWUSER . '</strong></legend>';
echo '<table><p><strong>* = ' . _REQUIRED . '</strong></p>';
echo '<tr><td><label for="ya_username">*' . _NICKNAME . ':</label></td>';
echo '<td><input type="text" id="ya_username" name="ya_username" size="15" maxlength="' . $ya_config['nick_max'] . '" value="' . $ya_username . '" />';
echo '<font class="tiny"><span id="userAvailability"></span></font>';
echo '<label for="ya_nicklength">&nbsp;</label><input id="ya_nicklength" name="ya_nicklength" type="hidden" />';
echo '<font class="tiny">(' . _YA_NICKLENGTH . ')</font></td>';
if ($ya_config['userealname'] > 1) {
	echo '<tr><td><label for="ya_realname">*' . _UREALNAME . ':</td>';
	if ($ya_config['userealname'] == 3) {
	}
	echo '</label><td><input type="text" id="ya_realname" name="ya_realname" size="40" maxlength="60"  value="' . $ya_realname . '" /></td></tr>';
}
echo '<tr><td><label for="ya_user_email">*' . _EMAIL . ':</td></label><td><input type="text" id="ya_user_email" name="ya_user_email" size="40" maxlength="255" value="' . $ya_user_email . '" />
	 <span id="emailAvailability" class="error"></span></td></tr>';
if ($ya_config['doublecheckemail'] == 1) {
	echo '<tr><td><label for="ya_user_email2">*' . _RETYPEEMAIL . ':</label></td><td><input type="text" id="ya_user_email2" name="ya_user_email2" size="40" maxlength="255" value="' . $ya_user_email2 . '" /></td>';
} else {
	echo '<td><input type="hidden" name="ya_user_email2" value="ya_user_email" /></td>';
}
echo '</tr>';
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
   echo "<tr><td bgcolor='$bgcolor2'><div class=\"textbold\" id=\"blink\"><font color=\"FF0000\">*A n t i B o t: </font></div></td><td bgcolor='$bgcolor1'><input name=\"company\" type=\"text\" size=\"23\" value=\"Delete All Of This Text!\"> <span class='tiny'>"._REQUIRED."</span>
	</td></tr>";
/*****[END]********************************************
 [ Mod:     coRpSE Nuke Honeypot           			  ]
 ******************************************************/
echo $ya_CustomFields['HTML'];
$pass_size = intval($ya_config['pass_max']) +3;
echo '<tr><td><label for="user_password">' . _PASSWORD . ':</label></td><td><br /><input class="user_password" id="user_password" name="user_password" type="password" size="' . $pass_size . '" maxlength="' . $ya_config['pass_max'] . '" value="' . $user_password . '" /></td>';
echo '<td><label for="ya_passlength">&nbsp;</label><input id="ya_passlength" name="ya_passlength" type="hidden" /></td>';
$inlinpwsJS = '<script type="text/javascript">
	jQuery(\'#user_password\').pstrength({minChar: '.$ya_config['pass_min'].', minCharText: \''._YA_PASSLENGTH.' ('._BLANKFORAUTO.')\',
	verdicts: [\'Weak\', \'Not Bad\', \'OK\', \'Strong\', \'Very Strong\']
	});
	</script>';
addJSToBody($inlinpwsJS,'inline');
echo '</tr>';
echo '<tr><td><label for="user_password2">' . _RETYPEPASSWORD . ':</label></td><td><input id="user_password2" name="user_password2" type="password" size="' . $pass_size . '" maxlength="' . $ya_config['pass_max'] . '" value="' . $user_password2 . '" /></td></tr>';
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
                countdown.innerHTML = '<strong>All done! You can click \"Continue\" at any time!</strong>';
 
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
	if ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
	if ($ya_config['usefakeemail'] >= '1') echo '<tr><td><label for="femail">' . _UFAKEMAIL . ':</label></td><td><br /><input type="text" name="femail" size="40" maxlength="255" /><br />' . _EMAILPUBLIC . '</td></tr>';
	if ($ya_config['usewebsite'] >= '1') echo '<tr><td><label for="user_website">' . _YOURHOMEPAGE . ':</label></td><td><input type="text" name="user_website" size="40" maxlength="255" /></td>';
	if ($ya_config['useinstantmessaim'] >= '1') echo '<tr><td><label for="user_aim">' . _YAIM . ':</label></td><td><input type="text" name="user_aim" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['useinstantmessicq'] >= '1') echo '<tr><td><label for="user_icq">' . _YICQ . ':</label></td><td><input type="text" name="user_icq" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['useinstantmessmsn'] >= '1') echo '<tr><td><label for="user_msnm">' . _YMSNM . ':</label></td><td><input type="text" name="user_msnm" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['useinstantmessyim'] >= '1') echo '<tr><td><label for="user_yim">' . _YYIM . ':</label></td><td><input type="text" name="user_yim" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['uselocation'] >= '1') echo '<tr><td><label for="user_from">' . _YLOCATION . ':</label></td><td><input type="text" name="user_from" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['useoccupation'] >= '1') echo '<tr><td><label for="user_occ">' . _YOCCUPATION . ':</label></td><td><input type="text" name="user_occ" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['useinterests'] >= '1') echo '<tr><td><label for="user_interests">' . _YINTERESTS . ':</label></td><td><input type="text" name="user_interests" size="30" maxlength="100" /></td></tr>';
	if ($ya_config['usenewsletter'] >= '1') echo '<tr><td><label for="newsletter">' . _RECEIVENEWSLETTER . ': *</label></td><td><select name="newsletter"><option value="1" selected="selected">' . _YES . '</option><option value="0">' . _NO . '</option></select></td></tr>';
/*****[START]***** Email Spam Warning - sgtmudd *****/
	if ($ya_config['useviewemail'] >= '1') echo '<tr><td><label for="user_viewemail">' . _ALWAYSSHOWEMAIL . ': *</label></td><td><input type="radio" name="user_viewemail" value="1" onclick="return spamwarn_question();" />' . _YES . '&nbsp;&nbsp;<input type="radio" name="user_viewemail" value="0" checked="checked" />' . _NO . '</td></tr>';
/*****[END]***** Email Spam Warning - sgtmudd *******/
	if ($ya_config['usehideonline'] >= '1') echo '<tr><td><label for="user_allow_viewonline">' . _HIDEONLINE . ': *</label></td><td><select name="user_allow_viewonline"><option value="0">' . _YES . '</option><option value="1" selected="selected">' . _NO . '</option></select></td></tr>';
	echo '<tr><td><label for="ya_realname">' . _FORUMSTIME . ' *</label></td><td><select name="user_timezone">';
	$utz = date('Z');
	$utz = round($utz/3600);
	for ($i = -12;$i < 13;$i++) {
		if ($i == 0) {
			$dummy = 'GMT';
		} else {
			if (!preg_match('/-/', $i)) {
				$i = '+' . $i;
			}
			$dummy = 'GMT ' . $i . ' ' . _HOURS;
		}
		if ($utz == $i) {
			echo '<option value="' . $i . '" selected="selected">' . $dummy . '</option>';
		} else {
			echo '<option value="' . $i . '">' . $dummy . '</option>';
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td><label for="ya_realname">' . _FORUMSDATE . ': *</label></td><td><input type="text" name="user_dateformat" value="Y-m-d, H:i:s" size="15" maxlength="14" />' . _FORUMSDATEMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') echo '<tr><td><label for="ya_realname">' . _SIGNATURE . ':<br />' . _NOHTML . '</label></td><td><textarea cols="50" rows="5" name="user_sig"></textarea><br />' . _255CHARMAX . '</td></tr>';
	if ($ya_config['useextrainfo'] >= '1') echo '<tr><td><label for="ya_realname">' . _EXTRAINFO . ':<br />' . _NOHTML . '</label></td><td><textarea cols="50" rows="5" name="bio"></textarea><br />' . _CANKNOWABOUT . '</td></tr>';
}
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
                countdown.innerHTML = '<strong>All done! You can click \"Continue\" at any time!</strong>';
 
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
echo '<input type="hidden" name="op" value="new_confirm" />';
echo '<tr><td><p align="center"><input type="submit" value="' . _YA_CONTINUE . '" /></p></td></tr></table>';
echo '</fieldset></form>';
echo '<br />';
echo $next;
echo '<p>' . _COOKIEWARNING . '</p>';
if ($ya_config['useasreguser'] == '1') {
	echo _ASREGUSER . '<br />';
	echo '<ul>';
	echo '<li>' . _ASREG1 . '</li>';
	echo '<li>' . _ASREG2 . '</li>';
	echo '<li>' . _ASREG3 . '</li>';
	echo '<li>' . _ASREG4 . '</li>';
	echo '<li>' . _ASREG5 . '</li>';
	$handle = opendir('themes');
	$thmcount = 0;
	while ($file = readdir($handle)) {
		if ((!preg_match('/[.]/', $file) AND file_exists('themes/' . $file . '/theme.php'))) {
			$thmcount++;
		}
	}
	closedir($handle);
	if ($thmcount > 1) {
		echo '<li>' . _ASREG6 . '</li>';
	}
	$sql = 'SELECT custom_title FROM ' . $prefix . '_modules WHERE active=\'1\' AND view=\'1\' AND inmenu=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$custom_title = $row['custom_title'];
		if ($custom_title != '') {
			echo '<li>' . _ACCESSTO . ' ' . $custom_title . '</li>';
		}
	}
	$sql = 'SELECT title FROM ' . $prefix . '_blocks WHERE active=\'1\' AND view=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$b_title = $row['title'];
		if ($b_title != '') {
			echo '<li>' . _ACCESSTO . ' ' . $b_title . '</li>';
		}
	}
	if (is_active('Journal')) {
		echo '<li>' . _CREATEJOURNAL . '</li>';
	}
	if ($my_headlines == 1) {
		echo '<li>' . _READHEADLINES . '</li>';
	}
	echo '<li>' . _ASREG7 . '</li>';
	echo '</ul>';
}
echo _REGISTERNOW . '<br />';
echo _WEDONTGIVE . '<br /><br />';
//echo '<center><font class="content">[ <a href="modules.php?name=' . $module_name . '" >' . _USERLOGIN . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=pass_lost" >' . _PASSWORDLOST . '</a> ]</font></center>';
CloseTable();
include_once 'footer.php';
?>