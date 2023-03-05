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

if (stristr($_SERVER['SCRIPT_NAME'], "block-Bookmark_This.php"))
{
	Header("Location: ../../index.php");
	die();
}
global $prefix, $db, $name, $pagetitle, $nukeurl;
include_once("includes/nukeSEO_sSB.php");
//$content .= "<center><br />";
$content = "<center><br />";
$_SERVER['FULL_URL'] = 'http';
//if($_SERVER['HTTPS']=='on'){
//  $_SERVER['FULL_URL'] .=  's';
//}
$_SERVER['FULL_URL'] .=  '://';
if($_SERVER['SERVER_PORT']!='80') 
  $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'];
else
  $_SERVER['FULL_URL'] .=  $_SERVER['HTTP_HOST'];
if($_SERVER['QUERY_STRING']>' ')
{
  $_SERVER['FULL_URL'] .=  '?'.$_SERVER['QUERY_STRING'];
}
$blogurl = $_SERVER['FULL_URL'];
$blogtitle = $pagetitle;
$content .= getBookmarkHTML2($blogurl, $blogtitle, "&nbsp;","large");
$content .= "</center>";
?>
