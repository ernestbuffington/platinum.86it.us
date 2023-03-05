<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
    global $admin, $EditedMessage, $prefix, $db, $module_name;
    include_once('header.php');
	heading();
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk;
    if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
    if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
        OpenTable();
        echo '<center><font class="option"><strong><i>'._SECCODEINCOR.'</i></strong></font><br />';
        echo '<input type="button" onclick="history.go(-2)" value="'._GOBACK2.'" /></center>';
        CloseTable();
        include_once('footer.php');
        die();
    }
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/
    if (preg_match("/<!--pagebreak-->/i", $text)) {
	$text = preg_replace("/<!--pagebreak-->/","&lt;!--pagebreak--&gt;;",$text);
    }
    $title = stripslashes(FixQuotes(check_html($title, "nohtml")));
    $text = stripslashes(Fixquotes(urldecode(check_html($text, ""))));
    if (preg_match("/&lt;!--pagebreak--&gt;/i", $text)) {
	$text = preg_replace("/&lt;!--pagebreak--&gt;/","<!--pagebreak-->",$text);
    }
    OpenTable();
    echo "<div style=\"text-align: center;\"><font class=\"title\">"._SENDREVIEW."</font></div>\n";
    CloseTable();
    Opentable();
    echo "<br />\n";
    OpenTable2();
    echo "<br /><div style=\"text-align: center;\"><span style=\"font-weight: bold;\">"._RTHANKS."";
    if ($id != 0) {
	echo " "._MODIFICATION."";
	}
	echo ", $reviewer!";
        echo "</span><br /><br />\n";
    if ((is_admin($admin)) && ($id == 0)) {
	$db->sql_query("INSERT INTO ".$prefix."_reviews VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$cover', '$url', '$url_title', '1', '$rlanguage')");
	echo ""._ISAVAILABLE."";
    } else if ((is_admin($admin)) && ($id != 0)) {
	$db->sql_query("UPDATE ".$prefix."_reviews SET date='$date', title='$title', text='$text', reviewer='$reviewer', email='$email', score='$score', cover='$cover', url='$url', url_title='$url_title', hits='$hits', rlanguage='$rlanguage' where id = $id");
	echo ""._ISAVAILABLE."";
    } else {
	$db->sql_query("INSERT INTO ".$prefix."_reviews_add VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$url', '$url_title', '$rlanguage')");
	update_points(4);
	echo "<br />"._EDITORWILLLOOK."<br />\n";
    }
    echo "<br /><br />[ <a href=\"modules.php?name=$module_name\">"._RBACK."</a> ]</div><br />\n";
    CloseTable2();
    echo "<br />\n";
    Closetable();
    include_once("footer.php");
}

?>
