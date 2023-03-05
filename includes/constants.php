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
global $admin_file;

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
define_once('RNYA', true);
//define_once("CNBYA_DOMAINNAME", "");
// Debug Level
//define_once('DEBUG', 0); // Debugging on
define_once('DEBUG', 1); // Debugging off

// User Levels <- Do not change the values of USER or ADMIN
define_once('DELETED', -1);
define_once('ANONYMOUS', 1);

define_once('USER', 1);
define_once('ADMIN', 2);
define_once('MOD', 3);


// User related
define_once('USER_ACTIVATION_NONE', 0);
define_once('USER_ACTIVATION_SELF', 1);
define_once('USER_ACTIVATION_ADMIN', 2);

define_once('USER_AVATAR_NONE', 0);
define_once('USER_AVATAR_UPLOAD', 1);
define_once('USER_AVATAR_REMOTE', 2);
define_once('USER_AVATAR_GALLERY', 3);


// Group settings
define_once('GROUP_OPEN', 0);
define_once('GROUP_CLOSED', 1);
define_once('GROUP_HIDDEN', 2);
define_once('GROUP_INITIAL_NO', 0);
define_once('GROUP_INITIAL_YES', 1);

// Forum state
define_once('FORUM_UNLOCKED', 0);
define_once('FORUM_LOCKED', 1);


// Topic status
define_once('TOPIC_UNLOCKED', 0);
define_once('TOPIC_LOCKED', 1);
define_once('TOPIC_MOVED', 2);
define_once('TOPIC_WATCH_NOTIFIED', 1);
define_once('TOPIC_WATCH_UN_NOTIFIED', 0);


// Topic types
define_once('POST_NORMAL', 0);
define_once('POST_STICKY', 1);
define_once('POST_ANNOUNCE', 2);
define_once('POST_GLOBAL_ANNOUNCE', 3);

// BEGIN Advanced_Report_Hack
// Report category types
define_once('REPORT_NORMAL', 0);
define_once('REPORT_EXT', 1);
// Report status
define_once('REPORT_NOT_CLEARED', 0);
define_once('REPORT_IN_PROCESS', 1);
define_once('REPORT_CLEARED', 2);
// Special categories
define_once('REPORT_POST_ID', 1);
define_once('REPORT_TOPIC_ID', 2);
define_once('REPORT_USER_ID', 3);
// END Advanced_Report_Hack

// SQL codes
define_once('BEGIN_TRANSACTION', 1);
define_once('END_TRANSACTION', 2);


// Error codes
define_once('GENERAL_MESSAGE', 200);
define_once('GENERAL_ERROR', 202);
define_once('CRITICAL_MESSAGE', 203);
define_once('CRITICAL_ERROR', 204);


// Private messaging
define_once('PRIVMSGS_READ_MAIL', 0);
define_once('PRIVMSGS_NEW_MAIL', 1);
define_once('PRIVMSGS_SENT_MAIL', 2);
define_once('PRIVMSGS_SAVED_IN_MAIL', 3);
define_once('PRIVMSGS_SAVED_OUT_MAIL', 4);
define_once('PRIVMSGS_UNREAD_MAIL', 5);


// URL PARAMETERS
define_once('POST_TOPIC_URL', 't');
define_once('POST_CAT_URL', 'c');
define_once('POST_FORUM_URL', 'f');
define_once('POST_USERS_URL', 'u');
define_once('POST_POST_URL', 'p');
define_once('POST_GROUPS_URL', 'g');

// Session parameters
define_once('SESSION_METHOD_COOKIE', 100);
define_once('SESSION_METHOD_GET', 101);


// Page numbers for session handling
define_once('PAGE_INDEX', 0);
define_once('PAGE_LOGIN', -1);
define_once('PAGE_SEARCH', -2);
define_once('PAGE_REGISTER', -3);
define_once('PAGE_PROFILE', -4);
define_once('PAGE_VIEWONLINE', -6);
define_once('PAGE_VIEWMEMBERS', -7);
define_once('PAGE_FAQ', -8);
define_once('PAGE_POSTING', -9);
define_once('PAGE_PRIVMSGS', -10);
define_once('PAGE_GROUPCP', -11);
// BEGIN Advanced_Report_Hack
define_once('PAGE_REPORT', -2041);
// END Advanced_Report_Hack
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
define_once('PAGE_THREAD_KICKER', -1200);
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
define_once('PAGE_GAME', -50);
define_once('PAGE_ARCADES', -51);
define_once('PAGE_TOPARCADES', -52);
define_once('PAGE_STATARCADES', -53);
define_once('PAGE_SCOREBOARD', -54);
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3         START */
/*****************************************************/
define_once('PAGE_STAFF', -12);
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3           END */
/*****************************************************/
define_once('PAGE_TOPIC_OFFSET', 5000);


// Auth settings
define_once('AUTH_LIST_ALL', 0);
define_once('AUTH_ALL', 0);

define_once('AUTH_REG', 1);
define_once('AUTH_ACL', 2);
define_once('AUTH_MOD', 3);
define_once('AUTH_ADMIN', 5);

define_once('AUTH_VIEW', 1);
define_once('AUTH_READ', 2);
define_once('AUTH_POST', 3);
define_once('AUTH_REPLY', 4);
define_once('AUTH_EDIT', 5);
define_once('AUTH_DELETE', 6);
define_once('AUTH_ANNOUNCE', 7);
define_once('AUTH_STICKY', 8);
define_once('AUTH_POLLCREATE', 9);
define_once('AUTH_VOTE', 10);
define_once('AUTH_ATTACH', 11);
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
define_once('AUTH_GLOBALANNOUNCE', 12); 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/

