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

if (!isset($min)) $min=0;
if (!isset($max)) $max=$min+$dl_config['results'];
if(isset($orderby)) { $orderby = convertorderbyin($orderby); } else { $orderby = "title ASC"; }
$query = addslashes($query);
$totalselected = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE (title LIKE '%$query%' OR description LIKE '%$query%') AND active>'0'"));
$the_query = stripslashes($query);
$the_query = str_replace("\'", "'", $the_query);
include_once("header.php");
menu(1);
echo "<br />";
if ($query != "") {
  title(_SEARCHRESULTS4.": $the_query");
  OpenTable();
  echo "<table width='100%' bgcolor='$bgcolor2'><tr><td align='center'><font class='storytitle'><strong>"._USUBCATEGORIES."</strong></font></td></tr></table>";
  $crows  = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE title LIKE '%$query%' AND active>'0' ORDER BY title DESC"));
  if ($crows > 0) {
    $result2 = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE title LIKE '%$query%' ORDER BY title DESC");
    while($cidinfo2 = $db->sql_fetchrow($result2)) {
      $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='".$cidinfo2['cid']."'"));
      $cidinfo3 = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE cid='".$cidinfo2['cid']."'"));
      if ($cidinfo3['parentid'] > 0) $cidinfo3['title'] = getparent($cidinfo3['parentid'], $cidinfo3['title']);
      $cidinfo3['title'] = str_replace($query, "<strong>$query</strong>", $cidinfo3['title']);
      echo "<strong><big>·</big></strong>&nbsp;<a href='modules.php?name=$module_name&amp;cid=".$cidinfo2['cid']."'>".$cidinfo3['title']."</a> ($numrows)<br />";
    }
  } else {
    echo "<center><font class='option'><strong>"._NOMATCHES."</strong></font><br /><br /></center>";
  }
  CloseTable();
  echo"<br />\n";
  OpenTable();
  echo "<table width='100%' bgcolor='$bgcolor2'><tr><td align='center'><font class='storytitle'><strong>"._DOWNLOADS."</strong></font></td></tr></table>";
  $nrows  = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE (title LIKE '%$query%' OR description LIKE '%$query%') AND active>'0' ORDER BY $orderby LIMIT $min,".$dl_config['results']));
  if ($nrows>0) {
    echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>";
    $orderbyTrans = convertorderbytrans($orderby);
    echo "<tr><td align='center' colspan='2'><font class='content'>"._SORTDOWNLOADSBY.": ";
    echo ""._TITLE." (<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=titleA'>A</a>\<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=titleD'>D</a>) ";
    echo ""._DATE." (<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=dateA'>A</a>\<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=dateD'>D</a>) ";
    echo ""._POPULARITY." (<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=hitsA'>A</a>\<a href='modules.php?name=$module_name&amp;op=search&amp;query=$the_query&amp;orderby=hitsD'>D</a>)";
    echo "<br /><strong>"._RESSORTED.": $orderbyTrans</strong></center></td></tr>";
    echo "</table>";
    pagenums($cid, $query, $orderby, $op, $totalselected, $dl_config['perpage'], $max);
    $x = 0;
    $a = 0;
    $result = $db->sql_query("SELECT lid FROM ".$prefix."_nsngd_downloads WHERE (title LIKE '%$query%' OR description LIKE '%$query%') AND active>'0' ORDER BY $orderby LIMIT $min,".$dl_config['results']);
    echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>";
    while(list($lid) = $db->sql_fetchrow($result)) {
      if ($a == 0) { echo "<tr>"; }
      echo "<td valign='top' width='50%'><font class='content'>";
      showresulting($lid);
      echo "</font></td>";
      $a++;
      if ($a == 2) { echo "</tr>"; $a = 0; }
      $x++;
    }
    if ($a ==1) { echo "<td width=\"50%\">&nbsp;</td></tr>"; } else { echo "</tr>"; }
    $orderby = convertorderbyout($orderby);
    echo "</table>";
    pagenums($cid, $query, $orderby, $op, $totalselected, $dl_config['perpage'], $max);
  } else {
    echo "<center><font class='option'><strong>"._NOMATCHES."</strong></font></center><br /><br />";
  }
}
CloseTable();
include_once("footer.php");

?>
