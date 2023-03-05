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
  $db->sql_query("UPDATE ".$prefix."_nsngd_categories SET active='0' WHERE cid='$crawled[$x]'");
  $db->sql_query("UPDATE ".$prefix."_nsngd_downloads SET active='0' WHERE cid='$crawled[$x]'");
  $x++;
}
Header("Location: ".$admin_file.".php?op=Categories&min=$min");

?>
