<?php
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* PlatinumNuke: Your dreams, our imagination                             */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "nbbcode.php")) {
    Header("Location: ../index.php");
    die();
}

$ThemeSel = get_theme();
global $smilies_path;
if (file_exists("themes/$ThemeSel/images/smiles/icon_smile.gif")) {
    $smilies_path = "themes/$ThemeSel/images/smiles/";
} else {
    $smilies_path = "images/smiles/";
}

function get_code_lang($var, $array) {
    return ($array[$var] != '') ? $array[$var] : $var;
}

/***********************************************************************************

 Returns the message with smilies decoded to proper image tags.
    $message: The message to decode
    $url    : Optional http url to the images
     * @return string

************************************************************************************/
function set_smilies($message, $url='') {
    static $orig, $repl;
    if (!isset($orig)) {
        global $db, $prefix, $smilies_path, $language, $currentlang;
        $orig = $repl = array();
        $sql = 'SELECT * FROM '.$prefix.'_bbsmilies';
        if ( !$result = $db->sql_query($sql) ) {
            die("ERROR: Couldn't obtain smilies data");
        }
        $smilies = $db->sql_fetchrowset($result);
        if (count($smilies)) {
            usort($smilies, 'sort_smiley');
        }
        if ($url != '') {
            if (substr($url, -1) != '/') { $url .= '/'; }
        }
        if (file_exists("language/bbcode/lang-$currentlang.php")) {
            include_once("language/bbcode/lang-$currentlang.php");
        } else {
            include_once("language/bbcode/lang-$language.php");
        }
        for ($i = 0; $i < count($smilies); $i++) {
            $orig[] = "/(?<=.\W|\W.|^\W)" . nuke_preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
            $repl[] = '<img src="' . $url . $smilies_path . $smilies[$i]['smile_url'] . '" alt="' . get_code_lang($smilies[$i]['emoticon'], $smilies_desc) . '" border="0" />';
        }
    }
    if (count($orig)) {
        $message = preg_replace($orig, $repl, ' ' . $message . ' ');
        $message = substr($message, 1, -1);
    }
    return $message;
}

/**
 * Sorts the smilies
 * @access private
 * @return integer
 */
