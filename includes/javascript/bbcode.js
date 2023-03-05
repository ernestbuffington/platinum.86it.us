var theSelection = false;

var clientPC = navigator.userAgent.toLowerCase();
var clientVer = parseInt(navigator.appVersion);

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));

var is_win = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac = (clientPC.indexOf("mac")!=-1);

b_help = "Bold: [B]text[/B]";
i_help = "Italic: [I]text[/I]";
u_help = "Under Line: [U]text[/U]";
quote_help = "Quote: [quote]text[/quote]";
code_help = "Code: [code]code[/code]";
php_help = "PHP: [php]code[/php]";
img_help = "Insert Image: [img]http://image path[/img]";
fc_help = "Font Color: [color=red]text[/color] You can use HTML color=#FF0000";
fs_help = "Font Size: [size=9]Very Small[/size]";
ft_help = "Font type: [font=Andalus]text[/font]";
rtl_help = "Make message box align from Right to Left";
ltr_help = "Make message box align from Left to Right";
mail_help = "Insert Email: [email]Email Here[/email]";
url_help="Insert Web Page: [url=Page URL]Page name[/url]";
right_help="set text align to right: [align=right]text[/align]";
left_help="set text align to left: [align=left]text[/align]";
center_help="set text align to center: [align=center]text[/align]";
justify_help="justify text: [align=justify]text[/align]";
marqr_help="Marque text to Right: [marq=right]text[/marq]";
marql_help="Marque text to Left: [marq=left]text[/marq]";
marqu_help="Marque text to up: [marq=up]text[/marq]";
marqd_help="Marque text to down: [marq=down]text[/marq]";
hr_help="Insert H-Line [hr]";
video_help="Insert video file: [video width=# height=#]file URL[/video]";
flash_help="Insert flash file: [flash width=# height=#]flash URL[/flash]";

var bbcode = new Array(0);
var fc = new Array(0);
var fs = new Array(0);
var ft = new Array(0);

function emoticon(form, field, text) {
    text = ' ' + text + ' ';
    PostWrite(form, field, text);
}

function BBCie(form, field, start, end) {
  if ((clientVer >= 4) && is_ie && is_win) {
    theSelection = document.selection.createRange().text;
    if (theSelection != '') {
        document.selection.createRange().text = start + theSelection + end;
        document.forms[form].elements[field].focus();
        return true;
    }
  }
  return false;
}

function BBChr(form, field) {
  document.forms[form].elements[field].value+="[hr]";
  document.forms[form].elements[field].focus();
}

function BBCwmi(form, field, type) {
  if (type == 'img') {
    var link = prompt("Please enter image URL","http://");
  } else {
    var link = prompt("Enter the Email Address","");
  }
  if (!link) {
    alert("Error : You didn't write the Address");
    return;
  }
  var ToAdd = "["+type+"]"+link+"[/"+type+"]";
  document.forms[form].elements[field].value+=ToAdd;
  //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
  document.forms[form].elements[field].focus();
}

function BBCdir(form, field, dirc) {
  document.forms[form].elements[field].dir=(dirc);
}

function BBCode(form, field, code, img) {
  var type = img.name;
  if (BBCie(form, field, "["+code+"="+type+"]", "[/"+code+"]")) { return; }
  if (bbcode[code+type+form+field] == null) {
    ToAdd = "["+code+"="+type+"]";
    img.src = "images/bbcode/"+code+"_"+type+"1.gif";
    bbcode[code+type+form+field] = 1;
  } else {
    ToAdd = "[/"+code+"]";
    img.src = "images/bbcode/"+code+"_"+type+".gif";
    bbcode[code+type+form+field] = null;
  }
  PostWrite(form, field, ToAdd);
}

