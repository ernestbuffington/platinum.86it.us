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

if(!defined('MODULE_FILE')) { header("Location: ../../index.php");  die(); }

$index = 0;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._SEO_SITEMAP."";
require_once("modules/$module_name/nukeSEOfunctions.php");

# Get the current url
$url = str_replace('&', '&amp;', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$url = parse_url($url);

# Create a temporary table to hold the search results
$randkey = rand(0, 10000);
$tblname = $prefix.'_sitemap_'.$randkey;
$db->sql_query('CREATE TEMPORARY TABLE '.$tblname.' (
                `id` VARCHAR(20) NOT NULL ,
                `relevance` INT NOT NULL ,
                `date` INT NOT NULL ,
                `title` TEXT NOT NULL ,
                `rid` INT NOT NULL ,
                `desc` TEXT NOT NULL ,
                `author` TEXT NOT NULL ,
                `searchmodule` TEXT NOT NULL ,
                INDEX ( `relevance` ),
                INDEX ( `date` )
                );');

$GLOBALS['seoar'] = array();
$query = "";
$q = array("");
get_all_results();
global $db, $tblname, $url, $module_name;
$GLOBALS['seoresult'] = $db->sql_query('SELECT `id`, count(`id`) as `rel`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule` FROM '.$tblname.' GROUP BY id ORDER BY `searchmodule` ASC, `rel` DESC, date DESC');

switch ($op){
  case 'Google':
    header('Content-Type:text/xml');
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';

   	echo "<!-- Created by nukeSEO Sitemap "._SEO_VERSION." -->";
	echo "<!-- Updated on ".date('Y-m-d\TH:m:sO')." -->";

	$lastgroup = '';
	while ($i = $db->sql_fetchrow($GLOBALS['seoresult'])){
		if ($i['searchmodule'] != $lastgroup){
			$lastgroup = $i['searchmodule'];
			$modlinks = $GLOBALS['seoar'][$i['searchmodule']]->formatGoogleModuleLinks();
			echo $modlinks;
		}
		$googlelink = $GLOBALS['seoar'][$i['searchmodule']]->formatGoogleResult($i)."\n";
		echo $googlelink;
	}
	echo "\n</urlset>";
	break;

  default:
	include_once('header.php');
	OpenTable();
	echo '<strong>'._SEO_SITEMAP.':</strong><br /><div style="padding-left:15px">';
	$gar = array();
	$lastgroup = '';
	while ($i = $db->sql_fetchrow($GLOBALS['seoresult'])){
		if ($i['searchmodule'] != $lastgroup){
			$lastgroup = $i['searchmodule'];
			$gar[$lastgroup] = array();
			$gar[$lastgroup]['m'] = $lastgroup;
			$gar[$lastgroup]['c'] .= '<h3 style="margin:0">'.$lastgroup.'</h3><hr style="margin:0;padding:0" width="100%"><div style="padding-left:20px;">';
		}
		$gar[$lastgroup]['n'] += 1;
		$gar[$lastgroup]['r'] = (float)((($gar[$lastgroup]['r'] * ($gar[$lastgroup]['n'] - 1)) + $i['rel']) / $gar[$lastgroup]['n']);
		$gar[$lastgroup]['rn'] = ($gar[$lastgroup]['r'] * 50) + $gar[$lastgroup]['n'];
		$gar[$lastgroup]['c'] .= '<p'.($gar[$lastgroup]['n'] ? ' style="padding-top:0;margin-top:3px"' : '').'>'.$GLOBALS['seoar'][$i['searchmodule']]->formatSitemapResult($i).'</p>';
	}
	$gar = array_reverse(asortbyindex($gar, 'rn'));
	foreach ($gar as $val)
	{
		echo $val['c'].'</div>';
	}
	echo '</div>';
	CloseTable();
	include_once('footer.php');
    break;
}

?>