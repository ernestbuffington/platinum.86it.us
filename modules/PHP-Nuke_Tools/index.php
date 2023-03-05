<?php

/********************************************************/
/* PHP-Nuke Tools v4.00 RC 1                            */
/* By: Disipal Network (http://disipal.net)		*/
/* http://www.disipal.net                               */
/* Copyright � 2003-2009 by Disipal Network             */
/********************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
define('INDEX_FILE', true);
define('NO_EDITOR', true);

function Tools() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <center><table height=\"212\" cellspacing=0 cellpadding=0 width=\"100%\" border=0 style=\"border-collapse: collapse\" bordercolor=\"#111111\" id=\"AutoNumber1\" bordercolorlight=\"#FFFFFF\" bordercolordark=\"#C0C0C0\">"
  . "  <tbody>"
  . "  "
  . "    <td valign=top align=middle width=\"30%\" height=\"212\"><br />�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLPHP\">"._HTMLC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLASP\">"._HTMLASP."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLJSP\">"._HTMLJSP."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLPERL\">"._HTMLPERL."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLJS\">"._HTMLJS."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLSWS\">"._HTMLSWS."</a> �</td>"
  . "    <td valign=top align=middle width=\"30%\" height=\"212\"><br />�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Module\">"._MODULEC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Block\">"._BLOCKC."</a> � <br />"
  . "    &nbsp;<p>"
  . "    <br />"
  . "    ::&nbsp;&nbsp;HelpFiles&nbsp;&nbsp;::<br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HelpModule\">Help for Module Creator</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HelpBlock\">Help for Block Creator</a> � "
  . "</td></tr></tbody></table>";
echo " <center><table height=\"212\" cellspacing=0 cellpadding=0 width=\"100%\" border=0 style=\"border-collapse: collapse\" bordercolor=\"#111111\" id=\"AutoNumber1\" bordercolorlight=\"#FFFFFF\" bordercolordark=\"#C0C0C0\">"
  . "  <tbody>"
  . "  "
  . "    <td valign=top align=middle width=\"30%\" height=\"212\"><br />�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Source\">"._EDITORC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=MTags\">"._METAC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Scroll\">"._SCROLLC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Pop\">"._POPUP."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Color\">"._HEXC."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=PREVIEWER\">"._PREVIEWER."</a> � </td>"
  . "    <td valign=top align=middle width=\"30%\" height=\"182\"><br /> � "
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=SourceCoder\">"._SCODER."</a> �</p>"
  . "    <p>�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HTMLENCODER\">"._HTMLCODER."</a> �</p>"
  . "    <p>�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=URLENCODER\">"._URLCODER."</a> �</p>"
  . "    <p>�"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=EMAIL\">"._EMAILCODER."</a> � <br />"
  . "    <br />"
  . "    �"
  . "    <a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=ROT\">"._ROTCODER."</a> � <br />"
  . "</td></tbody></table>";
    CloseTable();

    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DisModule() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisModule.js");
       OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo "<table class=\"\" borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0><tbody>"
  . "<tr><td align=middle>"
  . "<table borderColor=#aa0000 height=400 cellSpacing=0 cellPadding=0 width=\"98%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center><br /><h4>"._MODULEC."</h4><br />"
  . "<form name=modumake><table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0><tbody><tr>"
  . "<td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68%></textarea> "
  . "</td></tr><tr><td align=middle>"._MODINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68%></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=makemymod() type=button value="._MAKEMOD."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "<tr><td align=middle>&nbsp;</td></tr></tbody></table></td></tr></tbody></table></center></tr></tbody></table>";
echo"    <br /><br /><center><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HelpModule\"><h5>"._HELP."</h5></a>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}

function DisBlock() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisBlock.js");
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><center>"
  . "<center><br /><h4>"._BLOCKC."</h4><br />"
  . "<table borderColor=#aa0000 cellSpacing=0 cellPadding=0 width=\"98%\" border=0>"
  . "<tbody><tr><td><center><form name=blocker>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr>"
  . "<td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr>"
  . "<td align=middle>"._BLOKINFO."</td></tr>"
  . "<tr>"
  . "<td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr>"
  . "<tr>"
  . "<td align=middle><input class=button onclick=blockfix() type=button value="._MAKEBLOK."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr><td align=middle>&nbsp;</td></tr></tbody></table>"
  . "</td></tr></tbody></table></center></tr></tbody></table>";
echo"    <br /><br /><center><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=HelpBlock\"><h5>"._HELP."</h5></a>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Oops, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}


function DisHTMLPHP() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisHTMLPHP.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLC."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}


function DisHTMLJS() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisHTMLJS.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLJS."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DisHTMLASP() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisHTMLASP.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLASP."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DisHTMLJSP() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisHTMLJSP.js");
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLJSP."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DisHTMLPERL() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisHTMLPERL.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLPERL."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=VIRTUAL cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DiSource() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/Dis.js");
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo ("<center><br /><h4>"._EDITORC."</h4><br /><br />")
  ."<form name=\"editor\">"
  . "<table border=1>"
  . "<tr>"
  . "<td align=center>"
  . "<strong>"

  . "<input type=\"button\" value=\" "._END." \" onClick=\"end()\">"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._PREV."\" onClick=\"preview()\">"
  . ""
  . "</strong>"
  . "</td>"
  . "<td align=center>"
  . "<input type=\"button\" value=\" "._START." \" onClick=\"treset()\">&nbsp;&nbsp;"
  . "<i>"
  . "<input type=\"button\" value=\" "._ABOUT." \" onClick=\"alert('By Disipal, (C) 2003')\">"
  . "</i>"
  . "</td>"
  . "</tr>"
  . "<tr>"
  . "<td valign=top>"
  . "<strong>"._FORMA."</strong><br />"
  . "<input type=\"button\" value=\" "._BOL." \" onClick=\"bold()\">&nbsp;&nbsp;&nbsp;"
  . "<input type=\"button\" value=\" "._ITAL." \""
  . "onClick=\"italic()\">&nbsp;&nbsp;&nbsp;"
  . "<input type=\"button\" value=\" "._UNDER." \" onClick=\"underline()\"><br />"
  . "<input type=\"button\" value=\" "._PRE." \" onClick=\"pre()\"><br />"
  . "<input type=\"button\" value=\" "._CENT." \" onClick=\"center()\">"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
  . "<input type=\"button\" value=\" "._HO." \" onClick=\"hbar()\"><br />"
  . "<input type=\"button\" value=\" "._LINE." \" onClick=\"lbreak()\">&nbsp;"
  . "<input type=\"button\" value=\" "._PA."\" onClick=\"pbreak()\">"
  . "</td>"
  . "<td valign=top>"
  . "<strong>"._MODE."</strong><br />"
  . "<input type=\"radio\" name=\"mode\" value=\"help\""
  . "onClick=\"thelp(1)\">&nbsp;&nbsp;"._HELP."<br />"
  . "&nbsp;&nbsp;<i><small>"._HELPT."</small></i><br />"
  . "<input type=\"radio\" name=\"mode\" value=\"prompt\" onClick=\"thelp(2)\">&nbsp;&nbsp;"._PROMPT."<br />"
  . "&nbsp;&nbsp;<i><small>"._PROMPTT."</small><br />"
  . "<input type=\"radio\" name=\"mode\" value=\"basic\" checked onClick=\"thelp(0)\">&nbsp;&nbsp;"._BASIC."<br />"
  . "&nbsp;&nbsp;<i><small>"._BASICT."</small></i>"
  . "</td>"
  . "</tr>"
  . "<tr>"
  . "<td valign=top>"
  . "<strong>"._HEADIN."</strong><br />"
  . "<input type=\"button\" value=\"  1  \" onClick=\"head1()\">"
  . "&nbsp;"
  . "<input type=\"button\" value=\"  2  \" onClick=\"head2()\">"
  . "&nbsp;"
  . "<input type=\"button\" value=\"  3  \" onClick=\"head3()\">"
  . "&nbsp;"
  . "<input type=\"button\" value=\"  4  \" onClick=\"head4()\">"
  . "&nbsp;"
  . "<input type=\"button\" value=\"  5  \" onClick=\"head5()\">"
  . "&nbsp;"
  . "<input type=\"button\" value=\"  6  \" onClick=\"head6()\">"
  . "</td>"
  . "<td valign=top>"
  . "<strong>"._LINKS."</strong><br />"
  . "<input type=\"button\" value=\" "._OP." \" onClick=\"linkopen()\">&nbsp;"
  . "<input type=\"button\" value=\" "._TEXT." \" onClick=\"linktext()\">&nbsp;"
  . "<input type=\"button\" value=\" "._CLO." \" onClick=\"linkclose()\">"
  . "<br />"
  . "<input type=\"button\" value=\" "._ANC." \" onClick=\"anchor()\">"
  . "</tr>"
  . "<tr>"
  . "<td valign=top>"
  . "<strong>"._LISTS."</strong><br />"
  . ""
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Ordered</i><br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._OP."\""
  . "onClick=\"orderopen()\">&nbsp;"
  . "<input type=\"button\" value=\" "._ITE." \" onClick=\"li()\">&nbsp;"
  . "<input type=\"button\" value=\" "._CLO." \" onClick=\"orderclose()\">"
  . "<br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Unordered</i><br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._OP." \""
  . "onClick=\"unorderopen()\">&nbsp;"
  . "<input type=\"button\" value=\" "._ITE." \" onClick=\"li()\">&nbsp;"
  . "<input type=\"button\" value=\" "._CLO." \" onClick=\"unorderclose()\">"
  . "<br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>"._DEF."</i><br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._OP." \" onClick=\"defopen()\">"
  . "<input type=\"button\" value=\" "._TERM." \" onClick=\"defterm()\">"
  . "<input type=\"button\" value=\" "._DEF." \" onClick=\"define()\">"
  . "<input type=\"button\" value=\" "._CLO." \" onClick=\"defclose()\">"
  . "</td>"
  . "<td valign=top>"
  . "<strong>"._IMAGS."</strong><br />"
  . "<input type=\"button\" value=\" "._IMAG." \" onClick=\"image()\">"
  . "<br /> "
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>"._ALIG." </i><br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._LEFT." \"onClick=\"aleft()\">&nbsp;"
  . "<input type=\"button\" value=\" "._RIGHT." \" onClick=\"aright()\"><br />"
  . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\" "._TOP." \" onClick=\"atop()\">&nbsp;"
  . "<input type=\"button\" value=\" "._MIDDLE." \" onClick=\"amid()\">&nbsp;"
  . "<input type=\"button\" value=\" "._BOTTOM."\" onClick=\"abottom()\">"
  . "</td>"
  . "</tr>"
  . "<tr>"
  . "<td valign=top>"
  . "<strong>"._FONT."</strong><br />"
  . "<input type=\"button\" value=\" "._FONT." \" onClick=\"font()\">&nbsp;"
  . "<input type=\"button\" value=\" "._COLOR." \" onClick=\"fontcolor()\">&nbsp;"
  . "<input type=\"button\" value=\" "._SIZE." \" onClick=\"fontsize()\">&nbsp;"
  . "<input type=\"button\" value=\" "._CLO." \" onClick=\"fontclose()\">"
  . "</td>"
  . "<td align=center>"
  . "<small>Copyright 2003 by Disipal</small>"
  . "</td>"
  . "</tr>"
  . "</table>"
  . "<p> "
  . "<strong>"._TSCON."</strong>"
  . "</center>"
  . "<br /><br />"
  . "<center>"
  . "<textarea name=\"area\" rows=12 cols=90 wrap=physical>"
  . "<html>"
  . ""
  . "<head>"
  . ""
  . "<Online Editor by Disipal Designs>"
  . ""
  . "<title>New Page</title>"
  . "</head>"
  . "</textarea>"
  . "<p>"
  . "</form>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function DisPop() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/popup.js");
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "    <center><br /><h4>"._POPUP."</h4><br /><br /><p><small><strong>"._STEP."</strong>"._STEPP."</font></small></p>"
  . "    <form method=\"POST\" name=\"winlook\">"
  . "      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\">"
  . "        <tr>"
  . "          <td width=\"20%\" height=\"20\">"
  . "          <p align=\"left\"><small>"._TOOLBAR."</font></small></td>"
  . "          <td width=\"5%\" height=\"20\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"toolbar\"></font></small></td>"
  . "          <td width=\"20%\" height=\"20\">"
  . "          <p align=\"left\"><small>"._LOCATION."</font></small></td>"
  . "          <td width=\"5%\" height=\"20\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"locks\" value=\"location\"></font></small></td>"
  . "          <td width=\"20%\" height=\"20\">"
  . "          <p align=\"left\"><small>"._DIRECT."</font></small></td>"
  . "          <td width=\"5%\" height=\"20\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"directories\"></font></small></td>"
  . "          <td width=\"20%\" height=\"20\">"
  . "          <p align=\"left\"><small>"._STATUSBA."</font></small></td>"
  . "          <td width=\"5%\" height=\"20\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"status\"></font></small></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td width=\"20%\" height=\"8\">"
  . "          <p align=\"left\"><small>"._SCROLL."</font></small></td>"
  . "          <td width=\"5%\" height=\"8\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"scrollbars\"></font></small></td>"
  . "          <td width=\"20%\" height=\"8\">"
  . "          <p align=\"left\"><small>"._MENUBAR."</font></small></td>"
  . "          <td width=\"5%\" height=\"8\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"menubar\"></font></small></td>"
  . "          <td width=\"20%\" height=\"8\">"
  . "          <p align=\"left\"><small>"._RESI."</font></small></td>"
  . "          <td width=\"5%\" height=\"8\">"
  . "          <p align=\"left\"><small><input type=\"checkbox\""
  . "          name=\"looks\" value=\"resizable\"></font></small></td>"
  . "          <td width=\"20%\" height=\"8\">"
  . "          <p align=\"left\"><small><a"
  . "          href=\"javascript:previewit()\">"._LIVE."</a></strong></font></small></td>"
  . "          <td width=\"5%\" height=\"8\">"
  . "          <p align=\"left\"></td>"
  . "        </tr>"
  . "      </table>"
  . "    </form>"
  . "    <form method=\"POST\" name=\"winsession\">"
  . "      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"626\">"
  . "        <tr>"
  . "          <td width=\"436\">"
  . "          <p align=\"left\"><small><strong>"._STTEP."</strong>"._STTEPP.""

  . "          <td valign=\"top\" width=\"190\">"
  . "          <p align=\"left\"><select size=\"1\" name=\"winsession1\">"
  . "              <option selected value=\"auto\">"._AYTO."</option>"
  . "              <option value=\"textlink\">"._TEXTLI."</option>"
  . "            </select></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td width=\"436\">"
  . "          <p align=\"left\"><br />"
  . "          <input type=\"button\" value=\" "._GENERA." \" name=\"B1\" onClick=\"generateit()\"> <input"
  . "          type=\"button\" value=\" "._RESET." \" name=\"B2\""
  . "          onClick=\"document.winlook.reset();document.winsession.reset();document.source.reset()\"></td>"
  . "          <td width=\"190\">"
  . "          <p align=\"left\"></td>"
  . "        </tr>"
  . "      </table>"
  . "    </form>"
  . "    <p><small>"._SCTGC."</small></font></p>"
  . "    <form method=\"POST\" action=\"--WEBBOT-SELF--\" name=\"source\">"
  . "      <!--webbot bot=\"SaveResults\" u-file=\"C:\\temp\\_private\\form_results.txt\" s-format=\"TEXT/CSV\" s-label-fields=\"TRUE\" --><p>"
  . "      <textarea"
  . "      rows=\"10\" name=\"source2\" cols=\"65\" style=\"width:100%; height:160\"></textarea></p>"
  . "    </form>"
  . "    <p><small><strong>"._CTPF."</strong>"
  . "    </small></font></p>"
  . "      <p><small>"._TCTD."</small></font></p>"
  . "</td></tr></tbody></table>"
  . "</td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }


}

function Scroll() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <center><td><br /><h4>"._SCROLLC."</h4><br />"
  . "<!-- Style Sheet -->"
  . ""
  . ""
  . "<!-- Common JS Calls -->"
  . "<script language = \"javascript\">"
  . "<!--"
  . "var ie = document.all ? 1 : 0"
  . "var ns = document.layers ? 1 : 0"
  . "if(ie){"
  . "document.write('<style type=\"text/css\">')"
  . "document.write('.textfield {font-size:10pt; font-family:verdana; color:#808080; font-weight:bold;}\\n')"
  . "document.write('.hexfield {font-size:10pt; font-family:verdana; color:#808080; font-weight:bold;}\\n')"
  . "document.write('.buttons {border-style: solid; background-color: #808080; border-color: #000000; border-width: 1; color: #FFFFFF; font-size: 10pt; font-family: verdana; font-weight: bold;}\\n')"
  . "document.write('</style>')"
  . "}"
  . "//-->"
  . "</script>"
  . ""
  . "<div align=\"center\"><script language=\"JavaScript\" src='modules/$module_name/js/iescroll.js'></script></div>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }


}

function Color() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <center><br /><h4>"._HEXC."</h4><br />"
  . "        <table width=\"90%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\" bordercolorlight=\"#787878\" bordercolordark=\"#787878\" style=\"border-collapse: collapse\" bordercolor=\"#787878\">"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#eeeeee\"><font color=\"#000000\">EEEEEE</font></td>"
  . "        <td bgcolor=\"#dddddd\"><font color=\"#000000\">DDDDDD</font></td>"
  . "        <td bgcolor=\"#cccccc\"><font color=\"#000000\">CCCCCC</font></td>"
  . "        <td bgcolor=\"#bbbbbb\"><font color=\"#000000\">BBBBBB</font></td>"
  . "        <td bgcolor=\"#aaaaaa\"><font color=\"#000000\">AAAAAA</font></td>"
  . "        <td bgcolor=\"#999999\"><font color=\"#ffffff\">999999</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#888888\"><font color=\"#ffffff\">888888</font></td>"
  . "        <td bgcolor=\"#777777\"><font color=\"#ffffff\">777777</font></td>"
  . "        <td bgcolor=\"#666666\"><font color=\"#ffffff\">666666</font></td>"
  . "        <td bgcolor=\"#555555\"><font color=\"#ffffff\">555555</font></td>"
  . "        <td bgcolor=\"#444444\"><font color=\"#ffffff\">444444</font></td>"
  . "        <td bgcolor=\"#333333\"><font color=\"#ffffff\">333333</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#222222\"><font color=\"#ffffff\">222222</font></td>"
  . "        <td bgcolor=\"#111111\"><font color=\"#ffffff\">111111</font></td>"
  . "        <td bgcolor=\"#000000\"><font color=\"#ffffff\">000000</font></td>"
  . "        <td bgcolor=\"#ff0000\"><font color=\"#ffffff\">FF0000</font></td>"
  . "        <td bgcolor=\"#ee0000\"><font color=\"#ffffff\">EE0000</font></td>"
  . "        <td bgcolor=\"#dd0000\"><font color=\"#ffffff\">DD0000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc0000\"><font color=\"#ffffff\">CC0000</font></td>"
  . "        <td bgcolor=\"#bb0000\"><font color=\"#ffffff\">BB0000</font></td>"
  . "        <td bgcolor=\"#aa0000\"><font color=\"#ffffff\">AA0000</font></td>"
  . "        <td bgcolor=\"#990000\"><font color=\"#ffffff\">990000</font></td>"
  . "        <td bgcolor=\"#880000\"><font color=\"#ffffff\">880000</font></td>"
  . "        <td bgcolor=\"#770000\"><font color=\"#ffffff\">770000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#660000\"><font color=\"#ffffff\">660000</font></td>"
  . "        <td bgcolor=\"#550000\"><font color=\"#ffffff\">550000</font></td>"
  . "        <td bgcolor=\"#440000\"><font color=\"#ffffff\">440000</font></td>"
  . "        <td bgcolor=\"#330000\"><font color=\"#ffffff\">330000</font></td>"
  . "        <td bgcolor=\"#220000\"><font color=\"#ffffff\">220000</font></td>"
  . "        <td bgcolor=\"#110000\"><font color=\"#ffffff\">110000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ffffff\"><font color=\"#000000\">FFFFFF</font></td>"
  . "        <td bgcolor=\"#ffffcc\"><font color=\"#000000\">FFFFCC</font></td>"
  . "        <td bgcolor=\"#ffff99\"><font color=\"#000000\">FFFF99</font></td>"
  . "        <td bgcolor=\"#ffff66\"><font color=\"#000000\">FFFF66</font></td>"
  . "        <td bgcolor=\"#ffff33\"><font color=\"#000000\">FFFF33</font></td>"
  . "        <td bgcolor=\"#ffff00\"><font color=\"#000000\">FFFF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ccffff\"><font color=\"#000000\">CCFFFF</font></td>"
  . "        <td bgcolor=\"#ccffcc\"><font color=\"#000000\">CCFFCC</font></td>"
  . "        <td bgcolor=\"#ccff99\"><font color=\"#000000\">CCFF99</font></td>"
  . "        <td bgcolor=\"#ccff66\"><font color=\"#000000\">CCFF66</font></td>"
  . "        <td bgcolor=\"#ccff33\"><font color=\"#000000\">CCFF33</font></td>"
  . "        <td bgcolor=\"#ccff00\"><font color=\"#000000\">CCFF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#99ffff\"><font color=\"#000000\">99FFFF</font></td>"
  . "        <td bgcolor=\"#99ffcc\"><font color=\"#000000\">99FFCC</font></td>"
  . "        <td bgcolor=\"#99ff99\"><font color=\"#000000\">99FF99</font></td>"
  . "        <td bgcolor=\"#99ff66\"><font color=\"#000000\">99FF66</font></td>"
  . "        <td bgcolor=\"#99ff33\"><font color=\"#000000\">99FF33</font></td>"
  . "        <td bgcolor=\"#99ff00\"><font color=\"#000000\">99FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66ffff\"><font color=\"#000000\">66FFFF</font></td>"
  . "        <td bgcolor=\"#66ffcc\"><font color=\"#000000\">66FFCC</font></td>"
  . "        <td bgcolor=\"#66ff99\"><font color=\"#000000\">66FF99</font></td>"
  . "        <td bgcolor=\"#66ff66\"><font color=\"#000000\">66FF66</font></td>"
  . "        <td bgcolor=\"#66ff33\"><font color=\"#000000\">66FF33</font></td>"
  . "        <td bgcolor=\"#66ff00\"><font color=\"#000000\">66FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#33ffff\"><font color=\"#000000\">33FFFF</font></td>"
  . "        <td bgcolor=\"#33ffcc\"><font color=\"#000000\">33FFCC</font></td>"
  . "        <td bgcolor=\"#33ff99\"><font color=\"#000000\">33FF99</font></td>"
  . "        <td bgcolor=\"#33ff66\"><font color=\"#000000\">33FF66</font></td>"
  . "        <td bgcolor=\"#33ff33\"><font color=\"#000000\">33FF33</font></td>"
  . "        <td bgcolor=\"#33ff00\"><font color=\"#000000\">33FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00ffff\"><font color=\"#000000\">00FFFF</font></td>"
  . "        <td bgcolor=\"#00ffcc\"><font color=\"#000000\">00FFCC</font></td>"
  . "        <td bgcolor=\"#00ff99\"><font color=\"#000000\">00FF99</font></td>"
  . "        <td bgcolor=\"#00ff66\"><font color=\"#000000\">00FF66</font></td>"
  . "        <td bgcolor=\"#00ff33\"><font color=\"#000000\">00FF33</font></td>"
  . "        <td bgcolor=\"#00ff00\"><font color=\"#000000\">00FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ffccff\"><font color=\"#000000\">FFCCFF</font></td>"
  . "        <td bgcolor=\"#ffcccc\"><font color=\"#000000\">FFCCCC</font></td>"
  . "        <td bgcolor=\"#ffcc99\"><font color=\"#000000\">FFCC99</font></td>"
  . "        <td bgcolor=\"#ffcc66\"><font color=\"#000000\">FFCC66</font></td>"
  . "        <td bgcolor=\"#ffcc33\"><font color=\"#000000\">FFCC33</font></td>"
  . "        <td bgcolor=\"#ffcc00\"><font color=\"#000000\">FFCC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ccccff\"><font color=\"#000000\">CCCCFF</font></td>"
  . "        <td bgcolor=\"#cccccc\"><font color=\"#000000\">CCCCCC</font></td>"
  . "        <td bgcolor=\"#cccc99\"><font color=\"#000000\">CCCC99</font></td>"
  . "        <td bgcolor=\"#cccc66\"><font color=\"#000000\">CCCC66</font></td>"
  . "        <td bgcolor=\"#cccc33\"><font color=\"#000000\">CCCC33</font></td>"
  . "        <td bgcolor=\"#cccc00\"><font color=\"#000000\">CCCC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#99ccff\"><font color=\"#000000\">99CCFF</font></td>"
  . "        <td bgcolor=\"#99cccc\"><font color=\"#000000\">99CCCC</font></td>"
  . "        <td bgcolor=\"#99cc99\"><font color=\"#000000\">99CC99</font></td>"
  . "        <td bgcolor=\"#99cc66\"><font color=\"#000000\">99CC66</font></td>"
  . "        <td bgcolor=\"#99cc33\"><font color=\"#000000\">99CC33</font></td>"
  . "        <td bgcolor=\"#99cc00\"><font color=\"#000000\">99CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66ccff\"><font color=\"#000000\">66CCFF</font></td>"
  . "        <td bgcolor=\"#66cccc\"><font color=\"#000000\">66CCCC</font></td>"
  . "        <td bgcolor=\"#66cc99\"><font color=\"#000000\">66CC99</font></td>"
  . "        <td bgcolor=\"#66cc66\"><font color=\"#000000\">66CC66</font></td>"
  . "        <td bgcolor=\"#66cc33\"><font color=\"#000000\">66CC33</font></td>"
  . "        <td bgcolor=\"#66cc00\"><font color=\"#000000\">66CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#33ccff\"><font color=\"#000000\">33CCFF</font></td>"
  . "        <td bgcolor=\"#33cccc\"><font color=\"#000000\">33CCCC</font></td>"
  . "        <td bgcolor=\"#33cc99\"><font color=\"#000000\">33CC99</font></td>"
  . "        <td bgcolor=\"#33cc66\"><font color=\"#000000\">33CC66</font></td>"
  . "        <td bgcolor=\"#33cc33\"><font color=\"#000000\">33CC33</font></td>"
  . "        <td bgcolor=\"#33cc00\"><font color=\"#000000\">33CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00ccff\"><font color=\"#000000\">00CCFF</font></td>"
  . "        <td bgcolor=\"#00cccc\"><font color=\"#000000\">00CCCC</font></td>"
  . "        <td bgcolor=\"#33cc66\"><font color=\"#000000\">33CC66</font></td>"
  . "        <td bgcolor=\"#33cc33\"><font color=\"#000000\">33CC33</font></td>"
  . "        <td bgcolor=\"#00cc99\"><font color=\"#000000\">00CC99</font></td>"
  . "        <td bgcolor=\"#00cc66\"><font color=\"#000000\">00CC66</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00cc33\"><font color=\"#000000\">00CC33</font></td>"
  . "        <td bgcolor=\"#00cc00\"><font color=\"#000000\">00CC00</font></td>"
  . "        <td bgcolor=\"#ff99ff\"><font color=\"#000000\">FF99FF</font></td>"
  . "        <td bgcolor=\"#ff99cc\"><font color=\"#000000\">FF99CC</font></td>"
  . "        <td bgcolor=\"#ff9999\"><font color=\"#000000\">FF9999</font></td>"
  . "        <td bgcolor=\"#ff9966\"><font color=\"#000000\">FF9966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff9933\"><font color=\"#ffffff\">FF9933</font></td>"
  . "        <td bgcolor=\"#ff9900\"><font color=\"#ffffff\">FF9900</font></td>"
  . "        <td bgcolor=\"#cc99ff\"><font color=\"#ffffff\">CC99FF</font></td>"
  . "        <td bgcolor=\"#cc99cc\"><font color=\"#ffffff\">CC99CC</font></td>"
  . "        <td bgcolor=\"#cc9999\"><font color=\"#ffffff\">CC9999</font></td>"
  . "        <td bgcolor=\"#cc9966\"><font color=\"#ffffff\">CC9966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc9933\"><font color=\"#ffffff\">CC9933</font></td>"
  . "        <td bgcolor=\"#cc9900\"><font color=\"#ffffff\">CC9900</font></td>"
  . "        <td bgcolor=\"#9999ff\"><font color=\"#ffffff\">9999FF</font></td>"
  . "        <td bgcolor=\"#9999cc\"><font color=\"#ffffff\">9999CC</font></td>"
  . "        <td bgcolor=\"#999999\"><font color=\"#ffffff\">999999</font></td>"
  . "        <td bgcolor=\"#999966\"><font color=\"#ffffff\">999966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#999933\"><font color=\"#ffffff\">999933</font></td>"
  . "        <td bgcolor=\"#999900\"><font color=\"#ffffff\">999900</font></td>"
  . "        <td bgcolor=\"#6699ff\"><font color=\"#ffffff\">6699FF</font></td>"
  . "        <td bgcolor=\"#6699cc\"><font color=\"#ffffff\">6699CC</font></td>"
  . "        <td bgcolor=\"#669999\"><font color=\"#ffffff\">669999</font></td>"
  . "        <td bgcolor=\"#669966\"><font color=\"#ffffff\">669966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#669933\"><font color=\"#ffffff\">669933</font></td>"
  . "        <td bgcolor=\"#669900\"><font color=\"#ffffff\">669900</font></td>"
  . "        <td bgcolor=\"#3399ff\"><font color=\"#ffffff\">3399FF</font></td>"
  . "        <td bgcolor=\"#3399cc\"><font color=\"#ffffff\">3399CC</font></td>"
  . "        <td bgcolor=\"#339999\"><font color=\"#ffffff\">339999</font></td>"
  . "        <td bgcolor=\"#339966\"><font color=\"#ffffff\">339966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#339933\"><font color=\"#ffffff\">339933</font></td>"
  . "        <td bgcolor=\"#339900\"><font color=\"#ffffff\">339900</font></td>"
  . "        <td bgcolor=\"#0099ff\"><font color=\"#ffffff\">0099FF</font></td>"
  . "        <td bgcolor=\"#0099cc\"><font color=\"#ffffff\">0099CC</font></td>"
  . "        <td bgcolor=\"#009999\"><font color=\"#ffffff\">009999</font></td>"
  . "        <td bgcolor=\"#009966\"><font color=\"#ffffff\">009966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#009933\"><font color=\"#ffffff\">009933</font></td>"
  . "        <td bgcolor=\"#009900\"><font color=\"#ffffff\">009900</font></td>"
  . "        <td bgcolor=\"#ff66ff\"><font color=\"#ffffff\">FF66FF</font></td>"
  . "        <td bgcolor=\"#ff66cc\"><font color=\"#ffffff\">FF66CC</font></td>"
  . "        <td bgcolor=\"#ff6699\"><font color=\"#ffffff\">FF6699</font></td>"
  . "        <td bgcolor=\"#ff6666\"><font color=\"#ffffff\">FF6666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff6633\"><font color=\"#ffffff\">FF6633</font></td>"
  . "        <td bgcolor=\"#ff6600\"><font color=\"#ffffff\">FF6600</font></td>"
  . "        <td bgcolor=\"#cc66ff\"><font color=\"#ffffff\">CC66FF</font></td>"
  . "        <td bgcolor=\"#cc66cc\"><font color=\"#ffffff\">CC66CC</font></td>"
  . "        <td bgcolor=\"#cc6699\"><font color=\"#ffffff\">CC6699</font></td>"
  . "        <td bgcolor=\"#cc6666\"><font color=\"#ffffff\">CC6666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc6633\"><font color=\"#ffffff\">CC6633</font></td>"
  . "        <td bgcolor=\"#cc6600\"><font color=\"#ffffff\">CC6600</font></td>"
  . "        <td bgcolor=\"#9966ff\"><font color=\"#ffffff\">9966FF</font></td>"
  . "        <td bgcolor=\"#9966cc\"><font color=\"#ffffff\">9966CC</font></td>"
  . "        <td bgcolor=\"#996699\"><font color=\"#ffffff\">996699</font></td>"
  . "        <td bgcolor=\"#996666\"><font color=\"#ffffff\">996666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#996633\"><font color=\"#ffffff\">996633</font></td>"
  . "        <td bgcolor=\"#996600\"><font color=\"#ffffff\">996600</font></td>"
  . "        <td bgcolor=\"#6666ff\"><font color=\"#ffffff\">6666FF</font></td>"
  . "        <td bgcolor=\"#6666cc\"><font color=\"#ffffff\">6666CC</font></td>"
  . "        <td bgcolor=\"#666699\"><font color=\"#ffffff\">666699</font></td>"
  . "        <td bgcolor=\"#666666\"><font color=\"#ffffff\">666666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#666633\"><font color=\"#ffffff\">666633</font></td>"
  . "        <td bgcolor=\"#666600\"><font color=\"#ffffff\">666600</font></td>"
  . "        <td bgcolor=\"#3366ff\"><font color=\"#ffffff\">3366FF</font></td>"
  . "        <td bgcolor=\"#0063F7\"><font color=\"#ffffff\">3366CC</font></td>"
  . "        <td bgcolor=\"#336699\"><font color=\"#ffffff\">336699</font></td>"
  . "        <td bgcolor=\"#336666\"><font color=\"#ffffff\">336666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#336633\"><font color=\"#ffffff\">336633</font></td>"
  . "        <td bgcolor=\"#336600\"><font color=\"#ffffff\">336600</font></td>"
  . "        <td bgcolor=\"#0066ff\"><font color=\"#ffffff\">0066FF</font></td>"
  . "        <td bgcolor=\"#0066cc\"><font color=\"#ffffff\">0066CC</font></td>"
  . "        <td bgcolor=\"#006699\"><font color=\"#ffffff\">006699</font></td>"
  . "        <td bgcolor=\"#006666\"><font color=\"#ffffff\">006666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#006633\"><font color=\"#ffffff\">006633</font></td>"
  . "        <td bgcolor=\"#006600\"><font color=\"#ffffff\">006600</font></td>"
  . "        <td bgcolor=\"#ff33ff\"><font color=\"#ffffff\">FF33FF</font></td>"
  . "        <td bgcolor=\"#ff33cc\"><font color=\"#ffffff\">FF33CC</font></td>"
  . "        <td bgcolor=\"#ff3399\"><font color=\"#ffffff\">FF3399</font></td>"
  . "        <td bgcolor=\"#ff3366\"><font color=\"#ffffff\">FF3366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff3333\"><font color=\"#ffffff\">FF3333</font></td>"
  . "        <td bgcolor=\"#ff3300\"><font color=\"#ffffff\">FF3300</font></td>"
  . "        <td bgcolor=\"#cc33ff\"><font color=\"#ffffff\">CC33FF</font></td>"
  . "        <td bgcolor=\"#cc33cc\"><font color=\"#ffffff\">CC33CC</font></td>"
  . "        <td bgcolor=\"#cc3399\"><font color=\"#ffffff\">CC3399</font></td>"
  . "        <td bgcolor=\"#cc3366\"><font color=\"#ffffff\">CC3366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc3333\"><font color=\"#ffffff\">CC3333</font></td>"
  . "        <td bgcolor=\"#cc3300\"><font color=\"#ffffff\">CC3300</font></td>"
  . "        <td bgcolor=\"#9933ff\"><font color=\"#ffffff\">9933FF</font></td>"
  . "        <td bgcolor=\"#9933cc\"><font color=\"#ffffff\">9933CC</font></td>"
  . "        <td bgcolor=\"#993399\"><font color=\"#ffffff\">993399</font></td>"
  . "        <td bgcolor=\"#993366\"><font color=\"#ffffff\">993366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#993333\"><font color=\"#ffffff\">993333</font></td>"
  . "        <td bgcolor=\"#993300\"><font color=\"#ffffff\">993300</font></td>"
  . "        <td bgcolor=\"#6633ff\"><font color=\"#ffffff\">6633FF</font></td>"
  . "        <td bgcolor=\"#6633cc\"><font color=\"#ffffff\">6633CC</font></td>"
  . "        <td bgcolor=\"#663399\"><font color=\"#ffffff\">663399</font></td>"
  . "        <td bgcolor=\"#663366\"><font color=\"#ffffff\">663366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#663333\"><font color=\"#ffffff\">663333</font></td>"
  . "        <td bgcolor=\"#663300\"><font color=\"#ffffff\">663300</font></td>"
  . "        <td bgcolor=\"#3333ff\"><font color=\"#ffffff\">3333FF</font></td>"
  . "        <td bgcolor=\"#3333cc\"><font color=\"#ffffff\">3333CC</font></td>"
  . "        <td bgcolor=\"#333399\"><font color=\"#ffffff\">333399</font></td>"
  . "        <td bgcolor=\"#333366\"><font color=\"#ffffff\">333366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#333333\"><font color=\"#ffffff\">333333</font></td>"
  . "        <td bgcolor=\"#333300\"><font color=\"#ffffff\">333300</font></td>"
  . "        <td bgcolor=\"#0033ff\"><font color=\"#ffffff\">0033FF</font></td>"
  . "        <td bgcolor=\"#ff3333\"><font color=\"#ffffff\">FF3333</font></td>"
  . "        <td bgcolor=\"#0033cc\"><font color=\"#ffffff\">0033CC</font></td>"
  . "        <td bgcolor=\"#003399\"><font color=\"#ffffff\">003399</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#003366\"><font color=\"#ffffff\">003366</font></td>"
  . "        <td bgcolor=\"#003333\"><font color=\"#ffffff\">003333</font></td>"
  . "        <td bgcolor=\"#003300\"><font color=\"#ffffff\">003300</font></td>"
  . "        <td bgcolor=\"#ff00ff\"><font color=\"#ffffff\">FF00FF</font></td>"
  . "        <td bgcolor=\"#ff00cc\"><font color=\"#ffffff\">FF00CC</font></td>"
  . "        <td bgcolor=\"#ff0099\"><font color=\"#ffffff\">FF0099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff0066\"><font color=\"#ffffff\">FF0066</font></td>"
  . "        <td bgcolor=\"#ff0033\"><font color=\"#ffffff\">FF0033</font></td>"
  . "        <td bgcolor=\"#ff0000\"><font color=\"#ffffff\">FF0000</font></td>"
  . "        <td bgcolor=\"#cc00ff\"><font color=\"#ffffff\">CC00FF</font></td>"
  . "        <td bgcolor=\"#cc00cc\"><font color=\"#ffffff\">CC00CC</font></td>"
  . "        <td bgcolor=\"#cc0099\"><font color=\"#ffffff\">CC0099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc0066\"><font color=\"#ffffff\">CC0066</font></td>"
  . "        <td bgcolor=\"#cc0033\"><font color=\"#ffffff\">CC0033</font></td>"
  . "        <td bgcolor=\"#cc0000\"><font color=\"#ffffff\">CC0000</font></td>"
  . "        <td bgcolor=\"#9900ff\"><font color=\"#ffffff\">9900FF</font></td>"
  . "        <td bgcolor=\"#9900cc\"><font color=\"#ffffff\">9900CC</font></td>"
  . "        <td bgcolor=\"#990099\"><font color=\"#ffffff\">990099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#990066\"><font color=\"#ffffff\">990066</font></td>"
  . "        <td bgcolor=\"#990033\"><font color=\"#ffffff\">990033</font></td>"
  . "        <td bgcolor=\"#990000\"><font color=\"#ffffff\">990000</font></td>"
  . "        <td bgcolor=\"#6600ff\"><font color=\"#ffffff\">6600FF</font></td>"
  . "        <td bgcolor=\"#6600cc\"><font color=\"#ffffff\">6600CC</font></td>"
  . "        <td bgcolor=\"#660099\"><font color=\"#ffffff\">660099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#660066\"><font color=\"#ffffff\">660066</font></td>"
  . "        <td bgcolor=\"#660033\"><font color=\"#ffffff\">660033</font></td>"
  . "        <td bgcolor=\"#660000\"><font color=\"#ffffff\">660000</font></td>"
  . "        <td bgcolor=\"#3300ff\"><font color=\"#ffffff\">3300FF</font></td>"
  . "        <td bgcolor=\"#3300cc\"><font color=\"#ffffff\">3300CC</font></td>"
  . "        <td bgcolor=\"#330099\"><font color=\"#ffffff\">330099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#330066\"><font color=\"#ffffff\">330066</font></td>"
  . "        <td bgcolor=\"#330033\"><font color=\"#ffffff\">330033</font></td>"
  . "        <td bgcolor=\"#330000\"><font color=\"#ffffff\">330000</font></td>"
  . "        <td bgcolor=\"#0000ff\"><font color=\"#ffffff\">0000FF</font></td>"
  . "        <td bgcolor=\"#0000cc\"><font color=\"#ffffff\">0000CC</font></td>"
  . "        <td bgcolor=\"#000099\"><font color=\"#ffffff\">000099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000066\"><font color=\"#ffffff\">000066</font></td>"
  . "        <td bgcolor=\"#000033\"><font color=\"#ffffff\">000033</font></td>"
  . "        <td bgcolor=\"#00ff00\"><font color=\"#000000\">00FF00</font></td>"
  . "        <td bgcolor=\"#00ee00\"><font color=\"#000000\">00EE00</font></td>"
  . "        <td bgcolor=\"#00dd00\"><font color=\"#000000\">00DD00</font></td>"
  . "        <td bgcolor=\"#00cc00\"><font color=\"#000000\">00CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00bb00\"><font color=\"#ffffff\">00BB00</font></td>"
  . "        <td bgcolor=\"#00aa00\"><font color=\"#ffffff\">00AA00</font></td>"
  . "        <td bgcolor=\"#009900\"><font color=\"#ffffff\">009900</font></td>"
  . "        <td bgcolor=\"#008800\"><font color=\"#ffffff\">008800</font></td>"
  . "        <td bgcolor=\"#007700\"><font color=\"#ffffff\">007700</font></td>"
  . "        <td bgcolor=\"#006600\"><font color=\"#ffffff\">006600</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#005500\"><font color=\"#ffffff\">005500</font></td>"
  . "        <td bgcolor=\"#004400\"><font color=\"#ffffff\">004400</font></td>"
  . "        <td bgcolor=\"#003300\"><font color=\"#ffffff\">003300</font></td>"
  . "        <td bgcolor=\"#002200\"><font color=\"#ffffff\">002200</font></td>"
  . "        <td bgcolor=\"#001100\"><font color=\"#ffffff\">001100</font></td>"
  . "        <td bgcolor=\"#0000ff\"><font color=\"#ffffff\">0000FF</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#0000ee\"><font color=\"#ffffff\">0000EE</font></td>"
  . "        <td bgcolor=\"#0000dd\"><font color=\"#ffffff\">0000DD</font></td>"
  . "        <td bgcolor=\"#0000cc\"><font color=\"#ffffff\">0000CC</font></td>"
  . "        <td bgcolor=\"#0000bb\"><font color=\"#ffffff\">0000BB</font></td>"
  . "        <td bgcolor=\"#0000aa\"><font color=\"#ffffff\">0000AA</font></td>"
  . "        <td bgcolor=\"#000099\"><font color=\"#ffffff\">000099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000088\"><font color=\"#ffffff\">000088</font></td>"
  . "        <td bgcolor=\"#000077\"><font color=\"#ffffff\">000077</font></td>"
  . "        <td bgcolor=\"#000055\"><font color=\"#ffffff\">000055</font></td>"
  . "        <td bgcolor=\"#000044\"><font color=\"#ffffff\">000044</font></td>"
  . "        <td bgcolor=\"#000022\"><font color=\"#ffffff\">000022</font></td>"
  . "        <td bgcolor=\"#000011\"><font color=\"#ffffff\">000011</font></td></tr></table><br /><br />"
  . "        <table width=\"90%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\" bordercolorlight=\"#787878\" bordercolordark=\"#787878\" style=\"border-collapse: collapse\" bordercolor=\"#787878\">"
  . "        <tr align=\"center\">"
  . "        <td>Color & name</td>"
  . "        <td>R-G-B Equivalent</td>"
  . "        <td>Hexadecimal #</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F8F8FF\"><font color=\"#000000\">GhostWhite</font></td>"
  . "        <td>248 248 255</td>"
  . "        <td>#F8F8FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F5F5F5\"><font color=\"#000000\">WhiteSmoke</font></td>"
  . "        <td>245 245 245</td>"
  . "        <td>#F5F5F5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DCDCDC\"><font color=\"#000000\">Gainsboro</font></td>"
  . "        <td>220 220 220</td>"
  . "        <td>#DCDCDC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFFFF\"><font color=\"#000000\">White</font></td>"
  . "        <td>255 255 255</td>"
  . "        <td>#FFFFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000000\"><font color=\"#ffffff\">Black</font></td>"
  . "        <td>0 0 0</td>"
  . "        <td>#000000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#696969\"><font color=\"#ffffff\">DimGray</font></td>"
  . "        <td>105 105 105</td>"
  . "        <td>#696969</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D3D3D3\"><font color=\"#000000\">LightGray</font></td>"
  . "        <td>211 211 211</td>"
  . "        <td>#D3D3D3</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BEBEBE\"><font color=\"#000000\">Gray</font></td>"
  . "        <td>190 190 190</td>"
  . "        <td>#BEBEBE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#1C1C1C\"><font color=\"#ffffff\">Gray11</font></td>"
  . "        <td>28 28 28</td>"
  . "        <td>#1C1C1C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#363636\"><font color=\"#ffffff\">Gray21</font></td>"
  . "        <td>54 54 54</td>"
  . "        <td>#363636</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4F4F4F\"><font color=\"#ffffff\">Gray31</font></td>"
  . "        <td>79 79 79</td>"
  . "        <td>#4F4F4F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#696969\"><font color=\"#ffffff\">Gray41</font></td>"
  . "        <td>105 105 105</td>"
  . "        <td>#696969</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#828282\"><font color=\"#ffffff\">Gray51</font></td>"
  . "        <td>130 130 130</td>"
  . "        <td>#828282</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9C9C9C\"><font color=\"#000000\">Gray61</font></td>"
  . "        <td>156 156 156</td>"
  . "        <td>#9C9C9C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B5B5B5\"><font color=\"#000000\">Gray71</font></td>"
  . "        <td>181 181 181</td>"
  . "        <td>#B5B5B5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CFCFCF\"><font color=\"#000000\">Gray81</font></td>"
  . "        <td>207 207 207</td>"
  . "        <td>#CFCFCF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E8E8E8\"><font color=\"#000000\">Gray91</font></td>"
  . "        <td>232 232 232</td>"
  . "        <td>#E8E8E8</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A9A9A9\"><font color=\"#000000\">DarkGray</font></td>"
  . "        <td>169 169 169</td>"
  . "        <td>#A9A9A9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#778899\"><font color=\"#ffffff\">LightSlateGray</font></td>"
  . "        <td>119 136 153</td>"
  . "        <td>#778899</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#708090\"><font color=\"#ffffff\">SlateGray</font></td>"
  . "        <td>112 128 144</td>"
  . "        <td>#708090</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C6E2FF\"><font color=\"#000000\">SlateGray1</font></td>"
  . "        <td>198 226 255</td>"
  . "        <td>#C6E2FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B9D3EE\"><font color=\"#000000\">SlateGray2</font></td>"
  . "        <td>185 211 238</td>"
  . "        <td>#B9D3EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9FB6CD\"><font color=\"#000000\">SlateGray3</font></td>"
  . "        <td>159 182 205</td>"
  . "        <td>#9FB6CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6C7B8B\"><font color=\"#ffffff\">SlateGray4</font></td>"
  . "        <td>108 123 139</td>"
  . "        <td>#6C7B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#2F4F4F\"><font color=\"#ffffff\">DarkSlateGray</font></td>"
  . "        <td>47 79 79</td>"
  . "        <td>#2F4F4F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#97FFFF\"><font color=\"#000000\">DarkSlateGray1</font></td>"
  . "        <td>151 255 255</td>"
  . "        <td>#97FFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8DEEEE\"><font color=\"#000000\">DarkSlateGray2</font></td>"
  . "        <td>141 238 238</td>"
  . "        <td>#8DEEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#79CDCD\"><font color=\"#000000\">DarkSlateGray3</font></td>"
  . "        <td>121 205 205</td>"
  . "        <td>#79CDCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#528B8B\"><font color=\"#ffffff\">DarkSlateGray4</font></td>"
  . "        <td>82 139 139</td>"
  . "        <td>#528B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE8AA\"><font color=\"#000000\">PaleGoldenrod</font></td>"
  . "        <td>238 232 170</td>"
  . "        <td>#EEE8AA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFAF0\"><font color=\"#000000\">FloralWhite</font></td>"
  . "        <td>255 250 240</td>"
  . "        <td>#FFFAF0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FAFAD2\"><font color=\"#000000\">LightGoldenrodYellow</font></td>"
  . "        <td>250 250 210</td>"
  . "        <td>#FAFAD2</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4513\"><font color=\"#ffffff\">SaddleBrown</font></td>"
  . "        <td>139 69 19</td>"
  . "        <td>#8B4513</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A0522D\"><font color=\"#ffffff\">Sienna</font></td>"
  . "        <td>160 82 45</td>"
  . "        <td>#A0522D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FDF5E6\"><font color=\"#000000\">OldLace</font></td>"
  . "        <td>253 245 230</td>"
  . "        <td>#FDF5E6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FAF0E6\"><font color=\"#000000\">Linen</font></td>"
  . "        <td>250 240 230</td>"
  . "        <td>#FAF0E6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFEFD5\"><font color=\"#000000\">PapayaWhip</font></td>"
  . "        <td>255 239 213</td>"
  . "        <td>#FFEFD5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFEBCD\"><font color=\"#000000\">BlanchedAlmond</font></td>"
  . "        <td>255 235 205</td>"
  . "        <td>#FFEBCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFE4B5\"><font color=\"#000000\">Moccasin</font></td>"
  . "        <td>255 228 181</td>"
  . "        <td>#FFE4B5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD853F\"><font color=\"#ffffff\">Peru</font></td>"
  . "        <td>205 133 63</td>"
  . "        <td>#CD853F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F5F5DC\"><font color=\"#000000\">Beige</font></td>"
  . "        <td>245 245 220</td>"
  . "        <td>#F5F5DC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F4A460\"><font color=\"#ffffff\">SandyBrown</font></td>"
  . "        <td>244 164 96</td>"
  . "        <td>#F4A460</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFAFA\"><font color=\"#000000\">Snow1</font></td>"
  . "        <td>255 250 250</td>"
  . "        <td>#FFFAFA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE9E9\"><font color=\"#000000\">Snow2</font></td>"
  . "        <td>238 233 233</td>"
  . "        <td>#EEE9E9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC9C9\"><font color=\"#000000\">Snow3</font></td>"
  . "        <td>205 201 201</td>"
  . "        <td>#CDC9C9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8989\"><font color=\"#ffffff\">Snow4</font></td>"
  . "        <td>139 137 137</td>"
  . "        <td>#8B8989</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFF5EE\"><font color=\"#000000\">Seashell1</font></td>"
  . "        <td>255 245 238</td>"
  . "        <td>#FFF5EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE5DE\"><font color=\"#000000\">Seashell2</font></td>"
  . "        <td>238 229 222</td>"
  . "        <td>#EEE5DE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC5BF\"><font color=\"#000000\">Seashell3</font></td>"
  . "        <td>205 197 191</td>"
  . "        <td>#CDC5BF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8682\"><font color=\"#ffffff\">Seashell4</font></td>"
  . "        <td>139 134 130</td>"
  . "        <td>#8B8682</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FAEBD7\"><font color=\"#000000\">AntiqueWhite</font></td>"
  . "        <td>250 235 215</td>"
  . "        <td>#FAEBD7</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFEFDB\"><font color=\"#000000\">AntiqueWhite1</font></td>"
  . "        <td>255 239 219</td>"
  . "        <td>#FFEFDB</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEDFCC\"><font color=\"#000000\">AntiqueWhite2</font></td>"
  . "        <td>238 223 204</td>"
  . "        <td>#EEDFCC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC0B0\"><font color=\"#000000\">AntiqueWhite3</font></td>"
  . "        <td>205 192 176</td>"
  . "        <td>#CDC0B0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8378\"><font color=\"#ffffff\">AntiqueWhite4</font></td>"
  . "        <td>139 131 120</td>"
  . "        <td>#8B8378</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFE4C4\"><font color=\"#000000\">Bisque1</font></td>"
  . "        <td>255 228 196</td>"
  . "        <td>#FFE4C4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EED5B7\"><font color=\"#000000\">Bisque2</font></td>"
  . "        <td>238 213 183</td>"
  . "        <td>#EED5B7</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDB79E\"><font color=\"#000000\">Bisque3</font></td>"
  . "        <td>205 183 158</td>"
  . "        <td>#CDB79E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7D6B\"><font color=\"#ffffff\">Bisque4</font></td>"
  . "        <td>139 125 107</td>"
  . "        <td>#8B7D6B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFDAB9\"><font color=\"#000000\">PeachPuff1</font></td>"
  . "        <td>255 218 185</td>"
  . "        <td>#FFDAB9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EECBAD\"><font color=\"#000000\">PeachPuff2</font></td>"
  . "        <td>238 203 173</td>"
  . "        <td>#EECBAD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDAF95\"><font color=\"#000000\">PeachPuff3</font></td>"
  . "        <td>205 175 149</td>"
  . "        <td>#CDAF95</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7765\"><font color=\"#ffffff\">PeachPuff4</font></td>"
  . "        <td>139 119 101</td>"
  . "        <td>#8B7765</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFDEAD\"><font color=\"#000000\">NavajoWhite1</font></td>"
  . "        <td>255 222 173</td>"
  . "        <td>#FFDEAD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EECFA1\"><font color=\"#000000\">NavajoWhite2</font></td>"
  . "        <td>238 207 161</td>"
  . "        <td>#EECFA1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDB38B\"><font color=\"#000000\">NavajoWhite3</font></td>"
  . "        <td>205 179 139</td>"
  . "        <td>#CDB38B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B795E\"><font color=\"#ffffff\">NavajoWhite4</font></td>"
  . "        <td>139 121 94</td>"
  . "        <td>#8B795E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFACD\"><font color=\"#000000\">LemonChiffon1</font></td>"
  . "        <td>255 250 205</td>"
  . "        <td>#FFFACD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE9BF\"><font color=\"#000000\">LemonChiffon2</font></td>"
  . "        <td>238 233 191</td>"
  . "        <td>#EEE9BF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC9A5\"><font color=\"#000000\">LemonChiffon3</font></td>"
  . "        <td>205 201 165</td>"
  . "        <td>#CDC9A5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8970\"><font color=\"#ffffff\">LemonChiffon4</font></td>"
  . "        <td>139 137 112</td>"
  . "        <td>#8B8970</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFF8DC\"><font color=\"#000000\">Cornsilk1</font></td>"
  . "        <td>255 248 220</td>"
  . "        <td>#FFF8DC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE8CD\"><font color=\"#000000\">Cornsilk2</font></td>"
  . "        <td>238 232 205</td>"
  . "        <td>#EEE8CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC8B1\"><font color=\"#000000\">Cornsilk3</font></td>"
  . "        <td>205 200 177</td>"
  . "        <td>#CDC8B1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8878\"><font color=\"#ffffff\">Cornsilk4</font></td>"
  . "        <td>139 136 120</td>"
  . "        <td>#8B8878</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFFF0\"><font color=\"#000000\">Ivory1</font></td>"
  . "        <td>255 255 240</td>"
  . "        <td>#FFFFF0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEEEE0\"><font color=\"#000000\">Ivory2</font></td>"
  . "        <td>238 238 224</td>"
  . "        <td>#EEEEE0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDCDC1\"><font color=\"#000000\">Ivory3</font></td>"
  . "        <td>205 205 193</td>"
  . "        <td>#CDCDC1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8B83\"><font color=\"#ffffff\">Ivory4</font></td>"
  . "        <td>139 139 131</td>"
  . "        <td>#8B8B83</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F5FFFA\"><font color=\"#000000\">MintCream</font></td>"
  . "        <td>245 255 250</td>"
  . "        <td>#F5FFFA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F0FFF0\"><font color=\"#000000\">Honeydew1</font></td>"
  . "        <td>240 255 240</td>"
  . "        <td>#F0FFF0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E0EEE0\"><font color=\"#000000\">Honeydew2</font></td>"
  . "        <td>224 238 224</td>"
  . "        <td>#E0EEE0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C1CDC1\"><font color=\"#000000\">Honeydew3</font></td>"
  . "        <td>193 205 193</td>"
  . "        <td>#C1CDC1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#838B83\"><font color=\"#ffffff\">Honeydew4</font></td>"
  . "        <td>131 139 131</td>"
  . "        <td>#838B83</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFF0F5\"><font color=\"#000000\">LavenderBlush1</font></td>"
  . "        <td>255 240 245</td>"
  . "        <td>#FFF0F5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE0E5\"><font color=\"#000000\">LavenderBlush2</font></td>"
  . "        <td>238 224 229</td>"
  . "        <td>#EEE0E5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC1C5\"><font color=\"#000000\">LavenderBlush3</font></td>"
  . "        <td>205 193 197</td>"
  . "        <td>#CDC1C5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8386\"><font color=\"#ffffff\">LavenderBlush4</font></td>"
  . "        <td>139 131 134</td>"
  . "        <td>#8B8386</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E6E6FA\"><font color=\"#000000\">Lavender</font></td>"
  . "        <td>230 230 250</td>"
  . "        <td>#E6E6FA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFE4E1\"><font color=\"#000000\">MistyRose1</font></td>"
  . "        <td>255 228 225</td>"
  . "        <td>#FFE4E1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EED5D2\"><font color=\"#000000\">MistyRose2</font></td>"
  . "        <td>238 213 210</td>"
  . "        <td>#EED5D2</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDB7B5\"><font color=\"#000000\">MistyRose3</font></td>"
  . "        <td>205 183 181</td>"
  . "        <td>#CDB7B5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7D7B\"><font color=\"#ffffff\">MistyRose4</font></td>"
  . "        <td>139 125 123</td>"
  . "        <td>#8B7D7B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F0FFFF\"><font color=\"#000000\">Azure1</font></td>"
  . "        <td>240 255 255</td>"
  . "        <td>#F0FFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E0EEEE\"><font color=\"#000000\">Azure2</font></td>"
  . "        <td>224 238 238</td>"
  . "        <td>#E0EEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C1CDCD\"><font color=\"#000000\">Azure3</font></td>"
  . "        <td>193 205 205</td>"
  . "        <td>#C1CDCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#838B8B\"><font color=\"#ffffff\">Azure4</font></td>"
  . "        <td>131 139 139</td>"
  . "        <td>#838B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F0F8FF\"><font color=\"#000000\">AliceBlue</font></td>"
  . "        <td>240 248 255</td>"
  . "        <td>#F0F8FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8470FF\"><font color=\"#ffffff\">LightSlateBlue</font></td>"
  . "        <td>132 112 255</td>"
  . "        <td>#8470FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7B68EE\"><font color=\"#ffffff\">MediumSlateBlue</font></td>"
  . "        <td>123 104 238</td>"
  . "        <td>#7B68EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6A5ACD\"><font color=\"#ffffff\">SlateBlue</font></td>"
  . "        <td>106 90 205</td>"
  . "        <td>#6A5ACD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#836FFF\"><font color=\"#ffffff\">SlateBlue1</font></td>"
  . "        <td>131 111 255</td>"
  . "        <td>#836FFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7A67EE\"><font color=\"#ffffff\">SlateBlue2</font></td>"
  . "        <td>122 103 238</td>"
  . "        <td>#7A67EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6959CD\"><font color=\"#ffffff\">SlateBlue3</font></td>"
  . "        <td>105 89 205</td>"
  . "        <td>#6959CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#473C8B\"><font color=\"#ffffff\">SlateBlue4</font></td>"
  . "        <td>71 60 139</td>"
  . "        <td>#473C8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#483D8B\"><font color=\"#ffffff\">DarkSlateBlue</font></td>"
  . "        <td>72 61 139</td>"
  . "        <td>#483D8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4169E1\"><font color=\"#ffffff\">RoyalBlue</font></td>"
  . "        <td>65 105 225</td>"
  . "        <td>#4169E1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4876FF\"><font color=\"#ffffff\">RoyalBlue1</font></td>"
  . "        <td>72 118 255</td>"
  . "        <td>#4876FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#436EEE\"><font color=\"#ffffff\">RoyalBlue2</font></td>"
  . "        <td>67 110 238</td>"
  . "        <td>#436EEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#3A5FCD\"><font color=\"#ffffff\">RoyalBlue3</font></td>"
  . "        <td>58 95 205</td>"
  . "        <td>#3A5FCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#27408B\"><font color=\"#ffffff\">RoyalBlue4</font></td>"
  . "        <td>39 64 139</td>"
  . "        <td>#27408B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#0000FF\"><font color=\"#ffffff\">Blue1</font></td>"
  . "        <td>0 0 255</td>"
  . "        <td>#0000FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#0000EE\"><font color=\"#ffffff\">Blue2</font></td>"
  . "        <td>0 0 238</td>"
  . "        <td>#0000EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00008B\"><font color=\"#ffffff\">DarkBlue</font></td>"
  . "        <td>0 0 139</td>"
  . "        <td>#00008B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000080\"><font color=\"#ffffff\">NavyBlue</font></td>"
  . "        <td>0 0 128</td>"
  . "        <td>#000080</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#191970\"><font color=\"#ffffff\">MidnightBlue</font></td>"
  . "        <td>25 25 112</td>"
  . "        <td>#191970</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6495ED\"><font color=\"#ffffff\">CornflowerBlue</font></td>"
  . "        <td>100 149 237</td>"
  . "        <td>#6495ED</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#0000CD\"><font color=\"#ffffff\">MediumBlue</font></td>"
  . "        <td>0 0 205</td>"
  . "        <td>#0000CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B0E0E6\"><font color=\"#000000\">PowderBlue</font></td>"
  . "        <td>176 224 230</td>"
  . "        <td>#B0E0E6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#1E90FF\"><font color=\"#ffffff\">DodgerBlue1</font></td>"
  . "        <td>30 144 255</td>"
  . "        <td>#1E90FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#1C86EE\"><font color=\"#ffffff\">DodgerBlue2</font></td>"
  . "        <td>28 134 238</td>"
  . "        <td>#1C86EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#1874CD\"><font color=\"#ffffff\">DodgerBlue3</font></td>"
  . "        <td>24 116 205</td>"
  . "        <td>#1874CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#104E8B\"><font color=\"#ffffff\">DodgerBlue4</font></td>"
  . "        <td>16 78 139</td>"
  . "        <td>#104E8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4682B4\"><font color=\"#ffffff\">SteelBlue</font></td>"
  . "        <td>70 130 180</td>"
  . "        <td>#4682B4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#63B8FF\"><font color=\"#ffffff\">SteelBlue1</font></td>"
  . "        <td>99 184 255</td>"
  . "        <td>#63B8FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#5CACEE\"><font color=\"#ffffff\">SteelBlue2</font></td>"
  . "        <td>92 172 238</td>"
  . "        <td>#5CACEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4F94CD\"><font color=\"#ffffff\">SteelBlue3</font></td>"
  . "        <td>79 148 205</td>"
  . "        <td>#4F94CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#36648B\"><font color=\"#ffffff\">SteelBlue4</font></td>"
  . "        <td>54 100 139</td>"
  . "        <td>#36648B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00BFFF\"><font color=\"#ffffff\">DeepSkyBlue1</font></td>"
  . "        <td>0 191 255</td>"
  . "        <td>#00BFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00B2EE\"><font color=\"#ffffff\">DeepSkyBlue2</font></td>"
  . "        <td>0 178 238</td>"
  . "        <td>#00B2EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#009ACD\"><font color=\"#ffffff\">DeepSkyBlue3</font></td>"
  . "        <td>0 154 205</td>"
  . "        <td>#009ACD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00688B\"><font color=\"#ffffff\">DeepSkyBlue4</font></td>"
  . "        <td>0 104 139</td>"
  . "        <td>#00688B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#87CEEB\"><font color=\"#000000\">SkyBlue</font></td>"
  . "        <td>135 206 235</td>"
  . "        <td>#87CEEB</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#87CEFF\"><font color=\"#000000\">SkyBlue1</font></td>"
  . "        <td>135 206 255</td>"
  . "        <td>#87CEFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7EC0EE\"><font color=\"#000000\">SkyBlue2</font></td>"
  . "        <td>126 192 238</td>"
  . "        <td>#7EC0EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6CA6CD\"><font color=\"#000000\">SkyBlue3</font></td>"
  . "        <td>108 166 205</td>"
  . "        <td>#6CA6CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4A708B\"><font color=\"#ffffff\">SkyBlue4</font></td>"
  . "        <td>74 112 139</td>"
  . "        <td>#4A708B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#87CEFA\"><font color=\"#000000\">LightSkyBlue</font></td>"
  . "        <td>135 206 250</td>"
  . "        <td>#87CEFA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B0E2FF\"><font color=\"#000000\">LightSkyBlue1</font></td>"
  . "        <td>176 226 255</td>"
  . "        <td>#B0E2FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A4D3EE\"><font color=\"#000000\">LightSkyBlue2</font></td>"
  . "        <td>164 211 238</td>"
  . "        <td>#A4D3EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8DB6CD\"><font color=\"#000000\">LightSkyBlue3</font></td>"
  . "        <td>141 182 205</td>"
  . "        <td>#8DB6CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#607B8B\"><font color=\"#ffffff\">LightSkyBlue4</font></td>"
  . "        <td>96 123 139</td>"
  . "        <td>#607B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B0C4DE\"><font color=\"#000000\">LightSteelBlue</font></td>"
  . "        <td>176 196 222</td>"
  . "        <td>#B0C4DE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CAE1FF\"><font color=\"#000000\">LightSteelBlue1</font></td>"
  . "        <td>202 225 255</td>"
  . "        <td>#CAE1FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BCD2EE\"><font color=\"#000000\">LightSteelBlue2</font></td>"
  . "        <td>188 210 238</td>"
  . "        <td>#BCD2EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A2B5CD\"><font color=\"#000000\">LightSteelBlue3</font></td>"
  . "        <td>162 181 205</td>"
  . "        <td>#A2B5CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6E7B8B\"><font color=\"#ffffff\">LightSteelBlue4</font></td>"
  . "        <td>110 123 139</td>"
  . "        <td>#6E7B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ADD8E6\"><font color=\"#000000\">LightBlue</font></td>"
  . "        <td>173 216 230</td>"
  . "        <td>#ADD8E6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BFEFFF\"><font color=\"#000000\">LightBlue1</font></td>"
  . "        <td>191 239 255</td>"
  . "        <td>#BFEFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B2DFEE\"><font color=\"#000000\">LightBlue2</font></td>"
  . "        <td>178 223 238</td>"
  . "        <td>#B2DFEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9AC0CD\"><font color=\"#000000\">LightBlue3</font></td>"
  . "        <td>154 192 205</td>"
  . "        <td>#9AC0CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#68838B\"><font color=\"#ffffff\">LightBlue4</font></td>"
  . "        <td>104 131 139</td>"
  . "        <td>#68838B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E0FFFF\"><font color=\"#000000\">LightCyan1</font></td>"
  . "        <td>224 255 255</td>"
  . "        <td>#E0FFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D1EEEE\"><font color=\"#000000\">LightCyan2</font></td>"
  . "        <td>209 238 238</td>"
  . "        <td>#D1EEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B4CDCD\"><font color=\"#000000\">LightCyan3</font></td>"
  . "        <td>180 205 205</td>"
  . "        <td>#B4CDCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7A8B8B\"><font color=\"#ffffff\">LightCyan4</font></td>"
  . "        <td>122 139 139</td>"
  . "        <td>#7A8B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#5F9EA0\"><font color=\"#ffffff\">CadetBlue</font></td>"
  . "        <td>95 158 160</td>"
  . "        <td>#5F9EA0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#98F5FF\"><font color=\"#000000\">CadetBlue1</font></td>"
  . "        <td>152 245 255</td>"
  . "        <td>#98F5FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8EE5EE\"><font color=\"#000000\">CadetBlue2</font></td>"
  . "        <td>142 229 238</td>"
  . "        <td>#8EE5EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7AC5CD\"><font color=\"#000000\">CadetBlue3</font></td>"
  . "        <td>122 197 205</td>"
  . "        <td>#7AC5CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#53868B\"><font color=\"#ffffff\">CadetBlue4</font></td>"
  . "        <td>83 134 139</td>"
  . "        <td>#53868B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#AFEEEE\"><font color=\"#000000\">PaleTurquoise</font></td>"
  . "        <td>175 238 238</td>"
  . "        <td>#AFEEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BBFFFF\"><font color=\"#000000\">PaleTurquoise1</font></td>"
  . "        <td>187 255 255</td>"
  . "        <td>#BBFFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#AEEEEE\"><font color=\"#000000\">PaleTurquoise2</font></td>"
  . "        <td>174 238 238</td>"
  . "        <td>#AEEEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#96CDCD\"><font color=\"#000000\">PaleTurquoise3</font></td>"
  . "        <td>150 205 205</td>"
  . "        <td>#96CDCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#668B8B\"><font color=\"#ffffff\">PaleTurquoise4</font></td>"
  . "        <td>102 139 139</td>"
  . "        <td>#668B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#48D1CC\"><font color=\"#000000\">MediumTurquoise</font></td>"
  . "        <td>72 209 204</td>"
  . "        <td>#48D1CC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00CED1\"><font color=\"#000000\">DarkTurquoise</font></td>"
  . "        <td>0 206 209</td>"
  . "        <td>#00CED1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#40E0D0\"><font color=\"#000000\">Turquoise</font></td>"
  . "        <td>64 224 208</td>"
  . "        <td>#40E0D0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00F5FF\"><font color=\"#000000\">Turquoise1</font></td>"
  . "        <td>0 245 255</td>"
  . "        <td>#00F5FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00E5EE\"><font color=\"#000000\">Turquoise2</font></td>"
  . "        <td>0 229 238</td>"
  . "        <td>#00E5EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00C5CD\"><font color=\"#000000\">Turquoise3</font></td>"
  . "        <td>0 197 205</td>"
  . "        <td>#00C5CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00868B\"><font color=\"#ffffff\">Turquoise4</font></td>"
  . "        <td>0 134 139</td>"
  . "        <td>#00868B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00FFFF\"><font color=\"#000000\">Cyan1</font></td>"
  . "        <td>0 255 255</td>"
  . "        <td>#00FFFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00EEEE\"><font color=\"#000000\">Cyan2</font></td>"
  . "        <td>0 238 238</td>"
  . "        <td>#00EEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00CDCD\"><font color=\"#000000\">Cyan3</font></td>"
  . "        <td>0 205 205</td>"
  . "        <td>#00CDCD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#008B8B\"><font color=\"#ffffff\">DarkCyan</font></td>"
  . "        <td>0 139 139</td>"
  . "        <td>#008B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7FFFD4\"><font color=\"#000000\">Aquamarine1</font></td>"
  . "        <td>127 255 212</td>"
  . "        <td>#7FFFD4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#76EEC6\"><font color=\"#000000\">Aquamarine2</font></td>"
  . "        <td>118 238 198</td>"
  . "        <td>#76EEC6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66CDAA\"><font color=\"#000000\">Aquamarine3</font></td>"
  . "        <td>102 205 170</td>"
  . "        <td>#66CDAA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#458B74\"><font color=\"#ffffff\">Aquamarine4</font></td>"
  . "        <td>69 139 116</td>"
  . "        <td>#458B74</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8FBC8F\"><font color=\"#000000\">DarkSeaGreen</font></td>"
  . "        <td>143 188 143</td>"
  . "        <td>#8FBC8F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C1FFC1\"><font color=\"#000000\">DarkSeaGreen1</font></td>"
  . "        <td>193 255 193</td>"
  . "        <td>#C1FFC1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B4EEB4\"><font color=\"#000000\">DarkSeaGreen2</font></td>"
  . "        <td>180 238 180</td>"
  . "        <td>#B4EEB4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9BCD9B\"><font color=\"#000000\">DarkSeaGreen3</font></td>"
  . "        <td>155 205 155</td>"
  . "        <td>#9BCD9B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#698B69\"><font color=\"#ffffff\">DarkSeaGreen4</font></td>"
  . "        <td>105 139 105</td>"
  . "        <td>#698B69</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#2E8B57\"><font color=\"#ffffff\">SeaGreen</font></td>"
  . "        <td>46 139 87</td>"
  . "        <td>#2E8B57</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#54FF9F\"><font color=\"#000000\">SeaGreen1</font></td>"
  . "        <td>84 255 159</td>"
  . "        <td>#54FF9F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#4EEE94\"><font color=\"#000000\">SeaGreen2</font></td>"
  . "        <td>78 238 148</td>"
  . "        <td>#4EEE94</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#43CD80\"><font color=\"#000000\">SeaGreen3</font></td>"
  . "        <td>67 205 128</td>"
  . "        <td>#43CD80</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#98FB98\"><font color=\"#000000\">PaleGreen</font></td>"
  . "        <td>152 251 152</td>"
  . "        <td>#98FB98</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9AFF9A\"><font color=\"#000000\">PaleGreen1</font></td>"
  . "        <td>154 255 154</td>"
  . "        <td>#9AFF9A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#90EE90\"><font color=\"#000000\">PaleGreen2</font></td>"
  . "        <td>144 238 144</td>"
  . "        <td>#90EE90</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7CCD7C\"><font color=\"#000000\">PaleGreen3</font></td>"
  . "        <td>124 205 124</td>"
  . "        <td>#7CCD7C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#548B54\"><font color=\"#ffffff\">PaleGreen4</font></td>"
  . "        <td>84 139 84</td>"
  . "        <td>#548B54</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00FF7F\"><font color=\"#000000\">SpringGreen1</font></td>"
  . "        <td>0 255 127</td>"
  . "        <td>#00FF7F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00EE76\"><font color=\"#000000\">SpringGreen2</font></td>"
  . "        <td>0 238 118</td>"
  . "        <td>#00EE76</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00CD66\"><font color=\"#000000\">SpringGreen3</font></td>"
  . "        <td>0 205 102</td>"
  . "        <td>#00CD66</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#008B45\"><font color=\"#ffffff\">SpringGreen4</font></td>"
  . "        <td>0 139 69</td>"
  . "        <td>#008B45</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00FF00\"><font color=\"#000000\">Green1</font></td>"
  . "        <td>0 255 0</td>"
  . "        <td>#00FF00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00EE00\"><font color=\"#000000\">Green2</font></td>"
  . "        <td>0 238 0</td>"
  . "        <td>#00EE00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00CD00\"><font color=\"#000000\">Green3</font></td>"
  . "        <td>0 205 0</td>"
  . "        <td>#00CD00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#008B00\"><font color=\"#ffffff\">Green4</font></td>"
  . "        <td>0 139 0</td>"
  . "        <td>#008B00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#006400\"><font color=\"#ffffff\">DarkGreen</font></td>"
  . "        <td>0 100 0</td>"
  . "        <td>#006400</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#3CB371\"><font color=\"#ffffff\">MediumSeaGreen</font></td>"
  . "        <td>60 179 113</td>"
  . "        <td>#3CB371</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#20B2AA\"><font color=\"#ffffff\">LightSeaGreen</font></td>"
  . "        <td>32 178 170</td>"
  . "        <td>#20B2AA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#90EE90\"><font color=\"#000000\">LightGreen</font></td>"
  . "        <td>144 238 144</td>"
  . "        <td>#90EE90</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7CFC00\"><font color=\"#000000\">LawnGreen</font></td>"
  . "        <td>124 252 0</td>"
  . "        <td>#7CFC00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00FA9A\"><font color=\"#000000\">MediumSpringGreen</font></td>"
  . "        <td>0 250 154</td>"
  . "        <td>#00FA9A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ADFF2F\"><font color=\"#000000\">GreenYellow</font></td>"
  . "        <td>173 255 47</td>"
  . "        <td>#ADFF2F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#32CD32\"><font color=\"#000000\">Lime</font></td>"
  . "        <td>50 205 50</td>"
  . "        <td>#32CD32</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9ACD32\"><font color=\"#000000\">YellowGreen</font></td>"
  . "        <td>154 205 50</td>"
  . "        <td>#9ACD32</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#228B22\"><font color=\"#ffffff\">ForestGreen</font></td>"
  . "        <td>34 139 34</td>"
  . "        <td>#228B22</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7FFF00\"><font color=\"#000000\">Chartreuse1</font></td>"
  . "        <td>127 255 0</td>"
  . "        <td>#7FFF00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#76EE00\"><font color=\"#000000\">Chartreuse2</font></td>"
  . "        <td>118 238 0</td>"
  . "        <td>#76EE00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66CD00\"><font color=\"#000000\">Chartreuse3</font></td>"
  . "        <td>102 205 0</td>"
  . "        <td>#66CD00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#458B00\"><font color=\"#ffffff\">Chartreuse4</font></td>"
  . "        <td>69 139 0</td>"
  . "        <td>#458B00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6B8E23\"><font color=\"#ffffff\">OliveDrab</font></td>"
  . "        <td>107 142 35</td>"
  . "        <td>#6B8E23</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C0FF3E\"><font color=\"#000000\">OliveDrab1</font></td>"
  . "        <td>192 255 62</td>"
  . "        <td>#C0FF3E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B3EE3A\"><font color=\"#000000\">OliveDrab2</font></td>"
  . "        <td>179 238 58</td>"
  . "        <td>#B3EE3A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9ACD32\"><font color=\"#000000\">OliveDrab3</font></td>"
  . "        <td>154 205 50</td>"
  . "        <td>#9ACD32</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#698B22\"><font color=\"#ffffff\">OliveDrab4</font></td>"
  . "        <td>105 139 34</td>"
  . "        <td>#698B22</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#556B2F\"><font color=\"#ffffff\">DarkOliveGreen</font></td>"
  . "        <td>85 107 47</td>"
  . "        <td>#556B2F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CAFF70\"><font color=\"#000000\">DarkOliveGreen1</font></td>"
  . "        <td>202 255 112</td>"
  . "        <td>#CAFF70</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BCEE68\"><font color=\"#000000\">DarkOliveGreen2</font></td>"
  . "        <td>188 238 104</td>"
  . "        <td>#BCEE68</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A2CD5A\"><font color=\"#000000\">DarkOliveGreen3</font></td>"
  . "        <td>162 205 90</td>"
  . "        <td>#A2CD5A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#6E8B3D\"><font color=\"#ffffff\">DarkOliveGreen4</font></td>"
  . "        <td>110 139 61</td>"
  . "        <td>#6E8B3D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFF68F\"><font color=\"#000000\">Khaki1</font></td>"
  . "        <td>255 246 143</td>"
  . "        <td>#FFF68F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEE685\"><font color=\"#000000\">Khaki2</font></td>"
  . "        <td>238 230 133</td>"
  . "        <td>#EEE685</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDC673\"><font color=\"#000000\">Khaki3</font></td>"
  . "        <td>205 198 115</td>"
  . "        <td>#CDC673</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B864E\"><font color=\"#ffffff\">Khaki4</font></td>"
  . "        <td>139 134 78</td>"
  . "        <td>#8B864E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BDB76B\"><font color=\"#ffffff\">DarkKhaki</font></td>"
  . "        <td>189 183 107</td>"
  . "        <td>#BDB76B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEDD82\"><font color=\"#000000\">LightGoldenrod</font></td>"
  . "        <td>238 221 130</td>"
  . "        <td>#EEDD82</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFEC8B\"><font color=\"#000000\">LightGoldenrod1</font></td>"
  . "        <td>255 236 139</td>"
  . "        <td>#FFEC8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEDC82\"><font color=\"#000000\">LightGoldenrod2</font></td>"
  . "        <td>238 220 130</td>"
  . "        <td>#EEDC82</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDBE70\"><font color=\"#000000\">LightGoldenrod3</font></td>"
  . "        <td>205 190 112</td>"
  . "        <td>#CDBE70</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B814C\"><font color=\"#ffffff\">LightGoldenrod4</font></td>"
  . "        <td>139 129 76</td>"
  . "        <td>#8B814C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFFE0\"><font color=\"#000000\">LightYellow1</font></td>"
  . "        <td>255 255 224</td>"
  . "        <td>#FFFFE0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEEED1\"><font color=\"#000000\">LightYellow2</font></td>"
  . "        <td>238 238 209</td>"
  . "        <td>#EEEED1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDCDB4\"><font color=\"#000000\">LightYellow3</font></td>"
  . "        <td>205 205 180</td>"
  . "        <td>#CDCDB4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8B7A\"><font color=\"#ffffff\">LightYellow4</font></td>"
  . "        <td>139 139 122</td>"
  . "        <td>#8B8B7A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFFF00\"><font color=\"#000000\">Yellow1</font></td>"
  . "        <td>255 255 0</td>"
  . "        <td>#FFFF00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEEE00\"><font color=\"#000000\">Yellow2</font></td>"
  . "        <td>238 238 0</td>"
  . "        <td>#EEEE00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDCD00\"><font color=\"#000000\">Yellow3</font></td>"
  . "        <td>205 205 0</td>"
  . "        <td>#CDCD00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B8B00\"><font color=\"#ffffff\">Yellow4</font></td>"
  . "        <td>139 139 0</td>"
  . "        <td>#8B8B00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFD700\"><font color=\"#000000\">Gold1</font></td>"
  . "        <td>255 215 0</td>"
  . "        <td>#FFD700</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEC900\"><font color=\"#000000\">Gold2</font></td>"
  . "        <td>238 201 0</td>"
  . "        <td>#EEC900</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDAD00\"><font color=\"#000000\">Gold3</font></td>"
  . "        <td>205 173 0</td>"
  . "        <td>#CDAD00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7500\"><font color=\"#ffffff\">Gold4</font></td>"
  . "        <td>139 117 0</td>"
  . "        <td>#8B7500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DAA520\"><font color=\"#ffffff\">Goldenrod</font></td>"
  . "        <td>218 165 32</td>"
  . "        <td>#DAA520</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFC125\"><font color=\"#ffffff\">Goldenrod1</font></td>"
  . "        <td>255 193 37</td>"
  . "        <td>#FFC125</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEB422\"><font color=\"#ffffff\">Goldenrod2</font></td>"
  . "        <td>238 180 34</td>"
  . "        <td>#EEB422</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD9B1D\"><font color=\"#ffffff\">Goldenrod3</font></td>"
  . "        <td>205 155 29</td>"
  . "        <td>#CD9B1D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B6914\"><font color=\"#ffffff\">Goldenrod4</font></td>"
  . "        <td>139 105 20</td>"
  . "        <td>#8B6914</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B8860B\"><font color=\"#ffffff\">DarkGoldenrod</font></td>"
  . "        <td>184 134 11</td>"
  . "        <td>#B8860B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFB90F\"><font color=\"#ffffff\">DarkGoldenrod1</font></td>"
  . "        <td>255 185 15</td>"
  . "        <td>#FFB90F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEAD0E\"><font color=\"#ffffff\">DarkGoldenrod2</font></td>"
  . "        <td>238 173 14</td>"
  . "        <td>#EEAD0E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD950C\"><font color=\"#ffffff\">DarkGoldenrod3</font></td>"
  . "        <td>205 149 12</td>"
  . "        <td>#CD950C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B658B\"><font color=\"#ffffff\">DarkGoldenrod4</font></td>"
  . "        <td>139 101 8</td>"
  . "        <td>#8B658B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BC8F8F\"><font color=\"#ffffff\">RosyBrown</font></td>"
  . "        <td>188 143 143</td>"
  . "        <td>#BC8F8F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFC1C1\"><font color=\"#ffffff\">RosyBrown1</font></td>"
  . "        <td>255 193 193</td>"
  . "        <td>#FFC1C1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEB4B4\"><font color=\"#ffffff\">RosyBrown2</font></td>"
  . "        <td>238 180 180</td>"
  . "        <td>#EEB4B4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD9B9B\"><font color=\"#ffffff\">RosyBrown3</font></td>"
  . "        <td>205 155 155</td>"
  . "        <td>#CD9B9B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B6969\"><font color=\"#ffffff\">RosyBrown4</font></td>"
  . "        <td>139 105 105</td>"
  . "        <td>#8B6969</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD5C5C\"><font color=\"#ffffff\">IndianRed</font></td>"
  . "        <td>205 92 92</td>"
  . "        <td>#CD5C5C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF6A6A\"><font color=\"#ffffff\">IndianRed1</font></td>"
  . "        <td>255 106 106</td>"
  . "        <td>#FF6A6A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE6363\"><font color=\"#ffffff\">IndianRed2</font></td>"
  . "        <td>238 99 99</td>"
  . "        <td>#EE6363</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD5555\"><font color=\"#ffffff\">IndianRed3</font></td>"
  . "        <td>205 85 85</td>"
  . "        <td>#CD5555</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B3A3A\"><font color=\"#ffffff\">IndianRed4</font></td>"
  . "        <td>139 58 58</td>"
  . "        <td>#8B3A3A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF8247\"><font color=\"#ffffff\">Sienna1</font></td>"
  . "        <td>255 130 71</td>"
  . "        <td>#FF8247</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE7942\"><font color=\"#ffffff\">Sienna2</font></td>"
  . "        <td>238 121 66</td>"
  . "        <td>#EE7942</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD6839\"><font color=\"#ffffff\">Sienna3</font></td>"
  . "        <td>205 104 57</td>"
  . "        <td>#CD6839</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4726\"><font color=\"#ffffff\">Sienna4</font></td>"
  . "        <td>139 71 38</td>"
  . "        <td>#8B4726</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DEB887\"><font color=\"#000000\">Burlywood</font></td>"
  . "        <td>222 184 135</td>"
  . "        <td>#DEB887</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFD39B\"><font color=\"#000000\">Burlywood1</font></td>"
  . "        <td>255 211 155</td>"
  . "        <td>#FFD39B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEC591\"><font color=\"#000000\">Burlywood2</font></td>"
  . "        <td>238 197 145</td>"
  . "        <td>#EEC591</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDAA7D\"><font color=\"#000000\">Burlywood3</font></td>"
  . "        <td>205 170 125</td>"
  . "        <td>#CDAA7D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7355\"><font color=\"#ffffff\">Burlywood4</font></td>"
  . "        <td>139 115 85</td>"
  . "        <td>#8B7355</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F5DEB3\"><font color=\"#000000\">Wheat</font></td>"
  . "        <td>245 222 179</td>"
  . "        <td>#F5DEB3</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFE7BA\"><font color=\"#000000\">Wheat1</font></td>"
  . "        <td>255 231 186</td>"
  . "        <td>#FFE7BA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EED8AE\"><font color=\"#000000\">Wheat2</font></td>"
  . "        <td>238 216 174</td>"
  . "        <td>#EED8AE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDBA96\"><font color=\"#000000\">Wheat3</font></td>"
  . "        <td>205 186 150</td>"
  . "        <td>#CDBA96</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7E66\"><font color=\"#ffffff\">Wheat4</font></td>"
  . "        <td>139 126 102</td>"
  . "        <td>#8B7E66</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D2B48C\"><font color=\"#000000\">Tan</font></td>"
  . "        <td>210 180 140</td>"
  . "        <td>#D2B48C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFA54F\"><font color=\"#ffffff\">Tan1</font></td>"
  . "        <td>255 165 79</td>"
  . "        <td>#FFA54F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE9A49\"><font color=\"#ffffff\">Tan2</font></td>"
  . "        <td>238 154 73</td>"
  . "        <td>#EE9A49</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD853F\"><font color=\"#ffffff\">Tan3</font></td>"
  . "        <td>205 133 63</td>"
  . "        <td>#CD853F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B5A2B\"><font color=\"#ffffff\">Tan4</font></td>"
  . "        <td>139 90 43</td>"
  . "        <td>#8B5A2B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D2691E\"><font color=\"#ffffff\">Chocolate</font></td>"
  . "        <td>210 105 30</td>"
  . "        <td>#D2691E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF7F24\"><font color=\"#ffffff\">Chocolate1</font></td>"
  . "        <td>255 127 36</td>"
  . "        <td>#FF7F24</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE7621\"><font color=\"#ffffff\">Chocolate2</font></td>"
  . "        <td>238 118 33</td>"
  . "        <td>#EE7621</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD661D\"><font color=\"#ffffff\">Chocolate3</font></td>"
  . "        <td>205 102 29</td>"
  . "        <td>#CD661D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4513\"><font color=\"#ffffff\">Chocolate4</font></td>"
  . "        <td>139 69 19</td>"
  . "        <td>#8B4513</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B22222\"><font color=\"#ffffff\">Firebrick</font></td>"
  . "        <td>178 34 34</td>"
  . "        <td>#B22222</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF3030\"><font color=\"#ffffff\">Firebrick1</font></td>"
  . "        <td>255 48 48</td>"
  . "        <td>#FF3030</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE2C2C\"><font color=\"#ffffff\">Firebrick2</font></td>"
  . "        <td>238 44 44</td>"
  . "        <td>#EE2C2C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD2626\"><font color=\"#ffffff\">Firebrick3</font></td>"
  . "        <td>205 38 38</td>"
  . "        <td>#CD2626</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B1A1A\"><font color=\"#ffffff\">Firebrick4</font></td>"
  . "        <td>139 26 26</td>"
  . "        <td>#8B1A1A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A52A2A\"><font color=\"#ffffff\">Brown</font></td>"
  . "        <td>165 42 42</td>"
  . "        <td>#A52A2A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF4040\"><font color=\"#ffffff\">Brown1</font></td>"
  . "        <td>255 64 64</td>"
  . "        <td>#FF4040</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE3B3B\"><font color=\"#ffffff\">Brown2</font></td>"
  . "        <td>238 59 59</td>"
  . "        <td>#EE3B3B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD3333\"><font color=\"#ffffff\">Brown3</font></td>"
  . "        <td>205 51 51</td>"
  . "        <td>#CD3333</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B2323\"><font color=\"#ffffff\">Brown4</font></td>"
  . "        <td>139 35 35</td>"
  . "        <td>#8B2323</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FA8072\"><font color=\"#ffffff\">Salmon</font></td>"
  . "        <td>250 128 114</td>"
  . "        <td>#FA8072</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF8C69\"><font color=\"#ffffff\">Salmon1</font></td>"
  . "        <td>255 140 105</td>"
  . "        <td>#FF8C69</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE8262\"><font color=\"#ffffff\">Salmon2</font></td>"
  . "        <td>238 130 98</td>"
  . "        <td>#EE8262</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD7054\"><font color=\"#ffffff\">Salmon3</font></td>"
  . "        <td>205 112 84</td>"
  . "        <td>#CD7054</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4C39\"><font color=\"#ffffff\">Salmon4</font></td>"
  . "        <td>139 76 57</td>"
  . "        <td>#8B4C39</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFA07A\"><font color=\"#ffffff\">LightSalmon1</font></td>"
  . "        <td>255 160 122</td>"
  . "        <td>#FFA07A</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE9572\"><font color=\"#ffffff\">LightSalmon2</font></td>"
  . "        <td>238 149 114</td>"
  . "        <td>#EE9572</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD8162\"><font color=\"#ffffff\">LightSalmon3</font></td>"
  . "        <td>205 129 98</td>"
  . "        <td>#CD8162</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B5742\"><font color=\"#ffffff\">LightSalmon4</font></td>"
  . "        <td>139 87 66</td>"
  . "        <td>#8B5742</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFA500\"><font color=\"#ffffff\">Orange1</font></td>"
  . "        <td>255 165 0</td>"
  . "        <td>#FFA500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE9A00\"><font color=\"#ffffff\">Orange2</font></td>"
  . "        <td>238 154 0</td>"
  . "        <td>#EE9A00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD8500\"><font color=\"#ffffff\">Orange3</font></td>"
  . "        <td>205 133 0</td>"
  . "        <td>#CD8500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B5A00\"><font color=\"#ffffff\">Orange4</font></td>"
  . "        <td>139 90 0</td>"
  . "        <td>#8B5A00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF8C00\"><font color=\"#ffffff\">DarkOrange</font></td>"
  . "        <td>255 140 0</td>"
  . "        <td>#FF8C00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF7F00\"><font color=\"#ffffff\">DarkOrange1</font></td>"
  . "        <td>255 127 0</td>"
  . "        <td>#FF7F00</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE7600\"><font color=\"#ffffff\">DarkOrange2</font></td>"
  . "        <td>238 118 0</td>"
  . "        <td>#EE7600</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD6600\"><font color=\"#ffffff\">DarkOrange3</font></td>"
  . "        <td>205 102 0</td>"
  . "        <td>#CD6600</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4500\"><font color=\"#ffffff\">DarkOrange4</font></td>"
  . "        <td>139 69 0</td>"
  . "        <td>#8B4500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#F08080\"><font color=\"#ffffff\">LightCoral</font></td>"
  . "        <td>240 128 128</td>"
  . "        <td>#F08080</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF7F50\"><font color=\"#ffffff\">Coral</font></td>"
  . "        <td>255 127 80</td>"
  . "        <td>#FF7F50</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF7256\"><font color=\"#ffffff\">Coral1</font></td>"
  . "        <td>255 114 86</td>"
  . "        <td>#FF7256</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE6A50\"><font color=\"#ffffff\">Coral2</font></td>"
  . "        <td>238 106 80</td>"
  . "        <td>#EE6A50</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD5B45\"><font color=\"#ffffff\">Coral3</font></td>"
  . "        <td>205 91 69</td>"
  . "        <td>#CD5B45</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B3E2F\"><font color=\"#ffffff\">Coral4</font></td>"
  . "        <td>139 62 47</td>"
  . "        <td>#8B3E2F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF6347\"><font color=\"#ffffff\">Tomato1</font></td>"
  . "        <td>255 99 71</td>"
  . "        <td>#FF6347</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE5C42\"><font color=\"#ffffff\">Tomato2</font></td>"
  . "        <td>238 92 66</td>"
  . "        <td>#EE5C42</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD4F39\"><font color=\"#ffffff\">Tomato3</font></td>"
  . "        <td>205 79 57</td>"
  . "        <td>#CD4F39</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B3626\"><font color=\"#ffffff\">Tomato4</font></td>"
  . "        <td>139 54 38</td>"
  . "        <td>#8B3626</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF4500\"><font color=\"#ffffff\">OrangeRed1</font></td>"
  . "        <td>255 69 0</td>"
  . "        <td>#FF4500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE4000\"><font color=\"#ffffff\">OrangeRed2</font></td>"
  . "        <td>238 64 0</td>"
  . "        <td>#EE4000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD3700\"><font color=\"#ffffff\">OrangeRed3</font></td>"
  . "        <td>205 55 0</td>"
  . "        <td>#CD3700</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B2500\"><font color=\"#ffffff\">OrangeRed4</font></td>"
  . "        <td>139 37 0</td>"
  . "        <td>#8B2500</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF0000\"><font color=\"#ffffff\">Red1</font></td>"
  . "        <td>255 0 0</td>"
  . "        <td>#FF0000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE0000\"><font color=\"#ffffff\">Red2</font></td>"
  . "        <td>238 0 0</td>"
  . "        <td>#EE0000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD0000\"><font color=\"#ffffff\">Red3</font></td>"
  . "        <td>205 0 0</td>"
  . "        <td>#CD0000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B0000\"><font color=\"#ffffff\">DarkRed</font></td>"
  . "        <td>139 0 0</td>"
  . "        <td>#8B0000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C60000\"><font color=\"#ffffff\">Rouge</font></td>"
  . "        <td>198 0 0</td>"
  . "        <td>#C60000</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DC143C\"><font color=\"#ffffff\">Crimson</font></td>"
  . "        <td>220 20 60</td>"
  . "        <td>#DC143C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF1493\"><font color=\"#ffffff\">DeepPink1</font></td>"
  . "        <td>255 20 147</td>"
  . "        <td>#FF1493</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE1289\"><font color=\"#ffffff\">DeepPink2</font></td>"
  . "        <td>238 18 137</td>"
  . "        <td>#EE1289</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD1076\"><font color=\"#ffffff\">DeepPink3</font></td>"
  . "        <td>205 16 118</td>"
  . "        <td>#CD1076</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B0A50\"><font color=\"#ffffff\">DeepPink4</font></td>"
  . "        <td>139 10 80</td>"
  . "        <td>#8B0A50</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF69B4\"><font color=\"#ffffff\">HotPink</font></td>"
  . "        <td>255 105 180</td>"
  . "        <td>#FF69B4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF6EB4\"><font color=\"#ffffff\">HotPink1</font></td>"
  . "        <td>255 110 180</td>"
  . "        <td>#FF6EB4</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE6AA7\"><font color=\"#ffffff\">HotPink2</font></td>"
  . "        <td>238 106 167</td>"
  . "        <td>#EE6AA7</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD6090\"><font color=\"#ffffff\">HotPink3</font></td>"
  . "        <td>205 96 144</td>"
  . "        <td>#CD6090</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B3A62\"><font color=\"#ffffff\">HotPink4</font></td>"
  . "        <td>139 58 98</td>"
  . "        <td>#8B3A62</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFC0CB\"><font color=\"#ffffff\">Pink</font></td>"
  . "        <td>255 192 203</td>"
  . "        <td>#FFC0CB</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFB5C5\"><font color=\"#ffffff\">Pink1</font></td>"
  . "        <td>255 181 197</td>"
  . "        <td>#FFB5C5</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEA9B8\"><font color=\"#ffffff\">Pink2</font></td>"
  . "        <td>238 169 184</td>"
  . "        <td>#EEA9B8</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD919E\"><font color=\"#ffffff\">Pink3</font></td>"
  . "        <td>205 145 158</td>"
  . "        <td>#CD919E</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B636C\"><font color=\"#ffffff\">Pink4</font></td>"
  . "        <td>139 99 108</td>"
  . "        <td>#8B636C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFB6C1\"><font color=\"#ffffff\">LightPink</font></td>"
  . "        <td>255 182 193</td>"
  . "        <td>#FFB6C1</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFAEB9\"><font color=\"#ffffff\">LightPink1</font></td>"
  . "        <td>255 174 185</td>"
  . "        <td>#FFAEB9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEA2AD\"><font color=\"#ffffff\">LightPink2</font></td>"
  . "        <td>238 162 173</td>"
  . "        <td>#EEA2AD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD8C95\"><font color=\"#ffffff\">LightPink3</font></td>"
  . "        <td>205 140 149</td>"
  . "        <td>#CD8C95</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B5F65\"><font color=\"#ffffff\">LightPink4</font></td>"
  . "        <td>139 95 101</td>"
  . "        <td>#8B5F65</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DB7093\"><font color=\"#ffffff\">PaleVioletred</font></td>"
  . "        <td>219 112 147</td>"
  . "        <td>#DB7093</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF82AB\"><font color=\"#ffffff\">PaleVioletred1</font></td>"
  . "        <td>255 130 171</td>"
  . "        <td>#FF82AB</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE799F\"><font color=\"#ffffff\">PaleVioletred2</font></td>"
  . "        <td>238 121 159</td>"
  . "        <td>#EE799F</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD6889\"><font color=\"#ffffff\">PaleVioletred3</font></td>"
  . "        <td>205 104 137</td>"
  . "        <td>#CD6889</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B475D\"><font color=\"#ffffff\">PaleVioletred4</font></td>"
  . "        <td>139 71 93</td>"
  . "        <td>#8B475D</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B03060\"><font color=\"#ffffff\">Maroon</font></td>"
  . "        <td>176 48 96</td>"
  . "        <td>#B03060</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF34B3\"><font color=\"#ffffff\">Maroon1</font></td>"
  . "        <td>255 52 179</td>"
  . "        <td>#FF34B3</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE30A7\"><font color=\"#ffffff\">Maroon2</font></td>"
  . "        <td>238 48 167</td>"
  . "        <td>#EE30A7</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD2990\"><font color=\"#ffffff\">Maroon3</font></td>"
  . "        <td>205 41 144</td>"
  . "        <td>#CD2990</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B1C62\"><font color=\"#ffffff\">Maroon4</font></td>"
  . "        <td>139 28 98</td>"
  . "        <td>#8B1C62</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D02090\"><font color=\"#ffffff\">Violetred</font></td>"
  . "        <td>208 32 144</td>"
  . "        <td>#D02090</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF3E96\"><font color=\"#ffffff\">Violetred1</font></td>"
  . "        <td>255 62 150</td>"
  . "        <td>#FF3E96</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE3A8C\"><font color=\"#ffffff\">Violetred2</font></td>"
  . "        <td>238 58 140</td>"
  . "        <td>#EE3A8C</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD3278\"><font color=\"#ffffff\">Violetred3</font></td>"
  . "        <td>205 50 120</td>"
  . "        <td>#CD3278</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B2252\"><font color=\"#ffffff\">Violetred4</font></td>"
  . "        <td>139 34 82</td>"
  . "        <td>#8B2252</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF00FF\"><font color=\"#ffffff\">Magenta1</font></td>"
  . "        <td>255 0 255</td>"
  . "        <td>#FF00FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE00EE\"><font color=\"#ffffff\">Magenta2</font></td>"
  . "        <td>238 0 238</td>"
  . "        <td>#EE00EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD00CD\"><font color=\"#ffffff\">Magenta3</font></td>"
  . "        <td>205 0 205</td>"
  . "        <td>#CD00CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B008B\"><font color=\"#ffffff\">DarkMagenta</font></td>"
  . "        <td>139 0 139</td>"
  . "        <td>#8B008B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DA70D6\"><font color=\"#ffffff\">Orchid</font></td>"
  . "        <td>218 112 214</td>"
  . "        <td>#DA70D6</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FF83FA\"><font color=\"#ffffff\">Orchid1</font></td>"
  . "        <td>255 131 250</td>"
  . "        <td>#FF83FA</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE7AE9\"><font color=\"#ffffff\">Orchid2</font></td>"
  . "        <td>238 122 233</td>"
  . "        <td>#EE7AE9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD69C9\"><font color=\"#ffffff\">Orchid3</font></td>"
  . "        <td>205 105 201</td>"
  . "        <td>#CD69C9</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B4789\"><font color=\"#ffffff\">Orchid4</font></td>"
  . "        <td>139 71 137</td>"
  . "        <td>#8B4789</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DDA0DD\"><font color=\"#ffffff\">Plum</font></td>"
  . "        <td>221 160 221</td>"
  . "        <td>#DDA0DD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFBBFF\"><font color=\"#ffffff\">Plum1</font></td>"
  . "        <td>255 187 255</td>"
  . "        <td>#FFBBFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EEAEEE\"<font color=\"#ffffff\">Plum2</font></td>"
  . "        <td>238 174 238</td>"
  . "        <td>#EEAEEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CD96CD\"><font color=\"#ffffff\">Plum3</font></td>"
  . "        <td>205 150 205</td>"
  . "        <td>#CD96CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B668B\"><font color=\"#ffffff\">Plum4</font></td>"
  . "        <td>139 102 139</td>"
  . "        <td>#8B668B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BA55D3\"><font color=\"#ffffff\">MediumOrchid</font></td>"
  . "        <td>186 85 211</td>"
  . "        <td>#BA55D3</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#E066FF\"><font color=\"#ffffff\">MediumOrchid1</font></td>"
  . "        <td>224 102 255</td>"
  . "        <td>#E066FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D15FEE\"><font color=\"#ffffff\">MediumOrchid2</font></td>"
  . "        <td>209 95 238</td>"
  . "        <td>#D15FEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B452CD\"><font color=\"#ffffff\">MediumOrchid3</font></td>"
  . "        <td>180 82 205</td>"
  . "        <td>#B452CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7A378B\"><font color=\"#ffffff\">MediumOrchid4</font></td>"
  . "        <td>122 55 139</td>"
  . "        <td>#7A378B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9932CC\"><font color=\"#ffffff\">DarkOrchid</font></td>"
  . "        <td>153 50 204</td>"
  . "        <td>#9932CC</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#BF3EFF\"><font color=\"#ffffff\">DarkOrchid1</font></td>"
  . "        <td>191 62 255</td>"
  . "        <td>#BF3EFF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#B23AEE\"><font color=\"#ffffff\">DarkOrchid2</font></td>"
  . "        <td>178 58 238</td>"
  . "        <td>#B23AEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9A32CD\"><font color=\"#ffffff\">DarkOrchid3</font></td>"
  . "        <td>154 50 205</td>"
  . "        <td>#9A32CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#68228B\"><font color=\"#ffffff\">DarkOrchid4</font></td>"
  . "        <td>104 34 139</td>"
  . "        <td>#68228B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C71585\"><font color=\"#ffffff\">MediumVioletred</font></td>"
  . "        <td>199 21 133</td>"
  . "        <td>#C71585</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EE82EE\"><font color=\"#ffffff\">Violet</font></td>"
  . "        <td>238 130 238</td>"
  . "        <td>#EE82EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9400D3\"><font color=\"#ffffff\">DarkViolet</font></td>"
  . "        <td>148 0 211</td>"
  . "        <td>#9400D3</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8A2BE2\"><font color=\"#ffffff\">BlueViolet</font></td>"
  . "        <td>138 43 226</td>"
  . "        <td>#8A2BE2</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#800080\"><font color=\"#ffffff\">Purple</font></td>"
  . "        <td>128 0 128</td>"
  . "        <td>#800080</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#A020F0\"><font color=\"#ffffff\">Purple1</font></td>"
  . "        <td>160 32 240</td>"
  . "        <td>#A020F0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9B30FF\"><font color=\"#ffffff\">Purple2</font></td>"
  . "        <td>155 48 255</td>"
  . "        <td>#9B30FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#912CEE\"><font color=\"#ffffff\">Purple3</font></td>"
  . "        <td>145 44 238</td>"
  . "        <td>#912CEE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#7D26CD\"><font color=\"#ffffff\">Purple4</font></td>"
  . "        <td>125 38 205</td>"
  . "        <td>#7D26CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#551A8B\"><font color=\"#ffffff\">Purple5</font></td>"
  . "        <td>85 26 139</td>"
  . "        <td>#551A8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9370DB\"><font color=\"#ffffff\">MediumPurple</font></td>"
  . "        <td>147 112 219</td>"
  . "        <td>#9370DB</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#AB82FF\"><font color=\"#ffffff\">MediumPurple1</font></td>"
  . "        <td>171 130 255</td>"
  . "        <td>#AB82FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#9F79EE\"><font color=\"#ffffff\">MediumPurple2</font></td>"
  . "        <td>159 121 238</td>"
  . "        <td>#9F79EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8968CD\"><font color=\"#ffffff\">MediumPurple3</font></td>"
  . "        <td>137 104 205</td>"
  . "        <td>#8968CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#5D478B\"><font color=\"#ffffff\">MediumPurple4</font></td>"
  . "        <td>93 71 139</td>"
  . "        <td>#5D478B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#D8BFD8\"><font color=\"#000000\">Thistle</font></td>"
  . "        <td>216 191 216</td>"
  . "        <td>#D8BFD8</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFE1FF\"><font color=\"#000000\">Thistle1</font></td>"
  . "        <td>255 225 255</td>"
  . "        <td>#FFE1FF</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#EED2EE\"><font color=\"#000000\">Thistle2</font></td>"
  . "        <td>238 210 238</td>"
  . "        <td>#EED2EE</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#CDB5CD\"><font color=\"#000000\">Thistle3</font></td>"
  . "        <td>205 181 205</td>"
  . "        <td>#CDB5CD</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#8B7B8B\"><font color=\"#ffffff\">Thistle4</font></td>"
  . "        <td>139 123 139</td>"
  . "        <td>#8B7B8B</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#DDC488\"><font color=\"#000000\">AntiqueGold</font></td>"
  . "        <td>221 196 136</td>"
  . "        <td>#DDC488</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ECAB53\"><font color=\"#ffffff\">AgedPaper</font></td>"
  . "        <td>236 171 83</td>"
  . "        <td>#ECAB53</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#C0C0C0\"><font color=\"#000000\">Silver</font></td>"
  . "        <td>192 192 192</td>"
  . "        <td>#C0C0C0</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#008080\"><font color=\"#ffffff\">Teal</font></td>"
  . "        <td>0 128 128</td>"
  . "        <td>#008080</td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#FFCC99\"><font color=\"#000000\">Blush</font></td>"
  . "        <td>255 204 153</td>"
  . "        <td>#FFCC99</td></tr></table><br /><br />"
  ."<center>Hex Colors v2&nbsp;by&nbsp;<a href=\"http://www.lenon.com\">VinDSL</a>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}


function MTags() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/DisMTags.js");
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <center><br /><h4>"._METAC."</h4><br />"
  . "    <table class=normal  width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"
  . "  <tr>"
  . "    <td><center><font face=\"verdana\" size=\"4\"></font></center>"
  . "    <form>"
  . "      <div align=\"center\"><center><table class=normal  border=\"0\" cellpadding=\"2\">"
  . "        <tr>"
  . "          <td>"._MTIT."</td>"
  . "          <td><input type=\"text\" name=\"input1\" size=\"30\"></td>"
  . "        </tr>"
  . "        <!-- The author META tag defines the name of the author of the document being read. -->"
  . "        <tr>"
  . "          <td>"._AUTHOR."</td>"
  . "          <td><input type=\"text\" name=\"input2\" size=\"30\"></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td>"._SUBJ."</td>"
  . "          <td><input type=\"text\" name=\"input3\" size=\"30\"></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td>"._DESCRR."</td>"
  . "          <td><input type=\"text\" name=\"input4\" size=\"30\"></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td>"._KEYW."</td>"
  . "          <td><input type=\"text\" name=\"input5\" size=\"30\"></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td>"._GENER."</td>"
  . "          <td><input type=\"text\" name=\"input6\" size=\"30\"></td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td>"._LANGUA."</td>"
  . "          <td><input type=\"text\" name=\"input7\" size=\"30\"></td>"
  . "        </tr>"
  . "        <!-- The expires META tag defines the expiration date and time of the document being"
  . "        indexed and requires RFC1123 date format, for example: Thu, 04 Oct 2010 14:21:20 GMT -->"
  . "        <tr>"
  . "          <td>"._EXPR."</td>"
  . "          <td><input type=\"text\" name=\"input8\" size=\"30\"></td>"
  . "        </tr>"
  . "        <!-- The abstract META tag is a one line sentence which gives an overview of the entire webpage -->"
  . "        <tr>"
  . "          <td>"._ABSTRA."</td>"
  . "          <td><input type=\"text\" name=\"input9\" size=\"30\"></td>"
  . "        </tr>"
  . "       <!-- Copyright: no need to add �, it will be added automatically -->"
  . "        <tr>"
  . "          <td>"._COPYRIGHTT."</td>"
  . "          <td><input type=\"text\" name=\"input10\" size=\"30\"></td>"
  . "        </tr>"
  . "       <!-- Designer = Webmaster -->"
  . "        <tr>"
  . "          <td>"._DESIGN."</td>"
  . "          <td><input type=\"text\" name=\"input11\" size=\"30\"></td>"
  . "        </tr>"
  . "       <!-- Publisher: Company that publishes material being read or sold on a web site -->"
  . "        <tr>"
  . "          <td>"._PUBLIS."</td>"
  . "          <td><input type=\"text\" name=\"input12\" size=\"30\"></td>"
  . "        </tr>"
  . "        <!-- The Revisit META tag defines how often a search engine or spider should"
  . "        come to your website for re-indexing. For example: 2 Days, 3 Days, 4 Days, etc."
  . "        Note: Just ad number(s), word Days will be added automatically -->"
  . "        <tr>"
  . "          <td>"._RA."</td>"
  . "          <td><input type=\"text\" name=\"input13\" size=\"30\"></td>"
  . "        </tr>"
  . "        <!-- Distribution: Global (indicates that your webpage is intended for"
  . "        mass distribution to everyone), Local (intended for local distribution"
  . "        of your document), and IU - Internal Use (not intended for public distribution). -->"
  . "        <tr>"
  . "          <td>"._DISTR."</td>"
  . "          <td><select name=\"input14\" size=\"1\">"
  . "             <option value=\"\" SELECTED>"._SELE."</option>"
  . "            <option value=\"Global\">"._GLOBAL."</option>"
  . "            <option value=\"Local\">"._LOCAL."</option>"
  . "            <option value=\"IU\">"._IU."</option>"
  . "          </select></td>"
  . "        <tr>"
  . "          <td>"._ROBOTS."</td>"
  . "          <td><select name=\"input15\" size=\"1\">"
  . "            <option value=\"\" SELECTED>"._SELE."</option>"
  . "            <option value=\"All\">"._ALL."</option>"
  . "            <option value=\"None\">"._NONEE."</option>"
  . "            <option value=\"Index\">"._IND."</option>"
  . "            <option value=\"No Index\">"._NIND."</option>"
  . "            <option value=\"Follow\">"._FOL."</option>"
  . "            <option value=\"No Follow\">"._NFOL."</option>"
  . "          </select></td>"
  . "        </tr>"
  . "        </tr>"
  . "      </table>"
  . "      </center></div><blockquote><center>"
  . "        <p><input type=\"button\" value=\""._CREATMT."\" ONCLICK=\"create(this.form)\"> <input"
  . "        type=\"reset\" value=\""._CLEARALL."\"><br /><br />"._INAST."<br />"._SIML."<br /><br /><textarea WRAP name=\"story\" rows=\"12\" cols=\"65\"></textarea></center>"
  . "        </p>"
  . "      </blockquote>"
  . "    </form>"
  . "    </td>"
  . "  </tr>"
  . "</table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function HelpModule() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo "<center><br /><br /><h4>"._HELP."</h4><br /><h5>"._MODULEC."</h5>"
  . "<br />&nbsp;&nbsp;[&nbsp;&nbsp;".  "<a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Module\">Back to Module ".  "Creator</a>&nbsp;&nbsp;]&nbsp;&nbsp"
  . "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">"
  . "                              <tr>"
  . "                                <td colspan=\"2\"><br /><br />Let's "
  . "                                assume that we have this html <br />"
  . "                                &nbsp;</font><table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "                                    &lt;html&gt; <br />"
  . "                                    &lt;head&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-Language&quot; "
  . "                                    content=&quot;en-us&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;GENERATOR&quot; content=&quot;Microsoft "
  . "                                    FrontPage 5.0&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;ProgId&quot; "
  . "                                    content=&quot;FrontPage.Editor.Document&quot;&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-type&quot; "
  . "                                    content=&quot;text/html; charset=windows-1252&quot;&gt;"
  . "                                    <br />"
  . "                                    &lt;title&gt;New Page 1&lt;/title&gt; <br />"
  . "                                    &lt;/head&gt; <br />"
  . "                                    &lt;body&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;font size=&quot;7&quot;&gt;PHP-Nuke "
  . "                                    tools&lt;/font&gt;&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;by&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;a "
  . "                                    href=&quot;http://www.disipal.net/&quot;&gt;&lt;font "
  . "                                    size=&quot;7&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt; <br />"
  . "                                    &lt;/body&gt; <br />"
  . "                                    &lt;/html&gt; <br />"
  . "                                    <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>Remove this</font></p>"
  . "                                <table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "<p>&lt;html&gt; <br />"
  . "                                    &lt;head&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-Language&quot; "
  . "                                    content=&quot;en-us&quot;&gt; <br />"
  . "                                   &lt;meta name=&quot;GENERATOR&quot; content=&quot;Microsoft "
  . "                                    FrontPage 5.0&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;ProgId&quot; "
  . "                                    content=&quot;FrontPage.Editor.Document&quot;&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-type&quot; "
  . "                                    content=&quot;text/html; charset=windows-1252&quot;&gt;"
  . "                                    <br />"
  . "                                    &lt;title&gt;New Page 1&lt;/title&gt; <br />"
  . "                                    &lt;/head&gt; <br />"
  . "                                    &lt;body&gt; </font>"
  . "                                    </p>"
  . "                                    <p>&lt;/body&gt; <br />"
  . "                                    &lt;/html&gt;"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p><br />"
  . "                                And now the code looks like this </font></p>"
  . "                                <table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;font size=&quot;7&quot;&gt;PHP-Nuke "
  . "                                    tools&lt;/font&gt;&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;by&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;a "
  . "                                    href=&quot;http://www.disipal.net/&quot;&gt;&lt;font "
  . "                                    size=&quot;7&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt; <br />"
  . "                                    <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>To make the module, we "
  . "                                copy and paste in the "
  . "                                module creator top block <br />"
  . "                                <br />"
  . "                                We click on �Create Module� and as a result we "
  . "                                have </font></p>"
  . "                                <table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    < ?php <br />"
   . "                                    /******************************************************************************/<br />
