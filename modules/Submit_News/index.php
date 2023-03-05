<?php
/************************************************************************/
/* Tricked Out News 2.4a                                                */ 
/* PHP-Platinum Nuke Pro: Expect to be impressed              COPYRIGHT */
/* Copyright (c) 2011 - 2017 by http://www.havocst.net                  */
/* DocHaVoC   (dochavoc(at)havocst(dot)net)                             */ 
/* This is a heavily modified version of the original Platinum Nuke     */ 
/* news module, to act and look more like a blog.                       */ 
/* Tricked Out News that was created originally for RavenNuke(tm)       */ 
/* by Nuken at http://trickedoutnews.com                                */ 
/* Converted to Platinum Nuke by DocHaVoC http://www.havocst.net        */
/************************************************************************/
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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

/************************************************************************/
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
#########################################################################

require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = '- '._SUBMITNEWS;
$index = 1;
if (!isset($address)) { $address = ''; }
if (!isset($alanguage)) { $alanguage = ''; }
if (!isset($posttype)) { $posttype = ''; }
if (!isset($op)) $op = '';

switch($op) {

    case _PREVIEW:
        PreviewStory($name, $address, $subject, $story, $storyext, $tags, $topic, $alanguage, $posttype);
    break;

    case _OK:
        SubmitStory($name, $address, $subject, $story, $storyext, $topic, $tags, $alanguage, $posttype);
    break;

    default:
        defaultDisplay();
    break;

}
die();

//Only functions below this line

function defaultDisplay() {
    global $AllowableHTML, $prefix, $user, $cookie, $anonymous, $currentlang, $multilingual, $db, $module_name, $language;
    include_once('header.php');
    OpenTable();
    echo '<center><p class="title"><strong>'._SUBMITNEWS.'</strong></p>';
    echo '<p class="content"><i>'._SUBMITADVICE.'</i></p></center>';
    CloseTable();
    echo '<br />';
    OpenTable();
    if (is_user($user)) getusrinfo($user);
    echo '<div class="content"><form action="modules.php?name='.$module_name.'" method="post">'
        .'<p><strong>'._YOURNAME.':</strong> ';
    if (is_user($user)) {
        cookiedecode($user);
        echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]';
    } else {
        echo $anonymous.' [ <a href="modules.php?name=Your_Account">'._NEWUSER.'</a> ]';
    }
    echo '</p><p>'
        .'<strong>'._SUBTITLE.':</strong> '
        .'('._BEDESCRIPTIVE.')<br />'
        .'<input type="text" name="subject" size="50" maxlength="80" /><br />('._BADTITLES.')'
        .'</p><p>'
        .'<strong>'._TOPIC.':</strong> <select name="topic">';
    $result = $db->sql_query('SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext');
    echo '<option value="" selected="selected">'._SELECTTOPIC.'</option>';
    while ($row = $db->sql_fetchrow($result)) {
        $topicid = intval($row['topicid']);
        $topics = stripslashes(check_html($row['topictext'], 'nohtml'));
        echo '<option value="'.$topicid.'">'.$topics.'</option>';
    }
    echo '</select></p><p>';
    if ($multilingual == 1) {
        echo '<strong>'._LANGUAGE.': </strong>'
            .'<select name="alanguage">';
        $handle=opendir('language');
        $languageslist = '';
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(' ', $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if(!empty($languageslist[$i])) {
            echo '<option value="'.$languageslist[$i].'" ';
            if($languageslist[$i]==$currentlang) echo 'selected="selected"';
            echo '>'.ucfirst($languageslist[$i]).'</option>';
            }
        }
        echo '</select>';
    } else {
        echo '<input type="hidden" name="alanguage" value="'.$language.'" />';
    }
    echo '</p><div>'
        .'<strong>'._STORYTEXT.':</strong> ('._HTMLISFINE.')<br />';
    wysiwyg_textarea('story', '', 'NukeUser', '50', '12');
    echo '</div><div><strong>'._EXTENDEDTEXT.':</strong><br />';
    wysiwyg_textarea('storyext', '', 'NukeUser', '50', '12');
    echo '</div><p>('._AREYOUSURE.')</p><p>'
