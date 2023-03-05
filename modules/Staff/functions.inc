<?php

FUNCTION connect_db() {
	global $dbhost, $dbuname, $dbpass, $dbname;
	mysql_connect("$dbhost", "$dbuname", "$dbpass") or die ("Problem connecting to Database");
	mysql_select_db("$dbname") or die ("Problem selecting database");
}


FUNCTION get_time($type) {

//Returns timestamp in variable from

//getdate is an internal php call
$time = getdate();

$hour = $time[hours];
$min = $time[minutes];
$sec = $time[seconds];
$year = $time[year];
$month = $time[mon];
$day = $time[mday];

if ($type == "datetime") {
//return 'DATETIME' format for SQL inserts
$stamp = ("$year" . "-" . "$month" . "-" . "$day" . " " . "$hour" . ":" . "$min" . ":" . "$sec");
return $stamp;
}

elseif ($type == "check") {
//return array for "stamp checking"
$stamp = array("$day", "$hour", "$min", "$month", "$year");
return $stamp;
   }
}

FUNCTION get_d($d,$d_var) {

// create sql statment
$sql = "SELECT i, $d
        FROM $d
		WHERE i = '$d_var'";

// execute SQl query and get results
$result = mysql_query($sql) or die ("Couldn't get results.");

// format results by row
$row = mysql_fetch_array($result);
    $dreturn = $row["$d"];

// free resources and close connection
mysql_free_result($result);

//Return results
return $dreturn;

}

FUNCTION get_dbox($get_dbox_db,$get_dbox_field_name,$get_dbox_selected) {
	// create sql statment
	$sql = "SELECT i, $get_dbox_db
       		FROM $get_dbox_db";

$result = mysql_query($sql);

	if($result)
	{
		print "<select name=\"$get_dbox_field_name\">";
		if ($get_dbox_selected == "0" || !isset($get_dbox_selected)) {print "<option selected value=\"0\">::Select One::</option>";
		} elseif ($get_dbox_selected > "0") {};
		while($row = mysql_fetch_array($result))
		{
			$dbox_name = $row["$get_dbox_db"];
			$dbox_num = $row["i"];
			if ("$dbox_name" == "$get_dbox_selected" || "$dbox_num" == "$get_dbox_selected") {
				print "<option selected value=\"$dbox_num\">$dbox_name</option>";
			} else {
				print "<option value=\"$dbox_num\">$dbox_name</option>";
			};
		}
		print "</select>";
		mysql_free_result($result);
	}
}

FUNCTION format_output($output) {

	$output = htmlspecialchars(stripslashes($output));
    /* new paragraph */
    $output = str_replace('[p]', '<p>', $output);
    /* bold */
    $output = str_replace('[b]', '<strong>', $output);
    $output = str_replace('[/b]', '</strong>', $output);
    /* underline */
    $output = str_replace('[u]', '<u>', $output);
    $output = str_replace('[/u]', '</u>', $output);
    /* italics */
    $output = str_replace('[i]', '<i>', $output);
    $output = str_replace('[/i]', '</i>', $output);
    /* preformatted */
    $output = str_replace('[pre]', '<pre>', $output);
    $output = str_replace('[/pre]', '</pre>', $output);
    /* indented blocks (blockquote) */
    $output = str_replace('[indent]', '<blockquote>', $output);
    $output = str_replace('[/indent]', '</blockquote>', $output);
    /* anchors */
    $output = preg_replace('/\[anchor=&amp;quot;([[:graph:]]+)&amp;quot;\]/', '&lt;a name="\1">&lt;/a>', $output);
    /* URLs */
    $output = str_replace('[url=&quot;', '<a href="', $output);
    $output = str_replace('&quot;]', '">', $output);
    $output = str_replace('[/url]', '</a>', $output);
    /* Center (allowing for US and British spelling) */
    $output = str_replace('[center]', '<center>', $output);
    $output = str_replace('[centre]', '<center>', $output);
    $output = str_replace('[/center]', '</center>', $output);
    $output = str_replace('[/centre]', '</center>', $output);
    /* Text Effects (allowing for US and British spelling) */
    $output = str_replace('&quot;', '"', $output);
    $output = str_replace('&amp;copy;', '&copy;', $output);
    $output = str_replace('[colour="', '<font color="', $output);
    $output = str_replace('[color="', '<font color="', $output);
    $output = str_replace('[/colour]', '</font>', $output);
    $output = str_replace('[/color]', '</font>', $output);
    $output = str_replace('[red]', '<font color="#ff0000">', $output);
    $output = str_replace('[/red]', '</font>', $output);
    $output = str_replace('[blue]', '<font color="#0009ff">', $output);
    $output = str_replace('[/blue]', '</font>', $output);
    $output = str_replace('[green]', '<font color="#08ff00">', $output);
    $output = str_replace('[/green]', '</font>', $output);
    $output = str_replace('[black]', '<font color="#000000">', $output);
    $output = str_replace('[/black]', '</font>', $output);
    $output = str_replace('[white]', '<font color="#FFFFFF">', $output);
    $output = str_replace('[/white]', '</font>', $output);
    $output = str_replace('[yellow]', '<font color="#FFFF00">', $output);
    $output = str_replace('[/yellow]', '</font>', $output);
    $output = str_replace('[purple]', '<font color="#DD00FF">', $output);
    $output = str_replace('[/purple]', '</font>', $output);
    /* Header Effects */
    $output = str_replace('[h3]', '<h3>', $output);
    $output = str_replace('[/h3]', '</h3>', $output);
    $output = str_replace('[h2]', '<h2>', $output);
    $output = str_replace('[/h2]', '</h2>', $output);
    $output = str_replace('[h1]', '<h1>', $output);
    $output = str_replace('[/h1]', '</h1>', $output);

    /* links, note we try to prevent javascript in links */
    $output = str_replace('[link=&amp;quot;javascript', '[link=&amp;quot; javascript', $output);
    $output = preg_replace('/\[link=&amp;quot;([[:graph:]]+)&amp;quot;\]/', '&lt;a href="\1">', $output);
    $output = str_replace('[/link]', '&lt;/a>', $output);      
    
    return nl2br($output);
}

FUNCTION email_format($email) {
	/* Replace the @ */
	$email = str_replace("@", "&nbsp;'at'&nbsp;", $email);
	/* Replace the . */
	$email = str_replace(".", "&nbsp;'dot'&nbsp;", $email);
	return $email;
}

FUNCTION get_short_date($date) {
	$vardate = "$date";
	preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/",$vardate, $regs);
	$date = "$regs[3].$regs[2].$regs[1]";
	print($date);
}

FUNCTION update_check($ver1, $ver2, $module){
$update_checker = "http://www.caffeine-junkies.com/downloads/checker/update.php".
		  "?module=$module&ver1=$ver1&ver2=$ver2";
$content = file($update_checker);
$slurp = "";
while (list($foo,$bar) = each($content)) {
    $slurp .= $bar;
}
return $slurp;
}
?>
