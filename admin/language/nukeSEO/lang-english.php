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

if(!defined('ADMIN_FILE')) { header("Location: ../../../index.php");  die(); }

# nukeSEO Menu
define_once("_SEO_NUKESEO","nukeSEO");
define_once("_SEO_MENU","Search Engine Optimization for PHP-Nuke");
define_once("_SEO_CONFIG","Configuration");
define_once("_SEO_ROBOTS","robots.txt");
define_once("_SEO_VIEW","View");
define_once("_SEO_VALIDATE","Validate");
define_once("_SEO_META","META Tags / Keywords");
define_once("_SEO_METAEDIT","Research & Edit");
define_once("_SEO_ANALYZE","Analyze META Tags");
define_once("_SEO_DENSITY","Keyword Density");
define_once("_SEO_GOOGLEMAP","Google Sitemap");
define_once("_SEO_GOOGLEMAPCONFIG","Configure");
define_once("_SEO_GOOGLEMAPGENERATE","Generate");
define_once("_SEO_GOOGLEMAPSTATUS","Status / Login");
define_once("_SEO_GOOGLEMAPSUBMIT","Submit");
define_once("_SEO_GOOGLEMAPSUBMIT_TITLE","Log into your Google Sitemap account before submitting");
define_once("_SEO_DISABLEDMODULES","Disabled Modules:");
define_once("_SEO_DELETEMODULE","Remove module");
define_once("_SEO_DISABLEMODULE","Disable module:");
define_once("_SEO_DISABLE","Disable");
define_once("_mSDISMOD","Disable Modules");
define_once("_mSACCESS","You do not have administration permission for module ");
define_once("_SEO_SUBMIT","Seach Engine Submission");
define_once("_SEO_SUBMIT_GOOGLE","Submit to Google and others");
define_once("_SEO_SUBMIT_TITLE","Free search engine submission and placement services, including Google and AOL!");
define_once("_SEO_SUBMIT_MSN","Submit to MSN");
define_once("_SEO_SUBMIT_MSN_TITLE","Submit to MSN requires manual entry");
define_once("_SEO_SUBMIT_YAHOO","Submit to Yahoo");
define_once("_SEO_SUBMIT_YAHOO_TITLE","Submit to Yahoo requires manual entry");
define_once("_SEO_RESULTS","Results");
define_once("_SEO_SATURATION","Saturation");
define_once("_SEO_SATURATION_HDR","Search Engine Saturation Report");
define_once("_SEO_INDEXEDPAGES","Indexed Pages");
define_once("_SEO_LINKPOP","Link Popularity");
define_once("_SEO_LINKPOP_HDR","Link Popularity Report");
define_once("_SEO_INDEXEDLINKS", "Indexed Links");
define_once("_SEO_KEYRANK","Keyword Ranking");
define_once("_SEO_KEYRANKHDR","Keyword Ranking Report");
define_once("_SEO_KEYRANKINST","Enter the search term(s) and the URL that you would like to check:");

define_once("_SEO_SEARCHENGINE","Search Engine");
define_once("_SEO_POSITION","Position");
define_once("_SEO_WEBURL","Nuke Website URL");
define_once("_SEO_SEARCHTERMS","Search Terms");
define_once("_SEO_NOTAVAIL","Not Available");

define_once("_ADDKEYWORD","Add");
define_once("_ADDCATEGORY","Add Category");
define_once("_ADDTAG","AddTag");
define_once("_AUTORISATIONERR","Sorry - You do not have authorization to see the MetaTags of this site");
define_once("_BACKUPFAILED","It was not possible to create a backup-file, saving aborted..");
define_once("_CLOSE","Close");
define_once("_COMMENTED","//");
define_once("_CONTENT","Content");
define_once("_DBERR","Error accessing database:");
define_once("_DBERRWHAT"," if column or table does not exist, you need to correct (remove it) from the config.php file");
define_once("_DELETESELECTED","Delete selected");
define_once("_HELP","Help");
define_once("_HELPFILE","UKhelp.htm");  // more to translate
define_once("_KEYWORD","Keyword");
define_once("_KEYWORDS","Keywords");
define_once("_KEYERR","The keyword is not created for the following reason:");
define_once("_LENGTH","Length:");
define_once("_METAERR","MetaTags not saved due to the following errors: ");
define_once("_METAOPEN","Could not open for writing MetaFile: ");
define_once("_METASTRING","Meta Tag:"); 
define_once("_METATAGCOPYRIGHT","Modified by nukeSEO from http://nukeSEO.com, adapted from the MetaTag module by http://visayas.dk");
define_once("_METATAGS", "MetaTags");
define_once("_METAWARN","During Save the following warnings were found");
define_once("_NAME","Name"); 
define_once("_PRIORITY","Priority");
define_once("_RESET","Reset");
define_once("_SAVE","Save changes");
define_once("_SAVEERR","Metafile not saved for the following reason:");
define_once("_SELECT","Select");
define_once("_SELECTALL","Select all");
define_once("_SETLOWERCASE","Lowercase");
define_once("_SETUNIQUE","Remove duplicates");
define_once("_SORTALFA","Sort keywords");
define_once("_SORTPRIOR","Sort by priority");
define_once("_TRYAGAIN","Go Back and correct");
define_once("_TYPE","Type");
define_once("_UNSELECTALL","Un-select all");
define_once("_VIEWERR","MetaTags are not shown for the following reason:");

# Error messages used in $error_html array defined in config.php 
define_once("_ERROR1","the keyword is not unique"); 
define_once("_ERROR2","The keyword(s) will make the MetaTag too long <br> Maximum length for a MetaTag is ");
define_once("_ERROR3"," is a too long tag <br> Maximum length for a MetaTag is ");
define_once("_ERROR4"," could not regcognize the syntax.<br>Correct syntax is &lt;number&gt;;URL=http://domain.suffix...");
define_once("_ERROR5"," could not open - commented out! "); 
define_once("_ERROR6","First parameter of Refresh tag should be numeric. Read: ");
define_once("_ERROR7"," is the maximum length os Description, the length measured to: ");
define_once("_ERROR8","Description contain one or more HTML-tags which are not permitted");
define_once("_ERROR9","Pragma tag can only have the value \"no-cache\"");
define_once("_ERROR10","Window-target tag can only have the value \"_top\"");
define_once("_ERROR11"," is not a valid word in ROBOTS tag");
define_once("_ERROR12","Robots have these valid combinations: <br>ALL, NONE, and combinations of INDEX, NOINDEX, FOLLOW and NOFOLLOW");
define_once("_ERROR13","\t not been validated as no validation rules have been coded");
