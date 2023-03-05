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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $user, $cookie, $prefix, $currentlang, $db, $dbi, $username, $numusers;
$prefix = "nuke";
$numusers = 50;
if(file_exists("language/lastseen/lastseen-$currentlang.php")) {
	include_once("language/lastseen/lastseen-$currentlang.php");
}
else {
	include_once("language/lastseen/lastseen-english.php");
}
        $username = $cookie[1];
        sql_query("CREATE TABLE IF NOT EXISTS $prefix"._lastseen." (id INT (15) not null AUTO_INCREMENT, username TEXT not null, date INT(15) not null, ip CHAR(50), PRIMARY KEY (id), UNIQUE (id))", $dbi);
        if (isset($username)) {
                $ip = getenv("REMOTE_HOST");
                if (empty($ip)) {
                        $ip = getenv("REMOTE_ADDR");
                }
                $result = sql_query("SELECT * FROM $prefix"._lastseen." WHERE username = \"$username\"", $dbi);
                if (sql_num_rows($result, $dbi) > 0) {
                        sql_query("UPDATE $prefix"._lastseen." SET date = " . time() . " WHERE username = \"$username\"", $dbi);
                } else {
                        sql_query("INSERT INTO $prefix"._lastseen." VALUES (\"\", \"$username\", ".time().", \"".$ip."\")", $dbi);
                }
        }
        $content = "<A name= \"scrollingCode\"></A>"; 
        $content .="<marquee behavior= \"scroll\" align= \"center\" direction= \"up\" height=\"110\" scrollamount= \"2\" scrolldelay= \"20\" onmouseover='this.stop()' onmouseout='this.start()'>";
        $result = sql_query("SELECT username, date FROM $prefix"._lastseen." ORDER BY date DESC limit $numusers", $dbi);
        while (list($uname, $date) = sql_fetch_row($result, $dbi)) {
                if ($uname != $username) {
                        $realtime = time() - $date;
                        $dont = false;
                        // how many days ago?
                        if ($realtime >= (60*60*24*2)) { // if it's been more than 2 days
                                $days = floor($realtime / (60*60*24));
                                $dont = true;
                        } else if ($realtime >= (60*60*24)) { // if it's been less than 2 days
                                $days = 1;
                                $realtime -= (60*60*24);
                        }
                        if (!$dont) {
                                // how many hours ago?
                                if ($realtime >= (60*60)) {
                                        //$content .= " ($realtime) ";
                                        $hours = floor($realtime / (60*60));
                                        $realtime -= (60*60*$hours);
                                }
                                // how many minutes ago?
                                if ($realtime >= 60) {
                                        $mins = floor($realtime / 60);
                                        $realtime -= (60*$mins);
                                }
                                // just a little precation, although I don't *think* mins will ever be 60...
                                if ($mins == 60) {
                                        $mins = 0;
                                        $hours += 1;
                                }
                        }
			$myresult = sql_query("select user_id from nuke_users where (username='$uname')", $dbi);
    			list($uid) = sql_fetch_row($myresult, $dbi);
                        $content .= "<font class=tiny><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=".$uid."\">".$uname."</a>:";
                        if ($dont) {
                                $content .= " ".$days." "._LASTSEENDAYS."";
                        } else {
                                if ($days > 0) {
                                        $content .= " ".$days." "._LASTSEENDAY."".(($hours == 0 && $mins == 0)?(""):(","));
                                }
                                if ($hours > 0) {
                                        $content .= " ".$hours." ".(($hours > 1)?(""._LASTSEENHOURS.""):(""._LASTSEENHOUR."")).(($mins == 0)?(""):(","));
                                }
                                if ($mins > 0) {
                                        $content .= " ".$mins." ".(($mins > 1)?(""._LASTSEENMINUTES.""):(""._LASTSEENMINUTE.""))."";
                                }  else { // less than a minute :)
                                        $content .= " ".$realtime." "._LASTSEENSECONDS."";
                                }
                        }
                        $content .= " "._LASTSEENAGO."</font><br />";
                        $days = 0;
                        $hours = 0;
                        $mins = 0;
                        $dont = false;
                }
        }
        $content .= "</marquee><br />";
?>
