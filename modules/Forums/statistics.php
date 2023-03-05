<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

$index = 1;

$module_name = basename(dirname(__FILE__));
require_once("modules/".$module_name."/nukebb.php");


define('IN_PHPBB', true);
//$phpbb_root_path = "./";
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

//
//Start user modifiable variables
//
$return_limit = 10;
//Vote Images based on the theme path, (i.e. templates/CURRNT_THEME/ is already inserted)
$vote_left = "images/vote_lcap.gif";
$vote_right = "images/vote_rcap.gif";
$vote_bar = "images/voting_bar.gif";
//
//End user modifiable variables
//

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_statistics.' . $phpEx);

// Do the math :) (i think this is the same method as in philip mayer's statistic's file)
// Taken from Acyd Burn.
function do_math($firstval, $value, $total, &$percentage, &$bar_percent)
{
        $cst = ($firstval > 0) ? 90 / $firstval : 90;

        if ( $value != 0  )
        {
                $percentage = ( $total ) ? round( min(100, ($value / $total) * 100)) : 0;
        }
        else
        {
                $percentage = 0;
        }

        $bar_percent = round($value * $cst);
}

$template->set_filenames(array(
"body" => "statistics.tpl"));

$template->assign_vars(array(
"GRAPH_IMAGE" => $graph_image,

"L_ADMIN_STATISTICS" => $lang['Admin_Stats'],
"L_TOP_SMILIES" => $lang['Top_Smilies'],
"L_MOST_ACTIVE" => $lang['Most_Active_Topics'],
"L_MOST_VIEWED" => $lang['Most_Viewed_Topics'],
"L_TOP_POSTERS" => $lang['Top_Posting_Users'],

"L_USES" => $lang['Uses'],
"L_RANK" => $lang['Rank'],
"L_PERCENTAGE" => $lang['Percent'],
"L_GRAPH" => $lang['Graph'],
"L_REPLIES" => $lang['Replies'],
"L_TOPIC" => $lang['Topic'],
"L_VIEWS" => $lang['Views'],
"L_USERNAME" => $lang['Username'],
"L_POSTS" => $lang['Posts'],
"L_STATISTIC" => $lang['Statistic'],
"L_VALUE" => $lang['Value'],
"L_IMAGE" => $lang['smiley_url'],
"L_CODE" => $lang['smiley_code'],
"PAGE_NAME" => $lang['Statistics'])
);

//
// Authorization SQL
//

$auth_data_sql = "";
$sql = "SELECT forum_id
FROM " . FORUMS_TABLE;

if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve forum_id data", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result)) {
        $is_auth = auth('auth_view', $row['forum_id'], $userdata);
        if ($is_auth['auth_view'])
        {
                $auth_data_sql .= ( $auth_data_sql != "") ? ", " . $row['forum_id'] : $row['forum_id'];
        }
}

//
// Getting voting bar info
//
if( !$board_config['override_user_style'] )
{
        if( ($userdata['user_id'] != ANONYMOUS) && (isset($userdata['user_style'])) )
        {
                $style = $userdata['user_style'];
                if( !$theme )
                {
                        $style =  $board_config['default_style'];
                }
        }
        else
        {
                $style =  $board_config['default_style'];
        }
}
else
{
        $style =  $board_config['default_style'];
}

$sql = "SELECT *
FROM " . THEMES_TABLE . "
WHERE themes_id = $style";

if ( !($result = $db->sql_query($sql)) )
{
        message_die(CRITICAL_ERROR, "Couldn't query database for theme info.");
}

if( !$row = $db->sql_fetchrow($result) )
{
        message_die(CRITICAL_ERROR, "Couldn't get theme data for themes_id=$style.");
}

$current_template_path = 'modules/Forums/templates/' . $row['template_name'] . '/';

