<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

$lid = intval($lid);
$cat = intval($cat);
$filesize = intval($filesize);
if(is_user($user)) {
  cookiedecode($user);
  $ratinguser = $cookie[1];
} else {
  $ratinguser = $anonymous;
}
if ($dl_config['blockunregmodify'] == 1 && !is_user($user)) {
  include_once("header.php");
  menu(1);
  echo "<br />\n";
  OpenTable();
  echo "<center><font class='content'>"._DONLYREGUSERSMODIFY."</font></center>\n";
  CloseTable();
  include_once("footer.php");
} else {
  $title = stripslashes(FixQuotes($title));
  $url = stripslashes(FixQuotes($url));
  $description = stripslashes(FixQuotes($description));
  $sub_ip = $_SERVER['REMOTE_ADDR'];
  $db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, $lid, $cat, 0, '$title', '$url', '$description', '$ratinguser', '$sub_ip', 0, '$auth_name', '$email', '$filesize', '$version', '$homepage')");
  include_once("header.php");
  menu(1);
  echo "<br />\n";
  OpenTable();
  echo "<center><font class='content'>"._THANKSFORINFO." "._LOOKTOREQUEST."</font></center>\n";
  CloseTable();
  include_once("footer.php");
}

?>
