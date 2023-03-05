<?php

/********************************************************/
/* NSN Groups                                           */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/

$pagetitle = "NSN Groups: Error Loading Functions";
include_once("header.php");
title($pagetitle);
OpenTable();
 echo "It appears that NSN Groups has not been configured correctly.  The
most common cause is that you either have an error in the syntax that is
including includes/nsngr_func.php FROM your mainfile.php, or you have not
added the NSN Groups code to your mainfile.php.  This code must be placed
immediately before the closing ?&gt; tag in mainfile.php.  So your first 7
lines in mainfile.php <strong>must look like this</strong>:<br /><br />
<pre>if(defined('FORUM_ADMIN')) {
&nbsp;&nbsp;include_once(\"../../../includes/nsngr_func.php\");
} elseif(defined('INSIDE_MOD')) {
&nbsp;&nbsp;include_once(\"../../includes/nsngr_func.php\");
} else {
&nbsp;&nbsp;include_once(\"includes/nsngr_func.php\");
}
?&gt;</pre>";
CloseTable();
include_once("footer.php");

?>
