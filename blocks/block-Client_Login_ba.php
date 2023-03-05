<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NUKE_FILE')) {
  Header("Location: ../index.php");
  die();
}
$modname = "Banner_Ads";
get_lang($modname);
$content = "";
global $nukeurl, $baclient, $bacookie, $prefix, $db, $anonymous, $sitekey;
$ba_config = baget_configs();
// Banner Client Login
if (is_baclient($baclient)) {
  $cltname = $bacookie[1];
  $content .= _BA_WEL.", <strong>$cltname</strong>.<br>(<a href='modules.php?name=$modname&amp;op=BALogout'>"._BA_LOGOUT."</a>)\n";
  $content .= "<hr noshade size='1'>\n";
  list($cid) = $db->sql_fetchrow($db->sql_query("SELECT cid FROM $prefix"._nsnba_clients." WHERE login='$cltname'"));
  $actban = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='1'"));
  $expban = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='0'"));
  $penban = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='-1'"));
  $totban = $actban + $expban + $penban;
  $content .= "<strong><a href='modules.php?name=$modname'>"._BA_BANS."</a>:</strong><br>\n";
  $content .= "<big><strong>&middot;</strong></big> "._BA_PEN.": <strong>$penban</strong><br>\n";
  $content .= "<big><strong>&middot;</strong></big> "._BA_ACT.": <strong>$actban</strong><br>\n";
  $content .= "<big><strong>&middot;</strong></big> "._BA_INA.": <strong>$expban</strong><br>\n";
  $content .= "<big><strong>&middot;</strong></big> "._BA_TOT.": <strong>$totban</strong><br>\n";
} else {
  mt_srand ((double)microtime()*1000000);
  $maxran = 1000000;
  $random_num = mt_rand(0, $maxran);
  $content .= "Welcome, <strong>$anonymous</strong>.<br>\n";
  $content .= "<hr noshade size='1'>\n";
  $content .= "<table border=0 cellpadding=0 cellspacing=0>\n";
  $content .= "<tr><form action='modules.php?name=$modname' method='post'>\n";
  $content .= "<td>"._BA_CLTID.": <input type='text' name='login' size='12' maxlength='25'><br>\n";
  $content .= _BA_PASS.": <input type='password' name='pass' size='12' maxlength='10'><br>\n";
  if (extension_loaded("gd") AND ($ba_config['usegfxcheck'] == 2 OR $ba_config['usegfxcheck'] == 3)) {
    $content .=""._BA_SECCODE.": <img src='modules.php?name=$modname&op=BAgfx&random_num=$random_num' border='1' height='20' width='80' alt='"._BA_SECCODE."' title='"._BA_SECCODE."'><br>\n";
    $content .=""._BA_TYPECODE.": <input type='text' NAME='gfx_check' SIZE='10' MAXLENGTH='8'><br>\n";
    $content .="<input type='hidden' name='random_num' value='$random_num'>\n";
  }
  $content .= "<input type='hidden' name='op' value='BALogin'>\n";
  $content .= "<input type='submit' value='".strtoupper(_BA_LOGIN)."'> (<a href='modules.php?name=$modname&amp;op=BAClientNew'>"._BA_REGS."</a>)</td>\n";
  $content .= "</form></tr>\n";
  $content .= "</table>\n";
}

?>