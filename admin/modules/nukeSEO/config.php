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

  $metafilename = "includes/meta.php";   //PHP-Nuke use file "includes/meta.php"
  $backupfilename = "includes/meta2.php";
  $script_version = "1.0";
  $maxpriorty = -1;   // either highest priority allowed or negative to have the number of keywords plus 1
  $maxtaglength = 1024;
  $tag_keyword_fill = 33; //length of tag that isnt keywords
  $maxdescription = 300;  //max length of description
  $addtaglevel = 1;       // 0: strict, only known tags ($tagName/$tagNameHTTP) can be added
	                        // 1: first strict, when no more known switch to free
	                        // 2: any - free format, own risk
  
  $tagType     = array("HTTP-EQUIV","NAME");
  $tagNameHTTP = array("refresh","Content-Type","EXPIRES","Pragma","Set-Cookie","Window-target","PICS-Label");
  $tagName     = array("RESOURCE-TYPE","DISTRIBUTION","AUTHOR","COPYRIGHT","DESCRIPTION","ROBOTS","REVISIT-AFTER","RATING","GENERATOR","GEO.POSITION","GEO.PLACENAME","GEO.REGION");

 
  $error_html[1] = _ERROR1;  
  $error_html[2] = _ERROR2;

  // categories that will be allowed to load keywords from
  // please be aware that these 4 arrays are to be in exactly same order
  switch($Version_Num) {
    default: // created for version 6.5
      $categories =        array("bb-topics",
	                       //    "categories",      //only if using Splatt Forums
						   		 "bb-categories",
								 "main downloads categories",
								 "sub downloads categories",
								 "faq categories",
							//	 "forums",          //only if using Splatt Forums
								 "bb-forums",
							//	 "forum topics",    //only if using Splatt Forums
								 "main links categories",
								 "sub links categories",
								 "pages categories",
								 "stories categories",
							//	 "words",            //only if using Splatt Forums    
								 "bb-words"
								 );  
      $categoriesTables  = array("bbtopics",
	                       //    "categories",
						   		 "bbcategories",
								 "downloads_categories",
								 "downloads_categories",
								 "faqcategories",
							//	 "forums",
								 "bbforums",
							//	 "forumtopics",
								 "links_categories",
								 "links_categories",
								 "pages_categories",
								 "stories_cat",
							//	 "words",
								 "bbwords"
								 );  
      $categoriesColName = array("topic_title",
	                       //    "cat_title",
						   		 "cat_title",
								 "title",
								 "title",
								 "categories",
							//	 "forum_name",
								 "forum_name",
							//	 "topic_title",
								 "title",
								 "title",
								 "title",
								 "title",
							//	 "word"
								 "word"
								 );	
      $categoriesWhere   = array("",
	                       //    "",
						   		 "",
								 "parentid=0",
								 "parentid<>0",
								 "",
							//	 "",
								 "",
							//	 "",
								 "parentid=0",
								 "parentid<>0",
								 "",
								 "",
							//	 "",
								 ""
								 );

	  break;
    case "6.0":  
      $categories =        array("bbtopics","categories","main downloads categories","sub downloads categories","faq categories","forums","forum topics","main links categories","sub links categories","pages categories","stories categories","words");  
      $categoriesTables  = array("bbtopics",   "categories","downloads_categories","downloads_categories","faqcategories","forums",    "forumtopics","links_categories","links_categories","pages_categories","stories_cat","words");  
      $categoriesColName = array("topic_title","cat_title", "title",               "title",               "categories",   "forum_name","topic_title","title",           "title",           "title",           "title",      "word");	
      $categoriesWhere   = array("","","parentid=0","parentid<>0","","","","parentid=0","parentid<>0","","","");
	  break;
  }	  	
?>
