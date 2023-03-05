<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on Platinum Nuke Pro*/
/*                                                                      */
/* Platinum: Your dreams, our imagination                               */
/************************************************************************/

if (!isset($min)) { $min = 0; }
$title = stripslashes(FixQuotes($title));
$url = stripslashes(FixQuotes($url));
$description = stripslashes(FixQuotes($description));
$name = stripslashes(FixQuotes($name));
$email = stripslashes(FixQuotes($email));
$db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET cid='$cat', sid='$perm', title='$title', url='$url', description='$description', name='$rname', email='$email', hits='$hits', filesize='$filesize', version='$version', homepage='$homepage' WHERE lid='$lid'");
Header("Location: ".$admin_file.".php?op=Downloads&min=$min");

?>
