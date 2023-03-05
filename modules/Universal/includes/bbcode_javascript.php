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

// BBCode System for PHP-Nuke phpBB by AL Tnen - http://www.tnen.zzn.com
// Modified for use in Universal Module by Barry Caplin - http://www.e-devstudio.com

if (preg_match("/bbcode_javascript.php/i", $PHP_SELF)) {
	die ("You can't access this file directly...");
}

?>
<script language="JavaScript" type="text/javascript">

var theSelection = false;
var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav  = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));

var is_win   = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac    = (clientPC.indexOf("mac")!=-1);

b_help = "Bold: [B]text[/B]";
i_help = "Italic: [I]text[/I]";
u_help = "Under Line: [U]text[/U]";
quote_help = "Quote: [quote]text[/quote]";
code_help = "Code: [code]code[/code]";
img_help = "Insert Image: [img]http://image path[/img]";
url_help = "Insert URL: [url]http://Site URL[/url] Ãæ [url=http://Site URL]Site Name[/url]";
fc_help = "Font Color: [color=red]text[/color] You can use HTML color=#FF0000";
fs_help = "Font Size: [size=9]Very Small[/size]";
ft_help = "Font type: [font=Andalus]text[/font]";
rtl_help = "Make message box align from Right to Left";
ltr_help = "Make message box align from Left to Right";
mail_help = "Insert Email: [email]Email Here[/email]";
grad_help="Insert gradient text";
right_help="set text align to right: [align=right]text[/align]";
left_help="set text align to left: [align=left]text[/align]";
center_help="set text align to center: [align=center]text[/align]";
justify_help="justify text: [align=justify]text[/align]";
marqr_help="Marque text to Right: [marq=right]text[/marq]";
marql_help="Marque text to Left: [marq=left]text[/marq]";
marqu_help="Marque text to up: [marq=up]text[/marq]";
marqd_help="Marque text to down: [marq=down]text[/marq]";
stream_help="Insert stream file: [stream]File URL[/stream]";
ram_help="Insert Real Media file: [ram]File URL[/ram]";
web_help="Insert Web Page into the post : [web]Page URL[/web]";
plain_help="Remove bbcodes from the selected text";
hr_help="Insert H-Line [hr]";
video_help="Insert video file: [video width=# height=#]file URL[/video]";
flash_help="Insert flash file: [flash width=# height=#]flash URL[/flash]";
fade_help = "Fade text: [fade]text[/fade]";
pagebreak_help = "Insert a page break";
imageinsert_help = "Click on a filename from this list, to add to the post";
selectcat_help = "Select a category to place the item in";
author_help = "Author of this item. Website is also required";
website_help = "Enter the Authors website. Author field must also be filled in";
title_help = "Enter the name of your item";
username1_help = "Your Name. Your username has already been entered. Change if you wish";
femail1_help = "Your E-Mail, your fake e-mail from your profile has automactially entered"
femail2_help = "Enter your e-mail address here. Spam-Proof";
username2_help = "Enter the name to be displayed when viewing the item";
descript_help = "Enter a short description for the item";
previewimage_help = "Preview an uploaded image";
var Quote = 0;
var Bold  = 0;
var Italic = 0;
var Underline = 0;
var Code = 0;
var flash = 0;
var fc = 0;
var fs = 0;
var ft = 0;
var center = 0;
var right = 0;
var left = 0;
var justify = 0;
var fade = 0;
var marqd = 0;
var marqu = 0;
var marql = 0;
var marqr = 0;
var mail = 0;
var web = 0;
var video = 0;
var stream = 0;
var ram = 0;
var hr = 0;
var grad = 0;
var plain = 0;

function BBCplain() {
theSelection = document.selection.createRange().text;
                if (theSelection != '') {
                       temp = theSelection;
                       temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
          temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
  document.selection.createRange().text = temp.replace(/\[[^\]]*\]/gi,"");
      }
}

