<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

// 7612

define("_PREVIEWAPPROVE","Preview");

// Main Admin Header

define("_ADADMINMENU","Administration Main");
define("_ADVERSIONCHECK","Version Check");
define("_ADPHPVERSION","PHP Version");
define("_ADMYSQLVERSION","MySQL Version");
define("_ADPRODUCTNAME","Product");

// Module Statistics

define("_ADSTATUS","Current Module Status");
define("_ADTOTALCAT","Total Categories");
define("_ADTOTALITEMS","Total Items");
define("_ADTOTALWAITING","Total Waiting Items");
define("_ADTOTALREQUESTS","Total Requests");
define("_ADTOTALREQUESTSW","Total Requests Waiting");
define("_ADWAITINGMODS","Waiting Modifications");
define("_ADMODREQUESTSSW","Modifications Pending");
define("_ADRLINKS","Related Links");

// Admin Nav Block

define("_ADCONFIG","Configuration");
define("_ADCENSORLIST","Word Censor List");
define("_AUTOAPPROVE","User Auto Approve");
define("_ADADDNEWCAT2","Catagory Management");
define("_ADREQUESTADMIN","Request Admin");
define("_ADRELATEDADMIN","Related Link Admin.");
define("_ADMODIFYITEM","Modify Existing Item");
define("_ADDELETEITEM","Delete Existing Item");
define("_ACTIVEDEACTIVE","Active/Deactivate Items");
define("_ADADDNEWITEM","Add New Entry");
define("_ADMODIFYITEM","Modify Existing Item");
define("_ADDELETEITEM","Delete Existing Item");
define("_ADITEMQUEUE","Waiting Item Queue");
define("_UPLOADIMAGE","Image Upload");

// Module Links Block

define("_ADMAININDEX","Main Index");
define("_ADSUBMITITEM","Submit Item");
define("_ADTOPRATED","Top Rated");
define("_ADRANDOMITEM","Random Item");
define("_ADMOSTWANTED","Most Wanted");

