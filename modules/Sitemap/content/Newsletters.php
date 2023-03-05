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

class seoNewsletters extends searchmodule {
	function seoNewsletters (){
		global $prefix;
		$this->name                  = 'Newsletters';
		$this->module                = 'Fancy_Newsletter';
		$this->sql_col_time          = 'time';
		$this->sql_col_title         = 'title';
		$this->sql_col_id            = 'nid';
		$this->sql_col_desc          = 'inhalt';
		$this->sql_col_author        = 'aid';
		$this->sql_table_with_prefix = $prefix.'_fancynl_archives';
		$this->sql_where_cols        = array('title', 
							'inhalt');}
	function buildlink($id)
	{
		return '?name=Fancy_NewsLetter&amp;op=view&amp;nid='.$id;
	}
}
?>
