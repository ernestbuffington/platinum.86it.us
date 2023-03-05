<?php

/***************************************************************************

 *                             admin_forums.php

 *                            -------------------

 *   begin                : Thursday, Jul 12, 2001

 *   copyright            : (C) 2001 The phpBB Group

 *   email                : support@phpbb.com

 *

 *   $Id: admin_forums.php,v 1.40.2.10 2003/01/05 02:36:00 psotfx Exp $

 *

 ***************************************************************************/



/***************************************************************************

 *

 *   This program is free software; you can redistribute it and/or modify

 *   it under the terms of the GNU General Public License as published by

 *   the Free Software Foundation; either version 2 of the License, or

 *   (at your option) any later version.

 *

 ***************************************************************************/



/***************************************************************************

 * Platinum Nuke Pro: Expect to be impressed                      COPYRIGHT

 *

 * Copyright (c) 2004 - 2006 by http://www.techgfx.com

 *     Techgfx - Graeme Allan                       (goose@techgfx.com)

 *

 * Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de

 *     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de)

 *

 * Refer to TechGFX.com for detailed information on Platinum Nuke Pro

 *

 * TechGFX: Your dreams, our imagination

 ***************************************************************************/



define('IN_PHPBB', 1);



if( !empty($setmodules) )

{

        $file = basename(__FILE__);

        $module['Forums']['Manage'] = $file;

        return;

}



//

// Load default header

//

$phpbb_root_path = "./../";

require_once($phpbb_root_path . 'extension.inc');

require_once('./pagestart.' . $phpEx);

include_once("../../../includes/functions_admin.php");



$forum_auth_ary = array(

        "auth_view" => AUTH_ALL,

        "auth_read" => AUTH_ALL,

	"auth_post" => AUTH_REG, 

	"auth_reply" => AUTH_REG,

        "auth_edit" => AUTH_REG,

        "auth_delete" => AUTH_REG,

        "auth_sticky" => AUTH_MOD,

        "auth_announce" => AUTH_MOD,

        "auth_vote" => AUTH_REG,

        "auth_pollcreate" => AUTH_REG

);



$forum_auth_ary['auth_attachments'] = AUTH_REG;

$forum_auth_ary['auth_download'] = AUTH_REG;


			$in_from = ($_POST['popup']) ? $_POST['popup'] : $_POST['popup'];
			if ( ($in_from) && ($userdata['user_level'] != ADMIN) )
				message_die(GENERAL_ERROR, '<a href="#" onclick="javascript:window.close();">'. $lang['close_popup'] .'</a>');

//

// Mode setting

//

if( isset($_POST['mode']) || isset($_GET['mode']) )

{

        $mode = ( isset($_POST['mode']) ) ? $_POST['mode'] : $_GET['mode'];

}

else

{

        $mode = "";

}

$permissions_update_sql =
"auth_view = '". intval((($_POST['auth_view']) ? $_POST['auth_view'] : $_POST['auth_view'])) ."',
 auth_read = '". intval((($_POST['auth_read']) ? $_POST['auth_read'] : $_POST['auth_read'])) ."',
 auth_post = '". intval((($_POST['auth_post']) ? $_POST['auth_post'] : $_POST['auth_post'])) ."',
 auth_reply = '". intval((($_POST['auth_reply']) ? $_POST['auth_reply'] : $_POST['auth_reply'])) ."',
 auth_edit = '". intval((($_POST['auth_edit']) ? $_POST['auth_edit'] : $_POST['auth_edit'])) ."',
 auth_delete = '". intval((($_POST['auth_delete']) ? $_POST['auth_delete'] : $_POST['auth_delete'])) ."',
 auth_sticky = '". intval((($_POST['auth_sticky']) ? $_POST['auth_sticky'] : $_POST['auth_sticky'])) ."',
 auth_announce = '". intval((($_POST['auth_announce']) ? $_POST['auth_announce'] : $_POST['auth_announce'])) ."',
 auth_vote = '". intval((($_POST['auth_vote']) ? $_POST['auth_vote'] : $_POST['auth_vote'])) ."',
 auth_pollcreate = '". intval((($_POST['auth_pollcreate']) ? $_POST['auth_pollcreate'] : $_POST['auth_pollcreate'])) ."'";
 
$permissions_insert_sql_one = 
"auth_view, 
auth_read, 
auth_post, 
auth_reply, 
auth_edit, 
auth_delete, 
auth_sticky, 
auth_announce, 
auth_vote, 
auth_pollcreate";

$permissions_insert_sql_two = 
"'". intval((($_POST['auth_view']) ? $_POST['auth_view'] : $_POST['auth_view'])) ."', 
'". intval((($_POST['auth_read']) ? $_POST['auth_read'] : $_POST['auth_read'])) ."', 
'". intval((($_POST['auth_post']) ? $_POST['auth_post'] : $_POST['auth_post'])) ."', 
'". intval((($_POST['auth_reply']) ? $_POST['auth_reply'] : $_POST['auth_reply'])) ."', 
'". intval((($_POST['auth_edit']) ? $_POST['auth_edit'] : $_POST['auth_edit'])) ."', 
'". intval((($_POST['auth_delete']) ? $_POST['auth_delete'] : $_POST['auth_delete'])) ."', 
'". intval((($_POST['auth_sticky']) ? $_POST['auth_sticky'] : $_POST['auth_sticky'])) ."',
'". intval((($_POST['auth_announce']) ? $_POST['auth_announce'] : $_POST['auth_announce'])) ."',
'". intval((($_POST['auth_vote']) ? $_POST['auth_vote'] : $_POST['auth_vote'])) ."',
'". intval((($_POST['auth_pollcreate']) ? $_POST['auth_pollcreate'] : $_POST['auth_pollcreate'])) ."'";


// ------------------

// Begin function block

//

function get_info($mode, $id)

