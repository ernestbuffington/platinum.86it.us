<?php
/*********************************************************************/
/* XHalo v.2                                         README */
/*                                                                   */
/* XHalo v.2 is a public theme package designed for PHP-Nuke         */
/* Platinum 7.6.x.                                                   */
/*                                                                   */
/* Features overview:                                                */
/*   - Dark/chrome colour scheme.                                    */
/*   - Includes matching PHPbb theme.                                */
/*   - Included PSD's for easy editing.                              */
/*   - Secure and customise XHalo with anti-theft management using   */
/*     ThemeConsole.                                                 */
/*                                                                   */
/* See TechGFX.com for detailed information on the XHalo v.2      */
/*                                                                   */
/* TechGFX: Your dreams, Our imagination                             */
/*********************************************************************/
/* All content and includes from this package is intellectual        */
/* property of TechGFX.com unless stated otherwise. Replication of   */
/* and copyrighted material is a civil and criminal act and          */
/* voilations may result in legal action.                            */
/*********************************************************************/
/* Copyright (c) 2004 by http://www.techgfx.com                      */
/*     Techgfx        (goose@techgfx.com)                            */
/*     Sigil          (sigil@techgfx.com)                            */
/* Copyright (c) 2004 by http://www.portedmods.com                   */
/*     Mighty_Y       (mighty_y@portedmods.com)                      */
/* Copyright (c) 2004 by http://www.mtechnik.net                     */
/*     Mtechnik       (mtechnik@mtechnik.net)                        */
/* Copyright (c) 2004 by http://www.daveshouse.net                   */
/*     DavidTomneyUK  (webmaster@daveshouse.net)                     */
/* ==================                                                */
/* Copyright (c) 2003 by Francisco Burzi http://phpnuke.org          */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2007 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* TechGFX: Your dreams, our imagination                                */
/************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "theme.php")) {
    die("Access Denied");
}

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/
$bgcolor1 = "#C0C0C0";
$bgcolor2 = "#C0C0C0";
$bgcolor3 = "#C0C0C0";
$bgcolor4 = "#C0C0C0";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

/*********************************************************************/
/*                                                       OPEN TABLE  */
/*********************************************************************/

function OpenTable()
{
    global $bgcolor1, $bgcolor2;
?>
<table bgcolor="#C0C0C0" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td><img name="tlc" src="themes/Impressed/images/tlc.gif" width="13" height="20"></td>
		<td background="themes/Impressed/images/tm.gif" width="100%"><img name="tm" src="themes/Impressed/images/spacer.gif" width="1" height="1" border="0"></td>
		<td><img name="trc" src="themes/Impressed/images/trc.gif" width="13" height="20"></td>
	</tr>
	<tr>
		<td background="themes/Impressed/images/tleft.gif"><img name="tleft" src="themes/Impressed/images/spacer.gif" width="1" height="1" border="0"></td>
        <td valign="top" bgcolor="#C0C0C0">
<?php
}

function OpenTable2()
{
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" ><tr><td class=extra>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n";
}

function CloseTable()
{
?>
   <td background="themes/Impressed/images/tright.gif"><img name="tright" src="themes/Impressed/images/spacer.gif" width="1" height="1" border="0"> </td>
	</tr>
	<tr>
        <td><img src="themes/Impressed/images/blc.gif" width="13" height="15" ></td>
		<td background="themes/Impressed/images/bm.gif" width="100%"><img name="bm" src="themes/Impressed/images/spacer.gif" width="1" height="1" border="0"></td>
		<td><img src="themes/Impressed/images/brc.gif" width="13" height="15" ></td>
	</tr></table>
<?php
}

