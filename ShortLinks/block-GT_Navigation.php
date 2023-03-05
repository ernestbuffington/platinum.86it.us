<?php

/************************************************************************/
/* TechGFX Navigation Block v.2.0.0                           COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Navigation.php")) {
    Header("Location: ../index.html");
    die();
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
$content = "<center><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=\"95%\">";
$content .="<TR><TD class=\"info1\"><strong>Main</strong></TD></TR>";
$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"index.html\">"._HOME."</a></TD></TR>\n";
//$content .= "<strong><big>·</big></strong> <a href=\"index.html\">"._HOME."</a><br>\n";

$sql = "SELECT mcid, mcname FROM ".$prefix."_modules_categories WHERE visible='1' ORDER BY mcid ASC";
$result2 = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result2)) {
    $mcid = $row[mcid];
    $mcname = $row[mcname];
    if (file_exists("images/blocks/modules/".$mcname.".gif")) {
        $content .="<tr><TD class=\"info1\" valign=middle> <img src=\"images/blocks/modules/".$mcname.".gif\"> <strong>".$mcname."</strong></td></tr>\n";
    } else {
        $content .="<tr><TD class=\"info1\"> <strong>".$mcname."</strong></td></tr>\n";
    }

/*****************************************************/
/* Module - NSN Groups v.1.6.3                 START */
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
	$sql = "SELECT title, custom_title, view, groups, url FROM ".$prefix."_modules WHERE active='1' AND title!='$def_module' AND inmenu='1' AND mcid='$mcid' ORDER BY custom_title ASC";
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $m_title = $row[title];
        $custom_title = $row[custom_title];
        $view = $row[view];
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
		$gt_url = $row['url'];
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/* Module - NSN Groups v.1.6.3                 START */
/*****************************************************/
        $groups = $row['groups'];
/*****************************************************/
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
        if ($custom_title != "") {
            $m_title2 = $custom_title;
        }
        $m_title2 = ereg_replace("_", " ", $m_title2);
/*****************************************************/
/* Module - NSN Groups v.1.6.3                 START */
/*****************************************************/
/*
        if ($m_title != $main_module) {
            if ((is_admin($admin) AND $view == 2) OR $view != 2) {
                $content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
            }
*/
        if ($m_title != $main_module) {
            if ($view == 0) {
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
				if ($gt_url != "") {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$m_title2</a></TD></TR>\n";
				} else {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
				}
			} elseif ($view == 1 AND is_user($user)) {
				if ($gt_url != "") {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$m_title2</a></TD></TR>\n";
				} else {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
				}
			} elseif ($view == 2 AND is_admin($admin)) {
				if ($gt_url != "") {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$m_title2</a></TD></TR>\n";
				} else {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
				}
			} elseif ($view == 3 AND paid()) {
				if ($gt_url != "") {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$m_title2</a></TD></TR>\n";
				} else {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
				}
			} elseif ($view > 3 AND in_groups($groups)) {
				if ($gt_url != "") {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$m_title2</a></TD></TR>\n";
				} else {
					$content .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$m_title\">$m_title2</a></TD></TR>\n";
				}
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
            }
/*****************************************************/
/* Module - NSN Groups v.1.6.3                   END */
/*****************************************************/
        }
    }
}
$content .= "</table></center>\n";
$content .= "<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=\"95%\"><tr><TD class=\"info1\">&nbsp;<strong>".Resources."</strong></td></tr></table>\n";
$content .= "<center><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=\"95%\">\n";
$content .= "<TD class=\"row1\">&nbsp;<a href=\"http://www.techgfx.com/\" target=_blank>TechGFX</a></TD></TR>\n";
$content .= "<TD class=\"row1\">&nbsp;<a href=\"http://www.portedmods.com/\" target=_blank>PortedMods</a></TD></TR>\n";
$content .= "<TD class=\"row1\">&nbsp;<a href=\"http://www.conrads-berlin.de/\" target=_blank>conrads-berlin</a></TD></TR>\n";
$content .= "</table></center>\n";

/*****************************************************/
/* Dropdown / block style selection menu creation    */
/*****************************************************/
if ($dropDown == 0){
    $content .= "<CENTER><br><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><FORM METHOD=POST ACTION=\"modules.php\"><TD><SELECT NAME=\"name\" onChange=\"top.location.href=this.options[this.selectedIndex].value\"><OPTION VALUE=\"\">Full Selection";
} else {
    $content .= "<CENTER><br><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><FORM METHOD=POST ACTION=\"modules.php\"><TD><SELECT NAME=\"name\" MULTIPLE SIZE=\"$row2show\" onChange=\"top.location.href=this.options[this.selectedIndex].value\"><OPTION VALUE=\"\">Full Selection";
}

$content .= "<OPTION VALUE=\"\">---------------\n";
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
$result = $db->sql_query("select title, custom_title, view, url from ".$prefix."_modules where active='1' AND title!='$def_module' AND inmenu='1' ORDER BY title ASC");
while(list($m_title, $custom_title, $view, $gt_url) = $db->sql_fetchrow($result)) {
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
    if ($custom_title != "") {
        $m_title2 = $custom_title;
    }
    $m_title2 = ereg_replace("_", " ", $m_title2);
    if ($m_title != $main_module) {
        if ((is_admin($admin) AND $view == 2) OR $view != 2) {
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
			if ($gt_url != "") {
				$content .= "<OPTION VALUE=\"$gt_url\">$m_title2\n";
			} else {
				$content .= "<OPTION VALUE=\"modules.php?name=$m_title\">$m_title2\n";
			}
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
        }
    }
}

