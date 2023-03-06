<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    PCN AdsPlus v2.0 -- by Pc-Nuke! --  www.pcnuke.com                */
/************************************************************************/
/*    Created by PcNuke.com -- Released on: 06.10.20. y.m.d             */
/*    http://www.max.pcnuke.com  --  http://www.pcnuke.com              */
/*    All Rights Reserved 2006 -- by Pc-Nuke!                           */
/*    No Modding, Porting, Changing, or Distribution of this program    */
/*    is allowed without written permission from www.pcnuke.com         */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/

/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.max.pcnuke.com/modules.php?name=GNU_GPL                 */
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

/**********************************/
/*  Module Configuration          */
/* (right side on) v3.1           */
/* Remove the following 2 lines   */
/* will remove the right side     */
/**********************************/

/*******************
 Applied rules:
 * AddDefaultValueForUndefinedVariableRector (https://github.com/vimeo/psalm/blob/29b70442b11e3e66113935a2ee22e165a70c74a4/docs/fixing_code.md#possiblyundefinedvariable)
 * BinaryOpBetweenNumberAndStringRector (https://3v4l.org/XPEEl)
 * SensitiveConstantNameRector (https://wiki.php.net/rfc/case_insensitive_constant_deprecation)
 * NullToStrictStringFuncCallArgRector
 *******************/

define('INDEX_FILE', true);

$index = 1; 

if (!defined('ADMIN_FILE')) {

	die ("Access Denied");

}

 

global $prefix, $db, $nukeurl, $admin_file;

$aid = substr((string) $aid, 0,25);

$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));

