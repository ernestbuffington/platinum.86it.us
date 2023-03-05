<?php

/********************************************************/
/* NSN Mailing List                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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

$pagetitle = " - "._ML_ADMIN." ".$ml_config['version_number'];
include_once("header.php");
title(_ML_ADMIN." ".$ml_config['version_number']);
ML_Admin();
echo "<br />\n";
OpenTable();
$query = "INSERT ".$prefix."_nsnml_issues VALUES (NULL, '$lid', '".addslashes($sub)."', '".addslashes($text)."', '".addslashes($htmltext)."', '".time()."')";
if(!$db->sql_query($query)) {
  $result = $db->sql_error($query);
  echo "<center><strong>".$result['code'].": ".$result['message']."</strong></center>\n";
  CloseTable();
  include_once("footer.php");
  return;
}
$nid = $db->sql_nextid();
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE active='1' AND lid='$lid'");
$count=0;
while ($user_info = $db->sql_fetchrow($result)) {
  if ($user_info['html'] == '0') {
    mail($user_info['email'], stripslashes($sub), stripslashes(strip_tags($text)), "From: $adminmail");
  } else {
    if(strlen($htmltext) > 1) {
      mail($user_info['email'], stripslashes($sub), stripslashes($htmltext), "From: $adminmail\r\nContent-Type: text/html; charset=iso-8859-1");
    } else {
      mail($user_info['email'], stripslashes($sub), stripslashes(strip_tags($text)), "From: $adminmail");
    }
  }
  $count++;
  $query = "INSERT ".$prefix."_nsnml_tracked SET mid='".$user_info['mid']."', nid='$nid', lid='$lid', sent='".time()."'";
  if(!$db->sql_query($query)) {
     $result = $db->sql_error($query);
     echo "<center><strong>".$result['code'].": ".$result['message']."</strong></center>\n";
     CloseTable();
     include_once("footer.php");
     return;
  }
}
echo "<center><strong>$count "._ML_SENT."</strong></center><br />\n";
echo "<center>"._GOBACK."</center>\n";
CloseTable();
include_once("footer.php");

?>
