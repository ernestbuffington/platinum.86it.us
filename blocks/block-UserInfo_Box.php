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
/************************************************************************/
/* Tableless CSS Sprite Powered Info Box for RNv2.4+                    */
/* Based on Info Box for RavenNuke by nukecoder.com                     */
/* Intended for use on RavenNuke(tm) v2.4+                              */
/*********************************************************************************************************/
/* Setup - Use these settings to control how some of the user info block displays to users/admins.       */
/*********************************************************************************************************/
$recent_member_count = 6; // how many newest members to show
$nameMaxLength       = 13; //Max length for username display.  Will truncate with ....
$max_session_mins    = 60; // how long before inactive uses are dropped from online list
$max_display_guests  = 10; // maximum number of guests to display
$max_display_members = 10; // maximum number of members to display
$LargeSectionIcons   = true; // use 32x32 icons for the sections
$show_guest_list     = true; // show online guests IP in online list
$show_guest_guest    = true; // show online guests to anonymous users FALSE=display to user only (if $show_guest_list = true)
$showonlinecount     = true; // small text showing total count of online guests/members (not affected by max diplay above)
$pm_colorbox_notice  = true; // if set to true, users will only be notified of private messages once per session
$UsemodalLogin       = false; // modal login popup - nukeNAV module must be ACTIVE!
$UseSearchPopUp      = true; // modal search popup - nukeNAV and Search modules must be ACTIVE!
$whoisUseModal       = true; //admin ip lookup in modal window
$whoisServerString   = 'www.dnsstuff.com/tools/whois/?ip='; //admin ip lookup
/*********************************************************************************************************/
/* Sprite Settings - For info see the included readme file                                               */
/*********************************************************************************************************/
$IBtran          = 'images/transparent.gif'; // source for the transparent gif sprite container
$IBicon          = 'IBicon8'; // default classes for icons (changed by theme below unless $MultiThemeMode = false) 
$rnIBicon        = 'rnIBicon'; // default classes for icons (changed by theme below unless $MultiThemeMode = false) 
$MultiThemeMode  = true; // false to disable loading theme specific icons, and ignore array settings below - see readme
$rnIBWhite       = array('3D-Fantasy', 'DeepBlue', 'ExtraLite', 'NukeNews', 'Slash', 'SlashOcean', 'Traditional'); // Themes with white block backgrounds
$rnIBGray        = array('Anagram', 'Karate', 'Milo', 'PNP_WB'); // Themes with white block backgrounds
$rnIBCreme       = array('Sunset'); // Themes with creme block backgrounds
$rnIBSimplyBlue  = array('SimplyBlue'); // Themes with sky blue block backgrounds
$rnIBSandJourney = array('Sand_Journey'); // Themes with sand block backgrounds
$rnIBBlueBlog    = array('Blue_Blog'); // Themes with taupe block backgrounds
$rnIBCTRN        = array('CT_RN'); // Themes with crimson backgrounds
$rnIBRavenIce    = array('RavenIce', 'fisubice'); // Themes with off-white/blue block backgrounds
$rnIBKaput       = array('Kaput', 'Impressed_II'); // Themes with blue/gray block backgrounds
$rnIBBlack       = array('BB_CFiber'); // Themes with black block backgrounds
$rnIBExtra       = array(); // An extra group for other themes (use class rnIBExtra and IBExtra to define your sprite background - see readme)
/*********************************************************************************************************/
/* You should not need to modify anything below this line                                                */
/*********************************************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
global $db, $prefix, $ya_config, $anonymous, $user_prefix, $user, $sitekey, $gfx_chk, $admin;
include_once 'modules/Your_Account/includes/functions.php';
if (!isset($ya_config)) $ya_config = ya_get_configs();
if ($MultiThemeMode){
	$ThemeSel = get_theme();
	if (in_array($ThemeSel, $rnIBWhite)) {$rnIBicon = 'rnIBWhite';$IBicon = 'IBWhite';}
	else if (in_array($ThemeSel, $rnIBGray)) {$rnIBicon = 'rnIBGray';$IBicon = 'IBGray';}
	else if (in_array($ThemeSel, $rnIBCreme)) {$rnIBicon = 'rnIBCreme';$IBicon = 'IBCreme';}
	else if (in_array($ThemeSel, $rnIBSimplyBlue)) {$rnIBicon = 'rnIBSimplyBlue';$IBicon = 'IBSimplyBlue';}
	else if (in_array($ThemeSel, $rnIBSandJourney)) {$rnIBicon = 'rnIBSandJourney';$IBicon = 'IBSandJourney';}
	else if (in_array($ThemeSel, $rnIBBlueBlog)) {$rnIBicon = 'rnIBBlueBlog';$IBicon = 'IBBlueBlog';}
	else if (in_array($ThemeSel, $rnIBCTRN)) {$rnIBicon = 'rnIBCT-RN';$IBicon = 'IBCT-RN';}
	else if (in_array($ThemeSel, $rnIBRavenIce)) {$rnIBicon = 'rnIBRavenIce';$IBicon = 'IBRavenIce';}
	else if (in_array($ThemeSel, $rnIBKaput)) {$rnIBicon = 'rnIBKaput';$IBicon = 'IBKaput';}
	else if (in_array($ThemeSel, $rnIBBlack)) {$rnIBicon = 'rnIBBlack';$IBicon = 'IBBlack';}
	else if (in_array($ThemeSel, $rnIBExtra)) {$rnIBicon = 'rnIBExtra';$IBicon = 'IBExtra';}
	else {$rnIBicon = 'rnIBicon';$IBicon = 'IBicon8';}
}
	// large section icons (not theme specific - enable above)
	if ($LargeSectionIcons) {$IBadjust = 'LG';$IBicon = 'IBBigIcons';}else{$IBadjust = '';}
	// borrowed nukeNAV lang defines - uncomment if needed
	if (!defined('_NAV_YOURPOSTS')) define('_NAV_YOURPOSTS','Your Forum Posts');
	// borrowed lang defines for PNPv1 - uncomment if needed	
	if (!defined('_SERDT')) define('_SERDT','Server Date/Time');
	if (!defined('_FSIYOURACCOUNT')) define('_FSIYOURACCOUNT','Your Account');
	if (!defined('_ALT_CHKPROFILE')) define('_ALT_CHKPROFILE','Check Profile of:');
	if (!defined('_WAITLINK')) define('_WAITLINK','Waiting');
	if (!defined('_YOURIP')) define('_YOURIP','Your IP:');
	if (!defined('_TTL_RESENDEMAIL')) define('_TTL_RESENDEMAIL','Re-Send Email');	
	if (!defined('_PASSWORDLOST')) define('_PASSWORDLOST','Forgot Password');		
	if (!defined('_NAV_CHGTHEME')) define('_NAV_CHGTHEME','Change Theme');
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $yourip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $yourip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $yourip=$_SERVER['REMOTE_ADDR'];
    }
$content = '<!-- Start Info -->
<div id="IBblock">
';
// get user info/show login
if (is_user($user))
{
  $uinfo = cookiedecode($user);
  $content .= '<div class="IBinfosection" id="IBsection1">
  <div><a href="modules.php?name=Your_Account&amp;op=edituser" class="IBuser' . $IBadjust . '" title="' . _FSIYOURACCOUNT . '"><img src="' . $IBtran . '" class="' . $IBicon . '" alt="' . _FSIYOURACCOUNT . '" /><span class="IBtextpad">'. $uinfo[1] .'</span></a></div>
<ul class="rninfobox">
';
  $content .= '<li class="' . $rnIBicon . ' IByourip" title="' . _YOURIP . ' '. $yourip .'"><span class="IBtextbold" title="' . _YOURIP . ' '. $yourip .'">'. $yourip .'</span></li>
';
  $content .= '<li class="' . $rnIBicon . ' IByourposts" title="' . _NAV_YOURPOSTS . '"><a href="modules.php?name=Forums&amp;file=search&amp;search_id=egosearch" title="' . _NAV_YOURPOSTS . '">' . _NAV_YOURPOSTS . '</a></li>
';
  if ($ya_config['allowusertheme']=='1'){
  $content .= '<li class="' . $rnIBicon . ' IBchangetheme" title="' . _NAV_CHGTHEME . '"><a href="modules.php?name=Your_Account&amp;op=chgtheme" title="' . _NAV_CHGTHEME . '">' . _NAV_CHGTHEME . '</a></li>
';
}
if (is_active('nukeNAV') and is_active('Search') and $UseSearchPopUp) $content .= '<li class="' . $rnIBicon . ' IBsearch" title="' . _SEARCH . '"><a href="modules.php?name=nukeNAV&amp;op=search" class="colorbox" title="">' . _SEARCH . '</a></li>
';
  $content .= '<li class="' . $rnIBicon . ' IBlogout" title="' . _LOGOUT . '"><a href="modules.php?name=Your_Account&amp;op=logout" title="' . _LOGOUT . '">' . _LOGOUT . '</a></li>
';
  $content .= '</ul>
';
  $content .= '</div>';
  // check new pms
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". intval($uinfo[0]) ."' AND (privmsgs_type='5' OR privmsgs_type='1')";
  if ( !($result = $db->sql_query($sql)) )
  {
    // error
    die('error checking new pms');
  }
  $new_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  // check old pms
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". intval($uinfo[0]) ."' AND (privmsgs_type='0')";
  if ( !($result = $db->sql_query($sql)) )
  {
    // error
    die('error checking old pms');
  }
  $old_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  $content .= '
<div class="IBinfosection" id="IBsection2">
  <div><img src="' . $IBtran . '" class="' . $IBicon . ' IBpms' . $IBadjust . '" alt="' . _BPM . '" /><span class="IBtextpad IBtextbold">' . _BPM . '</span></div>
<ul class="rninfobox">
<li class="' . $rnIBicon . ' IBnewpms" title="' . _BPM . '"><a href="modules.php?name=Private_Messages" title="' . _BPM . '">' . _BUNREAD . ': '. $new_pms .'</a></li>
';
  $content .= '<li class="' . $rnIBicon . ' IBoldpms" title="' . _BREAD . '"> ' . _BREAD . ': <span class="IBtextbold">'. $old_pms .'</span></li>
';
  $content .= '</ul>
';  
  $content .= '</div>
';  
  if (($pm_colorbox_notice && $new_pms > 0) and (!isset($_COOKIE["youhaveapm"])))
  {
    $IBmrCookie = '<script type="text/javascript">'."\n"
    .'<!--  '."\n"
    .'$.cookie("youhaveapm", "checked");'."\n"
    .'// -->'."\n"
    .'</script>';
  // div id = IByesnewpm triggers the colorbox popup
    $content .= $IBmrCookie.'
    <div id="IByesnewpm" style="display:none">
		<div id="IBnewmessages">
	    <span class="IBCBtext"><img src="' . $IBtran . '" class="' . $IBicon . ' IBoldpms" alt="' . _NEWPMSG . '" /> ' . _YOUHAVE . ' <a href="modules.php?name=Private_Messages">'. $new_pms .' ' . _NEWPMSG . '.</a></span>
	    </div>
    </div>
';
  }
}
else
{
  $content .= '<div class="IBinfosection" id="IBsection3">
  <div><a href="modules.php?name=Your_Account" title="' . _FSIYOURACCOUNT . '" class="IBglobe' . $IBadjust . '"><img src="' . $IBtran . '" class="' . $IBicon . ' IBglobe' . $IBadjust . '" alt="' . $anonymous . '" /><span class="IBtextpad">'.$anonymous.'</span></a></div>
<ul class="rninfobox">
';
  $content .= '<li class="' . $rnIBicon . ' IByourip" title="' . _YOURIP . ' '. $yourip .'"><span class="IBtextbold">'. $yourip .'</span></li>
';
  $content .= '<li class="' . $rnIBicon . ' IByourposts" title="' . _BREG . '"><a href="modules.php?name=Your_Account&amp;op=new_user">' . _BREG . '</a></li>
';
  $content .= '<li class="' . $rnIBicon . ' IBonlineguest" title="' . _PASSWORDLOST . '"><a href="modules.php?name=Your_Account&amp;op=pass_lost">'._PASSWORDLOST.'</a></li>
';
if (is_active('nukeNAV') and is_active('Search') and $UseSearchPopUp) $content .= '<li class="' . $rnIBicon . ' IBsearch" title="' . _SEARCH . '"><a href="modules.php?name=nukeNAV&amp;op=search" class="colorbox" title="">' . _SEARCH . '</a></li>
';
if ($UsemodalLogin){
  $content .= '<li class="' . $rnIBicon . ' IBlogout" title="' . _LOGIN . '"><a href="modules.php?name=Your_Account&amp;op=login" class="colorbox">' . _LOGIN . '</a></li>
</ul>';
}else{
  $content .= '</ul>
  <div><form action="modules.php?name=Your_Account" method="post">
  <label for="username">'. _NICKNAME .'</label>
  <input type="text" name="username" value="" size="15" maxlength="25" />
  <label for="user_password">'. _PASSWORD .'</label>
  <input type="password" name="user_password" size="15" maxlength="20" />
  <div class="IBcaptcha">
  ';
  /*****[BEGIN]******************************************
  [ Base:    GFX Code                           v1.0.0 ]
  ******************************************************/
    $content .= security_code(array(2,4,5,7), 'stacked');
  /*****[END]********************************************
  [ Base:    GFX Code                           v1.0.0 ]
  ******************************************************/
  $content .= '</div>
  <input type="hidden" name="op" value="login" />
  <input type="submit" name="login" value="'. _LOGIN .'" /> 
  </form></div><div class="IBspacedout">&nbsp;</div>';
  }
  $content .= '</div>
