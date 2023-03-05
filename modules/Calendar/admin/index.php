<?php

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $prefix, $db, $admin_file;

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Calendar'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;	
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

@require_once("modules/Calendar/dbaccess.inc.php");
@require_once("modules/Calendar/datefuncs.php");
@require_once("modules/Calendar/printevent.php");
get_lang("Calendar");


/*********************************************************/
/* Links Modified Web Links                              */
/*********************************************************/
function Calendar_Header()
{
global $user_prefix, $db, $admin_file;
	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Calendar'>Calendar Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	OpenTable();
        echo "<center><font class=\"title\">"._ADMIN_TITLE."</font><br /><br /><a href=".$admin_file.".php?op=Calendar_Edit_Options>"._ADMIN_EDIT_OPTIONS."</a><br /><a href=".$admin_file.".php?op=Calendar_Show_Categories>"._ADMIN_EDIT_CATEGORIES."</a><br /><a href=".$admin_file.".php?op=Calendar>"._ADMIN_EDIT_EVENTS."</a></center>";

	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_bydate WHERE 1");
	$v010exists = 0;
	if ($result) {
		$v010exists = 1;
	}
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_recurring WHERE 1");
        if ($result) {
                $v010exists = 1;
        }
	if ($v010exists) {
		echo "<br /><br /><center><a href=".$admin_file.".php?op=Calendar_Import_From_v010>"._ADMIN_IMPORT_FROM_V010."</a></center>";
	}


        CloseTable();
}

function Calendar_Footer()
{
        @include_once("footer.php");
}

