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

//
// Check to see if the username has been taken, or if it is disallowed.
// Also checks if it includes the " character, which we don't allow in usernames.
// Used for registering, changing names, and posting anonymously with a username
//

if (!defined('IN_PHPBB')) {
	die();
}

function validate_username($username)
{
        global $db, $lang, $userdata;

        // Remove doubled up spaces
        $username = preg_replace('#\s+#', ' ', trim($username)); 
   $username = phpbb_clean_username($username);

        $sql = "SELECT username
                FROM " . USERS_TABLE . "
                WHERE LOWER(username) = '" . strtolower($username) . "'";
        if ($result = $db->sql_query($sql))
        {
                while ($row = $db->sql_fetchrow($result))
                {
                        if (($userdata['session_logged_in'] && $row['username'] != $userdata['username']) || !$userdata['session_logged_in'])
                        {
                                $db->sql_freeresult($result);
                                return array('error' => true, 'error_msg' => $lang['Username_taken']);
                        }
                }
        }
        $db->sql_freeresult($result);

        $sql = "SELECT group_name
                FROM " . GROUPS_TABLE . "
                WHERE LOWER(group_name) = '" . strtolower($username) . "'";
        if ($result = $db->sql_query($sql))
        {
                if ($row = $db->sql_fetchrow($result))
                {
                        $db->sql_freeresult($result);
                        return array('error' => true, 'error_msg' => $lang['Username_taken']);
                }
        }
        $db->sql_freeresult($result);

        $sql = "SELECT disallow_username
                FROM " . DISALLOW_TABLE;
        if ($result = $db->sql_query($sql))
        {
                if ($row = $db->sql_fetchrow($result))
                {
                        do
                        {
                                if (preg_match("#\b(" . str_replace("\*", ".*?", preg_quote($row['disallow_username'], '#')) . ")\b#i", $username))
                                {
                                        $db->sql_freeresult($result);
                                        return array('error' => true, 'error_msg' => $lang['Username_disallowed']);
                                }
                        }
                        while($row = $db->sql_fetchrow($result));
                }
        }
        $db->sql_freeresult($result);

        $sql = "SELECT word
                FROM  " . WORDS_TABLE;
        if ($result = $db->sql_query($sql))
        {
                if ($row = $db->sql_fetchrow($result))
                {
                        do
                        {
                                if (preg_match("#\b(" . str_replace("\*", ".*?", phpbb_preg_quote($row['word'], '#')) . ")\b#i", $username))
                                {
                                        $db->sql_freeresult($result);
                                        return array('error' => true, 'error_msg' => $lang['Username_disallowed']);
                                }
                        }
                        while ($row = $db->sql_fetchrow($result));
                }
        }
        $db->sql_freeresult($result);

        // Don't allow " and ALT-255 in username.
        if (strstr($username, '"') || strstr($username, '&quot;') || strstr($username, chr(160)) || strstr($username, chr(173)) || preg_match("/[^a-zA-Z0-9_-]/",$username))
        {
                return array('error' => true, 'error_msg' => $lang['Username_invalid']);
        }

        return array('error' => false, 'error_msg' => '');
}

//
// Check to see if email address is banned
// or already present in the DB
//
function validate_email($email)
{
        global $db, $lang;

        if ($email != '')
        {
                if (preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email))
                {
                        $sql = "SELECT ban_email
                                FROM " . BANLIST_TABLE;
                        if ($result = $db->sql_query($sql))
                        {
                                if ($row = $db->sql_fetchrow($result))
                                {
                                        do
                                        {
                                                $match_email = str_replace('*', '.*?', $row['ban_email']);
                                                if (preg_match('/^' . $match_email . '$/is', $email))
                                                {
                                                        $db->sql_freeresult($result);
                                                        return array('error' => true, 'error_msg' => $lang['Email_banned']);
                                                }
                                        }
                                        while($row = $db->sql_fetchrow($result));
                                }
                        }
                        $db->sql_freeresult($result);

                        $sql = "SELECT user_email
                                FROM " . USERS_TABLE . "
                                WHERE user_email = '" . str_replace("\'", "''", $email) . "'";
                        if (!($result = $db->sql_query($sql)))
                        {
                                message_die(GENERAL_ERROR, "Couldn't obtain user email information.", "", __LINE__, __FILE__, $sql);
                        }

                        if ($row = $db->sql_fetchrow($result))
                        {
                                return array('error' => true, 'error_msg' => $lang['Email_taken']);
                        }
                        $db->sql_freeresult($result);

                        return array('error' => false, 'error_msg' => '');
                }
        }

        return array('error' => true, 'error_msg' => $lang['Email_invalid']);
}

//
// Does supplementary validation of optional profile fields. This expects common stuff like trim() and strip_tags()
// to have already been run. Params are passed by-ref, so we can set them to the empty string if they fail.
//
function validate_optional_fields(&$icq, &$aim, &$msnm, &$yim, &$website, &$location, &$occupation, &$interests, &$sig)
{
        $check_var_length = array('aim', 'msnm', 'yim', 'location', 'occupation', 'interests', 'sig');

        for($i = 0; $i < count($check_var_length); $i++)
        {
                if (strlen($$check_var_length[$i]) < 2)
                {
                        
                        $$check_var_length[$i] = '';
                }
        }

        // ICQ number has to be only numbers.
        if (!preg_match('/^[0-9]+$/', $icq))
        {
                $icq = '';
        }

        // website has to start with http://, followed by something with length at least 3 that
        // contains at least one dot.
        if ($website != "")
        {
                if (!preg_match('#^http[s]?:\/\/#i', $website))
                {
                        $website = 'http://' . $website;
                }

                if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $website))
                {
                        $website = '';
                }
        }

        return;
}

?>