/*  Generated by Module Creator - By Disipal Designs (www.disipal.net)       */<br />
/*  PHP-Nuke Tools v4.00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/<br />
/******************************************************************************/<br />"
  . "                                    if (!defined('MODULE_FILE')) { <br />"
  . "                                    &nbsp; &nbsp;die (&quot;You can't access this file "
  . "                                    directly...&quot;); <br />"
  . "                                    <br />"
  . "                                    } <br />"
  . "                                    require_once(&quot;mainfile.php&quot;); <br />"
  . "                                    $ module_name = basename(dirname(__FILE__));"
  . "                                    <br />"
  . "                                    get_lang($ module_name); <br />"
  . "                                    include_once(&quot;header.php&quot;); <br />"
  . "                                    define('INDEX_FILE', true); <br />"
  . "                                    OpenTable(); <br />"
  . "                                    echo&quot;&lt;p align=\\&quot;center\\&quot;&gt;&lt;font "
  . "                                    size=\\&quot;7\\&quot;&gt;PHP-Nuke tools&lt;/font&gt;&lt;/p&gt;&quot; <br />"
  . "                                    &nbsp; . &quot;&lt;p align=\\&quot;center\\&quot;&gt;by&lt;/p&gt;&quot; <br />"
  . "                                    &nbsp; . &quot;&lt;p align=\\&quot;center\\&quot;&gt;&lt;a "
  . "                                    href=\\&quot;http://www.disipal.net/\\&quot;&gt;&lt;font "
  . "                                    size=\\&quot;7\\&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt;&quot;; <br />"
  . "                                    CloseTable(); <br />"
  . "                                    include_once(&quot;footer.php&quot;); <br />"
  . "                                    <br />"
  . "                                    ?&gt; <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>"
  . "                                <br />"
  . "                                Now open notepad and paste the code given in the "
  . "                                Module Creator bottom block, and save "
  . "                                it as index.php <br />"
  . "                                <br />"
  . "                                Create a folder in the modules called �whatever� "
  . "                                and inside copy index.php <br />"
  . "                                &nbsp;</font><p>"
  . "                                "
  . "                                <strong><font size=\"4\">Note : </font></strong>"
  . "                                </font><p>If "
  . "                                you are not planning on using language files "
  . "                                remove this line</font><p><table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    "
  . "                                    <br />"
  . "                                    get_lang($ module_name); <br />"
  . "                                    &nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "<p>If you are going to use language files create a folder called &quot;language&quot; in "
  . "the module folder you just made and add you language files (ex. "
  . "lang-english.php)</font><p>"
  . "                                <br />"
  . "                                And you are ready!! <br />"
  . "                                Activate the module from"
  . "                                <a href=\"http://www.yoursite.com/admin.php?op=modules\" target=\"_blank\">"
  . "                                http://www.yoursite.com/admin.php?op=modules</a>"
  . "                                <br />"
  . "&nbsp;</font></td></tr></table><br /><br /><center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Module\">Back to Module Creator</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}


