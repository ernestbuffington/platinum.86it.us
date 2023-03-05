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

switch($op) {

    case "WPIndex":
    case "WPMemberAdd":
    case "WPMemberDelete":
    case "WPMemberEdit":
    case "WPMemberInsert":
    case "WPMemberList":
    case "WPMemberRemove":
    case "WPMemberUpdate":
    case "WPProjectAdd":
    case "WPProjectDelete":
    case "WPProjectEdit":
    case "WPProjectInsert":
    case "WPProjectList":
    case "WPProjectRemove":
    case "WPProjectReports":
    case "WPProjectUpdate":
    case "WPReportCommentDelete":
    case "WPReportCommentEdit":
    case "WPReportCommentRemove":
    case "WPReportCommentUpdate":
    case "WPReportConfig":
    case "WPReportConfigUpdate":
    case "WPReportDelete":
    case "WPReportEdit":
    case "WPReportImport":
    case "WPReportImportInsert":
    case "WPReportList":
    case "WPReportMembers":
    case "WPReportPrint":
    case "WPReportRemove":
    case "WPReportStatusAdd":
    case "WPReportStatusDelete":
    case "WPReportStatusEdit":
    case "WPReportStatusInsert":
    case "WPReportStatusList":
    case "WPReportStatusRemove":
    case "WPReportStatusUpdate":
    case "WPReportTypeAdd":
    case "WPReportTypeDelete":
    case "WPReportTypeEdit":
    case "WPReportTypeInsert":
    case "WPReportTypeList":
    case "WPReportTypeRemove":
    case "WPReportTypeUpdate":
    case "WPReportUpdate":
    include_once("modules/$module_name/admin/index.php");
    break;
}

?>