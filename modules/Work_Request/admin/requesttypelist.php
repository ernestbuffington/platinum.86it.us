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
echo "<br />";
title(_WR_TYPELIST);
$typeresult = $db->sql_query("select type_id, type_name from ".$prefix."_nsnwr_requests_types order by type_name");
$type_total = $db->sql_numrows($typeresult);
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='3' width='100%' bgcolor='$bgcolor2'><nobr><strong>"._WR_TYPEOPTIONS."</strong></nobr></td></tr>";
$wrimage = wrimage("options.png");
echo "<tr><td><img src='$wrimage'></td><td colspan='2' width='100%'><nobr><a href='".$admin_file.".php?op=WRRequestTypeAdd'>"._WR_TYPEADD."</a></nobr></td></tr>";
$wrimage = wrimage("stats.png");
echo "<tr><td><img src='$wrimage'></td><td colspan='2' width='100%'><nobr>"._WR_TOTALTYPES.": <strong>$type_total</strong></nobr></td></tr>";
echo "</table>";
CloseTable();
echo "<br />";
OpenTable();
echo "<table width='100%' border='1' cellspacing='0' cellpadding='2'>";
echo "<tr><td colspan='2' bgcolor='$bgcolor2' width='100%'><strong>"._WR_TYPELIST."</strong></a></td><td align='center' bgcolor='$bgcolor2'><strong>"._WR_FUNCTIONS."</strong></td></tr>";
if($type_total != 0){
    while (list($type_id, $type_name) = $db->sql_fetchrow($typeresult)) {
        $wrimage = wrimage("request_type.png");
        echo "<tr><td><img src='$wrimage'></td><td width='100%'>$type_name</td>";
        echo "<td align='center'><nobr>[ <a href='".$admin_file.".php?op=WRRequestTypeEdit&amp;type_id=$type_id'>"._WR_EDIT."</a>";
        echo " | <a href='".$admin_file.".php?op=WRRequestTypeRemove&amp;type_id=$type_id'>"._WR_DELETE."</a> ]</nobr></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td width='100%' colspan='3' align='center'>"._WR_NOREQUESTTYPES."</td></tr>";
}
echo "</table>";
CloseTable();
include_once("footer.php");

?>