function HelpBlock() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
    OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo "<center><br /><br /><h4>"._HELP."</h4><br /><h5>"._BLOCKC."</h5>"
  . "<br />&nbsp;&nbsp;[&nbsp;&nbsp;".  "<a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Block\">Back to Block ".  "Creator</a>&nbsp;&nbsp;]&nbsp;&nbsp"
  . "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">"
  . "                              <tr>"
  . "                                <td colspan=\"2\">Let's "
  . "                                assume that we have this html <br />"
  . "                                &nbsp;</font><table cellspacing=\"1\" cellpadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "                                    &lt;html&gt; <br />"
  . "                                    &lt;head&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-Language&quot; "
  . "                                    content=&quot;en-us&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;GENERATOR&quot; content=&quot;Microsoft "
  . "                                    FrontPage 5.0&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;ProgId&quot; "
  . "                                    content=&quot;FrontPage.Editor.Document&quot;&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-type&quot; "
  . "                                    content=&quot;text/html; charset=windows-1252&quot;&gt;"
  . "                                    <br />"
  . "                                    &lt;title&gt;New Page 1&lt;/title&gt; <br />"
  . "                                    &lt;/head&gt; <br />"
  . "                                    &lt;body&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;font size=&quot;7&quot;&gt;PHP-Nuke "
  . "                                    tools&lt;/font&gt;&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;by&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;a "
  . "                                    href=&quot;http://www.disipal.net/&quot;&gt;&lt;font "
  . "                                    size=&quot;7&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt; <br />"
  . "                                    &lt;/body&gt; <br />"
  . "                                    &lt;/html&gt; <br />"
  . "                                    <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>Remove this</font></p>"
  . "                                <table cellSpacing=\"1\" cellPadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    &nbsp;<br />&lt;html&gt; <br />"
  . "                                    &lt;head&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-Language&quot; "
  . "                                    content=&quot;en-us&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;GENERATOR&quot; content=&quot;Microsoft "
  . "                                    FrontPage 5.0&quot;&gt; <br />"
  . "                                    &lt;meta name=&quot;ProgId&quot; "
  . "                                    content=&quot;FrontPage.Editor.Document&quot;&gt; <br />"
  . "                                    &lt;meta http-equiv=&quot;Content-type&quot; "
  . "                                    content=&quot;text/html; charset=windows-1252&quot;&gt;"
  . "                                    <br />"
  . "                                    &lt;title&gt;New Page 1&lt;/title&gt; <br />"
  . "                                    &lt;/head&gt; <br />"
  . "                                    &lt;body&gt; </font>"
  . "                                    </p>"
  . "                                    <p>&lt;/body&gt; <br />"
  . "                                    &lt;/html&gt;<p> <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p><br />"
  . "                                And now the code looks like this </font></p>"
  . "                                <table cellspacing=\"1\" cellpadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;font size=&quot;7&quot;&gt;PHP-Nuke "
  . "                                    tools&lt;/font&gt;&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;by&lt;/p&gt; <br />"
  . "                                    &lt;p align=&quot;center&quot;&gt;&lt;a "
  . "                                    href=&quot;http://www.disipal.net/&quot;&gt;&lt;font "
  . "                                    size=&quot;7&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt; <br />"
  . "                                    <br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>To make the block, we "
  . "                                copy and paste in the "
  . "                                Block Creator top block <br />"
  . "                                <br />"
  . "                                We click on �Create Block� and as a result we "
  . "                                have </font></p>"
  . "                                <table cellspacing=\"1\" cellpadding=\"3\" width=\"90%\" align=\"center\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"\">"
  . "                                  <tr>"
  . "                                    <td><strong>Code:</strong></font></td>"
  . "                                  </tr>"
  . "                                  <tr>"
  . "                                    <td>"
  . "                                    <br />"
  . "                                    &lt;?php<br />"
  . "                                    /****************************************************************************/<br />
