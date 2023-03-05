<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_UPDTCLNT;
if (is_baclient($baclient)) {
  $chng_name = baclear_text($chng_name);
  $chng_email = baclear_text($chng_email);
  $new_pass1 = baclear_text($new_pass1);
  $new_pass2 = baclear_text($new_pass2);
  @include_once("header.php");
  title(_BA_UPDTCLNT);
  $new_pass1 = trim ("$new_pass1");
  $new_pass2 = trim ("$new_pass2");
  BAMenu();
  echo "<br>\n";
  OpenTable();
  if (($new_pass1 != $new_pass2) AND ($new_pass1 != "" AND $new_pass2 != "")) {
    echo "<center><b>"._BA_ERR_NOMATCH."</b></center>\n";
  } elseif ($new_pass1 > "") {
    $new_pass = md5($new_pass1);
    $db->sql_query("UPDATE ".$prefix."_nsnba_clients SET name='$chng_name', email='$chng_email', passwd='$new_pass' WHERE cid='$bacookie[0]'");
    $info = base64_encode("$cid:$login:$new_pass");
    setcookie("client","$info",time()+3024000);
    echo "<center><b>"._BA_ACCPASUPD."</b></center>\n";
  } else {
    $chng_extra = ereg_replace("\"", "", $chng_extra);
    $chng_extra = ereg_replace("'", "", $chng_extra);
    $db->sql_query("UPDATE ".$prefix."_nsnba_clients SET name='$chng_name', email='$chng_email' WHERE cid='$bacookie[0]'");
    echo "<center><b>"._BA_ACCUPD."</b></center>\n";
  }
  CloseTable();
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>