<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// NukeBlog by Trevor Scott					                                        //
// ///////////////////////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////////////////////
// Take care of PHPNuke related framework.											//
// ///////////////////////////////////////////////////////////////////////////////////
if ( !defined('MODULE_FILE') ) {
    die ('You can\'t access this file directly...');
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$self = "modules.php?name=" . $module_name . "&file=blog";
// ///////////////////////////////////////////////////////////////////////////////////
// Block non-users from viewing the blog system.			                        //
// ///////////////////////////////////////////////////////////////////////////////////
if (!$user) {
    include_once("header.php");
    opentable();
    center("<span class=\"title\">" . _NB_RESTRICTED . "</span>");
    closetable();
    br();
    opentable();
    center(_NB_MEMREQ);
    closetable();
    include_once("footer.php");
    include_once("includes/counter.php");
    die();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Include core functionality.														//
// ///////////////////////////////////////////////////////////////////////////////////
include_once("modules/$module_name/functions/functions_common.php");
include_once("modules/$module_name/functions/functions_blog.php");

// ///////////////////////////////////////////////////////////////////////////////////
// Turn right side blocks on or off through NukeBlog Admin Panel.					//
// ///////////////////////////////////////////////////////////////////////////////////
$index = get_config("right_blocks");
define('INDEX_FILE', true); //comment this out to hide right blocks
// ///////////////////////////////////////////////////////////////////////////////////
// Condition user identification variable into a "better" format.					//
// ///////////////////////////////////////////////////////////////////////////////////
$temp_user = base64_decode($user);
$temp_cookie = explode(":", $temp_user);
$sql = "SELECT user_id, username FROM " . $user_prefix . "_users WHERE username='" . $temp_cookie[1] . "'";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $nb_user[user_id] = $row[user_id];
    $nb_user[username] = $row[username];
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Auto-set $offset to the number stored in the database.						//
// ///////////////////////////////////////////////////////////////////////////////////
if (!$offset) {
    $offset = 0;
} 
include_once("header.php");
user_menu();
switch ($op) {

    case "message_remove":
        friend_menu();
        message_remove($mess_id);
        break;

    case "remove_bulk":
        friend_menu();
        remove_bulk($rem_uid);
        break;

    case "add_bulk":
        friend_menu();
        add_bulk($add_uid);
        break;

    case "remove_single":
        friend_menu();
        remove_single($friend_uid);
        break;

    case "add_single":
        friend_menu();
        add_single($form_data);
        break;

    case "blog_friends":
        friend_menu();
        blog_friends();
        break;

    case "friends_list":
        friend_menu();
        friends_list();
        break;

    case "fetch_blog":
        fetch_blog($blog_id);
        break;

    case "comment_remove":
        comment_remove($comm_id);
        break;

    case "blog_remove":
        blog_remove($blog_id, $step);
        break;

    case "blog_action":
        blog_action($form, $blog_id);
        break;

    case "blog_alter":
        blog_form($blog_id);
        break;

    case "blog_add":
        blog_form();
        break;

    case "blog_list":
        blog_list($offset);
        break;

    default:
        blog_list($offset);
        break;
} 
include_once("footer.php");
include_once("includes/counter.php");
die();
?>