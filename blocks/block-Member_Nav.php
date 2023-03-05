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
// Language Variables
define("_UMWEL", "Welcome"); 
define("_UMWELB", "Welcome Back"); 
define("_UMPM","Private Messages"); 
define("_UMNICK","Nickname"); 
define("_UMPSW","Password"); 
define("_UMMEMP","Membership"); 
define("_UMLATEST","Latest"); 
define("_UMNMSG","New"); 
define("_UMOMSG","Old"); 
define("_UMOVER","Overall"); 
define("_UMON","Members Online Now:"); 
define("_UMVIS","Visitors"); 
define("_UMMEM","Members"); 
define("_UMREG","Register"); 
define("_UMONLINE","Online Now"); 
define("_UMLOGIN","Login"); 
define("_UMBEXIT","Logout"); 
define("_UMSECURITYCODE","Security Code"); 
define("_UMTYPESECCODE","Enter Code"); 
define("_UMSENDPM","Send Private Message to"); 
define("_UMPAGEVIEWS","Page Views"); 
define("_UMHITSTOTAL","Total"); 
define("_UMHITSTODAY","Today"); 
define("_UMBADMINEXIT","Admin Logout"); 
define("_UMWRITE","Write private message to"); 
define("_UMVIEWUSER","View The Userinfo for"); 
define("_BLOGIN","Your Account"); 
define("_BFLOGIN","Edit Profile"); 
define("_ACCOUNTOPTIONS","Goto Your Account Screen"); 
define("_ACCOUNTOPTIONS2","Edit Your Profile Information");
global $Show_Hits, $Show_Online, $user, $userinfo, $prefix, $user_prefix, $db, $anonymous, $sitekey, $gfx_chk, $admin, $mainindex, $adminindex, $currentlang, $startdate;
$Show_Hits = 1; // Show total & Todays pageviews (0=off 1=on)
$Show_Online = 1; //Shows who is online (0=off 1=on)
/*************************************************************************/
$ThemeSel = get_theme();
$content = "";
function pageview() {
	global $db, $prefix;
	//Count total hits
	list($total_hits) = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'"));
	//Today hits
	list($today_hits) = $db->sql_fetchrow($db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE year='".date("Y")."' AND month='".date("n")."' AND date='".date("j")."'"));
	//Yesterday
	$y_time = time() - 86400; 
	$y_year = date("Y", $y_time); 
	$y_month = date("n", $y_time); 
	$y_date = date("j", $y_time); 
	list($yesterday) = $db->sql_fetchrow($db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE year='$y_year' AND month='$y_month' AND date='$y_date'"));
	//Output
	$pageviews = "<center><hr><strong>"._UMPAGEVIEWS."</strong></center>";
	$pageviews .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">";
	$pageviews .= "<tr><td><big><strong>&middot;</strong></big>&nbsp;"._UMHITSTODAY.": <strong><a href=\"modules.php?name=Statistics&op=DailyStats&year=".date("Y")."&month=".date("n")."&date=".date("j")."\">$today_hits</a></strong></td></tr>";
	$pageviews .= "<tr><td><big><strong>&middot;</strong></big>&nbsp;".Yesterday.": <strong><a href=\"modules.php?name=Statistics&op=DailyStats&year=$y_year&month=$y_month&date=$y_date\">$yesterday</a></strong></td></tr>";
	$pageviews .= "<tr><td><big><strong>&middot;</strong></big>&nbsp;"._UMHITSTOTAL.": <strong>$total_hits</strong></td></tr>";
	$pageviews .= "</table>";	
	return $pageviews;
}	
function useronline() {
	global $db, $prefix, $user_prefix, $Show_Online, $memres;
	$memres = $db->sql_query("SELECT uname, guest FROM $prefix"._session." WHERE guest=0 ORDER BY uname");
	$anonres = $db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest = 1 ORDER BY uname");
	$online_num[0] = $db->sql_numrows($memres);
	$online_num[1] = $db->sql_numrows($anonres);
	$online_num[2] = $online_num[0] + $online_num[1];
	if ($Show_Online == 1) {
		for($i = 1; $i <= $online_num[0]; $i++) {
			$content .= $i;
			$session = $db->sql_fetchrow($memres);
			list($uid, $user_rank) = $db->sql_fetchrow($db->sql_query("SELECT user_id, user_rank FROM ".$user_prefix."_users WHERE username='".$session['uname']."'"));
			intval($uid);
			$uname = $session['uname'];
			if (isset($session['guest']) and $session['guest'] == 0) {
				if ($i < 10) {
					if ($user_rank == 0 ) {
		 	   			$online_num[3] .= "&nbsp;&nbsp;0$i:&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$uid."\" title=\"View The Userinfo for $session[uname]\">$uname</a><br />";
					} else {
						$rank_image = $db->sql_fetchrow($db->sql_query("SELECT rank_title, rank_image_online FROM ".$prefix."_bbranks WHERE rank_id='$user_rank'"));
						if ($rank_image['rank_image_online'] != "") {
							$rank_name = "&nbsp;<img src=\"".$rank_image['rank_image_online']."\" alt=\"\" border=\"0\" title=\"".$rank_image['rank_title']."\">";
						} else {
							$rank_name = "";
						}
						$online_num[3] .= "&nbsp;&nbsp;0$i:&nbsp;<A HREF=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$uid."\" title=\"View The Userinfo for $session[uname]\">$uname</a>$rank_name<br />";
					}
				} else {
					if ($user_rank == 0 ) {
		 	   			$online_num[3] .= "&nbsp;&nbsp;$i:&nbsp;<A HREF=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$uid."\" title=\"View The Userinfo for $session[uname]\">$uname</a><br />";
					} else {
						$rank_image = $db->sql_fetchrow($db->sql_query("SELECT rank_title, rank_image_online FROM ".$prefix."_bbranks WHERE rank_id='$user_rank'"));
						if ($rank_image['rank_image_online'] != "") {
							$rank_name = "&nbsp;<img src=\"".$rank_image['rank_image_online']."\" alt=\"\" border=\"0\" title=\"".$rank_image['rank_title']."\">";
						} else {
							$rank_name = "";
						}
						$online_num[3] .= "&nbsp;&nbsp;$i:&nbsp;<a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$uid."\" title=\"View The Userinfo for $session[uname]\">$uname</a>$rank_name<br />";
					}
				}
			}
		}
	}
	return $online_num;
}
function num_users() {
    global $user_prefix, $db;
    list($numrows) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_id > 1 AND user_level >= 0"));
    return $numrows;
}
function newusers() {
    global $user_prefix, $db;
    list($userCount[0]) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y")."'"));
    list($userCount[1]) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM ".$user_prefix."_users WHERE user_regdate='".date("M d, Y", time()-86400)."'"));
    return $userCount;
}
function lastuserid() {
global $db, $user_prefix;
$sql = "SELECT user_id FROM ".$user_prefix."_users order by user_id DESC limit 0,1";
list($lastuserid) = $db->sql_fetchrow($db->sql_query($sql));
return $lastuserid;
}
function lastuser() {
    global $db, $user_prefix;
    $sql = "SELECT username FROM ".$user_prefix."_users ORDER BY user_id DESC LIMIT 1";
    list($lastuser) = $db->sql_fetchrow($db->sql_query($sql));
    return $lastuser;
}
function pms($id) {
    global $prefix, $userinfo, $db;
    intval($id);
		$usrid = $userinfo[user_id];
		if ($id == 1) {
    	$id = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM $prefix"._bbprivmsgs." WHERE privmsgs_to_userid='$usrid' AND (privmsgs_type='1' OR privmsgs_type='5')"));
		} else {    	
    	$id = $db->sql_numrows($db->sql_query("SELECT privmsgs_to_userid FROM $prefix"._bbprivmsgs." WHERE privmsgs_to_userid='$usrid' AND privmsgs_type='0'"));
    }	
		return $id;
}
if (is_user($user)) {
	if ($userinfo[user_avatar]) {
		if ($userinfo['user_avatar_type'] == 0) {
			$content .= "<center>"._UMWELB."<br /><img src=\"themes/$ThemeSel/forums/images/guest_avatar.gif\" alt=\"\"><br />".$userinfo['username']."\n</center><hr>";
		} else if (preg_match( "/(http)/", $userinfo['user_avatar']) ) {
			$content .= "<center>"._UMWELB."<br /><img src=\"$userinfo[user_avatar]\" alt=\"\"><br />".$userinfo['username']."</center><hr>";
		} else if ($userinfo['user_avatar']) {
			$content .= "<center>"._UMWELB."<br /><img src=\"modules/Forums/images/avatars/$userinfo[user_avatar]\" alt=\"\"><br />".$userinfo['username']."\n</center><hr>";
		}
	}
	$content .= "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" align=\"center\">\n";
	$content .= "<tr>\n";
	$content .= "<td><a href=\"modules.php?name=Private_Messages\"><strong>"._UMPM."</strong></a></td>\n";
	$content .= "</tr>\n";
	$content .= "<tr>\n";
	$content .= "<td>&nbsp;&nbsp;"._UMNMSG.": <strong>".pms('1')."</strong><br /></td>\n";
	$content .= "</tr>\n";
	$content .= "<tr>\n";
	$content .= "<td>&nbsp;&nbsp;"._UMOMSG.": <strong>".pms('0')."</strong>\n</td>\n";
	$content .= "</tr>\n";
	$content .= "</table>\n";
} else {
//	$content .= "<center><font class=\"content\">"._ASREGISTERED."</font></center><hr>"; 
//	$content .= "<center><img src=\"themes/$ThemeSel/forums/images/guest.gif\" alt=\"no avatar\"><br />"._BWEL." <strong>$anonymous</strong></center>\n<hr>";
	$content .= "<center>"._BWEL." <strong>$anonymous</strong></center>\n<hr>";
	$content .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">\n";
	$content .= "<table border=\"0\"><tr><td>\n";
	$content .= _NICKNAME.": <input type=\"text\" name=\"username\" size=\"10\" maxlength=\"25\"><br />\n";
	$content .= _PASSWORD.": <input type=\"password\" name=\"user_password\" size=\"10\" maxlength=\"25\"><br />\n";
	$content .= "<input type=\"hidden\" name=\"redirect\" value=$redirect>\n";
	$content .= "<input type=\"hidden\" name=\"mode\" value=$mode>\n";
	$content .= "<input type=\"hidden\" name=\"f\" value=$f>\n";
	$content .= "<input type=\"hidden\" name=\"t\" value=$t>\n";
	$content .= "<input type=\"hidden\" name=\"op\" value=\"login\">\n";
	$content .= "<input type=\"submit\" value=\""._LOGIN."\">&nbsp;&nbsp;[ <a href=\"modules.php?name=Your_Account&op=new_user\">"._UMREG."</a> ]\n";
	$content .= "</td></tr></table>\n";
	$content .= "</form>\n";
}
$num_users = newusers();
$last = lastuser();
$users = useronline();
$lastuid = lastuserid();
$content .= "<hr><strong>"._BMEMP.":</strong><br />\n";
$content .= "&nbsp;&nbsp;"._BLATEST.": <a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$lastuid\" title=\""._UMVIEWUSER." $last\"><strong>$last</strong></a><br />\n";
$content .= "&nbsp;&nbsp;"._BTD.": <strong>$num_users[0]</strong><br />\n";
$content .= "&nbsp;&nbsp;"._BYD.": <strong>$num_users[1]</strong><br />\n";
$content .= "&nbsp;&nbsp;"._BOVER.": <strong>".num_users()."</strong><br />\n<hr>\n";
$content .= "<strong>"._UMONLINE." [$users[2]]:</strong>\n<br />\n";
$content .= "&nbsp;&nbsp;"._BVIS.": <strong>$users[1]</strong><br />\n";
$content .= "&nbsp;&nbsp;"._BMEM.": <strong>$users[0]</strong>\n";
if ($Show_Online == 1) {
	$content .= "<hr>\n <strong>"._UMON."</strong><br />$who_online $users[3]";
}
if ($Show_Hits == 1) {
	$content .= pageview();
}
if (is_user($user)) {
	$content .= "<hr><center><a href=\"modules.php?name=Your_Account&amp;op=logout\"> <strong>"._UMBEXIT."</strong></a></center>";
}
if (is_admin($admin)) {
	$content .= "<hr><center><a href=\"admin.php?op=logout\"> <strong>"._UMBADMINEXIT."</strong></a></center>";
}
$content .= "<hr>";
?>
