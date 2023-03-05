<?php

/********************************************************/
/* NSN Work Probe                                       */
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
$typeresult = $db->sql_query("select type_name from ".$prefix."_nsnwp_reports_types where type_id='$type_id'");
list($type_name) = $db->sql_fetchrow($statusresult);
wpadmin_menu();
echo "<br />\n";
title(_WP_TYPEDELETE);
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form method='post' action='".$admin_file.".php'>\n";
echo "<input type='hidden' name='op' value='WPReportTypeDelete'>\n";
echo "<input type='hidden' name='type_id' value='$type_id'>\n";
echo "<tr><td align='center'><strong>"._WP_SWAPTYPE."</strong></td></tr>\n";
echo "<tr><td align='center'>$type_name -> <select name='swap_type_id'>\n";
echo "<option value='0'>---------</option>\n";
$typelist = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwp_reports_types where type_id != '$type_id' order by type_name");
while(list($t_type_id, $t_type_name) = $db->sql_fetchrow($typelist)){
    echo "<option value='$t_type_id'>$t_type_id - $t_type_name</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'><input type='submit' value='"._WP_TYPEDELETE."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>