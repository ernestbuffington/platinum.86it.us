<?php

/********************************************************/
/* NSN Work Request                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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
wradmin_menu();
echo "<br />\n";
title(_WR_PROJECTADD);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form method='post' action='".$admin_file.".php'>";
echo "<input type='hidden' name='op' value='WRProjectInsert'>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_PROJECTNAME.":</td>";
echo "<td><input type='text' name='project_name' size='30'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._WR_DESCRIPTION.":</td>";
echo "<td><textarea name='project_description' cols='60' rows='10' wrap='virtual'></textarea></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'>"._WR_FEATUREDBLOCK.":</td>\n";
echo "<td><select name='featured'><option value='0' selected>"._WR_NO."</option>\n";
echo "<option value='1'>"._WR_YES."</option></select></td></tr>\n";
echo "<tr><td colspan='2' align='center'><input type='submit' value='"._WR_PROJECTADD."'></td></tr>";
echo "</form>";
echo "</table>";
CloseTable();
include_once("footer.php");

?>