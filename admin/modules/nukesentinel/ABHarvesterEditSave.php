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

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(!get_magic_quotes_runtime()) { $harvester = addslashes($harvester); }
$testnum1 = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_harvesters` WHERE `harvester`='".$harvester."' AND `hid`!='".$hid."'"));
if($testnum1 > 0) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITHARVESTERERROR;
  include_once("header.php");
  OpenTable();
  OpenMenu(_AB_EDITHARVESTERERROR);
  mastermenu();
  CarryMenu();
  harvestermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<center><strong>'._AB_HARVESTEREXISTS.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once("footer.php");
} elseif($harvester == "") {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITHARVESTERERROR;
  include_once("header.php");
  OpenTable();
  OpenMenu(_AB_EDITHARVESTERERROR);
  mastermenu();
  CarryMenu();
  harvestermenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<center><strong>'._AB_HARVESTEREMPTY.'</strong></center><br />'."\n";
  echo '<center><strong>'._GOBACK.'</strong></center><br />'."\n";
  CloseTable();
  include_once("footer.php");
} else {
  $getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_harvesters` WHERE `hid`='".$hid."' LIMIT 0,1"));
  $db->sql_query("UPDATE `".$prefix."_nsnst_harvesters` SET `harvester`='".$harvester."' WHERE `hid`='".$hid."'");
  $list_harvester = explode("\r\n", $ab_config['list_harvester']);
  $list_harvester = str_replace($getIPs['harvester'], $harvester, $list_harvester);
  rsort($list_harvester);
  $endlist = count($list_harvester)-1;
  if(empty($list_harvester[$endlist])) { array_pop($list_harvester); }
  sort($list_harvester);
  $list_harvester = implode("\r\n", $list_harvester);
  absave_config("list_harvester", $list_harvester);
  header("Location: ".$admin_file.".php?op=$xop&min=$min&direction=$direction");
}

?>