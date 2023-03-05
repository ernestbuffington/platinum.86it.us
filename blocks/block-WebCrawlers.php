<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $user, $cookie, $prefix, $db, $user_prefix, $wcprefix, $_SERVER;
$wcprefix = "". $prefix ."_webcrawlers";
/* you can put these lang defines into lang-english.php */
/* if you wish too.                                     */
define("_WC_GOOGLE","Google Visits");
define("_WC_YAHOO","Yahoo Visits");
define("_WC_MSN","Msn Visits");
define("_WC_JEEVES","Jeeves Visits");
define("_WC_EXCITE","Excite Visits");
define("_WC_INFOSEEK","InfoSeek Visits");
define("_WC_LYCOS","Lycos Visits");
$crawlers=array(
"googlebot" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='google'",
"yahoo" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='yahoo'",
"msnbot" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='msn'",
"jeeves" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='jeeves'",
"ArchitextSpider" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='excite'",
"ultraseek" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='infoseek'",
"bos-spider" => "UPDATE ". $wcprefix ." SET count=count+1 WHERE webcrawler='lycos'"
);
/* sql_numrows */
if (!$result=$db->sql_query("SELECT * FROM ". $wcprefix ."")) { 
$result=$db->sql_query("CREATE TABLE ". $wcprefix ." (
webcrawler varchar(255) NOT NULL default '',  
count varchar(255) NOT NULL default '',  
PRIMARY KEY  (`webcrawler`)) 
TYPE=MyISAM;
");
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('google', '0')");
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('msn', '0')"); 
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('yahoo', '0')"); 
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('jeeves', '0')"); 
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('excite', '0')"); 
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('infoseek', '0')"); 
$db->sql_query("INSERT INTO ". $wcprefix ." (webcrawler, count) VALUES ('lycos', '0')"); 
if ($result){$content="sql tables installed. <br>now refresh your browser!";}
if (!$result){$content="error while installing sql tables!";}
}
foreach ($crawlers as $key => $value) {
if (preg_match("/$key/i", $_SERVER['HTTP_USER_AGENT'])) {$db->sql_query("$value");}
}
$content="<center><table border=0 width=60%>";
$content.="".wcshowformat('google',""._WC_GOOGLE."","www.google.com")."";
$content.="".wcshowformat('yahoo',""._WC_YAHOO."","www.yahoo.com")."";
$content.="".wcshowformat('msn',""._WC_MSN."","www.msn.com")."";
$content.="".wcshowformat('jeeves',""._WC_JEEVES."","www.ask.co.uk")."";
//$content.="".wcshowformat('excite',""._WC_EXCITE."","www.excite.com")."";
//$content.="".wcshowformat('lycos',""._WC_LYCOS."","www.lycos.com")."";
//$content.="".wcshowformat('infoseek',""._WC_INFOSEEK."","www.go.com")."";
$content.="</table></center>";
function wcgetcount($wc) {
global $db, $wcprefix;
$result=$db->sql_query("SELECT count FROM ". $wcprefix ." WHERE webcrawler='$wc'");
$row = $db->sql_fetchrow($result);
return $row['count'];
} 
function wcshowimg($img,$alt) {
return "<img src='images/wc_images/wc_{$img}.gif' border=0 width=60 height=15 alt='$alt'>";
}
function wcshowformat($who,$alt,$url) {
return "<tr><td><a href='http://$url' target=blank_>".wcshowimg($who,$alt)."</a></td><td><strong>".wcgetcount($who)."</strong></td><tr>";
}
?>
