<?php 
/****************************************************************************/
/* Coppermine Photo Gallery 1.2.3 for CMS                                   */
/****************************************************************************/
/****************************************************************************/
/* Port Copyright (C) 2004 Coppermine for CMS Dev Team                      */
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
/*   $Id: picmgmt.inc,v 1.2 2004/05/08 18:58:53 gtroll Exp $          */
/****************************************************************************/
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
// Add a picture to an album
function add_picture($aid, $filepath, $filename, $title = '', $caption = '', $keywords = '', $user1 = '', $user2 = '', $user3 = '', $user4 = '', $category = 0, $raw_ip = '', $hdr_ip = '')
{
    global $CONFIG, $ERROR, $USER_DATA, $PIC_NEED_APPROVAL, $CPG_M_DIR;
    global $lang_errors, $username;
    $image = $filepath . $filename;
    $normal = $filepath . $CONFIG['normal_pfx'] . $filename;
    $thumb = $filepath . $CONFIG['thumb_pfx'] . $filename; 
    // $image = $CPG_M_DIR."/albums/$image";
    // $normal = $CPG_M_DIR."/albums/$normal";
    // $thumb = $CPG_M_DIR."/albums/$thumb";
    $imagesize = getimagesize($image);
    if (!file_exists($thumb))
        if (!resize_image($image, $thumb, $CONFIG['thumb_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use']))
            return false;
    if (max($imagesize[0], $imagesize[1]) > $CONFIG['picture_width'] && $CONFIG['make_intermediate'] && !file_exists($normal))
        if (!resize_image($image, $normal, $CONFIG['picture_width'], $CONFIG['thumb_method'], $CONFIG['thumb_use']))
            return false;
    $image_filesize = filesize($image);
    $total_filesize = $image_filesize + (file_exists($normal) ? filesize($normal) : 0) + filesize($thumb);
    // Test if disk quota exceeded
    if (!GALLERY_ADMIN_MODE && $USER_DATA['group_quota']) {
        $result = db_query("SELECT sum(total_filesize) FROM {$CONFIG['TABLE_PICTURES']}, {$CONFIG['TABLE_ALBUMS']} WHERE  {$CONFIG['TABLE_PICTURES']}.aid = {$CONFIG['TABLE_ALBUMS']}.aid AND category = '" . (FIRST_USER_CAT + USER_ID) . "'");
        $record = mysql_fetch_array($result);
        $total_space_used = $record[0];
        mysql_free_result($result);
        if ($total_space_used + $total_filesize > $USER_DATA['group_quota'] << 10) {
            @unlink($image);
            @unlink($normal);
            @unlink($thumb);
            $msg = strtr($lang_errors['quota_exceeded'], array('[quota]' => ($USER_DATA['group_quota']),
                            '[space]' => ($total_space_used >> 10)));
            cpg_die(ERROR, $msg, __FILE__, __LINE__);
        }
    }
    // Test if picture requires approval
    if (GALLERY_ADMIN_MODE || defined('BATCH_MODE')) {
        $approved = 'YES';
    } elseif (!$USER_DATA['priv_upl_need_approval'] && $category == FIRST_USER_CAT + USER_ID) {
        $approved = 'YES';
    } elseif (!$USER_DATA['pub_upl_need_approval']) {
        $approved = 'YES';
    } else {
        $approved = 'NO';
    }
    $PIC_NEED_APPROVAL = ($approved == 'NO');
    // User ID is not recorded when in admin mode (ie. for batch uploads)
    $user_id = GALLERY_ADMIN_MODE ? 0 : USER_ID;
    $query = "INSERT INTO {$CONFIG['TABLE_PICTURES']} (pid, aid, filepath, filename, filesize, total_filesize, pwidth, pheight, ctime, owner_id, title, caption, keywords, approved, user1, user2, user3, user4, pic_raw_ip, pic_hdr_ip) VALUES ('', '$aid', '" . addslashes($filepath) . "', '" . addslashes($filename) . "', '$image_filesize', '$total_filesize', '{$imagesize[0]}', '{$imagesize[1]}', '" . time() . "', '" . USER_ID . "', '$title', '$caption', '$keywords', '$approved', '$user1', '$user2', '$user3', '$user4', '$raw_ip', '$hdr_ip')";
    $result = db_query($query);
    speedup_pictures();
    return $result;
}
define("GIS_GIF", 1);
define("GIS_JPG", 2);
define("GIS_PNG", 3);
/**
 * resize_image()
 *
 * Create a file containing a resized image
 *
 * @param  $src_file the source file
 * @param  $dest_file the destination file
 * @param  $new_size the size of the square within which the new image must fit
 * @param  $method the method used for image resizing
 * @return 'true' in case of success
*/
function resize_image($src_file, $dest_file, $new_size, $method, $thumb_use, $imginfo='', $DoDestCheck=true)
{
    global $CONFIG, $ERROR;
    global $lang_errors;
    if($imginfo == '')
       $imginfo = getimagesize($src_file);
    if ($imginfo == null)
        return false;
    // Check for GIF create support >= GD v2.0.28
    $gifsupport = 0;
    if ($method == 'gd2') {
        $gdinfo = gd_info();
        $gifsupport = $gdinfo["GIF Create Support"];
    }
    // GD can only handle JPG & PNG images
    if ($imginfo[2] != GIS_JPG && $imginfo[2] != GIS_PNG && ($method == 'gd1' || ($method == 'gd2' && !$gifsupport))) {
        $ERROR = $lang_errors['gd_file_type_err'];
        return false;
    }
    // height/width
    $srcWidth = $imginfo[0];
    $srcHeight = $imginfo[1];
    if ($thumb_use == 'ht') {
        $ratio = $srcHeight / $new_size;
    } elseif ($thumb_use == 'wd') {
        $ratio = $srcWidth / $new_size;
    } else {
        $ratio = max($srcWidth, $srcHeight) / $new_size;
    }
    $ratio = max($ratio, 1.0);
    $destWidth = (int)($srcWidth / $ratio);
    $destHeight = (int)($srcHeight / $ratio);
    // try to get more memory for executing large pictures -> DJMaze
    //ini_set("memory_limit", "32M");
	//Updated memory_limit check (fix by Diego Casorran)
	if(intval(ini_get('memory_limit')) < 32)
    ini_set("memory_limit", "32M");
    // Method for thumbnails creation
    $CONFIG['jpeg_qual'] = intval($CONFIG['jpeg_qual']);
    $im_options = escapeshellarg($CONFIG['im_options']);
    switch ($method) {
        case "im" :
            if (preg_match("#[A-Z]:|\\\\#Ai", __FILE__)) {
                // get the basedir, remove '/include'
                $cur_dir = "";
                $src_file = '"' . strtr($src_file, '/', '\\') . '"';
                $im_dest_file = str_replace('%', '%%', ('"' . strtr($dest_file, '/', '\\') . '"'));
            } else {
                $src_file = escapeshellarg($src_file);
                $im_dest_file = str_replace('%', '%%', escapeshellarg($dest_file));
            }
            //"
            $output = array();
            $cmd = "{$CONFIG['impath']}convert -quality {$CONFIG['jpeg_qual']} $im_options -geometry {$destWidth}x{$destHeight} $src_file $im_dest_file";
            exec ($cmd, $output, $retval);
            if ($retval) {
                $ERROR = "Error executing ImageMagick - Return value: $retval";
                if ($CONFIG['debug_mode']) {
                    // Re-execute the command with the backtit operator in order to get all outputs
                    // will not work is safe mode is enabled
                    $output = `$cmd 2>&1`;
                    $ERROR .= "<br /><br /><div align=\"left\">Cmd line : <br /><font size=\"2\">" . nl2br(htmlspecialchars($cmd)) . "</font></div>";
                    $ERROR .= "<br /><br /><div align=\"left\">The convert program said:<br /><font size=\"2\">";
                    $ERROR .= nl2br(htmlspecialchars($output));
                    $ERROR .= "</font></div>";
                }
                @unlink($dest_file);
                return false;
            }
            break;
 case "netpbm" :
        if (preg_match("#[A-Z]:|\\\\#Ai",__FILE__)){
            // get the basedir, remove '/include'
            $cur_dir = substr(dirname(__FILE__),0, -8);
            $src_file =   '"'.$cur_dir.'\\'.strtr($src_file, '/', '\\').'"';
            $im_dest_file = str_replace('%', '%%', ('"'.$cur_dir.'\\'.strtr($dest_file, '/', '\\').'"'));
        } else {
            $src_file =   escapeshellarg($src_file);
            $im_dest_file = str_replace('%', '%%', escapeshellarg($dest_file));
        }
           switch ($imginfo[2]){
        case GIS_GIF:
            $op_in   = 'giftopnm';
            $op_out = 'ppmtogif';
            $cmd = "{$CONFIG['impath']}{$op_in} $src_file | pnmscale -xsize={$destWidth} -ysize={$destHeight} | ppmquant 255 | {$op_out} > $dest_file";
            break;
        case GIS_JPG:
            $op_in   = 'jpegtopnm';
            $op_out = 'pnmtojpeg';
            $op_out2 = 'ppmtojpeg';
            $cmd = "{$CONFIG['impath']}{$op_in} $src_file | pnmscale -xsize={$destWidth} -ysize={$destHeight} | {$op_out} -quality={$CONFIG['jpeg_qual']} > $dest_file";
            $cmd2 = "{$CONFIG['impath']}{$op_in} $src_file | pnmscale -xsize={$destWidth} -ysize={$destHeight} | {$op_out2} -quality={$CONFIG['jpeg_qual']} > $dest_file";
            break;
        case GIS_PNG:
            $op_in   = 'pngtopnm';
            $op_out = 'pnmtopng';
            $cmd = "{$CONFIG['impath']}{$op_in} $src_file | pnmscale -xsize={$destWidth} -ysize={$destHeight} | {$op_out} > $dest_file";
            break;
    }
        $output = array();
        echo $cmd;
        if(!(@exec ($cmd)) && isset($cmd2)) @exec ($cmd2);
        break;
        case "gd1" :
            if (!function_exists('imagecreatefromjpeg')) {
                cpg_die(CRITICAL_ERROR, 'PHP running on your server does not support the GD image library, check with your webhost if ImageMagick is installed', __FILE__, __LINE__);
            }
            if ($imginfo[2] == GIS_JPG)
                $src_img = imagecreatefromjpeg($src_file);
            else
                $src_img = imagecreatefrompng($src_file);
            if (!$src_img) {
                $ERROR = $lang_errors['invalid_image'];
                return false;
            }
            $dst_img = imagecreate($destWidth, $destHeight);
            imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
            imagejpeg($dst_img, $dest_file, $CONFIG['jpeg_qual']);
            imagedestroy($src_img);
            imagedestroy($dst_img);
            break;
        case "gd2" :
            if (!function_exists('imagecreatefromjpeg')) {
                cpg_die(CRITICAL_ERROR, 'PHP running on your server does not support the GD image library, check with your webhost if ImageMagick is installed', __FILE__, __LINE__);
            }
            if (!function_exists('imagecreatetruecolor')) {
                cpg_die(CRITICAL_ERROR, 'PHP running on your server does not support GD version 2.x, please switch to GD version 1.x on the config page', __FILE__, __LINE__);
            }
            if ($imginfo[2] == GIS_JPG)
                $src_img = imagecreatefromjpeg($src_file);
            else if ($imginfo[2] == GIS_GIF && $gifsupport)
                $src_img = imagecreatefromgif($src_file);
            else
                $src_img = imagecreatefrompng($src_file);
            if (!$src_img) {
                $ERROR = $lang_errors['invalid_image'];
                return false;
            }
            $dst_img = imagecreatetruecolor($destWidth, $destHeight);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
            imagejpeg($dst_img, $dest_file, $CONFIG['jpeg_qual']);
            imagedestroy($src_img);
            imagedestroy($dst_img);
            break;
    }
    // Set mode of uploaded picture
    chmod($dest_file, octdec($CONFIG['default_file_mode']));
    if( $DoDestCheck == true )
    {
       // We check that the image is valid
       $imginfo = getimagesize($dest_file);
       if ($imginfo == null) {
           $ERROR = $lang_errors['resize_failed'];
           @unlink($dest_file);
           return false;
       }
    }
    return true;
}
?>
