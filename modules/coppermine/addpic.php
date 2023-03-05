<?php
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1c for CMS     2007.09.05                   //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>              //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.pcnuke.com                                                    //
// Website for Port Upgrades from 1.3.0 and up...                           //
// ------------------------------------------------------------------------ //
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
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('ADDPIC_PHP', true);
define('NO_HEADER', true);
require("modules/" . $name . "/include/load.inc");
require($CPG_M_DIR . '/include/picmgmt.inc');
// if (!GALLERY_ADMIN_MODE) die('Access denied');
$aid = (int)$_GET['aid'];
$pic_file = $CONFIG['fullpath'] . base64_decode($_GET['pic_file']);
$dir_name = dirname($pic_file) . "/";
$file_name = basename($pic_file);
$sql = "SELECT pid " . "FROM {$CONFIG['TABLE_PICTURES']} " . "WHERE filepath='" . addslashes($dir_name) . "' AND filename='" . addslashes($file_name) . "' " . "LIMIT 1";
$result = db_query($sql);
//Slow the batch adding down a little for fast connections.
// 5 = 5 seconds, change to meet your need. Tested in IE 7
sleep(5);
define('BATCH_MODE', true);
if (mysql_num_rows($result)) {
    $file_name = $CPG_M_DIR . "/images/up_dup.gif";
} elseif (add_picture($aid, $dir_name, $file_name)) {
    $file_name = $CPG_M_DIR . "/images/up_ok.gif";
} else {
    $file_name = $CPG_M_DIR . "/images/up_pb.gif";
    echo $ERROR;
} 
if (ob_get_length()) {
    exit;
} 
header('Content-type: image/gif');
echo fread(fopen($file_name, 'rb'), filesize($file_name));
?>
