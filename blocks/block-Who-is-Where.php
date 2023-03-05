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
define('_MIN','&#039; ');
define('_SEC','&quot;');
if ($lang=='french') {
	define("_MEMBRES","Membres ");
	define("_VISITEURS","Visiteurs ");
	define("_VISITEUR","Visiteur ");
} else if ($lang=='russian') {
	define("_MEMBRES","Члены");
	define("_VISITEURS","Посетители");
	define("_VISITEUR","Посетители");
} else if ($lang=='spanish') {
	define("_MEMBRES","Miembro");
	define("_VISITEURS","Visitante");
	define("_VISITEUR","Visitantes");
} else if ($lang=='italian') {
	define("_MEMBRES","Membri");
	define("_VISITEURS","Ospiti");
	define("_VISITEUR","Ospite");
} else if ($lang=='portuguese') {
	define("_MEMBRES","Miembro");
	define("_VISITEURS","Visitantes");
	define("_VISITEUR","Visitante");
} else {
	define("_MEMBRES","Members");
	define("_VISITEURS","Visitors");
	define("_VISITEUR","Visitor");
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
