<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Top Sites V1.4                                                       */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/* sid@xanys.com                                                        */
/*                                                                      */
/* Based on Web Links Hack                                              */
//* Copyright (c) 2002 by Francisco Burzi                               */
/* http://phpnuke.org                                                   */
/*                                                                      */
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
/*                                                                      */
/* Platinum Nuke Pro: Your dreams, our imagination                      */
/************************************************************************/
##############################################################################
# This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com  #
#                                                                            #
# This program is free software. You can redistribute it and/or modify       #
# it under the terms of the GNU General Public License as published by       #
# the Free Software Foundation; either version 2 of the License.             #
##############################################################################

define_once("_TOPSINDEX","Top Sites");

define_once("_LINKSMAIN","Links Main");
define_once("_ADDLINK","Add Link");
define_once("_ADDALINK","Add a New Link");
define_once("_EDITLINK","Edit");
define_once("_NEW","New");
define_once("_LINKS","Links");
define_once("_TITLE","Title");
define_once("_NOTES","Note");
define_once("_DESCRIPTION","Description");
define_once("_EDIT","Edit");
define_once("_RATESITE","Rate this Site");
define_once("_ALLOWTORATE","Make a link");

define_once("_SELECTPAGE","Select Page");
define_once("_PREVIOUS","Previous Page");
define_once("_NEXT","Next Page");

define_once("_LINKSDATESTRING","%d-%b-%Y");
define_once("_ADDEDON","Added on");

define_once("_LDESCRIPTION","Description: (255 characters max)");
define_once("_PAGETITLE","Page Title");
define_once("_PAGEURL","Page URL");
define_once("_URLBAN","URL Banner");
define_once("_YOUREMAIL","Your Email");
define_once("_YOURNAME","Your Login");
define_once("_ADDURL","Add this URL");
define_once("_GOBACK","Back");

define_once("_LINKSNOTUSER1","You are not a registered user or you have not logged in.");
define_once("_LINKSNOTUSER2","If you were registered you could add links on this website.");
define_once("_LINKSNOTUSER3","<a href=\"modules.php?name=Your_Account\">Register for an Account</a>");

define_once("_MODALINK","Modify/Validate/Delete a link");
define_once("_NUMSITE","n°site");
define_once("_MODIFY","Modify");
define_once("_DEL","DELETE");

define_once("_LINKALREADYEXT","ERROR: This URL is already listed in the Database or is been in  waiting ofvalidation!");
define_once("_LINKNOTITLE","ERROR: You need to type a TITLE for your URL!");
define_once("_LINKNOURL","ERROR: You need to type a URL for your URL!");
define_once("_LINKNODESC","ERROR: You need to type a DESCRIPTION for your URL!");
define_once("_LINKRECEIVED","We received your Link submission. Thanks!");
define_once("_EMAILWHENADD","You'll receive and E-mail when it's approved.");
define_once("_CHECKFORIT","You didn't provide an Email address but we will check your link soon.");

define_once("_LINKID","Link ID");

define_once("_SEARCHRESULTS4","Search Results for");
define_once("_THEREARE","There are");
define_once("_NOMATCHES","No matches found to your query");
define_once("_INOTHERSENGINES","in others Search Engines");
define_once("_TRY2SEARCH","Try to search");

define_once("_PROMOTEYOURSITE","Promote Your Website");
define_once("_PROMOTE01","Maybe you can be interested in several of the remote 'Rate a Website' options we have available. These allow you to place an image (or even a rating form) on your web site in order to increase the number of votes your resource receive. Please choose from one of the options listed below:");
define_once("_TEXTLINK","Text Link");
define_once("_PROMOTE02","One way to link to the rating form is through a simple text link:");
define_once("_HTMLCODE1","The HTML code you should use in this case, is the following:");
define_once("_THENUMBER","The Number");
if(!isset($sitename)) $sitename = '';
define_once("_IDREFER","in the HTML source references your site's ID number in $sitename database. Be sure this number is present.");
define_once("_BUTTONLINK","Button Link");
define_once("_PROMOTE03","If you're looking for a little more than a basic text link, you may wish to use a small button link:");
define_once("_RATEIT","Rate this Site!");
define_once("_HTMLCODE2","The source code for the above button is:");
define_once("_REMOTEFORM","Remote Rating Form");
define_once("_PROMOTE04","If you cheat on this, we'll remove your link. Having said that, here is what the current remote rating form looks like.");
define_once("_VOTE4THISSITE","Vote for this Site!");
define_once("_LINKVOTE","Vote!");
define_once("_HTMLCODE3","Using this form will allow users to rate your resource directly from your site and the rating will be recorded here. The above form is disabled, but the following source code will work if you simply cut and paste it into your web page. The source code is shown below:");
define_once("_PROMOTE05","Thanks! and good luck with your ratings!");
define_once("_STAFF","Nuke Xanys team");
define_once("_VISITTHISSITE","Visit this Website");
define_once("_RATETHISSITE","Rate this Resource");

