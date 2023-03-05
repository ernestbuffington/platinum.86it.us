<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Random_Headlines.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $multilingual, $currentlang, $db, $tipath, $user, $cookie;

$r_options = "";
if (!isset($cookie[4])) { $r_options .= ".html"; } if (isset($cookie[4])) { $r_options .= "-$cookie[4]"; }
if (isset($cookie[5])) { $r_options .= "-$cookie[5]"; }
if (isset($cookie[6])) { $r_options .= "-$cookie[6].html"; }

if ($multilingual == 1) {
    $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
} else {
    $querylang = "";
}

$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_topics"));
if ($numrows > 1) {
    $result = $db->sql_query("SELECT topicid FROM ".$prefix."_topics");
    while ($row = $db->sql_fetchrow($result)) {
	$topicid = intval($row['topicid']);
	$topic_array .= "$topicid-";
    }
    $r_topic = explode("-",$topic_array);
    mt_srand((double)microtime()*1000000);
    $numrows = $numrows-1;
    $topic = mt_rand(0, $numrows);
    $topic = $r_topic[$topic];
} else {
    $topic = 1;
}
$row2 = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext FROM ".$prefix."_topics WHERE topicid='$topic'"));
$topicimage = $row2['topicimage'];
$topictext = $row2['topictext'];
$content = "<br><center><a href=\"article-topic-$topic.html\"><img src=\"$tipath$topicimage\" border=\"0\" alt=\"$topictext\" title=\"$topictext\"></a><br>[ <a href=\"search-$topic.html\">$topictext</a> ]</center><br>";
$content .= "<table border=\"0\" width=\"100%\">";
//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
$result3 = $db->sql_query("SELECT sid, title FROM ".$prefix."_stories WHERE topic='$topic' $querylang ORDER BY sid DESC LIMIT 0,9");
while ($row3 = $db->sql_fetchrow($result3)) {
$sid = intval($row3['sid']);
$title = $row3['title'];
    $content .= "<tr><td valign=\"top\"><strong><big>·</big></strong></td><td><a href=\"article$sid$r_options\">$title</a></td></tr>";
}
$content .= "</table>";

?>