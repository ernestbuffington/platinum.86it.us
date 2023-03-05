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
$query2 = "UPDATE ".$prefix."_nsnml_users SET active='1', act_key='0', joined='".time()."' WHERE email='$email' AND lid='$lid'";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_users WHERE email='$email' AND act_key='$check' AND lid='$lid'");
if ($db->sql_numrows($result) != 1) {
  echo "<center><strong>"._ML_ERROR_SUBLINK."</strong></center>";
} elseif(!$db->sql_query($query2)) {
   $result = $db->sql_error($query);
   echo "<center><strong>".$result['code'].": ".$result['message']."</strong></center>\n";
} else {
  $result = $db->sql_query("SELECT * FROM ".$prefix."_nsnml_lists WHERE lid='$lid'");
  $list_info = $db->sql_fetchrow($result);
  echo "<center><strong>"._ML_MAIN."</strong>: ".$list_info['title']."<br />\n";
  echo "<strong>"._ML_SUBCOMPLETED."</strong></center>";
}
CloseTable();
@include_once("footer.php");

?>