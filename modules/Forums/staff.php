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

if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require_once("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
}

define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_STAFF, $session_length, $nukeuser);
init_userprefs($userdata); 

$page_title = $lang['Staff'];
include_once('includes/page_header.'.$phpEx); 

        $template->set_filenames(array(
                'body' => 'staff_body.tpl')
        );

// forums
// $sql = "SELECT ug.user_id, f.forum_id, f.forum_name
//           FROM " . FORUMS_TABLE . " f, " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug
//           LEFT JOIN  " . USER_GROUP_TABLE . " ug2  ON ug2.user_id = " . $userdata['user_id'] . "
//           LEFT JOIN  " . AUTH_ACCESS_TABLE . " aa2 ON aa2.group_id = ug2.group_id AND aa2.auth_view = " . TRUE . "
//           WHERE aa.auth_mod = " . TRUE . "
//                      AND ug.group_id = aa.group_id
 //                     AND f.forum_id = aa.forum_id
 //                     AND ( f.auth_view <= '.$auth.'
 //                     OR aa2.auth_view = " . TRUE . ")
 //          GROUP BY ug.user_id, ug2.user_id
  //        ORDER BY ug.user_id";
$sql = "SELECT ug.user_id, f.forum_id, f.forum_name
           FROM ".AUTH_ACCESS_TABLE." aa, ".USER_GROUP_TABLE." ug, ".FORUMS_TABLE." f
           WHERE aa.auth_mod = " . TRUE . "
                    AND ug.group_id = aa.group_id
                      AND f.forum_id = aa.forum_id";
if ( !$result = $db->sql_query($sql) ) 
{ 
        message_die(GENERAL_ERROR, 'Could not query forums.', '', __LINE__, __FILE__, $sql); 
} 
while( $row = $db->sql_fetchrow($result) ) 
{ 
        $forum_id = $row['forum_id'];
        $staff2[$row['user_id']][$row['forum_id']] = 'ø <a href='.append_sid("viewforum.$phpEx?f=$forum_id").' class=genmed>'.$row['forum_name'].'</a><br />'; 
} 

//main
$sql = "SELECT * FROM ".USERS_TABLE."
           WHERE user_level >= 2
           ORDER BY user_level = 3, user_level = 4";
