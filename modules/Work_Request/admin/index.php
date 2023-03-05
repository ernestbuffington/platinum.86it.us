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

require_once("mainfile.php");
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

include_once("modules/$module_name/includes/functions.php");
$wr_config = wrget_configs();
$pagetitle = ": "._WR_ADMINMENU." ".$wr_config['version_number'];
switch($op) {

    case "WRIndex":include_once("modules/$module_name/admin/indexwr.php");break;
    case "WRMemberAdd":include_once("modules/$module_name/admin/memberadd.php");break;
    case "WRMemberDelete":include_once("modules/$module_name/admin/memberdelete.php");break;
    case "WRMemberEdit":include_once("modules/$module_name/admin/memberedit.php");break;
    case "WRMemberInsert":include_once("modules/$module_name/admin/memberinsert.php");break;
    case "WRMemberList":include_once("modules/$module_name/admin/memberlist.php");break;
    case "WRMemberRemove":include_once("modules/$module_name/admin/memberremove.php");break;
    case "WRMemberUpdate":include_once("modules/$module_name/admin/memberupdate.php");break;
    case "WRProjectAdd":include_once("modules/$module_name/admin/projectadd.php");break;
    case "WRProjectDelete":include_once("modules/$module_name/admin/projectdelete.php");break;
    case "WRProjectEdit":include_once("modules/$module_name/admin/projectedit.php");break;
    case "WRProjectInsert":include_once("modules/$module_name/admin/projectinsert.php");break;
    case "WRProjectList":include_once("modules/$module_name/admin/projectlist.php");break;
    case "WRProjectRemove":include_once("modules/$module_name/admin/projectremove.php");break;
    case "WRProjectRequests":include_once("modules/$module_name/admin/projectrequests.php");break;
    case "WRProjectUpdate":include_once("modules/$module_name/admin/projectupdate.php");break;
    case "WRRequestCommentDelete":include_once("modules/$module_name/admin/requestcommentdelete.php");break;
    case "WRRequestCommentEdit":include_once("modules/$module_name/admin/requestcommentedit.php");break;
    case "WRRequestCommentRemove":include_once("modules/$module_name/admin/requestcommentremove.php");break;
    case "WRRequestCommentUpdate":include_once("modules/$module_name/admin/requestcommentupdate.php");break;
    case "WRRequestConfig":include_once("modules/$module_name/admin/requestconfig.php");break;
    case "WRRequestConfigUpdate":include_once("modules/$module_name/admin/requestconfigupdate.php");break;
    case "WRRequestDelete":include_once("modules/$module_name/admin/requestdelete.php");break;
    case "WRRequestEdit":include_once("modules/$module_name/admin/requestedit.php");break;
    case "WRRequestImport":include_once("modules/$module_name/admin/requestimport.php");break;
    case "WRRequestImportInsert":include_once("modules/$module_name/admin/requestimportinsert.php");break;
    case "WRRequestList":include_once("modules/$module_name/admin/requestlist.php");break;
    case "WRRequestMembers":include_once("modules/$module_name/admin/requestmembers.php");break;
    case "WRRequestPrint":include_once("modules/$module_name/admin/requestprint.php");break;
    case "WRRequestRemove":include_once("modules/$module_name/admin/requestremove.php");break;
    case "WRRequestStatusAdd":include_once("modules/$module_name/admin/requeststatusadd.php");break;
    case "WRRequestStatusDelete":include_once("modules/$module_name/admin/requeststatusdelete.php");break;
    case "WRRequestStatusEdit":include_once("modules/$module_name/admin/requeststatusedit.php");break;
    case "WRRequestStatusInsert":include_once("modules/$module_name/admin/requeststatusinsert.php");break;
    case "WRRequestStatusList":include_once("modules/$module_name/admin/requeststatuslist.php");break;
    case "WRRequestStatusRemove":include_once("modules/$module_name/admin/requeststatusremove.php");break;
    case "WRRequestStatusUpdate":include_once("modules/$module_name/admin/requeststatusupdate.php");break;
    case "WRRequestTypeAdd":include_once("modules/$module_name/admin/requesttypeadd.php");break;
    case "WRRequestTypeDelete":include_once("modules/$module_name/admin/requesttypedelete.php");break;
    case "WRRequestTypeEdit":include_once("modules/$module_name/admin/requesttypeedit.php");break;
    case "WRRequestTypeInsert":include_once("modules/$module_name/admin/requesttypeinsert.php");break;
    case "WRRequestTypeList":include_once("modules/$module_name/admin/requesttypelist.php");break;
    case "WRRequestTypeRemove":include_once("modules/$module_name/admin/requesttyperemove.php");break;
    case "WRRequestTypeUpdate":include_once("modules/$module_name/admin/requesttypeupdate.php");break;
    case "WRRequestUpdate":include_once("modules/$module_name/admin/requestupdate.php");break;
}

} else {
    echo "You can not access this section";
}

?>