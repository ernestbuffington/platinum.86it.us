<?php

/************************************************************************/
/* PHP-NUKE: DFG Netowrk Navigation                                     */
/* ==================================================================== */
/*                                                                      */
/* Copyright (c) 2007 by www.darkforgegfx.com                           */
/* http://www.darkforgegfx.com                                          */
/*                                                                      */
/************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}


// Configure Display Format: '0' = Off  //  '1' = On
//Turn this Entire Service Off
$display_bar = '1';

//Display the "Home" Button and its functions
$display_home = '1';

//Display the "Clans" Network Button and its functions
$display_clans = '0';

//Display the "Network" Button and its functions
$display_dfgnetwork = '0';

//Display the "Admin" Button and its functions
$display_admin = '1';

//Display the "Account" Button and its functions
$display_account = '1';

//Display the "Files" Button and its functions
$display_files = '1';

//Display the "Forums" Button and its functions
$display_forums = '1';

//Display the "Staff" Button and its functions
$display_staff = '1';

//Display the "Users Online" Button and its functions
$display_users = '1';

//Display the "New PM" Button to Users when a PM is waiting in their Inbox
$display_pm = '1';

//Display the "Forum Post" since Last Visit
$display_newforumpost = '1';

//Display the "News" Ticker Button and its functions
$display_news = '1';  // '1'=Default Info, '2'=Dfg News

//Display the "Home" Button and its functions
$display_date = '1';

//Title of your site news
$site_news = "Sites News";

//Display  Anonymous user Login
$display_anonymous_login = '0';
?>