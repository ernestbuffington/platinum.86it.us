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
    die('You can\'t access this file directly...');
}
require_once('mainfile.php');
if (!isset($op)) $op = '';
if (!isset($gfx_check)) $gfx_check = '';

$optionbox = '';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
// TON mod
$sql = "SELECT rblocks, showtags FROM ".$prefix."_news_config";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);   
    $rblocks =  stripslashes(check_html($row['rblocks'], 'nohtml'));
    $showtags = stripslashes(check_html($row['showtags'], 'nohtml'));
if ($rblocks == '1') {
define('INDEX_FILE', TRUE);
}

if (isset($sid)) { $sid = intval($sid); } else { $sid = ''; }
if (stristr($_SERVER['REQUEST_URI'],'mainfile')) {
    Header('Location: modules.php?name='.$module_name.'&file=article&sid='.$sid);
} elseif (empty($sid) && !isset($tid)) {
    Header('Location: index.php');
}

if(isset($user)) {
    cookiedecode($user);
}

if(is_user($user)) {
    getusrinfo($user);
    if(!isset($mode)) { $mode = $userinfo['umode']; }
    if(!isset($order)) { $order = $userinfo['uorder']; }
    if(!isset($thold)) { $thold = $userinfo['thold']; }
    $db->sql_query('UPDATE '.$user_prefix.'_users SET umode=\''.$mode.'\', uorder=\''.$order.'\', thold=\''.$thold.'\' where user_id=\''.intval($cookie[0]).'\'');
}

if ($op == 'Reply') {
    $display = '';
    if(isset($mode)) { $display .= '&mode='.$mode; }
    if(isset($order)) { $display .= '&order='.$order; }
    if(isset($thold)) { $display .= '&thold='.$thold; }
    Header('Location: modules.php?name='.$module_name.'&file=comments&op=Reply&pid=0&sid='.$sid.$display);
}

$result = $db->sql_query('SELECT catid, aid, time, title, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings, associated FROM '.$prefix.'_stories where sid=\''.$sid.'\'');
//Causes trouble, has to be fixed
$numrows = $db->sql_numrows($result);
//if (!empty($sid) && $numrows != 1) {
	// Modified by Raven 1/10/2007
	if (intval($numrows)!=1) {
    Header('Location: index.php');
    die();
}
$row = $db->sql_fetchrow($result);
$catid = intval($row['catid']);
$aaid = stripslashes($row['aid']);
$time = $row['time'];
$title = stripslashes(check_html($row['title'], 'nohtml'));
$hometext = stripslashes($row['hometext']);
$bodytext = stripslashes($row['bodytext']);
$topic = intval($row['topic']);
$informant = stripslashes($row['informant']);
$notes = stripslashes($row['notes']);
$acomm = intval($row['acomm']);
$haspoll = intval($row['haspoll']);
$pollID = intval($row['pollID']);
$score = intval($row['score']);
$ratings = intval($row['ratings']);
$associated = stripslashes($row['associated']);
# nukeSEO Social Bookmarking added Tricked Out News
require_once("includes/nukeSEO_SB.php");
//require_once("includes/nukeSEO_sSB.php");
global $nukeurl, $subject;
$articleurl = $nukeurl."/modules.php?name=News&file=article&sid=$sid";
$articletitle = $title;
$socialbookmarkHTML = getBookmarkHTML( $articleurl, $articletitle, "&nbsp;", "small");
//$socialbookmarkHTML2 = getBookmarkHTML2( $articleurl, $articletitle, "&nbsp;", "medium");
# nukeSEO Social Bookmarking

if (empty($aaid)) {
    Header('Location: modules.php?name='.$module_name);
    die();
}

$db->sql_query('UPDATE '.$prefix.'_stories SET counter=counter+1 where sid='.$sid);

$artpage = 1;
$pagetitle = '- '.$title;
include_once('header.php');
$artpage = 0;

formatTimestamp($time);
$title = stripslashes(check_html($title, 'nohtml'));
$hometext = stripslashes($hometext);
$bodytext = stripslashes($bodytext);
$notes = stripslashes($notes);

/* montego - unfortunately, FB wrote articles.php differently than index.php.  In index.php, no he relies
   on the theme to format each article, which is the right way of doing it. Then, for some reason, in
   article.php, he does it differently.  This wreaks havoc with HTML/XHTML compliance. I see that most of
   the core PHP-Nuke themes do formatting in both themeindex() and themearticle(), therefore, I think it
   best to do this the right way, and remove it from here.  Yes, it could break some themes, but if we
   want to be compliant... we'll just have to help folks out.  We will pass $notes as we should.

if (!empty($notes)) {
    $notes = '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
} else {
    $notes = '';
}
*/