/*  Generated by Block Creator - By Disipal Designs (www.disipal.net)       */<br />
/*  PHP-Nuke Tools v4.00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*/<br />
/****************************************************************************/<br />"
  . "                                    if ( !defined('BLOCK_FILE') ) {<br />"
  . "                                        Header(\"Location: ../index.php\");<br />"
  . "                                    die();<br />"
  . "                                    }<br />"
  . "                                    $ content = &quot;&lt;p align=\\&quot;center\\&quot;&gt;&lt;font "
  . "                                    size=\\&quot;7\\&quot;&gt;PHP-Nuke tools&lt;/font&gt;&lt;/p&gt; &quot;;<br />"
  . "                                    $ content .= &quot;&lt;p align=\\&quot;center\\&quot;&gt;by&lt;/p&gt; &quot;;<br />"
  . "                                    $ content .= &quot;&lt;p align=\\&quot;center\\&quot;&gt;&lt;a "
  . "                                    href=\\&quot;http://www.disipal.net/\\&quot;&gt;&lt;font "
  . "                                    size=\\&quot;7\\&quot;&gt;Disipal Designs&lt;/font&gt;&lt;/a&gt;&lt;/p&gt; &quot;;<br />"
  . "                                    ?&gt;<br />"
  . "&nbsp;</font></td>"
  . "                                  </tr>"
  . "                                </table>"
  . "                                <p>"
  . "                                <br />"
  . "                                Now open notepad and paste the code given in the "
  . "                                Block Creator bottom block, and save it as "
  . "                                block-whatever.php<p>"
  . "                                <br />"
  . "                                And you are ready!! <br />"
  . "                                Activate the block from "
  . "                                http://www.yoursite.com/admin.php?op=blocks<br />"
  . "&nbsp;</font></table><br /><br /><center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=PHP-Nuke_Tools&file=index&func=Block\">Back to Block Creator</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function HTMLSWS() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/HTMLSWS.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table bordercolor=blue cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table bordercolor=blue cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"
  . "<center><br /><h4>"._HTMLSWS."</h4><br />"
  . "<form name=htphp>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle>"._PASTE."</td></tr></tbody></table>"
  . "<table cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<tbody><tr><td align=middle><textarea name=input rows=15 wrap=virtual cols=68></textarea> "
  . "</td></tr><tr><td align=middle>"._CONINFO."</td></tr>"
  . "<tr><td align=middle><textarea name=output rows=15 wrap=virtual cols=68></textarea> "
  . "</td></tr><tr><td align=middle><input class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<input class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<input class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</td></tr></form></center></td></tr>"
  . "<tr></tr></tbody></table></td></tr></tbody></table></center></td></tr></tbody></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function EMAIL() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/emailencoder.js");
       OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center><br /><h4>"._EMAILCODER."</h4><br />"
  . "<center>"
  . "<form name=ENCODER><B>Your e-mail Address:</B>"
  . "<P><input size=80 name=regEmail> "
  . "<P><B>Encoded e-mail "
  . "Address:</B> "
  . "<P><textarea name=codeEmail rows=7 cols=80></textarea> "
  . "<P><input onclick=encodeEmail() type=button value="._ENCODE."> <input type=reset value="._CLEAR."> </form>"
  . "This form will allow you to encode your e-mail address through the use of <i><a "
  . "title=\"Go to this site for a detailed explanation of Character Entities\" "
  . "href=\"http://www.w3.org/tr/REC-html32\" target=_blank>Character Entities</a></i>, "
  . "transforming your ascii email address into its equivalent decimal entity. Simply "
  . "<B>enter your e-mail address</strong> in the first text box, <strong>click the "
  . "encode</strong> button, and then <strong>highlight and copy the resulting code</strong> "
  . "produced in the second text box. This encoded e-mail address can be read and "
  . "translated back into its original ascii text by almost any web browser without "
  . "any further action on your part. Just replace all instances of your e-mail "
  . "address on your pages with the code, and you won't have to worry about spam "
  . "lists."
  . "<tr></tr></tbody></table></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}