';  
}
// waiting users
$sql = 'SELECT username FROM '.$user_prefix.'_users_temp';
$result = $db->sql_query($sql);
$waiting = $db->sql_numrows($result);
$content .= '
<div class="IBinfosection" id="IBsection4">
  <div><img src="' . $IBtran . '" class="' . $IBicon . ' IBmembers' . $IBadjust . '" alt="' . _BMEM . '" /><span class="IBtextpad IBtextbold">' . _BMEM . '</span></div>
';
    $IBgetmonth = '<script type="text/javascript">'."\n"
    .'<!--   // Array of Month Names'."\n"
    .'var IBmonthNames = new Array( \''._JANUARY.'\', \''._FEBRUARY.'\', \''._MARCH.'\', \''._APRIL.'\', \''._MAY.'\', \''._JUNE.'\', \''._JULY.'\', \''._AUGUST.'\', \''._SEPTEMBER.'\', \''._OCTOBER.'\', \''._NOVEMBER.'\', \''._DECEMBER.'\');'."\n"
    .'var IBnow = new Date();'."\n"
    .'document.write(IBmonthNames[IBnow.getMonth()]);'."\n"
    .'// -->'."\n"
    .'</script>'."\n"
    .'<noscript>'._UMONTH.'</noscript>';
    $IBgetyear = '<script type="text/javascript">'."\n"
    .'<!--   // Insert the Year'."\n"
    .'var IBBnow = new Date();'."\n"
    .'var IBBthisYear = IBBnow.getYear();'."\n"
    .'if(IBBthisYear < 1900) {IBBthisYear += 1900; }' // corrections if Y2K display problem\n
    .'document.write(IBBthisYear);'."\n"
    .'// -->'."\n"
    .'</script>'."\n"
    .'<noscript>'._YEAR.'</noscript>';