function BBCgrad() {
    var oSelect,oSelectRange;
    document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
    oSelect = document.selection;
    oSelectRange = oSelect.createRange();
    if (oSelectRange.text.length < 1) { alert("Please select the text first");
return;
}
    if (oSelectRange.text.length > 120) {
      alert("This only works for less than 120 letters");
      return;
    }
    showModalDialog("modules/<?php echo $module_name; ?>/includes/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
}

function BBChr() {
   document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+="[hr]";
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCram() {
        var FoundErrors = '';
        var enterURL   = prompt("Please write real media file URL","http://");
        if (!enterURL) {
                FoundErrors += "You didn't write the file URL";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[ram]"+enterURL+"[/ram]";
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCstream() {
        var FoundErrors = '';
        var enterURL   = prompt("Please write stream file URL","http://");
        if (!enterURL) {
                FoundErrors += "You didn't write the file URL";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[stream]"+enterURL+"[/stream]";
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCvideo() {
	var FoundErrors = '';
	var enterFURL   = prompt("Please Enter the video file URL", "http://");
	if (!enterFURL)    {
		FoundErrors += "You didn't write the file URL";
	}
		var enterW   = prompt("Enter the video file width", "400");
	if (!enterW)    {
		FoundErrors += "You didn't enter the video file width";
	}
	var enterH   = prompt("Enter the video file height", "350");
	if (!enterH)    {
		FoundErrors += "You didn't enter the video file height";
	}
	if (FoundErrors)  {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[video width="+enterW+" height="+enterH+"]"+enterFURL+"[/video]";
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCweb() {
        var FoundErrors = '';
        var enterURL   = prompt("Please enter page URL","http://");
        if (!enterURL) {
                FoundErrors += "You didn't write the page URL";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[web]"+enterURL+"[/web]";
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCmail() {
        var FoundErrors = '';
        var entermail   = prompt("Enter the Email Address","");
        if (!entermail) {
                FoundErrors += "You didn't write the Email Address";
        }
        if (FoundErrors) {
                alert("Error :"+FoundErrors);
                return;
        }
        var ToAdd = "[email]"+entermail+"[/email]";
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
        document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCmarqu() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (marqu == 0) {
		ToAdd = "[marq=up]";
		document.<?php echo "$form_name"; ?>.marqu.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqu1.gif";
		marqu = 1;
	} else {
		ToAdd = "[/marq]";
		document.<?php echo "$form_name"; ?>.marqu.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqu.gif";
		marqu = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarql() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (marql == 0) {
		ToAdd = "[marq=left]";
		document.<?php echo "$form_name"; ?>.marql.src = "modules/<?php echo $module_name; ?>/images/bbcode/marql1.gif";
		marql = 1;
	} else {
		ToAdd = "[/marq]";
		document.<?php echo "$form_name"; ?>.marql.src = "modules/<?php echo $module_name; ?>/images/bbcode/marql.gif";
		marql = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqr() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (marqr == 0) {
		ToAdd = "[marq=right]";
		document.<?php echo "$form_name"; ?>.marqr.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqr1.gif";
		marqr = 1;
	} else {
		ToAdd = "[/marq]";
		document.<?php echo "$form_name"; ?>.marqr.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqr.gif";
		marqr = 0;
	}
	PostWrite(ToAdd);
}

function BBCdir(dirc) {
       document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.dir=(dirc);
}

function BBCfade() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (fade == 0) {
		ToAdd = "[fade]";
		document.<?php echo "$form_name"; ?>.fade.src = "modules/<?php echo $module_name; ?>/images/bbcode/fade1.gif";
		fade = 1;
	} else {
		ToAdd = "[/fade]";
		document.<?php echo "$form_name"; ?>.fade.src = "modules/<?php echo $module_name; ?>/images/bbcode/fade.gif";
		fade = 0;
	}
	PostWrite(ToAdd);
}

function BBCjustify() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (justify == 0) {
		ToAdd = "[align=justify]";
		document.<?php echo "$form_name"; ?>.justify.src = "modules/<?php echo $module_name; ?>/images/bbcode/justify1.gif";
		justify = 1;
	} else {
		ToAdd = "[/align]";
		document.<?php echo "$form_name"; ?>.justify.src = "modules/<?php echo $module_name; ?>/images/bbcode/justify.gif";
		justify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (left == 0) {
		ToAdd = "[align=left]";
		document.<?php echo "$form_name"; ?>.left.src = "modules/<?php echo $module_name; ?>/images/bbcode/left1.gif";
		left = 1;
	} else {
		ToAdd = "[/align]";
		document.<?php echo "$form_name"; ?>.left.src = "modules/<?php echo $module_name; ?>/images/bbcode/left.gif";
		left = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (right == 0) {
		ToAdd = "[align=right]";
		document.<?php echo "$form_name"; ?>.right.src = "modules/<?php echo $module_name; ?>/images/bbcode/right1.gif";
		right = 1;
	} else {
		ToAdd = "[/align]";
		document.<?php echo "$form_name"; ?>.right.src = "modules/<?php echo $module_name; ?>/images/bbcode/right.gif";
		right = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (center == 0) {
		ToAdd = "[align=center]";
		document.<?php echo "$form_name"; ?>.center.src = "modules/<?php echo $module_name; ?>/images/bbcode/center1.gif";
		center = 1;
	} else {
		ToAdd = "[/align]";
		document.<?php echo "$form_name"; ?>.center.src = "modules/<?php echo $module_name; ?>/images/bbcode/center.gif";
		center = 0;
	}
	PostWrite(ToAdd);
}

function BBCft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[font="+document.<?php echo "$form_name"; ?>.ft.value+"]" + theSelection + "[/font]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	ToAdd = "[font="+document.<?php echo "$form_name"; ?>.ft.value+"]"+" "+"[/font]";
	PostWrite(ToAdd);
}

function BBCfs() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[size="+document.<?php echo "$form_name"; ?>.fs.value+"]" + theSelection + "[/size]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	ToAdd = "[size="+document.<?php echo "$form_name"; ?>.fs.value+"]"+" "+"[/size]";
	PostWrite(ToAdd);
}

function BBCfc() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[color="+document.<?php echo "$form_name"; ?>.fc.value+"]" + theSelection + "[/color]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	ToAdd = "[color="+document.<?php echo "$form_name"; ?>.fc.value+"]"+" "+"[/color]";
	PostWrite(ToAdd);
}

function BBCmarqd() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (marqd == 0) {
		ToAdd = "[marq=down]";
		document.<?php echo "$form_name"; ?>.marqd.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqd1.gif";
		marqd = 1;
	} else {
		ToAdd = "[/marq]";
		document.<?php echo "$form_name"; ?>.marqd.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqd.gif";
		marqd = 0;
	}
	PostWrite(ToAdd);
}

function BBCflash() {
	var FoundErrors = '';
	var enterFURL   = prompt("Enter the flash file URL", "http://");
	if (!enterFURL)    {
		FoundErrors += "You didn't write the flash file URL";
	}
		var enterW   = prompt("Enter the flash width", "250");
	if (!enterW)    {
		FoundErrors += "You didn't write the flash width";
	}
	var enterH   = prompt("Enter the flash height", "250");
	if (!enterH)    {
		FoundErrors += "You didn't write the flash height";
	}
	if (FoundErrors)  {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[flash width="+enterW+" height="+enterH+"]"+enterFURL+"[/flash]";
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function checkForm() {
	formErrors = false;    
	if (document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value.length < 2) {
		formErrors = "You must enter a message when posting";
	}
	if (formErrors) {
		alert(formErrors);
		return false;
	} else {
		//formObj.preview.disabled = true;
		//formObj.submit.disabled = true;
		return true;
	}
}

function emoticon(text) {
	text = ' ' + text + ' ';
	PostWrite(text);
}

function bbfontstyle(bbopen, bbclose) {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (!theSelection) {
			document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value += bbopen + bbclose;
			document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
	} else {
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value += bbopen + bbclose;
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
	}
	storeCaret(document.<?php echo "$form_name"; ?>.message);
}

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
	if (document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.createTextRange && document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.caretPos) {
		var caretPos = document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?	text + ' ' : text;
	}
	else document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value += text;
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus(caretPos)
}

function BBCcode() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[code]" + theSelection + "[/code]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (Code == 0) {
		ToAdd = "[code]";
		document.<?php echo "$form_name"; ?>.code.src = "modules/<?php echo $module_name; ?>/images/bbcode/code1.gif";
  		Code = 1;
	} else {
		ToAdd = "[/code]";
		document.<?php echo "$form_name"; ?>.code.src = "modules/<?php echo $module_name; ?>/images/bbcode/code.gif";
		Code = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (Quote == 0) {
		ToAdd = "[quote]";
		document.<?php echo "$form_name"; ?>.quote.src = "modules/<?php echo $module_name; ?>/images/bbcode/quote1.gif";
		Quote = 1;
	} else {
		ToAdd = "[/quote]";
		document.<?php echo "$form_name"; ?>.quote.src = "modules/<?php echo $module_name; ?>/images/bbcode/quote.gif";
		Quote = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[B]" + theSelection + "[/B]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (Bold == 0) {
		ToAdd = "[B]";
		document.<?php echo "$form_name"; ?>.bold.src = "modules/<?php echo $module_name; ?>/images/bbcode/bold1.gif";
		Bold = 1;
	} else {
		ToAdd = "[/B]";
		document.<?php echo "$form_name"; ?>.bold.src = "modules/<?php echo $module_name; ?>/images/bbcode/bold.gif";
		Bold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[I]" + theSelection + "[/I]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (Italic == 0) {
		ToAdd = "[I]";
		document.<?php echo "$form_name"; ?>.italic.src = "modules/<?php echo $module_name; ?>/images/bbcode/italic1.gif";
		Italic = 1;
	} else {
		ToAdd = "[/I]";
		document.<?php echo "$form_name"; ?>.italic.src = "modules/<?php echo $module_name; ?>/images/bbcode/italic.gif";
		Italic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[U]" + theSelection + "[/U]";
		document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
		return;
		}
	}
	if (Underline == 0) {
		ToAdd = "[U]";
		document.<?php echo "$form_name"; ?>.under.src = "modules/<?php echo $module_name; ?>/images/bbcode/under1.gif";
		Underline = 1;
	} else {
		ToAdd = "[/U]";
		document.<?php echo "$form_name"; ?>.under.src = "modules/<?php echo $module_name; ?>/images/bbcode/under.gif";
		Underline = 0;
	}
	PostWrite(ToAdd);
}

function BBCurl() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the URL", "http://");
	var enterTITLE = prompt("Enter the page name", "Web Page Name");
	if (!enterURL)    {
		FoundErrors += "You didn't write the URL";
	}
	if (!enterTITLE)  {
		FoundErrors += "You didn't write the page name";
	}
	if (FoundErrors)  {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function BBCimg() {
	var FoundErrors = '';
	var enterURL   = prompt("Enter the image URL","http://");
	if (!enterURL) {
		FoundErrors += "You didn't write the image URL";
	}
	if (FoundErrors) {
		alert("Error :"+FoundErrors);
		return;
	}
	var ToAdd = "[img]"+enterURL+"[/img]";
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.value+=ToAdd;
	document.<?php echo "$form_name"; ?>.<?php echo "$entrybox"; ?>.focus();
}

function helpline(help) {
	document.<?php echo "$form_name"; ?>.helpbox.value = eval(help + "_help");
	document.<?php echo "$form_name"; ?>.helpbox.readOnly = "true";
}

</script>