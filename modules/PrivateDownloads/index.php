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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
@require_once("mainfile.php");
get_lang($module_name);
$pagetitle = _DOWNLOADS;
@include_once("modules/$module_name/includes/functions.php");
$result1 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_config");
$dl_config = gdget_configs();
if (!$dl_config OR $dl_config=="") {
    @include_once("header.php");
    title(_DL_DBCONFIG);
    @include_once("footer.php");
    die();
}
$index = 1;

if(isset($d_op)) { $op = $d_op; unset($d_op); }
if(op == "viewdownload") { $op = "getit"; }
if(op == "viewdownloaddetails") { $op = "getit"; }

switch($op) {

    default:
    case "index":@include_once("modules/$module_name/public/index.php");break;

    case "NewDownloads":@include_once("modules/$module_name/public/NewDownloads.php");break;
    case "NewDownloadsDate":@include_once("modules/$module_name/public/NewDownloadsDate.php");break;
    case "MostPopular":@include_once("modules/$module_name/public/MostPopular.php");break;
    case "brokendownload":@include_once("modules/$module_name/public/brokendownload.php");break;
    case "brokendownloadS":@include_once("modules/$module_name/public/brokendownloadS.php");break;
    case "modifydownloadrequest":@include_once("modules/$module_name/public/modifydownloadrequest.php");break;
    case "modifydownloadrequestS":@include_once("modules/$module_name/public/modifydownloadrequestS.php");break;
    case "getit":@include_once("modules/$module_name/public/getit.php");break;
    case "go":@include_once("modules/$module_name/public/go.php");break;
    case "search":@include_once("modules/$module_name/public/search.php");break;
    case "gfx":@include_once("modules/$module_name/public/gfx.php");break;

}

?>
