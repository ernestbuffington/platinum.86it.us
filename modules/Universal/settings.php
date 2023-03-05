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

if ( !defined('MODULE_FILE') ) {
	die("Illegal Module File Access");
}

// Do not delete this file.

$mainprefix = "universal";

function getconfigvar($var) {
    global $prefix, $db, $mainprefix;
    static $umsave;
    if (is_array($umsave)) {
        if (isset($umsave[$var])) return ($umsave[$var]);
        return 0;
    }
    $result = $db->sql_query("select name, value from ".$prefix."_".$mainprefix."_cfg");
    	while(list($name, $value) = $db->sql_fetchrow($result)) {
    		$umsave[$name] = $value;
    }
    if (isset($umsave[$var])) return ($umsave[$var]);
    return 0;
}

// Not to be moved
// Set to one to disable message about settings.php being writable
// Use only on NT (Windows) Systems
// If using Linux/Unix/FreeBSD, etc CHMOD settings.php 0644

$isnt = 1;

?>