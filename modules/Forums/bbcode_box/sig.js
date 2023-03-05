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
php_help = "Php: [php]php script[/php]";
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
var Php = 0;
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
    document.preview.signature.focus();
    oSelect = document.selection;
    oSelectRange = oSelect.createRange();
    if (oSelectRange.text.length < 1) { alert("Please select the text first");
return;
}
    if (oSelectRange.text.length > 120) {
      alert("This only works for less than 120 letters");
      return;
    }
    showModalDialog("modules/Forums/bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:50px; dialogWidth:50px");
}

function BBChr() {
   document.preview.signature.value+="[hr]";
        document.preview.signature.focus();
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
        document.preview.signature.value+=ToAdd;
        document.preview.signature.focus();
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
        document.preview.signature.value+=ToAdd;
        document.preview.signature.focus();
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
	document.preview.signature.value+=ToAdd;
	document.preview.signature.focus();
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
        document.preview.signature.value+=ToAdd;
        document.preview.signature.focus();
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
        document.preview.signature.value+=ToAdd;
        document.preview.signature.focus();
}

function BBCmarqu() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=up]" + theSelection + "[/marq]";
		document.preview.signature.focus();
		return;
		}
	}
	if (marqu == 0) {
		ToAdd = "[marq=up]";
		document.preview.marqu.src = "modules/Forums/bbcode_box/images/marqu1.gif";
		marqu = 1;
	} else {
		ToAdd = "[/marq]";
		document.preview.marqu.src = "modules/Forums/bbcode_box/images/marqu.gif";
		marqu = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarql() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=left]" + theSelection + "[/marq]";
		document.preview.signature.focus();
		return;
		}
	}
	if (marql == 0) {
		ToAdd = "[marq=left]";
		document.preview.marql.src = "modules/Forums/bbcode_box/images/marql1.gif";
		marql = 1;
	} else {
		ToAdd = "[/marq]";
		document.preview.marql.src = "modules/Forums/bbcode_box/images/marql.gif";
		marql = 0;
	}
	PostWrite(ToAdd);
}

function BBCmarqr() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=right]" + theSelection + "[/marq]";
		document.preview.signature.focus();
		return;
		}
	}
	if (marqr == 0) {
		ToAdd = "[marq=right]";
		document.preview.marqr.src = "modules/Forums/bbcode_box/images/marqr1.gif";
		marqr = 1;
	} else {
		ToAdd = "[/marq]";
		document.preview.marqr.src = "modules/Forums/bbcode_box/images/marqr.gif";
		marqr = 0;
	}
	PostWrite(ToAdd);
}

function BBCdir(dirc) {
       document.preview.signature.dir=(dirc);
}

function BBCfade() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[fade]" + theSelection + "[/fade]";
		document.preview.signature.focus();
		return;
		}
	}
	if (fade == 0) {
		ToAdd = "[fade]";
		document.preview.fade.src = "modules/Forums/bbcode_box/images/fade1.gif";
		fade = 1;
	} else {
		ToAdd = "[/fade]";
		document.preview.fade.src = "modules/Forums/bbcode_box/images/fade.gif";
		fade = 0;
	}
	PostWrite(ToAdd);
}

function BBCjustify() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=justify]" + theSelection + "[/align]";
		document.preview.signature.focus();
		return;
		}
	}
	if (justify == 0) {
		ToAdd = "[align=justify]";
		document.preview.justify.src = "modules/Forums/bbcode_box/images/justify1.gif";
		justify = 1;
	} else {
		ToAdd = "[/align]";
		document.preview.justify.src = "modules/Forums/bbcode_box/images/justify.gif";
		justify = 0;
	}
	PostWrite(ToAdd);
}

function BBCleft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=left]" + theSelection + "[/align]";
		document.preview.signature.focus();
		return;
		}
	}
	if (left == 0) {
		ToAdd = "[align=left]";
		document.preview.left.src = "modules/Forums/bbcode_box/images/left1.gif";
		left = 1;
	} else {
		ToAdd = "[/align]";
		document.preview.left.src = "modules/Forums/bbcode_box/images/left.gif";
		left = 0;
	}
	PostWrite(ToAdd);
}

function BBCright() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=right]" + theSelection + "[/align]";
		document.preview.signature.focus();
		return;
		}
	}
	if (right == 0) {
		ToAdd = "[align=right]";
		document.preview.right.src = "modules/Forums/bbcode_box/images/right1.gif";
		right = 1;
	} else {
		ToAdd = "[/align]";
		document.preview.right.src = "modules/Forums/bbcode_box/images/right.gif";
		right = 0;
	}
	PostWrite(ToAdd);
}

function BBCcenter() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[align=center]" + theSelection + "[/align]";
		document.preview.signature.focus();
		return;
		}
	}
	if (center == 0) {
		ToAdd = "[align=center]";
		document.preview.center.src = "modules/Forums/bbcode_box/images/center1.gif";
		center = 1;
	} else {
		ToAdd = "[/align]";
		document.preview.center.src = "modules/Forums/bbcode_box/images/center.gif";
		center = 0;
	}
	PostWrite(ToAdd);
}

