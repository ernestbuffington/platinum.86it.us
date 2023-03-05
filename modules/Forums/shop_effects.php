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
if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}

define('IN_PHPBB', true);

$phpbb_root_path = 'modules/Forums/';

include_once($phpbb_root_path . 'extension.inc'); 

include_once($phpbb_root_path . 'common.'.$phpEx);

include_once ('header.php');

global $prefix;

//

// Start session management

//

$userdata = session_pagestart($user_ip, PAGE_PROFILE,$nukeuser);

init_userprefs($userdata);

//

// End session management

//

//Over rule the points with cash

$sql="SELECT cash_name FROM ".$prefix."_bbcash"; 

if ( !($sresult = $db->sql_query($sql)) ) { 

	message_die(GENERAL_MESSAGE, 'Cash Table Not Found');  

} else {

	$row = $db->sql_fetchrow($sresult);

	$board_config['points_name'] = $row[0];

	$db->sql_freeresult($sresult);

}

$sql="SELECT  cash_dbfield FROM ".$prefix."_bbcash";

if ( !($sresult = $db->sql_query($sql)) ) { 

	message_die(GENERAL_MESSAGE, 'Cash Table Not Found');  

} else {

	$row = $db->sql_fetchrow($sresult);

	$cash_field = $row[0];

	$db->sql_freeresult($sresult);

}

//

// Start page Variables

//

$colordropdown = '<td class="row2"><select name="color"><option value="000000">Black</option><option value="333399">Blue, Dark</option><option value="3366FF">Blue, Light</option><option value="99FFFF">Cyan</option><option value="A4A467">Gold</option><option value="339933">Green, Dark</option><option value="66FF33">Green, Light</option><option value="999999">Grey, Dark</option><option value="CCCCCC">Grey, Light</option><option value="FF9900">Orange</option><option value="FF33FF">Pink</option><option value="CC33FF">Purple</option><option value="993333">Red, Dark</option><option value="FF3366">Red, Light</option><option value="FFFFFF">White</option><option value="FFFF00">Yellow</option></select>';

//

// End page variables

//



//start of special shop display

if (($_REQUEST['action'] == "specialshop") || (empty($_REQUEST['action'])))

