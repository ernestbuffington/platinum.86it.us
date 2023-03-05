<?php

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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

global $module_name, $tutconfig, $admin_file;
#
###MAIN LANGUAGE DEFINITIONS
#
define("_TUTMAINTUTMODULE","Tutorials");
define("_TUTMAINTUTORIALSMAIN","Tutorials Main");
define("_TUTMAINNEW","Latest Tutorials");
define("_TUTMAINPOPULAR","Popular Tutorials");
define("_TUTMAINTOPRATED","Top Rated Tutorials");
define("_TUTADMIN_PANEL","Admin Panel");
define("_TUTMAINTUTORIALSMAINCAT","Tutorials Main Categories");
define("_TUTMAINTHEREARE","There are");
define("_TUTMAINTUTORIALS","Tutorials");
define("_TUTMAINAND","and");
define("_TUTMAININDB","in our database");
define("_TUTMAINTUTCATEGORIES","Categories");
define("_TUTMAINCATEGORY","Category");
define("_TUTMAINMAIN","Main");
define("_TUTMAINSORTTUTORIALSBY","Sort Tutorials by");
define("_TUTMAINPOPULARITY1","Popularity (Least to Most Hits)");
define("_TUTMAINPOPULARITY2","Popularity (Most to Least Hits)");
define("_TUTMAINTITLEAZ","Title (A to Z)");
define("_TUTMAINTITLEZA","Title (Z to A)");
define("_TUTMAINRATING1","Rating (Lowest Scores to Highest Scores)");
define("_TUTMAINRATING2","Rating (Highest Scores to Lowest Scores)");
define("_TUTMAINTITLE","Title");
define("_TUTMAINDDATE1","Date (Old Tutorials Listed First)");
define("_TUTMAINDDATE2","Date (New Tutorials Listed First)");
define("_TUTMAINDATE","Date");
define("_TUTMAINRATING","Rating");
define("_TUTMAINPOPULARITY","Popularity");
define("_TUTMAINRESSORTED","Resources currently sorted by");
define("_TUTMAINVERSION","Version");
define("_TUTMAINDESCRIPTION","Description");
define("_TUTMAINAUTHOR","Author");
define("_TUTMAINHOMEPAGE","HomePage");
define("_TUTMAINADDEDON","Added on");
define("_TUTMAINVIEWS","Views");
define("_TUTMAINLINKSDATESTRING","%d-%B-%Y");
define("_TUTMAINVOTE","Vote");
define("_TUTMAINVOTES","Votes");
define("_TUTMAINRATERESOURCE","Rate Resource");
define("_TUTMAINMODIFYRESOURCE","Modification Request");
define("_TUTMAINSCOMMENTS","Comments");
define("_TUTMAINSELECTPAGE","Select Page");
define("_TUTMAINPREVIOUS","Previous Page");
define("_TUTMAINNEXT","Next Page");
define("_TUTMAINRATENOTE1","Please do not vote for the same resource more than once.");
define("_TUTMAINRATENOTE2","The scale is 1 - 10, with 1 being poor and 10 being excellent.");
define("_TUTMAINRATENOTE3","Please be objective in your vote, if everyone receives a 1 or a 10, the ratings aren't very useful.");
define("_TUTMAINRATENOTE5","Do not vote for your own resource or a competitor's.");
define("_TUTMAINDRATENOTE4","You can view a list of the <a href=\"modules.php?name=".$module_name."&amp;t_op=TopTutorials\">Top Rated Tutorials</a>.");
define("_TUTMAINYOUAREREGGED","You are a registered user and are logged in.");
define("_TUTMAINFEELFREE2ADD","Feel free to add a comment about this resource.");
define("_TUTMAINYOUARENOTREGGED","You are not a registered user or you have not logged in.");
define("_TUTMAINIFYOUWEREREG","If you were registered you could make comments on this resource.");
define("_TUTMAINVIEWTUTORIAL","View Tutorial");
define("_TUTMAINTHANKSTOTAKETIME","Thank you for taking the time to rate a tutorial here at");
define("_TUTMAINDLETSDECIDE","Input from users such as yourself will help other visitors better decide which Tutorials to view.");
define("_TUTMAINTUTORIALCOMMENTS","Tutorial Comments");
define("_TUTMAINCOMPLETEVOTE1","Your vote is appreciated.");
define("_TUTMAINCOMPLETEVOTE2","You have already voted for this resource in the past ".$tutconfig['anonwaitdays']." day(s).");
define("_TUTMAINCOMPLETEVOTE3","Vote for a resource only once.<br>All votes are logged and reviewed.");
define("_TUTMAINCOMPLETEVOTE4","You cannot vote on a link you submitted.<br>All votes are logged and reviewed.");
define("_TUTMAINCOMPLETEVOTE5","No rating selected - no vote tallied");
define("_TUTMAINTUTORIALPROFILE","Tutorial Profile");
define("_TUTMAINTOTALOF","Total of");
define("_TUTMAINUSER","User");
define("_TUTMAINUSERAVGRATING","User's Average Rating");
define("_TUTMAINNUMRATINGS","# of Ratings");
define("_TUTMAINSHOWTOP","Show Top");
define("_TUTMAINMOSTPOPULAR","Most Popular - Top");
define("_TUTMAINNEWTODAY","New Today");
define("_TUTMAINNEWLAST3DAYS","New last 3 days");
define("_TUTMAINNEWTHISWEEK","New This Week");
define("_TUTMAINCATNEWTODAY","New Tutorials in this Category Added Today");
define("_TUTMAINCATLAST3DAYS","New Tutorials in this Category Added in the last 3 days");
define("_TUTMAINCATTHISWEEK","New Tutorials in this Category Added this week");
define("_TUTMAINBESTRATED","Best Rated Tutorials - Top");
define("_TUTMAINRATEDTUTORIALS","total rated Tutorials");
define("_TUTMAINOF","of");
define("_TUTMAINNOTE","Note");
define("_TUTMAINVOTESREQ","minimum votes required");
define("_TUTMAINNEWTUTORIALS","New Tutorials");
define("_TUTMAINTOTALNEWTUTORIALS","Total New Tutorials");
define("_TUTMAINTOTALFORLAST","Total new Tutorials for last");
define("_TUTMAINLASTWEEK","Last Week");
define("_TUTMAINLAST30DAYS","Last 30 Days");
define("_TUTMAIN1WEEK","1 Week");
define("_TUTMAIN2WEEKS","2 Weeks");
define("_TUTMAIN30DAYS","30 Days");
define("_TUTMAINSHOW","Show");
define("_TUTMAINDAYS","days");
define("_TUTMAINSEARCH","Search");
define("_TUTMAINSEARCHRESULTS4","Search Results for");
define("_TUTMAINUSUBCATEGORIES","Sub-Categories");
define("_TUTMAINNOMATCHES","No matches found to your query");
define("_TUTMAINPAGE","Page");
define("_TUTMAINVIEWCOMMENTS","View Comments");
define("_TUTMAINMODIFYINADMIN","Edit in AdminPanel");
define("_TUTMAINTUTORIALPROFILE","Tutorial Profile");
define("_TUTMAINTUTORIALRATINGDET","Download Rating Details");
define("_TUTMAINTOTALVOTES","Total Votes:");
define("_TUTMAINOVERALLRATING","Overall Rating:");
define("_TUTMAINADDITIONALDET","Additional Tutorials Details");
define("_TUTMAINREGISTEREDUSERS","Registered Users");
define("_TUTMAINNUMBEROFRATINGS","Number of Ratings");
define("_TUTMAINNOREGUSERSVOTES","No Registered User Votes");
define("_TUTMAINBREAKDOWNBYVAL","Breakdown of Ratings by Value");
define("_TUTMAINLTOTALVOTES","total votes");
define("_TUTMAINLVOTES","votes");
define("_TUTMAINTUTORIALRATING","Tutorials Rating");
define("_TUTMAINHIGHRATING","High Rating");
define("_TUTMAINLOWRATING","Low Rating");
define("_TUTMAINNUMOFCOMMENTS","Number of Comments");
define("_TUTMAINWEIGHNOTE","<strong>*Note:</strong> This Resource weighs Registered vs. Unregistered users ratings");
define("_TUTMAINNOUNREGUSERSVOTES","No Unregistered User Votes");
define("_TUTMAINTO","to");
define("_TUTMAINUNREGISTEREDUSERS","Unregistered Users");
define("_TUTMAINFULLPROFILE","Detailed Profile");
define("_TUTMAINTUTORIALTITLE","Tutorial Title");
define("_TUTMAINFAVREMOVE","Remove");
define("_TUTMAINFAVREMOVE2","Remove from List");
define("_TUTMAINFAVTOP5","Top 5");
define("_TUTMAINADDTOP5","Add to Top 5");
define("_TUTMAINREMOVETOP5","Remove from Top 5");
define("_TUTMAINGO","Go");
define("_TUTMAINFAVORITE","Favorite Tutorials");
define("_TUTMAINADDFAV","Add to Favorites");
define("_TUTMAINSUREREMOVEFAV","Are you sure you want to remove Favorite");
define("_TUTMAINFAV","Favorite");
define("_TUTMAINFROMTOP5","from Top 5");
define("_TUTMAINSUCREMOVED","The Tutorial has been succesfully removed from your Favorites List<br><br>You will be redirected within in a few seconds, if not click <a href=\"modules.php?name=".$module_name."&t_op=FavoriteTutorials\">here</a>");
define("_TUTMAINSUCREMOVEDT5","The Tutorial has been succesfully removed from your Top 5<br><br>You will be redirected within in a few seconds, if not click <a href=\"modules.php?name=".$module_name."&t_op=FavoriteTutorials\">here</a>");
define("_TUTMAINSUCADDEDT5","The Tutorial has been succesfully added to your Top 5<br><br>You will be redirected within in a few seconds, if not click <a href=\"modules.php?name=".$module_name."&t_op=FavoriteTutorials\">here</a>");
define("_TUTMAINALREADY5","You already have 5 Tutorials listed in the top 5, you need to remove 1 first before you can add this one.");
define("_TUTMAINTUTORIAL","Tutorial");
define("_TUTMAINSUCADDED","The Tutorial has been succesfully added to your favourites<br><br>You will be redirected within in a few seconds, if not click <a href=\"modules.php?name=".$module_name."&t_op=FavoriteTutorials\">here</a>");
define("_TUTMAINALREADYINFAVS","You already have that Tutorials listed in your Favorites, you need to remove 1 first before you can add this one.");
define("_TUTMAINALREADYMAX1","You already have the maximum allowed Tutorials");
define("_TUTMAINALREADYMAX2","listed in the favorites list, you need to remove 1 first before you can add this one.");
define("_TUTMAINLOGINFAV","<a href=\"modules.php?name=Your_Account\">Login</a> to See your Favorite Tutorials");
define("_TUTMAINTOP5STILL1","You can still add");
define("_TUTMAINTOP5STILL2","Tutorials<br>to Top 5");
define("_TUTMAINLEVEL","Difficulty Level");
define("_TUTMAINEASY","Easy");
define("_TUTMAINADVANCED","Advanced");
define("_TUTMAININTERMEDIATE","Intermediate");
define("_TUTMAINSUBMITTUT","Submit a Tutorial");
define("_TUTMAINSUBBY", "Submitted by");
define("_TUTNEWTUTORIALSUBADD","Thanks for submitting a Tutorial here,<br>we and our users appreciate this alot!");
define("_TUTNEWTUTORIALSUBADD2","The Tutorial will be viewable on the site as soon as an administrator has approved it!");
define("_TUTNEWTUTORIALSUBADD2","The Tutorial has been made viewable on this site!");
define("_TUTMAINSUBONLYLOG","Only registered users our allowed to submit a Tutorial<br>You can register <a href=\"modules.php?name=Your_Account&op=new_user\">here</a>
or if you are already registered, you can login <a href=\"modules.php?name=Your_Account\">here</a>");
define("_TUTMAINSUBRES", "Restricted Access!");
define("_TUTMAINSUBSUC", "Submission Succesfully Completed!");
define("_TUTMAINSUBONLYLOGOFF","The Submission of Tutorials is turned off and only registered users our allowed to submit a Tutorial<br>You can register <a href=\"modules.php?name=Your_Account&op=new_user\">here</a>
or if you are already registered, you can login <a href=\"modules.php?name=Your_Account\">here</a>");
define("_TUTMAINSUBONLYOFF","The Submission of Tutorials is turned off, if you have a Tutorial you want to submit you can contact an Administrator");

