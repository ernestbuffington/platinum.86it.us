<?php
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
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


if (preg_match("/ns_downloads_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");


//$ns_theme = get_theme();

global $userinfo, $theme, $Default_Theme;
getusrinfo($user);
if ($userinfo[theme] != "") {
$ns_theme = $userinfo[theme];
} else {
$ns_theme = $Default_Theme;
}

/****************************************************/
/*                                                  */
/* Controls the Title Images. Leave this on, even   */
/* if you don't have images made. If the script     */
/* does not detect any images, it defaults to off.  */
/*                                                  */
$mod_title = 1;
$mod_title2 = 1;
$mod_title_directory = "images/module_titles";
/*                                                  */
/*                                                  */
/****************************************************/



function ns_download_mod_title() {
global $module_name, $sitename, $ns_theme, $mod_title, $mod_title_directory;
$alt_title = preg_replace("/_/","/ /",$module_name);
	if (($mod_title == 1) AND (file_exists("themes/$ns_theme/$mod_title_directory/$module_name.gif"))) {
    	OpenTable();
    	ns_dl_OpenTable();
    	echo "<center><a href=\"modules.php?name=$module_name\">";
    	echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name.gif\" ";
		echo "title=\"$sitename - $alt_title\" border=\"0\"></a></center>";
    	ns_dl_CloseTable();
    	CloseTable();
	} else {
    	OpenTable();
    	ns_dl_OpenTable();
    	echo "<center><a href=\"modules.php?name=$module_name\">";
    	echo "<img src=\"modules/$module_name/images/down-logo.gif\" border=\"0\" ";
		echo "title=\"$sitename - $alt_title\"></a></center>";
    	ns_dl_CloseTable();
    	CloseTable();
	}
}



function ns_mod_title3($gif_name, $text) {
global $module_name, $sitename, $ns_theme, $mod_title, $mod_title2, $mod_title_directory;
$alt_title = preg_replace("/_/","/ /",$module_name);
$no_mod_title = preg_replace("/_/","/ /",$text);
OpenTable();
ns_dl_OpenTable();
    if (($mod_title == 1) AND ($mod_title2 == 1) AND (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/$gif_name.gif"))) {
    	echo "<center><a href=\"modules.php?name=$module_name\">";
    	echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name/$gif_name.gif\" ";
		echo "title=\"$sitename - $no_mod_title\" border=\"0\"></a></center>";
    } elseif (($mod_title == 1) AND ($mod_title2 == 0) AND (file_exists("themes/$ns_theme/$mod_title_directory/$module_name.gif"))) {
    	echo "<center><a href=\"modules.php?name=$module_name\">";
    	echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name.gif\" ";
		echo "title=\"$sitename - $alt_title\" border=\"0\"></a></center>";
    } else {
    	echo "<center><font class=\"title\"><strong>$text</strong></font></center>";
    }
ns_dl_CloseTable();
CloseTable();
}



function ns_dl_image($lid, $title) {
global $prefix, $db, $ns_theme, $sitename, $module_name;
$result = $db->sql_query("select ns_download_image, ns_download_image_pos from ".$prefix."_ns_downloads_general");
list($ns_download_image, $ns_download_image_pos) = $db->sql_fetchrow($result);
$result2 = $db->sql_query("select ns_disable from ".$prefix."_downloads_downloads where lid='$lid'");
list($ns_disable) = $db->sql_fetchrow($result2);
    if (($ns_download_image == "") && ($ns_disable == 0)) {
		$dl_link_image = "";
    } elseif (($ns_download_image != "") && (file_exists("themes/$ns_theme/images/$ns_download_image")) && ($ns_disable == 0)) {
		$dl_link_image = "<span style=\"vertical-align=$ns_download_image_pos\">";
		$dl_link_image .= "<img src=\"themes/$ns_theme/images/$ns_download_image\" border=\"0\" ";
		$dl_link_image .= "title=\"$title\"></span>&nbsp;&nbsp;";
    } elseif ($ns_disable == 1) {
		$dl_link_image = "<span style=\"vertical-align=-6\">";
		$dl_link_image .= "<img src=\"images/NukeStyles/EDL/mod/ndelete.gif\" border=\"0\" ";
		$dl_link_image .= "title=\""._NSDLDOWNDISABLED."\"></span>&nbsp;&nbsp;";
    } else {
    	$dl_link_image = "";
    }
echo "$dl_link_image";

}



function ns_dl_cat_image() {
global $prefix, $db, $ns_theme, $sitename;
$result = $db->sql_query("select ns_cat_image, ns_cat_image_pos from ".$prefix."_ns_downloads_general");
list($ns_cat_image, $ns_cat_image_pos) = $db->sql_fetchrow($result);
    if ($ns_cat_image == "") {
		$dl_cat_image = "";
    } elseif ($ns_cat_image != "" && file_exists("themes/$ns_theme/images/$ns_cat_image")) {
		$dl_cat_image  = "<span style=\"vertical-align=$ns_cat_image_pos\">";
		$dl_cat_image .= "<img src=\"themes/$ns_theme/images/$ns_cat_image\" border=\"0\" ";
		$dl_cat_image .= "title=\"$sitename Downloads\"></span>&nbsp;&nbsp;";
    } else {
    	$dl_cat_image = "";
    }
echo "$dl_cat_image";
}



function ns_dl_subcat_image() {
global $prefix, $db, $ns_theme, $sitename;
$result = $db->sql_query("select ns_subcat_image, ns_subcat_image_pos from ".$prefix."_ns_downloads_general");
list($ns_subcat_image, $ns_subcat_image_pos) = $db->sql_fetchrow($result);
    if ($ns_subcat_image == "") {
		$dl_subcat_image = "";
    } elseif (($ns_subcat_image != "") && (file_exists("themes/$ns_theme/images/$ns_subcat_image"))) {
		$dl_subcat_image  = "<span style=\"vertical-align=$ns_subcat_image_pos\">";
		$dl_subcat_image .= "<img src=\"themes/$ns_theme/images/$ns_subcat_image\" border=\"0\" ";
		$dl_subcat_image .= "title=\"$sitename Downloads\"></span>&nbsp;&nbsp;";
    } else {
    	$dl_subcat_image = "";
    }
echo "$dl_subcat_image";
}



function ns_dl_featured_image() {
global $prefix, $db, $ns_theme, $sitename;
$result = $db->sql_query("select ns_featured_image, ns_featured_image_pos from ".$prefix."_ns_downloads_general");
list($ns_featured_image, $ns_featured_image_pos) = $db->sql_fetchrow($result);
    if ($ns_featured_image == "") {
		$dl_featured_image = "";
    } elseif ($ns_featured_image != "" && file_exists("themes/$ns_theme/images/$ns_featured_image")) {
		$dl_featured_image  = "<span style=\"vertical-align=$ns_featured_image_pos\">";
		$dl_featured_image .= "<img src=\"themes/$ns_theme/images/$ns_featured_image\" border=\"0\" ";
		$dl_featured_image .= "title=\"$sitename "._FEATUREDDOWNLOADS."\"></span>&nbsp;&nbsp;";
    } else {
    	$dl_featured_image = "";
    }
echo "$dl_featured_image";
}



function ns_dl_right_blocks() {
global $prefix, $db, $index;
$result = $db->sql_query("select ns_dl_right_blocks from ".$prefix."_ns_downloads_general");
list($ns_dl_right_blocks) = $db->sql_fetchrow($result);
    if ($ns_dl_right_blocks == 1) {
		$index = 1;
    } else {
		$index = 0;
    }
}



function ns_dl_popup() {
global $prefix, $db;
$result_pu = $db->sql_query("select ns_dl_pop_win_width, ns_dl_pop_win_height from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_pop_win_width, $ns_dl_pop_win_height) = $db->sql_fetchrow($result_pu);
echo "<script type=\"text/javascript\">\n";
echo "function pop(page) {\n";
echo "OpenWin = this.open(page, \"CtrlWindow\", \"toolbar=no,menubar=no,";
echo "location=no,scrollbars=no,resize=yes,width=$ns_dl_pop_win_width,";
echo "height=$ns_dl_pop_win_height,screenX=500,screenY=500,top=25,left=200\");\n";
echo "}\n";
echo "</script>\n";
}



function ns_dl_upload() {
global $prefix, $db;
echo "<script language=\"JavaScript\">\n";
echo "function newWindow(file,window) {\n";
echo "msgWindow=open(file,window,'resizable=no,width=450,height=350,top=25,left=200');\n";
echo "if (msgWindow.opener == null) msgWindow.opener = self;\n";
echo "}\n";
echo "</script>\n";
}



function ns_download_image() {
global $prefix, $db, $module_name;
$result_pp = $db->sql_query("select ns_dl_pop_win, ns_dl_pop_conform from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_pop_win, $ns_dl_pop_conform) = $db->sql_fetchrow($result_pp);
    if ($ns_dl_pop_win == 1) {
		if ($ns_dl_pop_conform == 0) {
			ns_dl_popup();
		} elseif ($ns_dl_pop_conform == 1) {
			echo "<script type=\"text/javascript\" src=\"includes/NukeStyles/EDL/ns_dl_java.js\">";
			echo "</script>\n";  	
		}
    }
}



function ns_download_image_pop($cid, $lid, $title, $description, $ns_des_img, $ns_dl_down_note) {
$lid = intval($lid);
global $prefix, $db, $module_name;
$result = $db->sql_query("select ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result);
$result_di = $db->sql_query("select ns_dl_des_img, ns_dl_des_img_pos, ns_dl_des_img_width, ns_dl_des_img_height, ns_dl_pop_win, ns_dl_pop_conform, ns_dl_use_standard from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_conform, $ns_dl_use_standard) = $db->sql_fetchrow($result_di);
$result_gen = $db->sql_query("select ns_dl_down_button from ".$prefix."_ns_downloads_general");
list($ns_dl_down_button) = $db->sql_fetchrow($result_gen);
$result_url = $db->sql_query("select url from ".$prefix."_downloads_downloads where lid=".$lid."");
list($url) = $db->sql_fetchrow($result_url);
    if (file_exists("modules/$module_name/copyright.php")) {
    	echo "<br />";
    	echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">";
    	echo "<tr><td valign=\"top\"><div align=\"justify\">";
	if ($ns_dl_des_img == 1) {
	    if ($ns_dl_des_img_pos == "l") {
			$pos = "left";
	    } elseif ($ns_dl_des_img_pos == "r") {
			$pos = "right";
	    }
		$thumb = end(explode("/",$ns_des_img));
		$ns_directory = "modules/$module_name/".$ns_dl_image_dir;
		if(file_exists($ns_directory.'/thumb/'.$thumb)) {
			$ns_des_img_thumb = $ns_directory.'/thumb/'.$thumb;
		} else {
			$ns_des_img_thumb = $ns_des_img;
		}
			if ($ns_dl_use_standard == 1) {
    			$widhgt = "";
			} elseif ($ns_dl_use_standard == 0) {
    			$widhgt = "width=\"$ns_dl_des_img_width\" height=\"$ns_dl_des_img_height\"";
			}
	if (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 1) AND ($ns_des_img != "")) {
		echo "<center><a href=\"javascript:popImage('$ns_des_img','$title')\">";
		echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
		echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
		echo "alt=\""._NSCLICKVIEW."\"></a></center>";
	} elseif (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 0) AND ($ns_des_img != "")) {
		echo "<center><a href=\"javascript:pop('$ns_des_img')\">";
		echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
		echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
		echo "alt=\""._NSCLICKVIEW."\"></a></center>";
	} elseif ($ns_des_img != "") {
		echo "<center><img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
		echo "hspace=\"10\" title=\"$title "._NSDLIMAGEVIEW."\"></center>";
	}
			echo "$description";
		} else {
			echo "$description";
		}
			if ($ns_dl_down_note != "") {
				echo "<br /><br />"._NSDLADMINNOTE.": $ns_dl_down_note<br /><br />";
			}
		echo "</div></td></tr></table><br />";
		if ($ns_dl_down_button == 1) {
		if (!remote_file_exists ($url)){
	        $img1 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstson.gif\" border=\"0\">";
	        }else{
	        $img1 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstsof.gif\" border=\"0\">";
                }
		        echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<img src=\"images/NukeStyles/EDL/mod/dwlbut.gif\" border=\"0\"><img src=\"images/NukeStyles/EDL/mod/dwlinfo.gif\" border=\"0\">--><strong>Select a Download Mirror:</strong><br /><br />";
			/*echo "<br /><table border=\"0\" align=\"center\" cellpadding=\"8\" cellspacing=\"0\"><tr>";
			echo "<td align=\"center\">"; */
			echo "<center><img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
			//echo "</td><td align=\"center\">";
			echo "<input type=\"button\" style=\"width:146px;\" value=\"Download Mirror 1\" title=\"Download Mirror 1\" ";
			echo "onClick=\"window.location = 'modules.php?name=$module_name&";
			echo "d_op=getit&amp;lid=$lid#dl'\">";
			//echo "</td><td align=\"center\">";
			echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">&nbsp;&nbsp;".$img1."</center>";
			//echo "</td></tr></table><br />";
		}
    } else {
    	echo "<br />";
    	echo "<br /><center><strong>Well, this is the last message.<br /><br />";
    	echo "Some people just don't appreciate Hard Work.</strong></center><br />";
    	die();
    }
}



function ns_download_image_adpop($description, $ns_des_img, $ns_dl_down_note) {
global $prefix, $db, $module_name;
$result_di = $db->sql_query("select ns_dl_des_img, ns_dl_des_img_pos, ns_dl_des_img_width, ns_dl_des_img_height, ns_dl_pop_win, ns_dl_pop_conform from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img, $ns_dl_des_img_pos, $ns_dl_des_img_width, $ns_dl_des_img_height, $ns_dl_pop_win, $ns_dl_pop_conform) = $db->sql_fetchrow($result_di);
$result = $db->sql_query("select ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result);
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">";
echo "<tr><td valign=\"top\"><div align=\"justify\">";
	if ($ns_dl_des_img == 1) {
	    if ($ns_dl_des_img_pos == "l") {
			$pos = "left";
	    } elseif ($ns_dl_des_img_pos == "r") {
			$pos = "right";
	    }
	    $thumb = end(explode("/",$ns_des_img));
	    $ns_directory = "modules/$module_name/".$ns_dl_image_dir;
	    if(file_exists($ns_directory.'/thumb/'.$thumb)) {
			$ns_des_img_thumb = $ns_directory.'/thumb/'.$thumb;
	    } else {
			$ns_des_img_thumb = $ns_des_img;
	    }
		$result_st = $db->sql_query("select ns_dl_use_standard from ".$prefix."_ns_downloads_desc_img");
		list($ns_dl_use_standard) = $db->sql_fetchrow($result_st);
		if ($ns_dl_use_standard == 1) {
    		$widhgt = "";
		} elseif ($ns_dl_use_standard == 0) {
    		$widhgt = "width=\"$ns_dl_des_img_width\" height=\"$ns_dl_des_img_height\"";
		}
		if (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 1) AND ($ns_des_img != "")) {
			echo "<center><a href=\"javascript:popImage('$ns_des_img','$title')\">";
			echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
			echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
			echo "alt=\""._NSCLICKVIEW."\"></a></center>";
		} elseif (($ns_dl_pop_win == 1) AND ($ns_dl_pop_conform == 0) AND ($ns_des_img != "")) {
			echo "<center><a href=\"javascript:pop('$ns_des_img')\">";
			echo "<img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
			echo "hspace=\"10\" title=\""._NSCLICKVIEW."\" ";
			echo "alt=\""._NSCLICKVIEW."\"></a></center>";
		} elseif ($ns_des_img != "") {
			echo "<center><img src=\"$ns_des_img_thumb\" border=\"0\" align=\"$pos\" $widhgt ";
			echo "hspace=\"10\" title=\"$title "._NSDLIMAGEVIEW."\"></center>";
		}
			echo "$description";
	} else {
		echo "$description";
	}
	if ($ns_dl_down_note != "") {
		echo "<br /><br />"._NSDLADMINNOTE.": $ns_dl_down_note<br />";
	}
echo "</div></td></tr></table>";
}



function ns_dl_foot_img($dlgif) {
global $ns_theme, $module_name;
	if (file_exists("themes/$ns_theme/images/downloads/$dlgif")) {
		$ns_dl_foot_img = "themes/$ns_theme/images/downloads/$dlgif";
	} else {
		$ns_dl_foot_img = "modules/$module_name/images/downloads/$dlgif";
	}
return($ns_dl_foot_img);
}



function ns_download_foot($homepage, $cid, $lid, $transfertitle, $totalcomments) {
$cid = intval($cid);
$lid = intval($lid);
global $prefix, $db, $module_name, $ns_theme, $dlgif;
$result_fld = $db->sql_query("select ns_dl_field_rate from ".$prefix."_ns_downloads_field_perm");
list($ns_dl_field_rate) = $db->sql_fetchrow($result_fld);
$dl_foot_img = 1;
	if (($dl_foot_img == 1) AND ((file_exists("themes/$ns_theme/images/downloads/$dlgif")) OR (file_exists("modules/$module_name/images/downloads/$dlgif")))) {
        if (($homepage == "") OR ($homepage == "http://") OR ($homepage == "http:///")) {
    		echo "<br />"; 
        } else {
    		$ns_dl_foot_img = ns_dl_foot_img("home.gif");
    		echo "<br />";
    		echo "<a href=\"$homepage\" target=\"_blank\">";
    		echo "<img src=\"$ns_dl_foot_img\" border=\"0\" title=\""._HOMEPAGE."\"></a>";
    		echo "&nbsp;&nbsp;";
        }
    	if ($ns_dl_field_rate == 1) {
    		$ns_dl_foot_img = ns_dl_foot_img("rate.gif");
    		echo "<a href=\"modules.php?name=$module_name&d_op=ratedownload&amp;";
    		echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#rate\">";
    		echo "<img src=\"$ns_dl_foot_img\" border=\"0\" title=\""._RATERESOURCE."\"></a>";
    		echo "&nbsp;&nbsp;";
		}
    	$ns_dl_foot_img = ns_dl_foot_img("broken.gif");
    	echo "<a href=\"modules.php?name=$module_name&d_op=brokendownload&amp;";
    	echo "lid=$lid#reportbroken\">";
    	echo "<img src=\"$ns_dl_foot_img\" border=\"0\" title=\""._REPORTBROKEN."\"></a>";
    	echo "&nbsp;&nbsp;";
    	$ns_dl_foot_img = ns_dl_foot_img("details.gif");
    	echo "<a href=\"modules.php?name=$module_name&d_op=viewdownloaddetails&amp;";
    	echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dldetails\">";
    	echo "<img src=\"$ns_dl_foot_img\" border=\"0\" title=\""._DETAILS."\"></a>";
    	echo "&nbsp;&nbsp;";
    	if ($totalcomments != 0) {
    		$ns_dl_foot_img = ns_dl_foot_img("comments.gif");
			if ($totalcomments != 1) {
    			$ns_cnum = ""._SCOMMENTS."";
			} else {
    			$ns_cnum = ""._NSCOMMENT."";
			}
    		echo "<a href=\"modules.php?name=$module_name&d_op=viewdownloadcomments&amp;";
    		echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dlcom\">";
    		echo "<img src=\"$ns_dl_foot_img\" border=\"0\" title=\"$totalcomments $ns_cnum\"></a>";
    		echo "&nbsp;&nbsp;";
    	}
	} else {
    	if (($homepage == "") OR ($homepage == "http://") OR ($homepage == "http:///")) {
    		echo "<br />";
    	} else {
    		echo "<br />[ <a href=\"$homepage\" target=\"_blank\">"._HOMEPAGE."</a> ] - ";
    	}
    	if ($ns_dl_field_rate == 1) {
    		echo "[ <a href=\"modules.php?name=$module_name&d_op=ratedownload&amp;";
    		echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#rate\">"._RATERESOURCE."</a> ]";
    		echo " - ";
		}
    	echo "[ <a href=\"modules.php?name=$module_name&d_op=brokendownload&amp;";
    	echo "lid=$lid#reportbroken\">"._REPORTBROKEN."</a> ]";
    	echo " - [ <a href=\"modules.php?name=$module_name&d_op=viewdownloaddetails&amp;";
    	echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dldetails\">"._DETAILS."</a> ]";
    	if ($totalcomments != 0) {
    		echo " - [ <a href=\"modules.php?name=$module_name&d_op=viewdownloadcomments&amp;";
    		echo "cid=$cid&amp;lid=$lid&amp;ttitle=$transfertitle#dlcom\">$totalcomments ";
			if ($totalcomments != 1) {
    			echo ""._SCOMMENTS."</a> ]";
			} else {
    			echo ""._NSCOMMENT."</a> ]";
			}
		}
    }
}



function ns_dl_menu_img($mugif) {
global $ns_theme, $module_name;
	if (file_exists("themes/$ns_theme/images/dmenu/$mugif")) {
		$ns_dl_menu_img = "themes/$ns_theme/images/dmenu/$mugif";
	} else {
		$ns_dl_menu_img = "modules/$module_name/images/dmenu/$mugif";
	}
return($ns_dl_menu_img);
}



function ns_download_menu($maindownload, $ns_dl_add) {	
global $prefix, $db, $module_name, $ns_theme, $mugif;
	if ((file_exists("themes/$ns_theme/images/dmenu/$mugif")) OR (file_exists("modules/$module_name/images/dmenu/$mugif"))) {
		if ($maindownload > 0) {
    		$ns_dl_menu_img = ns_dl_menu_img("main.gif");
    		echo "<a href=\"modules.php?name=$module_name\">";
    		echo "<img src=\"$ns_dl_menu_img\" border=\"0\" title=\""._DOWNLOADSMAIN."\" ";
    		echo "alt=\""._DOWNLOADSMAIN."\"></a>&nbsp;";
		}
		if ($ns_dl_add == 1) {
    		$ns_dl_menu_img = ns_dl_menu_img("add.gif");
    		echo "<a href=\"modules.php?name=$module_name&d_op=AddDownload#adddownload\">";
    		echo "<img src=\"$ns_dl_menu_img\" border=\"0\" title=\""._ADDDOWNLOAD."\" ";
    		echo "alt=\""._ADDDOWNLOAD."\"></a>&nbsp;";
		}
    	$ns_dl_menu_img = ns_dl_menu_img("new.gif");
    	echo "<a href=\"modules.php?name=$module_name&d_op=NewDownloads#newdownloads\">";
    	echo "<img src=\"$ns_dl_menu_img\" border=\"0\" title=\""._NEW."\" ";
    	echo "alt=\""._NEW."\"></a>&nbsp;";
    	$ns_dl_menu_img = ns_dl_menu_img("popular.gif");
    	echo "<a href=\"modules.php?name=$module_name&d_op=MostPopular#mostpop\">";
    	echo "<img src=\"$ns_dl_menu_img\" border=\"0\" title=\""._POPULAR."\" ";
    	echo "alt=\""._POPULAR."\"></a>&nbsp;";
    	$ns_dl_menu_img = ns_dl_menu_img("top.gif");
    	echo "<a href=\"modules.php?name=$module_name&d_op=TopRated#toprated\">";
    	echo "<img src=\"$ns_dl_menu_img\" border=\"0\" title=\""._TOPRATED."\" ";
    	echo "alt=\""._TOPRATED."\"></a>&nbsp;";
	} else {	
		echo "<center><font class=\"content\">";
			if ($maindownload > 0) {
				echo "[ <a href=\"modules.php?name=$module_name\">"._DOWNLOADSMAIN."</a> ] - ";
			}
			if ($ns_dl_add == 1) {
				echo "[ <a href=\"modules.php?name=$module_name&d_op=AddDownload#adddownload\">";
				echo ""._ADDDOWNLOAD."</a> ] - ";
			} 
		echo "[ <a href=\"modules.php?name=$module_name&d_op=NewDownloads#newdownloads\">";
		echo ""._NEW."</a> ]";
		echo " - [ <a href=\"modules.php?name=$module_name&d_op=MostPopular#mostpop\">";
		echo ""._POPULAR."</a> ]";
		echo " - [ <a href=\"modules.php?name=$module_name&d_op=TopRated#toprated\">";
		echo ""._TOPRATED."</a> ]";
		echo "</font></center>";
    }
}



function ns_dl_admin($lid, $admin) {
$lid = intval($lid);
global $prefix, $db, $admin, $admin_file;
$result = $db->sql_query("select ns_disable from ".$prefix."_downloads_downloads where lid='$lid'");
list($ns_disable) = $db->sql_fetchrow($result);
	if (is_admin($admin)) {
		echo "<br /><br /><div align=\"left\">";
		echo "<strong>"._ADMINOPTIONS.":</strong> ";
		echo "<a href=\"".$admin_file.".php?op=DownloadsModDownload&amp;lid=$lid\">"._EDIT."</a> - ";
		echo "<a href=\"".$admin_file.".php?op=DownloadsDelDownload&amp;lid=$lid#delete\">"._DELETE."</a> - ";
		if ($ns_disable == 0) {
			echo "<a href=\"".$admin_file.".php?op=downloads_disable&amp;lid=$lid\">"._NSDLDISABLE."</a> - ";
		} else {
			echo "<a href=\"".$admin_file.".php?op=downloads_enable&amp;lid=$lid\">"._NSDLENABLE."</a> - ";
		}
		echo "<a href=\"".$admin_file.".php?op=ns_edl_add_featured&amp;lid=$lid#feat\">"._NSDLFEATURED."</a>";
		echo "</div><br />";
    }
}



function ns_dl_link_bar($maindownload) {
global $prefix, $db, $user, $module_name;
$result_ns = $db->sql_query("select ns_dl_add from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_add) = $db->sql_fetchrow($result_ns);
$result_lb = $db->sql_query("select ns_dl_link_bar from ".$prefix."_ns_downloads_general");
list($ns_dl_link_bar) = $db->sql_fetchrow($result_lb);

$result_blk = $db->sql_query("select ns_dl_show_block, ns_dl_show_all from ".$prefix."_ns_downloads_blocks");
list($ns_dl_show_block, $ns_dl_show_all) = $db->sql_fetchrow($result_blk);
	if ($ns_dl_show_block == 1) {
		require_once("ns_blocks_file.php");
    	if ($ns_dl_show_all == 0 && $maindownload == 0) {
    		ns_dl_blocks();	
    	} elseif ($ns_dl_show_all == 1) {
			ns_dl_blocks();
    	}
	}
    if ($ns_dl_link_bar != 0) {
		OpenTable();
		ns_dl_OpenTable();
		echo "<center>";
		ns_download_menu($maindownload, $ns_dl_add);
		echo "</center>";
		ns_dl_CloseTable();
		CloseTable();
    }
include_once("footer.php");
}



function ns_dl_OpenTable() {	
global $prefix, $db, $ns_theme, $module_name;
$result_th = $db->sql_query("select id, name from ".$prefix."_ns_downloads_theme where name='$ns_theme'");
list($id, $name) = $db->sql_fetchrow($result_th);
$result_md = $db->sql_query("select mode, mset from ".$prefix."_ns_downloads_theme_mode where id='$id'");
list($mode, $mset) = $db->sql_fetchrow($result_md);
    if ($mset == 0) {
    	OpenTable2();
    } elseif ($mset == 1) {
		if ($mode == 1) {
			OpenTable2();
		} elseif ($mode == 2) {
			$result_m2 = $db->sql_query("select width, cpad, cspace, align, bdr, bdrclr, trclr, tdclr, bgclr, bgimg from ".$prefix."_ns_downloads_table_form where id='$id' && act='1'");
			list($width, $cpad, $cspace, $align, $bdr, $bdrclr, $trclr, $tdclr, $bgclr, $bgimg)=$db->sql_fetchrow($result_m2);
	    		if ($cpad == "") {
	        		$tcpad = " cellpadding=\"0\"";
	    		} else {
	        		$tcpad = " cellpadding=\"$cpad\"";
	    		}
	    		if ($cspace == "") {
	        		$tcspace = " cellspacing=\"0\"";
	    		} else {
	        		$tcspace = " cellspacing=\"$cspace\"";
	    		}
	    		if ($align == "1") {
	        		$talign = "left";
	    		} elseif ($align == "2") {
	        		$talign = "center";
	    		} elseif ($align == "3") {
	        		$talign = "right";
	    		}
	    		if ($bdr != "") {
	        		$tbdr = " border=\"$bdr\"";
	    		} else {
	        		$tbdr = "";
	    		}
	    		if ($bdrclr != "") {
	        		$tbdrclr = " bordercolor=\"$bdrclr\"";
	    		} else {
	        		$tbdrclr = "";
	    		}
	    		if ($trclr != "") {
	        		$ttrclr = " bgcolor=\"$trclr\"";
	    		} else {
	        		$ttrclr = "";
	    		}
	    		if ($tdclr != "") {
	        		$ttdclr = " bgcolor=\"$tdclr\"";
	    		} else {
	        		$ttdclr = "";
	    		}
	    		if ($bgclr != "") {
	        		$tbgclr = " bgcolor=\"$bgclr\"";
	    		} else {
	        		$tbgclr = "";
	    		}
	    		if ($bgimg != "") {
	        		$tbgimg = " background=\"themes/$name/images/$bgimg\"";
	    		} else {
	        		$tbgimg = "";
	    		}
			echo "<table align=\"$talign\" width=\"$width%\" $tcpad$tcspace$tbdr$tbdrclr$tbgclr$tbgimg>";
			echo "<tr$ttrclr><td$ttdclr>";
		} elseif ($mode == 3) {		
			$result_m3 = $db->sql_query("select html_open from ".$prefix."_ns_downloads_table_html where id='$id' && act='1'");
			list($html_open) = $db->sql_fetchrow($result_m3);
			$html_open = stripslashes($html_open);
			echo "$html_open";
		}
    }
}



function ns_dl_CloseTable() {	
global $prefix, $db, $ns_theme, $module_name;
$result_th = $db->sql_query("select id, name from ".$prefix."_ns_downloads_theme where name='$ns_theme'");
list($id, $name) = $db->sql_fetchrow($result_th);
$result_md = $db->sql_query("select mode, mset from ".$prefix."_ns_downloads_theme_mode where id='$id'");
list($mode, $mset) = $db->sql_fetchrow($result_md);
    if ($mset == 0) {
    	CloseTable2();	
    } elseif ($mset == 1) {
		if ($mode == 1) {
        	CloseTable2();
		} elseif ($mode == 2) {
			echo "</td></tr>";
			echo "</table>";
		} elseif ($mode == 3) {	
			$result_m3 = $db->sql_query("select html_close from ".$prefix."_ns_downloads_table_html where id='$id' && act='1'");
			list($html_close) = $db->sql_fetchrow($result_m3);
			$html_close = stripslashes($html_close);
			echo "$html_close";
		}
    }
}



function ns_dl_register2($dlreg) {
global $prefix, $db, $module_name, $user, $sitename, $my_headlines;
ns_dl_OpenTable();	
echo "<div align=\"justify\">";
echo "<br /><font class=\"content\">";
	if ($dlreg == 1) {
		echo ""._DOWNLOADSNOTUSER1."";
	} elseif ($dlreg == 2) {
		echo ""._DOWNLOADSNOTUSER2."";	
	}
echo "<br /><br />";
echo ""._ASREGUSER." $sitename.<br /><br />";
echo ""._ASREGUSER2."<br /><br />";
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG1."<br />";
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG2."<br />";
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG3."<br />";
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG4."<br />";
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG5."<br />";
$handle=opendir('themes');
	while ($file = readdir($handle)) {
	    if ((!preg_match("/[.]/",$file) AND file_exists("themes/$file/theme.php"))) {
			$thmcount++;
	    }
	}
closedir($handle);
    if ($thmcount > 1) {
		echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG6."<br />";
    }
$result = $db->sql_query("select custom_title from ".$prefix."_modules WHERE active='1' AND view='1'");
    while(list($custom_title) = $db->sql_fetchrow($result)) {
		if ($custom_title != "") {
	    	echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ACCESSTO." $custom_title.<br />";
		}
    }
$result2 = $db->sql_query("select title from ".$prefix."_blocks WHERE active='1' AND view='1'");
    while(list($b_title) = $db->sql_fetchrow($result2)) {
		if ($b_title != "") {
	    	echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ACCESSTO." $b_title.<br />";
		}
    }
    if (is_active("Journal")) {
		echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._CREATEJOURNAL."<br />";
    }
    if ($my_headlines == 1) {
		echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._READHEADLINES."<br />";
    }
    if (is_active("Downloads")) {
		echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._DOWNLOADSUSER11.".<br />";
    }
    if (is_active("Web_Links")) {
		echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._WEBLINKSUSER11.".<br />";
    }
echo "&nbsp;&nbsp;&nbsp;<strong>&#8226;</strong> "._ASREG7."<br />";
echo "<br /><center><strong>"._REGISTERNOW."</strong></font></div>";
echo "<br /><br /><center>"._GOBACK."</center><br />";
ns_dl_CloseTable();
}



function ns_dl_no_search() {
global $module_name;
ns_dl_OpenTable();
echo "<br /><br /><center><font class=\"option\"><strong>"._NOMATCHES."</strong></font><br /><br />";
echo "<br /><center><form action=\"modules.php?name=$module_name&d_op=search";
echo "&amp;query=$query#searchresults\" method=\"post\">";
echo "<center><input type=\"text\" size=\"25\" name=\"query\"> ";
echo "<input type=\"submit\" name=\"submit\" value=\""._SEARCH."\" title=\""._SEARCH."\">";
echo "</center></form><br />";
echo "<br />"._GOBACK."</center><br /><br />";
ns_dl_CloseTable();
}



function ns_dl_get_version() {
global $prefix, $db;
$result_ver = $db->sql_query("select Version_Num from ".$prefix."_config");
list($Version_Num) = $db->sql_fetchrow($result_ver);
return ($Version_Num);
}



function ns_dl_cat_jump($cid) {
$cid = intval($cid);
global $prefix, $db;

$result_sc = $db->sql_query("select ns_dl_empty_cat from ".$prefix."_ns_downloads_general");
list($ns_dl_empty_cat) = $db->sql_fetchrow($result_sc);

$result_cj = $db->sql_query("select title, parentid from ".$prefix."_downloads_categories where cid='$cid'");
list($title, $parentid) = $db->sql_fetchrow($result_cj);

$title = getparentlink($parentid, $title);
$ns_view_dis = ns_dl_admin_view(2);
echo "<br /><form name=\"gocat\">";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\">";
echo "<tr><td align=\"center\"><strong>"._NSDLCATEGORYJM.":</strong></td></tr>";
echo "<tr><td align=\"center\">";
$result_cat = $db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
echo "<select name=\"cat\" OnChange=\"location.href=gocat.cat.options[selectedIndex].value\">";
    while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result_cat)) { 
        $cid2 = intval($cid2);
	    if ($cid2 == $cid) {
			$sel = "selected";
	    } else {
			$sel = "";
	    }
		if ($parentid2 != 0) $ctitle2 = getparent($parentid2,$ctitle2);
			$result_dn = $db->sql_query("select * from ".$prefix."_downloads_downloads where cid='$cid2' $ns_view_dis");
			$dl_num = $db->sql_numrows($result_dn);
			if ($ns_dl_empty_cat == 1) {
				echo "<option value=\"modules.php?name=Downloads&d_op=viewdownload";
				echo "&cid=$cid2#cat\" $sel>$ctitle2 ($dl_num)</option>";
			} else {
				if ($dl_num > 0) {
					echo "<option value=\"modules.php?name=Downloads&d_op=viewdownload";
					echo "&cid=$cid2#cat\" $sel>$ctitle2 ($dl_num)</option>";
				}
			}
    	}
echo "</select>";
echo "</td></tr></table></form>";
}



function ns_dl_sort_order($orderby, $ns_dl_sort_order) {
	if ($ns_dl_sort_order == 1) {
		$orderby = "title ASC";
	} elseif ($ns_dl_sort_order == 2) {
		$orderby = "title DESC";
	} elseif ($ns_dl_sort_order == 3) {
		$orderby = "date ASC";
	} elseif ($ns_dl_sort_order == 4) {
		$orderby = "date DESC";
	} elseif ($ns_dl_sort_order == 5) {
		$orderby = "hits ASC";
	} elseif ($ns_dl_sort_order == 6) {
		$orderby = "hits DESC";
	} elseif ($ns_dl_sort_order == 7) {
		$orderby = "downloadratingsummary ASC";
	} elseif ($ns_dl_sort_order == 8) {
		$orderby = "downloadratingsummary DESC";
	} else {
		$orderby = "title ASC";
	}
return($orderby);	
}



function ns_dl_show_mirror($lid, $ns_mirror_one, $ns_mirror_two) {
$lid = intval($lid);
global $prefix, $db, $module_name;
	if (($ns_mirror_one != "") && ($ns_mirror_two != "")) {
		$ns_num1 = "2";
		$ns_num2 = "3";
	} elseif (($ns_mirror_one != "") && ($ns_mirror_two == "")) {
		$ns_num1 = "2";
		$ns_num2 = "3";
	} elseif (($ns_mirror_one == "") && ($ns_mirror_two != "")) {
		$ns_num1 = "2";
		$ns_num2 = "3";
	}
	if ($ns_mirror_one != "") {
	        if (!remote_file_exists ($ns_mirror_one)){
	        $img1 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstson.gif\" border=\"0\">";
	        }else{
	        $img1 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstsof.gif\" border=\"0\">";
                }
	        echo "<center>";
		echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\"><input type=\"button\" value=\""._NSDOWNLOADMIRROR." ".$ns_num1."\" title=\""._NSDOWNLOADMIRROR." ".$ns_num1."\" ";
    	        echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=ns_dl_get_mirror_one";
    	        echo "&amp;lid=$lid#dl'\"><img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">&nbsp;&nbsp;".$img1."";
    	        echo "</center>";
	}
	if (($ns_mirror_one != "") && ($ns_mirror_two == "")) {
		echo "&nbsp;&nbsp;";
	}
	if (($ns_mirror_one != "") && ($ns_mirror_two != "")) {
	        if (!remote_file_exists ($ns_mirror_two)){
	        $img2 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstson.gif\" border=\"0\">";
	        }else{
	        $img2 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstsof.gif\" border=\"0\">";
                }
	        echo "<center>";
	        echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\"><input type=\"button\" value=\""._NSDOWNLOADMIRROR." ".$ns_num2."\" title=\""._NSDOWNLOADMIRROR." ".$ns_num2."\" ";
                echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=ns_dl_get_mirror_two";
                echo "&amp;lid=$lid#dl'\"><img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">&nbsp;&nbsp;".$img2."";
                echo "</center>";
	} elseif (($ns_mirror_one == "") && ($ns_mirror_two != "")) {
	        if (!remote_file_exists ($ns_mirror_two)){
	        $img3 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstson.gif\" border=\"0\">";
	        }else{
	        $img3 = "<!--<img src=\"images/NukeStyles/EDL/mod/dwlsts.gif\" border=\"0\">--><img src=\"images/NukeStyles/EDL/mod/dwlstsof.gif\" border=\"0\">";
                }
                echo "<center>";
		echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\"><input type=\"button\" style=\"width:146px;\" value=\""._NSDOWNLOADMIRROR." ".$ns_num1."\" title=\""._NSDOWNLOADMIRROR." ".$ns_num1."\" ";
                echo "onClick=\"window.location = 'modules.php?name=$module_name&d_op=ns_dl_get_mirror_two";
                echo "&amp;lid=$lid#dl'\"><img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">&nbsp;&nbsp;".$img3."";
                echo "</center>";
	}
}
function remote_file_exists ($url) 
{
   $head = "";
   $url_p = parse_url ($url);

   if (isset ($url_p["host"]))
   { $host = $url_p["host"]; }
   else
   { return false; }
   
   if (isset ($url_p["path"]))
   { $path = $url_p["path"]; }
   else
   { $path = ""; }
   
   $fp = @fsockopen ($host, 80, $errno, $errstr, 20);
   if (!$fp) 
   { return false; } 
   else 
   {
       fputs($fp, "HEAD ".$url." HTTP/1.1\r\n");
       fputs($fp, "HOST: dummy\r\n");
       fputs($fp, "Connection: close\r\n\r\n");
       $headers = "";
       while (!feof ($fp)) 
       { $headers .= fgets ($fp, 128); }
   }
   fclose ($fp);
   $arr_headers = explode("\n", $headers);
   $return = false;
   if (isset ($arr_headers[0]))
   { $return = strpos($arr_headers[0], "404") !== false; }
   return $return;
}


function ns_dl_get_mirror_one($lid) {
$lid = intval($lid);
global $prefix, $db, $module_name, $user;
$result = $db->sql_query("select ns_dl_reg_down from ".$prefix."_ns_downloads_general");
list($ns_dl_reg_down) = $db->sql_fetchrow($result);
$result_get = $db->sql_query("select ns_getit from ".$prefix."_ns_downloads_fetch");
list($ns_getit) = $db->sql_fetchrow($result_get);
$result_mr = $db->sql_query("select cid, ns_mirror_one from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $ns_mirror_one) = $db->sql_fetchrow($result_mr);
$cid = intval($cid);
	if ($ns_dl_reg_down == 0) {
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=mirror_one#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
    		Header("Location: $ns_mirror_one");
		}
    } else if ($ns_dl_reg_down == 1 && (is_user($user))) {
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=mirror_one#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
    		Header("Location: $ns_mirror_one");
		}
    } else if ($ns_dl_reg_down == 1 && (!is_user($user))) {	    	
    	include_once("header.php");
    	menu(1);
    	echo "<a name=\"dl\">";
    	ns_mod_title3("download_reg",""._REGDOWNLOAD."");
    	OpenTable();
    	ns_dl_register2($dlreg = 2);
    	CloseTable();
    	$maindownload = 1;
    	ns_dl_link_bar($maindownload);
	}
}



function ns_dl_get_mirror_two($lid) {
$lid = intval($lid);
global $prefix, $db, $module_name, $user;
$result = $db->sql_query("select ns_dl_reg_down from ".$prefix."_ns_downloads_general");
list($ns_dl_reg_down) = $db->sql_fetchrow($result);
$result_get = $db->sql_query("select ns_getit from ".$prefix."_ns_downloads_fetch");
list($ns_getit) = $db->sql_fetchrow($result_get);
$result_mr = $db->sql_query("select cid, ns_mirror_two from ".$prefix."_downloads_downloads where lid='$lid'");
list($cid, $ns_mirror_two) = $db->sql_fetchrow($result_mr);
$cid = intval($cid);
	if ($ns_dl_reg_down == 0) {	
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=mirror_two#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
    		Header("Location: $ns_mirror_two");
		}
    } else if ($ns_dl_reg_down == 1 && (is_user($user))) {
		if ($ns_getit == 1) {
			Header("Location: modules.php?name=$module_name&d_op=ns_getit&cid=$cid&lid=$lid&type=mirror_two#get");
		} else {
    		$db->$db->sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid='$lid'");
    		Header("Location: $ns_mirror_two");
		}
    } else if ($ns_dl_reg_down == 1 && (!is_user($user))) {	    	
    	include_once("header.php");
    	menu(1);
    	echo "<a name=\"dl\">";
    	ns_mod_title3("download_reg",""._REGDOWNLOAD."");
    	OpenTable();
    	ns_dl_register2($dlreg = 2);
    	CloseTable();
    	$maindownload = 1;
    	ns_dl_link_bar($maindownload);
	}
}



function ns_dl_get_referrer() {
$dref = getenv("HTTP_REFERER");
return($dref);
}



function ns_dl_getuser_ip() {
$rip = "";
if (getenv("HTTP_CLIENT_IP")) {
	$rip = getenv("HTTP_CLIENT_IP");
} elseif (getenv("HTTP_X_FORWARDED_FOR")) {
	$rip = getenv("HTTP_X_FORWARDED_FOR");
} elseif (getenv("REMOTE_ADDR")) {
	$rip = getenv("REMOTE_ADDR");
} else {
	$rip = "Unknown";
}
return($rip);
}



function ns_dl_pagination($type, $the_query, $cid, $download_num, $orderby, $min, $max, $show, $x) {
$cid = intval($cid);
global $prefix, $db, $module_name, $ns_theme, $mod_title, $mod_title_directory;
$result_pp = $db->sql_query("select ns_dl_num_per_page, ns_dl_num_results from ".$prefix."_ns_downloads_general");
list($ns_dl_num_per_page, $ns_dl_num_results) = $db->sql_fetchrow($result_pp);
	if ($type == "view") {
		$ns_page_num = $ns_dl_num_per_page;
		$nd_op = "viewdownload&amp;cid=$cid";
		$ns_anch = "cat";
	} elseif ($type == "search") {
		$ns_page_num = $ns_dl_num_results;
		$nd_op = "search&amp;query=$the_query";
		$ns_anch = "searchresults";
	}
$downloadpagesint = ($download_num / $ns_page_num);			
$downloadpageremainder = ($download_num % $ns_page_num);
    if ($downloadpageremainder != 0) {
    	$downloadpages = ceil($downloadpagesint);
    	if ($download_num < $ns_page_num) {
    		$downloadpageremainder = 0;
    	}
    } else {
    	$downloadpages = $downloadpagesint;
    }
	if ($downloadpages != 1 && $downloadpages != 0) {
    	ns_dl_OpenTable();
		echo "<br /><br /><center>";
		if (($mod_title == 1) && (file_exists("themes/$ns_theme/$mod_title_directory/$module_name/selectpage.gif"))) {
			echo "<img src=\"themes/$ns_theme/$mod_title_directory/$module_name/selectpage.gif\" ";
			echo "border=\"0\" title=\""._SELECTPAGE."\">";
		} else {
        	echo "<strong>"._SELECTPAGE."</strong>";
		}
		echo "</center>";
		echo "<form name=\"gopage\">";
    	echo "<table cellpadding=\"8\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr>";
    	$prev = $min - $ns_page_num;
    	if ($prev >= 0) {
    		echo "<td align=\"center\" valign=\"middle\"><a href=\"modules.php?name=$module_name";
			echo "&amp;d_op=$nd_op&amp;min=$prev&amp;orderby=$orderby&amp;show=$show#$ns_anch\">";
    		echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\" title=\""._PREVIOUS."\">";
			echo "</a></td>";
  		} else {
    		echo "<td align=\"center\" valign=\"middle\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
		}
    	$counter = 1;
 		$currentpage = ($max / $ns_page_num);
		echo "<td align=\"center\" valign=\"middle\">";
		echo "<select name=\"min\" OnChange=\"location.href=gopage.min.options[selectedIndex].value\">";
        while ($counter <= $downloadpages) {
            $cpage = $counter;
            $mintemp = ($ns_page_num * $counter) - $ns_page_num;
        	if ($counter == $currentpage) {
        		echo "<option selected>&nbsp;Page $counter&nbsp;</option>";
        	} else {
				echo "<option value=\"modules.php?name=$module_name";
				echo "&amp;d_op=$nd_op&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show#$ns_anch\">";
				echo "&nbsp;Page $counter&nbsp;</option>";
			}
		$counter++;
		}
		echo "</select></td>";
    	$next = $min + $ns_page_num;
    	if ($x >= $ns_page_num) {
    		echo "<td align=\"center\" valign=\"middle\"><a href=\"modules.php?name=$module_name";
			echo "&amp;d_op=$nd_op&amp;min=$max&amp;orderby=$orderby&amp;show=$show#$ns_anch\">";
    		echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\" title=\""._NEXT."\">";
			echo "</a></td>";
    	} else {
    		echo "<td align=\"center\" valign=\"middle\">&nbsp;&nbsp;&nbsp;&nbsp;</td>";
		}
	echo "</tr></table></form>";
	ns_dl_CloseTable();
	}
}



function ns_dl_admin_view($type) {
global $prefix, $db, $admin;
$result = $db->sql_query("select ns_dl_view_dis from ".$prefix."_ns_downloads_general");
list($ns_dl_view_dis) = $db->sql_fetchrow($result);
	if ($ns_dl_view_dis == 1) {
    	if (is_admin($admin)) {
			$ns_view_dis = "";
		} else {
			if ($type == 1) {
				$ns_view_dis = "where ns_disable='0'";
			} elseif ($type == 2) {
				$ns_view_dis = "&& ns_disable='0'";
			}
		}
	} elseif ($ns_dl_view_dis == 0) {
		if ($type == 1) {
			$ns_view_dis = "where ns_disable='0'";
		} elseif ($type == 2) {
			$ns_view_dis = "&& ns_disable='0'";
		}
	}
return($ns_view_dis);
}





?>
