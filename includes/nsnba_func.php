<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

function bacookiedecode($baclient) {
  global $bacookie, $prefix, $db;
  $baclient = base64_decode($baclient);
  $bacookie = explode(":", $baclient);
  $result = $db->sql_query("select passwd from ".$prefix."_nsnba_clients where login='$bacookie[1]'");
  list($pass) = $db->sql_fetchrow($result);
  if ($bacookie[2] == $pass && $pass != "") {
    return $bacookie;
  } else {
    unset($baclient);
    unset($bacookie);
  }
}

function is_baclient($baclient) {
  global $prefix, $db;
  if(!is_array($baclient)) {
    $baclient = base64_decode($baclient);
    $baclient = explode(":", $baclient);
    $cid = "$baclient[0]";
    $pwd = "$baclient[2]";
  } else {
    $cid = "$baclient[0]";
    $pwd = "$baclient[2]";
  }
  if ($cid != "" AND $pwd != "") {
    $result = $db->sql_query("select passwd from ".$prefix."_nsnba_clients where cid='$cid'");
    list($pass) = $db->sql_fetchrow($result);
    if($pass == $pwd && $pass != "") { return 1; }
  }
  return 0;
}

function baget_client_info($baclient) {
  global $clientinfo, $prefix, $db;
  $client2 = base64_decode($baclient);
  $client3 = explode(":", $client2);
  $result = $db->sql_query("select cid, name, email, login, passwd from ".$prefix."_nsnba_clients where login='$client3[1]' and passwd='$client3[2]'");
  if ($db->sql_numrows($result) == 1) { $clientinfo = $db->sql_fetchrow($result); }
  return $clientinfo;
}

