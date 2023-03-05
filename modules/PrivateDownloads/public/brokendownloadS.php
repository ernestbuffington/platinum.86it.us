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
if(is_user($user)) {
  cookiedecode($user);
  $ratinguser = $cookie[1];
} else {
  $ratinguser = $anonymous;
}
$sub_ip = $_SERVER['REMOTE_ADDR'];
$db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, $lid, 0, 0, '', '', '', '$ratinguser', '$sub_ip', 1, '', '', '', '', '')");
include_once("header.php");
menu(1);
echo "<br />\n";
OpenTable();
echo "<br /><center>"._THANKSFORINFO."<br /><br />"._LOOKTOREQUEST."</center><br />\n";
CloseTable();
include_once("footer.php");

?>
