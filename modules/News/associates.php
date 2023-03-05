<?php
/************************************************************************/
/* Tricked Out News 2.4a                                                */ 
/* PHP-Platinum Nuke Pro: Expect to be impressed              COPYRIGHT */
/* Copyright (c) 2011 - 2017 by http://www.havocst.net                  */
/* DocHaVoC   (dochavoc(at)havocst(dot)net)                             */ 
/* This is a heavily modified version of the original Platinum Nuke     */ 
/* news module, to act and look more like a blog.                       */ 
/* Tricked Out News that was created originally for RavenNuke(tm)       */ 
/* by Nuken at http://trickedoutnews.com                                */ 
/* Converted to Platinum Nuke by DocHaVoC http://www.havocst.net        */
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
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */
/*                                                                      */
/* Refer to TechGFX.com for detailed information on Platinum Nuke Pro   */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

@require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$sid = intval($sid);
$arow = $db->sql_fetchrow($db->sql_query("SELECT associated FROM ".$prefix."_stories WHERE sid='$sid'"));

if ($arow[associated] != "") {
    OpenTable();
    echo "<center><strong>"._ASSOTOPIC."</strong><br /><br />";
    $asso_t = explode("-",$arow[associated]);
    for ($i=0; $i<sizeof($asso_t); $i++) {
	if ($asso_t[$i] != "") {
	    $atop = $db->sql_fetchrow($db->sql_query("SELECT topicimage, topictext from ".$prefix."_topics WHERE topicid='$asso_t[$i]'"));
	    echo "<a href=\"modules.php?name=$module_name&amp;new_topic=$asso_t[$i]\"><img src=\"$tipath$atop[topicimage]\" border=\"0\" hspace=\"10\" alt=\"$atop[topictext]\" title=\"$atop[topictext]\"></a>";
	}
    }
    echo "</center>";
    CloseTable();
    echo "<br />";
}

?>