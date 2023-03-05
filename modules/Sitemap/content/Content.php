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

class seoContent extends searchmodule {
	function seoContent (){
		global $prefix;
		$this->name                  = 'Content';
		$this->module                = 'Content';
		$this->sql_col_time          = 'date';
		$this->sql_col_title         = 'title';
		$this->sql_col_id            = 'pid';
		$this->sql_col_desc          = 'text';
		$this->sql_col_author        = '"none"';
		$this->sql_table_with_prefix = $prefix.'_pages';
		$this->sql_where_cols        = array('title',
							'page_footer',
							'signature',
							'text');}
	function buildlink($id){
		return '?name=Content&amp;pa=showpage&amp;pid='.$id;}
	function doquery(){
		global $prefix, $tblname, $db;
		$q = $this->query[0][1];
		foreach ($q as $query){
			$db->sql_query('INSERT INTO '.$tblname.' (`id`, `relevance`, `date`, `title`, `rid`, `desc`, `author`, `searchmodule`) 
					SELECT CONCAT("Content", `pid`) AS `id`, \'1\', UNIX_TIMESTAMP(`date`), `title`, `pid`, `text`, "none", 
					"Content" FROM '.$prefix.'_pages 
					WHERE (active like 1) AND ((title like \'%'.$query.'%\') 
						OR (page_footer like \'%'.$query.'%\') 
						OR (signature like \'%'.$query.'%\') 
						OR (text like \'%'.$query.'%\'))');}}}
?>
