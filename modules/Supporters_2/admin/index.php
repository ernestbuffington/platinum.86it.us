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

global $admin_file, $adveditor, $vers;
$adveditor = 0;
if(!$admin_file OR empty($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { die("Illegal File Access Detected!!"); }

require_once("mainfile.php");
get_lang(Supporters_2);
$index=1;
$textrowcol = "rows='10' cols='50'";
if($Version_Num > $vers) { $textrowcol = "rows='10' cols='75'"; }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT `title`, `admins` FROM `".$prefix."_modules` WHERE `title`='Supporters_2'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT `name`, `radminsuper` FROM `".$prefix."_authors` WHERE `aid`='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for($i=0; $i < sizeof($admins); $i++) { if($row2['name'] == "$admins[$i]" AND $row['admins'] != "") { $auth_user = 1; } }
if($row2['radminsuper'] == 1 || $auth_user == 1) {
  include_once("includes/nsnsp2_func.php");
  $sp_config = spget_configs();
  $checktime = strtotime(date("Y-m-d", TIME()));
/*
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
    $nsnsp_ver = "<tr><td align='center' colspan='2'><strong>"._SP2_NEWVER." - ".$nsnsp_ver_info."</strong></td></tr>";
  } else {
      $nsnsp_ver = "<tr><td align='center' colspan='2'><strong><i>"._SP2_CURVER."</i></strong></td></tr>";
  }*/
  switch ($op) {
    case "SP2Main":include_once("modules/Supporters_2/admin/SP2Main.php");break;
    case "SP2Activate":include_once("modules/Supporters_2/admin/SP2Activate.php");break;
    case "SP2Active":include_once("modules/Supporters_2/admin/SP2Active.php");break;
    case "SP2Add":include_once("modules/Supporters_2/admin/SP2Add.php");break;
    case "SP2AddSave":include_once("modules/Supporters_2/admin/SP2AddSave.php");break;
    case "SP2Approve":include_once("modules/Supporters_2/admin/SP2Approve.php");break;
    case "SP2ApproveSave":include_once("modules/Supporters_2/admin/SP2ApproveSave.php");break;
    case "SP2Config":include_once("modules/Supporters_2/admin/SP2Config.php");break;
    case "SP2ConfigSave":include_once("modules/Supporters_2/admin/SP2ConfigSave.php");break;
    case "SP2Deactivate":include_once("modules/Supporters_2/admin/SP2Deactivate.php");break;
    case "SP2Delete":include_once("modules/Supporters_2/admin/SP2Delete.php");break;
    case "SP2DeleteConfirm":include_once("modules/Supporters_2/admin/SP2DeleteConfirm.php");break;
    case "SP2Edit":include_once("modules/Supporters_2/admin/SP2Edit.php");break;
    case "SP2EditSave":include_once("modules/Supporters_2/admin/SP2EditSave.php");break;
    case "SP2Inactive":include_once("modules/Supporters_2/admin/SP2Inactive.php");break;
    case "SP2Pending":include_once("modules/Supporters_2/admin/SP2Pending.php");break;
  }
} else {
  echo "Access Denined";
}

?>