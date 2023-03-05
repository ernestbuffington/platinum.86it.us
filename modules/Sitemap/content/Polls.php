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

if(!defined('ADMIN_FILE') and !defined('MODULE_FILE')) { header("Location: ../../../index.php");  die(); }

class seoPolls extends searchmodule {
	function seoPolls (){
		global $prefix;
		$this->name                  = 'Polls';
		$this->module                = 'Surveys';
		$this->sql_table_with_prefix = $prefix.'_poll_desc';}

	function formatGoogleResult($result){
		global $url;
		return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=Surveys&amp;op=results&amp;pollID='.$result['rid']);
	}
	function formatSitemapResult($result){
		return '<a href="modules.php?name=Surveys&amp;op=results&amp;pollID='.$result['rid'].'">'.$result['title'].'</a>';
	}

	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$db->sql_query('INSERT INTO '.$tblname.'
					   (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
					   SELECT CONCAT("Polls", `pollID`) AS `id`, \'1\', `timeStamp`,
						    `pollTitle`, `pollID`, `pollTitle`, \'1\', "Polls"
					   FROM '.$prefix.'_poll_desc WHERE
					   `pollTitle` like \'%'.$query.'%\';');}}}
?>