// get new member info
$timestamp = time();
$today = date("M d, Y");
$yesterday = date("M d, Y", ($timestamp - 86400) );
$this_month = date("M");
$this_year = date("Y");
// today
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE user_regdate='$today'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting todays users');
}
list($new_today) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
// yesterday
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE user_regdate='$yesterday'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting yesterdays users');
}
list($new_yesterday) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
// this month
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE SUBSTRING(user_regdate, 1, 4)='$this_month' AND SUBSTRING(user_regdate, 9, 12)='$this_year'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting this months users');
}
list($new_month) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
// this year
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users WHERE SUBSTRING(user_regdate, 9, 12)='$this_year'";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting this years users');
}
list($new_year) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
// all time
$sql = "SELECT COUNT(user_id) FROM ". $user_prefix ."_users";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting total users');
}
	if (is_admin($admin) AND @file_exists('modules/Resend_Email/index.php')) $waitLink = '<a href="modules.php?name=Resend_Email" title="'._TTL_RESENDEMAIL.'">'._WAITLINK.': <span class="IBtextbold">'. $waiting .'</span></a>';
	else $waitLink = _WAITLINK . ': <span class="IBtextbold">'. $waiting .'</span>';
list($total_users) = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$content .= '<ul class="rninfobox">
<li class="' . $rnIBicon . ' IBtoday" title="' . _BTD . '">' . _BTD . ': <span class="IBtextbold">'. $new_today .'</span></li>
<li class="' . $rnIBicon . ' IByesterday" title="' . _BYD . '">' . _BYD . ': <span class="IBtextbold">'. $new_yesterday .'</span></li>
<li class="' . $rnIBicon . ' IBmonth" title="' . _UMONTH . '">' . $IBgetmonth . ': <span class="IBtextbold">'. $new_month .'</span></li>
<li class="' . $rnIBicon . ' IByear" title="' . _YEAR . '">' . $IBgetyear . ': <span class="IBtextbold">'. $new_year .'</span></li>
<li class="' . $rnIBicon . ' IBtotalusers" title="' . _BTT . '">' . _BTT . ': <span class="IBtextbold">'. $total_users .'</span></li>
<li class="' . $rnIBicon . ' IBwaiting" title="' . _WAITLINK . '">' . $waitLink . '</li>
</ul>
';
$content .= '</div>';  
// get newest member(s)
$sql = "SELECT username FROM ". $user_prefix ."_users ORDER BY user_id DESC LIMIT ". intval($recent_member_count);
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting latest users');
}
$latestusers = $db->sql_numrows($result = $db->sql_query($sql));
$content .= '
<div class="IBinfosection" id="IBsection5">
  <div><img src="' . $IBtran . '" class="' . $IBicon . ' IBnewusers' . $IBadjust . '" alt="' . _BLATEST . '" /><span class="IBtextpad IBtextbold">' . _BLATEST . '</span></div>