if(empty($bodytext)) {
    $bodytext = $hometext;
} else {
    $bodytext = $hometext.'<br /><br />'.$bodytext;
}

if(empty($informant)) {
    $informant = $anonymous;
}

getTopics($sid);

if ($catid != 0) {
    $row2 = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_stories_cat WHERE catid=\''.$catid.'\''));
    $title1 = stripslashes(check_html($row2['title'], 'nohtml'));
    $title = '<a href="modules.php?name='.$module_name.'&amp;file=categories&amp;op=newindex&amp;catid='.$catid.'"><span class="storycat">'.$title1.'</span></a>: '.$title;
}

echo '<table width="100%" border="0"><tr><td valign="top" width="100%">'."\n";
themearticle($aaid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext, $notes);
/* Start show tags mod */
if ($showtags){
$result = $db->sql_query("SELECT tag FROM ".$prefix."_tags WHERE cid='$sid'");
	$istag=$db->sql_numrows($result);
	if($istag>0){
	Opentable();
	echo '<div><img src="images/news/tag.png" alt="Tags" align="left" />&nbsp;';	
		while ($row = $db->sql_fetchrow($result)) {
			$tag = addslashes(check_words(check_html($row['tag'], "nohtml")));
			$num = $db->sql_numrows($db->sql_query("SELECT tag FROM ".$prefix."_tags WHERE tag='$tag'"));
			if ($num<=1) { $dim = "class1"; }
			else if ($num<=5) { $dim = "class2"; }
			else if ($num<=20) { $dim = "class3"; }
			else if ($num<=50) { $dim = "class4"; }
			else { $dim = "class5"; }		
			echo '<span class="'.$dim.'"><a href="modules.php?name=Tags&amp;op=list&amp;tag='.urlencode($tag).'" title="'.$tag.'">'.$tag.'</a></span> ';
		}
	echo '</div>';
	Closetable();
	}
}
/* End show tags mod */
if (empty($mode) OR $mode != 'nocomments' OR $acomm == 0 OR $articlecomm == 1) {
    include_once('modules/News/comments.php');
}
echo '</td><td>&nbsp;</td><td valign="top">'."\n";

if ($multilingual == 1) {
    $querylang = 'AND (blanguage=\''.$currentlang.'\' OR blanguage=\'\')';
} else {
    $querylang = '';
}

/* Determine if the article has attached a poll */
if ($haspoll == 1) {
    $url = sprintf('modules.php?name=Surveys&amp;op=results&amp;pollID=%d', $pollID);
    $boxContent = '<form action="modules.php?name=Surveys" method="post">';
    $boxContent .= '<input type="hidden" name="pollID" value="'.$pollID.'" />';
    $boxContent .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
    $row3 = $db->sql_fetchrow($db->sql_query('SELECT pollTitle, voters FROM '.$prefix.'_poll_desc WHERE pollID=\''.$pollID.'\''));
    $pollTitle = stripslashes(check_html($row3['pollTitle'], 'nohtml'));
    $voters = $row3['voters'];
    $boxTitle = _ARTICLEPOLL;
    $boxContent .= '<font class="content"><strong>'."$pollTitle".'</strong></font><br /><br />'."\n";
    $boxContent .= '<table border="0" width="100%">';
    for($i = 1; $i <= 12; $i++) {
        $result4 = $db->sql_query('SELECT pollID, optionText, optionCount, voteID FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\'');
        $row4 = $db->sql_fetchrow($result4);
        $numrows = $db->sql_numrows($result4);
        if($numrows != 0) {
            $optionText = $row4['optionText'];
            if(!empty($optionText)) {
                $boxContent .= '<tr><td valign="top"><input type="radio" name="voteID" value="'.$i.'" /></td><td width="100%"><font class="content">'.$optionText.'</font></td></tr>'."\n";
            }
        }
    }
    $boxContent .= '</table><br /><center><font class="content"><input type="submit" value="'._VOTE.'" /></font><br />';
    if (is_user($user)) {
        cookiedecode($user);
    }
    if (!isset($sum)) $sum = 0;
    for($i = 0; $i < 12; $i++) {
        $row5 = $db->sql_fetchrow($db->sql_query('SELECT optionCount FROM '.$prefix.'_poll_data WHERE pollID=\''.$pollID.'\' AND voteID=\''.$i.'\''));
        $optionCount = $row5['optionCount'];
        $sum = (int)$sum+$optionCount;
    }
    $boxContent .= '<font class="content">[ <a href="modules.php?name=Surveys&amp;op=results&amp;pollID='.$pollID.'&amp;mode='.$userinfo['umode'].'&amp;order='.$userinfo['uorder'].'&amp;thold='.$userinfo['thold'].'"><strong>'._RESULTS.'</strong></a> | <a href="modules.php?name=Surveys"><strong>'._POLLS.'</strong></a> ]<br />';

    if ($pollcomm) {
        $result6 = $db->sql_query('SELECT * FROM '.$prefix.'_pollcomments WHERE pollID=\''.$pollID.'\'');
        $numcom = $db->sql_numrows($result6);
        $boxContent .= '<br />'._VOTES.': <strong>'.$sum.'</strong><br />'._PCOMMENTS.' <strong>'.$numcom.'</strong>'."\n\n";
    } else {
        $boxContent .= '<br />'._VOTES.' <strong>'.$sum.'</strong>'."\n\n";
    }
    $boxContent .= '</font></center></form>'."\n\n";
    themesidebox($boxTitle, $boxContent);
}

