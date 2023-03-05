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

$result = $db->sql_query("SELECT rid, lid, cid, sid, title, url, description, name, email, filesize, version, homepage FROM ".$prefix."_nsngd_mods WHERE rid='$rid'");
while(list($rid, $lid, $cid, $sid, $title, $url, $description, $aname, $email, $filesize, $version, $homepage) = $db->sql_fetchrow($result)) {
  $title = stripslashes($title);
  $title = addslashes($title);
  $description = stripslashes($description);
  $description = addslashes($description);
  $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET cid=$cid, sid=$sid, title='$title', url='$url', description='$description', name='$aname', email='$email', filesize='$filesize', version='$version', homepage='$homepage' WHERE lid='$lid'");
  $db->sql_query("DELETE FROM ".$prefix."_nsngd_mods WHERE rid='$rid'");
  $db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_mods");
}
Header("Location: ".$admin_file.".php?op=DownloadModifyRequests");

?>
