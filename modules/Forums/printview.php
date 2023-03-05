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

define('IN_PHPBB', true);
$phpbb_root_path = "modules/Forums/";
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once('includes/bbcode.php');

//
// gzip_compression
//
$do_gzip_compress = FALSE;
if($board_config['gzip_compress'])
{
	$phpver = phpversion();

	if($phpver >= "4.0.4pl1")
	{
		if(extension_loaded("zlib"))
		{
			ob_end_clean();
			ob_start("ob_gzhandler");
		}
	}
	else if($phpver > "4.0")
	{
		if(strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
		{
			if(extension_loaded("zlib"))
			{
				$do_gzip_compress = TRUE;
				ob_start();
				ob_implicit_flush(0);

				header("Content-Encoding: gzip");
			}
		}
	}
}

header ("Cache-Control: no-store, no-cache, must-revalidate");
header ("Cache-Control: pre-check=0, post-check=0, max-age=0", false);
header ("Pragma: no-cache");
header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

//
// Start session management
//
$userdata = session_pagestart($user_ip, 0, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

// Make sure a topic id was passed
if(isset($_GET[POST_TOPIC_URL]))
{
	$topic_id = intval($_GET[POST_TOPIC_URL]);
}
else if(isset($_GET['topic']))
{
	$topic_id = intval($_GET['topic']);
}

if( !isset($topic_id) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$template->set_filenames(array(
                                   "body" => "viewtopic_print.tpl")
                                   );
                                   
$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f
	WHERE t.topic_id = " . $topic_id . "
		AND f.forum_id = t.forum_id
		$order_sql";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Couldn't obtain topic information", "", __LINE__, __FILE__, $sql);
}

if( !($forum_row = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}
$forum_id = $forum_row['forum_id'];
$forum_name = $forum_row['forum_name'];
$topic_title = $forum_row['topic_title'];
$topic_time = $forum_row['topic_time'];


//
// Start auth check
//
$is_auth = array();
$is_auth = auth(AUTH_READ, $forum_id, $userdata, $forum_row);

if( !$is_auth['auth_read'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = "t=" . $topic_id;
		header("Location: " . append_sid("login.$phpEx?redirect=printview.$phpEx&$redirect", true));
	}

	$message = sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
//
// End auth check
//

//
// Right we have auth checked and a topic id so we can fetch the topic data.
//

//
// Decide how to order the post display
//
if(!empty($_POST['postorder']) || !empty($_GET['postorder']))
{
	$post_order = (!empty($_POST['postorder'])) ? $_POST['postorder'] : $_GET['postorder'];
	$post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
}
else
{
	$post_order = "asc";
	$post_time_order = "ASC";
}

$sql = "SELECT u.*, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE p.topic_id = $topic_id
		AND pt.post_id = p.post_id
		AND u.user_id = p.poster_id
	ORDER BY p.post_time $post_time_order";
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Couldn't obtain post/user information.", "", __LINE__, __FILE__, $sql);
}

if(!$total_posts = $db->sql_numrows($result))
{
	message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
}
$postrow = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);

//
// Define censored word matches
//
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

//
// Censor topic title
//
if( count($orig_word) )
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}


//
// Loop through the posts
//
for($i = 0; $i < $total_posts; $i++)
{
	$poster_id = $postrow[$i]['user_id'];
	$poster = $postrow[$i]['username'];

	$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);
	$post_subject = ( $postrow[$i]['post_subject'] != "" ) ? $postrow[$i]['post_subject'] : "";

	$message = $postrow[$i]['post_text'];
	$bbcode_uid = $postrow[$i]['bbcode_uid'];
 
    // Dont want any HTML on printview
	if( $postrow[$i]['enable_html'] )
	{
		$message = preg_replace("#(<)([\/]?.*?)(>)#is", "&lt;\\2&gt;", $message);
	}
    // But BBcode, links and smilies are OK, possible revision in future version?
	if( $bbcode_uid != "" )
	{
		$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:[0-9a-z\:]+\]/si", "]", $message);
	}
	$message = make_clickable($message);
 	//
	// Replace naughty words
	//
	if( count($orig_word) )
	{
		$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
		$message = preg_replace($orig_word, $replacement_word, $message);
	}
	if( $board_config['allow_smilies'] )
	{
		if( $postrow[$i]['enable_smilies'] )
		{
			$message = smilies_pass($message);
		}
	}
	$message = str_replace("\n", "\n<br />\n", $message);
 
 	$template->assign_block_vars("postrow", array(
  		"POSTER_NAME" => $poster,
  		"POST_DATE" => $post_date,
		"POST_SUBJECT" => $post_subject,
		"MESSAGE" => $message)
	);
}


//
// Set up all the other template variables
//
$page_title = $lang['View_topic'] ." - $topic_title";
$template->assign_vars(array(
	"FORUM_ID" => $forum_id,
    "FORUM_NAME" => $forum_name,
    "TOPIC_ID" => $topic_id,
    "TOPIC_TITLE" => $topic_title,
	"SITENAME" => $board_config['sitename'],
	"SITE_DESCRIPTION" => $board_config['site_desc'],
	"PAGE_TITLE" => $page_title,
	"L_POSTED" => $lang['Posted'],
	"L_POST_SUBJECT" => $lang['Post_subject'],
	"L_POSTED" => $lang['Posted'],
	"L_AUTHOR" => $lang['Author'],
	"L_SUBJECT" => $lang['Subject'],
	"L_MESSAGE" => $lang['Message'],
	"L_FORUM" => $lang['Forum'],
	//"PHPBB_VERSION" => "2.0 " . $board_config['version'],
	"T_FONTFACE1" => $theme['fontface1'],
	"T_FONTSIZE2" => $theme['fontsize2'],
	"S_CONTENT_DIRECTION" => $lang['DIRECTION'],
	"S_CONTENT_ENCODING" => $lang['ENCODING'],
	"S_TIMEZONE" => sprintf($lang['All_times'], $lang[$board_config['board_timezone']]),
	"L_TOPICS" => $lang['Topics'])
);
//
// Right, thats got it all, send out to template.
//
$template->pparse("body");
// $db->sql_close();
//
// Compress buffered output if require_onced
// and send to browser
//
if($do_gzip_compress)
{
	//
	// Borrowed from php.net!
	//
	$gzip_contents = ob_get_contents();
	ob_end_clean();

	$gzip_size = strlen($gzip_contents);
	$gzip_crc = crc32($gzip_contents);

	$gzip_contents = gzcompress($gzip_contents, 9);
	$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
	echo $gzip_contents;
	echo pack("V", $gzip_crc);
	echo pack("V", $gzip_size);
}

exit;

?>
