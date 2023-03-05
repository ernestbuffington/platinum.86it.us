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
require_once('mainfile.php');

$index = 1;
    cookiedecode($user);
    $sender_name = $cookie[1];
    if ($sender_name == "") {
        $sender_name = "Anonymous";
    }
include_once("header.php");
title("$sitename: Ban Request");
OpenTable();

echo "<form method=\"POST\" action=\"modules.php?name=Ban_Request&file=submitform\">";
echo "  <p align=\"left\"><strong>Username / IP [if guest]:<br />";
echo "  <input type=\"text\" name=\"uname\" size=\"20\"><br />";

echo "  Reason for ban:<br />";
echo "  <textarea rows=\"4\" name=\"reason\" cols=\"48\"></textarea></strong><br />";
echo "  <input type=\"submit\" value=\"Submit\" name=\"B1\"></p>";
echo "  <input type=\"hidden\" name=\"staffname\" value=".$sender_name.">";
echo "</form>";
echo "<p align=\"left\">&nbsp;</p>";

CloseTable();
include_once("footer.php");
?>
