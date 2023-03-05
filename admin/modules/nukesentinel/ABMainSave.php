<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/
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

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(!isset($xpage_delay)) { $xpage_delay = 5; }
$xadmin_contact = str_replace("<br>", "\r\n", $xadmin_contact);
$xadmin_contact = str_replace("<br />", "\r\n", $xadmin_contact);
$admin_list = explode("\r\n", $xadmin_contact);
sort($admin_list);
$xadmin_contact = implode("\r\n", $admin_list);
absave_config("admin_contact",$xadmin_contact);
absave_config("block_perpage",$xblock_perpage);
absave_config("block_sort_column",$xblock_sort_column);
absave_config("block_sort_direction",$xblock_sort_direction);
absave_config("crypt_salt",$xcrypt_salt);
absave_config("disable_switch",$xdisable_switch);
absave_config("display_link",$xdisplay_link);
absave_config("display_reason",$xdisplay_reason);
absave_config("dump_directory",$xdump_directory);
absave_config("flood_delay",$xflood_delay);
absave_config("force_nukeurl",$xforce_nukeurl);
absave_config("ftaccess_path",$xftaccess_path);
absave_config("help_switch",$xhelp_switch);
absave_config("htaccess_path",$xhtaccess_path);
absave_config("http_auth",$xhttp_auth);
absave_config("lookup_link",$xlookup_link);
absave_config("page_delay",$xpage_delay);
absave_config("prevent_dos",$xprevent_dos);
absave_config("proxy_reason",$xproxy_reason);
absave_config("proxy_switch",$xproxy_switch);
absave_config("santy_protection",$xsanty_protection);
absave_config("self_expire",$xself_expire);
absave_config("show_right",$xshow_right);
absave_config("site_reason",$xsite_reason);
absave_config("site_switch",$xsite_switch);
absave_config("staccess_path",$xstaccess_path);
absave_config("test_switch",$xtest_switch);
absave_config("track_active",$xtrack_active);
absave_config("track_max",$xtrack_max);
absave_config("track_perpage",$xtrack_perpage);
absave_config("track_sort_column",$xtrack_sort_column);
absave_config("track_sort_direction",$xtrack_sort_direction);
header("Location: ".$admin_file.".php?op=ABMain");

?>