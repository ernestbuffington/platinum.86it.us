<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$stop = "";
$pagetitle = ": "._BA_TITLE." - "._BA_CLTREG;
if (!is_baclient($baclient)) {
  @include_once("header.php");
  title(_BA_CLTREG);
  if ($new_name == "") { $new_name = $new_login; }
  $new_login = baclear_text($new_login);
  $new_name = baclear_text($new_name);
  $new_email = baclear_text($new_email);
  $new_pass1 = baclear_text($new_pass1);
  $new_pass2 = baclear_text($new_pass2);
  $datekey = date("F j");
  $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $_POST[random_num] . $datekey));
  $code = substr($rcode, 2, 8);
  if (extension_loaded("gd") AND $code != $gfx_check AND ($ba_config['usegfxcheck'] == 1 OR $ba_config['usegfxcheck'] == 3)) {
    OpenTable();
    echo "<center><b>"._BA_ERRSECCODE."</b></center><br>";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    @include_once("footer.php");
    die();
  }
  if ($new_pass1 != $new_pass2) {
    OpenTable();
    echo "<center><b>"._BA_ERR_NOMATCH."</b></center>\n";
    CloseTable();
  } else {
    clientCheck($new_login, $new_email);
    if ($stop <= "") {
      $cryptpass = md5($new_pass1);
      $tempto = $db->sql_query("SELECT max(cid) AS new_cid FROM ".$prefix."_nsnba_clients");
      list ($new_cid) = $db->sql_fetchrow($tempto);
      $new_cid = $new_cid + 1;
      $result = $db->sql_query("INSERT INTO ".$prefix."_nsnba_clients (cid, name, email, login, passwd) VALUES ('$new_cid','$new_name','$new_email','$new_login','$cryptpass')");
      $message = _BA_WELTO." $sitename!\n\n";
      $message .= _BA_USEDMAIL." $sitename. ";
      $message .= _BA_CLNTINFO.":\n\n- "._BA_CLTID.": $new_login\n- "._BA_PASS.": $new_pass1";
      $subject = _BA_CLNTPASS." $new_login";
      $from = "$adminmail";
      mail($new_email, $subject, $message, "From: $from\nReturn-Path: $from\nX-Mailer: PHP/" . phpversion());
      $to = $adminmail;
      $from = $new_email;
      $subject = "$sitename - "._BA_NCLTADD;
      $message = "$new_login "._BA_HASADD." $sitename.";
      mail($to, $subject, $message, "From: $from\nReturn-Path: $from\nX-Mailer: PHP/" . phpversion());
      OpenTable();
      echo "<center><b>"._BA_ACCCREATE."</b><br><br>";
      echo _BA_NOWREG."<br>";
      echo "<a href='modules.php?name=$module_name'>"._BA_CLTLOG."</a><br><br>";
      echo _BA_THNKREG." $sitename!</center>";
      CloseTable();
    } else {
      OpenTable();
      echo "$stop";
      CloseTable();
    }
  }
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>