$row7 = $db->sql_fetchrow($db->sql_query('SELECT title, content, active, bposition FROM '.$prefix.'_blocks WHERE blockfile=\'block-Login.php\''." $querylang"));
$title = stripslashes(check_html($row7['title'], 'nohtml'));
$content = stripslashes($row7['content']);
$active = intval($row7['active']);
$position = $row7['bposition'];
$position = substr($position, 0,1);
if (($active == 1) AND ($position == 'r') AND (!is_user($user))) {
    loginbox($gfx_check);
}

$boxtitle = _RELATED;
$boxstuff = '<font class="content">';
$result8 = $db->sql_query('SELECT name, url FROM '.$prefix.'_related WHERE tid=\''.$topic.'\'');
while ($row8 = $db->sql_fetchrow($result8)) {
    $name = stripslashes($row8['name']);
    $url = stripslashes($row8['url']);
    $boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$url.'" target="_blank">'.$name.'</a><br />'."\n";
}

$boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Search&amp;topic='.$topic.'">'._MOREABOUT.' '.$topictext.'</a><br />'."\n";
$boxstuff .= '<strong><big>&middot;</big></strong>&nbsp;<a href="modules.php?name=Search&amp;author='.$aaid.'">'._NEWSBY.' '.$aaid.'</a>'."\n";
$boxstuff .= '</font><br /><hr noshade="noshade" width="95%" size="1" /><center><font class="content"><strong>'._MOSTREAD.' '.$topictext.':</strong><br />'."\n";

global $multilingual, $currentlang, $admin_file, $user;
if ($multilingual == 1) {
    $querylang = 'AND (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = '';
}
$row9 = $db->sql_fetchrow($db->sql_query('SELECT sid, title FROM '.$prefix.'_stories WHERE topic=\''.$topic."' $querylang".' ORDER BY counter DESC LIMIT 0,1'));
$topstory = intval($row9['sid']);
$ttitle = stripslashes(check_html($row9['title'], 'nohtml'));

$boxstuff .= '<a href="modules.php?name='.$module_name.'&amp;file=article&amp;sid='.$topstory.'">'.$ttitle.'</a></font></center><br />'."\n";
themesidebox($boxtitle, $boxstuff);

if ($ratings != 0) {
    $rate = substr($score / $ratings, 0, 4);
    $r_image = round($rate);
    if ($r_image == 1) {
        $the_image = '<br /><br /><img src="images/articles/stars-1.gif" border="1" alt="" /></center><br />';
    } elseif ($r_image == 2) {
        $the_image = '<br /><br /><img src="images/articles/stars-2.gif" border="1" alt="" /></center><br />';
    } elseif ($r_image == 3) {
        $the_image = '<br /><br /><img src="images/articles/stars-3.gif" border="1" alt="" /></center><br />';
    } elseif ($r_image == 4) {
        $the_image = '<br /><br /><img src="images/articles/stars-4.gif" border="1" alt="" /></center><br />';
    } elseif ($r_image == 5) {
        $the_image = '<br /><br /><img src="images/articles/stars-5.gif" border="1" alt="" /></center><br />';
    }
} else {
    $rate = 0;
    $the_image = '</center><br />';
}