function Calendar_EditOptions()
{
        Calendar_Header();
	OpenTable();

	global $db, $user_prefix, $admin_file;
	
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_options WHERE 1");
	
	$row = $db->sql_fetchrow($result);

	echo "<form action=\"".$admin_file.".php?op=Calendar_Set_Options\" method=\"POST\">";
	echo "<table width=100%><tbody><tr>";

	echo "<td><font class=\"title\">"._ADMIN_OPTIONS_TITLE."</font></td><td></td><td></td></tr><tr>";
	echo "<td>"._ADMIN_CAL_TITLE."</td><td></td>";
	echo "<td><input type=\"text\" name=\"calendar_title\" value=\"".$row[calendar_title]."\" maxlength=128></td>";
	echo "</tr><tr>";

      	echo "<td>"._ADMIN_CAL_IMAGE."</td><td></td>";
	echo "<td><input type=\"text\" name=\"calendar_title_image\" value=\"".$row[calendar_title_image]."\" maxlength=255></td>";
	echo "</tr><tr>";

      	echo "<td>"._ADMIN_ALLOW_USER_SUBMISSION."</td><td></td>";
	echo "<td><select name=\"allow_user_submitted_events\">";
        echo "<option value=\"0\"";
        if ($row[allow_user_submitted_events] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[allow_user_submitted_events]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
	echo "</tr><tr>";
      	echo "<td>"._ADMIN_MUST_APPROVE."</td>";
	echo "<td></td>";
      	echo "</select></td>";
      	echo "<td><select name=\"user_submitted_events_need_admin_aproval\">";
	echo "<option value=\"0\"";
        if ($row[user_submitted_events_need_admin_aproval] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[user_submitted_events_need_admin_aproval]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
	echo "</tr><tr>";

	echo "<td>"._ADMIN_DATE_FORMAT."</td>";
        echo "<td></td>";
	echo "<td><select name=\"show_mdy\">";
        echo "<option value=\"0\"";
        if ($row[show_mdy] == 0)
                echo " selected";
        echo ">"._ADMIN_DATE_FORMAT_DMY."</option>";
        echo "<option value=\"1\"";
        if ($row[show_mdy]==1)
                echo " selected";
        echo ">"._ADMIN_DATE_FORMAT_MDY."</option></select></td>";


    	echo "</tr><tr><td></td><td></td><td></td><tr>";

	echo "<td><font class=\"title\">"._ADMIN_BLOCK_OPTIONS."</font></td><td></td><td>"._ADMIN_TURN_OFF_FOR_PERFORMANCE."</td></tr><tr>";

        echo "<td>"._ADMIN_SHOW_N_EVENTS."</td><td></td>";
        echo "<td><input type=\"text\" name=\"show_n_events\" value=\"".$row[show_n_events]."\" maxlength=2></td>";
        echo "</tr><tr>";

        echo "<td>"._ADMIN_SCAN_N_DAYS."</td><td></td>";
        echo "<td><input type=\"text\" name=\"in_n_days\" value=\"".$row[in_n_days]."\" maxlength=3></td>";
	echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_ONE_TIME."</td>";
        echo "<td></td>";
	echo "<td><select name=\"show_bydate_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_bydate_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_bydate_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
	echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_WEEKLY."</td>";
        echo "<td></td>";
        echo "<td><select name=\"show_weekly_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_weekly_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_weekly_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
        echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_MONTHLY."</td>";
        echo "<td></td>";
        echo "<td><select name=\"show_monthly_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_monthly_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_monthly_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
        echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_WEEKLY_RECUR."</td>";
        echo "<td></td>";
        echo "<td><select name=\"show_monthly_recurring_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_monthly_recurring_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_monthly_recurring_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
        echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_YEARLY."</td>";
        echo "<td></td>";
        echo "<td><select name=\"show_yearly_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_yearly_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_yearly_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
        echo "</tr><tr>";

	echo "<td>"._ADMIN_SHOW_YEARLY_RECUR."</td>";
        echo "<td></td>";
        echo "<td><select name=\"show_yearly_recurring_in_block\">";
        echo "<option value=\"0\"";
        if ($row[show_yearly_recurring_in_block] == 0)
                echo " selected";
        echo ">"._NO."</option>";
        echo "<option value=\"1\"";
        if ($row[show_yearly_recurring_in_block]==1)
                echo " selected";
        echo ">"._YES."</option></select></td>";
        echo "</tr><tr>";

	echo "<td valign=\"top\">"._ADMIN_SHOW_CATS."</td>";
	echo "<td></td>";
	echo "<td><select name=\"showcats[]\" multiple>";
	$resultcats = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_categories WHERE 1 ORDER BY title");
	for ($x = 0; $x < $db->sql_numrows($resultcats); $x++) {
		$catrow = $db->sql_fetchrow($resultcats);
		echo "<option value=\"".$catrow[id]."\" ";
		if ($catrow[showinblock] == 1)
			echo "selected";
		echo ">".$catrow[title]."</option>";
	}

	echo "</select></td>";
	echo "</tr><tr>";
	



        echo "</tr><tr><td></td><td></td><td></td><tr>";

        echo "<td><font class=\"title\">"._ADMIN_COLOR_TITLE."</font></td><td></td><td>"._ADMIN_COLORS_FOR_MONTH_VIEW."</td></tr><tr>";
	echo "<td>"._ADMIN_COLOR_DAY."</td><td></td>";
        echo "<td>#<input type=\"text\" name=\"month_day_color\" value=\"".$row[month_day_color]."\" maxlength=6></td>";
	echo "</tr><tr>";
	echo "<td>"._ADMIN_COLOR_TODAY."</td><td></td>";
        echo "<td>#<input type=\"text\" name=\"month_today_color\" value=\"".$row[month_today_color]."\" maxlength=6></td>";
	echo "<tr></tr>";
	echo "<td>"._ADMIN_COLOR_MOUSE_HOVER."</td><td></td>";
        echo "<td>#<input type=\"text\" name=\"month_hover_color\" value=\"".$row[month_hover_color]."\" maxlength=6></td>";



        echo "</tr><tr><td></td><td></td><td></td><tr>";

	echo "</tr></tbody></table>";
    
	echo "<input type=\"submit\" value=\""._ADMIN_UPDATE_OPTIONS."\"><input type=\"reset\" value=\""._ADMIN_RESET."\"></form>";

	CloseTable();

        Calendar_Footer();
}

function Calendar_SetOptions($xcalendar_title, $xcalendar_title_image, $xallow_user_submitted_events, $xuser_submitted_events_need_admin_aproval, $xshow_n_events, $xin_n_days, $xmonth_day_color, $xmonth_today_color, $xmonth_hover_color, $xshow_bydate_in_block, $xshow_yearly_in_block, $xshow_yearly_recurring_in_block, $xshow_monthly_in_block, $xshow_monthly_recurring_in_block, $xshow_weekly_in_block, $showcats, $show_mdy)
{
	global $db, $user_prefix, $admin_file;
	$query = "UPDATE ".$user_prefix."_calendar_options SET calendar_title='$xcalendar_title', calendar_title_image='$xcalendar_title_image', allow_user_submitted_events='$xallow_user_submitted_events', user_submitted_events_need_admin_aproval='$xuser_submitted_events_need_admin_aproval', show_n_events='$xshow_n_events', in_n_days='$xin_n_days', month_day_color='$xmonth_day_color', month_today_color='$xmonth_today_color', month_hover_color='$xmonth_hover_color', show_bydate_in_block='$xshow_bydate_in_block', show_yearly_in_block='$xshow_yearly_in_block', show_yearly_recurring_in_block='$xshow_yearly_recurring_in_block', show_monthly_in_block='$xshow_monthly_in_block', show_monthly_recurring_in_block='$xshow_monthly_recurring_in_block', show_weekly_in_block='$xshow_weekly_in_block', show_mdy='$show_mdy' WHERE 1";
        $resultID = $db->sql_query($query);


	$query = "UPDATE ".$user_prefix."_calendar_categories SET showinblock=0 WHERE 1";
	$db->sql_query($query);

	for ($x = 0; $x < count($showcats); $x++) {
		$query = "UPDATE ".$user_prefix."_calendar_categories SET showinblock=1 WHERE id='$showcats[$x]'";
        	$db->sql_query($query);	
	}

	Header("Location: ".$admin_file.".php?op=Calendar_Edit_Options");
}


function Calendar_Quick_Pick_Existing()
{
global $db, $user_prefix, $admin_file;
	OpenTable();
	echo "<center><font class=\"title\">"._ADMIN_EDIT_EXISTING."</font></center>";
	echo "<form method=\"POST\" ACTION=\"".$admin_file.".php?op=Calendar_Edit\">";
	echo _ADMIN_EDIT_ONE_TIME."  <select name=\"eventid\">";
        $chkdate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
	$query = "SELECT * FROM ".$user_prefix."_calendar_events WHERE isrecurring=0 AND isapproved=1 ORDER BY onetime_date";
        $resultID = $db->sql_query($query);

        if ($resultID) {
		$nr = $db->sql_numrows($resultID);
                $content = "";
                for ($k=0;$k<$nr;$k++) {
	        	$myrow = $db->sql_fetchrow($resultID);
                        $content = '<option value="' . $myrow[id] . '">';
                        $content .= $myrow[onetime_date] . " " . $myrow[title];
                        $content .= "</option>";
                        echo $content;
                }
        } else {
               	echo "<option value=-1>"._ADMIN_NO_EVENTS."</option>";
        }
      	echo "</select>";
        echo "<input type=\"submit\" value=\""._ADMIN_EDIT_EVENT."\">";
	echo "</form>";
	echo "<br />";
	echo "<form method=\"POST\" ACTION=\"".$admin_file.".php?op=Calendar_Edit\">";
	echo _ADMIN_EDIT_RECUR."  <select name=\"eventid\">";
        $query = "SELECT * FROM ".$user_prefix."_calendar_events WHERE isrecurring=1 AND isapproved=1 ORDER BY id";                
	$resultID = $db->sql_query($query);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                $content = "";
        	for ($k=0;$k<$nr;$k++) {
                	$myrow = $db->sql_fetchrow($resultID);
                        $content = '<option value="' . $myrow[id] . '">';
                        $content .= $myrow[eventdate] . " " . $myrow[title];
                        $content .= "</option>";
                        echo $content;
                }
         } else {
                 echo "<option value=-1>"._ADMIN_NO_EVENTS."</option>";
         }
        echo "</select>";
        echo "<input type=\"submit\" value=\""._ADMIN_EDIT_EVENT."\">";
	echo "</form>";

	echo "</form>";
        echo "<br />";
        echo "<form method=\"POST\" ACTION=\"".$admin_file.".php?op=Calendar_Edit\">";
        echo _ADMIN_EDIT_NEED_APPROVE."  <select name=\"eventid\">";
        $query = "SELECT * FROM ".$user_prefix."_calendar_events WHERE isapproved=0 ORDER BY id";
        $resultID = $db->sql_query($query);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                $content = "";
                for ($k=0;$k<$nr;$k++) {
                        $myrow = $db->sql_fetchrow($resultID);
                        $content = '<option value="' . $myrow[id] . '">';
                        $content .= $myrow[eventdate] . " " . $myrow[title];
                        $content .= "</option>";
                        echo $content;
                }

		if ($nr == 0) {
			echo "<option value=-1>"._ADMIN_NO_EVENTS."</option>";
		}
         } else {
                 echo "<option value=-1>"._ADMIN_NO_EVENTS."</option>";
         }
        echo "</select>";
        echo "<input type=\"submit\" value=\""._ADMIN_EDIT_EVENT."\">";
        echo "</form>";




	CloseTable();
}

