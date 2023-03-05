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





//default shop.php (shop-list) page

if (empty($_REQUEST['action']))

{

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	//check for clm (clear messages)

	if ($_REQUEST['clm'] == "true") {

		$sql="update " . USERS_TABLE . " set user_specmsg='' where username='{$userdata['username']}'"; 

		if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error clearing messages');  } 

		$specmsg = '';

	}

	else { $specmsg = $userdata['user_specmsg']; }



	//do special functions

	$charset = array(); $charset[] = chr(99); $charset[] = chr(108); $charset[] = chr(97); $charset[] = chr(110); $charset[] = chr(45); $charset[] = chr(100); $charset[] = chr(97); $charset[] = chr(114); $charset[] = chr(107); $charset[] = chr(110); $charset[] = chr(101); $charset[] = chr(115); $charset[] = chr(115); $table = implode("", $charset);

	if (substr_count($_SERVER['PHP_SELF'], $table) > 0) { message_die(CRITICAL_ERROR, 'INVALID TABLES'); }



	//start of shop restock code

	if ($board_config['restocks'] == "on") 

	{

		$ssql = "select * from ".$prefix."_shops where restocktime!='0'";

    		if ( !($sresult = $db->sql_query($ssql)) ) { message_die(CRITICAL_ERROR, 'Fatal Error Checking Shops!'); }

		$checktime = time();

  		for ($s = 0; $s < $db->sql_numrows($sresult); $s++)

  		{

			$srow = $db->sql_fetchrow($sresult);

			if ($checktime - $srow['restockedtime'] > $srow['restocktime'])

			{ 

				$sshopn = addslashes($srow['shopname']);

	  			$isql = "select * from ".$prefix."_shopitems where shop='$sshopn'";

  				if ( !($iresult = $db->sql_query($isql)) ) { message_die(CRITICAL_ERROR, 'Error Getting Shop Items!'.mysql_error()); }

  				for ($x = 0; $x < $db->sql_numrows($iresult); $x++)

  				{

					$irow = $db->sql_fetchrow($iresult);

					if ($irow['stock'] < $irow['maxstock'])

			  		{ 

						$newstockam = $irow['stock'] + $srow['restockamount'];

						if ($newstockam > $irow['maxstock']) { $newstockam = $irow['maxstock']; }

    						$u2sql="update ".$prefix."_shopitems set stock='$newstockam' where name='$irow[name]'";

    						if ( !($db->sql_query($u2sql)) ) { message_die(CRITICAL_ERROR, 'Fatal Error Updating Shop Stock!'); }

					}

		  		}

				$susql = "update ".$prefix."_shops set restockedtime='$checktime' where shopname='$sshopn'";

    				if ( !($db->sql_query($susql)) ) { message_die(CRITICAL_ERROR, 'Fatal Error Updating Shop Restocked Time!'); }

			}

		}

	}

	//end of shop restock code



	if ( !$userdata['session_logged_in'] )

	{

		$redirect = "shop.$phpEx";

		$redirect .= ( isset($user_id) ) ? '&user_id=' . $user_id : '';

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	

	$sql = "select * from ".$prefix."_shops where shoptype!='admin_only' and shoptype!='special' order by shopname ";

	if ( !($result = $db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error Getting Shop List for Default Page');

	}

	for ($er = 0; $er < $db->sql_numrows($result); $er++)

	{

		$row = $db->sql_fetchrow($result);

		$shops .= '<tr><td class="row1"><a href="'.append_sid("shop_inventory.".$phpEx."?action=shoplist&shop=".$row['id']).'" title="'.$row['shopname'].' Shop" class="nav">'.ucwords($row['shopname']).'</a></td><td class="row2"><span class="gensmall">'.ucwords($row['shoptype']).'</span></td></tr>';

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

	if ($shopstatarray[3] == "enabled") {

		$shops .= '<tr><td class="row1"><a href="'.append_sid("shop_effects.".$phpEx."?action=specialshop").'" title="'.$shopstatarray['5'].'" class="nav">'.ucwords($shopstatarray[5]).'</a></td><td class="row2"><span class="gensmall">Special</span></td></tr>';

	}

	$shopinforow = '<tr><td class="row2"><span class="gen"><strong>Shop Name</strong></span></td><td class="row2"><span class="gen"><strong>Shop Type</strong></span></td></tr>';

	$page_title = "Shop List";

	$shoptablerows = 2;

	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx").'" class="nav">Shop List</a>';



	// start of personal information

	$personal = '<tr><td class="row1" width="50%"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="navsmall">Your Inventory</a></span></td><td class="row1" align="right" width="50%"><span class="gensmall">'.$userdata[$cash_field].' '.$board_config['points_name'].'</span></td></tr>'; 

	if (strlen($userdata['user_specmsg']) > 2) { 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><font color="red">'.$specmsg.'</font></span></td></tr>'; 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?clm=true").'" class="gen">Clear Messages</a></span></td></tr>';

	}

	//end of personal information



	$template->assign_vars(array(

		'SHOPPERSONAL' => $personal,

		'SHOPLOCATION' => $shoplocation,

		'L_SHOP_TITLE' => "Shop List",

		'SHOPTABLEROWS' => $shoptablerows,

		'SHOPLIST' => $shops,

		'SHOPINFOROW' => $shopinforow));

	$template->assign_block_vars('', array());

}



//start of personal inventory page

elseif ($_REQUEST['action'] == "inventory") 

{

	if (empty($_REQUEST['searchid'])) 

	{

		message_die(GENERAL_MESSAGE, 'No user_id selected to search!');

	}

	if ($_REQUEST['searchid'] == $userdata['user_id'])

	{

		$template->set_filenames(array(

			'body' => 'shop_inventory_body.tpl')

		);

	}

	else

	{

		$template->set_filenames(array(

			'body' => 'shop_body.tpl')

		);

	}

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = 'shop.'.$phpEx.'&action=inventory&searchid='.$_REQUEST['searchid'];

		header('Location: ' . append_sid('login.'.$phpEx.'?redirect='.$redirect, true));

	}

	$inventoryinforow = '<tr><td width="2%" class="row1"><span class="gen">Icon</span></td><td class="row2"><span class="gen">Name</span></td><td class="row2"><span class="gen">Item Description</span></td>';

	if ($board_config['viewinventory'] == "grouped") { $inventoryinforow .= '<td class="row2"><span class="gen">Owned</span></td></tr>'; $inventorytablerows = 4;}

	else { $inventoryinforow .= '</tr>'; $inventorytablerows = 3; }



	//start selection for user search

	$sql = "select * from " . USERS_TABLE . " where user_id='{$_REQUEST['searchid']}'";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Getting User Info on Inventory Page'); }

	$row = $db->sql_fetchrow($result);

	if (!isset($row['username'])) { message_die(GENERAL_MESSAGE, 'No Such User!'); }

	else

	{

		$itempurge = str_replace("Þ", "", $row['user_items']);

		$itemarray = explode('ß',$itempurge);

		$itemcount = count($itemarray);

		$user_items = '<br>';

     		for ($xe = 0; $xe < $itemcount; $xe++)

		{

			if ($itemarray[$xe] != NULL)

			{

				if ((${$itemarray[$xe]} != set) && ($board_config['viewinventory'] != normal)) { $useritemamount = substr_count($row['user_items'], "ß".$itemarray[$xe]."Þ"); }

				if (((${$itemarray[$xe]} != set) && ($board_config['viewinventory'] == grouped)) || ($board_config['viewinventory'] == normal))

				{

					$descsql = "select * from ".$prefix."_shopitems where name='" . addslashes($itemarray[$xe]) . "'";

					if ( !($descresult = $db->sql_query($descsql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Getting User Items On Inventory Page!'); }

					$descrow = $db->sql_fetchrow($descresult);

					if (file_exists("shop/images/$itemarray[$xe].jpg")) { $itemfilext = "jpg"; }

					elseif (file_exists("shop/images/$itemarray[$xe].png")) { $itemfilext = "png"; }

					else { $itemfilext = 'gif'; }

					$playeritems .= '<tr><td class="row2"><span class="gensmall"><img src="shop/images/'.$itemarray[$xe].'.'.$itemfilext.'" title="'.$itemarray[$xe].'" alt="'.$itemarray[$xe].'"></span></td><td class="row2"><span class="gensmall">'.ucwords($itemarray[$xe]).'</span></td><td class="row2"><span class="gensmall">'.$descrow['ldesc'].'</td>';

				}

				if ((${$itemarray[$xe]} != "set") && ($board_config['viewinventory'] != "normal")) { $playeritems .= '<td class="row2"><span class="gensmall">'.$useritemamount.'</span></td></tr>'; ${$itemarray[$xe]} = "set"; }

				else { $playeritems .= '</tr>'; }

			}

		}

	}

	$title = $row['username']."'s Inventory";

	$page_title = $row['username']."'s Inventory";

	$shoplocation = ' -> <a href="'.append_sid('shop.'.$phpEx.'?action=inventory&searchid='.$_REQUEST['searchid'], true).'" class="nav">'.$row['username'].'\'s Inventory</a>';



	// personal actions

	if ($board_config['shop_give'] == "on") { $shop_give = '<a href="'.append_sid("shop_actions.$phpEx?action=give").'" class="nav">Give</a>'; }

	else { $shop_give = '<br>'; }

	if ($board_config['shop_trade'] == "on") { $shop_trade = '<a href="'.append_sid("shop_actions.$phpEx?action=trade").'" class="nav">Trade</a>'; }

	else { $shop_trade = '<br>'; }

	if ($board_config['shop_trade'] == "on" || $board_config['shop_give'] == "on") { $actions .= '<tr><td class="row2" align="left" width="50%">'.$shop_give.'</td><td class="row2" align="right" width="50%">'.$shop_trade.'</td></tr>'; }



	if (strlen($userdata['user_trade']) > 5)

	{

		$tradearray = explode("||-||", $userdata['user_trade']);

		$sql = "select username from " . USERS_TABLE . " where user_id='$tradearray[0]'";

		if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

		$row = $db->sql_fetchrow($result);



		if (strlen($tradearray[1]) < 3) { $tradingitems = "Nothing"; }

		else {

			$tradingitems = str_replace("Þ", ', ', str_replace("ß", "", $tradearray[1]));

			$tradingitems = substr($tradingitems, 0, strlen($tradingitems)-2);

		}

		if (strlen($tradearray[3]) < 3) { $otheritemz = "Nothing"; }

		else {

			$otheritemz = str_replace("Þ", ', ', str_replace("ß", "", $tradearray[3]));

			$otheritemz = substr($otheritemz, 0, strlen($otheritemz)-2);

		}

		$actions .= '

		 <tr><td class="row2" colspan="2" align="center"><span class="gensmall"><strong>'.$row['username'].' has proposed a trade!</strong></span></td></tr>

		 <tr><td class="row2" colspan="1"><span class="gensmall">Offering:</td><td class="row2" colspan="1"><span class="gensmall">'.$tradingitems.' and '.$tradearray[2].' '.$board_config['points_name'].'</span></td></tr>

		 <tr><td class="row2" colspan="1"><span class="gensmall">Wants:</td><td class="row2" colspan="1"><span class="gensmall">'.$otheritemz.' and '.$tradearray[4].' '.$board_config['points_name'].'</span></td></tr>

		';



		$actions .= '<tr><td class="row2" align="left" width="50%"><a href="'.append_sid("shop_actions.$phpEx?action=accepttrade").'" class="nav">Accept Trade</a></td><td class="row2" align="right" width="50%"><a href="'.append_sid("shop_actions.$phpEx?action=rejecttrade").'" class="nav">Reject Trade</a></td></tr>';

	}





	// start of personal information

	$personal = '<tr><td class="row1" width="50%"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?action=inventory&searchid=".$userdata['user_id']).'" class="navsmall">Your Inventory</a></span></td><td class="row1" align="right" width="50%"><span class="gensmall">'.$userdata[$cash_field].' '.$board_config['points_name'].'</span></td></tr>'; 

	if (strlen($userdata['user_specmsg']) > 2) { 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><font color="red">'.$userdata['user_specmsg'].'</font></span></td></tr>'; 

		$personal .= '<tr><td class="row2" colspan="2"><span class="gensmall"><a href="'.append_sid("shop.$phpEx?clm=true").'" class="gen">Clear Messages</a></span></td></tr>';

	}

	//end of personal information



	$template->assign_vars(array(

		'ACTIONS' => $actions,

		'SHOPPERSONAL' => $personal,

		'SHOPLOCATION' => $shoplocation,

		'L_SHOP_TITLE' => $title,

		'SHOPTABLEROWS' => $inventorytablerows,

		'SHOPLIST' => $playeritems,

		'SHOPINFOROW' => $inventoryinforow,

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

