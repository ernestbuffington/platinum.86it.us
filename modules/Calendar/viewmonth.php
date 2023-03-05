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

   @require_once("modules/$module_name/dbaccess.inc.php");
   @require_once("modules/$module_name/printevent.php");
   get_lang($module_name);

   if (!isset($day) || $day = "" || $day > 31 || $day < 1) {
	$day = date("d");
   }

   if (!isset($month) || $month == "" || $month > 12 || $month < 1)
   {
      $month = date("m");
   }
   if (!isset($year) || $year == "" || $year < 1972 || $year > 2036)
   {
      $year = date("Y");
   }

   $timestamp = mktime(0, 0, 0, $month, 1, $year);
   
   $current = GetMonthName($month) . " " . $year;

   if ($month < 2)
   {
      $prevmonth = 12;
      $prevyear = $year - 1;
   }
   else
   {
      $prevmonth = $month - 1;
      $prevyear = $year;
   }

   if ($month > 11)
   {
      $nextmonth = 1;
      $nextyear = $year + 1;
   }
   else
   {
      $nextmonth = $month + 1;
      $nextyear = $year;
   }

   $backward = GetMonthName($prevmonth) . " " . $prevyear;
   $forward = GetMonthName($nextmonth) . " " . $nextyear;

   $first =  DotWForFirstDay($month, $year);
   
   $lastday = NumDaysInMonth($month, $year);
   
   
   function AddDay($fday, $fmonth, $fyear, $fvar, $colors)
   {
      if (!isset($fday) || $fday == "")
      {
         echo '	<td class="calendar" align="left" valign="top" width="14%" height=70>
		&nbsp;
';
      }
      else
      {
         $schurl = 'modules.php?name=Calendar&op=ShowDay&day='.$fday.'&month='.$fmonth.'&year='.$fyear;
         echo '<a href='.$schurl.'>';
         if (date("m") == $fmonth && date("Y") == $fyear && date("j") == $fday)
         {
            echo '	<td ID="day'.$fday.'" border=2 align=left bgcolor=#'.$colors[month_today_color].'  style="cursor: hand" align="left" valign="top" width="14%" height=70 
		onMouseOver="tdmouseover(\'day'.$fday.'\')"; onMouseOut="tdcurmouseout(\'day'.$fday.'\')";">
';
         }
         else
         {
//            echo '';
//              <td ID="day'.$fday.'" class="otherday" style="cursor: hand" align="left" valign="top" width="14%" height=70 
//		onMouseOver="tdmouseover(\'day'.$fday.'\')"; onMouseOut="tdmouseout(\'day'.$fday.'\')";">
//';
			echo '	<td ID="day'.$fday.'" align=left bgcolor=#'.$colors[month_day_color].' style="cursor: hand" align="left" valign="top" width="14%" height=70 
		onMouseOver="tdmouseover(\'day'.$fday.'\')"; onMouseOut="tdmouseout(\'day'.$fday.'\')";">
';

         }
         echo '		<strong><a href=' . $schurl . '>' .$fday.'</a></strong><br />
';
         if (isset($fvar) && $fvar != "")
         {
         
//            echo '<a class=\'calendar\' style="cursor: hand" onClick=document.open("' .$schurl . '");">';
         
//            echo '		<a class=\'calendar\' style="cursor: hand" onClick="javascript:document.open(\''.$schurl.'\');">
//';
            echo '		'.$fvar;
//		</a>';
         }
      }
      echo '	</td></a>
';
   }

   function FillDay($dayofweek, $dayofmonth, $thismonth, $thisyear)
   {
      	$textbody = '';
	$events = Calendar_GetAllEventsOn($thismonth, $dayofmonth, $thisyear, $dayofweek);

        foreach ($events as $event) {
                $textbody .= "<li>" . PrintShortEvent($event, $thismonth, $dayofmonth, $thisyear).'</li>';

        } 

      return $textbody;
   }

	global $db, $user_prefix;

	if (isset($printing)) {
		echo'<html><head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<meta name="index" content="no">
			<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
			<title>'.$caloptionsrow[calendar_title].'</title>
			<body>';
	}

	$caloptions = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");
        $caloptionsrow = $db->sql_fetchrow($caloptions);


	echo '
	<script language="JavaScript">
	<!-- 
		var isIE;
		isIE = (document.all) ? true : false;

		function tdmouseover(itemID)
		{
		   if(isIE)
		   {
		      var theObj = eval("document.all." + itemID);
			
		      theObj.style.backgroundColor = \'#'.$caloptionsrow[month_hover_color].'\';
		   }
		}

		function tdmouseout(itemID)
		{
		   if(isIE)
		   {
		      var theObj = eval("document.all." + itemID);

		      theObj.style.backgroundColor = \'#'.$caloptionsrow[month_day_color].'\';
		   }
		}
		
		function tdcurmouseout(itemID)
		{
		   if(isIE)
		   {
		      var theObj = eval("document.all." + itemID);

		      theObj.style.backgroundColor = \'#'.$caloptionsrow[month_today_color].'\';
		   }
		}
	//-->
	        </script>