$template->assign_vars(array(
        'LEFT_GRAPH_IMAGE' => $current_template_path . $vote_left,
        'RIGHT_GRAPH_IMAGE' => $current_template_path . $vote_right,
        'GRAPH_IMAGE' => $current_template_path . $vote_bar)
);

//
// Top posters SQL
//
$sql = "SELECT user_id, username, user_posts
FROM " . USERS_TABLE . "
WHERE user_id <> " . ANONYMOUS . "
AND user_posts > 0
ORDER BY user_posts DESC
LIMIT " . $return_limit;

if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve users data", "", __LINE__, __FILE__, $sql);
}

$user_count = $db->sql_numrows($result);
$user_data = $db->sql_fetchrowset($result);
$percentage = 0;
$bar_percent = 0;

$firstcount = $user_data[0]['user_posts'];

for ($i = 0; $i < $user_count; $i++)
{
        do_math($firstcount, $user_data[$i]['user_posts'], get_db_stat('postcount'), $percentage, $bar_percent);

        $template->assign_block_vars("users", array(
        "RANK" => $i+1,
        "CLASS" => ( !($i+1 % 2) ) ? $theme['td_class2'] : $theme['td_class1'],
        "USERNAME" => $user_data[$i]['username'],
        "PERCENTAGE" => $percentage,
        "BAR" => $bar_percent,
        "URL" => "modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $user_data[$i]['user_id'],
        "POSTS" => $user_data[$i]['user_posts'])
        );
}

//
// Most active topics SQL
//
$sql = "SELECT topic_id, topic_title, topic_replies
FROM " . TOPICS_TABLE ."
WHERE forum_id IN ($auth_data_sql)
AND topic_status <> 2
AND topic_replies > 0
ORDER BY topic_replies DESC
LIMIT " . $return_limit;

if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve topic data", "", __LINE__, __FILE__, $sql);
}

$topic_data = $db->sql_fetchrowset($result);

for ($i = 0; $i < count($topic_data); $i++)
{
        $template->assign_block_vars("topicreplies", array(
        "RANK" => $i+1,
        "CLASS" => ( !($i+1 % 2) ) ? $theme['td_class2'] : $theme['td_class1'],
        "TITLE" => $topic_data[$i]['topic_title'],
        "REPLIES" => $topic_data[$i]['topic_replies'],
        "URL" => $nuke_file_path . "viewtopic&t=" . $topic_data[$i]['topic_id'])
        );
}

//
// Most viewed topics SQL
//
$rank = 0;
$sql = "SELECT topic_id, topic_title, topic_views
FROM " . TOPICS_TABLE ."
WHERE forum_id IN ($auth_data_sql)
AND topic_status <> 2
AND topic_views > 0
ORDER BY topic_views DESC
LIMIT " . $return_limit;

if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve topic data", "", __LINE__, __FILE__, $sql);
}

$topic_data = $db->sql_fetchrowset($result);

for ($i = 0; $i < count($topic_data); $i++)
{
        $template->assign_block_vars("topicviews", array(
        "RANK" => $i+1,
        "CLASS" => ( !($i+1 % 2) ) ? $theme['td_class2'] : $theme['td_class1'],
        "TITLE" => $topic_data[$i]['topic_title'],
        "VIEWS" => $topic_data[$i]['topic_views'],
        "URL" => $nuke_file_path . "viewtopic&t=" . $topic_data[$i]['topic_id'])
        );
}

//
// Get forum statistics (taken from admin panel)
//
$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');

$start_date = create_date($board_config['default_dateformat'], $board_config['board_startdate'], $board_config['board_timezone']);

$boarddays = ( time() - $board_config['board_startdate'] ) / 86400;

$posts_per_day = sprintf("%.2f", $total_posts / $boarddays);
$topics_per_day = sprintf("%.2f", $total_topics / $boarddays);
$users_per_day = sprintf("%.2f", $total_users / $boarddays);

$avatar_dir_size = 0;

