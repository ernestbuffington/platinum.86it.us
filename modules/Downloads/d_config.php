<?php

######################################################################
# PHP-NUKE: Web Portal System
# ===========================
#
# Copyright (c) 2000 by Francisco Burzi (fbc@mandrakesoft.com)
# http://phpnuke.org
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################
/***********************************************************************/
/*wysiwyg editor and dbi conversion added/completed by DocHaVoC#0003262012*/
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

######################################################################
# Downloads Preferences (Some variables are valid also for Downloads)
#
# $perpage:      	    	How many downloads to show on each page?
# $popular:      	    	How many hits need a download to be listed as popular?
# $newdownloads:     	    	How many downloads to display in the New Downloads Page?
# $topdownloads:     	    	How many downloads to display in The Best Downloads Page? (Most Popular)
# $downloadsresults: 	    	How many downloads to display on each search result page?
# $downloads_anonadddownloadlock:   	Lock Unregistered users from Suggesting New Downloads? (1=Yes 0=No)
# $anonwaitdays:        	Number of days anonymous users need to wait to vote on a download
# $outsidewaitdays:     	Number of days outside users need to wait to vote on a download (checks IP)
# $useoutsidevoting:        	Allow Webmasters to put vote downloads on their site (1=Yes 0=No)
# $anonweight:          	How many Unregistered User vote per 1 Registered User Vote?
# $outsideweight:       	How many Outside User vote per 1 Registered User Vote?
# $detailvotedecimal:       	Let Detailed Vote Summary Decimal out to N places. (no max)
# $mainvotedecimal:     	Let Main Vote Summary Decimal show out to N places. (max 4)
# $topdownloadspercentrigger:   	1 to Show Top Downloads as a Percentage (else # of downloads)
# $topdownloads:            	Either # of downloads OR percentage to show (percentage as whole number. #/100)
# $mostpopdownloadspercentrigger:	1 to Show Most Popular Downloads as a Percentage (else # of downloads)
# $mostpopdownloads:        	Either # of downloads OR percentage to show (percentage as whole number. #/100)
# $featurebox:          	1 to Show Feature Download Box on downloads Main Page? (1=Yes 0=No)
# $downloadvotemin:         	Number votes needed to make the 'top 10' list
# $blockunregmodify:        	Block unregistered users from suggesting downloads changes? (1=Yes 0=No)
# $show_links_num:              Show the number of links for each category? (1=Yes 0=No)
######################################################################

$perpage = 10;
$popular = 5000;
$anonwaitdays = 1;
$outsidewaitdays = 1;
$useoutsidevoting = 1;
$anonweight = 10;
$outsideweight = 20;
$detailvotedecimal = 2;
$mainvotedecimal = 1;
$featurebox = 1;
$blockunregmodify = 0;
$newdownloads = 10;
$topdownloads = 25;
$downloadsresults = 10;
$downloads_anonadddownloadlock = 0;
$user_adddownload = 1;
$topdownloadspercentrigger = 0;
$topdownloads = 25;
$mostpopdownloadspercentrigger = 0;
$mostpopdownloads = 25;
$downloadvotemin = 5;
$show_links_num = 0;

?>