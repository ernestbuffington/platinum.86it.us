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
$errormsg = '';
include_once 'header.php';
$ya_username = check_html($ya_username, 'nohtml');
ya_userCheck($ya_username);
$stop = str_replace('<center>', '', $stop);
$stop = str_replace('</center>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
$user_viewemail = '0';
$ya_user_email = strtolower(check_html($ya_user_email, 'nohtml'));
if ($ya_config['userealname'] < '2') {
	$ya_realname = '';
}
if ($ya_realname == '' && $ya_config['userealname'] == 3) {
	$errormsg .= _YA_NOREALNAME . '<br />';
}
if ($ya_config['doublecheckemail'] == 0) {
	$ya_user_email2 == $ya_user_email;
} else {
	$ya_user_email2 = strtolower($ya_user_email2);
	if ($ya_user_email != $ya_user_email2) {
		$errormsg .= _EMAILDIFFERENT . '<br />';
	}
}
ya_mailCheck($ya_user_email);
$stop = str_replace('<center>', '', $stop);
$stop = str_replace('</center>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
$datekey = date('F j');
// fkelly 6/11/2008 took random num out and put check for gfx_chk being set in
// not sure where random num is supposed to be posted from and gfx check will throw an error if it is not set
$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $datekey));
// $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
$code = substr($rcode, 2, $ya_config['codesize']);
/*
 * montego - usegfxcheck is not configurable for RN and only the RN captcha security
 * code should be used.  Therefore, to avoid conflicts, following code is being commented out.
 *
if (isset($gfx_check)) {
	if (extension_loaded('gd') AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 1 OR $ya_config['usegfxcheck'] == 3)) {
		$errormsg .= _SECCODEINCOR . '<br />';
	}
}
*/
/*****[BEGIN]******************************************
 [ Mod:     coRpSE Nuke Honeypot					  ]
 ******************************************************/
 		global $db, $prefix;
$date = date("F j, Y, g:i A");
$ip = $_SERVER['REMOTE_ADDR'];
 
		$loadtime = $_POST['loadtime'];
		$totaltime = time() - $loadtime;
		if($totaltime < 17){
$potnum = "0";
$reason = "Submitted in $totaltime sec.";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname' '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");
			 OpenTable();
  			 echo("You took less than 15 seconds to complete the form, We think your a bot...");
			 echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
			 CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
 		     exit;
			}
		$botblock2 = $_POST["company"];
		if (!empty($botblock2)) {
$reason = $botblock2;
$potnum = "1";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");
		OpenTable();


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
echo "<style type=\"text/css\">
.hpfont {
color:#FF0000;
font-weight:700;
font-size:15px;
}
</style>";
			echo "<div align=\"left\">You failed the bot test!<br>You should have deleted<br><br><div id=\"blink\"><div class=\"hpfont\">$botblock2</div></div><br> and left it blank! <br>Go back and try again.</div>";
			echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
					CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');	
			exit ();
			}
		$botblock = $_POST["addition"];
		if ($botblock == "4" || $botblock == "four") {
		
$reason = "Answered with $botblock";
$potnum = "2";
$db->sql_query("INSERT INTO `" . $prefix . "_honeypot` VALUES ('', '$ya_username', '$ya_realname', '$ya_user_email', '$ip', '$date', '$potnum', '$reason')");



			OpenTable();
			echo "You failed the bot test!";
			echo "<center><span class='content'><br><br><br><br>[ <a href=\"./modules.php?name=Your_Account&op=new_user\">Go Back</a> ]</span></center>";
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');	
			exit ();
			}
/*****[END]********************************************
 [ Mod:     coRpSE Nuke Honeypot           			  ]
 ******************************************************/