';
if ($latestusers > 0){
  $content .= '<ul class="rninfobox">
';
  $newusercounter = 0;
  }
while( $row = $db->sql_fetchrow($result) )
{
  $newusercounter += 1;
  $TruncateUser = strlen($row['username'])<$nameMaxLength?$row['username']:substr($row['username'],0,$nameMaxLength).'...'; // 2.2.0
  $lastusername = $row['username'];
  $content .= '<li class="' . $rnIBicon . ' IBmembernew" title="'._ALT_CHKPROFILE.$lastusername.'"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$row['username'].'" title="'._ALT_CHKPROFILE.$lastusername.'">'.$TruncateUser.'</a></li>
';
if ($newusercounter==$latestusers){
	$content .= '</ul>
';
	}
}
$db->sql_freeresult($result);
  $content .= '</div>
';  
// show whos online
$members = '';
$guests = '';
$m = $g = 0;
$sql = "SELECT uname, time, host_addr, guest FROM ". $prefix ."_session WHERE time > '".( time() - ($max_session_mins * 60) )."' ORDER BY guest ASC,time DESC";
if ( !($result = $db->sql_query($sql)) )
{
  // error
  die('error getting online users');
}
$content .= '<div class="IBinfosection" id="IBsection6">
  <div><img src="' . $IBtran . '" class="' . $IBicon . ' IBmembers' . $IBadjust . $IBadjust . '" alt="' . _BON . '" /><span class="IBtextpad IBtextbold">' . _BON . '</span></div>
