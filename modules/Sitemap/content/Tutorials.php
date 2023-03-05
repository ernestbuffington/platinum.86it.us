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

class seoTutorials extends searchmodule {
	function seoTutorials (){
		global $prefix;
		$this->name                  = 'Tutorials';
		$this->module                = 'Tutoriaux';
		$this->sql_col_time          = 'time';
		$this->sql_col_time_unix     = false;
		$this->sql_col_title         = 'tuto';
#		$this->sql_col_title         = 'subtitle';
		$this->sql_col_id            = 'did';
		$this->sql_col_desc          = 'comment';
#		$this->sql_col_desc          = 'page';
		$this->sql_col_author        = 'username';
		$this->sql_table_with_prefix = $prefix.'_tuto_infos';
#		$this->sql_table_with_prefix = $prefix.'_tuto_page';
		$this->sql_where_cols        = array('tuto', 'comment');}
#		$this->sql_where_cols        = array('subtitle', 'page');}
	function buildlink($id){
		return '?name=Tutoriaux&amp;rop=tutoriaux&amp;did='.$id;}}
?>
