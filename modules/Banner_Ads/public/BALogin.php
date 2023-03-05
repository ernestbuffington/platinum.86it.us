<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$login = baclear_text($login);
$pass = baclear_text($pass);
$referer = $_SERVER['HTTP_REFERER'];
if ($referer == "") { $referer = $nukeurl; }
$setinfo = $db->sql_fetchrow($db->sql_query("SELECT passwd, cid FROM ".$prefix."_nsnba_clients WHERE login='$login'"));
if (($db->sql_numrows($result)==1) AND ($setinfo[cid] != 0) AND ($setinfo[passwd] != "")) {
  $dbpass=$setinfo[passwd];
  $new_pass = md5($pass);
  if ($dbpass != $new_pass) {
    header("Location: modules.php?name=$module_name&stop=1");
    return;
  }
  $datekey = date("F j");
  $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
  $code = substr($rcode, 2, 8);
  if (extension_loaded("gd") AND $code != $gfx_check AND ($ba_config['usegfxcheck'] == 2 OR $ba_config['usegfxcheck'] == 3)) {
    header("Location: modules.php?name=$module_name&stop=1");
    die();
  } else {
    $setcid = $setinfo[cid];
    BACookie($setcid, $login, $new_pass);
    header("Location: $referer");
  }
} else {
  header("Location: modules.php?name=$module_name&stop=1");
}

?>