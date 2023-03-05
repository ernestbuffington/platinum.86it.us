<?php
/************************************************************************/
/* TechGFX Navigation Block v.2.1.0                           COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
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
	die("Illegal Block File Access");
}
global $prefix, $db, $admin, $user;
/*****************************************************/
/* Uncomment the following if you wish               */
/*****************************************************/
//$mouseOver = "#000000";
//$mouseOut = "#000000";
/*****************************************************/
/* 0 = No search                      1 = Yes search */
/*****************************************************/
$viewSearch = "0";
/*****************************************************/
/* 0 = Dropdown style                1 = Block style */
/*****************************************************/
$dropDown = "0";
/*****************************************************/
/* Variable declarations                             */
/*****************************************************/
$admcontent = "";
$actionMenu = "onMouseOver=\"this.style.background='$mouseOver'\" onMouseOut=\"this.style.background='$mouseOut'\" style=\"cursor:pointer;cursor:hand\" onclick=\"window.location.href=";
$result = $db->sql_query("select main_module from ".$prefix."_main");
list($main_module) = $db->sql_fetchrow($result);
/*****************************************************/
/* Remove module from database if does not exist     */
/*****************************************************/
$result = $db->sql_query("select title from ".$prefix."_modules");
while (list($title) = $db->sql_fetchrow($result)) {
    $a = 0;
    $handle=opendir('modules');
    while ($file = readdir($handle)) {
        if ($file == $title) {
            $a = 1;
        }
    }
    closedir($handle);
    if ($a == 0) {
        $db->sql_query("delete from ".$prefix."_modules where title='$title'");
    }
}
/*****************************************************/
/* Interface with correspondent url's                */
/*****************************************************/
$content = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\">";
$content .="<tr><td class=\"info1\"><strong>Main</strong></td></tr>";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"index.php\">"._HOME."</a></td></tr>\n";
//$content .= "<strong><big>·</big></strong> <a href=\"index.php\">"._HOME."</a><br />\n";
$sql = "SELECT mcid, mcname FROM ".$prefix."_modules_categories WHERE visible='1' ORDER BY mcid ASC";
$result2 = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result2)) {
    $mcid = $row[mcid];
    $mcname = $row[mcname];
    if (file_exists("images/blocks/modules/".$mcname.".gif")) {
        $content .="<tr><td class=\"info1\" valign=middle> <img src=\"images/blocks/modules/".$mcname.".gif\"> <strong>".$mcname."</strong></td></tr>\n";
    } else {
        $content .="<tr><td class=\"info1\"> <strong>".$mcname."</strong></td></tr>\n";
    }
/*****************************************************/
/* Module - NSN Groups v.1.6.3                 START */
/*****************************************************/
    $sql = "SELECT title, custom_title, view, groups FROM ".$prefix."_modules WHERE active='1' AND title!='$def_module' AND inmenu='1' AND mcid='$mcid' ORDER BY custom_title ASC";
/*****************************************************/
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $m_title = $row[title];
        $custom_title = $row[custom_title];
        $view = $row[view];
/*****************************************************/
/* Module - NSN Groups v.1.6.3                 START */
/*****************************************************/
        $groups = $row['groups'];
/*****************************************************/
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
        if ($custom_title != "") {
            $m_title2 = $custom_title;
        }
        $m_title2 = preg_replace("/_/", " ", $m_title2);
/*****************************************************/
/* Module - NSN Groups v.1.6.3                 START */
/*****************************************************/
        /*if ($m_title != $main_module) {
            if ((is_admin($admin) AND $view == 2) OR $view != 2) {
                $content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">".boldit($m_title,$m_title2)."</a></td></tr>\n";
            }*/
        if ($m_title != $main_module) {
	        if ($view == 0) {
		        if (strpos($m_title,$_SERVER['REQUEST_URI'])) {
    				$content .= "<tr><td class=\"row1\">&nbsp;<strong><a href=\"modules.php?name=$m_title\">$m_title2</a></strong></td></tr>\n"; 
					} else { 
						$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></td></tr>\n";
            	}
        } elseif ($view == 1 AND is_user($user)) {
                if (strpos($m_title,$_SERVER['REQUEST_URI'])) {
    				$content .= "<tr><td class=\"row1\">&nbsp;<strong><a href=\"modules.php?name=$m_title\">$m_title2</a></strong></td></tr>\n";
					} else { $content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></td></tr>\n";
            	} 
        } elseif ($view == 2 AND is_admin($admin)) {
                if (strpos($m_title,$_SERVER['REQUEST_URI'])) {
    				$content .= "<tr><td class=\"row1\">&nbsp;<strong><a href=\"modules.php?name=$m_title\">$m_title2</a></strong></td></tr>\n";
					} else { $content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></td></tr>\n";
            	}
        } elseif ($view == 3 AND paid()) {
                if (strpos($m_title,$_SERVER['REQUEST_URI'])) {
    				$content .= "<tr><td class=\"row1\">&nbsp;<strong><a href=\"modules.php?name=$m_title\">$m_title2</a></strong></td></tr>\n";
					} else { $content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></td></tr>\n";
            	} 
        } elseif ($view > 3 AND in_groups($groups)) {
                if (strpos($m_title,$_SERVER['REQUEST_URI'])) {
    				$content .= "<tr><td class=\"row1\">&nbsp;<strong><a href=\"modules.php?name=$m_title\">$m_title2</a></strong></td></tr>\n";
					} else { $content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></td></tr>\n";
					}
				}
			}
		}
	}
