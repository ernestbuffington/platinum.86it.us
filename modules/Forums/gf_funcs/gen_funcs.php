<?php
/***************************************************************************
 *                                gen_funcs.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://arcade.portedmods.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

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

if (!defined('IN_PHPBB')) {
	die('Hacking attempt');
}

function get_var_gf($variable) {
		global $_GET, $_POST ;



		$var = $variable['name'] ;

		$$var = ( isset($variable['default']) ) ? $variable['default'] : '' ;
		$method = ( isset($variable['method']) ) ? $variable['method'] : '' ;
		$default = ( isset($variable['default']) ) ? $variable['default'] : '' ;

		switch($method) {
				case 'POST':
					$$var = (isset($_POST[$var])) ? $_POST[$var] : $default;
					break;

				case 'GET' :
					$$var = (isset($_GET[$var])) ? $_GET[$var] : $default;
					break;

				default:
					if(isset($_POST[$var]) || isset($_GET[$var]))
					{
							$$var = (isset($_POST[$var])) ? $_POST[$var] : $_GET[$var];
					}
		}

		if ( isset($variable['intval']) and $variable['intval']) {
				$$var = intval($$var);
		}

		if ( isset($variable['okvar']) ) {
				if ( !in_array($$var,$variable['okvar']) ) {
						$$var = $default ;
				}
		}

		return $$var ;
}

function strip_htmlchars($t="") {
		$t = preg_replace("/&(?!#[0-9]+;)/s", '&amp;', $t );
		$t = str_replace( "<", "&lt;"  , $t );
		$t = str_replace( ">", "&gt;"  , $t );
		$t = str_replace( '"', "&quot;", $t );
	
		return $t;
}
	
function add_htmlchars($t="") {
		$t = str_replace( "&lt;"  , "<", $t );
		$t = str_replace( "&gt;"  , ">", $t );
		$t = str_replace( "&quot;", '"', $t );
		$t = str_replace( "&amp;" , "&", $t );

		return $t;
}

?>
