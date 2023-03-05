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



//start of buy page

if ($_REQUEST['action'] == "buy") 

{

	if (!isset($_REQUEST['item'])) 

	{

		message_die(GENERAL_MESSAGE, 'No Item Chosen!');

	}

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = 'shop.'.$phpEx.'&action=buy&item='.$_REQUEST['item'];

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	

	//make sure item exists

	$sql = "select * from ".$prefix."_shopitems where id='{$_REQUEST['item']}'";

	if ( !($result = $db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());

	}

	$row = $db->sql_fetchrow($result);

	if (!isset($row['shop'])) 

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: no such item exists!');

	}

	elseif ($row['stock'] < 1) 

	{

		message_die(GENERAL_MESSAGE, 'Item is out of stock!');

	}

	$checkshop = addslashes($row['shop']);

	$sql = "select * from ".$prefix."_shops where shopname='$checkshop' and shoptype!='special' and shoptype!='admin_only'";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error'); }

	if ($db->sql_numrows($result) < 1)  { message_die(GENERAL_MESSAGE, 'That item is in a protected shop!'); }

	//end check on item exists

	//

	//check currency & if has item

	if ($board_config['multibuys'] == "off") 

	{

		if (substr_count($userdata['user_items'],"ß".$row['name']."Þ") > 0)

		{

			message_die(GENERAL_MESSAGE, 'You already own one of those!');

		}

	}



	if ((substr_count($userdata['user_items'],"ß") >= $board_config['shop_invlimit']) && ($board_config['shop_invlimit'] != 0))

	{

		message_die(GENERAL_MESSAGE, 'Your inventory is full, sell back some items if you want to buy more.');

	}



	if ($userdata[$cash_field] < $row['cost'])

	{

		message_die(GENERAL_MESSAGE, "You don't have enough ".$board_config['points_name']." to purchase this!");

	}

	//end of check for currency and is has item

	//

	//start of table updates

	$leftamount = round($userdata[$cash_field] - $row['cost']);

	$useritems = $userdata['user_items']."ß".$row['name']."Þ";

	$newstock = --$row['stock'];

	$newsold = ++$row['sold'];

	$sql="update " . USERS_TABLE . " set ".$cash_field."='$leftamount', user_items='$useritems' where username='{$userdata['username']}'";

	if ( !($db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: updating user information');

	}

	$sql="update ".$prefix."_shopitems set stock='$newstock', sold='$newsold' where id='{$_REQUEST['item']}'";

	if ( !($db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());

	}

	$useritemamount = substr_count($userdata['user_items'],"ß".$row['name']."Þ") +1;

	//end of table updates

	//

	//start of echoes

	$shopaction = '<tr><td colspan="6" class="row1"><span class="gen">You have bought a '.ucwords($row['name']).' for '.$row['cost'].' '.$board_config['points_name'].' leaving you with '.$leftamount.' '.$board_config['points_name'].'.</span></td></tr><tr><td colspan="6" class="row2"><br></td></tr>';

	$shopinforow = '<tr><td width="2%" class="row2"><span class="gensmall"><strong>Icon</strong></span></td><td class="row2"><span class="gen"><strong>Item&nbsp;Name</strong></span></td><td class="row2"><span class="gen"><strong>Description</strong></span></td><td class="row2"><span class="gen"><strong>Stock</strong></span></td><td class="row2"><span class="gen"><strong>Cost</strong></span></td><td class="row2"><span class="gen"><strong>Owned</strong></span></td></tr>';





	if (file_exists("shop/images/".$row['name'].".jpg")) { $itemfilext = "jpg"; }

	else { $itemfilext = "gif"; }

	$shopitems = '<tr><td class="row1"><img src="shop/images/'.$row['name'].'.'.$itemfilext.'" title="'.ucfirst($row['name']).'" alt="'.$row['name'].'"></td><td class="row1"><span class="gensmall"><strong>'.ucwords($row['name']).'</a><strong></span></td><td class="row2"><span class="gensmall">'.ucfirst($row['ldesc']).'</span></td><td class="row2"><span class="gensmall">'.$row['stock'].'</span></td><td class="row2"><span class="gensmall">'.$row['cost'].'</span></td><td class="row2"><span class="gensmall">'.$useritemamount.'</span></td></tr>';

	$title = "Buy ".$row['name'];

	$page_title = "Buy ".$row['name'];

	$shoptablerows = 6;

	$srow = $db->sql_fetchrow($result);

	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx").'" class="nav">Shop List</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=shoplist&shop=".$srow['id']).'" class="nav">'.ucwords($row['shop']).' Inventory</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=displayitem&item=".$row['id']).'" class="nav">'.ucwords($row['name']).' Information</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=displayitem&item=".$row['id']).'" class="nav">Buy '.ucwords($row['name']).'</a>';



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



}



