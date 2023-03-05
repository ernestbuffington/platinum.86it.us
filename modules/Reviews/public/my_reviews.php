<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

global $module_name, $prefix, $sitename, $db, $datetime;
$ipp = "50";	// Number Of Reviews On Each Page / Numero De Reviews En Cada Pagina
include_once("header.php");
heading();
OpenTable();
$count = 0;
$start_time = time();
echo "<table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">\n";
echo "<tr>\n";
echo "<td align=\"center\" width=\"60%\" class=\"boxtitle\"><span style=\"font-weight: bold;\">"._REVIEW."</span></td>\n" ;
echo "<td width=\"20%\" class=\"boxtitle\"><span style=\"font-weight: bold;\">"._HITS."&nbsp;</span></td>\n";
echo "<td align=\"center\" width=\"20%\" class=\"boxtitle\"><span style=\"font-weight: bold;\">"._SCORE."</span></td>\n";
echo "</tr>\n";

// Start Opening
$result = $db->sql_query("SELECT * FROM ".$prefix."_reviews");
$total =  $db->sql_numrows($result);
if ($total>$ipp) {
	$pages=ceil($total/$ipp);
	if ($page > $pages) { $page = $pages; }
	if (!$page) { $page=1; }
	$offset=($page-1)*$ipp;
} else {
	$offset=0;
	$pages=1;
	$page=1;
}
$result = $db->sql_query("SELECT id, date, title, hits, score FROM ".$prefix."_reviews ORDER BY title ASC limit $offset,$ipp");
while (list($id, $date, $title, $hits, $score) = $db->sql_fetchrow($result)) {
	$title = "<a href=\"modules.php?name=$module_name&amp;rop=showcontent&amp;id=$id\">$title</a>";
	echo "<td><li>";
	echo "$title";
	newreviewgraphic($datetime, $date);
	popgraphic($hits);
	echo "</li></td>\n";
	echo "<td>($hits "._HITS.")";
	echo "<td><span style=\"vertical-align=-33%\">";
	display_score($score);
	echo "</span></td>\n";
	echo "</tr>\n";
	$count ++;
 }
echo "</table><br />\n";   
echo "<br /><br />\n";
echo "<div style=\"text-align: center;\">"._THEREARE." <span style=\"font-weight: bold;\">$total</span> "._REVIEWSINDB."</div><br />\n";
   
if ($pages > 1) {
	$pcnt=1;
	echo "<div style=\"text-align: center;\">";
	if ($page > 1) {
		echo "<a href=\"modules.php?name=$module_name&amp;rop=my_reviews&amp;page=" . ($page-1) . "\">\n";
		echo "<img src=\"modules/$module_name/images/left.gif\" Alt=\"Previous Page\" border=0></a>&nbsp;\n";
	} else {
		echo "<img src=\"modules/$module_name/images/left-no.gif\" Alt=\"No Previous Page\" border=0>&nbsp;\n";
	}
	while($pcnt < $page) {
		echo "<span style=\"font-weight: bold;\">[ <a href=\"modules.php?name=$module_name&amp;rop=my_reviews&amp;page=$pcnt\">$pcnt</a> ]</span>\n";
		$pcnt++;
	}
	echo "<span style=\"font-weight: bold;\">[ $page ]</span>\n";
	$pcnt++;
	while($pcnt <= $pages) {
		echo " <span style=\"font-weight: bold;\">[ <a href=\"modules.php?name=$module_name&amp;rop=my_reviews&amp;page=$pcnt\">$pcnt</a> ]</span>\n";
		$pcnt++;
	}
	if ($page < $pages) {
		echo "&nbsp;<a href=\"modules.php?name=$module_name&amp;rop=my_reviews&amp;page=" . ($page+1) . "\">\n";
		echo "<img src=\"modules/$module_name/images/right.gif\" Alt=\"Next Page\" border=\"0\"></a>\n";
	} else {
		echo "&nbsp;<img src=\"modules/$module_name/images/right-no.gif\" Alt=\"No Next Page\" border=\"0\">\n";
	}
	echo "</div><br />\n";
}
 
CloseTable();
include_once("footer.php");
   
?>