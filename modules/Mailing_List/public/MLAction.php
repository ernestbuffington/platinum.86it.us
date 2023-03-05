<?php

/********************************************************/
/* NSN Mailing List                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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

$pagetitle = " - "._ML_TITLE." ".$ml_config['version_number'];
@include_once("header.php");
title(_ML_TITLE." ".$ml_config['version_number']);
OpenTable();
if (!preg_match("/@/", $email)) {
  echo "<center><strong>"._ML_ERROR_INVALID."</strong></center><br />";
  echo "<center>"._GOBACK."</center>";
} elseif($sub == 'sub') {
  $mid = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE email='$email' AND lid='$lid'"));
  if($mid > 0) {
    echo "<center><strong>"._ML_ERROR_ALREADY."</strong></center><br />";
    echo "<center>"._GOBACK."</center>";
  } else {
    srand ((double)microtime()*1000000);
    $mycode = rand();
    $joined = time();
    $query = "INSERT INTO ".$prefix."_nsnml_users VALUES (NULL, '$lid', '$email', '0', '$type', '$mycode', '$joined')";
    if(!$db->sql_query($query)) {
      $result = $db->sql_error($query);
      echo "<center><strong>".$result['code'].": ".$result['message']."</strong></center>\n";
    } else {
      $buildlink = "$nukeurl/modules.php?name=$module_name&op=MLActivate&email=$email&lid=$lid&check=$mycode";
      mail($email, _ML_SUBSCRIPTION, _ML_CONFIGTEXT."\n\n$buildlink", "From: $adminmail");
      echo "<center><strong>"._ML_CONFIRSENT."</strong></center><br />";
      echo "<center>"._GOBACK."</center>";
    }
  }
} elseif($sub == 'unsub') {
  $mid = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE email='$email' AND lid='$lid'"));
  if($mid < 1) {
    echo "<center><strong>"._ML_ERROR_NOTSUB."</strong></center><br />";
    echo "<center>"._GOBACK."</center>";
  } else {
    list($mid) = $db->sql_fetchrow($db->sql_query("SELECT mid FROM ".$prefix."_nsnml_users WHERE email='$email' AND lid='$lid'"));
    $query1 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_users WHERE email='$email' AND lid='$lid'");
    $query2 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_tracked WHERE mid='$mid' AND lid='$lid'");
    if(!$query1 || !$query2) {
      $result1 = $db->sql_error($query1);
      echo "<center><strong>".$result1['code'].": ".$result1['message']."</strong></center>\n";
      $result2 = $db->sql_error($query2);
      echo "<center><strong>".$result2['code'].": ".$result2['message']."</strong></center>\n";
    } else {
      $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_users");
      $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_tracked");
      echo "<center><strong>"._ML_SUBEND."</strong></center><br />";
      echo "<center>"._GOBACK."</center>";
    }
  }
}
CloseTable();
@include_once("footer.php");

?>