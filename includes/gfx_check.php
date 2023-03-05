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
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

function security_code($gfxchk, $size='normal', $force=0) {
	global $gfx_chk, $user, $admin;
	if (!GDSUPPORT) return '';
	if (!$force) {
		if (is_array($gfxchk)) {  //login check
			if (!in_array($gfx_chk, $gfxchk)) return '';
		} else {
			$gfxchk = intval($gfxchk);
			if ($gfxchk == 0 or is_admin($admin)) return '';
			if (is_user($user) and $gfxchk != 2 and $gfxchk != 3) return '';
			if (!is_user($user) and $gfxchk != 1 and $gfxchk != 3) return '';
		}
	}
	$code = '';
	if (defined('VISUAL_CAPTCHA')) {
		switch($size) {
			case 'large':
			$code .= '<tr><td>'._SECURITYCODE.':</td><td><img src="images/captcha.php?size=large" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /></td></tr>'."\n";
			$code .= '<tr><td>'._TYPESECCODE.':</td><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>'."\n";
			$code .= "\n";
			break;
			case 'normal':
			$code .= '<tr><td>'._SECURITYCODE.':</td></tr><tr><td><img src="images/captcha.php?size=normal" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /></td></tr>'."\n";
			$code .= '<tr><td>'._TYPESECCODE.':</td></tr><tr><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>'."\n";
			$code .= "\n";
			break;
			case 'small':
			$code .= _SECURITYCODE.': <img src="images/captcha.php?size=small" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" />'."\n";
			$code .= _TYPESECCODE.': <input type="text" name="gfx_check" size="10" maxlength="10" />'."\n";
			$code .= "\n";
			break;
			case 'stacked':
			$code .= _SECURITYCODE.'<br /><img src="images/captcha.php?size=normal" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /><br />'."\n";
			$code .= _TYPESECCODE.' <br /><input type="text" name="gfx_check" size="10" maxlength="10" />'."\n";
			$code .= '<br />'."\n";
			break;
			case 'demo':
				$code .= '<img src="images/captcha.php?size=large" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" />';
			break;
		}
	} else {
		switch($size) {
			case 'large':
			$code .= '<tr><td>'._SECURITYCODE.':</td><td><img src="?gfx=gfx" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /></td></tr>'."\n";
			$code .= '<tr><td>'._TYPESECCODE.':</td><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>'."\n";
			break;
			case 'normal':
			$code .= '<tr><td>'._SECURITYCODE.':</td></tr><tr><td><img src="?gfx=gfx" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /></td></tr>'."\n";
			$code .= '<tr><td>'._TYPESECCODE.':</td></tr><tr><td><input type="text" name="gfx_check" size="10" maxlength="10" /></td></tr>'."\n";
			break;
			case 'small':
			$code .= _SECURITYCODE.': <img src="?gfx=gfx" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" />'."\n";
			$code .= _TYPESECCODE.': <input type="text" name="gfx_check" size="10" maxlength="10" />'."\n";
			break;
			case 'stacked':
			$code .= _SECURITYCODE.'<br /><img src="?gfx=gfx" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" /><br />'."\n";
			$code .= _TYPESECCODE.' <br /><input type="text" name="gfx_check" size="10" maxlength="10" />'."\n";
			break;
			case 'demo':
				$code .= '<img src="gfx=gfx" border="0" alt="'._SECURITYCODE.'" title="'._SECURITYCODE.'" />';
			break;
		}
	}
	return $code;
}

function security_code_check($gfx_code, $gfxchk,  $force=0) {
	global $gfx_chk, $user, $admin;
	//If there is no GD then we did not have a code
	if (!GDSUPPORT) {
		return true;
	}
	//Start the session
	if(!isset($_SESSION)) { session_start(); }

	if (!$force) {
		if (is_array($gfxchk)) {  //login check
			if (!in_array($gfx_chk, $gfxchk)) {
				if (isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
				return true;
			}
		} else {
			$passModChk = FALSE;
			$gfxchk = intval($gfxchk);
			if ($gfxchk == 0 or is_admin($admin)) $passModChk = TRUE;
			if (is_user($user) and $gfxchk != 2 and $gfxchk != 3) $passModChk = TRUE;
			if (!is_user($user) and $gfxchk != 1 and $gfxchk != 3) $passModChk = TRUE;
			if ($passModChk) {
				if (isset($_SESSION['GFXCHECK'])) unset($_SESSION['GFXCHECK']);
				return true;
			}
		}
	}

	if (defined('VISUAL_CAPTCHA')) {
		require_once(NUKE_CLASSES_DIR.'class.php-captcha.php');
		if (PhpCaptcha::Validate($gfx_code)) {
			return true;
		} else {
			return false;
		}
	} else {
		//If there is no session
		if(!isset($_SESSION['GFXCHECK'])) {
			return false;
		}
		//If the code and the session code doesnt match
		if ($gfx_code != $_SESSION['GFXCHECK']) {
			unset($_SESSION['GFXCHECK']);
			return false;
		}
		//Unset the session code so it cannot be reused
		unset($_SESSION['GFXCHECK']);

		return true;
	}
}

?>