if ($row['radminsuper'] == 1) {



	/*********************************************************/

	/* Banners Administration Functions                      */

	/*********************************************************/



	$c_num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_clients"));

	if ($c_num == 0) {

		$cli = "<i>"._ADDNEWBANNER."</i>";

	} else {

		$cli = "<a href=\"".$admin_file.".php?op=add_banner\">"._ADDNEWBANNER."</a>";

	}

	$act = $db->sql_fetchrow($db->sql_query("SELECT active FROM ".$prefix."_modules WHERE title='Advertising'"));

	if ($act['active'] == 0) {

		$act = "<center>"._ADSMODULEINACTIVE."</center>";	

	} else {

		$act = "";	

	}

	$ad_admin_menu = "<center><font class=\"title\"><strong>" . _BANNERSADMIN . "</strong></font>

	<hr width='80%'>

	[ <a href=\"".$admin_file.".php?op=BannersAdmin\">"._BANNERCLIENTS."</a>

    || <a href=\"".$admin_file.".php?op=ad_positions\">"._ADPOSITIONS."</a>

	|| <a href=\"".$admin_file.".php?op=ajaxBlocksEditor\">"._ADBLOCKS."</a>

	|| <a href=\"".$admin_file.".php\">"._ADMINMAIN."</a>

	|| <a href=\"modules.php?name=Advertising\">"._ADSFRONTSIDE."</a> ]<br /><br />

	

<strong>Edit:</strong>  [ 

<a href=\"".$admin_file.".php?op=frontpage\">"._TITLEFRONT."</a> - 

<a href=\"".$admin_file.".php?op=cancel\">"._TITLECANCEL."</a> - 

<a href=\"".$admin_file.".php?op=campaigns\">"._TITLECAMPAIGNS."</a> - 

<a href=\"".$admin_file.".php?op=stats\">"._TITLESTATS."</a> - 

<a href=\"".$admin_file.".php?op=ad_terms\">"._TITLETERMS."</a> - 

<a href=\"".$admin_file.".php?op=thanks\">"._TITLETHANKS."</a> ]

<br /><br />

<strong>Add:</strong>   [  $cli - <a href=\"".$admin_file.".php?op=add_client\">"._ADDCLIENT."</a> - <a href=\"".$admin_file.".php?op=ad_plans\">"._PLANSPRICES."</a> ]

<br /><br />  [  <strong><a href=\"".$admin_file.".php?op=CheckImages\">"._ADSUPLOAD."</a> | <a href='modules.php?name=Advertising&op=sponsors'>"._ADVIEWBANNERS."</a></strong> ]<br /></center><br />$act";





/////////////////////////////////////////////////////////////////

// Main page of Advertising Admin

/////////////////////////////////////////////////////////////////

	function BannersAdmin() {

		global $prefix, $db, $bgcolor2, $banners, $admin_file, $ad_admin_menu, $bgcolor1;

		include_once("header.php");

		//echo "<br />";

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		/* Banners List */

		echo "<a name=\"top\">";

		OpenTable();

		echo "<center><font class=\"option\"><strong>" . _ACTIVEBANNERS . "</strong></font></center><br />"

		."<table width=100% border=1><tr>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _BANNERNAME . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLIENT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _ENDDATE . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPRESSIONS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPLEFT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKSPERCENT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _POSITION . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLASS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";

		$result = $db->sql_query("SELECT bid, cid, name, enddate, imptotal, impmade, clicks, imageurl, date,  position, active, ad_class from " . $prefix . "_banner WHERE active='1' order by position,bid");

		while ($row = $db->sql_fetchrow($result)) {

			$bid = intval($row['bid']);

			$cid = intval($row['cid']);

			$enddate = $row['enddate'];

			$imptotal = intval($row['imptotal']);

			$impmade = intval($row['impmade']);

			$clicks = intval($row['clicks']);

			$imageurl = $row['imageurl'];

			$date = $row['date'];

			$dateend = $row['dateend'];

			$type = $row['position'];

			$active = intval($row['active']);

			$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients where cid='$cid'"));

			$cid = intval($row2['cid']);

			$name = trim((string) $row2['name']);

			$ad_class = $row['ad_class'];

			if ($row['name'] == "") {

				$row['name'] = _NONE;

			} else {

				if ($row['ad_class'] == "image") {

					$row['name'] = "<a href=\"$imageurl\" target=\"_blank\">".$row['name']."</a>";

				}

			}

			if ($ad_class == "") {

				$ad_class = "image";	

			}

			$ad_class = ucFirst((string) $ad_class);

			if($impmade==0) {

				$percent = 0;

			} else {

				$percent = substr(100 * $clicks / $impmade, 0, 5);

			}

			if($imptotal==0) {

				$left = _UNLIMITED;

			} else {

				$left = $imptotal-$impmade;

			}

			$percent = "$percent%";

			if ($ad_class == "Code" || $ad_class == "Flash") {

				$clicks = "N/A";

				$percent = "N/A";

			}

			$row2 = $db->sql_fetchrow($db->sql_query("SELECT apid, position_name FROM ".$prefix."_banner_positions where position_number='$type'"));

			$type = "<a href=\"".$admin_file.".php?op=position_edit&apid=".$row2['apid'] . "\">".$row2['position_name']."</a>";

			if ($active == 1) {

				$t_active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

				$c_active = "<img src=\"images/inactive.gif\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

			} else {

				$t_active = "<img src=\"images/inactive.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

				$c_active = "<img src=\"images/active.gif\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

			}

		echo "<td bgcolor=\"$bgcolor1\" align=center>".$row['name']."</td>"

			."<td bgcolor=\"$bgcolor1\" align=center><a href=\"".$admin_file.".php?op=BannerClientEdit&cid=".$row['cid']."\">$name</a></td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$enddate</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$impmade</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$left</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$clicks</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$percent</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$type</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$ad_class</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>&nbsp;<a href=\"".$admin_file.".php?op=BannerEdit&amp;bid=$bid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=BannerStatus&amp;bid=$bid&status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=BannerDelete&amp;bid=$bid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";

		}

		echo "</td></tr></table><br />"

		."<center><font class=\"option\"><strong>" . _INACTIVEBANNERS . "</strong></font></center><br />"

		."<table width=100% border=1><tr>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _BANNERNAME . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLIENT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _ENDDATE . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPRESSIONS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPLEFT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKSPERCENT . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _POSITION . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLASS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";

		$result = $db->sql_query("SELECT bid, cid, name, enddate, imptotal, impmade, clicks, imageurl, date, position, active, ad_class from " . $prefix . "_banner WHERE active='0' order by position,bid");

		while ($row = $db->sql_fetchrow($result)) {

			$bid = intval($row['bid']);

			$cid = intval($row['cid']);

			$enddate = $row['enddate'];

			$imptotal = intval($row['imptotal']);

			$impmade = intval($row['impmade']);

			$clicks = intval($row['clicks']);

			$imageurl = $row['imageurl'];

			$date = $row['date'];

			$type = $row['position'];

			$active = intval($row['active']);

			$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients where cid='$cid'"));

			$cid = intval($row2['cid']);

			$name = trim((string) $row2['name']);

			$ad_class = $row['ad_class'];

			if ($row['name'] == "") {

				$row['name'] = _NONE;

			} else {

				if ($row['ad_class'] == "image") {

					$row['name'] = "<a href=\"$imageurl\" target=\"_blank\">".$row['name']."</a>";

				}

			}

			if ($ad_class == "") {

				$ad_class = "image";	

			}

			$ad_class = ucFirst((string) $ad_class);

			if($impmade==0) {

				$percent = 0;

			} else {

				$percent = substr(100 * $clicks / $impmade, 0, 5);

			}

			if($imptotal==0) {

				$left = _UNLIMITED;

			} else {

				$left = $imptotal-$impmade;

			}

			$percent = "$percent%";

			if ($ad_class == "Code" || $ad_class == "Flash") {

				$clicks = "N/A";

				$percent = "N/A";

			}

			$row2 = $db->sql_fetchrow($db->sql_query("SELECT apid, position_name FROM ".$prefix."_banner_positions where position_number='$type'"));

			$type = "<a href=\"".$admin_file.".php?op=position_edit&apid=".$row2['apid'] . "\">".$row2['position_name']."</a>";

			if ($active == 1) {

				$t_active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

				$c_active = "<img src=\"images/inactive.gif\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

			} else {

				$t_active = "<img src=\"images/inactive.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

				$c_active = "<img src=\"images/active.gif\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

			}

		echo "<td bgcolor=\"$bgcolor1\" align=center>".$row['name']."</td>"

			."<td bgcolor=\"$bgcolor1\" align=center><a href=\"".$admin_file.".php?op=BannerClientEdit&cid=".$row['cid']."\">$name</a></td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$enddate</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$impmade</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$left</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$clicks</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$percent</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$type</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>$ad_class</td>"

			."<td bgcolor=\"$bgcolor1\" align=center>&nbsp;<a href=\"".$admin_file.".php?op=BannerEdit&amp;bid=$bid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=BannerStatus&amp;bid=$bid&status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=BannerDelete&amp;bid=$bid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";

		}

		echo "</td></tr></table>";

		CloseTable();

		//echo "<br />";

		/* Clients List */

		OpenTable();

		echo "<center><font class=\"option\"><strong>" . _ADVERTISINGCLIENTS . "</strong></font></center><br />"

		."<table width=\"100%\" border=\"1\"><tr>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLIENTNAME . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _ACTIVEBANNERS2 . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _INACTIVEBANNERS . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CONTACTNAME . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CONTACTEMAIL . "</strong></td>"

		."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";

		$result3 = $db->sql_query("SELECT cid, name, contact, email from " . $prefix . "_banner_clients order by cid");

		while ($row3 = $db->sql_fetchrow($result3)) {

			$cid = intval($row3['cid']);

			$name = $row3['name'];

			$contact = $row3['contact'];

			$email = $row3['email'];

			$result4 = $db->sql_query("SELECT cid from " . $prefix . "_banner WHERE cid='$cid' AND active='1'");

			$numrows = $db->sql_numrows($result4);

			$row4 = $db->sql_fetchrow($result4);

			$rcid = intval($row4['cid']);

			$numrows2 = $db->sql_numrows($db->sql_query("SELECT cid from " . $prefix . "_banner WHERE cid='$cid' AND active='0'"));

			echo "<td bgcolor=\"$bgcolor1\" align=\"center\">$name</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$numrows</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$numrows2</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$contact</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\"><a href=\"mailto:$email\">$email</a></td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\" nowrap>&nbsp;<a href=\"".$admin_file.".php?op=BannerClientEdit&amp;cid=$cid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=BannerClientDelete&amp;cid=$cid\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";

		}

		echo "</td></tr></table>";

		CloseTable();



include_once("footer.php");

	}











	function add_banner() {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		define('NO_EDITOR', 1);

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$result = $db->sql_query("select * from ".$prefix."_banner_clients");

		$numrows = $db->sql_numrows($result);

		if($numrows > 0) {

			echo "<center><font class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></font></center><br /><br />"

			."<table border=\"0\"><tr><td>"

			."<form action=\"".$admin_file.".php?op=BannersAdd\" method=\"post\">"

			."" . _CLIENTNAME . ":</td>"

			."<td><select name=\"cid\">";

			$result = $db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients ORDER BY name");

			while ($row = $db->sql_fetchrow($result)) {

				$cid = intval($row['cid']);

				$name = $row['name'];

				echo "<option value=\"$cid\">$name</option>";

			}

			echo "</select></td></tr>"

			."<tr><td nowrap>" . _BANNERNAME . ":</td><td><input type=\"text\" name=\"adname\" size=\"12\" maxlength=\"50\"></td></tr>"

			."<tr><td nowrap>" . _ENDDATE . ":</td><td><input type=\"text\" name=\"enddate\" size=\"12\" maxlength=\"100\"> This is only for reference - All ads have to be manually stopped by the Admin</td></tr>"

			."<tr><td nowrap>" . _PURCHASEDIMPRESSIONS . ":</td><td><input type=\"text\" name=\"imptotal\" size=\"12\" maxlength=\"11\"> 0 = " . _UNLIMITED . "</td></tr>"

			."<tr><td>" . _ADCLASS . ":</td><td><select name=\"ad_class\">"

			."<option name=\"type\" value=\"image\">" . _ADIMAGE . "</option>"

			."<option name=\"type\" value=\"code\">" . _ADCODE . "</option>"

			."<option name=\"type\" value=\"flash\">" . _ADFLASH . "</option>"

			."</select></td></tr>"

			."<tr><td>&nbsp;</td><td><i>"._CLASSNOTE."</i></td></tr>"

			."<tr><td>" . _IMAGESWFURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"http://\"></td></tr>"

			."<tr><td>" . _IMAGESIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\"> &nbsp; "._INPIXELS."</td></tr>"

			."<tr><td>" . _CLICKURL . "</td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"http://\"></td></tr>"

			."<tr><td>" . _ALTTEXT . ":</td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\"></td></tr>"

			."<tr><td>" . _ADCODE . ":</td><td><textarea name=\"ad_code\" rows=\"15\" cols=\"70\"></textarea></td></tr>"

			."<tr><td>" . _TYPE . ":</td><td><select name=\"position\">";

			$result = $db->sql_query("SELECT position_number, position_name FROM ".$prefix."_banner_positions ORDER BY position_number");

			while ($row = $db->sql_fetchrow($result)) {

				echo "<option name=\"position\" value=\"".$row['position_number']."\">".$row['position_number']." - ".$row['position_name']."</option>";

			}

			echo "</select></td></tr><tr><td>&nbsp;</td><td>"._POSITIONNOTE."</td></tr>"

				."<tr><td>" . _ACTIVATE . ":</td><td><input type=\"radio\" name=\"active\" value=\"1\" checked>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\">" . _NO . "</td></tr>"

				."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"BannersAdd\">"

				."<input type=\"submit\" value=\"" . _ADDBANNER . "\">"

				."</form></td></tr></table>";

		} else {

			echo "<center><font class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></font></center><br /><br />"

				."<center>"._ADSNOCLIENT."<br /><br />"._GOBACK."</center>";

		}

		CloseTable();

		include_once("footer.php");

	}

	

	

	

	

	

	function add_client() {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$cl_pass = makepass();

		echo"<center><font class=\"title\"><strong>" . _ADDCLIENT . "</strong></font></center><br /><br />

			<table border=\"0\"><tr><td>

			<form action=\"".$admin_file.".php?op=BannerAddClient\" method=\"post\">

			" . _CLIENTNAME . ":</td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\"></td></tr>

			<tr><td>" . _CONTACTNAME . ":</td><td><input type=\"text\" name=\"contact\" size=\"30\" maxlength=\"60\"></td></tr>

			<tr><td>" . _CONTACTEMAIL . ":</td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"></td></tr>

			<tr><td>" . _CLIENTLOGIN . ":</td><td><input type=\"text\" name=\"login\" size=\"12\" maxlength=\"10\"></td></tr>

			<tr><td>" . _CLIENTPASSWD . ":</td><td><input type=\"text\" name=\"passwd\" size=\"12\" maxlength=\"10\" value=\"$cl_pass\"></td></tr>

			<tr><td>" . _EXTRAINFO . ":</td><td><textarea name=\"extrainfo\" cols=\"70\" rows=\"15\"></textarea></td></tr>

			<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"BannerAddClient\">

			<input type=\"submit\" value=\"" . _ADDCLIENT2 . "\">

			</form></td></tr></table>";

		CloseTable();

		include_once("footer.php");

	}



	function BannerStatus($bid, $status) {

		global $prefix, $db, $admin_file;

		if ($status == 1) {

			$active = 0;

		} else {

			$active = 1;

		}

		$bid = intval($bid);

		$db->sql_query("update " . $prefix . "_banner set active='$active' WHERE bid='$bid'");

		Header("Location: ".$admin_file.".php?op=BannersAdmin");

	}



	function BannersAdd($name, $cid, $adname, $enddate, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height) {

		$a = null;
  global $prefix, $db, $admin_file, $ad_admin_menu;

		$alttext = filter($alttext, "nohtml", 1);

		$cid = intval($cid);

		$imptotal = intval($imptotal);

		$active = intval($active);

		if (($ad_class == "image" OR $ad_class == "flash") AND ($ad_width == "" OR $ad_height == "")) { $a = 1; }

		if (($ad_class == "image") AND ($imageurl == "http://" OR $imageurl == "")) { $a = 1; }

		if (($ad_class == "image" OR $ad_class == "flash") AND ((!is_numeric($ad_width) || !is_numeric($ad_height)))) { $a = 1; }

		if (($ad_class == "code") AND ($ad_code == "")) { $a = 1; }

		if ($a == 1) {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			echo "<center>"._ADINFOINCOMPLETE."<br /><br />"._GOBACK."</center>";

			CloseTable();

			include_once("footer.php");

			die();

		}

		$adname = filter($adname, "nohtml", 1);

		$enddate = filter($enddate, "nohtml", 1);

		$db->sql_query("insert into " . $prefix . "_banner values (NULL, '$cid', '$adname', '$enddate', '$imptotal', '1', '0', '$imageurl', '$clickurl', '$alttext', now(), '00-00-0000 00:00:00', '$position', '$active', '$ad_class', '$ad_code', '$ad_width', '$ad_height')");

		Header("Location: ".$admin_file.".php?op=BannersAdmin");

	}



	function BannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo) {

		global $prefix, $db, $admin_file;

		$name = filter($name, "nohtml", 1);

		$contact = filter($contact, "nohtml", 1);

		$email = filter($email, "nohtml", 1);

		$login = filter($login, "nohtml", 1);

		$passwd = filter($passwd, "nohtml", 1);

		$extrainfo = filter($extrainfo, "nohtml", 1);

		$db->sql_query("insert into " . $prefix . "_banner_clients values (NULL, '$name', '$contact', '$email', '$login', '$passwd', '$extrainfo')");

		Header("Location: ".$admin_file.".php?op=BannersAdmin");

	}



	function BannerDelete($bid, $ok=0) {

		$alttext = null;
  global $prefix, $db, $admin_file, $bgcolor1, $bgcolor2, $ad_admin_menu;

		$bid = intval($bid);

		if ($ok == 1) {

			$db->sql_query("delete from " . $prefix . "_banner where bid='$bid'");

			Header("Location: ".$admin_file.".php?op=BannersAdmin");

		} else {

			include_once("header.php");

			

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			$row = $db->sql_fetchrow($db->sql_query("SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, ad_class, ad_code, ad_width, ad_height from " . $prefix . "_banner where bid='$bid'"));

			$row['name'] = filter($row['name'], "nohtml");

			$cid = intval($row['cid']);

			$imptotal = intval($row['imptotal']);

			$impmade = intval($row['impmade']);

			$clicks = intval($row['clicks']);

			$imageurl = $row['imageurl'];

			$clickurl = $row['clickurl'];

			$ad_class = $row['ad_class'];

			$ad_code = $row['ad_code'];

			$ad_width = $row['ad_width'];

			$ad_height = $row['ad_height'];

			if ($row['name'] == "") {

				$row['name'] = _NONE;

			}

			OpenTable();

			echo "<center><font class=\"title\"><strong>" . _DELETEBANNER . "</strong></font><br /><br />";

			if ($ad_class == "code") {

				$ad_code = filter($ad_code);

				//$ad_code = stripslashes(FixQuotes($ad_code));

				echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br /><br />";

			} elseif ($ad_class == "flash") {

				echo "<center>

					<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"

					codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"

					WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">

					<PARAM NAME=movie VALUE=\"$imageurl\">

					<PARAM NAME=quality VALUE=high>

					<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"

					NAME=\"$bid\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"

					PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">

					</EMBED>

					</OBJECT>

					</center><br /><br />";

			} else {

				echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br /><br />";

			}

			echo "<table width=\"100%\" border=\"1\"><tr>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _BANNERNAME . "<strong></td>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPRESSIONS . "<strong></td>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _IMPLEFT . "<strong></td>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKS . "<strong></td>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLICKSPERCENT . "<strong></td>"

				."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _CLIENTNAME . "<strong></td><tr>";

			$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients where cid='$cid'"));

			$cid = intval($row2['cid']);

			$name = filter($row2['name'], "nohtml");

			$percent = substr(100 * $clicks / $impmade, 0, 5);

			if($imptotal==0) {

				$left = _UNLIMITED;

			} else {

				$left = $imptotal-$impmade;

			}

			echo "<td bgcolor=\"$bgcolor1\" align=\"center\">".$row['name']."</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$impmade</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$left</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$clicks</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$percent%</td>"

			."<td bgcolor=\"$bgcolor1\" align=\"center\">$name</td><tr>";

		}

		echo "</td></tr></table><br />"

			."" . _SURETODELBANNER . "<br /><br />"

			."[ <a href=\"".$admin_file.".php?op=BannersAdmin\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=BannerDelete&amp;bid=$bid&amp;ok=1\">" . _YES . "</a> ]</center><br />";

		CloseTable();

		include_once("footer.php");

	}

	

	

	function BannerEdit($bid) {

		$did = null;
  $unl = null;
  global $prefix, $db, $admin_file, $ad_admin_menu;

		define('NO_EDITOR', true);

		include_once("header.php");

		

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		$bid = intval($bid);

		$row = $db->sql_fetchrow($db->sql_query("SELECT cid, name, enddate, imptotal, impmade, clicks, imageurl, clickurl, alttext,  date,  position, active, ad_class, ad_code, ad_width, ad_height from " . $prefix . "_banner where bid='$bid'"));

		$cid = intval($row['cid']);

		$enddate = $row['enddate'];

		$imptotal = intval($row['imptotal']);

		$impmade = intval($row['impmade']);

		$clicks = intval($row['clicks']);

		$imageurl = $row['imageurl'];

		$clickurl = $row['clickurl'];

		$alttext = filter($row['alttext'], "nohtml");

		$date = $row['date'];

		$date = explode(" ", (string) $date);

		$date = "$date[0] @ $date[1]";

		$position = $row['position'];

		$active = intval($row['active']);

		$ad_class = $row['ad_class'];

		$ad_code = $row['ad_code'];

		$ad_width = $row['ad_width'];

		$ad_height = $row['ad_height'];

		OpenTable();

		echo"<center><font class=\"title\"><strong>" . _EDITBANNER . "</strong></font></center><br /><br />";

		if ($ad_class == "code") {

			$ad_code = stripslashes((string) FixQuotes($ad_code));

			echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br /><br />";

		} elseif ($ad_class == "flash") {

			echo "<center>

				<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"

				codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"

				WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">

				<PARAM NAME=movie VALUE=\"$imageurl\">

				<PARAM NAME=quality VALUE=high>

				<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"

				NAME=\"$did\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"

				PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">

				</EMBED>

				</OBJECT>

				</center><br /><br />";

		} else {

			echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br /><br />";

		}



		echo "<table border=\"0\" cellpadding=\"3\"><tr><td>"

			."<form action=\"".$admin_file.".php?op=BannerChange\" method=\"post\">"

			."" . _CLIENTNAME . ":</td><td>"

			."<select name=\"cid\">";

		$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients where cid='$cid'"));

		$cid = intval($row2['cid']);

		$name = filter($row2['name'], "nohtml");

		echo "<option value=\"$cid\" selected>$name</option>";

		$result3 = $db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients");

		while ($row3 = $db->sql_fetchrow($result3)) {

			$ccid = intval($row3['cid']);

			$name = filter($row3['name'], "nohtml");

			if($cid!=$ccid) {

				echo "<option value=\"$ccid\">$name</option>";

			}

		}

		echo "</select></td></tr>";

		if($imptotal==0) {

			$impressions = _UNLIMITED;

		} else {

			$impressions = $imptotal;

		}

		if ($active == 1) {

			$check1 = "checked";

			$check2 = "";

		} else {

			$check1 = "";

			$check2 = "checked";

		}

		if ($imptotal != 0) {

			$unl = "("._XFORUNLIMITED.")";

		}

		echo "<tr><td>"._BANNERNAME.":</td><td><input type=\"text\" name=\"adname\" size=\"20\" maxlength=\"50\" value=\"".$row['name']."\"></td></tr>";

		echo "<tr><td>"._ENDDATE.":</td><td><input type=\"text\" name=\"enddate\" size=\"20\" maxlength=\"50\" value=\"".$row['enddate']."\"></td></tr>";

		echo "<tr><td>"._ADDEDDATE.":</td><td>$date</td></tr>";

		echo "<tr><td>"._IMPPURCHASED.":</td><td><strong>$impressions</strong></td></tr>";

		echo "<tr><td>"._IMPMADE.":</td><td><strong>$impmade</strong></td></tr>";

		echo "<tr><td>"._ADDIMPRESSIONS.":</td><td><input type=\"text\" name=\"impadded\" size=\"12\" maxlength=\"11\" value=\"0\"> <i>$unl</i></td></tr>";

		echo "<tr><td>"._ADCLASS.":</td><td><strong>".ucFirst((string) $ad_class)."</strong></td></tr>";

		if ($ad_class == "code") {

			echo "<tr><td>" . _ADCODE . ":</td><td><textarea name=\"ad_code\" rows=\"15\" cols=\"70\">$ad_code</textarea>"

				."<input type=\"hidden\" name=\"imageurl\" value=\"$imageurl\">"

				."<input type=\"hidden\" name=\"ad_width\" value=\"$ad_width\">"

				."<input type=\"hidden\" name=\"ad_height\" value=\"$ad_height\">"

				."<input type=\"hidden\" name=\"clickurl\" value=\"$clickurl\">"

				."<input type=\"hidden\" name=\"alttext\" value=\"$alttext\"></td></tr>";

		} elseif ($ad_class == "flash") {

			echo "<tr><td>" . _FLASHFILEURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"$imageurl\"> &nbsp; <a href=\"$imageurl\" target=\"_blank\"><img src=\"images/view.gif\" border=\"0\" alt=\""._SHOW."\" title=\""._SHOW."\"></a></td></tr>"

				."<tr><td>" . _FLASHSIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\" value=\"$ad_width\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\" value=\"$ad_height\"> &nbsp; "._INPIXELS.""

				."<input type=\"hidden\" name=\"clickurl\" value=\"$clickurl\">"

				."<input type=\"hidden\" name=\"alttext\" value=\"$alttext\">"

				."<input type=\"hidden\" name=\"ad_code\" value=\"$ad_code\"></td></tr>";

		} else {

			echo "<tr><td>" . _IMAGEURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"$imageurl\"></td></tr>"

				."<tr><td>" . _IMAGESIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\" value=\"$ad_width\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\" value=\"$ad_height\"> &nbsp; "._INPIXELS."</td></tr>"

				."<tr><td>" . _CLICKURL . ":</td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"$clickurl\"></td></tr>"

				."<tr><td>" . _ALTTEXT . ":</td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\" value=\"$alttext\">"

				."<input type=\"hidden\" name=\"ad_code\" value=\"$ad_code\"></td></tr>";

		}

		echo "<tr><td>" . _TYPE . ":</td><td><select name=\"position\">";

		$result4 = $db->sql_query("SELECT position_number, position_name FROM ".$prefix."_banner_positions ORDER BY position_number");

		while ($row4 = $db->sql_fetchrow($result4)) {

			if ($position == $row4['position_number']) {

				$sel = "selected";

			} else {

				$sel = "";

			}

			echo "<option name=\"position\" value=\"".$row4['position_number']."\" $sel>".$row4['position_number']." - ".$row4['position_name']."</option>";

		}

		echo "</select></td></tr>"

			."<tr><td>" . _ACTIVATE . ":</td><td><input type=\"radio\" name=\"active\" value=\"1\" $check1>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" $check2>" . _NO . "</td></tr>"

			."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"bid\" value=\"$bid\">"

			."<input type=\"hidden\" name=\"imptotal\" value=\"$imptotal\">"

			."<input type=\"hidden\" name=\"impmade\" value=\"$impmade\">"

			."<input type=\"hidden\" name=\"op\" value=\"BannerChange\">"

			."<input type=\"submit\" value=\"" . _SAVECHANGES . "\">"

			."</form></td></tr></table>";

		CloseTable();

		include_once("footer.php");

	}















	function BannerChange($bid, $cid, $adname, $enddate, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade) {

		$imp = null;
  global $prefix, $db, $admin_file;

		if (!is_numeric($impadded)) {

			$impadded = strtoupper((string) $impadded);

			if ($impadded == "X") {

				$imp = 0;	

			}

		} else {

			if ($impadded == 0) {

				$imp = $imptotal;

			} else {

				if ($imptotal == 0) {

					$imp = $impmade+$impadded;

				} else {

					$imp = $imptotal+$impadded;

				}			

			}

		}

		$alttext = filter($alttext, "nohtml", 1);

		$adname = filter($adname, "nohtml", 1);

		$enddate = filter($enddate, "nohtml", 1);

		$cid = intval($cid);

		$imp = intval($imp);

		$active = intval($active);

		$bid = intval($bid);

		$db->sql_query("update " . $prefix . "_banner set cid='$cid', name='$adname', enddate='$enddate', imptotal='$imp', imageurl='$imageurl', clickurl='$clickurl', alttext='$alttext', position='$position', active='$active', ad_code='$ad_code', ad_width='$ad_width', ad_height='$ad_height' where bid='$bid'");

		Header("Location: ".$admin_file.".php?op=BannersAdmin");

	}

















	function BannerClientDelete($cid, $ok=0) {

		global $prefix, $db, $admin_file, $ad_admin_menu;

		$cid = intval($cid);

		if ($ok==1) {

			$db->sql_query("delete from " . $prefix . "_banner where cid='$cid'");

			$db->sql_query("delete from " . $prefix . "_banner_clients where cid='$cid'");

			Header("Location: ".$admin_file.".php?op=BannersAdmin");

		} else {

			include_once("header.php");

			

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			$row = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_banner_clients where cid='$cid'"));

			$cid = intval($row['cid']);

			$name = filter($row['name'], "nohtml");

			OpenTable();

			echo "<center><strong>" . _DELETECLIENT . ": $name</strong><br /><br />

	    		" . _SURETODELCLIENT . "<br /><br />";

			$result2 = $db->sql_query("SELECT imageurl, clickurl, alttext from " . $prefix . "_banner where cid='$cid'");

			$numrows = $db->sql_numrows($result2);

			if($numrows==0) {

				echo "" . _CLIENTWITHOUTBANNERS . "<br /><br />";

			} else {

				echo "<strong>" . _WARNING . "!!!</strong><br />

					" . _DELCLIENTHASBANNERS . ":<br /><br />";

			}

			while ($row2 = $db->sql_fetchrow($result2)) {

				$imageurl = $row2['imageurl'];

				$clickurl = $row2['clickurl'];

				$alttext = filter($row2['alttext'], "nohtml");

				echo "<a href=\"$clickurl\"><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\"></a><br />

					<a href=\"$clickurl\">$clickurl</a><br /><br />";

			}

		}

		echo "" . _SURETODELCLIENT . "<br /><br />

			[ <a href=\"".$admin_file.".php?op=BannersAdmin#top\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=BannerClientDelete&amp;cid=$cid&amp;ok=1\">" . _YES . "</a> ]</center><br /><br /></center>";

		CloseTable();

		include_once("footer.php");

	}

	function BannerClientEdit($cid) {

		global $prefix, $db, $admin_file, $ad_admin_menu;

		include_once("header.php");

		

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		$cid = intval($cid);

		$row = $db->sql_fetchrow($db->sql_query("SELECT name, contact, email, login, passwd, extrainfo from " . $prefix . "_banner_clients where cid='$cid'"));

		$name = filter($row['name'], "nohtml");

		$contact = filter($row['contact'], "nohtml");

		$email = filter($row['email'], "nohtml");

		$login = filter($row['login'], "nohtml");

		$passwd = filter($row['passwd'], "nohtml");

		$extrainfo = filter($row['extrainfo'], "nohtml");

		OpenTable();

		echo "<center><font class=\"option\"><strong>" . _EDITCLIENT . "</strong></font></center><br /><br />"

		."<form action=\"".$admin_file.".php?op=BannerClientChange\" method=\"post\">"

		."" . _CLIENTNAME . ": <input type=\"text\" name=\"name\" value=\"$name\" size=\"30\" maxlength=\"60\"><br /><br />"

		."" . _CONTACTNAME . ": <input type=\"text\" name=\"contact\" value=\"$contact\" size=\"30\" maxlength=\"60\"><br /><br />"

		."" . _CONTACTEMAIL . ": <input type=\"text\" name=\"email\" size=30 maxlength=\"60\" value=\"$email\"><br /><br />"

		."" . _CLIENTLOGIN . ": <input type=\"text\" name=\"login\" size=12 maxlength=\"10\" value=\"$login\"><br /><br />"

		."" . _CLIENTPASSWD . ": <input type=\"text\" name=\"passwd\" size=12 maxlength=\"10\" value=\"$passwd\"><br /><br />"

		."" . _EXTRAINFO . "<br /><textarea name=\"extrainfo\" cols=\"70\" rows=\"15\">$extrainfo</textarea><br /><br />"

		."<input type=\"hidden\" name=\"cid\" value=\"$cid\">"

		."<input type=\"hidden\" name=\"op\" value=\"BannerClientChange\">"

		."<input type=\"submit\" value=\"" . _SAVECHANGES . "\">"

		."</form>";

		CloseTable();

		include_once("footer.php");

	}



	function BannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd) {

		global $prefix, $db, $admin_file;

		$cid = intval($cid);

		$name = filter($name, "nohtml", 1);

		$contact = filter($contact, "nohtml", 1);

		$email = filter($email, "nohtml", 1);

		$login = filter($login, "nohtml", 1);

		$passwd = filter($passwd, "nohtml", 1);

		$extrainfo = filter($extrainfo, "nohtml", 1);

		$db->sql_query("update ".$prefix."_banner_clients set name='$name', contact='$contact', email='$email', login='$login', passwd='$passwd', extrainfo='$extrainfo' where cid='$cid'");

		Header("Location: ".$admin_file.".php?op=BannersAdmin#top");

	}



	function ad_positions() {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2;

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		echo "<center><font class=\"title\"><strong>"._CURRENTPOSITIONS."</strong></font></center><br /><br /><table width=\"100%\" border=\"1\"><tr>"

			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _POSITIONNAME . "<strong></td>"

			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _POSITIONNUMBER . "<strong></td>"

			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _ASSIGNEDADS . "<strong></td>"

			."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>" . _FUNCTIONS . "<strong></td>";

		$result = $db->sql_query("SELECT * FROM ".$prefix."_banner_positions ORDER BY apid");

		while ($row = $db->sql_fetchrow($result)) {

			$ban_num = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='".$row['position_number']."'"));

			$row['position_name'] = filter($row['position_name'], "nohtml");

			echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\">".$row['position_name']."</td>"

				."<td bgcolor=\"$bgcolor1\" align=\"center\">".$row['position_number']."</td>"

				."<td bgcolor=\"$bgcolor1\" align=\"center\">$ban_num</td>"

				."<td bgcolor=\"$bgcolor1\" align=\"center\">&nbsp;<a href=\"".$admin_file.".php?op=position_edit&amp;apid=".$row['apid']."\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=position_delete&amp;apid=".$row['apid']."\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>";

		}

		echo "</table><br />";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_positions"));

		if ($numrows == 0) {

			$pos_num = 0;	

		} else {

			$row = $db->sql_fetchrow($db->sql_query("SELECT position_number FROM ".$prefix."_banner_positions ORDER BY position_number DESC LIMIT 0,1"));

			$pos_num = $row['position_number']+1;

		}

		echo "<center><font class=\"title\"><strong>"._ADDNEWPOSITION."</strong></font><br /><br />"

			."<form method=\"\" action=\"".$admin_file.".php\">"

			.""._POSITIONNAME.": <input type=\"text\" name=\"ad_position_name\"> "._POSITIONNUMBER.": <strong>$pos_num</strong><input type=\"hidden\" name=\"ad_position_number\" value=\"$pos_num\"><input type=\"hidden\" name=\"position_new\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"position_save\"><br /><br /><input type=\"submit\" value=\""._ADDPOSITION."\">"

			."</form></center>";

		CloseTable();

		//echo "<br />";

		OpenTable();

		echo "<center><strong>"._NOTE."</strong><br /><br />"._POSITIONNOTE."<br />"._POSEXAMPLE."</center>";

		CloseTable();

		include_once("footer.php");

	}

	

	function position_save($apid=0, $ad_position_number, $ad_position_name, $position_new=0) {

		global $prefix, $db, $admin_file, $ad_admin_menu;

		if ($ad_position_name == "") {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			echo "<center><font class=\"title\"><strong>"._ADDNEWPOSITION."</strong></font><br /><br />"

				.""._POSINFOINCOMPLETE."<br /><br />"._GOBACK."</center>";

			CloseTable();

			include_once("footer.php");

			die();			

		}

		$ad_position_name = filter($ad_position_name, "nohtml", 1);

		$ad_position_number = intval($ad_position_number);

		if ($position_new == 1) {

			$db->sql_query("INSERT INTO ".$prefix."_banner_positions VALUES (NULL, '$ad_position_number', '$ad_position_name')");

		} else {

			$apid = intval($apid);

			$db->sql_query("UPDATE ".$prefix."_banner_positions SET position_name='$ad_position_name' WHERE apid='$apid'");

		}

		Header("Location: ".$admin_file.".php?op=ad_positions");

	}

	

	function position_edit($apid) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		$apid = intval($apid);

		if ($apid == 0 AND $apid == 0) {

			Header("Location: ".$admin_file.".php?op=ad_positions");	

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

		$row['position_name'] = filter($row['position_name'], "nohtml");

		echo "<center><font class=\"title\"><strong>"._EDITPOSITION."</strong></font><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._POSITIONNAME.": <input type=\"text\" name=\"ad_position_name\" value=\"".$row['position_name']."\"> "._POSITIONNUMBER.": <strong>".$row['position_number']."</strong><input type=\"hidden\" name=\"ad_position_number\" value=\"".$row['position_number']."\"><input type=\"hidden\" name=\"apid\" value=\"$apid\"><input type=\"hidden\" name=\"op\" value=\"position_save\"><br /><br /><input type=\"submit\" value=\""._SAVEPOSITION."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}



	function position_delete($apid, $ok=0, $active=0, $new_pos=\X) {

		$new_post = null;
  global $prefix, $db, $admin_file, $ad_admin_menu;

		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_positions"));

		if ($numrows == 1) {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			echo "<center><strong>"._DELETEPOSITION."</strong><br /><br />

		   		"._CANTDELETEPOSITION."<br /><br />"._GOBACK."";

		   	CloseTable();

		   	include_once("footer.php");

		   	die();

		}

		if ($ok == 1) {

			if ($new_pos == "x" OR $new_post == "") {

				$db->sql_query("DELETE FROM ".$prefix."_banner_positions WHERE apid='$apid'");

			} else {

				if ($active == "same") {

					$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

				$result = $db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='".$row['position_number']."'");	

					while($row2 = $db->sql_fetchrow($result)) {

						$db->sql_query("UPDATE ".$prefix."_banner SET position='$new_pos' WHERE bid='".$row2['bid']."'");

					}

					$db->sql_query("DELETE FROM ".$prefix."_banner_positions WHERE apid='$apid'");

				} elseif ($active == "active") {

					$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

				$result = $db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='".$row['position_number']."'");	

					while($row2 = $db->sql_fetchrow($result)) {

						$db->sql_query("UPDATE ".$prefix."_banner SET position='$new_pos', active='1' WHERE bid='".$row2['bid']."'");

					}

					$db->sql_query("DELETE FROM ".$prefix."_banner_positions WHERE apid='$apid'");

				} elseif ($active == "inactive") {

					$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

				$result = $db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='".$row['position_number']."'");	

					while($row2 = $db->sql_fetchrow($result)) {

						$db->sql_query("UPDATE ".$prefix."_banner SET position='$new_pos', active='0' WHERE bid='".$row2['bid']."'");

					}

					$db->sql_query("DELETE FROM ".$prefix."_banner_positions WHERE apid='$apid'");

				} elseif ($active == "delete_all") {

					$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

					$db->sql_query("DELETE FROM ".$prefix."_banner WHERE position='".$row['position_number']."'");

					$db->sql_query("DELETE FROM ".$prefix."_banner_positions WHERE apid='$apid'");

				}

			}

			Header("Location: ".$admin_file.".php?op=ad_positions");

			die();

		} else {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid='$apid'"));

			$row['position_name'] = filter($row['position_name'], "nohtml");

			echo "<br /><center><strong>"._DELETEPOSITION.": ".$row['position_name']."</strong><br /><br />

	    		"._SURETODELPOSITION."<br /><br />";

			$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE position='".$row['position_number']."'"));

			if($numrows != 0) {

				echo ""._POSITIONHASADS."<br /><br />";

				echo "<form action=\"".$admin_file.".php\" method=\"POST\">";

				echo ""._MOVEADS.": <select name=\"new_pos\">";

				$result = $db->sql_query("SELECT * FROM ".$prefix."_banner_positions WHERE apid!='$apid'");

				while($row = $db->sql_fetchrow($result)) {

					echo "<option value=\"".$row['position_number']."\">".$row['position_number'].": ".$row['position_name']."</option>";

				}

				echo "</select><br /><br />";

				echo ""._MOVEDADSSTATUS.": <select name=\"active\">";

				echo "<option value=\"same\">"._NOCHANGES."</option>";

				echo "<option value=\"active\">"._ACTIVE."</option>";

				echo "<option value=\"inactive\">"._INACTIVE."</option>";

				echo "<option value=\"delete_all\">"._DELETEALLADS." ($numrows)</option>";

				echo "</select><br /><br />";

				echo "<input type=\"hidden\" name=\"apid\" value=\"$apid\"><input type=\"hidden\" name=\"ok\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"position_delete\"><input type=\"submit\" value=\""._DELETE."\">";

				echo "</form>";

			} else {

				echo "[ <a href=\"".$admin_file.".php?op=ad_positions\">"._NO."</a> | <a href=\"".$admin_file.".php?op=position_delete&amp;apid=$apid&amp;ok=1\">"._YES."</a> ]</center>";

			}

		}

		CloseTable();

		include_once("footer.php");

	}



	

	

	

	

	

	function ad_terms($save=0, $terms_body=0, $country=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_terms SET terms_body='$terms_body', country='$country'");

			Header("Location: ".$admin_file.".php?op=ad_terms");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_terms"));

		$row['terms_body'] = filter($row['terms_body']);

		echo "<center><font class=\"title\"><strong>"._EDITTERMS."</strong></font><br /><br /><i>"._SITENAMEADS."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._TERMSOFSERVICEBODY.":<br /><br /><textarea name=\"terms_body\" rows=\"20\" cols=\"70\">".$row['terms_body']."</textarea><br /><br />"

			.""._COUNTRYNAME.":<br /><br /><select name=\"country\">";

		$result = $db->sql_query("SELECT DISTINCT country FROM ".$prefix."_cities");

		while ($row2 = $db->sql_fetchrow($result)) {

			if ($row['country'] == $row2['country']) {

				$sel = "selected";

			} else {

				$sel = "";	

			}

			echo "<option value=\"".$row2['country']."\" $sel>".$row2['country']."</option>";

		}

		echo "</select><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"ad_terms\"><br /><br /><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._TERMSNOTE."</i></td></tr></table>";

		CloseTable();

		include_once("footer.php");

	}

	

	

	

	

	

	

// Altered by hammer on 06.09.20 - www.pcnuke.com //

	

	function ad_plans() {

		$type = null;
  global $prefix, $db, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2;

		define('NO_EDITOR', true);

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner_plans"));

		if ($numrows != 0) {

			OpenTable();

			$result = $db->sql_query("SELECT * FROM ".$prefix."_banner_plans");

			echo "<center><font class=\"title\"><strong>"._ADVERTISINGPLANS."</strong></font></center><br />";

			echo "<table border=\"1\" width=\"100%\"><tr><td bgcolor=\"$bgcolor2\"><strong>&nbsp;"._PLANNAME."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._DELIVERY."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._STATUS."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._PRICE."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._FUNCTIONS."</strong></td></tr>";

			while ($row = $db->sql_fetchrow($result)) {

				if ($row['delivery_type'] == 0) {

					$type = _IMPRESSIONS;

				} elseif ($row['delivery_type'] == 1) {

					$type = _CLICKS;

				} elseif ($row['delivery_type'] == 2) {

					$type = _DAYS;

				} elseif ($row['delivery_type'] == 3) {

					$type = _MONTHS;

				} elseif ($row['delivery_type'] == 4) {

					$type = _YEARS;

				}

				$active = intval($row['active']);

				if ($active == 1) {

					$t_active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

					$c_active = "<img src=\"images/inactive.gif\" alt=\""._DEACTIVATE."\" title=\""._DEACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

				} else {

					$t_active = "<img src=\"images/inactive.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\">";

					$c_active = "<img src=\"images/active.gif\" alt=\""._ACTIVATE."\" title=\""._ACTIVATE."\" border=\"0\" width=\"16\" height=\"16\">";

				}

				echo "<tr><td bgcolor=\"$bgcolor1\">&nbsp;".$row['name']."</td>"

					."<td align=\"center\" bgcolor=\"$bgcolor1\">".$row['delivery']." $type</td>"

					."<td align=\"center\" bgcolor=\"$bgcolor1\">$t_active</td>"

					."<td align=\"center\" bgcolor=\"$bgcolor1\">".$row['price']."</td>"

					."<td align=\"center\" bgcolor=\"$bgcolor1\">&nbsp;<a href=\"".$admin_file.".php?op=ad_plans_edit&amp;pid=".$row['pid']."\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>  <a href=\"".$admin_file.".php?op=ad_plans_status&amp;pid=".$row['pid']."&status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=ad_plans_delete&amp;pid=".$row['pid']."&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>";

			}

			echo "</table>";

			CloseTable();

			//echo "<br />";

		}

		OpenTable();

		echo "<center><font class=\"title\"><strong>"._ADDADVERTISINGPLAN."</strong></font></center><br /><br />";

		echo "<table border=\"0\"><tr><td>";

		echo "<form method=\"POST\" action=\"".$admin_file.".php\">";

		echo ""._PLANNAME.":</td><td><input type=\"text\" size=\"40\" name=\"name\"></td></tr>";

		echo "<tr><td>"._PLANDESCRIPTION.":</td><td><textarea name=\"description\" rows=\"10\" cols=\"70\"></textarea></td></tr>";

		echo "<tr><td>"._DELIVERYQUANTITY.":</td><td><input type=\"text\" size=\"10\" name=\"delivery\"></td></tr>";

		echo "<tr><td>"._DELIVERYTYPE.":</td><td><select name=\"type\">"

			."<option value=\"0\">"._IMPRESSIONS."</option>"

			."<option value=\"1\">"._CLICKS."</option>"

			."<option value=\"2\">"._PDAYS."</option>"

			."<option value=\"3\">"._PMONTHS."</option>"

			."<option value=\"4\">"._PYEARS."</option>"

			."</select></td></tr>";

		echo "<tr><td>"._PRICE.":</td><td><input type=\"text\" size=\"10\" name=\"price\"></td></tr>";

		echo "<tr><td>"._PLANBUYLINKS.":</td><td><textarea name=\"buy_links\" rows=\"10\" cols=\"70\"></textarea></td></tr>";

		echo "<tr><td>"._PLANBUYLINKS2.":</td><td><textarea name=\"buy_links2\" rows=\"10\" cols=\"70\"></textarea></td></tr>";

		echo "<tr><td>"._INITIALSTATUS.":</td><td><input type=\"radio\" name=\"status\" value=\"1\" checked> "._ACTIVE." &nbsp;&nbsp; <input type=\"radio\" name=\"status\" value=\"0\"> "._INACTIVE."</td></tr>";

		echo "<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"ad_plans_add\"><input type=\"submit\" value=\""._ADDNEWPLAN."\"></td></tr></table></form><br /><center><i>"._PLANSNOTE."</i></center>";

		CloseTable();

		include_once("footer.php");

	}



	function ad_plans_add($name, $description, $delivery, $type, $price, $buy_links, $buy_links2, $status) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($buy_links2) AND !empty($status)) {

			$name = filter($name, "nohtml", 1);

			$description = filter($description, "", 1);

			$price = filter($price, "nohtml", 1);

			$buy_links = filter($buy_links, "", 1);

			$db->sql_query("INSERT INTO ".$prefix."_banner_plans VALUES (NULL, '$status', '$name', '$description', '$delivery', '$type', '$price', '$buy_links', '$buy_links2')");

			Header("Location: ".$admin_file.".php?op=ad_plans");

			die();

		} else {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			echo "<center>"._ADDPLANERROR."<br /><br />"._GOBACK."</center>";

			CloseTable();

			include_once("footer.php");

		}

	}



	function ad_plans_edit($pid) {

		$sel0 = null;
  $sel1 = null;
  $sel2 = null;
  $sel3 = null;
  $sel4 = null;
  $check0 = null;
  $check1 = null;
  global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		define('NO_EDITOR', true);

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE pid='$pid'"));

		echo "<center><font class=\"title\"><strong>"._ADVERTISINGPLANEDIT."</strong></font></center><br /><br />";

		echo "<table border=\"0\"><tr><td>";

		echo "<form method=\"POST\" action=\"".$admin_file.".php\">";

		echo ""._PLANNAME.":</td><td><input type=\"text\" size=\"40\" name=\"name\" value=\"".$row['name']."\"></td></tr>";

		echo "<tr><td>"._PLANDESCRIPTION.":</td><td><textarea name=\"description\" rows=\"10\" cols=\"70\">".$row['description']."</textarea></td></tr>";

		

		

		echo "<tr><td>"._DELIVERYQUANTITY.":</td><td><input type=\"text\" size=\"10\" name=\"delivery\" value=\"".$row['delivery']."\"></td></tr>";

		if ($row['delivery_type'] == 0) {

			$sel0 = "selected";

		}

		if ($row['delivery_type'] == 1) {

			$sel1 = "selected";

		}

		if ($row['delivery_type'] == 2) {

			$sel2 = "selected";

		}

		if ($row['delivery_type'] == 3) {

			$sel3 = "selected";

		}

		if ($row['delivery_type'] == 4) {

			$sel4 = "selected";

		}

		echo "<tr><td>"._DELIVERYTYPE.":</td><td><select name=\"type\">"

			."<option value=\"0\" $sel0>"._IMPRESSIONS."</option>"

			."<option value=\"1\" $sel1>"._CLICKS."</option>"

			."<option value=\"2\" $sel2>"._PDAYS."</option>"

			."<option value=\"3\" $sel3>"._PMONTHS."</option>"

			."<option value=\"4\" $sel4>"._PYEARS."</option>"

			."</select></td></tr>";

		echo "<tr><td>"._PRICE.":</td><td><input type=\"text\" size=\"10\" name=\"price\" value=\"".$row['price']."\"></td></tr>";

		echo "<tr><td>"._PLANBUYLINKS.":</td><td><textarea name=\"buy_links\" rows=\"10\" cols=\"70\">".$row['buy_links']."</textarea></td></tr>";

		echo "<tr><td>"._PLANBUYLINKS2.":</td><td><textarea name=\"buy_links2\" rows=\"10\" cols=\"70\">".$row['buy_links2']."</textarea></td></tr>";

		if ($row['active'] == 1) {

			$check0 = "checked";

			$check1 = "";

		} elseif ($row['active'] == 0) {

			$check0 = "";

			$check1 = "checked";

		}

		echo "<tr><td>"._STATUS.":</td><td><input type=\"radio\" name=\"status\" value=\"1\" $check0> "._ACTIVE." &nbsp;&nbsp; <input type=\"radio\" name=\"status\" value=\"0\" $check1> "._INACTIVE."</td></tr>";

		echo "<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"pid\" value=\"$pid\"><input type=\"hidden\" name=\"op\" value=\"ad_plans_save\"><input type=\"submit\" value=\""._SAVECHANGES."\"></td></tr></table></form><br /><center><i>"._PLANSNOTE."</i></center>";

		CloseTable();

		include_once("footer.php");

	}

	

	function ad_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $buy_links2, $status) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($buy_links2) AND !empty($status)) {

			$name = filter($name, "nohtml", 1);

			$description = filter($description, "", 1);

			$price = filter($price, "nohtml", 1);

			$buy_links = filter($buy_links, "", 1);

			$buy_links2 = filter($buy_links2, "", 1);

			$db->sql_query("UPDATE ".$prefix."_banner_plans SET active='$status', name='$name', description='$description', delivery='$delivery', delivery_type='$type', price='$price', buy_links='$buy_links', buy_links2='$buy_links2' WHERE pid='$pid'");

			Header("Location: ".$admin_file.".php?op=ad_plans");

			die();

		} else {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			echo "<center>"._ADDPLANERROR."<br /><br />"._GOBACK."</center>";

			CloseTable();

			include_once("footer.php");

		}

	}

	

	function ad_plans_delete($pid, $ok=0) {

		global $prefix, $db, $admin_file, $ad_admin_menu;

		if ($ok == 1) {

			$db->sql_query("DELETE FROM ".$prefix."_banner_plans WHERE pid='$pid'");

			Header("Location: ".$admin_file.".php?op=ad_plans");

			die();

		} else {

			include_once("header.php");

			title(""._MENU."");

			OpenTable();

			echo "$ad_admin_menu";

			CloseTable();

			//echo "<br />";

			OpenTable();

			$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_plans WHERE pid='$pid'"));

			echo "<center><strong>"._DELETEPLAN.": ".$row['name']."</strong><br /><br />"

	    		.""._SURETODELPLAN."<br /><br />"

				."[ <a href=\"".$admin_file.".php?op=ad_plans\">"._NO."</a> | <a href=\"".$admin_file.".php?op=ad_plans_delete&amp;pid=$pid&amp;ok=1\">"._YES."</a> ]</center>";

			CloseTable();

			include_once("footer.php");

		}

	}

	









	function ad_plans_status($pid, $status) {

		global $prefix, $db, $admin_file;

		if ($status == 1) {

			$active = 0;

		} else {

			$active = 1;

		}

		$pid = intval($pid);

		$db->sql_query("UPDATE ".$prefix."_banner_plans SET active='$active' WHERE pid='$pid'");

		Header("Location: ".$admin_file.".php?op=ad_plans");

	}



