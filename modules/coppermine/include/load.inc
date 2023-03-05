<?php 
if (preg_match("/load.inc/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
//define('SILLY_SAFE_MODE', 1);
global $cpg_dir;
$CPG_VERSION = ' 1.3.2';
if (!isset($cpg_block)) $cpg_block = 0;
if (!defined('IN_COPPERMINE')) define('IN_COPPERMINE', true);
if (!isset($name)) $name = $GLOBALS['name']; // postnuke
if (!isset($cpg_dir)) $cpg_dir = $name;
if (!function_exists('getlink')) {
function getlink($str="", $UseSEO=true) {
    global $cpg_dir;
    if ($str != '') {
        if ($str[0] == '&' && $cpg_dir != '') $str = $cpg_dir.$str;
        $url = (!defined('IN_POSTNUKE')) ? "modules.php?name=" : "modules.php?op=modload&name=";
        $url .= $str;
    }
    else $url = $CPG_M_URL;
    return $url;
}
}
global $CONFIG, $CURRENT_ALBUM_DATA, $CPG_URL, $cookie, $Version_Num;
// language variables not declared global else where
global $lang_user_admin_menu, $lang_gallery_admin_menu, $lang_cat_list,
       $lang_get_pic_data,    $lang_pagetitle_php,      $lang_charset,
       $lang_text_dir,        $lang_byte_units,         $lang_day_of_week,
       $lang_month,           $lang_yes,                $lang_no,
       $lang_back,            $lang_continue,           $lang_info,
       $lang_error,           $album_date_fmt,          $lastcom_date_fmt,
       $lastup_date_fmt,      $lasthit_date_fmt,        $comment_date_fmt,
       $lang_picinfo,         $lang_album_admin_menu;
global $template_tab_display, $template_user_list_info_box, $template_album_admin_menu; // index.php
global $template_img_navbar,  $template_display_picture,    $template_image_rating,
       $template_image_comments, $template_add_your_comment; // displayimage.php
global $template_cpg_die, $template_msg_box; // functions.inc.php
global $template_ecard;                      // displayecard.php
global $template_edit_one_pic;               // editDesc.inc.php
global $field_user_id, $field_user_pass, $field_user_name, $field_user_email, $field_user_from;
global $first_install_M_DIR,$CPG_PROFILE_URL;
$CPG_M_DIR = "modules/" . $cpg_dir;
// load postnuke specific part
if (!isset($Version_Num)) {
    if (!defined('IN_POSTNUKE')) {
        require_once($CPG_M_DIR . "/include/postnuke.inc");
    }
    $CPG_URL = getlink($cpg_dir, false);
    $CPG_M_URL = $CPG_URL."&file=index";
    $CPG_PROFILE_URL = "user.php?op=userinfo&uname=";
    if (!defined('_BREG')) {
        define("_BREG", "Register");
    }
} else {
    $CPG_URL = getlink($cpg_dir, false);
    $CPG_M_URL = $CPG_URL;
    $CPG_PROFILE_URL = getlink("Forums&amp;file=profile&amp;mode=viewprofile&amp;u=", false);
    if (!defined('LOGOUT_URL')) {
        define('LOGOUT_URL', getlink("Your_Account&amp;op=logout"));
        define('LOGIN_URL', getlink("Your_Account")); //&redirect=$name doesn't was it tested?
        define('NEWUSER_URL', getlink("Your_Account&amp;op=new_user"));
        define('ADDUSER_URL', "admin.php?op=mod_users");
        define('USERPROF_URL', getlink("Your_Account&amp;op=edituser"));
    }
    if (!$cpg_block) $module_name = $name;
    // load phpnuke 5.5-6.0 specific part
    if ($Version_Num[0] == 5 || $Version_Num == "6.0") {
        global $dbi;
        if (!defined('IN_OLDNUKE')) {
            require_once($CPG_M_DIR . "/include/oldnuke.inc");
        }
    } 
    // load phpnuke 6.5+ specific part
    else {
        $field_user_id = "user_id";
        $field_user_name = "username";
        $field_user_pass = "user_password";
        $field_user_email = "user_email";
        $field_user_from = "user_from";
    }
    $field_user_regdate = "user_regdate";
    $field_user_avatar = "user_avatar";
} 
if (!defined('INSTALL_PHP')) {
    // load required settings for this install
    $result = $db->sql_fetchrow($db->sql_query("SELECT prefix, dirname FROM ".$prefix."_cpg_installs WHERE dirname='$cpg_dir'"));
    if (!$result || $result[1] != $cpg_dir) {
        header('Location: '.getlink("&file=install"));
        exit;
    }
    $cpg_prefix = $result[0];
    // $first_install_M_DIR gets the first installs module directory is used for language detection
    // can be used for other file that are not required to be different between installs
    $result = $db->sql_fetchrow($db->sql_query("SELECT dirname FROM ".$prefix."_cpg_installs WHERE  cpg_id=1"));
    $first_install_M_DIR = "modules/" .$result[0];
    require($CPG_M_DIR . '/include/init.inc');
    if (!defined('NO_HEADER') && !defined('IN_POSTNUKE')) {
        // Set nice page title
        $pagetitle = "> ".$CONFIG['gallery_name'];
        $sql = "SELECT value FROM " . $cpg_prefix . "config WHERE name='nice_titles'";
        $value = $db->sql_fetchrow($db->sql_query($sql));
        if ($value[0]) {
            $breadcrumb = array();
            if (is_numeric($album) && $album > 0) {
                $result = db_query("SELECT aid AS id, title, category AS parent FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid = ".$album);
                if (mysql_num_rows($result) > 0) {
                    $breadcrumb[] = mysql_fetch_array($result);
                    mysql_free_result($result);
                }
            }
            else if (is_numeric($cat) && $cat > 0) {
                if ($cat > FIRST_USER_CAT) {
                    $result = db_query("SELECT $field_user_name AS title FROM {$CONFIG['TABLE_USERS']} WHERE $field_user_id = " . ($cat - FIRST_USER_CAT));
                    if (mysql_num_rows($result) != 0) {
                        $row = mysql_fetch_array($result);
                        $row['id'] = $cat;
                        $row['parent'] = 1;
                        $breadcrumb[] = $row;
                        mysql_free_result($result);
                    }
                }
                else {
                    $result = db_query("SELECT cid as id, parent, catname AS title FROM {$CONFIG['TABLE_CATEGORIES']} WHERE cid='$cat'");
                    if (mysql_num_rows($result) > 0) {
                        $breadcrumb[] = mysql_fetch_array($result);
                        mysql_free_result($result);
                    }
                }
            }
            get_breadcrumb($breadcrumb);
            foreach($breadcrumb as $crumb) {
                $pagetitle .= " > ".$crumb['title'];
            }
            if (!is_numeric($album)) switch ($album) {
                case 'lastup':
                case 'lastcom':
                case 'topn':
                case 'toprated':
                case 'search':
                case 'random':
                    $pagetitle .= " > ".$lang_meta_album_names[$album];
                    break;
            }else {
            //sorted by code
            }
            if ($pagetitle == "") $pagetitle = "> ".$CONFIG['gallery_name'];
        }
        else $pagetitle = "> ".$CONFIG['gallery_name'];
    }
}
?>
