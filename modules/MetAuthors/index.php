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

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);



Function MetAuthorsUpdateAuthors ($articleid,$author){

   if ($articleid > ""  and $author > ""){

    global $db, $prefix;

    $sql = "UPDATE `".$prefix."_stories` SET `informant` = '$author', aid= '$author' WHERE `sid` = '$articleid' LIMIT 1 ";

    //echo $sql;

    $result = $db->sql_query($sql);

    echo ' '._MA_ARTICLEID.' '.$articleid.' '._MA_ARTICLE_AUTHOR_UPDATE.' '.$author.' .$result<br />';

   } else {

       echo '_MA_ARTICLE_UPDATE_WARNING';

   }

}

Function MetAuthorsColumnists(){

   $module_name = basename(dirname(__FILE__));

   global $db, $prefix,$cookie;



   include_once("header.php");

   $uname = $cookie[1];

   MetAuthorsMenu();

   echo "<a name=\"authorlist\">";

   OpenTable();

   echo "<tr><td colspan=\"6\"><strong>Author List:</strong></td></tr>";

   echo "<tr><td><strong></strong></td><td><strong>Author's Bio</strong></td><td><strong>Info</strong></td></tr>";

   $sql = "select ma.metauthorsid, ma.username as informant, ma.Salutation,  ma.last,  ma.first, ma.midinit, ma.suffix,  ma.img,  ma.bio,  ma.columnist,  ma.title, "

         ."count(*) as totcount, sum(st.counter) as totreads, round(avg(st.counter),0) as avgreads, round(avg( st.counter / ( TO_DAYS( NOW( ) ) - TO_DAYS( st.time ) ) ),1) AS readsperday, sum(st.ratings) as totvotes, round(sum(st.score)/sum(st.ratings),1) as avgrating "

         ."from ".$prefix."_metauthors ma, ".$prefix."_stories st where ma.username=st.informant group by ma.username order by ma.last, ma.first desc ";

   $result = $db->sql_query($sql);



   while ($row = $db->sql_fetchrow($result)) {

     $authorname = $row['salutation']." ".$row['first']." ".$row['midinit']." ".$row['last'];

     echo ($uname==$row['informant'] ? "<tr border=\"0\">" : "<tr border=\"0\">");

     echo "<td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">"

         ."<img src=\"".$row['img']."\" valign=\"top\" border =\"0\" alt=\"\" /><br />";

     echo ($uname==$row['informant'] ? "<i>".$row['informant']."</i>" : $row['informant']) ;

     echo "</a></td>"

         ."<td><strong>".$authorname."</strong><br />"

         .$row['bio']."</td>"

         ."<td>Articles: <strong>".$row['totcount']."</strong><br /> Reads: ".$row['totreads']."<br /> Avg Reads: ".$row['avgreads']."<br />Avg Rating: <strong>".$row['avgrating']."</strong>/5.0<br />"

         ."<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">Read More From ".$authorname."</td>";

   }

   CloseTable();

   echo "<br />";



   echo "<form action=\"modules.php?name=".$module_name."\" method=\"post\">"

        ."Add a Columnist:<br />"

        ."Article Id: <input type=\"text\" name=\"articleid\" size=\"5\" value=\"\" /> "

        ."Author: <input type=\"text\" name=\"author\" size=\"15\" value=\"\" /> "

        ."<input type=\"hidden\" name=\"maction\" value=\"updateauthors\" />"

        ."<input type=\"submit\" value=\"GO\" />"

        ."</form>";

}



Function MetAuthorsMenu ($currentmenu=""){

  $module_name = basename(dirname(__FILE__));

}



