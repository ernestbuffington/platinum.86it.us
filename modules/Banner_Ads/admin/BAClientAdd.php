<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_ADDCLT;
@include_once("header.php");
title(_BA_ADDCLT);
BAAdmin();
echo "<br>\n";
OpenTable();
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='post'>";
echo "<input type='hidden' name='op' value='BAClientAddSave'>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONNME.":</b></td><td><input type='text' name='new_name' size='30' maxlength='60'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONEML.":</b></td><td><input type='text' name='new_email' size='30' maxlength='60'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTID.":</b></td><td><input type='text' name='new_login' size='12' maxlength='25'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PASS.":</b></td><td><input type='text' name='new_passwd' size='12' maxlength='10'></td></tr>";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>";
echo "</form>\n";
echo "</table></center>\n";
CloseTable();
@include_once("footer.php");

?>