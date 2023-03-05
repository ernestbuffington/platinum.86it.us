<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2017 coRpSE			                                */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


// START CONFIG
	$per_page = 	     "25";  		 // number of members per page.
	$page_numberpos =    "both";	  	// page number position top, bottom or both.
	$head_color =  	     "#ffffff";	  	// head colour.
	$row_color1 =  	     "#ffffff";	  	// row colour 1.
	$row_color2 =        "#ffffff";	  	// row colour 2.	
	$page_bgcolor =      "#f0f0f0";	  	// page number background colour.
	$page_bordercolor =  "#000000";	  	// page number border colour.
// END CONFIG	

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

    if (isset($_GET['del']) && $_GET['del'] == 'all') {
        $db->sql_query('DELETE FROM `'.$prefix.'_honeypot`');
		$db->sql_query('ALTER TABLE `'.$prefix.'_honeypot` AUTO_INCREMENT = 1');
        $db->sql_query('OPTIMIZE TABLE `'.$prefix.'_honeypot`');
		Header("Location: ".$admin_file.".php?op=honeypot");
        } else {
	global $prefix, $db, $bgcolor2, $admin_file;
	include_once('header.php');
	echo "<div class=\"honeycontainer\">"."\n";	
	OpenTable();
	   echo "<div align=\"center\"><h1>Nuke HoneyPot - Antispam<br></p><p><img src=\"./images/admin/Nuke_Honeypot.png\"></h1></div>\n";
	   echo "<div align=\"center\">[ <a href=\"$admin_file.php\">Return to Main Administration</a> ]</div>\n";
	CloseTable();
	
	OpenTable();
echo "<div class=\"pagination\" style=\"text-align:right;\">\n<a href=\"./".$admin_file.".php?op=honeypot&amp;del=all\">Delete All</a></div>\n";
echo "<br /><br />";

	// Number of results per page
	// $per_page = 15; moved to the top config section
	if(isset($_GET['page'])) {
	if (!file_exists("includes/functions_honeypot.php")) {
	$currentPage = $_GET['page'];
	}else{
	$currentPage = $db->sql_escape_string($_GET['page']);
	}
	}else{
	$currentPage = 1;
	}	
	
	// total results
	$sql = "SELECT * FROM ".$prefix."_honeypot";
	$resultcount = $db->sql_query($sql);
	$num = $db->sql_numrows($resultcount);
		
	// round up total pages from total results
	$total_pages = ceil($num/$per_page);
	
	//limit
	$limitQ = 'LIMIT ' .($currentPage - 1) * $per_page .',' .$per_page;
	$page_url = "".$admin_file.".php?op=honeypot"; 
	
	if (($page_numberpos=='top') OR ($page_numberpos=='both') ) { 
	
		if($total_pages >=2){	
		$adjacents = 3;
		$page = intval($_GET["page"]);
		if($page<=0) $page = 1;
		$reload = $page_url;
		// call pagination function:
		echo "<p>\n";
		echo paginate($reload, $page, $total_pages, $adjacents).'</p>';
		} 
	}
    echo '<script type="text/javascript" language="JavaScript">
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
d.style.left = (cX+10) + "px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
</script>';
	echo '
	<style>
	.honeycontainer {
	cursor: url(./images/cursor.cur) 0 0, auto;
	}
	
	div.pagination a {
	-moz-border-radius: 4px;
	border-radius: 4px;
	text-decoration:none;
	border:1px solid '.$page_bordercolor .';
	font-weight:700;
	padding:2px 5px;
	color: #000;
	background-color: '.$page_bgcolor .';
	}
	
	div.pagination a:hover {
	color: #000;
	}	
	
	div.pagination span {
	-moz-border-radius: 4px;
	border-radius: 4px;
	text-decoration:none;
	border:1px solid '.$page_bordercolor .';
	font-weight:700;
	padding:2px 5px;
	color: #000;
	background-color: '.$page_bgcolor .';
	}
	
	div.pagination a:hover,div.pagination a:active,div.pagination span.current {
	-moz-border-radius: 4px;
	border-radius: 4px;	
	text-decoration:none;
	border:1px solid '.$page_bordercolor .';
	font-weight:700;
	background-color: '.$row_color1 .';
	padding:2px 5px;
	}
	
	.pothead {
	-moz-border-radius: 4px;
	border-radius: 4px;
	font-family: "Aladin", cursive;
	font-size: 22px;
	color: #000;
	text-shadow: 0 0 5px #F5C623;
	font-weight:700;
	border:1px solid '.$page_bgcolor .';
	}

	.potlogo p{
	font-family: "Aladin", cursive;
	font-size: 40px;
	text-shadow: 0 0 15px '.$page_bgcolor .';
	color: #000;
	font-weight:700;
	text-align:center;
	}
		
	.pot {
	-moz-border-radius: 4px;
	border-radius: 4px;
	border:1px solid '.$page_bordercolor .';
	color: #000;
	}	
	.minipot {
	color: #000;
	font-weight:700;
	border:0px solid;
	}
	.minipot-text {
	color: #000;
	border:0px solid;
	}
	</style>'."\n";
	
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\">";
echo "<tr>
	<td width=\"45px\" align=\"center\">ID#</td>
	<td width=\"25%\" align=\"center\">IP Address</td>
	<td width=\"25%\" align=\"center\">Date & Time</td>
	<td width=\"25%\" align=\"center\">Caught By</td>
	<td width=\"25%\" align=\"center\">Reason</td>
	</tr>";
	
	$result = $db->sql_query("SELECT id, username, realname, email, ip, date, potnum, reason FROM ".$prefix."_honeypot ORDER BY id ASC $limitQ");
	while ($row = $db->sql_fetchrow($result)) {

	$row_color = ( $row_color1 != $row_color ) ? $row_color1 : $row_color2;
	
	if ($row['potnum'] == 0){
	$script = "Wait Script";
	}elseif ($row['potnum'] == 1){
	$script = "Text Removal Script";
	}elseif ($row['potnum'] == 2){
	$script = "Hidden Text Field";
	}
	echo "<tr>";
	echo"<td bgcolor=\"$row_color\" class=\"pot\" width=\"45px\" align=\"center\"><a onmouseover=\"ShowContent('addinfo".$row['id']."'); return true;\"
	     onmouseout=\"HideContent('addinfo".$row['id']."'); return true;\" href=\"javascript:ShowContent('addinfo".$row['id'].")\"><div class=\"minipot\">" . $row['id'] . "</div></a>";
	echo"</td><div id=\"addinfo".$row['id']."\" 
   style=\"display:none; 
      position:absolute; 
      border-style: solid;
	  -moz-border-radius: 15px;
	  border-radius: 15px;
	  border-color:#000000;
      background-color: #f8ce55;
	  color: #000; 
      padding: 5px;
	  width:400px;
	  text-align:left;
	  font-size:11px;\">"; 
	echo"<div class=\"pothead\" align=\"center\">Additional Information</div><hr>
<p class=\"minipot-text\"><b class=\"minipot\">Username (used)</b> &nbsp;&nbsp;-&nbsp;&nbsp; ".$row['username']."<br></p>
<p class=\"minipot-text\"><b class=\"minipot\">Realname (used)</b> &nbsp;&nbsp;-&nbsp;&nbsp; ".$row['realname']."<br></p>
<p class=\"minipot-text\"><b class=\"minipot\">Email (used)</b> &nbsp;&nbsp;-&nbsp;&nbsp; ".$row['email']."</p></div>"; 
	 
	echo"<td width=\"25%\" align=\"center\">" . $row['ip'] . "</td>"; 
	echo"<td width=\"25%\" align=\"center\">" . $row['date'] . "</td>";
	echo"<td class=\"pot\" width=\"25%\" align=\"center\">$script</td>";
	echo"<td class=\"pot\" width=\"25%\">&nbsp;" . $row['reason'] . "</td>"; 
	echo"</tr>";
}
echo"</table>";

	if (($page_numberpos=='bottom') OR ($page_numberpos=='both') ) { 
	
		if($total_pages >=2){	
		$adjacents = 3;
		$page = intval($_GET["page"]);
		if($page<=0) $page = 1;
		$reload = $page_url;
		// call pagination function:
		echo "<p>\n";
		echo paginate($reload, $page, $total_pages, $adjacents).'</p>';	
		} 
	}
	
	CloseTable();
	
//	OpenTable();
	echo "<p class='tiny' style='text-align:center;'>Mod Created by coRpSE <a href='http://www.headshotdomain.net' title='HeadShotDOmain' target='_blank'>www.headshotdomain.net</a><br>\n";
	echo "Configured for PlatinumNukePro by sgtmudd <a href='http://www.platinumnukepro.com' title='Platinum Nuke Pro' target='_blank'>www.platinumnukepro.com</a></p>\n";
//	CloseTable();
	echo "</div>"."\n";
    include("footer.php");
}


} else {
    echo 'Access Denied2';
}

