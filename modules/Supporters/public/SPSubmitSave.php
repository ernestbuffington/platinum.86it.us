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

if($sp_config['require_user'] == 0 || is_user($user)) {
  $site_name = strip_tags($site_name);
  $site_name = htmlspecialchars($site_name, ENT_QUOTES);
  $site_name = stripslashes($site_name);
  $site_description = strip_tags($site_description);
  $site_description = htmlspecialchars($site_description, ENT_QUOTES);
  $site_description = stripslashes($site_description);
  if(($site_name=="")OR($site_url=="")OR($site_description=="")) {
    include_once("header.php");
    OpenTable();
    echo "<center><strong>"._SP_MISSINGDATA."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once("footer.php");
    die();
  }
  $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
  if(!in_array($ext,$limitedext)) {
    include_once("header.php");
    OpenTable();
    echo "<center><strong>"._SP_BADEXT."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once("footer.php");
    die();
  }
  if($sp_config['image_type']==0) {
    $imgurl = $site_image;
  } else {
    list($newest_oid) = $db->sql_fetchrow($db->sql_query("SELECT max(`site_id`) AS newest_oid FROM `".$prefix."_nsnsp_sites`"));
    if($newest_oid == "-1") { $new_oid = 1; } else { $new_oid = $newest_oid+1; }
    $oid = str_pad($new_oid, 6, "0", STR_PAD_LEFT);
    $imageurl_name = $_FILES['site_image']['name'];
    $imageurl_temp = $_FILES['site_image']['tmp_name'];
    $ext = substr($imageurl_name, strrpos($imageurl_name,'.'), 5);
    if(move_uploaded_file($imageurl_temp, "modules/$module_name/images/supporters/$oid$ext")) {
      chmod ("modules/$module_name/images/supporters/$oid$ext", 0777);
      $imgurl = "modules/$module_name/images/supporters/$oid$ext";
    } else {
      include_once("header.php");
      title(_SP_CONFBANN);
      OpenTable();
      echo "<center><strong>"._SP_NOUPLOAD."</strong></center><br />\n";
      echo "<center>"._GOBACK."</center>";
      CloseTable();
      include_once("footer.php");
      die();
    }
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
  $result = $db->sql_query("INSERT INTO `".$prefix."_nsnsp_sites` values (NULL, '$site_name', '$site_url', '$imgurl', '0', '0', now(), '$site_description', '$user_id', '$user_name', '$user_email', '$user_ip')");
  if(!$result) {
    include_once("header.php");
    OpenTable();
    echo "<center><strong>"._SP_DBERROR1."</strong></center><br />\n";
    echo "<center>"._GOBACK."</center>\n";
    CloseTable();
    include_once("footer.php");
    die();
  } else {
    $msg = "$sitename "._SP_ADDED."\n\n";
    $msg .= _SP_NAME.": ".stripslashes($site_name)."\n";
    $msg .= _SP_URL.": ".stripslashes($site_url)."\n";
    $msg .= _SP_IMAGE.": ".stripslashes($imgurl)."\n";
    $msg .= _SP_DESCRIPTION.": ".stripslashes($site_description)."\n";
    $msg .= _SP_USERID.": $user_id\n";
    $msg .= _SP_USERNAME.": ".stripslashes($user_name)."\n";
    $msg .= _SP_USEREMAIL.": ".stripslashes($user_email)."\n";
    $msg .= _SP_USERIP.": $user_ip\n";
    $to = $adminmail;
    $subject = "$sitename - "._SP_ADDED;
    $mailheaders = "From: $adminmail\r\n";
    $mailheaders .= "Reply-To: $adminmail\r\n";
    $mailheaders .= "Return-Path: $adminmail\r\n";
    mail($to, $subject, $msg, $mailheaders);
  }
  Header("Location: $comefrom");
} else {
  header("Location: modules.php?name=$module_name");
}

?>