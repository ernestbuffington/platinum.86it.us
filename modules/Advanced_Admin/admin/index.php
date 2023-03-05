<?php
/*=======================================================================
 Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
    Nuke-Evolution: Advanced Admin Block
    ===========================================================
    Copyright (c) 2009-2010 by DarkForgeGfx Development Team
    Author        : killigan
    Version       : 1.0.3
    Developer     : killigan - www.darkforgegfx.com
    Notes         : N/A
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
 	  Block completely recoded (SgtLegend)     v1.0.3       01/18/2009
 	  Block completely recoded                 v1.0.2       08/30/2009
      Admin Panel added                        v1.0.2       08/30/2009
 ************************************************************************/

/*if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}*/

$module_name = "Advanced_Admin";

global $db, $admin_file, $admin, $userinfo, $module_name, $lang_new;

include_once('modules/'.$module_name.'/admin/inc/functions.php');


if (is_admin($admin)) {
	echo '<script type="text/javascript" language="javascript" src="modules/'.$module_name.'/admin/inc/lytebox/lytebox.js"></script>';
	echo '<link rel="stylesheet" href="modules/'.$module_name.'/admin/inc/lytebox/lytebox.css" type="text/css" media="screen" />';
	
	get_lang($module_name);
	include_once('header.php');
	
	// Grab the current config
	$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_aab_config LIMIT 0,1"));
	//$config = $db->sql_fetchrow("SELECT * FROM ".$prefix."_aab_config LIMIT 0,1");

	OpenTable();
    echo '<div align="center"><a href="'.$admin_file.'.php?op=Advanced_Admin"><img src="modules/'.$module_name.'/images/aab.png" border="0" /></a>';
	echo '<br /><br />';
	echo '[ <a href="'.$admin_file.'.php">'.$lang_new['MAIN_ADMINISTRATION'].'</a> ]</div>';
	echo "    <br /><br /><div align=\"right\"><a href=\"http://www.darkforgegfx.com\" alt=\"DarkForge GFX\" title=\"DarkForge GFX\" target=\"_blank\">&copy; darkforgegfx</a></div>";
	CloseTable();
	OpenTable();
		
	if ($op <> 'block_config_save'){
		echo '<form action="'.$admin_file.'.php?op=block_config_save" method="post">';
		echo '<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3">';
		echo '  <tr>';
		echo '    <th colspan="2" class="thHead">'.$lang_new['BLOCK_CONFIG'].'</th>';
		echo '  </tr>';
		// cPanel Link
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['CPANEL'].':</strong></td>';
		echo '    <td width="50%"><input name="cpanel_url" type="text" size="60" value="'.$config['cpanel_url'].'" /><br />( '.$lang_new['EXAMPLE'].': '.$lang_new['CPANELEXAMPLE'].' )</td>';
		echo '  </tr>';
		// phpMyAdmin Link
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['PHPMYADMIN'].':</strong></td>';
		echo '    <td width="50%"><input name="phpmyadmin_url" type="text" size="60" value="'.$config['phpmyadmin_url'].'" /><br />( '.$lang_new['EXAMPLE'].': '.$lang_new['MYADMINEXAMPLE'].' )</td>';
		echo '  </tr>';
		// Display Admin Button
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['MAINADMIN'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('mainadmin_button', $config['mainadmin_button']).'</td>';
		echo '  </tr>';
		// Display Forum Admin Button
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['FORUMADMIN'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('forumadmin_button', $config['forumadmin_button']).'</td>';
		echo '  </tr>';
		// Display phpMyAdmin Button
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['MYADMINBUTTON'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('phpmyadmin_button', $config['phpmyadmin_button']).'</td>';
		echo '  </tr>';
		// Display cPanel Button
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['CPANELBUTTON'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('cpanel_button', $config['cpanel_button']).'</td>';
		echo '  </tr>';
		// Display Logout Button
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['ADMINLOGOUT'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('admin_logout', $config['admin_logout']).'</td>';
		echo '  </tr>';
		// Button Text
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['BUTTONTEXT'].':</strong></td>';
		echo '    <td width="50%"><input name="button_text" type="text" size="7" maxlength="7" value="'.$config['button_text'].'"/> <a href="color.php" rel="lyteframe" title="" rev="width: 450px; height: 300px; scrolling: no;">Click Here to select color!</a><br />( '.$lang_new['EXAMPLE'].': '.$lang_new['BUTTONEXAMPLE'].' )</td>';
		echo '  </tr>';
		// Show Warning Image
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWWARNINGIMAGE'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('show_warning_image', $config['show_warning_image']).'</td>';
		echo '  </tr>';
		// Show Warning
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWWARNING'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('show_warning', $config['show_warning']).'</td>';
		echo '  </tr>';
		// Warning Text
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['WARNINGTEXT'].':</strong></td>';
		echo '    <td width="50%"><input name="warning_text" type="text" size="60" value="'.$config['warning_text'].'"/></td>';
		echo '  </tr>';
		
		
/*		// Show Fusion
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWFUSION'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('fusion_menu', $config['fusion_menu']).'</td>';
		echo '  </tr>';		
*/		
		
		// Show Sentinel
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWSENTINEL'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('sentinel_menu', $config['sentinel_menu']).'</td>';
		echo '  </tr>';
		// Show Modules
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWMODULES'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('show_modules', $config['show_modules']).'</td>';
		echo '  </tr>';
		// Show Forum
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SHOWFORUM'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('show_forum', $config['show_forum']).'</td>';
		echo '  </tr>';
		// Show Submissions
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['SUBMISSIONS'].':</strong></td>';
		echo '    <td width="50%">'.aa_yesno_option('submissions', $config['submissions']).'</td>';
		echo '  </tr>';
		// Block Width
		echo '  <tr>';
		echo '    <td width="40%" class="row1" height="28"><strong>'.$lang_new['BLOCKWIDTH'].':</strong></td>';
		echo '    <td width="50%"><input name="block_width" type="text" size="7" maxlength="3" value="'.$config['block_width'].'"/></td>';
		echo '  </tr>';
		echo '  <tr>';
		echo '    <td colspan="2" align="center"><input name="submit" type="submit" value="'.$lang_new['UPDATE_BLOCK_CONFIG'].'">';
		echo '  <tr>';
		echo '</table>';
		echo '</form>';
	} else {
		$db->sql_query("UPDATE `".$prefix."_aab_config` SET `phpmyadmin_url`='$phpmyadmin_url', `cpanel_url`='$cpanel_url', `mainadmin_button`='$mainadmin_button', `forumadmin_button`='$forumadmin_button', `phpmyadmin_button`='$phpmyadmin_button', `cpanel_button`='$cpanel_button', `admin_logout`='$admin_logout', `show_warning_image`='$show_warning_image', `show_warning`='$show_warning', `button_text`='$button_text', `warning_text`='$warning_text', `fusion_menu`='$fusion_menu', `sentinel_menu`='$sentinel_menu', `show_modules`='$show_modules', `show_forum`='$show_forum', `submissions`='$submissions', `block_width`='$block_width'");
        header ('Location: '.$admin_file.'.php?op=Advanced_Admin');	
	}
} else {
	//GraphicAdmin();
	OpenTable();
	echo 'Access Denied';
	CloseTable();
	include_once('footer.php');
	exit;
}
	CloseTable();
	include_once('footer.php');

?>