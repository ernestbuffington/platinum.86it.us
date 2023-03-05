<?php

/********************************************************/
/* NukeSupporters(tm)                                   */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
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

$pagetitle = ": "._SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_ADDSUPPORTER;
include_once("header.php");
if(defined("NUKESENTINEL_IS_LOADED")) {
  $sip = $nsnst_const['remote_ip'];
} else {
  $sip = $_SERVER['REMOTE_ADDR'];
}
title(_SP_MAINTITLE." "._SP_ADMINMAIN." ".$sp_config['version_number']." - "._SP_ADDSUPPORTER);
spmenu();
echo "<br />\n";
OpenTable();
echo "<center><br />"._SP_ALLREQ."<br />\n";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
if($supporter_config['image_type']==0) { $enctype = ""; } else { $enctype = "enctype='multipart/form-data'"; }
echo "<form action='".$admin_file.".php?op=SPAddSave' method='post'$enctype>\n";
echo "<input type='hidden' name='user_id' value='$suid'>\n";
echo "<tr><td><strong>"._SP_NAME.":</strong></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
echo "<tr><td><strong>"._SP_URL.":</strong></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
if($supporter_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
echo "<tr><td valign='top'><strong>"._SP_IMAGE.":</strong></td><td><input $type name='site_image' size='50'><br />";
echo ""._SP_MUSTBE."</td></tr>\n";
echo "<tr><td valign='top'><strong>"._SP_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
echo "<tr><td><strong>"._SP_YOURNAME.":</strong></td><td><input type='test' name='user_name' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP_YOUREMAIL.":</strong></td><td><input type='text' name='user_email' size='40'></td></tr>\n";
echo "<tr><td><strong>"._SP_YOURIP.":</strong></td><td><input type='text' name='user_ip' value='$sip' size='40'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP_SUBMITSITE."'></td></tr>\n";
echo "</form></table></center>\n";
CloseTable();
include_once("footer.php");

?>