<?php

/********************************************************/
/* NSN Work Probe                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright ? 2000-2005 by NukeScripts Network         */
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

include_once("header.php");
$userinfo = getusrinfo($user);
$report = wpreport_info($report_id);
title(_WP_COMMENTADD.": ".$report['report_name']);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='modules.php?name=$module_name' method='post'>\n";
echo "<input type='hidden' name='op' value='WPReportCommentInsert'>\n";
echo "<input type='hidden' name='report_id' value='$report_id'>\n";
echo "<tr><td align='center' colspan='2' class='title'>"._WP_INPUTNOTE."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_NAME.":</td>\n";
echo "<td><input type='text' name='commenter_name' size='30' value='".$userinfo['username']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._WP_EMAILADDRESS.":</td>\n";
echo "<td><input type='text' name='commenter_email' size='30' value='".$userinfo['user_email']."'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WP_COMMENT.":</td>\n";
echo "<td><textarea name='comment_description' cols='60' rows='10' wrap='virtual'></textarea></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._WP_COMMENTADD."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>