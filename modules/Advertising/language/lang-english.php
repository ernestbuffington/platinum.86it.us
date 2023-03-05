<?php

/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    PCN AdsPlus v2.0 -- by Pc-Nuke! --  www.pcnuke.com                */
/************************************************************************/
/*    Created by PcNuke.com -- Released on: 06.10.20. y.m.d             */
/*    http://www.max.pcnuke.com  --  http://www.pcnuke.com              */
/*    All Rights Reserved 2006 -- by Pc-Nuke!                           */
/*    No Modding, Porting, Changing, or Distribution of this program    */
/*    is allowed without written permission from www.pcnuke.com         */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.max.pcnuke.com/modules.php?name=GNU_GPL                 */
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

//--- PCN ADvertising extra defines  ---//
// You may want to make TEXT adjustments in this area to things like the:
// TOP RIGHT text, Payment Gateways, Image sizes, or maybe Advertising Quote, etc....
define("_MAIN","Customer Advertising Center");
define("_ENDDATE","End Date");
define("_TODAYIS","Today Is");
define("_MOSTMONTH","Busiest Month");
define("_MOSTDAY","Busiest Day");
define("_MOSTHOUR","Busiest Hour");
define("_HITS","hits");
define("_STATS","Statistics");
define("_SPONSORS","Sponsors");
define("_STATSTEXT","<center><strong>Statistics information for this website</strong></center>");
define("_ADSMENU","Customer Advertising Center");
define("_MAINPAGE","Main");
define("_HOMEPAGETEXT","<strong>Welcome to the Advertising Center:</strong>");
define("_CAMPAIGNS","Campaigns");
define("_CAMPAIGNSTEXT","<strong>Campaign Scopes:</strong>");
define("_ADCAMPAIGNS","Advertising Campaigns");
define("_ADPLANS","Advertising Plans");
define("_ACTIVATE","Activate");


define("_STEP1","<strong>Step 1: </strong>Please submit your image to our Server");
define("_STEP2","<strong>Step 2: </strong>Please complete the form with the needed information ");