define("_ADMESSAGE","<strong><i><u>What is the Universal Module??</u></i></strong><br><br>
		The Universal Module is at its heart a content listing module, while originally designed to 
		display (and in some ways still is {RE: Most Wanted System}) you can make it 
		display anything just by altering the language files.<br><br>This new version of the 
		Universal Module makes use of the same style options (bbcode) as
		<a target=\"_blank\" href=\"http://www.phpbb.com\">phpBB</a> to add images, links, 
		and other style options making it very easy to add content. <br><br><strong><i><u>How to use the 
		Universal Module??</u></i></strong><br><br>It is very easy to use this module, just navigate around in 
		the admin area with the links on the right side. <a href=\"modules.php?name=$modulename\">
		The main module</a> is also that easy to navigate around and to use. <br><br>
		<strong><i><u>How about Copyright??</u></i></strong><br><br><strong>DISPLAY OF COPYRIGHT NOTICES REQUIRED</strong><br>
		All copyright notices used within the module that the module generate, MUST remain 
		intact. Furthermore, these notices must remain visible. The module license does not imply 
		license to resell or redistribute any of those items without expressed permission.<br><br>
		<strong>MODIFICATION AND DISTRIBUTION</strong><br>Users may alter or modify the module at their own risk, but 
		only for their own use. You may also hire me to modify your own copy of the module. <br><br>
		Although users may modify the code for their use, modified code may not be sold or 
		distributed, without express written permission from me. This prohibition applies to both my 
		altered code and any new code developed by users specifically for use with my modules. <br><br>
		<strong><i><u>How can I support you??</u></i></strong><br><br>If you like my work and you want 
		to give me some support, you can donate through paypal to keep the developing and such going by 
		clicking the button below: <center>
		<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">
		<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
		<input type=\"hidden\" value=\"bcaplin@hypermax.net.au\" name=\"business\">
		<input type=\"hidden\" value=\"Universal Module Donation\" name=\"item_name\">
		<input type=\"image\" alt=\"Make payments with PayPal - it's fast, free and secure!\" 
		src=\"modules/$modulename/images/paypal5.png\" border=\"0\" name=\"submit\"> 
		</form></center><p><i>If you follow these rules, there will be no problems :D,<br>
		<strong>Barry Caplin<br>Developer of the Universal Module.</strong></i>");

// Configuration Setttings

define("_MAINCMESS","Universal Module Configuration");
define("_MODTITLE","Module Title");
define("_RIGHTBLOCKS","Right Blocks");
define("_LOGOIMAGE","Logo Image");
define("_ITEMSPERPAGE","Items Per Page");
define("_ALLOWUSERSUBMIT","Allow User Submit");
define("_ITEMSONPAGE","How many items on new page");
define("_VIEWSPOPULAR","Views for a item to be popular");
define("_ONPOPULARPAGE","How many items on Popular Page");
define("_MAXSEARCHRESULTS","Maximum Search Results Displayed");
define("_SHOWITEMQUEUE","Show Waiting Item Queue on Index");
define("_ONLYREGUSERS","Only Registered Users can submit Items");
define("_SUBMITMODIFYR","Allow Users to Submit Modify Requests");
define("_IMAGEUPLOADUSERS","Allow Image Upload for Users");
define("_RESTRICTIMAGEUPLOAD","Restrict Image Upload to Registered Users");
define("_ALLOWCOMMENTS","Allow Comment Posting");
define("_RESTRICTCOMMENTS","Restrict Comment Posting to Registered Users");
define("_MAXTOPRATED","Max. Num of Items on Top Rated Page");
define("_MAINPREFIX","Main Database Prefix");
define("_MOSTPOPBLOCK","Most Popular Block On Module Index");
define("_NEWBLOCK","New Block on Module Index");
define("_MAXSUBCATS","Max. Sub-Categories displayed under a main one");
define("_ALLOWRATINGS","Allow Items to be rated");
define("_MOSTWANTEDSYSTEM","Most Wanted System");
define("_MWPOSTINGLEVEL","Most Wanted System Posting Level");
define("_SORTBYTYPE","Sort By Type");
define("_MWPERPAGE","Items Per Page for Most Wanted Section");
define("_SAVESETTINGS","Save Settings");
define("_ADYES","Yes");
define("_ADNO","No");
define("_ADON","On");
define("_ADOFF","Off");
define("_EVERYONE","Everyone");
define("_REGUSERS","Reg. Users");
define("_DROPDOWNBOX","Drop-Down Box");
define("_TEXTLINKS","Text Links");
define("_QUICKVIEW","Quickview on Module Index");
define("_QUICKVIEWNUM","Number of Items the Quickview Function Displays");
define("_RANDOMQUICK","Make Quickview display random items");
define("_QVARTICLE","Quickview displays a sample of content");
define("_QVACHARLIMIT","Number of characters that quickview displays of the content");
define("_CATUSEDESCRIP","Category index displays Items Description, if not a content sample");
define("_LIMITMODREQUESTS","Limit Modifcation Requests to the user who submitted the item");
define("_JSCHECKING","Disable checking for author and website when submitting items");
define("_USEPHPBBNUMBERING","Enable phpBB Style page numbering");
define("_USEMULTILINGUELFEATURE","Enable Multilinguel Feature");
define("_NOSUBCATS","Disable Sub Categories");

// Confirmation Entries

define("_ADSETTINGSUPDATED","Module configuration settings have been updated");
define("_ADADDEDCWORD","Chosen word has been added to the censor list");
define("_ADSAVEDCWORD","The censor list has been updated");
define("_ADDELETEDCWORD","Censor word has been deleted");
define("_CATEGORYSAVED","Category has been saved");
define("_CATDELETE1","Selected Category has been deleted.");
define("_CATDELETE2","Selected Category and sub-categories have been deleted.");
define("_SUBCATADDED","Sub-Category has been added.");
define("_NEWCATADDED","New Category has been added.");
define("_REQUESTADDED","Item Request has been added.");
define("_REQUESTDELETED","Item Request has been deleted");
define("_RELATEDLADDED","Related Link has been added and attached to the requested item");
define("_RELATEDLSAVED","Related Link has been sucessfully modified");
define("_RELATEDLDELETED","Related Link has been deleted.");
define("_ITEMADDEDC","Item has been sucessfully added.");
define("_ITEMDELETED","Selected Item has been deleted");
define("_ITEMSAVED","Modifications to selected item have been saved");
define("_ITEMACTIVATED","Selected item is now active");
define("_ITEMDEACTIVATED","Selected item is now deactivated");
define("_ITEMAPPROVED","Selected Item has been added to the database");
define("_ITEMQDELETED","Selected Item has been deleted from the queue");
define("_ITEMRAPPROVED","Item Modification Request has been approved. Item has been updated");
define("_ITEMRDELETED","Itm Modification Request has been deleted");
define("_IMAGEUPLOADC","Selected Image has been uploaded");

// Censor List

define("_CLWORD","Word");
define("_CLFUNCTIONS","Functions");
define("_CLEDIT","Edit");
define("_CLDELETE","Delete");
define("_CLADDWORD","Add a word to the censor list");
define("_CLADDWORD2","Add Word");
define("_CLEDITINGWORD","Editing Censor Word");
define("_CLCENSORWORD","Censor Word");
define("_CLSAVECHANGES","Save Changes");
define("_CLDELETINGWORD","Deleting Censor Word");
define("_CLDELTEINGWORD2","Are you sure you wish to delete the censor word");
define("_CLACTIONUNDONE","This action cannot be undone");

// Used in any function

define("_RYES","Yes");
define("_RNO","No");

// Auto-Approve User Control

define("_THEUSER","The User");
define("_USERADDED","was added to the auto-approve list. All submissions from this user will be automactially approved");
define("_USERDOESNTEXITS","does not exist in the database. Please check the spelling and try again");
define("_HASBEENREMOVED","has been removed from the auto-approve users list");
define("_USERSFOUND","The following user(s) that match your search request have been found");
define("_ADDUSERBUTTON","Add User");
define("_NORESULTS","No results found for");
define("_ADDANUSER","Add A User");
define("_SEARCHFORUSER","Or Search for a user");
define("_SEARCHBUTTON","Search");
define("_SEARCHPMATCHES","Partial Matches");
define("_SEARCHAMATCHES","All Matches");
define("_UCUSERNAME","Username");

// Edit Category

define("_ADEDITCAT","Edit/Delete Category");
define("_ADCAT","Category");
define("_ADEDIT","Edit");
define("_ADDELETE","Delete");
define("_EDITACAT","Edit a Category");
define("_ID","ID");
define("_SAVECHANGES","Save Changes");
define("_DELCAT","Delete Category");
define("_NCATITLE","Title");
define("_NCADESCRIP","Description");
define("_ADGOBUTTON","Go");

// Add New Category

define("_ADADDNEWCAT","A New Category");
define("_ADTITLE","Title");
define("_ADDESCRIP","Description");
define("_ADADD","Add");

// New Sub Cat

define("_ADNEWSUBCAT","A New Sub-Category");
define("_ADPCAT","Parent Category");

// Category Deletation

define("_DELCAT","Delete Category");
define("_DELETE1","Delete Category");
define("_DELETECONFIRM","Are you sure you wish to delete category");
define("_DELETEWARNBIG","WARNING");
define("_NOTE2","If you delete a Main Category, all sub-categories under it will be deleted too.");
define("_DELETE2","This action cannot be undone.");

// Request Administration

define("_APPROVEREQUEST","Approve");
define("_RSUBMIT","Submitter");

// Item Queue

define("_SUBMITTER","Submitter");
define("_FUNCTION","Functions");
define("_PREVIEW","Preview");
define("_DELETEITEMTOP","Delete a item");
define("_DELETEITEM","Are you sure you wish to delete item");

// Related Link System

define("_ADDRELATED","Add Related Link");
define("_ADDRELATED2","Adding a Related Link");
define("_EDITRLINK","Editing Related Link");
define("_LINKTITLE","Link Title");
define("_LINKURL","Link URL");
define("_SAVERELATED","Save Related Link");
define("_DELRELATEDLINK","Are you sure you wish to delete the Related Link");
define("_ATTACHEDITEM","Attached to the Item");
define("_WARNINGBIG","WARNING");
define("_WARNMESS","This action cannot be undone");
define("_RLINKTITLE","Related Links Stored in the Database.");
define("_RLINK","Related Link");
define("_RATTACHED","Item its Attached To");
define("_RFUNCTIONS","Functions");
define("_RITEM","Content");
define("_RYES","Yes");
define("_RNO","No");
define("_SELECTCAT","Please select a category first");
define("_SWITCHWARNING","WARNING: If you have altered Link Title/Address, you will lose altered the values when switching categories.");

// BBCode Stuff

define("_TUTBBCODE", "Code");
define("_TUTBBQUOTE", "Quote");
define("_TUTBBWROTE", "Wrote");
define("_TUTBBDARKRED", "Dark Red");
define("_TUTBBRED", "Red");
define("_TUTBBORANGE", "Orange");
define("_TUTBBBROWN", "Brown");
define("_TUTBBYELLOW", "Yellow");
define("_TUTBBGREEN", "Green");
define("_TUTBBOLIVE", "Olive");
define("_TUTBBCYAN", "Cyan");
define("_TUTBBBLUE", "Blue");
define("_TUTBBDARKBLUE", "Dark Blue");
define("_TUTBBINDIGO", "Indigo");
define("_TUTBBVIOLET", "Violet");
define("_TUTBBWHITE", "White");
define("_TUTBBBLACK", "Black");
define("_TUTBBFONTCOLOR", "Font Color");
define("_TUTBBTINY", "Tiny");
define("_TUTBBSMALL", "Small");
define("_TUTBBNORMAL", "Normal");
define("_TUTBBLARGE", "Large");
define("_TUTBBHUGH", "Hugh");
define("_TUTBBFONTSIZE", "Font Size");
define("_TUTBBFONTDEFAULT", "Default Font");

// Misc

define("_MODIFY","Modify");
define("_INSERTPB","Insert Pagebreak");
define("_SNORESULTS","No results where found for your query");
define("_SFRESULTS","The following results where return for your query");
define("_PREVIEWIMAGE","Preview Image");
define("_ITEMACTIVATE","Activate");
define("_ITEMDEACTIVEATE","Deactivate");

// Upload an Image

define("_UPLOADANIMAGE","Upload an Image");
define("_SELECTIMAGE","Please select an image to be uploaded");
define("_UPLOADIMAGE","Upload Image");
define("_UPIERROR","Error: You must select a valid image file to upload");

// Comments Control

define("_EDITINGCOMMENT","Editing Comment");
define("_COMMENT","Comment");
define("_EDITCOMMENT","Edit Comment");
define("_DELETINGCOMMENT","Deleting Comment");
define("_COMAREYOUSURE","Are you sure you wish to delete the comment");

?>