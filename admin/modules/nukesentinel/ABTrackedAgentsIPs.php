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
$pagetitle = _AB_NUKESENTINEL.": "._AB_AGENTIPTRACKING;
include_once("header.php");
OpenTable();
OpenMenu(_AB_AGENTIPTRACKING);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
//$perpage = $ab_config['track_perpage'];
if($perpage == 0) { $perpage = 25; }
if(!isset($min)) $min=0;
if(!isset($max)) $max=$min+$perpage;
$tid=intval($tid);
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `user_agent` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$totalselected = $db->sql_numrows($db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname'"));
if($totalselected > 0) {
  echo '<center><strong>'.$uname.'</strong></center><br />'."\n";
  echo '<table summary="" align="center" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" border="0">'."\n";
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td nowrap="nowrap" width="40%"><strong>'._AB_IPADDRESSES.'</strong></td>'."\n";
  echo '<td align="center" width="30%"><strong>'._AB_DATE.'</strong></td>'."\n";
  echo '<td align="center" width="30%"><strong>'._AB_COUNTRY.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $result = $db->sql_query("SELECT DISTINCT(`ip_addr`) FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname' ORDER BY `ip_long` LIMIT $min, $perpage");
  while(list($lipaddr) = $db->sql_fetchrow($result)){
    $newrow = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname' AND `ip_addr`='$lipaddr' ORDER BY `date` DESC LIMIT 1"));
    $countrytitle = abget_countrytitle($newrow['c2c']);
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td><a href="'.$ab_config['lookup_link'].$lipaddr.'" target="_blank">'.$lipaddr.'</a></td>'."\n";
    echo '<td align="center" nowrap="nowrap">'.date("Y-m-d \@ H:i:s",$newrow['date']).'</td>'."\n";
    echo '<td align="center" nowrap="nowrap">'.$countrytitle['country'].'</td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  abadminpagenums($op, $totalselected, $perpage, $max, $column, $direction, "", "", $tid);
} else {
  echo '<center><strong>'._AB_NOIPS.'</strong></center>'."\n";
}
CloseTable();
include_once("footer.php");

?>