#
###ADMIN LANGUAGE DEFINITIONS
#
define("_TUTADMIN","Tutorials Admin");
define("_TUTADMINBACK","Administration Menu");
define("_TUTAMAIN","<center><font class=\"option\">Welcome to the Tutorials Admin</font></center><br><br>
    <strong><i><u>What is the Tutorials Module??</u></i></strong><br><br>The Tutorials Module is a module especially designed to deliver Adobe Photoshop and Macromedia Fireworks tutorials to your users, but it can be used for other kinds of tutorials too.<br>
    It is very easy to make a nice tutorial because the module makes use of the same style options (bbcode) as <a href=\"http://www.phpbb.com\" target=\"_blank\">phpBB</a> to add images, links, and other style options.
    <br><br><strong><i><u>How to use the Tutorials Module??</u></i></strong><br><br>It is very easy to use this module, just navigate around in the adminpanel with the links on the right side.  <a href=\"modules.php?name=".$module_name."\">The main module</a> is also that easy to navigate around and to use.
    <br><br><strong><i><u>How about Copyright??</u></i></strong><br><br><strong>DISPLAY OF COPYRIGHT NOTICES REQUIRED</strong><br>
    All copyright notices used within the module that the module generate, MUST remain intact. Furthermore, these notices must remain visible. The module license does not imply license to resell or redistribute any of those items without expressed permission.
    <br><br><strong>MODIFICATION AND DISTRIBUTION</strong><br>
    Users may alter or modify the module at their own risk, but only for their own use. You may also hire Mighty_Y to modify your own copy of the module. <br><br>Although users may modify the code for their use, modified code may not be sold or distributed, without express written permission from Mighty_Y. This prohibition applies to both altered Mighty_Y's code and any new code developed by users specifically for use with Mighty_Y's modules.
    <br><br><strong><i><u>How can I support you??</u></i></strong><br><br>If you like my work and you want to give me some support, you can donate through paypal to keep the developing and such going by clicking the button below:
<center>
<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">
<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
<input type=\"hidden\" name=\"business\" value=\"sales@portedmods.com\">
<input type=\"hidden\" name=\"item_name\" value=\"Tutorials Module Donation\">
<input type=\"image\" src=\"modules/".$module_name."/images/paypal5.png\" border=\"0\" name=\"submit\" alt=\"Make payments with PayPal - it's fast, free and secure!\">
</form></center>
I also appreciate it when you put my link button on your site. Link the button to: http://www.portedmods.com and use this button:<br><br>
<center><a href=\"http://www.portedmods.com\" target=\"_blank\">
<img src=\"modules/".$module_name."/images/portedmods.gif\" width=\"88\" height=\"31\" border=\"0\" alt=\"PortedMods.com\"></a></center>
<br><br><i>If you follow these rules, there will be no problems :D,<br><strong>Mighty_Y</strong></i>");
define("_TUTADMINMAIN","Tutorials Admin Main");
define("_TUTMAIN","Tutorials Main");
define("_TUTADMINCAT","Add Category");
define("_TUTADMINMODCAT","Modify Category");
define("_TUTADMINTRANSFERCAT","Transfer Tutorials");
define("_TUTADMINADDTUT","Add Tutorial");
define("_TUTADMINMODTUT","Modify Tutorial");
define("_TUTADMINADDMAINCATEGORY","Add a MAIN Category");
define("_TUTADMINADDSUBCATEGORY","Add a SUB-Category");
define("_TUTADMININ","in");
define("_TUTADMINNAME","Name");
define("_TUTADMINDESCRIPTION","Description");
define("_TUTADMINADD","Add");
define("_TUTADMINMODCATEGORY","Modify a Category");
define("_TUTADMINCATEGORY","Category");
define("_TUTADMINMODIFY","Modify");
define("_TUTADMINTRANSFERTUTORIALS","Transfer all tutorials from category");
define("_TUTADMINTRANSFER","Transfer");
define("_TUTADMINMODTUTORIAL","Modify a Tutorial");
define("_TUTADMINMODTUTORIAL2","Modify a Tutorial by ID");
define("_TUTADMINTUTORIALID","Tutorial ID");
define("_TUTADMINADDNEWTUTORIAL","Add a New Tutorial");
define("_TUTADMINTUTORIALNAME","Tutorial Name");
define("_TUTADMINDESCRIPTION255","Description: (255 characters max)");
define("_TUTADMINTUTORIALTEXT","Tutorial Content");
define("_TUTADMINPAGEBREAK","If you want multiple pages you can write <strong>&lt;!--pagebreak--&gt;</strong> where you want to cut.<br>Use BBCodes to format your text.");
define("_TUTADMINAUTHORNAME","Author's Name");
define("_TUTADMINAUTHOREMAIL","Author's Email");
define("_TUTADMINAUTHORHOMEPAGE","Author's Homepage");
define("_TUTADMINVERSION","Version");
define("_TUTADMINADDTUTORIAL","Add this Tutorial");
define("_TUTADMINERRORNOTITLE","ERROR: You need to type a TITLE for your Tutorial!");
define("_TUTADMINERRORNODESCRIPTION","ERROR: You need to type a DESCRIPTION for your Tutorial!");
define("_TUTADMINERRORNOTUTORIAL","ERROR: You need to type a TEXT for your Tutorial!");
define("_TUTADMINERRORNOAUTHOR","ERROR: You need to type a AUTHOR for your Tutorial!");
define("_TUTADMINERRORNOAUTHORMAIL","ERROR: You need to type a AUTHOR MAIL for your Tutorial!");
define("_TUTADMINERRORNOAUTHORSITE","ERROR: You need to type a AUTHOR SITE for your Tutorial!");
define("_TUTADMINERRORNOVERSION","ERROR: You need to type a VERSION for your Tutorial!");
define("_TUTADMINNEWTUTORIALADDED","New Tutorial added to the Database");
define("_TUTADMINTUTORIALSADMIN","Tutorials Administration");
define("_TUTADMINMODTUTORIAL","Modify a Tutorial");
define("_TUTADMINTUTORIALID","Tutorial ID#");
define("_TUTADMINSUBMITTER","Submitter");
define("_TUTADMINHITS","Views");
define("_TUTADMINDELETE","DELETE");
define("_TUTADMINSAVECHANGES","Save Changes");
define("_TUTADMINDELTUTORIALCATWARNING","WARNING : Are you sure you want to delete this category ? You will delete all sub-categories and attached Tutorials as well !");
define("_TUTADMINTHEREIS","There is");
define("_TUTADMINSUBCAT","sub-categories");
define("_TUTADMINATTACHEDTOCAT","under this category");
define("_TUTADMINERRORTHECATEGORY","ERROR: The Category");
define("_TUTADMINALREADYEXIST","already exist!");
define("_TUTADMINERRORTHESUBCATEGORY","ERROR: The Sub-Category");
define("_TUTADMINSURECLEANVOTE","<font color=\"#CC0000\">Warning!</font><br><br>Are you sure you want to clean <strong>all</strong> Tutorial Votes?");
define("_TUTADMINBYES"," Yes ");
define("_TUTADMINBNO","  No  ");
define("_TUTADMINYES","Yes");
define("_TUTADMINNO","No");
define("_TUTADMINSUREDELTUTORIAL","<font color=\"#CC0000\">Warning!</font><br><br>Are you sure you want to delete this Tutorial?");
define("_TUTADMINCOMMENTS","Tutorial Comments (total comments: ");
define("_TUTADMINUSER","User");
define("_TUTADMINCOMMENT","Comment");
define("_TUTADMINNOCOMMENTS","No Comments");
define("_TUTADMINREGVOTES","Registered User Votes (total votes: ");
define("_TUTADMINNOREGVOTES","No Registered User Votes");
define("_TUTADMINNOUNREGVOTES","No Unregistered User Votes");
define("_TUTADMINUNREGVOTES","Unregistered User Votes (total votes: ");
define("_TUTADMINIPADDRESS","IP Address");
define("_TUTADMINRATING","Rating");
define("_TUTADMINDATE","Date");
define("_TUTADMINUAVGRATING","User AVG Rating");
define("_TUTADMINTOTALRATINGS","Total Ratings");
define("_TUTADMINVISIT","Visit");
define("_TUTADMINCONFIG","General Settings");
define("_TUTADMINTUTSPERPAGE","Number of Tutorials Shown per page");
define("_TUTADMINTUTSPOPPAGE","Number of Tutorials shown on Most Popular page");
define("_TUTADMINTUTSTOPPAGE","Number of Tutorials shown on Top Rated page");
define("_TUTADMINTUTSSEARCHPAGE","Number of Search Results per page");
define("_TUTADMINTUTSMAXFAVS","Maximum Allowed Favorite Tutorials per User");
define("_TUTADMINTUTSPOPHITS","Views a Tutorial needs to be listed as Popular");
define("_TUTADMINTUTSMINVOTES","Minimum Votes a Tutorial needs to be listed in Top Rated List");
define("_TUTADMINTUTSNUMDAYS","Number of days Anonymous voters have to wait to vote again");
define("_TUTADMINTUTSDAY","Day");
define("_TUTADMINTUTSDAYS","Days");
define("_TUTADMINTUTSWEEK","Week");
define("_TUTADMINTUTSWEEKS","Weeks");
define("_TUTADMINTUTSVERSUSVOTE","Number of Anonymous votes vs. 1 Registered vote");
define("_TUTADMINTUTSMAINDECIMAL","Main Rating Decimal out to X places");
define("_TUTADMINTUTSDETAILDECIMAL","Detail Rating Decimal out to X places");
define("_TUTADMINTUTSSHOWBLOCKS","Show right blocks for Tutorials Module");
define("_TUTADMINTUTSSHOWNUM","Show number of Tutorials next to Category");
define("_TUTADMINTUTSSAVECHANGES","Save Changes");
define("_TUTADMINSUCUPDATED","The Tutorials Config has been succesfully updated!<br><br>You will be redirected within in a few seconds, if not click <a href=\"".$admin_file.".php?op=config\">here</a>");
define("_TUTADMINLEVEL","Difficulty Level");
define("_TUTADMINLEVELCONFIG","Difficulty Settings");
define("_TUTADMINLEVELTITLE","Difficulty Title");
define("_TUTADMINLEVELWEIGHT","Weight");
define("_TUTADMINLEVELFUNCTIONS","Difficulty Functions");
define("_TUTADMINLEVELEDIT","Edit");
define("_TUTADMINLEVELDELETE","Delete");
define("_TUTADMINLEVELADDNEWLEVEL","Add New Difficulty Level");
define("_TUTADMINLEVELCREATELEVEL","Create!");
define("_TUTADMINLEVELUP","Level Up");
define("_TUTADMINLEVELDOWN","Level Down");
define("_TUTADMINEDITLEVEL","Edit Difficulty Level");
define("_TUTADMINDELLEVEL","Delete Difficulty Level");
define("_TUTADMINSAVELEVEL","Save!");
define("_TUTADMINARESUREDELLEVEL","Are you sure you want to delete Difficulty Level");
define("_TUTADMINTUTSALLOWSUB","Allow registered users to submit Tutorials");
define("_TUTADMINWAITINGSUBMISSIONS","Waiting Submissions");
define("_TUTADMINSUBON","Submitted on");
define("_TUTADMINAPPROVE","Approve");
define("_TUTADMINDENY","DENY");
define("_TUTADMINAPPROVETUTORIAL","Approve a Tutorial");
define("_TUTADMINTUTSAPPROVE","Turn on approvement on submissions");
define("_TUTADMINSUREDENY","Are you sure you don't want to approve this Tutorial?");
define("_TUTADMINTUTORIALAPPROVED","Tutorial successfully approved and added to the Database!");
#
###BBCODE LANGUAGE DEFINITIONS
#
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

?>
