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

if ( !defined('IN_PHPBB') )
{
        die("Hacking attempt");
        exit;
}

if ( empty($_GET[POST_USERS_URL]) || $_GET[POST_USERS_URL] == ANONYMOUS )
{
        message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}

$profiledata = get_userdata($_GET[POST_USERS_URL]);
//////FIELDS MOD START//////////////
require_once ("includes/profilefields.php");
//////FIELDS MOD END//////////////
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
$buddy_id = ( isset($_GET['b']) ) ? $_GET['b'] : 0;
$buddy_action = ( isset($_GET['buddy_action']) ) ? ( ($_GET['buddy_action'] == 'add') ? 'add' : ( ($_GET['buddy_action'] == 'remove') ? 'remove' : '') ) : '';

//
// Add to/remove from buddylist
//
if ( $buddy_id )
{
	$redirect = POST_USERS_URL . '=' . $profiledata['user_id'];
	$redirect .= '&mode=viewprofile';

	if( !$userdata['session_logged_in'] )
	{
		$redirect .= ( isset($buddy_id) ) ? "&b=$buddy_id" : '';
		$redirect .= ( isset($buddy_action) ) ? "&buddy_action=$buddy_action" : '';
		$header_location = ( @preg_match("/Microsoft|WebSTAR|Xitami/", getenv("SERVER_SOFTWARE")) ) ? "Refresh: 0; URL=" : "Location: ";
		header($header_location . append_sid("login.$phpEx?redirect=profile.$phpEx&$redirect", true));
		exit;
	}

	//
	// Do not perform actions with yourself now...
	//
	if ( $buddy_id == $userdata['user_id'] )
	{
		message_die(GENERAL_MESSAGE, 'You cannot add/remove yourself to/from your buddylist');
	}

	//
	// Check if the user exists
	//
	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE user_id = $buddy_id";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query user information', '', __LINE__, __FILE__, $sql);
	}
	if ( !$row = $db->sql_fetchrow($result) )
	{
		message_die(GENERAL_MESSAGE, 'User does not exist');
	}

	//
	// See if user is already/not in the buddylist already
	//
	$sql = "SELECT * FROM " . BUDDIES_TABLE . "
			WHERE user_id = " . $userdata['user_id'] . "
				AND buddy_id = $buddy_id";
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query buddylist information', '', __LINE__, __FILE__, $sql);
	}

	if( ($buddy_action == 'add') && ($row = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_MESSAGE, 'User is already in your buddylist');
	}
	else if( ($buddy_action == 'remove') && (!$row = $db->sql_fetchrow($result)) )
	{
		message_die(GENERAL_MESSAGE, 'User is not in your buddylist');
	}

	//
	// Perform add & remove now
	//
	if ( $buddy_action == 'add' )
	{
		$sql = "INSERT INTO " . BUDDIES_TABLE . " (user_id, buddy_id)
				VALUES (" . $userdata['user_id'] . ", $buddy_id)";
		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not add the user to your buddylist', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Buddy_added'] . '<br /><br />' . sprintf($lang['Click_return_profile'], '<a href="' . append_sid ("profile.$phpEx?$redirect") . '">', '</a>');
	}

	if ( $buddy_action == 'remove' )
	{
		$sql = "DELETE FROM " . BUDDIES_TABLE . "
				WHERE user_id = " . $userdata['user_id'] . "
					AND buddy_id = $buddy_id";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not remove the user from your buddylist', '', __LINE__, __FILE__, $sql);
		}

		$message = $lang['Buddy_removed'] . '<br /><br />' . sprintf($lang['Click_return_profile'], '<a href="' . append_sid("profile.$phpEx?$redirect") . '">', '</a>');
	}

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("profile.$phpEx?$redirect") . '">')
		);

	message_die(GENERAL_MESSAGE, $message);
}
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
// Mighty Gorgon - Multiple Ranks - BEGIN
require_once('includes/functions_mg_ranks.'.$phpEx);
$ranks_sql = query_ranks();
// Mighty Gorgon - Multiple Ranks - END
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
if ( $userdata['session_logged_in'] )
{
	$sql = "SELECT buddy_id FROM " . BUDDIES_TABLE . "
			WHERE user_id = " . $userdata['user_id'] . "
				AND buddy_id = " . $profiledata['user_id'];
}
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not obtain buddies information', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$buddy_id = $row['buddy_id'];
}
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

