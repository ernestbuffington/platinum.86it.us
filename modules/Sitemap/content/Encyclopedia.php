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

class seoEncyclopedia extends searchmodule {
	function seoEncyclopedia (){
		global $prefix;
		$this->name                  = 'Encyclopedia';
		$this->module                = 'Encyclopedia';
		$this->sql_table_with_prefix = $prefix.'_encyclopedia';
	}

	function formatGoogleResult($result){
		global $db, $prefix, $url;
		if ($result['author'] == 1){
			return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=Encyclopedia&amp;op=list_content&amp;eid='.$result['rid']);
		} else {
			return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=Encyclopedia&amp;op=content&amp;tid='.$result['rid']);
	}
	}
	function formatSitemapResult($result){
		global $db, $prefix;
		if ($result['author'] == 1){
			return '<a href="modules.php?name=Encyclopedia&amp;op=list_content&amp;eid='.$result['rid'].'" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a>';
		} else {
			return '<a href="modules.php?name=Encyclopedia&amp;op=content&amp;tid='.$result['rid'].'" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a>';
		}
	}
	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			if ($_REQUEST['msenc1'] || (!$_REQUEST['msenc1'] && !$_REQUEST['msenc2'])){
				$db->sql_query('INSERT INTO '.$tblname.'
					   (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
					   SELECT CONCAT("Encyclopedia", `eid`) AS `id`, \'1\', \'1\',
						    `title`, `eid`, `description`, \'1\', "Encyclopedia"
					   FROM '.$prefix.'_encyclopedia WHERE
					   ((`title` like \'%'.$query.'%\')
						OR (`description` like \'%'.$query.'%\')) AND `active`="1";');
			}
			if ($_REQUEST['msenc2'] || (!$_REQUEST['msenc1'] && !$_REQUEST['msenc2'])){
				$db->sql_query('INSERT INTO '.$tblname.'
					   (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
					   SELECT CONCAT("Encyclopedia2", `tid`) AS `id`, \'1\', \'1\',
						    `title`, `tid`, `text`, \'2\', "Encyclopedia"
					   FROM '.$prefix.'_encyclopedia_text WHERE
					   ((`title` like \'%'.$query.'%\')
						OR (`text` like \'%'.$query.'%\'));');
			}
		}
	}
}
?>