function BBCcode(form, field, img) {
  var code = img.name;
  if (BBCie(form, field, "["+code+"]", "[/"+code+"]")) { return; }
  if (bbcode[form+field+code] == null) {
    ToAdd = "["+code+"]";
    img.src = "images/bbcode/"+code+"1.gif";
    bbcode[form+field+code] = 1;
  } else {
    ToAdd = "[/"+code+"]";
    img.src = "images/bbcode/"+code+".gif";
    bbcode[form+field+code] = null;
  }
  PostWrite(form, field, ToAdd);
}

function BBCft(form, field) {
  if (BBCie(form, field, "[font="+document.forms[form].ft.value+"]", "[/font]")) { return; }
  ToAdd = "[font="+document.forms[form].ft.value+"]"+" "+"[/font]";
  PostWrite(form, field, ToAdd);
}

function BBCfs(form, field) {
  if (BBCie(form, field, "[size="+document.forms[form].fs.value+"]", "[/size]")) { return; }
  ToAdd = "[size="+document.forms[form].fs.value+"]"+" "+"[/size]";
  PostWrite(form, field, ToAdd);
}

function BBCfc(form, field, box) {
  if (BBCie(form, field, "[color="+box.value+"]", "[/color]")) { return; }
  ToAdd = "[color="+box.value+"]"+" "+"[/color]";
  PostWrite(form, field, ToAdd);
}

function BBCmm(form, field, type) {
  var FoundErrors = '';
  var enterFURL   = prompt("Enter the "+type+" file URL", "http://");
  if (!enterFURL)    {
    FoundErrors += "You didn't write the "+type+" file URL";
  }
  var enterW   = prompt("Enter the "+type+" width", "250");
  if (!enterW)    {
    FoundErrors += "You didn't write the "+type+" width";
  }
  var enterH   = prompt("Enter the "+type+" height", "250");
  if (!enterH)    {
    FoundErrors += "You didn't write the "+type+" height";
  }
  if (FoundErrors)  {
    alert("Error :"+FoundErrors);
    return;
  }
  var ToAdd = "["+type+" width="+enterW+" height="+enterH+"]"+enterFURL+"[/"+type+"]";
  document.forms[form].elements[field].value+=ToAdd;
  document.forms[form].elements[field].focus();
}

function helpline(form, field, help) {
  document.forms[form].elements["help"+field].value = eval(help + "_help");
  document.forms[form].elements["help"+field].readOnly = "true";
}

function bbfontstyle(form, field, bbopen, bbclose) {
  if ((clientVer >= 4) && is_ie && is_win) {
    theSelection = document.selection.createRange().text;
    if (!theSelection) {
      document.forms[form].elements[field].value += bbopen + bbclose;
      document.forms[form].elements[field].focus();
      return;
    }
    document.selection.createRange().text = bbopen + theSelection + bbclose;
    document.forms[form].elements[field].focus();
    return;
  } else {
    document.forms[form].elements[field].value += bbopen + bbclose;
    document.forms[form].elements[field].focus();
    return;
  }
  storeCaret(document.forms[form].elements[field]);
}

function storeCaret(textEl) {
  if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(form, field, text) {
  if (document.forms[form].elements[field].createTextRange && document.forms[form].elements[field].caretPos) {
    var caretPos = document.forms[form].elements[field].caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?    text + ' ' : text;
  }
  else document.forms[form].elements[field].value += text;
  document.forms[form].elements[field].focus(caretPos)
}

function BBCurl(form, field) {
  var FoundErrors = '';
  var enterURL   = prompt("Enter the URL", "http://");
  var enterTITLE = prompt("Enter the page name", "Web Page Name");
  if (!enterURL)    {
    FoundErrors += "You didn't write the URL ";
  }
  if (!enterTITLE)  {
    FoundErrors += "You didn't write the page name ";
  }
  if (FoundErrors)  {
    alert("Error :"+FoundErrors);
    return;
  }
  var ToAdd = "[url="+enterURL+"]"+enterTITLE+"[/url]";
  document.forms[form].elements[field].value+=ToAdd;
  document.forms[form].elements[field].focus();
}