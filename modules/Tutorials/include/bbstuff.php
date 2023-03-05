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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/
/* NSN-NUKE: Intelligent Content Management System      */
/* ============================================         */
/*                                                      */
/* Copyright (c) 2003 by NSN-Nuke                       */
/* http://nsnnuke.org                                   */
/*                                                      */
/* This program is free software. You can redistribute  */
/* it and/or modify it under the terms of the GNU       */
/* General Public License as published by the Free      */
/* Software Foundation; either version 2 of the License.*/
/********************************************************/
/* BBCode Parser for the News module                    */
/* Copyright (c) 2003 by ArtificialIntel                */
/* All Rights Reserved                                  */
/********************************************************/

$bbcode_is_set = "1";
function prepare_bbcode_template($bbcode_tpl)
{
        global $lang;

        $bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}', '\\1', $bbcode_tpl['olist_open']);

        $bbcode_tpl['color_open'] = str_replace('{COLOR}', '\\1', $bbcode_tpl['color_open']);

        $bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);

        $bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);

        $bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_username_open']);
        $bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}', $lang['wrote'], $bbcode_tpl['quote_username_open']);
        $bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}', '\\1', $bbcode_tpl['quote_username_open']);

        $bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);

        $bbcode_tpl['img'] = str_replace('{URL}', '\\1', $bbcode_tpl['img']);

        // We do URLs in several different ways..
        $bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);

        $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

        $bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);

        $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
        $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\5', $bbcode_tpl['url4']);

        $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

        define("BBCODE_TPL_READY", true);

        return $bbcode_tpl;
}
function parse_bbcode($hometext, $bbcode_uid){


		$bbcode_tpl = array();
		$bbcode_tpl['web'] = "<iframe width=\"100%\" height=\"350\" src=\"$1\"></iframe>";
		$bbcode_tpl['b'] = "<span style=\"font-weight: bold;\">";
		$bbcode_tpl['b_close'] = "</span>";
		$bbcode_tpl['strike'] = "<span><strike>";
		$bbcode_tpl['strike_close'] = "</strike></span>";
		$bbcode_tpl['acronym'] = "<acronym title=\"$1\">";
		$bbcode_tpl['acronym_close'] = "</acronym>";
		$bbcode_tpl['i'] = "<span style=\"font-style: italic;\">";
		$bbcode_tpl['i_close'] = "</span>";
		$bbcode_tpl['u'] = "<span style=\"text-decoration: underline;\">";
		$bbcode_tpl['u_close'] = "</span>";
		$bbcode_tpl['size_open'] = "<span style=\"font-size: $1px; line-height: normal\">";
		$bbcode_tpl['size_close'] = "</span>";
		$bbcode_tpl['color_open'] = "<span style=\"color: $1;\">";
		$bbcode_tpl['color_close'] = "</span>";
		$bbcode_tpl['img'] = "<img src=\"$1\" border=\"0\" />";
		$bbcode_tpl['url1'] = "<a href=\"$1$2\" target=\"_blank\" class=\"postlink\">$1$2</a>";
		$bbcode_tpl['url2'] = "<a href=\"http://$1\" target=\"_blank\" class=\"postlink\">$1</a>";
		$bbcode_tpl['url3'] = "<a href=\"$1$2\" target=\"_blank\" class=\"postlink\">$6</a>";
		$bbcode_tpl['url4'] = "<a href=\"http://$1\" target=\"_blank\" class=\"postlink\">$5</a>";
		$bbcode_tpl['email'] = "<a href=\"mailto:$1\" class=\"postlink\">$1</a>";
		$bbcode_tpl['code_open'] = "<table width=\"85%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\"><tr><td><span class=\"genmed\"><strong>"._TUTBBCODE.":</strong></span></td></tr><tr><td class=\"code\">";
		$bbcode_tpl['code_close'] = "</td></tr></table>";
		$bbcode_tpl['align_open'] = "<div style=\"text-align:$1\">";
		$bbcode_tpl['align_close'] = "</div>";
		$bbcode_tpl['quote_open'] = "<table width=\"85%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\"><tr><td><span class=\"genmed\"><strong>"._TUTBBQUOTE.":</strong></span></td></tr><tr><td class=\"quote\">";
		$bbcode_tpl['quote_close'] = "</td></tr></table>";
		$bbcode_tpl['quote_username_open'] = "<table width=\"85%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\"><tr><td><span class=\"genmed\"><strong>$1 "._TUTBBWROTE.":</strong></span></td></tr><tr><td class=\"quote\">";
                $bbcode_tpl['ulist_open'] = "<ul>";
		$bbcode_tpl['ulist_close'] = "</ul>";
		$bbcode_tpl['olist_open'] = "<ol type=\"$1\">";
		$bbcode_tpl['olist_close'] = "</ol>";
		$bbcode_tpl['list_item'] = "<li>";
		$bbcode_tpl['hr'] = "<hr noshade color='#000000' size='1'>";
		$bbcode_tpl['font_open'] = "<span style=\"font-family:$1\">";
		$bbcode_tpl['font_close'] = "</span>";
		$bbcode_tpl['marq_open'] = "<marquee direction=\"$1\" scrolldelay=\"120\">";
		$bbcode_tpl['marq_close'] = "</marquee>";
		$bbcode_tpl['fade_open'] = "<span style=\"height: 1; Filter: Alpha(Opacity=100, FinishOpacity=0, Style=1, StartX=0, FinishX=100%)\">";
		$bbcode_tpl['fade_close'] = "</span>";
		$bbcode_tpl['edit_open'] = "<table width=\"85%\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\"><tr><td><span class=\"genmed\"><strong>Update:</strong></span></td></tr><tr><td class=\"code\">";
		$bbcode_tpl['edit_close'] = "	</tr></table><span class=\"postbody\">";
		$bbcode_tpl['table_open'] = "<table style=\"$1\"><tr>";
		$bbcode_tpl['table_close'] = "</tr></table>";
		$bbcode_tpl['cell_open'] = "<td style=\"$1\">";
		$bbcode_tpl['cell_close'] = "</td>";
		$bbcode_tpl['ram'] = "<div align=\"center\"><embed src=\"$1\" align=\"center\" width=\"275\" height=\"40\" type=\"audio/x-pn-realaudio-plugin\" console=\"cons\" controls=\"ControlPanel\" autostart=\"false\"></embed></div>";
		$bbcode_tpl['stream'] = "<object id=\"wmp\" width=275 height=40 classid=\"CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95\" codebase=\"http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0\" standby=\"Loading Microsoft Windows Media Player components...\" type=\"application/x-oleobject\"><param name=\"FileName\" value=\"$1\"><param name=\"ShowControls\" value=\"1\"><param name=\"ShowDisplay\" value=\"0\"><param name=\"ShowStatusBar\" value=\"1\"><param name=\"AutoSize\" value=\"1\"><embed type=\"application/x-mplayer2\" pluginspage=\"http://www.microsoft.com/windows95/downloads/contents/wurecommended/s_wufeatured/mediaplayer/default.asp\" src=\"$1\" name=MediaPlayer2 showcontrols=1 showdisplay=0 showstatusbar=1 autosize=1 visible=1 animationatstart=0 transparentatstart=1 loop=0 height=70 width=300></embed></object>";
		$bbcode_tpl['flash'] = "<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" WIDTH=$1 HEIGHT=$2><PARAM NAME=movie VALUE=\"$3\"><PARAM NAME=quality VALUE=high> <PARAM NAME=scale VALUE=noborder> <PARAM NAME=wmode VALUE=transparent><PARAM NAME=bgcolor VALUE=#000000><EMBED src=\"$3\" quality=high scale=noborder wmode=transparent bgcolor=#000000 WIDTH=$1 HEIGHT=$2 TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\"></EMBED></OBJECT>";
		$bbcode_tpl['video'] = "<div align=\"center\"><embed src=\"$3\" width=$1 height=$2></embed></div>";

		$patterns = array();
		$replacements = array();
		$patterns[] = "#\[img:$bbcode_uid\](.*?)\[/img:$bbcode_uid\]#si";
		$replacements[] = $bbcode_tpl['img'];
		$patterns[] = "#\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]#is";
		$replacements[] = $bbcode_tpl['url1'];
		$patterns[] = "#\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url2'];
		$patterns[] = "#\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url3'];
		$patterns[] = "#\[url=(([\w\-]+\.)*?[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\](.*?)\[/url\]#si";
		$replacements[] = $bbcode_tpl['url4'];
		$patterns[] = "#\[email\]([a-z0-9\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
		$replacements[] = $bbcode_tpl['email'];
		$patterns[] = "#\[web:$bbcode_uid\](.*?)\[/web:$bbcode_uid\]#si";
		$replacements[] = $bbcode_tpl['web'];
        $patterns[] = "#\[ram:$bbcode_uid\](.*?)\[/ram:$bbcode_uid\]#si";
        $replacements[] = $bbcode_tpl['ram'];
        $patterns[] = "#\[stream:$bbcode_uid\](.*?)\[/stream:$bbcode_uid\]#si";
        $replacements[] = $bbcode_tpl['stream'];
        $patterns[] = "#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$bbcode_uid\](.*?)\[/flash:$bbcode_uid\]#si";
        $replacements[] = $bbcode_tpl['flash'];
        $patterns[] = "#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9]):$bbcode_uid\](.*?)\[/video:$bbcode_uid\]#si";
        $replacements[] = $bbcode_tpl['video'];
		$hometext = preg_replace($patterns, $replacements, $hometext);

		$code_start_html = $bbcode_tpl['code_open'];
		$code_end_html =  $bbcode_tpl['code_close'];

		$match_count = preg_match_all("#\[code:1:$bbcode_uid\](.*?)\[/code:1:$bbcode_uid\]#si", $hometext, $matches);
		for ($i = 0; $i < $match_count; $i++)
		{
			$before_replace = $matches[1][$i];
			$after_replace = $matches[1][$i];
			$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
			$after_replace = str_replace("  ", " &nbsp;", $after_replace);
			$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);
			$str_to_match = "[code:1:$bbcode_uid]" . $before_replace . "[/code:1:$bbcode_uid]";
			$replacement = $code_start_html;
			$replacement .= $after_replace;
			$replacement .= $code_end_html;
			$hometext = str_replace($str_to_match, $replacement, $hometext);
		}

		$hometext = str_replace("[code:$bbcode_uid]", $code_start_html, $hometext);
		$hometext = str_replace("[/code:$bbcode_uid]", $code_end_html, $hometext);
	        $hometext = preg_replace("/\[acronym:$bbcode_uid=\"(.*?)\"\]/si", $bbcode_tpl['acronym'], $hometext);
	        $hometext = str_replace("[/acronym:$bbcode_uid]", $bbcode_tpl['acronym_close'], $hometext);
		$hometext = str_replace("[quote:$bbcode_uid]", $bbcode_tpl['quote_open'], $hometext);
		$hometext = str_replace("[/quote:$bbcode_uid]", $bbcode_tpl['quote_close'], $hometext);
		$hometext = preg_replace("/\[quote:$bbcode_uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $hometext);
		$hometext = str_replace("[list:$bbcode_uid]", $bbcode_tpl['ulist_open'], $hometext);
                $hometext = preg_replace("/\[align=(left|right|center|justify):$bbcode_uid\]/si", $bbcode_tpl['align_open'], $hometext);
                $hometext = str_replace("[/align:$bbcode_uid]", $bbcode_tpl['align_close'], $hometext);
                $hometext = str_replace("[hr:$bbcode_uid]", $bbcode_tpl['hr'], $hometext);
                $hometext = preg_replace("/\[marq=(left|right|up|down):$bbcode_uid\]/si", $bbcode_tpl['marq_open'], $hometext);
                $hometext = str_replace("[/marq:$bbcode_uid]", $bbcode_tpl['marq_close'], $hometext);
		$hometext = str_replace("[*:$bbcode_uid]", $bbcode_tpl['listitem'], $hometext);
		$hometext = str_replace("[/list:u:$bbcode_uid]", $bbcode_tpl['ulist_close'], $hometext);
		$hometext = str_replace("[/list:o:$bbcode_uid]", $bbcode_tpl['olist_close'], $hometext);
		$hometext = preg_replace("/\[list=([a1]):$bbcode_uid\]/si", $bbcode_tpl['olist_open'], $hometext);
                $hometext = preg_replace("/\[font=(.*?):$bbcode_uid\]/si", $bbcode_tpl['font_open'], $hometext);
                $hometext = str_replace("[/font:$bbcode_uid]", $bbcode_tpl['font_close'], $hometext);
		$hometext = str_replace("[b:$bbcode_uid]", $bbcode_tpl['b'], $hometext);
		$hometext = str_replace("[/b:$bbcode_uid]", $bbcode_tpl['b_close'], $hometext);
                $hometext = str_replace("[strike:$bbcode_uid]", $bbcode_tpl['strike'], $hometext);
                $hometext = str_replace("[/strike:$bbcode_uid]", $bbcode_tpl['strike_close'], $hometext);
   		$hometext = str_replace("[u:$bbcode_uid]", $bbcode_tpl['u'], $hometext);
		$hometext = str_replace("[i:$bbcode_uid]", $bbcode_tpl['i'], $hometext);
		$hometext = str_replace("[/u:$bbcode_uid]", $bbcode_tpl['u_close'], $hometext);
		$hometext = str_replace("[/i:$bbcode_uid]", $bbcode_tpl['i_close'], $hometext);
		$hometext = preg_replace("/\[size=([1-2]?[0-9]):$bbcode_uid\]/si", $bbcode_tpl['size_open'], $hometext);
		$hometext = str_replace("[/size:$bbcode_uid]", $bbcode_tpl['size_close'], $hometext);
		$hometext = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z]+):$bbcode_uid\]/si", $bbcode_tpl['color_open'], $hometext);
		$hometext = str_replace("[/color:$bbcode_uid]", $bbcode_tpl['color_close'], $hometext);
                $hometext = str_replace("[edit:$bbcode_uid]", $bbcode_tpl['edit_open'], $hometext);
                $hometext = str_replace("[/edit:$bbcode_uid]", $bbcode_tpl['edit_close'], $hometext);
		$hometext = str_replace("[fade:$bbcode_uid]", $bbcode_tpl['fade_open'], $hometext);
		$hometext = str_replace("[/fade:$bbcode_uid]", $bbcode_tpl['fade_close'], $hometext);
        $hometext = preg_replace("/\[table=(.*?):$bbcode_uid\]/si", $bbcode_tpl['table_open'], $hometext);
        $hometext = str_replace("[/table:$bbcode_uid]", $bbcode_tpl['table_close'], $hometext);
        $hometext = preg_replace("/\[cell=(.*?):$bbcode_uid\]/si", $bbcode_tpl['cell_open'], $hometext);
        $hometext = str_replace("[/cell:$bbcode_uid]", $bbcode_tpl['cell_close'], $hometext);
                $hometext = smilies_pass( $hometext );
                $hometext = make_clickable($hometext);
                $hometext = str_replace("\n", '<br />', $hometext);
		return $hometext;
}
function smilies_pass($message)
{
	static $orig, $repl;
	if (!isset($orig))
	{
		global $db, $prefix;
		$orig = $repl = array();
		$sql = "SELECT code, smile_url, emoticon FROM ".$prefix."_bbsmilies";
		if( !$result = $db->sql_query($sql) )
		{
			die("Couldn't obtain smilies data");
		}
		$smilies = $db->sql_fetchrowset($result);
		if (count($smilies))
		{
			usort($smilies, 'smiley_sort');
		}
		for ($i = 0; $i < count($smilies); $i++)
		{
			$orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
			$repl[] = '<img src="modules/Forums/images/smiles/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" />';
		}
	}
	if (count($orig))
	{
		$hometext = preg_replace($orig, $repl, ' ' . $hometext . ' ');
		$hometext = substr($hometext, 1, -1);
	}
	
	return $message;
}
function smiley_sort($a, $b)
{
        if ( strlen($a['code']) == strlen($b['code']) )
        {
                return 0;
        }

        return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}
