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

/* ©2001 Proverbs, LLC. All rights reserved. */ 

//    @require_once("mainfile.php");

	
    function Calendar_GetAllEventsOn($month, $day, $year, $dayofweek) 
    {
	global $db;
	$events = array();
	$resultID = Calendar_GetByDate($month, $day, $year);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
			array_push($events, $myrow);
                }
        }

	$resultID = Calendar_GetYearly($month, $day);
	if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
                        array_push($events, $myrow);
                }
        }

	$resultID = Calendar_GetYearlyRecurring($month, $dayofweek);
	if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
			$myrow = $db->sql_fetchrow($resultID);
                        $test = $day / 7;

                        $period = $myrow[recur_period];

                        if ($period == 5)
                                $period = NumDotWInMonth($dayofweek, $month, $year);

                        $periodlow = $period - 1;

                        if ($test <= $period && $test > $periodlow) {
                                array_push($events, $myrow);
                        } else if ($period == 5 && $test >= 4  && $day+7 < NumDaysInMonth($month, $year)) {
                                 if ($test <= ($period-1) && $test > ($periodlow -1)) {
                                        array_push($events, $myrow);
                                }
                        }
                }
        }

	$resultID = Calendar_GetMonthly($day);
	if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
                        array_push($events, $myrow);
                }
        }

	$resultID = Calendar_GetMonthlyRecurring($dayofweek);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
                        $test = $day / 7;

			$period = $myrow[recur_period];

			if ($period == 5)
				$period = NumDotWInMonth($dayofweek, $month, $year);

                        $periodlow = $period - 1;

                        if ($test <= $period && $test > $periodlow) {
				array_push($events, $myrow);
                        } else if ($period == 5 && $test >= 4  && $day+7 < NumDaysInMonth($month, $year)) {
				 if ($test <= ($period-1) && $test > ($periodlow-1)) {
                                	array_push($events, $myrow);
				}
			}
                }
        }

	$resultID = Calendar_GetWeekly($dayofweek);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
			array_push($events, $myrow);
                }
        }

	return $events;
    }

    function Calendar_NumEventsOn($month, $day, $year, $dayofweek)
    {
        global $db;
	$rtnVal = 0;
        $resultID = Calendar_GetByDate($month, $day, $year);
        if ($resultID) {
                $rtnVal += $db->sql_numrows($resultID);
        }

        $resultID = Calendar_GetYearly($month, $day);
        if ($resultID) {
                $rtnVal += $db->sql_numrows($resultID);
        }

        $resultID = Calendar_GetYearlyRecurring($month, $dayofweek);
        if ($resultID) {
		 $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
                        $test = $day / 7;

                        $period = $myrow[recur_period];

                        if ($period == 5)
                                $period = NumDotWInMonth($dayofweek, $month, $year);

                        $periodlow = $period - 1;

                        if ($test <= $period && $test > $periodlow) {
                                $rtnVal++;
                        } else if ($period == 5 && $test >= 4  && $day+7 < NumDaysInMonth($month, $year)) {
                                 if ($test <= ($period-1) && $test > ($periodlow -1)) {
                                        $rtnVal++;
                                }
                        }
                }
        }

        $resultID = Calendar_GetMonthly($day);
        if ($resultID) {
                $rtnVal += $db->sql_numrows($resultID);
        }
	
	$resultID = Calendar_GetMonthlyRecurring($dayofweek);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                for ($k=0;$k<$nr;$k++)
                {
                        $myrow = $db->sql_fetchrow($resultID);
                        $test = $day / 7;

                        $period = $myrow[recur_period];

                        if ($period == 5)
                                $period = NumDotWInMonth($dayofweek, $month, $year);

                        $periodlow = $period - 1;

                        if ($test <= $period && $test > $periodlow) {
				$rtnVal++;
                        } else if ($period == 5 && $test >= 4  && $day+7 < NumDaysInMonth($month, $year)) {
                                 if ($test <= ($period-1) && $test > ($periodlow -1)) {
					$rtnVal++;
                                }
                        }
                }
        }

        $resultID = Calendar_GetWeekly($dayofweek);
        if ($resultID) {
                $rtnVal += $db->sql_numrows($resultID);
        }

        return $rtnVal;
    }


    function Calendar_GetByDate($month, $day, $year, $otherwhere = "")
    {
	global $db, $user_prefix;
      $a     = $user_prefix."_calendar_events";
      $chkdate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
      $query = "SELECT * FROM ".$a." WHERE onetime_date='$chkdate' AND isactive=1 AND isapproved=1 AND isrecurring=0 $otherwhere ORDER BY starttime";
	$resultID = $db->sql_query($query);
	return $resultID;
    }
    
    function Calendar_GetYearly($month, $day, $otherwhere = "")
    {
	global $db, $user_prefix;

      $a     = $user_prefix."_calendar_events";
      $chkdate = date("2000-m-d", mktime(0, 0, 0, $month, $day, 0));
      $query = "SELECT * FROM $a WHERE onetime_date='$chkdate' AND isactive=1 AND isapproved=1 AND isrecurring=0 $otherwhere ORDER BY starttime";
      $resultID = $db->sql_query($query);
      return $resultID;
    }
    
    function Calendar_GetMonthly($day, $otherwhere = "")
    {
	global $db, $user_prefix;

      $a     = $user_prefix."_calendar_events";
      $chkdate = date("1900-00-d", mktime(0, 0, 0, 0, $day, 0));
      $query = "SELECT * FROM $a WHERE onetime_date='$chkdate' AND isactive=1 AND isapproved=1 AND isrecurring=1 $otherwhere ORDER BY starttime";
	$resultID = $db->sql_query($query);
        return $resultID;
    }

    function Calendar_GetWeekly($weekday, $otherwhere = "")
    {
	global $db, $user_prefix;

      $a     = $user_prefix."_calendar_events";
      $query = "SELECT * FROM $a WHERE recur_weekday=$weekday AND recur_schedule='weekly' AND isactive=1 AND isrecurring=1 AND isapproved=1 $otherwhere ORDER BY starttime";
	$resultID = $db->sql_query($query);
        return $resultID;
    }
    
    function Calendar_GetYearlyRecurring($month, $weekday, $otherwhere = "")
    {
	global $db, $user_prefix;

      $a     = $user_prefix."_calendar_events";
      $query = "SELECT * FROM $a WHERE recur_weekday=$weekday AND recur_schedule='yearly' AND recur_month=$month AND isactive=1 AND isrecurring=1 AND isapproved=1 $otherwhere ORDER BY starttime";
	$resultID = $db->sql_query($query);
        return $resultID;
    }
    
    function Calendar_GetMonthlyRecurring($weekday, $otherwhere = "")
    {
	global $db, $user_prefix;

      $a     = $user_prefix."_calendar_events";
      $query = "SELECT * FROM $a WHERE recur_weekday=$weekday AND recur_schedule='monthly' AND isactive=1 AND isrecurring=1 AND isapproved=1 $otherwhere ORDER BY starttime";
	$resultID = $db->sql_query($query);
        return $resultID;
    }

