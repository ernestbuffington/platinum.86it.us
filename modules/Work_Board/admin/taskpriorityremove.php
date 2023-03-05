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
$priority = wbtaskpriority_info($priority_id);
wbadmin_menu();
echo "<br />\n";
title(_WB_DELETETASKPRIORITY);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WBTaskPriorityDelete'>\n";
echo "<input type='hidden' name='priority_id' value='$priority_id'>\n";
echo "<tr><td align='center'><strong>"._WB_SWAPTASKPRIORITY."</strong></td></tr>\n";
echo "<tr><td align='center'>".$priority['priority_name']." -> <select name='swap_priority_id'>\n";
echo "<option value='0'>---------</option>\n";
$prioritylist = $db->sql_query("select priority_id, priority_name from ".$prefix."_nsnwb_tasks_priorities where priority_id != '$priority_id' order by priority_weight");
while(list($s_priority_id, $s_priority_name) = $db->sql_fetchrow($prioritylist)){
    echo "<option value='$s_priority_id'>$s_priority_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._WB_DELETETASKPRIORITY."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include_once("footer.php");

?>