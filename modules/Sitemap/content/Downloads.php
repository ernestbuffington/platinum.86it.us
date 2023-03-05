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

class seoDownloads extends searchmodule {
	function seoDownloads(){
		global $prefix;
		$this->name                  = 'Downloads';
		$this->module                = 'Downloads';
		$this->sql_table_with_prefix = $prefix.'_downloads_downloads';
	}

	function formatGoogleResult($result){
		global $url;
		return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=Downloads&amp;d_op=viewdownloaddetails&amp;ttitle='.$result['title'].'&amp;lid='.$result['rid']);
	}
	function formatSitemapResult($result)
	{
		return '<a href="modules.php?name=Downloads&d_op=viewdownloaddetails&ttitle='.$result['title'].'&lid='.$result['rid'].'" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a>';
	}
	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$db->sql_query('INSERT INTO '.$tblname.'
					    (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
					    SELECT CONCAT("Downloads", `lid`) AS `id`, \'1\', UNIX_TIMESTAMP(`date`),
						     `title`, `lid`, `description`, `submitter`, "Downloads"
					    FROM '.$prefix.'_downloads_downloads
					    WHERE ((title like \'%'.$query.'%\')
						     OR (description like \'%'.$query.'%\'))');}}}
?>