//tag cloud start
."<br />" ._TAGSCLOUD. ": <input type=\"text\" name=\"tags\" size=\"40\" maxlength=\"255\"> <span style=\"font-size:9px\">("._SEPARATEDBYCOMMAS.")</span><br /><br />"
//end tag cloud
        ._ALLOWEDHTML.'<br />';
    while (list($key) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
    echo '</p><p><input type="submit" name="op" value="'._PREVIEW.'" />&nbsp;&nbsp;';
    echo '<br />('._SUBPREVIEW.')</p></form></div>';
    CloseTable();
    include_once('footer.php');
}

function PreviewStory($name, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype) {
    global $advanced_editor, $user, $cookie, $bgcolor1, $bgcolor2, $anonymous, $prefix, $multilingual, $AllowableHTML, $db, $module_name;
    include_once('header.php');
    $subject = stripslashes(check_html($subject, 'nohtml'));
    $story = stripslashes(check_html($story));
    $storyext = stripslashes(check_html($storyext));
    $f_story = $story;
    $f_storyext = $storyext;
    $story2 = $f_story.'<br /><br />'.$f_storyext;
    title(_NEWSUBPREVIEW);
    OpenTable();
    echo '<center><p><i>'._STORYLOOK.'</i></p></center>';
    echo '<table width="70%" bgcolor="'.$bgcolor2.'" cellpadding="0" cellspacing="1" border="0" align="center"><tr><td>'
        .'<table width="100%" bgcolor="'.$bgcolor1.'" cellpadding="8" cellspacing="1" border="0"><tr><td>';
    if (empty($topic)) {
        $topic = 0;
        $topicimage='AllTopics.gif';
        $warning = '<center><p><strong>'._SELECTTOPIC.'</strong></p></center>';
    } else {
        $topic = intval($topic);
        $warning = '';
        $row = $db->sql_fetchrow($db->sql_query('SELECT topicimage FROM '.$prefix.'_topics WHERE topicid=\''.$topic.'\''));
        $topicimage = stripslashes($row['topicimage']);
    }
    echo '<img src="images/topics/'.$topicimage.'" border="0" align="right" alt="" />';
    themepreview($subject, $story2);
    echo $warning
        .'</td></tr></table></td></tr></table>'
        .'<center><p class="tiny">'._CHECKSTORY.'</p></center>';
    CloseTable();
    echo '<br />';

    OpenTable();
    echo '<div class="content"><form action="modules.php?name='.$module_name.'" method="post">'
        .'<p><strong>'._YOURNAME.':</strong> ';
    if (is_user($user)) {
        cookiedecode($user);
        echo '<a href="modules.php?name=Your_Account">'.$cookie[1].'</a> [ <a href="modules.php?name=Your_Account&amp;op=logout">'._LOGOUT.'</a> ]';
    } else {
        echo $anonymous;
    }
    echo '</p><p><strong>'._SUBTITLE.':</strong><br />'
        .'<input type="text" name="subject" size="50" maxlength="80" value="'.$subject.'" />'
        .'</p><p><strong>'._TOPIC.': </strong><select name="topic">';
    $result2 = $db->sql_query('SELECT topicid, topictext FROM '.$prefix.'_topics ORDER BY topictext');
    if ($topic == 0) {
        echo '<option value="" selected="selected">'._SELECTTOPIC.'</option>';
    } else {
        echo '<option value="">'._SELECTTOPIC.'</option>';
    }
    while ($row2 = $db->sql_fetchrow($result2)) {
        $sel = '';
        $topicid = intval($row2['topicid']);
        $topics = stripslashes(check_html($row2['topictext'], 'nohtml'));
        if ($topicid == $topic) {
            $sel = ' selected="selected"';
        }
        echo '<option'.$sel.' value="'.$topicid.'">'.$topics.'</option>';
    }
    echo '</select></p>';
    if ($multilingual == 1) {
        $langFound = '';
        $languageslist = '';
        echo '<p><strong>'._LANGUAGE.': </strong> '
            .'<select name="alanguage">';
        $handle=opendir('language');
        while ($file = readdir($handle)) {
            if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= $langFound.' ';
            }
        }
        closedir($handle);
        $languageslist = explode(' ', $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if(!empty($languageslist[$i])) {
            echo '<option value="'.$languageslist[$i].'" ';
            if($languageslist[$i]==$alanguage) echo 'selected="selected"';
            echo '>'.ucfirst($languageslist[$i]).'</option>';
            }
        }
        echo '</select></p>';
    }
    echo '<div><strong>'._STORYTEXT.':</strong> ('._HTMLISFINE.')<br />';
    if (!isset($advanced_editor) || $advanced_editor == 0) $story = htmlentities($story, ENT_QUOTES);
    wysiwyg_textarea('story', $story, 'NukeUser', '50', '12');
    echo '</div><div><strong>'._EXTENDEDTEXT.':</strong><br />';
    if (!isset($advanced_editor) || $advanced_editor == 0) $storyext = htmlentities($storyext, ENT_QUOTES);
    wysiwyg_textarea('storyext', $storyext, 'NukeUser', '50', '12');
    echo '</div><p>('._AREYOUSURE.')</p>'
