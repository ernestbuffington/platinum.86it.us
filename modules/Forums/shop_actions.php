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

include_once($phpbb_root_path . 'common.' . $phpEx);

include_once ('header.php');

global $prefix;

// 

// Start session management 

// 

$userdata = session_pagestart($user_ip, PAGE_PROFILE,$nukeuser);

init_userprefs($userdata); 

// 

// End session management 



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

//check logged in

//

if( !($userdata['session_logged_in']) ) 

{ 

	header('Location: ' . append_sid("login.$phpEx?redirect=shop_actions.$phpEx?action=".$_REQUEST['action'], true)); 

} 

//

//end check 

//

//start functions

//

function userhasitem($checkusername, $checkitemname)

{

	$checkinguser = get_userdata($checkusername); 

	if (substr_count($checkinguser['user_items'],"ß".$checkitemname."Þ") < 1) { return false; } 

	else { return true; }

}

function checkgold($checkusername, $checkgold)

{

	$checkinguser = get_userdata($checkusername); 

	if ($checkinguser[$cash_field] < $checkgold) { return false; } 

	else { return true; }

}

function checkitemarray($checkusername, $checkitemname)

{

	$arrayitems = str_replace("ß", "", $checkitemname);

	$arrayitems = explode("Þ", substr($arrayitems, 0, strlen($arrayitems)-1));

	$arraycount = count($arrayitems);

	$checkinguser = get_userdata($checkusername);

	for ($x = 0; $x < $arraycount; $x++)

	{

		if (substr_count($checkinguser['user_items'],"ß".$arrayitems[$x]."Þ") < 1) { return false; } 

	}

	return true;

}

function cleartrade($clearer, $messageto, $message)

{

	$sql = "update " . USERS_TABLE . " set user_trade='' where user_id='$clearer'";

	if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: ',$sql); }



	$sql = "select user_specmsg from " . USERS_TABLE . " where user_id='$messageto'";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: ',$sql); }

	$row = $db->sql_fetchrow($result);



	$newmessage = $row['user_specmsg'].'<br />'.$message;

	$sql = "update " . USERS_TABLE . " set user_specmsg='$newmessage' where user_id='{$row['user_id']}'";

	if ( !($db->sql_query($sql)) ) 

	{ 

		message_die(GENERAL_MESSAGE, 'Fatal Error: ',$sql); 

	}

}

//end functions



$template->set_filenames(array( 

	'body' => 'shop_body.tpl') 

); 



//set useritems into variable 

$itemarray = str_replace("Þ", "", $userdata['user_items']); 

$itemarray = explode('ß',$itemarray); 

$itemcount = count ($itemarray); 

for ($xe = 0; $xe < $itemcount; $xe++) 

{ 

	if ($itemarray[$xe] != NULL) { $user_items .= '<option value="'.$itemarray[$xe].'">'.$itemarray[$xe].'</option>'; } 

} 

if (strlen($user_items) < 5) { $user_items = '<option>Nothing</option>'; } 





if (empty($_REQUEST['action']))

{

	header("Location: shop.php");

}

elseif ($_REQUEST['action'] == "give")

{

	if ($board_config['shop_give'] == "off") { message_die(GENERAL_MESSAGE, "The ability to give items has been disabled!"); }

	$shopaction = '<tr><td colspan="2" class="row1" align="center"><span class="gensmall">Please select an item and the person you would like to give it to.</span></td></tr>'; 

	$shopinforow = '<form name="post" method="post" action="'.append_sid("shop_actions.$phpEx?action=confirmgive").'"><tr><td class="row2" width="50%"><span class="gensmall"><strong>Your items:</strong></span></td><td class="row1"><select name="itemname">'.$user_items.'</select></td></tr><tr><td class="row2"><span class="gensmall"><strong>Give to:</strong></span></td><td class="row1"><input type="text" class="post" name="username"> <input type="submit" name="usersubmit" value="Find Username" class="liteoption" onClick="window.open(\'./search.php?mode=searchuser\', \'_nukesearch\', \'HEIGHT=250,resizable=yes,WIDTH=400\');return false;" /></select></td></tr><tr><td class="row2" colspan="2" align="center"><input type="submit" value="Execute" class="liteoption"></td></tr></form>'; 



	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Give</a>'; 

	$title = 'Give Item'; 

	$page_title = 'Give Item'; 

	$shoptablerows = 2; 

}