';

    
	echo '<br />
<table width="95%" border="1" align="center" cellpadding="5" cellspacing="0">
	<tr>
	<p>
	<p>
	<td class="form" align="center" valign="bottom" width="100%" colspan=7>
		<form method="post" action="modules.php?name=Calendar">
		<table cellspacing=0 cellpadding=0 width="100%" border=0>
		<tr>
		<td class="form" align="left" valign="bottom">
			<strong>'._VIEW_MONTH_TODAYS_DATE.'</strong> '. GetMonthDayYearText($month, $day, $year).'
		</td>
		<td class="form" align="left" valign="bottom">
			<strong>'._VIEW_MONTH_MONTH.'</strong> <select name="month">
';
			for ($j=1;$j<=12;$j++)
			{
			   echo'<option value='.$j;
			   if ($month == $j)
			   {
			      echo ' selected';
			   }
			   echo '>'.GetMonthName($j).'
			   ';
			}
			echo '			</select>			
		         &nbsp;&nbsp;<strong>'._VIEW_MONTH_YEAR.'</strong> <select name="year">
';
			for ($j=2003;$j<=2036;$j++)
			{
			   echo'<option value='.$j;
			   if ($year == $j)
			   {
			      echo ' selected';
			   }
			   echo '>'.$j.'
			   ';
			}
			echo '			</select>
			 &nbsp;&nbsp;<input type="submit" value="'._VIEW_MONTH_GOTO_MONTH.'">			
		    </select></td>
		<td class="form" align="right" valign="bottom">';

		PrintSubmitEventLink();

            echo '<br />
            ';
            
            if (!isset($printing))
            	echo '<a href="#" onClick=window.open("modules.php?name=Calendar&printing=1&day=' . $day . '&month=' . $month . '&year=' . $year . '","ec_window_11190874","width=800,height=600,resizable=yes,scrollbars=1,toolbar=1");>'._PRINTER_FRIENDLY_VERSION.'</a>';
       echo'</td>
		</tr>
		</table>
		</form>
	</td>	
	</tr>
	<tr>
	<td align="center" valign="middle" height=60 COLSPAN=7>
		<table cellspacing=0 cellpadding=0 width="100%" border=0>
		<tr>
		<td class="ends" nowrap align="center" valign="bottom">
			<a href="modules.php?name=Calendar&month='.$prevmonth.'&year='.$prevyear.'">'.$backward.'</a>
		</td>
		<td class="top" nowrap align="center" valign="middle" width="100%">
';
   if ($caloptionsrow[calendar_title_image] != "") {
	echo "<img src=".$caloptionsrow[calendar_title_image]."></br>";
   } 
   echo $caloptionsrow[calendar_title];

   echo '<br />'.$current.'
		</td>
		<td class="ends" nowrap align="center" valign="bottom">
			<a href="modules.php?name=Calendar&month='.$nextmonth.'&year='.$nextyear.'">'.$forward.'</a>
		</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
	<td class="days" nowrap align="center" valign="middle" width="15%" height=40>
	'._VIEW_MONTH_SUNDAY.'	
	</td>
	<td class="days" nowrap align="center" valign="middle" width="14%" height=40>
	'._VIEW_MONTH_MONDAY.'	
	</td>
	<td class="days" nowrap align="center" valign="middle" width="14%" height=40>
	'._VIEW_MONTH_TUESDAY.'
	</td>
	<td class="days" nowrap align="center" valign="middle" width="14%" height=40>
	'._VIEW_MONTH_WEDNESDAY.'		
	</td>
	<td class="days" nowrap align="center" valign="middle" width="14%" height=40>
	'._VIEW_MONTH_THURSDAY.'
	</td>
	<td class="days" nowrap align="center" valign="middle" width="14%" height=40>
	'._VIEW_MONTH_FRIDAY.'	
	</td>
	<td class="days" nowrap align="center" valign="middle" width="15%" height=40>
	'._VIEW_MONTH_SATURDAY.'	
	</td>
	</tr>
';
   $calday = 1;
   while ($calday <= $lastday)
   {
      echo '<tr>';
      for ($j=0;$j<7;$j++)
      {
         if ($calday == 1)
         {
            if ($first == $j)
            {
               $info = FillDay($j, $calday, $month, $year);
               AddDay($calday, $month, $year, $info, $caloptionsrow);
               $calday++;
            }
            else
            {
               AddDay('', '', '', '', $caloptionsrow);
            }
         }
         else
         {
            if ($calday > $lastday)
            {
               AddDay('', '', '', '', $caloptionsrow);
            }
            else
            {
               $info = FillDay( $j, $calday, $month, $year);
               AddDay($calday, $month, $year, $info, $caloptionsrow);
               $calday++;
            }
         }
      }
      echo '</tr>';
   }
   echo '</table>';

if (isset($printing)) {
	echo'</body></html>';
}


?>
