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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

$module_name = "Work_Request";

switch($op) {

    case "WRIndex":
    case "WRMemberAdd":
    case "WRMemberDelete":
    case "WRMemberEdit":
    case "WRMemberInsert":
    case "WRMemberList":
    case "WRMemberRemove":
    case "WRMemberUpdate":
    case "WRProjectAdd":
    case "WRProjectDelete":
    case "WRProjectEdit":
    case "WRProjectInsert":
    case "WRProjectList":
    case "WRProjectRemove":
    case "WRProjectRequests":
    case "WRProjectUpdate":
    case "WRRequestCommentDelete":
    case "WRRequestCommentEdit":
    case "WRRequestCommentRemove":
    case "WRRequestCommentUpdate":
    case "WRRequestConfig":
    case "WRRequestConfigUpdate":
    case "WRRequestDelete":
    case "WRRequestEdit":
    case "WRRequestImport":
    case "WRRequestImportInsert":
    case "WRRequestList":
    case "WRRequestMembers":
    case "WRRequestPrint":
    case "WRRequestRemove":
    case "WRRequestStatusAdd":
    case "WRRequestStatusDelete":
    case "WRRequestStatusEdit":
    case "WRRequestStatusInsert":
    case "WRRequestStatusList":
    case "WRRequestStatusRemove":
    case "WRRequestStatusUpdate":
    case "WRRequestTypeAdd":
    case "WRRequestTypeDelete":
    case "WRRequestTypeEdit":
    case "WRRequestTypeInsert":
    case "WRRequestTypeList":
    case "WRRequestTypeRemove":
    case "WRRequestTypeUpdate":
    case "WRRequestUpdate":
    include_once("modules/$module_name/admin/index.php");
    break;

}

?>