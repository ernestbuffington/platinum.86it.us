<?php
/*
+=============================================================================+
|  Site Navigator for PHP-Nuke                                                |
|  Copyright (c) 2004 Devaz Network, All Rights Reserved                      |
|  http://devaz.uni.cc                                                        |
|                                                                             |
|  Language Definition (English)                                              |
|  Creation date    : July 13th, 2004                                         |
|  Last revised     : -                                                       |
|  Revision history : -                                                       |
+-----------------------------------------------------------------------------+
|  Converted to Nuke-Evolution by ICEMAN at http://montecitogaming.com or     |
|  http://tc-net.info (but download at http://montecitogaming.com             |
+-----------------------------------------------------------------------------+
|  This program is free software; you can redistribute it and/or modify it    |
|  under the terms of the GNU General Public License as published by the      |
|  Free Software Foundation; either version 2 of the License, or (at your     |
|  option) any later version. (http://www.gnu.org/copyleft/gpl.html)          |
|                                                                             |
|  This program is distributed in the hope that it will be useful, but        |
|  WITHOUT ANY WARRANTY; without even the implied warranty of                 |
|  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General   |
|  Public License for more details.                                           |
|                                                                             |
|  You should have received a copy of the GNU General Public License along    |
|  with this program; if not, write to the Free Software Foundation, Inc.,    |
|  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                    |
|                                                                             |
|  You run this program at your sole risk. Author cannot be held liable of    |
|  uses and misuses of this program. It advised to test this program under    |
|  a development environment. Be sure to make any backups before implement    |
|  and running this program within a production environment.                  |
|                                                                             |
|  Installing and running this program also means you agree to the terms of   |
|  usages and conditions to this program. All codes that released here are    |
|  considered as sample code only. It may be fully functional, but you use    |
|  at your own risk. No warranty is given or implied. All original header     |
|  code and copyright messages will be maintained to give credit where        |
|  credit is due. If you modify this program, the only requirement is that    |
|  you also maintain all original copyright messages.                         |
|                                                                             |
+=============================================================================+
*/

if (!defined('SNAVI_IS_ACTIVE') || preg_match('/snavi\/languages\/lang\-[a-z09_-]+\.php$/i', $_SERVER['PHP_SELF']))
{
	die('<center>You cannot run this script directly.</center>');
}

/*****************************************************************************/
/*
 * language definitions
 */

$snavi_lang['about']                 = 'About';
$snavi_lang['about_desc']            = 'About Site Navigator';
$snavi_lang['join']                  = 'Join DFG Netowrk';
$snavi_lang['join_desc']             = 'Join This Network';
$snavi_lang['joinclan']              = 'Add Your Clan';
$snavi_lang['joinclan_desc']         = 'Add Your Clan';
$snavi_lang['home']                  = 'Home';
$snavi_lang['home_desc']             = 'Go to main home page';
$snavi_lang['network']               = 'Netowrk';
$snavi_lang['network_desc']          = 'Go to main Netowrk page';
$snavi_lang['admin']                 = 'Admin';
$snavi_lang['admin_desc']            = 'Go to administration panel';
$snavi_lang['account']               = 'Account';
$snavi_lang['account_desc']          = 'Go to user account panel';
$snavi_lang['files']                 = 'files';
$snavi_lang['files_desc']            = 'Go to file downloads';
$snavi_lang['files_sect']            = 'Go to downloads section: %s';
$snavi_lang['forums']                = 'Forums';
$snavi_lang['forums_desc']           = 'Go to forums board';
$snavi_lang['forums_cat']            = 'Go to forum category: %s';
$snavi_lang['forums_sect']           = 'Go to forum section: %s';
$snavi_lang['staffs']                = 'Staffs Online';
$snavi_lang['staffs_desc']           = 'Staffs that online right now';
$snavi_lang['staffs_info']           = 'Information about %s';
$snavi_lang['staffs_pm']             = 'Send Private Message to %s';
$snavi_lang['staffs_profile']        = '%s Forum Profile';
$snavi_lang['staffs_post']           = 'Find %s Posts';
$snavi_lang['members']               = 'Staffs Online';
$snavi_lang['members_desc']          = 'Staffs that online right now';
$snavi_lang['members_info']          = 'Information about %s';
$snavi_lang['members_pm']            = 'Send Private Message to %s';
$snavi_lang['members_profile']       = '%s Forum Profile';
$snavi_lang['members_post']          = 'Find %s Posts';
$snavi_lang['newpm']                 = 'New Private Message';
$snavi_lang['newpm_desc']            = 'You have new private messages';
$snavi_lang['newpm_from']            = 'From: %s';
$snavi_lang['newpm_subject']         = '%s';
$snavi_lang['newposts']              = 'New Forum Posts';
$snavi_lang['newposts_desc']         = 'New forum posts since your last visits';
$snavi_lang['newposts_forum']        = 'Forum: %s';
$snavi_lang['newposts_topic']        = '%s';
$snavi_lang['modules']               = 'Modules';
$snavi_lang['inactive_mods']         = 'Inactive Modules';
$snavi_lang['other_mods']            = 'Other Modules';
$snavi_lang['login_username']        = 'User:';
$snavi_lang['login_password']        = 'Pwd:';
$snavi_lang['login_seccode']         = 'Code:';
$snavi_lang['login_altseccode']      = 'Security Code';
$snavi_lang['login_submit']          = 'Login';
$snavi_lang['ticker_missing']        = 'You are missing our excellent site navigation system.';
$snavi_lang['ticker_register']       = 'Register %shere%s for free and get full operational site navigation system.';
$snavi_lang['ticker_regfeats']       = 'Benefits of full navigation system: Additional items in "home" menu for registered users, shortcuts to your account managements, quick-shortcut links to download and forum sections, show staffs and members online, notify you for new private messages and shortcut to individual messages grouped by senders, tracking latest forum posts since your last visits and reads, and much more.';
$snavi_lang['ticker_reguserlist']    = 'Please welcome our <strong>{REGUSERCOUNT}</strong> latest members: {REGUSERITEMS}.';
$snavi_lang['ticker_reguseritem']    = '{REGUSERLINK} registered on {REGUSERDATE}';
$snavi_lang['ticker_regusertotal']   = 'Currently we have total <strong>{REGUSERTOTAL}</strong> registered user{USER_S} in our database.';
$snavi_lang['ticker_filelist']       = 'Proud to present our <strong>{FILECOUNT}</strong> latest downloaded files: {FILEITEMS}.';
$snavi_lang['ticker_fileitem']       = '{FILELINK} size {FILESIZE} available since {FILEDATE}';
$snavi_lang['ticker_filetotal']      = 'We have total <strong>{FILETOTAL}</strong> file{FILE_S} and <strong>{FILECATTOTAL}</strong> section{FILECAT_S} in our database.';
$snavi_lang['ticker_filenosize']     = 'not specified';
$snavi_lang['ticker_foruminfo']      = 'Join to our %sForum Board%s, curently we have <strong>{FORUMS}</strong> forum{FORUM_S} in <strong>{TOPICS}</strong> topic{TOPIC_S} with total of <strong>{POSTS}</strong> post{POST_S}.';

