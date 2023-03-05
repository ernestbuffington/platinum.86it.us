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
define("_SEO_NUKESEO","nukeSEO");
define("_SEO_MENU","Search Engine Optimization for PHP-Nuke");
define("_SEO_CONFIG","Configuration");
define("_SEO_ROBOTS","robots.txt");
define("_SEO_VIEW","View");
define("_SEO_VALIDATE","Validate");
define("_SEO_META","META Tags / Keywords");
define("_SEO_METAEDIT","Research & Edit");
define("_SEO_ANALYZE","Analyze META Tags");
define("_SEO_DENSITY","Keyword Density");
define("_SEO_GOOGLEMAP","Google Sitemap");
define("_SEO_GOOGLEMAPCONFIG","Configure");
define("_SEO_GOOGLEMAPGENERATE","Generate");
define("_SEO_GOOGLEMAPSTATUS","Status / Login");
define("_SEO_GOOGLEMAPSUBMIT","Submit");
define("_SEO_GOOGLEMAPSUBMIT_TITLE","Log into your Google Sitemap account before submitting");
define("_SEO_DISABLEDMODULES","Disabled Modules:");
define("_SEO_DELETEMODULE","Remove module");
define("_SEO_DISABLEMODULE","Disable module:");
define("_SEO_DISABLE","Disable");
define("_mSDISMOD","Disable Modules");
define("_mSACCESS","You do not have administration permission for module ");
define("_SEO_SUBMIT","Seach Engine Submission");
define("_SEO_SUBMIT_GOOGLE","Submit to Google and others");
define("_SEO_SUBMIT_TITLE","Free search engine submission and placement services, including Google and AOL!");
define("_SEO_SUBMIT_MSN","Submit to MSN");
define("_SEO_SUBMIT_MSN_TITLE","Submit to MSN requires manual entry");
define("_SEO_SUBMIT_YAHOO","Submit to Yahoo");
define("_SEO_SUBMIT_YAHOO_TITLE","Submit to Yahoo requires manual entry");
define("_SEO_RESULTS","Results");
define("_SEO_SATURATION","Saturation");
define("_SEO_SATURATION_HDR","Search Engine Saturation Report");
define("_SEO_INDEXEDPAGES","Indexed Pages");
define("_SEO_LINKPOP","Link Popularity");
define("_SEO_LINKPOP_HDR","Link Popularity Report");
define("_SEO_INDEXEDLINKS", "Indexed Links");
define("_SEO_KEYRANK","Keyword Ranking");
define("_SEO_KEYRANKHDR","Keyword Ranking Report");
define("_SEO_KEYRANKINST","Enter the search term(s) and the URL that you would like to check:");

define("_SEO_SEARCHENGINE","Search Engine");
define("_SEO_POSITION","Position");
define("_SEO_WEBURL","Nuke Website URL");
define("_SEO_SEARCHTERMS","Search Terms");
define("_SEO_NOTAVAIL","Not Available");

define("_ADDKEYWORD","Add");
define("_ADDCATEGORY","Add Category");
define("_ADDTAG","AddTag");
define("_AUTORISATIONERR","Sorry - You do not have authorization to see the MetaTags of this site");
define("_BACKUPFAILED","It was not possible to create a backup-file, saving aborted..");
define("_CLOSE","Close");
define("_COMMENTED","//");
define("_CONTENT","Content");
define("_DBERR","Error accessing database:");
define("_DBERRWHAT"," if column or table does not exist, you need to correct (remove it) from the config.php file");
define("_DELETESELECTED","Delete selected");
define("_HELP","Help");
define("_HELPFILE","UKhelp.htm");  // more to translate
define("_KEYWORD","Keyword");
define("_KEYWORDS","Keywords");
define("_KEYERR","The keyword is not created for the following reason:");
define("_LENGTH","Length:");
define("_METAERR","MetaTags not saved due to the following errors: ");
define("_METAOPEN","Could not open for writing MetaFile: ");
define("_METASTRING","Meta Tag:"); 
define("_METATAGCOPYRIGHT","Modified by nukeSEO from http://nukeSEO.com, adapted from the MetaTag module by http://visayas.dk");
define("_METATAGS", "MetaTags");
define("_METAWARN","During Save the following warnings were found");
define("_NAME","Name"); 
define("_PRIORITY","Priority");
define("_RESET","Reset");
define("_SAVE","Save changes");
define("_SAVEERR","Metafile not saved for the following reason:");
define("_SELECT","Select");
define("_SELECTALL","Select all");
define("_SETLOWERCASE","Lowercase");
define("_SETUNIQUE","Remove duplicates");
define("_SORTALFA","Sort keywords");
define("_SORTPRIOR","Sort by priority");
define("_TRYAGAIN","Go Back and correct");
define("_TYPE","Type");
define("_UNSELECTALL","Un-select all");
define("_VIEWERR","MetaTags are not shown for the following reason:");

# Error messages used in $error_html array defined in config.php 
define("_ERROR1","the keyword is not unique"); 
define("_ERROR2","The keyword(s) will make the MetaTag too long <br> Maximum length for a MetaTag is ");
define("_ERROR3"," is a too long tag <br> Maximum length for a MetaTag is ");
define("_ERROR4"," could not regcognize the syntax.<br>Correct syntax is &lt;number&gt;;URL=http://domain.suffix...");
define("_ERROR5"," could not open - commented out! "); 
define("_ERROR6","First parameter of Refresh tag should be numeric. Read: ");
define("_ERROR7"," is the maximum length os Description, the length measured to: ");
define("_ERROR8","Description contain one or more HTML-tags which are not permitted");
define("_ERROR9","Pragma tag can only have the value \"no-cache\"");
define("_ERROR10","Window-target tag can only have the value \"_top\"");
define("_ERROR11"," is not a valid word in ROBOTS tag");
define("_ERROR12","Robots have these valid combinations: <br>ALL, NONE, and combinations of INDEX, NOINDEX, FOLLOW and NOFOLLOW");
define("_ERROR13","\t not been validated as no validation rules have been coded");

?>