';
while( $row = $db->sql_fetchrow($result) )
{
  if ($row['guest'] == 0)
  {
    $m++;
    if ($m <= $max_display_members)
    {
      $TruncateUser = strlen($row['uname'])<$nameMaxLength?$row['uname']:substr($row['uname'],0,$nameMaxLength).'...'; // 2.2.0
	  $lastusername = $row['uname'];
	  $members .= '<li class="' . $rnIBicon . ' IBonline" title="' . _BON . '"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$row['uname'].'" title="'._ALT_CHKPROFILE.$lastusername.'">'.$TruncateUser.'</a></li>
';
    }
  }
  else
  {
    $g++;
    if ($show_guest_list && $g <= $max_display_guests)
    {
      if (is_admin($admin))
      {
      if ($whoisUseModal){$uname = '<a class="IBmodal" href="http://'.$whoisServerString.$row['uname'].'">'.$row['uname'].'</a>';
      }else{$uname = '<a target="_blank" href="http://'.$whoisServerString.$row['uname'].'">'.$row['uname'].'</a>';}
      }
      else
      {
        // hide last 2 octets of guest ip's.
        $ip = explode('.', $row['uname']);
        $uname = $ip[0].'.'.$ip[1].'.'.preg_replace("/(0|1|2|3|4|5|6|7|8|9)/", "x", $ip[2]).'.'.preg_replace("/(0|1|2|3|4|5|6|7|8|9)/", "x", $ip[3]);
      }
       if ($show_guest_guest){
	  $guests .= '<li class="' . $rnIBicon . ' IBonlineguest" title="' . _BON . '">'.$uname.'</li>
';
	  }else{
	  if (is_user($user)) $guests .= '<li class="' . $rnIBicon . ' IBonlineguest" title="' . _BON . '">'.$uname.'</li>
';
	  }
    }
  }
}
$db->sql_freeresult($result);
if ($showonlinecount)
{
	$content .= '<div class="IBsmallnotes">';
	if ($m > 0)
	{
	  $content .= _BMEM.':<span class="IBtextbold">'. $m .'</span>';
	}
	if ($show_guest_list && $g > 0)
	{
	  $content .= '&nbsp;'._BVIS.':<span class="IBtextbold">'. $g .'</span>';
	}
	$content .= '&nbsp;</div>
';
}
if (($m > 0) OR ($show_guest_list && $g > 0))
	{
	  $content .= '<ul class="rninfobox">
';  
	}
	if ($m > 0)
	{
	  $content .= $members;
	}
	if ($g > 0)
	{
	  $content .= $guests;
	}
