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
if(!empty($xblocker_row['list'])) {
  if(!empty($xblocker_row['listadd'])) {
    $xblocker_row['list'] = $xblocker_row['list']."\r\n".$xblocker_row['listadd'];
  } else {
    $xblocker_row['list'] = $xblocker_row['list'];
  }
} else {
  $xblocker_row['list'] = $xblocker_row['listadd'];
}
$xblocker_row['list'] = str_replace("<br>", "\r\n", $xblocker_row['list']);
$xblocker_row['list'] = str_replace("<br />", "\r\n", $xblocker_row['list']);
$block_list = explode("\r\n", $xblocker_row['list']);
rsort($block_list);
$endlist = count($block_list)-1;
if(empty($block_list[$endlist])) { array_pop($block_list); }
sort($block_list);
$xblocker_row['list'] = implode("\r\n", $block_list);
$xblocker_row['list'] = str_replace("\r\n\r\n", "\r\n", $xblocker_row['list']);
$xblocker_row['duration'] = $xblocker_row['duration'] * 86400;
$db->sql_query("UPDATE `".$prefix."_nsnst_blockers` SET `activate`='".$xblocker_row['activate']."', `block_type`='".$xblocker_row['block_type']."', `email_lookup`='".$xblocker_row['email_lookup']."', `forward`='".$xblocker_row['forward']."', `reason`='".$xblocker_row['reason']."', `template`='".$xblocker_row['template']."', `duration`='".$xblocker_row['duration']."', `htaccess`='".$xblocker_row['htaccess']."', `list`='".$xblocker_row['list']."' WHERE `block_name`='".$xblocker_row['block_name']."'");
header("Location: ".$admin_file.".php?op=$xop");

?>