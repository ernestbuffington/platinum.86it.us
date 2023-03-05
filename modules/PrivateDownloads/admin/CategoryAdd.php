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

$pagetitle = _CATEGORIESADMIN.": "._ADDCATEGORY;
include_once("header.php");
title($pagetitle);
dladminmain();
echo "<br />\n";
OpenTable();
echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td><input type='text' name='title' size='50' maxlength='50'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._PARENT."</td><td><select name='cid'><option value='0' selected>"._DL_NONE."</option>\n";
$result = $db->sql_query("SELECT cid, title, parentid FROM ".$prefix."_nsngd_categories WHERE parentid='0' ORDER BY title");
while($cidinfo = $db->sql_fetchrow($result)) {
  $crawled = array($cidinfo['cid']);
  CrawlLevel($cidinfo['cid']);
  $x=0;
  while ($x <= (sizeof($crawled)-1)) {
    list($title,$parentid) = $db->sql_fetchrow($db->sql_query("SELECT title, parentid FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'"));
    if ($x > 0) { $title = getparent($parentid,$title); }
    echo "<option value='$crawled[$x]'>$title</option>\n";
    $x++;
  }
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='cdescription' cols='50' rows='5'></textarea></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._DL_WHOADD.":</td><td><select name='whoadd'>\n";
echo "<option value='-1'>"._DL_NONE."</option>\n";
echo "<option value='0' selected>"._DL_ALL."</option>\n";
echo "<option value='1'>"._DL_USERS."</option>\n";
echo "<option value='2'>"._DL_ADMIN."</option>\n";
$gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
while($gidinfo = $db->sql_fetchrow($gresult)) {
  $gidinfo['gid'] = $gidinfo['gid'] + 2;
  echo "<option value='".$gidinfo['gid']."'>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._UPDIRECTORY.":</td><td><input type='text' name='uploaddir' size='50' maxlength='255'><br />("._USEUPLOAD.")</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._DL_CANUPLOAD.":</td><td><select name='canupload'>\n";
echo "<option value='0'>"._DL_NO."</option>\n";
echo "<option value='1'>"._DL_YES."</option>\n";
echo "</select></td></tr>\n";
echo "<input type='hidden' name='op' value='CategoryAddSave'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDCATEGORY."'></td></tr>\n";
echo "</form>\n</table>\n";
CloseTable();
include_once("footer.php");

?>
