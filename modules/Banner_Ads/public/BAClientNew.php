<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_CLTREG;
if (!is_baclient($baclient)) {
  mt_srand ((double)microtime()*1000000);
  $maxran = 1000000;
  $random_num = mt_rand(0, $maxran);
  @include_once("header.php");
  title(_BA_CLTREG);
  $new_login = $cookie[1];
  $userinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$user_prefix."_users where username='$new_login'"));
  OpenTable();
  echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<tr><td align='center' bgcolor='$bgcolor2' colspan='2'><b>"._BA_BANNED."</b></td></tr>\n";
  echo "</table>\n";
  echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<form action='modules.php?name=$module_name' method='post'>\n";
  echo "<input type='hidden' name='op' value='BAClientNewSave'>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTID.":</b></td><td><input type='text' name='new_login' size='30' maxlength='26' value='$new_login'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONNME.":</b></td><td><input type='text' name='new_name' size='30' maxlength='60' value='".$userinfo['name']."'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONEML.":</b></td><td><input type='text' name='new_email' size='30' maxlength='60' value='".$userinfo['user_email']."'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PASS.":</b></td><td><input type='password' name='new_pass1' size='10' maxlength='20'></td></tr>\n";
  echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PASSRE.":</b></td><td><input type='password' name='new_pass2' size='10' maxlength='20'></td></tr>\n";
  if (extension_loaded("gd") AND ($ba_config['usegfxcheck'] == 1 OR $ba_config['usegfxcheck'] == 3)) {
    echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_SECCODE.":</b></td><td><img src='modules.php?name=$module_name&op=BAgfx&random_num=$random_num' border='1' height='20' width='80' alt='"._BA_SECCODE."' title='"._BA_SECCODE."'></td></tr>\n";
    echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_TYPCODE.":</b></td><td><input type='text' NAME='gfx_check' SIZE='10' MAXLENGTH='8'></td></tr>\n";
    echo "<input type='hidden' name='random_num' value='$random_num'>\n";
  }
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>\n";
  echo "</form>\n";
  echo "</table>\n";
  CloseTable();
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>