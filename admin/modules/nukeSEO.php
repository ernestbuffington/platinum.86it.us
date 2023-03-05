<?php
#########################################################################
# nukeSEO Copyright (c) 2005 Kevin Guske              http://nukeSEO.com
# Meta Tag function developed by Jens Hauge           http://visayas.dk
# Sitemap object approach from mSearch by David Karn  http://webdever.net
# Submit Sitemap from phpSitemapNG by Tobias Kluge    http://enarion.net
# Results originally developed by Curve2 Design       http://curve2.com
#########################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
#########################################################################

if(!defined('ADMIN_FILE')) { header("Location: ../../index.php");  die(); }

echo <<<CREDITS
<script type="text/javascript">
function viewCredits(){
  window.open ("modules/Sitemap/copyright.php","nukeSEO","toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,copyhistory=no,width=440,height=330");
}
</SCRIPT>
CREDITS;

global $admin_file, $adveditor, $currentlang;
$adveditor = 0;
if(!isset($admin_file)) { $admin_file = "admin"; }

if (file_exists("admin/language/nukeSEO/lang-$currentlang.php")) {
	include_once("admin/language/nukeSEO/lang-$currentlang.php");
} else {
	include_once("admin/language/nukeSEO/lang-english.php");
}
require_once("admin/modules/nukeSEO/nukeSEOfunctions.php");
check_install();

function nukeSEOmenu() {
	global $admin_file, $nukeurl;
	echo "<div align=\"center\">\n<table border=\"0\" cellspacing=\"2\" cellpadding=\"3\">\n<tr>";
	echo "<td colspan='6' align='center'><a href='".$admin_file.".php?op=nukeSEO' title=\""._SEO_NUKESEO."\">["._SEO_NUKESEO." Administration]</a>
    <br />
    <a href='".$admin_file.".php' title=\""._ADMINMENU."\">["._ADMINMENU."]</a></td>\n</tr>\n<tr>";
	echo "<td valign=\"top\">";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<strong>"._SEO_ROBOTS."</strong><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOrobots\" title=\""._SEO_VIEW."\">"._SEO_VIEW."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://tool.motoricerca.info/robots-checker.phtml?checkreferer=1\" target=\"nukeSEOrobotsvalidate\" title=\""._SEO_VALIDATE."\">"._SEO_VALIDATE."</a><br>";
	echo "</td>\n";
//	echo "<td valign=\"top\">";
//	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;"._SEO_META."<br>";
//	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOmeta\" title=\""._SEO_METAEDIT."\">"._SEO_METAEDIT."</a><br>";
//	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://www.submitexpress.com/cgi-bin/analyzer/meta.pl?url=$nukeurl\" target=\"nukeSEOMETAanalyze\" title=\""._SEO_ANALYZE."\">"._SEO_ANALYZE."</a><br>";
//	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://www.gorank.com/analyze.php?url=$nukeurl&amp;keyword=Submit=Analyze+Page\" target=\"nukeSEOMETAanalyze\" title=\""._SEO_DENSITY."\">"._SEO_DENSITY."</a><br>";
//	echo "</td>\n";
	echo "<td valign=\"top\">";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<strong>"._SEO_GOOGLEMAP."</strong><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOgoogleSMConfig\" title=\""._SEO_GOOGLEMAPCONFIG."\">"._SEO_GOOGLEMAPCONFIG."</a><br>";
#	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOgoogleSMGenerate\" title=\""._SEO_GOOGLEMAPGENERATE."\">"._SEO_GOOGLEMAPGENERATE."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://www.google.com/webmasters/sitemaps\" target=\"nukeSEOgooglemap\" title=\""._SEO_GOOGLEMAPSTATUS."\">"._SEO_GOOGLEMAPSTATUS."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOgoogleSMSubmit\" title=\""._SEO_GOOGLEMAPSUBMIT_TITLE."\">"._SEO_GOOGLEMAPSUBMIT."</a><br>";
	echo "</td>\n";
	echo "<td valign=\"top\">";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<strong>"._SEO_SUBMIT."</strong><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://www.submitexpress.com/submit.html?$nukeurl\" target=\"nukeSEOsubmit\" title=\""._SEO_SUBMIT_TITLE."\">"._SEO_SUBMIT_GOOGLE."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"https://login.yahoo.com/config/login?.src=srch&amp;.done=http://submit.search.yahoo.com/free/request\" target=\"nukeSEOsubmitYahoo\" title=\""._SEO_SUBMIT_YAHOO_TITLE."\">"._SEO_SUBMIT_YAHOO."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"http://search.msn.com/docs/submit.aspx\" target=\"nukeSEOsubmitMSN\" title=\""._SEO_SUBMIT_MSN_TITLE."\">"._SEO_SUBMIT_MSN."</a><br>";
	echo "</td>\n";
	echo "<td valign=\"top\">";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<strong>"._SEO_RESULTS."</strong><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOsaturation\" title=\""._SEO_SATURATION."\">"._SEO_SATURATION."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOlinkpop\" title=\""._SEO_LINKPOP."\">"._SEO_LINKPOP."</a><br>";
	echo "<img src=\"images/nukeSEO/info.gif\" alt=\"?\" title=\"?\">&nbsp;&nbsp;<a href=\"".$admin_file.".php?op=nukeSEOkeyrank\" title=\""._SEO_KEYRANK."\">"._SEO_KEYRANK."</a><br>";
	echo "</td>\n";
	echo "</tr>\n";
	echo "<tr><td>&nbsp;</td><td><a href=\"javascript:viewCredits()\" title=\"View credits\">Credits</a></td><td>&nbsp;</td><td><a href=\"http://nukeseo.com\" title=\"Documentation, support\">nukeSEO&trade;</a></td><td>&nbsp;</td></tr>";
	echo "</table>\n</div>\n";
}

