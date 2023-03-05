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

define("_ADMINMAIN","Main Admin ");
define("_MENU","Advertising Administration ");
define("_ADBLOCKS","Ad Blocks");

define("_ENDDATE","End Date");

define("_BANNERCLIENTS","Banners & Clients");

define("_ADSFRONTSIDE","Frontside");

define("_ADSUPLOAD","Upload banner files!");

define("_ADVIEWBANNERS","View banner files!");

define("_ADSPATH","Image path is:");

define("_ADSPATH2","Set the above folder to CHMOD 777 - This allows it to recieve uploads");

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

define("_ADDNEWBANNER","Add Banner");

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

define("_POSITIONNOTE","To use the position you must include the code: <i> ads(position);</i> in your theme file, where \"position\" is the number of the position you want to use in that ad space.");

define("_XFORUNLIMITED","write X for unlimited");

define("_IMPPURCHASED","Impressions Purchased");

define("_IMPMADE","Impressions Made");

define("_ADINFOINCOMPLETE","<strong>Error:</strong> Banner Information is Incomplete!");

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
