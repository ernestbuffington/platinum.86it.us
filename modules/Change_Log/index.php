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
//  Config 
$module_path = "http://platinumnukepro.com"; // Module folder path NO TRAILING BACKSLASH!
$file = "changelog.txt"; // File to load with this module
//  End Config 

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include_once("header.php");
print "<div align=\"center\"><font size=\"-7\" color=\"$textcolor1\"></div>"; 
OpenTable();
echo""
  . "<table width=100% border=0 cellspacing=0 cellpadding=2 height=100%> "
  . "<tr><td><table width=\"100%\" border=0 cellspacing=0 cellpadding=0\" height=\"100%\"><tr><td> "
  . "<center><strong>Platinum Nuke Pro 76v1.0.0 Change Log:</strong></center><br /> "
  . "<hr>"
  . "<center><iframe id=1 name=\"portal\" src=$module_path/$file width=\"100%\" scrolling=\"auto\" height=\"800\" frameborder=\"0\"></iframe> "
  . "</center></td></tr></table></td></tr></table> ";
CloseTable();
include_once("footer.php");

?>