function ROT() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/rot.js");
       OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center>"
  . "<td valign=top align=middle width=\"80%\" height=\"100%\">"
  . "      <h4>"._ROTCODER."</h4><br /><form "
  . "      name=form1><textarea name=text1 rows=13 cols=50 value=\"\"></textarea><br /><input onclick=\"with (document.form1.text1) {value = rot13(value);}\" type=button value="._ENCODE."> "
  . "<input onclick=\"document.form1.text1.value = '';\" type=button value="._CLEAR."> "
  . "      </form>&nbsp;Simply enter the text and press "
  . "      Encode.</td>"
  . "<tr></tr></tbody></table></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}

function URLENCODER() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/URLCODER.js");
       OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center>"
  . "<td valign=top align=middle width=\"80%\" height=\"100%\">"
  . "      <h4>"._URLCODER."</h4><br /><form name=form1 action=\"\"><B>URL</B>: <input size=50 value=http:// "
  . "      name=text1><br /><input onclick=encode(document.form1.text1.value) type=button value="._ENCODE.">&nbsp;<input onclick=decode(document.form1.text1.value) type=button value="._DECODE."> "
  . "      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onclick=document.form1.text1.focus();document.form1.text1.select() type=button value="._SELEC.">&nbsp;<input type=reset value="._CLEAR."> "
  . "        <p>Use this form to encode/decode URLs.URLs are encoded "
  . "      in order to avoid special characters causing problems in an Internet "
  . "        addresses.URLs use some characters for special use in defining their "
  . "      syntax. When these characters are not used in their special role inside a "
  . "      URL, they need to be encoded. Some characters are known as unsafe "
  . "      characters and present the possibility of not being understood within URLs "
  . "      for various reasons. These characters should also always be "
  . "      encoded.</p>"
  . "      </form></td>"
  . "<tr></tr></tbody></table></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}

