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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}
define('RNYA', true);
//define("CNBYA_DOMAINNAME", "");
// Debug Level
//define('DEBUG', 0); // Debugging on
define('DEBUG', 1); // Debugging off

// User Levels <- Do not change the values of USER or ADMIN
define('DELETED', -1);
define('ANONYMOUS', 1);

define('USER', 1);
define('ADMIN', 2);
define('MOD', 3);


// User related
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);

define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);


// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);
define('GROUP_INITIAL_NO', 0);
define('GROUP_INITIAL_YES', 1);

// Forum state
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);


// Topic status
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);


// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);

// BEGIN Advanced_Report_Hack
// Report category types
define('REPORT_NORMAL', 0);
define('REPORT_EXT', 1);
// Report status
define('REPORT_NOT_CLEARED', 0);
define('REPORT_IN_PROCESS', 1);
define('REPORT_CLEARED', 2);
// Special categories
define('REPORT_POST_ID', 1);
define('REPORT_TOPIC_ID', 2);
define('REPORT_USER_ID', 3);
// END Advanced_Report_Hack

// SQL codes
define('BEGIN_TRANSACTION', 1);
define('END_TRANSACTION', 2);


// Error codes
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);


// Private messaging
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);


// URL PARAMETERS
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');

// Session parameters
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);


// Page numbers for session handling
define('PAGE_INDEX', 0);
define('PAGE_LOGIN', -1);
define('PAGE_SEARCH', -2);
define('PAGE_REGISTER', -3);
define('PAGE_PROFILE', -4);
define('PAGE_VIEWONLINE', -6);
define('PAGE_VIEWMEMBERS', -7);
define('PAGE_FAQ', -8);
define('PAGE_POSTING', -9);
define('PAGE_PRIVMSGS', -10);
define('PAGE_GROUPCP', -11);
// BEGIN Advanced_Report_Hack
define('PAGE_REPORT', -2041);
// END Advanced_Report_Hack
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
define('PAGE_THREAD_KICKER', -1200);
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
define('PAGE_GAME', -50);
define('PAGE_ARCADES', -51);
define('PAGE_TOPARCADES', -52);
define('PAGE_STATARCADES', -53);
define('PAGE_SCOREBOARD', -54);
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3         START */
/*****************************************************/
define('PAGE_STAFF', -12);
/*****************************************************/
/* Forum - Advanced Staff Page v.2.0.3           END */
/*****************************************************/
define('PAGE_TOPIC_OFFSET', 5000);


// Auth settings
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);

define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);

define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);
/*****************************************************/
/* Forum - Global Announce v.1.2.3             START */
/*****************************************************/
define('AUTH_GLOBALANNOUNCE', 12); 
/*****************************************************/
/* Forum - Global Announce v.1.2.3               END */
/*****************************************************/

// Table names
define('CONFIRM_TABLE', $prefix.'_bbconfirm');
define('AUTH_ACCESS_TABLE', $prefix.'_bbauth_access');
define('BANLIST_TABLE', $prefix.'_bbbanlist');
/*****************************************************/
/* Forum - Buddy List v.0.9.5                  START */
/*****************************************************/
define('BUDDIES_TABLE', $prefix.'_bbbuddies');
/*****************************************************/
/* Forum - Buddy List v.0.9.5                    END */
/*****************************************************/
define('CATEGORIES_TABLE', $prefix.'_bbcategories');
define('CONFIG_TABLE', $prefix.'_bbconfig');
define('DISALLOW_TABLE', $prefix.'_bbdisallow');
define('FORUMS_TABLE', $prefix.'_bbforums');
define('FORUMS_WATCH_TABLE', $prefix.'_bbforums_watch');
define('GROUPS_TABLE', $prefix.'_bbgroups');
define('POSTS_TABLE', $prefix.'_bbposts');
define('POSTS_TEXT_TABLE', $prefix.'_bbposts_text');
define('PRIVMSGS_TABLE', $prefix.'_bbprivmsgs');
define('PRIVMSGS_TEXT_TABLE', $prefix.'_bbprivmsgs_text');
define('ADMIN_PM_TABLE', $prefix .'_bbadmin_pm');
define('PRIVMSGS_IGNORE_TABLE', $prefix.'_bbprivmsgs_ignore');
define('PRUNE_TABLE', $prefix.'_bbforum_prune');
define('RANKS_TABLE', $prefix.'_bbranks');
// BEGIN Advanced_Report_Hack
define('REPORT_CAT_TABLE', $prefix.'_bbreport_cat');
define('REPORT_TABLE', $prefix.'_bbreport');
// END Advanced_Report_Hack
define('SEARCH_TABLE', $prefix.'_bbsearch_results');
define('SEARCH_WORD_TABLE', $prefix.'_bbsearch_wordlist');
define('SEARCH_MATCH_TABLE', $prefix.'_bbsearch_wordmatch');
define('SESSIONS_TABLE', $prefix.'_bbsessions');
define('SESSIONS_KEYS_TABLE', $prefix.'_bbsessions_keys');