if ($avatar_dir = @opendir($board_config['avatar_path']))
{
        while( $file = @readdir($avatar_dir) )
        {
                if( $file != "." && $file != ".." )
                {
                        $avatar_dir_size += @filesize($board_config['avatar_path'] . "/" . $file);
                }
        }
        @closedir($avatar_dir);

        //
        // This bit of code translates the avatar directory size into human readable format
        // Borrowed the code from the PHP.net annoted manual, origanally written by:
        // Jesse (jesse@jess.on.ca)
        //
        if($avatar_dir_size >= 1048576)
        {
                $avatar_dir_size = round($avatar_dir_size / 1048576 * 100) / 100 . " MB";
        }
        else if($avatar_dir_size >= 1024)
        {
                $avatar_dir_size = round($avatar_dir_size / 1024 * 100) / 100 . " KB";
        }
        else
        {
                $avatar_dir_size = $avatar_dir_size . " Bytes";
        }

}
else
{
        // Couldn't open Avatar dir.
        $avatar_dir_size = $lang['Not_available'];
}

if($posts_per_day > $total_posts)
{
        $posts_per_day = $total_posts;
}

if($topics_per_day > $total_topics)
{
        $topics_per_day = $total_topics;
}

if($users_per_day > $total_users)
{
        $users_per_day = $total_users;
}

//
// DB size ... MySQL only
//
// This code is heavily influenced by a similar routine
// in phpMyAdmin 2.2.0
//
if( preg_match("/^mysql/", SQL_LAYER) )
{
        $sql = "SELECT VERSION() AS mysql_version";
        if($result = $db->sql_query($sql))
        {
                $row = $db->sql_fetchrow($result);
                $version = $row['mysql_version'];

                if( preg_match("/^(3\.23|4\.)/", $version) )
                {
                        $db_name = ( preg_match("/^(3\.23\.[6-9])|(3\.23\.[1-9][1-9])|(4\.)/", $version) ) ? "`$dbname`" : $dbname;

                        $sql = "SHOW TABLE STATUS
                        FROM " . $db_name;
                        if($result = $db->sql_query($sql))
                        {
                                $tabledata_ary = $db->sql_fetchrowset($result);

                                $dbsize = 0;
                                for($i = 0; $i < count($tabledata_ary); $i++)
                                {
                                        if( $tabledata_ary[$i]['Type'] != "MRG_MyISAM" )
                                        {
                                                if( $table_prefix != "" )
                                                {
                                                        if( strstr($tabledata_ary[$i]['Name'], $table_prefix) )
                                                        {
                                                                $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                                                        }
                                                }
                                                else
                                                {
                                                        $dbsize += $tabledata_ary[$i]['Data_length'] + $tabledata_ary[$i]['Index_length'];
                                                }
                                        }
                                }

                                if( $dbsize >= 1048576 )
                                {
                                        $dbsize = sprintf("%.2f MB", ( $dbsize / 1048576 ));
                                }
                                else if( $dbsize >= 1024 )
                                {
                                        $dbsize = sprintf("%.2f KB", ( $dbsize / 1024 ));
                                }
                                else
                                {
                                        $dbsize = sprintf("%.2f Bytes", $dbsize);
                                }
                        } // Else we couldn't get the table status.
                }
                else
                {
                        $dbsize = $lang['Not_available'];
                }
        }
        else
        {
                $dbsize = $lang['Not_available'];
        }
}
else
{
        $dbsize = $lang['Not_available'];
}

//
//Newest user data
//
$newest_userdata = get_db_stat('newestuser');
$newest_user = $newest_userdata['username'];
$newest_user_id = $newest_userdata['user_id'];
$sql = "SELECT user_regdate
FROM " . USERS_TABLE . "
WHERE user_id = " . $newest_userdata['user_id'] . "
LIMIT 1";
if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve users data", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$newest_user_date = $row['user_regdate'];

