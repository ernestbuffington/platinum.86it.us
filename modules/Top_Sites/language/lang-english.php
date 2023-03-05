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

define("_TOPSINDEX","Top Sites");

define("_LINKSMAIN","Links Main");
define("_ADDLINK","Add Link");
define("_ADDALINK","Add a New Link");
define("_EDITLINK","Edit");
define("_NEW","New");
define("_LINKS","Links");
define("_TITLE","Title");
define("_NOTES","Note");
define("_DESCRIPTION","Description");
define("_EDIT","Edit");
define("_RATESITE","Rate this Site");
define("_ALLOWTORATE","Make a link");

define("_SELECTPAGE","Select Page");
define("_PREVIOUS","Previous Page");
define("_NEXT","Next Page");

define("_LINKSDATESTRING","%d-%b-%Y");
define("_ADDEDON","Added on");

define("_LDESCRIPTION","Description: (255 characters max)");
define("_PAGETITLE","Page Title");
define("_PAGEURL","Page URL");
define("_URLBAN","URL Banner");
define("_YOUREMAIL","Your Email");
define("_YOURNAME","Your Login");
define("_ADDURL","Add this URL");
define("_GOBACK","Back");

define("_LINKSNOTUSER1","You are not a registered user or you have not logged in.");
define("_LINKSNOTUSER2","If you were registered you could add links on this website.");
define("_LINKSNOTUSER3","<a href=\"modules.php?name=Your_Account\">Register for an Account</a>");

define("_MODALINK","Modify/Validate/Delete a link");
define("_NUMSITE","n°site");
define("_MODIFY","Modify");
define("_DEL","DELETE");

define("_LINKALREADYEXT","ERROR: This URL is already listed in the Database or is been in  waiting ofvalidation!");
define("_LINKNOTITLE","ERROR: You need to type a TITLE for your URL!");
define("_LINKNOURL","ERROR: You need to type a URL for your URL!");
define("_LINKNODESC","ERROR: You need to type a DESCRIPTION for your URL!");
define("_LINKRECEIVED","We received your Link submission. Thanks!");
define("_EMAILWHENADD","You'll receive and E-mail when it's approved.");
define("_CHECKFORIT","You didn't provide an Email address but we will check your link soon.");

define("_LINKID","Link ID");

define("_SEARCHRESULTS4","Search Results for");
define("_THEREARE","There are");
define("_NOMATCHES","No matches found to your query");
define("_INOTHERSENGINES","in others Search Engines");
define("_TRY2SEARCH","Try to search");

define("_PROMOTEYOURSITE","Promote Your Website");
define("_PROMOTE01","Maybe you can be interested in several of the remote 'Rate a Website' options we have available. These allow you to place an image (or even a rating form) on your web site in order to increase the number of votes your resource receive. Please choose from one of the options listed below:");
define("_TEXTLINK","Text Link");
define("_PROMOTE02","One way to link to the rating form is through a simple text link:");
define("_HTMLCODE1","The HTML code you should use in this case, is the following:");
define("_THENUMBER","The Number");
define("_IDREFER","in the HTML source references your site's ID number in $sitename database. Be sure this number is present.");
define("_BUTTONLINK","Button Link");
define("_PROMOTE03","If you're looking for a little more than a basic text link, you may wish to use a small button link:");
define("_RATEIT","Rate this Site!");
define("_HTMLCODE2","The source code for the above button is:");
define("_REMOTEFORM","Remote Rating Form");
define("_PROMOTE04","If you cheat on this, we'll remove your link. Having said that, here is what the current remote rating form looks like.");
define("_VOTE4THISSITE","Vote for this Site!");
define("_LINKVOTE","Vote!");
define("_HTMLCODE3","Using this form will allow users to rate your resource directly from your site and the rating will be recorded here. The above form is disabled, but the following source code will work if you simply cut and paste it into your web page. The source code is shown below:");
define("_PROMOTE05","Thanks! and good luck with your ratings!");
define("_STAFF","Nuke Xanys team");
define("_VISITTHISSITE","Visit this Website");
define("_RATETHISSITE","Rate this Resource");

define("_COMPLETEVOTE1","Your vote is appreciated.");
define("_COMPLETEVOTE2","You have already voted for this URL !");
define("_COMPLETEVOTE3","Vote for a resource only once.<br>All votes are logged and reviewed.");
define("_COMPLETEVOTE4","You cannot vote on a link you submitted.<br>All votes are logged and reviewed.");
define("_COMPLETEVOTE5","No rating selected - no vote tallied");
define("_COMPLETEVOTE6","Only one vote per IP address allowed every $outsidewaitdays day(s).");
define("_YOUCANVOTE","You can voteagain in");
define("_DAYS","day(s)");

define("_HITS","Hits");
define("_VOTE","Vote");
define("_VOTES","Votes");

