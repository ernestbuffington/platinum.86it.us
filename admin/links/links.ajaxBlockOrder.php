<?php

/************************************************************************/
/* ajaxBlocksEditor   v1.33-Platinum Special Edition                    */
/* for Platinum Nuke Pro version Nuke Pro                                */
/* Module for phpnuke                                                   */
/* Copyright (C) 2006 aman                                              */
/* Web:   http://www.aman.38.com/phpnuke/                               */
/* Email: aman@aman.38.com   2006-09-23 18:23                           */
/* =====================================================================*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */ 
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
if ($radminsuper==1) {
    adminmenu("".$admin_file.".php?op=ajaxBlocksEditor", ""._AJAXBlocksEditor."", "blocks2.gif");
}

?>
