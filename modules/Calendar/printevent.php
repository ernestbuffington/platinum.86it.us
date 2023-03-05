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


function PrintEventLink($op, $month, $day, $year, $row, $text)
{
	return "<a href=modules.php?name=Calendar&op=".$op."&month=".$month."&day=".$day."&year=".$year."&eventid=".$row[id].">".$text."</a>";

}

function PrintShortEvent($myrow, $month, $day, $year)
{
	return PrintEventLink("ShowEvent", $month, $day, $year, $myrow, $myrow[title]);
}

function PrintEvent($myrow, $month, $day, $year, $printtitlelink = 0)
{
	global $db, $bgcolor3, $bgcolor4, $user_prefix;

	$content = "";

	$content .= "<br /><hr><br /> ";  		
	$content .= "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
	$content .= "<tr>";
    	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"" . $bgcolor4 ."\">"._VIEW_DAY_EVENT."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor4."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor4."\">";
	if ($printtitlelink) {
		$content .= "<strong>" . PrintShortEvent($myrow, $month, $day, $year) . "</strong>";
	} else {
		$content .= $myrow[title];
	}
	$content .= "</td>";
	$content .= "</tr><tr>";
    	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"".$bgcolor3."\">"._VIEW_DAY_START_TIME."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor3."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor3."\">";
	$content .= MilitaryTo12Hour($myrow[starttime]);
    	$content .= "</td></tr><tr>";
	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"".$bgcolor4."\">"._VIEW_DAY_DURATION."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor4."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor4."\">";
    	$content .= MilitaryTo12HourDuration($myrow[duration]) . "</td>";
	
	$content .= "</tr><tr>";
    	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"".$bgcolor3."\">"._VIEW_DAY_LOCATION."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor3."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor3."\">".$myrow[location]."</td>";
	$content .= "</tr>";

	if ($printdate == 1) {
	  	$content .= "<tr>";
    		$content .= "<td width=\"150\" valign=\"top\">"._VIEW_DAY_DATE."</td>";
	    	$content .= "<td width=\"2%\">&nbsp;</td>";
    		$content .= "<td width=\"80%\" valign=\"top\">".$myrow[onetime_date]."</td></tr>";
	}

	$content .= "<tr>";
    	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"".$bgcolor4."\">"._VIEW_DAY_CATEGORY."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor4."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor4."\">";
	$catresult = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_categories WHERE id=".$myrow[categoryid]);	

	if ($catresult) {
		$catrow = $db->sql_fetchrow($catresult);
		$content .= $catrow[title]."<br /><br />".$catrow[description];
	} else {
		$content .= _VIEW_DAY_NO_CAT;
	}
    	$content .= "</td></tr><tr>";
    	$content .= "<td width=\"150\" valign=\"top\" bgcolor=\"".$bgcolor3."\">"._VIEW_DAY_OTHER_INFO."</td>";
	$content .= "<td width=\"2%\" bgcolor=\"".$bgcolor3."\">&nbsp;</td>";
    	$content .= "<td width=\"80%\" valign=\"top\" bgcolor=\"".$bgcolor3."\">".$myrow[fulldesc]."&nbsp;</td>";
	$content .= "</tr></table>";

	return $content;
}

function PrintEventFooter($op, $month, $day, $year, $eventid, $showprintlink, $printop, $linkup)
{
	echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
      	echo "<tr>";
        echo "<td width=\"17%\">";
	PrintSubmitEventLink();
        echo "</td>";
        echo "<td width=\"17%\">&nbsp;</td>";
        echo "<td width=\"16%\">";

	if ($showprintlink == 1) {
                echo "<a href=\"#\" onClick=window.open(\"modules.php?name=Calendar&op=".$printop."&month=".$month."&day=".$day."&year=".$year."&printing=1&eventid=".$eventid."\",\"ec_window_11190874\",\"width=800,height=600,resizable=yes,scrollbars=1,toolbar=1\")>"._PRINTER_FRIENDLY_VERSION."</a>";
	}
	echo "</td>";
        echo "<td width=\"17%\" align=\"right\">";
        echo "&nbsp;</td>";
        echo "<td width=\"17%\" align=\"right\">";
        echo "<a href=modules.php?name=Calendar&op=".$op."&month=".$month."&day=".$day."&year=".$year.">".$linkup."</a>";
        echo "</td>";
      	echo "</tr>";
    	echo "</table>";
}