define("_YOUAREREGGED","You are a registered user and are logged in.");
define("_YOUARENOTREGGED","You are not a registered user or you have not logged in.");
define("_IFYOUWEREREG","If you were registered you could make comments on this website.");
define("_WEBLINKS","Web Links");

//admin
define("_URL","URL");
define("_LINKNOTVALIDATE","Not validate links");
define("_LINKVALIDATE","Validate links");
define("_CLEANVOTES","Clean Links Votes");
define("_LINKTITLE","Link Title");
define("_YOURLINKAT","Your Link at");
define("_LINKAPPROVEDMSG","Your link is accepted.");
define("_THANKS4YOURSUBMISSION","Thanks for your submission!");
define("_TEAM","Team of Php-Nuke-Algérie.");
define("_ACTION","Action");
define("_APPROVE","Approve");
define("_DISAPPROVE","Disapprove");

//added on Feb,1, 2003
define("_ALLCATEGORIES","All categories");
define("_ALL","ALL");
define("_INCATEGORY","in category");
define("_CATEGORY","Category");
define("_NEWSITE","New link in Top Sites");
define("_HELLO","Hello");
define("_THE","the");
define("_LATEST","last");
define("_LATEST2","last sites");
define("_ADDED","Added on");
define("_AND","and");
define("_ADDCAT","Add category");
define("_MODIFYCAT","Modify category");
define("_PARAMETERS","Parameters");
define("_PARAMETERCONFIG","Configuration of options");
define("_CATEGORYEXIST","Present catgories");
define("_NAME","Name");
define("_ADD","Add");
define("_ERRORTHECATEGORY","Erroe, the category ");
define("_ALREADYEXIST","alreadyexist");
define("_THECATEGORY","The category ");
define("_ADDED2"," is added");
define("_MODIFIED"," is modified");
define("_DELETED"," is deleted");
define("_NOLINKTOVALIDATE","No link to validate !");
define("_SAVECHANGES","Save");

define("_PERPAGE","Nbr links per page");
define("_PERPAGE2","How many links to show on each page?");
define("_LINKSRESULT","Nbr links");
define("_LINKSRESULT2","How many links to display on each search result page?");
define("_ANONWAITDAYS","Nbr days before vote again");
define("_ANONWAITDAYS2","Number of days anonymous users need to wait to vote on a link");
define("_OUTSIDEWAITDAYS","Nbr days before vote again");
define("_OUTSIDEWAITDAYS2","Number of days outside users need to wait to vote on a link (checks IP)");
define("_USEOUTSIDEVOTING","Allow webmaster to link");
define("_USEOUTSIDEVOTING2","Allow Webmasters to put vote links on their site (1=Yes 0=No)");
define("_ANONWEIGHT","Ratio unregistered/ registered");
define("_ANONWEIGHT2","	How many Unregistered User vote per 1 Registered User Vote ?");
define("_OUTSIDEWEIGHT","Ratio outside user/ registered");
define("_OUTSIDEWEIGHT2","How many Outside User vote per 1 Registered User Vote?");
define("_CATEGORYOPTION","Categories System ?");
define("_CATEGORYOPTION2","Top Sites with categories system 1=Yes  0=No");
define("_MAXAFFICHAGE","Nbr max banners to display");
define("_MAXAFFICHAGE2","Number max of banners showed on topsite ");
define("_RECEIVEMAIL","Admin, receive email ?");
define("_RECEIVEMAIL2","Want to receive a mail when a user post a link ? 1=Yes  0=No");
define("_NUMLATEST","Nbr lnks");
define("_NUMLATEST2","How many links to show on 'latest links' ?");
define("_MAXIMAGEWIDTHSIZE","Width max (if resize images)");
define("_MAXIMAGEWIDTHSIZE2","Width maximum of banners, 468 by default");
define("_MAXIMAGEHEIGHTSIZE","Height max");
define("_MAXIMAGEHEIGHTSIZE2","Height maximum of banners, 60 by default (if resize images)");
define("_ALTERNATAVECOLOR1","Color 1");
define("_ALTERNATAVECOLOR1_2","Alternative color 1 in 'latest link'");
define("_ALTERNATAVECOLOR2","Color 2");
define("_ALTERNATAVECOLOR2_2","Alternative color 2 in 'latest link'");
define("_NOCATEGORYNAME","Error, rhe field 'category' is empty !");
define("_CLEANALLSITES","Delete all sites");
define("_GLOBALBILAN","Global stat");
define("_RESIZEIMAGE","Resize images");
define("_RESIZEIMAGE2","Resize images for total incorporationin design in your site ? 1=Yes  0=No");

