<?php


if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

if (file_exists("modules/Downloads/admin/language/lang-".$currentlang.".php")) {
	include_once("modules/Downloads/admin/language/lang-".$currentlang.".php");
} else {
	include_once("modules/Downloads/admin/language/lang-english.php");
}	

switch($op) {

    case "downloads":
    case "downloads_add":
    case "downloads_add_cat":
    case "downloads_add_subcat":
    case "downloads_modify":
    case "downloads_modify_cat":
    case "downloads_transfer":
    case "downloads_disabled":
    case "downloads_disable":
    case "downloads_enable":
    case "DownloadsDelNew":
    case "DownloadsAddCat":
    case "DownloadsAddSubCat":
    case "DownloadsAddDownload":
    case "DownloadsAddEditorial":
    case "DownloadsModEditorial":
    case "DownloadsDownloadCheck":
    case "DownloadsValidate":
    case "DownloadsDelEditorial":
    case "DownloadsCleanVotes":
    case "DownloadsListBrokenDownloads":
    case "DownloadsDelBrokenDownloads":
    case "DownloadsIgnoreBrokenDownloads":
    case "DownloadsListModRequests":
    case "DownloadsChangeModRequests":
    case "DownloadsChangeIgnoreRequests":
    case "DownloadsDelCat":
    case "DownloadsModCat":
    case "DownloadsModCatS":
    case "DownloadsModDownload":
    case "DownloadsModDownloadS":
    case "DownloadsDelDownload":
    case "DownloadsDelVote":
    case "DownloadsDelComment":
    case "DownloadsTransfer":
    include_once("modules/Downloads/admin/index.php");
    break;

    case "ns_edl_general":
    case "ns_edl_gensave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_general.php");
    break;
    
    case "ns_edl_cancel":    
    case "ns_edl_table":
    case "ns_edl_table_activate":
    case "ns_edl_table_add":
    case "ns_edl_table_deactivate":
    case "ns_edl_table_delete":
    case "ns_edl_table_edit":
    case "ns_edl_table_list":
    case "ns_edl_table_loaded":
    case "ns_edl_table_modify":
    case "ns_edl_table_preview":
    case "ns_edl_table_preview_view":
    case "ns_edl_table_premodify":
    case "ns_edl_table_save":
    case "ns_edl_table_view":
    case "ns_edl_theme":
    case "ns_edl_theme_config":
    case "ns_edl_theme_install":
    case "ns_edl_theme_load":
    case "ns_edl_theme_mode":
    case "ns_edl_theme_save":
    case "ns_edl_theme_uninstall":
    case "ns_edl_theme_update":
    case "ns_edl_load_color":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_table.php");
    break;
    
    case "ns_edl_desc_img":
    case "ns_edl_desc_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_desc_img.php");
    break;
    
    case "ns_edl_addmodify":
    case "ns_edl_addmodsave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_addmodify.php");
    break;

    case "ns_edl_rating":
    case "ns_edl_ratesave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_rating.php");
    break;

    case "ns_edl_add_featured":
	case "ns_edl_add_featured_save":
	case "ns_edl_list_featured":
    case "ns_edl_remove_featured":
    case "ns_edl_set_featured":
    case "ns_edl_set_featured_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_featured.php");
    break;
    
    case "ns_edl_newpop":
    case "ns_edl_newpopsave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_newpop.php");
    break;
    
    case "ns_edl_upload":
    case "ns_edl_upsave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_upload.php");
    break;
    
    case "ns_edl_field":
    case "ns_edl_field_save":
    case "ns_edl_field_add":
    case "ns_edl_field_add_save":
    case "ns_edl_field_edit":
    case "ns_edl_field_edit_save":
    case "ns_edl_field_delete":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_field.php");
    break;

    case "ns_edl_manage":
    case "ns_edl_manage_fileall":
    case "ns_edl_manage_imgall":
    case "ns_edl_manage_delfile":
    case "ns_edl_manage_delimg":
    case "ns_edl_manage_delallfile":
    case "ns_edl_manage_delallimg":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_manage.php");
    break;
       
    case "ns_help_edl":
    include_once("modules/Downloads/admin/NukeStyles/EDL/help/ns_edl_help.php");
    break;

    case "ns_edl_recom":
    case "ns_edl_recom_astats":
    case "ns_edl_recom_stats_purge":
    case "ns_edl_recom_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_recommend.php");
    break;

    case "ns_edl_fetch":
    case "ns_edl_fetch_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_fetch.php");
    break;

    case "ns_edl_author":
    case "ns_edl_author_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_author.php");
    break;

    case "ns_edl_blocks":
    case "ns_edl_blocks_save":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_blocks.php");
    break;

    case "ns_edl_group":
    case "ns_edl_groupsave":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_groups.php");
    break;
       
    case "ns_edl_batch":
    include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_batch.php");
    break;

}

?>