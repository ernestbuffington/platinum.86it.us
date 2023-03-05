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
  $pagetitle = _AB_NUKESENTINEL.": "._AB_LISTHTTPAUTH;
  include_once("header.php");
  OpenTable();
  OpenMenu(_AB_LISTHTTPAUTH);
  mastermenu();
  CarryMenu();
  authmenu();
  CloseMenu();
  CloseTable();
  echo '<br />'."\n";
  OpenTable();
  echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2" bgcolor="'.$bgcolor2.'" width="80%">'."\n";
  if($ab_config['staccess_path'] > "" AND is_writable($ab_config['staccess_path'])){
    echo '<tr bgcolor="'.$bgcolor1.'"><td align="center" colspan="5"><strong>'._AB_BUILDCGI.': <a href="'.$admin_file.'.php?op=ABCGIBuild">'.$ab_config['staccess_path'].'</a></strong></td></tr>'."\n";
  }
  echo '<tr bgcolor="'.$bgcolor2.'">'."\n";
  echo '<td width="30%"><strong>'._AB_ADMIN.'</strong></td>'."\n";
  echo '<td width="25%"><strong>'._AB_AUTHLOGIN.'</strong></td>'."\n";
  echo '<td width="25%" align="center"><strong>'._AB_PASSWORD.'</strong></td>'."\n";
  echo '<td width="10%" align="center"><strong>'._AB_PROTECTED.'</strong></td>'."\n";
  echo '<td width="10%" align="center"><strong>'._AB_FUNCTIONS.'</strong></td>'."\n";
  echo '</tr>'."\n";
  $adminresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` ORDER BY `aid`");
  while($adminrow = $db->sql_fetchrow($adminresult)) {
    if($adminrow['password'] > "") { $adminrow['password'] = _AB_SET; } else { $adminrow['password'] = _AB_UNSET; }
    if($adminrow['protected']==0) { $adminrow['protected'] = "<i>"._AB_NO."</i>"; } else { $adminrow['protected'] = _AB_YES; }
    echo '<tr onmouseover="this.style.backgroundColor=\''.$bgcolor2.'\'" onmouseout="this.style.backgroundColor=\''.$bgcolor1.'\'" bgcolor="'.$bgcolor1.'">'."\n";
    echo '<td>'.$adminrow['aid'].'</td>'."\n";
    echo '<td>'.$adminrow['login'].'</td>'."\n";
    echo '<td align="center">'.$adminrow['password'].'</td>'."\n";
    echo '<td align="center">'.$adminrow['protected'].'</td>'."\n";
    echo '<td align="center" nowrap="nowrap"><a href="'.$admin_file.'.php?op=';
    if($adminrow['password']==_AB_SET) { echo 'ABAuthResend'; } else { echo 'ABAuthEdit'; }
    echo '&amp;a_aid='.$adminrow['aid'].'"><img src="images/nukesentinel/resend.png" height="16" width="16" border="0" alt="'._AB_RESEND.'" title="'._AB_RESEND.'" /></a> ';
    echo '<a href="'.$admin_file.'.php?op=ABAuthEdit&amp;a_aid='.$adminrow['aid'].'"><img src="images/nukesentinel/edit.png" height="16" width="16" border="0" alt="'._AB_EDIT.'" title="'._AB_EDIT.'" /></a></td>'."\n";
    echo '</tr>'."\n";
  }
  echo '</table>'."\n";
  CloseTable();
  include_once("footer.php");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>