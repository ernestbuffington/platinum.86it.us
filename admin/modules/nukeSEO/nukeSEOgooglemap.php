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

if(!defined('ADMIN_FILE')) { header("Location: ../../../index.php");  die(); }

$pagetitle = _SEO_NUKESEO.": "._SEO_MENU;
include_once("header.php");
title($pagetitle);
OpenTable();
nukeSEOmenu();
global $nukeurl, $db, $prefix;

require_once('modules/Sitemap/nukeSEOfunctions.php');

function listSitemapModules(){
	global $db, $prefix;
	$content = '<h4>'._SEO_DISABLEDMODULES.'</h4><div style="padding-left:10px">';
	$res = $db->sql_query('SELECT * FROM '.$prefix.'_seomodules WHERE `use`="no"');
	while ($i = $db->sql_fetchrow($res)){
		$content .= $i['name'].' (<a href="$admin_file.php?op=nukeSEODelMod&id='.$i['name'].'">'._SEO_DELETEMODULE.'</a>)<br />';
	}
	$content .= '</div><h4>'._SEO_DISABLEMODULE.'</h4><div style="padding-left:10px"><form method="post" action="$admin_file.php?op=nukeSEODisableMod"><select name="id">';
	if ($handle = opendir('modules/Sitemap/content/')) {
		while (false !== ($file = readdir($handle))) {
			if (!is_dir('modules/Sitemap/content/'.$file)) {
				include_once('modules/Sitemap/content/'.$file);
				$cname = substr($file,0,-4);
				$cname2 = 'seo'.$cname;
				${$cname} = new $cname2();
				if (${$cname}->useme()){
					$file = substr($file,0,-4);
					$content .= '<option value="'.$file.'">'.$file.'</option>'."\n";
				}
			}
		}
		closedir($handle);
	}
	echo $content.'</select><input type="submit" value="'._SEO_DISABLE.'"></form></div>';
	return true;
}

function submitPageToGoogle() { 
	global $nukeurl;
	$sitemapurl = $nukeurl."/modules.php?name=Sitemap&op=Google";
	$res = fopen("http://www.google.com/webmasters/sitemaps/ping?sitemap=".urlencode($sitemapurl),"r");
	if ($res === FALSE) {
		echo "Error submitting sitemap $sitemapurl to Google";
	}
	
	while (!feof($res)) {
		$str .= fread($res, 1000);
	}
	fclose($res);
	echo "Result was: <i>".	strip_tags($str, "<br> <h2> <h1>")."</i><br/>";
	echo "Your sitemap file has been successfully sent to Google!";
	return true;
}

switch ($op) {
			
	case "nukeSEOgoogleSMConfig":
		listSitemapModules();		
		break;
	case 'nukeSEODisableMod':
		$res = $db->sql_query('INSERT INTO `'.$prefix.'_seomodules` (`name`, `use`) VALUES("'.$_REQUEST['id'].'", "no");');
		listSitemapModules();		
  		break;
	case 'nukeSEODelMod':
		$res = $db->sql_query('DELETE FROM `'.$prefix.'_seomodules` WHERE `name`="'.$_REQUEST['id'].'"');
		listSitemapModules();		
		break;
	
	case "nukeSEOgoogleSMSubmit":
		submitPageToGoogle();		
		break;

	default:
		viewSetup();
		break;
}

CloseTable();
include_once("footer.php");
?>