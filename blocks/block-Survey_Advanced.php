<?php
/************************************************************************/
/* hack1 by sid from http://phpnuke-dz.com                              */
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
require_once("mainfile.php");
global $mode,$prefix, $multilingual, $currentlang, $db, $boxTitle, $pollcomm, $user, $cookie,$_COOKIE;
if ($multilingual == 1) {
    $querylang = "WHERE planguage='$currentlang' AND artid='0'";
} else {
    $querylang = "WHERE artid='0'";
}
$sql = "SELECT pollID FROM ".$prefix."_poll_desc $querylang ORDER BY pollID DESC LIMIT 1";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$pollID = $row[pollID];
if ($pollID == 0 || $pollID == "") {
    $content .= "";
} else {
	if (empty($ip)) { $ip = $_SERVER["REMOTE_ADDR"];   }
	$revote=24*60*60;   //you can revote after 24 hours
    $past = time()-$revote; 
    $db->sql_query("DELETE FROM ".$prefix."_poll_check WHERE time < $past");
	$sql="SELECT ip,time FROM ".$prefix."_poll_check WHERE (ip='$ip') AND (pollID='$pollID')";
    $result = $db->sql_query($sql);
    list($ips,$times) = $db->sql_fetchrow($result);
   if ($ip == $ips) {
      $time=$times;
      $content = VoteResults($pollID,$ip,$time);
   } else {
    if(!isset($url))
	$url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    $content = "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $content .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $content .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $sql2 = "SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID=$pollID";
    $result2 = $db->sql_query($sql2);
    $row2 = $db->sql_fetchrow($result2);
    $pollTitle = $row2[pollTitle];
    $voters = $row2[voters];
    $boxTitle = _SURVEY;
    $content .= "<font class=\"content\"><strong>$pollTitle</strong></font><br /><br />\n";
    $content .= "<table border=\"0\" width=\"100%\">";
    for($i = 1; $i <= 12; $i++) {
	$sql3 = "SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)";
	$result3 = $db->sql_query($sql3);
	$row3 = $db->sql_fetchrow($result3);
	if(isset($row3)) {
	    $optionText = $row3[optionText];
	    if ($optionText != "") {
		$content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
	    }
	}
    }
    $content .= "</table><br /><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br />";
    if (is_user($user)) {
	cookiedecode($user);
    }
    for($i = 0; $i < 12; $i++) {
	$sql4 = "SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)";
	$result4 = $db->sql_query($sql4);
	$row4 = $db->sql_fetchrow($result4);
	$optionCount = $row4[optionCount];
	$sum = (int)$sum+$optionCount;
    }
    $content .= "<br /><font class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=$cookie[4]&amp;order=$cookie[5]&amp;thold=$cookie[6]\"><strong>"._RESULTS."</strong></a><br /><a href=\"modules.php?name=Surveys\"><strong>"._POLLS."</strong></a><br />";
    if ($pollcomm) {
	$numcom = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pollcomments WHERE pollID='$pollID'"));
	$content .= "<br />"._VOTES.": <strong>$sum</strong> <br /> "._PCOMMENTS." <strong>$numcom</strong>\n\n";
    } else {
	$content .= "<br />"._VOTES." <strong>$sum</strong>\n\n";
    }
    $content .= "</font></center></form>\n\n";
}
}
function VoteResults($pollID,$ip,$time) {
    global $pollcomm,$revote,$mode,$content,$resultTableBgColor, $resultBarFile, $Default_Theme, $user, $cookie, $prefix,$db,$admin, $module_name;
    $mode=1;    //choose your graphic 1,2 or 3
    if(!isset($pollID)) $pollID = 1;
	$sql="SELECT pollID, pollTitle, timeStamp, artid FROM ".$prefix."_poll_desc WHERE pollID='$pollID'";
    $result = $db->sql_query($sql);
    $holdtitle = $db->sql_fetchrow($result);
    $content .= "<strong>$holdtitle[1]</strong><br /><br />";
    for($i = 0; $i < 12; $i++) {
	   $sql="SELECT optionCount FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i'";
       $result = $db->sql_query($sql);
	   $object =sql_fetch_object($result,$db);
	   $optionCount =$object->optionCount;
	   $sum = (int)$sum+$optionCount;
    }
    for($i = 1; $i <= 12; $i++) {
	   $sql="SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND voteID='$i' ";
	   $result = $db->sql_query($sql);
	   $object =sql_fetch_object($result,$db);
	   if(is_object($object)) {
	     $optionText = $object->optionText;
	     $optionCount = $object->optionCount;
	        if($optionText != "") {
		       $content .= "- $optionText :<br />";
		       if($sum) {
		       $percent = 100 * $optionCount / $sum;
		       } else {
		       $percent = 0;
		       }
		       $percentInt = (int)$percent;
		       $percent2 = (int)$percent;
//			   $percent3=sprintf(" %.1f%% ", $percent);
			   $percent3=sprintf("%.0f%%", $percent);  //  JagaTelesin
               if ($mode==1){
		         if(is_user($user)) {
		            if($cookie[9]=="") $cookie[9]=$Default_Theme;
		            if(!$file=@opendir("themes/$cookie[9]")) {
		              $ThemeSel = $Default_Theme;
		             } else {
			         $ThemeSel = $cookie[9];
		             }
		         } else {
		           $ThemeSel = $Default_Theme;
		         }
		         if (file_exists("themes/$ThemeSel/images/survey_leftbar.gif") AND file_exists("themes/$ThemeSel/images/survey_mainbar.gif") AND file_exists("themes/$ThemeSel/images/survey_rightbar.gif")) {
		              $l_size = getimagesize("themes/$ThemeSel/images/survey_leftbar.gif");
    		          $m_size = getimagesize("themes/$ThemeSel/images/survey_mainbar.gif");
		              $r_size = getimagesize("themes/$ThemeSel/images/survey_rightbar.gif");
		              $leftbar = "survey_leftbar.gif";
		              $mainbar = "survey_mainbar.gif";
		              $rightbar = "survey_rightbar.gif";
		          } else {
		              $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    		         $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
		             $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
		             $leftbar = "leftbar.gif";
		             $mainbar = "mainbar.gif";
		             $rightbar = "rightbar.gif";
		         }
		         if (file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
		             $m1_size = getimagesize("themes/$ThemeSel/images/survey_mainbar_d.gif");
		             $mainbar_d = "survey_mainbar_d.gif";
		             if ($percent2 > 0 AND $percent2 <= 23) {
			            $salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$percentInt\" align=\"middle\">";
		             } elseif ($percent2 > 24 AND $percent2 < 50) {
			            $a = ($percentInt - 100)/2;
			            $salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
				        ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				        ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\" align=\"middle\">";
		             } elseif ($percent2 > 49 AND $percent2 < 75) {
                     
			             $a = ($percentInt - 200)/2;
			             $salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\" align=\"middle\">";
		             } elseif ($percent2 > 74 AND $percent2 <= 100) {
			              $a = ($percentInt - 300)/2;
			              $salto = "<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
			              ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				          ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
				          ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				          ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"70\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar_d\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m1_size[1]\" width=\"30\" align=\"middle\">"
				         ."<img src=\"themes/$ThemeSel/images/$mainbar\" alt=\"$percent2 %\" title=\"$percent2 %\" height=\"$m_size[1]\" width=\"$a\" align=\"middle\">";
		             }
		          }
                  if ($percent > 0) {
		             $content .= "<img src=\"themes/$ThemeSel/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		             if (file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
			            $content .= "$salto";
		             } else {
			             $content .= "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$percentInt\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		             }
		             $content .= "<img src=\"themes/$ThemeSel/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		          } else {
		                $content .= "<img src=\"themes/$ThemeSel/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		               if (!file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) {
			               $content .= "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$m_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		               }
		               $content .= "<img src=\"themes/$ThemeSel/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\" align=\"middle\">";
		           }
                    $content .= " $percent3";
		           $content .="<br />";
       } else { 
        if ($mode==2) {
        $color[1]="#FF3300";
        $color[2]="#33CC33";
        $color[3]="#0099FF";
        $color[4]="#990066";
        $color[5]="#FF9900";
        $color[6]="#FF0000";
        $color[7]="#FF66FF";
        $color[8]="#FFFF00";
        $color[9]="#FF3300";
        $color[10]="#FF3300";
        $color[11]="#FF3300";
        $color[12]="#FF3300";
        $content .= "<table width=\"100%\" height=\"15\" border=\"0\" >";
	if ($percent2==0) $percent2=1; 
        $content .= "<tr><td width=\"$percent2\" bgcolor=\"$color[$i]\"></td>";
		 $content .= "<td align=\"left\"> $percent3</td>";
		$content.="</tr></table>";
        }
        else {
        $color[1]="aqua.gif";
        $color[2]="red.gif";
        $color[3]="blue.gif";
        $color[4]="gold.gif";
        $color[5]="green.gif";
        $color[6]="yellow.gif";
        $color[7]="purple.gif";
        $color[8]="#orange.gif";
        $color[9]="pink.gif";
        $color[10]="darkgreen.gif";
        $color[11]="brown.gif";
        $color[12]="grey.gif";
		$content .= "<table width=\"100%\" height=\"15\" border=\"0\" >";
	if ($percent2==0) $percent2=1; 
        $content .= "<tr><td width=\"$percent2\"><img src=\"images/survey/$color[$i]\" width=\"$percent2\" height=\"15\"></td>";
		 $content .= "<td align=\"left\">$percent3</td>";
		$content.="</tr></table>";
     }
    }
       }
	}
  }
	 $content .= "<center><font class=\"content\">";
     $content .= "<br />";
	if ($pollcomm) {
	$numcom = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_pollcomments WHERE pollID='$pollID'"));
	$content .= "<br />"._VOTES.": <strong>$sum</strong> <br /> "._PCOMMENTS." <strong>$numcom</strong>\n\n";
    } else {
	$content .= "<br />"._VOTES." <strong>$sum</strong><br /><br />";
    }
	$ctime=time();
	$revote=24*60*60; //you can revote after 24 hours
	$revote_1=$time+$revote-$ctime;
	if ($revote_1 <= 60) {
	   $revote_main=$revote_1;
	   $string="second(s)";
	 } elseif ($revote_1 >60 AND $revote_1 <= 3600) {
	   $revote_main=$revote_1/60;
	   $revote_main=sprintf("%.1f",$revote_main); 
	   $string="minutes(s)";
	  } elseif ($revote_1 > 3600 AND $revote_1<=86400) {
	   $revote_main=$revote_1/3600;
	   $revote_main=sprintf("%.1f",$revote_main); 
	   $string="hour(s)";
	  } else {
	   $revote_main=$revote_1/86400;
	   $revote_main=sprintf("%.1f",$revote_main); 
	   $string="day(s)";
	   } 
	$content .= "<br />Vote again in:<br /><strong>$revote_main $string</strong><br />";
    if (is_admin($admin)) {
    global $admin_file;
    $content .= "<br /><br /><center>[ <a href=\"".$admin_file.".php?op=create\">"._ADD."</a> | <a href=\"".$admin_file.".php?op=polledit&pollID=$pollID\">"._EDIT."</a> ]</center>";
    }
   return($content);
}
?>