//
// Output page header and profile_view template
//
$template->set_filenames(array(
        'body' => 'profile_view_body.tpl')
);
if (is_active("Forums")) {
    make_jumpbox('viewforum.'.$phpEx);
}
//
// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
//
$regdate = $profiledata['user_regdate'];
$nukedate = strtotime($regdate);
$memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
        $total_posts = get_db_stat('postcount');
        $percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
        $percentage = 0;
}

$avatar_img = '';
if ( $profiledata['user_avatar_type'] && $profiledata['user_allowavatar'] )
{
        switch( $profiledata['user_avatar_type'] )
        {
                case USER_AVATAR_UPLOAD:
                        $avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
                        break;

		case USER_AVATAR_REMOTE:
			$avatar_img = resize_avatar($profiledata['user_avatar']);
			break;

                case USER_AVATAR_GALLERY:
                        $avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
                        break;
        }
}
	// Mighty Gorgon - Multiple Ranks - BEGIN
	$user_ranks = generate_ranks($profiledata, $ranks_sql);

	$user_rank_01 = ($user_ranks['rank_01'] == '') ? '' : ($user_ranks['rank_01'] . '<br />');
	$user_rank_01_img = ($user_ranks['rank_01_img'] == '') ? '' : ($user_ranks['rank_01_img'] . '<br />');
	$user_rank_02 = ($user_ranks['rank_02'] == '') ? '' : ($user_ranks['rank_02'] . '<br />');
	$user_rank_02_img = ($user_ranks['rank_02_img'] == '') ? '' : ($user_ranks['rank_02_img'] . '<br />');
	$user_rank_03 = ($user_ranks['rank_03'] == '') ? '' : ($user_ranks['rank_03'] . '<br />');
	$user_rank_03_img = ($user_ranks['rank_03_img'] == '') ? '' : ($user_ranks['rank_03_img'] . '<br />');
	$user_rank_04 = ($user_ranks['rank_04'] == '') ? '' : ($user_ranks['rank_04'] . '<br />');
	$user_rank_04_img = ($user_ranks['rank_04_img'] == '') ? '' : ($user_ranks['rank_04_img'] . '<br />');
	$user_rank_05 = ($user_ranks['rank_05'] == '') ? '' : ($user_ranks['rank_05'] . '<br />');
	$user_rank_05_img = ($user_ranks['rank_05_img'] == '') ? '' : ($user_ranks['rank_05_img'] . '<br />');
	// Mighty Gorgon - Multiple Ranks - END
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
$buddy_img = '';
$buddy = '';

if ( $userdata['session_logged_in'] && ( $userdata['user_id'] != $profiledata['user_id'] ) )
{
	$redirect = POST_USERS_URL . '=' . $profiledata['user_id'];
	$redirect .= '&amp;mode=viewprofile';
	$redirect .= '&amp;b=' . $profiledata['user_id'];
	
	if ( $buddy_id )
	{
		$redirect .= '&amp;buddy_action=remove';
		$buddy_img = '<a href="' . append_sid("profile.$phpEx?$redirect") . '"><img src="' . $images['icon_buddy_remove'] . '" alt="' . $lang['Remove_buddy_list'] . '" border="0"></a>';
		$buddy = '<a href="' . append_sid("profile.$phpEx?$redirect") . '">' . $lang['Remove_buddy_list'] . '</a>';
	}
	else
	{
		$redirect .= '&amp;buddy_action=add';
		$buddy_img = '<a href="' . append_sid("profile.$phpEx?$redirect") . '"><img src="' . $images['icon_buddy'] . '" alt="' . $lang['Add_buddy_list'] . '" border="0"></a>';
		$buddy = '<a href="' . append_sid("profile.$phpEx?$redirect") . '">' . $lang['Add_buddy_list'] . '</a>';
	}
}
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/

