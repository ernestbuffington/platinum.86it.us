<?php
/************************************************************************************************/
/**  Platinum Nuke Pro Theme																	*/
/**  ===============================															*/
/**  Theme Impressed_II																				*/
/**  Designed By   : D. Miller AkA. DocHaVoC - http://www.havocst.net 							*/
/**  Theme Version : v1.0 (100% Width)															*/
/** Copyright     : A public theme for use with Platinum Nuke Pro http://www.platinumnukepro.com	*/
/**																								*/
/**	  Copyright (c) 2011 D. Miller AkA. DocHaVoC | All Rights Reserved							*/
/************************************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));
/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/

$bgcolor1 = "#c6c7c7";
$bgcolor2 = "#c6c7c7";
$bgcolor3 = "#909090";
$textcolor1 = "#000000";
$textcolor2 = "#000000";
$textcolor3 = "#000000";
$textcolor4 = "#000000";

/************************************************************/
/* OpenTable Functions	                                    */
/************************************************************/
function OpenTable() {
    global $bgcolor1, $bgcolor2;

    echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";   
    echo "<tr>\n";
    echo "<td width=\"63\" height=\"50\"><img src=\"themes/Impressed_II/images/tlc.gif\" alt=\"\" width=\"63\" height=\"50\"></td>\n";
    echo "<td style=\"background-image: url(themes/Impressed_II/images/tm.gif)\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td width=\"63\" height=\"50\"><img src=\"themes/Impressed_II/images/trc.gif\" alt=\"\" width=\"63\" height=\"50\"></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td style=\"background-image: url(themes/Impressed_II/images/tleft.gif)\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td style =\"background-color: #c6c7c7;\">";    
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;

    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\"><tr><td class=extras>\n";
    echo "<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" ><tr><td>\n";
}

function CloseTable() {
	echo "</td>\n";    
    echo "<td style=\"background-image: url(themes/Impressed_II/images/tright.gif)\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td width=\"63\" height=\"33\"><img src=\"themes/Impressed_II/images/blc.gif\" alt=\"\" width=\"63\" height=\"33\"></td>\n";
    echo "<td style=\"background-image: url(themes/Impressed_II/images/btm.gif)\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\"></td>\n";
    echo "<td width=\"63\" height=\"33\"><img src=\"themes/Impressed_II/images/brc.gif\" alt=\"\" width=\"63\" height=\"33\"></td>\n";
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
    global $user, $cookie, $prefix, $sitekey, $db, $name, $flash, $banners, $slogan, $datetime, $topics_list, $searchbox;

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
        $theuser = "<form action=\"modules.php?name=Your_Account\" method=\"post\"><input type=\"text\" name=\"username\" value=\"username\" onFocus=\"if(this.value=='username')this.value='';\" value style=\"width:25;height:18;\"><img src=\"themes/Impressed_II/images/spacer.gif\" width=\"5\" height=\"1\" border=\"0\"><input type=\"password\" name=\"user_password\" value=\"password\" onFocus=\"if(this.value=='password')this.value='';\" value style=\"width:25;height:18;\"><input type=\"hidden\" name=\"random_num\" value=\"$random_num\"><input type=\"hidden\" name=\"gfx_check\" value=\"$code\"><input type=\"hidden\" name=\"op\" value=\"login\"><img src=\"themes/Impressed_II/images/spacer.gif\" width=\"5\" height=\"1\" border=\"0\"><br /><input type=\"image\" value=\"login\" class=\"noborder\" src=\"themes/Impressed_II/images/login.jpg\" border=\"0\" alt=login>
		<a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"themes/Impressed_II/images/reg.jpg\" border=0 alt=register></a></td></form><p>\n";
} else { 
  $theuser = "<img src=\"themes/Impressed_II/images/spacer.gif\" border=0 width=4 height=1><font class=copyright>Welcome&nbsp; 
  $username</font>&nbsp;<a href=\"modules.php?name=Your_Account&op=logout\"><img src=\"themes/Impressed_II/images/logout.jpg\" border=0 alt=logout></a></td>\n"; 
}

    $result = $db->sql_query("SELECT * FROM " . $prefix .
        "_themeconsole WHERE themename='Impressed_II'");
    $themeconsole = $db->sql_fetchrow($result);
    if (($themeconsole['disrightclick'] and !is_admin($admin)) || ($themeconsole['disrightclick'] and
        is_admin($admin) and $themeconsole['adminright'])) {
        echo " <script language=\"javascript\" src=\"themes/Impressed_II/scripts/norightclick.js\">\n";
        echo " </script> \n";
    }
    if (($themeconsole['disselectall'] and !is_admin($admin)) || ($themeconsole['disselectall'] and
        is_admin($admin) and $themeconsole['adminselect'])) {
        echo " <script language=\"javascript\" src=\"themes/Impressed_II/scripts/noselect.js\">\n";
        echo " </script> \n";
    }