function PREVIEWER() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/PREVIEWER.js");
       OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center><br /><h4>"._PREVIEWER."</h4><br />"
  . "      <form name=pad method=post>"
  . "        <textarea name=text rows=15 cols=68></textarea><br /><input onclick=preview() type=button value="._PREVIEWR." name=view>&nbsp;<input type=reset value="._CLEAR." name=clear>&nbsp;<input onclick=document.pad.text.select(); type=button value="._SELEC."> "
  . "        <p>Enter your HTML or javascript coding in the form below to "
  . "      test its appearence or check that the scripting code is error "
  . "      free.</p>"
  . "      </form>"

  . "<tr></tr></tbody></table></table>";
    CloseTable();
    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }
}

function HTMLENCODER() {
    global $module_name;
include_once("header.php");
    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/HTMLENCODER.js");
        OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center><br /><h4>"._HTMLCODER."</h4><br />"
  . "<table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "  <tbody>"
  . "  <tr>"
  . "<form name=form1 action=\"\">"
  . "      <table width=100% align=center>"
  . "        <tbody>"
  . "        <tr>"
  . "          <td align=\"center\" width=\"662\"><textarea name=text1 rows=12 cols=51></textarea></td></tr>"
  . "        <tr>"
  . "          <td align=\"center\" width=\"662\"><input onclick=encode(document.form1.text1.value) type=button value=Convert> "
  . "            <input id=RCinput type=checkbox value=1 name=mgsbrd>Convert for forums. &nbsp;&nbsp;<input "
  . "onclick=selectCode(document.form1.text1) type=button  value=Select>&nbsp;<input onclick=Cleartxt(document.form1.text1) type=button "
  . "value=Clear></td></tr>"
  . "        <tr>"
  . "          <td width=\"662\" align=\"center\">"
  . "          <textarea name=encoded_txt rows=12 cols=51></textarea></td></tr>"
  . "        <tr>"
  . "          <td align=\"center\" width=\"662\"><input onclick=preview() type=button value=Preview> &nbsp;&nbsp;<input onclick=selectCode(document.form1.encoded_txt) type=button value=Select>&nbsp;<input onclick=Cleartxt(document.form1.encoded_txt) type=button value=Clear> "
  . "          <p>HTML Encoder prevents your browser from "
  . "      rendering selected html tags allowing you to display the code "
  . "      instead.</td></tr></tbody></table></form>"
  . "</td></tr></tbody></table>"
  . "</td></tr></tbody></table>";
    CloseTable();

    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}

