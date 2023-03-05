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
getusrinfo($user);
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once('header.php');
	OpenTable();
	echo '<center><font class="title"><strong>'._COMMENTSCONFIG.'</strong></font></center>';
	CloseTable();
	echo '<br />';
	OpenTable();
	nav();
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="modules.php?name='.$module_name.'" method="post">'
		.'<table cellpadding="8" border="0"><tr><td>'
		.'<strong>'._DISPLAYMODE.'</strong>'
		.'<select name="umode">';
	?>
	<option value="nocomments" <?php if ($userinfo['umode'] == 'nocomments') { echo 'selected="selected"'; } ?>><?php echo _NOCOMMENTS ?></option>
	<option value="nested" <?php if ($userinfo['umode'] == 'nested') { echo 'selected="selected"'; } ?>><?php echo _NESTED ?></option>
	<option value="flat" <?php if ($userinfo['umode'] == 'flat') { echo 'selected="selected"'; } ?>><?php echo _FLAT ?></option>
	<option value="thread" <?php if (!isset($userinfo['umode']) || (empty($userinfo['umode'])) || $userinfo['umode']=='thread') { echo 'selected="selected"'; } ?>><?php echo _THREAD ?></option>
	</select>
	<br /><br />
	<strong><?php echo _SORTORDER ?></strong>
	<select name="uorder">
	<option value="0" <?php if (!$userinfo['uorder']) { echo 'selected="selected"'; } ?>><?php echo _OLDEST ?></option>
	<option value="1" <?php if ($userinfo['uorder']==1) { echo 'selected="selected"'; } ?>><?php echo _NEWEST ?></option>
	<option value="2" <?php if ($userinfo['uorder']==2) { echo 'selected="selected"'; } ?>><?php echo _HIGHEST ?></option>
	</select>
	<br /><br />
	<strong><?php echo _THRESHOLD ?></strong>
	<?php echo _COMMENTSWILLIGNORED ?><br />
	<select name="thold">
	<option value="-1" <?php if ($userinfo['thold']==-1) { echo 'selected="selected"'; } ?>>-1: <?php echo _UNCUT ?></option>
	<option value="0" <?php if ($userinfo['thold']==0) { echo 'selected="selected"'; } ?>>0: <?php echo _EVERYTHING ?></option>
	<option value="1" <?php if ($userinfo['thold']==1) { echo 'selected="selected"'; } ?>>1: <?php echo _FILTERMOSTANON ?></option>
	<option value="2" <?php if ($userinfo['thold']==2) { echo 'selected="selected"'; } ?>>2: <?php echo _USCORE ?> +2</option>
	<option value="3" <?php if ($userinfo['thold']==3) { echo 'selected="selected"'; } ?>>3: <?php echo _USCORE ?> +3</option>
	<option value="4" <?php if ($userinfo['thold']==4) { echo 'selected="selected"'; } ?>>4: <?php echo _USCORE ?> +4</option>
	<option value="5" <?php if ($userinfo['thold']==5) { echo 'selected="selected"'; } ?>>5: <?php echo _USCORE ?> +5</option>
	</select><br />
	<i><?php echo _SCORENOTE ?></i>
	<br /><br />
	<input type="checkbox" name="noscore" <?php if ($userinfo['noscore']==1) { echo 'checked="checked"'; } ?> /><strong> <?php echo _NOSCORES ?></strong> <?php echo _HIDDESCORES ?>
	<br /><br />
	<strong><?php echo _MAXCOMMENT ?></strong> <?php echo _TRUNCATES ?><br />
	<input type="text" name="commentmax" value="<?php echo intval($userinfo['commentmax']) ?>" size="11" maxlength="11" /> <?php echo _BYTESNOTE ?>
	<br /><br />
	<input type="hidden" name="username" value="<?php echo $userinfo['username']; ?>" />
	<input type="hidden" name="user_id" value="<?php echo intval($userinfo['user_id']); ?>" />
	<input type="hidden" name="op" value="savecomm" />
	<input type="submit" value="<?php echo _SAVECHANGES ?>" />
	</td></tr></table></form>
    <?php
    CloseTable();
    echo '<br /><br />';
	include_once 'footer.php';
} else {
	mmain($user);
}
?>