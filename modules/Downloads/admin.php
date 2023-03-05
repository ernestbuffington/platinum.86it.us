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
$module_name = basename(dirname(__FILE__));
if ( !defined('MODULE_FILE') )
{
    die('You can\'t access this file directly...');
}
require_once("mainfile.php");
get_lang($module_name);
if(!is_array($admin)) {
    $adm = base64_decode($admin);
    $adm = explode(":", $adm);
    $aname = "$adm[0]";
} else {
    $aname = "$admin[0]";
}
$index=1;

$result = $db->sql_query("SELECT radmindownload, radminsuper FROM ".$prefix."_authors WHERE aid='$aname'");
list($radmindownload, $radminsuper) = $db->sql_fetchrow($result);
if (($radmindownload==1) OR ($radminsuper==1)) {
$dl_config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_config"));
include_once("modules/$module_name/functions.php");

switch ($op) {

    default:
        $pagetitle = _DOWNLOADSADMIN;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        include_once("footer.php");
    break;

    case "downloads":
        $pagetitle = _DOWNLOADSADMIN;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        list ($perpage) = $db->sql_fetchrow($db->sql_query("SELECT admperpage FROM ".$prefix."_nsngd_config"));
        if (!isset($min)) $min=0;
        if (!isset($max)) $max=$min+$perpage;
        $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads"));
        pagenums_admin($op, $totalselected, $perpage, $max);
        echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
        echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._TITLE."</strong></td>\n<td align='right'><strong>"._FILESIZE."</strong></td>\n";
        echo "<td align='center'><strong>"._ADDED."</strong></td>\n<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
        $x = 0;
        $result = $db->sql_query("SELECT * FROM $prefix"._nsngd_downloads." ORDER BY title LIMIT $min,$perpage");
        while($lidinfo = $db->sql_fetchrow($result)) {
            echo "<tr bgcolor='$bgcolor1'><form method='post' action='modules.php?name=$module_name'>\n";
            echo "<input type='hidden' name='file' value='admin'>\n";
            echo "<input type='hidden' name='min' value='$min'>\n";
            echo "<input type='hidden' name='lid' value='".$lidinfo['lid']."'>\n";
            echo "<td>".$lidinfo['title']."</td>\n";
            echo "<td align='right'>".CoolSize($lidinfo['filesize'])."</td>\n";
            echo "<td align='center'>".CoolDate($lidinfo['date'])."</td>\n";
            echo "<td align='center'><select name='op'><option value='ModifyDownload' selected>"._MODIFY."</option>\n";
            if ($lidinfo['active'] ==1) {
                echo "<option value='deactivate'>"._DL_DEACTIVATE."</option>\n";
            } else {
                echo "<option value='activate'>"._DL_ACTIVATE."</option>\n";
            }
            echo "<option value='DeleteDownload'>"._DL_DELETE."</option></select> ";
            echo "<input type='submit' value='"._DL_OK."'></td></tr>\n";
            echo "</form></tr>\n";
            $x++;
        }
        echo "</table>\n";
        pagenums_admin($op, $totalselected, $perpage, $max);
        CloseTable();
        include_once("footer.php");
    break;

    case "DeleteNewDownload":
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_new WHERE lid='$lid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_new");
        Header("Location: modules.php?name=$module_name&file=admin");
    break;

    case "AddDownload":
        $pagetitle = _DOWNLOADSADMIN.": "._ADDDOWNLOAD;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._TITLE.":</td><td><input type='text' name='title' size='50' maxlength='100'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='url' size='50' maxlength='255' value='http://'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td><select name='cat'><option value='0'>"._DL_NONE."</option>\n";
        $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
        while($cidinfo = $db->sql_fetchrow($result2)) {
            if ($cidinfo['parentid'] != 0) $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']);
            echo "<option value='".$cidinfo['cid']."'>".$cidinfo['title']."</option>\n";
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td><select name='perm'>\n";
        echo "<option value='0'>"._DL_ALL."</option>\n";
        echo "<option value='1'>"._DL_USERS."</option>\n";
        echo "<option value='2'>"._DL_ADMIN."</option>\n";
        $gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
        while($gidinfo = $db->sql_fetchrow($gresult)) {
            $gidinfo['gid'] = $gidinfo['gid'] + 2;
            echo "<option value='".$gidinfo['gid']."'>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION."</td><td><textarea name='description' cols='50' rows='5'></textarea></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td><input type='text' name='sname' size='30' maxlength='60'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td><input type='text' name='email' size='30' maxlength='60'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td><input type='text' name='filesize' size='12' maxlength='20'> ("._INBYTES.")</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td><input type='text' name='version' size='11' maxlength='20'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><input type='text' name='homepage' size='50' maxlength='255' value='http://'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._HITS.":</td><td><input type='text' name='hits' size='12' maxlength='11'></td></tr>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='op' value='AddDownloadSave'>\n";
        echo "<input type='hidden' name='new' value='0'>\n";
        echo "<input type='hidden' name='lid' value='0'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDDOWNLOAD."'></td></tr>\n";
        echo "</form>\n</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "AddDownloadSave":
        $pagetitle = _DOWNLOADSADMIN;
        include_once("header.php");
        $numrows = $db->sql_numrows($db->sql_query("SELECT url FROM ".$prefix."_nsngd_downloads WHERE url='$url'"));
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        if ($numrows>0) {
            echo "<center><font class='content'><strong>"._ERRORURLEXIST."</strong></center><br />";
            echo "<center>"._GOBACK."</center>";
        } else {
            /* Check if Title exist */
            if ($title=="") {
                echo "<center><font class='content'><strong>"._ERRORNOTITLE."</strong></center><br />";
                echo "<center>"._GOBACK."</center>";
            }
            /* Check if URL exist */
            if ($url=="") {
                echo "<center><font class='content'><strong>"._ERRORNOURL."</strong></center><br />";
                echo "<center>"._GOBACK."</center>";
            }
            // Check if Description exist
            if ($description=="") {
                echo "<center><font class='content'><strong>"._ERRORNODESCRIPTION."</strong></center><br />";
                echo "<center>"._GOBACK."</center>";
            }
            $title = stripslashes(FixQuotes($title));
            $url = stripslashes(FixQuotes($url));
            $description = stripslashes(FixQuotes($description));
            $sname = stripslashes(FixQuotes($sname));
            $email = stripslashes(FixQuotes($email));
            $sub_ip = $_SERVER['REMOTE_ADDR'];
            if ($submitter == "") { $submitter = $aname; }
            $db->sql_query("INSERT INTO ".$prefix."_nsngd_downloads VALUES (NULL, '$cat', '$perm', '$title', '$url', '$description', now(), '$sname', '$email', '$hits', '$submitter', '$sub_ip', '$filesize', '$version', '$homepage', '1')");
            echo "<br /><center><font class='option'>"._NEWDOWNLOADADDED."<br /><br />";
            echo "[ <a href='modules.php?name=$module_name&amp;file=admin&amp;op=downloads'>"._DOWNLOADSADMIN."</a> ]</center><br /><br />";
            if ($new==1) {
                $result = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_accesses WHERE username='$sname'"));
                if ($result < 1) {
                    $db->sql_query("INSERT INTO ".$prefix."_nsngd_accesses VALUES ('$sname', 0, 1)");
                } else {
                    $db->sql_query("UPDATE ".$prefix."_nsngd_accesses SET uploads=uploads+1 WHERE username='$submitter'");
                }
                $db->sql_query("DELETE FROM ".$prefix."_nsngd_new WHERE lid='$lid'");
                if ($email!="") {
                    $subject = ""._YOURDOWNLOADAT." $sitename";
                    $message = ""._HELLO." $sname:\n\n"._DL_APPROVEDMSG."\n\n"._TITLE.": $title\n"._URL.": $url\n"._DESCRIPTION.": $description\n\n\n"._YOUCANBROWSEUS." $nukeurl/modules.php?name=$module_name\n\n"._THANKS4YOURSUBMISSION."\n\n$sitename "._TEAM."";
                    $from = "$sitename";
                    mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
                }
            }
        }
        CloseTable();
        include_once("footer.php");
    break;

    case "NewDownload":
        $pagetitle = _DOWNLOADSADMIN.": "._DOWNLOADSWAITINGVAL;
        include_once("header.php");
        $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_new ORDER BY lid");
        $numrows = $db->sql_numrows($result);
        title("$pagetitle ($numrows)");
        adminmain();
        echo "<br />\n";
        OpenTable();
        if ($numrows>0) {
            while($lidinfo = $db->sql_fetchrow($result)) {
                if ($lidinfo['submitter'] == "") { $lidinfo['submitter'] = $anonymous; }
                $lidinfo['homepage'] = preg_replace("#http://#","",$lidinfo['homepage']);
                if ($lidinfo['homepage'] != "") { $lidinfo['homepage'] = "http://".$lidinfo['homepage']; }
                OpenTable2();
                echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
                echo "<form action='modules.php?name=$module_name' method='post'>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._SUBMITTER.":</td><td><strong>".$lidinfo['submitter']."</strong></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._SUBIP.":</td><td><strong>".$lidinfo['sub_ip']."</strong></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._TITLE.":</td><td><input type='text' name='title' value='".$lidinfo['title']."' size='50' maxlength='100'></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='url' value='".$lidinfo['url']."' size='50' maxlength='100'>&nbsp;[ <a href='".$lidinfo['url']."' target='_blank'>"._CHECK."</a> ]</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td><select name='cat'><option value='0'";
                if ($lidinfo['cid'] == 0) { echo " selected"; }
                echo ">"._DL_NONE."</option>\n";
                $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
                while($cidinfo = $db->sql_fetchrow($result2)) {
                    if ($cidinfo['cid'] == $lidinfo['cid']) { $sel = "selected"; } else { $sel = ""; }
                    if ($cidinfo['parentid'] != 0) $cidinfo['title'] = getparent($cidinfo['parentid'], $cidinfo['title']);
                    echo "<option value='".$cidinfo['cid']."' $sel>".$cidinfo['title']."</option>\n";
                }
                echo "</select></td></tr>\n";
                $sel1 = $sel2 = $sel3 = "";
                if ($lidinfo['sid'] == 0) { $sel1 = " selected"; } elseif ($lidinfo['sid'] == 1) { $sel2 = " selected"; } elseif ($lidinfo['sid'] == 2) { $sel3 = " selected"; }
                echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td><select name='perm'>\n";
                echo "<option value='0'$sel1>"._DL_ALL."</option>\n";
                echo "<option value='1'$sel2>"._DL_USERS."</option>\n";
                echo "<option value='2'$sel3>"._DL_ADMIN."</option>\n";
                $gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
                while($gidinfo = $db->sql_fetchrow($gresult)) {
                    $gidinfo['gid'] = $gidinfo['gid'] + 2;
                    if ($gidinfo['gid'] == $lidinfo['sid']) { $selected = " SELECTED"; } else { $selected = ""; }
                    echo "<option value='".$gidinfo['gid']."'$selected>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
                }
                echo "</select></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='description' cols='60' rows='10'>".$lidinfo['description']."</textarea></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td><input type='text' name='sname' size='20' maxlength='100' value='".$lidinfo['name']."'></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td><input type='text' name='email' size='20' maxlength='100' value='".$lidinfo['email']."'></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td><input type='text' name='filesize' size='12' maxlength='20' value='".$lidinfo['filesize']."'></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td><input type='text' name='version' size='11' maxlength='20' value='".$lidinfo['version']."'></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><input type='text' name='homepage' size='30' maxlength='255' value='".$lidinfo['homepage']."'> [ <a href='".$lidinfo['homepage']."' target='_blank'>"._VISIT."</a> ]</td></tr>\n";
                echo "<input type='hidden' name='file' value='admin'>\n";
                echo "<input type='hidden' name='sub_ip' value='".$lidinfo['sub_ip']."'>\n";
                echo "<input type='hidden' name='new' value='1'>\n";
                echo "<input type='hidden' name='hits' value='0'>\n";
                echo "<input type='hidden' name='lid' value='".$lidinfo['lid']."'>\n";
                echo "<input type='hidden' name='submitter' value='".$lidinfo['submitter']."'>\n";
                echo "<input type='hidden' name='op' value='AddDownloadSave'>\n";
                echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDDOWNLOAD."'></td></tr>\n";
                echo "</form>\n";
                echo "<form action='modules.php?name=$module_name' method='post'>\n";
                echo "<input type='hidden' name='file' value='admin'>\n";
                echo "<input type='hidden' name='lid' value='".$lidinfo['lid']."'>\n";
                echo "<input type='hidden' name='op' value='DeleteNewDownload'>\n";
                echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DELETEDOWNLOAD."'></td></tr>\n";
                echo "</form>\n";
                echo "</table>\n";
                CloseTable2();
                echo "<br />\n";
            }
        } else {
            echo "<tr><td align='center'><strong>"._DNODOWNLOADSWAITINGVAL."<strong></td></tr>\n";
        }
        CloseTable();
        include_once("footer.php");
    break;

    case "DownloadCheck":
        $pagetitle = _DOWNLOADSADMIN.": "._DOWNLOADVALIDATION;
        include_once("header.php");
        title(_DOWNLOADSADMIN.": "._DOWNLOADVALIDATION);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' width='100%' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<tr><td align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=DownloadValidate&amp;cid=0'>"._CHECKALLDOWNLOADS."</a><br /><br /></td></tr>\n";
        echo "<tr><td align='center'><strong>"._CHECKCATEGORIES."</strong><br />"._INCLUDESUBCATEGORIES."<br /><br /></td></tr>\n";
        $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
        while($cidinfo = $db->sql_fetchrow($result)) {
            if ($cidinfo['parentid'] != 0) { $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']); }
            $transfertitle = str_replace (" ", "_", $cidinfo['title']);
            echo "<tr><td align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=DownloadValidate&amp;cid=".$cidinfo['cid']."&amp;ttitle=$transfertitle'>".$cidinfo['title']."</a></td></tr>\n";
        }
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "DownloadValidate":
        $pagetitle = _DOWNLOADSADMIN.": "._DOWNLOADVALIDATION;
        include_once("header.php");
        title(_DOWNLOADSADMIN.": "._DOWNLOADVALIDATION);
        adminmain();
        echo "<br />\n";
        OpenTable();
        $cidtitle = str_replace ("_", "", $ttitle);
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='80%'>\n";
        if ($cid == 0) {
            echo "<tr><td align='center' colspan='3'><strong>"._CHECKALLDOWNLOADS."</strong><br />"._BEPATIENT."</td></tr>\n";
            $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads ORDER BY title");
        } else {
            echo "<tr><td align='center' colspan='3'><strong>"._VALIDATINGCAT.": $cidtitle</strong><br />"._BEPATIENT."</td></tr>\n";
            $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='$cid' ORDER BY title");
        }
        echo "<tr><td bgcolor='$bgcolor2' align='center'><strong>"._STATUS."</strong></td><td bgcolor='$bgcolor2' width='80%'><strong>"._TITLE."</strong></td><td bgcolor='$bgcolor2' align='center'><strong>"._FUNCTIONS."</strong></td></tr>\n";
        while($lidinfo = $db->sql_fetchrow($result)) {
            if (!preg_match("#http://#", $lidinfo['url'])) { $lidinfo['url'] = $nukeurl."/".$lidinfo['url']; }
            $vurl = parse_url($lidinfo['url']);
            $fp = fsockopen($vurl['host'], 80, $errno, $errstr, 15);
            if (!$fp){
                echo "<tr><td align='center' bgcolor='$bgcolor2'><strong>&nbsp;&nbsp;"._FAILED."&nbsp;&nbsp;</strong></td>\n";
                echo "<td>&nbsp;&nbsp;<a href='".$lidinfo['url']."' target='new'>".$lidinfo['title']."</a>&nbsp;&nbsp;</td>\n";
                echo "<td align='center'>&nbsp;&nbsp;[ <a href='modules.php?name=$module_name&amp;file=admin&amp;op=ModifyDownload&amp;lid=".$lidinfo['lid']."'>"._DL_EDIT."</a>";
                echo " | <a href='modules.php?name=$module_name&amp;file=admin&amp;op=DeleteDownload&amp;lid=".$lidinfo['lid']."'>"._DL_DELETE."</a> ]&nbsp;&nbsp;</font></td></tr>\n";
                $date = date("M d, Y g:i:a");
                $sub_ip = $_SERVER['REMOTE_ADDR'];
                $db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, ".$lidinfo['lid'].", 0, 0, '', '', '', '"._DSCRIPT."<br />$date', '$sub_ip', 1, '".$lidinfo['name']."', '".$lidinfo['email']."', '".$lidinfo['filesize']."', '".$lidinfo['version']."', '".$lidinfo['homepage']."')");
            }
            if ($fp){
                echo "<tr><td align='center'>&nbsp;&nbsp;"._OK."&nbsp;&nbsp;</td>\n";
                echo "<td>&nbsp;&nbsp;<a href='".$lidinfo['url']."' target='new'>".$lidinfo['title']."</a>&nbsp;&nbsp;</td>\n";
                echo "<td align='center'>&nbsp;&nbsp;"._DL_NONE."&nbsp;&nbsp;</td></tr>\n";
            }
        }
        echo "<tr><td align='center' colspan='3'>"._GOBACK."</td></tr>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "FilesizeCheck":
        $pagetitle = _DOWNLOADSADMIN.": "._FILESIZEVALIDATION;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' width='100%' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<tr><td align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=FilesizeValidate&amp;cid=0'>"._CHECKALLDOWNLOADS."</a><br /><br /></td></tr>\n";
        echo "<tr><td align='center'><strong>"._CHECKCATEGORIES."</strong><br />"._INCLUDESUBCATEGORIES."<br /><br /></td></tr>\n";
        $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
        while($cidinfo = $db->sql_fetchrow($result)) {
            if ($cidinfo['parentid'] != 0) { $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']); }
            $transfertitle = str_replace (" ", "_", $cidinfo['title']);
            echo "<tr><td align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=FilesizeValidate&amp;cid=".$cidinfo['cid']."&amp;ttitle=$transfertitle'>".$cidinfo['title']."</a></td></tr>\n";
        }
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "FilesizeValidate":
        $pagetitle = _DOWNLOADSADMIN.": "._FILESIZEVALIDATION;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        $cidtitle = str_replace ("_", "", $ttitle);
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='80%'>\n";
        if ($cid == 0) {
            echo "<tr><td align='center' colspan='3'><strong>"._CHECKALLDOWNLOADS."</strong><br />"._BEPATIENT."</td></tr>\n";
            $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE active>'0' ORDER BY title");
        } else {
            echo "<tr><td align='center' colspan='3'><strong>"._VALIDATINGCAT.": $cidtitle</strong><br />"._BEPATIENT."</td></tr>\n";
            $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='$cid' AND active>'0' ORDER BY title");
        }
        echo "<tr bgcolor='$bgcolor2'><td width='70%' valign='bottom'><strong>"._FILENAME."</strong></td>\n";
        echo "<td align='right' width='15%'><strong>"._OLDSIZE."<br />"._INBYTES."</strong></td>\n";
        echo "<td align='right' width='15%'><strong>"._NEWSIZE."<br />"._INBYTES."</strong></td></tr>\n";
        while($dresult = $db->sql_fetchrow($result)) {
            echo "<tr bgcolor='$bgcolor1'><td>".stripslashes($dresult['title'])."</td>\n";
            echo "<td align='right'>".number_format($dresult['filesize'])."</td>\n";
            if (!preg_match("#http#",$dresult['url'])) {
                if (!file_exists($dresult['url'])) {
                    echo "<td align='right'>"._FAILED."</td></tr>\n";
                    $date = date("M d, Y g:i:a");
                    $sub_ip = $_SERVER['REMOTE_ADDR'];
                    $db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, ".$dresult['lid'].", 0, 0, '', '', '', '"._DSCRIPT."<br />$date', '$sub_ip', 1, '".$dresult['name']."', '".$dresult['email']."', '".$dresult['filesize']."', '".$dresult['version']."', '".$dresult['homepage']."')");
                } else {
                    $newsize = filesize($dresult['url']);
                    echo "<td align='right'>".number_format($newsize)."</td></tr>\n";
                    $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET filesize='$newsize' WHERE lid='".$dresult['lid']."'");
                }
            } else {
                echo "<td align='right'>"._NOTLOCAL."</td></tr>\n";
            }
        }
        echo "</table>\n";
        echo "<br /><center>"._GOBACK."</center>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "BrokenDownloads":
        $pagetitle = _DOWNLOADSADMIN.": "._DUSERREPBROKEN;
        include_once("header.php");
        $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_mods WHERE brokendownload='1' ORDER BY rid");
        $totalbroken = $db->sql_numrows($result);
        title("$pagetitle ($totalbroken)");
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<center>"._DIGNOREINFO."<br />\n"._DDELETEINFO."</center><br />\n";
        echo "<table align='center' width='80%' cellpadding='2' cellspacing='0'>";
        if ($totalbroken==0) {
            echo "<tr><td align='center'><strong>"._DNOREPORTEDBROKEN."<strong></td></tr>\n";
        } else {
            $colorswitch = $bgcolor2;
            echo "<tr>\n";
            echo "<td><strong>"._DOWNLOAD."</strong></td>\n";
            echo "<td><strong>"._SUBMITTER."</strong></td>\n";
            echo "<td><strong>"._DOWNLOADOWNER."</strong></td>\n";
            echo "<td><strong>"._IGNORE."</strong></td>\n";
            echo "<td><strong>"._DL_DELETE."</strong></td>\n";
            echo "<td><strong>"._DL_EDIT."</strong></td>\n";
            echo "</tr>\n";
            while($ridinfo = $db->sql_fetchrow($result)) {
                $lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid='".$ridinfo['lid']."'"));
                list($memail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$ridinfo['modifier']."'"));
                list($oemail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$lidinfo['name']."'"));
                echo "<tr>\n";
                echo "<td bgcolor='$colorswitch'><a href='".$lidinfo['url']."'>".$lidinfo['title']."</a></td>\n";
                echo "<td bgcolor='$colorswitch'>";
                if ($memail=='') { echo $ridinfo['modifier']; } else { echo "<a href='mailto:$memail'>".$ridinfo['modifier']."</a>"; }
                echo "</td>\n";
                echo "<td bgcolor='$colorswitch'>";
                if ($oemail=='') { echo $lidinfo['name']; } else { echo "<a href='mailto:$oemail'>".$lidinfo['name']."</a>"; }
                echo "</td>\n";
                echo "<td bgcolor='$colorswitch' align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=IgnoreBrokenDownloads&amp;lid=".$ridinfo['lid']."'>X</a></td>\n";
                echo "<td bgcolor='$colorswitch' align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=DeleteBrokenDownloads&amp;lid=".$ridinfo['lid']."'>X</a></td>\n";
                echo "<td bgcolor='$colorswitch' align='center'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=ModifyDownload&amp;lid=".$ridinfo['lid']."'>X</a></td>\n";
                echo "</tr>\n";
                if ($colorswitch == $bgcolor2) { $colorswitch = $bgcolor1; } else { $colorswitch = $bgcolor2; }
            }
        }
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "DeleteBrokenDownloads":
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_mods WHERE lid='$lid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_mods");
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_downloads");
        Header("Location: modules.php?name=$module_name&file=admin&op=BrokenDownloads");
    break;

    case "IgnoreBrokenDownloads":
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_mods WHERE lid='$lid' and brokendownload='1'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_mods");
        Header("Location: modules.php?name=$module_name&file=admin&op=BrokenDownloads");
    break;

    case "ModRequests":
        $pagetitle = _DOWNLOADSADMIN.": "._DUSERMODREQUEST;
        include_once("header.php");
        $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_mods WHERE brokendownload='0' ORDER BY rid");
        $totalmods = $db->sql_numrows($result);
        title("$pagetitle ($totalmods)");
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table width='95%' align='center'><tr><td>";
        if ($totalmods != 0) {
            while($ridinfo = $db->sql_fetchrow($result)) {
                $lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid='".$ridinfo['lid']."'"));
                list($cidtitle) = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='".$ridinfo['cid']."'"));
                list($origcidtitle) = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_nsngd_categories WHERE cid='".$lidinfo['cid']."'"));
                list($memail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$ridinfo['modifier']."'"));
                list($oemail) = $db->sql_fetchrow($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE username='".$lidinfo['submitter']."'"));
                $ridinfo['title'] = stripslashes($ridinfo['title']);
                $ridinfo['description'] = stripslashes($ridinfo['description']);
                if ($lidinfo['submitter'] == "") { $lidinfo['submitter'] = "administration"; }
                if ($cidtitle=="") { $cidtitle= _DL_NONE; }
                if ($origcidtitle=="") { $origcidtitle= _DL_NONE; }
                echo "<table border='1' bordercolor='$textcolor1' cellpadding='5' cellspacing='0' align='center' width='100%'>\n";
                echo "<tr><td><table width='100%'>\n";
                echo "<tr><td align='center' bgcolor='$bgcolor2' class='title' colspan='2'>"._ORIGINAL."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2' width='15%'>"._TITLE.":</td><td width='85%'>".$lidinfo['title']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><a href='".$lidinfo['url']."' target='new'>".$lidinfo['url']."</a></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td>$origcidtitle</td></tr>\n";
                if ($ridinfo['sid'] == 0) {
                    $who_view = _DL_ALL;
                } elseif ($ridinfo['sid'] == 1) {
                    $who_view = _DL_USERS;
                } elseif ($ridinfo['sid'] == 2) {
                    $who_view = _DL_ADMIN;
                } elseif ($ridinfo['sid'] >2) {
                    $newView = $ridinfo['sid'] - 2;
                    list($who_view) = $db->sql_fetchrow($db->sql_query("SELECT gname FROM ".$prefix."_nsngr_groups WHERE gid=$newView"));
                    $who_view = $who_view." "._DL_ONLY;
                }
                echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td>$who_view</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td>".$lidinfo['name']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td>".$lidinfo['email']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td>".number_format($lidinfo['filesize'])." "._BYTES."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td>".$lidinfo['version']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><a href='".$lidinfo['homepage']."' target='new'>".$lidinfo['homepage']."</a></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td>".$lidinfo['description']."</td></tr>\n";
                echo "</table></td></tr>\n";
                echo "<tr><td><table width='100%'>\n";
                echo "<tr><td align='center' bgcolor='$bgcolor2' class='title' colspan='2'>"._PURPOSED."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2' width='15%'>"._TITLE.":</td><td width='85%'>".$ridinfo['title']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><a href='".$ridinfo['url']."' target='new'>".$ridinfo['url']."</a></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td>$cidtitle</td></tr>\n";
                if ($lidinfo['sid'] == 0) {
                    $who_view = _DL_ALL;
                } elseif ($lidinfo['sid'] == 1) {
                    $who_view = _DL_USERS;
                } elseif ($lidinfo['sid'] == 2) {
                    $who_view = _DL_ADMIN;
                } elseif ($lidinfo['sid'] >2) {
                    $newView = $lidinfo['sid'] - 2;
                    list($who_view) = $db->sql_fetchrow($db->sql_query("SELECT gname FROM ".$prefix."_nsngr_groups WHERE gid=$newView"));
                    $who_view = $who_view." "._DL_ONLY;
                }
                echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td>$who_view</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td>".$ridinfo['name']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td>".$ridinfo['email']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td>".number_format($ridinfo['filesize'])." "._BYTES."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td>".$ridinfo['version']."</td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><a href='".$ridinfo['homepage']."' target='new'>".$ridinfo['homepage']."</a></td></tr>\n";
                echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td>".$ridinfo['description']."</td></tr>\n";
                echo "</table></td></tr>\n";
                echo "</table>\n";
                echo "<table align='center' width='100%'>\n";
                echo "<tr>";
                echo "<td align='left'>"._SUBMITTER.": ";
                if ($memail=="") { echo $ridinfo['modifier']; } else { echo "<a href='mailto:$memail'>".$ridinfo['modifier']."</a>"; }
                echo "</td>\n";
                echo "<td align='center'>( <a href='modules.php?name=$module_name&amp;file=admin&amp;op=ModRequestsAccept&amp;rid=".$ridinfo['rid']."'>"._ACCEPT."</a> / ";
                echo "<a href='modules.php?name=$module_name&amp;file=admin&amp;op=ModRequestsIgnore&amp;rid=".$ridinfo['rid']."'>"._IGNORE."</a> )</td>\n";
                echo "<td align='right'>"._OWNER.": ";
                if ($oemail=="") { echo $lidinfo['submitter']; } else { echo "<a href='mailto:$oemail'>".$lidinfo['submitter']."</a>"; }
                echo "</td>\n";
                echo "</tr></table>\n<br />\n<br />\n";
            }
        } else {
            echo "<center>"._NOMODREQUESTS."</center><br />\n";
            echo "<center>"._GOBACK."</center>\n";
        }
        echo "</td></tr></table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "ModRequestsAccept":
        $result = $db->sql_query("SELECT rid, lid, cid, sid, title, url, description, name, email, filesize, version, homepage FROM ".$prefix."_nsngd_mods WHERE rid='$rid'");
        while(list($rid, $lid, $cid, $sid, $title, $url, $description, $aname, $email, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
            $title = stripslashes($title);
            $title = addslashes($title);
            $description = stripslashes($description);
            $description = addslashes($description);
            $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET cid=$cid, sid=$sid, title='$title', url='$url', description='$description', name='$aname', email='$email', filesize='$filesize', version='$version', homepage='$homepage' WHERE lid='$lid'");
            $db->sql_query("DELETE FROM ".$prefix."_nsngd_mods WHERE rid='$rid'");
            $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_mods");
        }
        Header("Location: modules.php?name=$module_name&file=admin&op=ModRequests");
    break;

    case "ModRequestsIgnore":
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_mods WHERE rid='$rid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_mods");
        Header("Location: modules.php?name=$module_name&file=admin&op=ModRequests");
    break;

    case "categories":
        $pagetitle = _CATEGORIESADMIN;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />";
        OpenTable();
        list ($perpage) = $db->sql_fetchrow($db->sql_query("SELECT admperpage FROM ".$prefix."_nsngd_config"));
        if (!isset($min)) $min=0;
        if (!isset($max)) $max=$min+$perpage;
        $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories"));
        pagenums_admin($op, $totalselected, $perpage, $max);
        echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
        echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._TITLE."</strong></td>\n";
        echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
        $x = 0;
        $result = $db->sql_query("SELECT * FROM $prefix"._nsngd_categories." ORDER BY parentid,title LIMIT $min,$perpage");
        while($cidinfo = $db->sql_fetchrow($result)) {
            echo "<tr bgcolor='$bgcolor1'><form method='post' action='modules.php?name=$module_name'>\n";
            echo "<input type='hidden' name='file' value='admin'>\n";
            echo "<input type='hidden' name='op' value='categories'>\n";
            echo "<input type='hidden' name='min' value='$min'>\n";
            echo "<input type='hidden' name='cid' value='".$cidinfo['cid']."'>\n";
            $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']);
            echo "<td>".$cidinfo['title']."</td>\n";
            echo "<td align='center'><select name='op'><option value='ModifyCategory' selected>"._MODIFY."</option>\n";
            if ($cidinfo['active'] ==1) {
                echo "<option value='deactivateCat'>"._DL_DEACTIVATE."</a>\n";
            } else {
                echo "<option value='activateCat'>"._DL_ACTIVATE."</a>\n";
            }
            echo "<option value='DeleteCategory'>"._DL_DELETE."</option></select> ";
            echo "<input type='submit' value='"._DL_OK."'></td></tr>\n";
            echo "</form></tr>\n";
            $x++;
        }
        echo "</table>\n";
        pagenums_admin($op, $totalselected, $perpage, $max);
        CloseTable();
        include_once("footer.php");
    break;

    case "CatTrans":
        $pagetitle = _CATEGORIESADMIN.": "._CATTRANS;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads"));
        OpenTable();
        if ($numrows>0) {
            echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
            echo "<form method='post' action='modules.php?name=$module_name'>\n";
            echo "<tr><td align='center' colspan='2'><strong>"._EZTRANSFERDOWNLOADS."</strong></td></tr>\n";
            echo "<tr><td bgcolor='$bgcolor2'>"._FROM.":</td><td><select name='cidfrom'>\n";
            echo "<option value='0'>"._DL_NONE."</option>\n";
            $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE parentid='0' ORDER BY title");
            while($cidinfo = $db->sql_fetchrow($result2)) {
                $crawled = array($cidinfo['cid']);
                CrawlLevel($cidinfo['cid']);
                $x=0;
                while ($x <= (sizeof($crawled)-1)) {
                    list($title,$parentid) = $db->sql_fetchrow($db->sql_query("SELECT title, parentid FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'"));
                    if ($x > 0) { $title = getparent($parentid,$title); }
                    echo "<option value='$crawled[$x]'>$title</option>\n";
                    $x++;
                }
            }
            echo "</select></td></tr>\n";
            echo "<tr><td bgcolor='$bgcolor2'>"._TO.":</td><td><select name='cidto'>\n";
            echo "<option value='0'>"._DL_NONE."</option>\n";
            $result2 = $db->sql_query("SELECT cid, title, parentid FROM ".$prefix."_nsngd_categories WHERE parentid='0' ORDER BY title");
            while($cidinfo = $db->sql_fetchrow($result2)) {
                $crawled = array($cidinfo['cid']);
                CrawlLevel($cidinfo['cid']);
                $x=0;
                while ($x <= (sizeof($crawled)-1)) {
                    list($title,$parentid) = $db->sql_fetchrow($db->sql_query("SELECT title, parentid FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'"));
                    if ($x > 0) { $title = getparent($parentid,$title); }
                    echo "<option value='$crawled[$x]'>$title</option>\n";
                    $x++;
                }
            }
            echo "</select></td></tr>\n";
            echo "<input type='hidden' name='file' value='admin'>\n";
            echo "<input type='hidden' name='op' value='DownloadsTransfer'>\n";
            echo "<tr><td align='center' colspan='2'><input type='submit' value='"._EZTRANSFER."'></td></tr>\n";
            echo "</form>\n</table>\n";
        } else {
            echo "<center><strong>"._NOCATTRANS."</strong></center>\n";
        }
        CloseTable();
        include_once("footer.php");
    break;

    case "AddCategory":
        $pagetitle = _CATEGORIESADMIN.": "._ADDCATEGORY;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form method='post' action='modules.php?name=$module_name'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td><input type='text' name='title' size='50' maxlength='50'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._PARENT."</td><td><select name='cid'><option value='0' selected>"._DL_NONE."</option>\n";
        $result = $db->sql_query("SELECT cid, title, parentid FROM ".$prefix."_nsngd_categories WHERE parentid='0' ORDER BY title");
        while($cidinfo = $db->sql_fetchrow($result)) {
            $crawled = array($cidinfo['cid']);
            CrawlLevel($cidinfo['cid']);
            $x=0;
            while ($x <= (sizeof($crawled)-1)) {
                list($title,$parentid) = $db->sql_fetchrow($db->sql_query("SELECT title, parentid FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'"));
                if ($x > 0) { $title = getparent($parentid,$title); }
                echo "<option value='$crawled[$x]'>$title</option>\n";
                $x++;
            }
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='cdescription' cols='100%' rows='5'></textarea></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_WHOADD.":</td><td><select name='whoadd'>\n";
        echo "<option value='-1'>"._DL_NONE."</option>\n";
        echo "<option value='0' selected>"._DL_ALL."</option>\n";
        echo "<option value='1'>"._DL_USERS."</option>\n";
        echo "<option value='2'>"._DL_ADMIN."</option>\n";
        $gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
        while($gidinfo = $db->sql_fetchrow($gresult)) {
            $gidinfo['gid'] = $gidinfo['gid'] + 2;
            echo "<option value='".$gidinfo['gid']."'>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._UPDIRECTORY.":</td><td><input type='text' name='uploaddir' size='50' maxlength='255'><br />("._USEUPLOAD.")</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_CANUPLOAD.":</td><td><select name='canupload'>\n";
        echo "<option value='0'>"._DL_NO."</option>\n";
        echo "<option value='1'>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='op' value='AddCategorySave'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDCATEGORY."'></td></tr>\n";
        echo "</form>\n</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "AddCategorySave":
        $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE title='$title' AND parentid='$cid'"));
        if ($numrows>0) {
            $pagetitle = _CATEGORIESADMIN.": "._DL_ERROR;
            include_once("header.php");
            title($pagetitle);
            adminmain();
            echo "<br />\n";
            OpenTable();
            echo "<center><strong>"._ERRORTHESUBCATEGORY." $title "._ALREADYEXIST."</strong></center><br />\n";
            echo "<center>"._GOBACK."</center>\n";
            CloseTable();
            include_once("footer.php");
        } else {
            $db->sql_query("INSERT INTO ".$prefix."_nsngd_categories VALUES (NULL, '$title', '$cdescription', '$cid', '$whoadd', '$uploaddir', '$canupload', 1)");
            Header("Location: modules.php?name=$module_name&file=admin&op=categories");
        }
    break;

    case "DeleteCategory":
        $pagetitle = _CATEGORIESADMIN;
        $categoryinfo = getcategoryinfo($cid);
        include_once("header.php");
        title(_CATEGORIESADMIN);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<center>\n";
        echo "<strong>"._EZTHEREIS." ".$categoryinfo['categories']." "._EZSUBCAT." "._EZATTACHEDTOCAT."</strong><br />\n";
        echo "<strong>"._EZTHEREIS." ".$categoryinfo['downloads']." "._DOWNLOADS." "._EZATTACHEDTOCAT."</strong><br />\n";
        echo "<br /><strong>"._DELEZDOWNLOADSCATWARNING."</strong><br /><br />\n";
        echo "[ <a href='modules.php?name=$module_name&amp;file=admin&amp;op=DeleteCategorySave&amp;cid=$cid'>"._YES."</a> | <a href='modules.php?name=$module_name&amp;file=admin&amp;op=categories'>"._NO."</a> ]\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "DeleteCategorySave":
        $crawled = array($cid);
        CrawlLevel($cid);
        $x=0;
        while ($x <= (sizeof($crawled)-1)) {
            $db->sql_query("DELETE FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'");
            $db->sql_query("DELETE FROM ".$prefix."_nsngd_downloads WHERE cid='$crawled[$x]'");
            $x++;
        }
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_categories");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_downloads");
        Header("Location: modules.php?name=$module_name&file=admin&op=categories");
    break;

    case "ModifyCategory":
        $pagetitle = _CATEGORIESADMIN;
        include_once("header.php");
        title(_CATEGORIESADMIN);
        adminmain();
        echo "<br />\n";
        OpenTable();
        $cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid='$cid'"));
        $cidinfo['cdescription'] = stripslashes($cidinfo['cdescription']);
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<tr><td align='center' colspan='2'><strong>"._MODCATEGORY."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._NAME.":</td><td><input type='text' name='title' value='".$cidinfo['title']."' size='50' maxlength='50'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='cdescription' cols='50' rows='10'>".$cidinfo['cdescription']."</textarea></td></t>\n";
        $sel0 = $sel1 = $sel2 = $sel3 = "";
        if ($cidinfo['whoadd'] == -1) { $sel0 = " selected"; } elseif ($cidinfo['whoadd'] == 0) { $sel1 = " selected"; } elseif ($cidinfo['whoadd'] == 1) { $sel2 = " selected"; } elseif ($cidinfo['whoadd'] == 2) { $sel3 = " selected"; }
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_WHOADD.":</td><td><select name='whoadd'>\n";
        echo "<option value='-1'$sel0>"._DL_NONE."</option>\n";
        echo "<option value='0'$sel1>"._DL_ALL."</option>\n";
        echo "<option value='1'$sel2>"._DL_USERS."</option>\n";
        echo "<option value='2'$sel3>"._DL_ADMIN."</option>\n";
        $gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
        while($gidinfo = $db->sql_fetchrow($gresult)) {
            $gidinfo['gid'] = $gidinfo['gid'] + 2;
            if ($gidinfo['gid'] == $cidinfo['whoadd']) { $selected = " SELECTED"; } else { $selected = ""; }
            echo "<option value='".$gidinfo['gid']."'$selected>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._UPDIRECTORY.":</td><td><input type='text' name='uploaddir' value='".$cidinfo['uploaddir']."' size='50' maxlength='255'></td></t>\n";
        $sel0 = $sel1 = "";
        if ($cidinfo['canupload'] == 0) { $sel0 = " selected"; } elseif ($cidinfo['canupload'] == 1) { $sel1 = " selected"; }
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_CANUPLOAD.":</td><td><select name='canupload'>\n";
        echo "<option value='0'$sel0>"._DL_NO."</option>\n";
        echo "<option value='1'$sel2>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='cid' value='$cid'>\n";
        echo "<input type='hidden' name='op' value='ModifyCategorySave'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr></form>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='cid' value='$cid'>\n";
        echo "<input type='hidden' name='op' value='DeleteCategory'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DL_DELETE."'></td></tr></form>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "ModifyCategorySave":
        $db->sql_query("UPDATE ".$prefix."_nsngd_categories SET title='$title', cdescription='$cdescription', whoadd='$whoadd', uploaddir='$uploaddir', canupload='$canupload' WHERE cid='$cid'");
        Header("Location: modules.php?name=$module_name&file=admin&op=categories");
    break;

    case "deactivateCat":
        $crawled = array($cid);
        CrawlLevel($cid);
        $x=0;
        while ($x <= (sizeof($crawled)-1)) {
            $db->sql_query("UPDATE ".$prefix."_nsngd_categories SET active='0' WHERE cid='$crawled[$x]'");
            $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='0' WHERE cid='$crawled[$x]'");
            $x++;
        }
        Header("Location: modules.php?name=$module_name&file=admin&op=categories&min=$min");
    break;

    case "activateCat":
        $crawler = array($cid);
        CrawlLevelR($cid);
        $x=0;
        while ($x <= (sizeof($crawler)-1)) {
            $db->sql_query("UPDATE ".$prefix."_nsngd_categories SET active='1' WHERE cid='$crawler[$x]'");
            $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='1' WHERE cid='$crawler[$x]'");
            $x++;
        }
        //$db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='1' WHERE lid='$lid'");
        Header("Location: modules.php?name=$module_name&file=admin&op=categories&min=$min");
    break;

    case "ModifyDownload":
        if (!isset($min)) { $min = 0; }
        $pagetitle = _DOWNLOADSADMIN." - "._MODDOWNLOAD;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        $lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'"));
        if ($lidinfo['submitter'] == "") { $lidinfo['submitter'] = $anonymous; }
        $lidinfo['homepage'] = preg_replace("#http://#","",$lidinfo['homepage']);
        if ($lidinfo['homepage'] != "") { $lidinfo['homepage'] = "http://".$lidinfo['homepage']; }
        $lidinfo['title'] = stripslashes($lidinfo['title']);
        $lidinfo['description'] = stripslashes($lidinfo['description']);
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._DOWNLOADID.":</td><td><strong>$lid</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._TITLE.":</td><td><input type='text' name='title' value='".$lidinfo['title']."' size='50' maxlength='100'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._URL.":</td><td><input type='text' name='url' value='".$lidinfo['url']."' size='50' maxlength='100'>&nbsp;[ <a href='".$lidinfo['url']."' target='new'>"._CHECK."</a> ]</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._CATEGORY.":</td><td><select name='cat'><option value='0'";
        if ($lidinfo['cid'] == 0) { echo " selected"; }
        echo ">"._DL_NONE."</option>\n";
        $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
        while($cidinfo = $db->sql_fetchrow($result2)) {
            if ($cidinfo['cid']==$lidinfo['cid']) { $sel = " selected"; } else { $sel = ""; }
            if ($cidinfo['parentid'] != 0) $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']);
            echo "<option value='".$cidinfo['cid']."'$sel>".$cidinfo['title']."</option>\n";
        }
        echo "</select></td></tr>\n";
        $sel1 = $sel2 = $sel3 = "";
        if ($lidinfo['sid'] == 0) { $sel1 = " selected"; } elseif ($lidinfo['sid'] == 1) { $sel2 = " selected"; } elseif ($lidinfo['sid'] == 2) { $sel3 = " selected"; }
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_PERM.":</td><td><select name='perm'>\n";
        echo "<option value='0'$sel1>"._DL_ALL."</option>\n";
        echo "<option value='1'$sel2>"._DL_USERS."</option>\n";
        echo "<option value='2'$sel3>"._DL_ADMIN."</option>\n";
        $gresult = $db->sql_query("SELECT * FROM ".$prefix."_nsngr_groups ORDER BY gname");
        while($gidinfo = $db->sql_fetchrow($gresult)) {
            $gidinfo['gid'] = $gidinfo['gid'] + 2;
            if ($gidinfo['gid'] == $lidinfo['sid']) { $selected = " selected"; } else { $selected = ""; }
            echo "<option value='".$gidinfo['gid']."'$selected>".$gidinfo['gname']." "._DL_ONLY."</option>\n";
        }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2' valign='top'>"._DESCRIPTION.":</td><td><textarea name='description' cols='60' rows='10'>".$lidinfo['description']."</textarea></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AUTHORNAME.":</td><td><input type='text' name='rname' size='50' maxlength='100' value='".$lidinfo['name']."'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._AUTHOREMAIL.":</td><td><input type='text' name='email' size='50' maxlength='100' value='".$lidinfo['email']."'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FILESIZE.":</td><td><input type='text' name='filesize' size='12' maxlength='20' value='".$lidinfo['filesize']."'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._VERSION.":</td><td><input type='text' name='version' size='11' maxlength='20' value='".$lidinfo['version']."'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._HOMEPAGE.":</td><td><input type='text' name='homepage' size='50' maxlength='255' value='".$lidinfo['homepage']."'>&nbsp;[ <a href='".$lidinfo['homepage']."' target='new'>"._VISIT."</a> ]</td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._HITS.":</td><td><input type='text' name='hits' value='".$lidinfo['hits']."' size='12' maxlength='11'></td></tr>\n";
        echo "<input type='hidden' name='op' value='ModifyDownloadSave'>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='lid' value='$lid'>\n";
        echo "<input type='hidden' name='min' value='$min'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._MODIFY."'></td></tr>\n";
        echo "</form>\n<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<input type='hidden' name='op' value='DeleteDownload'>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='lid' value='$lid'>\n";
        echo "<input type='hidden' name='min' value='$min'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DL_DELETE."'></td></tr>\n";
        echo "</form>\n</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "ModifyDownloadSave":
        if (!isset($min)) { $min = 0; }
        $title = stripslashes(FixQuotes($title));
        $url = stripslashes(FixQuotes($url));
        $description = stripslashes(FixQuotes($description));
        $name = stripslashes(FixQuotes($name));
        $email = stripslashes(FixQuotes($email));
        $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET cid='$cat', sid='$perm', title='$title', url='$url', description='$description', name='$rname', email='$email', hits='$hits', filesize='$filesize', version='$version', homepage='$homepage' WHERE lid='$lid'");
        Header("Location: modules.php?name=$module_name&file=admin&min=$min");
    break;

    case "DeleteDownload":
        list($sname) = $db->sql_fetchrow($db->sql_query("SELECT submitter FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'"));
        $db->sql_query("UPDATE ".$prefix."_nsngd_accesses SET uploads=uploads-1 WHERE username='$sname'");
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_downloads");
        Header("Location: modules.php?name=$module_name&file=admin&min=$min");
    break;

    case "DownloadsTransfer":
        $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET cid=$cidto WHERE cid='$cidfrom'");
        Header("Location: modules.php?name=$module_name&file=admin&op=categories");
    break;

    case "deactivate":
        $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='0' WHERE lid='$lid'");
        Header("Location: modules.php?name=$module_name&file=admin&min=$min");
    break;

    case "activate":
        $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='1' WHERE lid='$lid'");
        Header("Location: modules.php?name=$module_name&file=admin&min=$min");
    break;

    case "DownloadConfig":
        $pagetitle = _DOWNCONFIG;
        include_once("header.php");
        $dl_config = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_config"));
        title($pagetitle);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMBLOCKUNREGMODIFY."</td><td><select name='xblockunregmodify'>\n";
        echo "<option value='0'";
        if ($dl_config['blockunregmodify'] == 0) { echo " selected"; }
        echo "> "._YES." </option>\n<option value='1'";
        if ($dl_config['blockunregmodify'] == 1) { echo " selected"; }
        echo "> "._NO." </option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMMOSTPOPULAR."</td><td><select name='xmostpopular'>\n";
        echo "<option value='".$dl_config['mostpopular']."' selected> ".$dl_config['mostpopular']." </option>\n";
        for ($i=1; $i <= 5; $i++) { $j = $i * 5; echo "<option value='$j'> $j </option>\n"; }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMMOSTPOPULARTRIG."</td><td><select name='xmostpopulartrig'>\n";
        echo "<option value='0'";
        if ($dl_config['mostpopulartrig'] == 0) { echo " selected"; }
        echo "> "._NUMBER." </option>\n<option value='1'";
        if ($dl_config['mostpopulartrig'] == 1) { echo " selected"; }
        echo "> "._PERCENT." </option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMPERPAGE."</td><td><select name='xperpage'>\n";
        echo "<option value='".$dl_config['perpage']."' selected> ".$dl_config['perpage']." </option>\n";
        for ($i=1; $i <= 5; $i++) { $j = $i * 10; echo "<option value='$j'> $j </option>\n"; }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMADMPERPAGE."</td><td><select name='xadmperpage'>\n";
        echo "<option value='".$dl_config['admperpage']."' selected> ".$dl_config['admperpage']." </option>\n";
        for ($i=1; $i <= 8; $i++) { $j = $i * 25; echo "<option value='$j'> $j </option>\n"; }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMPOPULAR."</td><td><select name='xpopular'>\n";
        echo "<option value='".$dl_config['popular']."' selected> ".$dl_config['popular']." </option>\n";
        for ($i=1; $i <= 10; $i++) { $j = $i * 100; echo "<option value='$j'> $j </option>\n"; }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMRESULTS."</td><td><select name='xresults'>\n";
        echo "<option value='".$dl_config['results']."' selected> ".$dl_config['results']." </option>\n";
        for ($i=1; $i <= 5; $i++) { $j = $i * 10; echo "<option value='$j'> $j </option>\n"; }
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMSHOWNUM."</td><td><select name='xshow_links_num'>\n";
        echo "<option value='0'";
        if ($dl_config['show_links_num'] == 0) { echo " selected"; }
        echo "> "._NO." </option>\n<option value='1'";
        if ($dl_config['show_links_num'] == 1) { echo " selected"; }
        echo "> "._YES." </option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._ADMUSEGFX."</td><td><select name='xusegfxcheck'>\n";
        echo "<option value='0'";
        if ($dl_config['usegfxcheck'] == 0) { echo " selected"; }
        echo "> "._NO." </option>\n<option value='1'";
        if ($dl_config['usegfxcheck'] == 1) { echo " selected"; }
        echo "> "._YES." </option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._DL_DATEFORMAT.":<br />"._DL_DATEMSG."</td><td>";
        echo "<input size='30' maxlength='60' type='text' name='xdateformat' value='".$dl_config['dateformat']."'></td></tr>\n";
        echo "<input type='hidden' name='op' value='DownloadConfigSave'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr>\n";
        echo "</form>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "DownloadConfigSave":
        $db->sql_query("UPDATE ".$prefix."_nsngd_config SET blockunregmodify='$xblockunregmodify', mostpopular='$xmostpopular', mostpopulartrig='$xmostpopulartrig', perpage='$xperpage', admperpage='$xadmperpage', popular='$xpopular', results='$xresults', show_links_num='$xshow_links_num', usegfxcheck='$xusegfxcheck', dateformat='$xdateformat'");
        Header("Location: modules.php?name=$module_name&file=admin&op=DownloadConfig");
    break;

    case "extensions":
        $pagetitle = _EXTENSIONSADMIN;
        include_once("header.php");
        title($pagetitle);
        adminmain();
        echo "<br />";
        OpenTable();
        list ($perpage) = $db->sql_fetchrow($db->sql_query("SELECT admperpage FROM ".$prefix."_nsngd_config"));
        if (!isset($min)) $min=0;
        if (!isset($max)) $max=$min+$perpage;
        $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_extensions"));
        pagenums_admin($op, $totalselected, $perpage, $max);
        echo "<table align='center' cellpadding='2' cellspacing='2' bgcolor='$textcolor1' border='0'>\n";
        echo "<tr bgcolor='$bgcolor2'>\n<td><strong>"._EXTENSION."</strong></td>\n";
        echo "<td><strong>"._FILETYPE."</strong></td>\n";
        echo "<td><strong>"._IMAGETYPE."</strong></td>\n";
        echo "<td align='center'><strong>"._FUNCTIONS."</strong></td>\n</tr>\n";
        $x = 0;
        $result = $db->sql_query("SELECT * FROM $prefix"._nsngd_extensions." ORDER BY ext,eid LIMIT $min,$perpage");
        while($eidinfo = $db->sql_fetchrow($result)) {
            echo "<tr bgcolor='$bgcolor1'><form method='post' action='modules.php?name=$module_name'>\n";
            echo "<input type='hidden' name='file' value='admin'>\n";
            echo "<input type='hidden' name='op' value='categories'>\n";
            echo "<input type='hidden' name='min' value='$min'>\n";
            echo "<input type='hidden' name='eid' value='".$eidinfo['eid']."'>\n";
            echo "<td>".$eidinfo['ext']."</td>\n";
            if ($eidinfo['file'] == 1) { $ftype = "<strong>"._YES."</strong>"; } else { $ftype = _NO; }
            echo "<td align='center'>$ftype</td>\n";
            if ($eidinfo['image'] == 1) { $itype = "<strong>"._YES."</strong>"; } else { $itype = _NO; }
            echo "<td align='center'>$itype</td>\n";
            echo "<td align='center'><select name='op'><option value='ModifyExtension' selected>"._MODIFY."</option>\n";
            echo "<option value='DeleteExtension'>"._DL_DELETE."</option></select> ";
            echo "<input type='submit' value='"._DL_OK."'></td></tr>\n";
            echo "</form></tr>\n";
            $x++;
        }
        echo "</table>\n";
        pagenums_admin($op, $totalselected, $perpage, $max);
        CloseTable();
        include_once("footer.php");
    break;

    case "DeleteExtension":
        $eid = intval($eid);
        $db->sql_query("DELETE FROM ".$prefix."_nsngd_extensions WHERE eid='$eid'");
        $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_extensions");
        Header("Location: modules.php?name=$module_name&file=admin&op=extensions&min=$min");
    break;

  case "ModifyExtension":
        $eid = intval($eid);
        $pagetitle = _EXTENSIONSADMIN;
        include_once("header.php");
        title(_EXTENSIONSADMIN);
        adminmain();
        echo "<br />\n";
        OpenTable();
        $eidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_extensions WHERE eid='$eid'"));
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<tr><td align='center' colspan='2'><strong>"._MODEXTENSION."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EXT.":</td><td><input type='text' name='xext' value='".$eidinfo['ext']."' size='10' maxlength='6'></td></tr>\n";
        $sel0 = $sel1 = "";
        if ($eidinfo['file'] == 0) { $sel0 = " selected"; } elseif ($eidinfo['file'] == 1) { $sel1 = " selected"; }
        echo "<tr><td bgcolor='$bgcolor2'>"._FILETYPE.":</td><td><select name='xfile'>\n";
        echo "<option value='0'$sel0>"._DL_NO."</option>\n";
        echo "<option value='1'$sel1>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";
        $sel0 = $sel1 = "";
        if ($eidinfo['image'] == 0) { $sel0 = " selected"; } elseif ($eidinfo['image'] == 1) { $sel1 = " selected"; }
        echo "<tr><td bgcolor='$bgcolor2'>"._IMAGETYPE.":</td><td><select name='ximage'>\n";
        echo "<option value='0'$sel0>"._DL_NO."</option>\n";
        echo "<option value='1'$sel1>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";

        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='eid' value='$eid'>\n";
        echo "<input type='hidden' name='min' value='$min'>\n";
        echo "<input type='hidden' name='op' value='ModifyExtensionSave'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr></form>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='eid' value='$eid'>\n";
        echo "<input type='hidden' name='min' value='$min'>\n";
        echo "<input type='hidden' name='op' value='DeleteExtension'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._DL_DELETE."'></td></tr></form>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "ModifyExtensionSave":
        $db->sql_query("UPDATE ".$prefix."_nsngd_extensions SET ext='$xext', file='$xfile', image='$ximage' WHERE eid='$eid'");
        Header("Location: modules.php?name=$module_name&file=admin&op=extensions&min=$min");
    break;

    case "AddExtension":
        $pagetitle = _EXTENSIONSADMIN.": "._ADDEXTENSION;
        include_once("header.php");
        title(_EXTENSIONSADMIN);
        adminmain();
        echo "<br />\n";
        OpenTable();
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form action='modules.php?name=$module_name' method='post'>\n";
        echo "<tr><td align='center' colspan='2'><strong>"._ADDEXTENSION."</strong></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._EXTENSION.":</td><td><input type='text' name='xext' size='10' maxlength='6'></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._FILETYPE.":</td><td><select name='xfile'>\n";
        echo "<option value='0' selected>"._DL_NO."</option>\n";
        echo "<option value='1'>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<tr><td bgcolor='$bgcolor2'>"._IMAGETYPE.":</td><td><select name='ximage'>\n";
        echo "<option value='0' selected>"._DL_NO."</option>\n";
        echo "<option value='1'>"._DL_YES."</option>\n";
        echo "</select></td></tr>\n";
        echo "<input type='hidden' name='file' value='admin'>\n";
        echo "<input type='hidden' name='op' value='AddExtensionSave'>\n";
        echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDEXTENSION."'></td></tr></form>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "AddExtensionSave":
        $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_extensions WHERE ext='$xext'"));
        if ($numrows>0) {
            $pagetitle = _EXTENSIONSADMIN.": "._DL_ERROR;
            include_once("header.php");
            title($pagetitle);
            adminmain();
            echo "<br />\n";
            OpenTable();
            echo "<center><strong>"._ERRORTHEEXTENSION." $xext "._ALREADYEXIST."</strong></center><br />\n";
            echo "<center>"._GOBACK."</center>\n";
            CloseTable();
            include_once("footer.php");
        } else {
            $db->sql_query("INSERT INTO ".$prefix."_nsngd_extensions VALUES (NULL, '$xext', '$xfile', '$ximage')");
            Header("Location: modules.php?name=$module_name&file=admin&op=extensions");
        }
    break;

}

} else {
    Header("Location: index.php");
}

?>