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

@require_once("mainfile.php");

function PrevDay(&$month, &$day, &$year)
{

   $day -= 1;
   if ($day == 0) {
   		
		$month -= 1;	
		
		if ($month == 0) {
			$month = 12;
			$year -= 1;
		}
		
		if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
			$day = 31;
		} else if ($month == 2) {
			$day = 28;
		} else {
			$day = 30;
		}
   }
}

function NextDay(&$month, &$day, &$year)
{
	$day += 1;
    $maxday = 30;
   	if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
		$maxday = 31;
	} else if ($month == 2) {
		$maxday = 28;
	} 
	
	if ($day > $maxday) {
		$month += 1;
		$day = 1;
		
		if ($month == 13) {
			$month = 1;
			$year += 1;
		}
	}
}

function DotWForFirstDay($month, $year)
{
	return DotWForDate($month, 1, $year);
}

function DotWForDate($month, $day, $year)
{
	 return date("w", mktime(0, 0, 0, $month, $day, $year));
}

function NumDaysInMonth($month, $year)
{
	 $lastday = 28;
  
   	for ($i=$lastday;$i<32;$i++)
   	{
      		if (checkdate($month, $i, $year))
      		{
        		 $lastday = $i;
      		}
   	}

	return $lastday;
}

function NumDotWInMonth($dotw, $month, $year)
{
	$numDotW = 0;	
	for ($x = 1; $x < NumDaysInMonth($month, $year)+1; $x++) {
		if ($dotw == DotwForDate($month, $x, $year)) {
			$numDotW++;
		}
	}
	return $numDotW;
}

function PrintEventDateHeader($month, $day, $year)
{
	$prevday = $day;
   	$prevmonth = $month;
   	$prevyear = $year;

   	PrevDay($prevmonth, $prevday, $prevyear);

   	$nextday = $day;
   	$nextmonth = $month;
   	$nextyear = $year;

   	NextDay($nextmonth, $nextday, $nextyear);


	$today = GetMonthDayYearText($month, $day, $year);
	$backward = GetMonthDayYearText($prevmonth, $prevday, $prevyear);
	$forward = GetMonthDayYearText($nextmonth, $nextday, $nextyear);

	echo "<td width=\"100%\">";
        echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\"  width=\"100%\">";
        echo "<tr>";
        echo "<td width=\"20%\" align=\"left\"><a href=modules.php?name=Calendar&op=ShowDay&day=".$prevday."&month=".$prevmonth."&year=".$prevyear.">".$backward."</a></td>";
        echo "<td width=\"60%\" align=\"center\"><strong>".$today."</strong></td>";
        
        echo "<td width=\"20%\" align=\"right\"><a href=modules.php?name=Calendar&op=ShowDay&day=".$nextday."&month=".$nextmonth."&year=".$nextyear.">".$forward."</a></td>";
        echo "</tr>";
        echo "</table>";
}

function GetMonthDayYearText($month, $day, $year)
{
	global $db, $user_prefix, $currentlang;

	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");
	$row = $db->sql_fetchrow($result);


	if ($row[show_mdy]) {
		$rtnVal = GetMonthName($month);


		if ($currentlang == "english")
			$formater = " jS Y";
		else
			$formater = " j Y";
		$rtnVal .= date($formater, mktime(0, 0, 0, $month, $day, $year));	
	} else {
		 if ($currentlang == "english")
                        $formater = "jS";
                else
                        $formater = "j";
		$rtnVal = date($formater, mktime(0, 0, 0, $month, $day, $year));
		$rtnVal .= " " . GetMonthName($month) . " ";
		$rtnVal .= date("Y", mktime(0, 0, 0, $month, $day, $year));
	}

	return $rtnVal;
}

function GetMonthYearText($month, $year) 
{
        $rtnVal = GetMonthName($month);
        $rtnVal .= date(" Y", mktime(0, 0, 0, $month, 1, $year));
        return $rtnVal;
}