$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
if (is_active("Private_Messages")) {
    $pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
    $pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';
	// Country/Location Flags
$location = ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;';
$flag = ( !empty($profiledata['user_from_flag']) ) ? '&nbsp;<img src="images/flags/' . $profiledata['user_from_flag'] . '" alt="' . $profiledata['user_from_flag'] . '" title="' . $profiledata['user_from_flag'] . '" border="1" />' : '';
$location .= $flag;
}

if ( !empty($profiledata['user_viewemail']) || $userdata['user_level'] == ADMIN )
{
        $email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];

        
        $email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
        $email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
}
else
{
        $email_img = '&nbsp;';
        $email = '&nbsp;';
}
if (( $profiledata['user-website'] == "http:///") || ( $profiledata['user_website'] == "http://")){
    $profiledata['user_website'] =  "";
}
if (($profiledata['user_website'] != "" ) && (substr($profiledata['user_website'],0, 7) != "http://")) {
    $profiledata['user_website'] = "http://".$profiledata['user_website'];
}

$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '&nbsp;';
$www = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_userwww">' . $profiledata['user_website'] . '</a>' : '&nbsp;';

if ( !empty($profiledata['user_icq']) )
{
        $icq_status_img = '<a href="http://wwp.icq.com/' . $profiledata['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $profiledata['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
        $icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
        $icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '">' . $lang['ICQ'] . '</a>';
}
else
{
        $icq_status_img = '&nbsp;';
        $icq_img = '&nbsp;';
        $icq = '&nbsp;';
}

$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '&nbsp;';
$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '&nbsp;';

//====================================================================== |
//==== Start Invision View Profile ===================================== |
//==== v1.1.3 ========================================================== |
//====
$msn_img = ( $profiledata['user_msnm'] ) ? '<a href="http://members.msn.com/' . $profiledata['user_msnm'] . '" target="_blank"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : ''; 
$msn = ( $profiledata['user_msnm'] ) ? $profiledata['user_msnm'] : '&nbsp;';
//====
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |
$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($profiledata['username']) . "&amp;showresults=posts");
$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" border="0" /></a>';
//====================================================================== |
//==== Start Invision View Profile ===================================== |
//==== v1.1.3 ========================================================== |
//====
$user_sig = '';
if ( $profiledata['user_attachsig'] && $board_config['allow_sig'] )
{
	include_once('includes/bbcode.'.$phpEx);
	$user_sig = $profiledata['user_sig'];
	$user_sig_bbcode_uid = $profiledata['user_sig_bbcode_uid'];
	if ( $user_sig != '' )
	{
		if ( !$board_config['allow_html'] && $profiledata['user_allowhtml'] )
		{
			$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
		}

		if ( $board_config['allow_bbcode'] && $user_sig_bbcode_uid != '' )
		{
			$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
		}

		$user_sig = make_clickable($user_sig);

		if ( !$userdata['user_allowswearywords'] )
		{
			$orig_word = !empty($orig_word) ? $orig_word : array();
			$replacement_word = !empty($replacement_word) ? $replacement_word : array();
			obtain_word_list($orig_word, $replacement_word);
			$user_sig = preg_replace($orig_word, $replacement_word, $user_sig);
		}

		if ( $profiledata['user_allowsmile'] )
		{
			$user_sig = smilies_pass($user_sig);
		}

		$user_sig = str_replace("\n", "\n<br />\n", $user_sig);
	}

	$template->assign_block_vars('switch_user_sig_block', array());
}

