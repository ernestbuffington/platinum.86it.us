<?php
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
$usemarquee = 1;
$scrolldirection = 'Up';
$content = '';
global $admin, $admin_file, $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $name, $lang;
//
// language system
//
define_once('_MIN','&#039; ');
define_once('_SEC','&quot;');
if ($lang=='french') {
	define_once("_MEMBRES","Membres ");
	define_once("_VISITEURS","Visiteurs ");
	define_once("_VISITEUR","Visiteur ");
} else if ($lang=='russian') {
	define_once("_MEMBRES","Члены");
	define_once("_VISITEURS","Посетители");
	define_once("_VISITEUR","Посетители");
} else if ($lang=='spanish') {
	define_once("_MEMBRES","Miembro");
	define_once("_VISITEURS","Visitante");
	define_once("_VISITEUR","Visitantes");
} else if ($lang=='italian') {
	define_once("_MEMBRES","Membri");
	define_once("_VISITEURS","Ospiti");
	define_once("_VISITEUR","Ospite");
} else if ($lang=='portuguese') {
	define_once("_MEMBRES","Miembro");
	define_once("_VISITEURS","Visitantes");
	define_once("_VISITEUR","Visitante");
} else {
	define_once("_MEMBRES","Members");
	define_once("_VISITEURS","Visitors");
	define_once("_VISITEUR","Visitor");
}
//
// Init
//
$who_online[0] = "";
$who_online[1] = "";
$num[0] = 1;
$num[1] = 1;
/**
 * function that displays 
 * int timeSec : time in seconds
 * @return String timeDisplay
 */
function displayTime($sec) {
	$minutes = floor($sec / 60);
	$seconds = $sec % 60;
	if ($minutes == 0) {
		return $seconds . _SEC;
	}
	return $minutes . _MIN . $seconds . _SEC;
}
//
// Query
//
$result = $db->sql_query("SELECT w.username, w.guest, w.module, w.url, u.user_color_gc FROM ".$prefix."_whoiswhere AS w LEFT JOIN ".$prefix."_users AS u ON u.username = w.username ORDER BY u.username DESC");
//$result = $db->sql_query("select username, guest, module, url, UNIX_TIMESTAMP(now())-time AS time from ".$prefix."_whoiswhere order by username");
$member_online_num  = $db->sql_numrows($result);
//
// Display Section
//
while ($session = $db->sql_fetchrow($result)) {
	//--- guest can only be 0 or 1
	if(preg_match("/".$admin_file.".php/", $session['url']))
			{
			$session['module'] = "Admin";
			$session['url'] = "index.php";
			}
	$guest = $session["guest"];
	if ($num[$guest] < 10) {
		$who_online[$guest] .= "0";
	}	
	$username_color = UsernameColor($session['user_color_gc'],$session['username']);
	if ($guest == 0) {
		if (!isset($session['time']))
		$session['time'] = time();
		$title = "<A HREF=\"modules.php?name=Your_Account&op=userinfo&username=$session[username]\" title=\"" . displayTime($session['time']) . "\">$username_color</a>";
	} else {
		//--- Anonymous user
		if (isset($admin)) {
			$title = '<A title="' . displayTime($session['time']) . "\">$session[username]</a>";
		} else {
			$title = '<A title="' . displayTime($session['time']) . '">' . _VISITEUR . '</a>';
		}
	}
	$who_online[$guest] .= "$num[$guest]:&nbsp;$title -&gt; <a href=\"$session[url]\" target=\"_blank\">$session[module]</a><br />\n";
	$num[$guest]++;
}
//--- Members
if ($who_online[0] != "") {
	$content = "<img src=\"images/Who-is-Where/members.gif\">&nbsp;<span class=\"content\"><strong>"._MEMBRES.":</strong></span><br />$who_online[0]<br />";
}
//--- Anonymous
if ($who_online[1] != "") {
$content .= "<hr><br /><img src=\"images/Who-is-Where/visitors.gif\">&nbsp;<span class=\"content\"><strong>"._VISITEURS.":</strong><br /></span>";
$content .= '<marquee behavior="Scroll" direction="'.$scrolldirection.'" height="150" scrollamount="1" scrolldelay="75" onmouseover="this.stop()" onmouseout="this.start()"><br />';
$content .= "<br />$who_online[1]\n";
$content .= '</marquee>';
}
?>
