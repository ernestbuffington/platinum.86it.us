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

if (stristr($_SERVER['SCRIPT_NAME'], "block-GT_Month_of_Events.php")) {
    Header("Location: ../index.html");
    die();
}

require_once("modules/Calendar/dbaccess.inc.php");
require_once("modules/Calendar/datefuncs.php");
require_once("modules/Calendar/printevent.php");
get_lang("Calendar");

function FillDayBlock($fdotw, $fday, $fmonth, $fyear)
{
 	$rtnVal = "<br><center><a href=calendar-showday-" . $fday . "-" . $fmonth . "-". $fyear . ".html"."><img border=0 src=images/";

        $numEvents = Calendar_NumEventsOn($fmonth, $fday, $fyear, $fdotw);
        if ($numEvents == 0)
                $rtnVal .= "red_dot.gif";
        else
                $rtnVal .= "green_dot.gif";

        $rtnVal .= "></a></center>";

        return $rtnVal;

}

function AddDayBlock($fday, $fmonth, $fyear)
{
	$rtnVal = "<TD nowrap align=\"center\" valign=\"middle\" width=\"15%\"><a href=calendar-showday-" . $fday . "-" . $fmonth . "-". $fyear . ".html".">". $fday . "</a>";

	return $rtnVal;
}

   $month = date("m");
   $month = date("m");
   $year = date("Y");
   $first = date("w", mktime(0, 0, 0, $month, 1, $year));

$content = "<center><strong>" .  GetMonthName($month) . "</strong></center><br>";
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
               $content .= AddDayBlock($calday, $month, $year);
               //@RJR-Pwmg@Rncvkpwo@-@Eqratkijv@(e)@VgejIHZ.eqo
	       $content .=  FillDayBlock($j, $calday, $month, $year);
	       $content .= "</td>";
               $calday++;
            }
            else
	    {
               $content .= AddDayBlock('', '', '');
	       $content .= "</td>";
            }
         }
         else
         {
            if ($calday > $lastday)
            {
               $content .= AddDayBlock('', '', '');
	       $content .= "</td>";
            }
            else
            {
               $content .= AddDayBlock($calday, $month, $year);
	       $content .= FillDayBlock( $j, $calday, $month, $year); 
	       $content .= "</td>";
               $calday++;
            }
         }
      }
      $content .= "</TR><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
   }



$content .= "</table>";

?>