define('SMILIES_TABLE', $prefix.'_bbsmilies');
define('THEMES_TABLE', $prefix.'_bbthemes');
define('THEMES_NAME_TABLE', $prefix.'_bbthemes_name');
define('TOPICS_TABLE', $prefix.'_bbtopics');
define('TOPICS_WATCH_TABLE', $prefix.'_bbtopics_watch');
define('USER_GROUP_TABLE', $prefix.'_bbuser_group');
define('USERS_TABLE', $user_prefix.'_users');
define('WORDS_TABLE', $prefix.'_bbwords');
define('VOTE_DESC_TABLE', $prefix.'_bbvote_desc');
define('VOTE_RESULTS_TABLE', $prefix.'_bbvote_results');
define('VOTE_USERS_TABLE', $prefix.'_bbvote_voters');
define('FLAG_TABLE', $prefix.'_bbflags');	// Country/Location Flags
define('PROXY_TABLE', $prefix.'_bbproxies');
define('GOOGLE_BOT_DETECTOR_TABLE', $prefix.'_google_bot_detector');
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2               START */
/*****************************************************/
define('THREAD_KICKER_TABLE',  $prefix.'_bbthread_kicker');
/*****************************************************/
/* Forum - Thread Kicker v.1.0.2                 END */
/*****************************************************/

/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0        START */
/*****************************************************/
define('REPORTS', $prefix.'_bbreport'); 
define('REPORT_CONFIG', $prefix.'_bbreport_config'); 
define('REPORT_CAT', $prefix.'_bbreport_cat'); 
/*****************************************************/
/* Forum - Advanced Report Hack v.1.0.0          END */
/*****************************************************/

/*****************************************************/
/* Forum - Acronym v.0.9.5                     START */
/*****************************************************/
define('ACRONYMS_TABLE', $prefix.'_bbacronyms');
/*****************************************************/
/* Forum - Acronym v.0.9.5                       END */
/*****************************************************/

/*****************************************************/
/* Forum - Reduce ACP Navigation v.2.1.2       START */
/*****************************************************/
define('ADMIN_MODULE_TABLE', $prefix.'_bbadmin_nav_module');
/*****************************************************/
/* Forum - Reduce ACP Navigation v.2.1.2         END */
/*****************************************************/
define('BBATTRIBUTES', $prefix.'_bbattributes');
/*****************************************************/
/* Forum - Arcade v.3.0.2                      START */
/*****************************************************/
define('GAMES_TABLE', $prefix.'_bbgames');
define('SCORES_TABLE', $prefix.'_bbscores');
define('GAMEHASH_TABLE', $prefix.'_bbgamehash');
define('HACKGAME_TABLE', $prefix.'_bbhackgame');
define('ARCADE_CATEGORIES_TABLE', $prefix.'_bbarcade_categories');
define('ARCADE_TABLE', $prefix.'_bbarcade');
define('AUTH_ARCADE_ACCESS_TABLE', $prefix.'_bbauth_arcade_access');
define('COMMENTS_TABLE', $prefix.'_bbarcade_comments'); 
define('ARCADE_FAV_TABLE', $prefix.'_bbarcade_fav');
/*****************************************************/
/* Forum - Arcade v.3.0.2                        END */
/*****************************************************/

/*****************************************************/
/* Forum - PHP-Nuke Admin Link v.1.0.1         START */
/*****************************************************/
define('NUKEADMINCP', "../../../$admin_file.".php);
/*****************************************************/
/* Forum - PHP-Nuke Admin Link v.1.0.1           END */
/*****************************************************/

/*****************************************************/
/* Forum - Log Actions v.1.1.6                 START */
/*****************************************************/
define('LOGS_TABLE', $prefix.'_bblogs');
define('LOGS_CONFIG_TABLE', $prefix.'_bblogs_config');
define('LOG_ACTIONS_VERSION', '1.1.6');
/*****************************************************/
/* Forum - Log Actions v.1.1.6                   END */
/*****************************************************/
define('PROXY_ERROR',99);
define('PROXY_TRANSPARE',65);
define('PROXY_ANONYMOUS',66);
define('PROXY_HIGH_ANON',67);

?>