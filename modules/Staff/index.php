<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */
/* Copyright (c) 2004 - 2005 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2007 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* PlatinumNuke: Your dreams, our imagination                                */
/************************************************************************/
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
$pagetitle = "- Staff";

//Start Staff Ness.
global $db, $prefix;

//Pull info about index.
$sqlind = "SELECT index_bl FROM ".$prefix."_staff_config";
$resultind = $db->sql_query($sqlind);
$rowind = $db->sql_fetchrow($resultind);
//If index is wanted, include.
$index = $rowind[index_bl];

include_once("header.php");

//Page Header
OpenTable();
//Require Functions.inc
require("modules/Staff/functions.inc");
echo "<strong><center>Staff Page</strong></center>";
CloseTable();
echo "<br />";
OpenTable();
//Pull Config info
$sqlconf = "SELECT img_url, staff_join_page, copyright_txt FROM ".$prefix."_staff_config WHERE latest = '1'";
$resultconf = $db->sql_query($sqlconf);
$rowconf = $db->sql_fetchrow($resultconf);
$img_url = $rowconf[img_url];
$staff_page = $rowconf[staff_join_page];
$copyright_txt = $rowconf[copyright_txt];

//if($copyright_txt != "[center][color=\"#999999\" size=\"1\"]Staff v0.2 by [url=\"http://www.caffeine-junkies.com\"]Caffeine Junkies[/url]. &copy; 2004[/colour][/center]") { die("Editing the copyright means no script use for you!"); }

if(!$img_url){ $img_url = "images/staff"; }

//retrieve staff categories
$sql = "SELECT * FROM ".$prefix."_staff_cat";
$result = $db->sql_query($sql);

//Print Staff Categories in order
while($row = $db->sql_fetchrow($result)){
	$cat_name = $row[name];
	$cat_id = $row[id];

	//get staff information
	$result_ = $db->sql_query("SELECT * FROM ".$prefix."_staff WHERE id = '$cat_id' AND ");
	$rowtmp = $db->sql_fetchrow($result2);
	$photo1 = $rowtmp[photo];


	//Print tables and category
	//echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n";
	echo "<table cellSpacing=1 cellPadding=2 width=\"100%\" border=1>";
	echo "<tbody width=\"100%\">";
	echo "<tr>\n";
	echo "<td width=\"100%\" colspan=\"3\">\n";
	echo "<center><font size=\"2\"><strong>$cat_name</strong></font></center>\n";
	echo "</td>\n";
	echo "</tr>\n";

	//Pull staff info
	$sql2 = "SELECT name, des, alias, photo, rank FROM ".$prefix."_staff WHERE id = '$cat_id'";
	$result2 = $db->sql_query($sql2);
	$num = $db->sql_numrows($result2);

	//Print Staff members
	while($row2 = $db->sql_fetchrow($result2)){
		$name = $row2[name];
		$description = $row2[des];
		$alias = $row2[alias];
		$photo = $row2[photo];
		$rank = $row2[rank];

		//Print the name and if there is an alias
		echo "<tr>\n";
		echo "<td height=\"11\">\n";
		echo "<strong>Name:</strong>\n";
		echo "</td>\n";
		echo "<td ";
		if($photo){
			if(!file_exists("$img_url/$photo")) {
				echo "colspan=\"2\"";
			}
		}
		echo ">\n";
		echo "$name";
		if($alias){ echo "&nbsp;<i>aka</i> $alias"; }
		echo "\n</td>\n";

		//check for photo if there is one in the database, then print
		if($photo){
			if(file_exists("$img_url/$photo")) {
            list($width, $height, $type, $attr) = getimagesize("$img_url/$photo");
				echo "\n<td rowspan=\"";
				if($rank) { echo "3"; } else { echo "2"; }
				echo "\" width=\"$width\">";
				echo "\n<img src=\"$img_url/$photo\">";
				echo "\n</td>";
			}
		}

		echo "\n</tr>";

		//If rank is assigned
		if($rank) {
			echo "\n<tr>";
			echo "\n<td height=\"11\">";
			echo "\n<strong>Position:</strong>";
			echo "\n</td>";
			echo "\n<td ";
		if($photo){
			if(!file_exists("$img_url/$photo")) {
				echo "colspan=\"2\"";
			}
		}
		echo ">";
			echo "\n$rank";
			echo "\n</td>\n</tr>";
		}

		//Print description.
		echo "\n<tr>";
		echo "\n<td>";
		echo "\n<strong>Description:</strong>";
		echo "\n</td>";
		echo "\n<td ";
		if($photo){
			if(!file_exists("$img_url/$photo")) {
				echo "colspan=\"2\"";
			}
		}
		echo ">";
		echo format_output($description);
		echo "\n</td>";
		echo "\n</tr>";
		if($num > 1) { echo "\n<tr>\n<td>\n</td>\n</tr>\n"; }
	}

	//Close category Table
	echo "\n</trbody></table>";
	echo "\n<br />\n\n";
}

//Staff join
echo "<table align=\"center\"><tr><td align=\"center\"><center>\n";

if(!$staff_page){
	echo "<strong>Currently Not Taking Staff</strong>\n";
}
else {
	echo "<form action=\"$staff_page\" method=\"post\">\n";
	echo "<input name=\"submit\" type=\"submit\" value=\"Join!\">\n";
	echo "</form>";
}

echo "</center></td></tr></table>\n";

//?><center><table><tr><td align="center"><? echo format_output($copyright_txt); ?></td></tr></table></center>
<?
CloseTable();
include_once("footer.php");
?>