function GetMonthDayText($month, $day)
{

	global $db, $user_prefix;

        $result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE
1");
        $row = $db->sql_fetchrow($result);

        if ($row[show_mdy]) {
                $rtnVal = $month . "/" . $day;
        } else {
                $rtnVal = $day . "/" . $month;
        }
        return $rtnVal;
}

function GetMonthName($month)
{
	$rtnVal = "";
	if ($month == -1) {
		$rtnVal = date("m");
	} else {
		$rtnVal = date("F", mktime(0, 0, 0, $month, 1, 0));
	}

	// php's date func always seems to return month names in english....
	$rtnVal = preg_replace("/January/", _JANUARY, $rtnVal);
	$rtnVal = preg_replace("/February/", _FEBRUARY, $rtnVal);
	$rtnVal = preg_replace("/March/", _MARCH, $rtnVal);
	$rtnVal = preg_replace("/April/", _APRIL, $rtnVal);
	$rtnVal = preg_replace("/May/", _MAY, $rtnVal);
	$rtnVal = preg_replace("/June/", _JUNE, $rtnVal);
	$rtnVal = preg_replace("/July/", _JULY, $rtnVal);
	$rtnVal = preg_replace("/August/", _AUGUST, $rtnVal);
	$rtnVal = preg_replace("/September/", _SEPTEMBER, $rtnVal);
	$rtnVal = preg_replace("/October/", _OCTOBER, $rtnVal);
	$rtnVal = preg_replace("/November/", _NOVEMBER, $rtnVal);
	$rtnVal = preg_replace("/December/", _DECEMBER, $rtnVal); 

	return $rtnVal;
}

function MilitaryTo12Hour($miltime)
{
	list($hour, $min, $sec) = preg_split("/:/", $miltime);

	$pm = FALSE;
	if ($hour > 11) {
		$pm = TRUE;
		if ($hour == 24) {
			$pm = FALSE;
			$hour = 12;
		} else if ($hour == 12) {
			$hour = 12;
			$pm = TRUE;
		} else {
			$hour -= 12;
		}
	} else if ($hour == 0) {
		$hour = 12;
		$pm = FALSE;
	}

	$rtnVal = $hour . ":" . $min;
	if ($pm == 1)
		$rtnVal .= " " . _VIEW_DAY_PM;
	else
		$rtnVal .= " " . _VIEW_DAY_AM;

	return $rtnVal;
}

function MilitaryTo12HourDuration($miltime)
{
	list($hour, $min, $sec) = preg_split("/:/", $miltime);

	if ($hour == 24) {
		$rtnVal = _VIEW_DAY_ALL_DAY;
	} else {
		$rtnVal = $hour . " " . _VIEW_DAY_HOURS;
		$rtnVal .= " " . $min . " " . _VIEW_DAY_MINUTES;
	}

	return $rtnVal;
}

function MilitaryTimeIsPM($miltime)
{
	list($hour, $min, $sec) = preg_split("/:/", $miltime);

	$rtnVal = FALSE;
	if ($hour > 11) {
                $rtnVal = TRUE;
                if ($hour == 24) {
                        $rtnVal = FALSE;
                } 
        } else if ($hour == 0) {
                $pm = FALSE;
        }

	return $rtnVal;
}

function MilitaryTimeGetHour($miltime)
{
        list($hour, $min, $sec) = preg_split("/:/", $miltime);

	$pm = FALSE;
        if ($hour > 11) {
                if ($hour == 24) {
                        $hour = 12;
                } else if ($hour == 12) {
                        $hour = 12;
                } else {
                        $hour -= 12;
                }
        } else if ($hour == 0) {
                $hour = 12;
        }
	return $hour;
}

function MilitaryTimeGetMinute($miltime)
{
	list($hour, $min, $sec) = preg_split("/:/", $miltime);

	return $min;
}

function TimeToMilitaryTime($hour, $min, $pm)
{
	if ($pm == 1) {
		if ($hour < 12)
			$hour += 12;
	} else {
		if ($hour == 12)
			$hour = 24;
	}

	return $hour . ":" . $min;
}
?>
