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

global $admin_file;
if(!$admin_file OR empty($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { die("Illegal File Access Detected!!"); }
$modname = basename(str_replace("/admin", "", dirname(__FILE__)));
get_lang($modname);
switch ($op) {
  case "SP2Main":
  case "SP2Activate":
  case "SP2Active":
  case "SP2Add":
  case "SP2AddSave":
  case "SP2Approve":
  case "SP2ApproveSave":
  case "SP2Config":
  case "SP2ConfigSave":
  case "SP2Deactivate":
  case "SP2Delete":
  case "SP2DeleteConfirm":
  case "SP2Edit":
  case "SP2EditSave":
  case "SP2Inactive":
  case "SP2Pending":
  include_once("modules/Supporters_2/admin/index.php");
  break;
}

?>
