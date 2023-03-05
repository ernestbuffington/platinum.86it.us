<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright � 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
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

global $admin_file;
if(!isset($admin_file)) { $admin_file = 'admin'; }
if(!defined('ADMIN_FILE')) { header("Location: ../../".$admin_file.".php"); }
switch($op) {
    case 'ABAuth':
    case 'ABAuthEdit':
    case 'ABAuthEditSave':
    case 'ABAuthList':
    case 'ABAuthResend':
    case 'ABAuthScan':
    case 'ABBlockedIPAdd':
    case 'ABBlockedIPAddSave':
    case 'ABBlockedIPClear':
    case 'ABBlockedIPClearExpired':
    case 'ABBlockedIPClearSave':
    case 'ABBlockedIPDelete':
    case 'ABBlockedIPDeleteSave':
    case 'ABBlockedIPEdit':
    case 'ABBlockedIPEditSave':
    case 'ABBlockedIPList':
    case 'ABBlockedIPListPrint':
    case 'ABBlockedIPMenu':
    case 'ABBlockedIPView':
    case 'ABBlockedIPViewPrint':
    case 'ABBlockedRangeAdd':
    case 'ABBlockedRangeAddSave':
    case 'ABBlockedRangeClear':
    case 'ABBlockedRangeClearExpired':
    case 'ABBlockedRangeClearSave':
    case 'ABBlockedRangeDelete':
    case 'ABBlockedRangeDeleteSave':
    case 'ABBlockedRangeEdit':
    case 'ABBlockedRangeEditSave':
    case 'ABBlockedRangeList':
    case 'ABBlockedRangeListPrint':
    case 'ABBlockedRangeMenu':
    case 'ABBlockedRangeOverlapCheck':
    case 'ABBlockedRangeView':
    case 'ABBlockedRangeViewPrint':
    case 'ABCGIAuth':
    case 'ABCGIBuild':
    case 'ABConfig':
    case 'ABConfigAdmin':
    case 'ABConfigAuthor':
    case 'ABConfigClike':
    case 'ABConfigDefault':
    case 'ABConfigFilter':
    case 'ABConfigFlood':
    case 'ABConfigHarvester':
    case 'ABConfigReferer':
    case 'ABConfigRequest':
    case 'ABConfigSave':
    case 'ABConfigScript':
    case 'ABConfigString':
    case 'ABConfigUnion':
    case 'ABConfigUpdate':
    case 'ABCountryList':
    case 'ABDBMaintenance':
    case 'ABDBOptimize':
    case 'ABDBRepair':
    case 'ABDBStructure':
    case 'ABExcludedAdd':
    case 'ABExcludedAddSave':
    case 'ABExcludedClear':
    case 'ABExcludedClearSave':
    case 'ABExcludedDelete':
    case 'ABExcludedDeleteSave':
    case 'ABExcludedEdit':
    case 'ABExcludedEditSave':
    case 'ABExcludedList':
    case 'ABExcludedListPrint':
    case 'ABExcludedMenu':
    case 'ABExcludedOverlapCheck':
    case 'ABExcludedView':
    case 'ABExcludedViewPrint':
    case 'ABHarvesterAdd':
    case 'ABHarvesterAddSave':
    case 'ABHarvesterDelete':
    case 'ABHarvesterDeleteSave':
    case 'ABHarvesterEdit':
    case 'ABHarvesterEditSave':
    case 'ABHarvesterList':
    case 'ABHarvesterListPrint':
    case 'ABHarvesterMenu':
    case 'ABIP2CountryAdd':
    case 'ABIP2CountryAddSave':
    case 'ABIP2CountryDelete':
    case 'ABIP2CountryDeleteSave':
    case 'ABIP2CountryEdit':
    case 'ABIP2CountryEditSave':
    case 'ABIP2CountryList':
    case 'ABIP2CountryMenu':
    case 'ABIP2CountryOverlapCheck':
    case 'ABIP2CountryUpdateBlocked':
    case 'ABIP2CountryUpdateBlockedRanges':
    case 'ABIP2CountryUpdateExcludedRanges':
    case 'ABIP2CountryUpdateProtectedRanges':
    case 'ABIP2CountryUpdateTracked':
    case 'ABLoadError':
    case 'ABMain':
    case 'ABMainSave':
    case 'ABProtectedAdd':
    case 'ABProtectedAddSave':
    case 'ABProtectedClear':
    case 'ABProtectedClearSave':
    case 'ABProtectedDelete':
    case 'ABProtectedDeleteSave':
    case 'ABProtectedEdit':
    case 'ABProtectedEditSave':
    case 'ABProtectedList':
    case 'ABProtectedListPrint':
    case 'ABProtectedMenu':
    case 'ABProtectedOverlapCheck':
    case 'ABProtectedView':
    case 'ABProtectedViewPrint':
    case 'ABRefererAdd':
    case 'ABRefererAddSave':
    case 'ABRefererDelete':
    case 'ABRefererDeleteSave':
    case 'ABRefererEdit':
    case 'ABRefererEditSave':
    case 'ABRefererList':
    case 'ABRefererListPrint':
    case 'ABRefererMenu':
    case 'ABSearch':
    case 'ABSearchIPPrint':
    case 'ABSearchIPResults':
    case 'ABSearchRangePrint':
    case 'ABSearchRangeResults':
    case 'ABStringAdd':
    case 'ABStringAddSave':
    case 'ABStringDelete':
    case 'ABStringDeleteSave':
    case 'ABStringEdit':
    case 'ABStringEditSave':
    case 'ABStringList':
    case 'ABStringListPrint':
    case 'ABStringMenu':
    case 'ABTemplate':
    case 'ABTemplateSource':
    case 'ABTemplateView':
    case 'ABTrackedAdd':
    case 'ABTrackedAddSave':
    case 'ABTrackedAgentsDelete':
    case 'ABTrackedAgentsIPs':
    case 'ABTrackedAgentsList':
    case 'ABTrackedAgentsListAdd':
    case 'ABTrackedAgentsListAddSave':
    case 'ABTrackedAgentsListPrint':
    case 'ABTrackedAgentsPages':
    case 'ABTrackedAgentsPagesPrint':
    case 'ABTrackedClear':
    case 'ABTrackedClearSave':
    case 'ABTrackedDelete':
    case 'ABTrackedDeleteSave':
    case 'ABTrackedList':
    case 'ABTrackedListPrint':
    case 'ABTrackedMenu':
    case 'ABTrackedPages':
    case 'ABTrackedPagesPrint':
    case 'ABTrackedRefersDelete':
    case 'ABTrackedRefersIPs':
    case 'ABTrackedRefersList':
    case 'ABTrackedRefersListAdd':
    case 'ABTrackedRefersListAddSave':
    case 'ABTrackedRefersListPrint':
    case 'ABTrackedRefersPages':
    case 'ABTrackedRefersPagesPrint':
    case 'ABTrackedUsersDelete':
    case 'ABTrackedUsersIPs':
    case 'ABTrackedUsersList':
    case 'ABTrackedUsersListPrint':
    case 'ABTrackedUsersPages':
    case 'ABTrackedUsersPagesPrint':
    include_once('admin/modules/nukesentinel.php');
    break;
}
?>