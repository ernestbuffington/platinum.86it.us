<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

$pagetitle = _AB_NUKESENTINEL.": "._AB_IMPORTDATA;
include_once("header.php");
OpenTable();
OpenMenu(_AB_IMPORTDATA);
ipbanmenu();
CarryMenu();
importmenu();
CloseMenu();
CloseTable();
include_once("footer.php");

?>