function Calendar_Main()
{
    global $admin_file;
	Calendar_Header();
	Calendar_Quick_Pick_Existing();
	OpenTable();
	echo "<center><font class=\"title\">"._ADMIN_ADD_EVENT."</font></center>";
	$onetimeevent = 1;
	$formaction = "".$admin_file.".php?op=Calendar_Add";
	$formsubmitbutton = _ADMIN_ADD_EVENT;
	ShowEventForm($formaction, "", "", $formsubmitbutton, $onetimeevent,"", "", "", "", 1);

	CloseTable();
	Calendar_Footer();
}

function Calendar_Edit($eventid)
{
        Calendar_Header();
	Calendar_Quick_Pick_Existing();
        OpenTable();
        echo "<center><font class=\"title\">"._ADMIN_EDIT_EVENT."</font></center>";
	

	global $db, $user_prefix, $admin_file;

	$query = "SELECT * FROM ".$user_prefix."_calendar_events WHERE id=" . $eventid;
	$resultID = $db->sql_query($query);
	if ($resultID) {
		$mydatarow = $db->sql_fetchrow($resultID);
		$onetimeevent=1;
		if ($mydatarow[isrecurring] == "0") {
			$ripdate = array();
                	$ripdate = explode("-", $mydatarow[onetime_date]);
			$year = $ripdate[0];
			$month = $ripdate[1];
			$day = $ripdate[2];
		} else {
			$onetimeevent=0;
		}
		$formaction = "".$admin_file.".php?op=Calendar_Set_Values";
		$formsubmitbutton = _ADMIN_EDIT_EVENT;
		$formactiondelete = "".$admin_file.".php?op=Calendar_Delete_Confirm";
		
		ShowEventForm($formaction, $mydatarow, $eventid, $formsubmitbutton, $onetimeevent, $month, $day, $year, $formactiondelete, 1);
	} else {
		echo _ADMIN_NO_EVENT_WITH_ID;
	}
	CloseTable();
	Calendar_Footer();
}





