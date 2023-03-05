<?php

######################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
global $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}
$module_name = "NukeC30";
switch($op) {
	case "NukeC30": 
	case "NukeC30AdminReport": 
	case "NukeC30AdminWaiting": 
	case "NukeC30EditWaiting":
	case "NukeC30DeleteWaiting":
	case "NukeC30PostWaiting":
	case "NukeC30AdminAds": 
	case "NukeC30ViewStats":
	case "NukeC30AdminDone":
	case "NukeC30DeleteAds":
	case "NukeC30EditAds":
	case "NukeC30DoEditAds" :
	case "NukeC30DeleteComment" :
	include_once("modules/$module_name/admin/nukec.php");break;
	case "NukeC30currency":
	case "NukeC30DeleteCurr":
	case "NukeC30EditCurr";
	case "NukeC30UpdateCurr";
	case "NukeC30AddCurr":
	include_once("modules/$module_name/admin/currency.php");break;
	case "NukeC30AdminCatg": 
	case "NukeC30SubmitCatg":
	case "NukeC30ModCatg":
	case "NukeC30SaveModCatg":
	case "NukeC30DeleteCatg":
	case "NukeC30UploadCatgImg":
	include_once("modules/$module_name/admin/category.php");break;
	case "NukeC30Setting":
	case "NukeC30SaveSetting":
	include_once("modules/$module_name/admin/setting.php");break;
	case "NukeC30Disclaimer":
	case "NukeC30AddDisclaimer":
	case "NukeC30SaveDisclaimer":
	case "NukeC30EditDisclaimer":
	case "NukeC30UpdateDisclaimer":
	case "NukeC30DeleteDisclaimer":
	include_once("modules/$module_name/admin/disclaimer.php");break;
	case "NukeC30Doc":
	include_once("modules/$module_name/admin/doc.php");break;
	case "NukeC30AdsDuration" :
	case "NukeC30AdsDurationAdd":
	case "NukeC30AdsDurationSave":
	case "NukeC30AdsDurationEdit" :
	case "NukeC30AdsDurationDelete" : 
	case "NukeC30AdsDurationUpdate":
	include_once("modules/$module_name/admin/duration.php");break;
	case "NukeC30AdsWordFilter" : 
	case "NukeC30AdsWordFilterAdd":
	case "NukeC30AdsWordFilterSave":  
	case "NukeC30AdsWordFilterEdit" : 
	case "NukeC30AdsWordFilterUpdate":
	case "NukeC30AdsWordFilterDelete" : 
	include_once("modules/$module_name/admin/filter.php");break;
	case "NukeC30CustomContent" : 
	case "NukeC30CustomContentOrder":
	case "NukeC30CustomContentAdd" :
	case "NukeC30CustomContentEdit" :
	case "NukeC30CustomContentChangeStatus" :
	case "NukeC30CustomContentDelete" :
	case "NukeC30CustomContentUpdate" :
	include_once("modules/$module_name/admin/customcontent.php");break;
}

?>