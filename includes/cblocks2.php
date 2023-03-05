<?php

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

if (stristr($_SERVER['SCRIPT_NAME'], "cblocks2.php")) {
    Header("Location: ../index.php");
    die();
}

global $bgcolor1, $bgcolor2;
$cbinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_nsncb_config where cgid='2'"));
if ($cbinfo['enabled'] == '1') {
    if ($cbinfo['height'] <> "") { $cheight = "height='".$cbinfo['height']."' "; } else { $cheight = ""; }
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='0'><tr><td valign='top'>\n";
    echo "<table width='100%' ".$cheight."border='0' cellspacing='1' cellpadding='4'><tr>";
    $result3 = $db->sql_query("SELECT * FROM ".$prefix."_nsncb_blocks WHERE cgid='2' ORDER BY cbid");
    while($cbidinfo = $db->sql_fetchrow($result3)) {
        if ($cbidinfo['cbid'] <= $cbinfo['count']) {
            if ($cbidinfo['wtype'] == '0') {
                echo "<td width='".$cbidinfo['width']."' valign='top' align='center'>\n";
            } else {
                echo "<td width='".$cbidinfo['width']."%' valign='top' align='center'>\n";
            }
            cb_blocks($cbidinfo['rid']);
            echo "</td>\n";
        }
    }
    echo "</tr></table>\n";
    echo "</td></tr></table>\n";
    echo "<br />";
}

?>
