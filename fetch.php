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
include_once("mainfile.php");
if ($fetchid == "") {
        header("location: index.php");
}
if ($checkpass == $passcode) {
$url = base64_decode($fetchid);
        if (preg_match("/http/", $url, $location)) {
                /* Increase the counter for total downloads */
                sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid=$lid", $dbi);
                header("location: $url");
                exit;
        }
        if (file_exists($url)) {
                /* Fetch the file if it exists */
                /* Increase the counter for total downloads */
                sql_query("update ".$prefix."_downloads_downloads set hits=hits+1 where lid=$lid", $dbi);
                header("location: $url");
                exit;
        } else {
                cookiedecode($user);
                $username = $cookie[1];
                if ($username == "") {
                        $username = "Guest";
                }
                $date = date("M d, Y g:i:a");
                /* Flag it for being a broken link if it isn't found */
                sql_query("insert into ".$prefix."_downloads_modrequest values (NULL, $lid, 0, 0, '', '', '', 'Download Script<br />$date', 1, '$auth_name', '$email', '$filesize', '$version', '$homepage')", $dbi);
                include_once("header.php");
                OpenTable();
                echo "<center><font class=\"title\">File Not Found for $title</font></center>";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<p>Sorry $username, The file for <strong>\"$title\"</strong> was not found. It
                could be because the person hosting the download may removed or renamed the
                file.</p>
                <p>This download has now been automatically flagged for review by the
                webmaster.</p>
                <center>[ <a href=\"modules.php?name=Downloads\">Back To Downloads</a> ]</center>";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<div align=\"right\"><font class=\"tiny\">Fetching Mod V.1b<br />By:
                <a href=\"http://www.2thextreme.org\">MGCJerry</a></div>";
                CloseTable();
                include_once("footer.php");
                return;
        }
} else {
        include_once("header.php");
        OpenTable();
        echo "<center><font class=\"title\">Password Error</font></center><br /><br />
        <p>You have entered an invalid Password.</p>
        <input type=\"button\" value=\"&lt;&lt; Try Again\" onclick=\"history.go(-1)\">";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<div align=\"right\"><font class=\"tiny\">Fetching Mod V.1b<br />By:
        <a href=\"http://www.2thextreme.org\">MGCJerry</a></div>";
        CloseTable();
        include_once("footer.php");
        return;
}
?>