elseif ($_REQUEST['action'] == "confirmgive") 

{ 

	if ($board_config['shop_give'] == "off") { message_die(GENERAL_MESSAGE, "The ability to give items has been disabled!"); }



	//check if trying to give item to self 

	if (strtolower($userdata['username']) == strtolower($username)) { message_die(GENERAL_MESSAGE, 'What is the point in giving your <strong>'.$itemname.'</strong> to yourself?'); } 



	//make sure the user exists 

	$otheruser = get_userdata($_REQUEST['username']); 

	if( !($otheruser['user_id']) ) { message_die(GENERAL_MESSAGE, 'No Such User Exists!'); } 



	//make sure user has item, prevents exploit

	if (!(userhasitem($userdata['username'], $_REQUEST['itemname']))) { message_die(GENERAL_MESSAGE, "You don't have that item!"); } 



	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Give</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Confirm Trade</a>'; 

	$shoptablerows = 1;

	$shopaction = '<tr><td class="row1" align="center"><BR><span class="gensmall">Are you sure you want to give the <strong>'.$_REQUEST['itemname'].'</strong> to <strong>'.$_REQUEST['username'].'</strong>?</span></td></tr>'; 

	$shopinforow = '<form name="post" method="post" action="'.append_sid("shop_actions.$phpEx?action=giveitem").'"><input type="hidden" name="itemname" value="'.$_REQUEST['itemname'].'"><input type="hidden" name="username" value="'.$_REQUEST['username'].'"><tr><td class="row2" align="center"><input type="submit" value="Yes" class="liteoption"> <input type="button" value="No" onclick="document.location=\'shop_actions.php\'"></td></tr></form>'; 

} 



elseif ($_REQUEST['action'] == "giveitem") 

{ 

	if ($board_config['shop_give'] == "off") { message_die(GENERAL_MESSAGE, "The ability to give items has been disabled!"); }



	//begin secondary checks

	//check if trying to give item to self 

	//make sure the user exists 

	$otheruser = get_userdata($_REQUEST['username']); 

	if( !($otheruser['user_id']) ) { message_die(GENERAL_MESSAGE, 'No Such User Exists!'); } 



	//make sure user has item, prevents exploit

	if (!(userhasitem($userdata['username'], $_REQUEST['itemname']))) { message_die(GENERAL_MESSAGE, "You don't have that item!"); } 



	if (strtolower($userdata['username']) == strtolower($_REQUEST['username'])) { message_die(GENERAL_MESSAGE, 'What is the point in giving your <strong>'.$_REQUEST['itemname'].'</strong> to yourself?'); } 

	//end secondary checks



	$title = "Item Given"; 

	$page_title = "Item Given"; 



	//take the item away from the user 



	$useritems = substr_replace($userdata['user_items'], "", strpos($userdata['user_items'], "ß".$_REQUEST['itemname']."Þ"), strlen("ß".$_REQUEST['itemname']."Þ")); 

	$sql="update " . USERS_TABLE . " set user_items='$useritems' where username='{$userdata['username']}'"; 

	if ( !($db->sql_query($sql)) ) 

	{ 

		message_die(GENERAL_MESSAGE, 'Fatal Error.'); 

	} 



	//give the item to the recipient 



	$useritems = $otheruser['user_items']."ß".$_REQUEST['itemname']."Þ"; 



	//send receiver message

	$usermessage = $otheruser['user_specmsg'];

	$usermessage .= '<br><span class="gensmall">'.$userdata['username'].' has given you a '.$_REQUEST['itemname'].'!</span>';



	//update table

	$sql="update " . USERS_TABLE . " set user_items='$useritems', user_specmsg='$usermessage' where username='{$_REQUEST['username']}'"; 

	if ( !($db->sql_query($sql)) ) 

	{ 

		message_die(GENERAL_MESSAGE, 'Fatal Error Updating User Information on Give Page'); 

	} 



	//tell the user that the item has been given

	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Give</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Confirm Trade</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Trade Completed</a>'; 

	$shoptablerows = 1;

	$shopaction = '<tr><td class="row1" align="center"><BR><span class="gensmall"><strong>'.$_REQUEST['username'].'</strong> received the <strong>'.$_REQUEST['itemname'].'</strong>.</span><P></td></tr>'; 

} 



