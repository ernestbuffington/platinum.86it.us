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
global $admin_file;
list($sname) = $db->sql_fetchrow($db->sql_query("SELECT submitter FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'"));
$db->sql_query("UPDATE ".$prefix."_nsngd_accesses SET uploads=uploads-1 WHERE username='$sname'");
$db->sql_query("DELETE FROM ".$prefix."_nsngd_downloads WHERE lid='$lid'");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_downloads");
Header("Location: ".$admin_file.".php?op=Downloads&min=$min");

?>
