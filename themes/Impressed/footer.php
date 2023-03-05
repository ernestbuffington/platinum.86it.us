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

if (stristr($_SERVER['SCRIPT_NAME'], "footer.php")) {
    die ("Access Denied");
}
echo"<table id=\"Table_01\" width=\"100%\" height=\"150\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
echo"	<tr>\n";
echo"		<td rowspan=\"4\">\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_01.gif\" width=\"38\" height=\"150\" alt=\"\"></td>\n";
echo"		<td rowspan=\"3\">\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_02.gif\" width=\"173\" height=\"130\" alt=\"\"></td>\n";
echo"		<td rowspan=\"4\" background=\"themes/Impressed/images/footer/lfs.gif\" width=\"50%\" height=\"150\" alt=\"\"></td>\n";
echo"		<td>\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_04.gif\" width=\"467\" height=\"36\" alt=\"\"></td>\n";
echo"		<td rowspan=\"4\" background=\"themes/Impressed/images/footer/rfs.gif\" width=\"50%\" height=\"150\" alt=\"\"></td>\n";
echo"		<td rowspan=\"3\">\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_06.gif\" width=\"194\" height=\"130\" alt=\"\"></td>\n";
echo"		<td rowspan=\"4\">\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_07.gif\" width=\"23\" height=\"150\" alt=\"\"></td>\n";
echo"	</tr>\n";
echo"	<tr>\n";
echo"		<td align=\"center\" valign=\"top\" background=\"themes/Impressed/images/footer/message.gif\" width=\"467\" height=\"93\" alt=\"\">\n";    
echo"$showbanners<br /><font class=copyright>\n";
footmsg();
echo "  </td>\n";
echo"	</tr>\n";
echo"	<tr>\n";
echo"		<td rowspan=\"2\">\n";
echo"			<a href=\"http://platinumnukepro.com\">\n";
echo"				<img src=\"themes/Impressed/images/footer/hd-copy-2_08.gif\" width=\"467\" height=\"21\" border=\"0\" alt=\"\"></a></td>\n";
echo"	</tr>\n";
echo"	<tr>\n";
echo"		<td>\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_10.gif\" width=\"173\" height=\"20\" alt=\"\"></td>\n";
echo"		<td>\n";
echo"			<img src=\"themes/Impressed/images/footer/footer_11.gif\" width=\"194\" height=\"20\" alt=\"\"></td>\n";
echo"	</tr>\n";
echo"</table>\n";
?>