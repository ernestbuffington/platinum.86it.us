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

$numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories WHERE title='$title' AND parentid='$cid'"));
if ($numrows>0) {
  $pagetitle = _CATEGORIESADMIN.": "._DL_ERROR;
  include_once("header.php");
  title($pagetitle);
  dladminmain();
  echo "<br />\n";
  OpenTable();
  echo "<center><strong>"._ERRORTHESUBCATEGORY." $title "._ALREADYEXIST."</strong></center><br />\n";
  echo "<center>"._GOBACK."</center>\n";
  CloseTable();
  include_once("footer.php");
} else {
  $db->sql_query("INSERT INTO ".$prefix."_nsngd_categories VALUES (NULL, '$title', '$cdescription', '$cid', '$whoadd', '$uploaddir', '$canupload', 1)");
  Header("Location: ".$admin_file.".php?op=Categories");
}

?>
