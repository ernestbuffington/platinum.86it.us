<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Top Sites V1.4                                                       */
/* Copyright (c) 2003-2004 by Sid                                       */
/* http://nuke.xanys.com                                                */
/* sid@xanys.com                                                        */
/*                                                                      */
/* Based on Web Links Hack                                              */
//* Copyright (c) 2002 by Francisco Burzi                               */
/* http://phpnuke.org                                                   */
/*                                                                      */
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
/*                                                                      */
/* Platinum Nuke Pro: Your dreams, our imagination                      */
/************************************************************************/
##############################################################################
# This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com  #
#                                                                            #
# This program is free software. You can redistribute it and/or modify       #
# it under the terms of the GNU General Public License as published by       #
# the Free Software Foundation; either version 2 of the License.             #
##############################################################################

@require_once("mainfile.php");

global $prefix,$db;
$result_config = $db->sql_query("SELECT autovalidation,evaluation,perpage,linksresults,anonwaitdays,outsidewaitdays,useoutsidevoting,
              maxaffichage,categorie_option,receivemail,delafterxdays,delxdays,nextdatedeletevote,latest,
	         resizeimage,maxwidth,maxheight,altbgcolor1,altbgcolor2 from ".$prefix."_top_sites_config");
list($autovalidation,$evaluation,$perpage,$linksresults,$anonwaitdays,$outsidewaitdays,$useoutsidevoting,
         $maxaffichage,$categorie_option,$receivemail,$delafterxdays,$delxdays,$nextdatedeletevote,$latest,
	    $resizeimage,$maxwidth,$maxheight,$altbgcolor1,$altbgcolor2) = $db->sql_fetchrow($result_config);
  

$outsidevotes = 0;
$anonvotes = 0;
$regvotes= 0;
$outsidevoteval = 0;
$anonvoteval = 0;
$regvoteval = 0;	
while(list($ratingDB, $ratinguserDB)=$db->sql_fetchrow($voteresult)) {
    if ($ratinguserDB==$anonymous ) {
	   if ($ratingDB !=0) {
	   $anonvotes++;
	   $anonvoteval += $ratingDB;
	   } else {
	   $anonvotes=$anonvotes;
	   $anonvoteval=$anonvoteval;
	   }
    }
    if ($useoutsidevoting == 1) {
	    if ($ratinguserDB=='outside' ) {
		    if ($ratingDB !=0) {
	          $outsidevotes++;
	          $outsidevoteval += $ratingDB;
		     } else {
	           $outsidevotes=$outsidevotes;
	          $outsidevoteval=$outsidevoteval;
	         }
	     }
    } else { 
	   $outsidevotes = 0;
    }
    if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside" ) { 
	   if ($ratingDB !=0) {
	      $regvotes++;
	      $regvoteval += $ratingDB;
		} else {
		$regvotes=$regvotes;
		  $regvoteval=$regvoteval;
		}  
    }
}
//$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
if ($totalvotesDB == 0) { 
    $finalrating = 0;
	
} else if ($anonvotes == 0 && $outsidevotes==0 && $regvotes == 0) {
    /* Figure Outside Only Vote */
    
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
		     	 	
} else if ($regvotes == 0 && $useoutsidevoting == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
    /* Figure Reg and Anon Mix */
    $avgAU = $anonvoteval / $anonvotes;
    $avgOU = $outsidevoteval / $outsidevotes;
	
	$finalrating = ($anonvoteval + $outsidevoteval) / ($anonvotes + $outsidevotes);
	$finalrating = number_format($finalrating, 4);
		 	 		    		         	
} else {
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
    $finalrating = ($regvoteval + $anonvoteval + $outsidevoteval) / ($regvotes + $anonvotes + $outsidevotes);
    $finalrating = number_format($finalrating, 4); 
}

?>