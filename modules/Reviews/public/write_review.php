<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function write_review() {
    global $admin, $sitename, $user, $cookie, $prefix, $user_prefix, $currentlang, $multilingual, $db, $module_name;
    include_once('header.php');
	heading();
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._SUBMITREVIEW."</font></div>\n";
    CloseTable();
    Opentable();
	OpenTable2();
    echo "<div align=\"center\"><font class=\"title\">"._WRITEREVIEWFOR."</font></div>\n";
	CloseTable2();
    echo "<br /><div align=\"justify\">"._ENTERINFO."</div><br /><br />\n
    <form method=\"post\" action=\"modules.php?name=$module_name\" name=\"reviews\" enctype=\"multipart/form-data\">\n
    <span style=\"font-weight: bold;\">"._YOURNAME.":</span><br />\n";
    if (is_user($user)) {
        $result = $db->sql_query("select name, email from ".$user_prefix."_users where uname='$cookie[1]'");
        list($name, $email) = $db->sql_fetchrow($result);
    }
    echo "<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"$name\"><br />\n
    "._FULLNAMEREQ."<br /><br />\n
    <span style=\"font-weight: bold;\">"._REMAIL.":</span><br />\n
    <input type=\"text\" name=\"email\" size=\"41\" maxlength=\"80\" value=\"$email\"><br />\n
    "._REMAILREQ."<br /><br />\n
    <span style=\"font-weight: bold;\">"._PRODUCTTITLE.":</span><br />\n
    <input type=\"text\" name=\"title\" size=\"41\" maxlength=\"150\"><br />\n
    "._NAMEPRODUCT."<br />\n";
	echo "<br /><span style=\"font-weight: bold;\">"._LANGUAGE.": </span>\n"
	    ."<select name=\"rlanguage\">\n";
	$handle=opendir('language');
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
	        $languageslist .= "$langFound ";
	    }
	}
	closedir($handle);
	$languageslist = explode(" ", $languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
		echo "<option value=\"$languageslist[$i]\" ";
		if($languageslist[$i]==$currentlang) echo "selected";
		echo ">$languageslist[$i]</option>\n";
	    }
	}
    echo "</select><br />\n";
    echo "<span style=\"font-weight: bold;\">"._REVIEW.":</span><br />\n";
    if (function_exists('wysiwyg_textarea')) {
	if (is_admin($admin)) {
		wysiwyg_textarea("text", "", "PHPNukeAdmin", "65", "20");
	} else {
		wysiwyg_textarea("text", "", "NukeUser", "65", "20");
	}
    } else {
	echo "<textarea name=\"text\" rows=\"20\" wrap=\"virtual\" cols=\"65\"></textarea><br />\n";
    }
    if (is_admin($admin)) {
	echo "<font class=\"content\"><span style=\"font-weight: bold;\">"._ADMINOPTIONS.":</span> "._PAGEBREAK."</font><br />\n";
    }
    echo "<div align=\"justify\">"._CHECKREVIEW."<br /><br />"._HTMLISFINE."</div>\n";
    echo "<br /><br />\n";
    echo "<span style=\"font-weight: bold;\">"._YOURSCORE.":</span><br />\n
    <select name=\"score\">\n
    <option name=\"null\" value=\"null\">"._CHOOSE."</option>\n
    <option name=\"score\" value=\"10\">10</option>\n
    <option name=\"score\" value=\"9\">9</option>\n
    <option name=\"score\" value=\"8\">8</option>\n
    <option name=\"score\" value=\"7\">7</option>\n
    <option name=\"score\" value=\"6\">6</option>\n
    <option name=\"score\" value=\"5\">5</option>\n
    <option name=\"score\" value=\"4\">4</option>\n
    <option name=\"score\" value=\"3\">3</option>\n
    <option name=\"score\" value=\"2\">2</option>\n
    <option name=\"score\" value=\"1\">1</option>\n
    </select><br />\n

    "._SELECTSCORE."<br /><br />\n
    <span style=\"font-weight: bold;\">"._RELATEDLINK.":</span><br />\n
    <input type=\"text\" name=\"url\" size=\"41\" maxlength=\"100\"><br />\n
    <div align=\"justify\">"._PRODUCTSITE."</div><br />\n
    <span style=\"font-weight: bold;\">"._LINKTITLE.":</span><br />\n
    <input type=\"text\" name=\"url_title\" size=\"41\" maxlength=\"50\"><br />\n
    "._LINKTITLEREQ."<br /><br />\n";
    if (is_admin($admin)) {
	echo "<span style=\"font-weight: bold;\">"._RIMAGEFILE."</span>:<br />\n";
	echo "<input type=\"text\" name=\"cover\" size=\"45\"><br />\n";
	echo ""._RIMAGEFILEREQ."<br /><br />\n";
    }
    echo "<div align=\"justify\">"._CHECKINFO."</div><br /><br />\n";
    echo "<div align=\"center\"><input type=\"hidden\" name=\"rop\" value=\"preview_review\">\n";
    echo "<input type=\"submit\" value=\""._PREVIEW."\">&nbsp;&nbsp;";
    echo "<input type=\"reset\" value=\""._CLEAR."\">&nbsp;&nbsp;";
    echo "<input type=\"button\" onClick=\"history.go(-1)\" value=\""._CANCEL."\">\n";
    echo "</form>\n";
    echo "<div align=\"center\"><font class=\"content\">"._PRIVACY."</font></div>\n";
    echo "<br />\n";
    Closetable();
    include_once("footer.php");
}

?>