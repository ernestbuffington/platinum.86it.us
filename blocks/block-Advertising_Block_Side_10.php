<?php
/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management Systems           */
/*    ==================--------------------==================          */
/*    Php based web portal systems & more...                            */
/*    http://www.pcnuke.com     &    www.max.pcnuke.com                 */
/*                                                                      */
/************************************************************************/
/*         The Power of the Nuke! - Without the Radiation!              */
/*        =================================================             */
/************************************************************************/
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/
/************************************************************************/
/*   Positions currently are setup this way in the Pc-Nuke!             */
/*   upgraded version of PHP-Nuke adveretising                          */
/* "0" is for "Page Top" advertising.                                   */
/* "1" is for "Block Side" advertising.                                 */
/* "2" is for "Block Center" advertising.                               */
/* "3" is for "Page Bottom" advertising.                                */
/*   To use the position you must include the code: ads(position); in   */
/*   your theme file, where "position" is the number of the position    */
/*   you want to use in that ad space. You can have a look at the file  */
/*   /blocks/block-Advertising.php and file /header.php to have a       */
/*   clear example on how to implement this in your site.               */
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
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
$content .= ads(1);
?>
