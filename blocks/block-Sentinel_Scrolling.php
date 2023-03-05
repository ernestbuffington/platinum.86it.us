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
if(!defined('NUKE_FILE') && !defined('BLOCK_FILE')) { header("Location: ../index.php"); }
global $prefix, $db, $user, $admin, $ab_config, $nsnst_const;
$usemarquee = 1;
$scrolldirection = 'Down';
$content = '';
$content .= '<script type="text/javascript" src="includes/javascript/nukesentinel/nukesentinel4.js"></script>'."\n";
$content .= '<script type="text/javascript" src="includes/javascript/nukesentinel/nukesentinel5.js"></script>'."\n";
$content .= '<center>'._AB_LISTBANNEDIPS.'</center><hr />'."\n";
$content .= '<center><div style="width:150px; overflow:hidden; height:150px; position:relative;" class="Fsp.Scroller.Delay:30"><div>'."\n";
$result = $db->sql_query('SELECT `ip_addr`, `reason` FROM `'.$prefix.'_nsnst_blocked_ips` ORDER BY `date` DESC LIMIT 0,20');
while (list($ip_addr, $ip_reason) = $db->sql_fetchrow($result)) {
  if((is_admin($admin) AND $ab_config['display_link']==1) OR ((is_user($user) OR is_admin($admin)) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
    $lookupip = str_replace('*', '0', $ip_addr);
    $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$ip_addr.'</a>'."\n";
  } else {
    $content .= '<strong><big>&middot;</big></strong>&nbsp;'.$ip_addr."\n";
  }
  if((is_admin($admin) AND $ab_config['display_reason']==1) OR ((is_user($user) OR is_admin($admin)) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
    $result2 = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blockers` WHERE `blocker`=\''.$ip_reason.'\' LIMIT 0,1');
    list($reason) = $db->sql_fetchrow($result2);
    $reason = str_replace('Abuse-','',$reason);
    $content .= '&nbsp;-&nbsp;'."$reason\n";
  }
  $content .= '<br />'."\n";
}
$content .= '</div></div></center>'."\n";
$content .= '<hr /><center><a href="http://www.nukescripts.net" title="'._AB_AVAILABLEAT.'" target="_blank">'._AB_NUKESENTINEL.'</a></center>'."\n";
?>
