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

$pagetitle = _CATEGORIESADMIN;
$categoryinfo = getcategoryinfo($cid);
include_once("header.php");
title(_CATEGORIESADMIN);
dladminmain();
echo "<br />\n";
OpenTable();
echo "<center>\n";
echo "<strong>"._EZTHEREIS." ".$categoryinfo['categories']." "._EZSUBCAT." "._EZATTACHEDTOCAT."</strong><br />\n";
echo "<strong>"._EZTHEREIS." ".$categoryinfo['downloads']." "._DOWNLOADS." "._EZATTACHEDTOCAT."</strong><br />\n";
echo "<br /><strong>"._DELEZDOWNLOADSCATWARNING."</strong><br /><br />\n";
echo "[ <a href='".$admin_file.".php?op=CategoryDeleteSave&amp;cid=$cid'>"._YES."</a> | <a href='".$admin_file.".php?op=Categories'>"._NO."</a> ]\n";
CloseTable();
include_once("footer.php");

?>
