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
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

if (!stristr($_SERVER['SCRIPT_NAME'], "modules.php")) {
    die ("You can't access this file directly...");
}

include_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._TUTMAINTUTMODULE."";
$tutconfigsql = $db->sql_query("SELECT * FROM ".$prefix."_tutorials_config");
$tutconfig = $db->sql_fetchrow($tutconfigsql);
if($tutconfig['rightblocks'] == 1){
$index = 1;
}
include_once("modules/".$module_name."/include/menu.php");
function index(){
         global $db, $user, $admin, $prefix, $user_prefix, $module_name, $tutconfig;
         $userinfo = getusrinfo($user);
         $username = $userinfo['username'];
         include_once('header.php');
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
         OpenTable();
         if ((is_user($user)) && ($tutconfig['submit_on'] == 1)){
	echo "<form method=\"post\" name=\"post\" action=\"modules.php?name=".$module_name."\">"
	    ."<font class=\"content\"><strong>"._TUTADMINADDNEWTUTORIAL."</strong><br /><br />"
	    .""._TUTADMINTUTORIALNAME.": <input type=\"text\" name=\"t_title\" size=\"50\" maxlength=\"100\"><br />";
	$result2=$db->sql_query("select tc_id, tc_title, parentid from ".$prefix."_tutorials_categories order by tc_title");
	echo ""._TUTADMINCATEGORY.": <select name=\"tc_id\">";
	while(list($tc_id2, $tc_title2, $parentid2) = $db->sql_fetchrow($result2)) {
	    if ($parentid2!=0) $tc_title2=getparent($parentid2,$tc_title2);
	    echo "<option value=\"$tc_id2\">$tc_title2</option>";
	}
	echo "</select><br /><br />"
	.""._TUTADMINDESCRIPTION255."<br /><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br /><br />";
        tutorial_form();
        echo "			<td colspan=\"9\"><span class=\"gen\">
			  <textarea name=\"message\" rows=\"40\" cols=\"100%\" wrap=\"virtual\" class=\"post\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\"></textarea>
			  </span></td>
		  </tr>
		</table>
		</span></td>
	</tr>
  </table>";
        echo ""._TUTADMINAUTHORNAME.": <input type=\"text\" name=\"author\" size=\"30\" maxlength=\"60\"><br /><br />"
	    .""._TUTADMINAUTHOREMAIL.": <input type=\"text\" name=\"author_email\" size=\"30\" maxlength=\"60\"><br /><br />"
	    .""._TUTADMINAUTHORHOMEPAGE.": <input type=\"text\" name=\"author_homepage\" size=\"30\" maxlength=\"200\"><br /><br />"
            .""._TUTADMINVERSION.": <input type=\"text\" name=\"version\" size=\"11\" maxlength=\"10\"><br /><br />";
echo ""._TUTADMINLEVEL.":<br />";
$result3=$db->sql_query("select sid, title from ".$prefix."_tutorials_levels order by weight ASC");
echo "<select name=\"level\">";
while(list($level_id, $level_title) = $db->sql_fetchrow($result3)) {
echo "<option value=\"$level_id\">$level_title</option>";
}
echo "</select><br /><br />";
	    echo "<input type=\"hidden\" name=\"submitter\" value=\"$username\">"
	    ."<input type=\"hidden\" name=\"file\" value=\"submit\">"
	    ."<input type=\"hidden\" name=\"t_op\" value=\"savetutorial\">"
	    ."<center><input type=\"submit\" value=\""._TUTADMINADDTUTORIAL."\"><br />"
	    ."</form>";
    	}else{
    	 echo "<font class=\"content\"><center><strong>"._TUTMAINSUBRES."</strong></center>";
    	 if($tutconfig['submit_on'] == 0 && !is_user($user)){
        echo "<br /><center>"._TUTMAINSUBONLYLOGOFF."</center><br />";
         }elseif($tutconfig['submit_on'] == 1 && !is_user($user)){
        echo "<br /><center>"._TUTMAINSUBONLYLOG."</center><br />";
         }elseif($tutconfig['submit_on'] == 0 && is_user($user)){
        echo "<br /><center>"._TUTMAINSUBONLYOFF."</center><br />";
         }
        }
    CloseTable();
    include_once('footer.php');
}
function tutorial_form(){
    global $module_name;
        include_once("include/bbcode_javascript.php");
       echo ""._TUTADMINTUTORIALTEXT.":<br />
         <font class=\"tiny\">"._TUTADMINPAGEBREAK."</font><br />
         <table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" width=\"100%\">
	<tr>
	  <td valign=\"top\"><span class=\"gen\"> <span class=\"genmed\"> </span>
		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
		  <tr align=\"right\" valign=\"middle\">
			<td>
			  <p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\" align=\"left\"><span class=\"gen\">
			  <span class=\"genmed\">
			  &nbsp;<select name=\"fc\" onChange=\"BBCfc()\" dir=\"ltr\">
              <option selected value=\"black\" class=\"genmed\">"._TUTBBFONTCOLOR."</option>
                                          <option style=\"color:darkred;\" value=\"darkred\" class=\"genmed\">"._TUTBBDARKRED."</option>
					  <option style=\"color:red;\" value=\"red\" class=\"genmed\">"._TUTBBRED."</option>
					  <option style=\"color:orange;\" value=\"orange\" class=\"genmed\">"._TUTBBORANGE."</option>
					  <option style=\"color:brown;\" value=\"brown\" class=\"genmed\">"._TUTBBBROWN."</option>
					  <option style=\"color:yellow;\" value=\"yellow\" class=\"genmed\">"._TUTBBYELLOW."</option>
					  <option style=\"color:green;\" value=\"green\" class=\"genmed\">"._TUTBBGREEN."</option>
					  <option style=\"color:olive;\" value=\"olive\" class=\"genmed\">"._TUTBBOLIVE."</option>
					  <option style=\"color:cyan;\" value=\"cyan\" class=\"genmed\">"._TUTBBCYAN."</option>
					  <option style=\"color:blue;\" value=\"blue\" class=\"genmed\">"._TUTBBBLUE."</option>
					  <option style=\"color:darkblue;\" value=\"darkblue\" class=\"genmed\">"._TUTBBDARKBLUE."</option>
					  <option style=\"color:indigo;\" value=\"indigo\" class=\"genmed\">"._TUTBBINDIGO."</option>
					  <option style=\"color:violet;\" value=\"violet\" class=\"genmed\">"._TUTBBVIOLET."</option>
					  <option style=\"color:white;\" value=\"white\" class=\"genmed\">"._TUTBBWHITE."</option>
					  <option style=\"color:black;\" value=\"black\" class=\"genmed\">"._TUTBBBLACK."</option>
			  </select>&nbsp;&nbsp; <select name=\"fs\" onChange=\"BBCfs()\" dir=\"ltr\">
			                <option selected value=\"7\" class=\"genmed\">"._TUTBBFONTSIZE."</option>
			  		  <option value=\"7\" class=\"genmed\">"._TUTBBTINY."</option>
					  <option value=\"9\" class=\"genmed\">"._TUTBBSMALL."</option>
					  <option value=\"12\" class=\"genmed\">"._TUTBBNORMAL."</option>
					  <option value=\"18\" class=\"genmed\">"._TUTBBLARGE."</option>
					  <option  value=\"24\" class=\"genmed\">"._TUTBBHUGH."</option>
					</select> <span lang=\"ar-sy\">&nbsp;</span><select name=\"ft\" onChange=\"BBCft()\" dir=\"ltr\">
                                          <option selected value=\"Arial\" class=\"genmed\">Font type</option>
                                          <option value=\"Arial\" class=\"genmed\">Default font
                                          </option>
<option value=\"Andalus\" class=\"genmed\">
Andalus</option> 
<option value=\"Arial\" class=\"genmed\">
Arial</option> 
<option value=\"Comic Sans MS\" class=\"genmed\">
Comic Sans MS</option>
<option value=\"Courier New\" class=\"genmed\">
Courier New</option> 
                                          <option value=\"Lucida Console\" class=\"genmed\">Lucida Console
                                          </option>
<option value=\"Microsoft Sans Serif\" class=\"genmed\">
Microsoft Sans Serif</option> 
<option value=\"Symbol\" class=\"genmed\">
Symbol</option>
<option value=\"Tahoma\" class=\"genmed\">
Tahoma</option> 
<option value=\"Times New Roman\" class=\"genmed\">
Times New Roman</option>
<option value=\"Traditional Arabic\" class=\"genmed\">
Traditional Arabic</option> 
<option value=\"Verdana\" class=\"genmed\">
Verdana</option> 
<option value=\"Webdings\" class=\"genmed\">
Webdings</option> 
<option value=\"Wingdings\" class=\"genmed\">
Wingdings</option> 
                                  </select></span></span></span><p dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">
              <span class=\"genmed\"><span style=\"font-size: 5pt\">&nbsp;</span></span></td>
		  </tr>
		  <span class=\"gen\">
		  <tr> 
			<td width=\"450\">
			  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				<tr> 
                        <td> 
                          <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr> 
                                  <td>
                                  <p dir=\"ltr\" align=\"left\"><span class=\"gen\">
			  <span class=\"genmed\">
			                      <span lang=\"ar-sy\">&nbsp;</span><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/justify.gif\" name=\"justify\" type=\"image\" onClick=\"BBCjustify()\" style=\"border-style: outset; border-width: 1\" alt=\"justify\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/right.gif\" name=\"right\" type=\"image\" onClick=\"BBCright()\" style=\"border-style: outset; border-width: 1\" alt=\"right\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/center.gif\" name=\"center\" type=\"image\" onClick=\"BBCcenter()\" style=\"border-style: outset; border-width: 1\" alt=\"center\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/left.gif\" name=\"left\" type=\"image\" onClick=\"BBCleft()\" style=\"border-style: outset; border-width: 1\" alt=\"left\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/bold.gif\" name=\"bold\" type=\"image\" onClick=\"BBCbold()\" style=\"border-style: outset; border-width: 1\" alt=\"bold\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/italic.gif\" name=\"italic\" type=\"image\" onClick=\"BBCitalic()\" style=\"border-style: outset; border-width: 1\" alt=\"italic\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/under.gif\" name=\"under\" type=\"image\" onClick=\"BBCunder()\" style=\"border-style: outset; border-width: 1\" alt=\"under line\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/fade.gif\" name=\"fade\" type=\"image\" onClick=\"BBCfade()\" style=\"border-style: outset; border-width: 1\" alt=\"fade\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/grad.gif\" name=\"grad\" type=\"image\" onClick=\"BBCgrad()\" style=\"border-style: outset; border-width: 1\" alt=\"gradient\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/rtl.gif\" name=\"dirrtl\" type=\"image\" onClick=\"BBCdir('rtl')\" style=\"border-style: outset; border-width: 1\" alt=\"Right to Left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ltr.gif\" name=\"dirltr\" type=\"image\" onClick=\"BBCdir('ltr')\" style=\"border-style: outset; border-width: 1\" alt=\"Left to Right\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqd.gif\" name=\"marqd\" type=\"image\" onClick=\"BBCmarqd()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to down\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqu.gif\" name=\"marqu\" type=\"image\" onClick=\"BBCmarqu()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to up\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marql.gif\" name=\"marql\" type=\"image\" onClick=\"BBCmarql()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to left\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/marqr.gif\" name=\"marqr\" type=\"image\" onClick=\"BBCmarqr()\" style=\"border-style: outset; border-width: 1\" alt=\"Marque to right\"></span></span></td>
                                </tr> 
                                <tr> 
                                  <td dir=\"rtl\">
                                  <p align=\"right\" dir=\"rtl\" style=\"margin-top: 0; margin-bottom: 0\">
                                  <span style=\"font-size: 5pt\">&nbsp;</span><p align=\"left\" dir=\"ltr\" style=\"margin-top: 0; margin-bottom: 0\"><span class=\"gen\">
			  <span class=\"genmed\">
			                      &nbsp;<img border=\"0\" src=\"modules/".$module_name."/images/bbcode/code.gif\" name=\"code\" type=\"image\" onClick=\"BBCcode()\" style=\"border-style: outset; border-width: 1\" alt=\"Code\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/quote.gif\" name=\"quote\" type=\"image\" onClick=\"BBCquote()\" style=\"border-style: outset; border-width: 1\" alt=\"Quote\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/url.gif\" name=\"url\" type=\"image\" onClick=\"BBCurl()\" style=\"border-style: outset; border-width: 1\" alt=\"URL\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/email.gif\" name=\"email\" type=\"image\" onClick=\"BBCmail()\" style=\"border-style: outset; border-width: 1\" alt=\"Email\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/web.gif\" name=\"web\" type=\"image\" onClick=\"BBCweb()\" style=\"border-style: outset; border-width: 1\" alt=\"Wep Page\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/img.gif\" name=\"img\" type=\"image\" onClick=\"BBCimg()\" style=\"border-style: outset; border-width: 1\" alt=\"Image\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/flash.gif\" name=\"flash\" type=\"image\" onClick=\"BBCflash()\" style=\"border-style: outset; border-width: 1\" alt=\"Flash\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/video.gif\" name=\"video\" type=\"image\" onClick=\"BBCvideo()\" style=\"border-style: outset; border-width: 1\" alt=\"Video\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/sound.gif\" name=\"stream\" type=\"image\" onClick=\"BBCstream()\" style=\"border-style: outset; border-width: 1\" alt=\"Stream\"><img border=\"0\" src=\"modules/".$module_name."/images/bbcode/ram.gif\" name=\"ram\" type=\"image\" onClick=\"BBCram()\" style=\"border-style: outset; border-width: 1\" alt=\"Real Media\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/hr.gif\" name=\"hr\" type=\"image\" onClick=\"BBChr()\" style=\"border-style: outset; border-width: 1\" alt=\"H-Line\">&nbsp;&nbsp;
                                  <img border=\"0\" src=\"modules/".$module_name."/images/bbcode/plain.gif\" name=\"plain\" type=\"image\" onClick=\"BBCplain()\" style=\"border-style: outset; border-width: 1\" alt=\"Remove BBcode\"></span></td>
                                </tr>
                          </table> 
                        </td> 
                  </tr> 

			  </table>
			</td>
		  </tr>
		  <tr>";
}
function savetutorial($t_title, $tc_id, $description, $t_text, $author, $author_email, $author_homepage, $version, $level, $submitter) {
    global $prefix, $db, $module_name, $tutconfig;
    $tc_id = intval($tc_id);
    include_once("include/bbstuff.php");
    if ($t_title=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOTITLE."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
	include_once("footer.php");
    }
    if ($description=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNODESCRIPTION."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
	include_once("footer.php");
    }
    if ($t_text=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOTUTORIAL."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
	include_once("footer.php");
    }
    if ($author=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOAUTHOR."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
	include_once("footer.php");
    }
    if ($author_email=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOAUTHORMAIL."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
	include_once("footer.php");
    }
    if ($author_homepage=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOAUTHORSITE."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
include_once("footer.php");
    }
    if ($version=="") {
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
	OpenTable();
	echo "<br /><center>"
	    ."<font class=\"content\">"
	    ."<strong>"._TUTADMINERRORNOVERSION."</strong><br /><br />"
	    .""._GOBACK."<br /><br />";
	CloseTable();
    include_once("footer.php");
    }
    $tc_id = explode("-", $tc_id);
    if ($tc_id[1]=="") {
	$tc_id[1] = 0;
    }
    $t_title = stripslashes(FixQuotes($t_title));
    $author = stripslashes(FixQuotes($author));
    $author_email = stripslashes(FixQuotes($author_email));
    $author_homepage = stripslashes(FixQuotes($author_homepage));
    $submitter = stripslashes(FixQuotes($submitter));
    $description = stripslashes(FixQuotes($description));
    $t_text = stripslashes(FixQuotes($t_text));
    $level = intval($level);
    $bbcode_uid = make_bbcode_uid();
    $t_text = insert_bbcode_uid($t_text, $bbcode_uid);
    if($tutconfig['approve_on'] == 0){
    $table_name = $prefix."_tutorials_tutorials";
    }else{
    $table_name = $prefix."_tutorials_submit";
    }
    $db->sql_query("insert into ".$table_name." values (NULL, '$tc_id[0]', '$t_title', '$t_text', now(), '$t_counter', '$version', '$description', '', '$author', '$author_email', '$author_homepage', '$submitter', '', '', '$bbcode_uid', '$level')");
    include_once("header.php");
         $main = 0;
         $submit = ""._TUTMAINSUBMITTUT."";
         menu($main, $submit);
         echo "<br />";
    OpenTable();
    echo "<font class=\"content\"><center><strong>"._TUTMAINSUBSUC."</strong></center>";
    echo "<br /><center>";
    echo "<font class=\"content\">";
    if($tutconfig['approve_on'] == 0){
    echo ""._TUTNEWTUTORIALSUBADD."<br /><br />"._TUTNEWTUTORIALSUBADD3."<br /><br />";
    }else{
    echo ""._TUTNEWTUTORIALSUBADD."<br /><br />"._TUTNEWTUTORIALSUBADD2."<br /><br />";
    }
    CloseTable();
    include_once("footer.php");
}
function getparent($parentid,$tc_title) {
    global $prefix, $db;
    $sql = "SELECT tc_id, tc_title, parentid FROM ".$prefix."_tutorials_categories WHERE tc_id='$parentid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $cid = $row[tc_id];
    $ptitle = $row[tc_title];
    $pparentid = $row[parentid];
    if ($ptitle!="") $tc_title=$ptitle."/".$tc_title;
    if ($pparentid!=0) {
   $tc_title=getparent($pparentid,$ptitle);
    }
    return $tc_title;
}
switch ($t_op){
    default:
    index();
    break;

    case "savetutorial":
    savetutorial($t_title, $tc_id, $description, $message, $author, $author_email, $author_homepage, $version, $level, $submitter, $submitter_homepage, $submitter_email);
    break;
    }

?>
