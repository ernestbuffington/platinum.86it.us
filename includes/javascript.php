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

if (stristr($_SERVER['SCRIPT_NAME'], "javascript.php")) {
    Header("Location: ../index.php");
    die();
}

/*******************************************************/
/*   Include for some common javascripts functions     */
/*******************************************************/
/*****[BEGIN]*******************************************/
/*          [  Mod:     IE Embed Fixs   ]              */
/*******************************************************/
//echo "<!--[if IE]><script defer=\"defer\" type=\"text/javascript\" src=\"includes/javascript/embed_fix.js\"></script>\n<![endif]-->";
	addJSToHead('includes/javascript/embed_fix.js', 'file');
/*****[END]*********************************************/
/*            [ Mod:     IE Embed Fix   ]              */
/*******************************************************/
/**BEGIN - Add style sheet for collapsing forum block****/
global $bgcolor1;
/*****************************************************/
/* Security - Sentinel v.2.3.0                 START */
/*****************************************************/
   global $sentineladmin;
if($sentineladmin > 0) {
  echo "<script type=\"text/javascript\" src=\"includes/javasript/overlib.js\"><!-- overLIB
        (c) Erik Bosrup --></script>\n";
  echo "<script type=\"text/javascript\" src=\"includes/javascript/overlib_hideform.js\"><!--
        overLIB (c) Erik Bosrup --></script>\n";
}
/*****************************************************/
/* Security - Sentinel v.2.3.0                   END */
/*****************************************************/
/*
 * JS with variables or dynamic
 */
if ($userpage == 1) {
	$inlineJS = '<script type="text/javascript">'."\n";
	$inlineJS .= '<!--'."\n";
	$inlineJS .= 'function showimage() {'."\n";
	$inlineJS .= 'if (!document.images)'."\n";
	$inlineJS .= 'return'."\n";
	$inlineJS .= 'document.images.avatar.src='."\n";
	$inlineJS .= "'$nukeurl".'/modules/Forums/images/avatars/gallery/\' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= '//-->'."\n";
	$inlineJS .= '</script>'."\n\n";
	addJSToHead($inlineJS, 'inline');
}

global $name;

if (defined('MODULE_FILE') AND file_exists('modules/'.$name.'/copyright.php')) {
	$inlineJS = '<script type="text/javascript">'."\n";
	$inlineJS .= '<!--'."\n";
	$inlineJS .= 'function openwindow(){'."\n";
	$inlineJS .= '	window.open (\'modules/'.$name.'/copyright.php\',\'Copyright\',\'toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\');'."\n";
	$inlineJS .= "}\n";
	$inlineJS .= '//-->'."\n";
	$inlineJS .= '</script>'."\n\n";
	addJSToHead($inlineJS, 'inline');
}

/**********************************/	
/* pnpro jquery mod START ****/
/**********************************/	
//echo "<script type=\"text/javascript\" src=\"includes/jquery/lib/jquery-1.5.min.js\"></script>\n";
	addJSToHead('includes/jquery/lib/jquery-1.5.min.js', 'file');
	include_once NUKE_INCLUDE_DIR . 'jquery/lib/jquery_ya.php';	
	include_once NUKE_INCLUDE_DIR . 'jquery/lib/jquery.pnpro.php';
	include_once NUKE_INCLUDE_DIR . 'DFW/DFWSiteInfo.php';
/********************************/
/* Colorbox and jquery mod  END */
/********************************/
/*****[BEGIN]******************************************
 [ Base:    Snavi Menu Bar                       v2.5.]
 ******************************************************/ 
include_once NUKE_INCLUDE_DIR . '/snavi/snavibar.php';
/*****[END]********************************************
 [ Base:    Snavi Menu Bar                       v2.5.]
 ******************************************************/
?>