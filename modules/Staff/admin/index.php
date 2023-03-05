<?php

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $prefix, $db, $admin_file;

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Staff'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Staff'>Staff Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	Opentable();
	echo "<strong><center>" . _STADMIN . "</center></strong>";
	Closetable();
	Opentable();
	@require("modules/Staff/functions.inc");

	//set the version checker information
	$ver1 = "0";
	$ver2 = "2";
	$module_name = "staff";

	//Define the functions

	//configure
	FUNCTION configure(){
		global $db, $prefix, $admin_file;
		//Pull current configuration.
		$sql = "SELECT img_url, staff_join_page, index_bl, ranks FROM ".$prefix."_staff_config WHERE latest = '1'";
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$img_url = $row[img_url];
		$staff_page = $row[staff_join_page];
		$index_s = $row[index_bl];
		$ranks = $row[ranks];

		//Print the Configuration Form
		echo "<table align=\"center\">";
		echo "\n<tr><td valign=\"top\">";
		echo "<strong>" . _STCONF . "</strong>";

		//Start Clear Form
		echo "\n</td><td valign=\"bottom\" align=\"right\"><form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "\n<input type=\"hidden\" name=\"send\" value=\"clear\">";
		echo "\n<input type=\"submit\" name=\"Submit\" value=\"" . _STMMENU . "\">";
		echo "\n</form></td></tr><tr><td align=\"center\" colspan=\"2\">";
		//End Clear Form

		if ($index_s == "1") $sel = "checked"; else $sel = "";
		if ($ranks == "1") $sel = "checked"; else $sel = "";

		//Start Configuration Form
		echo "\n<form ENCTYPE=\"multipart/form-data\" action=\"".$admin_file.".php?op=staff\" method=\"post\"></td></tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STPHDIR . ":</strong></td>";
		echo "<td> <input type=\"text\" name=\"img_url\" size=\"40\" value=\"$img_url\">";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STAPPLIC . ":</strong></td>";
		echo "<td> <input type=\"text\" name=\"staff_page\" size=\"40\" value=\"$staff_page\">";
		echo "<input type=\"hidden\" name=\"send\" value=\"save_config\">";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=\"left\" valign=\"top\" colspan=\"2\"><strong>" . _STRBLOCKS . ":</strong>";
		echo " <input type=\"checkbox\" name=\"index_s\" value=\"1\" $sel>";
		echo "&nbsp;&nbsp;<strong>" . _STRANKS . ":</strong>";
		echo " <input type=\"checkbox\" name=\"ranks_s\" value=\"1\" $sel></td>";
		echo "</tr>";
		echo "<tr><td align=\"center\" colspan=\"2\">";
		echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STSUBMIT . "\"></form>";
		echo "</td></tr>";
		echo "</table>";
	}

	FUNCTION save_config($img_url, $staff_page, $ranks_s, $index_s){
		global $db, $prefix;
		//Update DB
		$db->sql_query("UPDATE ".$prefix."_staff_config SET
		img_url = '$img_url',
		staff_join_page = '$staff_page',
		ranks = '$ranks_s',
		index_bl = '$index_s'");
		//Set success message
		$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
		$success .= "" . _STDATAENTERED . " ".$prefix."_staff_config:<br />";
		$success .= "img_url = $img_url  " . _STAND . "   staff_join_page = $staff_page   " . _STAND . "   ranks = '$ranks_s'   " . _STAND . "   index = '$index_s'</center><p>";
		echo "$success";
	}

	FUNCTION add_cat($id){
		global $db, $prefix, $admin_file;
		//If edit, pull old category info.
		if($id != "new"){
			$sql = "SELECT name FROM ".$prefix."_staff_cat WHERE id = '$id'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$name = $row[name];
			$sav_cat = "save_edit_cat";
			$config = "" . _STEDCAT . "";
		}
		else { $sav_cat = "save_new_cat";
		$config = "" . _STNEWCAT . ""; }

		//Print the Category Form
		echo "<table align=\"center\">";
		echo "\n<tr><td valign=\"top\">";
		echo "<strong>$config</strong>";

		//Start Clear Form
		echo "\n</td><td valign=\"bottom\" align=\"right\"><form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "\n<input type=\"hidden\" name=\"send\" value=\"clear\">";
		echo "\n<input type=\"submit\" name=\"Submit\" value=\"" . _STMMENU . "\">";
		echo "\n</form></td></tr><tr><td align=\"center\" colspan=\"2\">";
		//End Clear Form

		//Start Category Form
		echo "\n<form ENCTYPE=\"multipart/form-data\" action=\"".$admin_file.".php?op=staff\" method=\"post\"></td></tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STCATNAME . ":</strong></td>";
		echo "<td> <input type=\"text\" name=\"name\" maxlength=\"255\" size=\"40\" value=\"$name\">";
		echo "</td>";
		echo "<tr>";
		if($id != "new") {
			echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
			echo "<td align=\"middle\" colspan=\"2\">" . _STDELETE . "&gt;&gt;<input type=\"radio\" name=\"send\" value=\"delete_cat\">";
			echo "&nbsp;&nbsp;" . _STSAVE . "&gt;&gt;<input type=\"radio\" name=\"send\" value=\"save_edit_cat\" checked></td>";
		} else {
			echo "<input type=\"hidden\" name=\"send\" value=\"save_new_cat\">";
		}
		echo "</tr>";
		echo "<td align=\"center\" colspan=\"2\">";
		echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STSUBMIT . "\"></form>";
		echo "</td></tr>";
		echo "</table>";
	}

	FUNCTION delete_cat($id){
		global $db, $prefix;
		$db->sql_query("DELETE FROM ".$prefix."_staff_cat WHERE id = '$id'");
		$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
		$success .= "" . _STCAT . " $id " . _STDEL . "";
		echo "$success";

	}

	FUNCTION save_edit_cat($id, $name){
		global $db, $prefix;
		//Check to see if name was filled in
		if(!$name){
			//Set Error Message
			$success = "<center><strong>" . _STERR . "</strong><br />";
			$success .= "" . _STNOCATNAME . "</center>";
		} else {
			//Update DB
			$db->sql_query("UPDATE ".$prefix."_staff_cat SET
			name = '$name'
			WHERE id = '$id'");
			//Set success message
			$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
			$success .= "" . _STDATAENTERED . " ".$prefix."_staff_cat:<br />";
			$success .= "" . _STNAME . " = '$name'</center><p>";
		}
		echo "$success";
	}

	FUNCTION save_new_cat($name){
		global $db, $prefix;
		//Check to see if name was filled in
		if(!$name){
			//Set Error Message
			$success = "<center><strong>" . _STERR . "</strong><br />";
			$success .= "" . _STNOCATNAME . "</center>";
		} else {
			//Insert Into DB
			$db->sql_query("INSERT INTO ".$prefix."_staff_cat (
			name)
			VALUES (
			'$name')");
			//Set success message
			$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
			$success .= "" . _STDATAENTERED . " ".$prefix."_staff_cat:<br />";
			$success .= "" . _STNAME . " = '$name'</center><p>";
		}
		echo "$success";
	}

	FUNCTION add_staff($sid){
		global $db, $prefix, $admin_file;
		//If edit, pull old staff info
		if($sid != "new"){
			$sql = "SELECT name, des, alias, photo, id, rank FROM ".$prefix."_staff WHERE sid = '$sid'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$name = $row[name];
			$des = $row[des];
			$alias = $row[alias];
			$photo = $row[photo];
			$id = $row[id];
			$rank_s = $row[rank];
			$sav_staff = "save_edit_staff";
			$config = "" . _STEDIT . " $name";
		}
		else { $sav_staff = "save_new_staff";
			$config = "" . _STNEWSTAFF . "";
		}

		//Determine weather ranks are given.
		$sqlranks = "SELECT ranks FROM ".$prefix."_staff_config";
		$resultranks = $db->sql_query($sqlranks);
		$rowranks = $db->sql_fetchrow($resultranks);
		$ranks_s = $rowranks[ranks];

		//Print the Staff Form
		echo "<table align=\"center\">";
		echo "\n<tr><td valign=\"top\">";
		echo "<strong>$config</strong>";

		//Start Clear Form
		echo "\n</td><td valign=\"bottom\" align=\"right\"><form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "\n<input type=\"hidden\" name=\"send\" value=\"clear\">";
		echo "\n<input type=\"submit\" name=\"Submit\" value=\"" . _STMMENU . "\">";
		echo "\n</form></td></tr><tr><td align=\"center\" colspan=\"2\">";
		//End Clear Form

		//Start Staff Form
		echo "\n<form ENCTYPE=\"multipart/form-data\" action=\"".$admin_file.".php?op=staff\" method=\"post\"></td></tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STNAME . ":</strong></td>";
		echo "<td> <input type=\"text\" name=\"name\" maxlength=\"255\" size=\"40\" value=\"$name\">";
		echo "</td></tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STALIAS . ":</strong></td>";
		echo "<td> <input type=\"text\" name=\"alias\" maxlength=\"255\" size=\"40\" value=\"$alias\">";
		echo "</td></tr>";
		echo "<tr>";
		echo "<td align=\"right\" valign=\"top\"><strong>" . _STCAT . ":</strong></td>";
		echo "<td>";
		echo "\n<select name=\"id\"><option ";
		if(!$id){
			echo "selected";
		}
		echo ">::" . _STSELECT . "::</option>";
		//Pull info for category dropdown menu
		$sql2 = "SELECT name, id FROM ".$prefix."_staff_cat";
		$result2 = $db->sql_query($sql2);
		while($row2 = $db->sql_fetchrow($result2)){
			$cat_nam = $row2[name];
			$cat_id = $row2[id];
			//create dropdown menu
			echo "\n<option value=\"$cat_id\" ";
			if($cat_id == $id) {
				echo "selected";
			}
			echo ">$cat_nam</option>";
		}
		echo "</select>";
		echo "</td></tr>";
		if($ranks_s == "1") {
			echo "<tr>\n<td align=\"right\" valign=\"top\">\n<strong>" . _STPOS . ":</strong>\n</td>\n<td>\n<input type=\"text\" name=\"rank_s\" maxlength=\"255\" size=\"40\" value=\"$rank_s\">\n</td>\n</tr>";
		} else {
			echo "<input type=\"hidden\" name = \"rank_s\" value=\"0\">";
		}
		echo "<tr>";
		echo "<td colspan=\"2\"><strong>" . _STDESC . ":</strong><br />";
		echo "<textarea name=\"descrip\" cols=\"50\" rows=\"10\" id=\"descrip\">htmlspecialchars($des)";
		echo "</textarea></td><br /></center>";
		echo "</tr>";
		echo "<tr>";
		echo "<td colspan=\"2\"><strong>" . _STPHOTO . ":</strong><br />";
		$sql2 = "SELECT img_url FROM ".$prefix."_staff_config";
		$result2 = $db->sql_query($sql2);
		$row2 = $db->sql_fetchrow($result2);
		$img_url = $row2[img_url];
		echo "<strong>" . _STIMGPATH . " $img_url</strong>";
		echo "<br /><INPUT NAME=\"the_file\" TYPE=\"file\" SIZE=\"35\">";
		echo "<!-- <input type=\"text\" name=\"the_file\" maxlength=\"255\" size=\"40\" value=\"$photo\"> -->";
		echo "</td>";
		//If there is a photo already, print it.
		if($photo) {
			echo "<td align=\"right\"><strong>" . _STCURRPHOT . "</strong><br /><img src=\"$img_url/$photo\"></td>";
		}
		echo "</tr>";
		echo "<tr><td align=\"center\" colspan=\"2\">";
		if($sid != "new") {
			echo "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
			echo "" . _STDELETE . "&gt;&gt;</td><td><input type=\"radio\" name=\"send\" value=\"delete_staff\"></td>";
			echo "<td>" . _STSAVE . "&gt;&gt;</td><td><input type=\"radio\" name=\"send\" value=\"save_edit_staff\" checked></td><td align=\"center\">";
		} else {
			echo "<input type=\"hidden\" name=\"send\" value=\"save_new_staff\">";
		}
		echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STSUBMIT . "\"></form>";
		echo "</td></tr>";
		echo "</table>";

	}

	FUNCTION delete_staff($sid){
		global $db, $prefix;
		//Remove photo from DB is photo exists
		$sql = "SELECT photo FROM ".$prefix."_staff WHERE sid = '$sid'";
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$photo = $row[photo];
		if($photo){
			$sql = "SELECT img_url FROM ".$prefix."_staff_config";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$dir = $row[img_url];
			unlink("$dir"."$photo");
		}
		//delete DB entry
		$db->sql_query("DELETE FROM ".$prefix."_staff WHERE sid = '$sid'");
		$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
		$success .= "" . _STUSER . " $sid " . _STDEL . "";
		echo "$success";
	}

	FUNCTION save_edit_staff($name, $descrip, $id, $sid, $alias, $rank_s, $photo) {
		global $db, $prefix;
		//Check that all nessercary variables were entered
		if(!$name || !$descrip || !$id || !$sid){
			$success = "<center><strong>" . _STERR . "</strong><br />";
			$success .= "" . _STINCOMP . "</center><p>";
		} else {
			if($photo){
				$photo = $photo;
			} else {
				$sql = "SELECT photo FROM ".$prefix."_staff WHERE sid = '$sid'";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$photo = $row[photo];
			}
			if($img_error) {
				$success = "<center><strong>" . _STERR . "</strong><br />$img_error</center>";
			} else {
				$db->sql_query("UPDATE ".$prefix."_staff SET
				id = '$id',
				name = '$name',
				des = '$descrip',
				alias = '$alias',
				photo = '$photo',
				rank = '$rank_s'
				WHERE sid = '$sid'");
				//set success message
				$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
				$success .= "" . _STDATAENTERED . " ".$prefix."_staff:<br />";
				$success .= "id = '$id' " . _STAND . " name = '$name' " . _STAND . " des = '$descrip' " . _STAND . " alias = '$alias' " . _STAND . " photo = '$photo'   " . _STAND . "   rank = '$rank_s'</center><p>";
			}
		}
		echo "$success";
	}


	FUNCTION save_new_staff($name, $descrip, $id, $alias, $rank_s, $photo) {
		global $db, $prefix;
		//Check that all nessercary variables were entered
		if(!$name || !$descrip || !$id){
			$success = "<center><strong>" . _STERR . "</strong><br />";
			$success .= "" . _STINCOMP . "</center><p>";
		} else {
			if($the_file){
				$photo = $photo;
			}
			if($img_error) {
				$success = "<center><strong>" . _STERR . "</strong><br />$img_error</center>";
			} else {  //320
				$db->sql_query("INSERT INTO ".$prefix."_staff (
				id,
				name,
				des,
				alias,
				photo,
				rank)
				VALUES (
				'$id',
				'$name',
				'$descrip',
				'$alias',
				'$photo',
				'$rank_s')");
				//set success message
				$success = "<center><strong>" . _STSUCCESS . "</strong><br />";
				$success .= "" . _STDATAENTERED . " ".$prefix."_staff:<br />";
				$success .= "id = '$id' " . _STAND . " name = '$name' " . _STAND . " des = '$descrip' " . _STAND . " alias = '$alias' " . _STAND . " photo = '$photo'   " . _STAND . "   rank = '$rank_s'</center><p>";
			}
		}
		echo "$success";
	}

	FUNCTION main_def() {
		global $db, $prefix, $ver1, $ver2, $module_name, $admin_file;
		//Make the main menu


		//Configre
		echo "<table align=\"center\"><tr><td align=\"center\">";
		echo "<form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"send\" value=\"config\">";
		echo "\n<input type=\"submit\" name=\"Submit\" value=\"" . _STCONF . "\">";
		echo "</form></td></tr>";
		//Add Category
		echo "<tr><td align=\"center\">";
		echo "<form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"send\" value=\"add_cat\">";
		echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STADDCAT . "\">";
		echo "</form></td></tr>";
		//Add staff member
        
		echo "<tr><td align=\"center\">";
		echo "<form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"send\" value=\"add_staff\">";
		echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STADDMEM . "\">";
		echo "</form></td></tr>";

		//create dropdown menus for editing

		//Edit Categories
		$sqlcat = "SELECT * FROM ".$prefix."_staff_cat";
		$resultcat = $db->sql_query($sqlcat);
		$rowcat = $db->sql_numrows($resultcat);

		if(!$rowcat) {
		} else {
			echo "\n<tr><td align=\"center\">";
			echo "<form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
			echo "<select name=\"id\"><option selected>::" . _STSELECT . "::</option>";
			//Pull info for category dropdown menu
			while($rowcat = $db->sql_fetchrow($resultcat)) {
				$cat_nam = $rowcat[name];
				$cat_id = $rowcat[id];
				//create dropdown menu
				echo "\n<option value=\"$cat_id\">$cat_nam</option>";
			}
			echo "</select>";
			echo "<input type=\"hidden\" name=\"send\" value=\"edit_cat\">";
			echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STEDCAT . "\">";
			echo "</form></td></tr>";
		}

		//Edit Staff
		$sqlstaff = "SELECT name, sid FROM ".$prefix."_staff";
		$resultstaff = $db->sql_query($sqlstaff);
		$rowstaff = $db->sql_numrows($resultstaff);

		if(!$rowstaff) {
		} else {
			echo "\n<tr><td align=\"center\">";
			echo "<form action=\"".$admin_file.".php?op=staff\" method=\"post\">";
			echo "<select name=\"sid\"><option selected>::" . _STSELECT . "::</option>";
			//Pull info for category dropdown menu
			while($rowstaff = $db->sql_fetchrow($resultstaff)) {
				$name = $rowstaff[name];
				$sid = $rowstaff[sid];
				//create dropdown menu
				echo "\n<option value=\"$sid\">$name</option>";
			}
			echo "</select>";
			echo "<input type=\"hidden\" name=\"send\" value=\"edit_staff\">";
			echo "<input type=\"submit\" name=\"Submit\" value=\"" . _STEDMEM . "\">";
			echo "</form></td></tr>";
		}
		echo "<tr><td align=\"center\">";
		update_check($ver1, $ver2, $module_name);
		echo "</td></tr></table>";
	}

	switch ($send){

		case 'config':
		configure();
		break;

		case 'add_cat':
		$id = "new";
		add_cat($id);
		break;

		case 'edit_cat':
		add_cat($id);
		break;

		case 'add_staff':
		$sid = "new";
		add_staff($sid);
		break;

		case 'edit_staff':
		add_staff($sid);
		break;

		default:
		main_def();
		break;

		case 'save_config':
		if($ranks_s != "1") { $ranks_s = "0"; }
		if($index_s != "1") { $index_s = "0"; }
		save_config($img_url, $staff_page, $ranks_s, $index_s);
		main_def();
		break;

		case 'save_edit_cat':
		save_edit_cat($id, $name);
		main_def();
		break;

		case 'save_new_cat':
		save_new_cat($name);
		main_def();
		break;

		case 'save_edit_staff':
		//If a photo is chosen for upload, upload it.
		if($the_file){
			$sql = "SELECT img_url FROM ".$prefix."_staff_config";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$dir = $row[img_url];
			$uploadfile = $dir."/".$_FILES['the_file']['name'];

			if (!move_uploaded_file($_FILES['the_file']['tmp_name'], $uploadfile)) {
				$img_error = "<strong>" . _STUPFAIL . "</strong>";
			} else {
				$photo = $_FILES['the_file']['name'];
			}
		}
		save_edit_staff($name, $descrip, $id, $sid, $alias, $rank_s, $photo);
		main_def();
		break;

		case 'save_new_staff':
		//If a photo is chosen for upload, upload it.
		if($the_file) {
			$sql = "SELECT img_url FROM ".$prefix."_staff_config";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$dir = $row[img_url];
			$uploadfile = $dir."/".$_FILES['the_file']['name'];

			if (!move_uploaded_file($_FILES['the_file']['tmp_name'], $uploadfile)) {
				$img_error = "<strong>" . _STUPFAIL . "</strong>";
			} else {
				$photo = $_FILES['the_file']['name'];
			}
		}
		save_new_staff($name, $descrip, $id, $alias, $rank_s, $photo);
		main_def();
		break;

		case 'delete_staff':
		delete_staff($sid);
		main_def();
		break;

		case 'delete_cat':
		delete_cat($id);
		main_def();
		break;
	}

	CloseTable();
	@include_once("footer.php");

} else {
	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=Staff'>Staff Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
	OpenTable();
	echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module Staff</center>";
	CloseTable();
	@include_once("footer.php");
}

?>
