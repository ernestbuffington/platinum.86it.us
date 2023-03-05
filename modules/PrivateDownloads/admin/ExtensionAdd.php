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

$pagetitle = _EXTENSIONSADMIN.": "._ADDEXTENSION;
include_once("header.php");
title(_EXTENSIONSADMIN);
dladminmain();
echo "<br />\n";
OpenTable();
echo "<table align='center' cellpadding='2' cellspacing='2' border='0'>\n";
echo "<form action='".$admin_file.".php' method='post'>\n";
echo "<tr><td align='center' colspan='2'><strong>"._ADDEXTENSION."</strong></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._EXTENSION.":</td><td><input type='text' name='xext' size='10' maxlength='6'></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._FILETYPE.":</td><td><select name='xfile'>\n";
echo "<option value='0' selected>"._DL_NO."</option>\n";
echo "<option value='1'>"._DL_YES."</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td bgcolor='$bgcolor2'>"._IMAGETYPE.":</td><td><select name='ximage'>\n";
echo "<option value='0' selected>"._DL_NO."</option>\n";
echo "<option value='1'>"._DL_YES."</option>\n";
echo "</select></td></tr>\n";
echo "<input type='hidden' name='op' value='ExtensionAddSave'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._ADDEXTENSION."'></td></tr></form>\n";
echo "</table>\n";
CloseTable();
include_once("footer.php");

?>
