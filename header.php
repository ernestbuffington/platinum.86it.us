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
if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
    Header("Location: index.php");
    die();
}

if (!defined('NUKE_HEADER')) {
define('NUKE_HEADER', true);
}
require_once("mainfile.php");

/******GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004********/
/******Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks********/
global $tnsl_bUseShortLinks, $tnsl_bAutoTapBlocks, $tnsl_bAutoTapLinks, $tnsl_bDebugShortLinks, $tnsl_sGTFilePath;
if (defined('TNSL_USE_SHORTLINKS')) {
  $GLOBALS['tnsl_asGTFilePath'] = tnsl_fPageTapStart();
}

##################################################
# Include some common header for HTML generation #
##################################################

//$header = 1;

function head() {
/*****************************************************/
/* Security - Sentinel v.2.5.10                START */
/*****************************************************/
    global $ab_config, $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle, $name, $db, $prefix, $adb_chk, $login_bar;
/*****************************************************/
/* Security - Sentinel v.2.5.10                  END */
/*****************************************************/
    include_once("includes/ipban.php");
/***START*********Initialize CSS and JS arrays ********/
/************RN Compatability Layer part 1 ********/
	$headCSS = array();
	addCSSToHead(INCLUDE_PATH . 'themes/pnpro.css', 'file');
	$headJS  = array();  // added inside HEAD tags
	$bodyJS  = array(); // added at bottom of page, before </BODY>
/***END*********Initialize CSS and JS arrays ********/
/************RN Compatability Layer part 1 ********/	
    global $define_theme_xtreme_209e, $myappid, $ab_config, $modheader, $name, $cache, $userinfo, $cookie, $sitekey, $db, $name, $banners, $sitename, $ads, $browser, $ThemeSel;

	$ThemeSel = get_theme();

	include_once(NUKE_THEMES_DIR.$ThemeSel.'/theme.php');

    if (@file_exists(NUKE_INCLUDE_DIR . 'mimetype.php') && ($define_theme_xtreme_209e != true)) 
	{
        include(NUKE_INCLUDE_DIR.'mimetype.php');
    } 
	else 
	{
	   echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
       echo "<html>\n";
       echo "<head>\n";
    }

    include_once(NUKE_INCLUDE_DIR.'meta.php');
/***START****If Dynamic Titles are turned on, use them, otherwise, use default PHP-Nuke page titles********/
    global $useDynamicTitles;

    if (isset($useDynamicTitles) && $useDynamicTitles && file_exists(INCLUDE_PATH.'includes/dynamic_titles.php')) 
	{
      include_once(INCLUDE_PATH.'includes/dynamic_titles.php');
    } 
    else 
      {
          echo '<title>'.$sitename.' '.$pagetitle.'</title>'."\n";
      }
/***END*******End of Dynamic Titles changes********/
    ############################################################################ 
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/a-links.php'))           ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/a-links.php');             ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##                             Theme Design On The Fly
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/async-hide.php'))        ############################## Stop Deleteing Cache To see
	{                                                                         ##                             your changes! 08/13/2019
	  echo "<style type=\"text/css\">\n";                                     ##                             By Ernest Allen Buffington
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/async-hide.php');          ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/block.php'))             ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/block.php');               ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/body.php'))              ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/body.php');                ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/categories.php'))        ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/categories.php');          ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/maintable.php'))         ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/maintable.php');           ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/menunowrap.php'))        ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/menunowrap.php');          ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/modules.php'))           ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/modules.php');             ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/myButton.php'))          ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/myButton.php');            ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/storycat.php'))          ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/storycat.php');            ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/css/style.php'))             ##
	{                                                                         ##
	  echo "<style type=\"text/css\">\n";                                     ##
	  require_once(NUKE_THEMES_DIR.$ThemeSel.'/css/style.php');               ##
	  echo "</style>\n";                                                      ##
	}                                                                         ##
    ###########################################################################
    include_once(NUKE_INCLUDE_DIR.'javascript.php');                          ######## Load local javascript File
    ###########################################################################
	if (@file_exists(NUKE_CLASSES_DIR . 'class.browsers.php')) #      Added by Ernest Buffington
	    include(NUKE_CLASSES_DIR . 'class.browsers.php');      ###### Load Browser class - used for checking your browser types
                                                                   #      Start date Jan 1st 2012 till Present - It is a work in progress!
    ################################################################
	if (@file_exists(NUKE_INCLUDE_DIR . 'cookies.php'))     #            Added by Ernest Buffington
	{                                                       ############ Load the custom cookies file if it exist COOKIE CONTROL
        include(NUKE_INCLUDE_DIR . 'cookies.php');          #            Jan 1st 2012 
    }                                                       #
    #########################################################
		
    if (file_exists("themes/$ThemeSel/images/favicon.ico")) {
	echo "<link REL=\"shortcut icon\" HREF=\"themes/$ThemeSel/images/favicon.ico\" TYPE=\"image/x-icon\">\n";
    }
    if (file_exists('favicon.ico')) {
        echo '<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />'."\n";
    }
    echo '<link rel="alternate" type="application/rss+xml" title="RSS" href="backend.php" />'."\n";
    echo '<link rel="alternate" type="application/rss+xml" title="RSS" href="forumsbackend.php" />'."\n";
    echo '<link rel="StyleSheet" href="themes/'.$ThemeSel.'/style/style.css" type="text/css" />'."\n\n";

    if (file_exists('includes/custom_files/custom_head.php')) {
        include_once('includes/custom_files/custom_head.php');
    }
