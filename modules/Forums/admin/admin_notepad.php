<?php
/***************************************************************************
 *                               admin_notepad.php
 *                            ----------------------
 *
 *  copyright	: ©2003, 2004 Martyn Hackett  (webmaster@tophostinguk.com)
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

define('IN_PHPBB', 1);

//
// First we do the setmodules stuff for the admin cp.
//
if( !empty($setmodules) )
{
        $filename = basename(__FILE__);
        $module['General']['Admin Notepad'] = $filename;

        return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

//
// Output the authorisation details
//
$template->set_filenames(array(
        'body' => 'admin/admin_notpad.tpl'
        )
);

             if(isset($_POST['post'])){
                     $tnote = addslashes($_POST['noteme']);
                $query = $db->sql_query("UPDATE nuke_bbnotes SET text = '" . addslashes($_POST['noteme']) . "' WHERE id = 1");
        }

        $sql = $db->sql_query("SELECT text FROM nuke_bbnotes");
        if(!$sql) { echo mysql_error(); };
        $note = $db->sql_fetchrow($sql);

include_once('./page_header_admin.'.$phpEx);

        $template->assign_vars(array(
                "U_NOTEPAD" => stripslashes($note['text']))
        );

$template->pparse('body');

include_once('./page_footer_admin.'.$phpEx);

?>

