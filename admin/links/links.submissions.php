<?php

/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

global $admin_file;
if (($radminsuper==1) OR ($radminarticle==1)) {
    adminmenu("".$admin_file.".php?op=submissions", ""._SUBMISSIONS."", "submissions.gif");
}

?>
