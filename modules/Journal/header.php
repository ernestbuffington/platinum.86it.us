<?php

    /************************************************************************/
    /* PHP-NUKE: Advanced Content Management System                         */
    /* ==================================================================== */
    /*                                                                      */
    /* Copyright (c) 2002 by Francisco Burzi                                */
    /* http://phpnuke.org                                                   */
    /*                                                                      */
    /* This program is free software. You can redistribute it and/or modify */
    /* it under the terms of the GNU General Public License as published by */
    /* the Free Software Foundation; either version 2 of the License.       */
    /************************************************************************/
    /* Journal 2.0 Enhanced and Debugged 2004                               */
    /* by sixonetonoffun -- http://www.netflake.com --                      */
    /* Images Created by GanjaUK -- http://www.GanjaUK.com                  */
    /************************************************************************/
if (stristr(htmlentities($_SERVER['PHP_SELF']), "header.php")) {
	Header("Location: index.php");
	die();
}
    require_once("mainfile.php");
    ##################################################
    # Include some common header for HTML generation #
    ##################################################
    $header = 1;
    function head() {
        global $slogan, $sitename, $banners, $nukeurl, $Version_Num, $artpage, $topic, $hlpfile, $user, $hr, $theme, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2, $forumpage, $adminpage, $userpage, $pagetitle;
        $ThemeSel = get_theme();
	include_once("themes/$ThemeSel/theme.php");
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n";
        echo "<html>\n";
        echo "<head>\n";
        echo "<title>$sitename $pagetitle</title>\n";
        include_once("includes/meta.php");
        include_once("includes/javascript.php");
        if (file_exists("themes/$ThemeSel/images/favicon.ico")) {
            echo "<link REL=\"shortcut icon\" HREF=\"themes/$ThemeSel/images/favicon.ico\" TYPE=\"image/x-icon\">\n";
        }
        if (file_exists("modules/Journal/styles/$ThemeSel/style/style.css")) {
            echo "<LINK REL=\"StyleSheet\" HREF=\"modules/Journal/styles/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
        } else {
            echo "<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\">\n\n\n";
        }
        include_once("includes/my_header.php");
        echo "\n\n\n</head>\n\n";
        themeheader();
    }
    online();
    head();
    include_once("includes/counter.php");
if(defined("HOME_FILE")) {
        message_box();
	blocks("Center");
    }

?>