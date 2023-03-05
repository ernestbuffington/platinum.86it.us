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
if (preg_match("#modules/#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
define('SHOWTHUMB_PHP', true);
define('NO_HEADER', true);
require("modules/" . $name . "/include/load.inc");
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
define("UNKNOW_ICON", $CPG_M_DIR . '/images/unk48x48.gif');
define("GIF_ICON", $CPG_M_DIR . '/images/gif48x48.gif');
define("READ_ERROR_ICON", $CPG_M_DIR . '/images/read_error48x48.gif');
function makethumbnail($src_file, $newSize, $method)
{
    global $CONFIG;
    $content_type = array(
        GIS_GIF => 'gif',
        GIS_JPG => 'jpeg',
        GIS_PNG => 'png'
        );
    // Checks that file exists and is readable
    if (!filesize($src_file) || !is_readable($src_file)) {
        header("Content-type: image/gif");
        fpassthru(fopen(READ_ERROR_ICON, 'rb'));
        exit;
    }
    // find the image size, no size => unknow type
    $imginfo = getimagesize($src_file);
    if ($imginfo == null) {
        header("Content-type: image/gif");
        fpassthru(fopen(UNKNOW_ICON, 'rb'));
        exit;
    }
    // Check for GIF create support >= GD v2.0.28
    $gifsupport = 0;
    if ($method == 'gd2') {
        $gdinfo = gd_info();
        $gifsupport = $gdinfo["GIF Create Support"];
	   }
    // GD can't handle gif images
    if ($imginfo[2] == GIS_GIF && ($method == 'gd1' || ($method == 'gd2' && !$gifsupport))) {
        header("Content-type: image/gif");
        fpassthru(fopen(GIF_ICON, 'rb'));
        exit;
    }
    // height/width
    $srcWidth = $imginfo[0];
    $srcHeight = $imginfo[1];
    $ratio = max($srcWidth, $srcHeight) / $newSize;
    $ratio = max($ratio, 1.0);
    $destWidth = (int)($srcWidth / $ratio);
    $destHeight = (int)($srcHeight / $ratio); 
    // Choose method for thumb creation
    switch ($method) {
        case "im" :
            if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
                $cur_dir = dirname(__FILE__);
                $src_file = '"' . $cur_dir . '\\' . strtr($src_file, '/', '\\') . '"';
            } else {
                $src_file = escapeshellarg($src_file);
            } 
            header("Content-type: image/" . ($content_type[$imginfo[2]]));
            passthru("{$CONFIG['impath']}convert -quality $CONFIG[jpeg_qual] -antialias -geometry {$destWidth}x{$destHeight} $src_file -");
            break;
        case "gd2" :
            if ($imginfo[2] == GIS_JPG)
                $src_img = imagecreatefromjpeg($src_file);
            else if ($imginfo[2] == GIS_GIF && $gifsupport)
                $src_img = imagecreatefromgif($src_file);
            else
                $src_img = imagecreatefrompng($src_file);
            $dst_img = imagecreatetruecolor($destWidth, $destHeight);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
            header("Content-type: image/jpeg");
            imagejpeg($dst_img);
            imagedestroy($src_img);
            imagedestroy($dst_img);
            break;
        default :
            if ($imginfo[2] == GIS_JPG)
                $src_img = imagecreatefromjpeg($src_file);
            else
                $src_img = imagecreatefrompng($src_file);
            $dst_img = imagecreate($destWidth, $destHeight);
            imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
            header("Content-type: image/jpeg");
            imagejpeg($dst_img);
            imagedestroy($src_img);
            imagedestroy($dst_img);
            break;
    } 
} 
makethumbnail($CONFIG['fullpath'] . $_GET['picfile'], $_GET['size'], $CONFIG['thumb_method']);
?>
