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
title(_WB_DELETEPOSITION);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBMemberPositionDelete'>\n";
echo "<input type='hidden' name='position_id' value='$position_id'>";
echo "<tr><td align='center'><strong>"._WB_SWAPPOSITION."</strong></td></tr>\n";
echo "<tr><td align='center'>".$position['position_name']." -> <select name='swap_position_id'>\n";
echo "<option value='0'>---------</option>\n";
$positionlist = $db->sql_query("select position_id, position_name from ".$prefix."_nsnwb_members_positions where position_id != '$position_id' order by position_name");
while(list($s_position_id, $s_position_name) = $db->sql_fetchrow($positionlist)){
    echo "<option value='$s_position_id'>$s_position_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._WB_DELETEPOSITION."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>