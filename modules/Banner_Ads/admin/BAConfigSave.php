<?php

/********************************************************/
/* NSN Banner Ads                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

basave_config("ipp",$ipp);
basave_config("impamnt",$impamnt);
basave_config("usegfxcheck",$usegfxcheck);
header("Location: ".$admin_file.".php?op=BAConfig");

?>