{

        global $db;



        switch($mode)

        {

                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $namefield = 'cat_title';

                        break;



                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $namefield = 'forum_name';

                        break;



                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;

        }

        $sql = "SELECT count(*) as total

                FROM $table";

        if( !$result = $db->sql_query($sql) )

        {

                message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);

        }

        $count = $db->sql_fetchrow($result);

        $count = $count['total'];



        $sql = "SELECT *

                FROM $table

                WHERE $idfield = $id";



        if( !$result = $db->sql_query($sql) )

        {

                message_die(GENERAL_ERROR, "Couldn't get Forum/Category information", "", __LINE__, __FILE__, $sql);

        }



        if( $db->sql_numrows($result) != 1 )

        {

                message_die(GENERAL_ERROR, "Forum/Category doesn't exist or multiple forums/categories with ID $id", "", __LINE__, __FILE__);

        }



        $return = $db->sql_fetchrow($result);

        $return['number'] = $count;

        return $return;

}



function get_list($mode, $id, $select)

{

        global $db;



        switch($mode)

        {

                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $namefield = 'cat_title';

                        break;



                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $namefield = 'forum_name';

                        break;



                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;

        }



        $sql = "SELECT *

                FROM $table";

        if( $select == 0 )

        {

                $sql .= " WHERE $idfield <> $id";

        }



        if( !$result = $db->sql_query($sql) )

        {

                message_die(GENERAL_ERROR, "Couldn't get list of Categories/Forums", "", __LINE__, __FILE__, $sql);

        }



        $cat_list = "";



        while( $row = $db->sql_fetchrow($result) )

        {

                $s = "";

                if ($row[$idfield] == $id)

                {

                        $s = " selected=\"selected\"";

                }

                $catlist .= "<option value=\"$row[$idfield]\"$s>" . $row[$namefield] . "</option>\n";

        }



        return($catlist);

}



function renumber_order($mode, $cat = 0)

{

        global $db;



        switch($mode)

        {

                case 'category':

                        $table = CATEGORIES_TABLE;

                        $idfield = 'cat_id';

                        $orderfield = 'cat_order';

                        $cat = 0;

                        break;



                case 'forum':

                        $table = FORUMS_TABLE;

                        $idfield = 'forum_id';

                        $orderfield = 'forum_order';

                        $catfield = 'cat_id';

                        break;



                default:

                        message_die(GENERAL_ERROR, "Wrong mode for generating select list", "", __LINE__, __FILE__);

                        break;

        }



        $sql = "SELECT * FROM $table";

        if( $cat != 0)

        {

                $sql .= " WHERE $catfield = $cat";

        }

        $sql .= " ORDER BY $orderfield ASC";





        if( !$result = $db->sql_query($sql) )

        {

                message_die(GENERAL_ERROR, "Couldn't get list of Categories", "", __LINE__, __FILE__, $sql);

        }



        $i = 10;

        $inc = 10;



        while( $row = $db->sql_fetchrow($result) )

        {

                $sql = "UPDATE $table

                        SET $orderfield = $i

                        WHERE $idfield = " . $row[$idfield];

                if( !$db->sql_query($sql) )

                {

                        message_die(GENERAL_ERROR, "Couldn't update order fields", "", __LINE__, __FILE__, $sql);

                }

                $i += 10;

        }



}

//

// End function block

// ------------------



//

// Begin program proper

//

if( isset($_POST['addforum']) || isset($_POST['addcategory']) )

{

        $mode = ( isset($_POST['addforum']) ) ? "addforum" : "addcat";



        if( $mode == "addforum" )

        {

                list($cat_id) = each($_POST['addforum']);

                $cat_id = intval($cat_id);

                //

                // stripslashes needs to be run on this because slashes are added when the forum name is posted

                //

                $forumname = stripslashes($_POST['forumname'][$cat_id]);

        }

}



if( !empty($mode) )

