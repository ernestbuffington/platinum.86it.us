<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Top Sites V1.4                                                       */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/* sid@xanys.com                                                        */
/*                                                                      */
/* Based on Web Links Hack                                              */
//* Copyright (c) 2002 by Francisco Burzi                               */
/* http://phpnuke.org                                                   */
/*                                                                      */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
/* Nuke 7.5'd by MrFluffy (mrfluffy@ayhsel.de)                          */
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

$module_name = "Top_Sites";
if (file_exists("modules/$module_name/admin/language/lang-".$currentlang.".php")) {
	@include_once("modules/$module_name/admin/language/lang-".$currentlang.".php");
} else {
	@include_once("modules/$module_name/admin/language/lang-english.php");
}	

switch($op) {

	case "topsites":
	case "topsitesnotvalidelink":
	case "topsitesvalidelink":
	case "topsitesmodifylink":
	case "topsitesmodifylinks":
	case "topsitesvalidatelink":
	case "topsitesdellink":
	case "topsitesadd":
	case "topsitesvisit":
	case "topsitesaddlink":
	case "topsitesaddcat":
	case "topsitesaddcats":
	case "topsitesmodifycat":
	case "topsitesmodifycats":
	case "topsitesmodifycats_bis":
	case "topsitesdelcat":
	case "topsitescleanallsites":
	case "topsitescleanvotes":
	case "topsitesdelvote":
	case "topsitesdelhits":
	case "topsitesconfigure":
	case "topsitesconfiguresave":
	case "topsitesletter":
	case "topsitesendletter":
	@include_once("modules/$module_name/admin/index.php");
	break;
}

?>