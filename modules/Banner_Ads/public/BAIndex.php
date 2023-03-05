<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." ".$ba_config['version_number'];
@include_once("header.php");
if(is_baclient($baclient)) {
  title(_BA_CLTMENU);
  BAMenu();
} else {
  mt_srand ((double)microtime()*1000000);
  $maxran = 1000000;
  $random_num = mt_rand(0, $maxran);
  title(_BA_CLTLOG);
  OpenTable();
  if ($stop) {
    echo "<center><font color='#ff0000'><b>"._BA_LOGINC."</b></font></center><br>\n";
  }
  echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
  echo "<form action='modules.php?name=$module_name' method='post'>\n";
  echo "<input type='hidden' name='op' value='BALogin'>\n";
  echo "<tr><td>"._BA_CLTID.":</td><td><input type='text' name='login' size='15' maxlength='25'></td></tr>\n";
  echo "<tr><td>"._BA_PASS.":</td><td><input type='password' name='pass' size='15' maxlength='20'></td></tr>\n";
  if (extension_loaded("gd") AND ($ba_config['usegfxcheck'] == 2 OR $ba_config['usegfxcheck'] == 3)) {
    echo "<tr><td>"._BA_SECCODE.":</td><td><img src='modules.php?name=$module_name&op=BAgfx&random_num=$random_num' border='1' height='20' width='80' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>\n";
    echo "<tr><td>"._BA_TYPCODE.":</td><td><input type='text' NAME='gfx_check' SIZE='10' MAXLENGTH='8'></td></tr>\n";
    echo "<input type='hidden' name='random_num' value='$random_num'>\n";
  }
  echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_LOGIN."'></td></tr>\n";
  echo "</form></table></center><br>\n";
  echo "<center>[ <a href='modules.php?name=$module_name&amp;op=BAClientPassLost'>"._BA_LOSTPASS."</a> |";
  echo " <a href='modules.php?name=$module_name&amp;op=BAClientNew'>"._BA_CLTREG."</a> ]</center>\n";
  CloseTable();
}
@include_once("footer.php");

?>