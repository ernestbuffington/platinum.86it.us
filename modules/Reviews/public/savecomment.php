<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function savecomment($xanonpost, $uname, $id, $score, $comments, $gen) {
    global $anonymous, $user, $cookie, $prefix, $db, $module_name, $score;
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk;
    if (isset($_POST['gfx_check'])) $gfx_check = $_POST['gfx_check']; else $gfx_check = '';
    if (!security_code_check($gfx_check, $modGFXChk[$module_name])) {
        include_once('header.php');
        OpenTable();
        echo '<center><font class="option"><strong><i>'._SECCODEINCOR.'</i></strong></font><br />';
        echo '<input type="button" onclick="history.go(-1)" value="'._GOBACK2.'" /></center>';
        CloseTable();
        include_once('footer.php');
        die();
    }
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
******************************************************/
    include_once('header.php');
	heading();
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._REVIEWS."</font></div>\n";
    CloseTable();
OpenTable();
    echo "<br />\n";
    if ($comments == "") {
    	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._CINVALIDTEXT."</span><br />\n";
    }
    if (($score < 1) || ($score > 10)) {
	$error = 1;
	echo "<span style=\"font-weight: bold;\">"._CINVALIDSCORE."</span><br />\n";
    }
	if ($gen!==$id) {
	$error=1;
	}
	if ($error == 1){
	    echo "<br /><div align=\"center\">"._GOBACK."</div>\n";
CloseTable();
    include_once("footer.php");
} else {
    if ($xanonpost) {
	$uname = $anonymous;
    }
    $comments = stripslashes(FixQuotes(check_html($comments)));
    $db->sql_query("insert into ".$prefix."_reviews_comments values (NULL, '$id', '$uname', now(), '$comments', '$score')");
	update_points(12);
    Header("Location: modules.php?name=$module_name&rop=showcontent&id=$id#$id");
  }
}

?>
