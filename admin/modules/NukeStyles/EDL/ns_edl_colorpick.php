<?php

/******************************************************/
/* ================================                   */
/* Enhanced Downloads Module - V3.0                   */
/* ================================                   */
/*                                                    */
/* Released: January, 8 2017                          */
/* Modified by w2ibc http://www.w2ibc.com             */
/* w2ibc@w2ibc.com                                    */
/*                                                    */
/* ================================                   */
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* Francisco Burzi & the Nuke credits MUST            */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

//include_once("admin/modules/NukeStyles/EDL/ns_edl_functions.php");
//include_once("admin/modules/NukeStyles/EDL/ns_edl_language.php");

function ns_color_pick($field) {

?>

<HTML>
<HEAD>
<TITLE>NukeStyles EDL V2.0 - Color Picker</TITLE>  
<SCRIPT language="JavaScript">
<!--
var fast
var red
var yel
var gre
var alertTold=0
binval=new Array('0000','0001','0010','0011','0100','0101','0110','0111','1000','1001','1010','1011','1100','1101','1110','1111')
hexval=new Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F')
bincol=new Array(8)

fixed_red=new Array('255','255','255','255','255','255','200','150','100','50','0','0','0','0','0','0','0','0','0','0','0','50','100','150','200','255','255','240','220','200')

fixed_gre=new Array('0','50','100','150','200','255','255','255','255','255','255','255','255','255','255','255','200','150','100','50','0','0','0','0','0','0','255','240','220','200')

fixed_blue=new Array('0','0','0','0','0','0','0','0','0','0','0','50','100','150','200','255','255','255','255','255','255','255','255','255','255','255','255','240','220','200')

function dectohex(color)
{
for(j=0;j<=7;j++)bincol[j]=0;

for(i=0;i<=7;i++)
{
if (color>=1){
       bincol[i]=color%2
       color=Math.floor(color/2)
}
else bincol[i]=0
}
hex1=String(bincol[7])
hex2=String(bincol[3])

for(j=6;j>=4;j--)
{
hex1=hex1+String(bincol[j])
hex2=hex2+String(bincol[j-4])
}
for (i=0;i<=15;i++)
{
if(hex1==binval[i])hexcolor1=hexval[i]
if(hex2==binval[i])hexcolor2=hexval[i]
}
hexcolor=String(hexcolor1)+ String(hexcolor2)
return hexcolor
}

function turnhextodec(color)
{
alertTold=0
hextodec(color)
}

function hextodec(color)
{
if(color.length>6)
{
color=color.substring(0,6)
document.htmlcolor.code.value=color
hextodec(color)
}

var col=new Array(6)
var colString = new Array(3)
var decval = new Array(3)
var successCounter=0
for(j=0;j<=5;j++)
{
col[j]=color.substring(j,j+1)
for (i=0;i<=15;i++)
	{
	if(col[j]==hexval[i] || col[j]==hexval[i].toLowerCase())
		{
		col[j]=binval[i]
		successCounter++
		}
	}
}

if(successCounter==6)
{

for(i=0;i<=2;i++)colString[i]=String(col[2*i]) + String(col[2*i+1])

for(j=0;j<=2;j++)
{
	decval[j]=0
	for(i=1;i<=8;i++)
	{
	oddeven=colString[j].substring(i-1,i)
      decval[j]=2*decval[j]
	if(oddeven==1)decval[j]++
	}
document.forms['red'].rednr.value=decval[0]
document.forms['yel'].yelnr.value=decval[1]
document.forms['gre'].grenr.value=decval[2]
document.bgColor=color
}
}
else
{
if(alertTold==0)
	{
	alert("You have used one or more forbidden characters in the color code")
	alertTold=1
	}
}
}

function color_change()
{
if(document.forms['red'].rednr.value>255)document.forms['red'].rednr.value
=255
if(document.forms['red'].rednr.value<0)document.forms['red'].rednr.value
=0
if(document.forms['yel'].yelnr.value>255)document.forms['yel'].yelnr.value
=255
if(document.forms['yel'].yelnr.value<0)document.forms['yel'].yelnr.value
=0
if(document.forms['gre'].grenr.value>255)document.forms['gre'].grenr.value
=255
if(document.forms['gre'].grenr.value<0)document.forms['gre'].grenr.value
=0
red=document.forms['red'].rednr.value
yel=document.forms['yel'].yelnr.value
gre=document.forms['gre'].grenr.value
hexbgcolor=dectohex(red)+dectohex(yel)+dectohex(gre)
document.bgColor=hexbgcolor
document.htmlcolor.code.value=hexbgcolor
}


//function increment(col,sign)
//{
//eval('document.forms["'+col+'"].'+col+'nr.value=1*document.forms["'+col+'"].'+col+'nr.value'+sign+'1*5')
//}

function increment(col,sign,faster)
{
eval('document.forms["'+col+'"].'+col+'nr.value=1*document.forms["'+col+'"].'+col+'nr.value'+sign+'1*1')
color_change()
if (faster=="yes")
{
mycol=col
mysign=sign
fast = setTimeout("increment(mycol,mysign,'yes')",10)
}
}

function insert_col(ord)
{
document.forms['red'].rednr.value=fixed_red[ord]
document.forms['yel'].yelnr.value=fixed_gre[ord]
document.forms['gre'].grenr.value=fixed_blue[ord]
color_change()
}

//-->
</SCRIPT>
</HEAD>

<BODY onload="color_change()">
<center>

<div align="justify"><Font Face=Arial size=1><B>Choose a color value from the various options, then click the Submit button to transfer the value to the Form on the main page.</B></font></div><br />

<FORM name=red onSubmit="return false">
<Font Face=Arial size=1 color=red><B>RED Channel</B></font>
<br /><INPUT type=submit value=" < " onclick="increment('red','-','no');"  onMouseDown="increment('red','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></INPUT>
<INPUT type=submit value=" > " onclick="increment('red','+');" onMouseDown="increment('red','+','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></INPUT><INPUT name=rednr type=text size=4 value=125 onChange="color_change()"></INPUT></FORM>

<FORM name=yel onSubmit="return false">
<Font Face=Arial size=1 color=green><B>GREEN Channel</B></font>
<br /><INPUT type=submit value=" < " onclick="increment('yel','-');"   onMouseDown="increment('yel','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></INPUT>
<INPUT type=submit value=" > " onclick="increment('yel','+');"  onMouseDown="increment('yel','+','yes');" onMouseUp="clearTimeout(fast)"  onMouseOut="clearTimeout(fast)" class=buttons></INPUT>
<INPUT name=yelnr type=text size=4 value=125 onChange="color_change()"></INPUT></FORM>

<FORM name=gre onSubmit="return false">
<Font Face=Arial size=1 color=blue><B>BLUE Channel</B></font>
<br /><INPUT type=submit value=" < " onclick="increment('gre','-');" onMouseDown="increment('gre','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></INPUT>
<INPUT type=submit value=" > " onclick="increment('gre','+')" onMouseDown="increment('gre','+','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></INPUT>
<INPUT name=grenr type=text size=4 value=125 onChange="color_change()"></INPUT></FORM>

<Font Face=Arial size=1><B>Color Picker</B></font>

<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 COLS=10 >
<TR>
<TD BGCOLOR="#FF0000"><A HREF="" onClick="insert_col('0');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FF3200"><A HREF="" onClick="insert_col('1');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FF6400"><A HREF="" onClick="insert_col('2');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FF9600"><A HREF="" onClick="insert_col('3');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FFC800"><A HREF="" onClick="insert_col('4');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FFFF00"><A HREF="" onClick="insert_col('5');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#C8FF00"><A HREF="" onClick="insert_col('6');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#96FF00"><A HREF="" onClick="insert_col('7');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#64FF00"><A HREF="" onClick="insert_col('8');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#32FF00"><A HREF="" onClick="insert_col('9');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>
</TR>

<TR>
<TD BGCOLOR="#00FF00"><A HREF="" onClick="insert_col('10');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#00FF32"><A HREF="" onClick="insert_col('11');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#00FF64"><A HREF="" onClick="insert_col('12');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#33FF96"><A HREF="" onClick="insert_col('13');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#00FFC8"><A HREF="" onClick="insert_col('14');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#00FFFF"><A HREF="" onClick="insert_col('15');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#00C8FF"><A HREF="" onClick="insert_col('16');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#0096FF"><A HREF="" onClick="insert_col('17');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#0064FF"><A HREF="" onClick="insert_col('18');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#0032FF"><A HREF="" onClick="insert_col('19');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>
</TR>

<TR>
<TD BGCOLOR="#0000FF"><A HREF="" onClick="insert_col('20');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>


<TD BGCOLOR="#3200FF"><A HREF="" onClick="insert_col('21');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#6400FF"><A HREF="" onClick="insert_col('22');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#9600FF"><A HREF="" onClick="insert_col('23');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#C800FF"><A HREF="" onClick="insert_col('24');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FF00FF"><A HREF="" onClick="insert_col('25');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#FFFFFF"><A HREF="" onClick="insert_col('26');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#F0F0F0"><A HREF="" onClick="insert_col('27');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#DCDCDC"><A HREF="" onClick="insert_col('28');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>

<TD BGCOLOR="#C8C8C8"><A HREF="" onClick="insert_col('29');return false"><IMG SRC="pic.gif" BORDER=0 HEIGHT=20 WIDTH=10></A></TD>
</TR>
</TABLE><br />

<script language="JavaScript">
function setForm() {
    opener.document.tabledesign.<?php $field ?>.value = document.htmlcolor.code.value;
    self.close();
    return false;
}
</script>

<FORM name=htmlcolor onSubmit="return setForm();">
<Font Face=Arial size=1 color=black><B>HexaDecimal Color</B></font><br />
<INPUT type=text size=12 name=code value=7D7D7D onChange="turnhextodec(document.forms.htmlcolor.code.value)"></INPUT>
<br /><br /><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;
<input type="button" value="Close" onclick="window.close()">
</form>

</center>
</BODY>
</HTML>

<?
 
}
 
switch($op) {

    default:
    ns_color_pick($field);
    break;
    
}
  
} else {
    echo "Access Denied";
}

?>