<?php
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

global $admin_file;
if (!preg_match("/".$admin_file.".php/", $PHP_SELF)) { die ("Access Denied"); }

switch($op) {

    case "amazon":
    include_once("admin/modules/amazon.php");
    break;

    case "amazon1":
    include_once("admin/modules/amazon.php");
    break;

    case "amz_stats":
    include_once("admin/modules/amazon.php");
    break;
	
	case "am_add":
    include_once("admin/modules/amazon.php");
    break;
       
    case "am_submit":
    include_once("admin/modules/amazon.php");
    break;
    
    case "am_delete":
    include_once("admin/modules/amazon.php");
    break;

    case "am_delete_nf":
    include_once("admin/modules/amazon.php");
    break;

	case "amazon_cfg":
    include_once("admin/modules/amazon.php");
    break;
	
    case "amz_update":
    include_once("admin/modules/amazon.php");
    break;

	case "amazon_rpt":
    include_once("admin/modules/amazon.php");
    break;

	case "amazon_rpt_nf":
    include_once("admin/modules/amazon.php");
    break;

	case "amazon_reset":
    include_once("admin/modules/amazon.php");
    break;

	case "amazon_del_nf":
    include_once("admin/modules/amazon.php");
    break;
}


?>
