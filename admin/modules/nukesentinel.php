<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright © 2000-2008 by NukeScripts(tm)             */
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

@set_time_limit(600);
//@ini_set('display_errors', 1);
//@ini_set('error_reporting', E_WARNING);
if($ab_config['show_right'] == 1) {
  $index = 1;
  define('INDEX_FILE', TRUE);
}
$advanced_editor = 0;
define('NO_EDITOR', TRUE);
define('NUKESENTINEL_ADMIN', TRUE);
global $admin_file, $dbname;
if(!isset($admin_file)) { $admin_file = "admin"; }
if(!defined('ADMIN_FILE')) { header("Location: ../../".$admin_file.".php"); }
if(!defined('NUKESENTINEL_IS_LOADED')) { $op = 'ABLoadError'; }
include_once('admin/modules/nukesentinel/functions.php');
$getAdmin = $db->sql_fetchrow($db->sql_query("SELECT * FROM `".$prefix."_authors` WHERE `aid`='$aid' LIMIT 0,1"));
if ($getAdmin['radminsuper'] == 1) {
  switch ($op) {
    case 'ABAuth':include_once('admin/modules/nukesentinel/ABAuth.php');break;
    case 'ABAuthEdit':include_once('admin/modules/nukesentinel/ABAuthEdit.php');break;
    case 'ABAuthEditSave':include_once('admin/modules/nukesentinel/ABAuthEditSave.php');break;
    case 'ABAuthList':include_once('admin/modules/nukesentinel/ABAuthList.php');break;
    case 'ABAuthResend':include_once('admin/modules/nukesentinel/ABAuthResend.php');break;
    case 'ABAuthScan':include_once('admin/modules/nukesentinel/ABAuthScan.php');break;
    case 'ABBlockedIPAdd':include_once('admin/modules/nukesentinel/ABBlockedIPAdd.php');break;
    case 'ABBlockedIPAddSave':include_once('admin/modules/nukesentinel/ABBlockedIPAddSave.php');break;
    case 'ABBlockedIPClear':include_once('admin/modules/nukesentinel/ABBlockedIPClear.php');break;
    case 'ABBlockedIPClearExpired':include_once('admin/modules/nukesentinel/ABBlockedIPClearExpired.php');break;
    case 'ABBlockedIPClearSave':include_once('admin/modules/nukesentinel/ABBlockedIPClearSave.php');break;
    case 'ABBlockedIPDelete':include_once('admin/modules/nukesentinel/ABBlockedIPDelete.php');break;
    case 'ABBlockedIPDeleteSave':include_once('admin/modules/nukesentinel/ABBlockedIPDeleteSave.php');break;
    case 'ABBlockedIPEdit':include_once('admin/modules/nukesentinel/ABBlockedIPEdit.php');break;
    case 'ABBlockedIPEditSave':include_once('admin/modules/nukesentinel/ABBlockedIPEditSave.php');break;
    case 'ABBlockedIPList':include_once('admin/modules/nukesentinel/ABBlockedIPList.php');break;
    case 'ABBlockedIPListPrint':include_once('admin/modules/nukesentinel/ABBlockedIPListPrint.php');break;
    case 'ABBlockedIPMenu':include_once('admin/modules/nukesentinel/ABBlockedIPMenu.php');break;
    case 'ABBlockedIPView':include_once('admin/modules/nukesentinel/ABBlockedIPView.php');break;
    case 'ABBlockedIPViewPrint':include_once('admin/modules/nukesentinel/ABBlockedIPViewPrint.php');break;
    case 'ABBlockedRangeAdd':include_once('admin/modules/nukesentinel/ABBlockedRangeAdd.php');break;
    case 'ABBlockedRangeAddSave':include_once('admin/modules/nukesentinel/ABBlockedRangeAddSave.php');break;
    case 'ABBlockedRangeClear':include_once('admin/modules/nukesentinel/ABBlockedRangeClear.php');break;
    case 'ABBlockedRangeClearExpired':include_once('admin/modules/nukesentinel/ABBlockedRangeClearExpired.php');break;
    case 'ABBlockedRangeClearSave':include_once('admin/modules/nukesentinel/ABBlockedRangeClearSave.php');break;
    case 'ABBlockedRangeDelete':include_once('admin/modules/nukesentinel/ABBlockedRangeDelete.php');break;
    case 'ABBlockedRangeDeleteSave':include_once('admin/modules/nukesentinel/ABBlockedRangeDeleteSave.php');break;
    case 'ABBlockedRangeEdit':include_once('admin/modules/nukesentinel/ABBlockedRangeEdit.php');break;
    case 'ABBlockedRangeEditSave':include_once('admin/modules/nukesentinel/ABBlockedRangeEditSave.php');break;
    case 'ABBlockedRangeList':include_once('admin/modules/nukesentinel/ABBlockedRangeList.php');break;
    case 'ABBlockedRangeListPrint':include_once('admin/modules/nukesentinel/ABBlockedRangeListPrint.php');break;
    case 'ABBlockedRangeMenu':include_once('admin/modules/nukesentinel/ABBlockedRangeMenu.php');break;
    case 'ABBlockedRangeOverlapCheck':include_once('admin/modules/nukesentinel/ABBlockedRangeOverlapCheck.php');break;
    case 'ABBlockedRangeView':include_once('admin/modules/nukesentinel/ABBlockedRangeView.php');break;
    case 'ABBlockedRangeViewPrint':include_once('admin/modules/nukesentinel/ABBlockedRangeViewPrint.php');break;
    case 'ABCGIAuth':include_once('admin/modules/nukesentinel/ABCGIAuth.php');break;
    case 'ABCGIBuild':include_once('admin/modules/nukesentinel/ABCGIBuild.php');break;
    case 'ABConfig':include_once('admin/modules/nukesentinel/ABConfig.php');break;
    case 'ABConfigAdmin':include_once('admin/modules/nukesentinel/ABConfigAdmin.php');break;
    case 'ABConfigAuthor':include_once('admin/modules/nukesentinel/ABConfigAuthor.php');break;
    case 'ABConfigClike':include_once('admin/modules/nukesentinel/ABConfigClike.php');break;
    case 'ABConfigDefault':include_once('admin/modules/nukesentinel/ABConfigDefault.php');break;
    case 'ABConfigFilter':include_once('admin/modules/nukesentinel/ABConfigFilter.php');break;
    case 'ABConfigFlood':include_once('admin/modules/nukesentinel/ABConfigFlood.php');break;
    case 'ABConfigHarvester':include_once('admin/modules/nukesentinel/ABConfigHarvester.php');break;
    case 'ABConfigReferer':include_once('admin/modules/nukesentinel/ABConfigReferer.php');break;
    case 'ABConfigRequest':include_once('admin/modules/nukesentinel/ABConfigRequest.php');break;
    case 'ABConfigSave':include_once('admin/modules/nukesentinel/ABConfigSave.php');break;
    case 'ABConfigScript':include_once('admin/modules/nukesentinel/ABConfigScript.php');break;
    case 'ABConfigString':include_once('admin/modules/nukesentinel/ABConfigString.php');break;
    case 'ABConfigUnion':include_once('admin/modules/nukesentinel/ABConfigUnion.php');break;
    case 'ABConfigUpdate':include_once('admin/modules/nukesentinel/ABConfigUpdate.php');break;
    case 'ABCountryList':include_once('admin/modules/nukesentinel/ABCountryList.php');break;
    case 'ABDBMaintenance':include_once('admin/modules/nukesentinel/ABDBMaintenance.php');break;
    case 'ABDBOptimize':include_once('admin/modules/nukesentinel/ABDBOptimize.php');break;
    case 'ABDBRepair':include_once('admin/modules/nukesentinel/ABDBRepair.php');break;
    case 'ABDBStructure':include_once('admin/modules/nukesentinel/ABDBStructure.php');break;
    case 'ABExcludedAdd':include_once('admin/modules/nukesentinel/ABExcludedAdd.php');break;
    case 'ABExcludedAddSave':include_once('admin/modules/nukesentinel/ABExcludedAddSave.php');break;
    case 'ABExcludedClear':include_once('admin/modules/nukesentinel/ABExcludedClear.php');break;
    case 'ABExcludedClearSave':include_once('admin/modules/nukesentinel/ABExcludedClearSave.php');break;
    case 'ABExcludedDelete':include_once('admin/modules/nukesentinel/ABExcludedDelete.php');break;
    case 'ABExcludedDeleteSave':include_once('admin/modules/nukesentinel/ABExcludedDeleteSave.php');break;
    case 'ABExcludedEdit':include_once('admin/modules/nukesentinel/ABExcludedEdit.php');break;
    case 'ABExcludedEditSave':include_once('admin/modules/nukesentinel/ABExcludedEditSave.php');break;
    case 'ABExcludedList':include_once('admin/modules/nukesentinel/ABExcludedList.php');break;
    case 'ABExcludedListPrint':include_once('admin/modules/nukesentinel/ABExcludedListPrint.php');break;
    case 'ABExcludedMenu':include_once('admin/modules/nukesentinel/ABExcludedMenu.php');break;
    case 'ABExcludedOverlapCheck':include_once('admin/modules/nukesentinel/ABExcludedOverlapCheck.php');break;
    case 'ABExcludedView':include_once('admin/modules/nukesentinel/ABExcludedView.php');break;
    case 'ABExcludedViewPrint':include_once('admin/modules/nukesentinel/ABExcludedViewPrint.php');break;
    case 'ABHarvesterAdd':include_once('admin/modules/nukesentinel/ABHarvesterAdd.php');break;
    case 'ABHarvesterAddSave':include_once('admin/modules/nukesentinel/ABHarvesterAddSave.php');break;
    case 'ABHarvesterDelete':include_once('admin/modules/nukesentinel/ABHarvesterDelete.php');break;
    case 'ABHarvesterDeleteSave':include_once('admin/modules/nukesentinel/ABHarvesterDeleteSave.php');break;
    case 'ABHarvesterEdit':include_once('admin/modules/nukesentinel/ABHarvesterEdit.php');break;
    case 'ABHarvesterEditSave':include_once('admin/modules/nukesentinel/ABHarvesterEditSave.php');break;
    case 'ABHarvesterList':include_once('admin/modules/nukesentinel/ABHarvesterList.php');break;
    case 'ABHarvesterListPrint':include_once('admin/modules/nukesentinel/ABHarvesterListPrint.php');break;
    case 'ABHarvesterMenu':include_once('admin/modules/nukesentinel/ABHarvesterMenu.php');break;
    case 'ABIP2CountryAdd':include_once('admin/modules/nukesentinel/ABIP2CountryAdd.php');break;
    case 'ABIP2CountryAddSave':include_once('admin/modules/nukesentinel/ABIP2CountryAddSave.php');break;
    case 'ABIP2CountryDelete':include_once('admin/modules/nukesentinel/ABIP2CountryDelete.php');break;
    case 'ABIP2CountryDeleteSave':include_once('admin/modules/nukesentinel/ABIP2CountryDeleteSave.php');break;
    case 'ABIP2CountryEdit':include_once('admin/modules/nukesentinel/ABIP2CountryEdit.php');break;
    case 'ABIP2CountryEditSave':include_once('admin/modules/nukesentinel/ABIP2CountryEditSave.php');break;
    case 'ABIP2CountryList':include_once('admin/modules/nukesentinel/ABIP2CountryList.php');break;
    case 'ABIP2CountryMenu':include_once('admin/modules/nukesentinel/ABIP2CountryMenu.php');break;
    case 'ABIP2CountryOverlapCheck':include_once('admin/modules/nukesentinel/ABIP2CountryOverlapCheck.php');break;
    case 'ABIP2CountryUpdateBlocked':include_once('admin/modules/nukesentinel/ABIP2CountryUpdateBlocked.php');break;
    case 'ABIP2CountryUpdateBlockedRanges':include_once('admin/modules/nukesentinel/ABIP2CountryUpdateBlockedRanges.php');break;
    case 'ABIP2CountryUpdateExcludedRanges':include_once('admin/modules/nukesentinel/ABIP2CountryUpdateExcludedRanges.php');break;
    case 'ABIP2CountryUpdateProtectedRanges':include_once('admin/modules/nukesentinel/ABIP2CountryUpdateProtectedRanges.php');break;
    case 'ABIP2CountryUpdateTracked':include_once('admin/modules/nukesentinel/ABIP2CountryUpdateTracked.php');break;
    case 'ABLoadError':include_once('admin/modules/nukesentinel/ABLoadError.php');break;
    case 'ABMain':include_once('admin/modules/nukesentinel/ABMain.php');break;
    case 'ABMainSave':include_once('admin/modules/nukesentinel/ABMainSave.php');break;
    case 'ABProtectedAdd':include_once('admin/modules/nukesentinel/ABProtectedAdd.php');break;
    case 'ABProtectedAddSave':include_once('admin/modules/nukesentinel/ABProtectedAddSave.php');break;
    case 'ABProtectedClear':include_once('admin/modules/nukesentinel/ABProtectedClear.php');break;
    case 'ABProtectedClearSave':include_once('admin/modules/nukesentinel/ABProtectedClearSave.php');break;
    case 'ABProtectedDelete':include_once('admin/modules/nukesentinel/ABProtectedDelete.php');break;
    case 'ABProtectedDeleteSave':include_once('admin/modules/nukesentinel/ABProtectedDeleteSave.php');break;
    case 'ABProtectedEdit':include_once('admin/modules/nukesentinel/ABProtectedEdit.php');break;
    case 'ABProtectedEditSave':include_once('admin/modules/nukesentinel/ABProtectedEditSave.php');break;
    case 'ABProtectedList':include_once('admin/modules/nukesentinel/ABProtectedList.php');break;
    case 'ABProtectedListPrint':include_once('admin/modules/nukesentinel/ABProtectedListPrint.php');break;
    case 'ABProtectedMenu':include_once('admin/modules/nukesentinel/ABProtectedMenu.php');break;
    case 'ABProtectedOverlapCheck':include_once('admin/modules/nukesentinel/ABProtectedOverlapCheck.php');break;
    case 'ABProtectedView':include_once('admin/modules/nukesentinel/ABProtectedView.php');break;
    case 'ABProtectedViewPrint':include_once('admin/modules/nukesentinel/ABProtectedViewPrint.php');break;
    case 'ABRefererAdd':include_once('admin/modules/nukesentinel/ABRefererAdd.php');break;
    case 'ABRefererAddSave':include_once('admin/modules/nukesentinel/ABRefererAddSave.php');break;
    case 'ABRefererDelete':include_once('admin/modules/nukesentinel/ABRefererDelete.php');break;
    case 'ABRefererDeleteSave':include_once('admin/modules/nukesentinel/ABRefererDeleteSave.php');break;
    case 'ABRefererEdit':include_once('admin/modules/nukesentinel/ABRefererEdit.php');break;
    case 'ABRefererEditSave':include_once('admin/modules/nukesentinel/ABRefererEditSave.php');break;
    case 'ABRefererList':include_once('admin/modules/nukesentinel/ABRefererList.php');break;
    case 'ABRefererListPrint':include_once('admin/modules/nukesentinel/ABRefererListPrint.php');break;
    case 'ABRefererMenu':include_once('admin/modules/nukesentinel/ABRefererMenu.php');break;
    case 'ABSearch':include_once('admin/modules/nukesentinel/ABSearch.php');break;
    case 'ABSearchIPPrint':include_once('admin/modules/nukesentinel/ABSearchIPPrint.php');break;
    case 'ABSearchIPResults':include_once('admin/modules/nukesentinel/ABSearchIPResults.php');break;
    case 'ABSearchRangePrint':include_once('admin/modules/nukesentinel/ABSearchRangePrint.php');break;
    case 'ABSearchRangeResults':include_once('admin/modules/nukesentinel/ABSearchRangeResults.php');break;
    case 'ABStringAdd':include_once('admin/modules/nukesentinel/ABStringAdd.php');break;
    case 'ABStringAddSave':include_once('admin/modules/nukesentinel/ABStringAddSave.php');break;
    case 'ABStringDelete':include_once('admin/modules/nukesentinel/ABStringDelete.php');break;
    case 'ABStringDeleteSave':include_once('admin/modules/nukesentinel/ABStringDeleteSave.php');break;
    case 'ABStringEdit':include_once('admin/modules/nukesentinel/ABStringEdit.php');break;
    case 'ABStringEditSave':include_once('admin/modules/nukesentinel/ABStringEditSave.php');break;
    case 'ABStringList':include_once('admin/modules/nukesentinel/ABStringList.php');break;
    case 'ABStringListPrint':include_once('admin/modules/nukesentinel/ABStringListPrint.php');break;
    case 'ABStringMenu':include_once('admin/modules/nukesentinel/ABStringMenu.php');break;
    case 'ABTemplate':include_once('admin/modules/nukesentinel/ABTemplate.php');break;
    case 'ABTemplateSource':include_once('admin/modules/nukesentinel/ABTemplateSource.php');break;
    case 'ABTemplateView':include_once('admin/modules/nukesentinel/ABTemplateView.php');break;
    case 'ABTrackedAdd':include_once('admin/modules/nukesentinel/ABTrackedAdd.php');break;
    case 'ABTrackedAddSave':include_once('admin/modules/nukesentinel/ABTrackedAddSave.php');break;
    case 'ABTrackedAgentsList':include_once('admin/modules/nukesentinel/ABTrackedAgentsList.php');break;
    case 'ABTrackedAgentsDelete':include_once('admin/modules/nukesentinel/ABTrackedAgentsDelete.php');break;
    case 'ABTrackedAgentsIPs':include_once('admin/modules/nukesentinel/ABTrackedAgentsIPs.php');break;
    case 'ABTrackedAgentsListAdd':include_once('admin/modules/nukesentinel/ABTrackedAgentsListAdd.php');break;
    case 'ABTrackedAgentsListAddSave':include_once('admin/modules/nukesentinel/ABTrackedAgentsListAddSave.php');break;
    case 'ABTrackedAgentsListPrint':include_once('admin/modules/nukesentinel/ABTrackedAgentsListPrint.php');break;
    case 'ABTrackedAgentsPages':include_once('admin/modules/nukesentinel/ABTrackedAgentsPages.php');break;
    case 'ABTrackedAgentsPagesPrint':include_once('admin/modules/nukesentinel/ABTrackedAgentsPagesPrint.php');break;
    case 'ABTrackedClear':include_once('admin/modules/nukesentinel/ABTrackedClear.php');break;
    case 'ABTrackedClearSave':include_once('admin/modules/nukesentinel/ABTrackedClearSave.php');break;
    case 'ABTrackedDelete':include_once('admin/modules/nukesentinel/ABTrackedDelete.php');break;
    case 'ABTrackedDeleteSave':include_once('admin/modules/nukesentinel/ABTrackedDeleteSave.php');break;
    case 'ABTrackedList':include_once('admin/modules/nukesentinel/ABTrackedList.php');break;
    case 'ABTrackedListPrint':include_once('admin/modules/nukesentinel/ABTrackedListPrint.php');break;
    case 'ABTrackedMenu':include_once('admin/modules/nukesentinel/ABTrackedMenu.php');break;
    case 'ABTrackedPages':include_once('admin/modules/nukesentinel/ABTrackedPages.php');break;
    case 'ABTrackedPagesPrint':include_once('admin/modules/nukesentinel/ABTrackedPagesPrint.php');break;
    case 'ABTrackedRefersList':include_once('admin/modules/nukesentinel/ABTrackedRefersList.php');break;
    case 'ABTrackedRefersDelete':include_once('admin/modules/nukesentinel/ABTrackedRefersDelete.php');break;
    case 'ABTrackedRefersIPs':include_once('admin/modules/nukesentinel/ABTrackedRefersIPs.php');break;
    case 'ABTrackedRefersListAdd':include_once('admin/modules/nukesentinel/ABTrackedRefersListAdd.php');break;
    case 'ABTrackedRefersListAddSave':include_once('admin/modules/nukesentinel/ABTrackedRefersListAddSave.php');break;
    case 'ABTrackedRefersListPrint':include_once('admin/modules/nukesentinel/ABTrackedRefersListPrint.php');break;
    case 'ABTrackedRefersPages':include_once('admin/modules/nukesentinel/ABTrackedRefersPages.php');break;
    case 'ABTrackedRefersPagesPrint':include_once('admin/modules/nukesentinel/ABTrackedRefersPagesPrint.php');break;
    case 'ABTrackedUsersList':include_once('admin/modules/nukesentinel/ABTrackedUsersList.php');break;
    case 'ABTrackedUsersDelete':include_once('admin/modules/nukesentinel/ABTrackedUsersDelete.php');break;
    case 'ABTrackedUsersIPs':include_once('admin/modules/nukesentinel/ABTrackedUsersIPs.php');break;
    case 'ABTrackedUsersListPrint':include_once('admin/modules/nukesentinel/ABTrackedUsersListPrint.php');break;
    case 'ABTrackedUsersPages':include_once('admin/modules/nukesentinel/ABTrackedUsersPages.php');break;
    case 'ABTrackedUsersPagesPrint':include_once('admin/modules/nukesentinel/ABTrackedUsersPagesPrint.php');break;
  }
} else {
  echo "Access Denied";
}

?>
