<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/
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

if(!defined('MODULE_FILE')) { header("Location: ../../index.php"); }
define('NUKESENTINEL_PUBLIC', true);
$module_name = basename(dirname(__FILE__));
require_once('mainfile.php');
$index = 1;
define('INDEX_FILE', TRUE);
$ab_config = abget_configs();
$checkrow = $db->sql_numrows($db->sql_query('SELECT * FROM `'.$prefix.'_nsnst_ip2country` LIMIT 0,1'));
if($checkrow > 0) { $tableexist = 1; } else { $tableexist = 0; }
if (!isset($op)) $op='';
if($op == 'STIP2C' AND $tableexist != 1) { $op = 'STIndex'; }
if(!$op) { $op = 'STIndex'; }
include_once('modules/'.$module_name.'/public/functions.php');
switch($op) {

  case 'STIndex':include_once('modules/'.$module_name.'/public/STIndex.php');break;
  case 'STIPS':include_once('modules/'.$module_name.'/public/STIPS.php');break;
  case 'STRanges':include_once('modules/'.$module_name.'/public/STRanges.php');break;
  case 'STReferers':include_once('modules/'.$module_name.'/public/STReferers.php');break;
  case 'STIP2C':include_once('modules/'.$module_name.'/public/STIP2C.php');break;

}

?>