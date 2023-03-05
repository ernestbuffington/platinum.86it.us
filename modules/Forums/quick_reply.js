// Javascript for the PM Quick Reply MOD by Rondom <rondom@arcor.de> http://www.rondom.gu2.info
// Based on Editor Mod by Smartor <smartor_xp@hotmail.com> http://smartor.is-root.com
// and Advanced Quick Reply by Rusty Dragon <dev@RustyDragon.com>
// Don't remove these comments!
var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_clip_able = ((clientPC.indexOf("msie") != -1));
var is_nav  = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));

var is_win   = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac    = (clientPC.indexOf("mac")!=-1);

function openAllSmiles(){
smiles = window.open(u_more_smilies, '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');
smiles.focus();
return false;
}


function quoteSelection() {

theSelection = false;
theSelection = document.selection.createRange().text; // Get text selection

if (theSelection) {
 // Add tags around selection
 emoticon( '[quote]\n' + theSelection + '\n[/quote]\n');
 document.post.message.focus();
 theSelection = '';
 return;
}else{
 alert(l_quoteselelectedempty);
}
 }

 function checkForm() {
formerrors = '';
if (document.post.message.value.length < 2) {
 formerrors += l_empty_message + ' ';
}
if (!document.post.subject.value) {
 formerrors += l_empty_subject + ' ';
}
if (formerrors) {
 alert(formerrors);
 return false;
} else {
 if (document.post.quick_quote.checked) {
document.post.message.value = last_msg + document.post.message.value;
 }
 document.post.quick_quote.checked = false;
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

function BBC(bbcname) {
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (theSelection != '') {
		document.selection.createRange().text = "[" + bbcname + "]" + theSelection + "[/" + bbcname + "]";
		document.post.message.focus();
		return;
		}
	}
	if (!open[bbcname]) {
		ToAdd = "[" + bbcname + "]";
		open[bbcname] = 1;
	} else {
		ToAdd = "[/" + bbcname + "]";
		open[bbcname] = 0;
	}
	PostWrite(ToAdd);
}


function BBCurl() {
	var FoundErrors = '';
	var enterURL   = prompt(l_enter_url, "http://");
	var enterTITLE = prompt(l_enter_title, l_title);
	if (!enterURL)    {
		FoundErrors += " "+l_empty_url;
	}
	if (!enterTITLE)  {
		FoundErrors += " "+l_empty_title;
	}
	if (FoundErrors)  {
		alert(FoundErrors);
		return;
	}
	var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}

function BBCimg() {
	var FoundErrors = '';
	var enterURL   = prompt(l_enter_img_url,"http://");
	if (!enterURL) {
		FoundErrors += " "+l_empty_img_url;
	}
	if (FoundErrors) {
		alert(FoundErrors);
		return;
	}
	var ToAdd = "[img]"+enterURL+"[/img]";
	document.post.message.value+=ToAdd;
	document.post.message.focus();
}
