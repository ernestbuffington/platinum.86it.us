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

class seoNews extends searchmodule {
	function seoNews (){
		global $prefix;
		$this->name                  = 'News';
		$this->module                = 'News';
		$this->sql_col_time          = 'time';
		$this->sql_col_title         = 'title';
		$this->sql_col_id            = 'sid';
		$this->sql_col_desc          = 'hometext';
		$this->sql_col_author        = 'aid';
		$this->sql_table_with_prefix = $prefix.'_stories';
		$this->sql_where_cols        = array('title', 
							'hometext', 
							'bodytext');
	}
	
	function buildlink($id){
		return '?name=News&amp;file=article&amp;sid='.$id.'&amp;mode=&amp;order=0&amp;thold=0';
	}
}
?>
