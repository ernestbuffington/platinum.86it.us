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
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
define('THUMBNAILS_PHP', true);
define('INDEX_PHP', true);
require("modules/" . $name . "/include/load.inc");
if (isset($_GET['sort'])) $USER['sort'] = $_GET['sort'];
if (isset($_GET['uid'])) $USER['uid'] = (int)$_GET['uid'];
if (isset($_GET['search'])) {
    $USER['search'] = $_GET['search'];
    if (isset($_GET['type']) && $_GET['type'] == 'full') {
        $USER['search'] = '###' . $USER['search'];
    } 
} 
if (!isset($page)) $page = 1;
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
$meta = isset($_GET['meta']) ? $_GET['meta'] : '';
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;
if ($meta != '') {
    if ($album != '') {
        $thisalbum = "a.aid = $album";
    } elseif ($cat == 0) {
        $thisalbum = "a.category >= 0";
    } else {
        if ($cat == 1) $thisalbum = "a.category > ".FIRST_USER_CAT;
        else $thisalbum = "a.category = $cat";
    }
} else {
    $thisalbum = "a.category = cat";
}
pageheader(isset($CURRENT_ALBUM_DATA) ? $CURRENT_ALBUM_DATA['description'] : $lang_meta_album_names[$album]);
set_breadcrumb(!is_numeric($album));
display_thumbnails($meta, $album, $cat, $page, $CONFIG['thumbcols'], $CONFIG['thumbrows'], true);
// strpos ( string haystack, string needle [, int offset])
$mpl=$CONFIG['main_page_layout'];
if (strpos("$mpl","anycontent")=== true) {
    include_once("$CPG_M_DIR/anycontent.php");
}
pagefooter();
?>
