<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$referer = $_SERVER['HTTP_REFERER'];
if ($referer == "") { $referer = $nukeurl; }
bacookiedecode($baclient);
$c_uname = $bacookie[1];
setcookie("baclient");
header("Location: $referer");

?>