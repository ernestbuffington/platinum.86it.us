<?php
/********************************************************/
/* PHP-Nuke Tools v4.00 RC 1                            */
/* By: Disipal Network (http://disipal.net)	        */
/* http://www.disipal.net                               */
/* Copyright © 2003-2009 by Disipal Network             */
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
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
$content  =  "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Module\">"._MODULEC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Block\">"._BLOCKC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLPHP\">"._HTMLC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLASP\">"._HTMLASP."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLJSP\">"._HTMLJSP."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLPERL\">"._HTMLPERL."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLJS\">"._HTMLJS."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLSWS\">"._HTMLSWS."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Source\">"._EDITORC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=MTags\">"._METAC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Pop\">"._POPUP."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Scroll\">"._SCROLLC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=Color\">"._HEXC."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=PREVIEWER\">"._PREVIEWER."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=SourceCoder\">"._SCODER."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=HTMLENCODER\">"._HTMLCODER."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=URLENCODER\">"._URLCODER."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=EMAIL\">"._EMAILCODER."</a><br />";
$content  .= "<strong><big>· </big></strong><a href=\"modules.php?name=PHP-Nuke_Tools&file=index&amp;func=ROT\">"._ROTCODER."</a><br />";
?>
