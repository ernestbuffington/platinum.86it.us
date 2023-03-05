<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

include_once("admin/modules/NukeStyles/EDL/ns_edl_functions.php");
include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

function ns_edl_rating() {
global $prefix, $db, $admin_file;
ns_edl_top("rate");
$result = $db->sql_query("SELECT ns_dl_outside_vote, ns_dl_anon_wait_days, ns_dl_outside_wait_days, ns_dl_anon_weight, ns_dl_outside_weight, ns_dl_main_dec, ns_dl_detail_dec from ".$prefix."_ns_downloads_rating");
list($ns_dl_outside_vote, $ns_dl_anon_wait_days, $ns_dl_outside_wait_days, $ns_dl_anon_weight, $ns_dl_outside_weight, $ns_dl_main_dec, $ns_dl_detail_dec) = $db->sql_fetchrow($result);
    ns_dl_OpenTable();
    OpenTable2();
    echo "<center><font class=\"title\">"._NSDLRATESETTINGS."</font></center>";
    CloseTable2();
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<form action=".$admin_file.".php method='post'>";
    echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLOUTVOTE.":</td>";
    echo "<td align=\"left\" width=\"25%\">";
	if ($ns_dl_outside_vote == 1) {
    echo "<input type='radio' name='ns_dl_outside_vote' value='1' checked>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_outside_vote' value='0'>"._NSNO."";
	} else {
    echo "<input type='radio' name='ns_dl_outside_vote' value='1'>"._NSYES." &nbsp;";
    echo "<input type='radio' name='ns_dl_outside_vote' value='0' checked>"._NSNO."";
	}
    echo "</td></tr>";
        if ($ns_dl_anon_wait_days == "1") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "2") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "3") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "4") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "5") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "6") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "selected";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "7") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "selected";
	$sel8 = "";
    } elseif ($ns_dl_anon_wait_days == "14") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "selected";
    }
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEANWAIT.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_anon_wait_days\">";
    echo "<option value=\"1\" $sel1>1 "._NSDLVDAYS."</option>";
    echo "<option value=\"2\" $sel2>2 "._NSDLVDAYS1."</option>";
    echo "<option value=\"3\" $sel3>3 "._NSDLVDAYS1."</option>";
    echo "<option value=\"4\" $sel4>4 "._NSDLVDAYS1."</option>";
    echo "<option value=\"5\" $sel5>5 "._NSDLVDAYS1."</option>";
    echo "<option value=\"6\" $sel6>6 "._NSDLVDAYS1."</option>";
    echo "<option value=\"\">-----------</option>";
    echo "<option value=\"7\" $sel7>1 "._NSDLVDAYS4."</option>";
    echo "<option value=\"14\" $sel8>2 "._NSDLVDAYS5."</option>";
    echo "</select>";
    echo "</td></tr>";
           if ($ns_dl_outside_wait_days == "1") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "2") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "3") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "4") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "5") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "6") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "selected";
	$sel7 = "";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "7") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "selected";
	$sel8 = "";
    } elseif ($ns_dl_outside_wait_days == "14") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
	$sel6 = "";
	$sel7 = "";
	$sel8 = "selected";
    } 
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEOUTWAIT.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_outside_wait_days\">";
    echo "<option value=\"1\" $sel1>1 "._NSDLVDAYS."</option>";
    echo "<option value=\"2\" $sel2>2 "._NSDLVDAYS1."</option>";
    echo "<option value=\"3\" $sel3>3 "._NSDLVDAYS1."</option>";
    echo "<option value=\"4\" $sel4>4 "._NSDLVDAYS1."</option>";
    echo "<option value=\"5\" $sel5>5 "._NSDLVDAYS1."</option>";
    echo "<option value=\"6\" $sel6>6 "._NSDLVDAYS1."</option>";
    echo "<option value=\"\">-----------</option>";
    echo "<option value=\"7\" $sel7>1 "._NSDLVDAYS4."</option>";
    echo "<option value=\"14\" $sel8>2 "._NSDLVDAYS5."</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEANWEIGHT.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_anon_weight\">";
    echo "<option value=\"$ns_dl_anon_weight\">$ns_dl_anon_weight</option>"; 
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "<option value=\"5\">5</option>";
    echo "<option value=\"6\">6</option>";
    echo "<option value=\"7\">7</option>";
    echo "<option value=\"8\">8</option>";
    echo "<option value=\"9\">9</option>";
    echo "<option value=\"10\">10</option>";
    echo "<option value=\"11\">11</option>";
    echo "<option value=\"12\">12</option>";
    echo "<option value=\"13\">13</option>";
    echo "<option value=\"14\">14</option>";
    echo "<option value=\"15\">15</option>";
    echo "<option value=\"16\">16</option>";
    echo "<option value=\"17\">17</option>";
    echo "<option value=\"18\">18</option>";
    echo "<option value=\"19\">19</option>";
    echo "<option value=\"20\">20</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEOUTWEIGHT.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_outside_weight\">";
    echo "<option value=\"$ns_dl_outside_weight\">$ns_dl_outside_weight</option>"; 
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "<option value=\"5\">5</option>";
    echo "<option value=\"6\">6</option>";
    echo "<option value=\"7\">7</option>";
    echo "<option value=\"8\">8</option>";
    echo "<option value=\"9\">9</option>";
    echo "<option value=\"10\">10</option>";
    echo "<option value=\"11\">11</option>";
    echo "<option value=\"12\">12</option>";
    echo "<option value=\"13\">13</option>";
    echo "<option value=\"14\">14</option>";
    echo "<option value=\"15\">15</option>";
    echo "<option value=\"16\">16</option>";
    echo "<option value=\"17\">17</option>";
    echo "<option value=\"18\">18</option>";
    echo "<option value=\"19\">19</option>";
    echo "<option value=\"20\">20</option>";
    echo "<option value=\"21\">21</option>";
    echo "<option value=\"22\">22</option>";
    echo "<option value=\"23\">23</option>";
    echo "<option value=\"24\">24</option>";
    echo "<option value=\"25\">25</option>";
    echo "<option value=\"26\">26</option>";
    echo "<option value=\"27\">27</option>";
    echo "<option value=\"28\">28</option>";
    echo "<option value=\"29\">29</option>";
    echo "<option value=\"30\">30</option>";
    echo "<option value=\"31\">31</option>";
    echo "<option value=\"32\">32</option>";
    echo "<option value=\"33\">33</option>";
    echo "<option value=\"34\">34</option>";
    echo "<option value=\"35\">35</option>";
    echo "<option value=\"36\">36</option>";
    echo "<option value=\"37\">37</option>";
    echo "<option value=\"38\">38</option>";
    echo "<option value=\"39\">39</option>";
    echo "<option value=\"40\">40</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEMAINDEC.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_main_dec\">";
    echo "<option value=\"$ns_dl_main_dec\">$ns_dl_main_dec</option>"; 
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "<tr><td align=\"right\" width=\"75%\">"._NSDLVOTEADDDEC.":</td>";
    echo "<td align=\"left\" width=\"25%\"><select name=\"ns_dl_detail_dec\">";
    echo "<option value=\"$ns_dl_detail_dec\">$ns_dl_detail_dec</option>"; 
    echo "<option value=\"1\">1</option>";
    echo "<option value=\"2\">2</option>";
    echo "<option value=\"3\">3</option>";
    echo "<option value=\"4\">4</option>";
    echo "<option value=\"5\">5</option>";
    echo "<option value=\"6\">6</option>";
    echo "</select>";
    echo "</td></tr>";
    echo "</table><br />";
    ns_dl_CloseTable();
    ns_dl_OpenTable();
    echo "<br /><input type='hidden' name='op' value='ns_edl_ratesave'>";
    echo "<center><input type='submit' name=\"submit\" value='Save Changes'></center>";
    echo "<br />";
    ns_dl_CloseTable();
    echo "</form>";
    ns_edl_bottom(); 
}