function CloseTable2()
{
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* FormatStory                                              */
/************************************************************/
function FormatStory($thetext, $notes, $aid, $informant)
{
    global $anonymous;
    if ($notes != "") {
        $notes = "<br /><br /><strong>" . _NOTE . "</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        echo "<font class=\"content\" color=\"#505050\">$thetext$notes</font>\n";
    } else {
        if ($informant != "") {
            $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $boxstuff = "$anonymous ";
        }
        $boxstuff .= "" . _WRITES . " <i>\"$thetext\"</i>$notes\n";
        echo "<font class=\"content\" color=\"#505050\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader()
{
    global $user, $cookie, $prefix, $banners, $sitekey, $flash, $searchbox, $db;
	
    cookiedecode($user);
    mt_srand((double)microtime() * 1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    $username = $cookie[1];
    if ($username == "") {
        $username = "Anonymous";
    }
    $public_msg = public_message();
    echo "$public_msg";

    if ($username == "Anonymous") {
        $theuser = "<form action=\"modules.php?name=Your_Account\" method=\"post\"><input class=border type=\"text\" name=\"username\" value=\"username\" onFocus=\"if(this.value=='username')this.value='';\" value style=\"width:187;height:14;\"><input type=\"password\" class=noborder name=\"user_password\" value=\"password\" onFocus=\"if(this.value=='password')this.value='';\" value style=\"width:187;height:14;\">&nbsp;<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">>&nbsp;<input type=\"hidden\" name=\"gfx_check\" value=\"$code\">>&nbsp;<input type=\"hidden\" name=\"op\" value=\"login\"><input type=\"image\" value=\"login\" class=border src=\"themes/Impressed/images/login.gif\" border=\"0\"></form>\n";

    } else {
        $theuser = "&nbsp;</td>\n";
    }

    $result = $db->sql_query("SELECT * FROM " . $prefix .
        "_themeconsole WHERE themename='Impressed'");
    $themeconsole = $db->sql_fetchrow($result);
    if (($themeconsole['disrightclick'] and !is_admin($admin)) || ($themeconsole['disrightclick'] and
        is_admin($admin) and $themeconsole['adminright'])) {
        echo " <SCRIPT LANGUAGE=\"javascript\" SRC=\"themes/Impressed/scripts/norightclick.js\">\n";
        echo " </SCRIPT> \n";
    }
    if (($themeconsole['disselectall'] and !is_admin($admin)) || ($themeconsole['disselectall'] and
        is_admin($admin) and $themeconsole['adminselect'])) {
        echo " <script language=\"javascript\" SRC=\"themes/Impressed/scripts/noselect.js\">\n";
        echo " </script> \n";
    }
/*    if ($themeconsole['encrypt']) {
        include_once('themes/Impressed/scripts/csource.php');
    }
	*/
    $flash = "<img src=\"themes/Impressed/images/logo.jpg\" width=481 height=161>";
    if ($themeconsole['searchbox'] == 1) {
        $searchbox = "<form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value=\"type search here\" onFocus=\"if(this.value=='type search here')this.value='';\" value style=\"width:150;height:19;\"></td><td align=center background=\"themes/Impressed/images/XHalo-hd1_s2.jpg\" width=49 height=21><input type=\"image\" value=\"search\" src=\"themes/Impressed/images/search.gif\" class=noborder border=\"0\" alt=\"submit search\"></td></form>\n";
    } else {
        $searchbox = "&nbsp;</td><td><img src=\"themes/Impressed/images/XHalo-hd1_s2.jpg\" width=49 height=21></td>\n";
    }
    $mess1 = $themeconsole['marq1'];
    $mess2 = $themeconsole['marq2'];
    $mess3 = $themeconsole['marq3'];
    $mess4 = $themeconsole['marq4'];
    $mess5 = $themeconsole['marq5'];
    echo "<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
    include_once("themes/Impressed/header.php");

    echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n" .
        "<tr valign=\"top\">\n" . "<td width=\"20\" valign=\"top\" background=\"themes/Impressed/images/lt.gif\"><img name=\"lt\" src=\"themes/Impressed/images/spacer.gif\" width=\"20\" height=\"1\" border=\"0\" alt=\"\"></td>\n" .
        "<td width=\"175\" bgcolor=\"#C0C0C0\" valign=\"top\">\n";
  global $name;
/*    if($name==Forums)*/
    {
    blocks(left);
    }  
    echo "</td>\n" . "<td width=\"1\" valign=\"top\" background=\"themes/Impressed/images/spacer.gif\"><img src=\"themes/Impressed/images/spacer.gif\" width=\"1\" height=\"1\" border=\"0\"></td>\n" .
        "<td width=\"100%\">\n";
//NSN banner ads
    if ($banners == 1) {
        @include_once("includes/babanners1.php");
    }
	echo "<center>".$babanners1."</center>";
//NSN banner ads
}

/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter()
{
    global $index, $user, $banners, $cookie, $prefix, $db, $admin, $adminmail,
        $nukeurl;

	if (defined('INDEX_FILE')) {
//$index=1; {
//    if ($index == 1) {
        echo "</td>\n" . "<td width=\"1\" valign=\"top\" background=\"themes/Impressed/images/spacer.gif\"><img src=\"themes/Impressed/images/spacer.gif\" width=\"1\" height=\"1\" border=\"0\"></td>\n" .
            "<td width=\"175\" valign=\"top\">\n";
        blocks('right');
    }
    echo "</td>\n" . "<td width=\"20\" valign=\"top\" background=\"themes/Impressed/images/rt.gif\"><img src=\"themes/Impressed/images/rt.gif\" width=\"20\" height=\"1\" border=\"0\"></td>\n" .
        "</tr>\n" . "</table>\n\n\n";

    include_once("themes/Impressed/footer.php");
	
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
function themeindex($aid, $informant, $time, $title, $counter, $topic, $thetext,
    $notes, $morelink, $topicname, $topicimage, $topictext)
{
    global $anonymous, $tipath;

    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
        $t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
        $t_image = "$tipath$topicimage";
    }
    if ($notes != "") {
        $notes = "<br /><br /><strong>" . _NOTE . "</strong> $notes\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if ($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= "" . _WRITES . " \"$thetext\"$notes\n";
    }
    $posted = "" . _POSTEDBY . " ";
    $posted .= get_author($aid);
    $posted .= " " . _ON . " $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
    $tmpl_file = "themes/Impressed/story_home.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"" . $thefile . "\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/************************************************************/
function themearticle($aid, $informant, $datetime, $title, $thetext, $topic, $topicname,
    $topicimage, $topictext)
{
    global $admin, $sid, $tipath;
    $ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
        $t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
        $t_image = "$tipath$topicimage";
    }
    $posted = "" . _POSTEDON . " $datetime " . _BY . " ";
    $posted .= get_author($aid);
    if ($notes != "") {
        $notes = "<br /><br /><strong>" . _NOTE . "</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if ($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= "" . _WRITES . " <i>\"$thetext\"</i>$notes\n";
    }
    $tmpl_file = "themes/Impressed/story_page.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"" . $thefile . "\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content)
{
    $tmpl_file = "themes/Impressed/blocks.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"" . $thefile . "\";";
    eval($thefile);
    print $r_file;
}

/*********************************************************************/
/* - Redistributing ThemeConsole in any form is NOT permitted.       */
/* - Renaming files is NOT permitted.                                */
/* - This package cannot be ported without expressed permission from */
/*   either Techgfx, Anor or Mighty_Y on behalf of TechGFX.com.      */
/* - This package cannot be mirrored without expressed permission    */
/*   from either Techgfx, Anor or Mighty_Y on behalf of TechGFX.com. */
/* - Use of this package requires all credits to all authors to      */
/*   remain in all locations that are set as default.                */
/* - The following are the only sites permitted to mirror any release*/
/*   from TechGFX public theme package releases:                     */
/*     1. http://www.TechGFX.com                                     */
/*     2. http://www.PortedMods.com                                  */
/*     3. http://www.PHPNukeFiles.com                                */
/*     4. http://www.NukePlatinum.net                                */
/*     5. http://Protector.Warcenter.se                              */
/*     6. http://GT.AudioSlaved.com.com                              */
/*********************************************************************/
/* TechGFX: Corporate Alliance                                       */
/*  - PortedMods.com                                                 */
/*  - Protector.Warcenter.se                                         */
/*  - GT.AudioSlaved.com                                             */
/*********************************************************************/

?>