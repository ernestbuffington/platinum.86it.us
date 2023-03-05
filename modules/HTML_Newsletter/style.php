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

if ( !defined('MSNL_LOADED') and !defined('BLOCK_FILE') and !defined('NUKE_FILE') ) {
	die('Illegal File Access');
}

/************************************************************************
* Define style array values
************************************************************************/

unset( $msnl_asCSS );
$msnl_asCSS = array();	//Used for style settings used throughout the module

$msnl_asCSS['BLOCK_center']	= 'style="text-align:center"';
$msnl_asCSS['BLOCK_right']	= 'style="text-align:right"';
$msnl_asCSS['IMG_hlp']			= 'style="cursor:help;border:0px"';
$msnl_asCSS['IMG_def']			= 'style="border:0px"';
$msnl_asCSS['TABLE_lay']		= 'style="border:0px;padding:2px;width:100%"';
$msnl_asCSS['TABLE_adm']		= 'style="border:0px;padding:2px;spacing:4px"';
$msnl_asCSS['TABLE_data']		= 'style="border:0px;padding:2px;background-color:'.$bgcolor2.';width:100%"';
$msnl_asCSS['TR_hdr']				= 'style="font-weight:bold;background-color:'.$bgcolor2.';text-align:center;white-space:nowrap"';
$msnl_asCSS['TR_rows']			= 'style="background-color:'.$bgcolor1.';vertical-align:top"';
$msnl_asCSS['TR_top']				= 'style="vertical-align:top"';
$msnl_asCSS['TR_bottom']		= 'style="vertical-align:bottom"';
$msnl_asCSS['TD_2col50']		= 'style="width:50%"';
$msnl_asCSS['TD_left_nw']		= 'style="text-align:left;white-space:nowrap"';
$msnl_asCSS['TD_center_nw']	= 'style="text-align:center;white-space:nowrap"';
$msnl_asCSS['TD_right_nw']	= 'style="text-align:right;white-space:nowrap"';
$msnl_asCSS['TD_hdr_adm']		= 'style="font-weight:bold;text-align:left;white-space:nowrap;background-color:'.$bgcolor2.'"';

?>