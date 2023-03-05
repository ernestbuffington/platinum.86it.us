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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

$storynum = 20; //How many per page
$title_length = 20; //Maximum char for news titles
$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- $sitename "._CZNEWS."";

function pagejumper($numpages, $pagenum, $url) {
	if ($numpages > 1) {
            echo "<div align=\"right\">\n<form>\n"._CZPAGE.": <select name='jump' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
		for ($i=1; $i < $numpages+1; $i++) {
		   if ($i == $pagenum) { $sel = "SELECTED"; } else { $sel = ""; }
			 echo "<option value=\"".$url."$i\" $sel>$i</option>\n";
		}
            echo "</select></form>\n</div>\n";
	}
}

function cut_word($val, $cut_len) {
    $tot_len = strlen($val);
    $cut_str = substr($val, 0, $cut_len);
    $len = strlen($cut_str);
    for($i=0;$i < $len;$i++) {
    for($i=0;$i < $len;$i++) {
        if(ord($val[$i]) > 127) $hanlen++;
            else $englen++;
        }
    $cut_gap = $hanlen % 2;
        if($cut_gap == 1){ 
		$hanlen--;
	  }
    $length=$hanlen + $englen;

	  if($tot_len > $length){ 
		return substr($val, 0, $length)."...";
	  } else {
	      return substr($val, 0, $length);
	  }
    }
}


function index() {
    global $module_name, $db, $storyhome, $userinfo, $user, $prefix, $datetime, $locale, $bgcolor2, $textcolor1, $sitename, $bgcolor1, $pagenum, $home, $storynum, $title_length;
    include_once("header.php");
    getusrinfo($user);  
    if ($pagenum == "") { $pagenum = 1; }
    $offset = ($pagenum-1) * $storynum;
    automated_news();
    echo "<script language=\"javascript\" type=\"text/javascript\" src=\"modules/$module_name/news.js\"></script>\n";
    echo "<div id=\"outsidelinks_two\" style=\"position:absolute;width:350;display:none;\">\n";
    echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$textcolor1\">\n";
    echo "<tr bgcolor=\"$bgcolor2\">\n";
    echo "<td>\n";
    echo "<div id=\"insidelinks_two\" style=\"display:none;\"></div>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "</div>\n";
    Opentable();
    echo "<br /><fieldset><legend>"._CZNEWSSTORIES."</legend><br />\n";
    $result = $db->sql_query("SELECT s.sid, s.title, s.time, s.comments, s.counter, s.topic, s.informant, s.acomm, s.score, s.ratings, t.topicid, t.topictext FROM {$prefix}_stories AS s LEFT JOIN {$prefix}_topics AS t ON s.topic = t.topicid ORDER BY s.time DESC limit $offset, $storynum");
    while ($row = $db->sql_fetchrow($result)) {
      $sid = intval($row['sid']);
      $title = $row['title'];
      $time = $row['time'];
      formatTimestamp($time);
      $comments = intval($row['comments']);
      $counter = intval($row['counter']);
      $topic = intval($row['topic']);
      $informant = $row['informant'];
      $acomm = intval($row['acomm']);
      $score = intval($row['score']);
      $ratings = $row['ratings'];
      $topicid = intval($row['topicid']);
      $topicname = $row['topictext'];
	$r_options = "";
      if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=$userinfo[umode]"; }
      if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=$userinfo[uorder]"; }
      if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=$userinfo[thold]"; }
	$show_title = cut_word($title, $title_length);
      if ($score != 0) {
	    $rated = substr($score / $ratings, 0, 4);
	} else {
	    $rated = 0;
	} 
      $counter = number_format($counter);
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"80%\">\n"
        ."<tr><td>\n"
	  ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"90%\">\n"
	  ."<tr height=18 onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor=''\" onclick=\"window.location.href='modules.php?name=News&amp;file=article&amp;sid=$sid$r_options'\" style=\"cursor:hand;\">\n"
	  ."<td align=\"left\" width=\"70%\" nowrap>&nbsp;<strong><big>&middot;</big></strong>"
        ."&nbsp;<small><small><strong>(<a href='modules.php?name=News&amp;new_topic=$topicid'>$topicname</a>)</strong></small></small>&nbsp;"
	  ."&nbsp;<a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\" onmouseover=\"showNewsTip('show','"._CZCOMMENTS." ( $comments ) "._CZVOTES." ( $ratings ) "._CZSCORE." $rated -- "._CZSUBMITTEDBY." $informant')\"  OnMouseMove=\"followNewsTip('show')\" onmouseout=\"showNewsTip('hide')\">$show_title</a></td>\n"
	  ."<td align=\"right\" nowrap><small>($counter "._CZREADS.")</small>&nbsp;</td><td align=\"right\" nowrap><small><i>".$datetime."</i></small>&nbsp;</td>\n"
	  ."</tr></table></td></tr></table>\n"
	  ."<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" align=\"center\">\n"
	  ."<tr>\n"
	  ."<td height=1 bgcolor=\"$textcolor1\"></td>\n"
	  ."</tr>\n"
	  ."</table>\n";
      }
    $db->sql_freeresult($result);
    echo "<br />";
    $sql = "SELECT COUNT(*) FROM {$prefix}_stories WHERE sid > 0";
    list($numstories) = $db->sql_fetchrow($db->sql_query($sql));
    $numpages = ceil($numstories / $storynum);
    pagejumper($numpages, $pagenum, "modules.php?name=$module_name&pagenum=");
    echo "<br /><center><strong>";
if (is_user($user)) {
    echo "[ <a href=\"modules.php?name=Submit_News\">"._CZSUBMITNEWS."</a> ] - ";
} 
    echo "[ <a href=\"modules.php?name=News\">"._CZALLNEWS."</a> ]</strong></center><br />";
    echo "</fieldset>";
    CloseTable();
    include_once("footer.php");
}

switch ($op) {

    default:
    index();
    break;

}

?>
