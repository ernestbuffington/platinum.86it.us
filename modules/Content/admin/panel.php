<?php
/**********************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0
/* Written by: Jonathan Estrella
/* http://slaytanic.sourceforge.net
/* Copyright (c) 2004-2008 Jonathan Estrella
/**********************************************/

if (!defined('MODULE_FILE')) {
	die ('Access Denied');
}

global $cid, $pid, $admin, $db, $prefix, $admin_file, $module_name, $pa;
if (!is_admin($admin)) { die ('Access Denied'); }
echo '<center><strong>'._CP_CADMINPANEL.'</strong><br /><br />'.PHP_EOL;
if (!empty($cid) && $pa=='list_pages_categories') {
	$row = $db->sql_fetchrow($db->sql_query('SELECT title FROM '.$prefix.'_pages_categories WHERE cid='.$cid.''));
	echo _CP_CATEGORY.': <strong>'.$row['title'].'</strong><br /><br />'.PHP_EOL;
	echo '<a href="'.$admin_file.'.php?op=CPEditCat&amp;cid='.$cid.'">'.PHP_EOL;
	echo '<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" /></a>'.PHP_EOL;
	echo '<a href="'.$admin_file.'.php?op=CPDeleteCat&amp;cid='.$cid.'&amp;ok=0">'.PHP_EOL;
	echo '<img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" /></a>'.PHP_EOL;
}
if (!empty($pid)) {
	$row = $db->sql_fetchrow($db->sql_query('SELECT title, active FROM '.$prefix.'_pages WHERE pid='.$pid.''));
	echo _CP_CARTICLE.': <span style="font-weight: bold;">'.$row['title'].'</span><br /><br />'.PHP_EOL;
	echo '<a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'.PHP_EOL;
	echo '<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" /></a>'.PHP_EOL;
	if ($row['active'] == 1) {
		echo '<a href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=1">'.PHP_EOL;
		echo '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" /></a>'.PHP_EOL;
	} elseif ($row['active'] == 0) {
		echo '<a href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid=$pid&amp;active=0">'.PHP_EOL;
		echo '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_ACTIVATE.'" title="'._CP_ACTIVATE.'" border="0" /></a>'.PHP_EOL;
	}
	echo '<a href="'.$admin_file.'.php?op=CPDelete&amp;pid=$pid">'.PHP_EOL;
	echo '<img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" /></a>'.PHP_EOL;
}
echo '</center>'.PHP_EOL;
?>