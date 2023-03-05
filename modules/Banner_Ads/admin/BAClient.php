<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_LISTCLNT;
@include_once("header.php");
title(_BA_LISTCLNT);
BAAdmin();
echo "<br>\n";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients ORDER BY login");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  OpenTable();
  echo "<center><table border='0' cellpadding='2' bgcolor='$bgcolor2'><tr bgcolor='$bgcolor2'>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_CLTID."</b></td>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_ACT."</b></td>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_INA."</b></td>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_PEN."</b></td>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_UNP."</b></td>\n";
  echo "<td align='center' valign='bottom'><b>"._BA_FUNC."</b></td>\n";
  echo "</tr>\n";
  while ($cidinfo = $db->sql_fetchrow($result)) {
    $actrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='".$cidinfo['cid']."' AND active='1'"));
    $inarows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='".$cidinfo['cid']."' AND active='0'"));
    $penrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='".$cidinfo['cid']."' AND active='-1'"));
    $uknrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='".$cidinfo['cid']."' AND active='-2'"));
    echo "<tr onmouseover=\"this.style.backgroundColor='$bgcolor2'\" onmouseout=\"this.style.backgroundColor='$bgcolor1'\" bgcolor='$bgcolor1'>\n";
    echo "<td align='center'><a href='mailto:".$cidinfo['email']."'>".$cidinfo['login']."</a> (".$cidinfo['cid'].")</td>\n";
    echo "<td align='center'>$actrows</td>\n";
    echo "<td align='center'>$inarows</td>\n";
    echo "<td align='center'>$penrows</td>\n";
    echo "<td align='center'>$uknrows</td>\n";
    echo "<td align='center'> ";
    echo "<a href='".$admin_file.".php?op=BAClientView&amp;cid=".$cidinfo['cid']."' onclick=\"NewWindow(this.href,'BAClientView".$cidinfo['cid']."','400','300','yes');return false;\"><img src='modules/$modname/images/view.png' height='16' width='16' border='0' alt='"._BA_VIEW."' title='"._BA_VIEW."'></a> ";
    echo "<a href='".$admin_file.".php?op=BAClientEdit&amp;cid=".$cidinfo['cid']."'><img src='modules/$modname/images/edit.png' height='16' width='16' border='0' alt='"._BA_EDIT."' title='"._BA_EDIT."'></a> ";
    echo "<a href='".$admin_file.".php?op=BAClientDelete&amp;cid=".$cidinfo['cid']."'><img src='modules/$modname/images/delete.png' height='16' width='16' border='0' alt='"._BA_DELT."' title='"._BA_DELT."'></a> ";
    echo "</td>\n";
    echo "</tr>\n";
  }
  echo "</table></center>\n";
  CloseTable();
} else {
  OpenTable();
  echo "<center><b>"._BA_NOCLTFILE."</b></center>\n";
  CloseTable();
}
@include_once("footer.php");

?>