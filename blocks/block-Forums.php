<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This is a 2 min hack of the old forum block to work with the phpBB2  */
/* port.                                                                */
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
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
	Header('Location: ../index.php');
	die();
}
global $prefix, $db, $sitename;
$sql = 'SELECT t.forum_id, topic_id, topic_title, auth_view, auth_read FROM '.$prefix.'_bbtopics AS t, '.$prefix.'_bbforums AS f WHERE f.forum_id=t.forum_id ORDER BY topic_time DESC LIMIT 10';
$result = $db->sql_query($sql);
$content = '<br />';
while (list($forum_id, $topic_id, $topic_title, $auth_view, $auth_read) = $db->sql_fetchrow($result)) {
	if (($auth_view < 2) OR ($auth_read < 2)) {
		$content .= '<img src="images/arrow.gif" border=\"0\" alt=\"\" title=\"\" width=\"9\" height=\"9\" /> <a href="modules.php?name=Forums&amp;file=viewtopic&amp;t='.$topic_id.'">'.$topic_title.'</a><br />';
	}
}
$content .= '<br /><center><a href="modules.php?name=Forums"><strong>'.$sitename.' Forums</strong></a><br /><br /></center>';
?>
