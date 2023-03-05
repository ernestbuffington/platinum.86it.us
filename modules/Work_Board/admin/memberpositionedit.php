<?php

/********************************************************/
/* NSN Work Board                                       */
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

@include_once("header.php");
$position = wbmemberposition_info($position_id);
wbadmin_menu();
echo "<br />\n";
title(_WB_EDITPOSITION);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBMemberPositionUpdate'>\n";
echo "<input type='hidden' name='position_id' value='$position_id'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WB_POSITIONNAME.":</td>\n";
echo "<td><input type='text' name='position_name' size='30' value=\"".$position['position_name']."\"></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WB_POSITIONDESCRIPTION.":</td>\n";
echo "<td><textarea name='position_description' cols='60' rows='10' wrap='virtual'>".$position['position_description']."</textarea></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WB_UPDATEPOSITION."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>