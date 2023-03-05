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
    document.post.message.focus();
    oSelect = document.selection;
    oSelectRange = oSelect.createRange();
    if (oSelectRange.text.length < 1) { alert("Please select the text first");
return;
}
    if (oSelectRange.text.length > 120) {
      alert("This only works for less than 120 letters");
      return;
    }
    showModalDialog("modules/<?php echo $module_name; ?>/include/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
}

function BBChr() {
   document.post.message.value+="[hr]";
        document.post.message.focus();
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
        document.post.message.value+=ToAdd;
        document.post.message.focus();
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
        document.post.message.value+=ToAdd;
        document.post.message.focus();
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
	document.post.message.value+=ToAdd;
	document.post.message.focus();
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
        document.post.message.value+=ToAdd;
        document.post.message.focus();
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
        document.post.message.value+=ToAdd;
        document.post.message.focus();
}

function BBCmarqu() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	if (marqu == 0) {
		ToAdd = "[marq=up]";
		document.post.marqu.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqu1.gif";
		marqu = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqu.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqu.gif";
		marqu = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarql() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	if (marql == 0) {
		ToAdd = "[marq=left]";
		document.post.marql.src = "modules/<?php echo $module_name; ?>/images/bbcode/marql1.gif";
		marql = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marql.src = "modules/<?php echo $module_name; ?>/images/bbcode/marql.gif";
		marql = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqr() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	if (marqr == 0) {
		ToAdd = "[marq=right]";
		document.post.marqr.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqr1.gif";
		marqr = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqr.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqr.gif";
		marqr = 0;
	}
	PostWrite(ToAdd);
}

function BBCdir(dirc) {
       document.post.message.dir=(dirc);
}

function BBCfade() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
		document.post.message.focus();
		return;
		}
	}
	if (fade == 0) {
		ToAdd = "[fade]";
		document.post.fade.src = "modules/<?php echo $module_name; ?>/images/bbcode/fade1.gif";
		fade = 1;
	} else {
		ToAdd = "[/fade]";
		document.post.fade.src = "modules/<?php echo $module_name; ?>/images/bbcode/fade.gif";
		fade = 0;
	}
	PostWrite(ToAdd);
}

function BBCjustify() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	if (justify == 0) {
		ToAdd = "[align=justify]";
		document.post.justify.src = "modules/<?php echo $module_name; ?>/images/bbcode/justify1.gif";
		justify = 1;
	} else {
		ToAdd = "[/align]";
		document.post.justify.src = "modules/<?php echo $module_name; ?>/images/bbcode/justify.gif";
		justify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	if (left == 0) {
		ToAdd = "[align=left]";
		document.post.left.src = "modules/<?php echo $module_name; ?>/images/bbcode/left1.gif";
		left = 1;
	} else {
		ToAdd = "[/align]";
		document.post.left.src = "modules/<?php echo $module_name; ?>/images/bbcode/left.gif";
		left = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	if (right == 0) {
		ToAdd = "[align=right]";
		document.post.right.src = "modules/<?php echo $module_name; ?>/images/bbcode/right1.gif";
		right = 1;
	} else {
		ToAdd = "[/align]";
		document.post.right.src = "modules/<?php echo $module_name; ?>/images/bbcode/right.gif";
		right = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
		document.post.message.focus();
		return;
		}
	}
	if (center == 0) {
		ToAdd = "[align=center]";
		document.post.center.src = "modules/<?php echo $module_name; ?>/images/bbcode/center1.gif";
		center = 1;
	} else {
		ToAdd = "[/align]";
		document.post.center.src = "modules/<?php echo $module_name; ?>/images/bbcode/center.gif";
		center = 0;
	}
	PostWrite(ToAdd);
}

function BBCft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[font="+document.post.ft.value+"]" + theSelection + "[/font]";
		document.post.message.focus();
		return;
		}
	}
	ToAdd = "[font="+document.post.ft.value+"]"+" "+"[/font]";
	PostWrite(ToAdd);
}

