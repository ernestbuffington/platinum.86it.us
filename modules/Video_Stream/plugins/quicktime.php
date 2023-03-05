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
if (!preg_match("/modules.php/i", $_SERVER['SCRIPT_NAME'])) {
	die ("You can't access this file directly...");
}
// Quicktime plugin
$embedcode = "<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" width=\"".$row['width']."\" height=\"".$row['height']."\" CODEBASE=\"http://www.apple.com/qtactivex/qtplugin.cab\">\n";
$embedcode .= "<param name=\"SRC\" VALUE=\"".$row['url']."\">\n";
$embedcode .= "<param name=\"AUTOPLAY\" VALUE=\"true\">\n";
$embedcode .= "<param name=\"CONTROLLER\" VALUE=\"true\">\n";
$embedcode .= "<embed src=\"".$row['url']."\" width=\"".$row['width']."\" height=\"".$row['height']."\" autoplay=\"true\" controller=\"true\" PLUGINSPAGE=\"http://www.apple.com/quicktime/download/\"></EMBED>\n";
$embedcode .= "</object>\n";
?>