function BBCft() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[font="+document.preview.ft.value+"]" + theSelection + "[/font]";
		document.preview.signature.focus();
		return;
		}
	}
	ToAdd = "[font="+document.preview.ft.value+"]"+" "+"[/font]";
	PostWrite(ToAdd);
}

function BBCfs() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[size="+document.preview.fs.value+"]" + theSelection + "[/size]";
		document.preview.signature.focus();
		return;
		}
	}
	ToAdd = "[size="+document.preview.fs.value+"]"+" "+"[/size]";
	PostWrite(ToAdd);
}

function BBCfc() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[color="+document.preview.fc.value+"]" + theSelection + "[/color]";
		document.preview.signature.focus();
		return;
		}
	}
	ToAdd = "[color="+document.preview.fc.value+"]"+" "+"[/color]";
	PostWrite(ToAdd);
}

function BBCmarqd() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[marq=down]" + theSelection + "[/marq]";
		document.preview.signature.focus();
		return;
		}
	}
	if (marqd == 0) {
		ToAdd = "[marq=down]";
		document.preview.marqd.src = "modules/Forums/bbcode_box/images/marqd1.gif";
		marqd = 1;
	} else {
		ToAdd = "[/marq]";
		document.preview.marqd.src = "modules/Forums/bbcode_box/images/marqd.gif";
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
	document.preview.signature.value+=ToAdd;
	document.preview.signature.focus();
}

function helpline(help) {
	document.preview.helpbox.value = eval(help + "_help");
	document.preview.helpbox.readOnly = "true";
}

function checkForm() {
	formErrors = false;    
	if (document.preview.signature.value.length < 2) {
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
			document.preview.signature.value += bbopen + bbclose;
			document.preview.signature.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		document.preview.signature.focus();
		return;
	} else {
		document.preview.signature.value += bbopen + bbclose;
		document.preview.signature.focus();
		return;
	}
	storeCaret(document.preview.signature);
}

function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
	if (document.preview.signature.createTextRange && document.preview.signature.caretPos) {
		var caretPos = document.preview.signature.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?	text + ' ' : text;
	}
	else document.preview.signature.value += text;
	document.preview.signature.focus(caretPos)
}

function BBCcode() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[code]" + theSelection + "[/code]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Code == 0) {
		ToAdd = "[code]";
		document.preview.code.src = "modules/Forums/bbcode_box/images/code1.gif";
		Code = 1;
	} else {
		ToAdd = "[/code]";
		document.preview.code.src = "modules/Forums/bbcode_box/images/code.gif";
		Code = 0;
	}
	PostWrite(ToAdd);
}
function BBCphp() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[php]" + theSelection + "[/php]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Php == 0) {
		ToAdd = "[php]";
		document.preview.php.src = "modules/Forums/bbcode_box/images/php1.gif";
		Php = 1;
	} else {
		ToAdd = "[/php]";
		document.preview.php.src = "modules/Forums/bbcode_box/images/php.gif";
		Php = 0;
	}
	PostWrite(ToAdd);
}

function BBCquote() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[quote]" + theSelection + "[/quote]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Quote == 0) {
		ToAdd = "[quote]";
		document.preview.quote.src = "modules/Forums/bbcode_box/images/quote1.gif";
		Quote = 1;
	} else {
		ToAdd = "[/quote]";
		document.preview.quote.src = "modules/Forums/bbcode_box/images/quote.gif";
		Quote = 0;
	}
	PostWrite(ToAdd);
}

function BBCbold() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[B]" + theSelection + "[/B]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Bold == 0) {
		ToAdd = "[B]";
		document.preview.bold.src = "modules/Forums/bbcode_box/images/bold1.gif";
		Bold = 1;
	} else {
		ToAdd = "[/B]";
		document.preview.bold.src = "modules/Forums/bbcode_box/images/bold.gif";
		Bold = 0;
	}
	PostWrite(ToAdd);
}

function BBCitalic() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[I]" + theSelection + "[/I]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Italic == 0) {
		ToAdd = "[I]";
		document.preview.italic.src = "modules/Forums/bbcode_box/images/italic1.gif";
		Italic = 1;
	} else {
		ToAdd = "[/I]";
		document.preview.italic.src = "modules/Forums/bbcode_box/images/italic.gif";
		Italic = 0;
	}
	PostWrite(ToAdd);
}

function BBCunder() {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[U]" + theSelection + "[/U]";
		document.preview.signature.focus();
		return;
		}
	}
	if (Underline == 0) {
		ToAdd = "[U]";
		document.preview.under.src = "modules/Forums/bbcode_box/images/under1.gif";
		Underline = 1;
	} else {
		ToAdd = "[/U]";
		document.preview.under.src = "modules/Forums/bbcode_box/images/under.gif";
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
	document.preview.signature.value+=ToAdd;
	document.preview.signature.focus();
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
	document.preview.signature.value+=ToAdd;
	document.preview.signature.focus();
}

