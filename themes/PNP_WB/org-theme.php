<?php

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/

$bgcolor1 = "#ffffff";
$bgcolor2 = "#ffffff";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

/************************************************************/
/* OpenTable Functions	                                    */
/************************************************************/
function OpenTable() {
    global $bgcolor1, $bgcolor2;

    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";   
    echo "<tr>\n";
    echo "<td width=\"57\" height=\"51\"><img src=\"themes/PNP_WB/images/tlc.gif\" alt=\"\" width=\"57\" height=\"51\"></td>\n";
    echo "<td style=\"background-image: url(themes/PNP_WB/images/tm.gif)\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td width=\"57\" height=\"51\"><img src=\"themes/PNP_WB/images/trc.gif\" alt=\"\" width=\"57\" height=\"51\"></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td style=\"background-image: url(themes/PNP_WB/images/tleft.gif)\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td style =\"background-color: #ffffff;\">";    
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;

    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\"><tr><td class=extras>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n";
}

function CloseTable() {
	echo "</td>\n";    
    echo "<td style=\"background-image: url(themes/PNP_WB/images/tright.gif)\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td width=\"57\" height=\"38\"><img src=\"themes/PNP_WB/images/blc.gif\" alt=\"\" width=\"57\" height=\"38\"></td>\n";
    echo "<td style=\"background-image: url(themes/PNP_WB/images/btm.gif)\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td width=\"57\" height=\"38\"><img src=\"themes/PNP_WB/images/brc.gif\" alt=\"\" width=\"57\" height=\"38\"></td>\n";
    echo "</tr>\n";
    echo "</table>";
    
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}    

