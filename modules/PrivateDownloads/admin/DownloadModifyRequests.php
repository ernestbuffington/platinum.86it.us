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

$pagetitle = _DOWNLOADSADMIN.": "._DUSERMODREQUEST;
include_once("header.php");
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_mods WHERE brokendownload='0' ORDER BY rid");
$totalmods = $db->sql_numrows($result);
title("$pagetitle ($totalmods)");
dladminmain();
echo "<br />\n";
OpenTable();
echo "<table width='95%' align='center'><tr><td>";
if ($totalmods != 0) {
  while($ridinfo = $db->sql_fetchrow($result)) {
    $lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid='".$ridinfo['lid']."'"));
    list($cidtitle) = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='".$ridinfo['cid']."'"));
    list($origcidtitle) = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='".$lidinfo['cid']."'"));
    list($memail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$ridinfo['modifier']."'"));
    list($oemail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$lidinfo['submitter']."'"));
    $ridinfo['title'] = stripslashes($ridinfo['title']);
    $ridinfo['description'] = stripslashes($ridinfo['description']);
    if ($lidinfo['submitter'] == "") { $lidinfo['submitter'] = "administration"; }
    if ($cidtitle=="") { $cidtitle= _DL_NONE; }
    if ($origcidtitle=="") { $origcidtitle= _DL_NONE; }
    echo "<table border='1' bordercolor='$textcolor1' cellpadding='5' cellspacing='0' align='center' width='100%'>\n";
    echo "<tr><td><table width='100%'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor2' class='title' colspan='2'>"._ORIGINAL."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' width='15%'>"._TITLE.":</td><td width='85%'>".$lidinfo['title']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><a href='".$lidinfo['url']."' target='new'>".$lidinfo['url']."</a></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td>$origcidtitle</td></tr>\n";
    if ($ridinfo['sid'] == 0) {
      $who_view = _DL_ALL;
    } elseif ($ridinfo['sid'] == 1) {
      $who_view = _DL_USERS;
    } elseif ($ridinfo['sid'] == 2) {
      $who_view = _DL_ADMIN;
    } elseif ($ridinfo['sid'] >2) {
      $newView = $ridinfo['sid'] - 2;
      list($who_view) = $db->sql_fetchrow($db->sql_query("SELECT gname FROM ".$prefix."_nsngr_groups WHERE gid=$newView"));
      $who_view = $who_view." "._DL_ONLY;
    }
    echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td>$who_view</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td>".$lidinfo['name']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td>".$lidinfo['email']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td>".number_format($lidinfo['filesize'])." "._BYTES."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td>".$lidinfo['version']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><a href='".$lidinfo['homepage']."' target='new'>".$lidinfo['homepage']."</a></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td>".$lidinfo['description']."</td></tr>\n";
    echo "</table></td></tr>\n";
    echo "<tr><td><table width='100%'>\n";
    echo "<tr><td align='center' bgcolor='$bgcolor2' class='title' colspan='2'>"._PURPOSED."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' width='15%'>"._TITLE.":</td><td width='85%'>".$ridinfo['title']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><a href='".$ridinfo['url']."' target='new'>".$ridinfo['url']."</a></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td>$cidtitle</td></tr>\n";
    if ($lidinfo['sid'] == 0) {
      $who_view = _DL_ALL;
    } elseif ($lidinfo['sid'] == 1) {
      $who_view = _DL_USERS;
    } elseif ($lidinfo['sid'] == 2) {
      $who_view = _DL_ADMIN;
    } elseif ($lidinfo['sid'] >2) {
      $newView = $lidinfo['sid'] - 2;
      list($who_view) = $db->sql_fetchrow($db->sql_query("SELECT gname FROM ".$prefix."_nsngr_groups WHERE gid=$newView"));
      $who_view = $who_view." "._DL_ONLY;
    }
    echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td>$who_view</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td>".$ridinfo['name']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td>".$ridinfo['email']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td>".number_format($ridinfo['filesize'])." "._BYTES."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td>".$ridinfo['version']."</td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><a href='".$ridinfo['homepage']."' target='new'>".$ridinfo['homepage']."</a></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td>".$ridinfo['description']."</td></tr>\n";
    echo "</table></td></tr>\n";
    echo "</table>\n";
    echo "<table align='center' width='100%'>\n";
    echo "<tr>";
    echo "<td align='left'>"._SUBMITTER.": ";
    if ($memail=="") { echo $ridinfo['modifier']; } else { echo "<a href='mailto:$memail'>".$ridinfo['modifier']."</a>"; }
    echo "</td>\n";
    echo "<td align='center'>( <a href='".$admin_file.".php?op=DownloadModifyRequestsAccept&amp;rid=".$ridinfo['rid']."'>"._ACCEPT."</a> / ";
    echo "<a href='".$admin_file.".php?op=DownloadModifyRequestsIgnore&amp;rid=".$ridinfo['rid']."'>"._IGNORE."</a> )</td>\n";
    echo "<td align='right'>"._OWNER.": ";
    if ($oemail=="") { echo $lidinfo['submitter']; } else { echo "<a href='mailto:$oemail'>".$lidinfo['submitter']."</a>"; }
    echo "</td>\n";
    echo "</tr></table>\n<br />\n<br />\n";
  }
} else {
  echo "<center>"._NOMODREQUESTS."</center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
}
echo "</td></tr></table>\n";
CloseTable();
include_once("footer.php");

?>