{

        switch($mode)

        {

                case 'addforum':

                case 'editforum':

                        //

                        // Show form to create/modify a forum

                        //

                        if ($mode == 'editforum')

                        {

                                // $newmode determines if we are going to INSERT or UPDATE after posting?



                                $l_title = $lang['Edit_forum'];

                                $newmode = 'modforum';

                                $buttonvalue = $lang['Update'];



                                $forum_id = intval($_GET[POST_FORUM_URL]);



                                $row = get_info('forum', $forum_id);



                                $cat_id = $row['cat_id'];

                                $forumname = $row['forum_name'];

                                $forumdesc = $row['forum_desc'];

                                $forumstatus = $row['forum_status'];

   // Added by Attached Forums MOD

   

			   $forum_attached_id = $row['attached_forum_id'];

				$sql = "SELECT * from ". FORUMS_TABLE. " WHERE attached_forum_id = $forum_id";

				if( !$r = $db->sql_query($sql) )

				{

					message_die(GENERAL_ERROR, "Couldn't get list of children Forums", "", __LINE__, __FILE__, $sql);

				}



				if( $db->sql_numrows($r) > 0 )

				{



					$not_attachable=1;

					$has_subforums=1;

					$template->assign_block_vars('switch_attached_no', array());

					if (intval($_POST['detach_enabled'])) $detach_enabled = "checked=\"checked\"";



				}

				else

				{



					// this forum is not a parent of any other forum

					$sql = "SELECT * FROM ". FORUMS_TABLE. " WHERE attached_forum_id=-1 and cat_id= $cat_id and forum_id<>$forum_id ORDER BY forum_order";



					if( !$result1 = $db->sql_query($sql) )

					{

						message_die(GENERAL_ERROR, "Couldn't get list of attachable Forums", "", __LINE__, __FILE__, $sql);

					}

					if( $db->sql_numrows($result1) > 0 )

					{

						$attachable_forums = '<option value = "-1"'.($forum_attached_id==-1?' selected':'').'> NOT ATTACHED TO ANY FORUM </a>';

						while( $row1 = $db->sql_fetchrow($result1) )

						{

							$s='';

							if ($forum_attached_id == $row1['forum_id'])

							{

								$s = " selected=\"selected\"";

							}

							$attachable_forums .= '<option value="'.$row1[forum_id].$s.'">' . $row1[forum_name] . '</option>\n';

						}

					}

					else

					{

						$no_attachable_forums=1;

					}



				}

   // End Added by Attached Forums MOD

                                $forum_notify = $row['forum_notify'];

                                //

                                // start forum prune stuff.

                                //

                                if( $row['prune_enable'] )

                                {

                                        $prune_enabled = "checked=\"checked\"";

                                        $sql = "SELECT *

                                       FROM " . PRUNE_TABLE . "

                                       WHERE forum_id = $forum_id";

                                        if(!$pr_result = $db->sql_query($sql))

                                        {

                                                 message_die(GENERAL_ERROR, "Auto-Prune: Couldn't read auto_prune table.", __LINE__, __FILE__);

                                }



                                        $pr_row = $db->sql_fetchrow($pr_result);

                                }

                                else

                                {

                                        $prune_enabled = '';

                                }

                        }

else

{

	$l_title = $lang['Create_forum'];

	$newmode = 'createforum';

	$buttonvalue = $lang['Create_forum'];



	$forumdesc = '';

	$forumstatus = FORUM_UNLOCKED;

	$forum_id = ''; 

	$prune_enabled = '';

   // Added by Attached Forums MOD



					$sql = "SELECT * FROM ". FORUMS_TABLE. " WHERE attached_forum_id=-1 and cat_id= $cat_id ORDER BY forum_order";



					if( !$result1 = $db->sql_query($sql) )

					{

						message_die(GENERAL_ERROR, "Couldn't get list of Categories/Forums", "", __LINE__, __FILE__, $sql);

					}

				if( $db->sql_numrows($result1) > 0 )

				{

					$attachable_forums = '<option value = "-1"'.(($forum_attached_id==-1 || !$forum_attached_id)?' selected':'').'> NOT ATTACHED TO ANY FORUM </a>';

					while( $row1 = $db->sql_fetchrow($result1) )

					{



						if ($forum_attached_id == $row1['forum_id'])

						{

							$s = " selected=\"selected\"";

						}

						$attachable_forums .= '<option value="'.$row1[forum_id].$s.'">' . $row1[forum_name] . '</option>\n';

					}





				}

				else

				{

					$no_attachable_forums=1;

				}

   // END Added by Attached Forums MOD

	$forum_notify = '1';

}



( $forum_notify == '1' ) ? $notify_enabled = "selected=\"selected\"" : $notify_disabled = "selected=\"selected\"";

$notifylist = "<option value=\"1\" $notify_enabled>" . $lang['Forum_notify_enabled'] . "</option>\n";

$notifylist .= "<option value=\"0\" $notify_disabled>" . $lang['Forum_notify_disabled'] . "</option>\n";

   // Added by Attached Forums MOD



			$forum_attached_id = $attachable_forums;

   // END Added by Attached Forums MOD

                        $catlist = get_list('category', $cat_id, TRUE);



                        $forumstatus == ( FORUM_LOCKED ) ? $forumlocked = "selected=\"selected\"" : $forumunlocked = "selected=\"selected\"";



                        // These two options ($lang['Status_unlocked'] and $lang['Status_locked']) seem to be missing from

                        // the language files.

                        $lang['Status_unlocked'] = isset($lang['Status_unlocked']) ? $lang['Status_unlocked'] : 'Unlocked';

                        $lang['Status_locked'] = isset($lang['Status_locked']) ? $lang['Status_locked'] : 'Locked';



                        $statuslist = "<option value=\"" . FORUM_UNLOCKED . "\" $forumunlocked>" . $lang['Status_unlocked'] . "</option>\n";

                        $statuslist .= "<option value=\"" . FORUM_LOCKED . "\" $forumlocked>" . $lang['Status_locked'] . "</option>\n";



                        $template->set_filenames(array(

                                "body" => "admin/forum_edit_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode .'" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';
			$in_from = ($_GET['in_from']) ? $_GET['in_from'] : $_GET['in_from'];
			if (isset($in_from))
				$s_hidden_fields .= '<input type="hidden" name="popup" value="1">';

   // Added by Attached Forums MOD



			if ($not_attachable or $no_attachable_forums)

			{

				if ($has_subforums)

				{

					$lang['Attached_Description'] = $lang['Has_attachments'].'<br>'. $lang['Attached_Description'];

					$s_hidden_fields .='<input type="hidden" name="has_subforums" value="1" />';

				}

				if ($no_attachable_forums) $lang['Attached_Description'] = $lang['No_attach_forums'].'<br>'. $lang['Attached_Description'];

				$s_hidden_fields .='<input type="hidden" name="attached_forum_id" value="-1" />';

			}

			else

			{

				$template->assign_block_vars('switch_attached_yes', array());

			}

				$s_hidden_fields .='<input type="hidden" name="old_cat_id" value="'.$cat_id.'" />';

   // END Added by Attached Forums MOD
$field_names 		= array('auth_view', 'auth_read', 'auth_post', 'auth_reply', 'auth_edit', 'auth_delete', 'auth_sticky', 'auth_announce', 'auth_vote', 'auth_pollcreate');
$field_values 		= array('auth_view' => $lang['View'],'auth_read' => $lang['Read'],'auth_post' => $lang['Post'],'auth_reply' => $lang['Reply'],'auth_edit' => $lang['Edit'],'auth_delete' => $lang['Delete'],'auth_sticky' => $lang['Sticky'],'auth_announce' => $lang['Announce'], 'auth_vote' => $lang['Vote'], 'auth_pollcreate' => $lang['Pollcreate']);
$forum_levels 		= array('ALL', 'REG', 'PRIVATE', 'MOD', 'ADMIN');
$forum_level_val 	= array(AUTH_ALL, AUTH_REG, AUTH_ACL, AUTH_MOD, AUTH_ADMIN);
$rows				= 0;
$allowed_rows		= 4;

		for ($a = 0; $a < count($field_names); $a++)
			{
		unset($custom_auth, $seleted, $cell_title, $switch, $section);
		$custom_auth[$a] = '&nbsp;<select name="'. $field_names[$a] .'">';

			for ($b = 0; $b < count($forum_levels); $b++)
				{
			$selected = ( $row[$field_names[$a]] == $forum_level_val[$b] ) ? ' selected="selected"' : '';
			$custom_auth[$a] .= '<option value="'. $forum_level_val[$b] .'"'. $selected .'>'. $lang['Forum_'. $forum_levels[$b]] .'</option>';
				}
			$custom_auth[$a] .= '</select>&nbsp;';

		$cell_title = $field_values[$field_names[$a]];
			
		if ($rows <= $allowed_rows)
			{
		$section 	= '1_5';			
		$switch 	= 'top.';
		$template->assign_block_vars('top', array());
			}
		elseif ($rows > $allowed_rows)
			{
		$section 	= '5_10';			
		$switch 	= 'bottom.';
		$template->assign_block_vars('bottom', array());
			}
			
		$template->assign_block_vars($switch . $section, array(
			'TITLES' => $cell_title .'<br>'. $custom_auth[$a] .'&nbsp;&nbsp;')
				);

		$rows++;
			}
                        $template->assign_vars(array(

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

                                'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                'S_SUBMIT_VALUE' => $buttonvalue,

                                'S_CAT_LIST' => $catlist,

                                'S_STATUS_LIST' => $statuslist,

                                'S_PRUNE_ENABLED' => $prune_enabled,

   // Added by Attached Forums MOD

   'S_ATTACHED_FORUM_ID' => $forum_attached_id,

   'S_DETACH_ENABLED'=> $detach_enabled,

   // End Added by Attached Forums MOD

                                'S_NOTIFY_ENABLED' => $notifylist,

                                'L_FORUM_TITLE' => $l_title,

                                'L_FORUM_EXPLAIN' => $lang['Forum_edit_delete_explain'],

                                'L_FORUM_SETTINGS' => $lang['Forum_settings'],

                                'L_FORUM_NAME' => $lang['Forum_name'],

                                'L_CATEGORY' => $lang['Category'],

   // Added by Attached Forums MOD

   'L_ATTACHED_FORUM' => $lang['Attached_Field_Title'] ,

   'L_ATTACHED_DESC' => $lang['Attached_Description'],

   'L_DETACH_DESC'	=> $lang['Detach_Description'],

   // End Added by Attached Forums MOD

                                'L_FORUM_DESCRIPTION' => $lang['Forum_desc'],

                                'L_FORUM_STATUS' => $lang['Forum_status'],

                                'L_FORUM_NOTIFY' => $lang['Forum_notify'],

                                'L_AUTO_PRUNE' => $lang['Forum_pruning'],

                                'L_ENABLED' => $lang['Enabled'],

                                'L_PRUNE_DAYS' => $lang['prune_days'],

                                'L_PRUNE_FREQ' => $lang['prune_freq'],

                                'L_DAYS' => $lang['Days'],



                                'PRUNE_DAYS' => ( isset($pr_row['prune_days']) ) ? $pr_row['prune_days'] : 7,

                                'PRUNE_FREQ' => ( isset($pr_row['prune_freq']) ) ? $pr_row['prune_freq'] : 1,

                                'FORUM_NAME' => $forumname,

                                'DESCRIPTION' => $forumdesc)

                        );

                        $template->pparse("body");

                        break;



                case 'createforum':

                        //

                        // Create a forum in the DB

                        //

                        if( trim($_POST['forumname']) == "" )

                        {

                                message_die(GENERAL_ERROR, "Can't create a forum without a name");

                        }



                        $sql = "SELECT MAX(forum_order) AS max_order

                                FROM " . FORUMS_TABLE . "

                                WHERE cat_id = " . intval($_POST[POST_CAT_URL]);

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);

                        }

                        $row = $db->sql_fetchrow($result);



                        $max_order = $row['max_order'];

                        $next_order = $max_order + 10;



                        $sql = "SELECT MAX(forum_id) AS max_id

                                FROM " . FORUMS_TABLE;

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't get order number from forums table", "", __LINE__, __FILE__, $sql);

                        }

                        $row = $db->sql_fetchrow($result);



                        $max_id = $row['max_id'];

                        $next_id = $max_id + 1;



                        //

                        // Default permissions of public ::

                        //

                        $field_sql = "";

                        $value_sql = "";

                        while( list($field, $value) = each($forum_auth_ary) )

                        {

                                $field_sql .= ", $field";

                                $value_sql .= ", $value";



                        }


         $field_sql = ''; 
         $value_sql = '';
                        // There is no problem having duplicate forum names so we won't check for it.

   // Modified by Attached Forums MOD



			if (intval($_POST['old_cat_id']) != intval($_POST[POST_CAT_URL]))

			{

   				$_POST['attached_forum_id']=-1;

   			}



		$sql = "INSERT INTO " . FORUMS_TABLE . " (forum_id, $permissions_insert_sql_one, forum_name, cat_id, attached_forum_id, forum_desc, forum_order, forum_status, prune_enable" . $field_sql . ")

				VALUES ('" . $next_id . "', $permissions_insert_sql_two, '" . str_replace("\'", "''", $_POST['forumname']) . "', " . intval($_POST[POST_CAT_URL]) .  ", " . intval($_POST['attached_forum_id']) . ", '" . str_replace("\'", "''", $_POST['forumdesc']) . "', $next_order, " . intval($_POST['forumstatus']) . ", " . intval($_POST['prune_enable']) . $value_sql . ")";

   // End Added by Attached Forums MOD

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't insert row in forums table", "", __LINE__, __FILE__, $sql);

                        }



                        if( $_POST['prune_enable'] )

                        {



                                if( $_POST['prune_days'] == "" || $_POST['prune_freq'] == "")

                                {

                                        message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);

                                }



                                $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)

                                        VALUES('" . $next_id . "', " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't insert row in prune table", "", __LINE__, __FILE__, $sql);

                                }

                        }



                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

			$in_from = ($_POST['popup']) ? $_POST['popup'] : $_POST['popup'];
			if ($in_from)
				$message = $lang['successfull_popup'] .'<br><br><a href="#" onclick="javascript:window.close();">'. $lang['close_popup'] .'</a>';


                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'modforum':

                        // Modify a forum in the DB

                        if( isset($_POST['prune_enable']))

                        {

                                if( $_POST['prune_enable'] != 1 )

                                {

                                        $_POST['prune_enable'] = 0;

                                }

                        }



   // Modified by Attached Forums MOD

			if (isset($_POST['detach_enabled']) && isset($_POST['has_subforums']))

			{

				$sql = "UPDATE ". FORUMS_TABLE. " SET attached_forum_id=-1 WHERE attached_forum_id=" . intval($_POST[POST_FORUM_URL]);

				if( !$result = $db->sql_query($sql) )

				{

					message_die(GENERAL_ERROR, "Couldn't detach subforums", "", __LINE__, __FILE__, $sql);

				}



			}



 			if (intval($_POST['old_cat_id']) != intval($_POST[POST_CAT_URL]))

   			{

				$_POST['attached_forum_id']=-1;

				if (isset($_POST['has_subforums']) && !isset($_POST['detach_enabled']))

				{

					$sql = "UPDATE ". FORUMS_TABLE ." SET cat_id=". intval($_POST[POST_CAT_URL]) ." WHERE attached_forum_id=" . intval($_POST[POST_FORUM_URL]);

					if( !$result = $db->sql_query($sql) )

					{

						message_die(GENERAL_ERROR, "Couldn't update subforums to new category", "", __LINE__, __FILE__, $sql);

					}



				}

			}



			$sql = "UPDATE " . FORUMS_TABLE . "

				SET forum_name = '" . str_replace("\'", "''", $_POST['forumname']) . "', $permissions_update_sql, cat_id = " . intval($_POST[POST_CAT_URL]) .", attached_forum_id = " . intval($_POST['attached_forum_id']) . ", forum_desc = '" . str_replace("\'", "''", $_POST['forumdesc']) . "', forum_status = " . intval($_POST['forumstatus']) . ", prune_enable = " . intval($_POST['prune_enable']) . "

				WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);

   // End Added by Attached Forums MOD

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);

                        }



                        if( $_POST['prune_enable'] == 1 )

                        {

                                if( $_POST['prune_days'] == "" || $_POST['prune_freq'] == "" )

                                {

                                        message_die(GENERAL_MESSAGE, $lang['Set_prune_data']);

                                }



                                $sql = "SELECT *

                                        FROM " . PRUNE_TABLE . "

                                        WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't get forum Prune Information","",__LINE__, __FILE__, $sql);

                                }



                                if( $db->sql_numrows($result) > 0 )

                                {

                                        $sql = "UPDATE " . PRUNE_TABLE . "

                                                SET        prune_days = " . intval($_POST['prune_days']) . ",        prune_freq = " . intval($_POST['prune_freq']) . "

                                                 WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);

                                }

                                else

                                {

                                        $sql = "INSERT INTO " . PRUNE_TABLE . " (forum_id, prune_days, prune_freq)

                                                VALUES(" . intval($_POST[POST_FORUM_URL]) . ", " . intval($_POST['prune_days']) . ", " . intval($_POST['prune_freq']) . ")";

                                }



                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't Update Forum Prune Information","",__LINE__, __FILE__, $sql);

                                }

                        }