function sort_smiley($a, $b)
{
    if ( strlen($a['code']) == strlen($b['code']) ) { return 0; }
    return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

function nuke_preg_quote($str, $delimiter)
{
    $text = preg_quote($str);
    return str_replace($delimiter, '\\' . $delimiter, $text);
}
//'
/**
 * Return smiley table with smilies either in a window, inline or on 1 row
 * @param string $mode
            'window' = a popup window containing all smilies
            'inline' = a table of width 4 & height 5 smilies
            'onerow' = 1 row of 15 smilies
 * @param string $field the name of the <input>/<textare> field to communicate with, default = 'message'
 * @param string $form the name of the <form> to communicate with, default = 'post'
 * @return string
 */
function smilies_table($mode, $field="message", $form="post")
{
    global $db, $board_config, $template, $images, $CPG_URL, $theme, $phpEx, $phpbb_root_path;
    global $user_ip, $session_length, $starttime;
    global $userdata;
    global $smilies_path, $prefix;
    global $language, $currentlang;
    if (file_exists("language/bbcode/lang-$currentlang.php")) {
        include_once("language/bbcode/lang-$currentlang.php");
    } else {
        include_once("language/bbcode/lang-$language.php");
    }
    if (defined('CPG_NUKE')) {
        $url = getlink("smilies&amp;field=$field&amp;form=$form");
    } else {
        $url = "$CPG_URL&amp;mode=smilies&amp;field=$field&amp;form=$form";
    }
    $inline_columns = 4;
    $inline_rows = 5;
    $window_columns = 8;

    $content = '';
    if ($mode == 'window') {
        $path = dirname(getenv('SCRIPT_NAME'));
        if (substr($path,-1) != '/' && $path != '') $path .= '/';
        $www_location = getenv('HTTP_HOST') . $path;
        $content .= '<html><head><title>Smiley selector</title>
        <BASE href="http://'.$www_location.'"></head><body>
<script language="javascript" type="text/javascript">
<!--
function emoticon(form, field, text) {
    text = \' \' + text + \' \';
    if (opener.document.forms[form].elements[field].createTextRange && opener.document.forms[form].elements[field].caretPos) {
        var caretPos = opener.document.forms[form].elements[field].caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == \' \' ? text + \' \' : text;
        opener.document.forms[form].elements[field].focus();
    } else {
        opener.document.forms[form].elements[field].value += text;
        opener.document.forms[form].elements[field].focus();
    }
}
//-->
</script>';
    } else if (!defined("BBCODE_JS_ACTIVE")) {
        $content .= '<script language="JavaScript" src="includes/javascript/bbcode.js" type="text/javascript"></script>';
        define("BBCODE_JS_ACTIVE", 1);
    }
    if ($mode == 'onerow') {
        $content .= '
<table width="100%" border="0" cellspacing="1" cellpadding="4" class="forumline">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">';
    } else {
        $content .= '
<table width="100" border="0" cellspacing="1" cellpadding="4" class="forumline">
  <tr>
    <td><table width="100" border="0" cellspacing="0" cellpadding="5">';
    }
    $sql = "SELECT emoticon, code, smile_url FROM ".$prefix."_bbsmilies ORDER BY smilies_id";
    if ($result = $db->sql_query($sql)) {
        $num_smilies = 0;
        $rowset = array();
        while ($row = $db->sql_fetchrow($result)) {
            if (empty($rowset[$row['smile_url']])) {
                $rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
// process the smiley description'
                $rowset[$row['smile_url']]['emoticon'] = get_code_lang($row['emoticon'], $smilies_desc);
                $num_smilies++;
            }
        }

        if ($num_smilies) {
            $smilies_count = ($mode == 'inline') ? min(19, $num_smilies) : $num_smilies;
            $smilies_split_row = ($mode == 'inline') ? $inline_columns - 1 : $window_columns - 1;

            $s_colspan = 0;
            $row = 0;
            $col = 0;

            while (list($smile_url, $data) = @each($rowset)) {
                if (!$col) {
                    $content .= '<tr align="center" valign="middle">';
                }

                $content .= "<td><a href=\"javascript:emoticon('".$form."', '".$field."', '".$data['code']."')\"><img src=\"" . $smilies_path . $smile_url . "\" border=\"0\" alt=\"".$data['emoticon']."\" title=\"".$data['emoticon']."\" /></a></td>";
                $s_colspan = max($s_colspan, $col + 1);

                if ($mode == 'onerow') {
                    if ($col == 15) {
                        if ($num_smilies > 15) {
                            $url = "modules.php?name=Forums&file=smilies&amp;field=$field&amp;form=$form";
                            $content .= "<td colspan=\"$s_colspan\"><span  class=\"nav\"><a href=\"$url\" onclick=\"window.open('$url', '_smilies', 'HEIGHT=200,resizable=yes,scrollbars=yes,WIDTH=230');return false;\" target=\"_smilies\" class=\"nav\">$smilies_more</a></td>";
                        }
                        break;
                    }
                    $col++;
                }
                else if ($col == $smilies_split_row) {
                    $content .= "</tr>";
                    if ($mode == 'inline' && $row == $inline_rows - 1) {
                        break;
                    }
                    $col = 0;
                    $row++;
                }
                else { $col++; }
            }
            if ($col > 0) { $content .= '</tr>'; }

            if ($mode == 'inline' && $num_smilies > $inline_rows * $inline_columns) {
                $url = "modules.php?name=Forums&file=smilies&amp;field=$field&amp;form=$form";
                $content .= "                    <tr align=\"center\">
                        <td colspan=\"$s_colspan\"><span  class=\"nav\"><a href=\"$url\" onclick=\"window.open('$url', '_smilies', 'HEIGHT=200,resizable=yes,scrollbars=yes,WIDTH=230');return false;\" target=\"_smilies\" class=\"nav\">$smilies_more</a></td>
                    </tr>";
            }
        }
    }
    $content .= '
    </table></td>
  </tr>
</table>';

    if ($mode == 'window') {
        $content .= '<br /><div align="center">
        <a href="javascript:window.close();" class="genmed">'.$smilies_close.'</a>
        </div>
        </body></html>';
    }
    return $content;
}

/***********************************************************************************

 string bbcode_table($field="message", $form="post", $allowed=0)

 Return a table with BBcode options
    $field  : the name of the <input>/<textare> field to communicate with, default = 'message'
    $form   : the name of the <form> to communicate with, default = 'post'
    $allowed: 0 = simple, 1 = all code

************************************************************************************/
function bbcode_table($field="text", $form="post", $allowed=1)
{
    global $language, $currentlang;
    if (file_exists("language/bbcode/lang-$currentlang.php")) {
        include_once("language/bbcode/lang-$currentlang.php");
    } else {
        include_once("language/bbcode/lang-$language.php");
    }
    $content = '';
    if (!defined("BBCODE_JS_ACTIVE")) {
        $content .= '<script language="JavaScript" src="includes/javascript/bbcode.js" type="text/javascript"></script>';
        define("BBCODE_JS_ACTIVE", 1);
    }
    $content .= '<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
      <p align="left" dir="ltr"><span class="gen">
        <span class="genmed">
          <img alt="bold" title="[b]bold[/b]" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'b\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="b" src="images/bbcode/b.gif" border="0" />
          <img alt="italic" title="[i]italic[/i]" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'i\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="i" src="images/bbcode/i.gif" border="0" />
          <img alt="underline" title="[u]underline[/u]" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'u\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="u" src="images/bbcode/u.gif" border="0" />
&nbsp;&nbsp;
          <img alt="Left to Right" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'ltr\')" onclick="BBCdir(\''.$form.'\',\''.$field.'\',\'ltr\')" name="dirltr" src="images/bbcode/ltr.gif" border="0" />
          <img alt="Right to Left" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'rtl\')" onclick="BBCdir(\''.$form.'\',\''.$field.'\',\'rtl\')" name="dirrtl" src="images/bbcode/rtl.gif" border="0" />
&nbsp;&nbsp;
          <img alt="URL" title="[url]...[/url]" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'url\')" onclick="BBCurl(\''.$form.'\',\''.$field.'\')" name="url" src="images/bbcode/url.gif" border="0" />
          <img alt="Email" title="[email]...[/email]" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'mail\')" onclick="BBCwmi(\''.$form.'\',\''.$field.'\',\'email\')" name="email" src="images/bbcode/email.gif" border="0" />';
    if ($allowed) {
        $content .= '
&nbsp;&nbsp;
          <img alt="justify" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'justify\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="justify" src="images/bbcode/align_justify.gif" border="0" />
          <img alt="left" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'left\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="left" src="images/bbcode/align_left.gif" border="0" />
          <img alt="center" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'center\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="center" src="images/bbcode/align_center.gif" border="0" />
          <img alt="right" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'right\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'align\',this)" name="right" src="images/bbcode/align_right.gif" border="0" />';
    }
    $content .= '
&nbsp;&nbsp;
          <select onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'fc\')" onchange="BBCfc(\''.$form.'\',\''.$field.'\',this)">
          <option class="genmed" value="#444444" style="color: black; background-color: rgb(250, 250, 250);">'.get_code_lang('Default', $color_desc).'</option>
          <option class="genmed" value="maroon" style="color: maroon; background-color: rgb(250, 250, 250);">'.get_code_lang('Dark Red', $color_desc).'</option>
          <option class="genmed" value="red" style="color: red; background-color: rgb(250, 250, 250);">'.get_code_lang('Red', $color_desc).'</option>
          <option class="genmed" value="orange" style="color: orange; background-color: rgb(250, 250, 250);">'.get_code_lang('Orange', $color_desc).'</option>
          <option class="genmed" value="brown" style="color: brown; background-color: rgb(250, 250, 250);">'.get_code_lang('Brown', $color_desc).'</option>
          <option class="genmed" value="yellow" style="color: yellow; background-color: rgb(250, 250, 250);">'.get_code_lang('Yellow', $color_desc).'</option>
          <option class="genmed" value="green" style="color: green; background-color: rgb(250, 250, 250);">'.get_code_lang('Green', $color_desc).'</option>
          <option class="genmed" value="olive" style="color: olive; background-color: rgb(250, 250, 250);">'.get_code_lang('Olive', $color_desc).'</option>
          <option class="genmed" value="cyan" style="color: cyan; background-color: rgb(250, 250, 250);">'.get_code_lang('Cyan', $color_desc).'</option>
          <option class="genmed" value="blue" style="color: blue; background-color: rgb(250, 250, 250);">'.get_code_lang('Blue', $color_desc).'</option>
          <option class="genmed" value="darkblue" style="color: darkblue; background-color: rgb(250, 250, 250);">'.get_code_lang('Dark Blue', $color_desc).'</option>
          <option class="genmed" value="indigo" style="color: indigo; background-color: rgb(250, 250, 250);">'.get_code_lang('Indigo', $color_desc).'</option>
          <option class="genmed" value="violet" style="color: violet; background-color: rgb(250, 250, 250);">'.get_code_lang('Violet', $color_desc).'</option>
          <option class="genmed" value="white" style="color: white; background-color: rgb(250, 250, 250);">'.get_code_lang('White', $color_desc).'</option>
          <option class="genmed" value="black" style="color: black; background-color: rgb(250, 250, 250);">'.get_code_lang('Black', $color_desc).'</option>
          </select>';
    if ($allowed) {
        $content .= '
        </span></span></p></td>
  </tr>
  <tr>
    <td dir="rtl">
      <p style="margin-top: 0pt; margin-bottom: 0pt;" dir="ltr" align="left"><span class="gen">
        <span class="genmed">
          <img alt="Image" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'img\')" onclick="BBCwmi(\''.$form.'\',\''.$field.'\',\'img\')" name="img" src="images/bbcode/img.gif" border="0" />
          <img alt="Flash" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'flash\')" onclick="BBCmm(\''.$form.'\',\''.$field.'\',\'flash\')" name="flash" src="images/bbcode/flash.gif" border="0" />
          <img alt="Video" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'video\')" onclick="BBCmm(\''.$form.'\',\''.$field.'\',\'video\')" name="video" src="images/bbcode/video.gif" border="0" />
&nbsp;&nbsp;
          <img alt="Quote" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'quote\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="quote" src="images/bbcode/quote.gif" border="0" />
          <img alt="Code" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'code\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="code" src="images/bbcode/code.gif" border="0" />
          <img alt="PHP" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'php\')" onclick="BBCcode(\''.$form.'\',\''.$field.'\',this)" name="php" src="images/bbcode/php.gif" border="0" />
&nbsp;&nbsp;
          <img alt="H-Line" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'hr\')" onclick="BBChr(\''.$form.'\',\''.$field.'\')" name="hr" src="images/bbcode/hr.gif" border="0" />
&nbsp;&nbsp;
          <img alt="Marque to down" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'marqd\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="down" src="images/bbcode/marq_down.gif" border="0" />
          <img alt="Marque to up" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'marqu\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="up" src="images/bbcode/marq_up.gif" border="0" />
          <img alt="Marque to left" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'marql\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="left" src="images/bbcode/marq_left.gif" border="0" />
          <img alt="Marque to right" style="border-style: outset; border-width: 1px;" onmouseover="helpline(\''.$form.'\',\''.$field.'\',\'marqr\')" onclick="BBCode(\''.$form.'\',\''.$field.'\',\'marq\',this)" name="right" src="images/bbcode/marq_right.gif" border="0" />';
    }
    $content .= '
        </span></span></p></td>
  </tr>
  <tr>
    <td>
      <input type="text" name="help'.$field.'" size="66" maxlength="100" style="color:rgb(0,102,153); border-width:1pt; border-color:silver; border-style:none;" value="Tip: Styles can be applied quickly to selected text" class="helpline" />
    </td>
  </tr>
</table>';

    return $content;
}

/***********************************************************************************

 string decode_bbcode($text, $allowed=0, $user_sig_bbcode_uid='')

 Converts bbcode to proper xhtml
    $text               : the message to convert
    $allowed            : 0 = simple, 1 = all code
    $user_sig_bbcode_uid: only used to convert forum bbcode which has a uid attached
                          to each code like [b:3479375] instead of [b]

************************************************************************************/
function decode_bbcode($text, $allowed=0, $user_sig_bbcode_uid='')
{
    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    $text = " " . $text;

    $text = str_replace("<br />\n", "\n", $text);
    $text = str_replace("<br />\n", "\n", $text);
    $text = ($user_sig_bbcode_uid != '') ? preg_replace("/:(([a-z0-9]+:)?)$user_sig_bbcode_uid(=|\])/si", '\\3', $text) : $text;
    $text = nl2br($text);
    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if (! (strpos($text, "[") && strpos($text, "]")) ) {
        // Remove padding, return.
        $text = substr($text, 1);
        return $text;
    }

    // [list] and [list=x] for (un)ordered lists.
    // unordered lists
    $text = str_replace("[list]", "<ul>", $text);
    // li tags
    $text = str_replace("[*]", "<li>", $text);
    // ending tags
    $text = str_replace("[/list:u]", "</ul>", $text);
    $text = str_replace("[/list:o]", "</ol>", $text);
    // Ordered lists
    $text = preg_replace("/\[list=([a1])\]/si", "<ol type=\"\\1\">", $text);

    // colours
    $text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+)\]/si", '<span style="color: \\1">', $text);
    $text = str_replace("[/color]", "</span>", $text);

    // [b] and [/b] for bolding text.
    $text = str_replace("[b]", "<span style=\"font-weight: bold\">", $text);
    $text = str_replace("[/b]", "</span>", $text);

    // [u] and [/u] for underlining text.
    $text = str_replace("[u]", '<span style="text-decoration: underline">', $text);
    $text = str_replace("[/u]", '</span>', $text);

    // [i] and [/i] for italicizing text.
    $text = str_replace("[i]", "<span style=\"font-style: italic\">", $text);
    $text = str_replace("[/i]", "</span>", $text);

    // align
    $text = preg_replace("/\[align=(left|right|center|justify)\]/si", '<div style="text-align:\\1">', $text);
    $text = str_replace("[/align]", '</div>', $text);

    if ($allowed) {
        // [hr]
        $text = str_replace("[hr]", '<hr />', $text);
        
        $text = preg_replace("#\[ram\](.*?)\[/ram\]#si", "<div align=\"center\"><embed src=\"\\1\" align=\"center\" width=\"275\" height=\"40\" type=\"audio/x-pn-realaudio-plugin\" console=\"cons\" controls=\"ControlPanel\" autostart=\"false\"></embed></div>", $text);

        // marquee
        $text = preg_replace("/\[marq=(left|right|up|down)\]/si", '<marquee direction="\\1" scrolldelay="120">', $text);
        $text = str_replace("[/marq]", '</marquee>', $text);

        // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
        $text = str_replace("[quote]", '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center"><tr>
      <td><span class="genmed"><strong>Quote:</strong></span></td>
    </tr><tr>
      <td class="quote">', $text);
        $text = str_replace("[/quote]", '</td></tr></table>', $text);
        // Deal with opening quotes with usernames...
        $text = preg_replace("/\[quote=\"(.*?)\"\]/si", '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center"><tr>
      <td><span class="genmed"><strong>\\1 wrote:</strong></span></td>
    </tr><tr>
      <td class="quote">', $text);

        // [CODE] and [/CODE] for posting code (HTML, C etc etc) in your posts.
        $text = decode_bbcode_code($text);

        // [PHP] and [/PHP] for posting PHP code in your posts.
        $text = decode_bbcode_php($text);
    }

    // Patterns and replacements for URL, email tags etc.
    $patterns = array();
    $replacements = array();

    // matches a [url]xxxx://www.phpbb.com[/url] code..
    $patterns[] = "#\[url\]([\w]+?://[^ \"\n\r\t<]*?)\[/url\]#is";
    $replacements[] = "<a href=\"\\1\" target=\"_blank\" class=\"postlink\">\\1</a>";

    // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url\]((www|ftp)\.[^ \"\n\r\t<]*?)\[/url\]#is";
    $replacements[] = "<a href=\"http://\\1\" target=\"_blank\" class=\"postlink\">\\1</a>";

    // [url=xxxx://www.phpbb.com]phpBB[/url] code..
    $patterns[] = "#\[url=([\w]+?://[^ \"\n\r\t<]*?)\](.*?)\[/url\]#is";
    $replacements[] = "<a href=\"\\1\" target=\"_blank\" class=\"postlink\">\\2</a>";

    

    // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url=((www|ftp)\.[^ \"\n\r\t<]*?)\](.*?)\[/url\]#is";
    $replacements[] = "<a href=\"http://\\1\" target=\"_blank\" class=\"postlink\">\\3</a>";

    // [email]user@domain.tld[/email] code..
    $patterns[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
    $replacements[] = "<a href=\"mailto:\\1\">\\1</a>";

    if ($allowed) {
        // [img]image_url_here[/img] code..
//        $text = preg_replace("#\[img\]((ht|f)tp://)([^ \?&=\"\n\r\t<]*?(\.(jpg|jpeg|gif|png|php)))\[/img\]#sie", "'[img]\\1' . str_replace('".$admin_file.".php', ' ', '\\2') . '[/img]'", $text);
//        $patterns[] = "#\[img\]((ht|f)tp://)([^ \?&=\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/img\]#si";
//        $replacements[] = "'<img src=\"\\1' . str_replace('".$admin_file.".php', 'nothing', '\\3') . '\" border=\"0\" />'";
//        $text = preg_replace("#\[img\]((ht|f)tp://)(.*?)\[/img\]#sie", "'[img]\\1' . str_replace('admin', 'lozer', '\\3') . '[/img]'", $text);
//        $patterns[] = "#\[img\](.*?)\[/img\]#si";
//        $replacements[] = "<img src=\"\\1\" border=\"0\" />";
        $patterns[] = "#\[img\]((ht|f)tp://)(.*?)\[/img\]#sie";
        $replacements[] = "'<img src=\"\\1' . str_replace('".$admin_file.".php', 'lozer.txt', '\\3') . '\" border=\"0\" />'";

        // [flash width= height= loop= ] and [/flash] code..
        $patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\]((ht|f)tp://)([^ \?&=\"\n\r\t<]*?(\.(swf|fla)))\[/flash\]#si";
        $replacements[] = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="\\1" height="\\2">
    <param name="movie" value="\\3\\5">
    <param name="quality" value="high">
    <param name="scale" value="noborder">
    <param name="wmode" value="transparent">
    <param name="bgcolor" value="#000000">
  <embed src="\\3\\5" quality="high" scale="noborder" wmode="transparent" bgcolor="#000000" width="\\1" height="\\2" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
</embed></object>';

        // [video width= height= loop= ] and [/video] code..
        $patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\]((ht|f)tp://)([^ \?&=\"\n\r\t<]*?(\.(avi|mpg|mpeg)))\[/video\]#si";
        $replacements[] = '<div align="center"><embed src="\\3\\5" width=\\1 height=\\2></embed>';
    }

    $text = preg_replace($patterns, $replacements, $text);

    // Remove our padding from the string..
    $text = substr($text, 1);

    return $text;
}

/***********************************************************************************

 string encode_bbcode($text)

 Makes from the BBcode [list] a proper BBcode due to the different options of that code
    $text : the message to fix

************************************************************************************/
function encode_bbcode($text)
{
    // [list] and [list=x] for (un)ordered lists.
    $open_tag = array();
    $open_tag[0] = "[list]";
    // unordered..
    $text = encode_bbcode_pda($text, $open_tag, "[/list]", "[/list:u]", false);
    // ordered..
    $text = str_replace("[/list]", "[/list:o]", $text);

    return $text;
}

function encode_bbcode_pda($text, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $open_regexp_replace = false)
{
    $open_tag_count = 0;

    if (!$close_tag_new || ($close_tag_new == '')) { $close_tag_new = $close_tag; }

    $close_tag_length = strlen($close_tag);
    $close_tag_new_length = strlen($close_tag_new);

    $stack = array();

    if (is_array($open_tag)) {
        if (0 == count($open_tag)) {
            // No opening tags to match, so return.
            return $text;
        }
        $open_tag_count = count($open_tag);
    }
    else {
        // only one opening tag. make it into a 1-element array.
        $open_tag_temp = $open_tag;
        $open_tag = array();
        $open_tag[0] = $open_tag_temp;
        $open_tag_count = 1;
    }

    $open_is_regexp = false;

    if ($open_regexp_replace) {
        $open_is_regexp = true;
        if (!is_array($open_regexp_replace)) {
                $open_regexp_temp = $open_regexp_replace;
                $open_regexp_replace = array();
                $open_regexp_replace[0] = $open_regexp_temp;
        }
    }

    if ($mark_lowest_level && $open_is_regexp) {
        die("ERROR: Unsupported operation for encode_bbcode_pda().");
    }

    // Start at the 2nd char of the string, looking for opening tags.
    $curr_pos = 1;
    while ($curr_pos && ($curr_pos < strlen($text))) {
        $curr_pos = strpos($text, "[", $curr_pos);

        // If not found, $curr_pos will be 0, and the loop will end.
        if ($curr_pos) {
            // We found a [. It starts at $curr_pos.
            // check if it's a starting or ending tag.
            $found_start = false;
            $which_start_tag = "";
            $start_tag_index = -1;

            for ($i = 0; $i < $open_tag_count; $i++) {
                // Grab everything until the first "]"...
                $possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);
                //
                // We're going to try and catch usernames with "[' characters.
                //
                if( preg_match('#\[quote=\\\"#si', $possible_start, $match) && !preg_match('#\[quote=\\\"(.*?)\\\"\]#si', $possible_start) ) {
                    // OK we are in a quote tag that probably contains a ] bracket.
                    // Grab a bit more of the string to hopefully get all of it..
                    if ($close_pos = strpos($text, '"]', $curr_pos + 9)) {
                        if (strpos(substr($text, $curr_pos + 9, $close_pos - ($curr_pos + 9)), '[quote') === false) {
                            $possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 2);
                        }
                    }
                }
                // Now compare, either using regexp or not.
                if ($open_is_regexp) {
                    $match_result = array();
                    if (preg_match($open_tag[$i], $possible_start, $match_result)) {
                        $found_start = true;
                        $which_start_tag = $match_result[0];
                        $start_tag_index = $i;
                        break;
                    }
                }
                else {
                    // straightforward string comparison.
                    if (0 == strcasecmp($open_tag[$i], $possible_start)) {
                        $found_start = true;
                        $which_start_tag = $open_tag[$i];
                        $start_tag_index = $i;
                        break;
                    }
                }
            }

            if ($found_start) {
                // We have an opening tag.
                // Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
                $match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
                array_push($stack, $match);
                //
                // Rather than just increment $curr_pos
                // Set it to the ending of the tag we just found
                // Keeps error in nested tag from breaking out
                // of table structure..
                //
                $curr_pos += strlen($possible_start);
            }
            else {
                // check for a closing tag..
                $possible_end = substr($text, $curr_pos, $close_tag_length);
                if (0 == strcasecmp($close_tag, $possible_end)) {
                    // We have an ending tag.
                    // Check if we've already found a matching starting tag.
                    if (sizeof($stack) > 0) {
                        // There exists a starting tag.
                        $curr_nesting_depth = sizeof($stack);
                        // We need to do 2 replacements now.
                        $match = array_pop($stack);
                        $start_index = $match['pos'];
                        $start_tag = $match['tag'];
                        $start_length = strlen($start_tag);
                        $start_tag_index = $match['index'];

                        if ($open_is_regexp) {
                            $start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
                        }

                        // everything before the opening tag.
                        $before_start_tag = substr($text, 0, $start_index);

                        // everything after the opening tag, but before the closing tag.
                        $between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

                        // everything after the closing tag.
                        $after_end_tag = substr($text, $curr_pos + $close_tag_length);

                        // Mark the lowest nesting level if needed.
                        if ($mark_lowest_level && ($curr_nesting_depth == 1)) {
                            if ($open_tag[0] == '[code]') {
                                $code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
                                $code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
                                $between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
                            }
                            $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth]";
                            $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth]";
                        }
                        else {
                            if ($open_tag[0] == '[code]') {
                                $text = $before_start_tag . '&#91;code&#93;';
                                $text .= $between_tags . '&#91;/code&#93;';
                            }
                            else if ($open_tag[0] == '[php]') {
                                 // PHP MOD
                                $text = $before_start_tag . '/*php ';
                                $text .= $between_tags . ' /php*/';
                            }
                            else {
                                if ($open_is_regexp) {
                                    $text = $before_start_tag . $start_tag;
                                }
                                else {
                                    $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . "]";
                                }
                                $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . "]";
                            }
                        }

                        $text .= $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (sizeof($stack) > 0) {
                            $match = array_pop($stack);
                            $curr_pos = $match['pos'];
                        }
                        else {
                            $curr_pos = 1;
                        }
                    }
                    else {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                }
                else {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        }
    } // while

    return $text;

} // bbencode_first_pass_pda()

function decode_bbcode_code($text)
{
    $code_start_html = '<table width="90%" cellspacing="1" cellpadding="3" border="0" align="center">
<tr>
      <td><span class="genmed"><strong>Code:</strong></span></td>
    </tr>
    <tr>
      <td class="code">';
    $code_end_html =  '</td></tr></table>';

    // First, do all the 1st-level matches. These need an htmlspecialchars() run,
    // so they have to be handled differently.
    $match_count = preg_match_all("#\[code\](.*?)\[/code\]#si", $text, $matches);

    for ($i = 0; $i < $match_count; $i++) {
        $before_replace = $matches[1][$i];
        $after_replace = $matches[1][$i];

        // Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
        $after_replace = str_replace("  ", "&nbsp; ", $after_replace);
        // now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
        $after_replace = str_replace("  ", " &nbsp;", $after_replace);

        // Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
        $after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

        // now Replace space occurring at the beginning of a line
        $after_replace = preg_replace("/^ {1}/m", '&nbsp;', $after_replace);

        $str_to_match = "[code]" . $before_replace . "[/code]";

        $replacement = $code_start_html;
        $replacement .= $after_replace;
        $replacement .= $code_end_html;

        $text = str_replace($str_to_match, $replacement, $text);
    }

    // Now, do all the non-first-level matches. These are simple.
    $text = str_replace("[code]", $code_start_html, $text);
    $text = str_replace("[/code]", $code_end_html, $text);

    return $text;

} // decode_bbcode_code()

function decode_bbcode_php($text)
{
global $textcolor1;
    $code_start_html = '<table border="0" align="center" width="90%" cellpadding="3" cellspacing="1">
<tr>
      <td><span class="genmed"><strong>PHP:</strong></span></td>
    </tr>
    <tr>
      <td class="code">';
    $code_end_html =  '</td></tr></table>';
    $matches = array();
    $match_count = preg_match_all("#\[php\](.*?)\[/php\]#si", $text, $matches);

    for ($i = 0; $i < $match_count; $i++) {
        $before_replace = $matches[1][$i];
        $after_replace = trim($matches[1][$i]);
        $str_to_match = "[php]" . $before_replace . "[/php]";
        $replacement = $code_start_html;
        $after_replace = str_replace('&lt;', '<', $after_replace);
        $after_replace = str_replace('&gt;', '>', $after_replace);
        $after_replace = str_replace("<br />\r\n", "\n", $after_replace);
        $after_replace = str_replace("<br />\n", "\n", $after_replace);
        $after_replace = str_replace('&amp;', '&', $after_replace);
        $after_replace = str_replace('&quot;', '"', $after_replace);
        $added = FALSE;
        if (preg_match('/^<\?.*?\?>$/si', $after_replace) <= 0) {
            $after_replace = "<?php $after_replace ?>";
            $added = TRUE;
        }
        if(strcmp('4.2.0', phpversion()) > 0) {
            ob_start();
            highlight_string($after_replace);
            $after_replace = ob_get_contents();
            ob_end_clean();
        }
        else {
            $after_replace = highlight_string($after_replace, TRUE);
        }
        if ($added == TRUE) {
            $after_replace = str_replace('<font color="$textcolor1">&lt;?php ', '<font color="$textcolor1">', $after_replace);
            $after_replace = str_replace('<font color="$textcolor1">?&gt;</font>', '', $after_replace);
        }
        $after_replace = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $after_replace);
        $after_replace = str_replace('</font>', '</span>', $after_replace);
        $after_replace = str_replace("\n", '', $after_replace);
        $replacement .= $after_replace;
        $replacement .= $code_end_html;

        $text = str_replace($str_to_match, $replacement, $text);
    }

    $text = str_replace("[php]", $code_start_html, $text);
    $text = str_replace("[/php]", $code_end_html, $text);

    return $text;
} // decode_bbcode_php()

?>
