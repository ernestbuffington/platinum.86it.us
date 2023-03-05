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

if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}

$allowmodifyrequest = getconfigvar("allowmodifyrequest");

$optionbox .= "<br><img src=\"modules/$modulename/images/print.gif\" border=\"0\" alt=\""._PRINTER."\" title=\""._PRINTER."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a target=\"_blank\" href=\"modules.php?name=$modulename&amp;file=print&amp;sid=$vid\">"._PRINTER."</a><br><br>";
$optionbox .= "<img src=\"modules/$modulename/images/friend.gif\" border=\"0\" alt=\""._FRIEND."\" title=\""._FRIEND."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a href=\"javascript:friendwindow()\">"._FRIEND."</a>\n";
if ($allowmodifyrequest == 1) {
$optionbox .= "<br><br><center><a href=\"modules.php?name=$modulename&file=modify&id=$vid\">"._MODIFYITEM."</a></center>";
}
if (is_admin($admin)) {
    $optionbox .= "<center><br><strong>"._ADMIN."</strong><br>[ <a href=\"modules.php?name=$modulename&file=add\">"._ADD."</a> | <a href=\"modules.php?name=$modulename&file=admin&op=modifyitem&id=$vid\">"._EDIT."</a> | <a href=\"modules.php?name=$modulename&file=admin&op=DelItem&id=$vid\">"._DELETE."</a> ]</center>";
}

?>
