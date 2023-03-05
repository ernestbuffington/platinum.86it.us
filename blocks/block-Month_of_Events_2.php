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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
require_once("modules/Calendar/dbaccess.inc.php");
require_once("modules/Calendar/datefuncs.php");
require_once("modules/Calendar/printevent.php");
get_lang("Calendar");
function MakeDayLink($fmonth, $fday, $fyear, $color)
{
	 $rtnVal = "<a href=modules.php?name=Calendar&op=ShowDay&day="
 . $fday . "&month=" . $fmonth . "&year=". $fyear . ">";
         $rtnVal .= "<font color=" . $color . ">";
         $rtnVal .=  $fday . "</font></a>";
	return $rtnVal;
}
function AddDayBlock2($fdotw, $fday, $fmonth, $fyear)
{
	$thisday=date("d");
	$rtnVal = "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">";
 	$numEvents = Calendar_NumEventsOn($fmonth, $fday, $fyear, $fdotw);
	if ($fday == $thisday) {
		$rtnVal .= MakeDayLink($fmonth, $fday, $fyear, "#0f0fff");
	} else if ($numEvents > 0) {
		$rtnVal .= MakeDayLink($fmonth, $fday, $fyear, "#cc0000");
	} else {
                $rtnVal .= $fday;
	}
	$rtnVal .= "</td>";
	return $rtnVal;
}
   $month = date("m");
   $month = date("m");
   $year = date("Y");
   $first = date("w", mktime(0, 0, 0, $month, 1, $year));
   $prev_month = $month-1;
   $prev_year = $year;
   if ($month == 1) {
	$prev_month = 12;
	$prev_year--;
   }
   $next_month = $month+1;
   $next_year = $year;
   if ($month == 12) {
	$next_month = 1;
	$next_year++;
   }
$content = "<table width=100% border=0><tr><td width=5% align=left><a href=modules.php?name=Calendar&month=" . $prev_month . "&year=" . $prev_year . ">&lt;</a></td>";
$content .= "<td width=100%><center><strong>" .  GetMonthName($month) . " " . $year ."</strong></center></td>";
$content .= "<td width=5% align=right><a href=modules.php?name=Calendar&month=" . $next_month . "&year=" . $next_year . ">&gt;</a></td></tr></table>";
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  width=\"100%\">";
$content .= "<tr>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_SUNDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_MONDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_TUESDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_WEDNESDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_THURSDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_FRIDAY_SHORT."</td>";
$content .= "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_SATURDAY_SHORT."</td>";
$content .= "</tr>";
$content .= "<tr><td colspan=7><hr></td></tr>";
   $lastday = 28;
   for ($i=$lastday;$i<32;$i++)
   {
      if (checkdate($month, $i, $year))
      {
         $lastday = $i;
      }
   }
   $calday = 1;
   while ($calday <= $lastday)
   {
      $content .= "<tr>";
      for ($j=0;$j<7;$j++)
      {
         if ($calday == 1)
         {
            if ($first == $j)
            {
               $content .= AddDayBlock2($j, $calday, $month, $year);
	       $content .= "</td>";
               $calday++;
            }
            else
	    {
               $content .= AddDayBlock2('', '', '', '');
	       $content .= "</td>";
            }
         }
         else
         {
            if ($calday > $lastday)
            {
               $content .= AddDayBlock2('', '', '', '');
	       $content .= "</td>";
            }
            else
            {
               
               $content .= AddDayBlock2($j, $calday, $month, $year);
	       $content .= "</td>";
               $calday++;
            }
         }
      }
      $content .= "</tr><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
   }
$content .= "</table>";
?>
