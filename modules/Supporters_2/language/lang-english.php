<?php
/********************************************************/
/* NSN Supporters_2(TM) Universal                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/********************************************************/
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

global $sp_config;
define_once('_SP2_NEWVER','New version is availible!');
define_once('_SP2_CURVER','Your version is upto date!');
define_once("_SP2_MAINTITLE","NukeSupporters_2(tm)");
define_once("_SP2_ALLOWEDEXT","Allowed<br />Extensions");
define_once("_SP2_ACTIVATE","Activate");
define_once("_SP2_ACTIVESITES","Active Sites");
define_once("_SP2_ADDED","Added");
define_once("_SP2_ADDSUPPORTER","Add a Supporter");
define_once("_SP2_ADMINMAIN","Administration");
define_once("_SP2_ALLREQ","All Fields Required");
define_once("_SP2_APPROVE","Approve");
define_once("_SP2_APPROVESITE","Approve Site");
define_once("_SP2_BADEXT","Extension Not Allowed!");
define_once("_SP2_BESUPPORTER","Be A Supporter");
define_once("_SP2_CONFBANN","Bad Upload");
define_once("_SP2_CONFIGMAIN","Configuration");
define_once("_SP2_DBERROR1","ERROR: Failed to write to database");
define_once("_SP2_DEACTIVATE","Deactivate");
define_once("_SP2_DELETESITE","Delete Site");
define_once("_SP2_DESCRIPTION","Description");
define_once("_SP2_EDITSITE","Edit Site");
define_once("_SP2_EDITSITE","Modify Site");
define_once("_SP2_GOTOADMIN","Supporter Admin");
define_once("_SP2_IMAGE","Site Image");
define_once("_SP2_IMAGETYPE","Image Link Type");
define_once("_SP2_IMAGETYPE0","This is a image url!");
define_once("_SP2_IMAGETYPE1","The image is uploaded from your pc!");
define_once("_SP2_INACTIVESITES","Inactive Sites");
define_once("_SP2_LINKED","Linked");
define_once("_SP2_MAXHEIGHT","Max Image Height");
define_once("_SP2_MAXWIDTH","Max Image Width");
define_once("_SP2_MISSINGDATA","You are missing submission data!");
if(!isset($sp_config['max_width'])) $sp_config['max_width'] = '';
if(!isset($sp_config['max_height'])) $sp_config['max_height'] = '';
define_once("_SP2_MUSTBE","images larger than ".$sp_config['max_width']."x".$sp_config['max_height']." will be resized to ".$sp_config['max_width']."x".$sp_config['max_height']." on display");
define_once("_SP2_NAME","Site Name");
define_once("_SP2_NOACTIVESITES","There are no Active Sites.");
define_once("_SP2_NOINACTIVESITES","There are no Inactive Sites.");
define_once("_SP2_NOSUBMITTEDSITES","There are no Submitted Sites.");
define_once("_SP2_NOUPLOAD","Image did not upload properly.");
define_once("_SP2_REQUIREUSER","Require Membership");
define_once("_SP2_SAVECHANGES","Save Changes");
define_once("_SP2_SITEADMIN","Site Administration");
define_once("_SP2_SITEID","Site ID");
define_once("_SP2_SUBMITSITE","Submit Site");
define_once("_SP2_SUBMITTED","Submitted");
define_once("_SP2_SUBMITTEDSITES","Submitted Sites");
define_once("_SP2_SUPPORTEDBY","Supported by");
define_once("_SP2_SUPPORTERS","Supporters 2");
define_once("_SP2_SURE2DELETE","Are you sure you want to do delete this site?");
define_once("_SP2_UPLOAD","Upload");
define_once("_SP2_URL","Site URL");
define_once("_SP2_USEREMAIL","User Email");
define_once("_SP2_USERID","User ID");
define_once("_SP2_USERIP","User IP");
define_once("_SP2_USERNAME","User Name");
define_once("_SP2_VISITS","Visits");
define_once("_SP2_YOUDELETE","You are about to to delete the site");
define_once("_SP2_YOUREMAIL","Your Email");
define_once("_SP2_YOURIP","Your IP");
define_once("_SP2_YOURNAME","Your Name");
