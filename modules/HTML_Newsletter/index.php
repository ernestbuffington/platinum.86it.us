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
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright © 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright © 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    01.03.02
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
/************************************************************************
* Rev Date      Change ID       Description
* -----------   --------------  -----------------------------------------
* 18-MAY-2006   RN_0000185      Make XHTML 1.0 Compliant, plus better use of quotes
************************************************************************/

/************************************************************************
* Ensure that the module is not being called directly and then set up
* application level define that is used throughout the module to ensure
* no script is called outside of THIS index.php script.
************************************************************************/

if ( !defined('MODULE_FILE') ) { die("You can't access this file directly..."); }

define('MSNL_LOADED', true);
define('NW_HNL_LOADED', true);	//This is here for compatibility purposes with v1.2 newsletters

$msnl_sModuleNm	= 'HTML_Newsletter';	//If you change the module directory, change every instance of this definition

/************************************************************************
* Initialize and assign key module variables.
************************************************************************/

global $msnl_sModuleNm, $index, $msnl_gasModCfg;

@require_once( 'modules/'.$msnl_sModuleNm.'/functions.php' );
@require_once( 'modules/'.$msnl_sModuleNm.'/config.php' );
@include_once( 'modules/'.$msnl_sModuleNm.'/style.php' );

if ( $msnl_gasModCfg['show_blocks'] == 1 ) {

	$index = 1; //Here for compatibility with patches below 3.1
	define('INDEX_FILE', true); //Here for a nuke patched 3.1+

} else {

	$index = 0;

}

@require_once( 'mainfile.php' );

/************************************************************************
* Main "switch" code to control what the module is to do
************************************************************************/
if (!isset($op)) $op = '';
switch( $op ) {

	case 'msnl_nls_view':
		@include_once( 'modules/'.$msnl_sModuleNm.'/nls_view.php' );
		break;

	case 'msnl_copyright_credits':
		@include_once( 'modules/'.$msnl_sModuleNm.'/copyright_credits.php' );
		break;

	default:
		@include_once( 'modules/'.$msnl_sModuleNm.'/nls_list.php' );
		break;

}

?>
