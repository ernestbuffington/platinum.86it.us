<?php

/********************************************************/
/* NSN Work Board                                       */
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

$project_name = htmlentities($project_name);
$project_description = htmlentities($project_description);
$priority_id = intval($priority_id);
$status_id = intval($status_id);
$project_percent = intval($project_percent);
$featured = intval($featured);
$project_id = intval($project_id);
$start_date = "$project_start_year-$project_start_month-$project_start_day";
if ($start_date == "0000-00-00") { $start_date = 0; } else { $start_date = strtotime($start_date); }
$finish_date = "$project_finish_year-$project_finish_month-$project_finish_day";
if ($finish_date == "0000-00-00") { $finish_date = 0; } else { $finish_date = strtotime($finish_date); }
$db->sql_query("UPDATE ".$prefix."_nsnwb_projects SET project_name='$project_name', project_description='$project_description', priority_id='$priority_id', status_id='$status_id', project_percent='$project_percent', featured='$featured', date_started='$start_date', date_finished='$finish_date' WHERE project_id='$project_id'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnwb_projects");
while(list($null, $member_id) = each($member_ids)) {
        $db->sql_query("INSERT INTO ".$prefix."_nsnwb_projects_members VALUES ('$project_id', '$member_id', '0')");        
}
header("Location: ".$admin_file.".php?op=WBProjectList&project_id=$project_id");

?>