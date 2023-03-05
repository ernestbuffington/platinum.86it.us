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
$pagetitle = _DOWNLOADSADMIN.": "._DOWNLOADVALIDATION;
include_once("header.php");
title(_DOWNLOADSADMIN.": "._DOWNLOADVALIDATION);
dladminmain();
echo "<br />\n";
OpenTable();
echo "<table align='center' width='100%' cellpadding='2' cellspacing='2' border='0'>\n";
echo "<tr><td align='center'><a href='".$admin_file.".php?op=DownloadValidate&amp;cid=0'>"._CHECKALLDOWNLOADS."</a><br /><br /></td></tr>\n";
echo "<tr><td align='center'><strong>"._CHECKCATEGORIES."</strong><br />"._INCLUDESUBCATEGORIES."<br /><br /></td></tr>\n";
$result = $db->sql_query("SELECT * FROM ".$prefix."_nsngd_categories ORDER BY parentid,title");
while($cidinfo = $db->sql_fetchrow($result)) {
  if ($cidinfo['parentid'] != 0) { $cidinfo['title'] = getparent($cidinfo['parentid'],$cidinfo['title']); }
  $transfertitle = str_replace (" ", "_", $cidinfo['title']);
  echo "<tr><td align='center'><a href='".$admin_file.".php?op=DownloadValidate&amp;cid=".$cidinfo['cid']."&amp;ttitle=$transfertitle'>".$cidinfo['title']."</a></td></tr>\n";
}
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>
