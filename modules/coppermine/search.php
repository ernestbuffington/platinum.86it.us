<?php
// ------------------------------------------------------------------------ //
// Coppermine Photo Gallery 1.3.1c for CMS     2007.09.05                   //
// ------------------------------------------------------------------------ //
// Copyright (C) 2002,2003  GrAcgory DEMAR <gdemar@wanadoo.fr>              //
// http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------ //
// Updated by the Coppermine Dev Team                                       //
// (http://coppermine.sf.net/team/)                                         //
// see /docs/credits.html for details                                       //
// ------------------------------------------------------------------------ //
// New Port by GoldenTroll                                                  //
// http://coppermine.findhere.org/                                          //
// Based on coppermine 1.1d by Surf  http://www.surf4all.net/               //
// ------------------------------------------------------------------------ //
// Pc-Nuke! Systems - Development/Support - Coppermine for PHP-Nuke         //
// http://www.pcnuke.com                                                    //
// Website for Port Upgrades from 1.3.0 and up...                           //
// ------------------------------------------------------------------------ //
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
/**********************************/
/*  Module Configuration          */
/* (right side on) v3.1           */
/* Remove the following line      */
/* will remove the right side     */
/**********************************/
define('INDEX_FILE', true);
$index = 1; 
if (preg_match("#modules/#i", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}
define('SEARCH_PHP', true);
require("modules/" . $name . "/include/load.inc");
pageheader($lang_search_php[0]);
$action=getlink("&file=thumbnails&meta=search");
starttable(500, $lang_search_php[0]);
echo <<< EOT
    <tr>
<form method="get" enctype="multipart/form-data" accept-charset="$lang_charset">
        <input type="hidden" name="name" value="coppermine">
        <input type="hidden" name="file" value="thumbnails">
        <input type="hidden" name="meta" value="search">
        <input type="hidden" name="type" value="full">
        <td class="tableb" align="center" height="60">
      <input type="input" style="width: 90%" name="search" maxlength="255" value="" class="textinput">
        </td>
    </tr>
    <tr>
        <td colspan="8" align="center" class="tablef">
            <input type="submit" value="{$lang_search_php[0]}" class="button">
        </td>
        </form>
    </tr>
EOT;
endtable();
pagefooter();
?>