{

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = "shop.$phpEx&action=specialshop";

		$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}



	$shoparray = explode("ß", $board_config['specialshop']);

	$shoparraycount = count ($shoparray);

	$shopstatarray = array();

	for ($x = 0; $x < $shoparraycount; $x++)

	{

		$temparray = explode("Þ", $shoparray[$x]);

		$shopstatarray[] = $temparray[0];

		$shopstatarray[] = $temparray[1];

	}



	//start checks for first visit

	if (strlen($userdata['user_privs']) < 2) { 

		$sql = "update " . USERS_TABLE . " set user_effects='ßnoÞ0ßnoÞ0ßnoÞ0', user_privs='ßnoÞ0ßnoÞ0ßnoÞ0' where username='{$userdata['username']}'";

		if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Fixing User!'); }

		if (strlen($userdata['user_custitle']) < 2) {

			$sql = "update " . USERS_TABLE . " set user_custitle='ßoffÞ0ßoffÞ0ßoffÞ0ßoffÞ0ßoffÞ0' where username='{$userdata['username']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Fixing User!'); }

		}

		header("Location: shop_effects.php");

	}

	//end first visit checks



	$usereffects = explode("ß", $userdata['user_effects']);

	$userprivs = explode("ß", $userdata['user_privs']);

	$userctitle = explode("ß", $userdata['user_custitle']);

	$userbs = array();

	$usercount = count($userprivs);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $userprivs[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }

	$usercount = count($usereffects);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usereffects[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }

	$usercount = count($userctitle);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $userctitle[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }



	//check enabled

	if ($shopstatarray[3] != "enabled") { message_die(GENERAL_MESSAGE, 'Effects store is not Enabled!'); }



	if (($shopstatarray[6] == on) || ($shopstatarray[8] == on) || ($shopstatarray[10] == on))

	{

		if (($userbs[2] == no) || ($userbs[2] == off)) { $avatarbs = "Buy"; } else { $avatarbs = "Remove"; $avatarowned = "Yes"; }

		if (($userbs[4] == no) || ($userbs[4] == off)) { $sigbs = "Buy"; } else { $sigbs = "Remove"; $sigowned = "Yes"; }

		if (($userbs[6] == no) || ($userbs[6] == off)) { $titlebs = "Buy"; } else { $titlebs = "Remove"; $titleowned = "Yes"; }

		$shopinfo .= '<tr><td class="row2" colspan="5"><span class="gen"><strong>Privileges</strong></span></td></tr>';

		$shopinfo .= '<tr><td class="row2"><span class="gensmall">Privileges</span></td><td class="row2"><span class="gensmall">Cost</span></td><td class="row2"><br></td><td class="row2"><br></td><td class="row2"><span class="gensmall">Owned</span></td></tr>';

		if ($shopstatarray[6] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=avatar&bs=".$avatarbs).'"><tr><td class="row2"><span class="gensmall">Buy Avatar Privilege</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[7].'</span></td><td class="row2"><br></td><td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$avatarbs.' Avatar"></span></td><td class="row2"><span class="gensmall">'.$avatarowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[8] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=sig&bs=".$sigbs).'"><tr><td class="row2"><span class="gensmall">Buy Signature Privilege</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[9].'</span></td><td class="row2"><br></td><td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$sigbs.' Signature"></span></td><td class="row2"><span class="gensmall">'.$sigowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[10] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=title&bs=".$titlebs).'"><tr><td class="row2"><span class="gensmall">Buy Title Privilege</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[11].'</span></td><td class="row2"><br></td><td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$titlebs.' Title"></span></td><td class="row2"><span class="gensmall">'.$titleowned.'</span></td></tr></form>';

		}

	}

	if (($shopstatarray[12] == on) || ($shopstatarray[14] == on) || ($shopstatarray[16] == on))

	{

		$shopinfo .= '<tr><td class="row2" colspan="5"><span class="gen"><strong>Name Effects</strong></span></td></tr>';

		$shopinfo .= '<tr><td class="row2"><span class="gensmall">Effects</span></td><td class="row2"><span class="gensmall">Cost</span></td><td class="row2"><span class="gensmall">Colors</span></td><td class="row2"><br></td><td class="row2"><span class="gensmall">Owned</span></td></tr>';

		if (($userbs[10] == no) || ($userbs[10] == off)) { $colorbs = "Buy"; } else { $colorbs = "Remove"; $colorowned = "<font color=\"".$userbs[11]."\">Yes"; }

		if (($userbs[12] == no) || ($userbs[12] == off)) { $shadowbs = "Buy"; } else { $shadowbs = "Remove"; $shadowowned = "<font color=\"".$userbs[13]."\">Yes"; }

		if (($userbs[14] == no) || ($userbs[14] == off)) { $glowbs = "Buy"; } else { $glowbs = "Remove"; $glowowned = "<font color=\"".$userbs[15]."\">Yes"; }

		if ($shopstatarray[12] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=color&bs=".$colorbs).'"><tr><td class="row2"><span class="gensmall">Buy Color</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[13].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$colorbs.' Color"></span></td><td class="row2"><span class="gensmall">'.$colorowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[14] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=glow&bs=".$glowbs).'"><tr><td class="row2"><span class="gensmall">Buy Glow</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[15].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$glowbs.' Glow"></span></td><td class="row2"><span class="gensmall">'.$glowowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[16] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=bsspecial&type=shadow&bs=".$shadowbs).'"><tr><td class="row2"><span class="gensmall">Buy Shadow</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[17].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$shadowbs.' Shadow"></span></td><td class="row2"><span class="gensmall">'.$shadowowned.'</span></td></tr></form>';

		}

	}

	if (($shopstatarray[18] == on) || ($shopstatarray[20] == on) || ($shopstatarray[22] == on))

	{

		$shopinfo .= "<tr><td class=\"row2\" colspan=\"5\"><span class=\"gen\"><strong>Title Effects</strong></span></td></tr>";

		$shopinfo .= "<tr><td class=\"row2\"><span class=\"gensmall\">Effects</span></td><td class=\"row2\"><span class=\"gensmall\">Cost</span></td><td class=\"row2\"><span class=\"gensmall\">Colors</span></td><td class=\"row2\"><br></td><td class=\"row2\"><span class=\"gensmall\">Owned</span></td></tr>";

		if (($userbs[18] == no) || ($userbs[18] == off)) { $tcolorbs = "Buy"; } else { $tcolorbs = "Remove"; $tcolorowned = "<font color=\"".$userbs[19]."\">Yes"; }

		if (($userbs[20] == no) || ($userbs[20] == off)) { $tglowbs = "Buy"; } else { $tglowbs = "Remove"; $tglowowned = "<font color=\"".$userbs[21]."\">Yes"; }

		if (($userbs[22] == no) || ($userbs[22] == off)) { $tshadowbs = "Buy"; } else { $tshadowbs = "Remove"; $tshadowowned = "<font color=\"".$userbs[23]."\">Yes"; }

		if ($shopstatarray[18] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=tcolor&bs=$tcolorbs").'"><tr><td class="row2"><span class="gensmall">Buy Title Color</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[19].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$tcolorbs.' Color"></span></td><td class="row2"><span class="gensmall">'.$tcolorowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[20] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=tglow&bs=$tglowbs").'"><tr><td class="row2"><span class="gensmall">Buy Title Glow</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[21].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$tglowbs.' Glow"></span></td><td class="row2"><span class="gensmall">'.$tglowowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[22] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=tshadow&bs=$tshadowbs").'"><tr><td class="row2"><span class="gensmall">Buy Title Shadow</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[23].'</span></td>'.$colordropdown.'

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$tshadowbs.' Shadow"></span></td><td class="row2"><span class="gensmall">'.$tshadowowned.'</span></td></tr></form>';

		}

	}

	if (($shopstatarray[24] == on) || ($shopstatarray[26] == on))

	{

		$shopinfo .= "<tr><td class=\"row2\" colspan=\"5\"><span class=\"gen\"><strong>Custom Changes</strong></span></td></tr>";

		$shopinfo .= "<tr><td class=\"row2\"><span class=\"gensmall\">Type</span></td><td class=\"row2\"><span class=\"gensmall\">Cost</span></td><td class=\"row2\"><span class=\"gensmall\">Change to</span></td><td class=\"row2\"><br></td><td class=\"row2\"><span class=\"gensmall\">Owned/Name</span></td></tr>";

		if ((($userbs[24] == no) || ($userbs[24] == off)) || ($userbs[26] == on)) { $ctitlebs = "Buy"; } else { $ctitlebs = "Remove"; $ctitleowned = "Yes"; }

		if ($shopstatarray[24] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=ctitle&bs=$ctitlebs").'"><tr><td class="row2"><span class="gensmall">Change Title</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[25].'</span></td><td class="row2"><input type="text" class="post" name="newtitle" size="25" maxlength="25"></td>

			</td><td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="'.$ctitlebs.' Title"></span></td><td class="row2"><span class="gensmall">'.$ctitleowned.'</span></td></tr></form>';

		}

		if ($shopstatarray[26] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=cusername&bs=Buy").'"><tr><td class="row2"><span class="gensmall">Change Username</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[27].'</span></td><td class="row2"><input type="text" class="post" name="newname" size="25" maxlength="25"></td>

			<td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="Change Name"></span></td><td class="row2"><br></td></tr></form>';

		}

		if ($shopstatarray[28] == on)

		{

			$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.$phpEx?action=bsspecial&type=cutitle&bs=Buy").'"><tr><td class="row2"><span class="gensmall">Change Users Title</span></td><td class="row2"><span class="gensmall">'.$shopstatarray[29].'</span></td><td class="row2"><input type="text" class="post" name="newtitle" size="25" maxlength="25"></td>

			</td><td class="row2"><span class="gensmall"><input type="submit" class="liteoption" value="Change User Title"></span></td><td class="row2"><input type="text" class="post" name="tchangename" size="10" maxlength="50"></td></tr></form>';

		}

	}

	if ($shopstatarray[12] == "on" || $shopstatarray[14] == "on" || $shopstatarray[16] == "on" || $shopstatarray[18] == "on" || $shopstatarray[20] == "on" || $shopstatarray[22] == "on") {

		$shopinfo .= '<tr><td class="row2" colspan="5"><span class="gen"><strong>Test Effects</strong></span></td></tr>';

		$shopinfo .= '<tr><td class="row2" colspan="2"><span class="gensmall">Type</span></td><td class="row2" colspan="3"><span class="gensmall">Colors</span></td></tr>';

		$shopinfo .= '<form method="post" action="'.append_sid("shop_effects.".$phpEx."?action=specialshop&viewname=true#effects").'">';

		if ($shopstatarray[12] == "on" || $shopstatarray[18] == "on")

		{

			$shopinfo .= '<tr><td class="row2" colspan="2"><a name="effects"></a><span class="gensmall">Color</span></td><td class="row2" colspan="3"><select name="color"><option value="none">None</option>'.str_replace('<td class="row2"><select name="color">', '', $colordropdown).'</tr>';

		}

		if ($shopstatarray[14] == "on" || $shopstatarray[20] == "on")

		{

			$shopinfo .= '<tr><td class="row2" colspan="2"><span class="gensmall">Glow</span></td><td class="row2" colspan="3"><select name="gcolor"><option value="none">None</option>'.str_replace('<td class="row2"><select name="color">', '', $colordropdown).'</tr>';

		}

		if ($shopstatarray[16] == "on" || $shopstatarray[22] == "on")

		{

			$shopinfo .= '<tr><td class="row2" colspan="2"><span class="gensmall" colspan="3">Shadow</span></td><td class="row2" colspan="3"><select name="scolor"><option value="none">None</option>'.str_replace('<td class="row2"><select name="color">', '', $colordropdown).'</tr>';

		}

		$shopinfo .= '<tr><td class="row2" colspan="2"><span class="gensmall" colspan="3">Test Text:</span></td><td class="row2" colspan="3"><input type="text" class="post" size="15" maxlength="25" name="testtext"></td></tr>';

		$shopinfo .= '<tr><td colspan="5" class="row2" align="center"><input type="submit" class="liteoption" value="View Effects"></td></tr></form>';

	}

	if ($_REQUEST['viewname'] == "true") {

		if ($_REQUEST['color'] != "none") { $testcolor = '<font color="'.$_REQUEST['color'].'">'; }

		if ($_REQUEST['gcolor'] != "none") { $testglow = '; filter:glow(color=#'.$_REQUEST['gcolor'].', strength=5)'; }

		if ($_REQUEST['scolor'] != "none") { $testshadow = '; filter:shadow(color=#'.$_REQUEST['scolor'].', strength=5)'; }

		if (!preg_match("/^[a-zA-Z0-9 ]*$/", $testtext)) { $text = $userdata['username']; }

		elseif (strlen($testtext) < 2) { $text = $userdata['username']; }

		else { $text = $testtext; }

		$shopinfo .= '<tr><td class="row2" colspan="5" align="center"><span class="gen"><span style="width:100'.$testshadow.''.$testglow.'">'.$testcolor.''.$text.'</font></span></span></td></tr>';

	}

	$page_title = 'Permissions and Effects Store';

	$title = $shopstatarray[5];

	$shoplocation = ' -> <a href="'.append_sid("shop_effects.$phpEx?action=specialshop").'" class="nav">'.$shopstatarray[5].' Abilities</a>';

	if (strlen($shopinfo) > 3) { $shoptablerows = 5; }

	else { $shoptablerows = 1; $shopinforow = '<tr><td class="row2"><span class="gen">There are currently no effects or privlages for sale in this shop.</span></td></tr>'; }



	// start of personal information

	$personal = '<tr><td class="row1" width="50%"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="navsmall">Your Inventory</a></span></td><td class="row1" align="right" width="50%"><span class="gensmall">'.$userdata[$cash_field].' '.$board_config['points_name'].'</span></td></tr>'; 

	if (strlen($userdata['user_specmsg']) > 2) { 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><font color="red">'.$userdata['user_specmsg'].'</font></span></td></tr>'; 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?clm=true").'" class="gen">Clear Messages</a></span></td></tr>';

	}

	//end of personal information



	$template->assign_vars(array(

		'SHOPPERSONAL' => $personal,

		'SHOPLOCATION' => $shoplocation,

		'L_SHOP_TITLE' => $title,

		'SHOPTABLEROWS' => $shoptablerows,

		'SHOPLIST' => $shopinfo,

		'SHOPINFOROW' => $shopinforow,

	));

	$template->assign_block_vars('', array());



}



