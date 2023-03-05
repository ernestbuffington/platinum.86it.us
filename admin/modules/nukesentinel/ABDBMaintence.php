<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2007 by NukeScripts Network         */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(is_god($_COOKIE['admin'])) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_DBMAINTENCE;
  include_once("header.php");
  OpenTable();
  OpenMenu(_AB_DBMAINTENCE);
  ipbanmenu();
  CarryMenu();
  ipdbmenu();
  CloseMenu();
  CloseTable();
  include_once("footer.php");
} else {
  Header("Location: ".$admin_file.".php?op=ABMain");
}

?>