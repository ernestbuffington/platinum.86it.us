<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function postcomment($id, $title) {
    global $user, $cookie, $text, $score, $AllowableHTML, $anonymous, $module_name, $button_image;
    if (is_user($user)) {
	include_once("header.php");
	heading();
    cookiedecode($user);
    $title = urldecode($title);
    $text = stripslashes(check_html($text, ""));
	$rgen = $id;    
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._POSTCOMMENT."</font></div>\n";
    CloseTable();
    Opentable();
    OpenTable2();
    echo "<div align=\"center\"><font class=\"title\">"._REVIEWCOMMENT." - $title</font></div>\n";
    CloseTable2();
    echo "<form action=modules.php?name=$module_name method=post>\n";
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tr><td>\n";
    if (!is_user($user)) {
    echo "<span style=\"font-weight: bold;\">"._YOURNICK."</span> $anonymous [ "._RCREATEACCOUNT." ]<br /><br />\n";
    $uname = $anonymous;
    } else {
    echo "<span style=\"font-weight: bold;\">"._YOURNICK."</span> $cookie[1]<br />
    <input type=checkbox name=xanonpost> <span style=\"vertical-align=23%\">"._POSTANON."</span><br /><br />\n";
	$uname = $cookie[1];
    }
    echo "<span style=\"font-weight: bold;\">"._YOURSCORE.":</span><br />
    <input type=hidden name=uname value=$uname>
    <input type=hidden name=id value=$id>
	<input type=hidden name=gen value=$rgen>
    <select name=score>
    <option name=score value=null>Choose</option>
    <option name=score value=10>10</option>
    <option name=score value=9>9</option>
    <option name=score value=8>8</option>
    <option name=score value=7>7</option>
    <option name=score value=6>6</option>
    <option name=score value=5>5</option>
    <option name=score value=4>4</option>
    <option name=score value=3>3</option>
    <option name=score value=2>2</option>
    <option name=score value=1>1</option>
    </select><br />"._FAIR."<br /><br />
    <span style=\"font-weight: bold;\">"._YOURCOMMENT."</span><br />
    <textarea name=comments rows=10 cols=60></textarea>\n";
/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
    global $modGFXChk;
    echo '<br /><br />'.security_code($modGFXChk[$module_name], 'stacked');
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
        echo "<br /><br /></td></tr><tr><td align=\"center\" width=\"50%\">\n";
        echo "<input type=hidden name=rop value=savecomment>\n";

    echo "<input type=\"submit\" name=\"submit\" value=\""._SUBMIT."\">\n";
        echo "</td><td width=\"50%\">&nbsp;</td></tr></table></form>\n";
    Closetable();
    include_once("footer.php");
} else {
	include_once('header.php');
	heading();
	OpenTable();
	echo "<div align=\"center\">\n";
	echo ""._NOANONPOST."";
	echo "<br /><br />\n";
	echo "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._REGISTER."</a>\n";
	echo "</div>\n";
	CloseTable();
	include_once('footer.php');
}
}

?>