//start of buy & sell sepcials

elseif ($_REQUEST['action'] == "bsspecial")

{

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = "shop.$phpEx&action=bsspecial&type=".$_REQUEST['type']."&bs=".$_REQUEST['bs']."&color=".$_REQUEST['color'];

		$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	$template->set_filenames(array( 'body' => 'shop_body.tpl'));



	$usereffects = explode("ß", $userdata['user_effects']);

	$userprivs = explode("ß", $userdata['user_privs']);

	$usercustitle = explode("ß", $userdata['user_custitle']);

	$userbs = array();

	$usercount = count($userprivs);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $userprivs[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }

	$usercount = count($usereffects);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usereffects[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }

	$usercount = count($usercustitle);

	for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usercustitle[$x]); $userbs[] = $temppriv[0]; $userbs[] = $temppriv[1]; }



	$shoparray = explode("ß", $board_config['specialshop']);

	$shoparraycount = count ($shoparray);

	$shopstatarray = array();

	for ($x = 0; $x < $shoparraycount; $x++)

	{

		$temparray = explode("Þ", $shoparray[$x]);

		$shopstatarray[] = $temparray[0];

		$shopstatarray[] = $temparray[1];

	}

	if ($_REQUEST['bs'] == "Buy") {

		if ((($_REQUEST['type'] == "ctitle") && ($shopstatarray[24] == "on")) || (($_REQUEST['type'] == "cutitle") && ($shopstatarray[28] == "on"))) { 

			$tsql = "select * from " . RANKS_TABLE . " where rank_title='{$_REQUEST['newtitle']}'";

			if ( !($tresult = $db->sql_query($tsql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Rank Info!'); }

			$trow = $db->sql_fetchrow($tresult);

			if ($db->sql_numrows($tresult) > 0) { message_die(GENERAL_MESSAGE, 'That Rank has already been assigned!'); }

			elseif ((!preg_match("/^[a-zA-Z0-9 ]*$/", $_REQUEST['newtitle'])) || (strlen($_REQUEST['newtitle']) < 2)) { message_die(GENERAL_MESSAGE, 'That Rank is Invalid, it must only contain characters A-Z, a-z and 1-0. For more specific titles talk to an admin.'); }

			if (($_REQUEST['type'] == "cutitle") && ($shopstatarray[28] == "on")) {

				if ($userdata['username'] == $tchangename) { message_die(GENERAL_MESSAGE, 'If you want to change your title, do it with the proper field!'); }

				$sql = "select * from " . USERS_TABLE . " where username='{$_REQUEST['tchangename']}'";

				if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Checking Username!'); }

				$ucrow = $db->sql_fetchrow($result);

				if ((($ucrow['user_level'] == 1) || ($ucrow['user_level'] == 2)) && ($userdata['user_level'] != 1)) { message_die(GENERAL_MESSAGE, 'You cannot change the rank of Admins or Moderators!'); }

				if (strlen($ucrow['username']) < 2) { message_die(GENERAL_MESSAGE, 'No such user exists!'); }

				else { $specialcost = $shopstatarray[29]; }

			}

			else { $specialcost = $shopstatarray[25]; } 

		}

		if (($_REQUEST['type'] == cusername) && ($shopstatarray[26] == "on")) { 

			$sql = "select * from " . USERS_TABLE . " where username='{$_REQUEST['newname']}'";

			if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Checking Username!'); }

			if ($db->sql_numrows($result) > 0) { message_die(GENERAL_MESSAGE, 'That name is already in use, go back and pick another one!'); }

			elseif ((!preg_match("/^[a-zA-Z0-9 ]*$/", $_REQUEST['newname'])) || (strlen($_REQUEST['newname']) < 2)) { message_die(GENERAL_MESSAGE, 'Invalid name, Characters must be A-Z & a-z. If you wish a different type of name change contact an admin.'); } 

			else { $specialcost = $shopstatarray[27]; } 

		}

		if (($_REQUEST['type'] == 'tcolor') && ($shopstatarray[18] == 'on')) { $specialcost = $shopstatarray[19]; }

		if (($_REQUEST['type'] == 'tglow') && ($shopstatarray[20] == 'on')) { $specialcost = $shopstatarray[21]; }

		if (($_REQUEST['type'] == 'tshadow') && ($shopstatarray[22] == 'on')) { $specialcost = $shopstatarray[23]; }

		if (($_REQUEST['type'] == 'avatar') && ($shopstatarray[6] == 'on')) { $specialcost = $shopstatarray[7]; }

		if (($_REQUEST['type'] == 'sig') && ($shopstatarray[8] == 'on')) { $specialcost = $shopstatarray[9]; }

		if (($_REQUEST['type'] == 'title') && ($shopstatarray[10] == 'on')) { $specialcost = $shopstatarray[11]; }

		if (($_REQUEST['type'] == 'color') && ($shopstatarray[12] == 'on')) { $specialcost = $shopstatarray[13]; }

		if (($_REQUEST['type'] == 'shadow') && ($shopstatarray[16] == 'on')) { $specialcost = $shopstatarray[17]; }

		if (($_REQUEST['type'] == 'glow') && ($shopstatarray[14] == 'on')) { $specialcost = $shopstatarray[15]; }

		if (!is_numeric($specialcost)) { message_die(GENERAL_MESSAGE, 'Shop Function not Enabled or Error in Cost!'); }

		if (($_REQUEST['type'] == 'color') || ($_REQUEST['type'] == 'shadow') || ($_REQUEST['type'] == 'glow') || ($_REQUEST['type'] == 'tglow') || ($_REQUEST['type'] == 'tcolor') || ($_REQUEST['type'] == 'tshadow'))

		{

			if (substr_count($colordropdown, '<option value="'.$_REQUEST['color'].'">') < 1) { message_die(GENERAL_MESSAGE, 'This is not a valid color!'); }

		}

		if (($_REQUEST['type'] == 'ctitle') && (($userbs[24] == 'on') && ($userbs[26] != 'on'))) { message_die(GENERAL_MESSAGE, 'You already own a custom title!'); }

		if (($_REQUEST['type'] == 'tcolor') && ($userbs[18] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a colored title!'); }

		if (($_REQUEST['type'] == 'tglow') && ($userbs[20] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a glowing title!'); }

		if (($_REQUEST['type'] == 'tshadow') && ($userbs[22] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a shadowed title!'); }

		if (($_REQUEST['type'] == 'avatar') && ($userbs[2] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have avatar permissions!'); }

		if (($_REQUEST['type'] == 'sig') && ($userbs[4] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have signature permissions!'); }

		if (($_REQUEST['type'] == 'title') && ($userbs[6] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have title permissions!'); }

		if (($_REQUEST['type'] == 'color') && ($userbs[10] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a color in your name!'); }

		if (($_REQUEST['type'] == 'shadow') && ($userbs[12] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a shadow on your name!'); }

		if (($_REQUEST['type'] == 'glow') && ($userbs[14] == 'on')) { message_die(GENERAL_MESSAGE, 'You already have a glow on your name!'); }

		$userleftamount = $userdata[$cash_field] - $specialcost;

		if ($userleftamount < 0) { message_die(GENERAL_MESSAGE, 'You don\'t have enough '.$board_config['points_name'].' to purchase that!'); }

		else { $upsql = "update " . USERS_TABLE . " set ".$cash_field."='$userleftamount' where username='{$userdata['username']}'";

	 	if ( !($db->sql_query($upsql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Updating User Info!'); } }

		if ($_REQUEST['type'] == 'avatar') { $userprs = "ßonÞ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'sig') { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ßonÞ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'title') { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ßonÞ".$userbs[7]; }

		if (($_REQUEST['type'] != 'title') && ($_REQUEST['type'] != 'sig') && ($_REQUEST['type'] != 'avatar')) { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'color') { $usereff = "ßonÞ".$_REQUEST['color']."ß".$userbs[12]."Þ".$userbs[13]."ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'shadow') { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ßonÞ".$_REQUEST['color']."ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'glow') { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ß".$userbs[12]."Þ".$userbs[13]."ßonÞ".$_REQUEST['color']; }

		if (($_REQUEST['type'] != 'glow') && ($_REQUEST['type'] != 'shadow') && ($_REQUEST['type'] != 'color')) { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ß".$userbs[12]."Þ".$userbs[13]."ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'tcolor') { $usercustitle = "ßonÞ".$_REQUEST['color']."ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'tglow') { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ßonÞ".$_REQUEST['color']."ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'tshadow') { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ßonÞ".$_REQUEST['color']."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'ctitle') { 

			$usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ßonÞ".$_REQUEST['newtitle']."ßoffÞ0"; 

			$sql = "update " . USERS_TABLE . " set user_specmsg='' where username='{$userdata['username']}'";

			if (!($db->sql_query($sql))) { message_die(GENERAL_MESSAGE, 'Fatal Error clearing special messages!'); }

		}

		if (($_REQUEST['type'] != 'tglow') && ($_REQUEST['type'] != 'tshadow') && ($_REQUEST['type'] != 'tcolor') && ($_REQUEST['type'] != 'ctitle')) { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] != 'cutitle') { $ussql = "update " . USERS_TABLE . " set user_effects='$usereff', user_privs='$userprs', user_custitle='$usercustitle' where username='{$userdata['username']}'";

		if ( !($db->sql_query($ussql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Updating User Info!'); } }

		if ($_REQUEST['type'] == 'cusername') { 

			$sql = "update " . USERS_TABLE . " set username='{$_REQUEST['newname']}' where username='{$userdata['username']}'";

			if (!($db->sql_query($sql))) { message_die(GENERAL_MESSAGE, 'Fatal Error changing username!'); }

		}

		if ($_REQUEST['type'] == 'cutitle') {

			$usercustitle = explode("ß", $ucrow['user_custitle']);

			$usercount = count($usercustitle);

			$cuserbs = array();

			for ($x = 0; $x < $usercount; $x++) { $temppriv = explode("Þ", $usercustitle[$x]); $cuserbs[] = $temppriv[0]; $cuserbs[] = $temppriv[1]; }

			$usercustitle = "ß".$cuserbs[2]."Þ".$cuserbs[3]."ß".$cuserbs[4]."Þ".$cuserbs[5]."ß".$cuserbs[6]."Þ".$cuserbs[7]."ßonÞ".$_REQUEST['newtitle']."ß".$cuserbs[8]."Þ".$cuserbs[9];

			$usermessage = $userdata['username'].' has changed your title to<i> '.$_REQUEST['newtitle'].'. </i>If this is inappropriate, message an admin.';

			$sql = "update " . USERS_TABLE . " set user_custitle='$usercustitle', user_specmsg='$usermessage' where username='{$_REQUEST['tchangename']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Updating User Info!'); }

		}

		$page_title = 'Buy Special Ability';

		$title = $page_title;

		$shoplocation = ' -> <a href="'.append_sid("shop_effects.$phpEx?action=specialshop").'" class="nav">'.$shopstatarray[5].' Abilities</a> -> <a href="'.append_sid("shop_effects.$phpEx?action=specialshop").'" class="nav">Buy Special Ability</a>';

		$shopinforow = '<tr><td class="row2"><span class="gen">Your purchase has been successful!</span></td></tr>';

	}

	elseif ($_REQUEST['bs'] == "Remove") {

		if (($_REQUEST['type'] == 'avatar') && (($userbs[2] == 'off') || ($userbs[2] == 'no'))) { $error = 1; $msg = 'avatar permissions'; }

		if (($_REQUEST['type'] == 'sig') && (($userbs[4] == 'off') || ($userbs[4] == 'no'))) { $error = 1; $msg = 'signature permission'; }

		if (($_REQUEST['type'] == 'title') && (($userbs[6] == 'off') || ($userbs[6] == 'no'))) { $error = 1; $msg = 'title permission'; }

		if (($_REQUEST['type'] == 'color') && (($userbs[10] == 'off') || ($userbs[10] == 'no'))) { $error = 1; $msg = 'colour in your name'; }

		if (($_REQUEST['type'] == 'shadow') && (($userbs[12] == 'off') || ($userbs[12] == 'no'))) { $error = 1; $msg = 'shadow on your name'; }

		if (($_REQUEST['type'] == 'glow') && (($userbs[14] == 'off') || ($userbs[14] == 'no'))) { $error = 1; $msg = 'glow on your name'; }

		if (($_REQUEST['type'] == 'tcolor') && (($userbs[18] == 'off') || ($userbs[18] == 'no'))) { $error = 1; $msg = 'colour in your title'; }

		if (($_REQUEST['type'] == 'tglow') && (($userbs[20] == 'off') || ($userbs[20] == 'no'))) { $error = 1; $msg = 'glow on your title'; }

		if (($_REQUEST['type'] == 'tshadow') && (($userbs[22] == 'off') || ($userbs[22] == 'no'))) { $error = 1; $msg = 'shadow on your title'; }

		if (($_REQUEST['type'] == 'ctitle') && (($userbs[24] == 'off') || ($userbs[24] == 'no') || ($userbs[26] == 'on'))) { $error = 1; $msg = 'custom title'; }

		if ($error) { message_die(GENERAL_MESSAGE, "You don't have a ".$msg." to remove."); }



		if ($_REQUEST['type'] == 'avatar') { $userprs = "ßoffÞ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'sig') { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ßoffÞ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'title') { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ßoffÞ".$userbs[7]; }

		if (($_REQUEST['type'] != 'title') && ($_REQUEST['type'] != 'sig') && ($_REQUEST['type'] != 'avatar')) { $userprs = "ß".$userbs[2]."Þ".$userbs[3]."ß".$userbs[4]."Þ".$userbs[5]."ß".$userbs[6]."Þ".$userbs[7]; }

		if ($_REQUEST['type'] == 'color') { $usereff = "ßoffÞ0ß".$userbs[12]."Þ".$userbs[13]."ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'shadow') { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ßoffÞ0ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'glow') { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ß".$userbs[12]."Þ".$userbs[13]."ßoffÞ0"; }

		if (($_REQUEST['type'] != 'glow') && ($_REQUEST['type'] != 'shadow') && ($_REQUEST['type'] != 'color')) { $usereff = "ß".$userbs[10]."Þ".$userbs[11]."ß".$userbs[12]."Þ".$userbs[13]."ß".$userbs[14]."Þ".$userbs[15]; }

		if ($_REQUEST['type'] == 'tcolor') { $usercustitle = "ßoffÞ0ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'tglow') { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ßoffÞ0ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'tshadow') { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ßoffÞ0ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		if ($_REQUEST['type'] == 'ctitle') { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ßoffÞ0ß".$userbs[26]."Þ".$userbs[27]; }

		if (($_REQUEST['type'] != 'tglow') && ($_REQUEST['type'] != 'tshadow') && ($_REQUEST['type'] != 'tcolor') && ($_REQUEST['type'] != 'ctitle')) { $usercustitle = "ß".$userbs[18]."Þ".$userbs[19]."ß".$userbs[20]."Þ".$userbs[21]."ß".$userbs[22]."Þ".$userbs[23]."ß".$userbs[24]."Þ".$userbs[25]."ß".$userbs[26]."Þ".$userbs[27]; }

		$ussql = "update " . USERS_TABLE . " set user_effects='$usereff', user_privs='$userprs', user_custitle='$usercustitle' where username='{$userdata['username']}'";

		if ( !($db->sql_query($ussql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Updating User Info!'); }

		$page_title = "Sell Special Ability";

		$title = $page_title;

		$shoplocation = ' -> <a href="'.append_sid("shop_effects.$phpEx?action=specialshop").'" class="nav">'.$shopstatarray[5].' Abilities</a> -> <a href="'.append_sid("shop_effects.$phpEx?action=specialshop").'" class="nav">Sell Special Ability</a>';

		$shopinforow = '<tr><td class="row2"><span class="gen">Your sale has been successful!</span></td></tr>';

	}



	// start of personal information

	$personal = '<tr><td class="row1" width="50%"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="navsmall">Your Inventory</a></span></td><td class="row1" align="right" width="50%"><span class="gensmall">'.$userdata[$cash_field].' '.$board_config['points_name'].'</span></td></tr>'; 

	if (strlen($userdata['user_specmsg']) > 2) { 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><font color="red">'.$userdata['user_specmsg'].'</font></span></td></tr>'; 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?clm=true").'" class="gen">Clear Messages</a></span></td></tr>';

	}

	//end of personal information



	$template->assign_vars(array(

		'SHOPPERSONAL' => $personal,

		'SHOPLOCATION' => $shoplocation,

		'L_SHOP_TITLE' => $title,

		'SHOPTABLEROWS' => 1,

		'SHOPLIST' => $shopinfo,

		'SHOPINFOROW' => $shopinforow,

	));

	$template->assign_block_vars('', array());

}



else 

{

	message_die(GENERAL_MESSAGE, 'This is not a valid command!');

}



//

// Start output of page

//

include_once('includes/page_header.' . $phpEx);



//

// Generate the page

//

$template->pparse('body');



include_once('includes/page_tail.' . $phpEx);



?>