if (($m > 0) OR ($show_guest_list && $g > 0))
{
  $content .= '</ul>
';  
}
  $content .= '</div>
';  
// change the date/time format below, php.net/date
$content .= '<div class="IBinfosection" id="IBsection7">
  <div><img src="' . $IBtran . '" class="' . $IBicon . ' IBserver' . $IBadjust . '" alt="' . _SERDT . '" /><span class="IBtextpad IBtextbold">' . _SERDT . '</span></div>
<ul class="rninfobox">
<li class="' . $rnIBicon . ' IBserdate" title="' . _SERDT . '">'. date('M d, Y').'</li>
<li class="' . $rnIBicon . ' IBtime" title="' . _SERDT . '">'. date('h:i a T').'</li>
';
  if ((is_admin($admin)) and (defined('RAVENNUKE_VERSION_FRIENDLY')))
      {
  $content .= '<li class="' . $rnIBicon . ' IBglobe" title="RN '.RAVENNUKE_VERSION_FRIENDLY.'">RN '.RAVENNUKE_VERSION_FRIENDLY.'</li>
';  
      }
  $content .= '</ul>
</div>';      
  // make sure content does not float outside the block  
  $content .= '<div class="IBspacedout">&nbsp;</div>
';  
$content .= '</div>
<!-- END Info -->';
?>
