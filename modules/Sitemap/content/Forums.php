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

class seoForums extends searchmodule {
	function seoForums(){
		global $prefix;
		$this->name                  = 'Forums';
		$this->module                = 'Forums';
		$this->sql_table_with_prefix = $prefix.'_bbtopics';
	}

	function formatGoogleResult($result){
		global $url;
		return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=Forums&amp;file=viewtopic&amp;t='.$result['rid'].'&amp;mode=&amp;order=0&amp;thold=0');
	}

	function formatSitemapResult($result){
		if (!trim($result['title'])){
			$result['title'] = 'View Result';
		}
		return '<a href="modules.php?name=Forums&amp;file=viewtopic&amp;t='.$result['rid'].'&amp;mode=&amp;order=0&amp;thold=0" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a><br />';
	}

	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$db->sql_query('INSERT INTO '.$tblname.' 
					   (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`) 
					   SELECT CONCAT("Forums", t.topic_id) AS `id`, \'1\', \'0\', `topic_title`, 
					   t.topic_id, `topic_title`, t.topic_poster, "Forums" FROM '.$prefix.'_bbtopics t,'.$prefix.'_bbforums f
					   WHERE f.forum_id=t.forum_id  AND (f.auth_view < 2 or f.auth_read < 2) AND
					   (t.topic_title like \'%'.$query.'%\') order by t.topic_id desc');
		}
	}
}
?>
