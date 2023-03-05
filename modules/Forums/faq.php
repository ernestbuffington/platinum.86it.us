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

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require_once("modules/".$module_name."/nukebb.php");

define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_FAQ, $nukeuser);
init_userprefs($userdata);
//
// End session management
//
// Set vars to prevent naughtiness
$faq = array();
//
// Load the appropriate faq file
//
if( isset($_GET['mode']) )
{
        switch( $_GET['mode'] )
        {
                case 'bbcode':
                        $lang_file = 'lang_bbcode';
                        $l_title = $lang['BBCode_guide'];
                        break;
                case 'rules':
                      $lang_file = 'lang_rules';
                      $l_title = $lang['Rules'];
                      break;
                default:
                        $lang_file = 'lang_faq';
                        $l_title = $lang['FAQ'];
                        break;
        }
}
else
{
        $lang_file = 'lang_faq';
        $l_title = $lang['FAQ'];
}
include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $lang_file . '.' . $phpEx);

attach_faq_include_once($lang_file);

//
// Pull the array data from the lang pack
//
$j = 0;
$counter = 0;
$counter_2 = 0;
$faq_block = array();
$faq_block_titles = array();

for($i = 0; $i < count($faq); $i++)
{
        if( $faq[$i][0] != '--' )
        {
                $faq_block[$j][$counter]['id'] = $counter_2;
                $faq_block[$j][$counter]['question'] = $faq[$i][0];
                $faq_block[$j][$counter]['answer'] = $faq[$i][1];

                $counter++;
                $counter_2++;
        }
        else
        {
                $j = ( $counter != 0 ) ? $j + 1 : 0;

                $faq_block_titles[$j] = $faq[$i][1];

                $counter = 0;
        }
}

//
// Lets build a page ...
//
$page_title = $l_title;
include_once("includes/page_header.php");

$template->set_filenames(array(
        'body' => 'faq_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
        'L_FAQ_TITLE' => $l_title,
        'L_BACK_TO_TOP' => $lang['Back_to_top'])
);

for($i = 0; $i < count($faq_block); $i++)
{
        if( count($faq_block[$i]) )
        {
                $template->assign_block_vars('faq_block', array(
                        'BLOCK_TITLE' => $faq_block_titles[$i])
                );
                $template->assign_block_vars('faq_block_link', array(
                        'BLOCK_TITLE' => $faq_block_titles[$i])
                );

                for($j = 0; $j < count($faq_block[$i]); $j++)
                {
                        $row_color = ( !($j % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
                        $row_class = ( !($j % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

                        $template->assign_block_vars('faq_block.faq_row', array(
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'FAQ_QUESTION' => $faq_block[$i][$j]['question'],
                                'FAQ_ANSWER' => $faq_block[$i][$j]['answer'],

                                'U_FAQ_ID' => $faq_block[$i][$j]['id'])
                        );

                        $template->assign_block_vars('faq_block_link.faq_row_link', array(
                                'ROW_COLOR' => '#' . $row_color,
                                'ROW_CLASS' => $row_class,
                                'FAQ_LINK' => $faq_block[$i][$j]['question'],

                                'U_FAQ_LINK' => '#' . $faq_block[$i][$j]['id'])
                        );
                }
        }
}

$template->pparse('body');

include_once("includes/page_tail.php");

?>
