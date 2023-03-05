<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function r_comments($id, $title) {
    global $admin, $prefix, $db, $module_name, $num, $id;
    $result = $db->sql_query("select cid, userid, date, comments, score from ".$prefix."_reviews_comments where rid='$id' ORDER BY date DESC");
    while(list($cid, $uname, $date, $comments, $score) = $db->sql_fetchrow($result)) {
$num = $num + 1;
if ($num < 2) {
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._COMMENTS."</font></div>\n";
    CloseTable();
        echo "<a name=\"$id\">\n";
	Opentable();
	$title = urldecode($title);
	echo "<span style=\"font-weight: bold;\">$title</span><br />\n";
	if ($uname == "Anonymous") {
	    echo ""._POSTEDBY." $uname "._ON." $date<br />\n";
	} else {
	    echo ""._POSTEDBY." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$uname\">$uname</a> "._ON." $date<br />\n";
	}
	echo ""._MYSCORE."<span style=\"vertical-align=-33%\">\n";
	display_score($score);
	echo "</span>\n";
	if (is_admin($admin)) {
	    echo "<br /><span style=\"font-weight: bold;\">"._ADMINOPTIONS.":</span> [ <a href=\"modules.php?name=$module_name&rop=del_comment&amp;cid=$cid&amp;id=$id\">"._DELETE."</a> ]</font>\n";
	} else {
	    echo "</font><br />\n";
	}
	$comments = FixQuotes(nl2br(filter_text($comments)));
	echo "<br /><br /><div align=\"justify\">$comments</div><br />\n";
	Closetable();
	} else {
	Opentable();
	$title = urldecode($title);
	echo "<span style=\"font-weight: bold;\">$title</span><br />\n";
	if ($uname == "Anonymous") {
	    echo ""._POSTEDBY." $uname "._ON." $date<br />\n";
	} else {
	    echo ""._POSTEDBY." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$uname\">$uname</a> "._ON." $date<br />\n";
	}
	echo ""._MYSCORE."<span style=\"vertical-align=-33%\">\n";
	display_score($score);
	echo "</span>\n";
	if (is_admin($admin)) {
	    echo "<br /><span style=\"font-weight: bold;\">"._ADMINOPTIONS.":</span> [ <a href=\"modules.php?name=$module_name&rop=del_comment&amp;cid=$cid&amp;id=$id\">"._DELETE."</a> ]</font>\n";
	} else {
	    echo "</font><br />\n";
	}
	$comments = FixQuotes(nl2br(filter_text($comments)));
	echo "<br /><br /><div align=\"justify\">$comments</div><br />\n";	
	Closetable();
}
    }
}

?>