/*****************************************************/
/* If admin, display inactive modules                */
/*****************************************************/
if (is_admin($admin)) {
    $handle=opendir('modules');
    while ($file = readdir($handle)) {
        if ( (!ereg("[.]",$file)) ) {
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
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
				$db->sql_query("insert into ".$prefix."_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '', '1', '0', '1', '', NULL)");
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
        }
    }
}

$content .= "<OPTION VALUE=\"\">---------------\n";
$content .= "<OPTION VALUE=\"\">"._INVISIBLEMODULES."\n";
$content .= "<OPTION VALUE=\"\">---------------\n";

/*****************************************************/
/* If admin, display invisible modules               */
/*****************************************************/
$admcontent .="</TD></TABLE><BR>";
$admcontent .= "<center><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH=\"95%\">\n";
$admcontent .="<TR><TD class=\"info1\"> <strong>"._INVISIBLEMODULES."</TD></TR>\n";
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
	$result = $db->sql_query("select title, custom_title, url from ".$prefix."_modules where active='1' AND inmenu='0' ORDER BY title ASC");
	while(list($mn_title, $custom_title, $gt_url) = $db->sql_fetchrow($result)) {
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
    if ($custom_title != "") {
        $mn_title2 = $custom_title;
    }
    $mn_title2 = ereg_replace("_", " ", $mn_title2);
    if ($mn_title2 != "") {
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
			//@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
			if ($gt_url != "") {
				$content .= "<OPTION VALUE=\"$gt_url\">$mn_title2\n";
				$admcontent .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$mn_title2</a></TD></TR>\n";
			} else {
				$content .= "<OPTION VALUE=\"modules.php?name=$mn_title\">$mn_title2\n";
				$admcontent .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$mn_title\">$mn_title2</a></TD></TR>\n";
			}
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
        $dummy = 1;
    } else {
        $a = 1;
    }
}

/*****************************************************/
/* If no invisible modules, display lang variable    */
/*****************************************************/
if ($a = 1 AND $dummy != 1) {
    $content .= "<OPTION VALUE=\"\">"._NONE."\n";
    $admcontent .= "<TR><TD class=\"row1\">&nbsp;"._NONE."</TD></TR>\n";
}

$content .= "<OPTION VALUE=\"\">---------------\n";
$content .= "<OPTION VALUE=\"\">"._NOACTIVEMODULES."\n";
$content .= "<OPTION VALUE=\"\">---------------\n";

/*****************************************************/
/* If admin, display inactive modules                */
/*****************************************************/
$admcontent .= "<TR><TD class=\"info1\"> <strong>"._NOACTIVEMODULES."</TD></TR>\n";
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
	$result = $db->sql_query("select title, custom_title, url from ".$prefix."_modules where active='0' ORDER BY title ASC");
	while(list($mn_title, $custom_title, $gt_url) = $db->sql_fetchrow($result)) {
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
    if ($custom_title != "") {
        $mn_title2 = $custom_title;
    }
    $mn_title2 = ereg_replace("_", " ", $mn_title2);
    if ($mn_title2 != "") {
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
			if ($gt_url != "") {
				$content .= "<OPTION VALUE=\"$gt_url\">$mn_title2\n";
				$admcontent .= "<TR><TD class=\"row1\">&nbsp;<a href=\"$gt_url\">$mn_title2</a></TD></TR>\n";
			} else {
				$content .= "<OPTION VALUE=\"modules.php?name=$mn_title\">$mn_title2\n";
				$admcontent .= "<TR><TD class=\"row1\">&nbsp;<a href=\"modules.php?name=$mn_title\">$mn_title2</a></TD></TR>\n";
			}
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
        $dummy = 1;
    } else {
        $a = 1;
    }
}
/*****************************************************/
/* If no inactive modules, display lang variable     */
/*****************************************************/
if ($a = 1 AND $dummy != 1) {
    $content .= "<OPTION VALUE=\"\">"._NONE."\n";
    $admcontent .= "<TR><TD class=\"row1\">&nbsp;"._NONE."</TD></TR>\n";
}
}
$content .= "</SELECT></TD></TR></FORM>";
$content .= $admcontent;
$content .= "</TABLE></CENTER>";

/*****************************************************/
/* Search function / feature                         */
/*****************************************************/
if ($viewSearch == 1){
/*****************************************************/
/* GT-NExtGEn v.0.4a                           START */
/*****************************************************/
	$content .= "<center><TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><form action=\"search.html\" method=\"post\">";
/*****************************************************/
/* GT-NExtGEn v.0.4a                             END */
/*****************************************************/
    $content .= "<br><center><input type=\"text\" onfocus=\"value=''\" value=\"Site Search\" name=\"query\" size=\"20\"></center>";
    $content .= "</TD></TR></form></TABLE></center>";
} else {
    return;
}

?>