$textrowcol = "rows='10' cols='50'";
if($Version_Num > "7.6") { $textrowcol = "rows='15' cols='75'"; }
$getAdmin = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_authors` WHERE `aid`='$aid'"));
if ($getAdmin['radminsuper'] == 1) {
  switch($op) {
    case "nukeSEO":					include_once("admin/modules/nukeSEO/nukeSEO.php");			break;
    case "nukeSEOconfig":			include_once("admin/modules/nukeSEO/nukeSEOconfig.php");		break;
    case "nukeSEOrobots":			include_once("admin/modules/nukeSEO/nukeSEOrobots.php");		break;
    case "nukeSEOmeta":				include_once("admin/modules/nukeSEO/nukeSEOmeta.php");		break;
    case "nukeSEOmetaSave":			include_once("admin/modules/nukeSEO/nukeSEOmetaSave.php");	break;
    case "nukeSEOMETAhelp":			include_once("admin/modules/nukeSEO/nukeSEOMETAhelp.php");	break;
    case "nukeSEOgoogleSMConfig":	include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;
	case "nukeSEODelMod":			include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;
	case "nukeSEODisableMod":		include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;
#	case "nukeSEOgoogleSMGenerate":	include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;
#	case "nukeSEOgoogleSMwriteUI":	include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;  
    case "nukeSEOgoogleSMSubmit":	include_once("admin/modules/nukeSEO/nukeSEOgooglemap.php");	break;
    case "nukeSEOsubmit":			include_once("admin/modules/nukeSEO/nukeSEOsubmit.php");		break;
    case "nukeSEOsaturation":		include_once("admin/modules/nukeSEO/nukeSEOsaturation.php");	break;
    case "nukeSEOlinkpop":			include_once("admin/modules/nukeSEO/nukeSEOlinkpop.php");	break;
    case "nukeSEOkeyrank":			include_once("admin/modules/nukeSEO/nukeSEOkeyrank.php");	break;
  }
} else {
    echo "Access Denied";
}

?>