/*****************************************************************************/
/*
 * image definitions
 */

$snavi_image['icon_unlisted']        = 'sys_active.png';
$snavi_image['icon_inactive']        = 'sys_inactive.png';
 $snavi_image['menu_home']            = 'btn_home.gif';
$snavi_image['menu_home_about']      = 'icon_help.png';
 $snavi_image['menu_network']         = 'btn_network.gif';
$snavi_image['menu_network_about']   = 'icon_help.png';
 $snavi_image['menu_admin']           = 'btn_admin.gif';
 $snavi_image['menu_clan']            = 'btn_clan.gif';
$snavi_image['menu_join_clan']       = 'icon_active.png';
$snavi_image['menu_report_clan']     = 'icon_inactive.png';
 $snavi_image['menu_account']         = 'btn_account.gif';
 $snavi_image['menu_file']            = 'btn_files.gif';
$snavi_image['menu_filecat']         = 'icon_file.png';
$snavi_image['menu_filesub']         = 'icon_file.png';
 $snavi_image['menu_forum']           = 'btn_forums.gif';
$snavi_image['menu_forumcat']        = 'icon_forum.png';
$snavi_image['menu_forumsub']        = 'icon_forum.png';
 $snavi_image['icon_staff']           = 'btn_staffs.gif';
$snavi_image['icon_staffcat']        = 'icon_manred.png';
$snavi_image['icon_staffpm']         = 'icon_mail.png';
$snavi_image['icon_staffprofile']    = 'icon_help.png';
$snavi_image['icon_staffpost']       = 'icon_search.png';
 $snavi_image['icon_member']          = 'btn_members.gif';
$snavi_image['icon_membercat']       = 'icon_mangreen.png';
$snavi_image['icon_memberpm']        = 'icon_mail.png';
$snavi_image['icon_memberprofile']   = 'icon_help.png';
$snavi_image['icon_memberpost']      = 'icon_search.png';
 $snavi_image['icon_newpm']           = 'btn_newpm.gif';
$snavi_image['icon_newpmcat']        = 'icon_manblue.png';
$snavi_image['icon_newpmmail']       = 'icon_mail.png';
 $snavi_image['icon_newpost']         = 'btn_newposts.gif';
$snavi_image['icon_newpostcat']      = 'icon_forum.png';
$snavi_image['icon_newposttopic']    = 'icon_forum.png';

/*****************************************************************************/

?>