// Table names
define_once('CONFIRM_TABLE', $prefix.'_bbconfirm');
define_once('AUTH_ACCESS_TABLE', $prefix.'_bbauth_access');
define_once('BANLIST_TABLE', $prefix.'_bbbanlist');
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
define_once('BUDDIES_TABLE', $prefix.'_bbbuddies');
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
define_once('CATEGORIES_TABLE', $prefix.'_bbcategories');
define_once('CONFIG_TABLE', $prefix.'_bbconfig');
define_once('DISALLOW_TABLE', $prefix.'_bbdisallow');
define_once('FORUMS_TABLE', $prefix.'_bbforums');
define_once('FORUMS_WATCH_TABLE', $prefix.'_bbforums_watch');
define_once('GROUPS_TABLE', $prefix.'_bbgroups');
define_once('POSTS_TABLE', $prefix.'_bbposts');
define_once('POSTS_TEXT_TABLE', $prefix.'_bbposts_text');
define_once('PRIVMSGS_TABLE', $prefix.'_bbprivmsgs');
define_once('PRIVMSGS_TEXT_TABLE', $prefix.'_bbprivmsgs_text');
define_once('ADMIN_PM_TABLE', $prefix .'_bbadmin_pm');
define_once('PRIVMSGS_IGNORE_TABLE', $prefix.'_bbprivmsgs_ignore');
define_once('PRUNE_TABLE', $prefix.'_bbforum_prune');
define_once('RANKS_TABLE', $prefix.'_bbranks');
// BEGIN Advanced_Report_Hack
define_once('REPORT_CAT_TABLE', $prefix.'_bbreport_cat');
define_once('REPORT_TABLE', $prefix.'_bbreport');
// END Advanced_Report_Hack
define_once('SEARCH_TABLE', $prefix.'_bbsearch_results');
define_once('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define_once('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define_once('SESSIONS_TABLE', $prefix.'_bbsessions');
define_once('SESSIONS_KEYS_TABLE', $prefix.'_bbsessions_keys');

define_once('SMILIES_TABLE', $prefix.'_bbsmilies');
define_once('THEMES_TABLE', $prefix.'_bbthemes');
define_once('THEMES_NAME_TABLE', $prefix.'_bbthemes_name');
define_once('TOPICS_TABLE', $prefix.'_bbtopics');
define_once('TOPICS_WATCH_TABLE', $prefix.'_bbtopics_watch');
define_once('USER_GROUP_TABLE', $prefix.'_bbuser_group');
define_once('USERS_TABLE', $user_prefix.'_users');
define_once('WORDS_TABLE', $prefix.'_bbwords');
define_once('VOTE_DESC_TABLE', $prefix.'_bbvote_desc');
define_once('VOTE_RESULTS_TABLE', $prefix.'_bbvote_results');
define_once('VOTE_USERS_TABLE', $prefix.'_bbvote_voters');
define_once('FLAG_TABLE', $prefix.'_bbflags');	// Country/Location Flags
define_once('PROXY_TABLE', $prefix.'_bbproxies');
define_once('GOOGLE_BOT_DETECTOR_TABLE', $prefix.'_google_bot_detector');
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
define_once('THREAD_KICKER_TABLE',  $prefix.'_bbthread_kicker');
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/

/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
define_once('REPORTS', $prefix.'_bbreport'); 
define_once('REPORT_CONFIG', $prefix.'_bbreport_config'); 
define_once('REPORT_CAT', $prefix.'_bbreport_cat'); 
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

/*****************************************************/
/* Forum - Acronym v.0.9.5                     START */
/*****************************************************/
define_once('ACRONYMS_TABLE', $prefix.'_bbacronyms');
/*****************************************************/
/* Forum - Acronym v.0.9.5                       END */
/*****************************************************/

/*****************************************************/
/* Forum - Reduce ACP Navigation v.2.1.2       START */
/*****************************************************/
define_once('ADMIN_MODULE_TABLE', $prefix.'_bbadmin_nav_module');
/*****************************************************/
/* Forum - Reduce ACP Navigation v.2.1.2         END */
/*****************************************************/
define_once('BBATTRIBUTES', $prefix.'_bbattributes');
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
define_once('GAMES_TABLE', $prefix.'_bbgames');
define_once('SCORES_TABLE', $prefix.'_bbscores');
define_once('GAMEHASH_TABLE', $prefix.'_bbgamehash');
define_once('HACKGAME_TABLE', $prefix.'_bbhackgame');
define_once('ARCADE_CATEGORIES_TABLE', $prefix.'_bbarcade_categories');
define_once('ARCADE_TABLE', $prefix.'_bbarcade');
define_once('AUTH_ARCADE_ACCESS_TABLE', $prefix.'_bbauth_arcade_access');
define_once('COMMENTS_TABLE', $prefix.'_bbarcade_comments'); 
define_once('ARCADE_FAV_TABLE', $prefix.'_bbarcade_fav');
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/

/*****************************************************/
/* Forum - PHP-Nuke Admin Link v.1.0.1         START */
/*****************************************************/
define_once('NUKEADMINCP', "../../../'.$admin_file.'.php");
/*****************************************************/
/* Forum - PHP-Nuke Admin Link v.1.0.1           END */
/*****************************************************/

/*****************************************************/
/* Forum - Log Actions v.1.1.6                 START */
/*****************************************************/
define_once('LOGS_TABLE', $prefix.'_bblogs');
define_once('LOGS_CONFIG_TABLE', $prefix.'_bblogs_config');
define_once('LOG_ACTIONS_VERSION', '1.1.6');
/*****************************************************/
/* Forum - Log Actions v.1.1.6                   END */
/*****************************************************/
define_once('PROXY_ERROR',99);
define_once('PROXY_TRANSPARE',65);
define_once('PROXY_ANONYMOUS',66);
define_once('PROXY_HIGH_ANON',67);

