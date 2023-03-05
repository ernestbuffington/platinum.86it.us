<?php

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

if (stristr($_SERVER['SCRIPT_NAME'], "header.php")) {
    die ("Access Denied");
}
echo "<table id=\"Table_01\" width=\"100%\" height=\"275\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n"; 
echo "	<tr>\n"; 
echo "		<td colspan=\"2\" background=\"themes/Impressed/images/hd/header_01.gif\" width=\"243\" height=\"41\" alt=\"\"></td>\n";
echo "		<td rowspan=\"5\" background=\"themes/Impressed/images/hd/ltspan.gif\" width=\"50%\" height=\"275\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"5\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_03.gif\" width=\"2\" height=\"275\" alt=\"\"></td>\n"; 
echo "		<td colspan=\"8\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_04.gif\" width=\"785\" height=\"41\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"5\" background=\"themes/Impressed/images/hd/rtspan.gif\" width=\"50%\" height=\"275\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"5\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_06.gif\" width=\"12\" height=\"275\" alt=\"\"></td>\n"; 
echo "		<td>\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_07.gif\" width=\"235\" height=\"41\" alt=\"\"></td>\n"; 
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "		<td rowspan=\"2\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_08.gif\" width=\"242\" height=\"162\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"4\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_09.gif\" width=\"1\" height=\"234\" alt=\"\"></td>\n"; 
echo "		<td colspan=\"7\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/flash.gif\" width=\"784\" height=\"161\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"4\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_11.gif\" width=\"1\" height=\"234\" alt=\"\"></td>\n"; 
echo "		<td rowspan=\"4\">\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_12.gif\" width=\"235\" height=\"234\" alt=\"\"></td>\n"; 
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "		<td colspan=\"7\" rowspan=\"2\" background=\"themes/Impressed/images/hd/message.gif\" width=\"784\" height=\"29\" alt=\"\">\n"; 
if($themeconsole['marqstyle'] == '2'){
echo"<script language=\"JavaScript1.2\">";

/*
Fading Scroller- By DynamicDrive.com
For full source code, and usage terms, visit http://www.dynamicdrive.com
This notice MUST stay intact for use
*/

echo"var delay=4000
var fcontent=new Array()
begintag=''
fcontent[0]='<center>$mess1</center>'
fcontent[1]='<center>$mess2</center>'
fcontent[2]='<center>$mess3</center>'
fcontent[3]='<center>$mess4</center>'
fcontent[4]='<center>$mess5</center>'
closetag=''

var fwidth='784px'
var fheight='29px'

var fadescheme=1
var fadelinks=1
var hex=(fadescheme==0)? 255 : 0
var startcolor=(fadescheme==0)? \"rgb(255,255,255)\" : \"rgb(0,0,0)\"
var endcolor=(fadescheme==0)? \"rgb(0,0,0)\" : \"rgb(255,255,255)\"

var ie4=document.all&&!document.getElementById
var ns4=document.layers
var DOM2=document.getElementById
var faderdelay=0
var index=0

if (DOM2)
faderdelay=2000

function changecontent(){
if (index>=fcontent.length)
index=0
if (DOM2){
document.getElementById(\"fscroller\").style.color=startcolor
document.getElementById(\"fscroller\").innerHTML=begintag+fcontent[index]+closetag
linksobj=document.getElementById(\"fscroller\").getElementsByTagName(\"A\")
if (fadelinks)
linkcolorchange(linksobj)
colorfade()
}
else if (ie4)
document.all.fscroller.innerHTML=begintag+fcontent[index]+closetag
else if (ns4){
document.fscrollerns.document.fscrollerns_sub.document.write(begintag+fcontent[index]+closetag)
document.fscrollerns.document.fscrollerns_sub.document.close()
}

index++
setTimeout(\"changecontent()\",delay+faderdelay)
}
frame=20;

function linkcolorchange(obj){
if (obj.length>0){
for (i=0;i<obj.length;i++)
obj[i].style.color=\"rgb(\"+hex+\",\"+hex+\",\"+hex+\")\"
}
}

function colorfade() {
if(frame>0) {
hex=(fadescheme==0)? hex-12 : hex+12
document.getElementById(\"fscroller\").style.color=\"rgb(\"+hex+\",\"+hex+\",\"+hex+\")\";
if (fadelinks)
linkcolorchange(linksobj)
frame--;
setTimeout(\"colorfade()\",20);
}

else{
document.getElementById(\"fscroller\").style.color=endcolor;
frame=20;
hex=(fadescheme==0)? 255 : 0
}
}

if (ie4||DOM2)
document.write('<div id=\"fscroller\" style=\"position:center;border:0px solid black;width:'+fwidth+';height:'+fheight+';padding:0px\"></div>')

changecontent();
</script>

<ilayer id=\"fscrollerns\" width=&{fwidth}; height=&{fheight};><layer id=\"fscrollerns_sub\" width=&{fwidth}; height=&{fheight}; left=0 top=0></layer></ilayer>";
}elseif ($themeconsole['marqstyle'] == '3'){
echo "<script language=\"JavaScript1.2\">";

/*
Cross browser Marquee script- © Dynamic Drive (www.dynamicdrive.com)
For full source code, 100's more DHTML scripts, and Terms Of Use, visit http://www.dynamicdrive.com
Credit MUST stay intact
*/


echo"var marqueewidth=\"784px\"
var marqueeheight=\"29px\"
var marqueespeed=2
var marqueebgcolor=\"#\"
var pauseit=1
var marqueecontent='<nobr><div valign=\"middle\">$mess1 $mess2 $mess3 $mess4 $mess5</div></nobr>'
marqueespeed=(document.all)? marqueespeed : Math.max(1, marqueespeed-1)
var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id=\"temp\" style=\"visibility:hidden;position:absolute;top:-100px;left:-9000px\">'+marqueecontent+'</span>')
var actualwidth=''
var cross_marquee, ns_marquee

function populate(){
if (iedom){
cross_marquee=document.getElementById? document.getElementById(\"iemarquee\") : document.all.iemarquee
cross_marquee.style.left=parseInt(marqueewidth)+8+\"px\"
cross_marquee.innerHTML=marqueecontent
actualwidth=document.all? temp.offsetWidth : document.getElementById(\"temp\").offsetWidth
}
else if (document.layers){
ns_marquee=document.ns_marquee.document.ns_marquee2
ns_marquee.left=parseInt(marqueewidth)+8
ns_marquee.document.write(marqueecontent)
ns_marquee.document.close()
actualwidth=ns_marquee.document.width
}
lefttime=setInterval(\"scrollmarquee()\",20)
}
window.onload=populate

function scrollmarquee(){
if (iedom){
if (parseInt(cross_marquee.style.left)>(actualwidth*(-1)+8))
cross_marquee.style.left=parseInt(cross_marquee.style.left)-copyspeed+\"px\"
else
cross_marquee.style.left=parseInt(marqueewidth)+8+\"px\"

}
else if (document.layers){
if (ns_marquee.left>(actualwidth*(-1)+8))
ns_marquee.left-=copyspeed
else
ns_marquee.left=parseInt(marqueewidth)+8
}
}

if (iedom||document.layers){
with (document){
document.write('<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><td>')
if (iedom){
write('<div style=\"position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden\">')
write('<div style=\"position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';background-color:'+marqueebgcolor+'\" onMouseover=\"copyspeed=pausespeed\" onMouseout=\"copyspeed=marqueespeed\">')
write('<div id=\"iemarquee\" style=\"position:absolute;left:0px;top:0px\"></div>')
write('</div></div>')
}
else if (document.layers){
write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name=\"ns_marquee\" bgColor='+marqueebgcolor+'>')
write('<layer name=\"ns_marquee2\" left=0 top=0 onMouseover=\"copyspeed=pausespeed\" onMouseout=\"copyspeed=marqueespeed\"></layer>')
write('</ilayer>')
}
document.write('</td></table>')
}
}
</script>";
}elseif ($themeconsole['marqstyle'] == '99'){
echo "&nbsp";
}
echo "		</TD>\n";
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "		<td background=\"themes/Impressed/images/hd/user.gif\" width=\"242\" height=\"28\" alt=\"\">$theuser  </td>\n";
echo "  
echo "	</tr>\n"; 
echo "	<tr>\n"; 
echo "		<td>\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_15.gif\" width=\"242\" height=\"44\" alt=\"\"></td>\n"; 
echo "		<td>\n"; 
echo "			<img src=\"themes/Impressed/images/hd/header_16.gif\" width=\"105\" height=\"44\" alt=\"\"></td>\n"; 
echo "		<td align=\"center background=\"themes/Impressed/images/hd/link1.gif\" width=\"111\" height=\"44\" alt=\"\"><a href=\"".$themeconsole['hlinkurl1']."\" class=menutitle>".$themeconsole['hlink1']."</a></TD>\n";
echo "		<td align=\"center background=\"themes/Impressed/images/hd/link2.gif\" width=\"114\" height=\"44\" alt=\"\"><a href=\"".$themeconsole['hlinkurl2']."\" class=menutitle>".$themeconsole['hlink2']."</a></TD>\n"; 
echo "		<td align=\"center background=\"themes/Impressed/images/hd/link3.gif\" width=\"119\" height=\"44\" alt=\"\"><a href=\"".$themeconsole['hlinkurl3']."\" class=menutitle>".$themeconsole['hlink3']."</a></TD>\n";
echo "		<td align=\"center background=\"themes/Impressed/images/hd/link4.gif\" width=\"116\" height=\"44\" alt=\"\"><a href=\"".$themeconsole['hlinkurl4']."\" class=menutitle>".$themeconsole['hlink4']."</a></TD>\n";
echo "		<td align=\"center ckground=\"themes/Impressed/images/hd/link5.gif\" width=\"111\" height=\"44\" alt=\"\"><a href=\"".$themeconsole['hlinkurl5']."\" class=menutitle>".$themeconsole['hlink5']."</a></TD>\n"; 
echo "		<td>\n"; 
echo "			<img src=\"themes/Impressed/themes/Impressed/images/hd/hd/header_22.gif\" width=\"108\" height=\"44\" alt=\"\"></td>\n"; 
echo "	</tr>\n"; 
echo "</table>\n";
?>