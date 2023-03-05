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

if (!defined('IN_PHPBB')) {
	die();
}
 
function nuke_sql($query)
{
//echo "before = $query<br />";
        $nuke_sql = str_replace(" username", " username", $query);
        if (preg_match ('/privmsgs_text/', $nuke_sql)){
            $nuke_sql = str_replace("uname_", "username_", $query);
        }
        $nuke_sql = str_replace("u.username", "u.username", $nuke_sql);
        $nuke_sql = str_replace("u2.username", "u2.username", $nuke_sql);
        $nuke_sql = str_replace("user_password", "user_password", $nuke_sql);
        $nuke_sql = str_replace("user_website", "user_website", $nuke_sql);
        if ((stristr($nuke_sql, "user_email,")) || (stristr($nuke_sql, "user_email "))){
            $nuke_sql = str_replace("user_email", "user_email", $nuke_sql);
        }
        $nuke_sql = str_replace("user_interests", "user_intrest", $nuke_sql);
        if (stristr($nuke_sql,"topics_watch") || (stristr($nuke_sql,"user_group"))){
        } else {
            $nuke_sql = str_replace(" user_id", " user_id", $nuke_sql);
        }
        $nuke_sql = str_replace("uid_", "user_id_", $nuke_sql);
        $nuke_sql = str_replace("\(user_id", "\(user_id", $nuke_sql);
        $nuke_sql = str_replace("u.user_id", "u.user_id", $nuke_sql);
        $nuke_sql = str_replace("u2.user_id", "u2.user_id", $nuke_sql);

//echo "after  = $nuke_sql<br /><br />";

    return $nuke_sql;
}

?>
