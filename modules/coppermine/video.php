<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                             	            */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
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
// Coppermine Photo Gallery 1.3.1D for CMS     2008.02.01               //
// -------------------------------------------------------------------- //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>          //
// http://www.chezgreg.net/coppermine/                                  //
// -------------------------------------------------------------------- //
// Updated by the Coppermine Dev Team                                   //
// (http://coppermine.sf.net/team/)                                     //
// see /docs/credits.html for details                                   //
// ---------------------------------------------------------------------//
// New Port by GoldenTroll                                              //
// http://coppermine.findhere.org/                                      //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/           //
/************************************************************************/
if (!defined('MODULE_FILE')) {
   header('Location: ../../index.php');
   die();
} 
/**********************************/
/*  Module Configuration          */
/* (right side on)                */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
//define('INDEX_FILE', true);
require("modules/" . $name . "/include/load.inc");
pageheader($BREADCRUMB_TEXT ? $BREADCRUMB_TEXT : $lang_index_php['welcome']);
$title = _SELECTLANGUAGE;
starttable('100%', '<center> Streaming videos playing from a playlist -- <a href="http://www.pcnuke.com/modules.php?name=Forums&file=viewtopic&p=3213#3213" target="new">Try addon Now!</a><center>  ');
OpenTable(); 
?>
<!-- BEGIN GENERIC ALL BROWSER FRIENDLY HTML FOR WINDOWS MEDIA PLAYER --> 
<body bgcolor="#000000">
<div align="center"><br><strong>Doubleclick goes full screen</strong><br>
  <p>
  <div align="center">
<object id="MyWMPlayer" classid="clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6" width="600" height="400" VIEWASTEXT codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701' standby='Loading Microsoft Windows Media Player components...' type='application/oleobject'>
        <PARAM NAME="URL" VALUE="modules/coppermine/playlists/list.asx">
        <param name='animationatStart' value='true'>
        <param name='transparentatStart' value='true'>
        <param name='autoStart' value="true">
        <param name='showControls' value="true">
        <param name='loop' value="true">
		<param name="uiMode" value="full">
		<param name="Volume" value="100">
		<PARAM name="bgcolor" value="black">
        <param name="stretchToFit" value="TRUE">
<EMBED src="modules/coppermine/playlists/list.asx" width="600" height="400"  autostart="true" loop="true" type='application/x-mplayer2' pluginspage='http://microsoft.com/windows/mediaplayer/en/download/' id='mediaPlayer' displaysize='4' autosize='-1' bgcolor='darkblue' showcontrols="true" showtracker='-1' showdisplay='0' showstatusbar='-1' videoborder3d='-1' designtimesp='5311'>
</OBJECT>
</p>If you're not using an IE browser and the browser is shutting down, looks like the older type media player, or it's playing audio but not video, you probably need to install the:  <a href="http://www.microsoft.com/windows/windowsmedia/player/version64/plugin.aspx">WMP Plug-in for Firefox, Mozilla</a><br><br><a href="http://www.pcnuke.com" target="new">Addon by Pc-Nuke!</a> <br>
</div>
</body>
<!-- END GENERIC ALL BROWSER FRIENDLY HTML FOR WINDOWS MEDIA PLAYER --> 
<?php
CloseTable(); 
pagefooter();
endtable();
?>
