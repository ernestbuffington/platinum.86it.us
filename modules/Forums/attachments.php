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

if ($popup != "1")
    {
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

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

$attachment_mod_installed = ( defined('ATTACH_CONFIG_TABLE') ) ? TRUE : FALSE;

if (!$attachment_mod_installed)
{
	message_die(GENERAL_MESSAGE, "The Attachment Mod have to be installed in order to see the Attachment List.");
}

$sql = 'SELECT config_value
	FROM ' . ATTACH_CONFIG_TABLE . "
	WHERE config_name = 'attach_version'";

if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, "Unable to query config table.", '', __LINE__, __FILE__, $sql);
}

if (!($row = $db->sql_fetchrow($result)))
{
	message_die(GENERAL_MESSAGE, 'Wrong Attachment Version detected.<br />Please update your Attachment Mod (V' . ATTACH_VERSION . ') to at least Version 3.0.0.');
}

$attachment_version = $row['config_value'];

$real_filename = 'real_filename';
$attach_table = ATTACHMENTS_TABLE;
$attach_desc_table = ATTACHMENTS_DESC_TABLE;

$sql = 'SELECT config_value
	FROM ' . CONFIG_TABLE . "
	WHERE config_name = 'default_lang'";

if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, "Unable to query config table.", '', __LINE__, __FILE__, $sql);
}

$default_lang = $db->sql_fetchrow($result);
$default_lang = $default_lang['config_value'];

$language = $board_config['default_lang'];

if( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.'.$phpEx) )
{
	$language = $default_lang;
}

include_once($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.' . $phpEx);

//
// Start user modifiable variables
//

//
// Define the default forum by forum-id OR by Forum Name
// If both are set, the forum id is used
// To display the Attachments of all Forums, please set the display_all variable to true
//
$default_forum_id = '';
$default_forum_name = '';

// Set this to FALSE or fill the above values for a specific forum to be displayed
$display_all_forums = TRUE;

//
// Define the default Sort.
// Valid values are: filename, comment, filesize, downloads, post_time
//
$default_sort_method = 'downloads';

//
// Default Sort Order: ASC or DESC
//
$default_sort_order = 'DESC';

//
// End user modifiable variables
//

//
// Determine the variables we need for sorting and such
//
$start = ( isset($_GET['start']) ) ? intval($_GET['start']) : 0;

if(isset($_POST['order']))
{
	$sort_order = ($_POST['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($_GET['order']))
{
	$sort_order = ($_GET['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = $default_sort_order;
}

if(isset($_GET['mode']) || isset($_POST['mode']))
{
	$mode = (isset($_POST['mode'])) ? $_POST['mode'] : $_GET['mode'];
}
else
{
	$mode = $default_sort_method;
}

// Sort and Mode Select
$mode_types_text = array($lang['Sort_Filename'], $lang['Sort_Comment'], $lang['Sort_Size'], $lang['Sort_Downloads'], $lang['Sort_Posttime']);
$mode_types = array('filename', 'comment', 'filesize', 'downloads', 'post_time');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

switch ($mode)
{
	case 'filename':
		$order_by = '' . $real_filename . ' ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
	case 'comment':
		$order_by = 'comment ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
	case 'filesize':
		$order_by = 'filesize ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
	case 'downloads':
		$order_by = 'download_count ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
	case 'post_time':
		$order_by = 'filetime ' . $sort_order . ' LIMIT ' . $start . ', ' . $board_config['topics_per_page'];
		break;
	default:
		message_die(GENERAL_MESSAGE, "Please have a look at the attachments.php file and define valid sort order default values.");
		break;
}

// Forum Select
if(isset($_GET[POST_FORUM_URL]) || isset($_POST[POST_FORUM_URL]))
{
	$forum_id = (isset($_POST[POST_FORUM_URL])) ? $_POST[POST_FORUM_URL] : $_GET[POST_FORUM_URL];
}
else
{
	$default_forum_id = intval($default_forum_id);
	if ($default_forum_id)
	{
		$forum_id = intval($default_forum_id);
	}
	else if ($default_forum_name != '')
	{
		$sql = "SELECT forum_id 
		FROM " . FORUMS_TABLE . "
		WHERE forum_name='" . $default_forum_name . "'"; 
	
		if ( !($result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_MESSAGE, "Please specify a valid Forum Name.'" . $default_forum_name . "' could not be found.");
		}

		$row = $db->sql_fetchrow($result); 
		$forum_id = $row['forum_id']; 
	}
	else if (!$display_all_forums)
	{
		message_die(GENERAL_MESSAGE, "Please have a look at the attachments.php file and define valid forum default values.");
	}

	if ($forum_id)
	{
		$sql = "SELECT forum_id
		FROM " . FORUMS_TABLE . "
		WHERE forum_id = $forum_id 
		LIMIT 1";

		if ( !($result = $db->sql_query($sql) ))
		{
			message_die(GENERAL_ERROR, "Couldn't query forums table.", '', __LINE__, __FILE__, $sql);
		}

		if ($db->sql_numrows($result) == 0)
		{
			message_die(GENERAL_MESSAGE, "The default forum id/name does not exist, please check your default values.");
		}
	}
}

//
// Search forum - first delete those the user have not access to and then those the user have no permission to download to.
//
$sql = "SELECT c.cat_title, c.cat_id, f.forum_name, f.forum_id  
	FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
	WHERE f.cat_id = c.cat_id 
	ORDER BY c.cat_id, f.forum_order";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain forum_name/forum_id', '', __LINE__, __FILE__, $sql);
}

$is_auth_ary = auth(AUTH_READ, AUTH_LIST_ALL, $userdata);
$is_download_auth_ary = auth(AUTH_DOWNLOAD, AUTH_LIST_ALL, $userdata);

$forum_ids = array();
$select_forums = '';
while( $row = $db->sql_fetchrow($result) )
{
	if ( ( $is_auth_ary[$row['forum_id']]['auth_read'] ) && ( $is_download_auth_ary[$row['forum_id']]['auth_download'] ) )
	{
		$selected = ( $forum_id == $row['forum_id'] ) ? ' selected="selected"' : '';
		$select_forums .= '<option value="' . $row['forum_id'] . '"' . $selected . '>' . $row['forum_name'] . '</option>';
		$forum_ids[] = $row['forum_id'];
	}
}

if ( $select_forums != '' )
{
	$select_forums = '<select name="' . POST_FORUM_URL . '"><option value="-1">' . $lang['All_available'] . '</option>' . $select_forums . '</select>';
}
else
{
	message_die(GENERAL_MESSAGE, "You are not authorized to view Attachments at all.");
}

$forum_id = intval($forum_id);

$page_title = $lang['Statistics'];
include_once('includes/page_header.'.$phpEx); 

$template->set_filenames(array(
	'body' => 'attachments.tpl')
);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Submit'],
	'L_FORUM' => $lang['Forum'],

	'L_ATTACHMENTS' => $lang['Attachments'],
	'L_FILENAME' => $lang['File_name'], 
	'L_FILECOMMENT' => $lang['File_comment'], 
	'L_SIZE' => $lang['Size_in_kb'], 
	'L_DOWNLOADS' => $lang['Downloads'], 
	'L_POST_TIME' => $lang['Post_time'], 
	'L_POSTED_IN_TOPIC' => $lang['Posted_in_topic'],

	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_FORUM_SELECT' => $select_forums, 
	'S_MODE_ACTION' => append_sid("attachments.$phpEx"))
);

$sql = '';
if($forum_id=='-1'){
$forum_id = '0';
}
if (!$forum_id && $display_all_forums)
{
	$sql = "SELECT a.post_id, t.topic_title, d.*
		FROM " . $attach_table . " a, " . $attach_desc_table . " d, "  . POSTS_TABLE . " p, " . TOPICS_TABLE . " t
		WHERE (a.post_id = p.post_id) AND (p.forum_id IN (" . implode(', ', $forum_ids) . ")) AND (p.topic_id = t.topic_id) AND (a.attach_id = d.attach_id)
		ORDER BY $order_by";
}
else if (($is_auth_ary[$forum_id]['auth_read']) && ($is_download_auth_ary[$forum_id]['auth_download']))
{
	$sql = "SELECT a.post_id, t.topic_title, d.*
		FROM " . $attach_table . " a, " . $attach_desc_table . " d, "  . POSTS_TABLE . " p, " . TOPICS_TABLE . " t
		WHERE (a.post_id = p.post_id) AND (p.forum_id = " . $forum_id . ") AND (p.topic_id = t.topic_id) AND (a.attach_id = d.attach_id)
		ORDER BY $order_by";
}
	
if ($sql != '')
{
	if (!($result = $db->sql_query($sql)))
	{ 
		message_die(GENERAL_ERROR, 'Couldn\'t query attachments', '', __LINE__, __FILE__, $sql); 
	} 
	
	$attachments = $db->sql_fetchrowset($result);
	$num_attachments = $db->sql_numrows($result);
}
else
{
	$attachments = array();
	$num_attachments = 0;
}

for ($i = 0; $i < $num_attachments; $i++) 
{ 
	$class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$post_title = $attachments[$i]['topic_title'];
	$post_title_2 = '';
	
	if (strlen($post_title) > 32)
	{
		$post_title_2 = substr($post_title, 0, 30) . '...';
	}

	$view_topic = append_sid('viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . $attachments[$i]['post_id'] . '#' . $attachments[$i]['post_id']);
	if ($post_title_2 != '')
	{
		$post_title = '<a href="' . $view_topic . '" class="gen" title="' . $post_title . '" target="_blank">' . $post_title_2 . '</a>';
	}
	else
	{
		$post_title = '<a href="' . $view_topic . '" class="gen" target="_blank">' . $post_title . '</a>';
	}

	$comment = htmlspecialchars($attachments[$i]['comment']);
	$comment_2 = '';

	if (strlen($comment) > 32)
	{
		$comment_2 = substr($comment, 0, 30) . '...';
	}

	if ($comment_2 != '')
	{
		$comment_field = '<span title="' . $comment . '">' . $comment_2 . '</span>';
	}
	else
	{
		$comment_field = $comment;
	}

	$filename = $attachments[$i][$real_filename];
	$filename_2 = '';
	
	if (strlen($filename) > 32)
	{
		$filename_2 = substr($filename, 0, 30) . '...';
	}

	$view_attachment = append_sid('download.' . $phpEx . '?id=' . intval($attachments[$i]['attach_id']));
	if ($filename_2 != '')
	{
		$filename_link = '<a href="' . $view_attachment . '" class="gen" title="' . $filename . '" target="_blank">' . $filename_2 . '</a>';
	}
	else
	{
		$filename_link = '<a href="' . $view_attachment . '" class="gen" target="_blank">' . $filename . '</a>';
	}

	$template->assign_block_vars('attachrow', array(
		'ROW_NUMBER' => $i + ( $_GET['start'] + 1 ),
		'ROW_CLASS' => $class,

		'FILENAME' => $filename,
		'COMMENT' => $comment_field,
		'SIZE' => round(($attachments[$i]['filesize'] / 1024), 2),
		'DOWNLOAD_COUNT' => $attachments[$i]['download_count'],
		'POST_TIME' => create_date($board_config['default_dateformat'], $attachments[$i]['filetime'], $board_config['board_timezone']),
		'POST_TITLE' => $post_title,

		'VIEW_ATTACHMENT' => $filename_link)
	);
}

$sql = '';

if (!$forum_id && $display_all_forums)
{
	$sql = "SELECT count(*) AS total
		FROM " . $attach_table . " a, " . POSTS_TABLE . " p
		WHERE (a.post_id = p.post_id) AND (p.forum_id IN (" . implode(', ', $forum_ids) . "))";
}
else if ( ( $is_auth_ary[$forum_id]['auth_read'] ) && ( $is_download_auth_ary[$forum_id]['auth_download'] ) && ($num_attachments > 0) )
{
	$sql = "SELECT count(*) AS total
		FROM " . $attach_table . " a, " . POSTS_TABLE . " p
		WHERE (a.post_id = p.post_id) AND (p.forum_id = " . $forum_id . ")";
}

if ($sql != '')
{
	if (!($result = $db->sql_query($sql))) 
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total = $total['total'];

		$pagination = generate_pagination("attachments.$phpEx?mode=$mode&amp;order=$sort_order&amp;" . POST_FORUM_URL . "=$forum_id", $total, $board_config['topics_per_page'], $start). '&nbsp;';
	}

	$template->assign_vars(array(
		'PAGINATION' => $pagination,
		'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total / $board_config['topics_per_page'] )), 

		'L_GOTO_PAGE' => $lang['Goto_page'])
	);
}

$template->pparse('body');

include_once('includes/page_tail.'.$phpEx);

?>
