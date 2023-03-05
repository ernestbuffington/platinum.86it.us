<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = _GR_ADMIN.' '.$grconfig['version_number'].': '._GR_GROUPSEDIT;
include_once('header.php');
title("$pagetitle");
NSNGroupsAdmin();
echo "<br />\n";
OpenTable();
$sel1 = $sel2 = '';
$gid = intval($gid);
$grow = $db->sql_fetchrow($db->sql_query('SELECT * FROM `'.$prefix.'_nsngr_groups` WHERE `gid`='.$gid));
if($grow['gpublic'] == 0) { $sel1 = ' selected="selected"'; } else { $sel2 = ' selected="selected"'; }
$mrow = $db->sql_fetchrow($db->sql_query('SELECT * FROM `'.$user_prefix.'_users` WHERE `user_id`=\''.$grow['muid'].'\''));

echo '<form method="post" action="'.$admin_file.'.php">'."\n";
echo '<input type="hidden" name="op" value="NSNGroupsEditSave" />'."\n";
echo '<input type="hidden" name="gid" value="'.$gid.'" />'."\n";
echo '<input type="hidden" name="old_muid" value="'.$grow['muid'].'" />'."\n";

echo '<table align="center" border="0" cellpadding="0" cellspacing="2">'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._GR_GROUP.':</strong></td>';
echo '<td><input type="text" name="gname" size="40" maxlength="32" value="'.$grow['gname'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._GR_BBMODERATOR.':</strong></td>';
echo '<td><input type="text" name="mname" size="30" maxlength="25" value="'.$mrow['username'].'" /></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._GR_DESCRIPTION.':</strong></td>';
echo '<td><textarea name="gdesc"'.$textrowcol.'>'.$grow['gdesc'].'</textarea></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._GR_PUBLIC.':</strong></td>';
echo '<td><select name="gpublic"><option value="0"'.$sel1.'>'._NO.'</option>';
echo '<option value="1"'.$sel2.'>'._YES.'</option></select><br />'._GR_PUBLICNOTE.'</td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'" valign="top"><strong>'._GR_LIMIT.':</strong></td>';
echo '<td><input type="text" name="glimit" size="4" maxlength="4" value="'.$grow['glimit'].'" /><br />'._GR_LIMITNOTE.'</td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._GR_EDITGRP.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include_once('footer.php');

?>
