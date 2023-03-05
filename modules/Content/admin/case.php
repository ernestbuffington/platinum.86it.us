<?php
/**********************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0
/* Written by: Jonathan Estrella
/* http://slaytanic.sourceforge.net
/* Copyright (c) 2004-2008 Jonathan Estrella
/**********************************************/

if (!defined('ADMIN_FILE')) { die ('Access Denied'); }
$module_name = basename(dirname(dirname(__FILE__)));

if(file_exists(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$currentlang.'.php')) {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$currentlang.'.php');
} elseif(file_exists(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$language.'.php')) {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-'.$language.'.php');
} else {
	include_once(INCLUDE_PATH.'modules/'.$module_name.'/admin/language/lang-english.php');
}

switch($op) {
    case 'ContentPlus':
    case 'CPListPages':
    case 'CPListCats':
    case 'CPListPagesCat':
    case 'CPAddCategory':
    case 'CPAddPage':
    case 'CPPagesWaiting':
    case 'CPEdit':
    case 'CPDelete':
    case 'CPNewPageDelete':
    case 'content_review':
    case 'CPSave':
    case 'CPSaveEdit':
    case 'CPChangeStatus':
    case 'CPNewPageChangeStatus':
    case 'CPCategoryAddSave':
    case 'CPAddNewPage':
    case 'CPEditCat':
    case 'CPSaveCat':
    case 'CPDeleteCat':
    case 'CPFeat':
    case 'CPFeatSave':
	case 'CPAbout':
	case 'content':
	case 'CPShowCatImages':
    include_once('modules/'.$module_name.'/admin/index.php');
    break;
}
?>