function PrintSubmitEventLink()
{
	global $db, $user_prefix;
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");
        $row = $db->sql_fetchrow($result);
        if ($row[allow_user_submitted_events] == 1) {
		echo "<a href=modules.php?name=Calendar&op=SubmitEvent>"._SUBMIT_EVENT_INFO."</a>";
	}
}

function ShowEventForm($formaction, $mydatarow, $eventid, $formsubmitbutton, $onetimeevent = "", $month="", $day="", $year="", $formactiondelete="", $showapproved = 0)
{
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

   global $db, $user_prefix, $AllowableHTML;
?>

<form action="<?php echo $formaction; ?>" method="POST">
<table width="100%" cellspacing=0 border=0 cellpadding=0>
        <tr align="left">
                <td width="30%"></td>
                <td width="10"></td>
                <td width="70%"></td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _VIEW_DAY_EVENT; ?></td>
                <td width="10"></td>
                <td width="70%"><input type="text" name="title" value="<?php echo $mydatarow[title]; ?>" size=30></td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _VIEW_DAY_LOCATION; ?></td>
                <td width="10"></td>
                <td width="70%"><input type="text" name="location" value="<?php
echo $mydatarow[location]; ?>" size=30></td>
        </tr>
                <tr align="left">
                <td width="30%" valign="top"><?php echo _VIEW_DAY_OTHER_INFO; ?></td>
                <td width="10"></td>
                <td width="70%"><textarea rows="7" name="fulldesc" cols="45"><?php echo $mydatarow[fulldesc]; ?></textarea>
		<?php
			echo "<br /><font class=\"content\">"._ALLOWEDHTML."<br />";
    			while (list($key,) = each($AllowableHTML)) echo " &lt;".$key."&gt;";
		?>
        </tr>
                </td>
	<tr align="left">
                <td width="30%"><?php echo _VIEW_DAY_START_TIME; ?>:</td>
                <td width="10"></td>
                <td width="70%"><?php

			$hour =  MilitaryTimeGetHour($mydatarow[starttime]);
			$min = MilitaryTimeGetMinute($mydatarow[starttime]);
			$pm = MilitaryTimeIsPM($mydatarow[starttime]);

			echo "<select name=\"start_hour\">";
			for ($x = 1; $x <= 12; $x++) {
				echo "<option value=\"". $x . "\"";
				if ($x == $hour) {
					echo " selected";
				}
				if ($x == 12 && $hour == 0)
					echo " selected";

				echo ">" . $x . "</option>";
			}
			echo "</select>";
			echo ":";

			echo "<select name=\"start_min\">";
			for ($x = 00; $x <= 59; $x++) {
				$formatted_min = sprintf("%02d", $x);
                                echo "<option value=\"". $formatted_min . "\"";
                                if ($x == $min) {
                                        echo " selected";
                                }
                                echo ">" . $formatted_min . "</option>";
                        }
			echo "</select>";

			echo " <select name=\"start_pm\">";
			echo "<option value=0 ";
			if ($pm == 0)
				echo "selected";
			echo ">" . _VIEW_DAY_AM . "</option>";
			echo "<option value=1 ";
                        if ($pm == 1)
                                echo "selected";
                        echo ">" . _VIEW_DAY_PM . "</option>";
		?></td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _VIEW_DAY_DURATION;?>:</td>
                <td width="10"></td>
                <td width="70%"><?php

			list($hour, $min, $sec) = preg_split("/:/", $mydatarow[duration]);
			echo "<select name=\"dur_hour\">";
                        for ($x = 0; $x <= 24; $x++) {
                                echo "<option value=\"". $x . "\"";
                                if ($x == $hour) {
                                        echo " selected";
                                }
                                echo ">" . $x . "</option>";
                        }
                        echo "</select>";
                        echo _VIEW_DAY_HOURS . " ";

			echo "<select name=\"dur_min\">";
                        for ($x = 0; $x <= 59; $x++) {
                                echo "<option value=\"". $x . "\"";
                                if ($x == $min) {
                                        echo " selected";
                                }
                                echo ">" . $x . "</option>";
                        }
                        echo "</select>";
			echo _VIEW_DAY_MINUTES;


		?></td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _VIEW_DAY_CATEGORY; ?></td>
                <td width="10"></td>
                <td width="70%">
                        <select name="categoryid">
                        <?php
                                $result_cats = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_categories WHERE 1 ORDER BY title");

                                $num_cats = $db->sql_numrows($result_cats);
                                for ($cat_it = 0; $cat_it < $num_cats; $cat_it++) {
                                        $catrow = $db->sql_fetchrow($result_cats);
                                        echo "<option value=\"".$catrow[id]."\" ";
                                        if ($mydatarow[categoryid] == $catrow[id])
                                                echo "selected";
                                        echo ">" . $catrow[title]. "</option>";
                                }
                        ?>
                        </select>
                </td>
        </tr>
	<?php
                if ($showapproved) {
        ?>

	<tr align="left">
                <td width="30%"><?php echo _VIEW_SUBMIT_ACTIVE; ?></td>
                <td width="10"></td>
                <td width="70%">
                        <select name="isactive">
                                <option value="1" <?php if ($mydatarow[isactive]
== "1") echo "selected"; ?>><?php echo _YES; ?></option>
                                <option value="0" <?php if ($mydatarow[isactive]
== "0") echo "selected"; ?>><?php echo _NO; ?></option>
                        </select>
                </td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _VIEW_SUBMIT_APPROVED; ?></td>
                <td width="10"></td>
                <td width="70%">
                        <select name="isapproved">
                                <option value="1" <?php if ($mydatarow[isapproved]
== "1") echo "selected"; ?>><?php echo _YES; ?></option>
                                <option value="0" <?php if ($mydatarow[isapproved]
== "0") echo "selected"; ?>><?php echo _NO; ?></option>
                        </select>
                </td>
        </tr>
	<?php
	} else {
		echo "<input type=\"hidden\" name=\"isactive\" value=\"1\">";
	}

	?>
	<tr align="left">
                <td width="30%" valign="top"><?php _VIEW_DAY_EVENT_DATE; ?></td>
                <td width="10"></td>
                <td width="70%">
                        <input type="radio" name="onetime" value="onetime" <?php
if ($onetimeevent == "1") echo "checked"; ?>><?php echo _VIEW_SUBMIT_ONE_TIME; ?><br />
                        <table width="100%" cellspacing=0 border=0 cellpadding=0>
                               <tr>
                                        <td width="10%"></td>
                                        <td width="30%"><?php echo _VIEW_MONTH_MONTH; ?></td>
                                        <td width="30%"><?php echo _VIEW_MONTH_DAY; ?></td>
                                        <td width="30%"><?php echo _VIEW_MONTH_YEAR; ?></td>
                                </tr>
                                <tr>
                                        <td width="10%">
                                        <td width="30%">
                                        <?php
                                                $content = '<select name="month">';
                                                $content.='<option value="0">'._VIEW_SUBMIT_ALL.'</option>';
                                                for ($j=1;$j<=12;$j++) {
                                                        $content.='<option value="'.$j.'"';
                                                        if ($month == $j) {
                                                                $content.=' selected';
                                                        }
                                                        $content.='>'.GetMonthName($j).'</option>';
                                                }
                                                $content.='</select>';
                                                echo $content;
                                        ?>
                                        </td>
                                        <td width="30%">
                                                <input type="text" name="day" size="2" maxlength="2" value="<?php echo $day; ?>">
                                        </td>
                                        <td width="30%">
                                        <?php
						$content ='<select name="year">';                                                $content.='<option value="0">'._VIEW_SUBMIT_ALL.'</option>';
                                                for ($j=2003;$j<=2036;$j++) {
                                                        $content.='<option value="'.$j.'"';
                                                        if ($year == $j) {
                                                                $content.= ' selected';
                                                        }
                                                        $content.= '>'.$j.'</option>';
                                                }
                                                $content.='</select>';
                                                echo $content;
                                        ?>
                                        </td>
                                </tr>
                        </table>
                        <input type="radio" name="onetime" value="recur" <?php if ($onetimeevent == "0") echo "checked"; ?>><?php echo _VIEW_SUBMIT_RECURRING; ?><br />
                        <table width="100%" cellspacing=0 border=0 cellpadding=0>                                <tr>
                                        <td width="10%"></td>
                                        <td width="20%">
                                        <select name="recur_period">
                                                <option value=0 <?php if ($mydatarow[recur_period] == "0") echo "selected"; ?>><?php echo _VIEW_SUBMIT_ALL_WEEKLY; ?></option>
<option value=1 <?php if ($mydatarow[recur_period] == "1") echo "selected"; ?>><?php echo _VIEW_SUBMIT_FIRST; ?></option>
                                                <option value=2 <?php if ($mydatarow[recur_period] == "2") echo "selected"; ?>><?php echo _VIEW_SUBMIT_SECOND; ?></option>
                                                <option value=3 <?php if ($mydatarow[recur_period] == "3") echo "selected"; ?>><?php echo _VIEW_SUBMIT_THIRD; ?></option>
                                                <option value=4 <?php if ($mydatarow[recur_period] == "4") echo "selected"; ?>><?php echo _VIEW_SUBMIT_FOURTH; ?></option>
						<option value=5 <?php if ($mydatarow[recur_period] == "5") echo "selected"; ?>><?php echo _VIEW_SUBMIT_LAST; ?></option>
                                        </select>
                                        </td>
                                        <td width="20%">
						<select name="recur_weekday">
                                                        <option value=0 <?php if
($mydatarow[recur_weekday] == "0") echo "selected"; ?>><?php echo _VIEW_MONTH_SUNDAY; ?></option>
                                                        <option value=1 <?php if
($mydatarow[recur_weekday] == "1") echo "selected"; ?>><?php echo _VIEW_MONTH_MONDAY; ?></option>
                                                        <option value=2 <?php if
($mydatarow[recur_weekday] == "2") echo "selected"; ?>><?php echo _VIEW_MONTH_TUESDAY; ?></option>
                                                        <option value=3 <?php if
($mydatarow[recur_weekday] == "3") echo "selected"; ?>><?php echo _VIEW_MONTH_WEDNESDAY; ?></option>
<option value=4 <?php if ($mydatarow[recur_weekday] == "4") echo "selected"; ?>><?php echo _VIEW_MONTH_THURSDAY; ?></option>
                                                        <option value=5 <?php if
($mydatarow[recur_weekday] == "5") echo "selected"; ?>><?php echo _VIEW_MONTH_FRIDAY; ?></option>
                                                        <option value=6 <?php if
($mydatarow[recur_weekday] == "6") echo "selected"; ?>><?php echo _VIEW_MONTH_SATURDAY; ?></option>
                                                </select>
                                                <?php echo _VIEW_SUBMIT_OF; ?>
                                        </td>
                                        <td width="20%">
                                                <select name="recur_schedule">
                                                        <option value="weekly" <?php if ($mydatarow[recur_schedule] == "weekly") echo "selected"; ?>><?php echo _VIEW_SUBMIT_THE_WEEK; ?></option>                                                        <option value="monthly"
<?php if ($mydatarow[recur_schedule] == "monthly") echo "selected"; ?>><?php echo _VIEW_SUBMIT_ALL_MONTHS; ?></option>
                                                        <option value="yearly" <?php if ($mydatarow[recur_schedule] == "yearly") echo "selected"; ?>><?php echo _VIEW_SUBMIT_THE_MONTH; ?></option>
                                                </select>
                                        </td>
                                        <td width="20%">
                                        <?php
                                                $content = '<select name="recur_month"><option value=0>'._VIEW_SUBMIT_ALL_MONTHLY.'</option>';
                                                for ($j=1;$j<=12;$j++) {
                                                        $selected = "";
                                                        if ($mydatarow[recur_month] == $j)
                                                                $selected = "selected";
                                                        $content.='<option value='.$j.' ' . $selected . '>'.GetMonthName($j).'</option>';
                                                }
                                                $content .= '</selected>';
                                                echo $content;
                                        ?>
                                        </td>
				</tr>
                        </table>
                </td>
        </tr>
</table>
<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
<input type="submit" value="<?php echo $formsubmitbutton; ?>">
</form>

<?php
if ($formactiondelete != "") {
?>
<div align="right">
<form action="<?php echo $formactiondelete; ?>" method="POST">
<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
<input type="submit" value="<?php echo _VIEW_SUBMIT_DELETE_EVENT; ?>">
</form>
</div>
<?php
}
}

?>
