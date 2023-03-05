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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
$content = "";
global $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $sitekey, $gfx_chk;
$chk = array(2,4,5,7);
$cnbchk = array(2,3);
//$result = $db->sql_query("SELECT config_value FROM ".$prefix."_cnbya_config WHERE config_name='usegfxcheck'");
list ($cnbya_chk) = $db->sql_fetchrow($db->sql_query("SELECT config_value FROM ".$prefix."_cnbya_config WHERE config_name='usegfxcheck'"));
mt_srand ((double)microtime()*1000000);
$maxran = 1000000;
$random_num = mt_rand(0, $maxran);
$datekey = date("F j");
$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
$code = substr($rcode, 2, 6);
cookiedecode($user);
$uname = $cookie[1];
$lasturow = $db->sql_fetchrow($db->sql_query("SELECT username FROM $user_prefix"._users." ORDER BY user_id DESC LIMIT 0,1"));
$lastuser = $lasturow['username'];
$numrows = $db->sql_numrows($db->sql_query("SELECT user_id FROM $user_prefix"._users.""));
$result = $db->sql_query("SELECT uname, guest FROM $prefix"._session." WHERE guest='0'");
$member_online_num = $db->sql_numrows($result);
$who_online_now = "";
$i = 1;
while ($session = $db->sql_fetchrow($result)) {
    list($uid, $username2, $user_color_gc) = $db->sql_fetchrow($db->sql_query("SELECT user_id, username, user_color_gc FROM $user_prefix"._users." WHERE username='$session[uname]' and user_allow_viewonline='1'"));
            
			intval($uid);
			$username2=UsernameColor($user_color_gc, $username2);
    if (isset($session["guest"]) and $session["guest"] == 0) {
        if ($i < 10) {
            $who_online_now .= "0$i:&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$session[uname]\">$username2</a><br />\n";
        } else {
            $who_online_now .= "$i:&nbsp;<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$session[uname]\">$username2</a><br />\n";
        }
        $who_online_now .= ($i != $member_online_num ? "  " : "");
        $i++;
    }
}
$Today = getdate();
//Formatting Current Date
$month = $Today['month'];
$mday = $Today['mday'];
$year = $Today['year'];
//Formatting Previous Date
$pmonth = $Today['month'];
$pmday = $Today['mday'];
$pmday = $mday-1;
$pyear = $Today['year'];
//Month conversion into numeric mode
if ($pmonth=="January") { $pmonth=1; } else
if ($pmonth=="February") { $pmonth=2; } else
if ($pmonth=="March") { $pmonth=3; } else
if ($pmonth=="April") { $pmonth=4; } else
if ($pmonth=="May") { $pmonth=5; } else
if ($pmonth=="June") { $pmonth=6; } else
if ($pmonth=="July") { $pmonth=7; } else
if ($pmonth=="August") { $pmonth=8; } else
if ($pmonth=="September") { $pmonth=9; } else
if ($pmonth=="October") { $pmonth=10; } else
if ($pmonth=="November") { $pmonth=11; } else
if ($pmonth=="December") { $pmonth=12; };
$test = mktime (0,0,0,$pmonth,$pmday,$pyear,1);
//Creating SQL parameter
$curDate2 = "%".$month[0].$month[1].$month[2]."%".$mday."%".$year."%";
$preday = strftime ("%d",$test);
$premonth = strftime ("%B",$test);
$preyear = strftime ("%Y",$test);
$curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";
//Executing SQL Today
$row = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount FROM $user_prefix"._users." WHERE user_regdate LIKE '$curDate2'"));
$userCount = $row['userCount'];
//end
//Executing SQL Today
$row2 = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount FROM $user_prefix"._users." WHERE user_regdate LIKE '$curDateP'"));
$userCount2 = $row2['userCount'];
//end
$guest_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='1'"));
$member_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='0'"));
$who_online_num = $guest_online_num + $member_online_num;
$content .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">";
if (is_user($user)) {
    $content .= "<br /><img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <strong>$uname</strong>.<br />\n<hr>\n";
    $row3 = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM $user_prefix"._users." WHERE username='$uname'"));
    $uid = intval($row3[user_id]);
    $newpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM $prefix"._bbprivmsgs." WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')"));
    $oldpms = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM $prefix"._bbprivmsgs." WHERE privmsgs_to_userid='$uid' AND privmsgs_type='0'"));
    $content .= "<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\"> <a href=\"modules.php?name=Private_Messages\"><strong>"._BPM."</strong></a><br />\n";
    $content .= "<img src=\"images/blocks/email-r.gif\" height=\"10\" width=\"14\"> "._BUNREAD.": <strong>$newpms</strong><br />\n";
    $content .= "<img src=\"images/blocks/email-g.gif\" height=\"10\" width=\"14\"> "._BREAD.": <strong>$oldpms</strong><br />\n<hr>\n";
} else {
    $content .= "<img src=\"images/blocks/group-4.gif\" height=\"14\" width=\"17\"> "._BWEL.", <strong>$anonymous</strong>\n<hr>";
    $content .= ""._NICKNAME." <input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\"><br />";
    $content .= ""._PASSWORD." <input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"20\"><br />";
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk, 'stacked');
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $content .= "<center><input type=\"hidden\" name=\"op\" value=\"login\">";
    $content .= "<input type=\"submit\" value=\""._LOGIN."\">\n (<a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._BREG."</a>)</center><hr>";
}
$content .= "<img src=\"images/blocks/group-2.gif\" height=\"14\" width=\"17\"> <strong><u>"._BMEMP.":</u></strong><br />\n";
$content .= "<img src=\"images/blocks/ur-moderator.gif\" height=\"14\" width=\"17\"> "._BLATEST.": <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$lastuser\"><strong>$lastuser</strong></a><br />\n";
$content .= "<img src=\"images/blocks/ur-author.gif\" height=\"14\" width=\"17\"> "._BTD.": <strong>$userCount</strong><br />\n";
$content .= "<img src=\"images/blocks/ur-admin.gif\" height=\"14\" width=\"17\"> "._BYD.": <strong>$userCount2</strong><br />\n";
$content .= "<img src=\"images/blocks/ur-guest.gif\" height=\"14\" width=\"17\"> "._BOVER.": <strong>$numrows</strong><br />\n<hr>\n";
$content .= "<img src=\"images/blocks/group-3.gif\" height=\"14\" width=\"17\"> <strong><u>"._BVISIT.":</u></strong>\n<br />\n";
$content .= "<img src=\"images/blocks/ur-anony.gif\" height=\"14\" width=\"17\"> "._BVIS.": <strong>$guest_online_num</strong><br />\n";
$content .= "<img src=\"images/blocks/ur-member.gif\" height=\"14\" width=\"17\"> "._BMEM.": <strong>$member_online_num</strong><br />\n";
$content .= "<img src=\"images/blocks/ur-registered.gif\" height=\"14\" width=\"17\"> "._BTT.": <strong>$who_online_num</strong><br />\n";
if ($member_online_num > 0) {
    $content .= "<hr>\n<img src=\"images/blocks/group-1.gif\" height=\"14\" width=\"17\"> <strong><u>"._BON.":</u></strong><br />$who_online_now";
}
$content .= "</form>";
?>