function pregquote( $str, $delimiter )
{
   $txt = preg_quote( $str );
   $txt = str_replace($delimiter, '\\' . $delimiter, $txt );
   $hometext = $txt;
   return $hometext;
}
function make_clickable($text)
{
	$ret = ' ' . $text;
	$ret = preg_replace("#([\t\r\n ])([a-z0-9]+?){1}://([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="\2://\3" target="_blank">\2://\3</a>', $ret);
	$ret = preg_replace("#([\t\r\n ])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)#i", '\1<a href="http://\2.\3" target="_blank">\2.\3</a>', $ret);
	$ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
	$ret = substr($ret, 1);
	$hometext = $ret;

	return $hometext;
}
function insert_bbcode_uid($text, $uid){

	// pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
	// This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
	$text = " " . $text;

	// [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	$text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');

	// [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	$text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');
	$text = bbencode_first_pass_pda($text, $uid, '/\[quote=(\\\".*?\\\")\]/is', '[/quote]', '', false, '', "[quote:$uid=\\1]");

	// [list] and [list=x] for (un)ordered lists.
	$open_tag = array();
	$open_tag[0] = "[list]";

	// unordered..
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');

	$open_tag[0] = "[list=1]";
	$open_tag[1] = "[list=a]";

	// ordered.
	$text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');

	// [color] and [/color] for setting text color
	$text = preg_replace("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "[color=\\1:$uid]\\2[/color:$uid]", $text);

	// [size] and [/size] for setting text size
	$text = preg_replace("#\[size=([1-2]?[0-9])\](.*?)\[/size\]#si", "[size=\\1:$uid]\\2[/size:$uid]", $text);

	// [b] and [/b] for bolding text.
	$text = preg_replace("#\[b\](.*?)\[/b\]#si", "[b:$uid]\\1[/b:$uid]", $text);

	// [u] and [/u] for underlining text.
	$text = preg_replace("#\[u\](.*?)\[/u\]#si", "[u:$uid]\\1[/u:$uid]", $text);

	// [i] and [/i] for italicizing text.
	$text = preg_replace("#\[i\](.*?)\[/i\]#si", "[i:$uid]\\1[/i:$uid]", $text);

	// [img]image_url_here[/img] code..
	$text = preg_replace("#\[img\]((ht|f)tp://)([^\r\n\t<\"]*?)\[/img\]#sie", "'[img:$uid]\\1' . str_replace(' ', '%20', '\\3') . '[/img:$uid]'", $text);
        // bbcode_box Mod
        // [fade] and [/fade] for faded text.
		$text = preg_replace("#\[fade\](.*?)\[/fade\]#si", "[fade:$uid]\\1[/fade:$uid]", $text);
        // [align] and [/align]
        $text = preg_replace("#\[align=(left|right|center|justify)\](.*?)\[/align\]#si", "[align=\\1:$uid]\\2[/align:$uid]", $text);
        // [marq] and [/marq]
        $text = preg_replace("#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si", "[marq=\\1:$uid]\\2[/marq:$uid]", $text);
        // [table] and [/table]
        $text = preg_replace("#\[table=(.*?)\](.*?)\[/table\]#si", "[table=\\1:$uid]\\2[/table:$uid]", $text);
        // [cell] and [/cell]
        $text = preg_replace("#\[cell=(.*?)\](.*?)\[/cell\]#si", "[cell=\\1:$uid]\\2[/cell:$uid]", $text);
        // [font] and [/font]
        $text = preg_replace("#\[font=(.*?)\](.*?)\[/font\]#si", "[font=\\1:$uid]\\2[/font:$uid]", $text);
        // [poet] and [/poet]
        $text = preg_replace("#\[poet(.*?)\](.*?)\[/poet\]#si", "[poet\\1:$uid]\\2[/poet:$uid]", $text);
        // [real]and[/real]
        $text = preg_replace("#\[ram\](.*?)\[/ram\]#si", "[ram:$uid]\\1[/ram:$uid]", $text);
        // [stream]and[/stream]
        $text = preg_replace("#\[stream\](.*?)\[/stream\]#si", "[stream:$uid]\\1[/stream:$uid]", $text);
        // [web]and[/web]
        $text = preg_replace("#\[web\](http(s)?://)([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+)\[/web\]#si", "[web:$uid]\\1\\3[/web:$uid]", $text);
        //[flash width= heigth= loop=] and [/flash]
        $text = preg_replace("#\[flash width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/flash\]#si","[flash width=\\1 height=\\2:$uid\]\\3[/flash:$uid]", $text);
        //[video width= heigth=] and [/video]
        $text = preg_replace("#\[video width=([0-6]?[0-9]?[0-9]) height=([0-4]?[0-9]?[0-9])\](([a-z]+?)://([^, \n\r]+))\[\/video\]#si","[video width=\\1 height=\\2:$uid\]\\3[/video:$uid]", $text);
        // [hr]
        $text = preg_replace("#\[hr\]#si", "[hr:$uid]", $text);
        // bbcode_box Mod
	return $text;

}
function bbcode_array_push(&$stack, $value)
{
   $stack[] = $value;
   return(sizeof($stack));
}
function bbcode_array_pop(&$stack)
{
   $arrSize = count($stack);
   $x = 1;

   while(list($key, $val) = each($stack))
   {
      if($x < count($stack))
      {
                         $tmpArr[] = $val;
      }
      else
      {
                         $return_val = $val;
      }
      $x++;
   }
   $stack = $tmpArr;

   return($return_val);
}
function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false)
{
	$open_tag_count = 0;

	if (!$close_tag_new || ($close_tag_new == ''))
	{
		$close_tag_new = $close_tag;
	}

	$close_tag_length = strlen($close_tag);
	$close_tag_new_length = strlen($close_tag_new);
	$uid_length = strlen($uid);

	$use_function_pointer = ($func && ($func != ''));

	$stack = array();

	if (is_array($open_tag))
	{
		if (0 == count($open_tag))
		{
			// No opening tags to match, so return.
			return $text;
		}
		$open_tag_count = count($open_tag);
	}
	else
	{
		// only one opening tag. make it into a 1-element array.
		$open_tag_temp = $open_tag;
		$open_tag = array();
		$open_tag[0] = $open_tag_temp;
		$open_tag_count = 1;
	}

	$open_is_regexp = false;

	if ($open_regexp_replace)
	{
		$open_is_regexp = true;
		if (!is_array($open_regexp_replace))
		{
			$open_regexp_temp = $open_regexp_replace;
			$open_regexp_replace = array();
			$open_regexp_replace[0] = $open_regexp_temp;
		}
	}

	if ($mark_lowest_level && $open_is_regexp)
	{
		die("Unsupported operation for bbcode_first_pass_pda().");
	}

	// Start at the 2nd char of the string, looking for opening tags.
	$curr_pos = 1;
	while ($curr_pos && ($curr_pos < strlen($text)))
	{
		$curr_pos = strpos($text, "[", $curr_pos);

		// If not found, $curr_pos will be 0, and the loop will end.
		if ($curr_pos)
		{
			// We found a [. It starts at $curr_pos.
			// check if it's a starting or ending tag.
			$found_start = false;
			$which_start_tag = "";
			$start_tag_index = -1;

			for ($i = 0; $i < $open_tag_count; $i++)
			{
				// Grab everything until the first "]"...
				$possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);

				//
				// We're going to try and catch usernames with "[' characters.
				//
				if( preg_match('#\[quote=\\\"#si', $possible_start, $match) && !preg_match('#\[quote=\\\"(.*?)\\\"\]#si', $possible_start) )
				{
					// OK we are in a quote tag that probably contains a ] bracket.
					// Grab a bit more of the string to hopefully get all of it..
					if ($close_pos = strpos($text, '"]', $curr_pos + 9))
					{
						$possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 2);
					}
				}

				// Now compare, either using regexp or not.
				if ($open_is_regexp)
				{
					$match_result = array();
					if (preg_match($open_tag[$i], $possible_start, $match_result))
					{
						$found_start = true;
						$which_start_tag = $match_result[0];
						$start_tag_index = $i;
						break;
					}
				}
				else
				{
					// straightforward string comparison.
					if (0 == strcasecmp($open_tag[$i], $possible_start))
					{
						$found_start = true;
						$which_start_tag = $open_tag[$i];
						$start_tag_index = $i;
						break;
					}
				}
			}

			if ($found_start)
			{
				// We have an opening tag.
				// Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
				$match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
				bbcode_array_push($stack, $match);
				//
				// Rather than just increment $curr_pos
				// Set it to the ending of the tag we just found
				// Keeps error in nested tag from breaking out
				// of table structure..
				//
				$curr_pos += strlen($possible_start);
			}
			else
			{
				// check for a closing tag..
				$possible_end = substr($text, $curr_pos, $close_tag_length);
				if (0 == strcasecmp($close_tag, $possible_end))
				{
					// We have an ending tag.
					// Check if we've already found a matching starting tag.
					if (sizeof($stack) > 0)
					{
						// There exists a starting tag.
						$curr_nesting_depth = sizeof($stack);
						// We need to do 2 replacements now.
						$match = bbcode_array_pop($stack);
						$start_index = $match['pos'];
						$start_tag = $match['tag'];
						$start_length = strlen($start_tag);
						$start_tag_index = $match['index'];

						if ($open_is_regexp)
						{
							$start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
						}

						// everything before the opening tag.
						$before_start_tag = substr($text, 0, $start_index);

						// everything after the opening tag, but before the closing tag.
						$between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

						// Run the given function on the text between the tags..
						if ($use_function_pointer)
						{
							$between_tags = $func($between_tags, $uid);
						}

						// everything after the closing tag.
						$after_end_tag = substr($text, $curr_pos + $close_tag_length);

						// Mark the lowest nesting level if needed.
						if ($mark_lowest_level && ($curr_nesting_depth == 1))
						{
							if ($open_tag[0] == '[code]')
							{
								$code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
								$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
								$between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
							}
							$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
							$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
						}
						else
						{
							if ($open_tag[0] == '[code]')
							{
								$text = $before_start_tag . '&#91;code&#93;';
								$text .= $between_tags . '&#91;/code&#93;';
							}
							else
							{
								if ($open_is_regexp)
								{
									$text = $before_start_tag . $start_tag;
								}
								else
								{
									$text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
								}
								$text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
							}
						}

						$text .= $after_end_tag;

						// Now.. we've screwed up the indices by changing the length of the string.
						// So, if there's anything in the stack, we want to resume searching just after it.
						// otherwise, we go back to the start.
						if (sizeof($stack) > 0)
						{
							$match = bbcode_array_pop($stack);
							$curr_pos = $match['pos'];
//							bbcode_array_push($stack, $match);
//							++$curr_pos;
						}
						else
						{
							$curr_pos = 1;
						}
					}
					else
					{
						// No matching start tag found. Increment pos, keep going.
						++$curr_pos;
					}
				}
				else
				{
					// No starting tag or ending tag.. Increment pos, keep looping.,
					++$curr_pos;
				}
			}
		}
	} // while

	return $text;

} // bbencode_first_pass_pda()