if ( !($results = $db->sql_query($sql)) ) 
{ 
        message_die(GENERAL_ERROR, 'Could not obtain user information.', '', __LINE__, __FILE__, $sql); 
} 
while($staff = $db->sql_fetchrow($results)) 
{ 
        if ( $staff['user_avatar'] )
        {
                switch( $staff['user_avatar_type'] )
                {
                        case USER_AVATAR_UPLOAD:
		         	$avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $staff['user_avatar'] . '" border="0" />' : '';
			break;
                        case USER_AVATAR_REMOTE:
			$avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $staff['user_avatar'] . '" width="60" height="40" alt="" border="0" />' : '';
			break;
                        case USER_AVATAR_GALLERY:
			$avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $staff['user_avatar'] . '" alt="" border="0" />' : '';
			break;
                }
        }
        else
        {
                $avatar = '';
        }

        $level = ( $staff['user_level'] == 2 ) ? '<b style="color:#' . $theme['fontcolor3'] . '">'.$lang['Admin'].'</strong>' : '';
        $level .= ( $staff['user_level'] == 9 ) ? '<b style="color:#' . $theme['fontcolor1'] . '">'.$lang['Junior'].'</strong>' : '';
        $level .= ( $staff['user_level'] == 4 ) ? '<b style="color:#' . $theme['fontcolor1'] . '">'.$lang['Super'].'</strong>' : '';
        $level .= ( $staff['user_level'] == 3 ) ? '<b style="color:#' . $theme['fontcolor2'] . '">'.$lang['Mod'].'</strong>' : '';

        $forums = '';
        if ( !empty($staff2[$staff['user_id']]) ) 
        {  
                asort($staff2[$staff['user_id']]);
                $forums = implode(' ',$staff2[$staff['user_id']]); 
        }
        $regdate = $staff['user_regdate'];
        $nukedate = strtotime($regdate);
        $memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
        $posts_per_day = $staff['user_posts'] / $memberdays;
        if ( $staff['user_posts'] != 0 )
        {
                $total_posts = get_db_stat('postcount');
                $percentage = ( $total_posts ) ? min(100, ($staff['user_posts'] / $total_posts) * 100) : 0;
        }
        else
        {
                $percentage = 0;
        }
        $user_id = $staff['user_id'];
        $sql = "SELECT post_time, post_id FROM ".POSTS_TABLE." WHERE poster_id = " . $user_id . " ORDER BY post_time DESC LIMIT 1"; 
        if ( !($result = $db->sql_query($sql)) ) 
        { 
                message_die(GENERAL_ERROR, 'Error getting user last post time', '', __LINE__, __FILE__, $post_time_sql); 
        } 
        $row = $db->sql_fetchrow($result); 
        $last_post = ( isset($row['post_time']) ) ? '<a href="'.append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$row[post_id]#$row[post_id]").'" class=gensmall>'.create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']).'</a>' : $lang['None']; 

        $mailto = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $staff['user_id']) : 'mailto:' . $staff['user_email'];
        $mail = ( $staff['user_email'] ) ? '<a href="' . $mailto . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>' : '';

        $pmto = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$staff[user_id]");
        $pm = '<a href="' . $pmto . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';

        $msn = ( $staff['user_msnm'] ) ? '<a href="mailto: '.$staff['user_msnm'].'"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
        $yim = ( $staff['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $staff['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
        $aim = ( $staff['user_aim'] ) ? '<a href="aim:goim?screenname=' . $staff['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
        $icq = ( $staff['user_icq'] ) ? '<a href="http://wwp.icq.com/scripts/contact.dll?msgto=' . $staff['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>' : '';

        $www = ( $staff['user_website'] ) ? '<a href="' . $staff['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';

        $sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
        if ( !($result = $db->sql_query($sql)) )
        {
        	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
        }
        $ranksrow = array();
        while ( $row = $db->sql_fetchrow($result) )
        {
                $ranksrow[] = $row;
        }
        $db->sql_freeresult($result);

        $rank = '';
        $rank_image = '';
        if ( $staff['user_rank'] )
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }
        else
        {
                for($j = 0; $j < count($ranksrow); $j++)
                {
                        if ( $staff['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
                        {
                                $rank = $ranksrow[$j]['rank_title'];
                                $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="modules/Forums/' . $ranksrow[$j]['rank_image'] . '" alt="' . $rank . '" title="' . $rank . '" border="0" /><br />' : '';
                        }
                }
        }

        $template->assign_block_vars('staff', array(
                'AVATAR' => $avatar,
                'RANK' => $rank,
                'RANK_IMAGE' => $rank_image,
                'U_NAME' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$staff[user_id]"),
                'NAME' => CheckUsernameColor($staff['user_color_gc'], $staff['username']),
                'LEVEL' => $level,
                'FORUMS' => $forums,
                'JOINED' => $staff['user_regdate'],
                'PERIOD' => sprintf($lang['Period'], $memberdays),
                'POSTS' => $staff['user_posts'],
                'POST_DAY' => sprintf($lang['User_post_day_stats'], $posts_per_day), 
                'POST_PERCENT' => sprintf($lang['User_post_pct_stats'], $percentage), 
                'LAST_POST' => $last_post, 
                'MAIL' => $mail,
                'PM' => $pm,
                'MSN' => $msn,
                'YIM' => $yim,
                'AIM' => $aim,
                'ICQ' => $icq,
                'WWW' => $www)
        );
}
        $template->assign_vars(array( 
                'L_AVATAR' => $lang['Avatar'], 
                'L_USERNAME' => $lang['Username'], 
                'L_FORUMS' => $lang['Forums'], 
                'L_POSTS' => $lang['Posts'], 
                'L_JOINED' => $lang['Joined'], 
                'L_EMAIL' => $lang['Email'],
                'L_PM' => $lang['Private_Message'],
                'L_MESSENGER' => $lang['Messenger'],
                'L_WWW' => $lang['Website'])
        );

        $template->pparse('body');

include_once('includes/page_tail.'.$phpEx); 

?>
