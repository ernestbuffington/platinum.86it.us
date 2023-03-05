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

error_reporting(E_ALL^E_NOTICE);
@ini_set('display_errors', 0);
chdir("../");
@require_once("mainfile.php");
$nuke_config = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_config` LIMIT 0,1"));
$a_aid = $a_pas = "";
$tid = intval($tid);
if(isset($_COOKIE['admin']) && !empty($_COOKIE['admin'])) {
  $abadmin = st_clean_string(base64_decode($_COOKIE['admin']));
  if (preg_match(REGEX_UNION, $abadmin)) { block_ip($blocker_array[1]); }
  if (preg_match(REGEX_UNION, base64_decode($abadmin))) { block_ip($blocker_array[1]); }
  $abadmin = explode(":", $abadmin);
  $a_aid = addslashes($abadmin[0]);
  $a_pas = addslashes($abadmin[1]);
}
$num = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_authors` WHERE `aid`='$a_aid' AND `pwd`='$a_pas' LIMIT 0,1"));
$tum = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
if($num > 0 AND $tum > 0) {
  $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
  $row['refered_from'] = html_entity_decode($row['refered_from'], ENT_QUOTES);
  header("Location: ".$row['refered_from']);
} else {
  header("Location: ".$nuke_config['nukeurl']);
}

?>