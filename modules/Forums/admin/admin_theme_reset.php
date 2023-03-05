<?php

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB', 1);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['Platinum MODs']['Reset Users Themes'] = "$file";
	return;
}

//
// Let's set the root dir for phpBB
//
global $prefix;
$phpbb_root_path = "./../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);

echo '<table width="100%" cellspacing="1" cellpadding="2" border="0" class="forumline">';
echo '<tr><th>Resetting all Users Theme to Default</th></tr><tr><td><span class="genmed"><ul type="circle">';


$sql = array();

$sql[] = "UPDATE `nuke_users` SET `user_theme` = NULL , `theme` = 'Default';";
for( $i = 0; $i < count($sql); $i++ )
{
	if( !$result = $db->sql_query ($sql[$i]) )
	{
		$error = $db->sql_error();

		echo '<li>' . $sql[$i] . '<br /> +++ <font color="#FF0000"><strong>Error:</strong></font> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql[$i] . '<br /> +++ <font color="#00AA00"><strong>Successful</strong></font></li><br />';
	}
}


echo '</ul></span></td></tr><tr><td class="catBottom" height="28">&nbsp;</td></tr>';

echo '<tr><th>Completed!</th></tr><tr><td><span class="genmed">Theme reset is now finished. <br />If you have run into any errors, please visit <a href="http://www.platinumnukepro.com" target="_blank">PlatinumNuke</a> and post your errors.</span></td></tr>';
echo '<tr><td class="catBottom" height="28" align="center">&nbsp;</td></table>';

include_once('./page_footer_admin.'.$phpEx);

?>
