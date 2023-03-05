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
// Real PLayer Plugin
$embedcode = "<object id=\"RVOCX\" classid=\"clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA\" width=\"".$row['width']."\" height=\"".$row['height']."\">\n";
$embedcode .= "<param name=\"src\" value=\"".$row['url']."\">\n";
$embedcode .= "<param name=\"autostart\" value=\"true\">\n";
$embedcode .= "<param name=\"controls\" value=\"ImageWindow\">\n";
$embedcode .= "<param name=\"console\" value=\"video\">\n";
$embedcode .= "<param name=\"maintainaspect\" value=\"true\">\n";
$embedcode .= "<embed src=\"".$row['url']."?embed\" type=\"audio/x-pn-realaudio-plugin\" controls=\"ImageWindow\" width=\"".$row['width']."\" height=\"".$row['height']."\" nojava=\"true\" console=\"video\" autostart=\"true\" maintainaspect=\"true\" />\n";
$embedcode .= "</object>\n";
$embedcode .= "<br>\n";
$embedcode .= "<object id=\"RVOCX\" classid=\"clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA\" width=\"".$row['width']."\" height=\"36\">\n";
$embedcode .= "<param name=\"controls\" value=\"ControlPanel\">\n";
$embedcode .= "<param name=\"console\" value=\"video\">\n";
$embedcode .= "<embed src=\"".$row['url']."?embed\" type=\"audio/x-pn-realaudio-plugin\" controls=\"ControlPanel\" width=\"".$row['width']."\" height=\"36\" nojava=\"true\" console=\"video\" />\n";
$embedcode .= "</object>\n";
?>