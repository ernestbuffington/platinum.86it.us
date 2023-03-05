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
$lidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE lid=$lid"));
$priv = $lidinfo['sid'] - 2;
if (($lidinfo['sid'] == 0) || ($lidinfo['sid'] == 1 AND is_user($user)) || ($lidinfo['sid'] == 2 AND is_admin($admin)) || ($lidinfo['sid'] > 2 AND in_group($priv))) {
  if ($fetchid != "") {
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $checkpass . $datekey));
    $code = substr($rcode, 2, 8);
    if ((extension_loaded("gd") AND $code != $passcode) AND $dl_config['usegfxcheck'] == 1) {
      include_once("header.php");
      title(_DL_PASSERR);
      OpenTable();
      echo "<center>"._DL_INVALIDPASS."</center><br />\n";
      echo "<center>"._GOBACK."</center>\n";
      CloseTable();
      include_once("footer.php");
      die();
    } elseif ((!extension_loaded("gd") AND $checkpass != $passcode) AND $dl_config['usegfxcheck'] == 1) {
      include_once("header.php");
      title(_DL_PASSERR);
      OpenTable();
      echo "<center>"._DL_INVALIDPASS."</center><br />\n";
      echo "<center>"._GOBACK."</center>\n";
      CloseTable();
      include_once("footer.php");
    } else {
      $url = base64_decode($fetchid);
      if (stristr($lidinfo['url'], "http://") || stristr($lidinfo['url'], "ftp://") || @file_exists($lidinfo['url'])) {
      //if (@file($lidinfo['url'])) {
        include_once("includes/counter.php");
        $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET hits=hits+1 WHERE lid=$lid");
        if (!is_admin($admin)) {
          $uinfo = getusrinfo($user);
          $username = $uinfo['username'];
          if ($username == "") { $username = $_SERVER['REMOTE_ADDR']; }
          $result = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_accesses WHERE username='$username'"));
          if ($result < 1) {
            $db->sql_query("INSERT INTO ".$prefix."_nsngd_accesses VALUES ('$username', 1, 0)");
          } else {
            $db->sql_query("UPDATE ".$prefix."_nsngd_accesses SET downloads=downloads+1 WHERE username='$username'");
          }
        }
        Header("Location: ".$lidinfo['url']);
        exit;
      } else {
        cookiedecode($user);
        $username = $cookie[1];
        if ($username == "") { $username = "Guest"; }
        $date = date("M d, Y g:i:a");
        $sub_ip = $_SERVER['REMOTE_ADDR'];
        $db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, $lid, 0, 0, '', '', '', '"._DSCRIPT."<br />$date', '$sub_ip', 1, '$auth_name', '$email', '$filesize', '$version', '$homepage')");
        include_once("header.php");
        title(_DL_FNF." ".$lidinfo['title']);
        OpenTable();
        echo "<center>"._DL_SORRY." $username, ".$lidinfo['title']." "._DL_NOTFOUND."<br /><br />"._DL_FNFREASON."<br /><br />";
        echo _DL_FLAGGED."</center><br />";
        echo "<center>[ <a href='modules.php?name=$module_name'>"._DL_BACKTO." $module_name</a> ]</center>";
        CloseTable();
        include_once("footer.php");
      }
    }
  } else {
    include_once("header.php");
    title(_DL_URLERR);
    OpenTable();
    echo "<center>"._DL_INVALIDURL."</center><br />";
    echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once("footer.php");
  }
} else {
  include_once("header.php");
  title(_DL_RESTRICTED);
  OpenTable();
  restricted($lidinfo['sid']);
  CloseTable();
  include_once("footer.php");
}

?>
