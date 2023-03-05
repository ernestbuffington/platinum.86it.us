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

$bid = intval($bid);
$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_ADMIN." ".$ml_config['version_number']);
ML_Admin();
echo "<br>\n";
OpenTable();
$text = stripslashes($text);
$htmltext = stripslashes($htmltext);
if ($bid != 0) {
  $query = "SELECT bid, imageurl, clickurl FROM ".$prefix."_banner WHERE bid='$bid'";
  $result = $db->sql_query($query);
  list($bid, $imageurl, $clickurl) = $db->sql_fetchrow($result);
}
$text = $text."\n\n"._ML_BANNERTEXT."\n$clickurl";
$htmltext = $htmltext."<a href='$clickurl'><img src='$imageurl'><br>\n";
if ($seperator == '1') {
  $text = $text._ML_TEXTSEPERATOR;
  $htmltext = $htmltext._ML_HTMLSEPERATOR;
}
echo "<center><strong>"._ML_BANNERADDED."</strong></center><br>\n";
echo "<form action='".$admin_file.".php?op=MLAddIssue' method='POST'>\n";
echo "<input type='hidden' name='sub' value='".htmlspecialchars($sub, ENT_QUOTES)."'>\n";
echo "<input type='hidden' name='text' value='".htmlspecialchars($text, ENT_QUOTES)."'>\n";
echo "<input type='hidden' name='htmltext' value='".htmlspecialchars($htmltext, ENT_QUOTES)."'>\n";
echo "<center><input type='submit' value='"._ML_RESUME."'></center>\n";
echo "</form>\n";
CloseTable();
@include_once("footer.php");

?>