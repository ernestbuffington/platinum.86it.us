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
if (preg_match("/ns_add_download_file.php/", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}


require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");




function AddDownload() {
global $prefix, $user_prefix, $db, $cookie, $user, $module_name, $my_headlines, $sitename;
$result_di = $db->sql_query("select ns_dl_des_img from ".$prefix."_ns_downloads_desc_img");
list($ns_dl_des_img) = $db->sql_fetchrow($result_di);
$result_ns = $db->sql_query("select ns_dl_add, ns_dl_anon_add, ns_dl_allow_html, ns_dl_affiliate_links, ns_dl_add_email, ns_dl_add_filesize, ns_dl_add_compat from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_add, $ns_dl_anon_add, $ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_add_compat) = $db->sql_fetchrow($result_ns);
$result_up = $db->sql_query("select ns_dl_allow_file, ns_dl_allow_img from ".$prefix."_ns_downloads_upload");
list($ns_dl_allow_file, $ns_dl_allow_img) = $db->sql_fetchrow($result_up);
$result_di = $db->sql_query("SELECT ns_dl_mirror_link from ".$prefix."_ns_downloads_general");
list($ns_dl_mirror_link) = $db->sql_fetchrow($result_di);
include_once("header.php");
    if ($ns_dl_add != 1) {
    	Header("Location: modules.php?name=$module_name");
    	die();
    } 
$maindownload = 1;
menu(1);
echo "<a name=\"adddownload\">";
if (($ns_dl_add == 1) AND ((is_user($user)) OR ($ns_dl_anon_add == 1))) {
	ns_mod_title3("add_download",""._ADDADOWNLOAD."");
	OpenTable();
	ns_dl_OpenTable();    	
    echo "<br /><table width=\"90%\" cellpadding=\"2\" cellspacing=\"0\" ";
    echo "border=\"0\" align=\"center\">";
    echo "<tr><td colspan=\"2\" align=\"center\">";
    echo "<font class=\"title\"><u>"._INSTRUCTIONS."</u></font></td></tr>";
    echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DSUBMITONCE."</td></tr>";
	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DPOSTPENDING."</td></tr>";
        if ($ns_dl_allow_file == 1) {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._NSDLUPFILEINST."</td></tr>";
	    } else {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._NSDLUPFILEINST2."</td></tr>";
	    }
        if ($ns_dl_des_img == 1) {
        	if ($ns_dl_allow_img == 1) {
	        	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._NSDLUPIMGINST."</td></tr>";
	    	} else {
	        	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._NSDLUPIMGINST2."</td></tr>";
	    	}
		}
        if ($ns_dl_affiliate_links == 0) {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DAFFILIATELINKS."</td></tr>";
	    } else {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td>";
	        echo "<td>"._DAFFILIATEISALLOWED."</td></tr>";
	    }
        if ($ns_dl_allow_html == 0) {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DNOHTML."</td></tr>";
	    } else {
	        echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DHTMLISALLOWED."</td></tr>";
	    }
	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>$sitename "._RIGHTTOCHANGE."</td></tr>";
	echo "<tr><td valign=\"top\"><strong>&#8226;</strong></td><td>"._DUSERANDIP."<br /></td></tr>";
    echo "</table><br /><br />";
    echo "<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" align=\"center\"><tr>";
    echo "<tr><tr>";
    echo "<form method=\"post\" action=\"modules.php?name=$module_name&d_op=Add#nssubmit\" ";
    echo "name=\"add_download\">";
    echo "<tr><td align=\"left\"><strong>"._DOWNLOADNAME.":</strong> ";
    echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
    echo "<br /><input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\"></td></tr>";
    echo "<tr><td align=\"left\"><strong>"._FILEURL.":</strong> ";
    echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
    echo "<br /><input type=\"text\" name=\"url\" size=\"50\" maxlength=\"255\">&nbsp;&nbsp;";
	    if ($ns_dl_allow_file == 1) {
			ns_dl_upload();
			echo "<input type=\"button\" value=\""._NSUPLOADDESIMG."\" onClick=\"newWindow";
			echo "('modules.php?name=$module_name&amp;file=ns_uploads_file";
			echo "&amp;type=file','window2')\">";
        }	
	echo "</td></tr>";
		if ($ns_dl_mirror == 1) {
    		echo "<tr><td align=\"left\"><strong>"._NSDOWNLOADMIRROR.":</strong><br />";
    		echo "<input type=\"text\" name=\"ns_mirror_one\" size=\"60\" maxlength=\"255\"></td></tr>";
    		echo "<tr><td align=\"left\"><strong>"._NSDOWNLOADMIRROR." 2:</strong><br />";
    		echo "<input type=\"text\" name=\"ns_mirror_two\" size=\"60\" maxlength=\"255\"></td></tr>";
		} else {
			echo "<input type=\"hidden\" name=\"ns_mirror_one\" value=\"\">";
			echo "<input type=\"hidden\" name=\"ns_mirror_two\" value=\"\">";
		}
    echo "<tr><td align=\"left\"><strong>"._CATEGORY.":</strong> ";
    echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
    echo "<br /><select name=\"cat\">";
    $result2=$db->sql_query("select cid, title, parentid from ".$prefix."_downloads_categories order by parentid,title");
    echo "<option value=\"\">-----------------------------</option>";
    	while(list($cid2, $ctitle2, $parentid2) = $db->sql_fetchrow($result2)) {
            $cid2 = intval($cid2);
    	    if ($parentid2!=0) $ctitle2=getparent($parentid2,$ctitle2);
				echo "<option value=\"$cid2\">$ctitle2</option>";
    		}
    echo "</select></td></tr>";
    echo "<tr><td align=\"left\"><strong>"._LDESCRIPTION."</strong> ";
    echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
#    echo "<br /><textarea name=\"description\" cols=\"75\" rows=\"22\"></textarea>";
    echo "<br />";
    wysiwyg_textarea("desc", "", "NukeUser", "75", "22");
    	if ($ns_dl_allow_html == 1) {
            echo "<br />"._HTMLISFINE."";
    	} else {
            echo "<br />"._HTMLOFF."";
    	}
    echo "</td></tr>";
        if ($ns_dl_des_img == 1) {
	    	echo "<tr><td align=\"left\"><strong>"._NSDESIMAGE.":</strong><br />";
	    	echo "<input type=\"text\" name=\"ns_des_img\" size=\"40\" maxlength=\"100\">";
	    	echo "&nbsp;&nbsp;";
			if ($ns_dl_allow_img == 1) {
	    	    ns_dl_upload();
	    	    echo "<input type=\"button\" value=\""._NSUPLOADDESIMG."\" onClick=\"newWindow";
	    	    echo "('modules.php?name=$module_name&amp;file=ns_uploads_file";
	    	    echo "&amp;type=image','window2')\">";
        	}	
	    	echo "</td></tr>";	
        } else {
    	    echo "<input type=\"hidden\" name=\"ns_des_img\" value=\"\">";
        }
	cookiedecode($user);
	if (is_user($user)) {
		$ns_version = ns_dl_get_version();
		if ($ns_version <= "6.0") {
			$result_vd = $db->sql_query("select name, uname, email from ".$user_prefix."_users where uname='$cookie[1]'");
			list($vdname, $vduname, $vdemail) = $db->sql_fetchrow($result_vd);
			if ($vdname != "") { 
				$ns_add_yname = $vdname; 
			} else { 
				$ns_add_yname = $vduname; 
			}
			$ns_add_yemail = $vdemail; 
		} elseif ($ns_version >= "6.5") {
			$result_vu = $db->sql_query("select name, username, user_email from ".$user_prefix."_users where username='$cookie[1]'");
			list($vuname, $vuusername, $vuuser_email) = $db->sql_fetchrow($result_vu);
			if ($vuname != "") { 
				$ns_add_yname = $vuname; 
			} else { 
				$ns_add_yname = $vuusername; 
			}
			$ns_add_yemail = $vuuser_email;
		}
	}
    echo "<tr><td align=\"left\"><strong>"._AUTHORNAME.":</strong><br />";
    echo "<input type=\"text\" name=\"auth_name\" value=\"$ns_add_yname\" ";
	echo "size=\"30\" maxlength=\"60\"></td></tr>";
    echo "<tr><td align=\"left\"><strong>"._AUTHOREMAIL.":</strong> ";
        if ($ns_dl_add_email == 1) {
            echo "<font class=\"tiny\"><strong>"._NSDLREQUIRED."</strong></font>";
        }
    echo "<br /><input type=\"text\" name=\"email\" value=\"$ns_add_yemail\" size=\"30\" maxlength=\"60\">";
    echo "</td></tr>";
	ns_dl_add_pfields($ns_dl_add_filesize, $ns_dl_add_compat);
    //ns_dl_add_nfields();
    echo "<tr><td align=\"left\"><strong>"._HOMEPAGE.":</strong><br />";
    echo "<input type=\"text\" name=\"homepage\" size=\"50\" maxlength=\"200\"></td></tr>";
    echo "<tr><td align=\"center\"><br /><br />";
    echo "<input type=\"hidden\" name=\"d_op\" value=\"Add\">";
	echo "<input type=\"submit\" name=\"submit\" value=\""._ADDTHISFILE."\">";
	echo "</form></td></tr></table>";
		if (($ns_dl_allow_file == 1) || ($ns_dl_allow_img == 1)) {
	    	echo "<br /><center><font class=\"tiny\">"._NSDLUPLOADNOTE."</font></center>";
		} 	
	echo "<br />";
	ns_dl_CloseTable();
	CloseTable();
	ns_dl_link_bar($maindownload);
    } else {
	ns_mod_title3("add_download",""._ADDADOWNLOAD."");
	OpenTable();
	ns_dl_register2($dlreg = 1);
	CloseTable();
	ns_dl_link_bar($maindownload);
    }
}



function Add($title, $url, $auth_name, $cat, $description, $email, $filesize, $version, $homepage, $ns_compat, $ns_des_img, $ns_mirror_one, $ns_mirror_two) {
global $prefix, $db, $user, $module_name;
$result = $db->sql_query("select url from ".$prefix."_downloads_downloads where url='$url'");
$numrows = $db->sql_numrows($result);
$result_ns = $db->sql_query("select ns_dl_add, ns_dl_anon_add, ns_dl_allow_html, ns_dl_affiliate_links, ns_dl_add_email, ns_dl_add_filesize, ns_dl_add_compat from ".$prefix."_ns_downloads_add_modify");
list($ns_dl_add, $ns_dl_anon_add, $ns_dl_allow_html, $ns_dl_affiliate_links, $ns_dl_add_email, $ns_dl_add_filesize, $ns_dl_add_compat) = $db->sql_fetchrow($result_ns);
    if ($ns_dl_add != 1) {
    	Header("Location: modules.php?name=$module_name");
    	die();
    }
    if ($ns_dl_anon_add != 1 && (!is_user($user))) {
    	include_once("header.php");
    	menu(1);
    	echo "<a name=\"nssubmit\">";
    	ns_mod_title3("add_download",""._ADDDL."");
    	OpenTable();
    	ns_dl_OpenTable();
    	echo "<br /><br /><center>"._DONLYREGUSERSADD."";
    	echo "<br /><br />"._GOBACK."</center><br />";
    	ns_dl_CloseTable();
    	CloseTable();
    	ns_dl_link_bar($maindownload = 1);
    	die();
    }
    if ($numrows > 0) {
		include_once("header.php");
		menu(1);
		echo "<br />";
		echo "<a name=\"nssubmit\">";
		ns_mod_title3("download_error",""._NSDLERROR."");
		OpenTable();
		ns_dl_OpenTable();
		echo "<br /><br /><center><strong>"._DOWNLOADALREADYEXT."</strong><br /><br />";
		echo ""._NSDLBACK."</center><br /><br />";
		ns_dl_CloseTable();
		CloseTable();
    	ns_dl_link_bar($maindownload = 1);
    } else {
	if(is_user($user)) {
	    $user2 = base64_decode($user);
	    $cookie = explode(":", $user2);
	    cookiedecode($user);
	    $submitter = $cookie[1];
    }
//    include_once("ns_error.php");
    	if ($blocknow != 1) {
    		$cat = explode("-", $cat);
    			if ($cat[1]=="") {
					$cat[1] = 0;
    			}
    $title = stripslashes(FixQuotes($title));
    $result_up = $db->sql_query("select ns_dl_allow_file from ".$prefix."_ns_downloads_upload");
    list($ns_dl_allow_file) = $db->sql_fetchrow($result_up);
    $url = stripslashes(FixQuotes($url));
	$ns_mirror_one = stripslashes(FixQuotes($ns_mirror_one));
	$ns_mirror_two = stripslashes(FixQuotes($ns_mirror_two));
    if ($ns_dl_allow_file == 0) {
		if (strtolower(substr($url,0,7)) != "http://") {
			$url = "http://" . $url;
		}
    }
    $description = stripslashes(FixQuotes($description));
    if ($ns_dl_allow_html == 0) {
		$description = FixQuotes(filter_text($description, "nohtml"));
    }
    $auth_name = stripslashes(FixQuotes($auth_name));
    $email = stripslashes(FixQuotes($email));
    $filesize = preg_replace("/\./","",$filesize);
    $filesize = preg_replace("/\,/","",$filesize);
    $filesize = intval($filesize);
    $cat[0] = intval($cat[0]);
    $cat[1] = intval($cat[1]);
    $homepage = stripslashes(FixQuotes($homepage));
    if ($homepage != "") {
        if (strtolower(substr($homepage,0,7)) != "http://") {
	$homepage = "http://". $homepage;
        }
    }
    $result_av = $db->sql_query("select ns_dl_auto_add from ".$prefix."_ns_downloads_add_modify");
    list($ns_dl_auto_add) = $db->sql_fetchrow($result_av);
    if ($ns_dl_auto_add == 1) {
    	$db->$db->sql_query("insert into ".$prefix."_downloads_downloads values (NULL, '$cat[0]', '$cat[1]', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', now(), '".addslashes($name)."', '".addslashes($email)."', '$hits','".addslashes($submitter)."', 0, 0, 0, '".addslashes($filesize)."', '".addslashes($filesize)."', '".addslashes($homepage)."', '$ns_compat', '$ns_des_img', 0, '$ns_mirror_one', '$ns_mirror_two', '')");
                                                                       
    echo "<meta http-equiv=\"refresh\" content=\"3;url=modules.php?name=$module_name\">";
    	include_once("header.php");
    	menu(1);
    	echo "<br />";
    	echo "<a name=\"nssubmit\">";
    	ns_mod_title3("download_submitted",""._NSDLADDED."");
    	OpenTable();
    	ns_dl_OpenTable();
    	echo "<br /><br />";
    	echo "<center><strong>"._DOWNLOADAUTOADDED."</strong></center>";
    	echo "<br /><br />";
    	ns_dl_CloseTable();
    	CloseTable();
    	ns_dl_link_bar($maindownload = 1);
    } else {
		$db->$db->sql_query("insert into ".$prefix."_downloads_newdownload values (NULL, '$cat[0]', '$cat[1]', '".addslashes($title)."', '".addslashes($url)."', '".addslashes($description)."', '".addslashes($auth_name)."', '".addslashes($email)."', '".addslashes($submitter)."', '".addslashes($filesize)."', '".addslashes($version)."', '".addslashes($homepage)."', '$ns_compat', '$ns_des_img', '$ns_mirror_one', '$ns_mirror_two')");
    	include_once("header.php");
    	menu(1);
    	echo "<a name=\"nssubmit\">";
    	ns_mod_title3("download_submitted",""._NSDLADDED."");
    	OpenTable();
    	ns_dl_OpenTable();
    	echo "<br /><center><strong>"._DOWNLOADRECEIVED."</strong><br /><br />";
    	$waiting_dl = $db->sql_numrows($db->sql_query("select * from ".$prefix."_downloads_newdownload"));
    	echo "<center>"._DOWNLOADRECEIVEDCUR." ";
		if ($waiting_dl > 1) {
    		echo "<strong>$waiting_dl</strong> "._DOWNLOADRECEIVEDCUR3." ";
		} else {
    		echo "<strong>$waiting_dl</strong> "._DOWNLOADRECEIVEDCUR2." ";
		}
    	echo "<br /><br /><strong>"._DOWNLOADRECEIVEDCUR4."</strong><br /><br /><br />";
    	echo "[ <a href=\"modules.php?name=$module_name\">"._DOWNLOADSMAIN."</a> ]</center><br />";
    	ns_dl_CloseTable();
    	CloseTable();
    	ns_dl_link_bar($maindownload = 1);
	    	}
        }
    }
}




?>
