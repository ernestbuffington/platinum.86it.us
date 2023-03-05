<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_LISTBANN;
@include_once("header.php");
title(_BA_LISTBANN);
BAAdmin();
echo "<br>\n";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE active='$active' ORDER BY pid,cid");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  OpenTable();
  echo "<center><table border='0' bgcolor='$bgcolor2' cellpadding='2' width='100%'>\n";
  echo "<tr bgcolor='$bgcolor2'>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_CLTID."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_IMPTOT."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_IMPLFT."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_CLKS."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_CLKP."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_PLCM."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_STAT."</strong></td>\n";
  echo "<td align='center' valign='bottom'><strong>"._BA_FUNC."</strong></td>\n";
  echo "</tr>\n";
  while ($bidinfo = $db->sql_fetchrow($result)) {
    $result2 = $db->sql_query("SELECT login FROM ".$prefix."_nsnba_clients WHERE cid='$cid'");
    list ($login) = $db->sql_fetchrow($result2);
    if ($bidinfo['impmade'] == 0) { $percent = 0; } else { $percent = substr(100 * $bidinfo['clicks'] / $bidinfo['impmade'], 0, 5); }
    if ($bidinfo['imptotal'] == 0) { $left = ""._BA_UNLIMT.""; } else { $left = $bidinfo['imptotal'] - $bidinfo['impmade']; }
    if ($bidinfo['pid'] == 1) { $bantype = _BA_HEAD; } elseif ($bidinfo['pid'] == 2) { $bantype = _BA_FOOT; } elseif ($bidinfo['pid'] == 3) { $bantype = _BA_LEFT; } elseif ($bidinfo['pid'] == 4) { $bantype = _BA_RIGHT; }
    if ($bidinfo['active'] == -1) { $status = ""._BA_PEN.""; } elseif ($bidinfo['active'] == 0) { $status = ""._BA_INA.""; } elseif ($bidinfo['active'] == 1) { $status = ""._BA_ACT.""; }
    echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>\n";
    echo "<td align=center>".$bidinfo['cid']."</td>\n";
    if ($bidinfo['code'] > 0) { echo " <img src='modules/$modname/images/code.png' height='16' width='16' alt='"._BA_CDE."' title='"._BA_CDE."'>"; }
    if ($bidinfo['flash'] > 0) { echo " <img src='modules/$modname/images/flash.png' height='16' width='16' alt='"._BA_FLH."' title='"._BA_FLH."'>"; }
    echo "</td>\n";
    echo "<td align=center>".$bidinfo['impmade']."</td>\n";
    echo "<td align=center>$left</td>\n";
    echo "<td align=center>".$bidinfo['clicks']."</td>\n";
    echo "<td align=center>$percent%</td>\n";
    echo "<td align=center>$bantype</td>\n";
    echo "<td align=center>$status</td>\n";
    echo "<td align=center>";
    if ($bidinfo['height'] > $bidinfo['width'] AND $bidinfo['height'] > 400) {
      $bidinfo['height'] = $bidinfo['height'] + 50;
      $bidinfo['width'] = 500;
    } elseif ($bidinfo['width'] > $bidinfo['height'] AND $bidinfo['width'] > 400) {
      $bidinfo['height'] = 400;
      $bidinfo['width'] = $bidinfo['width'] + 50;
    } else {
      $bidinfo['height'] = 400;
          $bidinfo['width'] = 400;
    }
    echo " <a href='".$admin_file.".php?op=BAImageView&amp;bid=".$bidinfo['bid']."' onclick=\"NewWindow(this.href,'BAImageView".$bidinfo['bid']."','".$bidinfo['width']."','".$bidinfo['height']."','yes');return false;\"><img src='modules/$modname/images/view.png' height='16' width='16' border='0' alt='"._BA_VIEW."' title='"._BA_VIEW."'></a>";
    echo " <a href='".$admin_file.".php?op=BAImageMail&amp;bid=".$bidinfo['bid']."' onclick=\"NewWindow(this.href,'BAImageMail".$bidinfo['bid']."','400','50','no');return false;\"><img src='modules/$modname/images/email.png' height='16' width='16' border='0' alt='"._BA_MAIL."' title='"._BA_MAIL."'></a> ";
    echo " <a href='".$admin_file.".php?op=BAImageEdit&amp;bid=".$bidinfo['bid']."'><img src='modules/$modname/images/edit.png' height='16' width='16' border='0' alt='"._BA_EDIT."' title='"._BA_EDIT."'></a>";
    echo " <a href='".$admin_file.".php?op=BAImageDelete&amp;bid=".$bidinfo['bid']."'><img src='modules/$modname/images/delete.png' height='16' width='16' border='0' alt='"._BA_DELT."' title='"._BA_DELT."'></a>";
    echo " </td>\n</tr>\n";
  }
  echo "</table></center>\n";
  CloseTable();
} else {
  OpenTable();
  echo "<center><strong>"._BA_NOBANNTYPE."</strong></center>\n";
  CloseTable();
}
@include_once("footer.php");

?>