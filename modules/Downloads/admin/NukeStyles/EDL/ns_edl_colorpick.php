<?php

/******************************************************/
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
/* THIS MODULE IS NOT RELEASED UNDER THE GPL/GNU      */
/* LICENSE.                                           */
/*                                                    */
/* You can modifiy all files, EXCEPT the copyright    */
/* file to your liking. But you CANNOT redistribute   */
/* this module for any purpose, without the EXPRESS   */
/* WRITTEN CONSENT from Shawn Archer.                 */
/*                                                    */
/* Also, Francisco Burzi & the Nuke credits MUST      */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if ( !defined('ADMIN_FILE') )
{
	die("Illegal File Access");
}

global $prefix, $db, $admin_file;
if (!stristr($_SERVER['SCRIPT_NAME'], "".$admin_file.".php")) {
    die ("Access Denied");
}

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
	
//include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_functions.php");
//include_once("modules/Downloads/admin/NukeStyles/EDL/ns_edl_language.php");


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
</script>
</HEAD>

<body onload="color_change()">
<center>

<div align="justify"><Font Face=Arial size=1><strong>Choose a color value from the various options, then click the Submit button to transfer the value to the Form on the main page.</strong></font></div><br />


<form name=red onSubmit="return false">
<font Face=Arial size=1 color=red><strong>RED Channel</strong></font>
<br /><input type=submit value=" < " onclick="increment('red','-','no');"  onMouseDown="increment('red','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></input>
<input type=submit value=" > " onclick="increment('red','+');" onMouseDown="increment('red','+','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></input><input name=rednr type=text size=4 value=125 onChange="color_change()"></input></form>

<form name=yel onSubmit="return false">
<Font Face=Arial size=1 color=green><strong>GREEN Channel</strong></font>
<br /><input type=submit value=" < " onclick="increment('yel','-');"   onMouseDown="increment('yel','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></input>
<input type=submit value=" > " onclick="increment('yel','+');"  onMouseDown="increment('yel','+','yes');" onMouseUp="clearTimeout(fast)"  onMouseOut="clearTimeout(fast)" class=buttons></input>
<input name=yelnr type=text size=4 value=125 onChange="color_change()"></input></form>

<form name=gre onSubmit="return false">
<font Face=Arial size=1 color=blue><strong>BLUE Channel</strong></font>
<br /><input type=submit value=" < " onclick="increment('gre','-');" onMouseDown="increment('gre','-','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></input>
<input type=submit value=" > " onclick="increment('gre','+')" onMouseDown="increment('gre','+','yes');" onMouseUp="clearTimeout(fast)" onMouseOut="clearTimeout(fast)" class=buttons></input>
<input name=grenr type=text size=4 value=125 onChange="color_change()"></input></form>



<font Face=Arial size=1><strong>Color Picker</strong></font>

<table border=0 cellspacing=0 cellpadding=0 cols=10 >
<tr>
<td bgcolor="#FF0000"><a href="" onClick="insert_col('0');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FF3200"><a href="" onClick="insert_col('1');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FF6400"><a href="" onClick="insert_col('2');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FF9600"><a href="" onClick="insert_col('3');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FFC800"><a href="" onClick="insert_col('4');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FFFF00"><a href="" onClick="insert_col('5');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#C8FF00"><a href="" onClick="insert_col('6');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#96FF00"><a href="" onClick="insert_col('7');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#64FF00"><a href="" onClick="insert_col('8');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#32FF00"><a href="" onClick="insert_col('9');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>
</tr>

<tr>
<td bgcolor="#00FF00"><a href="" onClick="insert_col('10');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#00FF32"><a href="" onClick="insert_col('11');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#00FF64"><a href="" onClick="insert_col('12');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#33FF96"><a href="" onClick="insert_col('13');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#00FFC8"><a href="" onClick="insert_col('14');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#00FFFF"><a href="" onClick="insert_col('15');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#00C8FF"><a href="" onClick="insert_col('16');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#0096FF"><a href="" onClick="insert_col('17');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#0064FF"><a href="" onClick="insert_col('18');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#0032FF"><a href="" onClick="insert_col('19');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>
</tr>

<tr>
<td bgcolor="#0000FF"><a href="" onClick="insert_col('20');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>


<td bgcolor="#3200FF"><a href="" onClick="insert_col('21');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#6400FF"><a href="" onClick="insert_col('22');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#9600FF"><a href="" onClick="insert_col('23');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#C800FF"><a href="" onClick="insert_col('24');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FF00FF"><a href="" onClick="insert_col('25');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#FFFFFF"><a href="" onClick="insert_col('26');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#F0F0F0"><a href="" onClick="insert_col('27');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#DCDCDC"><a href="" onClick="insert_col('28');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>

<td bgcolor="#C8C8C8"><a href="" onClick="insert_col('29');return false"><img src="pic.gif" border=0 height=20 width=10></a></td>
</tr>
</table><br />




<script language="JavaScript">
function setForm() {
    opener.document.tabledesign.<?php $field?>.value = document.htmlcolor.code.value;
    self.close();
    return false;
}
</script>

<form name=htmlcolor onSubmit="return setForm();">
<Font Face=Arial size=1 color=black><strong>HexaDecimal Color</strong></font><br />
<input type=text size=12 name=code value=7D7D7D onChange="turnhextodec(document.forms.htmlcolor.code.value)"></input>
<br /><br /><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;
<input type="button" value="Close" onclick="window.close()">
</form>


</center>
</body>
</html>


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