if ( $profiledata['user_id'] )
{
   $user_most_active = get_forum_most_active($profiledata['user_id']);
   $user_most_active_forum_url = append_sid('viewforum.' . $phpEx . '?f=' . urlencode($user_most_active['forum_id']));
   $user_most_active_forum_name = $user_most_active['forum_name'];
   $user_most_active_posts = $user_most_active['posts'];
}
//====
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |
// BEGIN Advanced_Report_Hack
$s_report_user = '';
if ($userdata['user_id'] != ANONYMOUS)
{
	$temp_url = append_sid($phpbb_root_path . 'report.php?mode=reportuser&amp;id=' . $profiledata['user_id']);
	$s_report_user = '<a href="' . $temp_url . '" class="gen">' . $lang['Report_user'] . '</a>';
}
// END Advanced_Report_Hack
if ($board_config['viewprofile'] == "images")
{
	$itempurge = str_replace("Þ", "", $profiledata['user_items']);
	$itemarray = explode('ß',$itempurge);
	$itemcount = count ($itemarray);
	$user_items = "<br />";
	for ($xe = 0;$xe < $itemcount;$xe++)
	{
		if ($itemarray[$xe] != NULL)
		{
			if (file_exists('modules/Forums/images/shop/images/'.$itemarray[$xe].'.jpg'))
			{
				$user_items .= ' <img src="modules/Forums/images/shop/images/'.$itemarray[$xe].'.jpg" title="'.$itemarray[$xe].'" alt="'.$itemaray[$xe].'">';
			}
			elseif (file_exists('modules/Forums/images/shop/images/'.$itemarray[$xe].'.gif'))
			{
				$user_items .= ' <img src="modules/Forums/images/shop/images/'.$itemarray[$xe].'.gif" title="'.$itemarray[$xe].'" alt="'.$itemaray[$xe].'">';
			}
		}
	}
	$usernameurl = '<a href="'.append_sid('shop.'.$phpEx.'?action=inventory&searchid='.$profiledata['user_id'], true).'" class="nav">Items</a>: ';
}
elseif ($board_config['viewprofile'] == "link")
{
	$usernameurl = '<a href="'.append_sid('shop.'.$phpEx.'?action=inventory&searchid='.$profiledata['user_id'], true).'" class="nav">Items</a>';
}

//start of effects store checks
$shoparray = explode("ß", $board_config['specialshop']);
$shoparraycount = count ($shoparray);
$shopstatarray = array();
for ($x = 0; $x < $shoparraycount; $x++)
{
	$temparray = explode("Þ", $shoparray[$x]);
	$shopstatarray[] = $temparray[0];
	$shopstatarray[] = $temparray[1];
}
//end of effects store checks

$usereffects = explode("ß", $profiledata['user_effects']);
$userprivs = explode("ß", $profiledata['user_privs']);
$usercustitle = explode("ß", $profiledata['user_custitle']);
$userbs = array();
$usercount = count($userprivs);
for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $userprivs[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }
$usercount = count($usereffects);
for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usereffects[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }
$usercount = count($usercustitle);
for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usercustitle[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }

