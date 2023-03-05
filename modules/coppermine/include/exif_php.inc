<?php 
/****************************************************************************/
/* Coppermine Photo Gallery 1.2.3 for CMS                                   */
/****************************************************************************/
/****************************************************************************/
/* Port Copyright (C) 2004 Coppermine for CMS Dev Team  		            */
/* http://coppermine.findhere.org/                                          */
/* Based on coppermine 1.1d by Surf  http://www.surf4all.net/               */
/****************************************************************************/
/* Updated by the Coppermine Dev Team  2003                                 */
/* (http://coppermine.sf.net/team/)                                         */
/* see /docs/credits.html for details                                       */
/****************************************************************************/
/* Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               */
/* http://www.chezgreg.net/coppermine/                                      */
/* This program is free software; you can redistribute it and/or modify     */
/* it under the terms of the GNU General Public License as published by     */
/* the Free Software Foundation; either version 2 of the License, or        */
/* (at your option) any later version.                                      */
/****************************************************************************/
/*   $Id: exif_php.inc,v 1.1 2004/05/05 09:04:56 djmaze Exp $          */
/****************************************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
define("EXIF_CACHE_FILE", "exif.dat");
function exif_parse_fracval($val, &$num, &$den)
{
    $num = intval(strtok($val, "/"));
    $den = intval(strtok("/"));
} 
function exif_load_from_cache($filepath)
{
    $dir = dirname($filepath);
    $file = basename($filepath);
    if (!is_readable($dir . "/" . EXIF_CACHE_FILE)) return false;
    $exifDataArray = unserialize(fread(fopen($dir . "/" . EXIF_CACHE_FILE, 'rb'), filesize($dir . "/" . EXIF_CACHE_FILE)));
    return $exifDataArray[$file];
} 
function exif_save_to_cache($exifData, $filepath)
{
    $dir = dirname($filepath);
    $file = basename($filepath);
    if (!is_writable($dir)) return false;
    if (is_readable($dir . "/" . EXIF_CACHE_FILE))
        $exifDataArray = unserialize(fread(fopen($dir . "/" . EXIF_CACHE_FILE, 'rb'), filesize($dir . "/" . EXIF_CACHE_FILE)));
    $exifDataArray[$file] = $exifData;
    fwrite(fopen($dir . "/" . EXIF_CACHE_FILE, 'wb'), serialize($exifDataArray));
} 
function exif_parse_file($filename)
{
    if (!is_readable($filename)) return false;
    $size = @getimagesize($filename);
    if ($size[2] != 2) return false; // Not a JPEG file
    $exif = exif_read_data($filename, 0, true);
    if (!$exif) return false;
    $exifParsed = array();
    $Make = isset($exif['IFD0']['Make']);
    $Model = isset($exif['IFD0']['Model']);
    if (isset($exif['IFD0']['Make']) && isset($exif['IFD0']['Model']))
        $exifParsed['Camera'] = $exif['IFD0']['Make'] . " - " . $exif['IFD0']['Model'];
    if (isset($exif['EXIF']['DateTimeDigitized']))
        $exifParsed['DateTaken'] = $exif['EXIF']['DateTimeDigitized'];
    if (isset($exif['EXIF']['FNumber'])) {
        exif_parse_fracval($exif['EXIF']['FNumber'], $num, $den);
        $exifParsed['Aperture'] = "f/" . $num / ($den ? $den : 1);
    } elseif (isset($exif['COMPUTED']['ApertureFNumber']))
        $exifParsed['Aperture'] = $exif['COMPUTED']['ApertureFNumber'];
    if (isset($exif['COMPUTED']['ExposureTime']))
        $exifParsed['ExposureTime'] = $exif['COMPUTED']['ExposureTime'];
    elseif (isset($exif['EXIF']['ExposureTime'])) {
        exif_parse_fracval($exif['EXIF']['ExposureTime'], $num, $den);
        $exTime = $num / ($den ? $den : 1);
        if ($exTime <= 0.5)
            $exifParsed['ExposureTime'] = sprintf("%0.3f s (1/%d)", $exTime, 1 / $exTime);
        else
            $exifParsed['ExposureTime'] = sprintf("%3.2f s", $exTime);
    } 
    if (isset($exif['EXIF']['FocalLength'])) {
        exif_parse_fracval($exif['EXIF']['FocalLength'], $num, $den);
        $exifParsed['FocalLength'] = sprintf("%d mm", $num / ($den ? $den : 1));
    } 
    if (isset($exif['COMMENT'])) {
        $exifParsed['Comment'] = '';
        foreach ($exif['COMMENT'] as $comment)
        $exifParsed['Comment'] .= ($exifParsed['Comment'] ? '<br />' : '') . $comment;
    } 
    return $exifParsed;
} 
?>
