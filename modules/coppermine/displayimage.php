<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.1D for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
/**********************************/
/*  Module Configuration          */
/* (right side on) v3.1           */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
define('INDEX_FILE', true);
$index = 1; 
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('NO_EDITOR', 1);
define('DISPLAYIMAGE_PHP', true);
require("modules/" . $name . "/include/load.inc");
if ($CONFIG['enable_smilies']) require("includes/nbbcode.php");
//if ($CONFIG['enable_smilies']) include_once($CPG_M_DIR . "/include/smilies.inc.php");
$breadcrumb_text = '';
$cat_data = array();
if ($CONFIG['read_exif_data'] && function_exists('exif_read_data')) {
    include_once($CPG_M_DIR . "/include/exif_php.inc");
} elseif ($CONFIG['read_exif_data']) {
    cpg_die(CRITICAL_ERROR, 'PHP running on your server does not support reading EXIF data in JPEG files, please turn this off on the config page', __FILE__, __LINE__);
}
if ($CONFIG['read_iptc_data']) {
    include_once($CPG_M_DIR . "/include/iptc.inc");
}
// Local functions definition  //
// Altered security issue by Pc-Nuke! 12.23.05 -- start //
function html_picture_menu($id)
{
    global $lang_display_image_php, $user, $user, $cookie, $prefix, $user_prefix, $db;
    if (USER_ID or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN){
    return '<div align="center"><a href="'.getlink("&amp;file=editOnePic&amp;id=$id&amp;what=picture").'"><font color=\"#000000\">Edit Picture</font></a> || 
<a href="'.getlink("&amp;file=delete&amp;id=$id&amp;what=picture").'&ampclass="admin_menu" onclick="return confirm(\''.$lang_display_image_php['confirm_del'].'\');"><font color=\"#000000\">Delete Picture</font></a></div>';
}
}
// Altered security issue by Pc-Nuke! 12.23.05 -- end //
// Prints the image-navigation menu
function html_img_nav_menu()
{
    global $CONFIG, $_SERVER,  $CURRENT_PIC_DATA;
    global $meta, $album, $cat, $pos, $pic_count, $lang_img_nav_bar, $template_img_navbar, $lang_errors;
    $cat_link = is_numeric($album) ? '&amp;album='.$album : '&amp;cat=' . $cat;
    $meta_link = ($meta == '') ? '' : '&amp;meta=' . $meta;
    $human_pos = $pos + 1;
    $page = ceil(($pos + 1) / ($CONFIG['thumbrows'] * $CONFIG['thumbcols']));
    $pid = $CURRENT_PIC_DATA['pid'];
    if ($pos > 0) {
        $prev = $pos - 1;
        $prev_tgt = getlink("&amp;file=displayimage$meta_link$cat_link&amp;pos=$prev");
        $prev_title = $lang_img_nav_bar['prev_title'];
    } else {
        $prev_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['no_less_images']) . "');";
        $prev_title = $lang_img_nav_bar['no_less_images'];
    }
    if ($pos < ($pic_count -1)) {
        $next = $pos + 1;
        $next_tgt = getlink("&amp;file=displayimage$meta_link$cat_link&amp;pos=$next");
        $next_title = $lang_img_nav_bar['next_title'];
    } else {
        $next_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['no_more_images']) . "');";
        $next_title = $lang_img_nav_bar['no_more_images'];
    }
    if ((USER_CAN_SEND_ECARDS) && (USER_ID or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN)) {
        $ecard_tgt = getlink("&amp;file=ecard$meta_link$cat_link&amp;pid=$pid&amp;pos=$pos");
        $ecard_title = $lang_img_nav_bar['ecard_title'];
    } else {
        $ecard_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['ecard_disabled_msg']) . "');";
        $ecard_title = $lang_img_nav_bar['ecard_disabled'];
    }
    $thumb_tgt = getlink("&amp;file=thumbnails$meta_link$cat_link&amp;page=$page"); //$cat_link&page=$page
    // Only show the slideshow to registered user, admin, or if admin allows anon access to full size images
    if (USER_ID or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN) {
        $slideshow_tgt = getlink("&amp;file=displayimage$meta_link$cat_link&amp;pid=$pid&amp;slideshow=5000");
        $slideshow_title = $lang_img_nav_bar['slideshow_title'];
    } else {
        $slideshow_tgt = "javascript:alert('" . addslashes($lang_img_nav_bar['slideshow_disabled_msg']) . "');";
        $slideshow_title = $lang_errors['members_only'];
    }
    $pic_pos = sprintf($lang_img_nav_bar['pic_pos'], $human_pos, $pic_count);
    $params = array('{THUMB_TGT}' => $thumb_tgt,
//                '{THUMB_TITLE}' => $lang_img_nav_bar['thumb_title'],
//                '{PIC_INFO_TITLE}' => $lang_img_nav_bar['pic_info_title'],
                '{SLIDESHOW_TGT}' => $slideshow_tgt,
                '{SLIDESHOW_TITLE}' => $slideshow_title,
                '{PIC_POS}' => $pic_pos,
                '{ECARD_TGT}' => $ecard_tgt,
                '{ECARD_TITLE}' => $ecard_title,
                '{PREV_TGT}' => $prev_tgt,
                '{PREV_TITLE}' => $prev_title,
                '{NEXT_TGT}' => $next_tgt,
                '{NEXT_TITLE}' => $next_title,
    );
    return template_eval($template_img_navbar, $params);
}
// Displays a picture
function html_picture()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $USER, $_COOKIE, $CPG_M_DIR;
    global $album, $comment_date_fmt, $template_display_picture;
    global $lang_display_image_php, $lang_picinfo, $lang_config_data, $lang_errors;
    $pid = $CURRENT_PIC_DATA['pid'];
    // $ina is where the Registered Only picture is
    $ina = "$CPG_M_DIR/images/ina.jpg";
    // Check for anon picture viewing - only for registered user, admin, or if admin allows anon access to full size images
    if (USER_ID > 1 or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN) {
        // Add 1 to hit counter unless the user reloaded the page
        if (!isset($USER['liv']) || !is_array($USER['liv'])) {
            $USER['liv'] = array();
        }
        // Add 1 to hit counter
        if ($album != "lasthits" && !in_array($pid, $USER['liv']) && isset($_COOKIE[$CONFIG['cookie_name'] . '_data'])) {
            add_hit($pid);
            if (count($USER['liv']) > 4) array_shift($USER['liv']);
            array_push($USER['liv'], $pid);
        }
        if ($CONFIG['make_intermediate'] && max($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']) > $CONFIG['picture_width']) {
            $picture_url = get_pic_url($CURRENT_PIC_DATA, 'normal');
        } else {
            $picture_url = get_pic_url($CURRENT_PIC_DATA, 'fullsize');
        }
        $picture_menu = ((USER_ADMIN_MODE && $CURRENT_ALBUM_DATA['category'] == FIRST_USER_CAT + USER_ID) || GALLERY_ADMIN_MODE) ? html_picture_menu($pid) : '';
        $image_size = compute_img_size($CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight'], $CONFIG['picture_width']);
        $pic_title = '';
        if ($CURRENT_PIC_DATA['title'] != '') {
            $pic_title .= $CURRENT_PIC_DATA['title'] . "\n";
        }
        if ($CURRENT_PIC_DATA['caption'] != '') {
            $pic_title .= $CURRENT_PIC_DATA['caption'] . "\n";
        }
        if ($CURRENT_PIC_DATA['keywords'] != '') {
            $pic_title .= $lang_picinfo['Keywords'] . ": " . $CURRENT_PIC_DATA['keywords'];
        }
        if (isset($image_size['reduced'])) {
            $CONFIG['justso']=0;
            if ($CONFIG['justso']) {
                //include_once('jspw.js');
                $winsizeX = $CURRENT_PIC_DATA['pwidth']+ 16;
                $winsizeY = $CURRENT_PIC_DATA['pheight']+ 16;
                $hug = 'hug image';
                $hugwidth = '4';
                $bgclr = '#000000';
                $alt = 'Click image to close this window'; // $lang_fullsize_popup[1];
                $pic_html = '<a href="'.getlink("&amp;file=justsofullsize&amp;pid=$pid").'" target="' . uniqid(rand()) . "\" onClick=\"JustSoPicWindow('".getlink("&amp;file=justsofullsize&amp;pid=$pid")."','$winsizeX','$winsizeY','$alt','$bgclr','$hug','$hugwidth');return false\">";
            } else {
                $winsizeX = $CURRENT_PIC_DATA['pwidth'] + 16;
                $winsizeY = $CURRENT_PIC_DATA['pheight'] + 16;
                $pic_html = '<a href="'.getlink("&amp;file=displayimagepopup&amp;pid=$pid&amp;fullsize=1").'" target="' . uniqid(rand()) . "\" onClick=\"MM_openBrWindow('".getlink("&amp;file=displayimagepopup&amp;pid=$pid&amp;fullsize=1")."','" . uniqid(rand()) . "','resizable=yes,scrollbars=yes,width=$winsizeX,height=$winsizeY,left=0,top=0');return false\">"; //toolbar=yes,status=yes,
                $pic_title = $lang_display_image_php['view_fs'] . "\n ============== \n" . $pic_title; //added by gaugau
            }
            $pic_html .= "<img src=\"" . $picture_url . "\" {$image_size['geom']} class=\"image\" border=\"0\" alt=\"{$pic_title}\" title=\"{$pic_title}\" /><br />";
            $pic_html .= "</a>\n";
        } else {
            $pic_html = "<img src=\"" . $picture_url . "\" {$image_size['geom']} alt=\"{$pic_title}\" title=\"{$pic_title}\" class=\"image\" border=\"0\" /><br />\n";
        }
        if (!$CURRENT_PIC_DATA['title'] && !$CURRENT_PIC_DATA['caption']) {
            template_extract_block($template_display_picture, 'img_desc');
        } else {
            if (!$CURRENT_PIC_DATA['title']) {
                template_extract_block($template_display_picture, 'title');
            }
            if (!$CURRENT_PIC_DATA['caption']) {
                template_extract_block($template_display_picture, 'caption');
            }
        }
    } else {
        $imagesize = getimagesize($ina);
        $image_size = compute_img_size($imagesize[0], $imagesize[1], $CONFIG['picture_width']);
        $pic_html = '<a href="' .NEWUSER_URL. '">';
        $pic_html .= "<img src=\"" . $ina . "\" {$image_size['geom']} alt=\"Click to register\" title=\"Click to register\" class=\"image\" border=\"0\" /></a><br />";
        $picture_menu = "";
        $CURRENT_PIC_DATA['title'] = $lang_errors['members_only'];
        $CURRENT_PIC_DATA['caption'] = '';
    }
    $params = array('{CELL_HEIGHT}' => '100',
        '{IMAGE}' => $pic_html,
        '{ADMIN_MENU}' => $picture_menu,
        '{TITLE}' => $CURRENT_PIC_DATA['title'],
        '{CAPTION}' => bb_decode($CURRENT_PIC_DATA['caption']),
    );
    return template_eval($template_display_picture, $params);
}
function html_rating_box()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA;
    global $template_image_rating, $lang_rate_pic;
    if (!(USER_CAN_RATE_PICTURES && $CURRENT_ALBUM_DATA['votes'] == 'YES')) return '';
    $votes = $CURRENT_PIC_DATA['pic_rating'] ? sprintf($lang_rate_pic['rating'], round($CURRENT_PIC_DATA['pic_rating'] / 2000, 1), $CURRENT_PIC_DATA['votes']) : $lang_rate_pic['no_votes'];
    $pid = $CURRENT_PIC_DATA['pid'];
    $params = array(
//        '{TITLE}' => $lang_rate_pic['rate_this_pic'],
        '{VOTES}' => $votes,
        '{RATE0}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=0"),
        '{RATE1}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=1"),
        '{RATE2}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=2"),
        '{RATE3}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=3"),
        '{RATE4}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=4"),
        '{RATE5}' => getlink("&amp;file=ratepic&amp;pic=$pid&amp;rate=5"),
//        '{RUBBISH}' => $lang_rate_pic['rubbish'],
//        '{POOR}' => $lang_rate_pic['poor'],
//        '{FAIR}' => $lang_rate_pic['fair'],
//        '{GOOD}' => $lang_rate_pic['good'],
//        '{EXCELLENT}' => $lang_rate_pic['excellent'],
//        '{GREAT}' => $lang_rate_pic['great'],
    );
    if (USER_ID or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN) {
        return template_eval($template_image_rating, $params);
    }
}
// Display picture information
function html_picinfo()
{
    global $CONFIG, $CURRENT_PIC_DATA, $CURRENT_ALBUM_DATA, $THEME_DIR, $FAVPICS, $CPG_M_DIR;
    global $album, $lang_picinfo, $lang_display_image_php, $lang_byte_units;
    if ($CURRENT_PIC_DATA['owner_id'] && $CURRENT_PIC_DATA['owner_name']) {
        $owner_link = '<a href ="'.getlink('Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $CURRENT_PIC_DATA['owner_id']) . '">' . $CURRENT_PIC_DATA['owner_name'] . '</a> ';
    } else {
        $owner_link = '';
    }
    if (GALLERY_ADMIN_MODE && $CURRENT_PIC_DATA['pic_raw_ip']) {
        if ($CURRENT_PIC_DATA['pic_hdr_ip']) {
            $ipinfo = ' (' . $CURRENT_PIC_DATA['pic_hdr_ip'] . '[' . $CURRENT_PIC_DATA['pic_raw_ip'] . ']) / ';
        } else {
            $ipinfo = ' (' . $CURRENT_PIC_DATA['pic_raw_ip'] . ') / ';
        }
    } else {
        if ($owner_link) {
            $ipinfo = '/ ';
        } else {
            $ipinfo = '';
        }
    }
    if ($CONFIG['picinfo_display_filename']) {
        $info[$lang_picinfo['Filename']] = htmlspecialchars($CURRENT_PIC_DATA['filename']);
    }
    // -----------------------------------------------------------------
    // Added by Vitor Freitas on 2003-09-01.
    // Hack version: 1.1
    // Display the name of the user that upload the image whit the image information.
    // Modified by DJ Maze for CPG 1.2 RC4
    global $db, $field_user_name, $field_user_id, $lastup_date_fmt;
    $vf_sql = "SELECT $field_user_name FROM " . $CONFIG['TABLE_USERS'] . " WHERE $field_user_id='" . $CURRENT_PIC_DATA['owner_id'] . "'";
    $vf_result = $db->sql_query($vf_sql);
    $vf_row = $db->sql_fetchrow($vf_result);
    // if statement added by gtroll
    // only display if there is a value
    if ($vf_row != '') {
        $info['Upload by'] = '<a href="'.getlink('Forums&amp;file=profile&amp;mode=viewprofile&amp;u=' . $CURRENT_PIC_DATA['owner_id']) . '" target="_blank">' . $vf_row[$field_user_name] . '</a>';
		//////Added by PCN www.pcnuke.com//////
		$info['Date Added'] = '' . localised_date($CURRENT_PIC_DATA['ctime'],$lastup_date_fmt). '';
	}
    // End -- Vitor Freitas on 2003-08-29.
    // -----------------------------------------------------------------
    if ($CONFIG['picinfo_display_album_name']) {
        $info[$lang_picinfo['Album name']] = '<span class="alblink"><a href="' . getlink('&amp;file=thumbnails&amp;album=' . $CURRENT_PIC_DATA['aid']) . '">' . $CURRENT_ALBUM_DATA['title'] . '</a></span>';
    }
    if ($CURRENT_PIC_DATA['votes'] > 0) {
        $info[sprintf($lang_picinfo['Rating'], $CURRENT_PIC_DATA['votes'])] = '<img src="' . $CPG_M_DIR . '/images/rating' . round($CURRENT_PIC_DATA['pic_rating'] / 2000) . '.gif" align="absmiddle"/>';
    }
    if ($CURRENT_PIC_DATA['keywords'] != "") {
        $info[$lang_picinfo['Keywords']] = '<span class="alblink">' . preg_replace("/(\S+)/", '<a href="'.getlink('&amp;file=thumbnails&amp;meta=search&amp;search=\\1').'">\\1</a>' , $CURRENT_PIC_DATA['keywords']) . '</span>';
    }
    //$info[test] = "SELECT pid FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON visibility IN (".USER_IN_GROUPS.") WHERE p.pid='".$CURRENT_PIC_DATA['pid']."' GROUP BY pid LIMIT 1";
    for ($i = 1; $i <= 4; $i++) {
        if ($CONFIG['user_field' . $i . '_name']) {
            if ($CURRENT_PIC_DATA['user' . $i] != "") {
                $info[$CONFIG['user_field' . $i . '_name']] = cpg_make_clickable($CURRENT_PIC_DATA['user' . $i]);
            }
        }
    }
    $info[$lang_picinfo['File Size']] = ($CURRENT_PIC_DATA['filesize'] > 10240 ? ($CURRENT_PIC_DATA['filesize'] >> 10) . ' ' . $lang_byte_units[1] : $CURRENT_PIC_DATA['filesize'] . ' ' . $lang_byte_units[0]);
    if ($CONFIG['picinfo_display_file_size']) {
        $info[$lang_picinfo['File Size']] = '<span dir="LTR">' . $info[$lang_picinfo['File Size']] . '</span>';
    }
    if ($CONFIG['picinfo_display_dimensions']) {
        $info[$lang_picinfo['Dimensions']] = sprintf($lang_display_image_php['size'], $CURRENT_PIC_DATA['pwidth'], $CURRENT_PIC_DATA['pheight']);
    }
    if ($CONFIG['picinfo_display_dimensions']) {
        $info[$lang_picinfo['Displayed']] = sprintf($lang_display_image_php['views'], $CURRENT_PIC_DATA['hits']);
    }
    $path_to_pic = $CURRENT_PIC_DATA['filepath'] . $CURRENT_PIC_DATA['filename'];
    if ($CONFIG['read_exif_data'])
    {
       ///BEGIN(bugfix): EXIF data wasn't stored into the database - diegocr
       $exifdatatable = $CONFIG['TABLE_PREFIX']."exif";
       if( get_magic_quotes_gpc() )
          $sqlfilename = $path_to_pic;
       else
          $sqlfilename = addslashes($path_to_pic);
       $sql = "SELECT exifData FROM ".$exifdatatable." WHERE filename='" . $sqlfilename . "'";
       $result = $db->sql_query($sql);
       if(($row = $db->sql_fetchrow($result)))
       {
          $exifDataFound = true;
          $exif = unserialize($row['exifData']);
          if(!is_array($exif))
             $exif = '';
       }
       if(empty($exif))
       {
          $exif = exif_parse_file($path_to_pic);
          if(is_array($exif))
          {
             $exif_str = serialize($exif);
             if( ! get_magic_quotes_gpc() )
                $exif_str = addslashes($exif_str);
             // [XXX]: hmm...
             if( $exifDataFound == true )
             {
                $db->sql_query("UPDATE ".$exifdatatable." SET exifData='$exif_str' WHERE filename='$sqlfilename'");
             }
             else
             {
                $db->sql_query("INSERT INTO ".$exifdatatable." VALUES('$sqlfilename','$exif_str')");
             }
          }
       }
       ///END(bugfix): EXIF data wasn't stored into the database - diegocr
    }
    if (isset($exif) && is_array($exif)) {
        if (isset($exif['Camera'])) $info[$lang_picinfo['Camera']] = $exif['Camera'];
        if (isset($exif['DateTaken'])) $info[$lang_picinfo['Date taken']] = $exif['DateTaken'];
        if (isset($exif['Aperture'])) $info[$lang_picinfo['Aperture']] = $exif['Aperture'];
        if (isset($exif['ExposureTime'])) $info[$lang_picinfo['Exposure time']] = $exif['ExposureTime'];
        if (isset($exif['FocalLength'])) $info[$lang_picinfo['Focal length']] = $exif['FocalLength'];
        if (isset($exif['Comment'])) $info[$lang_picinfo['Comment']] = $exif['Comment'];
    }
    // Create the absolute URL for display in info
    if (($CONFIG['picinfo_display_URL']) || ($CONFIG['picinfo_display_URL_bookmark'])) {
        if ($CONFIG['picinfo_display_URL_bookmark']) {
            $info["URL"] = '<a href="'.$CONFIG["ecards_more_pic_target"].getlink("&amp;file=displayimage&amp;album=$CURRENT_PIC_DATA[aid]&amp;pos=$CURRENT_PIC_DATA[pid]").'" onClick="addBookmark(\''.$CURRENT_PIC_DATA["filename"].'\',\''.$CONFIG["ecards_more_pic_target"].getlink("&amp;file=displayimage&amp;album={$CURRENT_PIC_DATA['aid']}&amp;pos={$CURRENT_PIC_DATA['pid']}")."');return false\">{$lang_picinfo['bookmark_page']}</a>";
        } else {
            $info['URL'] = '<a href="'.$CONFIG["ecards_more_pic_target"].getlink("&amp;file=displayimage&amp;album=$CURRENT_PIC_DATA[aid]&amp;pos=$CURRENT_PIC_DATA[pid]").'">'.$CONFIG["ecards_more_pic_target"].getlink("&amp;file=displayimage&amp;album=$CURRENT_PIC_DATA[aid]&amp;pos=$CURRENT_PIC_DATA[pid]").'</a>';
        }
    }
    if ($CONFIG['read_iptc_data']) $iptc = get_IPTC($path_to_pic);
    if (isset($iptc) && is_array($iptc)) {
        if (isset($iptc['Title'])) $info[$lang_picinfo['iptcTitle']] = trim($iptc['Title']);
        if (isset($iptc['Copyright'])) $info[$lang_picinfo['iptcCopyright']] = trim($iptc['Copyright']);
        if (isset($iptc['Keywords'])) $info[$lang_picinfo['iptcKeywords']] = trim(implode(" ",$iptc['Keywords']));
        if (isset($iptc['Category'])) $info[$lang_picinfo['iptcCategory']] = trim($iptc['Category']);
        if (isset($iptc['SubCategories'])) $info[$lang_picinfo['iptcSubCategories']] = trim(implode(" ",$iptc['SubCategories']));
    }
    // with subdomains the variable is $_SERVER["SERVER_NAME"] does not return the right value instead of using a new config variable I reused $CONFIG["ecards_more_pic_target"] with trailing slash in the configure
    // Create the add to fav link
    if ($CONFIG['picinfo_display_favorites']) {
        if (!in_array($CURRENT_PIC_DATA['pid'], $FAVPICS)) {
            $info[$lang_picinfo['addFavPhrase']] = '<a href="' . getlink('&amp;file=addfav&amp;pid=' . $CURRENT_PIC_DATA['pid']) . '" >' . $lang_picinfo['addFav'] . '</a>';
        } else {
            $info[$lang_picinfo['addFavPhrase']] = '<a href="' . getlink('&amp;file=addfav&amp;pid=' . $CURRENT_PIC_DATA['pid']) . '" >' . $lang_picinfo['remFav'] . '</a>';
        }
    }
    if (USER_ID or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN) {
        return theme_html_picinfo($info);
    }
}
// Displays comments for a specific picture
function html_comments($pid)
{
    global $CONFIG, $USER, $CURRENT_ALBUM_DATA, $comment_date_fmt, $HTML_SUBST, $username;
    global $template_image_comments, $template_add_your_comment, $lang_display_comments;
    $html = '';
    if (!$CONFIG['enable_smilies']) {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_no_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_smilies');
        template_extract_block($template_add_your_comment, 'input_box_smilies');
    } else {
        $tmpl_comment_edit_box = template_extract_block($template_image_comments, 'edit_box_smilies', '{EDIT}');
        template_extract_block($template_image_comments, 'edit_box_no_smilies');
        template_extract_block($template_add_your_comment, 'input_box_no_smilies');
    }
    $tmpl_comments_buttons = template_extract_block($template_image_comments, 'buttons', '{BUTTONS}');
    $tmpl_comments_ipinfo = template_extract_block($template_image_comments, 'ipinfo', '{IPINFO}');
    $result = db_query("SELECT msg_id, msg_author, msg_body, UNIX_TIMESTAMP(msg_date) AS msg_date, author_id, author_md5_id, msg_raw_ip, msg_hdr_ip FROM {$CONFIG['TABLE_COMMENTS']} WHERE pid='$pid' ORDER BY msg_id ASC");
    while ($row = mysql_fetch_array($result)) {
        $user_can_edit = (GALLERY_ADMIN_MODE) || (USER_ID > 1 && USER_ID == $row['author_id'] && USER_CAN_POST_COMMENTS) || (USER_ID < 2 && USER_CAN_POST_COMMENTS && ($USER['ID'] == $row['author_md5_id']));
		if (USER_ID == 1){
		$comment_buttons = '';
		}else{
		    $comment_buttons = $user_can_edit ? $tmpl_comments_buttons : '';
		}
		$comment_edit_box = $user_can_edit ? $tmpl_comment_edit_box : '';
        $comment_ipinfo = ($row['msg_raw_ip'] && GALLERY_ADMIN_MODE)?$tmpl_comments_ipinfo : '';
        if ($CONFIG['enable_smilies']) {
            $comment_body = set_smilies(cpg_make_clickable($row['msg_body']));
            $smilies = smilies_table('onerow', 'msg_body', "f{$row['msg_id']}");
//            $comment_body = process_smilies(cpg_make_clickable($row['msg_body']));
//            $smilies = generate_smilies("f{$row['msg_id']}", 'msg_body');
        } else {
            $comment_body = cpg_make_clickable($row['msg_body']);
            $smilies = '';
        }
        $params = array('{EDIT}' => &$comment_edit_box,
            '{BUTTONS}' => &$comment_buttons,
            '{IPINFO}' => &$comment_ipinfo
        );
        $template = template_eval($template_image_comments, $params);
        $params = array('{MSG_AUTHOR}' => $row['msg_author'],
            '{MSG_ID}' => $row['msg_id'],
            '{EDIT_TITLE}' => &$lang_display_comments['edit_title'],
            '{CONFIRM_DELETE}' => &$lang_display_comments['confirm_delete'],
            '{MSG_DATE}' => localised_date($row['msg_date'], $comment_date_fmt),
            '{MSG_BODY}' => &$comment_body,
            '{MSG_BODY_RAW}' => $row['msg_body'],
            '{OK}' => &$lang_display_comments['OK'],
            '{SMILIES}' => $smilies,
            '{HDR_IP}' => $row['msg_hdr_ip'],
            '{RAW_IP}' => $row['msg_raw_ip'],
        );
        $html .= template_eval($template, $params);
    }
    if (USER_CAN_POST_COMMENTS && $CURRENT_ALBUM_DATA['comments'] == 'YES') {
        if (USER_ID > 1) {
            $username_input = '<input type="hidden" name="msg_author" value="' . CPG_USERNAME . '">';
            template_extract_block($template_add_your_comment, 'username_input', $username_input);
            // $username = '';
        } else {
            $username = isset($USER['name']) ? '"' . strtr($USER['name'], $HTML_SUBST) . '"' : '"' . $lang_display_comments['your_name'] . '" onClick="javascript:this.value=\'\';"';
        }
        $params = array('{ADD_YOUR_COMMENT}' => $lang_display_comments['add_your_comment'],
            // Modified Name and comment field
            '{NAME}' => $lang_display_comments['name'],
            '{COMMENT}' => $lang_display_comments['comment'],
            '{PIC_ID}' => $pid,
            '{username}' => $username,
            '{MAX_COM_LENGTH}' => $CONFIG['max_com_size'],
            '{OK}' => $lang_display_comments['OK'],
            '{SMILIES}' => '',
        );
        if ($CONFIG['enable_smilies']) $params['{SMILIES}'] = smilies_table('onerow', 'message', 'post');
//        if ($CONFIG['enable_smilies']) $params['{SMILIES}'] = generate_smilies();
        $html .= template_eval($template_add_your_comment, $params);
    }
    if (USER_ID > 1 or $CONFIG['allow_anon_fullsize'] or USER_IS_ADMIN) {
        return $html;
    }
}
function slideshow()
{
    global $CONFIG,  $lang_display_image_php, $template_display_picture, $CPG_M_DIR;
    if (function_exists('theme_slideshow')) {
        theme_slideshow();
        return;
    }
    pageheader($lang_display_image_php['slideshow']);
    include_once($CPG_M_DIR."/include/slideshow.inc");
    $start_slideshow = '<script language="JavaScript" type="text/JavaScript">runSlideShow()</script>';
    template_extract_block($template_display_picture, 'img_desc', $start_slideshow);
    $params = array('{CELL_HEIGHT}' => $CONFIG['picture_width'] + 100,
        '{IMAGE}' => '<img src="' . $start_img . '" name="SlideShow" class="image" /><br />',
        '{ADMIN_MENU}' => '',
    );
    starttable();
    echo template_eval($template_display_picture, $params);
    endtable();
    starttable();
    echo <<<EOT
        <tr>
        <td align="center" class="navmenu" style="white-space: nowrap;">
        <a href="javascript:endSlideShow()" class="navmenu">{$lang_display_image_php['stop_slideshow']}</a>
        </td>
        </tr>
EOT;
    endtable();
    pagefooter();
}
/**
 * Main code
 */
global $lang_list_categories;
$pos = isset($_GET['pos']) ? intval($_GET['pos']) : 0;
$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
$meta = isset($_GET['meta']) ? $_GET['meta'] : '';
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : '';
// $thisalbum is passed to get_pic_data as a varible used in queries 
// to limit meta queries to the current album or category
$thisalbum = "category >= '0'";//just something that is true
if ($meta != '') {
    if ($album != '') {
        $cat = -$album;
    }
    $album = $meta;
}
if ($cat<0) { //  && $cat<0 Meta albums, we need to restrict the albums to the current category
    $actual_album = -$cat;
    $thisalbum = 'a.aid = '.$actual_album;
}
else if ($cat){
    if ($cat == USER_GAL_CAT) {
        $thisalbum = 'category > ' . FIRST_USER_CAT;
    } elseif ($meta != '' && is_numeric($cat)) {
        if ($cat > 0) $thisalbum = "category = '$cat'";
    } else if (is_numeric($album)) {
        $thisalbum= "a.aid = $album";
    }
} else if (is_numeric($album)) {
    $thisalbum= "a.aid = $album";
}
// END NEW
// Retrieve data for the current picture
if ($meta == 'random' || ($meta == '' && !is_numeric($album)) || $pid > 0 || $pos < 0) {
    if ($pid < 1) $pid = $pos;
    if ($pos < 0) $pid = -$pos;
    // modified by DJMaze
    $result = db_query("SELECT p.aid FROM {$CONFIG['TABLE_PICTURES']} AS p INNER JOIN {$CONFIG['TABLE_ALBUMS']} ON (".VIS_GROUPS.") WHERE approved = 'YES' AND p.pid=".$pid." LIMIT 1");
    //this doesn't work
    if (mysql_num_rows($result) == 0) {
        cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    }
    $row = mysql_fetch_array($result);
    // this doesn't work either
    if ($row[0] == ''){
          cpg_die(ERROR, $lang_errors['members_only']);
    }
    $album = $row['aid'];
    mysql_free_result($result); //added by gtroll
    $pic_data = get_pic_data('', $album, $pic_count, $album_name, -1, -1, false);
    for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
    $pic_data = get_pic_data('', $album, $pic_count, $album_name, $pos, 1, false);
    $CURRENT_PIC_DATA = $pic_data[0];
} else if (isset($_GET['pos'])){
    $pic_data = get_pic_data($meta, $album, $pic_count, $album_name, $pos, 1, false);
    if ($pic_count == 0) {
        cpg_die(INFORMATION, $lang_errors['members_only'], __FILE__, __LINE__);
    }
    elseif (count($pic_data) == 0 && $pos >= $pic_count) {
        $pos = $pic_count - 1;
        $human_pos = $pos + 1;
        $pic_data = get_pic_data($meta, $album, $pic_count, $album_name, $pos, 1, false);
    }
    $CURRENT_PIC_DATA = $pic_data[0];
    if ($pic_count == 0) {
        cpg_die(INFORMATION, $lang_errors['members_only'], __FILE__, __LINE__);
    }
}
// Retrieve data for the current album
if (isset($CURRENT_PIC_DATA)) {
    $result = db_query("SELECT title, comments, votes, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE aid='{$CURRENT_PIC_DATA['aid']}' LIMIT 1");
    if (!mysql_num_rows($result)) cpg_die(CRITICAL_ERROR, sprintf($lang_errors['pic_in_invalid_album'], $CURRENT_PIC_DATA['aid']), __FILE__, __LINE__);
    $CURRENT_ALBUM_DATA = mysql_fetch_array($result);
}
// slideshow control
if (isset($_GET['slideshow'])) {
    slideshow();
} else {
//    if (!isset($_GET['pos'])) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
    $picture_title = $CURRENT_PIC_DATA['title'] ? $CURRENT_PIC_DATA['title'] : strtr(preg_replace("/(.+)\..*?\Z/", "\\1", htmlspecialchars($CURRENT_PIC_DATA['filename'])), "_", " ");
    $nav_menu = html_img_nav_menu();
    $picture = html_picture();
    $votes = html_rating_box();
    $pic_info = html_picinfo();
    $comments = html_comments($CURRENT_PIC_DATA['pid']);
    pageheader($album_name . '/' . $picture_title, '', false);
    // Display Breadcrumbs
    set_breadcrumb(0);
    // Display Filmstrip if the album is not search
    if ($album != 'search') {
        $film_strip = display_film_strip($meta, $album, (isset($cat) ? $cat : 0), $pos, true);
    }
    theme_display_image($nav_menu, $picture, $votes, $pic_info, $comments, $film_strip); //,
    // strpos ( string haystack, string needle [, int offset])
    $mpl=$CONFIG['main_page_layout'];
    if (strpos("$mpl","anycontent")=== true) {
        include_once("$CPG_M_DIR/anycontent.php");
    }
    pagefooter();
}
?>
