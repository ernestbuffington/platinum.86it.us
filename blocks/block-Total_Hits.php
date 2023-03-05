<?php
########################################################################
# PHP-Nuke Block: Total Hits v0.1                                      #
#                                                                      #
# Copyright (c) 2001 by C. Verhoef (cverhoef@gmx.net)                  #
#                                                                      #
########################################################################
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
########################################################################
#         Additional security & Abstraction layer conversion           #
#                           2003 chatserv                              #
#      http://www.nukefixes.com -- http://www.nukeresources.com        #
########################################################################
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}
global $prefix, $startdate, $db;
$sql = 'SELECT count FROM '.$prefix.'_counter WHERE type=\'total\' AND var=\'hits\'';
$result = $db->sql_query($sql);
list($hits) = $db->sql_fetchrow($result);
$hits = intval($hits);
$content = '<center><font class="tiny">'._WERECEIVED.'<br /><strong><a href="modules.php?name=Statistics">'.$hits.'</a></strong><br />'._PAGESVIEWS.' '.$startdate.'</font></center>';
?>
