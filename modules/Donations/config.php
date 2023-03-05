<?php
/************************************************************************/
/* NukeTreasury - Financial management for PHP-Nuke                      */
/* Copyright (c) 2004 by Dave Lawrence AKA Thrash                       */
/*                       thrash@fragnastika.com                         */
/*                       thrashn8r@hotmail.com                          */
/*                                                                      */
/* This program is free software; you can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* This program is distributed in the hope that it will be useful, but  */
/* WITHOUT ANY WARRANTY; without even the implied warranty of           */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU     */
/* General Public License for more details.                             */
/*                                                                      */
/* You should have received a copy of the GNU General Public License    */
/* along with this program; if not, write to the Free Software          */
/* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307  */
/* USA                                                                  */
/************************************************************************/

//$paypalUrl = "https://www.paypal.com/cgi-bin/webscr";
$paypalUrl = "https://www.sandbox.paypal.com";  //no trailing slash

global $db, $prefix, $dbhost, $dbname, $dbuname, $dbpass;

// used for IPN validation check
if (!isset($db))
{
	include("../../../config.php");
	include("../../../db/db.php");
}

$board_config = array();

	$query_cfg = "SELECT * FROM ".$prefix."_don_config WHERE subtype = ''";
	$cfgset = $db->sql_query($query_cfg) or die(mysqli_error($db));

	while ( $cfgset && $row = $db->sql_fetchrow($cfgset))
	{
			$tr_config[$row['name']] = $row['value'];
	}
?>