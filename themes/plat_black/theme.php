<?php
/************************************************************************/
/* PHP-Nuke Platinum: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2007 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to Futurenuke.com for detailed information on PHP-Nuke Platinum*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/
$bgcolor1 = "000000";
$bgcolor2 = "000000";
$bgcolor3 = "000000";
$bgcolor4 = "000000";
$textcolor1 = "#3eb7ef";
$textcolor2 = "#3eb7ef";

include_once("themes/plat_black/tables.php");

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
    global  $admin, $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $nukeurl, $anonymous;
    if ($banners == 1) {
        @include_once("includes/babanners1.php");
    }

        cookiedecode($user);
    $username = $cookie[1];
    if ($username == "") {
        $username = "Anonymous";
    }
    echo "<body bgcolor=\"#000000\" text=\"#3eb7ef\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
	
    if ($username == "Anonymous") {
	$theuser = "&nbsp;&nbsp;<a href=\"modules.php?name=Your_Account\">"._LOGIN."</a> or <a href=\"modules.php?name=Your_Account&op=new_user\">"._BREG."</a>";
    } else {
	$theuser = "&nbsp;&nbsp;"._BWEL." $username!";
    }


            	    $datetime = "<script type=\"text/javascript\">\n\n"
	        ."<!--   // Array ofmonth Names\n"
	        ."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
	        ."var now = new Date();\n"
	        ."thisYear = now.getYear();\n"
	        ."if(thisYear < 1900) {thisYear += 1900}; // corrections if Y2K display problem\n"
	        ."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
	        ."// -->\n\n"
	        ."</script>";
	//NSN banner ads
    if ($banners == 1) {
        @include_once("includes/babanners1.php");
    }
	echo "<center>".$babanners1."</center>";
//NSN banner ads        
    $public_msg = public_message();
        $result = $db->sql_query("SELECT * FROM ".$prefix."_themeconsole WHERE themename='plat_black'");
    $themeconsole = $db->sql_fetchrow($result);
    if (($themeconsole['disrightclick'] AND !is_admin($admin)) || ($themeconsole['disrightclick'] AND is_admin($admin) AND $themeconsole['adminright']) ) {
    echo " <SCRIPT LANGUAGE=\"javascript\" SRC=\"themes/plat_black/scripts/norightclick.js\">\n";
    echo " </SCRIPT> \n";
    }
    if (($themeconsole['disselectall'] AND !is_admin($admin)) || ($themeconsole['disselectall'] AND is_admin($admin) AND $themeconsole['adminselect']) ) {
    echo " <SCRIPT LANGUAGE=\"javascript\" SRC=\"themes/plat_black/scripts/noselect.js\">\n";
    echo " </SCRIPT> \n";
    }
    if ($themeconsole['encrypt']) {
	@include_once('themes/plat_black/scripts/csource.php');
    }
	$flash = "<img src=\"themes/plat_black/images/plat_black-hd1_logo.jpg\" width=\"481\" height=\"161\" alt=\"\">";
    if ($themeconsole['searchbox'] == 1) {
	    $searchbox = "&nbsp;</TD><TD><img src=\"themes/plat_black/images/plat_black-hd1_s2.jpg\" WIDTH=\"49\" HEIGHT=\"21\" ALT=\"\"></TD>\n";
//        $searchbox = "<form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value=\"type search here\" onFocus=\"if(this.value=='type search here')this.value='';\" value style=\"width:150;height:19;\"></TD><TD align=center background=\"themes/plat_black/images/plat_black-hd1_s2.jpg\" WIDTH=49 HEIGHT=21><input type=\"image\" value=\"search\" src=\"themes/plat_black/images/search.gif\" class=noborder border=\"0\" alt=\"submit search\"></TD></form>\n";
	} else {
	$searchbox = "&nbsp;</TD><TD><img src=\"themes/plat_black/images/plat_black-hd1_s2.jpg\" WIDTH=\"49\" HEIGHT=\"21\" ALT=\"\"></TD>\n";
    }
    $mess1 = $themeconsole['marq1'];
    $mess2 = $themeconsole['marq2'];
    $mess3 = $themeconsole['marq3'];
    $mess4 = $themeconsole['marq4'];
    $mess5 = $themeconsole['marq5'];
    $tmpl_file = "themes/plat_black/header.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
    blocks(left);
    $tmpl_file = "themes/plat_black/left_center.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
    global $index, $foot1, $foot2, $foot3, $foot4, $banners, $copyright, $totaltime, $footer_message;
    if ($index == 1) {
	$tmpl_file = "themes/plat_black/center_right.html";
	$thefile = implode("", file($tmpl_file));
	$thefile = addslashes($thefile);
	$thefile = "\$r_file=\"".$thefile."\";";
	eval($thefile);
	print $r_file;
	blocks(right);
    }	
    $tmpl_file = "themes/plat_black/footer.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
                    echo "<center>\n";
        $footer_message = footmsg();
            echo "</center>\n";
// PLEASE DO NOT TOUCH THE NEXT LINE.
// YOU CAN ONLY ADD TO IT IF YOU MODIFY THIS THEME :-)

	echo "<br>\n";
//NSN banner ads
    if ($banners == 1) {
        @include_once("includes/babanners2.php");
    }
	echo "<center>".$babanners2."</center>";
//NSN banner ads
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;
    if ($notes != "") {
	$notes = "<br><br><strong>"._NOTE."</strong> <i>$notes</i>\n";
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
	$content .= ""._WRITES." \"$thetext\" $notes\n";
    }
    $posted = ""._POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time $timezone ($counter "._READS.")";
    $tmpl_file = "themes/plat_black/story_home.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themearticle()                                  */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath;
    $posted = ""._POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
    if ($notes != "") {
	$notes = "<br><br><strong>"._NOTE."</strong> <i>$notes</i>\n";
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
	$content .= ""._WRITES." \"$thetext\" $notes\n";
    }
    $tmpl_file = "themes/plat_black/story_page.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
    $tmpl_file = "themes/plat_black/blocks.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

?>
