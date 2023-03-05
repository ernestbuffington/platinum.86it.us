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
global $admin_file;
$module_name = basename(dirname(__FILE__));
require_once("mainfile.php");
include_once("includes/nsnsp2_func.php");
$sp_config = spget_configs();
get_lang($module_name);
if(!isset($op)) { $op = "SP2Index"; }
$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='10' cols='75'"; }
$limitedext = array("gif", "jpg", "jpeg", "png");
switch ($op) {
  case "SP2Go":include_once("modules/$module_name/public/SP2Go.php");break;
  case "SP2Index":include_once("modules/$module_name/public/SP2Index.php");break;
  case "SP2Submit":include_once("modules/$module_name/public/SP2Submit.php");break;
  case "SP2SubmitSave":include_once("modules/$module_name/public/SP2SubmitSave.php");break;
}

?>