define_once("_COMPLETEVOTE1","Your vote is appreciated.");
define_once("_COMPLETEVOTE2","You have already voted for this URL !");
define_once("_COMPLETEVOTE3","Vote for a resource only once.<br>All votes are logged and reviewed.");
define_once("_COMPLETEVOTE4","You cannot vote on a link you submitted.<br>All votes are logged and reviewed.");
define_once("_COMPLETEVOTE5","No rating selected - no vote tallied");
if(!isset($outsidewaitdays)) $outsidewaitdays = '';
define_once("_COMPLETEVOTE6","Only one vote per IP address allowed every $outsidewaitdays day(s).");
define_once("_YOUCANVOTE","You can voteagain in");
define_once("_DAYS","day(s)");

define_once("_HITS","Hits");
define_once("_VOTE","Vote");
define_once("_VOTES","Votes");

define_once("_YOUAREREGGED","You are a registered user and are logged in.");
define_once("_YOUARENOTREGGED","You are not a registered user or you have not logged in.");
define_once("_IFYOUWEREREG","If you were registered you could make comments on this website.");
define_once("_WEBLINKS","Web Links");

//admin
define_once("_URL","URL");
define_once("_LINKNOTVALIDATE","Not validate links");
define_once("_LINKVALIDATE","Validate links");
define_once("_CLEANVOTES","Clean Links Votes");
define_once("_LINKTITLE","Link Title");
define_once("_YOURLINKAT","Your Link at");
define_once("_LINKAPPROVEDMSG","Your link is accepted.");
define_once("_THANKS4YOURSUBMISSION","Thanks for your submission!");
define_once("_TEAM","Team of Php-Nuke-Algérie.");
define_once("_ACTION","Action");
define_once("_APPROVE","Approve");
define_once("_DISAPPROVE","Disapprove");

//added on Feb,1, 2003
define_once("_ALLCATEGORIES","All categories");
define_once("_ALL","ALL");
define_once("_INCATEGORY","in category");
define_once("_CATEGORY","Category");
define_once("_NEWSITE","New link in Top Sites");
define_once("_HELLO","Hello");
define_once("_THE","the");
define_once("_LATEST","last");
define_once("_LATEST2","last sites");
define_once("_ADDED","Added on");
define_once("_AND","and");
define_once("_ADDCAT","Add category");
define_once("_MODIFYCAT","Modify category");
define_once("_PARAMETERS","Parameters");
define_once("_PARAMETERCONFIG","Configuration of options");
define_once("_CATEGORYEXIST","Present catgories");
define_once("_NAME","Name");
define_once("_ADD","Add");
define_once("_ERRORTHECATEGORY","Erroe, the category ");
define_once("_ALREADYEXIST","alreadyexist");
define_once("_THECATEGORY","The category ");
define_once("_ADDED2"," is added");
define_once("_MODIFIED"," is modified");
define_once("_DELETED"," is deleted");
define_once("_NOLINKTOVALIDATE","No link to validate !");
define_once("_SAVECHANGES","Save");

