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

class seoFAQs extends searchmodule {
	function seoFAQs (){
		global $prefix;
		$this->name                  = 'FAQs';
		$this->module                = 'FAQ';
		$this->sql_table_with_prefix = $prefix.'_faqanswer';}
		
	function formatGoogleResult($result){
		global $url;
		return $this->formatGoogleURL($url['scheme'].'://'.$url['host'].$url['path'].'?name=FAQ&amp;myfaq=yes&amp;id_cat='.$result['author'].'&amp;#'.$result['rid']);
    }
    
	function formatSitemapResult($result){
		return '<a href="modules.php?name=FAQ&amp;myfaq=yes&amp;id_cat='.$result['author'].'&amp;#'.$result['rid'].'" title="'.chopwords(strip_tags($result['desc']),192).'">'.$result['title'].'</a><br />';
	}
		
	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$db->sql_query('INSERT INTO '.$tblname.'
					   (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`)
					   SELECT CONCAT("FAQs", `id`) AS `id`, \'1\', \'1\',
						    `question`, `id`, `answer`, `id_cat`, "FAQs"
					   FROM '.$prefix.'_faqanswer WHERE
					   ((`question` like \'%'.$query.'%\')
						OR (`answer` like \'%'.$query.'%\'));');}}
}
?>