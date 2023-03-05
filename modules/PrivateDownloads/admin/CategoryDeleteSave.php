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

$crawled = array($cid);
CrawlLevel($cid);
$x=0;
while ($x <= (sizeof($crawled)-1)) {
  $db->sql_query("DELETE FROM ".$prefix."_nsngd_categories WHERE cid='$crawled[$x]'");
  $db->sql_query("DELETE FROM ".$prefix."_nsngd_downloads WHERE cid='$crawled[$x]'");
  $x++;
}
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_categories");
$db->sql_query("OPTIMIZE TABLE ".$prefix."_nsngd_downloads");
Header("Location: ".$admin_file.".php?op=Categories");

?>
