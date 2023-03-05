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
$expiretime = time();
$clearresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ranges` WHERE (`expires`<'$expiretime' AND `expires`!='0')");
while($clearblock = $db->sql_fetchrow($clearresult)) {
  $old_masscidr = ABGetCIDRs($clearblock['ip_lo'], $clearblock['ip_hi']);
  if($ab_config['htaccess_path'] != "") {
    $old_masscidr = explode("||", $old_masscidr);
    for($i=0; $i < sizeof($old_masscidr); $i++) {
      if($old_masscidr[$i]!="") {
        $old_masscidr[$i] = "deny from ".$old_masscidr[$i]."\n";
      }
    }
    $ipfile = file($ab_config['htaccess_path']);
    $ipfile = implode("", $ipfile);
    $ipfile = str_replace($old_masscidr, "", $ipfile);
    $ipfile = $ipfile;
    $doit = fopen($ab_config['htaccess_path'], "w");
    fwrite($doit, $ipfile);
    fclose($doit);
  }
  $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ranges` WHERE `ip_lo`='".$clearblock['ip_lo']."' AND `ip_hi`='".$clearblock['ip_hi']."'");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ranges`");
}
header("Location: ".$admin_file.".php?op=ABBlockedRange");

?>