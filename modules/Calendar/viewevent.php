<br />
<?php

/************************************************************************/
/* Calendar                                                           */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Bill Smith                                     */
/* http://www.vettesofthetropics.com                                    */
/*                                                                      */
/* Based on Web Calendar                                                */
/* Copyright (c) 2001 by Proverbs, LLC                                  */
/* http://www.proverbs.biz                                              */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
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

/*
 *  ©2001 Proverbs, LLC. All rights reserved.
 *
 *  This program is free software; you can redistribute it and/or modify it withthe following stipulations:
 *  Changes or modifications must retain all Copyright statements, including, but not limited to the Copyright statement
 *  and Proverbs, LLC homepage link provided at the bottom of this page.
 */

   @require_once("modules/$module_name/printevent.php");
   @require_once("modules/$module_name/dbaccess.inc.php");
   @require_once("modules/$module_name/datefuncs.php");
   get_lang($module_name);

   if (!isset($month) || $month == "" || $month > 12 || $month < 1)
   {
      $month = date("m");
   }
   if (!isset($year) || $year == "" || $year < 1972 || $year > 2036)
   {
      $year = date("Y");
   }
   if (!isset($day) || $day == "")
   {
      $day = date("d");
   }

   if (!checkdate($month, $day, $year))
   {
      $month = date("m");
      $year = date("Y");
      $day = date("d");
   }
   $dayofweek = date("w", mktime(0, 0, 0, $month, $day, $year));

   global $db, $user_prefix;
   $sql = "";
   $sql = "SELECT * FROM ".$user_prefix."_calendar_events WHERE id='$eventid'";

   $eventresult = $db->sql_query($sql);
   $event = $db->sql_fetchrow($eventresult);

   if (isset($printing)) {
	echo'<html><head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<meta name="index" content="no">
		<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<title>'._VIEW_MONTH_TITLE.'</title>
		<body>';
   }
?>
<table width="75%" border="0" align="center" cellpadding="5" cellspacing="0">
<tr><td>
<?php
	PrintEventDateHeader($month, $day, $year);
	echo PrintEvent($event, $month, $day, $year);
?>	
	<br /> <hr>
<?php
	if (isset($printing) || $printing == 1)
		$showprintlink = 0;
	else
		$showprintlink = 1;

	PrintEventFooter("ShowDay", $month, $day, $year, $eventid, $showprintlink, "ShowEvent", _VIEW_DAY_VIEW_DAY);
?>
</td>

</tr>
</table>
<?php
        if (isset($printing)) {
		echo "</head></html>";
	}
?>