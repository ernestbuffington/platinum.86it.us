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
//FLV PLayer Code

$embedcode = "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" width=\"".$row['width']."\" height=\"".$row['height']."\" id=\"flvplayer\" align=\"middle\">\n";
$embedcode .= "<param name=\"FlashVars\" value=\"url=".$row['url']."\" />\n";
$embedcode .= "<param name=\"movie\" value=\"modules/Video_Stream/plugins/flvplayer.swf\" />\n";
$embedcode .= "<param name=\"quality\" value=\"high\" />\n";
$embedcode .= "<param name=\"bgcolor\" value=\"#ffffff\" />\n";
$embedcode .= "<embed src=\"modules/Video_Stream/plugins/flvplayer.swf\" FlasVars=\"url=".$row['url']."\" quality=\"high\" bgcolor=\"#ffffff\" width=\"".$row['width']."\" height=\"".$row['height']."\" name=\"flvplayer\" align=\"middle\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />\n";
$embedcode .= "</object>\n";
?>