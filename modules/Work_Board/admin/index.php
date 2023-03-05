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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $admin_file;

$module_name = "Work_Board";

@require_once("mainfile.php");
get_lang($module_name);
$index=1;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='$module_name'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

@include_once("modules/$module_name/includes/functions.php");
$wb_config = wbget_configs();
$pagetitle = ": "._WB_ADMINMENU." ".$wb_config['version_number'];
switch ($op) {

    case "WBIndex":@include_once("modules/$module_name/admin/indexwb.php");break;
    case "WBMemberAdd":@include_once("modules/$module_name/admin/memberadd.php");break;
    case "WBMemberDelete":@include_once("modules/$module_name/admin/memberdelete.php");break;
    case "WBMemberEdit":@include_once("modules/$module_name/admin/memberedit.php");break;
    case "WBMemberInsert":@include_once("modules/$module_name/admin/memberinsert.php");break;
    case "WBMemberList":@include_once("modules/$module_name/admin/memberlist.php");break;
    case "WBMemberPositionAdd":@include_once("modules/$module_name/admin/memberpositionadd.php");break;
    case "WBMemberPositionDelete":@include_once("modules/$module_name/admin/memberpositiondelete.php");break;
    case "WBMemberPositionEdit":@include_once("modules/$module_name/admin/memberpositionedit.php");break;
    case "WBMemberPositionInsert":@include_once("modules/$module_name/admin/memberpositioninsert.php");break;
    case "WBMemberPositionList":@include_once("modules/$module_name/admin/memberpositionlist.php");break;
    case "WBMemberPositionRemove":@include_once("modules/$module_name/admin/memberpositionremove.php");break;
    case "WBMemberPositionUpdate":@include_once("modules/$module_name/admin/memberpositionupdate.php");break;
    case "WBMemberRemove":@include_once("modules/$module_name/admin/memberremove.php");break;
    case "WBMemberUpdate":@include_once("modules/$module_name/admin/memberupdate.php");break;
    case "WBProjectAdd":@include_once("modules/$module_name/admin/projectadd.php");break;
    case "WBProjectConfig":@include_once("modules/$module_name/admin/projectconfig.php");break;
    case "WBProjectConfigUpdate":@include_once("modules/$module_name/admin/projectconfigupdate.php");break;
    case "WBProjectDelete":@include_once("modules/$module_name/admin/projectdelete.php");break;
    case "WBProjectEdit":@include_once("modules/$module_name/admin/projectedit.php");break;
    case "WBProjectInsert":@include_once("modules/$module_name/admin/projectinsert.php");break;
    case "WBProjectList":@include_once("modules/$module_name/admin/projectlist.php");break;
    case "WBProjectMembers":@include_once("modules/$module_name/admin/projectmembers.php");break;
    case "WBProjectOrder":@include_once("modules/$module_name/admin/projectorder.php");break;
    case "WBProjectPriorityAdd":@include_once("modules/$module_name/admin/projectpriorityadd.php");break;
    case "WBProjectPriorityDelete":@include_once("modules/$module_name/admin/projectprioritydelete.php");break;
    case "WBProjectPriorityEdit":@include_once("modules/$module_name/admin/projectpriorityedit.php");break;
    case "WBProjectPriorityInsert":@include_once("modules/$module_name/admin/projectpriorityinsert.php");break;
    case "WBProjectPriorityList":@include_once("modules/$module_name/admin/projectprioritylist.php");break;
    case "WBProjectPriorityRemove":@include_once("modules/$module_name/admin/projectpriorityremove.php");break;
    case "WBProjectPriorityUpdate":@include_once("modules/$module_name/admin/projectpriorityupdate.php");break;
    case "WBProjectRemove":@include_once("modules/$module_name/admin/projectremove.php");break;
    case "WBProjectStatusAdd":@include_once("modules/$module_name/admin/projectstatusadd.php");break;
    case "WBProjectStatusDelete":@include_once("modules/$module_name/admin/projectstatusdelete.php");break;
    case "WBProjectStatusEdit":@include_once("modules/$module_name/admin/projectstatusedit.php");break;
    case "WBProjectStatusInsert":@include_once("modules/$module_name/admin/projectstatusinsert.php");break;
    case "WBProjectStatusList":@include_once("modules/$module_name/admin/projectstatuslist.php");break;
    case "WBProjectStatusRemove":@include_once("modules/$module_name/admin/projectstatusremove.php");break;
    case "WBProjectStatusUpdate":@include_once("modules/$module_name/admin/projectstatusupdate.php");break;
    case "WBProjectTasks":@include_once("modules/$module_name/admin/projecttasks.php");break;
    case "WBProjectUpdate":@include_once("modules/$module_name/admin/projectupdate.php");break;
    case "WBTaskAdd":@include_once("modules/$module_name/admin/taskadd.php");break;
    case "WBTaskConfig":@include_once("modules/$module_name/admin/taskconfig.php");break;
    case "WBTaskConfigUpdate":@include_once("modules/$module_name/admin/taskconfigupdate.php");break;
    case "WBTaskDelete":@include_once("modules/$module_name/admin/taskdelete.php");break;
    case "WBTaskEdit":@include_once("modules/$module_name/admin/taskedit.php");break;
    case "WBTaskInsert":@include_once("modules/$module_name/admin/taskinsert.php");break;
    case "WBTaskList":@include_once("modules/$module_name/admin/tasklist.php");break;
    case "WBTaskMembers":@include_once("modules/$module_name/admin/taskmembers.php");break;
    case "WBTaskPriorityAdd":@include_once("modules/$module_name/admin/taskpriorityadd.php");break;
    case "WBTaskPriorityDelete":@include_once("modules/$module_name/admin/taskprioritydelete.php");break;
    case "WBTaskPriorityEdit":@include_once("modules/$module_name/admin/taskpriorityedit.php");break;
    case "WBTaskPriorityInsert":@include_once("modules/$module_name/admin/taskpriorityinsert.php");break;
    case "WBTaskPriorityList":@include_once("modules/$module_name/admin/taskprioritylist.php");break;
    case "WBTaskPriorityRemove":@include_once("modules/$module_name/admin/taskpriorityremove.php");break;
    case "WBTaskPriorityUpdate":@include_once("modules/$module_name/admin/taskpriorityupdate.php");break;
    case "WBTaskRemove":@include_once("modules/$module_name/admin/taskremove.php");break;
    case "WBTaskStatusAdd":@include_once("modules/$module_name/admin/taskstatusadd.php");break;
    case "WBTaskStatusDelete":@include_once("modules/$module_name/admin/taskstatusdelete.php");break;
    case "WBTaskStatusEdit":@include_once("modules/$module_name/admin/taskstatusedit.php");break;
    case "WBTaskStatusInsert":@include_once("modules/$module_name/admin/taskstatusinsert.php");break;
    case "WBTaskStatusList":@include_once("modules/$module_name/admin/taskstatuslist.php");break;
    case "WBTaskStatusRemove":@include_once("modules/$module_name/admin/taskstatusremove.php");break;
    case "WBTaskStatusUpdate":@include_once("modules/$module_name/admin/taskstatusupdate.php");break;
    case "WBTaskUpdate":@include_once("modules/$module_name/admin/taskupdate.php");break;
}

} else {
    echo "You can not access this section";
}

?>