if ($user_password == '' AND $user_password2 == '') {
	$user_password = YA_MakePass();
} elseif ($user_password != $user_password2) {
	$errormsg .= _PASSDIFFERENT . '<br />';
} elseif ($user_password == $user_password2 AND (strlen($user_password) < $ya_config['pass_min'] OR strlen($user_password) > $ya_config['pass_max'])) {
	$errormsg .= _YA_PASSLENGTH . '<br />';
}
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need = \'3\' ORDER BY pos');
while ($sqlvalue = $db->sql_fetchrow($result)) {
	$t = $sqlvalue['fid'];
	if (trim($nfield[$t]) == '') {
		if (substr($sqlvalue['name'], 0, 1) == '_') @eval('$name_exit = ' . $sqlvalue['name'] . ';');
		else $name_exit = $sqlvalue['name'];
		$errormsg .= _YA_FILEDNEED1 . $name_exit . _YA_FILEDNEED2 . '<br />';
	}
}
if (empty($errormsg)) {
	if ($ya_config['requireadmin'] == 1) {
		$ncTitle = _USERAPPLOGIN;
		$ncNext = _USERAPPFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _WAITAPPROVAL;
	} elseif ($ya_config['useactivate'] == 1) {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _YOUWILLRECEIVE;
	} else {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '';
	}
	title($ncTitle);
	OpenTable();
	echo '<center><strong>' . $ncNext . '</strong><br /><br />' . $ya_username . ', ' . _USERCHECKDATA . '</center><br />';
	echo '<table align="center" border="0">';
	echo '<tr><td width="50%"><strong>' . _USERNAME . ':</strong></td><td align="left">' . $ya_username . '<br /></td></tr>';
	if ($ya_config['userealname'] > 1) echo '<tr><td width="50%"><strong>' . _UREALNAME . ':</strong></td><td align="left">' . $ya_realname . '<br /></td></tr>';
	echo '<tr><td width="50%"><strong>' . _EMAIL . ':</strong></td><td align="left">' . $ya_user_email . '</td></tr>';
	echo '</table><br /><br />';
	echo '<center>' . $ncNote;
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	echo security_code(array(3, 4, 6, 7) , 'stacked');
	if (isset($nfield)) {
		if (count($nfield) > 0) {
			foreach($nfield as $key => $var) {
				echo '<input type="hidden" name="nfield[' . $key . ']" value="' . $var . '" />';
			}
		}
	}
	echo '<input type="hidden" name="random_num" value="' . $random_num . '" />';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" />';
	echo '<input type="hidden" name="ya_realname" value="' . $ya_realname . '" />';
	echo '<input type="hidden" name="ya_user_email" value="' . $ya_user_email . '" />';
	echo '<input type="hidden" name="user_password" value="' . $user_password . '" />';
	if ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
		if (isset($femail)) echo '<input type="hidden" name="femail" value="' . htmlspecialchars($femail, ENT_QUOTES) . '" />';
		if (isset($user_website)) echo '<input type="hidden" name="user_website" value="' . htmlspecialchars($user_website, ENT_QUOTES) . '" />';
		if (isset($user_icq)) echo '<input type="hidden" name="user_icq" value="' . htmlspecialchars($user_icq, ENT_QUOTES) . '" />';
		if (isset($user_aim)) echo '<input type="hidden" name="user_aim" value="' . htmlspecialchars($user_aim, ENT_QUOTES) . '" />';
		if (isset($user_yim)) echo '<input type="hidden" name="user_yim" value="' . htmlspecialchars($user_yim, ENT_QUOTES) . '" />';
		if (isset($user_msnm)) echo '<input type="hidden" name="user_msnm" value="' . htmlspecialchars($user_msnm, ENT_QUOTES) . '" />';
		if (isset($user_from)) echo '<input type="hidden" name="user_from" value="' . htmlspecialchars($user_from, ENT_QUOTES) . '" />';
		if (isset($user_occ)) echo '<input type="hidden" name="user_occ" value="' . htmlspecialchars($user_occ, ENT_QUOTES) . '" />';
		if (isset($user_interests)) echo '<input type="hidden" name="user_interests" value="' . htmlspecialchars($user_interests, ENT_QUOTES) . '" />';
		if (isset($newsletter)) echo '<input type="hidden" name="newsletter" value="' . intval($newsletter) . '" />';
		if (isset($user_viewemail)) echo '<input type="hidden" name="user_viewemail" value="' . htmlspecialchars($user_viewemail, ENT_QUOTES) . '" />';
		if (isset($user_allow_viewonline)) echo '<input type="hidden" name="user_allow_viewonline" value="' . intval($user_allow_viewonline) . '" />';
		if (isset($user_timezone)) echo '<input type="hidden" name="user_timezone" value="' . htmlspecialchars($user_timezone, ENT_QUOTES) . '" />';
		if (isset($user_dateformat)) echo '<input type="hidden" name="user_dateformat" value="' . htmlspecialchars($user_dateformat, ENT_QUOTES) . '" />';
		if (isset($user_sig)) echo '<input type="hidden" name="user_sig" value="' . htmlspecialchars($user_sig, ENT_QUOTES) . '" />';
		if (isset($bio)) echo '<input type="hidden" name="bio" value="' . htmlspecialchars($bio, ENT_QUOTES) . '" />';
	}
	echo '<input type="hidden" name="op" value="new_finish" /><br /><br />';
	echo '<input type="submit" value="' . _FINISH . '" /> &nbsp;&nbsp;' . _GOBACK . '</form></center>';
	CloseTable();
} else {
	$errormsg = htmlentities($errormsg);
	OpenTable();
	echo '<form action="modules.php?name=' . $module_name . '&amp;op=new_user" method="post">';
	echo '<center><font class="title"><strong>' . _ERRORREG . '</strong></font></center><br /><br />';
	echo '<input type="hidden" name="errormsg" value="' . $errormsg . '" /><br />';
	echo '<input type="hidden" name="op" value="new_user" /><br />';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" /><br />';
	echo '<input type="hidden" name="ya_user_email" value="' . $ya_user_email . '" /><br />';
	echo '<input type="hidden" name="ya_user_email2" value="' . $ya_user_email2 . '" /><br />';
	echo '<input type="hidden" name="ya_realname" value="' . $ya_realname . '" /><br />';
	echo '<input type="hidden" name="user_password" value="' . $user_password . '" /><br />';
	echo '<input type="hidden" name="user_password2" value="' . $user_password2 . '" /><br />';
	echo '<center><input type="submit" name="submit" value="' . _YA_GOBACK . '" /></center>';
	echo '</form>';
	CloseTable();
}
include_once 'footer.php';
?>