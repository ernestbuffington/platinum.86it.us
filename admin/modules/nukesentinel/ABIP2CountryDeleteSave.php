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
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi' LIMIT 0,1"));
list($xcountry) = $db->sql_fetchrow($db->sql_query("SELECT `country` FROM `".$prefix."_nsnst_countries` WHERE `c2c`='".$getIPs['c2c']."' LIMIT 0,1"));
$db->sql_query("DELETE FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`='$ip_lo' AND `ip_hi`='$ip_hi'");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_ip2country`");
$db->sql_query("UPDATE `".$prefix."_nsnst_tracked_ips` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
$db->sql_query("UPDATE `".$prefix."_nsnst_blocked_ips` SET `c2c`='00' WHERE `ip_long` >= '$ip_lo' AND `ip_long` <= '$ip_hi'");
$db->sql_query("UPDATE `".$prefix."_nsnst_blocked_ranges` SET `c2c`='00' WHERE `ip_lo` >= '$ip_lo' AND `ip_lo` <= '$ip_hi'");
header("Location: ".$admin_file.".php?op=$xop&min=$min&column=$column&direction=$direction&sip=$sip&showcountry=$showcountry");

?>