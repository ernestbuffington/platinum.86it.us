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
$pagetitle = ": "._SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_DELETESITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("select `site_name`, `site_url` from `".$prefix."_nsnsp_sites` where `site_id`='$site_id'");
list($site_name, $site_url) = $db->sql_fetchrow($result);
include_once("header.php");
title(_SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_DELETESITE);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center>"._SP_YOUDELETE." <a href='$site_url' target='blank'><strong>$site_name</strong></a><br /><br />";
echo ""._SP_SURE2DELETE."<br /><br /></center>";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php?op=SPDeleteConfirm' method='post'>\n";
echo "<input type='hidden' name='site_id' value='$site_id'>\n";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<td align='center'><input type='submit' value=' "._YES." '><br />\n";
echo ""._GOBACK."</td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
CloseTable();
include_once("footer.php");

?>