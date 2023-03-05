<?php

/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* XFire Module v2                                                      */
/* By: MajorPlaying (mp@majorplaying.net)                               */
/* http://majorplaying.net                                              */
/* Copyright (c) 2000-2007 by MajorPlaying                              */
/* Modified for Nuke-Evolution by Wolfgrafix                            */
/************************************************************************/


/*****[CHANGES]**********************************************************
-=[Base]=-
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);


$mpop = $_REQUEST['mpop'];
$modulename = $_REQUEST['modulename'];
$xfirestoshow = $_REQUEST['xfirestoshow'];
$xfiresorderby = $_REQUEST['xfiresorderby'];
$xfiresorder = $_REQUEST['xfiresorder'];
$xfiresskin = $_REQUEST['xfiresskin'];
$xfiressize = $_REQUEST['xfiressize'];
$allowsubmit = $_REQUEST['allowsubmit'];
$xfire = $_REQUEST['xfire'];
$uid = $_REQUEST['uid'];
$xfireid = $_REQUEST['xfireid'];
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
$getxfirecfg = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfirecfg");
$xfirecfg = mysql_fetch_array($getxfirecfg);
if(!$xfirecfg){header("Location: modules/$module_name/xfireinstall.php");}
title("$xfirecfg[modulename]");
$index=1;
if(is_admin($admin)){
if($mpop == "admincfg"){$addmpop = "&mpop=admincfg";}
if($mpop != "admincfg"){$adminlink = "<CENTER>
<A HREF='modules.php?name=$module_name&mpop=admincfg'>"._OPENCONFIG."</A></CENTER>";}
if($mpop == "admincfg"){
if($xfirecfg[xfiresorderby] == "id"){$currorderby = ""._SUBMITTED."";}
if($xfirecfg[xfiresorderby] == "uid"){$currorderby = ""._USERID."";}
if($xfirecfg[xfiresorderby] == "xfire"){$currorderby = ""._XFIRENAME."";}
if($xfirecfg[xfiresorder] == "ASC"){$currorder = ""._ASCENDING."";}
if($xfirecfg[xfiresorder] == "DESC"){$currorder = ""._DESCENDING."";}
if($xfirecfg[xfiresskin] == "bg"){$currskin = ""._DEFAULT."";}
if($xfirecfg[xfiresskin] == "os"){$currskin = ""._FANTASY."";}
if($xfirecfg[xfiresskin] == "co"){$currskin = ""._COMBAT."";}
if($xfirecfg[xfiresskin] == "sf"){$currskin = ""._SCIFI."";}
if($xfirecfg[xfiresskin] == "sh"){$currskin = ""._SHADOW."";}
if($xfirecfg[xfiresskin] == "wow"){$currskin = ""._WOW."";}
if($xfirecfg[xfiressize] == "0"){$currsize = ""._CLASSIC."";}
if($xfirecfg[xfiressize] == "1"){$currsize = ""._COMPACT."";}
if($xfirecfg[xfiressize] == "2"){$currsize = ""._SHORTWIDE."";}
if($xfirecfg[xfiressize] == "3"){$currsize = ""._TINY."";}
if($xfirecfg[xfiressize] == "4"){$currsize = ""._MICRO."";}
$admincfg = "<TABLE ALIGN=center WIDTH=100%><FORM METHOD=post>
<TR>
<TD ALIGN=center><B>"._TITLE.":</B><BR><INPUT TYPE=text NAME=modulename VALUE='$xfirecfg[modulename]' SIZE=15></TD>
<TD ALIGN=center><B>"._NUMTOSHOW.":</B><BR><INPUT TYPE=text NAME=xfirestoshow SIZE=5 VALUE='$xfirecfg[xfirestoshow]'></TD>
<TD ALIGN=center><B>"._ORDERBY.":</B><BR><SELECT NAME=xfiresorderby>
<OPTION VALUE='$xfirecfg[xfiresorderby]'>$currorderby</OPTION><OPTION VALUE='$xfirecfg[xfiresorderby]'></OPTION>
<OPTION VALUE='id'>"._SUBMITTED."</OPTION><OPTION VALUE='uid'>"._USERID."</OPTION>
<OPTION VALUE='xfire'>"._XFIRENAME."</OPTION></SELECT></TD>
<TD ALIGN=center><B>"._ORDER.":</B><BR><SELECT NAME=xfiresorder><OPTION VALUE='$xfirecfg[xfiresorder]'>$currorder</OPTION>
<OPTION VALUE='$xfirecfg[xfiresorder]'></OPTION><OPTION VALUE='ASC'>"._ASCENDING."</OPTION>
<OPTION VALUE='DESC'>"._DESCENDING."</OPTION>
</SELECT></TD>
<TD ALIGN=center><B>"._XFIRESKIN.":</B><BR><SELECT NAME=xfiresskin><OPTION VALUE='$xfirecfg[xfiresskin]'>$currskin</OPTION>
<OPTION VALUE='$xfirecfg[xfiresskin]'></OPTION><OPTION VALUE='bg'>"._DEFAULT."</OPTION>
<OPTION VALUE='os'>"._FANTASY."</OPTION><OPTION VALUE='co'>"._COMBAT."</OPTION><OPTION VALUE='sf'>"._SCIFI."</OPTION>
<OPTION VALUE='sh'>"._SHADOW."</OPTION><OPTION VALUE='wow'>"._WOW."</OPTION>
</SELECT></TD>
<TD ALIGN=center><B>"._XFIRESIZE.":</B><BR><SELECT NAME=xfiressize><OPTION VALUE='$xfirecfg[xfiressize]'>$currsize</OPTION>
<OPTION VALUE='$xfirecfg[xfiressize]'></OPTION><OPTION VALUE='0'>"._CLASSIC."</OPTION>
<OPTION VALUE='1'>"._COMPACT."</OPTION><OPTION VALUE='2'>"._SHORTWIDE."</OPTION><OPTION VALUE='3'>"._TINY."</OPTION>
<OPTION VALUE='4'>"._MICRO."</OPTION>
</SELECT></TD>
<TD ALIGN=center><B>"._XFIRESUBMIT.":</B><BR><SELECT NAME=allowsubmit>
<OPTION VALUE='$xfirecfg[allowsubmit]'>$xfirecfg[allowsubmit]</OPTION>
<OPTION VALUE='$xfirecfg[allowsubmit]'></OPTION><OPTION VALUE='Yes'>Yes</OPTION>
<OPTION VALUE='No'>No</OPTION>
</SELECT></TD>
</TR>
<TR>
<TD ALIGN=center COLSPAN=100%><BR><INPUT TYPE=submit VALUE='"._UPDATE."'>
<INPUT TYPE=hidden NAME=mpop VALUE='adminupdate'></TD>
</TR>
</FORM></TABLE>
<CENTER><A HREF='modules.php?name=$module_name'>"._CLOSECONFIG."</A></CENTER>";
$adminadd = "<CENTER><FORM METHOD=post><B>"._ENTERXFIRENAME.":</B> <INPUT TYPE=text NAME=xfire MAXLENGTH='25'> 
<B>"._ENTERNAMEORID.":</B> <INPUT TYPE=text NAME=uid>
<INPUT TYPE=submit VALUE='"._ADDXFIRE."'><INPUT TYPE=hidden NAME=mpop VALUE='adminsubmit'></FORM></CENTER><HR>";
OpenTable();
title(""._XFIRECONFIG."");
echo "$adminadd";
echo "$admincfg";
CloseTable();
}else{$admincfg = "";}
if($mpop == "adminupdate"){
$db->sql_query("UPDATE ".$prefix."_mpg_xfirecfg SET modulename='$modulename', xfiresorder='$xfiresorder', 
xfiresorderby='$xfiresorderby', xfirestoshow='$xfirestoshow', xfiresskin='$xfiresskin', xfiressize='$xfiressize', 
allowsubmit='$allowsubmit'") or die
('<FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._UNABLEUPDATEXFIRECFG <B>"._SQLERROR.":</B> '.mysql_error());
header("Location: modules.php?name=$module_name");
}
if($mpop == "adminmodify"){
$db->sql_query("UPDATE ".$prefix."_mpg_xfires SET xfire='$xfire', uid='$uid' WHERE id='$xfireid'") or die
('<FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._UNABLEUPDATEXFIRE." <B>"._SQLERROR.":</B> '.mysql_error());
header("Location: modules.php?name=$module_name");}
if($mpop == "admindelete"){
$db->sql_query("DELETE FROM ".$prefix."_mpg_xfires WHERE id='$xfireid'") or die
('<FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._UNABLEDELETEXFIRE." <B>"._SQLERROR.":</B> '.mysql_error());
header("Location: modules.php?name=$module_name");}
if($mpop == "adminsubmit"){
$db->sql_query("INSERT INTO ".$prefix."_mpg_xfires SET xfire='$xfire', uid='$uid'") or die
('<FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._UNABLESUBMITXFIRE." <B>"._SQLERROR.":</B> '.mysql_error());
header("Location: modules.php?name=$module_name");}
}else{$adminlink = ""; $admincfg = ""; $adminadd = "";}
if(is_user($user)){
$getuserxfire = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE uid='$cookie[0]'");
$userxfire = mysql_fetch_array($getuserxfire);
if((!$userxfire) AND ($xfirecfg[allowsubmit] == "Yes") AND (!$mpop)){
$submitlink = "<CENTER><A HREF='modules.php?name=$module_name&mpop=submitxfire'>"._SUBMITXFIRE."</A></CENTER>";}
if($mpop == "submitxfire"){
OpenTable();
title(""._XFIRESUBMIT."");
echo "<CENTER><FORM METHOD=post><B>"._ENTERXFIRENAME.":</B> <INPUT TYPE=text NAME=xfire MAXLENGTH='25'> 
<INPUT TYPE=submit VALUE='"._SUBMIT."'><INPUT TYPE=hidden NAME=mpop VALUE='xfiresubmit'></FORM></CENTER>";
CloseTable();}
if($mpop == "xfiresubmit"){
$xfirelength = strlen($xfire);
if(($xfirelength > "25") OR ($xfirelength == "0") OR (!$xfirelength)){
echo "<CENTER><FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._INVALIDXFIRE."</CENTER>";}
else{
$db->sql_query("INSERT INTO ".$prefix."_mpg_xfires SET xfire='$xfire', uid='$cookie[0]'") or die
('<FONT COLOR=RED><B>"._ERROR.":</B></FONT> "._UNABLESUBMITXFIRE." <B>"._SQLERROR.":</B> '.mysql_error());
header("Location: modules.php?name=$module_name");}}
}
OpenTable();
if(!$start){$start=0;}
$numofxfires = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires"));
if($start != "0"){
$prevstart = $start - $xfirecfg[xfirestoshow];
if($prevstart < "0"){$prevstart=0;}
}
if($start != "0"){$prevbutton = "
<FORM ACTION='modules.php?name=$module_name&start=$prevstart$addmpop' METHOD=post>
<INPUT TYPE=submit VALUE='"._PREV." $xfirecfg[xfirestoshow]'></FORM>";}
$nextstart = $start + $xfirecfg[xfirestoshow];
if(($nextstart < "0") OR ($nextstart >= $numofxfires)){$nextstart=0;}
if($nextstart != "0"){$nextbutton = "
<FORM ACTION='modules.php?name=$module_name&start=$nextstart$addmpop' METHOD=post>
<INPUT TYPE=submit VALUE='"._NEXT." $xfirecfg[xfirestoshow]'></FORM>";}
$getxfireslist = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires 
ORDER BY $xfirecfg[xfiresorderby] $xfirecfg[xfiresorder] LIMIT $start,$xfirecfg[xfirestoshow]");
while(list($id) = mysql_fetch_row($getxfireslist)){
$getxfire = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE id='$id'");
$xfire = mysql_fetch_array($getxfire);
$getxfireuser = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_id='$xfire[uid]'");
$xfireuser = mysql_fetch_array($getxfireuser);
if(!$xfireuser){$xfireuser[username] = "$xfire[uid]";}
if((is_admin($admin)) AND ($mpop == "admincfg")){
$xfireslist = $xfireslist."<TR><TD ALIGN=center COLSPAN=100%><HR><B>$xfireuser[username]</B><HR>
<A HREF='http://profile.xfire.com/$xfire[xfire]' TARGET=_blank>
<IMG SRC='http://miniprofile.xfire.com/bg/$xfirecfg[xfiresskin]/type/$xfirecfg[xfiressize]/$xfire[xfire].png' alt='The Xfire website is currently down.' tittle='The Xfire website is currently down.' BORDER=0 
TITLE='"._VIEWPROFILE."'></A>
</TD></TR>
<TR><TD ALIGN=center COLSPAN=100%><TABLE ALIGN=center><TR>
<TD ALIGN=center><FORM METHOD=post>
<INPUT TYPE=text NAME=xfire VALUE='$xfire[xfire]'><INPUT TYPE=text NAME=uid VALUE='$xfire[uid]'>
<INPUT TYPE=submit VALUE='"._UPDATE."'>
<INPUT TYPE=hidden NAME=mpop VALUE='adminmodify'><INPUT TYPE=hidden NAME=xfireid VALUE='$xfire[id]'></FORM></TD>
<TD ALIGN=center><FORM METHOD=post><INPUT TYPE=submit VALUE='"._DELETE."'>
<INPUT TYPE=hidden NAME=mpop VALUE='admindelete'><INPUT TYPE=hidden NAME=xfireid VALUE='$xfire[id]'></FORM></TD>
</TR></TABLE></TD>
</TR>";}
else{$xfireslist = $xfireslist."<TR><TD ALIGN=center COLSPAN=100%><HR><B>$xfireuser[username]</B><HR>
<A HREF='http://profile.xfire.com/$xfire[xfire]' TARGET=_blank>
<IMG SRC='http://miniprofile.xfire.com/bg/$xfirecfg[xfiresskin]/type/$xfirecfg[xfiressize]/$xfire[xfire].png' alt='The Xfire website is currently down.' tittle='The Xfire website is currently down.' BORDER=0 
TITLE='"._VIEWPROFILE."'>
</TD></TR><TR><TD></TD></TR>";}
}
echo "<TABLE ALIGN=center>
<TR>
<TD ALIGN=left WIDTH=50%>$prevbutton</TD><TD ALIGN=right WIDTH=50%>$nextbutton</TD>
</TR>
$xfireslist
<TR>
<TD ALIGN=left WIDTH=50%>$prevbutton</TD><TD ALIGN=right WIDTH=50%>$nextbutton</TD>
</TR>
</TABLE>";
echo "$submitlink";
echo "$adminlink";
CloseTable();
//Added copyright popup
include("footer.php");
?>