/***START*********Initialize CSS and JS arrays ********/
/***Support custom CSS on a per-module basis *****/
/***Module authors need to define PN_MODULE_CSS to name the external style sheet they want to load*****/
/***and we will add a link to their stylesheet file automatically.*****/
/************RN Compatability Layer part 2 ********/	
if (defined('PN_MODULE_CSS')) {
		$modCssFile = 'themes/' . $ThemeSel . '/style/' . PN_MODULE_CSS;
		if (file_exists($modCssFile)) {
			addCSSToHead($modCssFile, 'file');
		}
	}
include_once NUKE_INCLUDE_DIR . 'javascript.php';
$addons = readDIRtoArray(NUKE_INCLUDE_DIR . 'addons', '/^head\-(.+)\.php/');
	foreach ($addons as $addon) {
		include_once NUKE_INCLUDE_DIR . 'addons/'.$addon;
	}
	$addons = readDIRtoArray(NUKE_INCLUDE_DIR . 'addons', '/^body\-(.+)\.php/');
	foreach ($addons as $addon) {
		include_once NUKE_INCLUDE_DIR . 'addons/'.$addon;
	}
	if (defined('PN_MODULE_HEAD'))
	include_once NUKE_MODULES_DIR . $name . '/' . PN_MODULE_HEAD;
	writeHEAD();
/***END*********Initialize CSS and JS arrays ********/
/************RN Compatability Layer part 2 ********/	
    echo "\n\n</head>\n\n";
    if (file_exists('includes/custom_files/custom_header.php')) {
        include_once('includes/custom_files/custom_header.php');
    }
