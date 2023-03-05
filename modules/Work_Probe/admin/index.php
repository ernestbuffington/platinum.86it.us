<?php

/********************************************************/
/* NSN Work Probe                                       */
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

$module_name = "Work_Probe";

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
$wp_config = wpget_configs();
$pagetitle = ": "._WP_ADMINMENU." ".$wp_config['version_number'];
switch($op) {

    case "WPIndex":include_once("modules/$module_name/admin/indexwp.php");break;
    case "WPMemberAdd":include_once("modules/$module_name/admin/memberadd.php");break;
    case "WPMemberDelete":include_once("modules/$module_name/admin/memberdelete.php");break;
    case "WPMemberEdit":include_once("modules/$module_name/admin/memberedit.php");break;
    case "WPMemberInsert":include_once("modules/$module_name/admin/memberinsert.php");break;
    case "WPMemberList":include_once("modules/$module_name/admin/memberlist.php");break;
    case "WPMemberRemove":include_once("modules/$module_name/admin/memberremove.php");break;
    case "WPMemberUpdate":include_once("modules/$module_name/admin/memberupdate.php");break;
    case "WPProjectAdd":include_once("modules/$module_name/admin/projectadd.php");break;
    case "WPProjectDelete":include_once("modules/$module_name/admin/projectdelete.php");break;
    case "WPProjectEdit":include_once("modules/$module_name/admin/projectedit.php");break;
    case "WPProjectInsert":include_once("modules/$module_name/admin/projectinsert.php");break;
    case "WPProjectList":include_once("modules/$module_name/admin/projectlist.php");break;
    case "WPProjectRemove":include_once("modules/$module_name/admin/projectremove.php");break;
    case "WPProjectReports":include_once("modules/$module_name/admin/projectreports.php");break;
    case "WPProjectUpdate":include_once("modules/$module_name/admin/projectupdate.php");break;
    case "WPReportCommentDelete":include_once("modules/$module_name/admin/reportcommentdelete.php");break;
    case "WPReportCommentEdit":include_once("modules/$module_name/admin/reportcommentedit.php");break;
    case "WPReportCommentRemove":include_once("modules/$module_name/admin/reportcommentremove.php");break;
    case "WPReportCommentUpdate":include_once("modules/$module_name/admin/reportcommentupdate.php");break;
    case "WPReportConfig":include_once("modules/$module_name/admin/reportconfig.php");break;
    case "WPReportConfigUpdate":include_once("modules/$module_name/admin/reportconfigupdate.php");break;
    case "WPReportDelete":include_once("modules/$module_name/admin/reportdelete.php");break;
    case "WPReportEdit":include_once("modules/$module_name/admin/reportedit.php");break;
    case "WPReportImport":include_once("modules/$module_name/admin/reportimport.php");break;
    case "WPReportImportInsert":include_once("modules/$module_name/admin/reportimportinsert.php");break;
    case "WPReportList":include_once("modules/$module_name/admin/reportlist.php");break;
    case "WPReportMembers":include_once("modules/$module_name/admin/reportmembers.php");break;
    case "WPReportPrint":include_once("modules/$module_name/admin/reportprint.php");break;
    case "WPReportRemove":include_once("modules/$module_name/admin/reportremove.php");break;
    case "WPReportStatusAdd":include_once("modules/$module_name/admin/reportstatusadd.php");break;
    case "WPReportStatusDelete":include_once("modules/$module_name/admin/reportstatusdelete.php");break;
    case "WPReportStatusEdit":include_once("modules/$module_name/admin/reportstatusedit.php");break;
    case "WPReportStatusInsert":include_once("modules/$module_name/admin/reportstatusinsert.php");break;
    case "WPReportStatusList":include_once("modules/$module_name/admin/reportstatuslist.php");break;
    case "WPReportStatusRemove":include_once("modules/$module_name/admin/reportstatusremove.php");break;
    case "WPReportStatusUpdate":include_once("modules/$module_name/admin/reportstatusupdate.php");break;
    case "WPReportTypeAdd":include_once("modules/$module_name/admin/reporttypeadd.php");break;
    case "WPReportTypeDelete":include_once("modules/$module_name/admin/reporttypedelete.php");break;
    case "WPReportTypeEdit":include_once("modules/$module_name/admin/reporttypeedit.php");break;
    case "WPReportTypeInsert":include_once("modules/$module_name/admin/reporttypeinsert.php");break;
    case "WPReportTypeList":include_once("modules/$module_name/admin/reporttypelist.php");break;
    case "WPReportTypeRemove":include_once("modules/$module_name/admin/reporttyperemove.php");break;
    case "WPReportTypeUpdate":include_once("modules/$module_name/admin/reporttypeupdate.php");break;
    case "WPReportUpdate":include_once("modules/$module_name/admin/reportupdate.php");break;
}

} else {
    echo "You can not access this section";
}

?>