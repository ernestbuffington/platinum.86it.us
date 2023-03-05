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

if(!defined('ADMIN_FILE') and !defined('MODULE_FILE')) { header("Location: ../../index.php");  die(); }

// Utility functions

function chopwords($str, $c){
	// Chop a string at a certain length, without cutting off any words.
	$s = explode(' ', $str);
	$x = 0;
	$string = '';
	foreach ($s as $word){
		$x += strlen($word)+1;
		if ($x < $c){
			$string .= $word.' ';
		} else {
			return $string;
		}
	}
	return $string;
}

function asortbyindex($multiArray, $secondIndex) {
	// Sort a 2-Dimensional array.
	$GLOBALS['secondIndex'] = $secondIndex;
	usort($multiArray, create_function('$a, $b', '
		$secondIndex = $GLOBALS["secondIndex"];
		if ($a[$secondIndex] == $b[$secondIndex]) {
			return 0;
		}
		return ($a[$secondIndex] < $b[$secondIndex]) ? -1 : 1;
		')
	);
	return $multiArray;
}

function get_all_results(){
	# Find all the modules and collect their results into the database.
	global $module_name, $q;
	if ($handle = opendir('modules/'.$module_name.'/content/')) {
		while (false !== ($file = readdir($handle))) {
			if (!is_dir('modules/'.$module_name.'/content/'.$file)) {
				include_once('modules/'.$module_name.'/content/'.$file);
				$cname = substr($file,0,-4);
				$cname2 = 'seo'.$cname;
				${$cname} = new $cname2();
				if (${$cname}->useme()){
					$GLOBALS['seoar'][$cname] = ${$cname};
					${$cname}->addquery('main', $q);
					${$cname}->getresults();
				}
			}
		}
		closedir($handle);
	}
}


class searchmodule {
	var $query;
	var $name;
	var $sql_col_time;
	var $sql_col_title;
	var $sql_col_id;
	var $sql_col_desc;
	var $sql_col_author;
	var $sql_table_with_prefix;
	var $sql_where_cols;

	function useme(){
		# Returns true if this module is configured to be used
		global $db, $prefix;
		if ($this->databaseexists()){
			$res = $db->sql_fetchrow($db->sql_query('SELECT `use` FROM '.$prefix.'_seomodules WHERE `name`="'.$this->name.'"'));
			return ($res['use'] == 'no' ? 0 : 1);
		}
		return 0;
	}

	function databaseexists(){
	# Returns true if the database for this module is installed
		global $db;
		$res = $db->sql_query('SELECT "1" FROM '.$this->sql_table_with_prefix);
		return ($res ? 1 : 0);
	}

	function formatGoogleURL($loc, $date = "", $changefreq = "daily", $priority = "0.5"){
		if ($date == "") { 
#			$date = date('Y-m-d\TH:m:sO');
			$date = date('Y-m-d\TH:m:s');
			$pre = date('O', $date);
			$offset = substr($pre, 0, 3).":".substr($pre, 3, 2);
			$date .= $offset;
		}
		return '
    <url>
      <loc>'.$loc.'</loc>
      <lastmod>'.$date.'</lastmod>
      <changefreq>'.$changefreq.'</changefreq>
      <priority>'.$priority.'</priority>
    </url>';
	}

	function formatGoogleResult($result){
	# Format a result for a Google Sitemap
		global $url, $nukeurl;
		$loc = $url['scheme'].'://'.$url['host'].$url['path'].$this->buildlink($result['rid']);
#		$date = date('Y-m-d\TH:m:sO');
#		$changefreq = "daily";
#		$priority = "0.5";
#		return formatGoogleURL($loc, $date, $changefreq, $priority);
		return $this->formatGoogleURL($loc);
    }
	function formatGoogleModuleLinks(){
		$formatGoogleModuleLinks = "";
		$modLinks = $this->buildModuleLinks();
		if (is_array($modLinks)){
			foreach($modLinks as $loc){
				$formatGoogleModuleLinks .= $this->formatGoogleURL($loc);
			}
		}
		return $formatGoogleModuleLinks;
	}

	function formatSitemapResult($result)
	{
		# Format a result to be displayed in the group-display page
		return '<a href="modules.php'.$this->buildlink($result['rid']).'" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a>';
	}

	function doquery(){
	# Insert any results matching the users query into the main database
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$wheretext = '('.$this->sql_where_cols[0].' like \'%'.$query.'%\')';
			for ($i = 1,$x=count($this->sql_where_cols);$i<$x;$i++){
				$wheretext .= ' OR (`'.$this->sql_where_cols[$i].'` like \'%'.$query.'%\')';
			}
			$db->sql_query('INSERT INTO '.$tblname.' 
				(`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
				SELECT CONCAT("'.$this->name.'", `'.$this->sql_col_id.'`) AS `id`, \'1\', 
				'.($this->sql_col_time_unix ? '' : 
				'UNIX_TIMESTAMP(`').$this->sql_col_time.($this->sql_col_time_unix ? '' : '`)').', 
				`'.$this->sql_col_title.'`, `'.$this->sql_col_id.'`, `'.$this->sql_col_desc.'`,
				`'.$this->sql_col_author.'`, "'.$this->name.'" FROM '.$this->sql_table_with_prefix.' 
				WHERE ('.$wheretext.')');
		}
	}

	function addquery($type, $query){
		$this->query[] = array($type, $query);
	}

	function getresults(){
		return $this->doquery();
	}

	function buildlink($id){
		# Used by the individual modules to define how a link to an item should be built
	}
	function buildModuleLinks(){
		global $url;
		# Used by the individual modules to define how a link to an item should be built
		$buildModuleLinks[] = $url['scheme'].'://'.$url['host'].$url['path']."?name=".$this->module;
		return $buildModuleLinks;
	}
}

?>