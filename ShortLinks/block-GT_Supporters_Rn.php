<?php

/********************************************************/
/* NSN Supporters(TM) Universal                         */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Supporters_Rn.php")) {
    Header("Location: ../index.html");
    die();
}

get_lang("Supporters");
global $prefix, $db, $user, $admin;
$supporterrn = $db->sql_fetchrow($db->sql_query("SELECT * from ".$prefix."_nsnsp_config"));
$content = "<center>Supported by<br><br>";
    $j = 1;
    while ($j <= 5) {
        $sresult = $db->sql_query("SELECT site_id FROM ".$prefix."_nsnsp_sites WHERE site_status='1'");
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

    $result = $db->sql_query("SELECT site_id, site_name, site_image FROM ".$prefix."_nsnsp_sites $sitelist");
    while (list($site_id, $site_name, $site_image) = $db->sql_fetchrow($result)) {
        $content .= "<a href=\"supporters-site-$site_id.html\" target=\"_blank\"><img src=\"$site_image\" height=\"31\" width=\"88\" title=\"$site_name\" border=\"0\"></a><br><br>\n";
    }
$content .="</center>\n";
if ($supporterrn['require_user'] == 0 || is_user($user)) { $content .= "[ <a href='supporters-submit.html'>"._BESUPPORTER."</a> ]<br>\n"; }
if (is_admin($admin)) { $content .= "[ <a href='modules.php?name=Supporters&amp;file=admin'>"._GOTOADMIN."</a> ]<br>\n"; }
$content .= "[ <a href='supporters.html'>"._SUPPORTERS."</a> ]</center>\n";

?>