function ns_edl_ratesave($ns_dl_outside_vote, $ns_dl_anon_wait_days, $ns_dl_outside_wait_days, $ns_dl_anon_weight, $ns_dl_outside_weight, $ns_dl_main_dec, $ns_dl_detail_dec) {
global $prefix, $db, $admin_file;
$db->sql_query("UPDATE ".$prefix."_ns_downloads_rating set ns_dl_outside_vote='$ns_dl_outside_vote', ns_dl_anon_wait_days='$ns_dl_anon_wait_days', ns_dl_outside_wait_days='$ns_dl_outside_wait_days', ns_dl_anon_weight='$ns_dl_anon_weight', ns_dl_outside_weight='$ns_dl_outside_weight', ns_dl_main_dec='$ns_dl_main_dec', ns_dl_detail_dec='$ns_dl_detail_dec'");
Header("Location: ".$admin_file.".php?op=ns_edl_rating#rate");
}

switch($op) {

    case "ns_edl_rating":
    ns_edl_rating();
    break;

    case "ns_edl_ratesave":
    ns_edl_ratesave($ns_dl_outside_vote, $ns_dl_anon_wait_days, $ns_dl_outside_wait_days, $ns_dl_anon_weight, $ns_dl_outside_weight, $ns_dl_main_dec, $ns_dl_detail_dec);
    break;

}

} else {
echo "Access Denied";
}

?>