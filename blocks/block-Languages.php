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
global $useflags, $currentlang, $languageslist;
if ($useflags == 1) {
	$content = '<div align="center"><span class="content">'._SELECTGUILANG.'<br /><br />';
	$langdir = dir('language');
	while($func=$langdir->read()) {
		if(substr($func, 0, 5) == 'lang-') {
			$menulist .= $func.' ';
		}
	}
	closedir($langdir->handle);
	$menulist = explode(' ', $menulist);
	sort($menulist);
	for ($i=0; $i < sizeof($menulist); $i++) {
		if(!empty($menulist[$i])) {
			$tl = str_replace('lang-','',$menulist[$i]);
			$tl = str_replace('.php','',$tl);
			$altlang = ucfirst($tl);
			$content .= '<a href="index.php?newlang='.$tl.'"><img src="images/language/flag-'.$tl.'.png" border="0" alt="'.$altlang.'" title="'.$altlang.'" hspace="3" vspace="3" /></a> ';
		}
	}
	$content .= '</span></div>';
} else {
	$content = '<div align="center"><span class="content">'._SELECTGUILANG.'<br /><br /></span>';
	$content .= '<form onsubmit="this.submit.disabled=\'true\'" action="index.php" method="get">'
		.'<select name="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
	$handle = opendir('language');
	while ($file = readdir($handle)) {
		if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
			$langFound = $matches[1];
			$languageslist .= $langFound.' ';
		}
	}
	closedir($handle);
	$languageslist = explode(' ', $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
		if($languageslist[$i]!='') {
			$content .= '<option value="index.php?newlang='.$languageslist[$i].'" ';
			if($languageslist[$i]==$currentlang) $content .= ' selected="selected"';
			$content .= '>'.ucfirst($languageslist[$i]).'</option>';
		}
	}
	$content .= '</select></form></div>';
}
?>