elseif ($_REQUEST['action'] == "trade")

{

	if ($board_config['shop_trade'] == "off") { message_die(GENERAL_MESSAGE, "The ability to trade items has been disabled!"); }



	if ((!(empty($_REQUEST['username']))) && ($_REQUEST['username'] != $userdata['username']))

	{

		$otheruser = get_userdata($_REQUEST['username']);

		if (strlen($otheruser['user_trade']) > 3) { header("Location: shop_actions.php?action=trade&errormessage=User already has a trade waiting!"); exit; }

		if (empty($otheruser)) { message_die(GENERAL_MESSAGE, "No such user exists!"); }

		else

		{

			//

			// Begin checks for additions and removes of each section.

			//

			if (!(checkitemarray($userdata['username'], $_REQUEST['tradeitems'])) && strlen($_REQUEST['tradeitems']) > 2) { message_die(GENERAL_MESSAGE, "Fatal Error: Invalid Items!"); }

			if (!(checkitemarray($_REQUEST['username'], $_REQUEST['otheritems'])) && strlen($_REQUEST['otheritems']) > 2) { message_die(GENERAL_MESSAGE, "Fatal Error: Invalid Items!"); }



			if (!(empty($_REQUEST['itemname'])))

			{

				if ((!(empty($_REQUEST['additem']))) && (userhasitem($userdata['username'], $_REQUEST['itemname'])))

				{

					if (substr_count($userdata['user_items'], $_REQUEST['itemname']) < (substr_count($tradeitems, $_REQUEST['itemname']) + 1)) { $errormessage .= 'You can not add more of an item than you currently own!<br />'; }

					else { $tradeitems .= 'ß'.$_REQUEST['itemname'].'Þ'; }

				}

				elseif ((!(empty($_REQUEST['removeitem']))) && (substr_count($_REQUEST['tradeitems'],"ß".$_REQUEST['itemname']."Þ") > 0))

				{

					$tradeitems = substr_replace($_REQUEST['tradeitems'], "", strpos($_REQUEST['tradeitems'], "ß".$_REQUEST['itemname']."Þ"), strlen("ß".$_REQUEST['itemname']."Þ")); 

				}

				else { $tradeitems = $_REQUEST['tradeitems']; }

			}

			else { $tradeitems = $_REQUEST['tradeitems']; }



			if (!(empty($_REQUEST['otheritem'])))

			{

				if ((!(empty($_REQUEST['additem']))) && (userhasitem($_REQUEST['username'], $_REQUEST['otheritem'])))

				{

					if (substr_count($otheruser['user_items'], $_REQUEST['otheritem']) < (substr_count($otheritems, $_REQUEST['otheritem']) + 1)) { $errormessage .= 'You can not add more of an item than '.$username.' currently owns!<br />'; }

					else { $otheritems .= 'ß'.$_REQUEST['otheritem'].'Þ'; }

				}

				elseif ((!(empty($_REQUEST['removeitem']))) && (substr_count($_REQUEST['otheritems'],"ß".$_REQUEST['otheritem']."Þ") > 0))

				{

					$otheritems = substr_replace($_REQUEST['otheritems'], "", strpos($_REQUEST['otheritems'], "ß".$_REQUEST['otheritem']."Þ"), strlen("ß".$_REQUEST['otheritem']."Þ")); 

				}

				else { $otheritems = $_REQUEST['otheritems']; }

			}

			else { $otheritems = $_REQUEST['otheritems']; }



			if (!(empty($_REQUEST['points'])))

			{

				if (!(empty($_REQUEST['addpoints'])) && is_numeric($_REQUEST['points']) && $_REQUEST['points'] > 0)

				{

					$goldamount = $_REQUEST['tradegold'] + $_REQUEST['points'];

					if (!(checkgold($userdata['username'], $goldamount))) { $errormessage .= 'You cannot trade more gold than you currently have!<br />'; }

					else { $tradegold = round($goldamount); }

				}

				elseif (!(empty($_REQUEST['removepoints'])) && is_numeric($points) && $points > 0)

				{

					$goldamount = $_REQUEST['tradegold'] - $_REQUEST['points'];

					if (!(checkgold($userdata['username'], $goldamount))) { $errormessage .= 'You cannot trade more gold than you currently have!<br />'; }

					elseif ($goldamount < 0) { $goldamount = 0; $errormessage .= 'You cannot set your gold into negative!<br />'; }

					else { $tradegold = round($goldamount); }

				}

				else { $tradegold = $_REQUEST['tradegold']; }

			}

			else { $tradegold = $_REQUEST['tradegold']; }



			if (!(empty($_REQUEST['otherpoints'])))

			{

				if (!(empty($_REQUEST['addpoints'])) && is_numeric($_REQUEST['otherpoints']) && $_REQUEST['otherpoints'] > 0)

				{

					$goldamount = $_REQUEST['othergold'] + $_REQUEST['otherpoints'];

					if (!(checkgold($_REQUEST['username'], $goldamount))) { $errormessage .= 'You cannot ask for more gold than '.$_REQUEST['username'].' currently has!<br />'; }

					else { $othergold = round($goldamount); }

				}

				elseif (!(empty($_REQUEST['removepoints'])) && is_numeric($_REQUEST['otherpoints']) && $_REQUEST['otherpoints'] > 0)

				{

					$goldamount = $_REQUEST['othergold'] - $_REQUEST['otherpoints'];

					if (!(checkgold($userdata['username'], $goldamount))) { $errormessage .= 'You cannot ask for more gold than '.$_REQUEST['username'].' currently has!<br />'; }

					elseif ($goldamount < 0) { $goldamount = 0; $errormessage .= 'You cannot set your requested gold into negative!<br />'; }

					else { $othergold = round($goldamount); }

				}

				else { $othergold = $_REQUEST['othergold']; }

			}

			else { $othergold = $_REQUEST['othergold']; }



			if (!is_numeric($tradegold) || $tradegold < 0 || !(checkgold($userdata['username'], $tradegold))) { $tradegold = 0; }

			if (!is_numeric($othergold) || $othergold < 0 || !(checkgold($_REQUEST['username'], $othergold))) { $othergold = 0; }



			$hiddenfields = '

				<input type="hidden" name="username" value="'.$_REQUEST['username'].'">

				<input type="hidden" name="tradeitems" value="'.$tradeitems.'">

				<input type="hidden" name="tradegold" value="'.$tradegold.'">

				<input type="hidden" name="otheritems" value="'.$otheritems.'">

				<input type="hidden" name="othergold" value="'.$othergold.'">

			';



			//

			// End checks for additions and removes of each section.

			//



			//

			// Begin main output and calculations

			// Set trade items into variable 

			//

			if (strlen($tradeitems) < 3) { $tradingitems = "Nothing"; }

			else {

				$tradingitems = str_replace("Þ", ', ', str_replace("ß", "", $tradeitems));

				$tradingitems = substr($tradingitems, 0, strlen($tradingitems)-2);

			}

			if (strlen($otheritems) < 3) { $otheritemz = "Nothing"; }

			else {

				$otheritemz = str_replace("Þ", ', ', str_replace("ß", "", $otheritems));

				$otheritemz = substr($otheritemz, 0, strlen($otheritemz)-2);

			}





			$itemarray = str_replace("Þ", "", $otheruser['user_items']); 

			$itemarray = explode('ß',$itemarray); 

			$itemcount = count ($itemarray); 

			for ($xe = 0; $xe < $itemcount; $xe++)

			{ 

				if ($itemarray[$xe] != NULL) { $otheruser_items .= '<option value="'.$itemarray[$xe].'">'.$itemarray[$xe].'</option>'; } 

			} 

			if (strlen($otheruser_items) < 5) { $otheruser_items = '<option>Nothing</option>'; } 



			if (strlen($errormessage) > 3)

			{

				$shopaction .= '<tr><td class="row2" colspan="2" align="center"><span class="gensmall"><font color="red"><strong>'.str_replace("&lt;br /&gt;", "<br />", htmlspecialchars($errormessage)).'</strong></font></span></td></tr>';

			}

			$shopaction .= '<form method="post" action="'.append_sid("shop_actions.$phpEx?action=trade").'">

			'.$hiddenfields.'

			<tr><td class="row2"><select name="itemname">'.$user_items.'</select></td><td class="row2"><input name="additem" type="submit" class="liteoption" value="Add Item"> <input type="submit" name="removeitem" class="liteoption" value="Remove Item"></td></tr>

			</form>

			<form method="post" action="'.append_sid("shop_actions.$phpEx?action=trade").'">

			'.$hiddenfields.'

			<tr><td class="row2"><input type="text" class="post" size="10" maxlength="15" name="points" value="0"></td><td class="row2"><input type="submit" name="addpoints" class="liteoption" value="Add '.$board_config['points_name'].'"> <input type="submit" name="removepoints" class="liteoption" value="Remove '.$board_config['points_name'].'"></td></tr>

			</form>

			<tr><td class="row2" valign="top"><span class="gen"><strong>You\'re currently offering: </strong></td><td class="row2"><span class="gensmall">'.$tradingitems.' and '.$tradegold.' '.$board_config['points_name'].'</span></td></tr>

			<tr><td colspan="2" class="row2"><br></td></tr>

			<form method="post" action="'.append_sid("shop_actions.$phpEx?action=trade").'">

			'.$hiddenfields.'

			<tr><td class="row2"><select name="otheritem">'.$otheruser_items.'</select></td><td class="row2"><input name="additem" type="submit" class="liteoption" value="Add Item"> <input name="removeitem" type="submit" class="liteoption" value="Remove Item"></td></tr>

			</form>

			<form method="post" action="'.append_sid("shop_actions.$phpEx?action=trade").'">

			'.$hiddenfields.'

			<tr><td class="row2"><input type="text" class="post" size="10" maxlength="15" name="otherpoints" value="0"></td><td class="row2"><input type="submit" name="addpoints" class="liteoption" value="Add '.$board_config['points_name'].'"> <input type="submit" name="removepoints" class="liteoption" value="Remove '.$board_config['points_name'].'"></td></tr>

			</form>

			<tr><td class="row2" valign="top"><span class="gen"><strong>You\'re currently requesting: </strong></td><td class="row2"><span class="gensmall">'.$otheritemz.' and '.$othergold.' '.$board_config['points_name'].'</span></td></tr>

			<form method="post" action="'.append_sid("shop_actions.$phpEx?action=confirmtrade").'">

			'.$hiddenfields.'

			<tr><td class="row2" align="center"><input type="submit" class="liteoption" name="dodeal" value="Execute"></td></form><form method="submit" action="shop_actions.php"><td class="row2" align="center"><input type="hidden" name="action" value="trade"><input type="submit" class="liteoption" name="reset" value="Reset"></td></tr>

			</form>';





			//$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid='.$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade</a>'; 

			$title = 'Trade Items with '.$_REQUEST['username']; 

			$page_title = 'Trade Items with '.$_REQUEST['username']; 

			$shoptablerows = 2;

		}

	}

	else

	{

		if (strlen($errormessage) > 3)

		{

			$shopaction .= '<tr><td class="row2" colspan="2" align="center"><span class="gensmall"><font color="red"><strong>'.str_replace("&lt;br /&gt;", "<br />", htmlspecialchars($errormessage)).'</strong></font></span></td></tr>';

		}

		$shopinforow = '<form name="post" method="post" action="'.append_sid("shop_actions.$phpEx?action=trade").'"><tr><td class="row2" width="50%"><span class="gensmall">Trade With:</span></td><td class="row1"><input type="text" class="post" name="username"> <input type="submit" name="usersubmit" value="Find Username" class="liteoption" onClick="window.open(\'./search.php?mode=searchuser\', \'_nukesearch\', \'HEIGHT=250,resizable=yes,WIDTH=400\');return false;" /></select></td></tr><tr><td class="row2" colspan="2" align="center"><input type="submit" value="Execute" class="liteoption"></td></tr></form>'; 

		$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade</a>'; 

		$title = 'Trade Items'; 

		$page_title = 'Trade Items'; 

		$shoptablerows = 2; 

	}

}

