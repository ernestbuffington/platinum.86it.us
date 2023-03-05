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
// List available plugins
// FORMAT: $vs_plugins[Plugin_ID] = "Plugin_Name::Plugin_Location::Image_Location";
// Windows Media Player
$vs_plugins[0] = _WINDOWSMP."::modules/Video_Stream/plugins/windows.php::modules/Video_Stream/images/wmplayer.png";
// Flash Player
$vs_plugins[1] = _FLASHP."::modules/Video_Stream/plugins/flash.php::modules/Video_Stream/images/flash.png";
// Quicktime Player
$vs_plugins[2] = _QUICKTIMEP."::modules/Video_Stream/plugins/quicktime.php::modules/Video_Stream/images/quicktime.png";
// Real Player
$vs_plugins[3] = _REALP."::modules/Video_Stream/plugins/real.php::modules/Video_Stream/images/real.png";
// Custom Embed Code
$vs_plugins[4] = _CUSTOMEMBED."::modules/Video_Stream/plugins/custom.php::modules/Video_Stream/images/custom.png";
// YouTube Player
$vs_plugins[5] = _YOUTUBEVP."::modules/Video_Stream/plugins/youtube.php::modules/Video_Stream/images/youtube.png";
// Google Video Player
$vs_plugins[6] = _GOOGLEVP."::modules/Video_Stream/plugins/google.php::modules/Video_Stream/images/gvideo.png";
// Winamp Plugin
$vs_plugins[7] = _WINAMP."::modules/Video_Stream/plugins/winamp.php::modules/Video_Stream/images/winamp.png";
//FLV Player Plugin
$vs_plugins[8] = _FLVPLAYER."::modules/Video_Stream/plugins/flvplayer.php::modules/Video_Stream/images/flash.png";
?>