define("_ADIMPORTANT","<font color='red'><strong>Important</strong></font>: You must upload your image file after making payments.");
define("_GATEWAYS","<a href='modules.php?name=Advertising&op=gateways'><strong>Payment gateways are Paypal & 2CheckOut, more info here!</strong></a>");
define("_LISTQUOTE","<font color=#ffffff><strong>With over 2 Million hits the 1st year and on a record pace of over 5 Million Hits per Year - Your Ads get Seen Here!</strong></font>");
define("_TOPRIGHTTEXT","The following information shows our advertising plans, prices, and purchase links. Banners advertising can run in the form of flash, scripts, & images (swf, png, gif, jpg). Click the <a href='modules.php?name=Advertising&op=plans'><strong>Buy Links!</strong></a> to purchase.");
define("_ADDETAILS","
<strong>Image Locations & Sizes:</strong>
<br>
 - Top Location = Only (728Wx90L).<br>
 - Themeheader = Only (468Wx60L).<br>
 - Side Locations = Up to (120Wx600L).<br>
 - Center Locations = Up to (550Wx100L).<br>
 - All Pages Lower = Up to (550Wx100L).<br>
 - Mini Ad Locations = Only (130Wx15L).<br>
 - Footer Location = Up to (728Wx90L).<br>
** We may not offer ALL listed locations.
 
<br><br>
<strong>Image Types:</strong>	
<br>
 - Uploads can be: (gif, jpg, png, or swf).
");
//--- PCN ADvertising extra defines  ---//


// Defines for Main Page -- Start //
define("_SIMAINPAGE","<font color=$textcolor1 ><h3>Information Forms</h3></font>");
define("_SIMAINPAGETEXT","<font color=$textcolor1><center>Use these forms to send various imput information back to our website.</center></font>");
define("_SIMAINPAGELIST2","<font color=$textcolor1 >Forms List: </font>");
define("_SIMAINPAGELIST3","<font color=$textcolor1 >
<ol type=1>
	<li><a href='modules.php?name=Send_Info&file=adsend'>Send us your banner Advertising information</a></li><br><br>
	<li><a href=''></a></li><br><br>
	<li><a href=''></a></li><br><br>
    <li><a href='modules.php?name=Send_Info'></a></li><br><br>
	<li><a href='modules.php?name=Send_Info'></a></li><br><br>
	<li><a href='modules.php?name=Send_Info'></a></li><br><br>
	<li><a href=''></a></li>
	<li><a href='modules.php?name=Send_Info'>To add more links to Forms just</a> </li><br><br>
	<li><a href='modules.php?name=Send_Info'>edit the language file here:</a></li><br><br>
	<li><a href='modules.php?name=Send_Info'>modules/Send_Info/language/lang-english.php</a></li><br><br>
</ol>
</font>");
define("_SEND","Send");
define("_YOURNAME","<font color=000000>Your Name</font>");
define("_MESSAGE", "<font color=000000>Message</font>");
define("_YOUREMAIL","<font color=000000>Your Email</font>");
define("_FEEDBACKNOTE","All comments and suggestions about this web site are very welcome and a valuable source of information for us. Thanks!");
define("_FEEDBACKTITLE","Feedback Form");
define("_FEEDBACK","<font color=000000>Feedback</font>");
define("_FBENTERNAME","ERROR: Please enter your name!");
define("_FBENTEREMAIL","ERROR: Please enter your e-mail address!");
define("_FBENTERIMAGE","ERROR: Please enter your image address!");
define("_FBENTERLINK","ERROR: Please enter your image link address!");
define("_FBENTERMESSAGE","ERROR: Please enter a message!");
define("_SENDEREMAIL","Sender's Email");
define("_SENDERNAME","Sender's Name");
define("_SENDERIMAGE","Sender's Image Address");
define("_SENDERLINK","Sender's Image Link");
define("_SENDERMESSAGE","Sender's Notes");
define("_FBMAILSENT","Mail has been sent!");
define("_FBTHANKSFORCONTACT","Thank you for contacting us");
// Defines for Main Page -- End //

// Defines for Ad Send Page -- Start //
define("_SENDTITLE","<font color=000000>Sending Banner Information</font>");
define("_SENDNOTE","<font color=000000>Please fill this form out completely and double check you information, before clicking the SEND button at the bottom of the page, Thank You</font>");
define("_YOURBANNERLINKURL","<font color=000000>URL address where an image backup copy can be download if needed</font>");
define("_YOURBANNERLOCATION","<font color=000000>A verfied URL address that the Advertising image will be linked to</font>");
define("_SENDMORE","<font color=000000>Additional Information (Please include your LOGIN member name)</font>");
define("_SENDPAGEFINAL","<font color=000000>Thats it -- We will contact you Soon!</font><br><br>");
define("_UPGRADE","<font color=000000>Upgrade to Full Advertising Version <a href=\"http://www.max.pcnuke.com/modules.php?name=Deluxe2\"> HERE!</font></a>.");
// Defines for Ad Send Page -- End //




define("_MYADS","My Ads");
define("_CLIENTLOGIN","Client Login");
define("_SITESTATS","Statistics");
define("_TERMS","Terms");
define("_PLANSPRICES","Pricing");
define("_ADVERTISING","Advertising");
define("_HEREARENUMBERS","Here are some numbers about our site that you might find interesting before proceeding to purchase your advertising:");
define("_GENERALSTATS","Statistics");
define("_TOTALVIEWS","Total pages views until now:");
define("_VIEWSYEAR","Average pages views per year:");
define("_VIEWSMONTH","Average pages views per month:");
define("_VIEWSDAY","Average pages views per day:");
define("_VIEWSHOUR","Average pages views per hour:");
define("_CURREGUSERS","Current registered users:");
define("_GOOGLERANK","This site Google's Page Rank:");

define("_PLANNAME","Plan Name");
define("_DESCRIPTION","Description");
define("_QUANTITY","Quantity");
define("_PRICE","Price");
define("_BUYLINKS","Buy Links");
define("_IMPRESSIONS","Impressions");
define("_CLICKS","Clicks");
define("_YEARS","Years");
define("_MONTHS","Months");
define("_DAYS","Days");
define("_ADSNOCONTENT","Sorry at this time we don't have any advertising plans available.");
define("_TERMSCONDITIONS","Terms and Conditions");
define("_ADSYSTEM","Client Advertising Stats");
define("_CLIENTLOGIN","Client Login");
define("_ENTER","Enter");
define("_LOGININCORRECT","Login Incorrect!!!");
define("_ACTIVEADSFOR","Current Active Banners for");
define("_NAME","Name");
define("_IMPMADE","Imp. Made");
define("_IMPTOTAL","Imp. Total");
define("_IMPLEFT","Imp. Left");
define("_TYPE","Type");
define("_FUNCTIONS","Functions");
define("_EMAILSTATS","Email Stats");
define("_VIEWBANNER","View Banner");
define("_INACTIVEADS","Current Inactive Banners for");
define("_NOCONTENT","There is no content here at this time...");
define("_ADISNTYOURS","<strong>Error:</strong> The banner you're trying to view isn't assigned to your account.");
define("_YOURBANNER","Your Banner");
define("_CURRENTSTATUS","Current Status:");
define("_ACTIVE","Active");
define("_INACTIVE","Inactive");
define("_FUNCTIONNOTALLOWED","<strong>Error:</strong> The selected function isn't allowed.");
define("_STATSNOTSEND","Statistics for the selected Banner can't be send because<br>there isn't an email associated with it.<br>Please contact the Administrator");
define("_YOURSTATS","Your Banner Statistics at");
define("_FOLLOWINGSTATS","Following are the complete stats for your advertising investment at");
define("_CLIENTNAME","Client Name");
define("_BANNERID","Banner ID");
define("_BANNERNAME","Banner Name");
define("_BANNERIMAGE","Banner Image");
define("_BANNERURL","Banner URL");
define("_IMPPURCHASED","Impressions Purchased");
define("_IMPREMADE","Impressions Made");
define("_IMPRELEFT","Impressions Left");
define("_RECEIVEDCLICKS","Clicks Received");
define("_CLICKSPERCENT","Clicks Percent");
define("_GENERATEDON","Report Generated on");
define("_STATSSENT","Statistics for your Ad Banner has been sent by email at:");
define("_FLASHMOVIE","Flash Movie");
define("_WELCOMEADS","<strong>Welcome to our Advertising Section!</strong><br><br>If you want your banner ad here in our website, you may want to know some details because you should know what kind of target and ads plans we can offer.<br><br>If you are already our advertising customer, please login <a href=\"modules.php?name=Advertising&op=client\">here</a>.<br>");


//--- PCN ADvertising extra defines  ---//

define("_ADTOPNOTE"," <strong>Please do not abuse this system:</strong> (review the image sizes at the bottom of the page and adjust your IMAGE... to the advertisement TYPE that you have paid for. Then select the same proper areas when filling in this form, thank you)");
define("_ADMINMAIN","Admin Main");
define("_ADBLOCKS","Ad Blocks");
define("_ENDDATE","End Date");
define("_ENDDATE2","<strong>00.00.00</strong> (END DATE of your ad calculated from today)");
define("_BANNERCLIENTS","Banners & Clients");
define("_ADSFRONTSIDE","Ads Frontside");
define("_ADSUPLOAD","Banner uploading is at bottom!");
define("_ADSPATH","Image path is:");
define("_ADSPATH2","Or you can click the newly uploaded image and see the URL path in the browsers address bar");
define("_ADVERTISING_ADMIN_SAVE","Save Changes");
define("_GENERAL","(WARNING: The all saved changes will be applied to the information located in the \"Advertising Frontside\" for each selected page area!)");
define("_FRONTBODY","Advertising Frontpage Body");
define("_CANCELBODY","Cancel Page Frontside Body");
define("_CAMPAIGNSBODY","Campaigns Page Frontside Body");
define("_STATSBODY","Statistics Page Frontside Body");
define("_TERMSBODY","Terms Page Frontside Body");
define("_THANKSBODY","Thanks Page Frontside Body");
define("_TITLEFRONT","Frontpage");
define("_TITLECANCEL","Cancel");
define("_TITLECAMPAIGNS","Campaigns");
define("_TITLESTATS","Statistics");
define("_TITLETERMS","Terms");
define("_TITLETHANKS","Thanks");
define("_EDITFRONT","Edit Advertising Frontpage");
define("_EDITCANCEL","Edit Cancel Page");
define("_EDITCAMPAIGNS","Edit Campaigns Page");
define("_EDITSTATS","Edit Statistics Page");
define("_EDITTERMS","Edit Terms Page");
define("_EDITTHANKS","Edit Thanks Page");
//--- PCN ADvertising extra defines  ---//

define("_BANNERSADMIN","Advertising Administration");
define("_ACTIVEBANNERS","Current Active Banners");
define("_ACTIVEBANNERS2","Active Banners");
define("_IMPRESSIONS","Impressions");
define("_IMPLEFT","Imp. Left");
define("_CLICKS","Clicks");
define("_CLICKSPERCENT","% Clicks");
define("_CLIENTNAME","Client Name");
define("_ADVERTISINGCLIENTS","Advertising Clients");
define("_CONTACTNAME","Contact Name");
define("_CONTACTEMAIL","Contact Email");
define("_ADDNEWBANNER","Add a Banner & We will Review it!");
define("_PURCHASEDIMPRESSIONS","Purchased Impressions");
define("_IMAGEURL","Image URL");
define("_CLICKURL","Click URL");
define("_ADDBANNER","Add Banner");
define("_ADDCLIENT","Add Client");
define("_CLIENTLOGIN","Client Login");
define("_CLIENTPASSWD","Client Password");
define("_ADDCLIENT2","Add Client");
define("_DELETEBANNER","Delete Banner");
define("_SURETODELBANNER","Are you sure you want to delete this Banner?");
define("_EDITBANNER","Edit Banner");
define("_ADDIMPRESSIONS","Add More Impressions");
define("_DELETECLIENT","Delete Advertising Client");
define("_SURETODELCLIENT","You are about to delete the client and all its Banners!!!");
define("_CLIENTWITHOUTBANNERS","This client doesn't have any banner running now.");
define("_DELCLIENTHASBANNERS","This client has the following ACTIVE BANNERS running now");
define("_CLASS","Class");
define("_CLASSNOTE","If your Ad Class is Javascript/HTML Code the next 4 fields will be ignored and will count only the Code area below. If your Ad Class is Flash you must put the .SWF complete URL in the next field and set width and height of the Flash movie (Click URL and Alternate Text fields will be ignored).");
define("_ADCLASS","Ad Class");
define("_ADIMAGE","Image");
define("_ADCODE","Javascript/HTML Code");
define("_ADFLASH","Flash");
define("_IMAGESIZE","Image Size");
define("_WIDTH","Width");
define("_HEIGHT","Height");
define("_INPIXELS","(size in pixels)");
define("_FLASHFILEURL","Flash File URL");
define("_FLASHSIZE","Flash Movie Size");
define("_ADPOSITIONS","Ad Positions");
define("_POSITIONNOTE","Select the (position) <strong>that you paid for</strong> (do not abuse)!<br> If you PAID for the CENTER area, select.. (2-Block Center)");
define("_XFORUNLIMITED","write X for unlimited");
define("_IMPPURCHASED","Impressions Purchased");
define("_IMPMADE","Impressions Made");
define("_ADINFOINCOMPLETE","<strong>Error:</strong> Banner Information is Incomplete!");
define("_ADINFOCOMPLETE","<strong>Great:</strong> Banner uploading is done - Your Finished!");
define("_CURRENTPOSITIONS","Current Ads Positions");
define("_POSITIONNAME","Position Name");
define("_POSITIONNUMBER","Position Number");
define("_ASSIGNEDADS","Assigned Ads");
define("_ADDNEWPOSITION","Add Advertising Positions");
define("_ADDPOSITION","Add Position");
define("_POSINFOINCOMPLETE","<strong>Error:</strong> Advertising position name field can't be empty.");
define("_EDITPOSITION","Edit Advertising Position");
define("_SAVEPOSITION","Save Changes");
define("_DELETEPOSITION","Delete Ads Position");
define("_SURETODELPOSITION","You are about to delete an Ads Position. Are you sure you want to proceed?");
define("_POSITIONHASADS","The ads position you selected to delete has banners assigned to it.<br>Please select a new position to move all ads.");
define("_MOVEADS","Move Ads To");
define("_MOVEDADSSTATUS","New status of moved Ads");
define("_NOCHANGES","No Changes");
define("_POSEXAMPLE","You can have a look at the file <i>/blocks/block-Advertising.php</i> and file <i>/header.php</i> to have a clear example on how to implement this in your site.");
define("_ADDEDDATE","Added Date");
define("_DELETEALLADS","Delete All Banners");
define("_ADSNOCLIENT","<strong>Error:</strong> There isn't any Advertising Client.<br>Please create a new client before add banners.");
define("_INACTIVEBANNERS","Inactive Banners");
define("_EXTRAINFO","Extra Info");
define("_EDITCLIENT","Edit Advertising Client");
define("_ALTTEXT","Alternate Text");
define("_IMAGESWFURL","Image or Flash file URL");
define("_TERMS","Terms");
define("_PLANSPRICES","Plans & Prices");
define("_EDITTERMS","Edit Terms of Service");
define("_TERMSOFSERVICEBODY","Terms of Service Body");
define("_COUNTRYNAME","Your Country Name");
define("_TERMSNOTE","Carefuly review the default Terms. Change whatever you want to change according with your advertising politics. This will be published in the Advertising module.");
define("_SITENAMEADS","(To embed your site name into the text use [sitename] and to use your country name type [country] in the text and it will be replaced from Advertising module)");
define("_ADSMODULEINACTIVE","[ Warning: Advertising Module is inactive! ]");
define("_ADDADVERTISINGPLAN","Add Advertising Plan");
define("_ADVERTISINGPLANS","Advertising Plans");
define("_PLANNAME","Plan Name");
define("_DELIVERY","Delivery Mode");
define("_PLANDESCRIPTION","Plan Description");
define("_DELIVERYQUANTITY","Delivery Quantity");
define("_DELIVERYTYPE","Delivery Mode");
define("_PLANBUYLINKS","Buy Links1");
define("_PLANBUYLINKS2","Buy Links2");
define("_INITIALSTATUS","Initial Status");
define("_ADDNEWPLAN","Add New Plan");
define("_PLANSNOTE","Plans are for reference only and will be published at the Advertising module so your clients know what you have to offer, conditions, prices and a link to pay for your service.");
define("_ADDPLANERROR","<strong>Error:</strong> One or more fields are empty. Please go back and correct the problem.");
define("_PDAYS","Days");
define("_PMONTHS","Months");
define("_PYEARS","Years");
define("_PRICE","Price");
define("_ADVERTISINGPLANEDIT","Advertising Plan Edit");
define("_DELETEPLAN","Delete Ads Plan");
define("_SURETODELPLAN","Your are about to delete an Advertising Plan. Are you sure you want to proceed?");
define("_CANTDELETEPOSITION","<strong>Error:</strong> You can't delete ALL positions. At least one should be in the database.<br>Edit the position if you need to change it or add a new one.");
define("_BANNERNAME","Banner Name");
define("_CLIENT","Client");
define("_YEARS","Years");
define("_MONTHS","Months");
define("_WARNING","Warning");



?>