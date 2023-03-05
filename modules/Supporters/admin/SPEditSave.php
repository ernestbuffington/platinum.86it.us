<?php

/********************************************************/
/* NukeSupporters(tm)                                   */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
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

$site_name = strip_tags($site_name);
$site_name = htmlspecialchars($site_name, ENT_QUOTES);
$site_name = stripslashes($site_name);
$site_description = strip_tags($site_description);
$site_description = htmlspecialchars($site_description, ENT_QUOTES);
$site_description = stripslashes($site_description);
$site_id = intval($site_id);
$oid = str_pad($site_id, 6, "0", STR_PAD_LEFT);
$newimage_name = $_FILES['new_image']['name'];
$newimage_temp = $_FILES['new_image']['tmp_name'];
if($newimage_name != "") {
  $ext = substr($newimage_name, strrpos($newimage_name,'.'), 5);
  if(move_uploaded_file($newimage_temp, "modules/Supporters/images/supporters/$oid$ext")) {
    chmod ("modules/Supporters/images/supporters/$oid$ext", 0777);
    $imgurl = "modules/Supporters/images/supporters/$oid$ext";
  } else {
    include_once("header.php");
    OpenTable();
    echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once("footer.php");
    die();
  }
} else {
  $imgurl = $old_image;
}
$user_id = intval($user_id);
if(!get_magic_quotes_runtime()) {
  $site_name = addslashes($site_name);
  $site_url = addslashes($site_url);
  $site_description = addslashes($site_description);
  $user_name = addslashes($user_name);
  $user_email = addslashes($user_email);
  $imgurl = addslashes($imgurl);
}
$result = $db->sql_query("UPDATE `".$prefix."_nsnsp_sites` SET `site_name`='$site_name', `site_url`='$site_url', `site_image`='$imgurl', `site_date`='$site_date', `site_description`='$site_description', `user_name`='$user_name', `user_email`='$user_email' where `site_id`='$site_id'");
Header("Location: $comefrom");

?>
