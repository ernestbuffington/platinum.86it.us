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
define('ADMIN_FILE', true);
require_once("mainfile.php");
if(isset($aid)) {
  if($aid AND (!isset($admin) OR empty($admin)) AND $op != 'login') {
    unset($aid);
    unset($admin);
    die('Access Denied');
  }
}
get_lang('admin');
function create_first($name, $url, $email, $pwd, $user_new) {
    global $prefix, $db, $user_prefix;
    $first = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_authors"));
    if ($first == 0) {
		$pwd = md5($pwd);
		$the_adm = "God";
		$email = validate_mail($email);
/* F */
		$db->sql_query("INSERT INTO ".$prefix."_authors (aid, name, url, email, pwd, counter, radminsuper, admlanguage, radminblocker) VALUES ('$name', '$the_adm', '$url', '$email', '$pwd', '0', '1', '', '0')");
/* F */
		if ($user_new == 1) {
		    $user_regdate = date("M d, Y");
		    $user_avatar = "gallery/blank.gif";
		    $commentlimit = 4096;
		    if ($url == "http://") { $url = ""; }
	            $db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_website, user_avatar, user_regdate, user_password, theme, commentmax, user_level, user_lang, user_dateformat) VALUES (NULL,'$name','$email','$url','$user_avatar','$user_regdate','$pwd','$Default_Theme','$commentlimit', '2', 'english','D M d, Y g:i a')");
		}
		login();
    }
}
global $admin_file;
$the_first = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_authors"));
if ($the_first == 0) {
    if (!$name) {
	    include_once("header.php");
	    title("$sitename: "._ADMINISTRATION."");
	    OpenTable();
	    echo "<center><strong>"._NOADMINYET."</strong></center><br /><br />"
			."<form action=\"".$admin_file.".php\" method=\"post\">"
			."<table border=\"0\">"
			."<tr><td><strong>"._NICKNAME.":</strong></td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"25\"></td></tr>"
			."<tr><td><strong>"._HOMEPAGE.":</strong></td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"255\" value=\"http://\"></td></tr>"
			."<tr><td><strong>"._EMAIL.":</strong></td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"255\"></td></tr>"
			."<tr><td><strong>"._PASSWORD.":</strong></td><td><input type=\"password\" name=\"pwd\" size=\"20\" maxlength=\"40\"></td></tr>"
			."<tr><td colspan=\"2\">"._CREATEUSERDATA."  <input type=\"radio\" name=\"user_new\" value=\"1\" checked>"._YES."&nbsp;&nbsp;<input type=\"radio\" name=\"user_new\" value=\"0\">"._NO."</td></tr>"
			."<tr><td><input type=\"hidden\" name=\"fop\" value=\"create_first\">"
			."<input type=\"submit\" value=\""._SUBMIT."\">"
			."</td></tr></table></form>";
	    CloseTable();
	    include_once("footer.php");
    }
    switch($fop) {
		case "create_first":
		create_first($name, $url, $email, $pwd, $user_new);
	break;
    }
    die();
}
if (isset($aid) && (preg_match("/[^a-zA-Z0-9_-]/",trim($aid)))) {
    die("Begone");
}
if (isset($aid)) { $aid = substr($aid, 0,25);}
if (isset($pwd)) { $pwd = substr($pwd, 0,40);}
if ((isset($aid)) && (isset($pwd)) && (isset($op)) && ($op == "login")) {
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    if (!isset($gfx_check)) {$gfx_check = '';}
    if (!security_code_check($gfx_check, array(1,5,6,7))) {
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	Header("Location: ".$admin_file.".php");
	die();
    }
    if(!empty($aid) && !empty($pwd)) {
	$pwd = md5($pwd);
        $result = $db->sql_query("SELECT pwd, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'");
	$row = $db->sql_fetchrow($result);
        $admlanguage = addslashes($row['admlanguage']);
        $rpwd = $row['pwd'];
	if($rpwd == $pwd) {
	    $admin = base64_encode("$aid:$pwd:$admlanguage");
	    setcookie("admin",$admin,time()+2592000);
	    unset($op);
	}
    }
}
$admintest = 0;
if(isset($admin) && !empty($admin)) {
  $admin = addslashes(base64_decode($admin));
  $admin = explode(":", $admin);
  $aid = addslashes($admin[0]);
  $pwd = $admin[1];
  $admlanguage = $admin[2];
  if (empty($aid) OR empty($pwd)) {
    $admintest=0;
    echo "<html>\n";
    echo "<title>INTRUDER ALERT!!!</title>\n";
    echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n<br /><br /><br />\n\n";
    echo "<center><img src=\"images/eyes.gif\" border=\"0\"><br /><br />\n";
    echo "<font face=\"Verdana\" size=\"+4\"><strong>Get Out!</strong></font></center>\n";
    echo "</body>\n";
    echo "</html>\n";
    exit;
  }
  $aid = substr("$aid", 0,25);
  $result2 = $db->sql_query("SELECT name, pwd FROM ".$prefix."_authors WHERE aid='$aid'");
  if (!$result2) {
        echo "Selection from database failed!";
        exit;
  } else {
    $row2 = $db->sql_fetchrow($result2);
    $rpwd = $row2['pwd'];
    if($rpwd == $pwd && !empty($rpwd)) {
        $admintest = 1;
    }
  }
}

