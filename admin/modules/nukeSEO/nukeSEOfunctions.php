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

function check_install() { 
	global $db, $prefix;
	$exists = $db->sql_query("SELECT 1 FROM `".$prefix."_seomodules` LIMIT 0");
	if ($exists) return true;
	# table creation is MySQL-specific
	$db->sql_query("CREATE TABLE `".$prefix."_seomodules` (
 		 `name` text NOT NULL,
 		 `use` text NOT NULL
		) TYPE=MyISAM;");
	return false; 
} 

function SERPfetch($source, $target, $smark, $smlen, $emark, $start, $stop) {
	// get data from source
	$data = @implode('', @file($source)); 
	
	// strip unnecessary data
	$data = substr($data, strpos($data, $start));
	if(substr_count($data, $stop))
		$data = substr($data, 0, strpos($data, $stop));
	
	// number of results on page
	$results = substr_count($data, $smark);
	
	// initialize valiables
	$num = 0;
	$found = false;
	
	// check results
	while($num < $results) {
		$begin = strpos($data, $smark) + $smlen;
		$length = strpos($data, $emark) - $begin;
		$tmp = substr($data, $begin, $length);
		
		$num++;
		if(substr_count($tmp, $target)) {
			$found = true;
			break;
		}
		// move past result that was just checked
		$data = substr($data, strpos($data, $emark));
		$data = substr($data, strpos($data, $smark));
	}
	
	return array($found, $num);
}

function fetchCount($source, $start, $smlen, $stop, $fail) {
	$data = @implode('', @file($source));
	$data = strip_tags($data);
	$data = strtolower($data);
	$data = str_replace("\n", '', $data);
	$data = str_replace("\r", '', $data);
	
	if(substr_count($data, $fail)) {
		return 0;
	} else {
		$startpos = strpos($data, $start);
		if ($startpos === false) {
			$startpos = strpos($data, "of");
			$smlen = 3;
		}
		$data = substr($data, $startpos+$smlen);
		$data = substr($data, 0, strpos($data, $stop));
		return trim($data);
	}
}

?>