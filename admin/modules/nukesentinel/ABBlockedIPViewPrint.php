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
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
echo '<html>'."\n";
echo '<head>'."\n";
$pagetitle = _AB_NUKESENTINEL.": "._AB_PRINTIP;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$getIPs = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='$xIPs' LIMIT 0,1"));
$getIPs['date'] = date("Y-m-d H:i:s",$getIPs['date']);
list($getIPs['reason']) = $db->sql_fetchrow($db->sql_query("SELECT `reason` FROM `".$prefix."_nsnst_blockers` WHERE `blocker`='".$getIPs['reason']."' LIMIT 0,1"));
$lookupip = str_replace("*", "0", $xIPs);
$getIPs['query_string'] = htmlentities(base64_decode($getIPs['query_string']));
$getIPs['query_string'] = str_replace("%20", " ", $getIPs['query_string']);
$getIPs['query_string'] = str_replace("/**/", "/* */", $getIPs['query_string']);
$countrytitleinfo = abget_countrytitle($getIPs['c2c']);
echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_BLOCKEDIP.':</strong></td><td>'.$xIPs.'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_USER.':</strong></td><td>'.$getIPs['username'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_AGENT.':</strong></td><td>'.$getIPs['user_agent'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_BLOCKEDON.':</strong></td><td>'.$getIPs['date'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td valign="top"><strong>'._AB_NOTES.':</strong></td><td>'.$getIPs['notes'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REASON.':</strong></td><td>'.$getIPs['reason'].'</td></tr>'."\n";
//echo '<tr bgcolor="#ffffff"><td colspan="2">&nbsp;</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_QUERY.':</strong></td><td>'.$getIPs['query_string'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_X_FORWARDED.':</strong></td><td>'.$getIPs['x_forward_for'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_CLIENT_IP.':</strong></td><td>'.$getIPs['client_ip'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REMOTE_ADDR.':</strong></td><td>'.$getIPs['remote_addr'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REMOTE_PORT.':</strong></td><td>'.$getIPs['remote_port'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_REQUEST_METHOD.':</strong></td><td>'.$getIPs['request_method'].'</td></tr>'."\n";
echo '<tr bgcolor="#ffffff"><td><strong>'._AB_COUNTRY.':</strong></td><td>'.strtoupper($getIPs['c2c']).' - '.$countrytitleinfo['country'].'</td></tr>'."\n";
echo '</table>'."\n";
echo '</body>'."\n";
echo '</html>';

?>