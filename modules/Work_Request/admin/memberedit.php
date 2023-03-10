<?php

/********************************************************/
/* NSN Work Request                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright ? 2000-2005 by NukeScripts Network         */
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
$memberresult = $db->sql_query("select member_name, member_email from ".$prefix."_nsnwb_members where member_id='$member_id'");
list($member_name, $member_email) = $db->sql_fetchrow($memberresult);
wradmin_menu();
echo "<br />\n";
title(_WR_MEMBEREDIT);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='WRMemberUpdate'>";
echo "<input type='hidden' name='member_id' value='$member_id'>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_MEMBERNAME.":</td>";
echo "<td><input type='text' name='member_name' size='30' value=\"$member_name\"></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_MEMBEREMAIL.":</td>";
echo "<td><input type='text' name='member_email' size='30' value=\"$member_email\"></td></tr>";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WR_MEMBERUPDATE."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
include_once("footer.php");

?>