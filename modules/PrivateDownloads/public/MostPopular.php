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

include_once("header.php");
menu(1);
echo "<br />";
OpenTable();
echo "<table border='0' width='100%'><tr><td align='center'>\n";
if ($ratenum != "" && $ratetype != "") {
  $dl_config['mostpopular'] = $ratenum;
  if ($ratetype == "percent") $dl_config['mostpopulartrig'] = 1;
}
if ($dl_config['mostpopulartrig'] == 1) {
  //$mostpopularpercent = $dl_config['mostpopular'];
  $result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_downloads WHERE active>'0'");
  $totalmostpopdownloads = $db->sql_numrows($result);
  $dl_config['mostpopular'] = $dl_config['mostpopular'] / 100;
  $dl_config['mostpopular'] = $totalmostpopdownloads * $dl_config['mostpopular'];
  $dl_config['mostpopular'] = round($dl_config['mostpopular']);
}
if ($dl_config['mostpopulartrig'] == 1) {
  echo "<center><font class='option'><strong>"._MOSTPOPULAR." ".$dl_config['mostpopular']."% ("._OFALL." $totalmostpopdownloads "._DOWNLOADS.")</strong></font></center>\n";
} else {
  echo "<center><font class='option'><strong>"._MOSTPOPULAR." ".$dl_config['mostpopular']."</strong></font></center>\n";
}
echo "<tr><td align='center'>"._SHOWTOP.": [ <a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=num'>10</a> - ";
echo "<a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=25&amp;ratetype=num'>25</a> - ";
echo "<a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=50&amp;ratetype=num'>50</a> | ";
echo "<a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=1&amp;ratetype=percent'>1%</a> - ";
echo "<a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=5&amp;ratetype=percent'>5%</a> - ";
echo "<a href='modules.php?name=$module_name&amp;op=MostPopular&amp;ratenum=10&amp;ratetype=percent'>10%</a> ]</td></tr\n>";
echo "</table>\n";
echo "<table border='0' cellpadding='0' cellspacing='4' width='100%'>\n";
$result = $db->sql_query("SELECT lid FROM ".$prefix."_nsngd_downloads WHERE active>'0' ORDER BY hits DESC LIMIT 0,".$dl_config['mostpopular']);
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
