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

$lid = intval($lid);
$query1 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_lists WHERE lid='$lid'");
$query2 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_users WHERE lid='$lid'");
$query3 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_issues WHERE lid='$lid'");
$query4 = $db->sql_query("DELETE FROM ".$prefix."_nsnml_tracked WHERE lid='$lid'");
if(!$query1 || !$query2 || !$query3 || !$query4) {
  @include_once("header.php");
  OpenTable();
  $result = $db->sql_error($query);
  echo "<center><strong>".$result['code'].": ".$result['message']."</strong></center>\n";
  CloseTable();
  @include_once("footer.php");
  return;
} else {
  $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_lists");
  $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_users");
  $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_issues");
  $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsnml_tracked");
  header("Location: ".$admin_file.".php?op=MLViewLists");
}

?>