$ratetitle = _RATEARTICLE;
$ratecontent = '<center>'._AVERAGESCORE.': <strong>'.$rate.'</strong><br />'._VOTES.': <strong>'.$ratings.'</strong>'.$the_image;
$ratecontent .= '<form action="modules.php?name='.$module_name.'" method="post"><center>'._RATETHISARTICLE.'</center><br />';
$ratecontent .= '<input type="hidden" name="sid" value="'.$sid.'" />';
$ratecontent .= '<input type="hidden" name="op" value="rate_article" />';
$ratecontent .= '<input type="radio" name="score" value="5" /> <img src="images/articles/stars-5.gif" border="0" alt="'._EXCELLENT.'" title="'._EXCELLENT.'" /><br />';
$ratecontent .= '<input type="radio" name="score" value="4" /> <img src="images/articles/stars-4.gif" border="0" alt="'._VERYGOOD.'" title="'._VERYGOOD.'" /><br />';
$ratecontent .= '<input type="radio" name="score" value="3" /> <img src="images/articles/stars-3.gif" border="0" alt="'._GOOD.'" title="'._GOOD.'" /><br />';
$ratecontent .= '<input type="radio" name="score" value="2" /> <img src="images/articles/stars-2.gif" border="0" alt="'._REGULAR.'" title="'._REGULAR.'" /><br />';
$ratecontent .= '<input type="radio" name="score" value="1" /> <img src="images/articles/stars-1.gif" border="0" alt="'._BAD.'" title="'._BAD.'" /><br /><br />';
$ratecontent .= '<center><input type="submit" value="'._CASTMYVOTE.'" /></center></form>';
themesidebox($ratetitle, $ratecontent);

$optiontitle = _OPTIONS;
$optionbox = '<center><br />';
$optionbox .= '<a href="modules.php?name='.$module_name.'&amp;file=print&amp;sid='.$sid.'" style="text-decoration: none"><img src="images/news/print.gif" border="0" alt="'._PRINTER.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._PRINTER.']body=[]" /> </a>';
# Tricked Out News Pdf link and images added to match Social Bookmarking
$optionbox .= '<a target="_blank" href="modules.php?name='.$module_name.'&amp;file=printpdf&amp;id='.$sid.'" style="text-decoration: none"><img src="images/news/pdf.png" border="0" alt="'._PDF.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._PDF.']body=[]" /></a>&nbsp;';
if (is_user($user)) {
    $optionbox .= '<a href="modules.php?name='.$module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$sid.'" style="text-decoration: none"><img src="images/news/friend.gif" border="0" alt="'._FRIEND.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._FRIEND.']body=[]" /></a>&nbsp;';
}
$optionbox .=  '<a href="backend.php" style="text-decoration: none"><img src="images/news/rss.png" border="0" alt="'._RSS.'" title="cssheader=[tonheaderclass] cssbody=[tonbodyclass] header=['._RSS.']body=[]" /> </a><br />';
# nukeSEO Social Bookmarking added Tricked Out News

$optionbox .=  $socialbookmarkHTML;

# nukeSEO Social Bookmarking
$optionbox .= "</center><br />\n";
if (is_admin($admin)) {
    $optionbox .= '<center><strong>'._ADMIN.'</strong><br />[ <a href="'.$admin_file.'.php?op=adminStory">'._ADD.'</a> | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</center><br /><br />';
}

themesidebox($optiontitle, $optionbox);

echo '</td></tr></table>'."\n";
cookiedecode($user);

//RN0000453 - montego - unnecessary include and SQL call
if (!empty($associated)) {
    OpenTable();
    echo '<center><strong>'._ASSOTOPIC.'</strong><br /><br />';
    $asso_t = explode('-',$associated);
    for ($i=0; $i<sizeof($asso_t); $i++) {
        if (!empty($asso_t[$i])) {
            $query = $db->sql_query('SELECT topicimage, topictext from '.$prefix.'_topics WHERE topicid=\''.(int)$asso_t[$i].'\'');
            list($topicimage, $topictext) = $db->sql_fetchrow($query);
            echo '<a href="modules.php?name='.$module_name.'&amp;new_topic='.(int)$asso_t[$i].'"><img src="'.$tipath.$topicimage.'" border="0" hspace="10" alt="'.$topictext.'" title="'.$topictext.'" /></a>';
        }
    }
    echo '</center>';
    CloseTable();
    echo '<br />';
}

// Removed not needed parentheses grouping - Raven 1/10/2007
//if (empty($mode) OR $mode != 'nocomments' OR $acomm == 0 OR $articlecomm == 1) {
//    include_once('modules/News/comments.php');
//}
//RN0000242: Fix by Montego on 6/12/2006 to work with change made in comments.php
include_once ('footer.php');

?>