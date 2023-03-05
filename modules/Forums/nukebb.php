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

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}
    
global $db, $user_prefix, $phpbb_root_path, $nuke_root_path, $nuke_file_path, $php_root_dir, $module_name, $nukename, $pass, $nukename, $name, $file;
//global $db, $prefix, $phpbb_root_path, $nuke_root_path, $nuke_file_path, $phpbb_root_dir, $module_name, $name, $file;
$module_name = "Forums";
$nuke_root_path = "modules.php?name=".$module_name;
$nuke_file_path = "modules.php?name=".$module_name."&file=";
$phpbb_root_path = "modules/".$module_name."/";
$phpbb_root_dir = "./../";
require_once("mainfile.php");
get_lang($module_name);
if(isset($f)) { 
$f = intval($f); 
$sql="SELECT forum_name  FROM ".$user_prefix."_bbforums WHERE forum_id='$f' LIMIT 0,1";
//$sql="SELECT forum_name  FROM ".$prefix."_bbforums WHERE forum_id='$f' LIMIT 0,1";
$result = $db->sql_query($sql); 
while ($row = $db->sql_fetchrow($result)) { 
$fname = check_html($row[forum_name], nohtml); 
$pagetitle = "$name-$fname" ; 
$pagetitle = check_html($pagetitle, nohtml); 
} 
} 

if(isset($t)) { 
$t = intval($t); 
$sql="SELECT topic_title FROM ".$user_prefix."_bbtopics WHERE topic_id='$t' LIMIT 0,1"; 
//$sql="SELECT topic_title FROM ".$prefix."_bbtopics WHERE topic_id='$t' LIMIT 0,1";
$result = $db->sql_query($sql); 
    while ($row = $db->sql_fetchrow($result)) { 
$tname = check_html($row[topic_title], nohtml); 
$pagetitle = "$name-$file-$tname" ; 
$pagetitle = check_html($pagetitle, nohtml); 
} 
} 
include_once("header.php");
?>
