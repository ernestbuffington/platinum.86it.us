<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

$platinum_loc = "../..";
$platinum_mod = "Universal";
$platinum_url = "modules/$platinum_mod/images/admin";
$platinum_img = "$platinum_loc/$platinum_url/universal.gif";
get_lang($platinum_mod);

adminmenu("modules.php?name=Universal&amp;file=admin", ""._UNI_ADM_LNK."", "$platinum_img");

?>