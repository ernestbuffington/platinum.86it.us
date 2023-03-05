<?php
/************************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0	*/
/* Written by: Jonathan Estrella				*/
/* http://slaytanic.sf.net						*/
/* Copyright (c) 2004-2008 Jonathan Estrella	*/
/************************************************/

if (!defined('IN_CPM')) {
	die('You can\'t access this file directly...');
}

require_once('mainfile.php');
$pagetitle = '- '._CP_RECOMMEND;

switch($op) {
    case 'SendPage': SendPage($pid); break;
    case 'FriendSend': FriendSend($pid); break;
}

function FriendSend($pid) {
global $user, $cookie, $prefix, $db, $user_prefix, $module_name;
	$sid = intval($pid);
	if(!isset($pid)) { exit(); }
	include_once('header.php');
	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\''));
	$title = $row['title'];
	cpheader();
	OpenTable();
	echo '<center><span class="content"><strong>'._CP_FRIEND.'</strong></span></center><br /><br />'.PHP_EOL;
	echo _CP_YOUSENDSTORY.' <strong>'.$title.'</strong> '._CP_TOAFRIEND.'<br /><br />'.PHP_EOL;
	echo '<form action="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=SendPage&amp;pid='.$pid.'" method="post">'.PHP_EOL;
	if (is_user($user)) {
		$row2 = $db->sql_fetchrow($db->sql_query('SELECT name, user_email FROM '.$user_prefix.'_users WHERE username=\''.$cookie[1].'\''));
		$yn = $row2['name'];
		$ye = $row2['user_email'];
	} else {
		$yn = '';
		$ye = '';
	}
	echo '<strong>'._CP_FYOURNAME.' </strong> <input type="text" name="yname" value="'.$yn.'" /><br /><br />'.PHP_EOL;
	echo '<strong>'._CP_FYOUREMAIL.' </strong> <input type="text" name="ymail" value="'.$ye.'" /><br /><br /><br />'.PHP_EOL;
	echo '<strong>'._CP_FFRIENDNAME.' </strong> <input type="text" name="fname" /><br /><br />'.PHP_EOL;
	echo '<strong>'._CP_FFRIENDEMAIL.' </strong> <input type="text" name="fmail" /><br /><br />'.PHP_EOL;
	echo '<input type="submit" value="'._CP_SEND.'" />'.PHP_EOL;
	echo '</form>'.PHP_EOL;
    CloseTable();
    include_once('footer.php');
}

function SendPage($pid) {
global $sitename, $slogan, $nukeurl, $prefix, $db, $module_name;
    $fname = removecrlf($_POST['fname']);
    $fmail = removecrlf($_POST['fmail']);
    $yname = removecrlf($_POST['yname']);
    $ymail = removecrlf($_POST['ymail']);
    $pid = intval($pid);

    if(!empty($fname) && !empty($fmail) && !empty($yname) && !empty($yname)) {
    	$mypage = $db->sql_fetchrow($db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\''));
   		$mytitle = $mypage['title'];
    	$mytext = $mypage['text'];
    	//$mytext = preg_replace('<!--pagebreak-->', '<br /><br /<', $mytext);
    	$mytext = str_replace('[--pagebreak--]', '<br /><br />', $mytext);
		$mytext = substr($mytext, 0, 1000);
		$mytext = check_html($mytext, 'nohtml');
    	$subject = _CP_INTERESTING.' '.$sitename;
    	$message = _CP_HELLO.' '.$fname.':<br />'.PHP_EOL;
		$message.= _CP_YOURFRIEND.' '.$yname.' '._CP_CONSIDERED.'<br /><br />'.PHP_EOL;
		$message.= '<strong>'.$mytitle.'</strong><br /><br />'.PHP_EOL;
		$message.= $mytext.'...<br /><br />'.PHP_EOL;
		$message.= _CP_CPREADMORE.' (<a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'</a> )<br /><br /><br />'.PHP_EOL;
		$message.= _CP_YOUCANREAD.' '.$sitename.': '.$slogan.'<br /><a href="'.$nukeurl.'">'.$nukeurl.'</a>'.PHP_EOL;
		$xheaders = 'From: '.$yname.' <'.$ymail.'>'.PHP_EOL;
		$xheaders.= 'X-Sender: <'.$ymail.'>'.PHP_EOL;
		$xheaders.= 'X-Mailer: PHP'.PHP_EOL; // mailer
		$xheaders.= 'X-Priority: 6'.PHP_EOL; // Urgent message!
		$xheaders.= 'Content-Type: text/html; charset=iso-8859-1'.PHP_EOL; // Mime type
		$params = array('html'=> 1); // Activate HTML mode for TegoNuke Mailer
    	if(defined('PNM_IS_ACTIVE')) {
			phpnukemail($fmail, $subject, $message, $ymail, $yname, $encode=1);
		} elseif(defined('TNML_IS_ACTIVE')) {
			tnml_fMailer($fmail, $subject, $message, $ymail, $yname, $params);
    	} else {
			mail($fmail, $subject, $message, $xheaders);
    	}
    	include_once('header.php');
   		cpheader();
    	OpenTable();
   		echo '<center>'._CP_FSTORY.' <strong>'.$mytitle.'</strong>'.PHP_EOL;
		echo ''._CP_HASSENT.' <strong>'.$fname.'</strong><br /><br />'.PHP_EOL;
		echo ''._CP_THANKS.'</center><br /><br />'.PHP_EOL;
    	CloseTable();
    	include_once('footer.php');
	} else {
		include_once('header.php');
   		cpheader();
    	OpenTable();
   		echo '<center>'._CP_FRIENDERROR.'<br /><br />'.PHP_EOL;
   		echo '<a href="javascript: history.go(-1)">'._CP_GOBACK.'</a>'.PHP_EOL;
    	CloseTable();
    	include_once('footer.php');
	}
}
?>