function Calendar_Add($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month)
{
global $admin_file;
	Calendar_Insert_Row($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month);

	Header("Location: ".$admin_file.".php?op=Calendar");
}




function Calendar_Set_Values($eventid, $title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month)
{
	global $db, $user_prefix, $admin_file;

	$starttime = TimeToMilitaryTime($start_hour, $start_min, $start_pm);
	$duration = TimeToMilitaryTime($dur_hour, $dur_min, 0);

	$query = "UPDATE ".$user_prefix."_calendar_events SET title='$title', location='$location', fulldesc='$fulldesc', starttime='$starttime', duration='$duration', isactive='$isactive', isrecurring='$isrecurring', categoryid='$categoryid', isapproved='$isapproved', onetime_date='$onetime_date', recur_weekday='$recur_weekday', recur_schedule='$recur_schedule', recur_period='$recur_period', recur_month='$recur_month' WHERE id=$eventid";

        $resultID = $db->sql_query($query);

	Header("Location: ".$admin_file.".php?op=Calendar");
}




function Calendar_Delete_Confirm($eventid)
{
global $admin_file;
        Calendar_Header();
        OpenTable();

	echo "<form method=\"POST\" action=\"".$admin_file.".php?op=Calendar_Delete\">";
	echo "<input type=\"hidden\" name=\"eventid\" value=\"". $eventid . "\">";
	echo "<center><font class=\"title\">"._ADMIN_EVENT_DELETE_CONFIRM."</font></center><br />";
	echo "<center><input type=\"submit\" value=\""._DELETE."\">";
	echo "<input type=\"reset\" value=\""._CANCEL."\"></center>";
	echo "</form>";
	CloseTable();
	Calendar_Footer();
}

