<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function reviews($letter, $field, $order) {
    global $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $sitename, $prefix, $multilingual, $currentlang, $db, $module_name, $ns_theme, $hovercolor;
    include_once('header.php');
    heading();
    Opentable();
    echo "<br /><div align=\"center\"><span style=\"font-weight: bold;\">$sitename "._REVIEWS."</span><br /><br />\n";
	    alpha();
Opentable2();
    echo "<div align=\"center\"><span style=\"font-weight: bold;\">"._REVIEWSLETTER." - $letter</span></div>\n";
Closetable2();
    switch ($field) {

	case "reviewer":
	$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by reviewer $order");
	break;

	case "score":
	$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by score $order");
	break;

	case "hits":
	$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by hits $order");
	break;

	default:
	$result = $db->sql_query("SELECT id, title, hits, reviewer, score FROM ".$prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER by title $order");
	break;
    }
    $numresults = $db->sql_numrows($result);
    if ($numresults == 0) {
	echo "<br />"._NOREVIEWS." - <span style=\"font-weight: bold;\">$letter</span><br /><br />\n";
    } elseif ($numresults > 0) {
	echo "<br /><table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n<tr>\n";
	echo "<td width=\"100%\" align=\"center\"><font class=\"title\"><span style=\"font-weight: bold;\">"._SORTORDER."</span></font></td>\n</tr>\n";
	echo "<tr><td width=\"100%\" align=\"center\"><span style=\"font-weight: bold;\">"._SORTTITLE."</span>&nbsp;\n";
	echo "<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=title&amp;order=ASC\"><span style=\"vertical-align=-20%\"><img src=\"images/up.gif\" border=\"0\" title=\""._SORTASC."\"></span></a>&nbsp;\n";
	echo "<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=title&amp;order=DESC\"><span style=\"vertical-align=-20%\"><img src=\"images/down.gif\" border=\"0\" title=\""._SORTDESC."\"></span></a>&nbsp;&nbsp;-&nbsp;&nbsp;\n";
	echo "<span style=\"font-weight: bold;\">"._SORTREVIEWER."</span> <a href=\"modules.php?name=$module_name&rop=$letter&amp;field=reviewer&amp;order=ASC\"><span style=\"vertical-align=-20%\"><img src=\"images/up.gif\" border=\"0\" title=\""._SORTASC."\"></span></a>&nbsp;\n";
	echo "<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=reviewer&amp;order=desc\"><span style=\"vertical-align=-20%\"><img src=\"images/down.gif\" border=\"0\" title=\""._SORTDESC."\"></span></a>&nbsp;&nbsp;-&nbsp;&nbsp;\n";
	echo "<span style=\"font-weight: bold;\">"._SORTSCORE."</span> <a href=\"modules.php?name=$module_name&rop=$letter&amp;field=score&amp;order=ASC\"><span style=\"vertical-align=-20%\"><img src=\"images/up.gif\" border=\"0\" title=\""._SORTASC."\"></span></a>&nbsp;\n";
	echo "<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=score&amp;order=DESC\"><span style=\"vertical-align=-20%\"><img src=\"images/down.gif\" border=\"0\" title=\""._SORTDESC."\"></span></a>&nbsp;&nbsp;-&nbsp;&nbsp;\n";
	echo "<span style=\"font-weight: bold;\">"._SORTHITS."</span>&nbsp;<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=hits&amp;order=ASC\"><span style=\"vertical-align=-20%\"><img src=\"images/up.gif\" border=\"0\" title=\""._SORTASC."\"></span></a>&nbsp;\n";
	echo "<a href=\"modules.php?name=$module_name&rop=$letter&amp;field=hits&amp;order=DESC\"><span style=\"vertical-align=-20%\"><img src=\"images/down.gif\" border=\"0\" title=\""._SORTDESC."\"></span></a></td></tr></table>\n";
	echo "<br /><table border=\"0\" width=\"100%\" cellpadding=\"3\" cellspacing=\"1\">\n";
	echo "<tr>\n";
	echo "<td width=\"47%\" bgcolor=\"$bgcolor3\" align=\"center\">\n";
	echo "<span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._PRODUCTTITLE."</font></span>\n";
	echo "</td>\n";
	echo "<td width=\"23%\" bgcolor=\"$bgcolor3\" align=\"center\">\n";
	echo "<span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._REVIEWER."</font></span>\n";
	echo "</td>\n";
	echo "<td width=\"18%\" bgcolor=\"$bgcolor3\" align=\"center\">\n";
	echo "<span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._SCORE."</font></span>\n";
	echo "</td>\n";
	echo "<td width=\"12%\" bgcolor=\"$bgcolor3\" align=\"center\">\n";
	echo "<span style=\"font-weight: bold;\"><font color=\"$textcolor1\">"._HITS."</font></span>\n";
	echo "</td>\n";
	echo "</tr>\n";
	while($myrow = $db->sql_fetchrow($result)) {
	    $title = $myrow["title"];
	    $id = $myrow["id"];
	    $reviewer = $myrow["reviewer"];
	    $email = $myrow["email"];
	    $score = $myrow["score"];
	    $hits = $myrow["hits"];
	    echo "<tr onmouseover=\"this.style.backgroundColor='$hovercolor'\" onmouseout=\"this.style.backgroundColor='$bgcolor4'\" bgcolor=\"$bgcolor4\">\n";
	    echo "<td width=\"47%\">&nbsp;<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id\">$title</a></td>\n";
	    echo "<td width=\"23%\" align=\"center\">\n";
	    if ($reviewer != "")
		echo "<font color=\"$textcolor2\"><span style=\"font-weight: bold;\">$reviewer</span></font>\n";
		echo "</td><td width=\"18%\" align=\"center\"><span style=\"vertical-align=-33%\">\n";
		display_score($score);
		echo "</span></td><td width=\"12%\" align=\"center\"><font color=\"$textcolor2\"><span style=\"font-weight: bold;\">$hits</span></font></td>\n";
		echo "</tr>\n";
	}
	echo "</table>\n";
    if ($numresults > 1) {
	echo "<br /><span style=\"font-weight: bold;\">$numresults</span> "._TOTALREVIEWS."<br /><br />\n";
    } else {
	echo "<br /><span style=\"font-weight: bold;\">$numresults</span> "._TOTALREVIEW."<br /><br />\n";
    }
    }
	if (is_active("Search")) {
		echo "<form action=\"modules.php?name=Search&amp;type=reviews#results\" method=\"post\">\n";
		echo "<div align=\"center\"><br /><span style=\"font-weight: bold;\">"._SEARCHREVIEWS."</span><br /><br />\n";
		echo "<input type=\"name\" name=\"query\" size=\"30\">&nbsp;&nbsp;\n";
		echo "<input type=\"submit\" name=\"submit\" value=\""._SEARCH."\">\n";
		echo "</div>\n";
		echo "</form>\n";
		echo "<div align=\"center\">[ <a href=\"modules.php?name=Search&amp;type=reviews\">"._ADVANCEDSEARCH."</a> ] - \n";
	}
    echo "[ <a href=\"modules.php?name=$module_name\">"._RETURN2MAIN."</a> ]</div><br /><br />\n";
    Closetable();
    include_once("footer.php");
}

?>