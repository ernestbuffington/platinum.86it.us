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
$pagetitle = _AB_NUKESENTINEL.": "._AB_AGENTTRACKING;
echo '<title>'.$pagetitle.'</title>'."\n";
echo '</head>'."\n";
echo '<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000">'."\n";
echo '<h1 align="center">'.$pagetitle.'</h1>'."\n";
$tid=intval($tid);
list($uname) = $db->sql_fetchrow($db->sql_query("SELECT `user_agent` FROM `".$prefix."_nsnst_tracked_ips` WHERE `tid`='$tid' LIMIT 0,1"));
$xname = wordwrap($uname, 50, "\n", true);
$xname = str_replace("&amp;amp;", "&amp;", htmlentities($xname, ENT_QUOTES));
$xname = str_replace("\n", "<br />\n", $xname);
echo '<center><strong>'.$xname.'</strong></center><br />'."\n";
echo '<table summary="" align="center" border="0" bgcolor="#000000" cellpadding="2" cellspacing="2">'."\n";
echo '<tr bgcolor="#ffffff">'."\n";
echo '<td><strong>'._AB_PAGEVIEWED.'</strong></td>'."\n";
echo '<td><strong>'._AB_DATE.'</strong></td>'."\n";
echo '</tr>'."\n";
$result = $db->sql_query("SELECT `page`, `date` FROM `".$prefix."_nsnst_tracked_ips` WHERE `user_agent`='$uname' ORDER BY `date` DESC");
while(list($page, $date_time) = $db->sql_fetchrow($result)){
  $page = wordwrap($page, 50, "\n", true);
  $page = str_replace("&amp;amp;", "&amp;", htmlentities($page, ENT_QUOTES));
  $page = str_replace("\n", "<br />\n", $page);
  echo '<tr bgcolor="#ffffff">'."\n";
  echo '<td>'.$page.'</td>'."\n";
  echo '<td>'.date("Y-m-d \@ H:i:s",$date_time).'</td>'."\n";
  echo '</tr>'."\n";
}
echo '</table>'."\n";
echo '</body>'."\n";
echo '</html>';

?>