<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

function mod_review($id) {
	global $admin, $prefix, $db, $module_name;
	include_once('header.php');
	heading();
    OpenTable();
    echo "<div align=\"center\"><font class=\"title\">"._REVIEWMOD."</font></div>\n";
    CloseTable();
	Opentable();
	if (($id == 0) || (!is_admin($admin)))
	    echo "This function must be passed argument id, or you are not admin.";
	else if (($id != 0) && (is_admin($admin)))
	{
		$result = $db->sql_query("select * from ".$prefix."_reviews where id = $id");
		while($myrow = $db->sql_fetchrow($result))
		{
			$id =  $myrow["id"];
			$date = $myrow["date"];
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
		}
		echo "<br /><form method=POST action=modules.php?name=$module_name&amp;rop=preview_review><input type=hidden name=id value=$id>\n";
		echo "<table border=0 width=100%>
			<tr>
				<td width=12%><span style=\"font-weight: bold;\">"._RDATE."</span></td>
				<td><input type=text name=date size=15 VALUE=\"$date\" maxlength=10></td>
			</tr>
			<tr>
				<td width=12%><span style=\"font-weight: bold;\">"._RTITLE."</span></td>
				<td><input type=text name=title size=50 maxlength=150 value=\"$title\"></td>
			</tr>
			<tr>\n";
		echo "<td width=12%><span style=\"font-weight: bold;\">"._LANGUAGE."</span></td>
				<td><select name=\"rlanguage\">\n";
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
						if($languageslist[$i]==$rlanguage) echo "selected";
						echo ">$languageslist[$i]</option>\n";
					}
			    }

	    echo "</select></td></tr>\n";
	    echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._RTEXT."</span></td>\n";
	echo "<td>\n";
	if (function_exists('wysiwyg_textarea')) {
		wysiwyg_textarea("text", "$text", "PHPNukeAdmin", "60", "20");
	} else {
		echo "<textarea class=\"textbox\" name=\"text\" rows=\"20\" wrap=\"virtual\" cols=\"60\">$text</textarea>\n";
	}
	echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._REVIEWER."</span></td>\n";
	echo "<td><input type=text name=reviewer size=41 maxlength=40 value=\"$reviewer\"></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._REVEMAIL."</span></td>\n";
	echo "<td><input type=text name=email value=\"$email\" size=30 maxlength=80></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._SCORE."</span></td>\n";
	echo "<td><input type=text name=score value=\"$score\" size=3 maxlength=2></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._RLINK."</span></td>\n";
	echo "<td><input type=text name=url value=\"$url\" size=30 maxlength=100></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._RLINKTITLE."</span></td>\n";
	echo "<td><input type=text name=url_title value=\"$url_title\" size=30 maxlength=50></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._COVERIMAGE."</span></td>\n";
	echo "<td><input type=text name=cover value=\"$cover\" size=30 maxlength=100></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width=12%><span style=\"font-weight: bold;\">"._HITS.":</span></td>\n";
	echo "<td><input type=text name=hits value=\"$hits\" size=5 maxlength=5></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "<input type=\"hidden\" name=\"rop\" value=\"preview_review\"><input type=\"submit\" value=\""._PREMODS."\">&nbsp;&nbsp;<input type=button onClick=history.go(-1) value="._CANCEL."></form>\n";
	}
	Closetable();
	include_once("footer.php");
}

?>