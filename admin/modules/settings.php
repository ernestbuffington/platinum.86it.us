<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
//define('_UITABS', true);
/*********************************************************/
/* Configuration Functions to Setup all the Variables    */
/*********************************************************/
function Configure() {
    global $prefix, $db, $admin_file;
    @include_once("header.php");
$row = $db->sql_fetchrow($db->sql_query("SELECT sitename, nukeurl, site_logo, slogan, startdate, adminmail, anonpost, Default_Theme, foot1, foot2, foot3, commentlimit, anonymous, minpass, pollcomm, articlecomm, broadcast_msg, my_headlines, top, storyhome, user_news, oldnum, ultramode, banners, adb_chk, backend_title, backend_language, language, locale, multilingual, useflags, notify, notify_email, notify_subject, notify_message, notify_from, moderate, admingraphic, httpref, httprefmax, CensorMode, CensorReplace, displayerror, login_bar from ".$prefix."_config"));
$sitename = $row['sitename'];
$nukeurl = $row['nukeurl'];
$site_logo = $row['site_logo'];
$slogan = $row['slogan'];
$startdate = $row['startdate'];
$adminmail = stripslashes($row['adminmail']);
$anonpost = $row['anonpost'];
$Default_Theme = $row['Default_Theme'];
$foot1 = $row['foot1'];
$foot2 = $row['foot2'];
$foot3 = $row['foot3'];
$commentlimit = intval($row['commentlimit']);
$anonymous = $row['anonymous'];
$minpass = intval($row['minpass']);
$pollcomm = intval($row['pollcomm']);
$articlecomm = intval($row['articlecomm']);
$broadcast_msg = intval($row['broadcast_msg']);
$my_headlines = intval($row['my_headlines']);
$top = intval($row['top']);
$storyhome = intval($row['storyhome']);
$user_news = intval($row['user_news']);
$oldnum = intval($row['oldnum']);
$ultramode = intval($row['ultramode']);
$banners = intval($row['banners']);
$adb_chk = $row['adb_chk'];
$backend_title = $row['backend_title'];
$backend_language = $row['backend_language'];
$language = $row['language'];
$locale = $row['locale'];
$multilingual = intval($row['multilingual']);
$useflags = intval($row['useflags']);
$notify = intval($row['notify']);
$notify_email = $row['notify_email'];
$notify_subject = $row['notify_subject'];
$notify_message = $row['notify_message'];
$notify_from = $row['notify_from'];
$moderate = intval($row['moderate']);
$admingraphic = intval($row['admingraphic']);
$httpref = intval($row['httpref']);
$httprefmax = intval($row['httprefmax']);
$CensorMode = intval($row['CensorMode']);
$CensorReplace = $row['CensorReplace'];
$pnpadmerr = intval($row['displayerror']);
$login_bar = intval($row['login_bar']);
    OpenTable();
    echo "<center><font class='title'><strong>" . _SITECONFIG . "</strong></font></center>";
    CloseTable();
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Configure'>Configuration Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
    echo "<br />";
    OpenTable();
    echo "<center><font class='option'><strong>" . _GENSITEINFO . "</strong></font></center><br />"
	."<form action='".$admin_file.".php' method='post'>";
	echo '<div style="height: 31px; padding: 0px 10px;">';
	echo '<ul id="conftab" class="shadetabs">
		  <li><a href="#" rel="conftab1" class="selected"><span class="center">&nbsp;</span>' . _GENSITEINFO . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab2"><span class="center">&nbsp;</span>' . _PNP_ADM_OPT . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab3"><span class="center">&nbsp;</span>' . _FOOTERMSG . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab4"><span class="center">&nbsp;</span>' . _BACKENDCONF . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab5"><span class="center">&nbsp;</span>' . _MAIL2ADMIN . '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab6"><span class="center">&nbsp;</span>' . _COMMENTSMOD .  '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab7"><span class="center">&nbsp;</span>' . _GRAPHICOPT .  '<span class="right">&nbsp;</span></a></li>
          <li><a href="#" rel="conftab8"><span class="center">&nbsp;</span>' . _MISCOPT . '<span class="right">&nbsp;</span></a></li>		  
          <li><a href="#" rel="conftab9"><span class="center">&nbsp;</span>' . _USERSOPTIONS . '<span class="right">&nbsp;</span></a></li>
		  <li><a href="#" rel="conftab10"><span class="center">&nbsp;</span>' . _CENSOROPTIONS . '<span class="right">&nbsp;</span></a></li>
          </ul>';
	echo '</div>';
	echo '<div class="tabcontb"><br /><br />';
	echo '<div id="conftab1" class="tabcontent" padding: 15px">';
    echo "<br /><br /><center><font class='option'><strong>" . _GENSITEINFO . "</strong></font></center>"	;
echo "<table border='0' cellpadding='4'><tr><td>" . _SITENAME . ":</td><td><input type='text' name='xsitename' value='$sitename' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _SITEURL . ":</td><td><input type='text' name='xnukeurl' value='$nukeurl' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _SITELOGO . ":</td><td><input type='text' name='xsite_logo' value='$site_logo' size='20' maxlength='255'> <font class='tiny'>[ " . _MUSTBEINIMG . " ]</font>"
	."</td></tr><tr><td>"
	."" . _SITESLOGAN . ":</td><td><input type='text' name='xslogan' value='$slogan' size='40' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _STARTDATE . ":</td><td><input type='text' name='xstartdate' value='$startdate' size='20' maxlength='50'>"
	."</td></tr><tr><td>"
	."" . _ADMINEMAIL . ":</td><td><input type='text' name='xadminmail' value='$adminmail' size='30' maxlength='255'>"
	."</td></tr><tr><td>"
	."" . _ITEMSTOP . ":</td><td><select name='xtop'>"
	."<option name='xtop'>$top</option>"
	."<option name='xtop'>5</option>"
	."<option name='xtop'>10</option>"
        ."<option name='xtop'>15</option>"
        ."<option name='xtop'>20</option>"
        ."<option name='xtop'>25</option>"
        ."<option name='xtop'>30</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _STORIESHOME . ":</td><td><select name='xstoryhome'>"
        ."<option name='xstoryhome'>$storyhome</option>"
        ."<option name='xstoryhome'>2</option>"
        ."<option name='xstoryhome'>3</option>"
        ."<option name='xstoryhome'>4</option>"
        ."<option name='xstoryhome'>5</option>"
        ."<option name='xstoryhome'>6</option>"
        ."<option name='xstoryhome'>10</option>"
        ."<option name='xstoryhome'>16</option>"
        ."<option name='xstoryhome'>26</option>"
        ."<option name='xstoryhome'>32</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _OLDSTORIES . ":</td><td><select name='xoldnum'>"
        ."<option name='xoldnum'>$oldnum</option>"
        ."<option name='xoldnum'>10</option>"
        ."<option name='xoldnum'>20</option>"
        ."<option name='xoldnum'>30</option>"
        ."<option name='xoldnum'>40</option>"
        ."<option name='xoldnum'>50</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _ACTULTRAMODE . "</td><td>";
    if ($ultramode==1) {
	echo "<input type='radio' name='xultramode' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xultramode' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xultramode' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xultramode' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>
    " . _ALLOWANONPOST . " </td><td>";
    if ($anonpost==1) {
	echo "<input type='radio' name='xanonpost' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xanonpost' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xanonpost' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xanonpost' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
	."" . _DEFAULTTHEME . ":</td><td><select name='xDefault_Theme'>";
    $handle=opendir('themes');
    while ($file = readdir($handle)) {
	if ( (!preg_match("/[.]/",$file)) ) {
		$themelist .= "$file ";
	}
    }
    closedir($handle);
    $themelist = explode(" ", $themelist);
    sort($themelist);
    for ($i=0; $i < sizeof($themelist); $i++) {
	if($themelist[$i]!="") {
	    echo "<option name='xDefault_Theme' value='$themelist[$i]' ";
		if($themelist[$i]==$Default_Theme) echo "selected";
		echo ">$themelist[$i]\n";
	}
    }
    echo "</select>"
	."</td></tr><tr><td>"
	."" . _SELLANGUAGE . ":</td><td>"
	."<select name='xlanguage'>";
    $handle=opendir('language');
    while ($file = readdir($handle)) {
	if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
            $langFound = $matches[1];
            $languageslist .= "$langFound ";
        }
    }
    closedir($handle);
    $languageslist = explode(" ", $languageslist);
    sort($languageslist);
    for ($i=0; $i < sizeof($languageslist); $i++) {
	if($languageslist[$i]!="") {
	    echo "<option name='xlanguage' value='$languageslist[$i]' ";
		if($languageslist[$i]==$language) echo "selected";
		echo ">".ucfirst($languageslist[$i])."\n";
	}
    }
    echo "</select>"
	."</td></tr><tr><td>"     
	."" . _LOCALEFORMAT . ":</td><td><input type='text' name='xlocale' value='$locale' size='20' maxlength='40'>"
	."</td></tr></table>";
	echo '</div>';
	echo '<div id="conftab2" class="tabcontent">';		
    echo "<br /><br /><font class='option'><strong>" . _PNP_ADM_OPT . "</strong></font>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _PNP_ADM_ERR . "</td><td>";
    if ($pnpadmerr==1) {
	echo "<input type='radio' name='xpnpadmerr' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xpnpadmerr' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xpnpadmerr' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xpnpadmerr' value='0' checked>" . _NO . "";
    }
    echo "</td></tr>";
	echo "<tr><td>"
	."" . _PNP_LOGIN_BAR . "</td><td>";
    if ($login_bar==1) {
	echo "<input type='radio' name='xlogin_bar' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xlogin_bar' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xlogin_bar' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xlogin_bar' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
    echo "<br /><br /><font class='option'><strong>" . _MULTILINGUALOPT . "</strong></font>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _ACTMULTILINGUAL . "</td><td>";
    if ($multilingual==1) {
	echo "<input type='radio' name='xmultilingual' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xmultilingual' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xmultilingual' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xmultilingual' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
	."" . _ACTUSEFLAGS . "</td><td>";
    if ($useflags==1) {
	echo "<input type='radio' name='xuseflags' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xuseflags' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xuseflags' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xuseflags' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";	
    echo "<br /><br /><font class='option'><strong>" . _BANNERSOPT . "</strong></font>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _ACTBANNERS . "</td><td>";
    if ($banners==1) {
	echo "<input type='radio' name='xbanners' value='1' checked>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xbanners' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xbanners' value='1'>" . _YES . " &nbsp;"
	    ."<input type='radio' name='xbanners' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
/***********************************************/
/* Adblock Detector                     START  */
/***********************************************/
    echo "<br /><br /><font class='option'><strong>" . _ADBCHECK . "</strong></font>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _ADBLOCKCHECK . "</td><td>";
    if ($adb_chk==1) {
	echo "<input type='radio' name='xadb_chk' value='1' checked>" . _YES . " &nbsp;"
		."<input type='checkbox' name='xadb_chk' value='2'>" . _ADBTHANK . "<br>"
		."<input type='radio' name='xadb_chk' value='0'>" . _NO . " &nbsp;";
    } else if ($adb_chk==2) {
	echo "<input type='radio' name='xadb_chk' value='1' checked>" . _YES . " &nbsp;"
		."<input type='checkbox' name='xadb_chk' value='2' checked>" . _ADBTHANK . "<br>"
		."<input type='radio' name='xadb_chk' value='0'>" . _NO . " &nbsp;";
		
    } else {
	echo "<input type='radio' name='xadb_chk' value='1'>" . _YES . " &nbsp;"
		."<input type='checkbox' name='xadb_chk' value='2'>" . _ADBTHANK . "<br>"
	    ."<input type='radio' name='xadb_chk' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
/***********************************************/
/* Adblock Detector                       END  */
/***********************************************/
	echo '</div>';
	echo '<div id="conftab3" class="tabcontent" padding: 15px">';			
    echo "<br /><br /><center><font class='option'><strong>" . _FOOTERMSG . "</strong></font></center>";
  echo '<table border="0" width="100%"><tr><td>' . _FOOTERLINE1 . ':</td><td>';
  //The following has to be done in order to ensure XHTML compliance when the advanced editor is not being used:
  global $advanced_editor;
  if ( $advanced_editor == 0 ) {
    $foot1 = htmlentities( $foot1, ENT_QUOTES );
    $foot2 = htmlentities( $foot2, ENT_QUOTES );
    $foot3 = htmlentities( $foot3, ENT_QUOTES );
  }
  //End add.
  //	<textarea name='xfoot1' cols='50' rows='5'>" . stripslashes($foot1) . "</textarea>"
  wysiwyg_textarea( 'xfoot1', $foot1, 'PHPNukeAdmin', '50', '10' );
  echo '</td></tr><tr><td>' . _FOOTERLINE2 . ':</td><td>';
  //	<textarea name='xfoot2' cols='50' rows='5'>' . stripslashes($foot2) . '</textarea>'
  wysiwyg_textarea( 'xfoot2', $foot2, 'PHPNukeAdmin', '50', '10' );
  echo '</td></tr><tr><td>' . _FOOTERLINE3 . ':</td><td>';
  //	<textarea name='xfoot3' cols='50' rows='5'>' . stripslashes($foot3) . '</textarea>'
  wysiwyg_textarea( 'xfoot3', $foot3, 'PHPNukeAdmin', '50', '10' );
  echo '</td></tr></table></fieldset>';
	echo '</div>';
	echo '<div id="conftab4" class="tabcontent" padding: 15px">';		
    echo "<br /><br /><center><font class='option'><strong>" . _BACKENDCONF . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _BACKENDTITLE . ":</td><td><input type='text' name='xbackend_title' value='$backend_title' size='40' maxlength='100'>"
	."</td></tr><tr><td>"
	."" . _BACKENDLANG . ":</td><td><input type='text' name='xbackend_language' value='$backend_language' size='10' maxlength='10'>"
	."</td></tr></table>";
	echo '</div>';	
	echo '<div id="conftab5" class="tabcontent" padding: 15px">';			
    echo "<br /><br /><center><font class='option'><strong>" . _MAIL2ADMIN . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _NOTIFYSUBMISSION . "</td><td>";
    if ($notify==1) {
	echo "<input type='radio' name='xnotify' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xnotify' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xnotify' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xnotify' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
	."" . _EMAIL2SENDMSG . ":</td><td><input type='text' name='xnotify_email' value='$notify_email' size='30' maxlength='100'>"
	."</td></tr><tr><td>"
	."" . _EMAILSUBJECT . ":</td><td><input type='text' name='xnotify_subject' value='$notify_subject' size='40' maxlength='100'>"
	."</td></tr><tr><td>"
	."" . _EMAILMSG . ":</td><td><textarea name='xnotify_message' cols='40' rows='8'>$notify_message</textarea>"
	."</td></tr><tr><td>"
	."" . _EMAILFROM . ":</td><td><input type='text' name='xnotify_from' value='$notify_from' size='15' maxlength='25'>"
	."</td></tr></table>";
	echo '</div>';	
	echo '<div id="conftab6" class="tabcontent" padding: 15px">';			
    echo "<br /><br /><center><font class='option'><strong>" . _COMMENTSMOD . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _MODTYPE . ":</td><td>"
	."<select name='xmoderate'>";
    if ($moderate==1) {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
    } elseif ($moderate==2) {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
    } elseif ($moderate==0) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
    }
    echo "<option name='xmoderate' value='1' $sel1>" . _MODADMIN . "</option>"
        ."<option name='xmoderate' value='2' $sel2>" . _MODUSERS . "</option>"
        ."<option name='xmoderate' value='0' $sel3>" . _NOMOD . "</option>"
	."</select></td></tr></table>";	
    echo "<br /><br /><center><font class='option'><strong>" . _COMMENTSOPT . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _COMMENTSLIMIT . ":</td><td><input type='text' name='xcommentlimit' value='$commentlimit' size='11' maxlength='10'>"
	."</td></tr><tr><td>"
	."" . _ANONYMOUSNAME . ":</td><td><input type='text' name='xanonymous' value='$anonymous'>"
	."</td></tr></table>";
	echo '</div>';	
	echo '<div id="conftab7" class="tabcontent" padding: 15px">';		
    echo "<br /><br /><center><font class='option'><strong>" . _GRAPHICOPT . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _ADMINGRAPHIC . "</td><td>";
    if ($admingraphic==1) {
	echo "<input type='radio' name='xadmingraphic' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xadmingraphic' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xadmingraphic' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xadmingraphic' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
	echo '</div>';	
	echo '<div id="conftab8" class="tabcontent" padding: 15px">';		
    echo "<br /><br /><center><font class='option'><strong>" . _MISCOPT . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
        ."" . _ACTIVATEHTTPREF . "</td><td>";
    if ($httpref==1) {
	echo "<input type='radio' name=xhttpref value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name=xhttpref value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xhttpref' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xhttpref' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
	."" . _MAXREF . "</td><td>"
	."<select name='xhttprefmax'>"
        ."<option name='xhttprefmax' value='$httprefmax'>$httprefmax</option>"
        ."<option name='xhttprefmax' value='100'>100</option>"
        ."<option name='xhttprefmax' value='250'>250</option>"
        ."<option name='xhttprefmax' value='500'>500</option>"
        ."<option name='xhttprefmax' value='1000'>1000</option>"
        ."<option name='xhttprefmax' value='2000'>2000</option>"
        ."</select>"
        ."</td></tr><tr><td>"
        ."" . _COMMENTSPOLLS . "</td><td>";
    if ($pollcomm==1) {
	echo "<input type='radio' name='xpollcomm' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xpollcomm' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xpollcomm' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xpollcomm' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>"
        ."" . _COMMENTSARTICLES . "</td><td>";
    if ($articlecomm==1) {
	echo "<input type='radio' name='xarticlecomm' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xarticlecomm' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xarticlecomm' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xarticlecomm' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
	echo '</div>';
	echo '<div id="conftab9" class="tabcontent" padding: 15px">';			
    echo "<br /><br /><center><font class='option'><strong>" . _USERSOPTIONS . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
        ."" . _PASSWDLEN . ":</td><td>"
        ."<select name='xminpass'>"
        ."<option name='xminpass' value='$minpass'>$minpass</option>"
        ."<option name='xminpass' value='3'>3</option>"
        ."<option name='xminpass' value='5'>5</option>"
        ."<option name='xminpass' value='8'>8</option>"
        ."<option name='xminpass' value='10'>10</option>"
        ."</select>"
	."</td></tr><tr><td>" . _BROADCASTMSG . "</td><td>";
    if ($broadcast_msg == 1) {
	echo "<input type='radio' name='xbroadcast_msg' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xbroadcast_msg' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xbroadcast_msg' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xbroadcast_msg' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>" . _MYHEADLINES . "</td><td>";
    if ($my_headlines == 1) {
	echo "<input type='radio' name='xmy_headlines' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xmy_headlines' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xmy_headlines' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xmy_headlines' value='0' checked>" . _NO . "";
    }
    echo "</td></tr><tr><td>" . _USERSHOMENUM . "</td><td>";
    if ($user_news == 1) {
	echo "<input type='radio' name='xuser_news' value='1' checked>" . _YES . " &nbsp;
	<input type='radio' name='xuser_news' value='0'>" . _NO . "";
    } else {
	echo "<input type='radio' name='xuser_news' value='1'>" . _YES . " &nbsp;
	<input type='radio' name='xuser_news' value='0' checked>" . _NO . "";
    }
    echo "</td></tr></table>";
	echo '</div>';	
	echo '<div id="conftab10" class="tabcontent" padding: 15px">';			
    echo "<br /><br /><center><font class='option'><strong>" . _CENSOROPTIONS . "</strong></font></center>"
	."<table border='0' cellpadding='4'><tr><td>"
	."" . _CENSORMODE . "</td><td>";
    if ($CensorMode == 0) {
	$sel0 = "selected";
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
    } elseif ($CensorMode == 1) {
	$sel0 = "";
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
    } elseif ($CensorMode == 2) {
	$sel0 = "";
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
    } elseif ($CensorMode == 3) {
	$sel0 = "";
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
    }
    echo "<select name='xCensorMode'>"
	."<option name='xCensorMode' value='0' $sel0>" . _NOFILTERING . "</option>"
	."<option name='xCensorMode' value='1' $sel1>" . _EXACTMATCH . "</option>"
	."<option name='xCensorMode' value='2' $sel2>" . _MATCHBEG . "</option>"
	."<option name='xCensorMode' value='3' $sel3>" . _MATCHANY . "</option>"
	."</select>"
	."</td></tr><tr><td>" . _CENSORREPLACE . "</td><td>"
	."<input type='text' name='xCensorReplace' value='$CensorReplace' size='10' maxlength='10'>"
	."</td></tr></table>";
	echo '</div>';	
	echo '</div>';	
    echo "<input type='hidden' name='op' value='ConfigSave'>"
	."<center><input type='submit' value='" . _SAVECHANGES . "'></center>"
	."</form>";
$inlineuiJS = '<script type="text/javascript">
          var ConfigSave=new ddtabcontent("conftab")
          ConfigSave.setpersist(true)
          ConfigSave.setselectedClassTarget("link")
          ConfigSave.init()
          </script>';
addJSToBody($inlineuiJS,'inline');	  
    CloseTable();
    @include_once("footer.php");
}
switch($op) {
    case "Configure":
    Configure();
    break;
    case "ConfigSave":
    global $prefix, $db, $admin_file;
    $xsitename = htmlentities($xsitename, ENT_QUOTES);
    $xslogan = htmlentities($xslogan, ENT_QUOTES);
    $xbackend_title = htmlentities($xbackend_title, ENT_QUOTES);
    $xnotify_subject = htmlentities($xnotify_subject, ENT_QUOTES);
    $xsingleaccountname = htmlentities($xsingleaccountname, ENT_QUOTES);
    $db->sql_query("UPDATE ".$prefix."_config SET sitename='$xsitename', nukeurl='$xnukeurl', site_logo='$xsite_logo', slogan='$xslogan', startdate='$xstartdate', adminmail='$xadminmail', anonpost='$xanonpost', Default_Theme='$xDefault_Theme', foot1='$xfoot1', foot2='$xfoot2', foot3='$xfoot3', commentlimit='$xcommentlimit', anonymous='$xanonymous', minpass='$xminpass', pollcomm='$xpollcomm', articlecomm='$xarticlecomm', broadcast_msg='$xbroadcast_msg', my_headlines='$xmy_headlines', top='$xtop', storyhome='$xstoryhome', user_news='$xuser_news', oldnum='$xoldnum', ultramode='$xultramode', banners='$xbanners', adb_chk='$xadb_chk', backend_title='$xbackend_title', backend_language='$xbackend_language', language='$xlanguage', locale='$xlocale', multilingual='$xmultilingual', useflags='$xuseflags', notify='$xnotify', notify_email='$xnotify_email', notify_subject='$xnotify_subject', notify_message='$xnotify_message', notify_from='$xnotify_from', moderate='$xmoderate', admingraphic='$xadmingraphic', httpref='$xhttpref', httprefmax='$xhttprefmax', CensorMode='$xCensorMode', CensorReplace='$xCensorReplace', displayerror='$xpnpadmerr', login_bar='$xlogin_bar'");
    Header("Location: ".$admin_file.".php?op=Configure");
    break;
}
} else {
    echo "Access Denied!";
}
?>