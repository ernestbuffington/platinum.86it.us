<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function showcontent($id, $page) {
    global $admin, $uimages, $prefix, $db, $module_name, $button_image, $ns_theme;
    include_once('header.php');
    heading();
    Opentable();
    if (($page == 1) OR ($page == "")) {
	$db->sql_query("UPDATE ".$prefix."_reviews SET hits=hits+1 WHERE id=$id");
    }
    $result = $db->sql_query("SELECT * FROM ".$prefix."_reviews WHERE id=$id");
    $myrow =  $db->sql_fetchrow($result);
    $id =  $myrow["id"];
    $date = $myrow["date"];
    $year = substr($date,0,4);
    $month = substr($date,5,2);
    $day = substr($date,8,2);
    $fdate = date("F jS Y",mktime (0,0,0,$month,$day,$year));
    $title = $myrow["title"];
    $text = $myrow["text"];
    $cover = $myrow["cover"];
    $reviewer = $myrow["reviewer"];
    $email = $myrow["email"];
    $hits = $myrow["hits"];
    $url = $myrow["url"];
    $url_title = $myrow["url_title"];
    $score = $myrow["score"];
    $rlanguage = $myrow["rlanguage"];
    $contentpages = explode( "<!--pagebreak-->", $text );
    $pageno = count($contentpages);
    if ( $page=="" || $page < 1 )
	$page = 1;
    if ( $page > $pageno )
	$page = $pageno;
    $arrayelement = (int)$page;
    $arrayelement --;
if ($pageno > 1) {
	echo "<br /><div style=\"text-align: center;\">"._PAGE." <span style=\"font-weight: bold;\">$page</span> "._OF." $pageno</div>\n";
    }
    echo "<br /><div style=\"text-align: center;\"><span style=\"font-weight: bold;\"><font class=\"title\"><h2>$title</h2></font></div></span><br />\n";
    echo "<blockquote><div align=\"justify\">\n";
    if ($cover != "" && file_exists("images/reviews/$cover")) {
	echo "<img width=\"25%\" height=\"\" src=\"images/reviews/$cover\" align=\"right\" border=\"1\" vspace=\"2\" title=\"$title\">\n";
    }
    echo "$contentpages[$arrayelement]
    </div></blockquote>\n";
    $title = urlencode($title);
    if($page >= $pageno) {
	  $next_page = "";
    } else {
	$next_pagenumber = $page + 1;
	if ($page != 1) {
	    $next_page .= " &nbsp;&nbsp; ";
	}
	$next_page .= "<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$next_pagenumber\"><img src=\"images/buttons/next.gif\" border=\"0\" title=\""._NEXT."\"></a>\n";
    }
    if($page <= 1) {
	$previous_page = "";
    } else {
	$previous_pagenumber = $page - 1;
	$previous_page = "<a href=\"modules.php?name=$module_name&rop=showcontent&amp;id=$id&amp;page=$previous_pagenumber\"><img src=\"images/buttons/previous.gif\" border=\"0\" title=\""._PREVIOUS."\"></a>\n";
    }
    echo "<div style=\"text-align: center;\">"
	."$previous_page &nbsp;&nbsp; $next_page<br /><br />\n";
    echo "</font>\n";
    echo "</div>\n";

    echo "<span style=\"font-weight: bold;\">"._ADDED."</span> $fdate<br />\n";
    if ($reviewer != "")
	echo "<span style=\"font-weight: bold;\">"._REVIEWER."</span> <a href=mailto:$email>$reviewer</a>\n";
    if ($url != "")
		echo "<br /><span style=\"font-weight: bold;\">"._RELATEDLINK.":</span> <a href=\"$url\" target=new>$url_title</a>\n";
    echo "<br /><span style=\"font-weight: bold;\">"._HITS.":</span> $hits";
    echo "<br /><span style=\"font-weight: bold;\">"._LANGUAGE.":</span> $rlanguage";
    if ($score != "") {
	echo "<br /><span style=\"font-weight: bold;\">"._SCORE.":</span> <span style=\"vertical-align=-33%\">\n";
    display_score($score);
	echo "</span>\n";    
}
    echo "<br />\n";
    if (is_admin($admin)) {
		echo "<span style=\"font-weight: bold;\">"._ADMINOPTIONS."</span> [ <a href=\"modules.php?name=$module_name&rop=mod_review&amp;id=$id\">"._EDIT."</a> ]&nbsp;-&nbsp;[ <a href=modules.php?name=$module_name&rop=del_review&amp;id_del=$id>"._DELETE."</a> ]<br />\n";
}
    echo "<br /><br />\n";
OpenTable2();
    echo "<div style=\"text-align: center;\">[ <a href=\"modules.php?name=$module_name\">"._RBACK."</a> ]&nbsp;-&nbsp;[ "
	."<a href=\"modules.php?name=$module_name&amp;rop=postcomment&amp;id=$id&amp;title=$title\">"._REPLYMAIN."</a> ]</div>\n";
CloseTable2();
    echo "<br />\n";
    Closetable();
    $title = urldecode($title);
    if (($page == 1) OR ($page == "")) {
	if (r_comments == 1)

    OpenTable();
	include_once("modules/$module_name/public/r_comments.php");
	r_comments($id, $title);

    }
    include_once("footer.php");
}

?>