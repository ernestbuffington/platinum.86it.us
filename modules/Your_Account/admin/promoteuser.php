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
if (!defined('YA_ADMIN'))
{
	header('Location: ../../../index.php');
	die ();
}

if ($radminsuper == 1) {
	list($uname, $rname, $email, $site, $upass) = $db->sql_fetchrow($db->sql_query("SELECT username, name, user_email, user_website, user_password FROM ".$user_prefix."_users WHERE user_id='$chng_uid'"));
	$pagetitle = ': '._USERADMIN.' - '._PROMOTEUSER;
	include_once('header.php');
	title(_USERADMIN." - "._PROMOTEUSER);
	amain();
	echo '<br />'."\n";
	OpenTable();
   echo '<center><form action="'.$admin_file.'.php" method="post">';
	 if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
	 if (isset($xop)) { echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n"; }
	 echo '<input type="hidden" name="op" value="yaPromoteUserConf" />'."\n";
	 echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
	 echo '<tr><td align="center">'._SURE2PROMOTE.' <strong>'.$uname.'<i>('.$chng_uid.')</i></strong>?</td></tr>'."\n";
	 echo '<tr><td><table border="0">';
	 echo '<tr><td>'._NAME.':</td><td colspan="3"><input type="text" name="add_name" size="30" maxlength="50" value="'.$rname.'" /> <font class="tiny">'._REQUIREDNOCHANGE.'</font></td></tr>';
	 echo '<tr><td>'._NICKNAME.':</td><td colspan="3"><input type="text" name="add_aid" size="30" maxlength="30" value="'.$uname.'" /> <font class="tiny">'._REQUIRED.'</font></td></tr>';
	 echo '<tr><td>'._EMAIL.':</td><td colspan="3"><input type="text" name="add_email" size="30" maxlength="60" value="'.$email.'" /> <font class="tiny">'._REQUIRED.'</font></td></tr>';
	 echo '<tr><td>'._URL.':</td><td colspan="3"><input type="text" name="add_url" size="30" maxlength="60" value="'.$site.'" /></td></tr>';
	//[vecino398(curt)]  www.vecino398.com -Modification-
	 echo '<tr><td valign="top">' . _PERMISSIONS . ':</td>';
	 $result = $db->sql_query('SELECT mid, title FROM '.$prefix.'_modules ORDER BY title ASC');
	 $a = 0;
	 while ($row = $db->sql_fetchrow($result)) {
		  $title = preg_replace('/_/', ' ', $row['title']);
		  if (file_exists('modules/'.$row['title'].'/admin/index.php') AND file_exists('modules/'.$row['title'].'/admin/links.php') AND file_exists('modules/'.$row['title'].'/admin/case.php')) {
				echo '<td><input type="checkbox" name="auth_modules[]" value="'.$row['mid'].'" />'.$title.'</td>';
				if ($a == 2) {
					 echo '</tr><tr><td>&nbsp;</td>';
					 $a = 0;
				} else {
					 $a++;
				}
		}
	}
	echo '</tr><tr><td>&nbsp;</td>'
		.'<td><input type="checkbox" name="add_radminsuper" value="1" /> <strong>' . _SUPERUSER . '</strong></td>'
		  .'</tr>';
	echo '</table></td></tr>';
	echo '<tr><td align="center"><input type="submit" value="'._PROMOTEUSER.'" /></td></tr>'."\n";
	echo '</table>'."\n";
	echo '<input type="hidden" name="add_password" value="'.$upass.'" />';
	echo '</form>'."\n";
    echo '<form action="'.$admin_file.'.php?op=yaUsers" method="post">';
	if (isset($query)) { echo '<input type="hidden" name="query" value="'.$query.'" />'."\n"; }
	if (isset($min)) { echo '<input type="hidden" name="min" value="'.$min.'" />'."\n"; }
#    if (isset($xop)) { echo "<input type='hidden' name='op' value='$xop' />\n"; }
	echo '<input type="hidden" name="chng_uid" value="'.$chng_uid.'" />'."\n";
	echo '<input type="button" value="'._CANCEL.'" onclick="history.go(-1)" />'."\n";
	echo '</form>'."\n";
	echo '</center>'."\n";
	CloseTable();
	include_once('footer.php');
	}else{
header('Location: ../../../index.php');
	 die ();
}
?>