if ( !empty($profiledata['user_gender']))
{ 
           switch ($profiledata['user_gender']) 
           { 
                      case 1: $gender=$lang['Male'];break; 
                      case 2: $gender=$lang['Female'];break; 
                      default:$gender=$lang['No_gender_specify']; 
           } 
} else $gender=$lang['No_gender_specify'];
// Start Age In Profile MOD
$this_year = create_date('Y', time(), $board_config['board_timezone']);
$this_date = create_date('md', time(), $board_config['board_timezone']);
// End Age In Profile MOD
// Start add - Birthday MOD
if ($profiledata['user_birthday']!=999999)
{
	$user_birthday = realdate($lang['DATE_FORMAT'], $profiledata['user_birthday']);
// Start Age In Profile MOD
    $userbdate=realdate('md', $profiledata['user_birthday']);
   	$userbirthdate = $this_year - realdate ('Y',$profiledata['user_birthday']);
    if ($this_date < $userbdate) $userbirthdate--;
	$userbirthdate = '&nbsp;(' . $userbirthdate . ' Years)';
// End Age In Profile MOD
} else
{
	$user_birthday = $lang['No_birthday_specify'];
// Start Age In Profile MOD
	$userbirthdate = '';
// End Age In Profile MOD	
}
// End add - Birthday MOD
//
// Generate page
//
$page_title = $lang['Viewing_profile'];
include_once("includes/page_header.php");
/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
if ( $profiledata['user_session_time'] >= (time()-60) )
{
	if ( $profiledata['user_allow_viewonline'] )
	{
		$online_status = '<strong><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_online'], $profiledata['username']) . '"' . $online_color . '>' . $lang['Online'] . '</a></strong>';
	}
	else if ( ( $userdata['user_level'] == ADMIN ) || ( $userdata['user_id'] == $profiledata['user_id'] ) )
	{
		$online_status = '<strong><i><a href="' . append_sid("viewonline.$phpEx") . '" title="' . sprintf($lang['is_hidden'], $profiledata['username']) . '"' . $hidden_color . '>' . $lang['Hidden'] . '</a></i></strong>';
	}
	else
	{
		$online_status = '<strong><span title="' . sprintf($lang['is_offline'], $profiledata['username']) . '"' . $offline_color . '>' . $lang['Offline'] . '</span></strong>';
	}
}
else
{
	$online_status = '<strong><span title="' . sprintf($lang['is_offline'], $profiledata['username']) . '"' . $offline_color . '>' . $lang['Offline'] . '</span></strong>';
}
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/
display_upload_attach_box_limits($profiledata['user_id']);
$profiledata['user_from'] = str_replace(".gif", "", $profiledata['user_from']);

