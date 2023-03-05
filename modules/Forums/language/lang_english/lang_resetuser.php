<?php
/***************************************************************************
 *                            lang_postcount.php
 *                            -------------------
 *   copyright            : (C) 2003 John McKernan
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
// message_die messages
$lang['Reset_noself'] = 'Sorry, but you can not reset yourself to \'User\' level.';	
$lang['Reset_nouser'] = 'Sorry, no user exists with the username <strong>%s</strong>. Please check the name and try again.';
$lang['Reset_success'] = 'The user, <strong>%s</strong>, has been successfully reset to \'User\' level.';
// language variables
$lang['Reset_user_level'] = 'Reset User-Level';
$lang['Reset_user_name'] = 'Username';
$lang['Reset_user_explain'] = 'Frequently, when changing a user from mod or above back to \'user\', the user-level is not fully reset. This can cause the user to show the wrong color in the online users list, and potentially other problems. This option allows you to fully reset the user.';
$lang['Reset_user_header'] = 'Reset User-Level to USER';
?>