function BBCfs() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[size="+document.post.fs.value+"]" + theSelection + "[/size]";
		document.post.message.focus();
		return;
		}
	}
	ToAdd = "[size="+document.post.fs.value+"]"+" "+"[/size]";
	PostWrite(ToAdd);
}

function BBCfc() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[color="+document.post.fc.value+"]" + theSelection + "[/color]";
		document.post.message.focus();
		return;
		}
	}
	ToAdd = "[color="+document.post.fc.value+"]"+" "+"[/color]";
	PostWrite(ToAdd);
}

function BBCmarqd() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
		document.post.message.focus();
		return;
		}
	}
	if (marqd == 0) {
		ToAdd = "[marq=down]";
		document.post.marqd.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqd1.gif";
		marqd = 1;
	} else {
		ToAdd = "[/marq]";
		document.post.marqd.src = "modules/<?php echo $module_name; ?>/images/bbcode/marqd.gif";
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
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}

function checkForm() {
	formErrors = false;    
	if (document.post.message.value.length < 2) {
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
			document.post.message.value += bbopen + bbclose;
			document.post.message.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		document.post.message.focus();
		return;
	} else {
		document.post.message.value += bbopen + bbclose;
		document.post.message.focus();
		return;
	}
	storeCaret(document.post.message);
}

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
	if (document.post.message.createTextRange && document.post.message.caretPos) {
		var caretPos = document.post.message.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?	text + ' ' : text;
	}
	else document.post.message.value += text;
	document.post.message.focus(caretPos)
}

function BBCcode() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[code]" + theSelection + "[/code]";
		document.post.message.focus();
		return;
		}
	}
	if (Code == 0) {
		ToAdd = "[code]";
		document.post.code.src = "modules/<?php echo $module_name; ?>/images/bbcode/code1.gif";
  		Code = 1;
	} else {
		ToAdd = "[/code]";
		document.post.code.src = "modules/<?php echo $module_name; ?>/images/bbcode/code.gif";
		Code = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
		document.post.message.focus();
		return;
		}
	}
	if (Quote == 0) {
		ToAdd = "[quote]";
		document.post.quote.src = "modules/<?php echo $module_name; ?>/images/bbcode/quote1.gif";
		Quote = 1;
	} else {
		ToAdd = "[/quote]";
		document.post.quote.src = "modules/<?php echo $module_name; ?>/images/bbcode/quote.gif";
		Quote = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[B]" + theSelection + "[/B]";
		document.post.message.focus();
		return;
		}
	}
	if (Bold == 0) {
		ToAdd = "[B]";
		document.post.bold.src = "modules/<?php echo $module_name; ?>/images/bbcode/bold1.gif";
		Bold = 1;
	} else {
		ToAdd = "[/B]";
		document.post.bold.src = "modules/<?php echo $module_name; ?>/images/bbcode/bold.gif";
		Bold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[I]" + theSelection + "[/I]";
		document.post.message.focus();
		return;
		}
	}
	if (Italic == 0) {
		ToAdd = "[I]";
		document.post.italic.src = "modules/<?php echo $module_name; ?>/images/bbcode/italic1.gif";
		Italic = 1;
	} else {
		ToAdd = "[/I]";
		document.post.italic.src = "modules/<?php echo $module_name; ?>/images/bbcode/italic.gif";
		Italic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[U]" + theSelection + "[/U]";
		document.post.message.focus();
		return;
		}
	}
	if (Underline == 0) {
		ToAdd = "[U]";
		document.post.under.src = "modules/<?php echo $module_name; ?>/images/bbcode/under1.gif";
		Underline = 1;
	} else {
		ToAdd = "[/U]";
		document.post.under.src = "modules/<?php echo $module_name; ?>/images/bbcode/under.gif";
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
	document.post.message.value+=ToAdd;
	document.post.message.focus();
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
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}
</script>