//
//Most Online data
//
$sql = "SELECT *
FROM " . CONFIG_TABLE . "
WHERE config_name = 'record_online_users'
OR config_name = 'record_online_date'";

if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve configuration data", "", __LINE__, __FILE__, $sql);
}

$row = $db->sql_fetchrow($result);
$most_users_date = ($row['config_value'] > 0) ? create_date($board_config['default_dateformat'], $row['config_value'], $board_config['board_timezone']) : $most_users_date = $lang['Not_available'];

$row = $db->sql_fetchrow($result);
$most_users = ($row['config_value'] > 0) ? $row['config_value'] : $lang['Not_available'];

$statistic_array = array($lang['Number_posts'],$lang['Posts_per_day'],$lang['Number_topics'],$lang['Topics_per_day'],$lang['Number_users'],$lang['Users_per_day'],$lang['Board_started'],$lang['Board_Up_Days'],$lang['Database_size'],$lang['Avatar_dir_size'],$lang['Latest_Reg_User_Date'],$lang['Latest_Reg_User'],$lang['Most_Ever_Online_Date'],$lang['Most_Ever_Online'],$lang['Gzip_compression']);
$value_array = array($total_posts, $posts_per_day, $total_topics, $topics_per_day, $total_users, $users_per_day, $start_date, sprintf('%.2f', $boarddays), $dbsize, $avatar_dir_size, $newest_user_date, sprintf('<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_user_id") . '">' . $newest_user . '</a>'), $most_users_date, $most_users, ( $board_config['gzip_compress'] ) ? $lang['Enabled'] : $lang['Disabled']);

for ($i = 0; $i < count($statistic_array); $i += 2)
{
        $template->assign_block_vars("adminrow", array(
        "STATISTIC" => $statistic_array[$i],
        "VALUE" => $value_array[$i],
        "STATISTIC2" => (isset($statistic_array[$i+1])) ? $statistic_array[$i + 1] : "",
        "VALUE2" => (isset($value_array[$i+1])) ? $value_array[$i + 1] : "")
        );
}
//
// End forum statistics
//

//
// Most used smilies
//
$sql = "SELECT SUM(smile_stat) as total
FROM " . SMILIES_TABLE;
if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve smilie data", "", __LINE__, __FILE__, $sql);
}
$row = $db->sql_fetchrow($result);
$total_post_perc = $row['total'];

$sql = "SELECT code, smile_url, smile_stat
FROM " . SMILIES_TABLE . "
WHERE smile_stat > 0
ORDER BY smile_stat DESC
LIMIT " . $return_limit;


if (!$result = $db->sql_query($sql))
{
        message_die(GENERAL_ERROR, "Couldn't retrieve smilie data", "", __LINE__, __FILE__, $sql);
}

$smilie_data = $db->sql_fetchrowset($result);
$top_perc = $smilie_data[0]['smile_stat'];

if ($top_perc)
{
        for ($i = 0; $i < count($smilie_data); $i++)
        {
                do_math($top_perc, $smilie_data[$i]['smile_stat'], $total_post_perc, $percentage, $bar_percent);

                $template->assign_block_vars("topsmilies", array(
                "RANK" => $i+1,
                "CLASS" => ( !($i+1 % 2) ) ? $theme['td_class2'] : $theme['td_class1'],
                "CODE" => $smilie_data[$i]['code'],
                "USES" => $smilie_data[$i]['smile_stat'],
                "PERCENTAGE" => $percentage,
                "BAR" => $bar_percent,
                "URL" => '<img src="'. $board_config['smilies_path'] . '/' . $smilie_data[$i]['smile_url'] . '" alt="' . $smilie_data[$i]['smile_url'] . '" border="0">')
                );
        }
}
//
//Output the page
//
$page_title = $lang['Statistics'];
include_once('includes/page_header.'.$phpEx);

$template->pparse("body");

include_once('includes/page_tail.'.$phpEx);

?>
