<?php
/********************************************************/
/* NSN Supporters_2(TM) Universal                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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
if(($site_name=="")OR($site_url=="")OR($site_description=="")) {
  include_once("header.php");
  OpenTable();
  echo "<center><strong>"._SP2_MISSINGDATA."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once("footer.php");
  die();
}
if($supporter_config['image_type']==0) {
  $imgurl = $site_image;
} else {
  list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `".$prefix."_nsnsp_2_sites`"));
  if($newest_oid == "-1") { $new_oid = 1; } else { $new_oid = $newest_oid+1; }
  $oid = str_pad($new_oid, 6, "0", STR_PAD_LEFT);
  $imageurl_name = $_FILES['site_image']['name'];
  $imageurl_temp = $_FILES['site_image']['tmp_name'];
  $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
  if(move_uploaded_file($imageurl_temp, "modules/Supporters_2/images/supporters/$oid$ext")) {
    chmod ("modules/Supporters_2/images/supporters/$oid$ext", 0777);
    $imgurl = "modules/Supporters_2/images/supporters/$oid$ext";
  } else {
    include_once("header.php");
    title(_SP2_CONFBANN);
    OpenTable();
    echo "<center><strong>"._SP2_NOUPLOAD."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once("footer.php");
    die();
  }
}
list($user_id) = $db->sql_fetchrow($db->sql_query("SELECT `user_id` FROM `".$user_prefix."_users` WHERE `username`='$user_name'"));
$user_id = intval($user_id);
if(!get_magic_quotes_runtime()) {
  $site_name = addslashes($site_name);
  $site_url = addslashes($site_url);
  $site_description = addslashes($site_description);
  $user_name = addslashes($user_name);
  $user_email = addslashes($user_email);
  $imgurl = addslashes($imgurl);
}
$result = $db->sql_query("INSERT INTO `".$prefix."_nsnsp_2_sites` values (NULL, '$site_name', '$site_url', '$imgurl', '1', '0', now(), '$site_description', '$user_id', '$user_name', '$user_email', '$user_ip')");
if(!$result) {
  include_once("header.php");
  OpenTable();
  echo "<center><strong>"._SP2_DBERROR1."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once("footer.php");
  die();
}
Header("Location: ".$admin_file.".php?op=SP2Main");

?>