define_once("_PERPAGE","Nbr links per page");
define_once("_PERPAGE2","How many links to show on each page?");
define_once("_LINKSRESULT","Nbr links");
define_once("_LINKSRESULT2","How many links to display on each search result page?");
define_once("_ANONWAITDAYS","Nbr days before vote again");
define_once("_ANONWAITDAYS2","Number of days anonymous users need to wait to vote on a link");
define_once("_OUTSIDEWAITDAYS","Nbr days before vote again");
define_once("_OUTSIDEWAITDAYS2","Number of days outside users need to wait to vote on a link (checks IP)");
define_once("_USEOUTSIDEVOTING","Allow webmaster to link");
define_once("_USEOUTSIDEVOTING2","Allow Webmasters to put vote links on their site (1=Yes 0=No)");
define_once("_ANONWEIGHT","Ratio unregistered/ registered");
define_once("_ANONWEIGHT2","	How many Unregistered User vote per 1 Registered User Vote ?");
define_once("_OUTSIDEWEIGHT","Ratio outside user/ registered");
define_once("_OUTSIDEWEIGHT2","How many Outside User vote per 1 Registered User Vote?");
define_once("_CATEGORYOPTION","Categories System ?");
define_once("_CATEGORYOPTION2","Top Sites with categories system 1=Yes  0=No");
define_once("_MAXAFFICHAGE","Nbr max banners to display");
define_once("_MAXAFFICHAGE2","Number max of banners showed on topsite ");
define_once("_RECEIVEMAIL","Admin, receive email ?");
define_once("_RECEIVEMAIL2","Want to receive a mail when a user post a link ? 1=Yes  0=No");
define_once("_NUMLATEST","Nbr lnks");
define_once("_NUMLATEST2","How many links to show on 'latest links' ?");
define_once("_MAXIMAGEWIDTHSIZE","Width max (if resize images)");
define_once("_MAXIMAGEWIDTHSIZE2","Width maximum of banners, 468 by default");
define_once("_MAXIMAGEHEIGHTSIZE","Height max");
define_once("_MAXIMAGEHEIGHTSIZE2","Height maximum of banners, 60 by default (if resize images)");
define_once("_ALTERNATAVECOLOR1","Color 1");
define_once("_ALTERNATAVECOLOR1_2","Alternative color 1 in 'latest link'");
define_once("_ALTERNATAVECOLOR2","Color 2");
define_once("_ALTERNATAVECOLOR2_2","Alternative color 2 in 'latest link'");
define_once("_NOCATEGORYNAME","Error, rhe field 'category' is empty !");
define_once("_CLEANALLSITES","Delete all sites");
define_once("_GLOBALBILAN","Global stat");
define_once("_RESIZEIMAGE","Resize images");
define_once("_RESIZEIMAGE2","Resize images for total incorporationin design in your site ? 1=Yes  0=No");