/************************************************************/
/* FormatStory                                              */
/************************************************************/

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;

    if (!empty($notes)) {
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        echo "<span class=\"content\" color=\"#505050\">$thetext$notes</span>\n";
    } else {
        if(!empty($informant)) {
        	if(is_array($informant)) {
            	$boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
            } else {
            	$boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
            }
        } else {
            $boxstuff = "$anonymous ";
        }
        $boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        echo "<span class=\"content\" color=\"#505050\">$boxstuff</span>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader() {
    global $user, $cookie, $prefix, $sitekey, $db, $dbi, $name, $flash, $banners, $slogan, $datetime, $topics_list, $searchbox;

    cookiedecode($user);
    mt_srand ((double)microtime()*1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    $username = $cookie[1];
       if ($username == "") {
        $username = "Anonymous";
    }
    	if ($username == "Anonymous") {
        $theuser = "<form action=\"modules.php?name=Your_Account\" method=\"post\"><input type=\"text\" name=\"username\" value=\"username\" onFocus=\"if(this.value=='username')this.value='';\" value style=\"width:25;height:18;\"><img src=\"themes/PNP_WB/images/spacer.gif\" width=\"5\" height=\"1\" border=\"0\"><input type=\"password\" name=\"user_password\" value=\"password\" onFocus=\"if(this.value=='password')this.value='';\" value style=\"width:25;height:18;\"><input type=\"hidden\" name=\"random_num\" value=\"$random_num\"><input type=\"hidden\" name=\"gfx_check\" value=\"$code\"><input type=\"hidden\" name=\"op\" value=\"login\"><img src=\"themes/PNP_WB/images/spacer.gif\" width=\"5\" height=\"1\" border=\"0\"><br /><input type=\"image\" value=\"login\" class=\"noborder\" src=\"themes/PNP_WB/images/login.jpg\" border=\"0\" alt=login>
		<a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"themes/PNP_WB/images/reg.jpg\" border=0 alt=register></a></td></form><p>\n";
} else { 
  $theuser = "<img src=\"themes/PNP_WB/images/spacer.gif\" border=0 width=4 height=1><font class=copyright>Welcome&nbsp; 
  $username</font>&nbsp;<a href=\"modules.php?name=Your_Account&op=logout\"><img src=\"themes/PNP_WB/images/logout.jpg\" border=0 alt=logout></a></td>\n"; 
}

    $result = $db->sql_query("SELECT * FROM " . $prefix .
        "_themeconsole WHERE themename='PNP_WB'");
    $themeconsole = $db->sql_fetchrow($result);
    if (($themeconsole['disrightclick'] and !is_admin($admin)) || ($themeconsole['disrightclick'] and
        is_admin($admin) and $themeconsole['adminright'])) {
        echo " <SCRIPT LANGUAGE=\"javascript\" SRC=\"themes/PNP_WB/scripts/norightclick.js\">\n";
        echo " </SCRIPT> \n";
    }
    if (($themeconsole['disselectall'] and !is_admin($admin)) || ($themeconsole['disselectall'] and
        is_admin($admin) and $themeconsole['adminselect'])) {
        echo " <script language=\"javascript\" SRC=\"themes/PNP_WB/scripts/noselect.js\">\n";
        echo " </script> \n";
    }
    if ($themeconsole['encrypt']) {
        include_once('themes/PNP_WB/scripts/csource.php');
    }
    $flash = "<img src=\"themes/PNP_WB/images/logo.jpg\" width=481 height=161>";
    if ($themeconsole['searchbox'] == 1) {
        $searchbox = "<form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value=\"type search here\" onFocus=\"if(this.value=='type search here')this.value='';\" value style=\"width:150;height:19;\"></td><td align=center background=\"themes/PNP_WB/images/XHalo-hd1_s2.jpg\" width=49 height=21><input type=\"image\" value=\"search\" src=\"themes/PNP_WB/images/search.gif\" class=noborder border=\"0\" alt=\"submit search\"></td></form>\n";
    } else {
        $searchbox = "&nbsp;</td><td><img src=\"themes/PNP_WB/images/XHalo-hd1_s2.jpg\" width=49 height=21></td>\n";
    }
    $mess1 = $themeconsole['marq1'];
    $mess2 = $themeconsole['marq2'];
    $mess3 = $themeconsole['marq3'];
    $mess4 = $themeconsole['marq4'];
    $mess5 = $themeconsole['marq5'];
    echo "<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
	include_once("themes/PNP_WB/header.php");
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"middle\">\n";
	echo "		<tr valign =\"top\">\n";
    echo "		<td style=\"width: 51px; background-image: url(themes/PNP_WB/images/leftborder.gif)\" align=\"left\" valign =\"top\"><img src=\"themes/PNP_WB/images/leftborder.gif\" width=\"51\" height=\"250\" border=\"0\" alt=\"\"></td>\n";
    echo "		<td valign =\"top\">\n";
  global $name;
/*    if($name==Forums)*/
    {
    blocks("left");
	}
    echo "    </td>\n";
    echo "		<td style=\"width: 5;\" valign =\"top\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>\n";
    echo "		<td width=\"100%\">\n";

    $public_msg = public_message();
    echo "$public_msg";
}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/

function themefooter() {
    global $index, $user, $banners, $cookie, $prefix, $db, $dbi, $foot1, $foot2, $foot3, $foot3, $babanners1, $prefix, $total_time, $start_time;

$maxshow = 10;	// Number of downloads to dispaly in the block.
$a = 1;
$result = sql_query("select lid, title, hits from ".$prefix."_links_links order by date DESC limit 0,$maxshow", $dbi);
while(list($lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
    $title2 = str_replace("_", " ", "$title");
    $show .= "&nbsp;&nbsp;&nbsp;$a: <a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$title\">$title2</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"content\">$hits<font class=\"copyright\"> times<br />";
     $showlinks = " <a name= \"scrollingCode\"></a><marquee behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"140\" height=\"120\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$show";
    
    
    $a++;
}


$a = 1;
$sql = "SELECT lid, title FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,10";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $title2 = str_replace("_", " ", $row[title]);
    $content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a><br />";
	 $showdl = " <font class=copyright>&nbsp;</strong><br />&nbsp;<a name= \"scrollingCode\"></a><marquee behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"140\" height=\"120\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$content";

    $a++;
}
	
//$index=1; {
    if ($index == 1) {
    echo "    </td>\n";
    echo "		<td style=\"width: 5;\" valign =\"top\"><img src=\"themes/PNP_WB/images/spacer.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>\n";
    echo "		<td width=\"100%\">\n";
	blocks(right);
    }   
    echo "		</td>\n";	    
	echo "		<td valign =\"top\">\n";
    echo "		<td style=\"width: 51px; background-image: url(themes/PNP_WB/images/rightborder.gif)\" align=\"right\" valign =\"top\"><img src=\"themes/PNP_WB/images/rightborder.gif\" width=\"51\" height=\"250\" border=\"0\" alt=\"\"></td>\n";
    echo "	    </tr>\n";
	echo "</table>\n";    

	$mtime = microtime(); 
    $mtime = explode(" ",$mtime); 
    $mtime = $mtime[1] + $mtime[0]; 
    $end_time = $mtime; 
    $total_time = ($end_time - $start_time); 
    $total_time = "".substr($total_time,0,5)." "._SECONDS."";	   
	
    $footer_message = "$foot1<br />$foot2<br />$foot3";
    include_once("themes/PNP_WB/footer.php");

if ($banners == 1) {
        @include_once("includes/babanners3.php");
    }   
}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;

$ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
	$t_image = "$tipath$topicimage";
}
    if ($notes != "") {
        $notes = "<br /><br /><strong>Admin's Comment:</strong> $notes\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= ""._WRITES." \"$thetext\"$notes\n";
    }
     //Code Changed - just show posted by
    $posted = ""._POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time $timezone ";
    //End Code Change
    $tmpl_file = "themes/PNP_WB/story_home.htm";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $dbi) {
    global $admin, $sid, $tipath;
    
$ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
	$t_image = "themes/$ThemeSel/images/topics/$topicimage";
      } else {
	    $t_image = "$tipath$topicimage";
}
    $posted = ""._POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
    if ($notes != "") {
        $notes = "<br /><br /><strong>Admin's Comment:</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
    }
    $tmpl_file = "themes/PNP_WB/story_page.htm";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content, $bid=0) {
    $tmpl_file = "themes/PNP_WB/blocks.htm";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}
?>