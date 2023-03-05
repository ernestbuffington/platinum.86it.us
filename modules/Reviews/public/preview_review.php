<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
    global $admin, $multilingual, $module_name;
    if (preg_match("#<!--pagebreak-->#i", $text)) {
	$text = preg_replace("#<!--pagebreak-->#","&lt;!--pagebreak--&gt;",$text);
    }
    $title = stripslashes(check_html($title, "nohtml"));
    $text = stripslashes(check_html($text, ""));
    $reviewer = stripslashes(check_html($reviewer, "nohtml"));
    $url_title = stripslashes(check_html($url_title, "nohtml"));
    include_once('header.php');
	heading();
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._PREVIEWREVIEW."</font></div>\n";
    CloseTable();
    Opentable();
    echo "<form method=\"post\" action=\"modules.php?name=$module_name\">\n";
	echo "<br />\n";
    if ($title == "") {
    	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._INVALIDTITLE."</span><br />\n";
    }
    if ($text == "") {
    	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._INVALIDTEXT."</span><br />\n";
    }
    if (($score < 1) || ($score > 10)) {
	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._INVALIDSCORE."</span><br />\n";
    }
    if (($hits < 0) && ($id != 0)) {
	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._INVALIDHITS."</span><br />\n";
    }
    if ($reviewer == "" || $email == "") {
	$error = 1;
	echo "<br /><span style=\"font-weight: bold;\">"._CHECKNAME."</span><br />\n";
    } else if ($reviewer != "" && $email != "")
	if (!(preg_match("#^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$#i",$email))) {
	    $error = 1;
	    /* preg checks for a valid email! works nicely for me! */
	    echo "<br /><span style=\"font-weight: bold;\">"._INVALIDEMAIL."</span><br />\n";
	}
	if (($url_title != "" && $url =="") || ($url_title == "" && $url != "")) {
	    $error = 1;
	    echo "<br /><span style=\"font-weight: bold;\">"._INVALIDLINK."</span><br />\n";
	} else if (($url != "") && (!(preg_match('#(^http[s]*:[/]+)(.*)#i', $url))))
	    $url = "http://" . $url;
	    /* If the user ommited the http, this nifty preg will add it */
	if ($error == 1)
	    echo "<br /><div align=\"center\">"._GOBACK."</div>\n";
	else
	{
	if ($date == "")
	    $date = date("Y-m-d", time());
	    $year2 = substr($date,0,4);
	    $month = substr($date,5,2);
	    $day = substr($date,8,2);
	    $fdate = date("F jS Y",mktime (0,0,0,$month,$day,$year2));
	    echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" align=\"center\" ><tr><td colspan=\"2\">\n";
    	    echo "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" align=\"center\"><tr><td>\n";
	    echo "<br /><font class=\"title\"><span style=\"font-weight: bold;\">$title</span></font><br /><br />\n";
	    if ($cover !== "") {
		echo "<img width=\"200\" height\"200\" src=\"images/reviews/$cover\" align=right border=1 vspace=2 title=\"$title\">\n";
	    }
	    echo "<div align=\"justify\">$text</div>\n";
	    echo "<br /><span style=\"font-weight: bold;\">"._ADDED."</span>&nbsp;&nbsp;$fdate<br />\n";
            echo "<span style=\"font-weight: bold;\">"._LANGUAGE."</span>&nbsp;&nbsp;$rlanguage<br />\n";
	    echo "<span style=\"font-weight: bold;\">"._REVIEWER.":</span>&nbsp;&nbsp;<a href=\"mailto:$email\">$reviewer</a><br />\n";
	    echo "<span style=\"font-weight: bold;\">"._SCORE.":</span>&nbsp;&nbsp;<span style=\"vertical-align=-33%\">\n";
	    display_score($score);
	    echo "</span>\n";
	    if ($url != "")
		echo "<br /><span style=\"font-weight: bold;\">"._RELATEDLINK.":</span>&nbsp;&nbsp;<a href=\"$url\" target=\"new\">$url_title</a>\n";
	    if ($id != 0) {
		echo "<br /><span style=\"font-weight: bold;\">"._REVIEWID.":</span>&nbsp;&nbsp;$id<br />\n";
		echo "<span style=\"font-weight: bold;\">"._HITS.":</span>&nbsp;&nbsp;<span style=\"font-weight: bold;\">$hits</span><br />\n";
	    }
	    echo "</font>\n";
	    echo "</td></tr></table></td></tr><tr><td colspan=\"2\" width=\"100%\">&nbsp;</td></tr>\n";
	    echo "<tr><td colspan=\"2\" width=\"100%\">&nbsp;</td></tr>\n";
	    $text = urlencode($text);
	    echo "<tr><td width=\"50%\" align=\"middle\" valign=\"middle\">"._LOOKSRIGHT."</td><td width=\"50%\" align=\"left\" valign=\"middle\">\n";
	    echo "<input type=\"hidden\" name=\"id\" value=$id>
		  <input type=\"hidden\" name=\"hits\" value=\"$hits\">
		  <input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\">
		  <input type=\"hidden\" name=\"date\" value=\"$date\">
		  <input type=\"hidden\" name=\"title\" value=\"$title\">
		  <input type=\"hidden\" name=\"text\" value=\"$text\">
		  <input type=\"hidden\" name=\"reviewer\" value=\"$reviewer\">
		  <input type=\"hidden\" name=\"email\" value=\"$email\">
		  <input type=\"hidden\" name=\"score\" value=\"$score\">
		  <input type=\"hidden\" name=\"url\" value=\"$url\">
		  <input type=\"hidden\" name=\"url_title\" value=\"$url_title\">
		  <input type=\"hidden\" name=\"cover\" value=\"$cover\">\n";
		  echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\">\n";
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
            echo '<br /><br /><strong>To prevent spamming, please enter the security code that you see below, before clicking on the YES button.</strong><br /><br />';
            global $modGFXChk;
            echo security_code($modGFXChk[$module_name], 'stacked').'<br />';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
		echo "<input type=\"submit\" name=\"rop\" value=\""._YES."\">&nbsp;&nbsp;<input type=\"button\" onClick=\"javascript:history.go(-1)\" value=\""._NO."\"></td></tr></table>\n";
	    echo "</form>\n";
	    if($id != 0)
	    	$word = ""._RMODIFIED."";
	    else
	    	$word = ""._RADDED."";
	    if(is_admin($admin))
	    	echo "<br /><br /><span style=\"font-weight: bold;\">"._NOTE."</span> "._ADMINLOGGED." $word.";
	}
	    echo "<br />\n";
    Closetable();
    include_once("footer.php");
}

?>
