<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
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
/************************************************************************/
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
$index = 1;
global $user, $gallerypath, $imagepath, $prefix, $db, $bgcolor1;
include 'modules/My_eGallery/admin/config.php';
//Note: Change this to match your bgcolor//
$scrollerbgcolor="$bgcolor1";
$sql= "SELECT p.pid, p.img, p.name, p.description, p.votes, p.rate, p.counter, p.submitter, c.galloc, c.visible FROM $prefix"._gallery_pictures." AS p, $prefix"._gallery_categories." AS c WHERE (c.gallid=p.gid) AND (p.votes > 0)  AND ( visible >0) ORDER BY votes DESC, rate DESC, pid ASC LIMIT 0, 10";
$result = $db->sql_query($sql);
//echo $sql . "<br /><br />" .mysql_error();
$messages = "";
$i = 1;
while ($pic = $db->sql_fetchrow($result)) {
	$pic['description'] = substr($pic['description'],0,255);
	if (strlen($pic['name']) > 15 ) {
		$pic['name'] = substr($pic['name'],0,14).".";
	}
	$galloc = $pic['galloc'];
	$img = $pic['img'];
	$ext = substr($img, (strrpos($img,'.') +  1));
	if (file_exists("$gallerypath/$galloc/thumb/$img")) {
		$thumb = "<img src='$gallerypath/$galloc/thumb/$img' border='0' width='118' alt='$pic[description]'>";
	} else {
		$row = $db->sql_fetchrow($db->sql_query("SELECT thumbnail from $prefix"._gallery_media_types." where extension='$ext'"));
		$thumb = "<img src='$imagepath/$row[thumbnail]' border='0' alt='$pic[description]'>";
	}
	if ($pic['visible'] == 1) {
	    if (is_user($user)) {
		$messages .= "messages[$i]=\"<strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br /><a href='$baseurl&amp;do=showpic&amp;pid=$pic[pid]'>$thumb</a><br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'>\"\n";
	    } else {
		$messages .= "messages[$i]=\"<strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br />$thumb<br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'>\"\n";
	    }
	} else {
		$messages .= "messages[$i]=\"<strong>.:N<u>o</u> $i:.</strong><br />Votes:$pic[votes]x<br /><a href='$baseurl&amp;do=showpic&amp;pid=$pic[pid]'>$thumb</a><br />$pic[name]<br />by<br />$pic[submitter]<hr width='50%'>\"\n";
	}
	$i++;
}
 if($messages== "") {
	$messages = "messages[1]=\"<br /><br /><br /><br /><br /><strong>None<br />Voted<br />Pictures</strong>\"\n";
 }
