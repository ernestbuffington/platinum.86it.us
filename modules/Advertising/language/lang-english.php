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
global $textcolor1;
//--- PCN ADvertising extra define_onces  ---//
// You may want to make TEXT adjustments in this area to things like the:
// TOP RIGHT text, Payment Gateways, Image sizes, or maybe Advertising Quote, etc....
define_once("_MAIN","Customer Advertising Center");
define_once("_ENDDATE","End Date");
define_once("_TODAYIS","Today Is");
define_once("_MOSTMONTH","Busiest Month");
define_once("_MOSTDAY","Busiest Day");
define_once("_MOSTHOUR","Busiest Hour");
define_once("_HITS","hits");
define_once("_STATS","Statistics");
define_once("_SPONSORS","Sponsors");
define_once("_STATSTEXT","<center><strong>Statistics information for this website</strong></center>");
define_once("_ADSMENU","Customer Advertising Center");
define_once("_MAINPAGE","Main");
define_once("_HOMEPAGETEXT","<strong>Welcome to the Advertising Center:</strong>");
define_once("_CAMPAIGNS","Campaigns");
define_once("_CAMPAIGNSTEXT","<strong>Campaign Scopes:</strong>");
define_once("_ADCAMPAIGNS","Advertising Campaigns");
define_once("_ADPLANS","Advertising Plans");
define_once("_ACTIVATE","Activate");


define_once("_STEP1","<strong>Step 1: </strong>Please submit your image to our Server");
define_once("_STEP2","<strong>Step 2: </strong>Please complete the form with the needed information ");