/*****************************************************/
/* Security - Sentinel v.2.5.17                 START */
/*****************************************************/
    global $ab_config;
	if ($ab_config['site_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<center><img src="images/nukesentinel/disabled.png" alt="' . _AB_SITEDISABLED . '" title="' . _AB_SITEDISABLED . '" border="0" /></center><br />';
	}
	if ($ab_config['disable_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<center><img src="images/nukesentinel/inactive.png" alt="' . _AB_NSDISABLED . '" title="' . _AB_NSDISABLED . '" border="0" /></center><br />';
    }
	if ($ab_config['test_switch'] == 1 && isset($_COOKIE['admin']) && is_admin($_COOKIE['admin'])) {
		echo '<center><img src="images/nukesentinel/testmode.png" alt="' . _AB_TESTMODE . '" title="' . _AB_TESTMODE . '" border="0" /></center><br />';
    }
/*****************************************************/
/* Security - Sentinel v.2.5.17                   END */
/*****************************************************/
/*****[BEGIN]******************************************/
/******Base:    Snavi Menu Bar            v2.5.********/
/*******************************************************/

if (defined('SNAVI_IS_ACTIVE') && file_exists('includes/snavi/snavi.php'))
{
  echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">' . "\n";
  echo '<tr><td align="center" valign="middle">' . "\n";

  include_once('includes/snavi/snavi.php');

  echo '</td></tr></table>' . "\n";
  echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">' . "\n";
  echo '<tr><td align="center" valign="top">' . "\n";
  echo '</td></tr></table>' . "\n";
}
/*****[END]********************************************
 [ Base:    Snavi Menu Bar                       v2.5.]
 ******************************************************/
    themeheader();
/*****************************************************/
/* Log In Bar - sgtmudd                        START */
/* boxover added PNP051511- DocHaVoc                 */
/*****************************************************/
if ($login_bar == 1) {	
  if (is_user($user)) {
       //echo "&nbsp;\n";
    } else {
       echo "<link rel=\"stylesheet\" href=\"includes/infobar/infobar.css\" type=\"text/css\" />\n";
       echo "  <table align=\"center\" class=\"infobar\" width=\"99%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\n";
       echo "    <tr>\n";
       echo "      <td>\n";
       echo "        <div id=\"infobar\"><i><strong>Attention...You are not logged in...Please login or register an account</strong></i>&nbsp;<br /><a href=\"modules.php?name=Your_Account\" title=\"cssheader=[boxhdr] cssbody=[boxbdy] header=['Login or Register']body=['Click Here to log into Your Account or Register a New Account']\">&nbsp;&nbsp;<strong>Click HERE</strong>.</a></div>\n";
       echo "      </td>\n";
       echo "    </tr>\n";
       echo "  </table>\n";
       echo "<br />\n";
    }
}
/*****************************************************/
/* Log In Bar                                    END */
/*****************************************************/
/*****************************************************/
/* adblock detector                            START */
/*****************************************************/
if ($adb_chk == '1') {
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/adblock_detector/adblock_detector.css\">\n";
echo "<script type=\"text/javascript\" src=\"includes/adblock_detector/adblock_detector.js\"></script>\n";
echo "
<script type=\"text/javascript\">
	if (document.getElementById(\"tester\") == undefined) {
		document.write('<div style=\"text-align:center;color: #F00;font-family: Arial, Helvetica, sans-serif;font-size: 18px;\">" . _CHKWARN . "</div>');
	}
</script>
";
} else if ($adb_chk == '2') {
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"includes/adblock_detector/adblock_detector.css\">\n";
echo "<script type=\"text/javascript\" src=\"includes/adblock_detector/adblock_detector.js\"></script>\n";
echo "
<script type=\"text/javascript\">
	if (document.getElementById(\"tester\") == undefined) {
		document.write('<div style=\"text-align:center;color: #F00;font-family: Arial, Helvetica, sans-serif;font-size: 18px;\">" . _CHKWARN . "</div>');
		} else {
		document.write('<div style=\"text-align:center;color: #090;font-family: Arial, Helvetica, sans-serif;font-size: 16px;\">" . _CHKOK . "</div>');
	}
</script>
";
}
/*****************************************************/
/* adblock detector                              END */
/*****************************************************/
}

online();
head();
include_once('includes/counter.php');

/*****************************************************/
/* Addon - Center Blocks v.2.1.1               START */
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
global $home;
if(defined('HOME_FILE') || $home == 1) {
    message_box();
        include_once("includes/cblocks1.php");
    blocks('Center');
}
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/* Addon - Center Blocks v.2.1.1                 END */
/*****************************************************/
?>