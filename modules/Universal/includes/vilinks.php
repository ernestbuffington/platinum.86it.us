<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
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

if (stristr($_SERVER['SCRIPT_NAME'], "vilinks.php")) {
	die("Illegal Desolate File Access");
}

$result = $db->sql_query("SELECT id from ".$prefix."_".$mainprefix."_items where language = '$unilang' and active = '1'");

$id_cache = array();
$break = 0;
$previous_id = 0;
while($row = $db->sql_fetchrow($result)) {
  $id_cache[] = $row['id'];
  $next_prev_cache[$row['id']] = $row;
  if ($break) {
    break;
  }
  if ($prev_id == $vid2) {
    $break = 1;
  }
  $prev_id = $row['id'];
}

$first_id = $id_cache['0'];
$getcurrentvalue = array_search($vid2, $id_cache);
$next_id = (isset($id_cache[$getcurrentvalue + 1])) ? $id_cache[$getcurrentvalue + 1] : 0;
$prev_id = (isset($id_cache[$getcurrentvalue - 1])) ? $id_cache[$getcurrentvalue - 1] : 0;
unset($id_cache);

?>