if( $_POST['notify_enable'] != '1' )

{

	// delete all notifications for that forum

	$sql = "DELETE 

		FROM " . FORUMS_WATCH_TABLE . " 

		WHERE forum_id = " . intval($_POST[POST_FORUM_URL]);

		

	if( !$result = $db->sql_query($sql) )

	{

		message_die(GENERAL_ERROR, "Couldn't Update Forum Notify Information","",__LINE__, __FILE__, $sql);

	}

}

                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'addcat':

                        // Create a category in the DB

                        if( trim($_POST['categoryname']) == '')

                        {

                                message_die(GENERAL_ERROR, "Can't create a category without a name");

                        }



                        $sql = "SELECT MAX(cat_order) AS max_order

                                FROM " . CATEGORIES_TABLE;

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't get order number from categories table", "", __LINE__, __FILE__, $sql);

                        }

                        $row = $db->sql_fetchrow($result);



                        $max_order = $row['max_order'];

                        $next_order = $max_order + 10;



                        //

                        // There is no problem having duplicate forum names so we won't check for it.

                        //

                        $sql = "INSERT INTO " . CATEGORIES_TABLE . " (cat_title, cat_order)

                                VALUES ('" . str_replace("\'", "''", $_POST['categoryname']) . "', $next_order)";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't insert row in categories table", "", __LINE__, __FILE__, $sql);

                        }



                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'editcat':

                        //

                        // Show form to edit a category

                        //

                        $newmode = 'modcat';

                        $buttonvalue = $lang['Update'];



                        $cat_id = intval($_GET[POST_CAT_URL]);



                        $row = get_info('category', $cat_id);

                        $cat_title = $row['cat_title'];



                        $template->set_filenames(array(

                                "body" => "admin/category_edit_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="' . POST_CAT_URL . '" value="' . $cat_id . '" />';



                        $template->assign_vars(array(

                                'CAT_TITLE' => $cat_title,



                                'L_EDIT_CATEGORY' => $lang['Edit_Category'],

                                'L_EDIT_CATEGORY_EXPLAIN' => $lang['Edit_Category_explain'],

                                'L_CATEGORY' => $lang['Category'],



                                'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                'S_SUBMIT_VALUE' => $buttonvalue,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"))

                        );



                        $template->pparse("body");

                        break;



                case 'modcat':

                        // Modify a category in the DB

                        $sql = "UPDATE " . CATEGORIES_TABLE . "

                                SET cat_title = '" . str_replace("\'", "''", $_POST['cat_title']) . "'

                                WHERE cat_id = " . intval($_POST[POST_CAT_URL]);

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't update forum information", "", __LINE__, __FILE__, $sql);

                        }



                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'deleteforum':

                        // Show form to delete a forum

                        $forum_id = intval($_GET[POST_FORUM_URL]);



                        $select_to = '<select name="to_id">';

                        $select_to .= "<option value=\"-1\"$s>" . $lang['Delete_all_posts'] . "</option>\n";

                        $select_to .= get_list('forum', $forum_id, 0);

                        $select_to .= '</select>';



                        $buttonvalue = $lang['Move_and_Delete'];



                        $newmode = 'movedelforum';



                        $foruminfo = get_info('forum', $forum_id);

                        $name = $foruminfo['forum_name'];



                        $template->set_filenames(array(

                                "body" => "admin/forum_delete_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $forum_id . '" />';



                        $template->assign_vars(array(

                                'NAME' => $name,



                                'L_FORUM_DELETE' => $lang['Forum_delete'],

                                'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'],

                                'L_MOVE_CONTENTS' => $lang['Move_contents'],

                                'L_FORUM_NAME' => $lang['Forum_name'],



                                "S_HIDDEN_FIELDS" => $s_hidden_fields,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

                                'S_SELECT_TO' => $select_to,

                                'S_SUBMIT_VALUE' => $buttonvalue)

                        );



                        $template->pparse("body");

                        break;



                case 'movedelforum':

                        //

                        // Move or delete a forum in the DB

                        //

                        $from_id = intval($_POST['from_id']);

                        $to_id = intval($_POST['to_id']);

                        $delete_old = intval($_POST['delete_old']);



                        // Either delete or move all posts in a forum

                        if($to_id == -1)

                        {

                                // Delete polls in this forum

                                $sql = "SELECT v.vote_id

                                        FROM " . VOTE_DESC_TABLE . " v, " . TOPICS_TABLE . " t

                                        WHERE t.forum_id = $from_id

                                                AND v.topic_id = t.topic_id";

                                if (!($result = $db->sql_query($sql)))

                                {

                                        message_die(GENERAL_ERROR, "Couldn't obtain list of vote ids", "", __LINE__, __FILE__, $sql);

                                }



                                if ($row = $db->sql_fetchrow($result))

                                {

                                        $vote_ids = '';

                                        do

                                        {

                                                $vote_ids .= (($vote_ids != '') ? ', ' : '') . $row['vote_id'];

                                        }

                                        while ($row = $db->sql_fetchrow($result));



                                        $sql = "DELETE FROM " . VOTE_DESC_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);



                                        $sql = "DELETE FROM " . VOTE_RESULTS_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);



                                        $sql = "DELETE FROM " . VOTE_USERS_TABLE . "

                                                WHERE vote_id IN ($vote_ids)";

                                        $db->sql_query($sql);

                                }

                                $db->sql_freeresult($result);



                                include_once("../../../includes/prune.php");

                                prune($from_id, 0, true); // Delete everything from forum

                        }

                        else

                        {

                                $sql = "SELECT *

                                        FROM " . FORUMS_TABLE . "

                                        WHERE forum_id IN ($from_id, $to_id)";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't verify existence of forums", "", __LINE__, __FILE__, $sql);

                                }



                                if($db->sql_numrows($result) != 2)

                                {

                                        message_die(GENERAL_ERROR, "Ambiguous forum ID's", "", __LINE__, __FILE__);

                                }

                                $sql = "UPDATE " . TOPICS_TABLE . "

                                        SET forum_id = $to_id

                                        WHERE forum_id = $from_id";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't move topics to other forum", "", __LINE__, __FILE__, $sql);

                                }

                                $sql = "UPDATE " . POSTS_TABLE . "

                                        SET        forum_id = $to_id

                                        WHERE forum_id = $from_id";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't move posts to other forum", "", __LINE__, __FILE__, $sql);

                                }

                                sync('forum', $to_id);

                        }



                        // Alter Mod level if appropriate - 2.0.4

                        $sql = "SELECT ug.user_id

                                FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug

                                WHERE a.forum_id <> $from_id

                                        AND a.auth_mod = 1

                                        AND ug.group_id = a.group_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);

                        }



                        if ($row = $db->sql_fetchrow($result))

                        {

                                $user_ids = '';

                                do

                                {

                                        $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];

                                }

                                while ($row = $db->sql_fetchrow($result));



                                $sql = "SELECT ug.user_id

                                        FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug

                                        WHERE a.forum_id = $from_id

                                                AND a.auth_mod = 1

                                                AND ug.group_id = a.group_id

                                                AND ug.user_id NOT IN ($user_ids)";

                                if( !$result2 = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't obtain moderator list", "", __LINE__, __FILE__, $sql);

                                }



                                if ($row = $db->sql_fetchrow($result2))

                                {

                                        $user_ids = '';

                                        do

                                        {

                                                $user_ids .= (($user_ids != '') ? ', ' : '' ) . $row['user_id'];

                                        }

                                        while ($row = $db->sql_fetchrow($result2));



                                        $sql = "UPDATE " . USERS_TABLE . "

                                                SET user_level = " . USER . "

                                                WHERE user_id IN ($user_ids)

                                                        AND user_level <> " . ADMIN;

                                        $db->sql_query($sql);

                                }

                                $db->sql_freeresult($result);



                        }

                        $db->sql_freeresult($result2);



                        $sql = "DELETE FROM " . FORUMS_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);

                        }



                        $sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum", "", __LINE__, __FILE__, $sql);

                        }



                        $sql = "DELETE FROM " . PRUNE_TABLE . "

                                WHERE forum_id = $from_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete forum prune information!", "", __LINE__, __FILE__, $sql);

                        }