Function MetAuthorsStats (){

   global $db, $admin, $prefix, $top, $cookie, $sitename, $multilingual, $currentlang;

   $module_name = basename(dirname(__FILE__));

   $uname = $cookie[1];

   include_once("header.php");



   if ($multilingual == 1) {

     $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories which are posted to ALL languages */



     $queryalang = "WHERE (alanguage='$currentlang' OR alanguage='')"; /* top stories */

     $querya1lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND"; /* top stories */

     $queryslang = "WHERE slanguage='$currentlang' "; /* top section articles */

     $queryplang = "WHERE planguage='$currentlang' "; /* top polls */

     $queryrlang = "WHERE rlanguage='$currentlang' "; /* top reviews */

   } else {

     $queryalang = "";

     $querya1lang = "WHERE";

     $queryslang = "";

     $queryplang = "";

     $queryrlang = "";

     $querylang = "";

   }



   OpenTable();

   echo "<center><font class=\"title\"><strong>"._TOPWELCOME.": $sitename!</strong></font></center>";

   CloseTable();

   echo "<br />\n\n";

   MetAuthorsMenu();



   if ($uname > "") echo _WELCOME." ".$uname.", <br /><br />";

   OpenTable();

   echo "<strong><u>"._SUBMITCONTENT."</u></strong><br /><br />";

       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Submit_News\">"._SUBMITARTICLE."</a><br />";

       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Reviews&amp;rop=write_review\">"._WRITEREVIEW."</a><br />";

       echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"modules.php?name=Web_Links&amp;file=index&amp;l_op=AddLink\">"._SUBMITWEBLINK."</a><br />";

   echo "<br />";

   echo "<strong><u>"._STATISTICS."</u></strong><br /><br />";

   echo "<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#qstat\">"._QUICKSTATOVERVIEW."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tstories30\">"._TOPRECENTSTORIES."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tstoriesall\">"._TOPALLSTORIES."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#tauthors\">"._TOPAUTHORS."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#monthlyarticlesoverview\">"._MONTHLYARTICLEOVERVIEW."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#articlecountbytopic\">"._ARTICLECOUNTBYTOPIC."</a><br />"

       ."<img src=\"modules/$module_name/images/arrow_red.gif\" alt=\"\" />&nbsp;<a href=\"#articlecountbycategory\">"._ARTICLECOUNTBYCATEGORY."</a><br />"

       ."<hr />";



   echo "<a name=\"qstat\">";

   echo "<strong><u>"._QUICKSTATOVERVIEW."</u></strong></a><br /><br />";

   $sql = "SELECT sum( counter ) "

       ."FROM `nuke_stories` ";

   $result = $db->sql_query($sql);

   $row = $db->sql_fetchrow($result);

   $numreadso = $row[0];



   $sql = "SELECT count(sid), sum( counter ) "

       ."FROM `nuke_stories` where  (TO_DAYS(NOW()) - TO_DAYS(time) <= 30)  ";

   $result = $db->sql_query($sql);

   $row = $db->sql_fetchrow($result);

   $numstoriesr = $row[0];

   $numreadsr = $row[1];



   $sql = "SELECT counter FROM `nuke_stories`  ORDER BY counter DESC  LIMIT 9 , 1";

   $result = $db->sql_query($sql);

   $row = $db->sql_fetchrow($result);

   $readstotop =$row[0];



   $sql = "SELECT sum( counter ) "

       ."FROM `nuke_stories` where counter >= $row[0] order by counter desc ";

   $result = $db->sql_query($sql);

   $row = $db->sql_fetchrow($result);

   $numreadst = $row[0];



   $sql = "SELECT count( sid ) "

       ."FROM `nuke_stories` ";

   $result = $db->sql_query($sql);

   $row = $db->sql_fetchrow($result);

   $numstorieso = $row[0];

   $numreadso = $numreadso>0?$numreadso:0; //Raven 12/16/2005

   $numreadsr = $numreadsr>0?$numreadsr:0; //Raven 12/16/2005

   $numreadst = $numreadst>0?$numreadst:0; //Raven 12/16/2005

   $numstoriesoAvg = $numstorieso>0?round(($numreadso / $numstorieso),0):0; //Raven 12/16/2005

   $numstoriesrAvg = $numstoriesr>0?round(($numreadsr / $numstoriesr),0):0; //Raven 12/16/2005

   $topAvg = $top>0?round(($numreadst / $top),0):0; //Raven 12/16/2005

   echo "<table border=\"1\" cellpadding=\"1\">"

        ."<tr><td></td><td>"._STORYREADS."</td><td>"._STORIES."</td><td>"._STORYAVGREADS."</td></tr>"

        ."<tr><td>"._OVERALL."</td><td>".$numreadso."</td><td>".$numstorieso."</td><td>".$numstoriesoAvg."</td></tr>"

        ."<tr><td>"._RECENT."</td><td>".$numreadsr."</td><td>".$numstoriesr."</td><td>".$numstoriesrAvg."</td></tr>"

        ."<tr><td>Top $top</td><td>".$numreadst."</td><td>".$top."</td><td>".$topAvg."</td></tr>";

   echo "</table>";

   echo ""._MA_READS_TO_MAKE_TOP10." ".$readstotop.". ";

    CloseTable();

   echo " <br /> <br /> ";



     OpenTable();

   echo "<table><tr><td colspan=\"6\"><a name=\"tstories30\"><strong><u>"._TOPRECENTSTORIES."</u></strong></a></td></tr>";

   echo "<tr><td><strong>#</strong></td><td><strong>"._STORYTITLE."</strong></td><td><strong>"._STORYDATE."</strong></td><td><strong>"._AUTHORNAME."</strong></td><td><strong>"._STORYREADS."</strong></td><td><strong>"._READSPERDAY."</strong></td></tr>";

   $sql = "select sid, title, counter, informant, left(time,10) as sttime, counter/(TO_DAYS(NOW()) - TO_DAYS(time)) as readsperday from ".$prefix."_stories where  (TO_DAYS(NOW()) - TO_DAYS(time) <= 30) $querylang order by counter desc ";

   $result = $db->sql_query($sql);

   $whilectr=1;

   while ($row = $db->sql_fetchrow($result)) {

      echo ($uname==$row['informant'] ? "<tr>" : "<tr>");

      echo "<td>$whilectr</td>"

          ."<td><a href=\"modules.php?name=News&amp;file=article&amp;sid=".$row['sid']."\">".$row['title']."</a></td> "

          ."<td>".$row['sttime']."</td><td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";

      echo ($uname==$row['informant'] ? "<i>".$row['informant']."</i>" : $row['informant']) ;

      echo "</a></td>"

          ."<td>".$row['counter']."</td><td>".$row['readsperday']."</td></tr>";

      $whilectr++;

   }

   echo "</table>";

       CloseTable();

   echo "<br />";



   OpenTable();

   echo "<table><tr><td colspan=\"6\"><a name=\"tstoriesall\"><strong><u>$top "._READSTORIES."</u></strong></a></td></tr>";

   echo "<tr><td><strong>#</strong></td><td><strong>"._STORYTITLE."</strong></td><td><strong>"._STORYDATE."</strong></td><td><strong>"._AUTHORNAME."</strong></td><td><strong>"._STORYREADS."</strong></td><td><strong>"._READSPERDAY."</strong></td></tr>";

   $sql = "select sid, title, counter, informant, left(time,10) as sttime, counter/(TO_DAYS(NOW()) - TO_DAYS(time)) as readsperday  from ".$prefix."_stories where  1=1 $querylang order by counter desc limit 0,$top";

   $result = $db->sql_query($sql);

   $whilectr=1;

   while ($row = $db->sql_fetchrow($result)) {

      echo ($uname==$row['informant'] ? "<tr>" : "<tr>");

      echo "<td>$whilectr</td>"

          ."<td><a href=\"modules.php?name=News&amp;file=article&amp;sid=".$row['sid']."\">".$row['title']."</a></td> "

          ."<td>".$row['sttime']."</td><td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";

      echo ($uname==$row['informant'] ? "<i>".$row['informant']."</i>" : $row['informant']) ;

      echo "</a></td>"

          ."<td>".$row['counter']."</td><td>".$row['readsperday']."</td></tr>";



       $whilectr++;

   }

   echo "</table>";

       CloseTable();

   echo "<br />";



   $sql ="select informant, count(*) as totcount, sum(counter) as totreads, round(avg(counter),0) as avgreads, round(avg( counter / ( TO_DAYS( NOW( ) ) - TO_DAYS( time ) ) ),1) AS readsperday, sum(ratings) as totvotes, round(sum(score)/sum(ratings),1) as avgrating from ".$prefix."_stories group by informant order by totreads DESC limit 0,$top";



   $result = $db->sql_query($sql);



   if ($db->sql_numrows($result)>0) {

   OpenTable();

   echo "<table><tr><td colspan=\"6\"><a name=\"tauthors\"><strong><u>"._TOP." $top "._AUTHORS."</u></strong></a></td></tr>";

   echo "<tr><td><strong>#</strong></td><td><strong>"._AUTHORNAME."</strong></td><td><strong>"._NUMSTORIES."</strong></td><td><strong>"._STORYREADS."</strong></td><td><strong>"._STORYAVGREADS."</strong></td><td><strong>"._READSPERDAY."</strong></td><td><strong>"._TOTALRATINGS."</strong></td><td><strong>"._AVGRATINGS."</strong></td></tr>";

     $whilectr=1;

     while ($row = $db->sql_fetchrow($result)) {

      echo ($uname==$row['informant'] ? "<tr>" : "<tr>");

      echo "<td>$whilectr</td>"

          ."<td><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$row['informant']."\">";

      echo ($uname==$row['informant'] ? "<i>".$row['informant']."</i>" : $row['informant']) ;

      echo "</a></td>"

          ."<td>".$row['totcount']."</td>"

          ."<td>".$row['totreads']."</td>"

          ."<td>".$row['avgreads']."</td>"

          ."<td>".$row['readsperday']."</td>"

          ."<td>".$row['totvotes']."</td>"

          ."<td>".$row['avgrating']."</td>"

          ."</tr>";



       $whilectr++;

       }

       echo "</table>";

       CloseTable();

       echo "<br />";

   } else ''._MA_NO_AUTHORS. '';



   OpenTable();

   echo "<a name=\"monthlyarticlesoverview\">"

       ."<strong><u>"._MONTHLYARTICLEOVERVIEW."</u></strong></a><br /><br />";



   $sql = "SELECT left(time,7) as mong, count(*) as mcount FROM `".$prefix."_stories` WHERE 1 group by mong "

       ."order by mong desc ";

   $result = $db->sql_query($sql);

   echo "<table><tr><td><strong>"._MONTH."</strong></td><td><strong>"._STORYREADS."</strong></td></tr>";

   $tempVar = '';

   while ($row = $db->sql_fetchrow($result)) {

     $tempVar .= "<tr><td>".$row['mong']."</td><td>".$row['mcount']."</td></tr>";

   }

   echo $tempVar."</table><br /><br /><br />";



   echo "<a name=\"articlecountbytopic\">"

       ."<strong><u>"._ARTICLECOUNTBYTOPIC."</u></strong></a><br /><br />";



   $sql = "SELECT t.topictext AS topicname, count( * ) AS mcount, sum( s.counter ) AS reads, round( sum( s.counter ) / count( * ) , 0 ) AS avgreads "

         ."FROM `nuke_stories` s, nuke_topics t "

         ."WHERE t.topicid = s.topic "

         ."GROUP BY t.topicname "

         ."order by t.topicname asc ";



   $result = $db->sql_query($sql);

   echo "<table><tr><td><strong>"._TOPIC."</strong></td><td><strong>"._NUMSTORIES."</strong></td><td><strong>"._STORYREADS."</strong></td><td><strong>"._STORYAVGREADS."</strong></td></tr>";

   $tempVar = '';

   while ($row = $db->sql_fetchrow($result)) {

     $tempVar .= "<tr><td>".$row['topicname']."</td><td>".$row['mcount']."</td><td>".$row['reads']."</td><td>".$row['avgreads']."</td></tr>";

   }

   echo $tempVar."</table><br /><br /><br />";



   echo "<a name=\"articlecountbycategory\">"

       ."<strong><u>"._ARTICLECOUNTBYCATEGORY."</u></strong></a><br /><br />";





   $sql = "SELECT IF ( c.Title IS NULL , \""._MA_ARTICLE."\", c.Title) AS category, count( * ) AS mcount, sum( s.counter ) AS reads, round( sum( s.counter ) / count( * ) , 0 ) AS avgreads "

         ."FROM `nuke_stories` s "

         ."LEFT JOIN nuke_stories_cat c ON s.catid = c.catid "

         ."WHERE 1  "

         ."GROUP BY category "

         ."ORDER BY category ASC  ";



   $result = $db->sql_query($sql);

   echo "<table><tr><td><strong>"._TOPIC."</strong></td><td><strong>"._NUMSTORIES."</strong></td><td><strong>"._STORYREADS."</strong></td><td><strong>"._STORYAVGREADS."</strong></td></tr>";

   $tempVar = '';

   while ($row = $db->sql_fetchrow($result)) {

     $tempVar .= "<tr><td>".$row['category']."</td><td>".$row['mcount']."</td><td>".$row['reads']."</td><td>".$row['avgreads']."</td></tr>";

   }

   echo $tempVar."</table><br /><br /><br />";



   CloseTable();



   echo "<br />";



   include_once("footer.php");

   }

if (!isset($op)) {$op = ""; }

switch($op) {

   case "columnists":

      MetAuthorsColumnists();

      break;

   case "stats":

   default:

   MetAuthorsStats();

}



?>

