<?php

/********************************************************/
/* NukeSupporters(tm)                                   */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
/********************************************************/
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

$site_id = intval($site_id);
$pagetitle = ": "._SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_EDITSITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("select * from `".$prefix."_nsnsp_sites` where `site_id`='$site_id'");
$site_row = $db->sql_fetchrow($result);
include_once("header.php");
title(_SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_EDITSITE);
spmenu();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form action='".$admin_file.".php?op=SPEditSave' method='post' enctype='multipart/form-data'>";
echo "<input type='hidden' name='site_id' value='".$site_row['site_id']."'>";
echo "<input type='hidden' name='old_image' value='".$site_row['site_image']."'>";
echo "<input type='hidden' name='user_id' value='".$site_row['user_id']."'>";
echo "<tr><td><strong>"._SP_SITEID.":</strong></td><td><strong>".$site_row['site_id']."</strong></tr></td>";
echo "<tr><td><strong>"._SP_NAME.":</strong></td><td><input type='text' name='site_name' size='30' value='".$site_row['site_name']."'></tr></td>";
echo "<tr><td><strong>"._SP_URL.":</strong></td><td><input type='text' name='site_url' size='60' value='".$site_row['site_url']."'></tr></td>";
echo "<tr><td valign='top'><strong>"._SP_IMAGE.":</strong></td><td><input type='file' name='new_image' size='30'><br />".$site_row['site_image']."</tr></td>";
echo "<tr><td><strong>"._SP_ADDED.":</strong></td><td><input type='text' name='site_date' size='30' value='".$site_row['site_date']."'></tr></td>";
echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'>".$site_row['site_description']."</textarea></tr></td>";
echo "<tr><td><strong>"._SP_USERNAME.":</strong></td><td><input type='text' name='user_name' size='30' value='".$site_row['user_name']."'></tr></td>";
echo "<tr><td><strong>"._SP_USEREMAIL.":</strong></td><td><input type='text' name='user_email' size='30' value='".$site_row['user_email']."'></tr></td>";
echo "<tr><td><strong>"._SP_USERIP."</strong></td><td>".$site_row['user_ip']."</tr></td>";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._EDIT."'></td></tr>";
echo "</form></table>";
CloseTable();
include_once("footer.php");

?>