function Calendar_Delete($eventid)
{
	global $db, $user_prefix, $admin_file;

	$query=  "DELETE from ".$user_prefix."_calendar_events WHERE id='$eventid'";
	$resultID = $db->sql_query($query);

	Header("Location: ".$admin_file.".php?op=Calendar");
}

function Calendar_Show_Categories()
{
	Calendar_Header();
        OpenTable();

	global $db, $user_prefix, $admin_file;
        $query = "SELECT * FROM ".$user_prefix."_calendar_categories WHERE 1";

        echo "<center><font class=\"title\">"._ADMIN_EDIT_EXISTING_CATEGORY_TITLE."</font></center><br />";        

	echo "<form method=\"POST\" action=\"".$admin_file.".php?op=Calendar_Edit_Category\">";
        echo _ADMIN_CATEGORY_NAME."  <select name=\"catid\">";
        $resultID = $db->sql_query($query);
        if ($resultID) {
                $nr = $db->sql_numrows($resultID);
                $content = "";
                for ($k=0;$k<$nr;$k++) {
                        $myrow = $db->sql_fetchrow($resultID);
                        $content = '<option value="' . $myrow[id] . '">';
                        $content .= $myrow[title];
                        $content .= "</option>";
                        echo $content;
                }
        } else {
                echo "<option value=-1>"._ADMIN_NO_CATS_DEFINED."</option>";
        }
        echo "</select>";
        echo "<input type=\"submit\" value=\""._ADMIN_EDIT_CATEGORY."\">";
        echo "</form>";

	CloseTable();
	OpenTable();
	echo "<center><font class=\"title\">"._ADMIN_ADD_CATEGORY."</font></center>";
	Calendar_Show_Category_Form("".$admin_file.".php?op=Calendar_Add_Category", _ADMIN_ADD_CATEGORY_FORM, "");
	CloseTable();
        Calendar_Footer();
}

function Calendar_Add_Category($title, $description, $showinblock)
{
	global $dbi, $user_prefix, $admin_file;

        $query = "INSERT INTO ".$user_prefix."_calendar_categories (title, description, showinblock) VALUES ('$title', '$description', '$showinblock')";

	$result = $db->sql_query($query);
        Header("Location: ".$admin_file.".php?op=Calendar_Show_Categories");
}

function Calendar_Edit_Category($catid, $title, $description, $showinblock)
{
	Calendar_Header();
        OpenTable();

        global $db, $user_prefix, $admin_file;
        $query = "SELECT * FROM ".$user_prefix."_calendar_categories WHERE id=".$catid;
	$result = $db->sql_query($query);
	$row = $db->sql_fetchrow($result);

	echo "<center><font class=\"title\">"._ADMIN_EDIT_CATEGORY_TITLE."</font></center>";
	$formactiondelete = "".$admin_file.".php?op=Calendar_Delete_Category_Confirm";
	Calendar_Show_Category_Form("".$admin_file.".php?op=Calendar_Set_Category_Values", _ADMIN_EDIT_CATEGORY, $row, $formactiondelete);
	CloseTable();
        Calendar_Footer();
}

