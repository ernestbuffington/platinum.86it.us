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
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on PHP-Nuke Platinum   */
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

/*
 *  ©2001 Proverbs, LLC. All rights reserved.
 *
 *  This program is free software; you can redistribute it and/or modify it withthe following stipulations:
 *  Changes or modifications must retain all Copyright statements, including, but not limited to the Copyright statement
 *  and Proverbs, LLC homepage link provided at the bottom of this page.
 */

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Month_of_Events_2.php")) {
    Header("Location: ../index.html");
    die();
}

require_once("modules/Calendar/dbaccess.inc.php");
require_once("modules/Calendar/datefuncs.php");
require_once("modules/Calendar/printevent.php");
get_lang("Calendar");

function MakeDayLink($fmonth, $fday, $fyear, $color)
{
	 $rtnVal = "<a href=calendar-showday-" . $fday . "-" . $fmonth . "-". $fyear . ".html".">";
	       $rtnVal .= "<font color=" . $color . ">";
         $rtnVal .=  $fday . "</font></a>";

	return $rtnVal;

}

function AddDayBlock2($fdotw, $fday, $fmonth, $fyear)
{
	$thisday=date("d");
	$rtnVal = "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">";

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

$content = "<table width=100% border=0><tr><td width=5% align=left><a href=calendar-" . $prev_month . "-" . $prev_year . ".html" . "><</a></td>";
$content .= "<td width=100%><center><strong>" .  GetMonthName($month) . " " . $year ."</strong></center></td>";
$content .= "<td width=5% align=right><a href=calendar-" . $next_month . "-" . $next_year . ".html" . ">></a></td></tr></table>";
$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  width=\"100%\">";
$content .= "<tr>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_SUNDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_MONDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_TUESDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_WEDNESDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_THURSDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_FRIDAY_SHORT."</TD>";
$content .= "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\">"._VIEW_MONTH_SATURDAY_SHORT."</TD>";
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
      $content .= "<TR>";
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
               //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
               $content .= AddDayBlock2($j, $calday, $month, $year);
	       $content .= "</td>";
               $calday++;
            }
         }
      }
      $content .= "</TR><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
   }



$content .= "</table>";

?>