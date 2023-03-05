<?php
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
global $admin_file, $bgcolor1, $bgcolor2, $bgcolor3, $textcolor1, $textcolor2, $admin, $user;
if (is_admin($admin)) {
if (!defined('_MAIN')) { define('_MAIN', 'Main'); }
if (!defined('_SEC')) { define('_SEC', 'Security'); }
if (!defined('_CONTENT')) { define('_CONTENT', 'Content'); }
if (!defined('_INTERNAL')) { define('_INTERNAL', 'Internal'); }
if (!defined('_ADMINNUKE')) { define('_ADMINNUKE', 'Admin CP [PHP-Nuke]'); }
if (!defined('_ADMINFORUM')) { define('_ADMINFORUM', 'Admin CP [Forum]'); }
if (!defined('_BLKSITECONFIG')) { define('_BLKSITECONFIG', 'Site Configuration'); }
if (!defined('_FUSION')) { define('_FUSION', 'Fusion System'); }
if (!defined('_SENTINEL')) { define('_SENTINEL', 'Sentinel'); }
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
if (!defined('_MODULESADMIN')) { define('_MODULESADMIN', 'Modules Admin'); }
if (!defined('_LOGOUT')) { define('_LOGOUT', 'Logout'); }
if (!defined('_ADMINLOGOUT')) { define('_ADMINLOGOUT', 'Administration Logout'); }
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
$content .= '<dl style="color: '.$textcolor2.';margin: 0px;">' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._MAIN.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none;color: '.$textcolor2.'; padding: 5px;">' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php"><font style="color: '.$textcolor2.';">'._ADMINNUKE.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=forums"><font style="color: '.$textcolor2.';">'._ADMINFORUM.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=Configure"><font style="color: '.$textcolor2.';">'._BLKSITECONFIG.'</font></a></li>' . "\n";
$content .= '' . "\n";
$content .= '	</ul>' . "\n";
$content .= '	</dd>' . "\n";
$content .= '	<dt style="background: '.$bgcolor2.';color: '.$textcolor2.';padding: 4px; margin: 2px;">' . "\n";
$content .= '<a href="#"><font style="color: '.$textcolor2.';font-weight: bold;">'._SEC.'</font></a></dt>' . "\n";
$content .= '	<dd style="margin: 0px;">' . "\n";
$content .= '	<ul style="list-style: none; padding: 5px;">' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=Fusion"><font style="color: '.$textcolor2.';">'._FUSION.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=ABMain"><font style="color: '.$textcolor2.';">'._SENTINEL.'</font></a></li>' . "\n";
$content .= '<li style="background-color: '.$bgcolor2.';padding: 3px;margin: 2px;"><a href="'.$admin_file.'.php?op=Fusion&amp;page_value=pro_hammer_fw"><font style="color: '.$textcolor2.';">'._CLOSESITE.'</font></a></li>' . "\n";
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
?>
