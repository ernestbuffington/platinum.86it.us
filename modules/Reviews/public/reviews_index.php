<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function reviews_index() {
    global $prefix, $currentlang, $db, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $module_name, $hovercolor;
    include_once('header.php');
	define('MAINPAGE', true);
	heading();
    Opentable();
    $result = $db->sql_query("select title, description from ".$prefix."_reviews_main");
    list($title, $description) = $db->sql_fetchrow($result);
    echo "<br /><div align=\"center\"><span style=\"font-weight: bold;\">$title</span></div><br /><div align=\"justify\">$description</div>\n";
    echo "<br /><br />\n";
    alpha();
	echo "<div align='center'><span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._20MOSTPOP."</font></span></div><br /><br />\n";
    echo "<table border=\"0\" width=\"95%\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\"><tr>\n";
    echo "</tr>\n";
    $result_pop = $db->sql_query("select id, title, hits, score from ".$prefix."_reviews order by hits DESC limit 20");
    $result_rec = $db->sql_query("select id, title, date, hits, score from ".$prefix."_reviews order by date DESC limit 20");
    $y = 1;
    for ($x = 0; $x < 20; $x++)	{
	$myrow = $db->sql_fetchrow($result_pop);
	$id = $myrow["id"];
	$title = $myrow["title"];
	$hits = $myrow["hits"];
	$score = $myrow["score"];
	echo "<tr bgcolor=\"$bgcolor4\">\n";
	echo "<td width='60%'>&nbsp;<span style=\"font-weight: bold;\"><font color=\"$textcolor2\">$y)</font></span>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td>\n";
	echo "<td width='20%'>($hits "._READS.")</td>\n";
	echo "<td width='20%'><span style=\"vertical-align=-33%\">\n";
	display_score($score);
	echo "</span></td></tr>\n";
	$y++;
}
    echo "<tr><td>&nbsp;</td></tr></table><br /><br />\n";
	echo "<div align=\"center\"><span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._20MOSTREC."</font></span></div><br /><br />\n";
    echo "<table border=\"0\" width=\"95%\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\"><tr>\n";
    echo "</tr>\n";
    $y = 1;
    for ($x = 0; $x < 20; $x++)	{
	$myrow = $db->sql_fetchrow($result_rec);
	$id = $myrow["id"];
	$title = $myrow["title"];
	$hits = $myrow["hits"];
	$score = $myrow["score"];
	echo "<tr bgcolor=\"$bgcolor4\">\n";
	echo "<td width='60%'>&nbsp;<span style=\"font-weight: bold;\">$y)</span>&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td>\n";
	echo"<td width='20%'>($hits "._READS.")</td>\n";
	echo "<td width='20%'><span style=\"vertical-align=-33%\">\n";
    display_score($score);
	echo "</span></td></tr>\n";
	$y++;
    }
    echo "<tr><td colspan=\"2\"><br /></td></tr></table>\n";
    $result = $db->sql_query("SELECT * FROM ".$prefix."_reviews $querylang");
    $numresults = $db->sql_numrows($result);
    echo "<br /><div align=\"center\">"._THEREARE." <span style=\"font-weight: bold;\">$numresults</span> "._REVIEWSINDB."</div><br />\n";
    Closetable();
    include_once("footer.php");
}

?>