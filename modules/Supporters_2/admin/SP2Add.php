<?php
/********************************************************/
/* NSN Supporters_2(TM) Universal                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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

$pagetitle = ": "._SP2_MAINTITLE." "._SP2_ADMINMAIN." ".$sp_config['version_number']." - "._SP2_ADDSUPPORTER;
include_once("header.php");
if(defined("NUKESENTINEL_IS_LOADED")) {
  $sip = $nsnst_const['remote_ip'];
} else {
  $sip = $_SERVER['REMOTE_ADDR'];
}
title(_SP2_MAINTITLE." "._SP2_ADMINMAIN." ".$sp_config['version_number']." - "._SP2_ADDSUPPORTER);
sp2menu();
echo "<br />\n";
OpenTable();
echo "<center><br />"._SP2_ALLREQ."<br />\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
if($supporter_config['image_type']==0) { $enctype = ""; } else { $enctype = "enctype='multipart/form-data'"; }
echo "<form action='".$admin_file.".php?op=SP2AddSave' method='post'$enctype>\n";
echo "<input type='hidden' name='user_id' value='$suid'>\n";
echo "<tr><td><strong>"._SP2_NAME.":</strong></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
echo "<tr><td><strong>"._SP2_URL.":</strong></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
if($supporter_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
echo "<tr><td valign='top'><strong>"._SP2_IMAGE.":</strong></td><td><input $type name='site_image' size='50'><br />";
echo ""._SP2_MUSTBE."</td></tr>\n";
echo "<tr><td valign='top'><strong>"._SP2_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
echo "<tr><td><strong>"._SP2_YOURNAME.":</strong></td><td><input type='test' name='user_name' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP2_YOUREMAIL.":</strong></td><td><input type='text' name='user_email' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP2_YOURIP.":</strong></td><td><input type='text' name='user_ip' value='$sip' size='40'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP2_SUBMITSITE."'></td></tr>\n";
echo "</form></table></center>\n";
CloseTable();
include_once("footer.php");

?>