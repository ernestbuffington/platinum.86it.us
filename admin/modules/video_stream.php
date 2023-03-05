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
global $prefix, $db, $admin_file, $currentlang;
if (!preg_match("/".$admin_file.".php/", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
	if ($currentlang) {
		if (file_exists("modules/Video_Stream/lang-admin/lang-$currentlang.php")) { 
			include_once("modules/Video_Stream/lang-admin/lang-$currentlang.php");
		} else {
			include_once("modules/Video_Stream/lang-admin/lang-english.php");
		}
	} else {
		include_once("modules/Video_Stream/lang-admin/lang-english.php");
	}
	include_once("admin/modules/videostream/functions.php");
	include_once("header.php");
	?>
	<script language="javascript" type="text/javascript">
	function disp_confirm(wheretogo, message) {
		var name = confirm(message)
		if (name==true) {
			window.location = ''+wheretogo+''
		}
	}
	</script>
	<?php
	switch($Submit) {
		case "Psettings":
		include_once("admin/modules/videostream/Psettings.php");
		break;
		case "settings":
		include_once("admin/modules/videostream/settings.php");
		break;
		case "addvid":
		include_once("admin/modules/videostream/add_video.php");
		break;
		case "editvid":
		include_once("admin/modules/videostream/edit_video.php");
		break;
		case "deletevid":
		include_once("admin/modules/videostream/delete_video.php");
		break;
		case "broken":
		include_once("admin/modules/videostream/broken.php");
		break;
		case "request":
		include_once("admin/modules/videostream/request.php");
		break;
		case "category":
		include_once("admin/modules/videostream/category.php");
		break;
		default:
		include_once("admin/modules/videostream/manage_videos.php");
		break;
	}
	include_once("footer.php");
} else {
    echo "Access Denied";
}
?>
