<?php    
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
/************************************************************************/
/*                                                                      */
/* Based on Journey Links Hack                                          */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/************************************************************************/

/******************************************************/
/* Enhanced Downloads Module - V2.1                   */
/* ================================                   */
/*                                                    */
/* Released: January, 14 2003                         */
/* Copyright (c) 2003 by Shawn Archer                 */
/* shawn@nukestyles.com                               */
/* http://www.NukeStyles.com                          */
/*                                                    */
/******************************************************/
/*                                                    */
/* Copyright Notice:                                  */
/* =================                                  */
/*                                                    */
/* THIS MODULE IS NOT RELEASED UNDER THE GPL/GNU      */
/* LICENSE.                                           */
/*                                                    */
/* You can modifiy all files, EXCEPT the copyright    */
/* file to your liking. But you CANNOT redistribute   */
/* this module for any purpose, without the EXPRESS   */
/* WRITTEN CONSENT from Shawn Archer.                 */
/*                                                    */
/* Also, Francisco Burzi & the Nuke credits MUST      */
/* remain. Please be fair with everyone that helps    */
/* you with this great CMS Script.                    */
/*                                                    */
/******************************************************/

if (!preg_match("/modules.php/", $_SERVER["PHP_SELF"])) {
    die("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require_once("modules/$module_name/ns_downloads_file.php");  
require_once("mainfile.php");

global $prefix, $db, $ns_dl_anon_weight, $ns_dl_outside_weight;
    $result_ii = $db->sql_query("SELECT ns_dl_outside_vote, ns_dl_anon_wait_days, ns_dl_outside_wait_days, ns_dl_anon_weight, ns_dl_outside_weight, ns_dl_main_dec, ns_dl_detail_dec from ".$prefix."_ns_downloads_rating");
    list($ns_dl_outside_vote, $ns_dl_anon_wait_days, $ns_dl_outside_wait_days, $ns_dl_anon_weight, $ns_dl_outside_weight, $ns_dl_main_dec, $ns_dl_detail_dec) = $db->sql_fetchrow($result_ii);

$outsidevotes = 0;
$anonvotes = 0;
$outsidevoteval = 0;
$anonvoteval = 0;
$regvoteval = 0;	
$truecomments = $totalvotesDB;
while(list($ratingDB, $ratinguserDB, $ratingcommentsDB)=$db->sql_fetchrow($voteresult)) {
    if ($ratingcommentsDB=="") $truecomments--;
    if ($ratinguserDB==$anonymous) {
	$anonvotes++;
	$anonvoteval += $ratingDB;
    }
    if ($ns_dl_outside_vote == 1) {
    	if ($ratinguserDB=='outside') {
	    $outsidevotes++;
	    $outsidevoteval += $ratingDB;
	}
    } else { 
	$outsidevotes = 0;
    }
    if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") { 
	$regvoteval += $ratingDB;
    }
}
$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
if ($totalvotesDB == 0) { 
    $finalrating = 0;
} else if ($anonvotes == 0 && $regvotes == 0) {
    /* Figure Outside Only Vote */
    $finalrating = $outsidevoteval / $outsidevotes;
    $finalrating = number_format($finalrating, 4); 
} else if ($outsidevotes == 0 && $regvotes == 0) {
    /* Figure Anon Only Vote */
    $finalrating = $anonvoteval / $anonvotes;	     	 	
    $finalrating = number_format($finalrating, 4); 
} else if ($outsidevotes == 0 && $anonvotes == 0) {
    /* Figure Reg Only Vote */
    $finalrating = $regvoteval / $regvotes;	     	 	
    $finalrating = number_format($finalrating, 4); 	     	 	
} else if ($regvotes == 0 && $ns_dl_outside_vote == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
    /* Figure Reg and Anon Mix */
    $avgAU = $anonvoteval / $anonvotes;
    $avgOU = $outsidevoteval / $outsidevotes;	 	 	
    if ($ns_dl_anon_weight > $ns_dl_outside_weight) {
	/* Anon is 'standard weight' */
	$newimpact = $ns_dl_anon_weight / $ns_dl_outside_weight;
	$impactAU = $anonvotes;
	$impactOU = $outsidevotes / $newimpact;
	$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
	$finalrating = number_format($finalrating, 4); 
    } else {
	/* Outside is 'standard weight' */
	$newimpact = $ns_dl_outside_weight / $ns_dl_anon_weight;
	$impactOU = $outsidevotes;
	$impactAU = $anonvotes / $newimpact;
	$finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
	$finalrating = number_format($finalrating, 4); 
    }       		         	
} else {
    /* Registered User vs. Anonymous vs. Outside User Weight Calutions */
    $impact = $ns_dl_anon_weight;
    $outsideimpact = $ns_dl_outside_weight;
    if ($regvotes == 0) {
	$regvotes = 0;
    } else { 
	$avgRU = $regvoteval / $regvotes;
    }
    if ($anonvotes == 0) {
	$avgAU = 0;
    } else {
	$avgAU = $anonvoteval / $anonvotes;
    }
    if ($outsidevotes == 0 ) {
	$avgOU = 0;
    } else {
	$avgOU = $outsidevoteval / $outsidevotes;
    }
    $impactRU = $regvotes;
    $impactAU = $anonvotes / $impact;
    $impactOU = $outsidevotes / $outsideimpact;
    $finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
    $finalrating = number_format($finalrating, 4); 
}

?>