elseif ($_REQUEST['action'] == "confirmtrade" || $_REQUEST['action'] == "proposetrade")

{

	if ($board_config['shop_trade'] == "off") { message_die(GENERAL_MESSAGE, "The ability to trade items has been disabled!"); }



	$otheruser = get_userdata($_REQUEST['username']); 

	if (strlen($otheruser['user_trade']) > 3) { header("Location: shop_actions.php?action=trade&errormessage=User already has a trade waiting!"); exit; }

	if ((!empty($_REQUEST['username']) && strlen($otheruser['username']) > 2 && $_REQUEST['username'] != $userdata['username']) && (!empty($_REQUEST['tradeitems']) || !empty($_REQUEST['tradegold'])) && (!empty($_REQUEST['otheritems']) || !empty($_REQUEST['othergold'])))

	{

		if (!is_numeric($_REQUEST['tradegold']) || $_REQUEST['tradegold'] < 0 || !(checkgold($userdata['username'], $_REQUEST['tradegold']))) { $tradegold = 0; }

		if (!is_numeric($_REQUEST['othergold']) || $_REQUEST['othergold'] < 0 || !(checkgold($_REQUEST['username'], $_REQUEST['othergold']))) { $othergold = 0; }

		if (!(checkitemarray($userdata['username'], $_REQUEST['tradeitems'])) && strlen($_REQUEST['tradeitems']) > 2) { message_die(GENERAL_MESSAGE, "Fatal Error: Invalid Items!"); }

		if (!(checkitemarray($_REQUEST['username'], $_REQUEST['otheritems'])) && strlen($_REQUEST['otheritems']) > 2) { message_die(GENERAL_MESSAGE, "Fatal Error: Invalid Items!"); }



		if (strlen($tradeitems) < 3) { $tradingitems = "Nothing"; }

		else {

			$tradingitems = str_replace("Þ", ', ', str_replace("ß", "", $tradeitems));

			$tradingitems = substr($tradingitems, 0, strlen($tradingitems)-2);

		}

		if (strlen($otheritems) < 3) { $otheritemz = "Nothing"; }

		else {

			$otheritemz = str_replace("Þ", ', ', str_replace("ß", "", $otheritems));

			$otheritemz = substr($otheritemz, 0, strlen($otheritemz)-2);

		}





		if ($_REQUEST['action'] == "confirmtrade")

		{

			$hiddenfields = '

				<input type="hidden" name="username" value="'.$_REQUEST['username'].'">

				<input type="hidden" name="tradeitems" value="'.$_REQUEST['tradeitems'].'">

				<input type="hidden" name="tradegold" value="'.$_REQUEST['tradegold'].'">

				<input type="hidden" name="otheritems" value="'.$_REQUEST['otheritems'].'">

				<input type="hidden" name="othergold" value="'.$_REQUEST['othergold'].'">

			';



			$shopaction .= '

			<tr><td class="row2" colspan="2" align="center"><span class="gensmall"><strong>Remember, once you propose a trade you can\'t retract it!</strong></span></td></tr>

			<tr><td class="row2" colspan="2" align="center"><span class="gensmall">'.$tradingitems.' and '.$_REQUEST['tradegold'].' '.$board_config['points_name'].'</span></td></tr>

			<tr><td class="row2" colspan="2" align="center"><span class="gensmall">for</span></td></tr>

			<tr><td class="row2" colspan="2" align="center"><span class="gensmall">'.$otheritemz.' and '.$_REQUEST['othergold'].' '.$board_config['points_name'].'</span></td></tr>

			<form method="post" action="'.append_sid("shop_actions.$phpEx?action=proposetrade").'">

			'.$hiddenfields.'

			<tr><td class="row2" align="center"><input type="submit" class="liteoption" name="dodeal" value="Execute"></td></form><form method="submit" action="shop_actions.php"><td class="row2" align="center"><input type="hidden" name="action" value="trade"><input type="submit" class="liteoption" name="cancel" value="Cancel"></td></tr>

			</form>';



			$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade</a>'; 

			$title = 'Confirm trade with '.$_REQUEST['username']; 

			$page_title = 'Confirm trade with '.$_REQUEST['username']; 

			$shoptablerows = 2;

		}

		elseif ($_REQUEST['action'] == "proposetrade")

		{

			$message = $otheruser['user_specmsg'].'<br>'.$userdata['username'].' has proposed a trade with you! Go to your inventory to view it.';

			$trade = $userdata['user_id'].'||-||'.$_REQUEST['tradeitems'].'||-||'.$_REQUEST['tradegold'].'||-||'.$_REQUEST['otheritems'].'||-||'.$_REQUEST['othergold'];



			$sql = "update " . USERS_TABLE . " set user_trade='$trade', user_specmsg='$message' where username='{$otheruser['username']}'";

			if ( !($db->sql_query($sql)) ) 

			{ 

				message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); 

			} 

			message_die(GENERAL_MESSAGE, 'Trade has been sent to '.$_REQUEST['username'].'!');



		}

	}

	else { header('Location: shop_actions.php?action=trade');  }

}