function paginate($reload, $page, $tpages, $adjacents) {
	
	$prevlabel = "Prev";
	$nextlabel = "Next";
	
	$out = "<div class=\"pagination\" align=\"center\">\n";
	
	// previous
	if($page==1) {
		//$out.= "<span>" . $prevlabel . "</span>\n";
	}
	elseif($page==2) {
		$out.= "<a href=\"" . $reload . "\">" . $prevlabel . "</a>\n";
	}
	else {
		$out.= "<a href=\"" . $reload . "&page=" . ($page-1) . "\">" . $prevlabel . "</a>\n";
	}
	
	// first
	if($page>($adjacents+1)) {
		$out.= "<a href=\"" . $reload . "\">1</a>\n";
	}
	
	// interval
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}
	
	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class=\"current\">" . $i . "</span>\n";
		}
		elseif($i==1) {
			$out.= "<a href=\"" . $reload . "\">" . $i . "</a>\n";
		}
		else {
			$out.= "<a href=\"" . $reload . "&page=" . $i . "\">" . $i . "</a>\n";
		}
	}
	
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}
	
	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<a href=\"" . $reload . "&page=" . $tpages . "\">" . $tpages . "</a>\n";
	}
	
	// next
	if($page<$tpages) {
		$out.= "<a href=\"" . $reload . "&page=" . ($page+1) . "\">" . $nextlabel . "</a>\n";
	}
	else {
		//$out.= "<span>" . $nextlabel . "</span>\n";
	}
	
	$out.= "</div>";
	
	return $out;
}

?>