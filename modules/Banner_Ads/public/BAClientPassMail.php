<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_CLTPASMAIL;
if (!is_baclient($baclient)) {
  $cname = baclear_text($cname);
  $code = baclear_text($code);
  $result = $db->sql_query("SELECT email, passwd FROM ".$prefix."_nsnba_clients WHERE login='$cname'");
  $numrows = $db->sql_numrows($result);
  @include_once("header.php");
  if ($numrows == 0) {
    title(_BA_CLTNOCLT);
    OpenTable();
    echo "<center>"._BA_NOINFO."</center>";
    CloseTable();
  } else {
    $host_name = $_SERVER['REMOTE_ADDR'];
    $result = $db->sql_query("SELECT email, passwd FROM ".$prefix."_nsnba_clients WHERE login='$cname'");
    list ($email, $pass) = $db->sql_fetchrow($result);
    $areyou = substr($pass, 0, 10);
    if ($areyou==$code) {
      $newpass=BAPass();
      $message = _BA_CLTACC." '$cname' "._BA_AT." $sitename "._BA_CLTACC2." $host_name "._BA_CLTACC3.": $newpass\n\n "._BA_CLTACC4." $nukeurl/modules.php?name=$module_name\n\n"._BA_CLTACC5;
      $subject = _BA_CLTPASSFOR." $cname";
      if ($email != "") {
        mail($email, $subject, $message, "From: $adminmail\nReturn-Path: $adminmail\nX-Mailer: PHP/" . phpversion());
      }
      $cryptpass = md5($newpass);
      $query="UPDATE ".$prefix."_nsnba_clients SET passwd='$cryptpass' WHERE login='$cname'";
      if (!$db->sql_query($query)) {
        title(_BA_CLTDBERR);
        OpenTable();
        echo _BA_CONTADMN;
        echo "<center>"._GOBACK."</center>";
        CloseTable();
      } elseif ($email=="") {
        title(_BA_ERR_INVEML);
        OpenTable();
        echo _BA_CONTADMN2;
        echo "<center>"._GOBACK."</center>";
        CloseTable();
      } else {
        title(_BA_CLTPASMAIL);
        OpenTable();
        echo "<center>"._BA_MAILPASS." $cname.</center>";
        echo "<center>"._GOBACK."</center>";
        CloseTable();
      }
    } else {
      $host_name = $_SERVER['REMOTE_ADDR'];
      $result = $db->sql_query("SELECT email, passwd FROM ".$prefix."_nsnba_clients WHERE login='$cname'");
      list ($email, $pass) = $db->sql_fetchrow($result);
      $areyou = substr($pass, 0, 10);
      $message =  _BA_CLTACC." '$cname' "._BA_AT." $sitename "._BA_CLTACC2." $host_name "._BA_CLTACC6.": $areyou \n\n"._BA_CLTACC7." $nukeurl/modules.php?name=$module_name&op=BAClientPassLost\n"._BA_CLTACC8;
      $subject= _BA_CLTCODEFOR." $cname";
      if ($email != "") {
        mail($email, $subject, $message, "From: $adminmail\nReturn-Path: $adminmail\nX-Mailer: PHP/" . phpversion());
      }
      title(_BA_CLTCODMAIL);
      OpenTable();
      echo "<center>"._BA_MAILCODE." $cname</center><br>\n";
      echo "<center>"._GOBACK."</center>";
      CloseTable();
    }
  }
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>