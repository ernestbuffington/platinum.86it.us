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
/*if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}*/
global $prefix, $db, $admin, $admin_file, $config, $sitename, $nukeurl;
/****[START]******************************
 [ Block: Settings                       ]
 *****************************************/
$config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_aab_config LIMIT 0,1")); 
//$config = $db->sql_ufetchrow("SELECT * FROM ".$prefix."_aab_config LIMIT 0,1");
echo '<script type="text/javascript" language="javascript" src="modules/Advanced_Admin/admin/inc/lytebox/lytebox.js"></script>';
echo '<link rel="stylesheet" href="modules/Advanced_Admin/admin/inc/lytebox/lytebox.css" type="text/css" media="screen" />';
// <!-- Javascript collaspable categories start -->
echo '<script type="text/javascript" src="modules/Advanced_Admin/admin/inc/jquery.min.js"></script>';
echo '<script>jqcc=jQuery.noConflict(true);</script>';            
echo "<script type=\"text/javascript\">\n";
echo "var lastID;
function toggle_main(id){
	jqcc(document).ready(function(){
		if (lastID != '' || lastID != NULL || lastID != 'null'){
			jqcc('#main_'+lastID).slideUp('slow');
			jqcc('#maini_'+lastID).replaceWith('<img src=\"images/plus.gif\" id=\"maini_'+lastID+'\" border=\"0\" />');
		}
		if (lastID == id && jqcc('#main_'+id).css('display') == 'block'){
			jqcc('#main_'+id).slideUp('slow');
			jqcc('#maini_'+id).replaceWith('<img src=\"images/plus.gif\" id=\"maini_'+id+'\" border=\"0\" />');
		} else {
			jqcc('#main_'+id).slideDown('slow');
			jqcc('#maini_'+id).replaceWith('<img src=\"images/minus.gif\" id=\"maini_'+id+'\" border=\"0\" />');
			lastID = id;
		}
	});
}\n";	
// Menus Inner
echo "var lastSubID;
function toggle_sub(id){
	jqcc(document).ready(function(){
		if (lastSubID != '' || lastSubID != NULL || lastSubID != 'null'){
			jqcc('#main_sub_'+lastSubID).slideUp('slow');
		}
		if (lastSubID == id && jqcc('#main_sub_'+id).css('display') == 'block'){
			jqcc('#main_sub_'+id).slideUp('slow');
		} else {
			jqcc('#main_sub_'+id).slideDown('slow');
			lastSubID = id;
		}
	});
}
</script>\n";
// <!-- Javascript collsapable categories end -->
/****[END]********************************
 [ Block: Settings                       ]
 *****************************************/