define_once("_ADIMPORTANT","<font color='red'><strong>Important</strong></font>: You must upload your image file after making payments.");
define_once("_GATEWAYS","<a href='modules.php?name=Advertising&op=gateways'><strong>Payment gateways are Paypal & 2CheckOut, more info here!</strong></a>");
define_once("_LISTQUOTE","<font color=#ffffff><strong>With over 2 Million hits the 1st year and on a record pace of over 5 Million Hits per Year - Your Ads get Seen Here!</strong></font>");
define_once("_TOPRIGHTTEXT","The following information shows our advertising plans, prices, and purchase links. Banners advertising can run in the form of flash, scripts, & images (swf, png, gif, jpg). Click the <a href='modules.php?name=Advertising&op=plans'><strong>Buy Links!</strong></a> to purchase.");
define_once("_ADDETAILS","
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
define_once("_SIMAINPAGE","<font color=$textcolor1 ><h3>Information Forms</h3></font>");
define_once("_SIMAINPAGETEXT","<font color=$textcolor1><center>Use these forms to send various imput information back to our website.</center></font>");
define_once("_SIMAINPAGELIST2","<font color=$textcolor1 >Forms List: </font>");
define_once("_SIMAINPAGELIST3","<font color=$textcolor1 >
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
define_once("_SEND","Send");
define_once("_YOURNAME","<font color=000000>Your Name</font>");
define_once("_MESSAGE", "<font color=000000>Message</font>");
define_once("_YOUREMAIL","<font color=000000>Your Email</font>");
define_once("_FEEDBACKNOTE","All comments and suggestions about this web site are very welcome and a valuable source of information for us. Thanks!");
define_once("_FEEDBACKTITLE","Feedback Form");
define_once("_FEEDBACK","<font color=000000>Feedback</font>");
define_once("_FBENTERNAME","ERROR: Please enter your name!");
define_once("_FBENTEREMAIL","ERROR: Please enter your e-mail address!");
define_once("_FBENTERIMAGE","ERROR: Please enter your image address!");
define_once("_FBENTERLINK","ERROR: Please enter your image link address!");
define_once("_FBENTERMESSAGE","ERROR: Please enter a message!");
define_once("_SENDEREMAIL","Sender's Email");
define_once("_SENDERNAME","Sender's Name");
define_once("_SENDERIMAGE","Sender's Image Address");
define_once("_SENDERLINK","Sender's Image Link");
define_once("_SENDERMESSAGE","Sender's Notes");
define_once("_FBMAILSENT","Mail has been sent!");
define_once("_FBTHANKSFORCONTACT","Thank you for contacting us");
// define_onces for Main Page -- End //

// define_onces for Ad Send Page -- Start //
define_once("_SENDTITLE","<font color=000000>Sending Banner Information</font>");
define_once("_SENDNOTE","<font color=000000>Please fill this form out completely and double check you information, before clicking the SEND button at the bottom of the page, Thank You</font>");
define_once("_YOURBANNERLINKURL","<font color=000000>URL address where an image backup copy can be download if needed</font>");
define_once("_YOURBANNERLOCATION","<font color=000000>A verfied URL address that the Advertising image will be linked to</font>");
define_once("_SENDMORE","<font color=000000>Additional Information (Please include your LOGIN member name)</font>");
define_once("_SENDPAGEFINAL","<font color=000000>Thats it -- We will contact you Soon!</font><br><br>");
define_once("_UPGRADE","<font color=000000>Upgrade to Full Advertising Version <a href=\"http://www.max.pcnuke.com/modules.php?name=Deluxe2\"> HERE!</font></a>.");
// define_onces for Ad Send Page -- End //




define_once("_MYADS","My Ads");
define_once("_CLIENTLOGIN","Client Login");
define_once("_SITESTATS","Statistics");
define_once("_TERMS","Terms");
define_once("_PLANSPRICES","Pricing");
define_once("_ADVERTISING","Advertising");
define_once("_HEREARENUMBERS","Here are some numbers about our site that you might find interesting before proceeding to purchase your advertising:");
define_once("_GENERALSTATS","Statistics");
define_once("_TOTALVIEWS","Total pages views until now:");
define_once("_VIEWSYEAR","Average pages views per year:");
define_once("_VIEWSMONTH","Average pages views per month:");
define_once("_VIEWSDAY","Average pages views per day:");
define_once("_VIEWSHOUR","Average pages views per hour:");
define_once("_CURREGUSERS","Current registered users:");
define_once("_GOOGLERANK","This site Google's Page Rank:");

define_once("_PLANNAME","Plan Name");
define_once("_DESCRIPTION","Description");
define_once("_QUANTITY","Quantity");
define_once("_PRICE","Price");
define_once("_BUYLINKS","Buy Links");
define_once("_IMPRESSIONS","Impressions");
define_once("_CLICKS","Clicks");
define_once("_YEARS","Years");
define_once("_MONTHS","Months");
define_once("_DAYS","Days");
define_once("_ADSNOCONTENT","Sorry at this time we don't have any advertising plans available.");
define_once("_TERMSCONDITIONS","Terms and Conditions");
define_once("_ADSYSTEM","Client Advertising Stats");
define_once("_CLIENTLOGIN","Client Login");
define_once("_ENTER","Enter");
define_once("_LOGININCORRECT","Login Incorrect!!!");
define_once("_ACTIVEADSFOR","Current Active Banners for");
define_once("_NAME","Name");
define_once("_IMPMADE","Imp. Made");
define_once("_IMPTOTAL","Imp. Total");
define_once("_IMPLEFT","Imp. Left");
define_once("_TYPE","Type");
define_once("_FUNCTIONS","Functions");
define_once("_EMAILSTATS","Email Stats");
define_once("_VIEWBANNER","View Banner");
define_once("_INACTIVEADS","Current Inactive Banners for");
define_once("_NOCONTENT","There is no content here at this time...");
define_once("_ADISNTYOURS","<strong>Error:</strong> The banner you're trying to view isn't assigned to your account.");
define_once("_YOURBANNER","Your Banner");
define_once("_CURRENTSTATUS","Current Status:");
define_once("_ACTIVE","Active");
define_once("_INACTIVE","Inactive");
define_once("_FUNCTIONNOTALLOWED","<strong>Error:</strong> The selected function isn't allowed.");
define_once("_STATSNOTSEND","Statistics for the selected Banner can't be send because<br>there isn't an email associated with it.<br>Please contact the Administrator");
define_once("_YOURSTATS","Your Banner Statistics at");
define_once("_FOLLOWINGSTATS","Following are the complete stats for your advertising investment at");
define_once("_CLIENTNAME","Client Name");
define_once("_BANNERID","Banner ID");
define_once("_BANNERNAME","Banner Name");
define_once("_BANNERIMAGE","Banner Image");
define_once("_BANNERURL","Banner URL");
define_once("_IMPPURCHASED","Impressions Purchased");
define_once("_IMPREMADE","Impressions Made");
define_once("_IMPRELEFT","Impressions Left");
define_once("_RECEIVEDCLICKS","Clicks Received");
define_once("_CLICKSPERCENT","Clicks Percent");
define_once("_GENERATEDON","Report Generated on");
define_once("_STATSSENT","Statistics for your Ad Banner has been sent by email at:");
define_once("_FLASHMOVIE","Flash Movie");
define_once("_WELCOMEADS","<strong>Welcome to our Advertising Section!</strong><br><br>If you want your banner ad here in our website, you may want to know some details because you should know what kind of target and ads plans we can offer.<br><br>If you are already our advertising customer, please login <a href=\"modules.php?name=Advertising&op=client\">here</a>.<br>");


//--- PCN ADvertising extra define_onces  ---//

define_once("_ADTOPNOTE"," <strong>Please do not abuse this system:</strong> (review the image sizes at the bottom of the page and adjust your IMAGE... to the advertisement TYPE that you have paid for. Then select the same proper areas when filling in this form, thank you)");
define_once("_ADMINMAIN","Admin Main");
define_once("_ADBLOCKS","Ad Blocks");
define_once("_ENDDATE","End Date");
define_once("_ENDDATE2","<strong>00.00.00</strong> (END DATE of your ad calculated from today)");
define_once("_BANNERCLIENTS","Banners & Clients");
define_once("_ADSFRONTSIDE","Ads Frontside");
define_once("_ADSUPLOAD","Banner uploading is at bottom!");
define_once("_ADSPATH","Image path is:");
define_once("_ADSPATH2","Or you can click the newly uploaded image and see the URL path in the browsers address bar");
define_once("_ADVERTISING_ADMIN_SAVE","Save Changes");
define_once("_GENERAL","(WARNING: The all saved changes will be applied to the information located in the \"Advertising Frontside\" for each selected page area!)");
define_once("_FRONTBODY","Advertising Frontpage Body");
define_once("_CANCELBODY","Cancel Page Frontside Body");
define_once("_CAMPAIGNSBODY","Campaigns Page Frontside Body");
define_once("_STATSBODY","Statistics Page Frontside Body");
define_once("_TERMSBODY","Terms Page Frontside Body");
define_once("_THANKSBODY","Thanks Page Frontside Body");
define_once("_TITLEFRONT","Frontpage");
define_once("_TITLECANCEL","Cancel");
define_once("_TITLECAMPAIGNS","Campaigns");
define_once("_TITLESTATS","Statistics");
define_once("_TITLETERMS","Terms");
define_once("_TITLETHANKS","Thanks");
define_once("_EDITFRONT","Edit Advertising Frontpage");
define_once("_EDITCANCEL","Edit Cancel Page");
define_once("_EDITCAMPAIGNS","Edit Campaigns Page");
define_once("_EDITSTATS","Edit Statistics Page");
define_once("_EDITTERMS","Edit Terms Page");
define_once("_EDITTHANKS","Edit Thanks Page");
//--- PCN ADvertising extra define_onces  ---//

define_once("_BANNERSADMIN","Advertising Administration");
define_once("_ACTIVEBANNERS","Current Active Banners");
define_once("_ACTIVEBANNERS2","Active Banners");
define_once("_IMPRESSIONS","Impressions");
define_once("_IMPLEFT","Imp. Left");
define_once("_CLICKS","Clicks");
define_once("_CLICKSPERCENT","% Clicks");
define_once("_CLIENTNAME","Client Name");
define_once("_ADVERTISINGCLIENTS","Advertising Clients");
define_once("_CONTACTNAME","Contact Name");
define_once("_CONTACTEMAIL","Contact Email");
define_once("_ADDNEWBANNER","Add a Banner & We will Review it!");
define_once("_PURCHASEDIMPRESSIONS","Purchased Impressions");
define_once("_IMAGEURL","Image URL");
define_once("_CLICKURL","Click URL");
define_once("_ADDBANNER","Add Banner");
define_once("_ADDCLIENT","Add Client");
define_once("_CLIENTLOGIN","Client Login");
define_once("_CLIENTPASSWD","Client Password");
define_once("_ADDCLIENT2","Add Client");
define_once("_DELETEBANNER","Delete Banner");
define_once("_SURETODELBANNER","Are you sure you want to delete this Banner?");
define_once("_EDITBANNER","Edit Banner");
define_once("_ADDIMPRESSIONS","Add More Impressions");
define_once("_DELETECLIENT","Delete Advertising Client");
define_once("_SURETODELCLIENT","You are about to delete the client and all its Banners!!!");
define_once("_CLIENTWITHOUTBANNERS","This client doesn't have any banner running now.");
define_once("_DELCLIENTHASBANNERS","This client has the following ACTIVE BANNERS running now");
define_once("_CLASS","Class");
define_once("_CLASSNOTE","If your Ad Class is Javascript/HTML Code the next 4 fields will be ignored and will count only the Code area below. If your Ad Class is Flash you must put the .SWF complete URL in the next field and set width and height of the Flash movie (Click URL and Alternate Text fields will be ignored).");
define_once("_ADCLASS","Ad Class");
define_once("_ADIMAGE","Image");
define_once("_ADCODE","Javascript/HTML Code");
define_once("_ADFLASH","Flash");
define_once("_IMAGESIZE","Image Size");
define_once("_WIDTH","Width");
define_once("_HEIGHT","Height");
define_once("_INPIXELS","(size in pixels)");
define_once("_FLASHFILEURL","Flash File URL");
define_once("_FLASHSIZE","Flash Movie Size");
define_once("_ADPOSITIONS","Ad Positions");
define_once("_POSITIONNOTE","Select the (position) <strong>that you paid for</strong> (do not abuse)!<br> If you PAID for the CENTER area, select.. (2-Block Center)");
define_once("_XFORUNLIMITED","write X for unlimited");
define_once("_IMPPURCHASED","Impressions Purchased");
define_once("_IMPMADE","Impressions Made");
define_once("_ADINFOINCOMPLETE","<strong>Error:</strong> Banner Information is Incomplete!");
define_once("_ADINFOCOMPLETE","<strong>Great:</strong> Banner uploading is done - Your Finished!");
define_once("_CURRENTPOSITIONS","Current Ads Positions");
define_once("_POSITIONNAME","Position Name");
define_once("_POSITIONNUMBER","Position Number");
define_once("_ASSIGNEDADS","Assigned Ads");
define_once("_ADDNEWPOSITION","Add Advertising Positions");
define_once("_ADDPOSITION","Add Position");
define_once("_POSINFOINCOMPLETE","<strong>Error:</strong> Advertising position name field can't be empty.");
define_once("_EDITPOSITION","Edit Advertising Position");
define_once("_SAVEPOSITION","Save Changes");
define_once("_DELETEPOSITION","Delete Ads Position");
define_once("_SURETODELPOSITION","You are about to delete an Ads Position. Are you sure you want to proceed?");
define_once("_POSITIONHASADS","The ads position you selected to delete has banners assigned to it.<br>Please select a new position to move all ads.");
define_once("_MOVEADS","Move Ads To");
define_once("_MOVEDADSSTATUS","New status of moved Ads");
define_once("_NOCHANGES","No Changes");
define_once("_POSEXAMPLE","You can have a look at the file <i>/blocks/block-Advertising.php</i> and file <i>/header.php</i> to have a clear example on how to implement this in your site.");
define_once("_ADDEDDATE","Added Date");
define_once("_DELETEALLADS","Delete All Banners");
define_once("_ADSNOCLIENT","<strong>Error:</strong> There isn't any Advertising Client.<br>Please create a new client before add banners.");
define_once("_INACTIVEBANNERS","Inactive Banners");
define_once("_EXTRAINFO","Extra Info");
define_once("_EDITCLIENT","Edit Advertising Client");
define_once("_ALTTEXT","Alternate Text");
define_once("_IMAGESWFURL","Image or Flash file URL");
define_once("_TERMS","Terms");
define_once("_PLANSPRICES","Plans & Prices");
define_once("_EDITTERMS","Edit Terms of Service");
define_once("_TERMSOFSERVICEBODY","Terms of Service Body");
define_once("_COUNTRYNAME","Your Country Name");
define_once("_TERMSNOTE","Carefuly review the default Terms. Change whatever you want to change according with your advertising politics. This will be published in the Advertising module.");
define_once("_SITENAMEADS","(To embed your site name into the text use [sitename] and to use your country name type [country] in the text and it will be replaced from Advertising module)");
define_once("_ADSMODULEINACTIVE","[ Warning: Advertising Module is inactive! ]");
define_once("_ADDADVERTISINGPLAN","Add Advertising Plan");
define_once("_ADVERTISINGPLANS","Advertising Plans");
define_once("_PLANNAME","Plan Name");
define_once("_DELIVERY","Delivery Mode");
define_once("_PLANDESCRIPTION","Plan Description");
define_once("_DELIVERYQUANTITY","Delivery Quantity");
define_once("_DELIVERYTYPE","Delivery Mode");
define_once("_PLANBUYLINKS","Buy Links1");
define_once("_PLANBUYLINKS2","Buy Links2");
define_once("_INITIALSTATUS","Initial Status");
define_once("_ADDNEWPLAN","Add New Plan");
define_once("_PLANSNOTE","Plans are for reference only and will be published at the Advertising module so your clients know what you have to offer, conditions, prices and a link to pay for your service.");
define_once("_ADDPLANERROR","<strong>Error:</strong> One or more fields are empty. Please go back and correct the problem.");
define_once("_PDAYS","Days");
define_once("_PMONTHS","Months");
define_once("_PYEARS","Years");
define_once("_PRICE","Price");
define_once("_ADVERTISINGPLANEDIT","Advertising Plan Edit");
define_once("_DELETEPLAN","Delete Ads Plan");
define_once("_SURETODELPLAN","Your are about to delete an Advertising Plan. Are you sure you want to proceed?");
define_once("_CANTDELETEPOSITION","<strong>Error:</strong> You can't delete ALL positions. At least one should be in the database.<br>Edit the position if you need to change it or add a new one.");
define_once("_BANNERNAME","Banner Name");
define_once("_CLIENT","Client");
define_once("_YEARS","Years");
define_once("_MONTHS","Months");
define_once("_WARNING","Warning");