function ClientCheck($cname, $email) {
  global $stop, $prefix, $db;
  if ((!$email) || ($email=="") || (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i",$email))) $stop = "<center>"._BA_ERR_INVEML."</center>";
  if (strrpos($email,' ') > 0) $stop = "<center>"._BA_ERR_EMLNOSPC."</center>";
  if ((!$cname) || ($cname=="") || (preg_match("/[^a-zA-Z0-9_-]/i",$cname))) $stop = "<center>"._BA_ERR_INVCLT."</center>";
  if (strlen($cname) < 4 OR strlen($cname) > 25) $stop = "<center>"._BA_ERR_TOLONG."</center>";
  if (preg_match("/^((root)|(adm)|(linux)|(webmaster)|(admin)|(god)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anónimo)|(operator))$/i",$cname)) $stop = "<center>"._BA_ERR_IDRESRV."</center>";
  if (preg_match("/(admin)|(nsn)|(nuke)|(staff)/i", $cname) ) $stop = "<center>"._BA_ERR_IDRESRV."</center>";
  if (strrpos($cname,' ') > 0) $stop = "<center>"._BA_ERR_IDNOSPC."</center>";
  if ($db->sql_numrows($db->sql_query("SELECT login FROM ".$prefix."_nsnba_clients WHERE login='$cname'")) > 0) $stop = "<center>"._BA_ERR_IDTAKEN."</center>";
  return($stop);
}

function BAMenu() {
  global $module_name, $bacookie, $wherefrom;
  echo "<script language='JavaScript'>\n";
  echo "<!-- Begin\n";
  echo "function NewWindow(mypage, myname, w, h, scroll) {\n";
  echo "var winl = (screen.width - w) / 2;\n";
  echo "var wint = (screen.height - h) / 2;\n";
  echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'\n";
  echo "win = window.open(mypage, myname, winprops)\n";
  echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
  echo "}\n";
  echo "//  End -->\n";
  echo "</script>\n";
  OpenTable();
  echo "<center><strong>"._BA_CLTID." - ".$bacookie[1]."</strong></center><br>\n";
  echo "<center><table cellpadding='3'><td align='center' valign='top' width='150'>\n";
  echo "<a href='modules.php?name=$module_name&op=BAClientView' onclick=\"NewWindow(this.href,'ClientView','400','200','no');return false;\">"._BA_VIEWCLT."</a><br>\n";
  echo "<a href='modules.php?name=$module_name&op=BAClientEdit'>"._BA_EDITCLT."</a><br>\n";
  echo "</td><td align='center' valign='top' width='150'>\n";
  echo "<a href='modules.php?name=$module_name&op=BAImageList'>"._BA_LISTBANN."</a><br>\n";
  echo "</td><td align='center' valign='top' width='150'>\n";
  echo "<a href='modules.php?name=$module_name&op=BALogout'>"._BA_CLTOUT."</a><br>\n";
  echo "</td></table></center>\n";
  CloseTable();
}

function BACookie($setcid, $login, $new_pass) {
  $info = base64_encode("$setcid:$login:$new_pass");
  setcookie("baclient","$info",time()+2419200);
}

function BAPass() {
  $lets = "abcdefghijklmnopqrstuvwxyz";
  $nums = "23456789";
  for ($x=0; $x < 6; $x++) {
    mt_srand ((double) microtime() * 1000000);
    $let[$x] = substr($lets, mt_rand(0, strlen($lets)-1), 1);
    $num[$x] = substr($nums, mt_rand(0, strlen($nums)-1), 1);
  }
  $BAPass = $let[0] . $num[0] .$let[2] . $let[1] . $num[1] . $let[3] . $num[3] . $let[4];
  return($BAPass);
}

function baclear_text($str) {
  $str = trim($str);
  $str = stripslashes($str);
  $str = strip_tags($str);
  $str = ereg_replace("\"", "", $str);
  $str = ereg_replace("'", "", $str);
  return $str;
}

function BAAdmin() {
  global $prefix, $db, $modname, $bgcolor2, $admin_file;
  echo "<script language='JavaScript'>\n";
  echo "<!-- Begin\n";
  echo "function NewWindow(mypage, myname, w, h, scroll) {\n";
  echo "var winl = (screen.width - w) / 2;\n";
  echo "var wint = (screen.height - h) / 2;\n";
  echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'\n";
  echo "win = window.open(mypage, myname, winprops)\n";
  echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
  echo "}\n";
  echo "//  End -->\n";
  echo "</script>\n";
  OpenTable();
  echo "<center>\n<table cellpadding='3'>\n<tr>\n<td align='center' valign='top' width='150'>\n";
  echo "<a href='".$admin_file.".php?op=BAImageAdd'>"._BA_ADDBAN."</a><br>";
  echo "<a href='".$admin_file.".php?op=BAClientAdd'>"._BA_ADDCLT."</a><br>";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='150'>\n";
  echo "<a href='".$admin_file.".php?op=BAConfig'>"._BA_CONFIGSET."</a><br>";
  $clrows = $db->sql_numrows($db->sql_query("SELECT cid FROM ".$prefix."_nsnba_clients"));
  echo "<a href='".$admin_file.".php?op=BAClient'>"._BA_CLTLST."</a> ($clrows)<br>";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='150'>\n";
  $ablrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE active='1'"));
  echo "<a href='".$admin_file.".php?op=BAImage&amp;active=1'>"._BA_ABANLST."</a> ($ablrows)<br>";
  $iblrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE active='0'"));
  echo "<a href='".$admin_file.".php?op=BAImage&amp;active=0'>"._BA_IBANLST."</a> ($iblrows)<br>";
  $pblrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE active='-1'"));
  echo "<a href='".$admin_file.".php?op=BAImage&amp;active=-1'>"._BA_PBANLST."</a> ($pblrows)<br>";
  echo "</td>\n</tr>\n</table>\n</center>\n";
  CloseTable();
}

function basave_config($config_name, $config_value){
  global $prefix, $db;
  $db->sql_query("UPDATE ".$prefix."_nsnba_config SET config_value='$config_value' WHERE config_name='$config_name'");
}

function baget_configs(){
  global $prefix, $db;
  $configresult = $db->sql_query("SELECT config_name, config_value FROM ".$prefix."_nsnba_config");
  while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
    $config[$config_name] = $config_value;
  }
  return $config;
}

?>