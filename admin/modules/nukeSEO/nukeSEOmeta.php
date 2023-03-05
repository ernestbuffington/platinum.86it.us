<?
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

global $admin_file, $adveditor, $currentlang;
$adveditor = 0;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { die("Illegal Access Detected!!"); }

$pagetitle = _SEO_NUKESEO.": "._SEO_META;
include_once("header.php");
title($pagetitle);
nukeSEOmenu();
require_once("admin/modules/nukeSEO/config.php");
require_once("admin/modules/nukeSEO/nukeSEOMETAfunc.php");

if (file_exists("admin/modules/nukeSEO/nukeSEOMETAhelp.php"))
{
	echo "<script type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function openhelp(){\n";
	echo "	window.open (\"".$admin_file.".php?op=nukeSEOMETAhelp\",\""._HELP."\",\"toolbar=yes,location=no,directories=yes,status=no,scrollbars=yes,resizable=yes,copyhistory=yes,width=500,height=400\");\n";
	echo "}\n";
	echo "//-->\n";
	echo "</SCRIPT>\n\n";
}

if (is_admin($admin)==1)
{
 
/***********************************************************************/  
/*  MAIN CONTROL FOR ADMIN IS HERE                                     */  
/***********************************************************************/  
  
  switch($seofunc)
  {
	case "tagname":
				update_MetaTag(); // update MetaTag with changes in form
				if (isset($ValidTag[$newTag])) $currenttag = $ValidTag[$newTag]; 
			    update_hidden();
		        break;
				
    case "keywordupdate":
				update_MetaTag(); // update MetaTag with changes in form
                switch($submit)
                { default: echo "<br> Unknown action $submit "; break;
                  case _ADDKEYWORD:  add_new_keyword($keyword); break;
                  case _DELETESELECTED:  delete_selected_keyword(); break;
                  case _SORTALFA: sort_keywords_name(); break;
				  case _SORTPRIOR: sort_keywords_priority(); break;
				  case _SETLOWERCASE: lowercase_keywords(); break;
				  case _SETUNIQUE: unique_case_keywords(); break; // test
				  case _SELECTALL: select_all(); break;
				  case _UNSELECTALL: deselect_all(); break;
				  case _SAVE: sort_keywords_priority(); 
				              if (validate()) {save_file(); reset_metadata(); read_metafile();}
							  break;
				  case _ADDCATEGORY: get_categories(); break;
				  case _ADDTAG: add_new_tag(); break;
				  case _RESET: read_metafile(); break;
				  case _HELP:  
				  break;
                 }
				 if (!($submit==_SAVE)) {
			       update_hidden();
				 }
		         break;
	case "Help": 
		 		 break;
    default: 
		if (!(isset($MetaTag)))
		{ 
			$MetaTag = array();  
			$lines = array();
			$MetaTagWord = array();
			read_metafile();
		}
		break;
  }
  metatag_form(); 
  mt_Footer(); 
  include_once("footer.php");
} 

?>
