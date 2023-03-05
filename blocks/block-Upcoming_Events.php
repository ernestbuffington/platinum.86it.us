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
$content = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  width=\"100%\">";
	$numFound = 0;
	$numDaysTested = 0;
    	$ulmonth = date("m");
	$ulmonth++;
	$ulmonth--;
    	$ulyear = date("Y");
    	$ulday = date("d");
	$ulday++;
	$ulday--;
	global $dbi, $user_prefix;
	$caloptions = sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1", $dbi);
	$caloptionrow = sql_fetch_array($caloptions, $dbi);
	$maxFound = $caloptionrow[show_n_events];
	$maxDaysTested = $caloptionrow[in_n_days];
	function DisplayEventsCategory($myrow)
	{
		global $user_prefix, $dbi;
		$result = sql_query("SELECT * FROM ".$user_prefix."_calendar_categories WHERE id='$myrow[categoryid]'", $dbi);
		$rtnVal = 0;
		$catrow = sql_fetch_array($result, $dbi);
		return $catrow[showinblock];
	}
	function DisplayInfo($ulmonth, $ulday, $ulyear, $myrow) 
	{
		$rtnVal = "";
		$rtnVal .= "<tr><td width=\"30%\" valign=\"top\">"
		. "<font size=1>" . GetMonthDayText($ulmonth, $ulday) . "</font>&nbsp;&nbsp;&nbsp;"
		. "</td><td width=\"70%\">"
		. "<font size=1>" . PrintShortEvent($myrow, $ulmonth, $ulday, $ulyear)."</font>"
		. "</td></tr>";
		return $rtnVal;
	}
	while ($numFound  < $maxFound  && $numDaysTested < $maxDaysTested) {
		$uldayofweek = date("w", mktime(0, 0, 0, $ulmonth, $ulday, $ulyear));
		if ($caloptionrow[show_bydate_in_block] == 1) {
			$resultID = Calendar_GetByDate($ulmonth, $ulday, $ulyear);
			if ($resultID) {
				$nr = sql_num_rows($resultID, $dbi);
      				for ($k=0;$k<$nr;$k++)
      				{
					$myrow = sql_fetch_array($resultID, $dbi);
					if ($numFound < $maxFound) {
						if (DisplayEventsCategory($myrow)) {
                                
         						$content.= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
							$numFound++;
						}
					}
      				}
			}
		}
		if ($caloptionrow[show_yearly_in_block] == 1) {
			$resultID = Calendar_GetYearly($ulmonth, $ulday);
			if ($resultID) {
	                        $nr = sql_num_rows($resultID, $dbi);
                        	for ($k=0;$k<$nr;$k++)
                	        {
        	                        $myrow = sql_fetch_array($resultID, $dbi);
	                                if ($numFound < $maxFound) {
						if (DisplayEventsCategory($myrow)) {
                                	        	$content.= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
							$numFound++;
						}
                	                }
        	                }
	                }
		}
		if ($caloptionrow[show_yearly_recurring_in_block] == 1) {
			$resultID  = Calendar_GetYearlyRecurring($ulmonth, $uldayofweek);
			if ($resultID) {
                	        $nr = sql_num_rows($resultID, $dbi);
                        	for ($k=0;$k<$nr;$k++)
	                        {
        	                        $myrow = sql_fetch_array($resultID, $dbi);
					$test = $ulday / 7;
        		                $period = $myrow[recur_period];
	                	        if ($period == 5)
                                		$period = NumDotWInMonth($uldayofweek, $ulmonth, $ulyear);
	                        	$periodlow = $period - 1;
        	        	        if ($test <= $period && $test > $periodlow) {
						if ($numFound < $maxFound) {
                                                        if (DisplayEventsCategory($myrow)) {                                    
                                                                $content .= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
                                                                $numFound += 1;
                                                        }
                                                }
	                	        } else if ($period == 5 && $test >= 4  && $day+7 < NumDaysInMonth($month, $year)) {
                        	         	if ($test <= ($period-1) && $test > ($periodlow-1)) {
							if ($numFound < $maxFound) {
                                                        	if (DisplayEventsCategory($myrow)) { 
                                                                	$content .= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
                                                                	$numFound += 1;
								}
                                                        }
                                                }
		                        }
			        }
                        }
                }
		if ($caloptionrow[show_monthly_in_block] == 1) {
			$resultID = Calendar_GetMonthly($ulday);
			if ($resultID) {
                	        $nr = sql_num_rows($resultID, $dbi);
                        	for ($k=0;$k<$nr;$k++)
	                        {
        	                        $myrow = sql_fetch_array($resultID, $dbi);
                	                if ($numFound < $maxFound) {
						if (DisplayEventsCategory($myrow)) {
                        	                	$content.= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
							$numFound++;
						}
                                	}
				}
                        }
                }
		if ($caloptionrow[show_monthly_recurring_in_block] == 1) {
		      	$resultID = Calendar_GetMonthlyRecurring($uldayofweek);
			if ($resultID) {
                	        $nr = sql_num_rows($resultID, $dbi);
                        	for ($k=0;$k<$nr;$k++)
	                        {
        	                        $myrow = sql_fetch_array($resultID, $dbi);
					$period = $myrow[recur_period];
                        		if ($period == 5)
                                		$period = NumDotWInMonth($uldayofweek, $ulmonth, $ulyear);
					$test = $ulday / 7;
				        $periodlow = $period - 1;
			        	if ($test <= $period && $test > $periodlow)
			        	{
          					if ($numFound < $maxFound) {
							if (DisplayEventsCategory($myrow)) {
								$content.= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
             							$numFound += 1;
							}
						}
             				}
          			}
                        }
                }
		if ($caloptionrow[show_weekly_in_block] == 1) {
			$resultID = Calendar_GetWeekly($uldayofweek);
			if ($resultID) {
                	        $nr = sql_num_rows($resultID, $dbi);
                        	for ($k=0;$k<$nr;$k++)
	                        {
        	                        $myrow = sql_fetch_array($resultID, $dbi);
                	                if ($numFound < $maxFound) {
						if (DisplayEventsCategory($myrow)) {
                        	                	$content.= DisplayInfo($ulmonth, $ulday, $ulyear, $myrow);
							$numFound++;
						}
					}
                                }
                        }
                }
		NextDay($ulmonth, $ulday, $ulyear);
		$numDaysTested += 1;
	}
$content .= "</table>";
?>