if(!isset($op)) { $op = "adminMain"; }
if(isset($op) AND ($op == "mod_authors" OR $op == "modifyadmin" OR $op == "UpdateAuthor" OR $op == "AddAuthor" OR $op == "deladmin2" OR $op == "deladmin" OR $op == "assignstories" OR $op == "deladminconf") AND ($row2['name'] != "God")) {
  die("Illegal Operation");
}
$pagetitle = "- "._ADMINMENU."";
/*********************************************************/
/* Login Function                                        */
/*********************************************************/
function login() {
    global $gfx_chk, $admin_file;
    include_once('header.php');
    OpenTable();
    echo '<center><font class="title"><strong>'._ADMINLOGIN.'</strong></font></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    echo '<form action="'.$admin_file.'.php" method="post">'
        .'<table border="0">'
		.'<tr><td>'._ADMINID.'</td>'
		.'<td><input type="text" name="aid" size="20" maxlength="25" /></td></tr>'
		.'<tr><td>'._PASSWORD.'</td>'
		.'<td><input type="password" name="pwd" size="20" maxlength="40" /></td></tr>';
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    echo security_code(array(1,5,6,7), 'normal');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
		echo '<tr><td><input type="hidden" name="op" value="login" />'
		.'<input type="submit" value="'._LOGIN.'" />'
		.'</td></tr></table>'
		.'</form>';
    CloseTable();
    include_once('footer.php');
}
function deleteNotice($id) {
    global $prefix, $db, $admin_file;
    $id = intval($id);
    $db->sql_query("DELETE FROM ".$prefix."_reviews_add WHERE id = '$id'");
    Header("Location: ".$admin_file.".php?op=reviews");
}
/*********************************************************/
/* Administration Menu Function                          */
/*********************************************************/
function adminmenu($url, $title, $image) {
    global $counter, $admingraphic, $Default_Theme;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/admin/$image")) {
		$image = "themes/$ThemeSel/images/admin/$image";
    } else {
		$image = "images/admin/$image";
    }
    if ($admingraphic == 1) {
		$img = "<img src=\"$image\" border=\"0\" alt=\"$title\" title=\"$title\"></a><br />";
		$close = "";
    } else {
		$img = "";
		$close = "</a>";
    }
    echo "<td align=\"center\" valign=\"top\" width=\"16%\"><font class=\"content\"><a href=\"$url\">$img<strong>$title</strong>$close<br /><br /></font></td>";
    if ($counter == 5) {
		echo "</tr><tr>";
		$counter = 0;
    } else {
		$counter++;
    }
}
function GraphicAdmin() {
    global $aid, $admingraphic, $language, $admin, $prefix, $db, $counter, $admin_file;
    $newsubs = $db->sql_numrows($db->sql_query("SELECT qid FROM ".$prefix."_queue"));
/* F */
    $row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper,radminblocker FROM ".$prefix."_authors WHERE aid='$aid'"));
    $radminsuper = intval($row['radminsuper']);
    $radminblocker = intval($row['radminblocker']);
    if ($radminsuper == 1 or $radminblocker == 1) {
/* F */
	    OpenTable();
	    echo "<center><a href=\"".$admin_file.".php\"><font class='title'>"._ADMINMENU."</font></a>";
	    echo "<br /><br />";
	    echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
	    $linksdir = dir("admin/links");
	    $menulist = "";
	    while($func=$linksdir->read()) {
	        if(substr($func, 0, 6) == "links.") {
	    	    $menulist .= "$func ";
			}
	    }
	    closedir($linksdir->handle);
	    $menulist = explode(" ", $menulist);
	    sort($menulist);
	    for ($i=0; $i < sizeof($menulist); $i++) {
			if(!empty($menulist[$i])) {
		    	$sucounter = 0;
		    	include_once($linksdir->path."/$menulist[$i]");
			}
	    }
	    adminmenu("".$admin_file.".php?op=logout", ""._ADMINLOGOUT."", "logout.gif");
		echo"</tr></table></center>";
		$counter = "";
    	CloseTable();
    	echo "<br />";
	}
    OpenTable();
    echo "<center><a href=\"".$admin_file.".php\"><font class='title'>"._MODULESADMIN."</font></a>";
    echo "<br /><br />";
    echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
    $handle=opendir('modules');
    $modlist = "";
    while ($file = readdir($handle)) {
		if ( (!preg_match("/[.]/",$file)) ) {
			$modlist .= "$file ";
		}
    }
    closedir($handle);
    $modlist = explode(" ", $modlist);
    sort($modlist);
    for ($i=0; $i < sizeof($modlist); $i++) {
		if(!empty($modlist[$i])) {
	    	$row = $db->sql_fetchrow($db->sql_query("SELECT mid from " . $prefix . "_modules where title='$modlist[$i]'"));
	    	$mid = intval($row['mid']);
	    	if (empty($mid)) {
				$db->sql_query("insert into " . $prefix . "_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '1', '0', '')");
	    	}
		}
    }
	$result = $db->sql_query("SELECT title, admins FROM ".$prefix."_modules ORDER BY title ASC");
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'"));
	while ($row = $db->sql_fetchrow($result)) {
		$admins = explode(",", $row['admins']);
		$auth_user = 0;
		for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
				$auth_user = 1;
			}
		}
		if ($radminsuper == 1 OR $auth_user == 1) {
			if (file_exists("modules/".$row['title']."/admin/index.php") AND file_exists("modules/".$row['title']."/admin/links.php") AND file_exists("modules/".$row['title']."/admin/case.php")) {
							include_once("modules/".$row['title']."/admin/links.php");
			}
		}
	}
    adminmenu("".$admin_file.".php?op=logout", ""._ADMINLOGOUT."", "logout.gif");
    echo"</tr></table></center>";
    CloseTable();
    echo "<br />";
}
/*********************************************************/
/* Administration Main Function                          */
/*********************************************************/
function adminMain() {
    global $language, $admin, $aid, $prefix, $file, $db, $sitename, $user_prefix, $admin_file, $bgcolor2, $bgcolor1, $textcolor1, $textcolor2;
    include_once("header.php");
    $dummy = 0;
    $month = date('M');
    $curDate2 = "%".$month[0].$month[1].$month[2]."%".date('d')."%".date('Y')."%";
    $ty = time() - 86400;
    $preday = strftime('%d', $ty);
    $premonth = strftime('%B', $ty);
    $preyear = strftime('%Y', $ty);
    $curDateP = "%".$premonth[0].$premonth[1].$premonth[2]."%".$preday."%".$preyear."%";
    GraphicAdmin();
    $aid = substr("$aid", 0,25);
    $row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper, admlanguage FROM ".$prefix."_authors WHERE aid='$aid'"));
    $radminsuper = intval($row['radminsuper']);
        $admlanguage = addslashes($row['admlanguage']);
    $result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='News'");
    $result2 = $db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$aid'");
    list($aidname) = $db->sql_fetchrow($result2);
	$radminarticle = 0;
	while (list($admins) = $db->sql_fetchrow($result)) {
		$admins = explode(",", $admins);
		$auth_user = 0;
		for ($i=0; $i < sizeof($admins); $i++) {
			if ($aidname == $admins[$i]) {
				$auth_user = 1;
			}
		}
		if ($auth_user == 1) {
			$radminarticle = 1;
		}
	}
    if (!empty($admlanguage) ) {
		$queryalang = "WHERE alanguage='$admlanguage' ";
    } else {
		$queryalang = "";
    }
    echo "<br />";
    list($main_module) = $db->sql_fetchrow($db->sql_query("SELECT main_module from ".$prefix."_main"));
    OpenTable();
    echo "<center><strong>$sitename: "._DEFHOMEMODULE."</strong><br /><br />"
		.""._MODULEINHOME." <strong>$main_module</strong><br />[ <a href=\"".$admin_file.".php?op=modules\">"._CHANGE."</a> ]</center>";
    CloseTable();
    echo "<br />";
    OpenTable();
    $guest_online_num = intval($db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='1'")));
    $member_online_num = intval($db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='0'")));
    $who_online_num = $guest_online_num + $member_online_num;
    $who_online = "<center><font class=\"option\">"._WHOSONLINE."</font><br /><br /><font class=\"content\">"._CURRENTLY." $guest_online_num "._GUESTS." $member_online_num "._MEMBERS."<br />";
    list($userCount) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount from ".$user_prefix."_users WHERE user_regdate LIKE '$curDate2'"));
    list($userCount2) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(user_id) AS userCount FROM ".$user_prefix."_users WHERE user_regdate LIKE '$curDateP'"));
    echo "<center>$who_online<br />"
		.""._BTD.": <strong>$userCount</strong> - "._BYD.": <strong>$userCount2</strong></center>";
    CloseTable();
    if (is_active("News")) {
    echo "<br />";
    OpenTable();
    echo "<center><strong>"._AUTOMATEDARTICLES."</strong></center><br />";
    $count = 0;
    $result5 = $db->sql_query("SELECT anid, aid, title, time, alanguage FROM ".$prefix."_autonews $queryalang ORDER BY time ASC");
     while (list($anid, $aid, $listtitle, $time, $alanguage) = $db->sql_fetchrow($result5)) {
 		$anid = intval($anid);
 		$said = substr($aid, 0,25);
 		$title = $listtitle;
		if (empty($alanguage)) {
		    $alanguage = ""._ALL."";
		}
		if (!empty($anid)) {
		    if ($count == 0) {
				echo "<table border=\"1\" width=\"100%\">";
				$count = 1;
		    }
		    $time = str_replace(" ", "@", $time);
		    if (($radminarticle == 1) OR ($radminsuper == 1)) {
				if (($radminarticle == 1) AND ($aid == $said) OR ($radminsuper == 1)) {
	    			echo "<tr><td nowrap>&nbsp;(<a href=\"".$admin_file.".php?op=autoEdit&amp;anid=$anid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=autoDelete&amp;anid=$anid\">"._DELETE."</a>)&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
				} else {
			    	echo "<tr><td>&nbsp;("._NOFUNCTIONS.")&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
				}
		    } else {
				echo "<tr><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
		    }
		}
    }
    if ((empty($anid)) AND ($count == 0)) {
		echo "<center><i>"._NOAUTOARTICLES."</i></center>";
    }
    if ($count == 1) {
        echo "</table>";
    }
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><strong>"._LAST." 20 "._ARTICLES."</strong></center><br />";
    $result6 = $db->sql_query("SELECT sid, aid, title, time, topic, informant, alanguage FROM ".$prefix."_stories $queryalang ORDER BY time DESC LIMIT 0,20");
    echo "<center><table border=\"1\" width=\"100%\" bgcolor=\"$bgcolor1\">";
    while (list($sid, $aid, $title, $time, $topic, $informant, $alanguage) = $db->sql_fetchrow($result6)) {
		$sid = intval($sid);
		$said = substr($aid, 0,25);
		list($topicname) = $db->sql_fetchrow($db->sql_query("SELECT topicname FROM ".$prefix."_topics WHERE topicid='$topic'"));
		if (empty($alanguage)) {
		    $alanguage = ""._ALL."";
		}
		formatTimestamp($time);
		echo "<tr><td align=\"right\"><strong>$sid</strong>"
		    ."</td><td align=\"left\" width=\"100%\"><a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a>"
		    ."</td><td align=\"center\">$alanguage"
		    ."</td><td align=\"right\">$topicname";
		if ($radminarticle == 1 OR $radminsuper == 1) {
		    if (($radminarticle == 1) AND ($aid == $said) OR ($radminsuper == 1)) {
				echo "</td><td align=\"right\" nowrap>(<a href=\"".$admin_file.".php?op=EditStory&amp;sid=$sid\">"._EDIT."</a>-<a href=\"".$admin_file.".php?op=RemoveStory&amp;sid=$sid\">"._DELETE."</a>)"
			    	."</td></tr>";
		    } else {
				echo "</td><td align=\"right\" nowrap><font class=\"content\"><i>("._NOFUNCTIONS.")</i></font>"
			    	."</td></tr>";
		    }
		} else {
		    echo "</td></tr>";
		}
    }
    echo "</table>";
    if (($radminarticle == 1) OR ($radminsuper == 1)) {
	echo "<center>"
	    ."<form action=\"".$admin_file.".php\" method=\"post\">"
	    .""._STORYID.": <input type=\"text\" NAME=\"sid\" SIZE=\"10\">"
	    ."<select name=\"op\">"
	    ."<option value=\"EditStory\" SELECTED>"._EDIT."</option>"
	    ."<option value=\"RemoveStory\">"._DELETE."</option>"
	    ."</select>"
	    ."<input type=\"submit\" value=\""._GO."\">"
	    ."</form></center>";
    }
    CloseTable();
    }
	if (is_active("Surveys")) {
    list($pollID, $pollTitle) = $db->sql_fetchrow($db->sql_query("SELECT pollID, pollTitle FROM ".$prefix."_poll_desc WHERE artid='0' ORDER BY pollID DESC LIMIT 1"));
    $pollID = intval($pollID);
    echo "<br />";
    OpenTable();
    echo "<center><strong>"._CURRENTPOLL.":</strong> $pollTitle [ <a href=\"".$admin_file.".php?op=polledit&amp;pollID=$pollID\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=create\">"._ADD."</a> ]</center>";
    CloseTable();
    }
    unset($title);
    include_once("footer.php");
}
function not_deleted($text) {
    include_once("header.php");
    OpenTable();
    echo "<center><font size=4 color=red>".$text."</center></font>";
    CloseTable();
    include_once("footer.php");
    die();
}
if($admintest) {
    switch($op) {
	case 'do_gfx':
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        gen_old_gfx();
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
	break;
	case "deleteNotice":
	deleteNotice($id);
	break;
	case "GraphicAdmin":
        GraphicAdmin();
        break;
	case "adminMain":
	adminMain();
	break;
	case "logout":
		setcookie("admin", false);
		$admin = "";
		include_once("header.php");
		OpenTable();
		echo "<center><font class=\"title\"><strong>"._YOUARELOGGEDOUT."</strong></font></center>";
		CloseTable();
		Header("Refresh: 3; url=".$admin_file.".php");
		include_once("footer.php");
	break;
	case "login";
	unset($op);
	default:
      if (!is_admin($admin)) {
          login();
      }
	$casedir = dir("admin/case");
	while($func=$casedir->read()) {
	    if(substr($func, 0, 5) == "case.") {
			include_once($casedir->path."/$func");
	    }
	}
	closedir($casedir->handle);
	$result = $db->sql_query("SELECT title FROM ".$prefix."_modules ORDER BY title ASC");
	while (list($mod_title) = $db->sql_fetchrow($result)) {
		if (file_exists("modules/$mod_title/admin/index.php") AND file_exists("modules/$mod_title/admin/links.php") AND file_exists("modules/$mod_title/admin/case.php")) {
		include_once("modules/$mod_title/admin/case.php");
		}
	}
	break;
	}
} else {
    switch($op) {
	default:
	login();
	break;
    }
}
?>