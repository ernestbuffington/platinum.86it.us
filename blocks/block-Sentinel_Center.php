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
global $db, $prefix, $ab_config;
$total_ips = $db->sql_numrows($db->sql_query('SELECT * FROM `'.$prefix.'_nsnst_blocked_ips`'));
if(!$total_ips) { $total_ips = 0; }
$content  = '<center><img src="images/nukesentinel/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><br />'._AB_HAVECAUGHT.' '.intval($total_ips).' '._AB_SHAMEFULHACKERS.'</center>'."\n";
$content .= '<hr /><center><a href="http://www.nukescripts.net" target="_blank">'._AB_NUKESENTINEL.'</a></center>'."\n";
?>
