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

$pagetitle = _DOWNCONFIG;
include_once("header.php");
$dl_config = gdget_configs();
title($pagetitle);
dladminmain();
echo "<br />\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMBLOCKUNREGMODIFY."</td><td><select name='xblockunregmodify'>\n";
echo "<option value='0'";
if ($dl_config['blockunregmodify'] == 0) { echo " selected"; }
echo "> "._YES." </option>\n<option value='1'";
if ($dl_config['blockunregmodify'] == 1) { echo " selected"; }
echo "> "._NO." </option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMMOSTPOPULAR."</td><td><select name='xmostpopular'>\n";
echo "<option value='".$dl_config['mostpopular']."' selected> ".$dl_config['mostpopular']." </option>\n";
for ($i=1; $i <= 5; $i++) { $j = $i * 5; echo "<option value='$j'> $j </option>\n"; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMMOSTPOPULARTRIG."</td><td><select name='xmostpopulartrig'>\n";
echo "<option value='0'";
if ($dl_config['mostpopulartrig'] == 0) { echo " selected"; }
echo "> "._NUMBER." </option>\n<option value='1'";
if ($dl_config['mostpopulartrig'] == 1) { echo " selected"; }
echo "> "._PERCENT." </option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMPERPAGE."</td><td><select name='xperpage'>\n";
echo "<option value='".$dl_config['perpage']."' selected> ".$dl_config['perpage']." </option>\n";
for ($i=1; $i <= 5; $i++) { $j = $i * 10; echo "<option value='$j'> $j </option>\n"; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMADMPERPAGE."</td><td><select name='xadmperpage'>\n";
echo "<option value='".$dl_config['admperpage']."' selected> ".$dl_config['admperpage']." </option>\n";
for ($i=1; $i <= 8; $i++) { $j = $i * 25; echo "<option value='$j'> $j </option>\n"; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMRESULTS."</td><td><select name='xresults'>\n";
echo "<option value='".$dl_config['results']."' selected> ".$dl_config['results']." </option>\n";
for ($i=1; $i <= 5; $i++) { $j = $i * 10; echo "<option value='$j'> $j </option>\n"; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMPOPULAR."</td><td><select name='xpopular'>\n";
echo "<option value='".$dl_config['popular']."' selected> ".$dl_config['popular']." </option>\n";
for ($i=1; $i <= 10; $i++) { $j = $i * 100; echo "<option value='$j'> $j </option>\n"; }
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMSHOWDOWNLOAD."</td><td><select name='xshow_download'>\n";
if($dl_config['show_download']=="0") { $dl_config['show_download_text'] = _DL_NO; } else { $dl_config['show_download_text'] = _DL_YES; }
echo "<option value='".$dl_config['show_download']."' selected> ".$dl_config['show_download_text']." </option>\n";
echo "<option value='0'>"._DL_NO."</option><option value='1'>"._DL_YES."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMSHOWNUM."</td><td><select name='xshow_links_num'>\n";
echo "<option value='0'";
if ($dl_config['show_links_num'] == 0) { echo " selected"; }
echo "> "._NO." </option>\n<option value='1'";
if ($dl_config['show_links_num'] == 1) { echo " selected"; }
echo "> "._YES." </option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._ADMUSEGFX."</td><td><select name='xusegfxcheck'>\n";
echo "<option value='0'";
if ($dl_config['usegfxcheck'] == 0) { echo " selected"; }
echo "> "._NO." </option>\n<option value='1'";
if ($dl_config['usegfxcheck'] == 1) { echo " selected"; }
echo "> "._YES." </option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._DL_DATEFORMAT.":<br />"._DL_DATEMSG."</td><td>";
echo "<input size='30' maxlength='60' type='text' name='xdateformat' value='".$dl_config['dateformat']."'></td></tr>\n";
echo "<input type='hidden' name='op' value='DLConfigSave'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>
