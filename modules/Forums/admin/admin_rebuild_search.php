<?php


define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Platinum MODs']['Rebuild Search'] = "$file";
	return;
}

//
// Load default header
//
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

if(( isset($_POST['rebuild'])) OR ($_GET['start_id'] > 0))
{
include_once("../../../includes/functions_search.php");
	
	if ($_GET['start_id']==0)
	{
	// Empty wordlist tables

	$sql = "DELETE FROM " . SEARCH_WORD_TABLE;
	$result = $db->sql_query($sql);
		if ( !$result )
		{
			message_die(GENERAL_ERROR, "Could not empty search_wordlist table.", "",__LINE__, __FILE__, $sql);
		}
	$sql = "DELETE FROM " . SEARCH_MATCH_TABLE;
	$result = $db->sql_query($sql);
		if ( !$result )
		{
			message_die(GENERAL_ERROR, "Could not empty search_wordmatch table.", "",__LINE__, __FILE__, $sql);
		}
	}
	$sql = "SELECT count(*) as pcount FROM " . POSTS_TEXT_TABLE;
	
	$result = $db->sql_query($sql);
		if ( !$result )
		{
			message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
		}

	$postcount = $db->sql_fetchrow($result);
	$nextpage = 0;
	for( $i = $_GET['start_id']; $i < $postcount[pcount]; $i++ )
	{

		if ($i == $_GET['start_id'] + 100)
		{
		$nextpage=1;
		break;
		}
		$sql = "SELECT post_id FROM " . POSTS_TEXT_TABLE . " LIMIT " . $i . ",1";
		$result = $db->sql_query($sql);
			if ( !$result )
			{
				message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
			}
		$posts = $db->sql_fetchrow($result);
		$activeid = $posts['post_id'];
		$sql = "SELECT * FROM " . POSTS_TEXT_TABLE . " WHERE post_id = " . $activeid;
		$result = $db->sql_query($sql);
			if ( !$result )
			{
				message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
			}

		$activepost = $db->sql_fetchrowset($result);
		add_search_words('single', $activepost[0]['post_id'], stripslashes($activepost[0]['post_text']), stripslashes($activepost[0]['post_subject']));
	}	
	
	if ($nextpage==1)
	{
	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="3;url=' . append_sid("admin_rebuild_search.$phpEx?start_id=$i") . '">')
	);
	$message = $i . ' posts completed';

	$message .= "<br /><br />" . sprintf('Click %sHere%s to continue (or wait 3 seconds)', "<a href=\"" . append_sid("admin_rebuild_search.$phpEx?start_id=$i") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
	}
	else
	{
	$message = 'Rebuild successful';

	$message .= "<br /><br />" . sprintf('Click %sHere%s to return to \'Rebuild Search Index\'', "<a href=\"" . append_sid("admin_rebuild_search.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf('Click %sHere%s to return to the Admin Index', "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
	}

}


$template->set_filenames(array(
	"body" => "admin/rebuild_search_body.tpl")
);

$template->assign_vars(array(
	"S_FORM_ACTION" => append_sid("admin_rebuild_search.$phpEx?start_id=0"),

	"L_INFO" => $output_info,
	"L_REBUILD_SEARCH_TITLE" => "Rebuild Search Index",
	"L_REBUILD_SEARCH_SUBMIT" => "Rebuild")
);

include_once('./page_header_admin.'.$phpEx);

$template->pparse("body");

include_once('./page_footer_admin.'.$phpEx);

?>

