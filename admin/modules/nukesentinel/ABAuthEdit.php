<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
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

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(is_god($_COOKIE['admin'])) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_EDITADMINS;
  include_once("header.php");
  $sapi_name = strtolower(php_sapi_name());
  OpenTable();
  OpenMenu(_AB_EDITADMINS);
  mastermenu();
  CarryMenu();
  authmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  $admin_row = abget_admin($a_aid);
  echo '<form action="'.$admin_file.'.php" method="post">'."\n";
  echo '<input type="hidden" name="a_aid" value="'.$a_aid.'" />'."\n";
  echo '<input type="hidden" name="op" value="ABAuthEditSave" />'."\n";
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_ADMIN.':</strong></td>';
  echo '<td><strong>'.$a_aid.'</strong></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_AUTHLOGIN.':</strong></td>';
  echo '<td><input type="text" name="xlogin" size="20" maxlength="25" value="'.$admin_row['login'].'" /></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PASSWORD.':</strong></td>';
  echo '<td><input type="text" name="xpassword" size="20" maxlength="20" value="'.$admin_row['password'].'" /></td></tr>'."\n";
  echo '<tr><td bgcolor="'.$bgcolor2.'"><strong>'._AB_PROTECTED.':</strong></td>';
  $sel1=$sel2='';
  if($admin_row['protected']==0) { $sel1 = ' selected="selected"'; } else { $sel2 = ' selected="selected"'; }
  echo '<td><select name="xprotected">'."\n";
  echo '<option value="0"'.$sel1.'>'._AB_NOTPROTECTED.'</option>'."\n";
  echo '<option value="1"'.$sel2.'>'._AB_ISPROTECTED.'</option>'."\n";
  echo '</select></td></tr>'."\n";
  echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
  echo '</table>'."\n";
  echo '</form>'."\n";
  CloseTable();
  include_once("footer.php");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>