// version 1.3
define_once("_HELPANDRULES","Rules and Assistances");
define_once("_RULES0","Our Top Sites doesn't accept racist or pornographic sites.<br>
                  Following the law, users could modify or delete their account.<br>
				  Admins could modify ordelete any account if it doesn't respect the politic of our site.<br> 
                  By submitting a link here, youaccept to receive newsletter concerning our Top sites or your stats
				  (will be an option in next versionof our Top Sites).<br>");
define_once("_RULES1","Option ' To erase after X jours' activated");
define_once("_RULES2","Votes are automatically erased every");
define_once("_RULES3","The next restoring are planned for");
define_once("_RULES4","Option ' Redimensionner images' activated (slowed down the operation of script)");
define_once("_RULES5","Option ' auto approval' activated");
define_once("_RULES6","A registered user can directly register his site without the validation by the admin");
define_once("_RULES7","The admin decided to activate the voting system per evaluation (notation)");
define_once("_RULES8","The admin decided to activate the voting system without evaluation (notation)");
define_once("_RULES9","The banners flash are authorized");
define_once("_RULES10","The banners flash are not authorized");
define_once("_RULES11","The option ' to insert automatically in the module Web_Link' activated");
define_once("_MAKEWEBLINK","Put a link towards the Web_Link module ?");
define_once("_MAKEWEBLINK2","Your link to Web_Link module");
define_once("_CATEGORY2","Category Web_Link directory");
define_once("_NOFLASHBANACCEPTED","The flash banners are not accepted");
define_once("_LINKFLASH","The link to put in your code flash is:");
define_once("_YOURLINKTOWEBLINK1","Your site are already registered in the Web_Link directory");
define_once("_YOURLINKTOWEBLINK2","Your site are also registered in the Web_Link directoryk");
define_once("_YOURRATELINK","Your codes to establish links towards your site");
define_once("_LINKAUTOADDED","Your proposal is automatically approved");
define_once("_PREVIEWBAN","Preview banner");
define_once("_MAKEWEBLINKREFUSED","Your link towards the Web_Links directory not approved for thismoment");
define_once("_MAKEWEBLINKREFUSED2","Refuse");
define_once("_MAKEWEBLINKAPPROVED","Your link is also present in the Web_Links directory");
define_once("_MAKEWEBLINKAPPROVED2","Approve");
define_once("_FIELDNOEMPTY","The fields title, description and URL should not be empty");
define_once("_LINKDELETED","The link is deleted !");
define_once("_REMOVELINK","Confirm the suppression of the link ?");
define_once("_VOTEDELETED","Votes are deleted !");
define_once("_REMOVEVOTE","Confirmthe suppression of the votes ?");
define_once("_HITSDELETED","Hits (OUT) are deleted !");
define_once("_REMOVEHITS","Confirmthe suppression of Hits (OUT) ?");
define_once("_CLEANSITES","All sites are deleted !");
define_once("_REMOVESITES","Confirm the suppression of sites ?");
define_once("_YES","Yes");
define_once("_NO","No");
define_once("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Back</a> ]");
define_once("_VALIDATE","Validate");
define_once("_ADMINRATE","Note of the admin");
define_once("_ADMINRATE2","The admin can evaluate itself your site");
define_once("_NEWSLETTER1","Newsletter");
define_once("_NEWSLETTER2","Message");
define_once("_NEWSLETTER3","Send their stats");
define_once("_NEWSLETTER4","SEND");
define_once("_NEWSLETTER5","Newsletter sent !");
define_once("_AUTOVALIDATION","Auto approval");
define_once("_AUTOVALIDATION2","The link are automatically approved ?");
define_once("_EVALUATIONORNOT","Evaluation of sites");
define_once("_EVALUATIONORNOT2","Evaluation (notation) of sites during votes ?");
define_once("_DELAFTERXDAYS","Auto reset of votes");
define_once("_DELAFTERXDAYS2","Automatic reset of the votes all X days");
define_once("_DELXDAYS","X days");
define_once("_DELXDAYS2","reset all X days");
define_once("_DATEDELETE","Next effacement");
define_once("_DATEDELETE2","Votes will be erased on this date");
define_once("_FLASHOPTION","Flash Banners ");
define_once("_FLASHOPTION2","Allow the users to put flas banners ");
define_once("_WEBLINKOPTION","Link to Web_Links directory");
define_once("_WEBLINKOPTION2","Allow to put a link towards the Web_Links directory");
define_once("_FIELDNONULL","The fields :<br>Nbr links per page<br>Nbr links search<br>Nbr links in 'last links'<br>Max width and max height<br> should not be null");

//version 1.4
define_once("_GIVEANOTE","Gine a note note between 1 and 10");
define_once("_CHOOSEANOTE","Choose a note by passing the mouse over the gauge");
define_once("_CLICKONOK","Click on OK to validate");
define_once("_NOYETSITE","Any site in Top Sites");
define_once("_NOYETSITEINTHISCAT","Any site in this catégory");
define_once("_RATINGNONULL","The not must not be null !");
define_once("_LATEST3","The 10 latest not validated links");
define_once("_NOTEBYJAVA","Notation by cursor and smilies");
define_once("_NOTEBYJAVA2","option notation by cursor and smilies (javascript)");
define_once("_REMOTEFORM2","Remote Rating Form by cursor (javascript)");
define_once("_CODEVOTEBYJSHERE","The code to put in your site is here !");
define_once("_PROMOTEVOTEBYJS","Notation by cursor and smiley.  You give the possibility to your visitors of choosing a note by a system simple, intuitive and attracting.");

define_once("_LASTRATING","Latest rating");
