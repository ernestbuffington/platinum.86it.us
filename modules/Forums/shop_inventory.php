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



//start of shop list page

if ($_REQUEST['action'] == "shoplist")

{

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = 'shop_inventory.'.$phpEx.'?action='.$_REQUEST['action'].'&shop='.$_REQUEST['shoplist'];

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	$sql = "select * from ".$prefix."_shops where id='{$_REQUEST['shop']}'";

	if ( !($result = $db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());

	}

	$srow = $db->sql_fetchrow($result);

	if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'No Such Shop Exists!'); }

	if (strtolower($srow['shoptype']) == "special")  { header("Location: shop_effects.php"); }

	if (strtolower($srow['shoptype']) == "admin_only")  { message_die(GENERAL_MESSAGE, 'No Such Shop Exists!'); }

	$sql = "select * from `".$prefix."_shopitems` where shop='".addslashes($srow['shopname'])."' order by " . $board_config['shop_orderby'];

	if ( !($result = $db->sql_query($sql)) )

	{

		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());

	}

	for ($er = 0; $er < $db->sql_numrows($result); $er++)

	{

		$row = $db->sql_fetchrow($result);

		$shops .= '<tr><td class="row2"><span class="gensmall"><a href="'.append_sid('shop_inventory.'.$phpEx.'?action=displayitem&item='.$row['id']).'" alt="'.$row['name'].'" title="Item Information on '.$row['name'].'"><strong>'.ucwords($row['name']).'</strong></a></span></td><td class="row2"><span class="gensmall">'.ucfirst($row['sdesc']).'</span></td><td class="row2"><span class="gensmall">'.$row['sold'].'</span></td><td class="row2"><span class="gensmall">'.$row['stock'].'</span></td><td class="row2"><span class="gensmall">'.$row['cost'].'</span></td></tr>';

	}

	$shopinforow = '<tr><td class="row1"><span class="gen"><strong>Item Name</strong></span></td><td class="row2"><span class="gen"><strong>Short Description</strong></span></td><td class="row1"><span class="gen"><strong>Sold</strong></span></td><td class="row1"><span class="gen"><strong>Left</strong></span></td><td class="row1"><span class="gen"><strong>Cost</strong></span></td></tr>';

	$page_title = stripslashes(ucwords($srow['shopname'])).' Inventory';

	$shoptablerows = 5;

	$shoplocation = ' -> <a href="'.append_sid('shop.'.$phpEx).'" class="nav">Shop List</a> -> <a href="'.append_sid('shop.'.$phpEx.'?action=shoplist&shop='.$srow['id'], true).'" class="nav">'.stripslashes(ucwords($srow['shopname'])).' Inventory</a>';



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

		'L_SHOP_TITLE' => stripslashes(ucwords($srow['shopname'])).' Inventory',

		'SHOPTABLEROWS' => $shoptablerows,

		'SHOPLIST' => $shops,

		'SHOPINFOROW' => $shopinforow,));

	$template->assign_block_vars('', array());

}

//start of item info page

elseif ($_REQUEST['action'] == "displayitem") 