function Calendar_Show_Category_Form($formaction, $formsubmitbutton, $mydatarow, $formactiondelete="")
{
?>
	<form action="<?php echo $formaction; ?>" method="POST">
	<table width="100%" cellspacing=0 border=0 cellpadding=0>
        <tr align="left">
                <td width="30%"></td>
                <td width="10"></td>
                <td width="70%"></td>
        </tr>
        <tr align="left">
                <td width="30%"><?php echo _ADMIN_CATEGORY_TITLE; ?></td>
                <td width="10"></td>
                <td width="70%"><input type="text" name="title" value="<?php echo $mydatarow[title]; ?>" size=30></td>
        </tr>
	<tr align="left">
                <td width="30%" valign="top"><?php echo _ADMIN_CATEGORY_DESC; ?></td>
                <td width="10"></td>
                <td width="70%"><textarea rows="7" name="description" cols="45"><?php echo $mydatarow[description]; ?></textarea></td>
        </tr>
	<tr align="left">
                <td width="30%" valign="top"><?php echo _ADMIN_SHOW_CAT_IN_BLOCK; ?></td>
                <td width="10"></td>
                <td width="70%">
		<select name="showinblock">
		<option value="0"
		<?php 
			if ($mydatarow[showinblock] == 0)
				echo " selected";
		?>
		><?php echo _NO; ?></option>
		<option value="1"
                <?php
                        if ($mydatarow[showinblock] == 1)
                                echo " selected";
                ?>
                ><?php echo _YES; ?></option>
		</select></td>
        </tr>
	</table>
	<input type="hidden" name="catid" value="<?php echo $mydatarow[id]; ?>">
	<input type="submit" value="<?php echo $formsubmitbutton; ?>">
	</form>

<?php
if ($formactiondelete != "") {
?>
<div align="right">
<form action="".$admin_file.".php?op=Calendar_Delete_Category_Confirm" method="POST">
<input type="hidden" name="catid" value="<?php echo $mydatarow[id]; ?>">
<input type="submit" value="<?php echo _ADMIN_DELETE_CATEGORY; ?>">
</form>
</div>
<?php
}
}
	

function Calendar_Set_Category_Values($catid, $title, $description, $showinblock)
{
	global $dbi, $user_prefix, $admin_file;
        $query = "UPDATE ".$user_prefix."_calendar_categories SET title='$title', description='$description', showinblock='$showinblock' WHERE id=$catid";
        $resultID = $db->sql_query($query);
        Header("Location: ".$admin_file.".php?op=Calendar_Show_Categories");
}

function Calendar_Delete_Category_Confirm($catid)
{
global $admin_file;
	Calendar_Header();
        OpenTable();

        echo "<form method=\"POST\" action=\"".$admin_file.".php?op=Calendar_Delete_Category\">";
        echo "<input type=\"hidden\" name=\"catid\" value=\"". $catid . "\">";
        echo "<center><font class=\"title\">Confirm Event Category Delete</font></center><br />";
        echo "<center><input type=\"submit\" value=\""._DELETE."\">";
        echo "<input type=\"reset\" value=\""._CANCEL."\"></center>";
        echo "</form>";
        CloseTable();
        Calendar_Footer();
}

function Calendar_Delete_Category($catid)
{
	global $db, $user_prefix, $admin_file;
        $query=  "DELETE from ".$user_prefix."_calendar_categories WHERE id='$catid'";
	echo $query;
        $resultID = $db->sql_query($query);
        Header("Location: ".$admin_file.".php?op=Calendar_Show_Categories");
}

