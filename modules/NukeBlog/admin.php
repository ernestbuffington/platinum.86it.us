<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// NukeBlog by Trevor Scott (http://www.trevor.net)                                 //
// ///////////////////////////////////////////////////////////////////////////////////
if (!preg_match("/modules.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Standard PHPNuke framework.														//
// ///////////////////////////////////////////////////////////////////////////////////
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
// ///////////////////////////////////////////////////////////////////////////////////
// Create self referencing path.													//
// ///////////////////////////////////////////////////////////////////////////////////
$self = "modules.php?name=" . $module_name . "&file=admin";
// ///////////////////////////////////////////////////////////////////////////////////
// Fetch admin associated data.														//
// ///////////////////////////////////////////////////////////////////////////////////
$admin = base64_decode($admin);
$admin = explode(":", $admin);
$aid = "$admin[0]";
$pwd = "$admin[1]";
$aid = trim($aid);
// ///////////////////////////////////////////////////////////////////////////////////
// Is the current user a super admin? Only super admins may admin this module.		//
// ///////////////////////////////////////////////////////////////////////////////////
$sql = "SELECT radminsuper FROM " . $prefix . "_authors WHERE aid =  '" . $aid . "'";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $radminsuper = $row[radminsuper];
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Include common library and admin functions.										//
// ///////////////////////////////////////////////////////////////////////////////////
include_once("modules/" . $module_name . "/functions/functions_common.php");
include_once("modules/" . $module_name . "/functions/functions_admin.php");
// ///////////////////////////////////////////////////////////////////////////////////
// Turn right side blocks on or off.												//
// ///////////////////////////////////////////////////////////////////////////////////
$index = get_config("right_blocks");
// ///////////////////////////////////////////////////////////////////////////////////
// Deny access to non-superadmins.													//
// ///////////////////////////////////////////////////////////////////////////////////
if ($radminsuper != 1) {
    include_once("header.php");
    echo("<div align=\"center\" class=\"title\">Access Denied!</a>");
    include_once("footer.php");
    include_once("includes/counter.php");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// More PHPNuke stuff. :)															//
// ///////////////////////////////////////////////////////////////////////////////////
include_once("header.php");
// ///////////////////////////////////////////////////////////////////////////////////
// Display NukeBlog Admin menu.														//
// ///////////////////////////////////////////////////////////////////////////////////
admin_menu();
switch ($op) {

    case "alert_remove":
        alert_remove($alert_id);
        break;

    case "admin_alerts":
        admin_alerts();
        break;

    case "author_list":
        author_list($orderby,$direction);
        break;

    case "author_strip":
        author_strip($user_id,$step,$method);
        break;

    case "mood_save":
        mood_save($form);
        break;

    case "mood_add":
        mood_add();
        break;

    case "mood_remove":
        mood_remove($mood_id, $step, $numood);
        break;

    case "mood_update":
        mood_update($mood_id,$form);
        break;

    case "mood_edit":
        mood_edit($mood_id);
        break;

    case "mood_list":
        mood_list();
        break;

    case "blog_do_comment":
        blog_do_comment($comm_id);
        break;

    case "remove_comment":
        remove_comment();
        break;

    case "blog_do_remove":
        blog_do_remove($blog_id, $mess_body);
        break;

    case "remove_blog":
        remove_blog();
        break;

    case "blog_settings_update":
        blog_settings_update($blog_page, $blog_wrap, $bad_words, $show_sql, $blog_admin, $right_blocks, $points_blog, $points_comment, $mass_remove);
        break;

    case "settings":
        blog_settings();
        break;

    default:
        nb_news();
        break;
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Finish up the display. And complete PHPNuke framework.							//
// ///////////////////////////////////////////////////////////////////////////////////
include_once("footer.php");
include_once("includes/counter.php");

?>