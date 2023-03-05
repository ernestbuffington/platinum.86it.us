<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." - "._BA_LISTBANN;
if (is_baclient($baclient)) {
  @include_once("header.php");
  title(_BA_LISTBANN);
  BAMenu();
  echo "<br>\n";
  $anumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$bacookie[0]'"));
  if ($anumrows < 1) {
    OpenTable();
    echo "<center><b>"._BA_NOBANFOR." $bacookie[1]</b></center>";
    CloseTable();
  } else {
    OpenTable();
    echo "<table width='100%' border='0' bgcolor='#000000'>\n<tr bgcolor='$bgcolor2'>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_ID."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_IMPMAD."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_CLKS."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_CLKP."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_ENDDTE."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_PLCM."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_STAT."</b></td>\n";
    echo "<td align='center' valign='bottom'><b>"._BA_FUNC."</b></td>\n";
    echo "</tr>\n";
    $result = $db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$bacookie[0]' ORDER BY datestr");
    while ($bidinfo = $db->sql_fetchrow($result)) {
      if ($bidinfo['impmade']==0) { $percent = 0; } else { $percent = substr(100 * $bidinfo['clicks'] / $bidinfo['impmade'], 0, 5); }
      if ($bidinfo['dateend']=="0000-00-00") { $remaining = _BA_NOTPUR; } else { $remaining = $bidinfo['dateend']; }
      if ($bidinfo['active'] == -1) { $status = _BA_PEN; } elseif ($bidinfo['active'] == 0) { $status = _BA_INA; } elseif ($bidinfo['active'] == 1) { $status = _BA_ACT; }
      if ($bidinfo['pid'] == 1) { $bantype = _BA_HEAD; } elseif ($bidinfo['pid'] == 2) { $bantype = _BA_FOOT; } elseif ($bidinfo['pid'] == 3) { $bantype = _BA_LEFT; } elseif ($bidinfo['pid'] == 4) { $bantype = _BA_RIGHT; }
      echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>\n";
      echo "<td align='center'>".$bidinfo['bid']."";
      if ($bidinfo['code'] > 0) { echo " <img src='modules/$module_name/images/code.png' height='16' width='16' border='0' alt='"._BA_CDE."' title='"._BA_CDE."'>"; }
      if ($bidinfo['flash'] > 0) { echo " <img src='modules/$module_name/images/flash.png' height='16' width='16' border='0' alt='"._BA_FLH."' title='"._BA_FLH."'>"; }
      echo "</td>\n<td align='center'>".$bidinfo['impmade']."</td>\n";
      echo "<td align='center'>".$bidinfo['clicks']."</td>\n";
      echo "<td align='center'>$percent%</td>\n";
      echo "<td align='center'>$remaining</td>\n";
      echo "<td align='center'>$bantype</td>\n";
      echo "<td align='center'>$status</td>\n";
      echo "<td align='center'>";
      if ($bidinfo['height'] > $bidinfo['width'] AND $bidinfo['height'] > 400) {
        $height = $bidinfo['height'] + 50;
        $width = 500;
      } elseif ($bidinfo['width'] > $bidinfo['height'] AND $bidinfo['width'] > 400) {
        $height = 400;
        $width = $bidinfo['width'] + 50;
      } else {
        $height = 400;
        $width = 400;
      }
      echo " <a href='modules.php?name=$module_name&op=BAImageView&bid=".$bidinfo['bid']."' onclick=\"NewWindow(this.href,'BAImageView".$bidinfo['bid']."','$width','$height','yes');return false;\"><img src='modules/$module_name/images/view.png' height='16' width='16' border='0' alt='"._BA_VIEW."' title='"._BA_VIEW."'></a> ";
      echo " <a href='modules.php?name=$module_name&op=BAImageMail&bid=".$bidinfo['bid']."' onclick=\"NewWindow(this.href,'BAImageMail".$bidinfo['bid']."','400','50','no');return false;\"><img src='modules/$module_name/images/email.png' height='16' width='16' border='0' alt='"._BA_MAIL."' title='"._BA_MAIL."'></a> ";
      if ($bidinfo['active'] == 1) {
        echo " <a href='modules.php?name=$module_name&op=BAImageEdit&bid=".$bidinfo['bid']."'><img src='modules/$module_name/images/edit.png' height='16' width='16' border='0' alt='"._BA_EDIT."' title='"._BA_EDIT."'></a> ";
      } else {
        echo " <img src='modules/$module_name/images/edit-no.png' height='16' width='16' border='0' alt='"._BA_NOTALW."' title='"._BA_NOTALW."'> ";
      }
      echo "</td>\n";
      echo "</tr>\n";
    }
    echo "</table>\n";
    CloseTable();
  }
  @include_once("footer.php");
} else {
  header("Location: modules.php?name=$module_name");
}

?>