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
/* Copyright (c) 2007 - 2012 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/* dbi layer conversion by DocHaVoC022211DM                                                                             */
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
if ( !defined('MODULE_FILE') )
{
    die("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
require_once("mainfile.php");
require_once("modules/$module_name/datefuncs.php");
require_once("modules/$module_name/printevent.php");
require_once("modules/$module_name/dbaccess.inc.php");


$index = 0;

function ShowMonthlyView($month, $year, $printing) 
{
	global $module_name;
	if (!isset($printing)) {
    		include_once("header.php");
    		title("$sitename: "._VIEW_MONTH_TITLE."");
    		OpenTable();
	}
    	include_once("modules/$module_name/viewmonth.php");
	if (!isset($printing)) {
    		CloseTable();
    		include_once("footer.php");
	}
}

function ShowDayView($month, $day, $year, $printing) 
{
	global $module_name;
	if (!isset($printing)) {
		include_once("header.php");
        title("$sitename: "._VIEW_MONTH_TITLE."");
		OpenTable();
	}
	include_once("modules/$module_name/viewday.php");
	if (!isset($printing)) {
		CloseTable();
		include_once("footer.php");
	}
}

function ShowEventView($eventid, $month, $day, $year, $recurring_event, $printing)
{
	global $module_name;
        if (!isset($printing)) {
                include_once("header.php");
    		    title("$sitename: "._VIEW_MONTH_TITLE."");
                OpenTable();
        }
        include_once("modules/$module_name/viewevent.php");
        if (!isset($printing)) {
                CloseTable();
                include_once("footer.php");
        }
}

function PostUserSubmitEvent()
{
	global $db, $user_prefix;
    
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");
	$row = $db->sql_fetchrow($result);
	if ($row[user_submitted_events_need_admin_aproval]) {
		include_once('header.php');
   		title("$sitename: "._VIEW_MONTH_TITLE."");
    		OpenTable();
    		echo "<center><font class=\"title\">"._SUBSENT."</font><br /><br />"
        	."<font class=\"content\"><strong>"._THANKSSUB."</strong><br /><br />"
        	.""._SUBTEXT;
    		CloseTable();
    		include_once('footer.php');
	} else {
		header("Location: modules.php?name=Calendar");
	}
}

switch($op) {

    case "ShowMonth":
    default:
    ShowMonthlyView($month, $year, $printing);
    break;
    
    case "ShowDay":
    ShowDayView($month, $day, $year, $printing); 
    break;

    case "ShowEvent":
    ShowEventView($eventid, $month, $day, $year, $recurring_event, $printing);
    break;

    case "SubmitEvent":
    include_once("header.php");
    title("$sitename: "._SUBMIT_EVENT_INFO."");
    OpenTable();
    ShowEventForm("modules.php?name=Calendar&op=AddEvent", "", "", "Submit Event", "1");
    CloseTable();
    include_once("footer.php");
	csrf_check();	
    break;

    case "AddEvent":
	
	$onetime_date = $year."-".$month."-".$day;

	Calendar_User_Insert_Row($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month);
	PostUserSubmitEvent();
	csrf_check();	
    break;
}

?>
