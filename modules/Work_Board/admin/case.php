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

$module_name = "Work_Board";

switch ($op) {

    case "WBIndex":
    case "WBMemberAdd":
    case "WBMemberDelete":
    case "WBMemberEdit":
    case "WBMemberInsert":
    case "WBMemberList":
    case "WBMemberPositionAdd":
    case "WBMemberPositionDelete":
    case "WBMemberPositionEdit":
    case "WBMemberPositionInsert":
    case "WBMemberPositionList":
    case "WBMemberPositionRemove":
    case "WBMemberPositionUpdate":
    case "WBMemberRemove":
    case "WBMemberUpdate":
    case "WBProjectAdd":
    case "WBProjectConfig":
    case "WBProjectConfigUpdate":
    case "WBProjectDelete":
    case "WBProjectEdit":
    case "WBProjectInsert":
    case "WBProjectList":
    case "WBProjectMembers":
    case "WBProjectOrder":
    case "WBProjectPriorityAdd":
    case "WBProjectPriorityDelete":
    case "WBProjectPriorityEdit":
    case "WBProjectPriorityInsert":
    case "WBProjectPriorityList":
    case "WBProjectPriorityRemove":
    case "WBProjectPriorityUpdate":
    case "WBProjectRemove":
    case "WBProjectStatusAdd":
    case "WBProjectStatusDelete":
    case "WBProjectStatusEdit":
    case "WBProjectStatusInsert":
    case "WBProjectStatusList":
    case "WBProjectStatusRemove":
    case "WBProjectStatusUpdate":
    case "WBProjectTasks":
    case "WBProjectUpdate":
    case "WBTaskAdd":
    case "WBTaskConfig":
    case "WBTaskConfigUpdate":
    case "WBTaskDelete":
    case "WBTaskEdit":
    case "WBTaskInsert":
    case "WBTaskList":
    case "WBTaskMembers":
    case "WBTaskPriorityAdd":
    case "WBTaskPriorityDelete":
    case "WBTaskPriorityEdit":
    case "WBTaskPriorityInsert":
    case "WBTaskPriorityList":
    case "WBTaskPriorityRemove":
    case "WBTaskPriorityUpdate":
    case "WBTaskRemove":
    case "WBTaskStatusAdd":
    case "WBTaskStatusDelete":
    case "WBTaskStatusEdit":
    case "WBTaskStatusInsert":
    case "WBTaskStatusList":
    case "WBTaskStatusRemove":
    case "WBTaskStatusUpdate":
    case "WBTaskUpdate":
    @include_once("modules/$module_name/admin/index.php");
    break;

}

?>