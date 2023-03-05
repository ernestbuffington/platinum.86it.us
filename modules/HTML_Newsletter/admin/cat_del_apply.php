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
* Script:			HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:		01.03.02
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright © 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

if ( !defined( 'MSNL_LOADED' ) ) { die( "Illegal File Access" ); }

/************************************************************************
* If this script is called "directly", as apposed to from cat_del.php
* we need to do some initialization and HTML formatting.
************************************************************************/

if ( !defined('MSNL_APPLY') ) {

	/************************************************************************
	* Script Initialization
	************************************************************************/

	opentable();

	/************************************************************************
	* FORM variable validation and cleansing
	************************************************************************/

	if ( !isset($_POST['msnl_cid']) ) { //Should not get here without a role id set

		msnl_fRaiseAppError( _MSNL_CAT_ERR_INVALIDCID );	

	}

	$msnl_iCID	= intval( $_POST['msnl_cid'] );

	/************************************************************************
	* Came from a direct call to script meaning there was impact to existing
	* newsletters.  Must re-assign all newsletters which have this category.
	************************************************************************/

	$sql	= "UPDATE `".$prefix."_hnl_newsletters` SET "
					."`cid` = 							1 "
					."WHERE `cid` = '"			.$msnl_iCID."'";

	if ( !msnl_fSQLCall( $sql ) ) { //Had an error in the re-assignment UPDATE

		msnl_fRaiseAppError( _MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN );	

	}

} //End of IF to test if initialization needs to be done

/************************************************************************
* Perform the delete.
************************************************************************/

$sql	= "DELETE FROM `".$prefix."_hnl_categories` "
				."WHERE `cid` = '$msnl_iCID'";

if ( !msnl_fSQLCall( $sql ) ) { //Had an error in the DELETE

	msnl_fRaiseAppError( _MSNL_CAT_DEL_APPLY_ERR_DBDELETE );	

} else {

	if ( !defined('MSNL_APPLY') ) { //Have already written out the following

		echo "\n<form method='post' action='$admin_file.php' name='msnl_frm'>\n";
		echo "<div id='msnl_div_init'>\n";
		echo "<input type='hidden' name='op' value='msnl_cat'>\n";
		echo "</div>\n";

	}

	echo "<div ${msnl_asCSS['BLOCK_center']}>"
				."<p><span class='title'>". _MSNL_COM_MSG_DELSUCCESS ."</span></p>\n"
					."<p>"
						."[ <a href=\"javascript:msnl_FormHandler('msnl_cat');\" title='"._MSNL_LNK_CATEGORYCFG."'>"
								._MSNL_CAT_MSG_CATBACK
						."</a> ] \n"
					."</p>\n"
				."</div>\n";

	if ( !defined('MSNL_APPLY') ) {

		echo "</form>\n";

	}

} //End IF check for successful DB update

/************************************************************************
* Close up the web page.
************************************************************************/

if ( !defined('MSNL_APPLY') ) {

	closetable();

}

?>