// delete all notifications for that forum

$sql = "DELETE FROM " . FORUMS_WATCH_TABLE . " 

	WHERE forum_id = $from_id";

if( !$result = $db->sql_query($sql) )

{

	message_die(GENERAL_ERROR, "Couldn't Delete Forum Notify Information","",__LINE__, __FILE__, $sql);

}

                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'deletecat':

                        //

                        // Show form to delete a category

                        //

                        $cat_id = intval($_GET[POST_CAT_URL]);



                        $buttonvalue = $lang['Move_and_Delete'];

                        $newmode = 'movedelcat';

                        $catinfo = get_info('category', $cat_id);

                        $name = $catinfo['cat_title'];



                        if ($catinfo['number'] == 1)

                        {

                                $sql = "SELECT count(*) as total

                                        FROM ". FORUMS_TABLE;

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't get Forum count", "", __LINE__, __FILE__, $sql);

                                }

                                $count = $db->sql_fetchrow($result);

                                $count = $count['total'];



                                if ($count > 0)

                                {

                                        message_die(GENERAL_ERROR, $lang['Must_delete_forums']);

                                }

                                else

                                {

                                        $select_to = $lang['Nowhere_to_move'];

                                }

                        }

                        else

                        {

                                $select_to = '<select name="to_id">';

                                $select_to .= get_list('category', $cat_id, 0);

                                $select_to .= '</select>';

                        }



                        $template->set_filenames(array(

                                "body" => "admin/forum_delete_body.tpl")

                        );



                        $s_hidden_fields = '<input type="hidden" name="mode" value="' . $newmode . '" /><input type="hidden" name="from_id" value="' . $cat_id . '" />';



                        $template->assign_vars(array(

                                'NAME' => $name,



                                'L_FORUM_DELETE' => $lang['Forum_delete'],

                                'L_FORUM_DELETE_EXPLAIN' => $lang['Forum_delete_explain'],

                                'L_MOVE_CONTENTS' => $lang['Move_contents'],

                                'L_FORUM_NAME' => $lang['Forum_name'],



                                'S_HIDDEN_FIELDS' => $s_hidden_fields,

                                'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

                                'S_SELECT_TO' => $select_to,

                                'S_SUBMIT_VALUE' => $buttonvalue)

                        );



                        $template->pparse("body");

                        break;



                case 'movedelcat':

                        //

                        // Move or delete a category in the DB

                        //

                        $from_id = intval($_POST['from_id']);

                        $to_id = intval($_POST['to_id']);



                        if (!empty($to_id))

                        {

                                $sql = "SELECT *

                                        FROM " . CATEGORIES_TABLE . "

                                        WHERE cat_id IN ($from_id, $to_id)";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't verify existence of categories", "", __LINE__, __FILE__, $sql);

                                }

                                if($db->sql_numrows($result) != 2)

                                {

                                        message_die(GENERAL_ERROR, "Ambiguous category ID's", "", __LINE__, __FILE__);

                                }



                                $sql = "UPDATE " . FORUMS_TABLE . "

                                        SET cat_id = $to_id

                                        WHERE cat_id = $from_id";

                                if( !$result = $db->sql_query($sql) )

                                {

                                        message_die(GENERAL_ERROR, "Couldn't move forums to other category", "", __LINE__, __FILE__, $sql);

                                }

                        }



                        $sql = "DELETE FROM " . CATEGORIES_TABLE ."

                                WHERE cat_id = $from_id";



                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't delete category", "", __LINE__, __FILE__, $sql);

                        }



                        $message = $lang['Forums_updated'] . "<br /><br />" . sprintf($lang['Click_return_forumadmin'], "<a href=\"" . append_sid("admin_forums.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");



                        message_die(GENERAL_MESSAGE, $message);



                        break;



                case 'forum_order':

                        //

                        // Change order of forums in the DB

                        //

                        $move = intval($_GET['move']);

                        $forum_id = intval($_GET[POST_FORUM_URL]);



                        $forum_info = get_info('forum', $forum_id);



                        $cat_id = $forum_info['cat_id'];



                        $sql = "UPDATE " . FORUMS_TABLE . "

                                SET forum_order = forum_order + $move

                                WHERE forum_id = $forum_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);

                        }



                        renumber_order('forum', $forum_info['cat_id']);

                        $show_index = TRUE;



                        break;



                case 'cat_order':

                        //

                        // Change order of categories in the DB

                        //

                        $move = intval($_GET['move']);

                        $cat_id = intval($_GET[POST_CAT_URL]);



                        $sql = "UPDATE " . CATEGORIES_TABLE . "

                                SET cat_order = cat_order + $move

                                WHERE cat_id = $cat_id";

                        if( !$result = $db->sql_query($sql) )

                        {

                                message_die(GENERAL_ERROR, "Couldn't change category order", "", __LINE__, __FILE__, $sql);

                        }



                        renumber_order('category');

                        $show_index = TRUE;



                        break;



                case 'forum_sync':

                        sync('forum', intval($_GET[POST_FORUM_URL]));

                        $show_index = TRUE;



                        break;



                default:

                        message_die(GENERAL_MESSAGE, $lang['No_mode']);

                        break;

        }



        if ($show_index != TRUE)

        {

                include_once('./page_footer_admin.'.$phpEx);

                exit;

        }

}



