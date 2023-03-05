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

$lid = intval($lid);
include_once("header.php");
menu(1);
echo "<br />\n";
OpenTable();
echo "<center><font class='option'><strong>"._REPORTBROKEN."</strong></font><br /><br /><br /><font class='content'>\n";
echo "<form action='modules.php?name=$module_name' method='post'>\n";
echo "<input type='hidden' name='lid' value='$lid'>\n";
echo ""._THANKSBROKEN."<br />"._SECURITYBROKEN."<br /><br />\n";
echo "<input type='hidden' name='op' value='brokendownloadS'><input type='submit' value='"._REPORTBROKEN."'></center></form>\n";
CloseTable();
include_once("footer.php");

?>
