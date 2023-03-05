<?php
/***************************************************************************
 *                               constants.php
 *                            -------------------
 *   begin                : Saturday, Mar 30, 2002
 *   copyright            : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: constants.php,v 1.27 2004/12/09 20:12:12 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License', or
 *   ('at your option) any later version.
 *
 ***************************************************************************/

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
	exit;
}

// Attachment Debug Mode
define('ATTACH_DEBUG', 0);		// Attachment Mod Debugging off
//define('ATTACH_DEBUG', 1);	// Attachment Mod Debugging on

//define('ATTACH_QUERY_DEBUG', 1);

// Auth
define('AUTH_DOWNLOAD', 20);

// Download Modes
define('INLINE_LINK', 1);
define('PHYSICAL_LINK', 2);

// Categories
define('NONE_CAT', 0);
define('IMAGE_CAT', 1);
define('STREAM_CAT', 2);
define('SWF_CAT', 3);

// Tables
define('ATTACH_CONFIG_TABLE', $prefix . '_bbattachments_config');
define('EXTENSION_GROUPS_TABLE', $prefix . '_bbextension_groups');
define('EXTENSIONS_TABLE', $prefix . '_bbextensions');
define('FORBIDDEN_EXTENSIONS_TABLE', $prefix . '_bbforbidden_extensions');
define('ATTACHMENTS_DESC_TABLE', $prefix . '_bbattachments_desc');
define('ATTACHMENTS_TABLE', $prefix . '_bbattachments');
define('QUOTA_TABLE', $prefix . '_bbattach_quota');
define('QUOTA_LIMITS_TABLE', $prefix . '_bbquota_limits');

// Pages
define('PAGE_UACP', -32);
define('PAGE_RULES', -33);

// Misc
define('MEGABYTE', 1024);
define('ADMIN_MAX_ATTACHMENTS', 50); // Maximum Attachments in Posts or PM's for Admin Users
define('THUMB_DIR', 'thumbs');
define('MODE_THUMBNAIL', 1);

// Forum Extension Group Permissions
define('GPERM_ALL', 0); // ALL FORUMS

// Quota Types
define('QUOTA_UPLOAD_LIMIT', 1);
define('QUOTA_PM_LIMIT', 2);

define('ATTACH_VERSION', '2.3.11');

?>