elseif (($_REQUEST['action'] == "accepttrade") || ($_REQUEST['action'] == "rejecttrade"))

{

	if ($board_config['shop_trade'] == "off") { message_die(GENERAL_MESSAGE, "The ability to trade items has been disabled!"); }



	if (strlen($userdata['user_trade']) < 4) { message_die(GENERAL_MESSAGE, "You don't have any trades waiting!"); }

	else 

	{

		$tradearray = explode("||-||", $userdata['user_trade']);

		$sql = "select * from " . USERS_TABLE . " where user_id='$tradearray[0]'"; 

		if ( !($result = $db->sql_query($sql)) ) 

		{ 

			message_die(GENERAL_MESSAGE, 'Fatal Error.'); 

		}

		$row = $db->sql_fetchrow($result);



		if (!(checkgold($userdata['username'], $tradearray[4])) && ($tradearray[4] != 0) && (strlen($tradearray[4]) > 0)) { cleartrade($userdata['user_id'], $row['user_id'], 'This trade has been automatically refused because '.$userdata['username'].' does not enough have gold to complete it.'); message_die(GENERAL_MESSAGE, "You do not have enough gold to accept this trade, so it has been automatically declined!"); }

		if (!(checkgold($row['username'], $tradearray[2])) && ($tradearray[2] != 0) && (strlen($tradearray[2]) > 0)) { cleartrade($userdata['user_id'], $row['user_id'], 'This trade has been automatically refused because you do not have enough gold to complete it.'); message_die(GENERAL_MESSAGE, $row['username']." does not have enough gold to complete this trade, so it has been automatically declined!"); }

		if (!(checkitemarray($userdata['username'], $tradearray[3])) && strlen($tradearray[3]) > 2) { cleartrade($userdata['user_id'], $row['user_id'], 'This trade has been automatically refused because '.$userdata['username'].' does not have the items to complete it.'); message_die(GENERAL_MESSAGE, "You do not have the items to accept this trade, so it has been automatically declined!"); }

		if (!(checkitemarray($row['username'], $tradearray[1])) && strlen($tradearray[1]) > 2) { cleartrade($userdata['user_id'], $row['user_id'], 'This trade has been automatically refused because you not have the items to complete it.'); message_die(GENERAL_MESSAGE, $row['username'].' does not have the items to complete this trade, so it has been automatically declined!'); }





		if ($_REQUEST['action'] == "accepttrade")

		{

			//take trader's points & add them to tradee

			$sql = "update " . USERS_TABLE . " set ".$cash_field." = ".$cash_field." - $tradearray[2] where user_id='{$tradearray[0]}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

			$sql = "update " . USERS_TABLE . " set ".$cash_field." = ".$cash_field." + $tradearray[2] where user_id='{$userdata['user_id']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }





			//take tradee's points & add them to trader

			$sql = "update " . USERS_TABLE . " set ".$cash_field." = ".$cash_field." - $tradearray[4] where user_id='{$userdata['user_id']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

			$sql = "update " . USERS_TABLE . " set ".$cash_field." = ".$cash_field." + $tradearray[4] where user_id='{$tradearray[0]}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }



			//take trader's items & add them to tradee

			$newitems = $userdata['user_items'];

			$olditems = $row['user_items'];



			$itemarray = str_replace("Þ", "", $tradearray[1]); 

			$itemarray = explode('ß',$itemarray); 

			$itemcount = count ($itemarray); 

			for ($xe = 0; $xe < $itemcount; $xe++)

			{

				if (strlen($itemarray[$xe]) > 2)

				{

					$olditems = substr_replace($olditems, "", strpos($olditems, "ß".$itemarray[$xe]."Þ"), strlen("ß".$itemarray[$xe]."Þ")); 

					$newitems .= "ß".$itemarray[$xe]."Þ";

				}

			}



			$sql = "update " . USERS_TABLE . " set user_items = '$newitems' where user_id='{$userdata['user_id']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

			$sql = "update " . USERS_TABLE . " set user_items = '$olditems' where user_id='{$tradearray[0]}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }



			//take tradee's items & add them to trader

			$sql = "select username, user_items, user_specmsg from " . USERS_TABLE . " where user_id='{$row['user_id']}'";

			if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

			$row = $db->sql_fetchrow($result);

			$newitems = $row['user_items'];



			$usql = "select user_items, user_specmsg from " . USERS_TABLE . " where user_id='{$userdata['user_id']}'";

			if ( !($result = $db->sql_query($usql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

			$urow = $db->sql_fetchrow($result);

			$olditems = $urow['user_items'];



			$itemarray = str_replace("Þ", "", $tradearray[3]); 

			$itemarray = explode('ß',$itemarray); 

			$itemcount = count ($itemarray); 

			for ($xe = 0; $xe < $itemcount; $xe++)

			{

				if (strlen($itemarray[$xe]) > 2)

				{

					$olditems = substr_replace($olditems, "", strpos($olditems, "ß".$itemarray[$xe]."Þ"), strlen("ß".$itemarray[$xe]."Þ")); 

					$newitems .= "ß".$itemarray[$xe]."Þ";

				}

			}



			$newmsg = $row['user_specmsg'].'<br />'.$userdata['username'].' has accepted your trade!'; 



			$sql = "update " . USERS_TABLE . " set user_items = '$newitems', user_specmsg='$newmsg' where user_id='{$tradearray[0]}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }



			$sql = "update " . USERS_TABLE . " set user_items = '$olditems', user_trade='' where user_id='{$userdata['user_id']}'";

			if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }





			$shopaction .= '<tr><td class="row2" colspan="2" align="center"><span class="gensmall"><strong>You have accepted the proposed trade by '.$row['username'].'.</strong></span></td></tr>';

			$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade Accepted</a>'; 

			$title = 'Trade Accepted'; 

			$page_title = 'Trade Accepted'; 

			$shoptablerows = 1; 

		}

		elseif ($_REQUEST['action'] == "rejecttrade")

		{

			cleartrade($userdata['user_id'], $tradearray[0], $userdata['username'].' has declined your proposed trade.');

			$shopaction .= '<tr><td class="row2" colspan="2" align="center"><span class="gensmall"><strong>You have rejected the proposed trade by '.$row['username'].'.</strong></span></td></tr>';

			$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="nav">Inventory</a> -> <a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade Declined</a>'; 

			$title = 'Trade Declined'; 

			$page_title = 'Trade Declined'; 

			$shoptablerows = 1; 

		}

	}

}

else { message_die(GENERAL_MESSAGE, "Invalid Action!"); }



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

	'SHOPACTION' => $shopaction, 

	'L_SHOP_TITLE' => $title, 

	'SHOPTABLEROWS' => $shoptablerows, 

	'SHOPLIST' => $shopitems, 

	'SHOPINFOROW' => $shopinforow, 

)); 

$template->assign_block_vars('', array()); 



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

