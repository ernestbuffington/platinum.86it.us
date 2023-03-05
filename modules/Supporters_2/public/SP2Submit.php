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

if($sp_config['require_user'] == 0 || is_user($user)) {
  $pagetitle = _SP2_ADDSUPPORTER;
  $comefrom = $_SERVER['HTTP_REFERER'];
  if(defined("NUKESENTINEL_IS_LOADED")) {
    $sip = $nsnst_const['remote_ip'];
  } else {
    $sip = $_SERVER['REMOTE_ADDR'];
  }
  if(!is_array($user)) {
    $member = base64_decode($user);
    $member = explode(":", $member);
    $memname = "$member[1]";
  } else {
    $memname = "$user[1]";
  }
  list($suid, $sname, $semail, $surl) = $db->sql_fetchrow($db->sql_query("select `user_id`, `username`, `user_email`, `user_website` from `".$user_prefix."_users` where `username`='$memname'"));
  include_once("header.php");
  title(_SP2_ADDSUPPORTER);
  OpenTable();
  echo "<center><strong>"._SP2_ADDSUPPORTER."</strong><br />"._SP2_ALLREQ."<br />\n";
  if(is_admin($admin)) {
    echo "<center>[ <a href='".$admin_file.".php?op=SP2Main'>"._SP2_GOTOADMIN."</a> ]\n";
  }
  $limitedext2 = implode(", ", $limitedext);
  echo "<table border='0'>\n";
  if($sp_config['image_type']==0) { $enctype = ""; } else { $enctype = " enctype='multipart/form-data'"; }
  echo "<form action='modules.php?name=$module_name' method='post'$enctype>\n";
  echo "<input type='hidden' name='op' value='SP2SubmitSave'>\n";
  echo "<input type='hidden' name='user_id' value='$suid'>\n";
  echo "<tr><td><strong>"._SP2_NAME.":</strong></td><td><input type='text' name='site_name' size='50'></td></tr>\n";
  echo "<tr><td><strong>"._SP2_URL.":</strong></td><td><input type='text' name='site_url' size='50' value='$surl'></td></tr>\n";
  echo "<tr><td><strong>"._SP2_ALLOWEDEXT.":</strong></td><td><strong>$limitedext2</strong></td></tr>\n";
  if($sp_config['image_type']==0) { $type = "type='input'"; } else { $type = "type='file'"; }
  echo "<tr><td valign='top'><strong>"._SP2_IMAGE.":</strong></td><td><input $type name='site_image' size='50'>";
  echo "<br />"._SP2_MUSTBE;
  if($sp_config['image_type']==0) { echo "<br />"._SP2_IMAGETYPE0; } else { echo "<br />"._SP2_IMAGETYPE1; }
  echo "</td></tr>\n";
  echo "<tr><td valign='top'><strong>"._SP2_DESCRIPTION.":</strong></td><td><textarea $textrowcol name='site_description'></textarea></td></tr>\n";
  echo "<tr><td><strong>"._SP2_YOURNAME.":</strong></td><td><input type='test' name='user_name' value='$sname' size='40'></td></tr>\n";
  echo "<tr><td><strong>"._SP2_YOUREMAIL.":</strong></td><td><input type='text' name='user_email' value='$semail' size='40'></td></tr>\n";
  echo "<tr><td><strong>"._SP2_YOURIP.":</strong></td><td>$sip</td></tr>\n";
  echo "<input type='hidden' name='user_ip' value='$sip'>\n";
  echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SP2_SUBMITSITE."'></td></tr>\n";
  echo "</form></table></center>\n";
  CloseTable();
  include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>