//tag cloud start
."<br />" ._TAGSCLOUD. ": <input type=\"text\" name=\"tags\" value=\"$tags\" size=\"40\" maxlength=\"255\"> <span style=\"font-size:9px\">("._SEPARATEDBYCOMMAS.")</span><br /><br />"
//tag cloud end
        .'<p>'._ALLOWEDHTML.'<br />';
    while (list($key,) = each($AllowableHTML)) echo ' &lt;'.$key.'&gt;';
    echo '</p>';
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk;
    echo security_code($modGFXChk[$module_name], 'stacked');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    echo '<br /><input type="submit" name="op" value="'._PREVIEW.'" />&nbsp;&nbsp;'
        .'<input type="submit" name="op" value="'._OK.'" />';
    echo '</form></div>';
    CloseTable();
    include_once('footer.php');
}

function submitStory($name, $address, $subject, $story, $storyext, $topic, $tags, $alanguage, $posttype) {
    global $user, $EditedMessage, $cookie, $anonymous, $notify, $notify_email, $notify_subject, $notify_message, $notify_from, $prefix, $db;
    include_once('header.php');
    OpenTable();
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk, $module_name;
    if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
    if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/
        echo '<center><font class="option"><strong><i>'._SECCODEINCOR.'</i></strong></font><br /><br />';
        echo '[ <a href="javascript:history.go(-2)">'._GOBACK2.'</a> ]</center>';
        CloseTable();
        include_once('footer.php');
        die();
    }
    if (is_user($user)) {
        cookiedecode($user);
        $uid = $cookie[0];
        $name = $cookie[1];
    } else {
        $uid = 1;
        $name = $anonymous;
    }
    $subject = str_replace('"', "''", $subject);
    $subject = FixQuotes(filter_text($subject, 'nohtml'));
    $story = FixQuotes(check_words(check_html($story)));
    $storyext = FixQuotes(check_words(check_html($storyext)));
	// tag cloud start
    $tags = stripslashes(check_html($tags, "nohtml"));
// tag cloud end
    $result = $db->sql_query('INSERT INTO '.$prefix.'_queue VALUES (NULL, \''.$uid.'\', \''.$name.'\', \''.$subject.'\', \''.$story.'\', \''.$storyext.'\', now(), \''.$topic.'\', \''.$alanguage.'\')');
// tag cloud start
$sql_id = $db->sql_query("SELECT qid FROM ".$prefix."_queue WHERE uname='$name' AND subject='$subject' AND 	topic='$topic'"); 
$row = $db->sql_fetchrow($sql_id);
$qid = $row['qid'];
   if ($tags!="") {
				$tags = explode(",",$tags);
				foreach ($tags as $tag) {
				$tag = addslashes(check_words(check_html($tag, "nohtml")));
					$db->sql_query("INSERT INTO ".$prefix."_tags_temp (tag,cid,whr) VALUES ('".trim($tag)."','$qid','6')");
				}
			}
//tag cloud end
    if(!$result) {
        echo '<p>'._ERROR.'</p>';
        CloseTable();
        include_once('footer.php');
        die();
    }
        if($notify) {
        $notify_message = "$notify_message\n\n\n========================================================\n$subject\n\n\n$story\n\n$storyext\n\n$name";
      mail($notify_email, $notify_subject, $notify_message, "From: $notify_from\nX-Mailer: PHP/" . phpversion());
    }
    $waiting = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_queue'));
    echo '<center><p class="title">'._SUBSENT.'</p></center>'
        .'<div class="content" align="center"><p><strong>'._THANKSSUB.'</strong></p>'
        .'<p>'._SUBTEXT.'</p>'
        .'<p>'._WEHAVESUB.' '.$waiting.' '._WAITING.'</p></div>';
    CloseTable();
    include_once('footer.php');
}

?>
