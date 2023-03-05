<?php

/********************************************************/

/* Site Credits Module for PHP-Nuke                     */

/* Version 1.0.1         4-03-04                        */

/* By: Telli (telli@codezwiz.com)                       */

/* http://codezwiz.com/                                 */

/* Copyright © 2000-2004 by Codezwiz                    */

/********************************************************/
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



function Showcredits($credit_id) {

    global $bgcolor2, $prefix, $db, $module_name;

    $credit_id = intval($credit_id);

    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"

	."<tr bgcolor=\"$bgcolor2\"><td width='15%' align='center'><font class=\"content\">"._MOD_NAME."</font></td><td width='70%' align='center'><font class=\"content\">"._MOD_DESCRIPTION."</font></td><td width='15%' align='center'><font class=\"content\">"._MOD_AUTHOR."</font></td></tr></table>";

    $sql = "SELECT * FROM ".$prefix."_credits ORDER BY credit_id ASC";

    $result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result)) {

    $credit_id = $row[credit_id];

    $credit_name = $row[credit_name];

    $credit_description = $row[credit_description];

    $credit_author = $row[credit_author];

    $credit_link = $row[credit_link]; 

    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"0\" border=\"0\">"

      ."<tr><td colspan=3><hr></td></tr>"

      ."<tr><td width='15%' valign='top' align='center'><font class=\"content\"><strong>$credit_name</strong></font></td>"

	."<td width='70%' valign='top'><font class=\"content\"><strong>$credit_description</strong></font></td>"

      ."<td width='15%' valign='top' align='center'><strong><a href='$credit_link'>$credit_author</a></strong></td></tr>"; 



   }

 

    echo "<tr><td colspan=3><hr></td></tr></table>";

    if (is_admin($admin)) { 

    echo "<center>"._ADMINLINK."</center>"; 

 

    }

	

}

    include_once("header.php");

    OpenTable();

    echo "<center><font class=\"title\"><strong>$sitename "._CREDITS."</strong></font></center>";

    CloseTable();

    echo "<br>";

    OpenTable();

    Showcredits($credit_id);

    CloseTable();

    include_once("footer.php");

?>