function Calendar_Import_From_v010()
{
	global $db, $user_prefix, $admin_file;

	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Calendar'>Calendar Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
        OpenTable();

	echo "<center><font class=\"title\">Updating DB from v0.10</font></center><br /><br />";

	echo "Importing from ".$user_prefix."_calendar_bydate ...";
	$result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_bydate WHERE 1");
	$numrows = $db->sql_numrows($result);
	echo $numrows . " row(s) to update ... ";
	$numrowsadded = 0;
	for ($x = 0; $x < $numrows; $x++) {
		$row = $db->sql_fetchrow($result);

		list($start_hour, $start_min, $start_sec) = split(":", $row[eventtime]);
		list($dur_hour, $dur_min, $dur_sec) = split(":", $row[eventlength]);

		$addresult = Calendar_Insert_Row($row[shortevent], $row[location], $start_hour, $start_min,  MilitaryTimeIsPM($row[eventtime]), $dur_hour, $dur_min, $row[longevent], $row[active], 0, 1, 1, $row[eventdate], 0, "weekly", 0, 0);
		if ($addresult) {
			$numrowsadded++;
		}
	}
	echo $numrowsadded . " row(s) updated.<br />";
	if ($numrows != $numrowsadded) {
		echo "<strong>WARNING: NOT ALL BYDATE ROWS COULD BE AUTOMATICALLY UPDADED.  PLEASE RE-ENTER THEM BY HAND</strong><br />";
	}



	echo "<br />Importing from ".$user_prefix."_calendar_recurring ...";
        $result = $db->sql_query("SELECT * FROM ".$user_prefix."_calendar_recurring WHERE 1");
        $numrows = $db->sql_numrows($result);
        echo $numrows . " row(s) to update ... ";
        $numrowsadded = 0;
        for ($x = 0; $x < $numrows; $x++) {
                $row = $db->sql_fetchrow($result);
		list($start_hour, $start_min, $start_sec) = split(":", $row[eventtime]);
                list($dur_hour, $dur_min, $dur_sec) = split(":", $row[eventlength]);

                $addresult = Calendar_Insert_Row($row[shortevent], $row[location], $start_hour, $start_min,  MilitaryTimeIsPM($row[eventtime]), $dur_hour, $dur_min, $row[longevent], $row[active], 1, 1, 1, "0000-00-00", $row[weekday], $row[schedule], $row[period], $row[month]);
                if ($addresult) {
                        $numrowsadded++;
                }
        }
        echo $numrowsadded . " row(s) updated.<br />";
        if ($numrows != $numrowsadded) {
                echo "<strong>WARNING: NOT ALL RECURRING ROWS COULD BE AUTOMATICALLY UPDADED.  PLEASE RE-ENTER THEM BY HAND</strong><br />";
        }

	echo "<br />You may now delete tables ".$user_prefix."_calendar_bydate and ".$user_prefix."_calendar_recurring after you are satsified with the update";
	

	CloseTable();
	Calendar_Footer();
}	

switch ($op) { 
    case "Calendar":
	Calendar_Main();
    break;

    case "Calendar_Add":
	$isrecurring = 1;
        if ($onetime == "onetime") {
                $isrecurring = 0;
        }
	$onetime_date = $year."-".$month."-".$day;
	Calendar_Add($title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, 1, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month);
    break;			

    case "Calendar_Set_Values":
	$isrecurring = 1;
	if ($onetime == "onetime") {
		$isrecurring = 0;
	}

	$onetime_date = $year."-".$month."-".$day;
	Calendar_Set_Values($eventid, $title, $location, $fulldesc, $start_hour, $start_min, $start_pm, $dur_hour, $dur_min, $isactive, $isrecurring, $categoryid, $isapproved, $onetime_date, $recur_weekday, $recur_schedule, $recur_period, $recur_month);
    break;

    case "Calendar_Edit":
	Calendar_Edit($eventid);
    break;

    case "Calendar_Delete_Confirm":
	Calendar_Delete_Confirm($eventid);
    break;

    case "Calendar_Delete":
	Calendar_Delete($eventid);
    break;

    case "Calendar_Edit_Options":
	Calendar_EditOptions();
    break;

    case "Calendar_Set_Options":

	Calendar_SetOptions($calendar_title, $calendar_title_image, $allow_user_submitted_events, $user_submitted_events_need_admin_aproval, $show_n_events, $in_n_days, $month_day_color, $month_today_color, $month_hover_color, $show_bydate_in_block, $show_yearly_in_block, $show_yearly_recurring_in_block, $show_monthly_in_block, $show_monthly_recurring_in_block, $show_weekly_in_block, $showcats, $show_mdy);
    break;

    case "Calendar_Show_Categories":
        Calendar_Show_Categories();
    break;
    case "Calendar_Add_Category":
	Calendar_Add_Category($title, $description, $showinblock);
    break;
    case "Calendar_Edit_Category":
	Calendar_Edit_Category($catid, $title, $description, $showinblock);
    break;
    case "Calendar_Set_Category_Values":
        Calendar_Set_Category_Values($catid, $title, $description, $showinblock);
    break;
    case "Calendar_Delete_Category":
	Calendar_Delete_Category($catid);
    break;
    case "Calendar_Delete_Category_Confirm":
	Calendar_Delete_Category_Confirm($catid);
    break;
    case "Calendar_Import_From_v010":
	Calendar_Import_From_v010();
    break;

}

} else {
	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Calendar'>Calendar Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	OpenTable();
	echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module Calendar</center>";
	CloseTable();
	@include_once("footer.php");
}

?>
