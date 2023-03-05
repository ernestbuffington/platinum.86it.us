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

//
// Pick a language, any language ...
//

if (!defined('IN_PHPBB')) {
	die();
}

function language_select($default, $select_name = "language", $dirname="modules/Forums/language")
{
        global $phpEx;

        $dir = @opendir($dirname);

        $lang = array();
        while ( $file = @readdir($dir) )
        {
                if ( preg_match("/^lang_/", $file) && !is_file($dirname . "/" . $file) && !is_link($dirname . "/" . $file) )
                {
                        $filename = trim(str_replace("lang_", "", $file));
                        $displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
                        $displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
                        $lang[$displayname] = $filename;
                }
        }

        @closedir($dir);

        @asort($lang);
        @reset($lang);

        $lang_select = '<select name="' . $select_name . '">';
        while ( list($displayname, $filename) = @each($lang) )
        {
                $selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
                $lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
        }
        $lang_select .= '</select>';

        return $lang_select;
}

//
// Pick a template/theme combo,
//
function style_select($default_style, $select_name = "style", $dirname = "templates")
{
        global $db;

        $sql = "SELECT themes_id, style_name
                FROM " . THEMES_TABLE . "
                ORDER BY template_name, themes_id";
        if ( !($result = $db->sql_query($sql)) )
        {
                message_die(GENERAL_ERROR, "Couldn't query themes table", "", __LINE__, __FILE__, $sql);
        }

        $style_select = '<select name="' . $select_name . '">';
        while ( $row = $db->sql_fetchrow($result) )
        {
                $selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';

                
                $style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
        }
        $style_select .= "</select>";

        return $style_select;
}

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone')
{
        global $sys_timezone, $lang;

        if ( !isset($default) )
        {
                $default == $sys_timezone;
        }
        $tz_select = '<select name="' . $select_name . '">';

        while( list($offset, $zone) = @each($lang['tz']) )
        {
                $selected = ( $offset == $default ) ? ' selected="selected"' : '';
                $tz_select .= '<option value="' . $offset . '"' . $selected . '>' . $zone . '</option>';
        }
        $tz_select .= '</select>';

        return $tz_select;
}

?>
