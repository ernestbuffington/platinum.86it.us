<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// NukeBlog by Trevor Scott					                                        //
// ///////////////////////////////////////////////////////////////////////////////////
// ///////////////////////////////////////////////////////////////////////////////////
// Take care of PHPNuke related framework.											//
// ///////////////////////////////////////////////////////////////////////////////////
if (!preg_match("#modules.php#", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
} 
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$self = "modules.php?name=" . $module_name . "&file=faq";
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
include_once("modules/$module_name/functions/functions_faq.php");

// ///////////////////////////////////////////////////////////////////////////////////
// Turn right side blocks on or off through NukeBlog Admin Panel.					//
// ///////////////////////////////////////////////////////////////////////////////////
$index = get_config("right_blocks");

include_once("header.php");
user_menu();
faq_menu();
switch ($op) {

    case "faqhome":
        faqhome();
        break;

    case "bbcode":
        bbcode();
        break;

    case "moods":
        moods();
        break;

    case "smilies":
        smilies();
        break;

    case "credits":
        credits();
        break;

    default:
        faqhome();
        break;
} 
include_once("footer.php");
include_once("includes/counter.php");
die();
?>