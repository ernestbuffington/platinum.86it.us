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
	$module['Platinum MODs']['Session Repair'] = "$file";
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
echo '<tr><th>Repairing Sessions Table</th></tr><tr><td><span class="genmed"><ul type="circle">';


$sql = array();
$sql[] = "TRUNCATE `" . $prefix . "_bbsessions`";
$sql[] = "TRUNCATE `" . $prefix . "_session`";
$sql[] = "REPAIR TABLE `" . $prefix . "_bbsessions`";
$sql[] = "OPTIMIZE TABLE `" . $prefix . "_bbsessions`";
$sql[] = "REPAIR TABLE `" . $prefix . "_session`";
$sql[] = "OPTIMIZE TABLE `" . $prefix . "_session`";
for( $i = 0; $i < count($sql); $i++ )
{
	if( !$result = $db->sql_query ($sql[$i]) )
	{
		$error = $db->sql_error();

		echo '<li>' . $sql[$i] . '<br /> +++ <font color="#FF0000"><strong>Error:</strong></font> ' . $error['message'] . '</li><br />';
	}
	else
	{
		echo '<li>' . $sql[$i] . '<br /> +++ <font color="#00AA00"><strong>Successfull</strong></font></li><br />';
	}
}


echo '</ul></span></td></tr><tr><td class="catBottom" height="28">&nbsp;</td></tr>';

echo '<tr><th>Completed!</th></tr><tr><td><span class="genmed">Session Repair is now finished. <br />If you have run into any errors, please visit <a href="http://www.platinumnukepro.com" target="_blank">Platinum Nuke</a> and post your errors.</span></td></tr>';
echo '<tr><td class="catBottom" height="28" align="center">&nbsp;</td></table>';

include_once('./page_footer_admin.'.$phpEx);

?>
