<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NUKE_FILE')) {
  Header("Location: ../index.php");
  die();
}
$content = "";
@include_once("includes/babanners3.php");
$content = "<center>".$babanners3."</center>";
?>