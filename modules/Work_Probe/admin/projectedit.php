<?php

/********************************************************/
/* NSN Work Probe                                       */
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

include_once("header.php");
$project = wpproject_info($project_id);
wpadmin_menu();
echo "<br />\n";
title(_WP_PROJECTEDIT);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPProjectUpdate'>\n";
echo "<input type='hidden' name='project_id' value='$project_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_PROJECTNAME.":</td>\n";
echo "<td><input type='text' name='project_name' size='30' value=\"".$project['project_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_DESCRIPTION.":</td>\n";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'>".$project['project_description']."</textarea></td></tr>\n";
if($project['featured'] == 0) { $sel1 = " selected"; } else { $sel2 = " selected"; }
echo "<tr><td bgcolor='$bgcolor2'>"._WP_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0'$sel1>"._WP_NO."</option>\n";
echo "<option value='1'$sel2>"._WP_YES."</option></select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WP_PROJECTUPDATE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>