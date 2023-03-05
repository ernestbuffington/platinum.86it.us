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

$dateDB = (date("d-M-Y", $selectdate));
$dateView = (date("F d, Y", $selectdate));
include_once("header.php");
menu(1);
echo "<br />";
OpenTable();
$newdownloadDB = Date("Y-m-d", $selectdate);
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE date LIKE '%$newdownloadDB%' AND active>'0'");
$totaldownloads = $db->sql_numrows($result);
title("$dateView - $totaldownloads "._NEWDOWNLOADS);
echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>\n";
$result = $db->sql_query("SELECT lid FROM ".$prefix."_nsngd_downloads WHERE date LIKE '%$newdownloadDB%' AND active>'0' ORDER BY title ASC");
$a = 0;
while(list($lid) = $db->sql_fetchrow($result)) {
  if ($a == 0) { echo "<tr>"; }
  echo "<td valign='top' width='50%'><font class='content'>";
  showresulting($lid);
  echo "</font></td>";
  $a++;
  if ($a == 2) { echo "</tr>"; $a = 0; }
}
if ($a ==1) { echo "<td width=\"50%\">&nbsp;</td></tr>"; } else { echo "</tr>"; }
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>
