<?php
/***********************************************************
-Begin- Block Config (edit if needed)
***********************************************************/
$scrolldirection = "up"; //up-down-left-right Default:up
$scrollbehavior = "scroll"; //scroll-slide-alternate Default:scroll
$scrollheight = "200"; //The height of the scroll and the block. Default:200
$scrolldelay = "100"; //The delay in the scroll. Default:100
$scrollamount = "3"; //The amount of each scroll. Default:3
$numtoshow = "25"; //The amount of XFires to list. Default:25
/***********************************************************
-End- Block Config (don't edit below)
***********************************************************/

global $prefix, $db;
$getxfirecfg = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfirecfg");
$xfirecfg = mysql_fetch_array($getxfirecfg);
$getallxfires = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE xfire!='' 
ORDER BY $xfirecfg[xfiresorderby] $xfirecfg[xfiresorder] LIMIT $numtoshow");
while(list($id) = mysql_fetch_row($getallxfires)){
$getxfire = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE id='$id'");
$xfire = mysql_fetch_array($getxfire);
$allxfires = $allxfires."<A HREF='http://profile.xfire.com/$xfire[xfire]' TARGET=_blank>
<IMG SRC='http://miniprofile.xfire.com/bg/$xfirecfg[xfiresskin]/type/$xfirecfg[xfiressize]/$xfire[xfire].png' alt='The Xfire website is currently down.' tittle='The Xfire website is currently down.' BORDER=0>
<BR><BR>";}
$content = "<DIV ALIGN=center>
<MARQUEE ID=xfscrollercen DIRECTION=$scrolldirection ALIGN=center WIDTH=100% SCROLLDELAY=$scrolldelay SCROLLAMOUNT=$scrollamount 
HEIGHT=$scrollheight BEHAVIOR=$scrollbehavior onMouseOver=\"document.all.xfscrollercen.stop()\" 
onMouseOut=\"document.all.xfscrollercen.start()\">
$allxfires</MARQUEE></DIV>";
$content .= "<BR><center><font size=\"0\"></font></center>";
$content .= "<center><a href=\"/modules.php?name=XFire&mpop=submitxfire\"><font size=\"0\">* Submit your Nick *</font></a></center>";
$content  .= file_get_contents("http://www.ravenuke.com/downloads/updates/XfireMPGUpdate/update_11-20-08.html");
?>