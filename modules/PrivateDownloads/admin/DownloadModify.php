<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

if (!isset($min)) { $min = 0; }
$pagetitle = _DOWNLOADSADMIN." - "._MODDOWNLOAD;
include_once("header.php");
title($pagetitle);
dladminmain();
echo "<br />\n";
OpenTable();
$lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'"));
if ($lidinfo['submitter'] == "") { $lidinfo['submitter'] = $anonymous; }
$lidinfo['homepage'] = preg_replace("#http://#","",$lidinfo['homepage']);
if ($lidinfo['homepage'] != "") { $lidinfo['homepage'] = "http://".$lidinfo['homepage']; }
$lidinfo['title'] = stripslashes($lidinfo['title']);
$lidinfo['description'] = stripslashes($lidinfo['description']);
echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._DOWNLOADID.":</td><td><strong>$lid</strong></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._TITLE.":</td><td><input type='text' name='title' value='".$lidinfo['title']."' size='50' maxlength='100'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='url' value='".$lidinfo['url']."' size='50' maxlength='100'>&nbsp;[ <a href='".$lidinfo['url']."' target='new'>"._CHECK."</a> ]</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td><select name='cat'><option value='0'";
if ($lidinfo['cid'] == 0) { echo " selected"; }
echo ">"._DL_NONE."</option>\n";
$result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
while($cidinfo = $db->sql_fetchrow($result2)) {
  if ($cidinfo['cid']==$lidinfo['cid']) { $sel = " selected"; } else { $sel = ""; }
  if ($cidinfo['parentid'] != 0) $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']);
  echo "<option value='".$cidinfo['cid']."'$sel>".$cidinfo['title']."</option>\n";
}
echo "</select></td></tr>\n";
$sel1 = $sel2 = $sel3 = "";
if ($lidinfo['sid'] == 0) { $sel1 = " selected"; } elseif ($lidinfo['sid'] == 1) { $sel2 = " selected"; } elseif ($lidinfo['sid'] == 2) { $sel3 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td><select name='perm'>\n";
echo "<option value='0'$sel1>"._DL_ALL."</option>\n";
echo "<option value='1'$sel2>"._DL_USERS."</option>\n";
echo "<option value='2'$sel3>"._DL_ADMIN."</option>\n";
$gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
while($gidinfo = $db->sql_fetchrow($gresult)) {
  $gidinfo['gid'] = $gidinfo['gid'] + 2;
  if ($gidinfo['gid'] == $lidinfo['sid']) { $selected = " selected"; } else { $selected = ""; }
  echo "<option value='".$gidinfo['gid']."'$selected>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='description' cols='60' rows='10'>".$lidinfo['description']."</textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td><input type='text' name='rname' size='50' maxlength='100' value='".$lidinfo['name']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td><input type='text' name='email' size='50' maxlength='100' value='".$lidinfo['email']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td><input type='text' name='filesize' size='12' maxlength='20' value='".$lidinfo['filesize']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td><input type='text' name='version' size='11' maxlength='20' value='".$lidinfo['version']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><input type='text' name='homepage' size='50' maxlength='255' value='".$lidinfo['homepage']."'>&nbsp;[ <a href='".$lidinfo['homepage']."' target='new'>"._VISIT."</a> ]</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._HITS.":</td><td><input type='text' name='hits' value='".$lidinfo['hits']."' size='12' maxlength='11'></td></tr>\n";
echo "<input type='hidden' name='op' value='DownloadModifySave'>\n";
echo "<input type='hidden' name='lid' value='$lid'>\n";
echo "<input type='hidden' name='min' value='$min'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._MODIFY."'></td></tr>\n";
echo "</form>\n<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='DownloadDelete'>\n";
echo "<input type='hidden' name='lid' value='$lid'>\n";
echo "<input type='hidden' name='min' value='$min'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DL_DELETE."'></td></tr>\n";
echo "</form>\n</table>\n";
CloseTable();
include_once("footer.php");

?>
