<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$cid = intval($cid);
echo "<html>\n";
echo "<head><title>"._BA_VIEWCLNT.": $cid</title></head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
$cidinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_nsnba_clients WHERE cid='$cid'"));
echo "<center><table border='0' cellpadding='2' cellspacing='2'>\n";
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CLTID.":</td><td>".$cidinfo['login']." (".$cidinfo['cid'].")</td></tr>";
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CONNME.":</td><td>".$cidinfo['name']."</td></tr>";
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_CONEML.":</td><td><a href='mailto:".$cidinfo['email']."'>".$cidinfo['email']."</a></td></tr>";
echo "<tr><td colspan='2'>&nbsp;</td></tr>";
echo "<tr><td align='right'><b>"._BA_PLCM."</b></td><td><b>#</b></td></tr>";
$actrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='1'"));
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_ACT.":</td><td>$actrows</td></tr>";
$inarows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='0'"));
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_INA.":</td><td>$inarows</td></tr>";
$penrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='-1'"));
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_PEN.":</td><td>$penrows</td></tr>";
$uknrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsnba_banners WHERE cid='$cid' AND active='-2'"));
echo "<tr><td align='right' bgcolor='$bgcolor2'>"._BA_UNP.":</td><td>$uknrows</td></tr>";
echo "</table></center>\n";
echo "</body>\n";
echo "</html>";

?>