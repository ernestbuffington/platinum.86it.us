<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to allow used to forward ads to their friends
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                             */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!preg_match("#modules.php#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include_once("modules/".$module_name."/config.php");
include_once("modules/".$module_name."/functions.php");
$pagetitle = "- ". $PageTitleNukeC;
#$index = 0;
define('INDEX_FILE', true);

function Index($xid_ads) {
        global $nukecprefix,$db,$module_name,$cookie,$user;
        global $nukecprefix,$db,$module_name,$multilingual,$currentlang,$MemberorNot,$perpage,$user_prefix;
        include_once("header.php");

        $nowdate = date("Y-m-d");
        MenuNukeC(0);
        echo "<br />";
    OpenTable();
        $adsinfo = AdsInfo($xid_ads);
        echo "<center><font class=\"content\"><strong>"._NUKECFRIEND."</strong></font></center><br /><br />"
                .""._NUKECYOUSENDADS." <strong>".$adsinfo[title]."</strong> "._NUKECTOAFRIEND."<br /><br />"
                ."<form name=\"friend\" action=\"modules.php?name=".$module_name."&amp;file=friend\" method=\"post\">"
                ."<input type=\"hidden\" name=\"id_ads\" value=\"".$xid_ads."\" />";
    if (is_user($user)) {
                $result=$db->sql_query("select name, user_email from ".$user_prefix."_users where username='".$cookie[1]."'");
                list($yn, $ye) = $db->sql_fetchrow($result);
    }
    echo "<strong>"._NUKECFYOURNAME." </strong> <input type=\"text\" name=\"yname\" value=\"".$yn."\" size=\"25\" /><br /><br />\n"
                ."<strong>"._NUKECFYOUREMAIL." </strong> <input type=\"text\" name=\"ymail\" value=\"".$ye."\"size=\"35\" /><br /><br /><br />\n"
                ."<strong>"._NUKECFFRIENDNAME." </strong> <input type=\"text\" name=\"fname\" size=\"25\" /><br /><br />\n"
                ."<strong>"._NUKECFFRIENDEMAIL." </strong> <input type=\"text\" name=\"fmail\" size=\"35\" /><br /><br />\n"
                ."<input type=\"hidden\" name=\"op\" value=\"NukeCSendAds\" />\n"
                ."<input type=\"submit\" value="._NUKECSEND." />\n";
        echo "<br /><br />"._NUKECSEND2FRIENDNOTE
                ."</form>\n";
        CloseTable();
        include_once("footer.php");
}


function NukeCSendAds($id_ads, $yname, $ymail, $fname, $fmail) {
    global $sitename, $nukeurl, $nukecprefix, $db, $module_name;
        global $Price_Format_code,$Date_Format_code;
        $adsinfo = AdsInfo($id_ads);

    $subject = ""._NUKECINTERESTING." ".$sitename;
        
        $headers = "FROM: ".$yname." <".$ymail.">\r\n";
        $message = ""._NUKECHELLO." ".$fname.": <br /><br />"._NUKECYOURFRIEND." ".$yname." "._NUKECCONSIDERED."<br />";
        $message .= "<br />".$adsinfo[title]."<br />("._NUKECFDATE." ".FormatDateAds($adsinfo[dateposted],$Date_Format_code).")<br />"._NUKECFTOPIC." ".getcategoryname($adsinfo[id_catg])."<br />";
        $ads_URL = "".$nukeurl."/modules.php?name=".$module_name."&amp;op=ViewDetail&amp;id_ads=".$id_ads."";
        $ads_URL = "<a href=\"$ads_URL\">".$ads_URL."</a>";
        $message .= "<br />"._NUKECURL.": $ads_URL<br /><br />"._NUKECYOUCANREAD." ".$sitename."<br /><br />".$nukeurl;
    mail($fmail, $subject, $message, $headers);
        $fname = urlencode($fname);
        $id = urlencode($id_ads);
    header("Location: modules.php?name=".$module_name."&file=friend&op=AdsSent&id_ads=$id_ads&fname=$fname");
}

function AdsSent($id_ads, $fname) {
        $fname = urldecode($fname);
        $id = urldecode($id_ads);
    include_once("header.php");
           $adsinfo = AdsInfo($id_ads);
    OpenTable();
    echo "<center><font class=\"content\">"._NUKECADS." <strong>".$adsinfo[title]."</strong> "._NUKECHASSENT." ".$fname."... <strong>"._NUKECTHANKS."</strong></font></center>";
    CloseTable();
    include_once("footer.php");
}

switch($op) {
        default : Index($id_ads); break;
        case "NukeCSendAds":NukeCSendAds($id_ads, $yname, $ymail, $fname, $fmail);break;
        case "AdsSent": AdsSent($id_ads, $fname);break;
}

?>
