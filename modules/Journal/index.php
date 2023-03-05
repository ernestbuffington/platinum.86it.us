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

    require_once("mainfile.php");

    $module_name = basename(dirname(__FILE__));

    get_lang($module_name);

    $pagetitle = "- "._USERSJOURNAL."";

    include_once("header.php");

    include_once("modules/Journal/functions.php");

    if (is_user($user)) {

        cookiedecode($user);

        $username = $cookie[1];

        $username = check_html($username, "nohtml");

    }

    $user = check_html($user, "nohtml");

    $sitename = check_html($sitename, "nohtml");

    startjournal($sitename, $user);

    function last20($bgcolor1, $bgcolor2, $bgcolor3, $username) {

        global $prefix, $user_prefix, $db, $module_name;

        OpenTable();

        echo ("<div align=\"center\" class=title>"._20ACTIVE."</div><br />");

        echo ("<table align=center border=1 cellpadding=0 cellspacing=0>");

        echo ("<tr>");

        echo ("<td bgcolor=$bgcolor1 width=150>&nbsp;<strong>"._MEMBER."</strong> "._CLICKTOVIEW."</td>");

        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._VIEWJOURNAL."</strong></td>");

        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._MEMBERPROFILE."</strong></td>");

        if (empty($username)) {

            echo "<td bgcolor=$bgcolor1 width=70 align=center><strong>"._CREATEACCOUNT2."</strong></td>";

        } else {

            if (is_active("Private_Messages")) {

                echo "<td bgcolor=$bgcolor1 width=70 align=center><strong>"._PRIVMSGJ."</strong></td>";

            }

        }

        echo "</tr>";

	$sql = "SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id, u.username FROM ".$prefix."_journal_stats j, ".$user_prefix."_users u where u.username=j.joid ORDER BY 'ldp' DESC";

        $result = $db->sql_query($sql);

        $dcount = 1;

        while ($row = $db->sql_fetchrow($result)) {

            $row['id'] = intval($row['id']);

            $row['joid'] = check_html($row['joid'], "nohtml");

            $row['nop'] = check_html($row['nop'], "nohtml");

            $row['ldp'] = check_html($row['ldp'], "nohtml");

            $row['ltp'] = check_html($row['ltp'], "nohtml");

            $row['micro'] = check_html($row['micro'], "nohtml");

            $row['user_id'] = check_html($row['user_id'], "nohtml");

            if ($dcount >= 21) {

                echo "</table>";

                CloseTable();

                journalfoot();

                die();

            } else {

                $dcount = $dcount + 1;

                print ("<tr>");

                printf ("<td bgcolor=$bgcolor2>&nbsp;&nbsp;<a href=\"modules.php?name=Journal&file=search&bywhat=aid&exact=1&forwhat=%s\">%s</a></td>", $row['joid'], $row['joid']);

                printf ("<td bgcolor=$bgcolor2 align=center><div class=title><a href=\"modules.php?name=Journal&file=search&bywhat=aid&exact=1&forwhat=%s\"><img src=\"modules/Journal/images/binocs.gif\" border=0 alt=\""._VIEWJOURNAL2."\" title=\""._VIEWJOURNAL2."\"></a></td>", $row['joid'], $row['joid']);

                printf ("<td bgcolor=$bgcolor2 align=center><a href=\"modules.php?name=Your_Account&op=userinfo&username=%s\"><img src=\"modules/Journal/images/nuke.gif\" alt=\""._USERPROFILE2."\" title=\""._USERPROFILE2."\" border=0></a></td>", $row['joid'], $row['joid'], $row['joid']);

                if (empty($username)) {

                    print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"modules/Journal/images/folder.gif\" border=0 alt=\""._CREATEACCOUNT."\" title=\""._CREATEACCOUNT."\"></a></td>");

                } else {

                    if (is_active("Private_Messages")) {

                        printf ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Private_Messages&mode=post&u=".$row['user_id']."\"><img src='modules/Journal/images/chat.gif' border='0' alt='"._PRIVMSGJ2."'></a></td>", $row['joid'], $row['joid']);

                    }

                }

                echo "</tr>";

            }

        }

        echo "</table>";

        CloseTable();

    }

    function all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username) {

        global $prefix, $user_prefix, $db, $module_name;

        OpenTable();

        echo ("<div align=\"center\" class=title>"._ALPHABETICAL."</div><br />");

        echo ("<table align=center border=1 cellpadding=0 cellspacing=0>");

        echo ("<tr>");

        echo ("<td bgcolor=$bgcolor1 width=150>&nbsp;<strong>"._MEMBER."</strong> "._CLICKTOVIEW."</td>");

        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._VIEWJOURNAL."</strong></td>");

        echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._MEMBERPROFILE."</strong></td>");

        if (empty($username)) {

            echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._CREATEACCOUNT2."</strong></td>");

        } else {

            echo ("<td bgcolor=$bgcolor1 width=70 align=center><strong>"._PRIVMSGJ."</strong></td>");

        }

        echo ("</tr>");

	$sql = "SELECT j.id, j.joid, j.nop, j.ldp, j.ltp, j.micro, u.user_id FROM ".$prefix."_journal_stats j, ".$user_prefix."_users u where u.username=j.joid ORDER BY 'joid'";

        $result = $db->sql_query($sql);

        while ($row = $db->sql_fetchrow($result)) {

            $row['id'] = intval($row['id']);

            $row['joid'] = check_html($row['joid'], "nohtml");

            $row['nop'] = check_html($row['nop'], "nohtml");

            $row['ldp'] = check_html($row['ldp'], "nohtml");

            $row['ltp'] = check_html($row['ltp'], "nohtml");

            $row['micro'] = check_html($row['micro'], "nohtml");

            $row['user_id'] = check_html($row['user_id'], "nohtml");

            print ("<tr>");

            printf ("<td bgcolor=$bgcolor2>&nbsp;&nbsp;<a href=\"modules.php?name=Journal&file=search&bywhat=aid&forwhat=%s\">%s</a></td>", $row['joid'], $row['joid']);

            printf ("<td bgcolor=$bgcolor2 align=center><div class=title><a href=\"modules.php?name=Journal&file=search&bywhat=aid&forwhat=%s\"><img src=\"modules/Journal/images/binocs.gif\" border=0 alt=\""._VIEWJOURNAL2."\" title=\""._VIEWJOURNAL2."\"></a></td>", $row['joid'], $row['joid']);

            printf ("<td bgcolor=$bgcolor2 align=center><a href=\"modules.php?name=Your_Account&op=userinfo&username=%s\"><img src=\"modules/Journal/images/nuke.gif\" alt=\""._USERPROFILE2."\" title=\""._USERPROFILE2."\" border=0></a></td>", $row['joid'], $row['joid'], $row['joid']);

            if (empty($username)) {

                print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"modules/Journal/images/folder.gif\" border=0 alt=\""._CREATEACCOUNT."\" title=\""._CREATEACCOUNT."\"></a></td>");

            } elseif (!empty($username) AND is_active("Private_Messages")) {

                print ("<td align=center bgcolor=$bgcolor2><a href=\"modules.php?name=Private_Messages&mode=post&u=".$row['user_id']."\"><img src='modules/Journal/images/chat.gif' border='0' alt='"._PRIVMSGJ2."'></a></td>");

            }

            echo "</tr>";

        }

        echo "</table>";

        CloseTable();

    }

    echo "<br />";

    OpenTable();

    echo ("<div align=center> [ <a href=\"modules.php?name=Journal&op=last\">"._20AUTHORS."</a> | <a href=\"modules.php?name=Journal&op=all\">"._LISTALLJOURNALS."</a> | <a href=\"modules.php?name=Journal&file=search&disp=showsearch\">"._SEARCHMEMBER."</a> ]</div>");

    CloseTable();

    echo "<br />";

    switch($op) {

        case "last":

        last20($bgcolor1, $bgcolor2, $bgcolor3, $username);

        break;

        case "all":

        all($bgcolor1, $bgcolor2, $bgcolor3, $sitename, $username);

        break;

        default:

        last20($bgcolor1, $bgcolor2, $bgcolor3, $username);

        break;

    }

    journalfoot();



?>
