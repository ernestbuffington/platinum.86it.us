<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

grsave_config("perpage",$xperpage);
grsave_config("date_format",$xdate_format);
grsave_config("send_notice",$xsend_notice);
Header("Location: ".$admin_file.".php?op=NSNGroups");

?>