function Calendar_Insert_Row($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month)
{
        global $db, $user_prefix;

        $fulldesc = FixQuotes(filter_text($fulldesc));
        $location = FixQuotes(filter_text($location));
        $title = FixQuotes(filter_text($title));
	$starttime = TimeToMilitaryTime($start_hour, $start_min, $start_pm);
	$duration = $dur_hour . ":" . $dur_min;

        $query = "INSERT INTO ".$user_prefix."_calendar_events (title, location, fulldesc, starttime, duration, isactive, isrecurring, categoryid, isapproved, onetime_date, recur_weekday, recur_schedule, recur_period, recur_month) VALUES ('$title', '$location', '$fulldesc', '$starttime', '$duration', '$isactive', '$isrecurring', '$categoryid', '$isapproved', '$onetime_date', '$recur_weekday', '$recur_schedule', '$recur_period', '$recur_month')";

        //echo $query . "<br />";
        $resultID = $db->sql_query($query);

        return $resultID;
}

function Calendar_User_Insert_Row($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month)
{
        $isapproved = 0;
        global $db, $user_prefix;

        $result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");

        $row = $db->sql_fetchrow($result);

        if ($row[user_submitted_events_need_admin_aproval] == 0)
                $isapproved = 1;

        if ($row[allow_user_submitted_events] == 1) {

                Calendar_Insert_Row($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month);
        }
}

?>