{

	if (!isset($_REQUEST['item'])) 

	{

		message_die(GENERAL_MESSAGE, 'No Item Selected!');

	}

	$template->set_filenames(array(

		'body' => 'shop_body.tpl')

	);

	if ( !$userdata['session_logged_in'] )

	{

		$redirect = 'shop_inventory.'.$phpEx.'&action=displayitem&item='.$_REQUEST['item'];

		header('Location: ' . append_sid("login.$phpEx?redirect=$redirect", true));

	}

	

	//make sure item exists & shop is not a special/admin shop

	$sql = "select * from ".$prefix."_shopitems where id='{$_REQUEST['item']}' order by id";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

	$row = $db->sql_fetchrow($result);

	if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'No such item exists!'); }



	$sql = "select * from ".$prefix."_shops where shopname='".addslashes($row['shop'])."' and shoptype!='special' and shoptype!='admin_only'";

	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }

	if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'Item is in a protected shop!'); }

	$sirow = $db->sql_fetchrow($result);

	//end check on item exists

	

	$shopinforow = '<tr><td width="2%" class="row2"><span class="gensmall"><strong>Icon</strong></span></td><td class="row2"><span class="gen"><strong>Item&nbsp;Name</strong></span></td><td class="row2"><span class="gen"><strong>Description</strong></span></td><td class="row2"><span class="gen"><strong>Stock</strong></span></td><td class="row2"><span class="gen"><strong>Cost</strong></span></td><td class="row2"><span class="gen"><strong>Owned</strong></span></td></tr>';





	if (strlen($userdata['user_items']) > 2)

	{

		$explodearray = explode("ß", str_replace("Þ", "", $userdata['user_items']));

		$arraycount = count($explodearray);

		for ($sef = 0; $sef < $arraycount; $sef++)

		{	

			if ($explodearray[$sef] == $row['name'])

			{

				++$useritemamount;

				$sellbuy = "sell";

			}	

		}

	}	



	if (($board_config['multibuys'] == "on") && ($useritemamount > 0)) 

	{

		if (file_exists("shop/images/".$row['name'].".jpg")) { $itemfilext = "jpg"; }

		else { $itemfilext = "gif"; }

		$shopitems = '<tr><td class="row1"><img src="shop/images/'.$row['name'].'.'.$itemfilext.'" title="'.ucfirst($row['name']).'" alt="'.$row['name'].'"></td><td class="row1"><span class="gensmall"><strong>'.ucwords($row['name']).'</a><strong></span></td><td class="row2"><span class="gensmall">'.ucfirst($row['ldesc']).'</span></td><td class="row2"><span class="gensmall">'.$row['stock'].'</span></td><td class="row2"><span class="gensmall">'.$row['cost'].'</span></td><td class="row2"><span class="gensmall">'.$useritemamount.'</span></td></tr><tr><td colspan="6" class="row2"><span class="gen"><strong><a href="'.append_sid('shop_bs.'.$phpEx.'?action=buy&item='.$row['id'], true).'" title="Buy '.ucwords($row['name']).'">Buy '.ucwords($row['name']).'</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="'.append_sid('shop_bs.'.$phpEx.'?action=sell&item='.$row['id']).'" title="Sell '.ucwords($row['name']).'">Sell '.ucwords($row['name']).'</a></strong></tr>';

	}

	elseif (($board_config['multibuys'] == "off") || ($useritemamount < 1)) 

	{

		if (!isset($useritemamount)) { $useritemamount = 0; $sellbuy = "buy"; }

		if (file_exists('shop/images/'.$row['name'].'.jpg')) { $itemfilext = 'jpg'; }

		else { $itemfilext = 'gif'; }

		$shopitems = '<tr><td class="row1"><img src="shop/images/'.$row['name'].'.'.$itemfilext.'" title="'.ucfirst($row['name']).'" alt="'.$row['name'].'"></td><td class="row1"><span class="gensmall"><strong>'.ucwords($row['name']).'</a><strong></span></td><td class="row2"><span class="gensmall">'.ucfirst($row['ldesc']).'</span></td><td class="row2"><span class="gensmall">'.$row['stock'].'</span></td><td class="row2"><span class="gensmall">'.$row['cost'].'</span></td><td class="row2"><span class="gensmall">'.$useritemamount.'</span></td></tr><tr><td colspan="6" class="row2"><span class="gen"><strong><a href="'.append_sid('shop_bs.'.$phpEx.'?action='.$sellbuy.'&item='.$row['id']).'" title="'.ucwords($sellbuy).' '.ucwords($row['name']).'">'.ucwords($sellbuy).' '.ucwords($row['name']).'</a></strong></span></td></tr>';

	}

	$title = ucwords($row['name']).' Information';

	$page_title = 'Item information';

	$shoptablerows = 6;

	$shoplocation = ' -> <a href="'.append_sid('shop.'.$phpEx, true).'" class="nav">Shop List</a> -> <a href="'.append_sid('shop_inventory.'.$phpEx.'?action=shoplist&shop='.$sirow['id'], true).'" class="nav">'.ucwords($row['shop']).' Inventory</a> -> <a href="'.append_sid('shop_inventory.'.$phpEx.'?action=displayitem&item='.$row['id'], true).'" class="nav">'.ucwords($row['name']).' Information</a>';



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

		'L_SHOP_TITLE' => "$title",

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

