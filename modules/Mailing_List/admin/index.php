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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $admin_file;

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='$module_name'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
$module_name="Mailing_List";
get_lang($module_name);
$ml_config = mlget_configs();

switch($op) {

  case 'MLAddBanner':@include_once("modules/$module_name/admin/MLAddBanner.php");break;
  case 'MLAddIssue':@include_once("modules/$module_name/admin/MLAddIssue.php");break;
  case 'MLAddList':@include_once("modules/$module_name/admin/MLAddList.php");break;
  case 'MLAddStory':@include_once("modules/$module_name/admin/MLAddStory.php");break;
  case 'MLAdmin':@include_once("modules/$module_name/admin/MLAdmin.php");break;
  case 'MLConfig':@include_once("modules/$module_name/admin/MLConfig.php");break;
  case 'MLConfigSave':@include_once("modules/$module_name/admin/MLConfigSave.php");break;
  case 'MLCreate':@include_once("modules/$module_name/admin/MLCreate.php");break;
  case 'MLDeleteList':@include_once("modules/$module_name/admin/MLDeleteList.php");break;
  case 'MLDeleteListSave':@include_once("modules/$module_name/admin/MLDeleteListSave.php");break;
  case 'MLEditList':@include_once("modules/$module_name/admin/MLEditList.php");break;
  case 'MLEditListSave':@include_once("modules/$module_name/admin/MLEditListSave.php");break;
  case 'MLSend':@include_once("modules/$module_name/admin/MLSend.php");break;
  case 'MLViewIssue':@include_once("modules/$module_name/admin/MLViewIssue.php");break;
  case 'MLViewIssues':@include_once("modules/$module_name/admin/MLViewIssues.php");break;
  case 'MLViewListIssues':@include_once("modules/$module_name/admin/MLViewListIssues.php");break;
  case 'MLViewLists':@include_once("modules/$module_name/admin/MLViewLists.php");break;
  case 'MLViewListSubscribers':@include_once("modules/$module_name/admin/MLViewListSubscribers.php");break;
  case 'MLViewSent':@include_once("modules/$module_name/admin/MLViewSent.php");break;
  case 'MLViewSubscribers':@include_once("modules/$module_name/admin/MLViewSubscribers.php");break;

}

} else {
    echo "Access Denied";
}

?>
