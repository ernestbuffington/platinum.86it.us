<?php
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
if(!defined('MODULE_FILE')) {
  header("Location: ../../index.php");
  die();
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));

require_once("modules/$module_name/includes/functions.php");
get_lang($module_name);
$index = 1;
global $admin_file;
$wb_config = wbget_configs();
$pagetitle = ": "._WB_TITLE." ".$wb_config['version_number'];

switch($op) {

    default:include_once("modules/$module_name/public/projectall.php");break;
    case "WBTaskMap":include_once("modules/$module_name/public/taskmap.php");break;
    case "WBViewProject":include_once("modules/$module_name/public/project.php");break;
    case "WBViewTask":include_once("modules/$module_name/public/task.php");break;
    case "WBViewTaskList":include_once("modules/$module_name/public/taskall.php");break;

}

?>
