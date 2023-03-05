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

$pagetitle = ": "._SP_MAINTITLE." "._SP_CONFIGMAIN." ".$sp_config['version_number'];
include_once("header.php");
title(_SP_MAINTITLE." "._SP_CONFIGMAIN." ".$sp_config['version_number']);
spmenu();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php?op=SPConfigSave' method='post'>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._SP_REQUIREUSER.":</strong></td>\n<td>";
$chk1 = $chk2 = $chk3 = $chk4 ="";
if($sp_config['require_user']==0) { $chk1 = " checked"; } else { $chk2 = " checked"; }
echo "<input type='radio' name='require_user' value='0'$chk1>"._NO." &nbsp;";
echo "<input type='radio' name='require_user' value='1'$chk2>"._YES."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._SP_IMAGETYPE.":</strong></td>\n<td>";
if($sp_config['image_type']==0) {  $chk3 = " checked"; } else { $chk4 = " checked"; }
echo "<input type='radio' name='image_type' value='0'$chk3>"._SP_LINKED." &nbsp;";
echo "<input type='radio' name='image_type' value='1'$chk4>"._SP_UPLOAD."</td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._SP_MAXWIDTH.":</strong></td>\n";
echo "<td><input type='text' name='max_width' value='".$sp_config['max_width']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'><strong>"._SP_MAXHEIGHT.":</strong></td>\n";
echo "<td><input type='text' name='max_height' value='".$sp_config['max_height']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP_SAVECHANGES."'></td></tr>\n";
echo "</form></table>";
CloseTable();
include_once("footer.php");

?>