// version 1.3
define("_HELPANDRULES","Rules and Assistances");
define("_RULES0","Our Top Sites doesn't accept racist or pornographic sites.<br>
                  Following the law, users could modify or delete their account.<br>
				  Admins could modify ordelete any account if it doesn't respect the politic of our site.<br> 
                  By submitting a link here, youaccept to receive newsletter concerning our Top sites or your stats
				  (will be an option in next versionof our Top Sites).<br>");
define("_RULES1","Option ' To erase after X jours' activated");
define("_RULES2","Votes are automatically erased every");
define("_RULES3","The next restoring are planned for");
define("_RULES4","Option ' Redimensionner images' activated (slowed down the operation of script)");
define("_RULES5","Option ' auto approval' activated");
define("_RULES6","A registered user can directly register his site without the validation by the admin");
define("_RULES7","The admin decided to activate the voting system per evaluation (notation)");
define("_RULES8","The admin decided to activate the voting system without evaluation (notation)");
define("_RULES9","The banners flash are authorized");
define("_RULES10","The banners flash are not authorized");
define("_RULES11","The option ' to insert automatically in the module Web_Link' activated");
define("_MAKEWEBLINK","Put a link towards the Web_Link module ?");
define("_MAKEWEBLINK2","Your link to Web_Link module");
define("_CATEGORY2","Category Web_Link directory");
define("_NOFLASHBANACCEPTED","The flash banners are not accepted");
define("_LINKFLASH","The link to put in your code flash is:");
define("_YOURLINKTOWEBLINK1","Your site are already registered in the Web_Link directory");
define("_YOURLINKTOWEBLINK2","Your site are also registered in the Web_Link directoryk");
define("_YOURRATELINK","Your codes to establish links towards your site");
define("_LINKAUTOADDED","Your proposal is automatically approved");
define("_PREVIEWBAN","Preview banner");
define("_MAKEWEBLINKREFUSED","Your link towards the Web_Links directory not approved for thismoment");
define("_MAKEWEBLINKREFUSED2","Refuse");
define("_MAKEWEBLINKAPPROVED","Your link is also present in the Web_Links directory");
define("_MAKEWEBLINKAPPROVED2","Approve");
define("_FIELDNOEMPTY","The fields title, description and URL should not be empty");
define("_LINKDELETED","The link is deleted !");
define("_REMOVELINK","Confirm the suppression of the link ?");
define("_VOTEDELETED","Votes are deleted !");
define("_REMOVEVOTE","Confirmthe suppression of the votes ?");
define("_HITSDELETED","Hits (OUT) are deleted !");
define("_REMOVEHITS","Confirmthe suppression of Hits (OUT) ?");
define("_CLEANSITES","All sites are deleted !");
define("_REMOVESITES","Confirm the suppression of sites ?");
define("_YES","Yes");
define("_NO","No");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Back</a> ]");
define("_VALIDATE","Validate");
define("_ADMINRATE","Note of the admin");
define("_ADMINRATE2","The admin can evaluate itself your site");
define("_NEWSLETTER1","Newsletter");
define("_NEWSLETTER2","Message");
define("_NEWSLETTER3","Send their stats");
define("_NEWSLETTER4","SEND");
define("_NEWSLETTER5","Newsletter sent !");
define("_AUTOVALIDATION","Auto approval");
define("_AUTOVALIDATION2","The link are automatically approved ?");
define("_EVALUATIONORNOT","Evaluation of sites");
define("_EVALUATIONORNOT2","Evaluation (notation) of sites during votes ?");
define("_DELAFTERXDAYS","Auto reset of votes");
define("_DELAFTERXDAYS2","Automatic reset of the votes all X days");
define("_DELXDAYS","X days");
define("_DELXDAYS2","reset all X days");
define("_DATEDELETE","Next effacement");
define("_DATEDELETE2","Votes will be erased on this date");
define("_FLASHOPTION","Flash Banners ");
define("_FLASHOPTION2","Allow the users to put flas banners ");
define("_WEBLINKOPTION","Link to Web_Links directory");
define("_WEBLINKOPTION2","Allow to put a link towards the Web_Links directory");
define("_FIELDNONULL","The fields :<br>Nbr links per page<br>Nbr links search<br>Nbr links in 'last links'<br>Max width and max height<br> should not be null");

//version 1.4
define("_GIVEANOTE","Gine a note note between 1 and 10");
define("_CHOOSEANOTE","Choose a note by passing the mouse over the gauge");
define("_CLICKONOK","Click on OK to validate");
define("_NOYETSITE","Any site in Top Sites");
define("_NOYETSITEINTHISCAT","Any site in this catégory");
define("_RATINGNONULL","The not must not be null !");
define("_LATEST3","The 10 latest not validated links");
define("_NOTEBYJAVA","Notation by cursor and smilies");
define("_NOTEBYJAVA2","option notation by cursor and smilies (javascript)");
define("_REMOTEFORM2","Remote Rating Form by cursor (javascript)");
define("_CODEVOTEBYJSHERE","The code to put in your site is here !");
define("_PROMOTEVOTEBYJS","Notation by cursor and smiley.  You give the possibility to your visitors of choosing a note by a system simple, intuitive and attracting.");

define("_LASTRATING","Latest rating");
?>
