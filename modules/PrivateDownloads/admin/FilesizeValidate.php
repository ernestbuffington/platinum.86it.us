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

$pagetitle = _DOWNLOADSADMIN.": "._FILESIZEVALIDATION;
include_once("header.php");
title($pagetitle);
dladminmain();
echo "<br />\n";
OpenTable();
$cidtitle = str_replace ("_", "", $ttitle);
echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='80%'>\n";
if ($cid == 0) {
  echo "<tr><td align='center' colspan='3'><strong>"._CHECKALLDOWNLOADS."</strong><br />"._BEPATIENT."</td></tr>\n";
  $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE active>'0' ORDER BY title");
} else {
  echo "<tr><td align='center' colspan='3'><strong>"._VALIDATINGCAT.": $cidtitle</strong><br />"._BEPATIENT."</td></tr>\n";
  $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE cid='$cid' AND active>'0' ORDER BY title");
}
echo "<tr bgcolor='$bgcolor2'><td width='70%' valign='bottom'><strong>"._FILENAME."</strong></td>\n";
echo "<td align='right' width='15%'><strong>"._OLDSIZE."<br />"._INBYTES."</strong></td>\n";
echo "<td align='right' width='15%'><strong>"._NEWSIZE."<br />"._INBYTES."</strong></td></tr>\n";
while($dresult = $db->sql_fetchrow($result)) {
  echo "<tr bgcolor='$bgcolor1'><td>".stripslashes($dresult['title'])."</td>\n";
  echo "<td align='right'>".number_format($dresult['filesize'])."</td>\n";
  if (!preg_match("#http#i",$dresult['url'])) {
    if (!file_exists($dresult['url'])) {
      echo "<td align='right'>"._FAILED."</td></tr>\n";
      $date = date("M d, Y g:i:a");
      $sub_ip = $_SERVER['REMOTE_ADDR'];
      $db->sql_query("INSERT INTO ".$prefix."_nsngd_mods VALUES (NULL, ".$dresult['lid'].", 0, 0, '', '', '', '"._DSCRIPT."<br />$date', '$sub_ip', 1, '".$dresult['name']."', '".$dresult['email']."', '".$dresult['filesize']."', '".$dresult['version']."', '".$dresult['homepage']."')");
    } else {
      $newsize = filesize($dresult['url']);
      echo "<td align='right'>".number_format($newsize)."</td></tr>\n";
      $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET filesize='$newsize' WHERE lid='".$dresult['lid']."'");
    }
  } else {
    echo "<td align='right'>"._NOTLOCAL."</td></tr>\n";
  }
}
echo "</table>\n";
echo "<br /><center>"._GOBACK."</center>\n";
CloseTable();
include_once("footer.php");

?>