/*****************************************************/
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
$content .= "</table>\n";
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\"><tr><td class=\"info1\"><strong>".Resources."</strong></td></tr></table>\n";
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\">\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"http://mach-hosting.com/index.php\" target=_blank>Mach-hosting</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"http://www.dcomputers.net\" target=_blank>Delgado Computers</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"http://platinumnukepro.com/\" target=_blank>Platinum Nuke</a><br /></td></tr>\n";
$content .= "</table>\n";
/*****************************************************/
/* Dropdown / block style selection menu creation    */
/*****************************************************/
if ($dropDown == 0){
    $content .= "<br /><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><form method=\"post\" action=\"modules.php\"><select name=\"name\" onChange=\"top.location.href=this.options[this.selectedIndex].value\"><option value=\"\">Full Selection";
} else {
    $content .= "<br /><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><form method=\"post\" action=\"modules.php\"><select name=\"name\" multiple size=\"$row2show\" onChange=\"top.location.href=this.options[this.selectedIndex].value\"><option value=\"\">Full Selection";
}
$content .= "<option value=\"\">---------------\n";
$result = $db->sql_query("select title, custom_title, view from ".$prefix."_modules where active='1' AND title!='$def_module' AND inmenu='1' ORDER BY title ASC");
while(list($m_title, $custom_title, $view) = $db->sql_fetchrow($result)) {
    if ($custom_title != "") {
        $m_title2 = $custom_title;
    }
    $m_title2 = preg_replace("/_/", " ", $m_title2);
    if ($m_title != $main_module) {
        if ((is_admin($admin) AND $view == 2) OR $view != 2) {
            $content .= "<option value=\"modules.php?name=$m_title\">$m_title2\n";
        }
    }
}
/*****************************************************/
/* If admin, display inactive modules                */
/*****************************************************/
if (is_admin($admin)) {
    $handle=opendir('modules');
    while ($file = readdir($handle)) {
        if ( (!preg_match("/[.]/",$file)) ) {
            $modlist .= "$file ";
        }
    }
    closedir($handle);
    $modlist = explode(" ", $modlist);
    sort($modlist);
    for ($i=0; $i < sizeof($modlist); $i++) {
/*****************************************************/
/* If module exists, add to database                 */
/*****************************************************/
    if($modlist[$i] != "") {
        $result = $db->sql_query("select mid from ".$prefix."_modules where title='$modlist[$i]'");
        list ($mid) = $db->sql_fetchrow($result);
        if ($mid == "") {
                    $db->sql_query("INSERT INTO ".$prefix."_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '', '1', '0', '1', '')");
        }
    }
}
$content .= "<option value=\"\">---------------\n";
$content .= "<option value=\"\">"._INVISIBLEMODULES."\n";
$content .= "<option value=\"\">---------------\n";
/*****************************************************/
/* If admin, display invisible modules               */
/*****************************************************/
$admcontent .="</table><br />";
$admcontent .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\">\n";
$admcontent .="<tr><td class=\"info1\"> <strong>"._INVISIBLEMODULES."</strong></td></tr>\n";
$result = $db->sql_query("select title, custom_title from ".$prefix."_modules where active='1' AND inmenu='0' ORDER BY title ASC");
while(list($mn_title, $custom_title) = $db->sql_fetchrow($result)) {
    if ($custom_title != "") {
        $mn_title2 = $custom_title;
    }
    $mn_title2 = preg_replace("/_/", " ", $mn_title2);
    if ($mn_title2 != "") {
        $content .= "<option value=\"modules.php?name=$mn_title\">$mn_title2\n";
        
        $admcontent .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$mn_title\">$mn_title2</a></td></tr>\n";
        $dummy = 1;
    } else {
        $a = 1;
    }
}
/*****************************************************/
/* If no invisible modules, display lang variable    */
/*****************************************************/
if ($a = 1 AND $dummy != 1) {
    $content .= "<option value=\"\">"._NONE."\n";
    $admcontent .= "<tr><td class=\"row1\">&nbsp;"._NONE."</td></tr>\n";
}
$content .= "<option value=\"\">---------------\n";
$content .= "<option value=\"\">"._NOACTIVEMODULES."\n";
$content .= "<option value=\"\">---------------\n";
/*****************************************************/
/* If admin, display inactive modules                */
/*****************************************************/
$admcontent .= "<tr><td class=\"info1\"> <strong>"._NOACTIVEMODULES."</strong></td></tr>\n";
$result = $db->sql_query("select title, custom_title from ".$prefix."_modules where active='0' ORDER BY title ASC");
while(list($mn_title, $custom_title) = $db->sql_fetchrow($result)) {
    if ($custom_title != "") {
        $mn_title2 = $custom_title;
    }
    $mn_title2 = preg_replace("/_/", " ", $mn_title2);
    if ($mn_title2 != "") {
        $content .= "<option value=\"modules.php?name=$mn_title\">$mn_title2\n";
        $admcontent .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=$mn_title\">$mn_title2</a></td></tr>\n";
        $dummy = 1;
    } else {
        $a = 1;
    }
}
/*****************************************************/
/* If no inactive modules, display lang variable     */
/*****************************************************/
if ($a = 1 AND $dummy != 1) {
    $content .= "<option value=\"\">"._NONE."\n";
    $admcontent .= "<tr><td class=\"row1\">&nbsp;"._NONE."</td></tr>\n";
}
}
$content .= "</select></form></td></tr>";
$content .= $admcontent;
$content .= "</table>";
/*****************************************************/
/* Search function / feature                         */
/*****************************************************/
if ($viewSearch == 1){
    $content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><form action=\"modules.php?name=Search\" method=\"post\">";
    $content .= "<br /><center><input type=\"text\" onfocus=\"value=''\" value=\"Site Search\" name=\"query\" size=\"20\"></center>";
    $content .= "</form></td></tr></table>";
} else {
    return;
} 
?>