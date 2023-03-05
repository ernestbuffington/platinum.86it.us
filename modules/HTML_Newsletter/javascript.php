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
************************************************************************/

if ( !defined( 'MSNL_LOADED' ) and !defined( 'BLOCK_FILE' ) and !defined( 'NUKE_FILE' ) ) {
	die( 'Illegal File Access' );
}

/************************************************************************
* This script writes out the key Javascript functions that are used in 
* the module and admin.
************************************************************************/

echo '<script type="text/javascript">';
echo '<!-- Javascript functions for HTML Newsletter Admin tools'."\n";

//Try and stop the preview pop-up when using the history(-1) function

echo 'msnl_iPreviewON = 1;'."\n";;

/************************************************************************
* Function: msnl_FormHandler()
* Inputs:   msnl_sOP = The operation to pass into the form submit
* Usage:    Used to change a page's form operation based on different
*           page links (functions).
************************************************************************/

echo 'function msnl_FormHandler(msnl_sOP) {';
echo '	document.msnl_frm.op.value = msnl_sOP;';
echo '	document.msnl_frm.submit();';
echo '}'."\n";;

/************************************************************************
* Function: msnl_ObjHandler()
* Inputs:   msnl_sOP = The operation to pass into the form submit
*           msnl_sVAR = The specific form variable to change the value for
*           msnl_iID = The ID value to change the variable to (integer
*             value ONLY)
* Usage:    This function is similar to msnl_FormHandler except that it
*           has further granular control over the form variable being
*           modified and is primarily used for object level maintainance
*           functions.
************************************************************************/

echo 'function msnl_ObjHandler(msnl_sOP, msnl_sVAR, msnl_iID) {';
echo '	eval("document.msnl_frm." + msnl_sVAR + ".value = msnl_iID");';
echo '	msnl_FormHandler(msnl_sOP);';
echo '}'."\n";;

/************************************************************************
* Function: msnl_ObjFocus()
* Inputs:   msnl_sField	= The form field to set focus on
* Usage:    Used to set the focus on the provided form field upon
*           completing the writing of the page.
************************************************************************/

echo 'function msnl_ObjFocus(msnl_sField) {';
echo '	eval("document.msnl_frm." + msnl_sField + ".focus()");';
echo '}'."\n";;

//Close the javascript hide tag

echo '-->';
echo '</script>';

?>