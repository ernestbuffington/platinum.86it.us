<?php

/********************************************************/
/* NSN Work Request                                     */
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

$date = time();
$task_name = htmlentities($task_name, ENT_QUOTES);
$task_description = htmlentities($task_description, ENT_QUOTES);
$start_date = "$task_start_year-$task_start_month-$task_start_day";
if($start_date == "0000-00-00") { $start_date = 0; } else { $start_date = strtotime($start_date); }
$finish_date = "$task_finish_year-$task_finish_month-$task_finish_day";
if($finish_date == "0000-00-00") { $finish_date = 0; } else { $finish_date = strtotime($finish_date); }
$db->sql_query("INSERT INTO ".$prefix."_nsnwb_tasks VALUES (NULL, '$project_id', '$task_name', '$task_description', '$priority_id', '$status_id', '$task_percent', '$date', '$start_date', '$finish_date')");
$taskresult = $db->sql_query("SELECT task_id FROM ".$prefix."_nsnwb_tasks WHERE date_created='$date'");
list($task_id) = $db->sql_fetchrow($taskresult);
while(list($null, $member_id) = each($member_ids)) {
    $db->sql_query("INSERT INTO ".$prefix."_nsnwb_tasks_members VALUES ('$task_id', '$member_id', '0')");	
}
header("Location: modules.php?name=$module_name&op=WRViewRequest&request_id=$request_id");

?>