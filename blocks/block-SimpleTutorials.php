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
/* Tutorials Module v.1.1.2                                   COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2002 - 2006 by http://www.portedmods.com               */
/*     Mighty_Y - Yannick Reekmans             (mighty_y@portedmods.com)*/
/*                                                                      */
/* See TechGFX.com for detailed information on the Tutorials Module     */
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $prefix, $db;
$result = $db->sql_query("select tc_id from ".$prefix."_tutorials_categories");
$cats = $db->sql_numrows($result);
$result = $db->sql_query("select t_id from ".$prefix."_tutorials_tutorials");
$tutorials = $db->sql_numrows($result);
$content .= "&nbsp;&nbsp;# Tutorials: <strong>$tutorials</strong><br />&nbsp;&nbsp;Categories: <strong>$cats</strong><br /><br />";
$content .= "<center><strong>5&nbsp;Latest Tutorials</strong></center>";
$a = 1;
$result = $db->sql_query("select t_id, t_title, t_counter from ".$prefix."_tutorials_tutorials order by t_date DESC limit 0,5");
while(list($pid, $title) = $db->sql_fetchrow($result)) {
		$title2 = preg_replace("/_/", " ", $title);
	  $content .= "&nbsp;&nbsp;$a- <a href=\"modules.php?name=Tutorials&amp;t_op=showtutorial&amp;pid=$pid\">$title2</a><br />";
		$a++;
}
$content .= "<br /><center><strong>20&nbsp;Most Popular Tutorials</strong></center>";
$a = 1;
$result = $db->sql_query("select t_id, t_title, t_counter from ".$prefix."_tutorials_tutorials order by t_counter DESC limit 0,20");
while(list($pid, $title, $counter) = $db->sql_fetchrow($result)) {
    $title2 = preg_replace("/_/", " ", $title);
    $content .= "&nbsp;&nbsp;$a- <a href=\"modules.php?name=Tutorials&amp;t_op=showtutorial&amp;pid=$pid\">$title2</a><br />[Views: <strong>$counter x</strong>]<br />";
    $a++;
}
?>