function SourceCoder() {
    global $module_name;
include_once("header.php");

    if (file_exists("modules/$module_name/copyright.php")) {
include_once("modules/$module_name/js/SourceCoder.js");      
OpenTable();
echo "<center><img src=\"modules/PHP-Nuke_Tools/images/tools.gif\"><br />";
    CloseTable();
    OpenTable();
echo " <table  cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "<tbody><tr><td><center>"
  . "<center><br /><h4>"._SCODER."</h4><br />"
  . "<table cellspacing=0 cellpadding=0 width=\"100%\" border=0>"
  . "        <tbody>"
  . "        <tr>"
  . "          <td width=\"100%\"><!-- Compilation Panel -->"
  . "            <form name=pad method=post align=\"center\">"
  . "              <p align=\"center\"><textarea style=\"width: 80%; background-color: #\" name=text rows=11 cols=58></textarea><br /><input onmouseover=LightOn(this) onclick=generate() onmouseout=LightOut(this) type=button value=EnCode name=compileIt> "
  . "<input onmouseover=LightOn(this) onclick=selectCode() onmouseout=LightOut(this) type=button value=Select name=select> "
  . "<input onmouseover=LightOn(this) onclick=preview() onmouseout=LightOut(this) type=button value=Preview name=view> "
  . "<input onmouseover=LightOn(this) onclick=uncompile() onmouseout=LightOut(this) type=button value=Decode name=retur> "
  . "<input onmouseover=LightOn(this) onmouseout=LightOut(this) type=reset value=Clear name=clear>"
  . "              </p>"
  . "            </form><!-- Compilation Panel --></td></tr></tbody></table><!--webbot bot=\"HTMLMarkup\" endspan -->"
  . "</td></tr></tbody></table>"
  . "</td></tr></tbody></table>";
    CloseTable();

    OpenTable();
   echo"    <center>&nbsp;&nbsp;[&nbsp;&nbsp;<a href=\"modules.php?name=$module_name\">"._BACK."</a>&nbsp;&nbsp;]&nbsp;&nbsp";
    CloseTable();
  echo "";
    OpenTable();
    echo ""._discopy."";
    CloseTable();
include_once("footer.php");
    } else {
    echo "<br />";
    OpenTable();
    echo "<br /><center><strong>Opps, you forgot to upload the Copyright.php file!<br /><br />Upload the copyright.php file, and this message will go away.<br /><br />Thanks for giving me credit!</strong></center><br />";
    CloseTable();
    include_once("footer.php");
    die();
    }

}
switch($func) {

    default:
    Tools();
    break;
    
    case "Module":
    DisModule();
    break;

    case "Block":
    DisBlock();
    break;

    case "HTMLPHP":
    DisHTMLPHP();
    break;

    case "HTMLJS":
    DisHTMLJS();
    break;

    case "HTMLJSP":
    DisHTMLJSP();
    break;

    case "HTMLPERL":
    DisHTMLPERL();
    break;

    case "HTMLASP":
    DisHTMLASP();
    break;

    case "Source":
    DiSource();
    break;

    case "Pop":
    DisPOp();
    break;

    case "Scroll":
    Scroll();
    break;

    case "Color":
    Color();
    break;

    case "MTags":
    MTags();
    break;

    case "HelpModule":
    HelpModule();
    break;

    case "HelpBlock":
    HelpBlock();
    break;

    case "HTMLSWS":
    HTMLSWS();
    break;

    case "EMAIL":
    EMAIL();
    break;

    case "ROT":
    ROT();
    break;

    case "URLENCODER":
    URLENCODER();
    break;

    case "PREVIEWER":
    PREVIEWER();
    break;


    case "HTMLENCODER":
    HTMLENCODER();
    break;

    case "SourceCoder":
    SourceCoder();
    break;

}

?>