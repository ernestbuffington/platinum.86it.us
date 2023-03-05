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
$tid = intval($tid);
if(preg_match("/All.*Modules/", $showmodule) || !$showmodule ) {
  $modfilter="";
} elseif(preg_match("/Admin/", $showmodule)) {
  $modfilter="AND page LIKE '%".$admin_file.".php%'";
} elseif(preg_match("/Index/", $showmodule)) {
  $modfilter="AND page LIKE '%index.php%'";
} elseif(preg_match("/Backend/", $showmodule)) {
  $modfilter="AND page LIKE '%backend.php%'";
} else {
  $modfilter="AND page LIKE '%name=$showmodule%'";
}
$deleterow = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `ip_addr` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$db->sql_query("DELETE FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_id`='".$deleterow['user_id']."' AND `ip_addr`='".$deleterow['ip_addr']."' $modfilter");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_tracked_ips`");
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&showmodule=$showmodule&sip=$sip");

?>