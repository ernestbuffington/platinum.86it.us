<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
	
include_once("admin/modules/NukeStyles/EDL/ns_edl_functions.php");
include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

function ns_edl_manage() {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_manage_pop();
ns_edl_top("manage");
$result_dr = $db->sql_query("SELECT ns_dl_file_dir, ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir, $ns_dl_image_dir) = $db->sql_fetchrow($result_dr);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();   
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" ";
echo "width=\"100%\"><tr><td colspan=\"2\" align=\"center\"><div align=\"justify\">";
echo ""._NSDLMANAGENOTE."</div></td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_fileall#fileall\">"._NSDLSHOWALLFILES."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_imgall#imgall\">"._NSDLSHOWALLIMGS."</a> ]";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<a name=\"managefile\">"; 
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" "; 
echo "width=\"75%\"><tr><td colspan=\"2\" align=\"center\"><font class=\"title\"><u>";
echo ""._NSDLUNATTFILES.":</u></font><br /><br /></td></tr>";
$fpath = "modules/Downloads/$ns_dl_file_dir";
$fdir = opendir($fpath);
while ($file = readdir($fdir)) {
    if (!is_dir($file)) {
		if (preg_match("#[.]#",$file)) {	
		$ffile = "$fpath/$file";			
		$result_dl = $db->sql_query("select lid, title, url from ".$prefix."_downloads_downloads where url='$ffile'");
		list($lid, $title, $url) = $db->sql_fetchrow($result_dl);
	    	if ($url != $ffile) {
            	echo "<tr><td align=\"left\" width=\"60%\"><strong>$file</strong></td>";
            	echo "<td align=\"center\" width=\"40%\">";
            	echo "<input type=\"button\" value=\""._NSDLFCHECK."\" title=\""._NSDLFCHECK."\" ";
            	echo "onClick=\"window.location='$ffile'\">&nbsp;&nbsp;";
            	echo "<input type=\"button\" value=\""._NSDLTDELETE."\" title=\""._NSDLTDELETE."\" ";
            	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_manage_delfile";
            	echo "&amp;file=$file#filedel'\">";
            	echo "</td></tr>";
	    	}
		} 
    }
}
closedir($fdir);
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLUNATTDELALL."\"  title=\""._NSDLUNATTDELALL."\" ";
echo "onClick=\"window.location = '".$admin_file.".php?op=ns_edl_manage_delallfile";
echo "&amp;confirm=0#delall'\">&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<a name=\"manageimg\">";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"75%\">";
echo "<tr><td colspan=\"2\" align=\"center\"><font class=\"title\">";
echo "<u>"._NSDLUNATTIMGS.":</u></font><br /><br /></td></tr>";
$ipath = "modules/Downloads/$ns_dl_image_dir";
$idir = opendir($ipath);
while ($file = readdir($idir)) {
    if (!is_dir($file)) {
		if (preg_match("#[.]#",$file)) {	
		$ifile = "$ipath/$file";			
		$result_dli = $db->sql_query("select lid, title, ns_des_img from ".$prefix."_downloads_downloads where ns_des_img='$ifile'");
		list($lid, $title, $ns_des_img) = $db->sql_fetchrow($result_dli);
	    	if ($ns_des_img != $ifile) {
            	echo "<tr><td align=\"left\" width=\"60%\"><strong>$file</strong></td>";
            	echo "<td align=\"center\" width=\"40%\">";
            	echo "<input type=\"button\" value=\""._NSDLVIEWIMG."\" title=\""._NSDLVIEWIMG."\" ";
            	echo "onClick=\"javascript:popImage('$ifile','$title')\">&nbsp;&nbsp;";
            	echo "<input type=\"button\" value=\""._NSDLTDELETE."\" title=\""._NSDLTDELETE."\" ";
            	echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_manage_delimg";
            	echo "&amp;file=$file#imgdel'\">";
            	echo "</td></tr>";
	    	}
		} 
    }
}
closedir($idir);
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "<img src=\"images/NukeStyles/EDL/mod/right.gif\" border=\"0\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type=\"button\" value=\""._NSDLUNATTDELALL."\"  title=\""._NSDLUNATTDELALL."\" ";
echo "onClick=\"window.location = '".$admin_file.".php?op=ns_edl_manage_delallimg";
echo "&amp;confirm=0#delall'\">&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<img src=\"images/NukeStyles/EDL/mod/left.gif\" border=\"0\">";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_fileall#fileall\">"._NSDLSHOWALLFILES."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_imgall#imgall\">"._NSDLSHOWALLIMGS."</a> ]";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />"; 
ns_dl_CloseTable();
ns_edl_bottom(); 
}

function ns_edl_manage_fileall() {
global $prefix, $db, $bgcolor2, $admin_file;
ns_edl_manage_pop();
ns_edl_top("fileall");
$result_fd = $db->sql_query("SELECT ns_dl_file_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir) = $db->sql_fetchrow($result_fd);
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\"><div align=\"justify\">";
echo ""._NSDLMANAGEALLNOTE."</div></td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage#manage\">"._NSDLMANAGEHOME."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_imgall#imgall\">"._NSDLSHOWALLIMGS."</a> ]";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />"; 
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"80%\">"; 
echo "<tr><td colspan=\"2\" align=\"center\"><font class=\"title\"><u>";
echo ""._NSDLATTFILES.":</u></font><br /><br /></td></tr>";
echo "</table><br /><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
$fpath = "modules/Downloads/$ns_dl_file_dir";
$fdir = opendir($fpath);
while ($file = readdir($fdir)) {
    if (!is_dir($file)) {
	if (preg_match("#[.]#",$file)) {	
	$ffile = "$fpath/$file";			
	$result_dl = $db->sql_query("select lid, title, url from ".$prefix."_downloads_downloads where url='$ffile'");
	list($lid, $title, $url) = $db->sql_fetchrow($result_dl);
	    if ($url == $ffile) {	
            echo "<tr><td align=\"right\" width=\"35%\"><strong>"._NSDLTITLE.":</strong></td>";
            echo "<td align=\"left\" width=\"65%\">$title</td></tr>";
            echo "<tr><td align=\"right\" width=\"35%\"><strong>"._NSDLMANAGEFILE.":</strong></td>";
            echo "<td align=\"left\" width=\"65%\">$file</td></tr>";
            echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
            echo "<tr><td align=\"center\" colspan=\"2\">";
            echo "<input type=\"button\" value=\""._NSDLFCHECK."\" title=\""._NSDLFCHECK."\" ";
            echo "onClick=\"window.location='$ffile'\">&nbsp;&nbsp;";
            echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" title=\""._NSDLBDEDIT."\" ";
            echo "onClick=\"window.location='".$admin_file.".php?op=DownloadsModDownload&lid=$lid'\">";
            echo "</td></tr>";
            echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
	    }
	} 
    }
}
closedir($fdir);
echo "</table><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage#manage\">"._NSDLMANAGEHOME."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_imgall#imgall\">"._NSDLSHOWALLIMGS."</a> ]";
echo "</td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
ns_edl_bottom(); 
}

function ns_edl_manage_imgall() {
global $prefix, $db, $bgcolor2, $admin_file;
$result_id = $db->sql_query("SELECT ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result_id);
ns_edl_manage_pop();
ns_edl_top("imgall");
ns_dl_OpenTable();
OpenTable2();
echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
CloseTable2();
ns_dl_CloseTable();
ns_dl_OpenTable();
echo "<br /><table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\"><div align=\"justify\">";
echo ""._NSDLMANAGEALLINOTE."</div></td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage#manage\">"._NSDLMANAGEHOME."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_fileall#fileall\">"._NSDLSHOWALLFILES."</a> ]";
echo "</td></tr>";
echo "</table>";
echo "<br /><hr color=\"$bgcolor2\" width=\"80%\"><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"80%\">"; 
echo "<tr><td colspan=\"2\" align=\"center\"><font class=\"title\"><u>";
echo ""._NSDLATTIMGS.":</u></font><br /><br /></td></tr>";
echo "</table><br /><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
$ipath = "modules/Downloads/$ns_dl_image_dir";
$idir = opendir($ipath);
while ($file = readdir($idir)) {
    if (!is_dir($file)) {
	if (preg_match("#[.]#",$file)) {	
	$ifile = "$ipath/$file";			
	$result_dli = $db->sql_query("select lid, title, ns_des_img from ".$prefix."_downloads_downloads where ns_des_img='$ifile'");
	list($lid, $title, $ns_des_img) = $db->sql_fetchrow($result_dli);
	    if ($ns_des_img == $ifile) {
            echo "<tr><td align=\"right\" width=\"35%\"><strong>"._NSDLTITLE.":</strong></td>";
            echo "<td align=\"left\" width=\"65%\">$title</td></tr>";
            echo "<tr><td align=\"right\" width=\"35%\"><strong>"._NSDLMANAGEFILE.":</strong></td>";
            echo "<td align=\"left\" width=\"65%\">$file</td></tr>";
            echo "<tr><td colspan=\"2\">&nbsp;</td></tr>";
            echo "<tr><td align=\"center\" colspan=\"2\">";
            echo "<input type=\"button\" value=\""._NSDLVIEWIMG."\" title=\""._NSDLVIEWIMG."\" ";
            echo "onClick=\"javascript:popImage('$ifile','$title')\">&nbsp;&nbsp;";
            echo "<input type=\"button\" value=\""._NSDLBDEDIT."\" title=\""._NSDLBDEDIT."\" ";
            echo "onClick=\"window.location='".$admin_file.".php?op=DownloadsModDownload&lid=$lid'\">";
            echo "</td></tr>";
            echo "<tr><td colspan=\"2\"><br /><hr color=\"$bgcolor2\" width=\"80%\"><br /></td></tr>";
	    }
	} 
    }
}
closedir($idir);
echo "</table><br />";
echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
echo "<tr><td colspan=\"2\" align=\"center\">";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage#manage\">"._NSDLMANAGEHOME."</a> ] - ";
echo "[ <a href=\"".$admin_file.".php?op=ns_edl_manage_fileall#fileall\">"._NSDLSHOWALLFILES."</a> ]";
echo "</td></tr>";
echo "</table><br />";
ns_dl_CloseTable();
ns_edl_bottom(); 
}

function ns_edl_manage_delfile($file) {
global $prefix, $db;
$result_dr = $db->sql_query("SELECT ns_dl_file_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir) = $db->sql_fetchrow($result_dr);
$ffile = "modules/Downloads/$ns_dl_file_dir/$file";
    if (!@chmod($ffile, 0777)) {
		ns_edl_top("filedel");
		ns_dl_OpenTable();
		OpenTable2();
		echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		CloseTable2();
		ns_dl_CloseTable();
		ns_dl_OpenTable();
    	echo "<br /><br />";
		echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo ""._NSDLUNLINKFILECHM."<br /><br /><br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKFILE2."";
		echo "<br /><br /><br />"._GOBACK."";
		echo "</td></tr>";
    	echo "</table><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom(); 
    }
    if (!@unlink($ffile)) {
		ns_edl_top("filedel");
		ns_dl_OpenTable();
		OpenTable2();
		echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		CloseTable2();
		ns_dl_CloseTable();
		ns_dl_OpenTable();
    	echo "<br /><br />";
		echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		echo "<tr><td colspan=\"2\" align=\"center\">";
		echo ""._NSDLUNLINKFILE."<br /><br /><br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKFILE2."";
		echo "<br /><br /><br />"._GOBACK."";
		echo "</td></tr>";
    	echo "</table><br /><br />";
		ns_dl_CloseTable();
		ns_edl_bottom();
    }
Header("Location: ".$admin_file.".php?op=ns_edl_manage#managefile");
}

function ns_edl_manage_delimg($file) {
global $prefix, $db;
$result_dr = $db->sql_query("SELECT ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result_dr);
$ifile = "modules/Downloads/$ns_dl_image_dir/$file";
    if (!@chmod($ifile, 0777)) {
	ns_edl_top("imgdel");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
    echo "<br /><br />";
	echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
	echo "<tr><td colspan=\"2\" align=\"center\">";
	echo ""._NSDLUNLINKIMGCHM."<br /><br /><br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKIMG2."";
	echo "<br /><br /><br />"._GOBACK."";
	echo "</td></tr>";
    echo "</table><br /><br />";
	ns_dl_CloseTable();
	ns_edl_bottom(); 
    }
    if (!@unlink($ifile)) {
	ns_edl_top("imgdel");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
    echo "<br /><br />";
	echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
	echo "<tr><td colspan=\"2\" align=\"center\">";
	echo ""._NSDLUNLINKIMG."<br /><br /><br /><strong>$file</strong><br /><br /><br />"._NSDLUNLINKIMG2."";
	echo "<br /><br /><br />"._GOBACK."";
	echo "</td></tr>";
    echo "</table><br /><br />";
	ns_dl_CloseTable();
	ns_edl_bottom();
    }
Header("Location: ".$admin_file.".php?op=ns_edl_manage#manageimg");
}

function ns_edl_manage_delallfile($file, $confirm = 0) {
global $prefix, $db;
if ($confirm == 1) {
$result_fd = $db->sql_query("SELECT ns_dl_file_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_file_dir) = $db->sql_fetchrow($result_fd);
$fpath = "modules/Downloads/$ns_dl_file_dir";
$fdir = opendir($fpath);
while ($file = readdir($fdir)) {
    if (!is_dir($file)) {
	if (preg_match("#[.]#",$file)) {	
	$ffile = "$fpath/$file";			
	$result_df = $db->sql_query("select lid, title, url from ".$prefix."_downloads_downloads where url='$ffile'");
	list($lid, $title, $url) = $db->sql_fetchrow($result_df);
	    if ($url != $ffile) {
	        if (!@chmod($ffile, 0777)) {
		    ns_edl_top("filedel");
		    ns_dl_OpenTable();
		    OpenTable2();
		    echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		    CloseTable2();
		    ns_dl_CloseTable();
		    ns_dl_OpenTable();
	        echo "<br /><br />";
		    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		    echo "<tr><td colspan=\"2\" align=\"center\">";
		    echo ""._NSDLUNLINKFILECHM."<br /><br /><br /><strong>$file</strong>.";
		    echo "<br /><br /><br />"._NSDLUNLINKFILE2."";
		    echo "<br /><br /><br />"._GOBACK."";
		    echo "</td></tr>";
	        echo "</table><br /><br />";
		    ns_dl_CloseTable();
		    ns_edl_bottom(); 
	        }
 	        if (!@unlink($ffile)) {
		    ns_edl_top("filedel");
		    ns_dl_OpenTable();
		    OpenTable2();
		    echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		    CloseTable2();
		    ns_dl_CloseTable();
		    ns_dl_OpenTable();
        	echo "<br /><br />";
		    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		    echo "<tr><td colspan=\"2\" align=\"center\">";
		    echo ""._NSDLUNLINKFILE."<br /><br /><br /><strong>$file</strong>.";
		    echo "<br /><br /><br />"._NSDLUNLINKFILE2."";
		    echo "<br /><br /><br />"._GOBACK."";
		    echo "</td></tr>";
        	echo "</table><br /><br />";
		    ns_dl_CloseTable();
		    ns_edl_bottom();
				}
			}
		} 
	}
}
closedir($fdir);
Header("Location: ".$admin_file.".php?op=ns_edl_manage#manage");
    } elseif ($confirm == 0) {
	ns_edl_top("delall");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
	echo "<center><br /><br />";
	echo "<strong>"._NSDLSUREDELALLUNFILES."</strong><br />";	
	echo "<br /><br />";
    echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
    echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_manage_delallfile";
    echo "&amp;confirm=1#delall'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
    echo "onClick=\"window.location='javascript:history.go(-1)'\">";
	echo "</center><br /><br />";
	ns_dl_CloseTable();
    ns_edl_bottom();
    }
}

function ns_edl_manage_delallimg($file, $confirm = 0) {
global $prefix, $db;
if ($confirm == 1) {
$result_fd = $db->sql_query("SELECT ns_dl_image_dir from ".$prefix."_ns_downloads_upload");
list($ns_dl_image_dir) = $db->sql_fetchrow($result_fd);
$ipath = "modules/Downloads/$ns_dl_image_dir";
$idir = opendir($ipath);
while ($file = readdir($idir)) {
    if (!is_dir($file)) {
	if (preg_match("#[.]#",$file)) {	
	$ifile = "$ipath/$file";			
	$result_df = $db->sql_query("select lid, title, ns_des_img from ".$prefix."_downloads_downloads where ns_des_img='$ifile'");
	list($lid, $title, $ns_des_img) = $db->sql_fetchrow($result_df);
	    if ($ns_des_img != $ifile) {
	        if (!@chmod($ifile, 0777)) {
		    ns_edl_top("filedel");
		    ns_dl_OpenTable();
		    OpenTable2();
		    echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		    CloseTable2();
		    ns_dl_CloseTable();
		    ns_dl_OpenTable();
	        echo "<br /><br />";
		    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		    echo "<tr><td colspan=\"2\" align=\"center\">";
		    echo ""._NSDLUNLINKIMGCHM."<br /><br /><br /><strong>$file</strong>";
		    echo "<br /><br /><br />"._NSDLUNLINKIMG2."";
		    echo "<br /><br /><br />"._GOBACK."";
		    echo "</td></tr>";
	        echo "</table><br /><br />";
		    ns_dl_CloseTable();
		    ns_edl_bottom(); 
	        }
 	        if (!@unlink($ifile)) {
		    ns_edl_top("imgdel");
		    ns_dl_OpenTable();
		    OpenTable2();
		    echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
		    CloseTable2();
		    ns_dl_CloseTable();
		    ns_dl_OpenTable();
        	echo "<br /><br />";
		    echo "<table align=\"center\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">";
		    echo "<tr><td colspan=\"2\" align=\"center\">";
		    echo ""._NSDLUNLINKIMG."<br /><br /><br /><strong>$file</strong>";
		    echo "<br /><br /><br />"._NSDLUNLINKIMG2."";
		    echo "<br /><br /><br />"._GOBACK."";
		    echo "</td></tr>";
        	echo "</table><br /><br />";
		    ns_dl_CloseTable();
		    ns_edl_bottom();
   				}
	    	}
		} 
    }
}
closedir($idir);
Header("Location: ".$admin_file.".php?op=ns_edl_manage#manage");
    } elseif ($confirm == 0) {
	ns_edl_top("delall");
	ns_dl_OpenTable();
	OpenTable2();
	echo "<center><font class=\"title\">"._NSDLMANAGEFLIMG."</font></center>";
	CloseTable2();
	ns_dl_CloseTable();
	ns_dl_OpenTable();
	echo "<center><br /><br />";
	echo "<strong>"._NSDLSUREDELALLUNIMGS."</strong><br />";	
	echo "<br /><br />";
    echo "<input type=\"button\" value=\""._NSBYES."\" title=\""._NSYES."\" ";
    echo "onClick=\"window.location='".$admin_file.".php?op=ns_edl_manage_delallimg";
    echo "&amp;confirm=1#delall'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSBNO."\" title=\""._NSNO."\" ";
    echo "onClick=\"window.location='javascript:history.go(-1)'\">";
	echo "</center><br /><br />";
	ns_dl_CloseTable();
    ns_edl_bottom();
    }
}

function ns_edl_manage_pop() {
echo "<script type=\"text/javascript\" src=\"includes/NukeStyles/EDL/ns_dl_java.js\">";
echo "</script>\n";
}

switch($op) {

    default:
    ns_edl_manage();
    break;

    case "ns_edl_manage_fileall":
    ns_edl_manage_fileall();
    break;
    
    case "ns_edl_manage_imgall":
    ns_edl_manage_imgall();
    break;
    
    case "ns_edl_manage_delfile":
    ns_edl_manage_delfile($file);
    break;
    
    case "ns_edl_manage_delimg":
    ns_edl_manage_delimg($file);
    break;
    
    case "ns_edl_manage_delallfile":
    ns_edl_manage_delallfile($file, $confirm);
    break;
    
    case "ns_edl_manage_delallimg":
    ns_edl_manage_delallimg($file, $confirm);
    break;
    
}

} else {
echo "Access Denied";
}

?>