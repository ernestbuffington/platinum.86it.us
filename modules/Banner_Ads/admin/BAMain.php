<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = ": "._BA_TITLE." "._BA_ADMIN." ".$ba_config['version_number'];
@include_once("header.php");
title(_BA_TITLE." "._BA_ADMIN." ".$ba_config['version_number']);
BAAdmin();
@include_once("footer.php");

?>