/**
 * Does second-pass bbencoding of the [code] tags. This includes
 * running htmlspecialchars() over the text contained between
 * any pair of [code] tags that are at the first level of
 * nesting. Tags at the first level of nesting are indicated
 * by this format: [code:1:$uid] ... [/code:1:$uid]
 * Other tags are in this format: [code:$uid] ... [/code:$uid]
 */
function bbencode_second_pass_code($text, $uid, $bbcode_tpl)
{
	global $lang;

	$code_start_html = $bbcode_tpl['code_open'];
	$code_end_html =  $bbcode_tpl['code_close'];

	// First, do all the 1st-level matches. These need an htmlspecialchars() run,
	// so they have to be handled differently.
	$match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);

	for ($i = 0; $i < $match_count; $i++)
	{
		$before_replace = $matches[1][$i];
		$after_replace = $matches[1][$i];

		// Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
		$after_replace = str_replace("  ", "&nbsp; ", $after_replace);
		// now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
		$after_replace = str_replace("  ", " &nbsp;", $after_replace);

		// Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
		$after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

		$str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";

		$replacement = $code_start_html;
		$replacement .= $after_replace;
		$replacement .= $code_end_html;

		$text = str_replace($str_to_match, $replacement, $text);
	}

	// Now, do all the non-first-level matches. These are simple.
	$text = str_replace("[code:$uid]", $code_start_html, $text);
	$text = str_replace("[/code:$uid]", $code_end_html, $text);

	return $text;

} // bbencode_second_pass_code()


function make_bbcode_uid()
{
	// Unique ID for this message..
	define("BBCODE_UID_LEN", "10");
	$uid = md5(mt_rand());
	$uid = substr($uid, 0, 10);

	return $uid;
}

?>
