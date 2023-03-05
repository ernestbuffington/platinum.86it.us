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
function FillDayBlock($fdotw, $fday, $fmonth, $fyear)
{
 	$rtnVal = "<br /><center><a href=modules.php?name=Calendar&op=ShowDay&day=" . $fday . "&month=" . $fmonth . "&year=". $fyear . "><img border=0 src=images/";
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
	$rtnVal = "<td nowrap align=\"center\" valign=\"middle\" width=\"15%\"><a href=modules.php?name=Calendar&op=ShowDay&day=" . $fday . "&month=" . $fmonth . "&year=". $fyear . ">". $fday . "</a>";
	return $rtnVal;
}
   $month = date("m");
   $month = date("m");
   $year = date("Y");
   $first = date("w", mktime(0, 0, 0, $month, 1, $year));
$content = "<center><strong>" .  GetMonthName($month) . "</strong></center><br />";
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
               $content .= AddDayBlock($calday, $month, $year);
               
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
      $content .= "</tr><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
   }
$content .= "</table>";
?>
