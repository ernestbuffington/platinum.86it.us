<?php
/************************************************************************/
/*Platinum Nuke Pro Advanced Administration .                           */
/* Platinum Nuke Pro: Expect to be impressed                            */ 
/* Copyright (c) 2011, Platinum Nuke Pro                                */ 
/************************************************************************/
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com               */
/*Refer to platinumnukepro.com for detailed information                    */
/*on Platinum Nuke Pro                                                  */
/* Your dreams, our imagination                                         */ 
/************************************************************************/
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
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $db, $config, $sitename, $nukeurl, $admin_file, $bgcolor1, $bgcolor2, $bgcolor3, $textcolor1, $textcolor2, $admin, $user;
if (is_admin($admin)) {
if (!defined('_MAIN')) { define('_MAIN', 'Main'); }
if (!defined('_SEC')) { define('_SEC', 'Security'); }
if (!defined('_CONTENT')) { define('_CONTENT', 'Content'); }
if (!defined('_INTERNAL')) { define('_INTERNAL', 'Internal'); }
if (!defined('_SUBMISSION')) { define('_SUBMISSION', 'Submissions'); }
if (!defined('_ADMINNUKE')) { define('_ADMINNUKE', 'Admin CP [Platinum]'); }
if (!defined('_ADMINFORUM')) { define('_ADMINFORUM', 'Admin CP [Forum]'); }
if (!defined('_BLKSITECONFIG')) { define('_BLKSITECONFIG', 'Site Configuration'); }
if (!defined('_BLKUSERCONFIG')) { define('_BLKUSERCONFIG', 'User Edit/Config'); }
if (!defined('_BLKNEWSCONFIG')) { define('_BLKNEWSCONFIG', 'News Configuration'); }
if (!defined('_SENTINEL')) { define('_SENTINEL', 'Sentinel'); }
if (!defined('_HONEYPOT')) { define('_HONEYPOT', 'HoneyPot'); }
if (!defined('_CLOSESITE')) { define('_CLOSESITE', 'Close The Site'); }
if (!defined('_DOWNLOADS')) { define('_DOWNLOADS', 'Downloads'); }
if (!defined('_MSNL_NEWSLETTER')) { define('_MSNL_NEWSLETTER', 'Newsletter'); }
if (!defined('_CONTENTADMIN')) { define('_CONTENTADMIN', 'Content Admin'); }
if (!defined('_REVIEWADMIN')) { define('_REVIEWADMIN', 'Reviews Admin'); }
if (!defined('_FAQADMIN')) { define('_FAQADMIN', 'FAQ Administration'); }
if (!defined('_GROUPSADMIN')) { define('_GROUPSADMIN', 'Groups Admin'); }
if (!defined('_ACCOUNTADMIN')) { define('_ACCOUNTADMIN', 'Account Admin'); }
if (!defined('_BLOCKSADMIN')) { define('_BLOCKSADMIN', 'Blocks Administration'); }
if (!defined('_NGADMIN')) { define('_NGADMIN', 'User Info Block'); }
if (!defined('_CLASSIFIEDS')) { define('_CLASSIFIEDS', 'Waiting Ads'); }
if (!defined('_MODULESADMIN')) { define('_MODULESADMIN', 'Modules Admin'); }
if (!defined('_LOGOUT')) { define('_LOGOUT', 'Logout'); }
if (!defined('_ADMINLOGOUT')) { define('_ADMINLOGOUT', 'Admin Logout/Exit'); }
if (!defined('_PASSWORD')) { define('_PASSWORD', 'Password'); }
$content = '';
$content .= '<script type="text/javascript" language="javascript">
	/* <![CDATA[ */
	$(document).ready(function(){
		$("dd:not(:first)").hide();
		$("dt a").click(function(){
			$("dd:visible").slideUp("slow");
			$(this).parent().next().slideDown("slow");
			return false;
		});
	});
	/* ]]> */
	</script>';
if (is_admin($admin)) {	
$content .= '<dl style="color: '.$textcolor2.';margin: 0px;">' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._MAIN.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none;color: '.$textcolor2.'; padding: 5px;">' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php"><font style="color: '.$textcolor2.';">'._ADMINNUKE.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=forums"><font style="color: '.$textcolor2.';">'._ADMINFORUM.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=Configure"><font style="color: '.$textcolor2.';">'._BLKSITECONFIG.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=newsedit"><font style="color: '.$textcolor2.';">'._BLKNEWSCONFIG.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=yaAdmin"><font style="color: '.$textcolor2.';">'._BLKUSERCONFIG.'</font></a></li>' . "\n";
$content .= '' . "\n";
$content .= '	</ul>' . "\n";
$content .= '	</dd>' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._SEC.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=ABMain"><font style="color: '.$textcolor2.';">'._SENTINEL.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=honeypot"><font style="color: '.$textcolor2.';">'._HONEYPOT.'</font></a></li>' . "\n";
$content .= '	</ul>' . "\n";
$content .= '	</dd>' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._CONTENT.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
$content .= '' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=content"><font style="color: '.$textcolor2.';">'._CONTENTADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=downloads"><font style="color: '.$textcolor2.';">'._DOWNLOADS.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=FaqAdmin"><font style="color: '.$textcolor2.';">'._FAQADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=msnl_admin"><font style="color: '.$textcolor2.';">'._MSNL_NEWSLETTER.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=reviews"><font style="color: '.$textcolor2.';">'._REVIEWADMIN.'</font></a></li>' . "\n";
$content .= '	</ul>' . "\n";
$content .= '	</dd>' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._INTERNAL.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
$content .= '' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=yaAdmin"><font style="color: '.$textcolor2.';">'._ACCOUNTADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=ajaxBlocksEditor"><font style="color: '.$textcolor2.';">'._BLOCKSADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=NSNGroups"><font style="color: '.$textcolor2.';">'._GROUPSADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=modules"><font style="color: '.$textcolor2.';">'._MODULESADMIN.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=DFWAdmin"><font style="color: '.$textcolor2.';">'._NGADMIN.'</font></a></li>' . "\n";
$content .= '	</ul>' . "\n";
$content .= '	</dd>' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._SUBMISSION.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
$content .= '' . "\n";
		$content .= '<u><strong>Downloads</strong></u>';	
		$newdown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_newdownload')); // New Downloads
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$newdown.' ]<a href="'.$admin_file.'.php?op=DownloadNew">New Downloads</a></li>';
		$modrdown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE `brokendownload`=\'1\'')); // Modify Downloads
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$modrdown.' ]<a href="'.$admin_file.'.php?op=DownloadsListModRequests">Mod Downloads</a></li>';	
		$brokendown = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE `brokendownload`=\'0\'')); // Broken Downloads
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$brokendown.' ]<a href="'.$admin_file.'.php?op=DownloadsListBrokenDownloads">Bad Downloads</a><hr></li>';
		$content .= '<u><strong>Stories</strong></u>';	
		$submissions = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_queue')); // New Submissions
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$submissions.' ]<a href="'.$admin_file.'.php?op=submissions">Submissions</a><hr></li>';
		$content .= '<u><strong>Content</strong></u>';	
		$newcont = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_newpages')); // New Content
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$newcont.' ]<a href="'.$admin_file.'.php?op=CPPagesWaiting">New Content</a><hr></li>';
		$content .= '<u><strong>Supporters</strong></u>';	
		$suppend = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status`=\'0\'')); // Pending Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$suppend.' ]<a href="'.$admin_file.'.php?op=SPPending">Waiting</a></li>';
		$supact = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status` =\'1\'')); // Active Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$supact.' ]<a href="'.$admin_file.'.php?op=SPActive">Active</a></li>';
		$supsp = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_sites WHERE `site_status` =\'-1\'')); // Inactive Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$supsp.' ]<a href="'.$admin_file.'.php?op=SPInactive">Inactive</a><hr></li>';
		$content .= '<u><strong>Supporters 2</strong></u>';	
		$suppend2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status`=\'0\'')); // Pending Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$suppend2.' ]<a href="'.$admin_file.'.php?op=Supporters_2pending_2">Waiting</a></li>';
		$supact2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status` =\'1\'')); // Active Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$supact2.' ]<a href="'.$admin_file.'.php?op=Supporters_2active_2">Active</a></li>';
		$supsp2 = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_nsnsp_2_sites WHERE `site_status` =\'-1\'')); // Inactive Supporters
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$supsp2.' ]<a href="'.$admin_file.'.php?op=Supporters_2inactive_2">Inactive</a><hr></li>';
		$content .= '<u><strong>Calendar</strong></u>';
		$calendar = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_calendar_events WHERE `isapproved` =\'0\'')); //Calendar Submissions
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$calendar.' ]<a href="'.$admin_file.'.php?op=Calendar">Waiting Events</a><hr></li>';
		$content .= '<u><strong>Classifieds</strong></u>';	
		$num = $db->sql_numrows($db->sql_query("SELECT * FROM `nukec30_ads_ads` WHERE `active`= 0")); // New NukeC30
        $content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$num.' ]<a href="'.$admin_file.'.php?op=NukeC30">'._CLASSIFIEDS.'</a><hr></li>';			
		$content .= '<u><strong>Waiting Users</strong></u>';
		$tempuser = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_users_temp')); // Users Awaiting Activation
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;">[ '.$tempuser.' ]<a href="modules.php?name=Your_Account&file=admin&op=listpending">Waiting Users</a></li>';	
		$content .= '	</ul>' . "\n";
		$content .= '	</dd>' . "\n";
		$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
		$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._LOGOUT.'</font></a></dt>' . "\n";
		$content .= '	<dd style="margin: 0px;">' . "\n";
		$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
		$content .= '' . "\n";
		$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=logout"><font style="color: '.$textcolor2.';">'._ADMINLOGOUT.'</font></a></li>' . "\n";
		$content .= '	</ul>' . "\n";
		$content .= '	</dd>' . "\n";
		$content .= '</dl>' . "\n";
		$content .= '' . "\n";
}
} else {
	$content .= '<center><strong>Admin Login</strong></center><br /><br />';	
	$content .= '<form action="'.$admin_file.'.php" method="post">';
	$content .= '<table align="left" border="0">';
	$content .= '  <tr>';
	$content .= '    <td>Admin Name</td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td><input type="text" name="aid" size="12" maxlength="25" /></td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td>'._PASSWORD.'</td>';
	$content .= '  </tr>';
	$content .= '  <tr>';
	$content .= '    <td><input type="password" name="pwd" size="12" maxlength="40" /></td>';
	$content .= '  </tr>';
	$content .= security_code(array(1,5,6,7));		
	$content .= '  <tr>';
	$content .= '    <td><input type="hidden" name="op" value="login" /><input type="submit" value="'._LOGIN.'" />';
    $content .= '    <br /><br /><div align="right"><a href="http://platinumnukepro.com" alt="Platinum Nuke Pro" title="Platinum Nuke Pro" target="_blank">&copy;</a></div>';
	$content .= '    </td>';
	$content .= '  </tr>';
	$content .= '</table>';
	$content .= '</form>';
}
?>