<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_CONFIG." ".$ba_config['version_number'];
@include_once("header.php");
title(_BA_CONFIG." ".$ba_config['version_number']);
BAAdmin();
echo "<br>\n";
OpenTable();
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<input type='hidden' name='op' value='BAConfigSave'>\n";
echo "<tr><td colspan='2' align='center'><b>"._BA_CONFIG." - "._BA_OPT."</b></td></tr>\n";
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_IPP.":</td><td><input type='text' size='5' name='ipp' value='".$ba_config['ipp']."'></td></tr>\n";
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_IMPAMT.":</td><td><input type='text' name='impamnt' size='5' value='".$ba_config['impamnt']."'></td></tr>\n";
echo "<tr><td align='right' bgcolor='$bgcolor2' valign='top'>"._BA_USEGFXCHECK."</td>\n<td>";
if (extension_loaded("gd")) {
  $ck0 = $ck1 = $ck2 = $ck3 = "";
  if ($ba_config['usegfxcheck']==0) { $ck0 = " checked"; } elseif ($ba_config['usegfxcheck']==1) { $ck1 = " checked"; } elseif ($ba_config['usegfxcheck']==2) { $ck2 = " checked"; } elseif ($ba_config['usegfxcheck']==3) { $ck3 = " checked"; }
  echo "<input type='radio' name='usegfxcheck' value='0'$ck0>"._BA_NC."<br>\n";
  echo "<input type='radio' name='usegfxcheck' value='1'$ck1>"._BA_RC."<br>\n";
  echo "<input type='radio' name='usegfxcheck' value='2'$ck2>"._BA_LC."<br>\n";
  echo "<input type='radio' name='usegfxcheck' value='3'$ck3>"._BA_CA."";
} else {
  echo "<input type='hidden' name='usegfxcheck' value='0'>"._BA_GD."";
}
echo "</td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>";
echo "</form>\n";
echo "</table></center>\n";
CloseTable();
@include_once("footer.php");

?>