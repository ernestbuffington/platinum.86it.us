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

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
$module_name = "Advertising";
include_once("modules/$module_name/admin/language/lang-".$currentlang.".php");

switch($op) {

    case "BannersAdmin":
    case "BannersAdd":
    case "BannerAddClient":
    case "BannerDelete":
    case "BannerEdit":
    case "BannerChange":
    case "BannerClientDelete":
    case "BannerClientEdit":
    case "BannerClientChange":
    case "BannerStatus":
    case "add_banner":
    case "add_client":
    case "ad_positions":
    case "position_add":
    case "position_save":
    case "position_edit":
    case "position_delete":
    case "ad_terms":
	case "ad_plans":
	case "ad_plans_add":
	case "ad_plans_edit":
	case "ad_plans_save":
	case "ad_plans_delete":
	case "ad_plans_status":
	case "frontpage":
	case "campaigns":
	case "cancel":
	case "stats":
	case "thanks":
	case "CheckImages":
    include_once("modules/$module_name/admin/index.php");
    break;

}

?>