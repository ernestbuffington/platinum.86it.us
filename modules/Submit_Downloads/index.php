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

$module_name = basename(dirname(__FILE__));

require_once("mainfile.php");
get_lang($module_name);
$index = 1;

function getparent($parentid,$title) {
    global $prefix, $db;
    $parentid = intval($parentid);
    $cidinfo = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_nsngd_categories where cid=$parentid"));
    if ($cidinfo['title'] != "") $title = $cidinfo['title']." -> ".$title;
    if ($cidinfo['parentid'] != 0) { $title = getparent($cidinfo['parentid'],$title); }
    return $title;
}

function CrawlLevel($cid) {
    global $prefix, $db, $crawled;
    $bresult = $db->sql_query("SELECT cid FROM ".$prefix."_nsngd_categories WHERE active>'0' AND parentid='$cid' ORDER BY title");
    while(list($cid2)=$db->sql_fetchrow($bresult)){
        array_push($crawled,$cid2);
        CrawlLevel($cid2);
    }
    return $crawled;
}

switch($op) {

    default:
        $pagetitle = _DOWNLOADS.": "._ADDADOWNLOAD;
        include_once("header.php");
        title(_ADDADOWNLOAD);
        OpenTable();
        OpenTable2();
        echo "<strong>"._INSTRUCTIONS.":</strong><br />\n";
        echo "<li> "._DSUBMITONCE."</li>\n";
        echo "<li> "._DPOSTPENDING."</li>\n";
        echo "<li> "._USERANDIP."</li>\n";
        echo "</ul>\n";
        CloseTable2();
        echo "<br />\n";
        echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
        echo "<form method='post' action='modules.php?name=$module_name'>\n";
        echo "<input type='hidden' name='op' value='Input'>\n";
        $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE active>'0' AND parentid='0' ORDER BY title");
        $numrow = $db->sql_numrows($result2);
        if ($numrow == 0) {
            echo "<tr><td align='center' colspan='2'><strong>"._NOCATEGORY.":</strong></td></tr>\n";
        } else {
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._CATEGORY.":</strong></td><td><select name='cat'>\n";
            while($cidinfo = $db->sql_fetchrow($result2)) {
                $crawled = array($cidinfo['cid']);
                CrawlLevel($cidinfo['cid']);
                $x=0;
                while ($x <= (sizeof($crawled)-1)) {
                    list($title, $parentid, $whoadd) = $db->sql_fetchrow($db->sql_query("SELECT title, parentid, whoadd FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'"));
                    if ($x > 0) { $title = getparent($parentid,$title); }
                    $priv = $whoadd - 2;
                    if ($whoadd == 0 OR ($whoadd == 1 AND (is_user($user) OR is_admin($admin))) OR ($whoadd == 2 AND is_admin($admin)) OR ($whoadd > 2 AND in_group($priv))) {
                        echo "<option value='$crawled[$x]'>$title</option>\n";
                    }
                    $x++;
                }
            }
            echo "</select></td></tr>\n";
            echo "<tr><td align='center' colspan='2'><input type='submit' value='"._GONEXT."'></td></tr>\n";
        }
        echo "</form>\n";
        echo "</table>\n";
        CloseTable();
        include_once("footer.php");
    break;

    case "Input":
        $pagetitle = _DOWNLOADS.": "._ADDADOWNLOAD;
        include_once("header.php");
        echo "<script language='JavaScript'>\n";
        echo "<!-- Begin\n";
        echo "function NewWindow(mypage, myname, w, h, scroll) {\n";
        echo "var winl = (screen.width - w) / 2;\n";
        echo "var wint = (screen.height - h) / 2;\n";
        echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'\n";
        echo "win = window.open(mypage, myname, winprops)\n";
        echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
        echo "}\n";
        echo "//  End -->\n";
        echo "</script>\n";
        title(_ADDADOWNLOAD);
        $cat = intval($cat);
        $cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid='$cat' ORDER BY title"));
        OpenTable();
        $priv = $cidinfo['whoadd'] - 2;
        if ($cidinfo['whoadd'] == 0 OR ($cidinfo['whoadd'] == 1 AND (is_user($user) OR is_admin($admin))) OR ($cidinfo['whoadd'] == 2 AND is_admin($admin)) OR ($cidinfo['whoadd'] > 2 AND in_group($priv))) {
            echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
            if ($cidinfo['canupload'] > 0) {
                echo "<form method='post' action='modules.php?name=$module_name' enctype='multipart/form-data'>\n";
            } else {
                echo "<form method='post' action='modules.php?name=$module_name'>\n";
            }
            echo "<input type='hidden' name='op' value='Add'>\n";
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._TITLE.":</strong></td><td><input type='text' name='title' size='50' maxlength='100'></td></tr>\n";
            if ($cidinfo['canupload'] == 1) {
                $result = $db->sql_query("SELECT ext FROM ".$prefix."_nsngd_extensions WHERE file=1");
                while (list ($exten) = $db->sql_fetchrow($result)) {
                    if ($limitedext == "") { $limitedext = $exten; }
                    else { $limitedext = $limitedext.", ".$exten; }
                }
                //$max = get_cfg_var('upload_max_filesize');
                //if (str_replace("M", "", $max)) {
                //    $mtemp = sprintf($max * 1024 * 1024);
                //    $msize = number_format($mtemp, 0, '.', ',')." "._BYTES;
                //} elseif (str_replace("K", "", $max)) {
                //    $mtemp = sprintf($max * 1024);
                //    $msize = number_format($mtemp, 0, '.', ',')." "._BYTES;
                //} else {
                //    $msize = number_format($max, 0, '.', ',')." "._BYTES;
                //}
                //echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._MAXFSIZE.":</strong></td><td>$msize</td></tr>\n";
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._DL_ALWEXT.":</strong></td><td>$limitedext</td></tr>\n";
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._URL.":</strong></td><td><input type='file' name='url' size='50'></td></tr>\n";
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong><a href='modules.php?name=$module_name&op=TermsUseUp' onclick=\"NewWindow(this.href,'TermsofUseUp','540','380','yes');return false;\">"._DL_TOU."</a>:</strong></td>";
                echo "<td><input type='radio' name='tou' value='1'>"._YES." &nbsp; <input type='radio' name='tou' value='0' checked>"._NO."</td></tr>\n";
            } else {
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._URL.":</strong></td><td><input type='text' name='url' size='50'></td></tr>\n";
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong><a href='modules.php?name=$module_name&op=TermsUse' onclick=\"NewWindow(this.href,'TermsofUse','540','380','yes');return false;\">"._DL_TOU."</a>:</strong></td>";
                echo "<td><input type='radio' name='tou' value='1'>"._YES." &nbsp; <input type='radio' name='tou' value='0' checked>"._NO."</td></tr>\n";
            }
            $title = getparent($cidinfo['parentid'],$cidinfo['title']);
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._CATEGORY.":</strong></td><td>$title</td></tr>\n";
            echo "<input type='hidden' name='cat' value='$cat'>\n";
            echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'><strong>"._DESCRIPTION.":</strong></td><td><textarea name='description' cols='50' rows='8'></textarea><br />"._NEWLINE."<br />"._CONVERTBR."</td></tr>\n";
            $usrinfo = $db->sql_fetchrow($db->sql_query("select * from ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
            if ($usrinfo['user_website'] == "http://") { $usrinfo['user_website'] = ""; }
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._AUTHORNAME.":</strong></td><td><input type='text' name='auth_name' size='50' maxlength='60' value='".$usrinfo['username']."'></td></tr>\n";
            echo "<input type='hidden' name='submitter' value='".$usrinfo['username']."'>\n";
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._AUTHOREMAIL.":</strong></td><td><input type='text' name='email' size='50' maxlength='100' value='".$usrinfo['user_email']."'></td></tr>\n";
            if ($cidinfo['canupload'] == 0) {
                echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._FILESIZE.":</strong></td><td><input type='text' name='filesize' size='20' maxlength='20'> ("._INBYTES.")</td></tr>\n";
            }
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._VERSION.":</strong></td><td><input type='text' name='version' size='20' maxlength='20'></td></tr>\n";
            echo "<tr><td align='right' bgcolor='$bgcolor2'><strong>"._HOMEPAGE.":</strong></td><td><input type='text' name='homepage' size='50' maxlength='255' value='".$usrinfo['user_website']."'></td></tr>\n";
            echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDTHISFILE."'></td></tr>\n";
            echo "</form>\n";
            echo "</table>\n";
        } else {
            echo "<center><strong>"._DL_CANTADD.":</strong></center>\n";
        }
        CloseTable();
        include_once("footer.php");
    break;

    case "Add":
        $pagetitle = _DOWNLOADS.": "._ADDADOWNLOAD;
        if ($tou > 0) {
            $cat = intval($cat);
            $cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid='$cat'"));
            $priv = $cidinfo['whoadd'] - 2;
            if ($cidinfo['whoadd'] == 0 OR ($cidinfo['whoadd'] == 1 AND (is_user($user) OR is_admin($admin))) OR ($cidinfo['whoadd'] == 2 AND is_admin($admin)) OR ($cidinfo['whoadd'] > 2 AND in_group($priv))) {
                if ($cidinfo['canupload'] > 0) {
                    $result = $db->sql_query("SELECT ext FROM ".$prefix."_nsngd_extensions WHERE file=1");
                    $xi = 0;
                    while (list ($exten) = $db->sql_fetchrow($result)) {
                        $limitedext[$xi] = $exten;
                        $xi++;
                    }
                    $imageurl_name = $_FILES['url']['name'];
                    $imageurl_temp = $_FILES['url']['tmp_name'];
                    $ext = substr($imageurl_name, strrpos($imageurl_name,'.'));
                    if (!in_array($ext,$limitedext)) {
                        include_once("header.php");
                        title(_ADDADOWNLOAD);
                        OpenTable();
                        echo "<center><strong>"._DL_BADEXT."</strong></center><br />\n";
                        echo "<center>"._GOBACK."</center>\n";
                        CloseTable();
                        include_once("footer.php");
                        die();
                    } elseif (file_exists($cidinfo['uploaddir']."/$imageurl_name")) {
                        include_once("header.php");
                        title(_ADDADOWNLOAD);
                        OpenTable();
                        echo "<center><strong>"._DL_FILEEXIST."</strong></center><br />\n";
                        echo "<center>"._GOBACK."</center>\n";
                        CloseTable();
                        include_once("footer.php");
                        die();
                    } elseif (move_uploaded_file($imageurl_temp, $cidinfo['uploaddir']."/$imageurl_name")) {
                        chmod ($cidinfo['uploaddir']."/$imageurl_name", 0644);
                        $url = $cidinfo['uploaddir']."/$imageurl_name";
                    } else {
                        include_once("header.php");
                        title(_ADDADOWNLOAD);
                        OpenTable();
                        echo "<center><strong>"._DL_NOUPLOAD."</strong></center><br />\n";
                        echo "<center>"._GOBACK."</center>\n";
                        CloseTable();
                        include_once("footer.php");
                        die();
                    }
                    $filesize = sprintf("%u", filesize($url));
                } else {
                    if ($url=="" OR $url=="http;//") {
                        include_once("header.php");
                        title(_ADDADOWNLOAD);
                        OpenTable();
                        echo "<center><strong>"._DOWNLOADNOURL."</strong></center><br />\n";
                        echo "<center>"._GOBACK."</center>\n";
                        CloseTable();
                        include_once("footer.php");
                        die();
                    }
                }
                if ($title=="") {
                    include_once("header.php");
                    title(_ADDADOWNLOAD);
                    OpenTable();
                    echo "<center><strong>"._DOWNLOADNOTITLE."</strong></center><br />\n";
                    echo "<center>"._GOBACK."</center>\n";
                    CloseTable();
                    include_once("footer.php");
                    die();
                }
                if ($description=="") {
                    include_once("header.php");
                    title(_ADDADOWNLOAD);
                    OpenTable();
                    echo "<center><strong>"._DOWNLOADNODESC."</strong></center><br />\n";
                    echo "<center>"._GOBACK."</center>\n";
                    CloseTable();
                    include_once("footer.php");
                    die();
                }
                $title = check_html($title, nohtml);
                $title = htmlentities($title, ENT_QUOTES);
                $url = check_html($url, nohtml);
                $description = str_replace("<br />", "\r\n", $description);
                $description = htmlentities($description, ENT_QUOTES);
                $description = check_html($description, nohtml);
                $auth_name = check_html($auth_name, nohtml);
                $submitter = check_html($submitter, nohtml);
                if ($submitter == "") { $submitter = $auth_name; }
                $email = check_html($email, nohtml);
                if (!get_magic_quotes_gpc()) {
                    $title = addslashes($title);
                    $url = addslashes($url);
                    $description = addslashes($description);
                    $auth_name = addslashes($auth_name);
                    $email = addslashes($email);
                }
                $filesize = preg_replace("#\.#","",$filesize);
                $filesize = preg_replace("#\.#","",$filesize);
                $filesize = intval($filesize);
                $cat = intval($cat);
                $sub_ip = $_SERVER['REMOTE_ADDR'];
                $db->sql_query("INSERT INTO ".$prefix."_nsngd_new VALUES (NULL, $cat, 0, '$title', '$url', '$description', now(), '$auth_name', '$email', '$submitter', '$sub_ip', $filesize, '$version', '$homepage')");
                include_once("header.php");
                title(_ADDADOWNLOAD);
                OpenTable();
                echo "<center><strong>"._DOWNLOADRECEIVED."</strong></center><br />\n";
                if ($email != "") {
                    echo "<center>"._EMAILWHENADD."</center>\n";
                } else {
                    echo "<center>"._CHECKFORIT."</center>\n";
                }
                CloseTable();
                $msg = "$sitename "._DOWSUB."\n\n";
                $msg .= _TITLE.": $title\n";
                $msg .= _URL.": $url\n";
                $msg .= _DESCRIPTION.": $description\n";
                $msg .= _HOMEPAGE.": $homepage\n";
                $msg .= _SUBIP.": $sub_ip\n";
                $to = $adminmail;
                $subject = "$sitename - "._DOWSUBREC;
                $mailheaders = "From: $email <$auth_name> \n";
                $mailheaders .= "Reply-To: $email\n\n";
                mail($to, $subject, $msg, $mailheaders);
                include_once("footer.php");
            } else {
                include_once("header.php");
                title(_ADDADOWNLOAD);
                OpenTable();
                echo "<center><strong>"._DL_CANTADD."</strong></center>\n";
                CloseTable();
                include_once("footer.php");
            }
        } else {
            include_once("header.php");
            title(_ADDADOWNLOAD);
            OpenTable();
            echo "<center><strong>"._DL_TOUMUST."</strong></center><br />\n";
            echo "<center>"._GOBACK."</center>\n";
            CloseTable();
            include_once("footer.php");
        }
    break;

    case "TermsUseUp":
        echo "<html>\n";
        echo "<head><title>"._DL_TOU."</title></head>\n";
        echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
        echo "<u>"._DUSAGEUP1."</u><br /><br />\n";
        echo "i) "._DUSAGEUP2."<br /><br />\n";
        echo "ii) "._DUSAGEUP3."<br /><br />\n";
        echo "iii) "._DUSAGEUP4."<br /><br />\n";
        echo "iv) "._DUSAGEUP5."<br /><br />\n";
        echo "v) "._DUSAGEUP6."<br /><br />\n";
        echo "</body>\n";
        echo "</html>";
    break;

    case "TermsUse":
        echo "<html>\n";
        echo "<head><title>"._DL_TOU."</title></head>\n";
        echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
        echo "<u>"._DUSAGE1."</u><br /><br />\n";
        echo "i) "._DUSAGE2."<br /><br />\n";
        echo "ii) "._DUSAGE3."<br /><br />\n";
        echo "iii) "._DUSAGE4."<br /><br />\n";
        echo "iv) "._DUSAGE5."<br /><br />\n";
        echo "</body>\n";
        echo "</html>";
    break;

}

?>