if (!isset($save)) { $save = ""; }

if (!isset($terms_body)) { $terms_body = ""; }

if (!isset($country)) { $country = ""; }

if (!isset($ok)) { $ok = ""; }

if (!isset($active)) { $active = ""; }

if (!isset($new_pos)) { $new_pos = ""; }







/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  START    ////////////////////





	

/*********************************/

/* ADVERTISING EDIT FRONTPAGE    */

/*********************************/

	function frontpage($save=0, $frontpage_body=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_frontpage SET frontpage_body='$frontpage_body'");

			Header("Location: ".$admin_file.".php?op=frontpage");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_frontpage"));

		$row['frontpage_body'] = filter($row['frontpage_body']);

		echo "<center><font class=\"title\"><strong>"._EDITFRONT."</strong></font><br /><br /><i>"._GENERAL."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._FRONTBODY.":<br /><br /><textarea name=\"frontpage_body\" rows=\"20\" cols=\"70\">".$row['frontpage_body']."</textarea><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"frontpage\"><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}

	

	

/*************************************/

/* ADVERTISING EDIT CANCEL PAGE   */

/*************************************/

	function cancel($save=0, $cancel_body=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_cancel SET cancel_body='$cancel_body'");

			Header("Location: ".$admin_file.".php?op=cancel");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_cancel"));

		$row['cancel_body'] = filter($row['cancel_body']);

		echo "<center><font class=\"title\"><strong>"._EDITCANCEL."</strong></font><br /><br /><i>"._GENERAL."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._CANCELBODY.":<br /><br /><textarea name=\"cancel_body\" rows=\"20\" cols=\"70\">".$row['cancel_body']."</textarea><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"cancel\"><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}

	

	

	

/*************************************/

/* ADVERTISING EDIT CAMPAIGNS PAGE   */

/*************************************/

	function campaigns($save=0, $campaigns_body=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_campaigns SET campaigns_body='$campaigns_body'");

			Header("Location: ".$admin_file.".php?op=campaigns");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_campaigns"));

		$row['campaigns_body'] = filter($row['campaigns_body']);

		echo "<center><font class=\"title\"><strong>"._EDITCAMPAIGNS."</strong></font><br /><br /><i>"._GENERAL."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._CAMPAIGNSBODY.":<br /><br /><textarea name=\"campaigns_body\" rows=\"20\" cols=\"70\">".$row['campaigns_body']."</textarea><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"campaigns\"><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}

	















/*********************************/

/* ADVERTISING EDIT STATS PAGE   */

/*********************************/

	function stats($save=0, $stats_body=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_stats SET stats_body='$stats_body'");

			Header("Location: ".$admin_file.".php?op=stats");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_stats"));

		$row['stats_body'] = filter($row['stats_body']);

		echo "<center><font class=\"title\"><strong>"._EDITSTATS."</strong></font><br /><br /><i>"._GENERAL."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._STATSBODY.":<br /><br /><textarea name=\"stats_body\" rows=\"20\" cols=\"70\">".$row['stats_body']."</textarea><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"stats\"><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}









/*************************************/

/* ADVERTISING EDIT THANKS PAGE      */

/*************************************/

	function thanks($save=0, $thanks_body=0) {

		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

		if ($save != 0) {

			$db->sql_query("UPDATE ".$prefix."_banner_thanks SET thanks_body='$thanks_body'");

			Header("Location: ".$admin_file.".php?op=thanks");

			die();

		}

		include_once("header.php");

		title(""._MENU."");

		OpenTable();

		echo "$ad_admin_menu";

		CloseTable();

		//echo "<br />";

		OpenTable();

		$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_banner_thanks"));

		$row['thanks_body'] = filter($row['thanks_body']);

		echo "<center><font class=\"title\"><strong>"._EDITTHANKS."</strong></font><br /><br /><i>"._GENERAL."</i><br /><br />"

			."<form method=\"POST\" action=\"".$admin_file.".php\">"

			.""._THANKSBODY.":<br /><br /><textarea name=\"thanks_body\" rows=\"20\" cols=\"70\">".$row['thanks_body']."</textarea><br /><br />"

			."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"thanks\"><input type=\"submit\" value=\""._SAVECHANGES."\">"

			."</form></center>";

		CloseTable();

		include_once("footer.php");

	}

	

/*************************************/

/*  Check Images PAGE                */

/*************************************/

function CheckImages() {

global $prefix, $db, $banners, $admin_file, $ad_admin_menu;

include_once("header.php");

title(""._MENU."");

OpenTable();

echo "$ad_admin_menu";

CloseTable();

OpenTable();

include_once("upload.php");

//echo "<center><strong>"._ADSPATH."</strong>  $nukeurl/files/image.xxx <br /></center>";

echo "<center><strong>"._ADSPATH."</strong>  /modules/Advertising/ad_files/banners/image.xxx <br /></center>";

echo "<center><br /><strong>"._ADSPATH2."</strong><br /></center>";

CloseTable();

include_once("footer.php");

	}

	

	



	

/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  END    ////////////////////







	switch($op) {



		case "BannersAdmin":

		BannersAdmin();

		break;



		case "BannersAdd":

		BannersAdd($name, $cid, $adname, $enddate, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height);

		break;



		case "BannerAddClient":

		BannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo);

		break;



		case "BannerDelete":

		BannerDelete($bid, $ok);

		break;



		case "BannerEdit":

		BannerEdit($bid);

		break;



		case "BannerChange":

		BannerChange($bid, $cid, $adname, $enddate, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade);

		break;



		case "BannerClientDelete":

		BannerClientDelete($cid, $ok);

		break;



		case "BannerClientEdit":

		BannerClientEdit($cid);

		break;



		case "BannerClientChange":

		BannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd);

		break;



		case "BannerStatus":

		BannerStatus($bid, $status);

		break;



		case "add_banner":

		add_banner();

		break;

		

		case "add_client":

		add_client();

		break;



		case "ad_positions":

		ad_positions();

		break;

		

		case "position_save":

		position_save($apid, $ad_position_number, $ad_position_name, $position_new);

		break;



		case "position_edit":

		position_edit($apid);

		break;



		case "position_delete":

		position_delete($apid, $ok, $active, $new_pos);

		break;



		case "ad_terms":

		ad_terms($save, $terms_body, $country);

		break;

		

		case "ad_plans":

		ad_plans();

		break;



		case "ad_plans_add":

		ad_plans_add($name, $description, $delivery, $type, $price, $buy_links, $buy_links2, $status);

		break;



		case "ad_plans_edit":

		ad_plans_edit($pid);

		break;



		case "ad_plans_save":

		ad_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $buy_links2, $status);

		break;

		

		case "ad_plans_delete":

		ad_plans_delete($pid, $ok);

		break;

		

		case "ad_plans_status":

		ad_plans_status($pid, $status);

		break;



 /////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  START    ////////////////////

		case "frontpage":

		frontpage($save, $frontpage_body);

		break;

		

		case "cancel":

		cancel($save, $cancel_body);

		break;		

		

		case "campaigns":

		campaigns($save, $campaigns_body);

		break;		

		

		case "stats":

		stats($save, $stats_body);

		break;

		

		case "thanks":

		thanks($save, $thanks_body);

		break;		



		case "CheckImages":

		CheckImages();

		break;	

		

	/////////////////  PCN ADVERTISING UPGRADE EXTRAS  --  END    ////////////////////



	}



} else {

	echo "Access Denied";

}



?>

