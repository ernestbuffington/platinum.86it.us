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

if (!isset($cid)) { $cid = 0; }
$cid = intval($cid);
include_once("header.php");
if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$dl_config['perpage'];
if(isset($orderby)) { $orderby = convertorderbyin($orderby); } else { $orderby = "title ASC"; }
if ($cid == 0) {
  menu(0);
  $title = ""._MAIN."";
} else {
  menu(1);
  $cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid=$cid AND active>'0'"));
  $title = getparentlink($cidinfo['parentid'], $cidinfo['title']);
  $title = "<a href=modules.php?name=$module_name>"._MAIN."</a> -&gt; $title";
}
echo "<br />";
OpenTable();
echo "<table align='center'><tr><td><font class='option'><strong>"._CATEGORY.": $title</strong></font></td></tr></table>";
$result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE parentid=$cid ORDER BY title");
$numrows2 = $db->sql_numrows($result2);
if ($numrows2 > 0) {
  echo "<table align='center' border='0' cellpadding='10' cellspacing='1' width='100%'>\n";
  $count = 0;
  while($cidinfo2 = $db->sql_fetchrow($result2)) {
    if ($count == 0) { echo "<tr>\n"; }
    if ($dl_config['show_links_num'] == 1) {
      $cnumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='".$cidinfo2['cid']."' AND active>'0'"));
      $categoryinfo = getcategoryinfo($cidinfo2['cid']);
      $cnumm = " (".$cnumrows."/".$categoryinfo['downloads'].")";
    } else {
      $cnumm = "";
    }
    echo "<td valign='top' width='33%'><font class='option'>";
    $myimage = myimage("icon-.png");
    echo "<img align='middle' src='$myimage' border='0' height='16' width='16' alt='' title=''>";
    echo "<a href='modules.php?name=$module_name&amp;cid=".$cidinfo2['cid']."'><strong>".$cidinfo2['title']."</strong></a>$cnumm</font>";
    newcategorygraphic($cidinfo2['cid']);
    if ($cidinfo2['cdescription']) {
      echo "<font class='content'>".$cidinfo2['cdescription']."</font><br />";
    } else {
      echo "<br />";
    }
    $space = 0;
    $result3 = $db->sql_query("SELECT cid, title FROM ".$prefix."_nsngd_categories WHERE parentid='".$cidinfo2['cid']."' AND active>'0' ORDER BY title");
    while($cidinfo3 = $db->sql_fetchrow($result3)) {
      if ($dl_config['show_links_num'] == 1) {
        $snumrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='".$cidinfo3['cid']."' AND active>'0'"));
        $categoryinfosub = getcategoryinfo($cidinfo3['cid']);
        $cnum = " (".$snumrows."/".$categoryinfosub['downloads'].")";
      } else {
        $cnum = "";
      }
      $myimage = myimage("icon+.png");
      echo "&nbsp;&nbsp;<img align='middle' src='$myimage' border='0' height='16' width='16' alt='' title=''>";
      echo "<font class='content'><a href='modules.php?name=$module_name&amp;cid=".$cidinfo3['cid']."'>".$cidinfo3['title']."</a>$cnum</font>";
      newcategorygraphic($cidinfo3['cid']);
      echo "<br />\n";
      $space++;
    }
    echo "</td>\n";
    if ($count < 2) { $dum = 1; }
    $count++;
    if ($count == 3) { echo "</tr>\n"; $count = 0; $dum = 0; }
  }
  if ($dum == 1 && $count == 2) {
    echo "<td>&nbsp;</td>\n</tr>\n</table>\n";
  } elseif ($dum == 1 && $count == 1) {
    echo "<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n</table>\n";
  } elseif ($dum == 0) {
    echo "</tr>\n</table>\n";
  }
}
$listrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE active>'0' AND cid='$cid'"));
if ($listrows > 0) {
  $op = $query = "";
  $orderbyTrans = convertorderbytrans($orderby);
  echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>";
  echo "<tr><td colspan='2'><hr noshade size='1'></td></tr>";
  echo "<tr><td align='center' colspan='2'><font class='content'>"._SORTDOWNLOADSBY.": ";
  echo ""._TITLE." (<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=titleA'>A</a>\<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=titleD'>D</a>) ";
  echo ""._DATE." (<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=dateA'>A</a>\<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=dateD'>D</a>) ";
  echo ""._POPULARITY." (<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=hitsA'>A</a>\<a href='modules.php?name=$module_name&amp;cid=$cid&amp;orderby=hitsD'>D</a>)";
  echo "<br /><strong>"._RESSORTED.": $orderbyTrans</strong></font></td></tr>\n";
  echo "</table>";
  $totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE active='1' AND cid=$cid"));
  pagenums($cid, $query, $orderby, $op, $totalselected, $dl_config['perpage'], $max);
  echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>";
  // START LISTING
  $x = 0;
  $a = 0;
  $result=$db->sql_query("SELECT lid FROM ".$prefix."_nsngd_downloads WHERE active>'0' AND cid=$cid ORDER BY $orderby LIMIT $min,".$dl_config['perpage']);
  while(list($lid)=$db->sql_fetchrow($result)) {
    if ($a == 0) { echo "<tr>"; }
    echo "<td valign='top' width='50%'><font class='content'>";
    showlisting($lid);
    echo "</font></td>";
    $a++;
    if ($a == 2) { echo "</tr>"; $a = 0; }
    $x++;
  }
  if ($a == 1) { echo "<td width=\"50%\">&nbsp;</td></tr>"; } else { echo "</tr>"; }
  echo "</table>";
  // END LISTING
  $orderby = convertorderbyout($orderby);
  pagenums($cid, $query, $orderby, $op, $totalselected, $dl_config['perpage'], $max);
}
CloseTable();
include_once("footer.php");

?>
