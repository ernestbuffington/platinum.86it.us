<?php
/************************************************************************/
/* TechGFX Administrator QuickNav Block              VERSION 1.0.0 BETA */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
global $admin, $admin_file;
if (is_admin($admin)) {
$content = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\"><tr><td><strong>"._AQN."</strong></td></tr>";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php\">"._AAPNP."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules/Forums/admin/index.php\">"._AAFRM."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=adminStory\">"._AANWS."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=messages\">"._AMSGA."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=ajaxBlocksEditor\">"._ABLKA."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=modules\">"._AMODA."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"modules.php?name=Your_Account&amp;file=admin\">"._AYAA."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=Configure\">"._ACNFG."</a></td></tr>\n";
$content .= "<tr><td class=\"row1\">&nbsp;<a href=\"".$admin_file.".php?op=logout\">"._ALGO."</a></td></tr>\n";
$content .= "</table>";
} else {
$content .="<center>Access Denied</center>";
}
?>