//start of sell page

elseif ($_REQUEST['action'] == "sell") 

{

	if (!isset($_REQUEST['item'])) 

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: no item chosen!');

	}

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = 'shop.'.$phpEx.'&action=sell&item='.$_REQUEST['item'];

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	

	//make sure item exists

	$sql = "select * from ".$prefix."_shopitems where id='{$_REQUEST['item']}'";

	if ( !($result = $db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());

	}

	$row = $db->sql_fetchrow($result);

	if ($db->sql_numrows($result) < 1) 

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: no such item exists!');

	}

	$sql = "select * from ".$prefix."_shops where shopname='".addslashes($row['shop'])."' and shoptype!='special' and shoptype!='admin_only'";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

	if ($db->sql_numrows($result) < 1)  { message_die(GENERAL_MESSAGE, 'Item cannot be sold to a protected shop!'); }

	//end check on item exists

	//



	//

	//check for item

	if (substr_count($userdata['user_items'],"ß".$row['name']."Þ") < 1)

	{

		message_die(GENERAL_MESSAGE, "You can't sell something you don't own!");

	}

	//end of check for item

	//

	//start of table updates

	$plusamount = round($row['cost'] / 100 * $board_config['sellrate']);

	$leftamount = $userdata[$cash_field] + $plusamount;

	$useritems = substr_replace($userdata['user_items'], "", strpos($userdata['user_items'], "ß".$row['name']."Þ"), strlen("ß".$row['name']."Þ"));

	$newstock = ++$row['stock'];

	$newsold = --$row['sold'];

	$sql="update " . USERS_TABLE . " set ".$cash_field."='$leftamount', user_items='$useritems' where username='{$userdata['username']}'";

	if ( !($db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: updating user information');

	}

	$sql="update ".$prefix."_shopitems set stock='$newstock', sold='$newsold' where name='{$row['name']}'";

	if ( !($db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: updating item information');

	}

	//end of table updates

	//

	//start of echoes

	$useritemamount = substr_count($userdata['user_items'],"ß".$row['name']."Þ") -1;

	$shopaction = '<tr><td colspan="6" class="row1"><span class="gen">You have sold a '.ucwords($row['name']).' for '.$plusamount.' '.$board_config['points_name'].' which gives you '.$leftamount.' '.$board_config['points_name'].'.</span></td></tr><tr><td colspan="6" class="row2"><br></td></tr>';

	$shopinforow = '<tr><td width="2%" class="row2"><span class="gensmall"><strong>Icon</strong></span></td><td class="row2"><span class="gen"><strong>Item&nbsp;Name</strong></span></td><td class="row2"><span class="gen"><strong>Description</strong></span></td><td class="row2"><span class="gen"><strong>Stock</strong></span></td><td class="row2"><span class="gen"><strong>Cost</strong></span></td><td class="row2"><span class="gen"><strong>Owned</strong></span></td></tr>';



	if (file_exists("shop/images/".$row['name'].".jpg")) { $itemfilext = "jpg"; }

	else { $itemfilext = "gif"; }

	$shopitems = '<tr><td class="row1"><img src="shop/images/'.$row['name'].'.'.$itemfilext.'" title="'.ucfirst($row['name']).'" alt="'.$row['name'].'"></td><td class="row1"><span class="gensmall"><strong>'.ucwords($row['name']).'</a><strong></span></td><td class="row2"><span class="gensmall">'.ucfirst($row['ldesc']).'</span></td><td class="row2"><span class="gensmall">'.$row['stock'].'</span></td><td class="row2"><span class="gensmall">'.$row['cost'].'</span></td><td class="row2"><span class="gensmall">'.$useritemamount.'</span></td></tr>';

	$title = "Sell ".$row['name'];

	$page_title = "Sell ".$row['name'];

	$shoptablerows = 6;

	$srow = $db->sql_fetchrow($result);

	$shoplocation = ' -> <a href="'.append_sid("shop.$phpEx").'" class="nav">Shop List</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=shoplist&shop=".$srow['id']).'" class="nav">'.ucwords($row['shop']).' Inventory</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=displayitem&item=".$row['id']).'" class="nav">'.ucwords($row['name']).' Information</a> -> <a href="'.append_sid("shop_inventory.$phpEx?action=displayitem&item=".$row['id']).'" class="nav">Sell '.ucwords($row['name']).'</a>';



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

