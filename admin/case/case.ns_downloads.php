<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

$module_name = "Downloads";
include_once("admin/modules/NukeStyles/EDL/language/lang-".$currentlang.".php");

switch($op) {

    case "ns_edl_general":
    case "ns_edl_gensave":
    include_once("admin/modules/ns_edl_general.php");
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
    include_once("admin/modules/NukeStyles/EDL/ns_edl_table.php");
    break;
    
    case "ns_edl_desc_img":
    case "ns_edl_desc_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_desc_img.php");
    break;
    
    case "ns_edl_addmodify":
    case "ns_edl_addmodsave":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_addmodify.php");
    break;

    case "ns_edl_rating":
    case "ns_edl_ratesave":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_rating.php");
    break;

    case "ns_edl_add_featured":
	case "ns_edl_add_featured_save":
	case "ns_edl_list_featured":
    case "ns_edl_remove_featured":
    case "ns_edl_set_featured":
    case "ns_edl_set_featured_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_featured.php");
    break;
    
    case "ns_edl_newpop":
    case "ns_edl_newpopsave":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_newpop.php");
    break;
    
    case "ns_edl_upload":
    case "ns_edl_upsave":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_upload.php");
    break;
    
    case "ns_edl_field":
    case "ns_edl_field_save":
    case "ns_edl_field_add":
    case "ns_edl_field_add_save":
    case "ns_edl_field_edit":
    case "ns_edl_field_edit_save":
    case "ns_edl_field_delete":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_field.php");
    break;

    case "ns_edl_manage":
    case "ns_edl_manage_fileall":
    case "ns_edl_manage_imgall":
    case "ns_edl_manage_delfile":
    case "ns_edl_manage_delimg":
    case "ns_edl_manage_delallfile":
    case "ns_edl_manage_delallimg":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_manage.php");
    break;
       
    case "ns_help_edl":
    include_once("admin/modules/NukeStyles/EDL/help/ns_edl_help.php");
    break;

    case "ns_edl_recom":
    case "ns_edl_recom_astats":
    case "ns_edl_recom_stats_purge":
    case "ns_edl_recom_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_recommend.php");
    break;

    case "ns_edl_fetch":
    case "ns_edl_fetch_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_fetch.php");
    break;

    case "ns_edl_author":
    case "ns_edl_author_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_author.php");
    break;

    case "ns_edl_blocks":
    case "ns_edl_blocks_save":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_blocks.php");
    break;

    case "ns_edl_group":
    case "ns_edl_groupsave":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_groups.php");
    break;
       
    case "ns_edl_batch":
    include_once("admin/modules/NukeStyles/EDL/ns_edl_batch.php");
    break;
       
}

?>