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

$pagetitle = _CATEGORIESADMIN;
include_once("header.php");
title(_CATEGORIESADMIN);
dladminmain();
echo "<br />\n";
OpenTable();
$cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid='$cid'"));
$cidinfo['cdescription'] = stripslashes($cidinfo['cdescription']);
echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<tr><td align='center' colspan='2'><strong>"._MODCATEGORY."</strong></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td><input type='text' name='title' value='".$cidinfo['title']."' size='50' maxlength='50'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='cdescription' cols='50' rows='10'>".$cidinfo['cdescription']."</textarea></td></t>\n";
$sel0 = $sel1 = $sel2 = $sel3 = "";
if ($cidinfo['whoadd'] == -1) { $sel0 = " selected"; } elseif ($cidinfo['whoadd'] == 0) { $sel1 = " selected"; } elseif ($cidinfo['whoadd'] == 1) { $sel2 = " selected"; } elseif ($cidinfo['whoadd'] == 2) { $sel3 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._DL_WHOADD.":</td><td><select name='whoadd'>\n";
echo "<option value='-1'$sel0>"._DL_NONE."</option>\n";
echo "<option value='0'$sel1>"._DL_ALL."</option>\n";
echo "<option value='1'$sel2>"._DL_USERS."</option>\n";
echo "<option value='2'$sel3>"._DL_ADMIN."</option>\n";
$gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
while($gidinfo = $db->sql_fetchrow($gresult)) {
  $gidinfo['gid'] = $gidinfo['gid'] + 2;
  if ($gidinfo['gid'] == $cidinfo['whoadd']) { $selected = " SELECTED"; } else { $selected = ""; }
  echo "<option value='".$gidinfo['gid']."'$selected>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._UPDIRECTORY.":</td><td><input type='text' name='uploaddir' value='".$cidinfo['uploaddir']."' size='50' maxlength='255'></td></t>\n";
$sel0 = $sel1 = "";
if ($cidinfo['canupload'] == 0) { $sel0 = " selected"; } elseif ($cidinfo['canupload'] == 1) { $sel1 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._DL_CANUPLOAD.":</td><td><select name='canupload'>\n";
echo "<option value='0'$sel0>"._DL_NO."</option>\n";
echo "<option value='1'$sel2>"._DL_YES."</option>\n";
echo "</select></td></tr>\n";
echo "<input type='hidden' name='cid' value='$cid'>\n";
echo "<input type='hidden' name='op' value='CategoryModifySave'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr></form>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='cid' value='$cid'>\n";
echo "<input type='hidden' name='op' value='CategoryDelete'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DL_DELETE."'></td></tr></form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>
