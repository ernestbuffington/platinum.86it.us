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
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
get_lang("Supporters_2");
global $prefix, $db, $user, $admin;
$supporterrn = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_nsnsp_2_config"));
$content = "<center>Supported by<br /><br />";
    $j = 1;
    while ($j <= 5) {
        $sresult = $db->sql_query("SELECT site_id FROM ".$prefix."_nsnsp_2_sites WHERE site_status='1'");
        $numrows = $db->sql_numrows($sresult);
        if ($numrows==1) {
            list ($siteid) = $db->sql_fetchrow($sresult);
        } else if ($numrows > 1) {
            $i = 1;
            while (list ($stid) = $db->sql_fetchrow($sresult)) {
                $abid[$i] = $stid;
                $i++;
            }
            $siteid = $abid[rand(1, $numrows)];
        } else {
            $siteid = 0;
        }
        if($j == 1) {
            $sitelist = "WHERE site_id='$siteid'";
        } else {
            $sitelist = $sitelist." OR site_id='$siteid'";
        }
        $j++;
    }
    $result = $db->sql_query("SELECT site_id, site_name, site_image FROM ".$prefix."_nsnsp_2_sites $sitelist");
    while (list($site_id, $site_name, $site_image) = $db->sql_fetchrow($result)) {
        echo "<a href=\"modules.php?name=Supporters_2&op=SP2Go&site_id=$site_id\" target=\"_blank\"><img src=\"$site_image\" height=\"31\" width=\"88\" title=\"$site_name\" border=\"0\"></a><br /><br />\n";
    }
$content .="</center>\n";
if ($supporterrn['require_user'] == 0 || is_user($user)) { $content .= "[ <a href='modules.php?name=Supporters_2&amp;file=submit'>"._SP2_BESUPPORTER."</a> ]<br />\n"; }
if (is_admin($admin)) { $content .= "[ <a href='modules.php?name=Supporters_2&amp;file=admin'>"._SP2_GOTOADMIN."</a> ]<br />\n"; }
$content .= "[ <a href='modules.php?name=Supporters_2'>"._SP2_SUPPORTERS."</a> ]</center>\n";
?>
