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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Last_5_Articles.php")) {
    Header("Location: ../index.html");
    die();
}

global $prefix, $multilingual, $currentlang, $db;

if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = "";
}
$content = "<table width=\"100%\" border=\"0\">";
$result = $db->sql_query("SELECT sid, title, comments, counter FROM " . $prefix . "_stories $querylang ORDER BY sid DESC LIMIT 0,5");
while ($row = $db->sql_fetchrow($result)) {
    //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
    $sid = intval($row['sid']);
    $title = stripslashes($row['title']);
    $comtotal = stripslashes($row['comments']);
    $counter = $row['counter'];
    $content .= "<tr><td align=\"left\"><strong><big>·</big></strong> <a href=\"article$sid.html\">$title</a></td><td align=\"right\">[ $comtotal "._COMMENTS." - $counter "._READS." ]</td></tr>";
}
$content .= "</table>";
$content .= "<br><center>[ <a href=\"news.html\">"._MORENEWS."</a> ]</center>";

?>