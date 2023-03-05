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
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright © 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright © 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    01.03.02
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
if ( !defined( 'BLOCK_FILE' ) and !defined( 'NUKE_FILE' ) ) {
	Header( 'Location: index.php' );
	die();
}
/************************************************************************
* Initialize and assign key block variables.
************************************************************************/
global $db, $prefix, $msnl_gasModCfg, $msnl_sModuleNm;
$msnl_sModuleNm	= 'HTML_Newsletter';	//If you change the module directory, change every instance of this definition
@require_once( 'modules/'.$msnl_sModuleNm.'/javascript.php' );
@require_once( 'modules/'.$msnl_sModuleNm.'/functions.php' );
@require_once( 'modules/'.$msnl_sModuleNm.'/config.php' );
@include_once( 'modules/'.$msnl_sModuleNm.'/style.php' );
/************************************************************************
* Build block content.
************************************************************************/
$content = '<p>';
if ( $msnl_gasModCfg['scroll'] == 1 ) {
	$content .='<marquee behavior="scroll" align="center" direction="up" '
						.'height="'.$msnl_gasModCfg['scroll_height'].'" '
						.'scrollamount="'.$msnl_gasModCfg['scroll_amt'].'" '
						.'scrolldelay="'.$msnl_gasModCfg['scroll_delay'].'" '
						.'onmouseover="this.stop()" onmouseout="this.start()">'."\n";
}
//Get Newsletter List and build the block content
if ( $msnl_gasModCfg['show_categories'] == 1 ) {  //Build SQL for displaying categories
	$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, '
				.'`ctitle`, `cblocklimit`, `filename`  FROM `'
				.$prefix.'_hnl_newsletters` as nl, `'
				.$prefix.'_hnl_categories` nc WHERE nl.`cid` = nc.`cid` '
				.'ORDER BY `ctitle` ASC, `datesent` DESC';
} else {  //Build SQL for displaying just date sorted list of newsletters
	$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, `hits`, '
				.'`ctitle`, `cblocklimit`  FROM `'
				.$prefix.'_hnl_newsletters` as nl, `'
				.$prefix.'_hnl_categories` nc WHERE nl.`cid` = nc.`cid` ORDER BY `datesent` DESC';
}
$msnl_result2 = msnl_fSQLCall( $sql );
$msnl_iTotNls		= 1;	//Index for total number of newsletters displayed
$msnl_iNbrNls		= 1;	//Index for number of newsletters displayed within a category
$msnl_sPrevCat	= '';	//For determining category breaks
$msnl_iMoreNls	= 0;	//Flag for when to display the "More Newsletters..." link
while ( $row = $db->sql_fetchrow( $msnl_result2 ) ) {
	$msnl_iNID					= intval( $row['nid'] );
	$msnl_iCID					= intval( $row['cid'] );
	$msnl_sTopic				= stripslashes( $row['topic'] );
	$msnl_sSender				= stripslashes( $row['sender'] );
	$msnl_sDatesent			= $row['datesent'];
	$msnl_iView					= intval( $row['view'] );
	$msnl_sGroups 			= stripslashes( $row['groups'] );
	$msnl_iHits 				= intval( $row['hits'] );
	$msnl_sCtitle 			= stripslashes( $row['ctitle'] );
	$msnl_iCblocklimit 	= intval( $row['cblocklimit'] );
	$msnl_filename 			= stripslashes($row['filename']);
	if ( $msnl_gasModCfg['show_categories'] == 1 ) { //Need to do more work if we are to place newsletters in categories
		if ( msnl_fIsViewable( $msnl_iView, $msnl_iCID, $msnl_sGroups ) ) {  //Is the newsletter viewable by the user?
			if ( $msnl_iTotNls <= $msnl_gasModCfg['blk_lmt'] ) {  //Can still fit more newsletters in the block?
				if ( $msnl_sCtitle <> $msnl_sPrevCat ) {  //Do we need to write out a new category heading?
					$content .= '</p><p '.$msnl_asCSS['BLOCK_center'].'><strong>'
										.'<a href="modules.php?name='.$msnl_sModuleNm.'" '
										.'title="'._MSNL_NLS_LNK_VIEWNLARCHS.'">'.$msnl_sCtitle.'</a></strong></p>'."\n".'<p>';
					$msnl_sPrevCat = $msnl_sCtitle;
					$msnl_iNbrNls = 1;
				}
				if ( $msnl_iNbrNls <= $msnl_iCblocklimit ) {  //Can still fit more newsletters into the category display?
					$mod_row = msnl_fGetBlockRow( $msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent, $msnl_filename ) ;
					if ( !empty($mod_row) ) {
						$content .= $mod_row . '<br />';
						$msnl_iNbrNls++;
						$msnl_iTotNls++;
					}
				} else {
					$msnl_iMoreNls = 1;
				}
			} else {  //Have reached the limit on number of newsletters allowed in the block
				$msnl_iMoreNls = 1;  //Flag that we still have more viewable newsletters than can fit in the block
				break;
			}
		}
	} else {  //No categories
		if ( msnl_fIsViewable( $msnl_iView, $msnl_gasModCfg['nsn_groups'], $msnl_iCID, $msnl_sGroups ) ) {  //Check if newsletter is viewable by the user
			if ( $msnl_iNbrNls <= $msnl_gasModCfg['blk_lmt'] ) {  //Can still fit more newsletters in the block
				$mod_row = msnl_fGetBlockRow( $msnl_iNbrNls, $msnl_iNID, $msnl_sTopic, $msnl_sSender, $msnl_iHits, $msnl_sDatesent, $msnl_filename );
				if ( !empty($mod_row) ) {
					$content .= $mod_row . '<br />';
					$msnl_iNbrNls++;
					$msnl_iTotNls++;
				}
			} else {  //Have reached the limit on number of newsletters allowed in the block
				$msnl_iMoreNls = 1;  //Flag that we still have more viewable newsletters than can fit in the block
				break;
			}
		}
	} //End of showcategories IF
} //End of while loop for list of newsletters
if ( $msnl_iTotNls == 0 ) {  //There were no newsletters to view
	$content .= '</p><p '.$msnl_asCSS['BLOCK_center'].'><strong>'. _MSNL_NLS_LST_MSG_NONLS .'</strong>';
}
if ( $msnl_iMoreNls ) {
	$content .= '</p><p '.$msnl_asCSS['BLOCK_center'].'><strong>'
							.'<a href="modules.php?name='.$msnl_sModuleNm.'" '
							.'title="'._MSNL_NLS_LNK_VIEWNLARCHS.'">'._MSNL_NLS_LAB_MORENLS.'</a></strong>';
}
if ( $msnl_gasModCfg['scroll'] == 1 ) {
	$content .='</marquee>';
}
$content .= '</p>'."\n";
?>
