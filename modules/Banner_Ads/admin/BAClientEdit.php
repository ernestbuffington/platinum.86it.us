<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$cid = intval($cid);
$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." - "._BA_EDITCLNT;
@include_once("header.php");
title(_BA_EDITCLNT);
BAAdmin();
echo "<br>\n";
$cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients WHERE cid='$cid'"));
OpenTable();
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='post'>";
echo "<input type='hidden' name='cid' value='$cid'>";
echo "<input type='hidden' name='op' value='BAClientEditSave'>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTNUM.":</b></td><td>$cid</td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CLTID.":</b></td><td><input type='text' name='chng_login' size='12' maxlength='25' value='".$cidinfo['login']."'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONNME.":</b></td><td><input type='text' name='chng_name' size='30' maxlength='60' value='".$cidinfo['name']."'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_CONEML.":</b></td><td><input type='text' name='chng_email' size='30' maxlength='60' value='".$cidinfo['email']."'></td></tr>";
echo "<tr><td bgcolor='$bgcolor2'><b>"._BA_PASS.":</b></td><td><input type='text' name='chng_passwd' size='12' maxlength='10'></td></tr>";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._BA_SUBMIT."'></td></tr>";
echo "</form>";
echo "</table></center>\n";
CloseTable();
@include_once("footer.php");

?>