$content = '';
// Navigation CSS
$text_color = (empty($config['button_text'])) ? '#FFFFFF' : $config['button_text'];
$content .= '<style type="text/css">
.nav_button {
background-image: url(modules/Advanced_Admin/images/'.$image_dir.'/title_bg.gif);
//background-image: url(modules/Advanced_Admin/images/title_bg.gif);
color: '.$text_color.';
text-align: center;
height: 20px;
width: 100%;
line-height: 1.95em;
border: #1a1a1a 1px solid;
cursor: pointer;
letter-spacing: 2px;
}
</style>';
    if (is_admin($admin)) {
	// Admin Menu
	if ($config['mainadmin_button'] == 1){
		$content .= '<div class="nav_button" title="Admin Panel" onclick="window.location=\''.$admin_file.'.php\'">Admin Panel</div>';
	}	  
	// Forum Admin Menu
	if ($config['forumadmin_button'] == 1){
		$content .= '<div class="nav_button" title="Forum Admin" onclick="window.location=\''.$admin_file.'.php?op=forums\'">Forum Admin</div>';
	}
	// cPanel Button
	if ($config['cpanel_button'] == 1 && !empty($config['cpanel_url'])){
		$content .= "<div class=\"nav_button\" title=\"Goto Your cPanel\" align=\"center\"><a href='".$config['cpanel_url']."' target=\"_blank\"><font color='".$config['button_text']."'>cPanel Login</a><div>";
		//$content .= '<div class="nav_button" title="Goto Your cPanel" onclick="window.location=\''.$config['cpanel_url'].'\'">cPanel Login</div>';
	}
	// phpMyAdmin Button
	if ($config['phpmyadmin_button'] == 1 && !empty($config['phpmyadmin_url'])){
		$content .= "<div class=\"nav_button\" title=\"phpMyAdmin\" align=\"center\"><a href='".$config['phpmyadmin_url']."' target=\"_blank\"><font color='".$config['button_text']."'>phpMyAdmin</a><div>";
		//$content .= '<div class="nav_button" title="phpMyAdmin" onclick="window.location=\''.$config['phpmyadmin_url'].'\'">phpMyAdmin</div>';
	}
    // Logout Button
	if ($config['admin_logout'] == 1){
		$content .= '<div class="nav_button" title="Logout" onclick="window.location=\''.$admin_file.'.php?op=logout\'">Logout</div>';
	}
	// HR Check
	if ($config['mainadmin_button'] == 1 || $config['forumadmin_button'] == 1 || $config['cpanel_button'] == 1 || $config['phpmyadmin_button'] == 1 || $config['admin_logout'] == 1){
		$content .= '<hr>';
	}
	$content .= '<div style="text-align:left;">';
	// Show Modules Admin	
	if ($config['show_modules'] == 1){
		$content .= '<div style="float:right;position:relative;cursor:pointer;"><a onclick="toggle_main(\'1\')"><img src="images/plus.gif" id="maini_1" border="0" /></a></div>';
		$content .= '<a href="javascript:void(0)" onclick="toggle_main(\'1\')" id="main_bar_1" style="font-weight:bold;">Admin Menu</a><br />';
	    $content .= '<div style="display:none;padding-left:5px;" id="main_1">';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php">Admin Main</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ajaxBlocksEditor">Blocks</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=CenterBlocksAdmin">Center Blocks</a><br>';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=modules">Modules</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=Configure">Preferences</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=czuser">CZ User Info</a><br />';	
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=sommaire">Sommaire</a><br>';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=themeconsole">Themes</a><br /><hr>';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=Advanced_Admin">Advanced Admin</a><br />';		
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ns_edl_general">Downloads</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=DLMain">Private Downloads</a><br>';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=Donations#AdminTop">Donations</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=messages">Messages</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=MAsetup&formno=0">Member Apps</a><br />';		
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=adminStory">News</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=newsedit">News Config</a><br />';		
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=WBIndex">Workboard</a><br />';		
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=Links">Web Links</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="modules.php?name=Your_Account&file=admin">Users Config</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=msnl_admin">HTML Newletter</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=shout">Shoutbox</a><br />';		
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=content">Content</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=tutorials">Tutorials</a><br />';
//		$content .= '<strong>&raquo;</strong> <a href="http://evolution-xtreme.com">Evolution-Xtreme</a><br />';
//		$content .= '<strong>&raquo;</strong> <a href="http://evolution-xtreme.com/modules.php?name=Forums">Support Forums</a><br />';	
		$content .= '</div>';
        $content .= '<hr>';		
	}
	// Show Forum Admin		
	if ($config['show_forum'] == 1){
		$content .= '<div style="float:right;position:relative;cursor:pointer;"><a onclick="toggle_main(\'2\')"><img src="images/plus.gif" id="maini_2" border="0" /></a></div>';
	    $content .= '<a href="javascript:void(0)" onclick="toggle_main(\'2\')" id="main_bar_2" style="font-weight:bold;">Forum Admin</a><br />';
	    $content .= '<div style="display:none;padding-left:5px;" id="main_2">';
		$content .= '<strong>&raquo;</strong> <a href="modules/Forums/admin/index.php">Forum Main</a><br />';
		// AUC
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'1\')">AUC</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_1">';
		$content .= '	<a href="modules/Forums/admin/admin_advanced_username_color.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Configuration</a></a><br />';
	    $content .= '	<a href="modules/Forums/admin/admin_advanced_username_color_m.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Management</a><br /><hr>';
		$content .= '  </div>';
		// Arcade Admin
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'2\')">Arcade Admin</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_2">';
	    $content .= '	<a href="modules/Forums/admin/admin_arcade.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Admin Arcade</a<br />';			
	    $content .= '	<a href="modules/Forums/admin/admin_arcade_games.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Manage Games</a><br />';
	    $content .= '	<a href="modules.php?name=Arcade_Tweaks"">Add Games</a><br /><hr>';				
		$content .= '  </div>';			
		// Forums Admin
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'3\')">Forums Admin</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_3">';
	    $content .= '	<a href="modules/Forums/admin/admin_forums.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Management</a><br />';
	    $content .= '	<a href="modules/Forums/admin/admin_overall_forumauth.php" rel="lyteframe" title="Forum Permissions" rev="width: 990px; height: 600px; scrolling: yes;">Permissions</a><br /><hr>';
		$content .= '  </div>';
		// General Admin
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'4\')">General Admin</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_4">';
	    $content .= '	<a href="modules/Forums/admin/admin_board.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Configuration</a><br />';
	    $content .= '	<a href="modules/Forums/admin/admin_mass_email.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Mass Email</a><br />';
	    $content .= '	<a href="modules/Forums/admin/admin_rebuild_search.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Rebuild Search</a><br /><hr>';		
		$content .= '  </div>';		
		// Group Admin
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'5\')">Group Admin</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_5">';
	    $content .= '    <a href="modules/Forums/admin/admin_groups.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Management</a><br />';
	    $content .= '    <a href="modules/Forums/admin/admin_ug_auth.php?mode=group" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Permissions</a><br /><hr>';
		$content .= '  </div>';	
		// User Admin
		$content .= '<strong>&raquo;</strong> <a href="javascript:void(0)" onclick="toggle_sub(\'6\')">Admin Users</a><br />';
		$content .= '  <div style="display:none;padding-left:15px;font-weight:bold;" id="main_sub_6">';
	    $content .= '    <a href="modules/Forums/admin/admin_users.php"  rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Management</a><br />';
	    $content .= '    <a href="modules/Forums/admin/admin_ug_auth.php?mode=user" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Permissions</a><br />';	
	    $content .= '    <a href="modules/Forums/admin/admin_priv_msgs.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">Private Msgs</a><br />';
	    $content .= '    <a href="modules/Forums/admin/admin_userlist.php" rel="lyteframe" title="" rev="width: 990px; height: 600px; scrolling: yes;">User Admin</a>';	
		$content .= '  </div>';	
		$content .= '</div>';
        $content .= '<hr>';	
	}	
	// Fusion Admin was here
	// Show Sentinel Admin	
	if ($config['sentinel_menu'] == 1){
		$content .= '<div style="float:right;position:relative;cursor:pointer;"><a onclick="toggle_main(\'4\')"><img src="images/plus.gif" id="maini_3" border="0" /></a></div>';
		$content .= '<a href="javascript:void(0)" onclick="toggle_main(\'4\')" id="main_bar_4" style="font-weight:bold;">Sentinel Menu</a><br />';
	    $content .= '<div style="display:none;padding-left:5px;" id="main_4">';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABMain">Sentinel Main</strong></a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABBlockedIPMenu">Blocked IP</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABBlockedRangeMenu">Blocked Range</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABExcludedMenu">Excluded Range</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABProtectedMenu">Protected Range</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABTrackedMenu">Tracked IP</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABCountryList">Country Listing</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABConfigAdmin">Blocked Config</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABSearchIPResults">Search IP</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABIP2CountryMenu">IP to Country</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABAuthList">Admin Auth List</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABAuthScan">Scan New Admins</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABDBOptimize">DB Maintenance</a><br />';
		$content .= '<strong>&raquo;</strong> <a href="'.$admin_file.'.php?op=ABTemplate">Template Menu</a>';
		$content .= '</div>';
        $content .= '<hr>';
	}
	// Show Submissions	
	if ($config['submissions'] == 1){
		$content .= '<div style="float:right;position:relative;cursor:pointer;"><a onclick="toggle_main(\'5\')"><img src="images/plus.gif" id="maini_4" border="0" /></a></div>';
	    $content .= '<a href="javascript:void(0)" onclick="toggle_main(\'5\')" id="main_bar_5" style="font-weight:bold;">Submissions</a><br />';
	    $content .= '<div style="display:none;" id="main_5">';
		$content .= '<br /><u><strong>Downloads</strong></u><br />';	
		$newdown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_newdownload')); // New Downloads
        $content .= '<div style="float:right;position:relative;">[ '.$newdown.' ]</div><a href="'.$admin_file.'.php?op=DownloadNew">New Downloads</a><br />';
		$modrdown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE `brokendownload`=\'1\'')); // Modify Downloads
        $content .= '<div style="float:right;position:relative;">[ '.$modrdown.' ]</div><a href="'.$admin_file.'.php?op=DownloadsListModRequests">Mod Downloads</a><br />';	
		$brokendown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE `brokendownload`=\'0\'')); // Broken Downloads
        $content .= '<div style="float:right;position:relative;">[ '.$brokendown.' ]</div><a href="'.$admin_file.'.php?op=DownloadsListBrokenDownloads">Bad Downloads</a><hr>';
		$content .= '<u><strong>Stories</strong></u></br />';	
		$submissions = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_queue')); // New Submissions
        $content .= '<div style="float:right;position:relative;">[ '.$submissions.' ]</div><a href="'.$admin_file.'.php?op=submissions">Submissions</a><hr>';
		$content .= '<u><strong>Content</strong></u><br />';	
		$newcont = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_newpages')); // New Content
        $content .= '<div style="float:right;position:relative;">[ '.$newcont.' ]</div><a href="'.$admin_file.'.php?op=CPPagesWaiting">New Content</a><br /><hr>';		
		$content .= '<u><strong>Supporters</strong></u><br />';	
		$suppend = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status`=\'0\'')); // Pending Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$suppend.' ]</div><a href="'.$admin_file.'.php?op=SPPending">Waiting</a><br />';
		$supact = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status` =\'1\'')); // Active Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$supact.' ]</div><a href="'.$admin_file.'.php?op=SPActive">Active</a><br />';
		$supsp = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status` =\'-1\'')); // Inactive Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$supsp.' ]</div><a href="'.$admin_file.'.php?op=SPInactive">Inactive</a><hr>';
		$content .= '<u><strong>Supporters 2</strong></u><br />';	
		$suppend2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status`=\'0\'')); // Pending Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$suppend2.' ]</div><a href="'.$admin_file.'.php?op=Supporters_2pending_2">Waiting</a><br />';
		$supact2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status` =\'1\'')); // Active Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$supact2.' ]</div><a href="'.$admin_file.'.php?op=Supporters_2active_2">Active</a><br />';
		$supsp2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status` =\'-1\'')); // Inactive Supporters
		$content .= '<div style="float:right;position:relative;">[ '.$supsp2.' ]</div><a href="'.$admin_file.'.php?op=Supporters_2inactive_2">Inactive</a><hr>';
		$content .= '<u><strong>Calendar</strong></u><br />';
		$calendar = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_calendar_events WHERE `isapproved` =\'0\'')); //Calendar Submissions
		$content .= '<div style="float:right;postion:relative;">[ '.$calendar.' ]</div><a href="'.$admin_file.'.php?op=Calendar">Waiting Events</a><hr>';
		$content .= '<u><strong>Waiting Users</strong></u><br />';
		$tempuser = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_users_temp')); // Users Awaiting Activation
		$content .= '<div style="float:right;position:relative;">[ '.$tempuser.' ]</div><a href="modules.php?name=Your_Account&file=admin&op=listpending">Waiting Users</a><br />';	
		$content .= '</div>';
	}
	$content .= '</div>';
    $content .= '<br /><div align="right"><a href="http://www.darkforgegfx.com" alt="DarkForgeGfx" title="DarkForgeGfx" target="_blank">&copy;</a></div>';
} else {
	if ($config['show_warning_image'] == 1){	
		$content .= '<center><img border="0" src="modules/Advanced_Admin/images/caution.png"></center>';
	}
	if ($config['show_warning'] == 1){	
		$content .= '<br /><center><font color="'.$config['button_text'].'">'.$config['warning_text'].'</font></center><br />';
	}
	$content .= '<center><strong>Admin Login</strong></center><br /><br />';	
	$content .= '<form action="'.$admin_file.'.php" method="post">';
	$content .= '<table align="left" border="0">';
	$content .= '  <tr>';
	$content .= '    <td>Username</td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td><input type="text" name="aid" size="12" maxlength="25" /></td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td>Password</td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td><input type="password" name="pwd" size="12" maxlength="40" /></td>';
	$content .= '  </tr>';
	$content .= security_code(array(1,5,6,7));		
	$content .= '  <tr>';
	$content .= '    <td><input type="hidden" name="op" value="login" /><input type="submit" value="'._LOGIN.'" />';
    $content .= '    <br /><br /><div align="right"><a href="http://www.darkforgegfx.com" alt="DarkForge GFX" title="DarkForge GFX" target="_blank">&copy; darkforgegfx</a></div>';
	$content .= '    </td>';
	$content .= '  </tr>';
	$content .= '</table>';
	$content .= '</form>';		
}
?>
