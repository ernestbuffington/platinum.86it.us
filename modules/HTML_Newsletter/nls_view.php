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
/************************************************************************
* Rev Date      Change ID       Description
* -----------   --------------  -----------------------------------------
* 18-MAY-2006   RN_0000185      Make XHTML 1.0 Compliant, plus better use of quotes
* 12-MAR-2006   MSNL_010301_04  Move admin check to admin scripts for 7.4
************************************************************************/

if ( !defined( 'MSNL_LOADED' ) ) { die( 'Illegal File Access' ); }

/************************************************************************
* Get the Newsletter to view
************************************************************************/

$msnl_iNID = intval( $msnl_nid );

$sql = 'SELECT `filename`, `hits`, `view`, `groups`, `cid` FROM `'
	.$prefix.'_hnl_newsletters` '
	.'WHERE `nid` = \''.$msnl_iNID.'\'';
			
$result					= msnl_fSQLCall( $sql );
$resultcount		= $db->sql_numrows( $result );

/************************************************************************
* View the newsletter if no errors and the file exists
************************************************************************/

if ( !$result || $resultcount < 1 ) { //Bad SQL call

	msnl_fRaiseAppError( _MSNL_NLS_VIEW_ERR_DBGETNL );	
	
} else { //Successful SQL call

	$row = $db->sql_fetchrow( $result );

	$msnl_asRec['hits']			= intval( $row['hits'] );
	$msnl_asRec['cid']			= intval( $row['cid'] );
	$msnl_asRec['view']			= intval( $row['view'] );
	$msnl_asRec['groups']		= stripslashes( $row['groups'] );
	$msnl_asRec['filename']	= $row['filename'];

	if ( msnl_fIsViewable( $msnl_asRec['view'], $msnl_asRec['cid'], $msnl_asRec['groups']) ) {  //User is allowed to view this newsletter

		//Increment hits on the newsletter as long as not admin

		if ( !is_admin( $admin ) ) {  //MSNL_010301_04

			$msnl_asRec['hits']++;

			$sql	= 'UPDATE `'.$prefix.'_hnl_newsletters` '
				.'SET `hits` = \''.$msnl_asRec['hits'].'\' '
				.'WHERE `nid` = \''.$msnl_iNID.'\'';

			$db->sql_query( $sql );

		}

		//Get the newsletter file then echo the newsletter

		$msnl_sFilePath	= 'modules/'.$msnl_sModuleNm.'/archive/'.$msnl_asRec['filename'];

		if ( @file_exists( $msnl_sFilePath ) ) {

			@include_once( $msnl_sFilePath );

		} else {

			msnl_fRaiseAppError( _MSNL_NLS_VIEW_ERR_CANNOTFIND );	

		}

		echo $emailfile;

	} else {  //user is not allowed to view this newsletter

		msnl_fRaiseAppError( _MSNL_NLS_VIEW_ERR_NOTAUTH );	

	} //End IF check for view permissions
	
} //End IF check for successfull DB call

?>
