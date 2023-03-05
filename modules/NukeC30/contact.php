<?php

######################################################################
# Nuke-C : Advanced Classifieds Addon For PHP-Nuke
# ===============================================
#
# Copyright (c) 2002 by Sudirman (nukecpower@yahoo.com)
# http://nukec.org
#
# This module is to allow used to contact ads owner
#
#################################################################

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
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
        global $nukecprefix,$db,$module_name,$cookie,$user,$multilingual,$currentlang,$MemberorNot,$perpage,$user_prefix;
        include_once("header.php");
        $nowdate = date("Y-m-d");
        MenuNukeC(0);
        echo "<br />";
    OpenTable();
        $adsinfo = AdsInfo($xid_ads);
        echo "<center><font class=\"content\"><strong>"._NUKECCONTACTTITLE."</strong></font></center><br /><br />"
                ." "._NUKECCONTACT1." <strong>".$adsinfo[submitter]."</strong> "._NUKECCONTACT2." <strong>".$adsinfo[title]."</strong> <br /><br />"
                ."<form action=\"modules.php?name=".$module_name."&amp;file=contact\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"tomail\" value=\"".$adsinfo[email]."\" />";
    if (is_user($user)) {
                $result=$db->sql_query("select name, user_email from ".$user_prefix."_users where username='".$cookie[1]."'");
                if (!$result) {
                        echo  mysql_error();
                }
                list($yn, $ye) = $db->sql_fetchrow($result);
    }
    echo "<strong>"._NUKECFYOURNAME." </strong> <br /><input type=\"text\" name=\"yname\" value=\"".$yn."\" size=\"25\" /><br /><br />\n"
                ."<strong>"._NUKECFYOUREMAIL." </strong> <br /><input type=\"text\" name=\"ymail\" value=\"".$ye."\" size=\"35\" /><br /><br />\n"
                ."<strong>"._NUKECSUBJECT." : </strong> <br /><input type=\"text\" name=\"subjek\" size=\"55\" /><br /><br />\n"
                ."<strong>"._NUKECYOURMSG." : </strong> <br />"
                ."<textarea name=\"pesan\" cols=\"65\" rows=\"7\"></textarea><br /><br />"
                ."<input type=\"hidden\" name=\"op\" value=\"NukeCSendContact\" />\n"
                ."<input type=\"submit\" value="._NUKECSEND." />\n"
                ."</form>\n";
        CloseTable();
        include_once("footer.php");
}

function NukeCSendContact($tomail,$yname, $ymail, $pesan,$subjek) {
    global $sitename, $nukeurl, $nukecprefix, $db, $module_name,$slogan;
        $msg = $sitename." - ".$slogan." \n ".$nukeurl." \n\n";
        $msg .= ""._NUKECSENDERNAME.": ".$yname."\n";
        $msg .= ""._NUKECSENDEREMAIL.": ".$ymail."\n";
        $msg .= ""._NUKECMESSAGE.": ".$pesan."\n\n";
        $subject= $subjek;
        $to = $tomail;
        $mailheaders = "FROM: ".$yname." <".$ymail.">\r\n";


        $mailheaders .= _NUKECREPLYTO.": ".$ymail."";
        mail($to, $subject, $msg, $mailheaders);
        $to = urlencode($tomail);
//The below line has been replaced by ANH TRAN to protect user's privacy.
//header("Location: modules.php?name=".$module_name."&file=contact&op=MailSent&to=$to");
    header("Location: modules.php?name=".$module_name."&file=contact&op=MailSent&to=");
}
// <strong>".$to."</strong> has been remove to protect user privacy by ANH TRAN.
function MailSent($to) {
        $to = urldecode($to);
    include_once("header.php");
    OpenTable();
    echo "<center><font class=\"content\">"._NUKECMAILSENT."<br /><br /><strong>"._NUKECTHANKS."</strong></font></center>";
    CloseTable();
    include_once("footer.php");
}

switch($op) {
        default : Index($id_ads); break;
        case "NukeCSendContact":NukeCSendContact($tomail,$yname, $ymail, $pesan,$subjek);break;
        case "MailSent": MailSent($to);break;
}

?>
