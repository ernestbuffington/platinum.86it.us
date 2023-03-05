<?php

# $Author: ejd $
# $Date: 2004/2/7 12:25:00 $
/*******************************************************************************/
/* PHP-NUKE Addon : NukeAmazon Module                                          */
/* ==================================                                          */
/* Version: 2.7                                                                */
/* Copyright (c)2002-2004 by Edgardo J. Diaz (ejdiaz@preciogasolina.com)       */
/* http://preciogasolina.com                                                   */
/*                                                                             */
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

/********************************************************/
/* NSN Weather for PHP-Nuke 5.5.0-6.0.0                 */
/* By: NukeScripts Network (nukescripts@netzero.net)    */
/* http://www.nukescripts.net                           */
/* Copyright © 2002 by NukeScripts Network              */
/********************************************************/
global $AMZVer;
	echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	echo "<!--\n";
	echo "function creditwindow(){\n";
	echo "	window.open (\"modules/$module_name/credits.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=300\");\n";
	echo "}\n";
	echo "//-->\n";
	echo "</SCRIPT>\n\n";
	echo "<!-- eStore Powered by NukeAmazon v$AMZVer for PHP-Nuke  -->\n";
	echo "<!-- Get a FREE copy of this great store at http://preciogasolina.com/nukeamazon.html -->\n\n";

# NewWindow Java
	echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	echo "<!-- Original:  Eric King (eric_andrew_king@hotmail.com) -->\n";
	echo "<!-- Web Site:  http://redrival.com/eak/ -->\n";
	echo "\n";
	echo "<!-- Begin\n";
	echo "function NewWindow(mypage, myname, w, h, scroll) {\n";
	echo "var winl = (screen.width - w) / 2;\n";
	echo "var wint = (screen.height - h) / 2;\n";
	echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'\n";
	echo "win = window.open(mypage, myname, winprops)\n";
	echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
	echo "}\n";
	echo "//-->\n";
	echo "</script>\n\n";
?>