/*    if ($themeconsole['encrypt']) {
        include_once('themes/Impressed_II/scripts/csource.php');
    }
*/	
    $flash = "<img src=\"themes/Impressed_II/images/logo.jpg\" width=481 height=161>";
    if ($themeconsole['searchbox'] == 1) {
        $searchbox = "<form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value=\"type search here\" onFocus=\"if(this.value=='type search here')this.value='';\" value style=\"width:150;height:19;\"></td><td align=center background=\"themes/Impressed_II/images/Impressed_II_s2.jpg\" width=49 height=21><input type=\"image\" value=\"search\" src=\"themes/Impressed_II/images/search.gif\" class=noborder border=\"0\" alt=\"submit search\"></td></form>\n";
    } else {
        $searchbox = "&nbsp;</td><td><img src=\"themes/Impressed_II/images/Impressed_II_s2.jpg\" width=49 height=21></td>\n";
    }
    $mess1 = $themeconsole['marq1'];
    $mess2 = $themeconsole['marq2'];
    $mess3 = $themeconsole['marq3'];
    $mess4 = $themeconsole['marq4'];
    $mess5 = $themeconsole['marq5'];
    {	
    echo "<body>\n";	
	include_once("themes/Impressed_II/header.php");
    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
	echo "		<tr valign =\"top\">\n";
    echo "		<td style=\"width: 15px; background-image: url(themes/Impressed_II/images/leftborder.gif)\" align=\"left\" valign =\"top\"><img src=\"themes/Impressed_II/images/leftborder.gif\" width=\"15\" height=\"250\" border=\"0\" alt=\"\"></td>\n";
    echo "		<td valign =\"top\">\n";
    blocks("left");
    echo "    </td>\n";
    echo "		<td style=\"width: 1;\" valign =\"top\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td>\n";
    echo "		<td width=\"100%\">\n";
//NSN banner ads
    if ($banners == 1) {
        @include_once("includes/babanners1.php");
    }
	echo "<center>".$babanners1."</center>";
//NSN banner ads
    $public_msg = public_message();
    echo "$public_msg";
}
	}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/

function themefooter() {
    global $index, $user, $banners, $cookie, $prefix, $db, $foot1, $foot2, $foot3, $foot3, $prefix, $total_time, $start_time;

$maxshow = 10;	// Number of downloads to dispaly in the block.
$a = 1;
$result = $db->sql_query("SELECT lid, title, hits FROM ".$prefix."_links_links ORDER BY date DESC LIMIT 0,$maxshow");
while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) {
    $title2 = str_replace("_", " ", "$title");
    $show .= "&nbsp;&nbsp;&nbsp;$a: <a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$title\">$title2</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"content\">$hits<font class=\"copyright\"> times<br />";
     $showlinks = " <a name= \"scrollingCode\"></a><marquee behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"130\" height=\"100\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$show";
    
    
    $a++;
}


$a = 1;
$sql = "SELECT lid, title FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,10";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $title2 = str_replace("_", " ", $row[title]);
    $content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a><br />";
	 $showdl = " <font class=copyright>&nbsp;</strong><br />&nbsp;<a name= \"scrollingCode\"></a><marquee behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"130\" height=\"100\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$content";

    $a++;
}
	
if (defined('INDEX_FILE')) {

    echo "    </td>\n";
    echo "		<td style=\"width: 1;\" valign =\"top\"><img src=\"themes/Impressed_II/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td>\n";
    echo "		<td width=\"100%\">\n";
	blocks(right);
    }   
    echo "		</td>\n";	    
	echo "		<td valign =\"top\">\n";
    echo "		<td style=\"width: 15px; background-image: url(themes/Impressed_II/images/rightborder.gif)\" align=\"right\" valign =\"top\"><img src=\"themes/Impressed_II/images/rightborder.gif\" width=\"15\" height=\"250\" border=\"0\" alt=\"\"></td>\n";
    echo "	    </tr>\n";
	echo "</table>\n";    

	$mtime = microtime(); 
    $mtime = explode(" ",$mtime); 
    $mtime = $mtime[1] + $mtime[0]; 
    $end_time = $mtime; 
    $total_time = ($end_time - $start_time); 
    $total_time = "".substr($total_time,0,5)." "._SECONDS."";	   
	
    $footer_message = "$foot1 $foot2 $foot3";
    include_once("themes/Impressed_II/footer.php");

//NSN banner ads
    if ($banners == 1) {
        @include_once("includes/babanners2.php");
    }
	echo "<center>".$babanners2."</center>";
//NSN banner ads 
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
    $tmpl_file = "themes/Impressed_II/story_home.htm";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
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
    $tmpl_file = "themes/Impressed_II/story_page.htm";
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
    $tmpl_file = "themes/Impressed_II/blocks.htm";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}
?>