$content = "
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tr><td align=\"center\">
<div align=\"conter\">
<script type=\"text/javascript\">
//configure the below five variables to change the style of the scroller
var scrollerdelay='5000' //delay between msg scrolls. 3000=3 seconds.
var scrollerwidth='120px'
var scrollerheight='240px'
var scrollerbgcolor='$scrollerbgcolor'
//set below to '' if you don't wish to use a background image
var scrollerbackground=''
//configure the below variable to change the contents of the scroller
var messages=new Array()
messages[0]=\"<br /><br /><br /><br />Top Ten<br />Vote Picture<br />Pause Scrolling<br />
$messages
///////Do not edit pass this line///////////////////////
var ie=document.all
var dom=document.getElementById
if (messages.length>2)
i=2
else
i=0
function move1(whichlayer){
tlayer=eval(whichlayer)
if (tlayer.top>0&&tlayer.top<=5){
tlayer.top=0
setTimeout(\"move1(tlayer)\",scrollerdelay)
setTimeout(\"move2(document.main.document.second)\",scrollerdelay)
return
}
if (tlayer.top>=tlayer.document.height*-1){
tlayer.top-=5
setTimeout(\"move1(tlayer)\",50)
}
else{
tlayer.top=parseInt(scrollerheight)
tlayer.document.write(messages[i])
tlayer.document.close()
if (i==messages.length-1)
i=0
else
i++
}
}
function move2(whichlayer){
tlayer2=eval(whichlayer)
if (tlayer2.top>0&&tlayer2.top<=5){
tlayer2.top=0
setTimeout(\"move2(tlayer2)\",scrollerdelay)
setTimeout(\"move1(document.main.document.first)\",scrollerdelay)
return
}
if (tlayer2.top>=tlayer2.document.height*-1){
tlayer2.top-=5
setTimeout(\"move2(tlayer2)\",50)
}
else{
tlayer2.top=parseInt(scrollerheight)
tlayer2.document.write(messages[i])
tlayer2.document.close()
if (i==messages.length-1)
i=0
else
i++
}
}
function move3(whichdiv){
tdiv=eval(whichdiv)
if (parseInt(tdiv.style.top)>0&&parseInt(tdiv.style.top)<=5){
tdiv.style.top=0+\"px\"
setTimeout(\"move3(tdiv)\",scrollerdelay)
setTimeout(\"move4(second2_obj)\",scrollerdelay)
return
}
if (parseInt(tdiv.style.top)>=tdiv.offsetHeight*-1){
tdiv.style.top=parseInt(tdiv.style.top)-5+\"px\"
setTimeout(\"move3(tdiv)\",50)
}
else{
tdiv.style.top=parseInt(scrollerheight)
tdiv.innerHTML=messages[i]
if (i==messages.length-1)
i=0
else
i++
}
}
function move4(whichdiv){
tdiv2=eval(whichdiv)
if (parseInt(tdiv2.style.top)>0&&parseInt(tdiv2.style.top)<=5){
tdiv2.style.top=0+\"px\"
setTimeout(\"move4(tdiv2)\",scrollerdelay)
setTimeout(\"move3(first2_obj)\",scrollerdelay)
return
}
if (parseInt(tdiv2.style.top)>=tdiv2.offsetHeight*-1){
tdiv2.style.top=parseInt(tdiv2.style.top)-5+\"px\"
setTimeout(\"move4(second2_obj)\",50)
}
else{
tdiv2.style.top=parseInt(scrollerheight)
tdiv2.innerHTML=messages[i]
if (i==messages.length-1)
i=0
else
i++
}
}
function startscroll(){
if (ie||dom){
first2_obj=ie? first2 : document.getElementById(\"first2\")
second2_obj=ie? second2 : document.getElementById(\"second2\")
move3(first2_obj)
second2_obj.style.top=scrollerheight
second2_obj.style.visibility='visible'
}
else if (document.layers){
document.main.visibility='show'
move1(document.main.document.first)
document.main.document.second.top=parseInt(scrollerheight)+5
document.main.document.second.visibility='show'
}
}
window.onload=startscroll
</script>
<ilayer id=\"main\" width=&{scrollerwidth}; height=&{scrollerheight}; bgColor=&{scrollerbgcolor}; background=&{scrollerbackground}; visibility=hide>
<layer id=\"first\" left=0 top=1 width=&{scrollerwidth};>
<script language=\"JavaScript1.2\">
if (document.layers)
document.write(messages[0])
</script>
</layer>
<layer id=\"second\" left=0 top=0 width=&{scrollerwidth}; visibility=hide>
<script language=\"JavaScript1.2\">
if (document.layers)
document.write(messages[dyndetermine=(messages.length==1)? 0 : 1])
</script>
</layer>
</ilayer>
<script language=\"JavaScript1.2\">
if (ie||dom){
document.writeln('<div align =\"center\" id=\"main2\" style=\"position:relative;width:'+scrollerwidth+';height:'+scrollerheight+';overflow:hidden;background-color:'+scrollerbgcolor+' ;background-image:url('+scrollerbackground+')\">')
document.writeln('<div style=\"position:absolute;width:'+scrollerwidth+';height:'+scrollerheight+';clip:rect(0 '+scrollerwidth+' '+scrollerheight+' 0);left:0px;top:0px\">')
document.writeln('<div align=\"center\" id=\"first2\" style=\"position:absolute;width:'+scrollerwidth+';left:0px;top:1px;\">')
document.write(messages[0])
document.writeln('</div>')
document.writeln('<div align=\"center\" id=\"second2\" style=\"position:absolute;width:'+scrollerwidth+';left:0px;top:0px;visibility:hidden\">')
document.write(messages[dyndetermine=(messages.length==1)? 0 : 1])
document.writeln('</div>')
document.writeln('</div>')
document.writeln('</div>')
}
</script></div>\n
</td></tr></table>\n\n";
?>
