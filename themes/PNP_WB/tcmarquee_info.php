<?php
/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme PNP_WB																		*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright     : A public theme for use with Platinum Nuke Pro http://www.platinumnuke.com	*/
/**																								*/
/**	  Copyright (c) 2011,2017 D. Miller AkA. DocHaVoC | All Rights Reserved						*/
/************************************************************************************************/
if($themeconsole['marqstyle'] == '1'){
/*
JQuery-Marquee 
For full source code, and usage terms, visit Giva, Inc. (http://www.givainc.com/labs/)
Rev:  1.0.01
This notice MUST stay intact for use
*/
echo "<ul id=\"marquee\" class=\"marquee\">\n";
echo "<li>$mess1</li>\n";
echo "<li>$mess2</li>\n";
echo "<li>$mess3</li>\n";
echo "<li>$mess4</li>\n";
echo "<li>$mess5</li>\n"; 
/*<script type="text/javascript"> $(document).ready(function (){   $("#marquee").marquee(); }); </script>
$inlineJS = '<script type="text/javascript"> $(document).ready(function (){   $("#marquee").marquee(); }); </script>'."\n";
addJSToBody($inlineJS,'inline');*/
}elseif ($themeconsole['marqstyle'] == '2'){
/*
Fading Scroller- By DynamicDrive.com
For full source code, and usage terms, visit http://www.dynamicdrive.com
This notice MUST stay intact for use
*/
echo"<script language=\"JavaScript\">";
echo"var delay=3000
var fcontent=new Array()
begintag=''
fcontent[0]='<center>$mess1</center>'
fcontent[1]='<center>$mess2</center>'
fcontent[2]='<center>$mess3</center>'
fcontent[3]='<center>$mess4</center>'
fcontent[4]='<center>$mess5</center>'
closetag=''

var fwidth='424px'
var fheight='18px'

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
setTimeout(\"colorfade()\",80);
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
/*
Cross browser Marquee script- © Dynamic Drive (www.dynamicdrive.com)
For full source code, 100's more DHTML scripts, and Terms Of Use, visit http://www.dynamicdrive.com
Credit MUST stay intact for use
*/
echo "<script language=\"JavaScript\">";
echo"var marqueewidth=\"424px\"
var marqueeheight=\"18px\"
var marqueespeed=3
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

?>