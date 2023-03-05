<?php

/********************************************************/
/* NSN Mailing List                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_CREATENEWISSUE);
ML_Admin();
echo "<br />\n";
$maxstories = 50;
$send = $adminmail;
if (strlen($sub) == 0) { $sub = _ML_TITLE; }
$text = stripslashes($text);
$htmltext = stripslashes($htmltext);
$num1 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_users"));
$num2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_lists"));
if($num1 && $num2) {
  OpenTable();
  echo "<table align='center' border='0'>\n";
  echo "<form action='".$admin_file.".php?op=MLSend' method='POST'>\n";
  echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_SUBJECT."</strong></td><td><input type='text' name='sub' value='".$sub."' size='50' maxlength='100'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_MAIN."</strong></td><td><select name ='lid'>\n";
  $result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_lists");
  while($list_info = $db->sql_fetchrow($result)) { echo "<option value='".$list_info['lid']."'>".$list_info['title']."</option>\n"; }
  echo "</select></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._ML_ENTERTEXTPLAIN."</strong></td><td><textarea name='text' rows='20' cols='60'>".$text."</textarea></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._ML_ENTERTEXTHTML."</strong></td><td><textarea name='htmltext' rows='20' cols='60'>".$htmltext."</textarea></td></tr>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ML_SEND."'></td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  CloseTable();
  $result = $db->sql_query("SELECT sid, title FROM ".$prefix."_stories ORDER BY sid DESC LIMIT $maxstories");
  $num = $db->sql_numrows($result);
  if($num) {
    echo "<br />";
    OpenTable();
    echo "<table align='center' border='0'>\n";
    echo "<form action='".$admin_file.".php?op=MLAddStory' method='POST'>\n";
    echo "<input type='hidden' name='sub' value='".htmlspecialchars($sub, ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='text' value='".htmlspecialchars($text, ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='htmltext' value='".htmlspecialchars($htmltext, ENT_QUOTES)."'>\n";
    echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_ADDSTORY."</strong></td><td><select name ='sid'>\n";
    while (list ($sid, $title) = $db->sql_fetchrow($result)) { echo "<option value='$sid'>$title</option>\n"; }
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_ADDAS."</strong></td><td><select name ='sidtype'>\n";
    echo "<option value='1'>"._ML_TITLELINK."</option>\n";
    echo "<option value='2'>"._ML_HOMELINK."</option>\n";
    echo "<option value='3'>"._ML_FULLTEXT."</option>\n";
    echo "</select></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_ADDSEPERATOR."</strong></td><td><input type='checkbox' name='seperator' value='1' checked='checked'></td></tr>\n";
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ML_ADD."'></td></tr>\n";
    echo "</form>";
    echo "</table>\n";
    CloseTable();
  }
  $result = $db->sql_query("SELECT bid, imageurl FROM ".$prefix."_banner");
  $num = $db->sql_numrows($result);
  if($num) {
    echo "<br />\n";
    OpenTable();
    echo "<table align='center' border='0'>\n";
    echo "<form action='".$admin_file.".php?op=MLAddBanner' method='POST'>\n";
    echo "<input type='hidden' name='sub' value='".htmlspecialchars($sub, ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='text' value='".htmlspecialchars($text, ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='htmltext' value='".htmlspecialchars($htmltext, ENT_QUOTES)."'>\n";
    echo "<tr><td bgcolor='$bgcolor2' valign='top'><strong>"._ML_ADDBANNER."</strong></td><td>";
    while (list ($bid, $imageurl) = $db->sql_fetchrow($result)) {
      if (strlen($imageurl) > 0) {
        echo("<input type='radio' name='bid' value='$bid'> <img src='$imageurl' width='200' height='40'><br />\n");
      }
    }
    echo "</td></tr>";
    echo "<tr><td bgcolor='$bgcolor2'><strong>"._ML_ADDSEPERATOR."</strong></td><td><input type='checkbox' name='seperator' value='1' checked='checked'></td></tr>\n";
    echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ML_ADD."'></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    CloseTable();
  }
} else {
  OpenTable();
  if(!$num1) { echo "<center><strong>"._ML_NOSUBSCRIBERS."</strong></center><br />\n"; }
  if(!$num2) { echo "<center><strong>"._ML_NOLISTS."</strong></center><br />\n"; }
  echo "<center>"._GOBACK."</center>";
  CloseTable();
}
@include_once("footer.php");

?>