//

// Start page proper

//

$template->set_filenames(array(

        "body" => "admin/forum_admin_body.tpl")

);



$template->assign_vars(array(

        'S_FORUM_ACTION' => append_sid("admin_forums.$phpEx"),

        'L_FORUM_TITLE' => $lang['Forum_admin'],

        'L_FORUM_EXPLAIN' => $lang['Forum_admin_explain'],

        'L_CREATE_FORUM' => $lang['Create_forum'],

        'L_CREATE_CATEGORY' => $lang['Create_category'],

        'L_EDIT' => $lang['Edit'],

        'L_DELETE' => $lang['Delete'],

        'L_MOVE_UP' => $lang['Move_up'],

        'L_MOVE_DOWN' => $lang['Move_down'],

        'L_RESYNC' => $lang['Resync'])

);



$sql = "SELECT cat_id, cat_title, cat_order

        FROM " . CATEGORIES_TABLE . "

        ORDER BY cat_order";

if( !$q_categories = $db->sql_query($sql) )

{

        message_die(GENERAL_ERROR, "Could not query categories list", "", __LINE__, __FILE__, $sql);

}



if( $total_categories = $db->sql_numrows($q_categories) )

{

        $category_rows = $db->sql_fetchrowset($q_categories);



        $sql = "SELECT *

                FROM " . FORUMS_TABLE . "

                ORDER BY cat_id, forum_order";

        if(!$q_forums = $db->sql_query($sql))

        {

                message_die(GENERAL_ERROR, "Could not query forums information", "", __LINE__, __FILE__, $sql);

        }



        if( $total_forums = $db->sql_numrows($q_forums) )

        {

                $forum_rows = $db->sql_fetchrowset($q_forums);

        }

        $subforum_rows=$forum_rows;

        //

        // Okay, let's build the index

        //

        $gen_cat = array();



        for($i = 0; $i < $total_categories; $i++)

        {

                $cat_id = $category_rows[$i]['cat_id'];



                $template->assign_block_vars("catrow", array(

                        'S_ADD_FORUM_SUBMIT' => "addforum[$cat_id]",

                        'S_ADD_FORUM_NAME' => "forumname[$cat_id]",



                        'CAT_ID' => $cat_id,

                        'CAT_DESC' => $category_rows[$i]['cat_title'],



                        'U_CAT_EDIT' => append_sid("admin_forums.$phpEx?mode=editcat&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_DELETE' => append_sid("admin_forums.$phpEx?mode=deletecat&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=-15&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_CAT_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=cat_order&amp;move=15&amp;" . POST_CAT_URL . "=$cat_id"),

                        'U_VIEWCAT' => ("../../../modules.php?name=Forums&file=index&c=$cat_id"))

                );



                for($j = 0; $j < $total_forums; $j++)

                {

                        $forum_id = $forum_rows[$j]['forum_id'];



                        if ($forum_rows[$j]['cat_id'] == $cat_id)

                        {



				$sub_error=false;

				$do_template=false;

				if ($forum_rows[$j]['attached_forum_id'] !=-1)

				{

				$ok='';

					for($k = 0; $k < $total_forums; $k++)

					{

						$subforum_id = $subforum_rows[$k]['forum_id'];



						if ($subforum_id == $forum_rows[$j]['attached_forum_id'] && $forum_rows[$k]['attached_forum_id']==-1)

						{

							$ok=TRUE;//normal parent found

						}

					}

					if ($forum_rows[$j]['attached_forum_id']==$forum_id) $ok=FALSE; //attached to itself

					if ($forum_rows[$j]['attached_forum_id']==0) $ok=FALSE; //invalid parent

					if (!$ok)

					{

						$do_template=TRUE;

						$sub_error=true;

					}

				}

				else

				{

					$do_template=true;

				}//attached_forum_id'] ==-1





				if ($do_template)

				{

					$template->assign_block_vars("catrow.forumrow",	array(

						'FORUM_NAME' => $forum_rows[$j]['forum_name'],

						'FORUM_DESC' => $forum_rows[$j]['forum_desc'],

						'ROW_COLOR' => $row_color,

						'NUM_TOPICS' => $forum_rows[$j]['forum_topics'],

						'NUM_POSTS' => $forum_rows[$j]['forum_posts'],



						'U_VIEWFORUM' => ("../../../modules.php?name=Forums&file=viewforum&f=$forum_id"),

						'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$forum_id"),

						'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$forum_id"),

						'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$forum_id"),

						'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$forum_id"),

						'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$forum_id"))

					);

					if ($sub_error)

					{

						$template->assign_block_vars ('catrow.forumrow.switch_error',array());

					}



					for($k = 0; $k < $total_forums; $k++)

					{

						$subforum_id = $subforum_rows[$k]['forum_id'];

						if ($subforum_rows[$k]['attached_forum_id'] == $forum_id)

						{

							$template->assign_block_vars("catrow.forumrow",	array(

								'FORUM_NAME' => $subforum_rows[$k]['forum_name'],

								'FORUM_DESC' => $subforum_rows[$k]['forum_desc'],

								'ROW_COLOR' => $row_color,

								'NUM_TOPICS' => $subforum_rows[$k]['forum_topics'],

								'NUM_POSTS' => $subforum_rows[$k]['forum_posts'],



								'U_VIEWFORUM' => append_sid($phpbb_root_path."viewforum.$phpEx?" . POST_FORUM_URL . "=$subforum_id"),

								'U_FORUM_EDIT' => append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=$subforum_id"),

								'U_FORUM_DELETE' => append_sid("admin_forums.$phpEx?mode=deleteforum&amp;" . POST_FORUM_URL . "=$subforum_id"),

								'U_FORUM_MOVE_UP' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=-15&amp;" . POST_FORUM_URL . "=$subforum_id"),

								'U_FORUM_MOVE_DOWN' => append_sid("admin_forums.$phpEx?mode=forum_order&amp;move=15&amp;" . POST_FORUM_URL . "=$subforum_id"),

								'U_FORUM_RESYNC' => append_sid("admin_forums.$phpEx?mode=forum_sync&amp;" . POST_FORUM_URL . "=$subforum_id"))

							);

							$template->assign_block_vars ('catrow.forumrow.switch_attached_forum',array());

						}

					}

				}



                        }// if ... forumid == catid



                } // for ... forums



        } // for ... categories



}// if ... total_categories



$template->pparse("body");



include_once('./page_footer_admin.'.$phpEx);



?>

