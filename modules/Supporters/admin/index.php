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

global $admin_file, $adveditor, $vers;
$adveditor = 0;
if(!$admin_file OR empty($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { die("Illegal File Access Detected!!"); }

require_once("mainfile.php");
get_lang(Supporters);
$index=1;
$textrowcol = "rows='10' cols='50'";
if($Version_Num > $vers) { $textrowcol = "rows='10' cols='75'"; }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='Supporters'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for($i=0; $i < sizeof($admins); $i++) { if($row2['name'] == "$admins[$i]" AND $row['admins'] != "") { $auth_user = 1; } }
if($row2['radminsuper'] == 1 || $auth_user == 1) {
  include_once("includes/nsnsp_func.php");
  $sp_config = spget_configs();
  $checktime = strtotime(date("Y-m-d", TIME()));
  if($sp_config['version_check'] < $checktime) {
    $errno = 0;
    $errstr = $nsnsp_ver_info = '';
    if ($fsock = @fsockopen('www.nukescripts.net', 80, $errno, $errstr, 10)) {
      @fputs($fsock, "GET /versions/nsnsp.txt HTTP/1.1\r\n");
      @fputs($fsock, "HOST: www.nukescripts.net\r\n");
      @fputs($fsock, "Connection: close\r\n\r\n");
      $get_info = false;
      while (!@feof($fsock)) {
        if ($get_info) {
          $nsnsp_ver_info = @fread($fsock, 1024);
        } else {
          if (@fgets($fsock, 1024) == "\r\n") {
            $get_info = true;
          }
        }
      }
      @fclose($fsock);
      spsave_config('version_check', $checktime);
      spsave_config('version_newest', $nsnsp_ver_info);
    }
  }
  if ($nsnsp_ver_info > $sp_config['version_number']) {  
    $nsnsp_ver = "<tr><td align='center' colspan='2'><strong>"._SP_NEWVER." - ".$nsnsp_ver_info."</strong></td></tr>";
  } else {
    $nsnsp_ver = "<tr><td align='center' colspan='2'><strong><i>"._SP_CURVER."</i></strong></td></tr>";
  }
  switch ($op) {
    case "SPMain":include_once("modules/Supporters/admin/SPMain.php");break;
    case "SPActivate":include_once("modules/Supporters/admin/SPActivate.php");break;
    case "SPActive":include_once("modules/Supporters/admin/SPActive.php");break;
    case "SPAdd":include_once("modules/Supporters/admin/SPAdd.php");break;
    case "SPAddSave":include_once("modules/Supporters/admin/SPAddSave.php");break;
    case "SPApprove":include_once("modules/Supporters/admin/SPApprove.php");break;
    case "SPApproveSave":include_once("modules/Supporters/admin/SPApproveSave.php");break;
    case "SPConfig":include_once("modules/Supporters/admin/SPConfig.php");break;
    case "SPConfigSave":include_once("modules/Supporters/admin/SPConfigSave.php");break;
    case "SPDeactivate":include_once("modules/Supporters/admin/SPDeactivate.php");break;
    case "SPDelete":include_once("modules/Supporters/admin/SPDelete.php");break;
    case "SPDeleteConfirm":include_once("modules/Supporters/admin/SPDeleteConfirm.php");break;
    case "SPEdit":include_once("modules/Supporters/admin/SPEdit.php");break;
    case "SPEditSave":include_once("modules/Supporters/admin/SPEditSave.php");break;
    case "SPInactive":include_once("modules/Supporters/admin/SPInactive.php");break;
    case "SPPending":include_once("modules/Supporters/admin/SPPending.php");break;
  }
} else {
  echo "Access Denined";
}

?>
