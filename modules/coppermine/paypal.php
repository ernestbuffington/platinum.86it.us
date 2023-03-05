<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.1D for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
/**********************************/
/*  Module Configuration          */
/* (right side on)                */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
define('INDEX_FILE', true);
require("modules/" . $name . "/include/load.inc");
pageheader($BREADCRUMB_TEXT ? $BREADCRUMB_TEXT : $lang_index_php['welcome']);
$title = _SELECTLANGUAGE;
starttable('100%', 'Do you need help on more space for your Galleries? - <a href="modules.php?name=Feedback" target="new">Contact Us</a> ');
?>
<div align="center">
<table width="82%" cellspacing="2" cellpadding="2" border="0">
<tr><td><center><br>
<h3>Photo Gallery Upgrade Plans</h3></center>
</td>
</tr>
</table>
<table width="88%" cellspacing="2" cellpadding="2" border="1">
<tr>
    <td><strong>Photo Galley - 50MB Extra Space: </strong><br>The stated costs is per individual account upgrade, priced yearly.</td>
    <td><strong>$15.00 yearly</strong></td>
    <td>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but24.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="email@mysite.com">
<input type="hidden" name="item_name" value="Gallery Upgrade - 50mb">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.mysite.com">
<input type="hidden" name="cancel_return" value="http://www.mysite.com">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="a3" value="15.00">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="Y">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
</form>
	</td>
</tr>
<tr>
    <td><strong>Photo Galley - 100MB Extra Space: </strong><br>The stated costs is per individual account upgrade, priced yearly.</td>
    <td><strong>$25.00 yearly</strong></td>
    <td>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but24.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="email@mysite.com">
<input type="hidden" name="item_name" value="Gallery Upgrade - 100mb">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.mysite.com">
<input type="hidden" name="cancel_return" value="http://www.mysite.com">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="a3" value="25.00">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="Y">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
</form>
	</td>
</tr>
<tr>
    <td><strong>Photo Galley - 200MB Extra Space: </strong><br>The stated costs is per individual account upgrade, priced yearly.</td>
    <td><strong>$38.00 yearly</strong></td>
    <td>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but24.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="email@mysite.com">
<input type="hidden" name="item_name" value="Gallery Upgrade - 200mb">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.mysite.com">
<input type="hidden" name="cancel_return" value="http://www.mysite.com">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="a3" value="38.00">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="Y">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
</form>
	</td>
</tr>
<tr>
    <td><strong>Photo Galley - 300MB Extra Space: </strong><br>The stated costs is per individual account upgrade, priced yearly.</td>
    <td><strong>$50.00 yearly</strong></td>
    <td>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but24.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="email@mysite.com">
<input type="hidden" name="item_name" value="Gallery Upgrade - 300mb">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://www.mysite.com">
<input type="hidden" name="cancel_return" value="http://www.mysite.com">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="a3" value="50.00">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="Y">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
</form>
	</td>
</tr>
<tr>
    <td><strong>To Unsubscibe from Gallery services</strong></td>
    <td>&nbsp;</td>
    <td>
	<A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=pcnuke%40pcnuke.com">
<IMG SRC="https://www.paypal.com/en_US/i/btn/cancel_subscribe_gen.gif" BORDER="0">
</td>
</tr>
</table>
<br>
<table width="80%" cellspacing="2" cellpadding="2" border="0">
<tr><td><div align="left">
<strong>Notes: </strong><font size="3">  Please allow 24 - 48 hrs for all processing before contacting!</font><br>
<strong>Gallery Upgrade Plans: </strong><font size="3">  These plans are based on the members chosen Storage Plan, Priced per year, and are automatically renewed annually. 
If you have questions about upgrade programs, please <a href="modules.php?name=Feedback" target="new"><strong>Contact Us</strong></a>.</div>
<br>
</font>
</div>
</td>
</tr>
</table>
<br><br>
<div align="center">
<font size="-1"><font color="#000000">
All Payment are Processed through PayPal - Don't have an account?<br>
Sign up now, it's Fast, Free, & Secure..<br>
<a name="paypal" id="paypal" href="http://www.paypal.com/at/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-at.gif" alt="" width="29" height="19" border="0"></a> &nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/be/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-be.gif" alt="" width="29" height="19" border="0"></a> &nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com" title="paypal" target="new">
<img src="modules/coppermine/images/flag-us.gif" alt="" width="29" height="18" border="0"></a>&nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/fr/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-fr.gif" alt="" width="29" height="19" border="0"></a>&nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/de/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-de.gif" alt="" width="29" height="19" border="0"></a> &nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/uk/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-uk.gif" alt="" width="29" height="19" border="0"></a> &nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/nl/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-nl.gif" alt="" width="29" height="19" border="0"></a> &nbsp;&nbsp;
<a name="paypal" id="paypal" href="http://www.paypal.com/ch/" title="paypal" target="new">
<img src="modules/coppermine/images/flag-ch.gif" alt="" width="28" height="28" border="0"></a>
</font></font>
</div>
</div>
<br><br>
<?php
pagefooter();
endtable();
?>