if (function_exists('get_html_translation_table'))
{
   $u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
   $u_search_author = urlencode(str_replace(array('&amp;', '&_#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

if (function_exists('get_html_translation_table'))
{
   $u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
   $u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

$template->assign_vars(array(
        'USERNAME' => CheckUsernameColor($profiledata['user_color_gc'], $profiledata['username']),
        'JOINED' => $profiledata['user_regdate'],
// Mighty Gorgon - Multiple Ranks - BEGIN
	'USER_RANK_01' => $user_rank_01,
	'USER_RANK_01_IMG' => $user_rank_01_img,
	'USER_RANK_02' => $user_rank_02,
	'USER_RANK_02_IMG' => $user_rank_02_img,
	'USER_RANK_03' => $user_rank_03,
	'USER_RANK_03_IMG' => $user_rank_03_img,
	'USER_RANK_04' => $user_rank_04,
	'USER_RANK_04_IMG' => $user_rank_04_img,
	'USER_RANK_05' => $user_rank_05,
	'USER_RANK_05_IMG' => $user_rank_05_img,
// Mighty Gorgon - Multiple Ranks - END		
	'INVENTORYLINK' => $usernameurl,
	'INVENTORYPICS' => $user_items,
        'POSTS_PER_DAY' => $posts_per_day,
        'POSTS' => $profiledata['user_posts'],
        'PERCENTAGE' => $percentage . '%',
        'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day),
        'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage),
//====================================================================== |
//==== Start Invision View Profile ===================================== |
//==== v1.1.3 ========================================================== |
	'INVISION_AVATAR_IMG' => $avatar_img,
	'INVISION_MOST_ACTIVE_FORUM_URL' => $user_most_active_forum_url,
	'INVISION_MOST_ACTIVE_FORUM_NAME' => $user_most_active_forum_name,
	'INVISION_POST_DAY_STATS' => sprintf($lang['Invision_User_post_day_stats'], $posts_per_day), 
	'INVISION_POST_PERCENT_STATS' => sprintf($lang['Invision_User_post_pct_stats'], $percentage),
	'INVISION_USER_SIG' => $user_sig,
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |
        'SEARCH_IMG' => $search_img,
        'SEARCH' => $search,
        'PM_IMG' => $pm_img,
        'PM' => $pm,
        'EMAIL_IMG' => $email_img,
        'EMAIL' => $email,
        'WWW_IMG' => $www_img,
        'WWW' => $www,
////////FIELDS MOD START////////
        'CUSTOMFIELDS' => $customfields,
///////FIELDS MOD END///////////
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
        'BUDDY_IMG' => $buddy_img,
        'BUDDY' => $buddy,
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
        'ICQ_STATUS_IMG' => $icq_status_img,
        'ICQ_IMG' => $icq_img,
        'ICQ' => $icq,
        'AIM_IMG' => $aim_img,
        'AIM' => $aim,
        'MSN_IMG' => $msn_img,
        'MSN' => $msn,
        'YIM_IMG' => $yim_img,
        'YIM' => $yim,

        'LOCATION' => $location,	// Country/Location Flags
        'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
        'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
// Start add - Birthday MOD
		'BIRTHDAY' => $user_birthday,
// End add - Birthday MOD
// Start Age In Profile MOD
		'POSTER_AGE' => $userbirthdate,
// End Age In Profile MOD
        'GENDER' => $gender,
        'AVATAR_IMG' => $avatar_img,

        'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], CheckUsernameColor($profiledata['user_color_gc'], $profiledata['username'])),
        'L_ABOUT_USER' => sprintf($lang['About_user'], $profiledata['username']),
        'L_AVATAR' => $lang['Avatar'],
        'L_POSTER_RANK' => $lang['Poster_rank'],
        'L_JOINED' => $lang['Joined'],
        'L_TOTAL_POSTS' => $lang['Total_posts'],
        'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']),
        'L_CONTACT' => $lang['Contact'],
        'L_EMAIL_ADDRESS' => $lang['Email_address'],
        'L_EMAIL' => $lang['Email'],
        'L_PM' => $lang['Private_Message'],
        'L_ICQ_NUMBER' => $lang['ICQ'],
        'L_YAHOO' => $lang['YIM'],
        'L_AIM' => $lang['AIM'],
        'L_MESSENGER' => $lang['MSNM'],
        'L_WEBSITE' => $lang['Website'],
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
        'L_BUDDY' => $lang['Buddy'],
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
        'L_LOCATION' => $lang['Location'],
        'L_OCCUPATION' => $lang['Occupation'],
        'L_INTERESTS' => $lang['Interests'],
//====================================================================== |
//==== Start Invision View Profile ===================================== |
//==== v1.1.3 ========================================================== |
//====
	'L_INVISION_A_STATS' => $lang['Invision_Active_Stats'],
	'L_INVISION_COMMUNICATE' => $lang['Invision_Communicate'],
	'L_INVISION_INFO' => $lang['Invision_Info'],
	'L_INVISION_MEMBER_TITLE' => $lang['Invision_Member_Title'],
	'L_INVISION_MEMBER_GROUP' => $lang['Invision_Member_Group'],
	'L_INVISION_MOST_ACTIVE' => $lang['Invision_Most_Active'],
	'L_INVISION_MOST_ACTIVE_POSTS' => sprintf($lang['Invision_Most_Active_Posts'], $user_most_active_posts),
	'L_INVISION_P_DETAILS' => $lang['Invision_Details'],
	'L_INVISION_POSTS' => $lang['Invision_Total_Posts'],
	'L_INVISION_PPD_STATS' => $lang['Invision_PPD_Stats'],
	'L_INVISION_SIGNATURE' => $lang['Invision_Signature'],
	'L_INVISION_WEBSITE' => $lang['Invision_Website'],
	'L_INVISION_VIEWING_PROFILE' => sprintf($lang['Invision_View_Profile'], $profiledata['username']),
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |
// Start add - Birthday MOD
	'L_BIRTHDAY' => $lang['Birthday'],
// End add - Birthday MOD
        'L_GENDER' => $lang['Gender'],
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
        'L_ARCADE' => $lang['lib_arcade'],
        'URL_STATS' => '<a class="genmed" href="' . append_sid("statarcade.$phpEx?uid=" . $profiledata['user_id'] ) . '">' . $lang['statuser'] . '</a> ',
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
/*****************************************************/
/* Forum - User Online Status v.1.0.5          START */
/*****************************************************/
        'ONLINE_STATUS' => $online_status,
        'L_ONLINE_STATUS' => $lang['Online_status'],
/*****************************************************/
/* Forum - User Online Status v.1.0.5            END */
/*****************************************************/

	'U_SEARCH_USER' => append_sid("search.$phpEx?search_author=" . $u_search_author),
        'S_REPORT_USER' => $s_report_user,
	'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
);
$cm_viewprofile->post_vars($template,$profiledata,$userdata);
//====================================================================== |
//==== Start Invision View Profile ===================================== |
//==== v1.1.3 ========================================================== |
//-- mod : groupes -----------------------------------------------------------------------------------
$user_id = $userdata['user_id'];
$view_user_id = $profiledata['user_id'];
$groups = array();
$sql = '
	SELECT 
		g.group_id, 
		g.group_name, 
		g.group_description, 
		g.group_type 
	FROM 
		'.USER_GROUP_TABLE.' as l, 
		'.GROUPS_TABLE.' as g 
	WHERE 
		l.user_pending = 0 AND 
		g.group_single_user = 0 AND 
		l.user_id ='. $view_user_id.' AND 
		g.group_id = l.group_id 
	ORDER BY 
		g.group_name, 
		g.group_id';
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Could not read groups', '', __LINE__, __FILE__, $sql);	
while ($group = $db->sql_fetchrow($result)) $groups[] = $group;

$template->assign_vars(array(
	'L_USERGROUPS' => $lang['Usergroups'],
	)
);
if (count($groups) > 0)
{  
   $template->assign_block_vars('switch_groups_on', array());  
}
{
	for ($i=0; $i < count($groups); $i++)
	{
		$is_ok = false;
		//
		// groupe invisible ?
		if ( ($groups[$i]['group_type'] != GROUP_HIDDEN) || ($userdata['user_level'] == ADMIN) )
		{
			$is_ok=true;
		}
		else
		{
			$group_id = $groups[$i]['group_id'];
			$sql = 'SELECT * FROM '.USER_GROUP_TABLE.' WHERE group_id='.$group_id.' AND user_id='.$user_id.' AND user_pending=0';
			if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t obtain viewer group list', '', __LINE__, __FILE__, $sql);
			$is_ok = ( $group = $db->sql_fetchrow($result) );
		}  // end if ($view_list[$i]['group_type'] == GROUP_HIDDEN)
		//
		// groupe visible : afficher
		if ($is_ok)
		{
			$u_group_name = append_sid("groupcp.php?g=".$groups[$i]['group_id']);
			$l_group_name = $groups[$i]['group_name'];
			$l_group_desc = $groups[$i]['group_description'];
			$template->assign_block_vars('groups',array(
				'U_GROUP_NAME' => $u_group_name,
				'L_GROUP_NAME' => $l_group_name,
				'L_GROUP_DESC' => $l_group_desc,
				)
			);
		}  // end if ($is_ok)
	}  // end for ($i=0; $i < count($groups); $i++)
}  // end if (count($groups) > 0)
//-- mod : groupes -----------------------------------------------------------------------------------
//==== Author: Disturbed One [http://anthonycoy.com] =================== |
//==== End Invision View Profile ======================================= |
//====================================================================== |

// START = Admin edit user profile link - sgtmudd
	if  ( $userdata['user_level'] == ADMIN ) {
$template->assign_vars(array( 
	'EDIT_USER_PROFILE' => '<a target="_blank" href="' . append_sid("modules/Forums/admin/admin_users.php?mode=edit&u=" . $profiledata['user_id'] ) . '" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">' . $lang['Edit_user_Profile'] . '</a> '
	));} else {}
// END = Admin edit user profile link - sgtmudd

$template->pparse('body');

include_once("includes/page_tail.php");

?>