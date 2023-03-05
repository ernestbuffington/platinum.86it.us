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
  $subject = _AB_ACCESSCHANGEDON.' '.$nuke_config['sitename'];
  $message  = _AB_HTTPONLY."\n";
  $message .= _AB_LOGIN.': '.$xlogin."\n";
  $message .= _AB_PASSWORD.': '.$xpassword."\n";
  $message .= _AB_PROTECTED.': ';
  if($xprotected==0) { $message .= _AB_NO."\n"; } else { $message .= _AB_YES."\n"; }
  $xpassword_md5 = md5($xpassword);
  $xpassword_crypt = crypt($xpassword);
  if(!get_magic_quotes_runtime()) {
    $xlogin = addslashes($xlogin);
    $xpassword = addslashes($xpassword);
  }
  $db->sql_query("UPDATE `".$prefix."_nsnst_admins` SET `login`='$xlogin', `password`='$xpassword', `password_md5`='$xpassword_md5', `password_crypt`='$xpassword_crypt', `protected`='$xprotected' WHERE `aid`='$a_aid'");
  list($amail) = $db->sql_fetchrow($db->sql_query("SELECT `email` FROM `".$prefix."_authors` WHERE `aid`='$a_aid' LIMIT 0,1"));
  if (defined('TNML_IS_ACTIVE')) {
    tnml_fMailer($amail, $subject, $message, $nuke_config['adminmail']);
  } else {
    @mail($amail, $subject, $message, "From: ".$nuke_config['adminmail']."\r\nX-Mailer: "._AB_NUKESENTINEL."\r\n");
  }
  if($ab_config['staccess_path'] > "" AND is_writable($ab_config['staccess_path'])) {
    $stwrite = "";
    $adminresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_admins` WHERE `password_crypt`>'' ORDER BY `aid`");
    while($adminrow = $db->sql_fetchrow($adminresult)) {
      $stwrite .= $adminrow['login'].":".$adminrow['password_crypt']."\n";
      $doit = fopen($ab_config['staccess_path'], "w");
      fwrite($doit, $stwrite);
      fclose($doit);
    }
  }
  header("Location: ".$admin_file.".php?op=ABAuthList");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>