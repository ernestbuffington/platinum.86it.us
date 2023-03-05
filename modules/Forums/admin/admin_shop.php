<?php
/***************************************************************************
 *                             admin_shop.php
 *                            -------------------
 *   Version              : 2.6.0
 *   released             : Sunday, December 15th, 2002
 *   email                : zarath@knightsofchaos.com
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   copyright (C) 2002/2003  Zarath
 *
 *   This program is free software; you can redistribute it and/or
 *   modify it under the terms of the GNU General Public License
 *   as published by the Free Software Foundation; either version 2
 *   of the License, or (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   http://www.gnu.org/copyleft/gpl.html
 *
 ***************************************************************************/

define('IN_PHPBB', 1);
if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Cash/Shop Mod']['Shop Settings'] = append_sid($filename);
	return;
}

//
// Load default header
//
$phpbb_root_path = "../";
require_once($phpbb_root_path . 'extension.inc');
require_once('./pagestart.' . $phpEx);



//shop pages
//main page
if (empty($_REQUEST['action']))
{
	$template->set_filenames(array(
		'body' => 'admin/shop_config_body.tpl')
	);
	$sql = "select * from nuke_shops order by id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
	}
	$shops = '<span class="genmed"><select name="shopid">';
	for ($x = 0; $x < $db->sql_numrows($result); $x++)
	{
		$row = $db->sql_fetchrow($result);
		$shops .= '<option value="'.$row['id'].'">'.$row['shopname'].'</option>';
	}
	$shops .= '</select>';

	if ($board_config['multibuys'] == "on") { $multibuys1 = "on"; $multibuys2 = "off"; }
	else { $multibuys1 = "off"; $multibuys2 = "on"; }
	if ($board_config['restocks'] == "on") { $restocking1 = "on"; $restocking2 = "off"; }
	else { $restocking1 = "off"; $restocking2 = "on"; }
	if ($board_config['viewtopic'] == "images") { $viewtopic1 = "images"; $viewtopic2 = "link"; }
	else { $viewtopic1 = "link"; $viewtopic2 = "images"; }
	if ($board_config['viewprofile'] == "images") { $viewprofile1 = "images"; $viewprofile2 = "link"; }
	else { $viewprofile1 = "link"; $viewprofile2 = "images"; }
	if ($board_config['viewinventory'] == "grouped") { $viewinventory1 = "grouped"; $viewinventory2 = "normal"; }
	else { $viewinventory1 = "normal"; $viewinventory2 = "grouped"; }
	if ($board_config['shop_give'] == "on") { $shopgive1 = "on"; $shopgive2 = "off"; }
	else { $shopgive1 = "off"; $shopgive2 = "on"; }
	if ($board_config['shop_trade'] == "on") { $shoptrade1 = "on"; $shoptrade2 = "off"; }
	else { $shoptrade1 = "off"; $shoptrade2 = "on"; }
	if ($board_config['shop_orderby'] == "name") { $orderby1 = "name"; $orderby2 = "cost"; $orderby3 = "id"; }
	elseif ($board_config['shop_orderby'] == "cost") { $orderby1 = "cost"; $orderby2 = "id"; $orderby3 = "name"; }
	else { $orderby1 = "id"; $orderby2 = "name"; $orderby3 = "cost"; }


	$shopinfo = '
<tr>
<td colspan="2" align="center" class="row2"><span class="gen"><strong>Global Shop Settings</strong></span></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Multiple Item Buying</span></td><td class="row2"><select name="multiitems"><option selected value="'.$multibuys1.'">'.$multibuys1.'</option><option value="'.$multibuys2.'">'.$multibuys2.'</option></select></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Shop Item Order</span></td><td class="row2"><select name="orderby"><option selected value="'.$orderby1.'">'.$orderby1.'</option><option value="'.$orderby2.'">'.$orderby2.'</option><option value="'.$orderby3.'">'.$orderby3.'</option></select></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Shop Restocking</span></td><td class="row2"><select name="shoprestock"><option selected value="'.$restocking1.'">'.$restocking1.'</option><option value="'.$restocking2.'">'.$restocking2.'</option></select></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Selling Rate (in %)</span></td><td class="row2"><input name="sellrate" type="text" class="post" size="4" maxlength="3" value="'.$board_config['sellrate'].'"></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Inventory Item Limit (0 for no limit)</span></td><td class="row2"><input name="invlimit" type="text" class="post" size="4" maxlength="3" value="'.$board_config['shop_invlimit'].'"></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Viewtopic Display Limit</span></td><td class="row2"><input name="topicdisplaynum" class="post" type="text" size="4" maxlength="3" value="'.$board_config['viewtopiclimit'].'"></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Viewtopic Type</span></td><td class="row2"><select name="viewtopic"><option selected value="'.$viewtopic1.'">'.$viewtopic1.'</option><option value="'.$viewtopic2.'">'.$viewtopic2.'</option></select></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Profile Display</span></td><td class="row2"><select name="profiledisplay"><option selected value="'.$viewprofile1.'">'.$viewprofile1.'</option><option value="'.$viewprofile2.'">'.$viewprofile2.'</option></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Inventory Type</span></td><td class="row2"><select name="inventorytype"><option selected value="'.$viewinventory1.'">'.$viewinventory1.'</option><option value="'.$viewinventory2.'">'.$viewinventory2.'</option></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Give Ability</span></td><td class="row2"><select name="shopgive"><option selected value="'.$shopgive1.'">'.$shopgive1.'</option><option value="'.$shopgive2.'">'.$shopgive2.'</option></select></td>
</tr>
<tr>
<td class="row2"><span class="gensmall">Trade Ability</span></td><td class="row2"><select name="shoptrade"><option selected value="'.$shoptrade1.'">'.$shoptrade1.'</option><option value="'.$shoptrade2.'">'.$shoptrade2.'</option></select></td>
</tr>
<tr>
<td class="row2" colspan="2" align="center"><input type="hidden" name="action" value="updateglobals"><input type="submit" class="liteoption" value="Update"></td>
</tr>
</form>
<tr>
<td class="row2" colspan="2"><br></td>
</tr>
<tr>
<td colspan="2" align="center" class="row2"><span class="gen"><strong>Edit Player Inventories</strong></span></td>
</tr>
<form method="post" action="'.append_sid("admin_shop.$phpEx").'" name="post"><input type="hidden" name="action" value="editinventory">
<tr>
<td class="row2"><input type="text" class="post" name="username" maxlength="25" size="25"> <input type="hidden" name="action" value="editinventory"><input type="submit" class="liteoption" value="Edit Inventory"></td><td class="row2"><input type="submit" name="usersubmit" value="Find Username" class="liteoption" onClick="window.open(\'../../../modules.php?name=Forums&file=search&mode=searchuser&popup=1&menu=1\', \'_phpbbsearch\', \'HEIGHT=250,resizable=yes,WIDTH=400\');return false;" /></td>
</tr>
</form>
<tr>
<td colspan="2" class="row2"><br></td>
</tr>
</form>
<tr>
<td colspan="2" align="center" class="row2"><span class="gen"><strong>Shop Modifications</strong></span></td>
</tr>
<tr>
<td class="row2"><form method="post" action="'.append_sid("admin_shop.$phpEx").'"><span class="gensmall">'.$shops.'</span></td><td class="row2"><input type="hidden" name="action" value="editshop"><input type="submit" class="liteoption" value="Edit"></td>
</tr>
</form>
<tr>
<td class="row2"><form method="post" action="'.append_sid("admin_shop.$phpEx").'"><span class="gensmall"><strong>Special Shop</strong></span></td><td class="row2"><input type="hidden" name="action" value="editspecialshop"><input type="submit" class="liteoption" value="Edit"></td></form>
</tr>';

	$shopinfo .= '<tr><td colspan="2" class="row2"><br></td></tr><form method="post" action="'.append_sid("admin_shop.$phpEx").'"><tr><td class="row2"><span class="gensmall">Name</span></td><td class="row2"><input type="text" class="post" name="shopname" size="32" maxlength="32"></td></tr><tr><td class="row2"><span class="gensmall">Shop Type</span></td><td class="row2"><input type="text" class="post" name="shoptype" size="32"  maxlength="32"></td></tr><tr><td class="row2"><span class="gensmall">Restock Time (0 for none/in seconds)</span></td><td class="row2"><input type="text" class="post" name="restocktime" size="32" maxlength="5"></td></tr><tr><td class="row2"><span class="gensmall">Restock Amount</span></td><td class="row2"><input type="text" class="post" name="restockamount" size="32"  maxlength="5"></td></tr>
		<tr><td class="row2" colspan="2" align="center"><input type="hidden" name="action" value="createshop"><input type="submit" class="liteoption" value="Create Shop"></td></tr></form>';
	$template->assign_vars(array(
		'SHOPCONFIGINFO' => "$shopinfo",
		'SHOPTABLETITLE' => "Create or Modify Shops",
		'S_CONFIG_ACTION' => append_sid('admin_shop.' . $phpEx),
		'SHOPTITLE' => "Shop Editor",
		'SHOPEXPLAIN' => "This section allows you to select a shop to edit, or create an entirely new shop.")
	);
}

elseif ($_REQUEST['action'] == "createshop")
{
	if ((strlen($_REQUEST['shopname']) < 4) || (strlen($_REQUEST['shoptype']) < 4) || (strlen($_REQUEST['shopname']) > 32) || (strlen($_REQUEST['shoptype']) > 32)) 
	{
		message_die(GENERAL_MESSAGE, "Error, Shop Name or Shop Type not filled in correctly!");
	}
	else
	{
		if ($shoptype == Special) { message_die(GENERAL_MESSAGE, 'Special is not a valid shop type!'); }
		$sql = "select * from nuke_shops where shopname='{$_REQUEST['shopname']}'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error Checking Shop Name');
		}
		$row = $db->sql_fetchrow($result);
		if (!is_null($row['shopname']))
		{
			message_die(GENERAL_MESSAGE, 'Shop Already Exists!');
		}
		if ((!is_numeric($_REQUEST['restocktime'])) || (strlen($_REQUEST['restocktime']) > 20))
		{
			$restocktime = 86400;
		}
		else { $restocktime = $_REQUEST['restocktime']; }
		if ((!is_numeric($_REQUEST['restockamount'])) || (strlen($_REQUEST['restockamount']) > 4))
		{
			$restockamount = 5;
		}
		else { $restockamount = $_REQUEST['restockamount']; }
		$sql = "insert into nuke_shops (shopname, shoptype, restocktime, restockamount) values('{$_REQUEST['shopname']}', '{$_REQUEST['shoptype']}', '$restocktime', '$restockamount')";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error Adding Shop');
		}
		$message = 'Shop added successfully!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}
}
elseif ($_REQUEST['action'] == "updateshop")
{
	if ((strlen($_REQUEST['name']) < 4) || (strlen($_REQUEST['shoptype']) < 4) || (strlen($_REQUEST['name']) > 32) || (strlen($_REQUEST['shoptype']) > 32) || (!is_numeric($_REQUEST['shopid']))) 
	{
		message_die(GENERAL_MESSAGE, "Error, shop name or shop type not filled in correctly!");
	}
	else
	{
		$sql = "select * from nuke_shops where id='{$_REQUEST['shopid']}'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
		}
		$row = $db->sql_fetchrow($result);

		if (is_null($row['shopname']))
		{
			message_die(GENERAL_MESSAGE, 'No such shop exists!');
		}
		if ((!is_numeric($_REQUEST['restocktime'])) || (strlen($_REQUEST['restocktime']) > 20)) { $error = 1; $msg .= 'Invalid restock time!<br /><br />'; }
		if ((!is_numeric($_REQUEST['restockamount'])) || (strlen($_REQUEST['restockamount']) > 4)) { $error = 1; $msg .= 'Invalid restock amount!'; }
		if ($error) { message_die(GENERAL_MESSAGE, $msg); }

		$sql = "update nuke_shops set shopname='{$_REQUEST['name']}', shoptype='{$_REQUEST['shoptype']}', restocktime='{$_REQUEST['restocktime']}', restockamount='{$_REQUEST['restockamount']}' where id='{$_REQUEST['shopid']}'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error Updating Shop');
		}
		$sql = "update nuke_shopitems set shop='{$_REQUEST['name']}' where shop='" . addslashes($row['shopname']) . "'";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error Updating Items');
		}
		$message = $row['shopname'].' successfully updated!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?action=editshop&shopid=".$row['id']).'">Here</a> to return to '.$row['shopname'].' Configuration<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}
}

//item pages
elseif ($_REQUEST['action'] == "additem")
{
	if ((strlen($_REQUEST['item']) > 32) || (strlen($_REQUEST['item']) < 2) || (strlen($_REQUEST['shortdesc']) < 3) || (strlen($_REQUEST['shortdesc']) > 80) || (strlen($_REQUEST['longdesc']) < 3) || (!is_numeric($_REQUEST['price']))  || (strlen($_REQUEST['price']) > 20) || (strlen($_REQUEST['stock']) > 6) || (!is_numeric($_REQUEST['stock'])) || (strlen($_REQUEST['maxstock']) > 6) || (!is_numeric($_REQUEST['maxstock'])) || (!is_numeric($_REQUEST['shopid']))) 
	{
		message_die(GENERAL_MESSAGE, 'Error, Item Fields not filled in correctly!');
	}
	if ((strlen($_REQUEST['accessforum']) > 4) || (!is_numeric($_REQUEST['accessforum']) && !empty($_REQUEST['accessforum'])))
	{
		message_die(GENERAL_MESSAGE, 'Access forum must be a number and less than 5 numerals!');
	}
	else
	{
		$sql = "select shopname from nuke_shops where id='{$_REQUEST['shopid']}'";
		if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, "Fatal Error: ".mysql_error()); }
		$row = $db->sql_fetchrow($result);

		$sql = "select * from nuke_shopitems where name='{$_REQUEST['item']}'";
		if ( !($result = $db->sql_query($sql)) )
		if ($db->sql_numrows($result) > 0)
		{
			message_die(GENERAL_MESSAGE, 'This item already exists!');
		}
		$sql = "insert into nuke_shopitems (name, shop, sdesc, ldesc, cost, stock, maxstock, sold, accessforum ) values('{$_REQUEST['item']}', '" . addslashes($row['shopname']). "', '{$_REQUEST['shortdesc']}', '{$_REQUEST['longdesc']}', '{$_REQUEST['price']}', '{$_REQUEST['stock']}', '{$_REQUEST['maxstock']}', '0', '{$_REQUEST['accessforum']}')";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
		}
		$message = stripslashes($_REQUEST['item']).' successfully added!<br /><br /> Click <a href="'.append_sid('admin_shop.'.$phpEx.'?action=editshop&shopid='.$_REQUEST['shopid'], true).'">Here</a> to return to '.$row['shopname'].' Configuration<br /><br /> Click <a href="'.append_sid('admin_shop.'.$phpEx, true).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid('index.'.$phpEx.'?pane=right', true).'">Here</a> to return to Admin Index.';
		message_die(GENERAL_MESSAGE, $message);
	}
}
elseif ($_REQUEST['action'] == "updateitem")
{
	$sql = "select * from nuke_shopitems where id='{$_REQUEST['itemid']}'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error');
	}
	$row = $db->sql_fetchrow($result);
	if (is_null($row['shop']))
	{
		message_die(GENERAL_MESSAGE, 'No Such Item Exists!');
	}
	if ((!is_numeric($_REQUEST['price'])) || (strlen($_REQUEST['price']) > 20)) { $error = 1; $msg .= 'Invalid price settings!<br /><br />'; }
	if ((!is_numeric($_REQUEST['stock'])) || (strlen($_REQUEST['stock']) > 4)) { $error = 1; $msg .= 'Invalid stock settings!<br /><br />'; }
	if ((!is_numeric($_REQUEST['maxstock'])) || (strlen($_REQUEST['maxstock']) > 4)) { $error = 1; $msg .= 'Invalid max stock settings!<br /><br />'; }
	if ((!is_numeric($_REQUEST['sold'])) || (strlen($_REQUEST['sold']) > 5)) { $error = 1; $msg .= 'Invalid sold settings!<br /><br />'; }
	if ((!is_numeric($_REQUEST['accessforum'])) || (strlen($_REQUEST['accessforum']) > 4)) { $error = 1; $msg .= 'Invalid access forum ID settings!<br /><br />'; }

	//
	if ((!is_null($_REQUEST['shop'])) && (strlen($_REQUEST['shop']) > 2) && ($_REQUEST['shop'] != $row['shop'])) { 
		$sql = "select * from nuke_shops where shopname='{$_REQUEST['shop']}'";
		if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
		$trow = $db->sql_fetchrow($result);
		if (is_null($trow['shopname'])) { $error = 1; $msg .= 'No such shop exists!<br /><br />'; }
	}
	elseif ((is_null($_REQUEST['shop'])) || (strlen($_REQUEST['shop']) < 2)) { $error = 1; $msg .= 'Invalid shop name!<br /><br />'; }
	
	if ((is_null($_REQUEST['shortdesc'])) || (strlen($_REQUEST['shortdesc']) < 2) || (strlen($_REQUEST['shortdesc']) > 80)) { $error = 1; $msg .= 'Short description is set incorrectly!<br /><br />'; }
	if ((is_null($_REQUEST['longdesc'])) || (strlen($_REQUEST['longdesc']) < 2)) { $error = 1; $msg .= 'Description is too short!<br /><br />'; }
	if ((is_null($_REQUEST['name'])) || (strlen($_REQUEST['name']) < 3)) { $error = 1; $msg .= 'Invalid shop name!'; }
	if ($error) { message_die(GENERAL_MESSAGE, $msg); }

	if ((!is_null($_REQUEST['name'])) && (strlen($_REQUEST['name']) > 2) && ($_REQUEST['name'] != $row['name']))
	{
 		$useritem = addslashes('ß'.$row['name'].'Þ');
  		$usql="select user_id, user_items from " . USERS_TABLE . " where user_items like '%$useritem%'";
  		if ( !($result = $db->sql_query($usql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Retrieving Users'); }
		$sql_count = $db->sql_numrows($result);
  		for ($x = 0; $x < $sql_count; $x++)
  		{
  			$urow = $db->sql_fetchrow($result);
  			$useritems = addslashes(str_replace($useritem, 'ß'.$_REQUEST['name'].'Þ', $urow['user_items']));
  			$u2sql = "update " . USERS_TABLE . " set user_items='$useritems' where user_id='{$urow['user_id']}'";
  			if ( !($u2result = $db->sql_query($u2sql)) )
  			{
  				message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
  			}
		}
	}


	$sql = "update `nuke_shopitems` set name='{$_REQUEST['name']}', shop='{$_REQUEST['shop']}', sdesc='{$_REQUEST['shortdesc']}', ldesc='{$_REQUEST['longdesc']}', cost='{$_REQUEST['price']}', stock='{$_REQUEST['stock']}', maxstock='{$_REQUEST['maxstock']}', sold='{$_REQUEST['sold']}', accessforum='{$_REQUEST['accessforum']}' where id='{$_REQUEST['itemid']}'";
	if ( !$db->sql_query($sql) )
  	{
  		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
  	}
	$sql = "select id from nuke_shops where shopname='{$_REQUEST['shop']}'";
	if ( !$result = $db->sql_query($sql) )
  	{
  		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
  	}
	$srow = $db->sql_fetchrow($result);
	$message = $row['name'].' successfully updated!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?action=editshop&shopid=".$srow['id']).'">Here</a> to return to '.stripslashes($_REQUEST['shop']).' Configuration<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
	message_die(GENERAL_MESSAGE, $message);
}

//delete pages
elseif ($_REQUEST['action'] == "deleteshop")
{
	$sql = "select * from nuke_shops where id='{$_REQUEST['shopid']}'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error');
	}
	$row = $db->sql_fetchrow($result);
	if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'No such shop exists!'); }

	$sql = "select * from nuke_shopitems where shop='" . addslashes($row['shopname']) . "'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error Retrieving Items');
	}
	for ($xe = 0; $xe < $db->sql_numrows($result); $xe++)
	{
	 	$irow = $db->sql_fetchrow($result);
	 	$useritem = "ß".addslashes($irow['name'])."Þ";
		$usql = "select * from " . USERS_TABLE . " where user_items like '%$useritem%'";
		if ( !($uresult = $db->sql_query($usql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Retrieving Users'); }
		for ($x = 0; $x < $db->sql_numrows($uresult); $x++)
		{
			$urow = $db->sql_fetchrow($uresult);
			$useritems = addslashes(str_replace(stripslashes($useritem), "", $urow['user_items']));
			$u2sql = "update " . USERS_TABLE . " set user_items='$useritems' where user_id='{$urow['user_id']}'";
			if ( !($db->sql_query($u2sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Updating Users'); }
	  	}
		$sql = "delete from nuke_shopitems where id='{$irow['id']}'";
		if ( !($db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error Deleting Item Entry!');
		}
	}
	$sql = "delete from nuke_shops where shopname='" . addslashes($row['shopname']) . "'";
	if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Deleting Shop Entry!'); }
	$message = $row['shopname'].' successfully Deleted!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
	message_die(GENERAL_MESSAGE, $message);
}
elseif ($_REQUEST['action'] == "deleteitem")
{
	$sql = "select * from nuke_shopitems where id='{$_REQUEST['itemid']}'";
  	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
	if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'No such item exists!'); }
	$row = $db->sql_fetchrow($result);

	$sql = "select id from nuke_shops where shopname='{$row['shop']}'";
  	if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
	$srow = $db->sql_fetchrow($result);	

	$useritem = "ß".addslashes($row['name'])."Þ";
  	$usql = "select * from " . USERS_TABLE . " where user_items like '%$useritem%'";
  	if ( !($uresult = $db->sql_query($usql)) )
  	{
  		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
  	}
  	for ($x = 0; $x < $db->sql_numrows($uresult); $x++)
  	{
  		$urow = $db->sql_fetchrow($uresult);
  		$useritems = addslashes(str_replace(stripslashes($useritem), "", $urow['user_items']));
  		$u2sql = "update " . USERS_TABLE . " set user_items='$useritems' where user_id='{$urow['user_id']}'";
  		if ( !($u2result = $db->sql_query($u2sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
	  }
	$sql = "delete from nuke_shopitems where id='{$_REQUEST['itemid']}'";
  	if ( !($result = $db->sql_query($sql)) )
  	{
  		message_die(GENERAL_MESSAGE, 'Fatal Error Deleteing Item from Shop!');
  	}

	$message = $row['name'].' successfully Deleted!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?action=editshop&shopid=".$srow['id']).'">Here</a> to return to '.$row['shop'].' Configuration<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
	message_die(GENERAL_MESSAGE, $message);
}


//change global settings
elseif ($_REQUEST['action'] == "updateglobals")
{
	if (($_REQUEST['multiitems'] != "on") && ($_REQUEST['multiitems'] != "off")) { $error = 1; }
	if (($_REQUEST['shoprestock'] != "on") && ($_REQUEST['shoprestock'] != "off")) { $error = 1; }
	if (($_REQUEST['shoptrade'] != "on") && ($_REQUEST['shoptrade'] != "off")) { $error = 1; }
	if (($_REQUEST['shopgive'] != "on") && ($_REQUEST['shopgive'] != "off")) { $error = 1; }
	if (($_REQUEST['orderby'] != "name") && ($_REQUEST['orderby'] != "cost") && ($_REQUEST['orderby'] != "id")) { $error = 1; }
	if (($_REQUEST['viewtopic'] != "images") && ($_REQUEST['viewtopic'] != "link")) { $error = 1; }
	if (($_REQUEST['profiledisplay'] != "images") && ($_REQUEST['profiledisplay'] != "link") && ($_REQUEST['profiledisplay'] != "none")) { $error = 1; }
	if (($_REQUEST['inventorytype'] != "grouped") && ($_REQUEST['inventorytype'] != "normal")) { $error = 1; }
	if (($_REQUEST['topicdisplaynum'] < 0) || (empty($_REQUEST['topicdisplaynum'])) || (!is_numeric($_REQUEST['topicdisplaynum']))) { $error = 1; }
	if ((($_REQUEST['invlimit'] < 0) || (empty($_REQUEST['invlimit'])) || (!is_numeric($_REQUEST['invlimit']))) && ($_REQUEST['invlimit'] != "0")) { $error = 1; }
	if ((empty($_REQUEST['sellrate'])) || (!is_numeric($_REQUEST['sellrate'])) || ($_REQUEST['sellrate'] < 0) || ($_REQUEST['sellrate'] > 100)) { $error = 1; }

	if ($error) { message_die(GENERAL_MESSAGE, "Invalid global settings!"); }

	if ($_REQUEST['shoprestock'] == "on") 
	{
		$settime = time();
		$sql = "update nuke_shops set restockedtime='$settime'";
		if ( !($db->sql_query($sql)) ) { message_die(CRITICAL_ERROR, 'Critical Error: '.mysql_error()); }
	}
	if ($_REQUEST['shoprestock'] == "off") 
	{
		$sql = "update nuke_shops set restockedtime='0'";
		if ( !($db->sql_query($sql)) ) { message_die(CRITICAL_ERROR, 'Critical Error: '.mysql_error()); }
	}
 
	$getarray = array();
	$getarray[] = "multibuys";
	$getarray[] = "restocks";
	$getarray[] = "sellrate";
	$getarray[] = "viewtopic";
	$getarray[] = "viewprofile";
	$getarray[] = "viewinventory";
	$getarray[] = "viewtopiclimit";
	$getarray[] = "shop_orderby";
	$getarray[] = "shop_give";
	$getarray[] = "shop_trade";
	$getarray[] = "shop_invlimit";
	$getarray2 = array();
	$getarray2[] = $_REQUEST['multiitems'];
	$getarray2[] = $_REQUEST['shoprestock'];
	$getarray2[] = $_REQUEST['sellrate'];
	$getarray2[] = $_REQUEST['viewtopic'];
	$getarray2[] = $_REQUEST['profiledisplay'];
	$getarray2[] = $_REQUEST['inventorytype'];
	$getarray2[] = $_REQUEST['topicdisplaynum'];
	$getarray2[] = $_REQUEST['orderby'];
	$getarray2[] = $_REQUEST['shopgive'];
	$getarray2[] = $_REQUEST['shoptrade'];
	$getarray2[] = $_REQUEST['invlimit'];
	$getarraynum = count($getarray);

	$globals = array();
	for($i = 0; $i < $getarraynum; $i++)
	{
		$gsql = "update " . CONFIG_TABLE . " set config_value='$getarray2[$i]' where config_name='$getarray[$i]'";
		if ( !($result = $db->sql_query($gsql)) ) { message_die(CRITICAL_ERROR, 'ERROR: Getting Global Variables!'); }
	}
	$message = 'Global information successfully updated!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
	message_die(GENERAL_MESSAGE, $message);
}


//edit shop
elseif ($_REQUEST['action'] == "editshop")
{
	$template->set_filenames(array(
		'body' => 'admin/shop_config_body.tpl')
	);
	//check shopname

	$sql = "select * from nuke_shops where id='{$_REQUEST['shopid']}'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
	}
	$row = $db->sql_fetchrow($result);
	if (strlen($row['shoptype']) < 3)
	{
		message_die(GENERAL_MESSAGE, "That shop doesn't exist.");
	}
	//get shop items
	$sql = "select * from nuke_shopitems where shop='" . addslashes($row['shopname']) . "'";
	if ( !($iresult = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
	}
	$shopitems = '<span class="genmed"><select name="itemid">';
	for ($x = 0; $x < $db->sql_numrows($iresult); $x++)
	{
		$irow = $db->sql_fetchrow($iresult);
		$shopitems .= '<option value="'.$irow['id'].'">'.$irow['name'].'</option>';
	}
	$shopitems .= '</select>';
	if (empty($irow['name'])) { $shopitems = '<tr><td class="row2" colspan="2"><span class="gensmall">This store has no items in it.</span></td></tr>'; }
	else { $shopitems = '<tr><td class="row2"><span class="gensmall"><span class="gensmall">'.$shopitems.'</span></td><td class="row2"><input type="hidden" name="action" value="edititem"><input type="submit" class="liteoption" value="Edit Item"></td></tr>'; }

	//
	//begin template variable creation
	//
 	$shopinfo = '<form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2"><span class="gensmall">Shop Name</span></td><td class="row2"><input type="text" class="post" name="name" value="'.$row['shopname'].'" size="32"></td></tr><tr><td class="row2"><span class="gensmall">Type</span></td><td class="row2"><input type="text" class="post" name="shoptype" value="'.$row['shoptype'].'" size="32"></td></tr><tr><td class="row2"><span class="gensmall">Restock Time (0 for none/in seconds)</span></td><td class="row2"><input type="text" class="post" name="restocktime" value="'.$row['restocktime'].'" size="20"></td></tr><tr><td class="row2"><span class="gensmall">Restock Amount</span></td><td class="row2"><input type="text" class="post" name="restockamount" value="'.$row['restockamount'].'" size="5"></td></tr><tr><td class="row2" align="center">
	<input type="hidden" name="shopid" value="'.$row['id'].'"><input type="hidden" name="action" value="updateshop"><input type="submit" class="liteoption" value="Update Shop"></td></form><form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><td class="row2" align="center"><input type="hidden" name="shopid" value="'.$row['id'].'"><input type="hidden" name="action" value="deleteshop"><input type="submit" class="liteoption" value="Delete Shop"></td></form></tr><tr><td class="row2" colspan="2"><br></td></tr><form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2" colspan="2" align="center"><span class="gen"><strong>Items</strong></span></td></tr>'.$shopitems.'<tr></form><td class="row2" colspan="2"><br></td></tr><form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2"><span class="gensmall">Name (image must have same name)</span></td>
	<td class="row2"><input type="text" class="post" name="item" size="32"  maxlength="32"></td></tr><tr><td class="row2"><span class="gensmall">Short Description (max 80 characters)</span></td><td class="row2"><input type="text" class="post" name="shortdesc" size="32"  maxlength="80"></td></tr><tr><td class="row2"><span class="gensmall">Long Description</span></td><td class="row2"><input type="text" class="post" name="longdesc" size="32"></td></tr><tr><td class="row2"><span class="gensmall">Price</span></td><td class="row2"><input type="text" class="post" name="price" size="32" maxlength="20"></td></tr><tr><td class="row2"><span class="gensmall">Stock</span>
	</td><td class="row2"><input type="text" class="post" name="stock" size="32" maxlength="3"></td></tr><tr><td class="row2"><span class="gensmall">Max Stock</span></td><td class="row2"><input type="text" class="post" name="maxstock" size="32" maxlength="3"></td></tr><tr><td class="row2"><span class="gensmall">Access Forum ID</span></td><td class="row2"><input type="text" class="post" name="accessforum" size="32" maxlength="4"></td></tr><tr><td class="row2" colspan="2" align="center"><input type="hidden" name="action" value="additem"><input type="submit" class="liteoption" value="Add Item"></td><input type="hidden" name="shopid" value="'.$row['id'].'"></form></tr>';

	//finish template varibable

	$template->assign_vars(array(
		'SHOPCONFIGINFO' => "$shopinfo",
		'SHOPTABLETITLE' => "Modify ".stripslashes($shopname),
		'S_CONFIG_ACTION' => append_sid('admin_shop.' . $phpEx),
		'SHOPTITLE' => "Shop Editor",
		'SHOPEXPLAIN' => "This section allows you to select a shop to add an item, edit a shop's properties or delete a shop.")
	);
}

//edit item
elseif ($_REQUEST['action'] == "edititem")
{
	$template->set_filenames(array(
		'body' => 'admin/shop_config_body.tpl')
	);
	//check itemname
	$sql = "select * from nuke_shopitems where id='{$_REQUEST['itemid']}'";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
	}
	$row = $db->sql_fetchrow($result);
	if ($db->sql_numrows($result) < 1)
	{
		message_die(GENERAL_MESSAGE, "No such item exists.");
	}
	//
	//begin template variable creation
	//
	$shopinfo = '<form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2"><span class="gensmall">Name (image must have same name)</span></td><td class="row2"><input name="name" type="text" class="post" size="32" maxlength="32" value="'.$row['name'].'"></td></tr><tr><td class="row2"><span class="gensmall">Shop (must be exact and exist)</span></td><td class="row2"><input name="shop" type="text" class="post" size="32" maxlength="32" value="'.$row['shop'].'"></td></tr><tr><td class="row2"><span class="gensmall">Short Description (max 80 characters)</span></td><td class="row2"><input name="shortdesc" type="text" class="post" size="32" maxlength="80" value="'.$row['sdesc'].'"></td></tr><tr><td class="row2"><span class="gensmall">Long Description</span></td><td class="row2"><input name="longdesc" class="post" type="text" size="32" value="'.$row['ldesc'].'"></td></tr><tr><td class="row2"><span class="gensmall">Price</span></td><td class="row2">
	<input name="price" type="text" class="post" size="32" maxlength="20" value="'.$row['cost'].'"></td></tr><tr><td class="row2"><span class="gensmall">Stock</span></td><td class="row2"><input name="stock" type="text" class="post" size="32" maxlength="3" value="'.$row['stock'].'"></td></tr><tr><td class="row2"><span class="gensmall">Max Stock</span></td><td class="row2"><input name="maxstock" type="text" class="post" size="32" maxlength="3" value="'.$row['maxstock'].'"></td></tr><tr><td class="row2"><span class="gensmall">Sold</span></td><td class="row2"><input name="sold" type="text" class="post" size="32" maxlength="5" value="'.$row['sold'].'"></td></tr><tr><td class="row2"><span class="gensmall">Access Forum ID</span></td><td class="row2"><input name="accessforum" type="text" class="post" size="32" maxlength="4" value="'.$row['accessforum'].'"></td></tr><tr><td class="row2" align="center"><input type="hidden" name="itemid" value="'.$row['id'].'">
	<input type="hidden" name="action" value="updateitem"><input type="submit" class="liteoption" value="Update Item"></td></form><form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><input type="hidden" name="action" value="deleteitem"><input type="hidden" name="itemid" value="'.$row['id'].'"><td class="row2" align="center"><input type="submit" class="liteoption" value="Delete Item"></td></tr></form>';

	//finish template varibable
	//
	//parse template variables
	$template->assign_vars(array(
		'SHOPCONFIGINFO' => $shopinfo,
		'SHOPTABLETITLE' => "Modify ".$row['name'],
		'S_CONFIG_ACTION' => append_sid('admin_shop.' . $phpEx),
		'SHOPTITLE' => "Shop Editor",
		'SHOPEXPLAIN' => "This section allows you to edit or delete an item.")
	);
}

//edit users inventories
elseif ($_REQUEST['action'] == "editinventory")
{
	$template->set_filenames(array(
		'body' => 'admin/shop_config_body.tpl')
	);
	//check username & get useritems
	$row = get_userdata(stripslashes($_REQUEST['username']));
	if (strlen($row['username']) < 3) { message_die(GENERAL_MESSAGE, 'No Such User Exists!'); }
	//set useritems into variable
	$itemarray = str_replace("Þ", "", $row['user_items']);
	$itemarray = explode('ß',$itemarray);
	$itemcount = count ($itemarray);
     	for ($xe = 0;$xe < $itemcount;$xe++)
	{
		if ($itemarray[$xe] != NULL) { $user_items .= '<option value="'.$itemarray[$xe].'">'.$itemarray[$xe].'</option>'; }
	}
	if (strlen($user_items) < 5) { $user_items = '<option value="Nothing">Nothing</option>'; }

	//get all items
	$isql = "select name from nuke_shopitems";
	if ( !($iresult = $db->sql_query($isql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error Getting All Items!'); }
  	for ($x = 0; $x < $db->sql_numrows($iresult); $x++)
  	{
		$irow = $db->sql_fetchrow($iresult);
		if ($irow['name'] != NULL) { $all_items .= '<option value="'.$irow['name'].'">'.$irow['name'].'</option>'; }
	}
	
	//make variables

	$inventoryinfo = '<form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2"><span class="gensmall">Delete Item: </span></td><td class="row2"><span class="gensmall"><select name="itemname">'.$user_items.'</select> <input type="hidden" name="subaction" value="delete"> <input type="hidden" name="action" value="updateinv"> <input type="hidden" name="username" value="'.$row['username'].'"> <input type="submit" class="liteoption" value="Delete Item"></span></td></tr></form><form method="post" action="'.append_sid("admin_shop.".$phpEx).'">
<tr><td class="row2"><span class="gensmall">Add Item: </span></td><td class="row2"><span class="gensmall"><select name="itemname">'.$all_items.'</select> <input type="hidden" name="action" value="updateinv"> <input type="hidden" name="subaction" value="add"> <input type="hidden" name="username" value="'.$row['username'].'"> <input type="submit" class="liteoption" value="Add Item"></span></td></tr></form><form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><tr><td class="row2"><span class="gensmall">Clear Items: </span></td><td class="row2"><input type="hidden" name="subaction" value="clear"><input type="hidden" name="action" value="updateinv"><input type="hidden" name="username" value="'.$row['username'].'"><input type="submit" class="liteoption" value="Delete Inventory"></td></tr></form>';

	//finish template varibable
	//
	//parse template variables
	$template->assign_vars(array(
		'SHOPCONFIGINFO' => $inventoryinfo,
		'SHOPTABLETITLE' => 'Modify '.$row['username'].'\'s Inventory',
		'S_CONFIG_ACTION' => append_sid('admin_shop.' . $phpEx),
		'SHOPTITLE' => "Shop Editor",
		'SHOPEXPLAIN' => "This section allows you to edit or delete an item.")
	);
}

//update users inventories
elseif ($_REQUEST['action'] == "updateinv")
{
	//check username
	$row = get_userdata(stripslashes($_REQUEST['username']));
	if (empty($row['username'])) { message_die(GENERAL_MESSAGE, 'No such user exists!'); }
	if (!empty($_REQUEST['itemname']))
	{
		//check if item exists
		$sql = "select * from nuke_shopitems where name='{$_REQUEST['itemname']}'";
		if ( !($result = $db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
		if ($db->sql_numrows($result) < 1) { message_die(GENERAL_MESSAGE, 'No such item exists!'); }
	}
	elseif ($_REQUEST['subaction'] != "clear") { message_die(GENERAL_MESSAGE, "No item has been selected!"); }

	if ($_REQUEST['subaction'] == "delete")
	{
		//make sure user has item
		if (substr_count($row['user_items'],"ß".stripslashes($_REQUEST['itemname'])."Þ") < 1)
		{
			message_die(GENERAL_MESSAGE, 'The user doesn\'t have that item!');
		}
		$useritems = substr_replace($row['user_items'], "", strpos($row['user_items'], "ß".stripslashes($_REQUEST['itemname'])."Þ"), strlen("ß".stripslashes($_REQUEST['itemname'])."Þ")); 
		$sql = "update " . USERS_TABLE . " set user_items='" . addslashes($useritems) . "' where user_id='{$row['user_id']}'";
		if ( !($db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
		}
		$message = stripslashes($_REQUEST['itemname']).' removed from '.$_REQUEST['username'].'\'s inventory successfully!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?username=".$_REQUEST['username']."&action=editinventory").'">Here</a> to return to Edit '.$_REQUEST['username'].'\'s Inventory<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';

		message_die(GENERAL_MESSAGE, $message);
	}
	if ($_REQUEST['subaction'] == "add")
	{
		$newitems = addslashes($row['user_items']).'ß'.$_REQUEST['itemname'].'Þ';
		$sql = "update " . USERS_TABLE . " set user_items = '$newitems' where username='{$_REQUEST['username']}'";
		if ( !($db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error());
		}
		$message = stripslashes($_REQUEST['itemname']).' added to '.$_REQUEST['username'].'\'s inventory successfully!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?username=".$_REQUEST['username']."&action=editinventory").'">Here</a> to return to Edit '.$_REQUEST['username'].'\'s Inventory<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
		message_die(GENERAL_MESSAGE, $message);
	}
	if ($_REQUEST['subaction'] == "clear")
	{
		$sql = "update " . USERS_TABLE . " set user_items='' where username='{$_REQUEST['username']}'";
		if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
		$message = $username.'\'s inventory successfully Deleted!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?username=".$_REQUEST['username']."&action=editinventory").'">Here</a> to return to Edit '.$_REQUEST['username'].'\'s Inventory<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';

		message_die(GENERAL_MESSAGE, $message);
	}
}

//special graphics shop
elseif ($_REQUEST['action'] == "editspecialshop")
{
	$template->set_filenames(array(
		'body' => 'admin/shop_config_body.tpl')
	);
	//
	//get special shop info
	//
	$shoparray = explode("ß", $board_config['specialshop']);
	$shoparraycount = count ($shoparray);
	$shopstatarray = array();
	for ($x = 0; $x < $shoparraycount; $x++)
	{
		$temparray = explode("Þ", $shoparray[$x]);
		$shopstatarray[] = $temparray[0];
		$shopstatarray[] = $temparray[1];
		if ($temparray[1] == 'enabled') { $shopstatarray[] = 'disabled'; } if ($temparray[1] == 'disabled') { $shopstatarray[] = 'enabled'; }
		if ($temparray[0] == 'on') { $shopstatarray[] = 'off'; } if ($temparray[0] == 'off') { $shopstatarray[] = 'on'; }  
	}
	//
	//begin template variable creation
	//
	$shopinfo = '<form method="post" action="'.append_sid("admin_shop.".$phpEx).'"><input type="hidden" name="action" value="updateeffects"><tr><td class="row2" colspan="2"><span class="gen"><strong>Main Store Settings</strong></span></td></tr><tr><td class="row2"><span class="gensmall">Store </span></td><td class="row2"><select name="shopstats"><option value="'.$shopstatarray[3].'">'.$shopstatarray[3].'</option><option value="'.$shopstatarray[4].'">'.$shopstatarray[4].'</option></select></td></tr><tr><td class="row2"><span class="gensmall">Name </span></td><td class="row2"><input name="shopname" type="text" class="post" size="32" maxlength="32" value="'.$shopstatarray[6].'"></td></tr><tr><td class="row2" colspan="2"><br></td></tr>
	<tr><td class="row2" colspan="2"><span class="gen"><strong>Privilege Settings</strong></span></td></tr><tr><td class="row2"><span class="gensmall">Buy Avatar Ability</span></td><td class="row2"><select name="avatarbuy"><option value="'.$shopstatarray[7].'">'.$shopstatarray[7].'</option><option value="'.$shopstatarray[9].'">'.$shopstatarray[9].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="avatarprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[8].'"></td></tr><tr><td class="row2"><span class="gensmall">Buy Signature Ability</span></td><td class="row2"><select name="sigbuy"><option value="'.$shopstatarray[10].'">'.$shopstatarray[10].'</option><option value="'.$shopstatarray[12].'">'.$shopstatarray[12].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="sigprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[11].'"></td></tr><tr><td class="row2"><span class="gensmall">Buy Titles Ability</span></td>
<td class="row2"><select name="titlebuy"><option value="'.$shopstatarray[13].'">'.$shopstatarray[13].'</option><option value="'.$shopstatarray[15].'">'.$shopstatarray[15].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="titleprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[14].'"></td></tr><tr><td class="row2" colspan="2"><br></td></tr>
	<tr><td class="row2" colspan="2"><span class="gen"><strong>Name Effects Settings</strong></span></td></tr><tr><td class="row2"><span class="gensmall">Buy Color</span></td><td class="row2"><select name="colorbuy"><option value="'.$shopstatarray[16].'">'.$shopstatarray[16].'</option><option value="'.$shopstatarray[18].'">'.ucwords($shopstatarray[18]).'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="colorprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[17].'"></td></tr><tr><td class="row2"><span class="gensmall">Buy Glow</span></td><td class="row2"><select name="glowbuy"><option value="'.$shopstatarray[19].'">'.$shopstatarray[19].'</option><option value="'.$shopstatarray[21].'">'.$shopstatarray[21].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="glowprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[20].'"></td></tr><tr><td class="row2"><span class="gensmall">Buy Shadow</span></td>
<td class="row2"><select name="shadowbuy"><option value="'.$shopstatarray[22].'">'.$shopstatarray[22].'</option><option value="'.$shopstatarray[24].'">'.$shopstatarray[24].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="shadowprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[23].'"></td></tr>
<tr><td class="row2" colspan="2"><br></td></tr>
<tr><td class="row2" colspan="2"><span class="gen"><strong>Title Effects Settings</strong></span></td></tr>
<tr><td class="row2"><span class="gensmall">Buy Title Color</span></td><td class="row2"><select name="tcolorbuy"><option value="'.$shopstatarray[25].'">'.$shopstatarray[25].'</option><option value="'.$shopstatarray[27].'">'.$shopstatarray[27].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="tcolorprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[26].'"></td></tr>
<tr><td class="row2"><span class="gensmall">Buy Title Glow</span></td><td class="row2"><select name="tglowbuy"><option value="'.$shopstatarray[28].'">'.$shopstatarray[28].'</option><option value="'.$shopstatarray[30].'">'.$shopstatarray[30].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="tglowprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[29].'"></td></tr>
<tr><td class="row2"><span class="gensmall">Buy Title Shadow</span></td><td class="row2"><select name="tshadowbuy"><option value="'.$shopstatarray[31].'">'.$shopstatarray[31].'</option><option value="'.$shopstatarray[33].'">'.$shopstatarray[33].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="tshadowprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[32].'"></td></tr>

<tr><td class="row2" colspan="2"><br></td></tr>
<tr><td class="row2" colspan="2"><span class="gen"><strong>User-Custom Settings</strong></span></td></tr>
<tr><td class="row2"><span class="gensmall">Buy Custom Title</span></td><td class="row2"><select name="buyctitle"><option value="'.$shopstatarray[34].'">'.$shopstatarray[34].'</option><option value="'.$shopstatarray[36].'">'.$shopstatarray[36].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="ctitleprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[35].'"></td></tr>
<tr><td class="row2"><span class="gensmall">Change Username</span></td><td class="row2"><select name="buynamec"><option value="'.$shopstatarray[37].'">'.$shopstatarray[37].'</option><option value="'.$shopstatarray[39].'">'.$shopstatarray[39].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="namecprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[38].'"></td></tr>
<tr><td class="row2"><span class="gensmall">Buy Other-User Title</span></td><td class="row2"><select name="buycutitle"><option value="'.$shopstatarray[40].'">'.$shopstatarray[40].'</option><option value="'.$shopstatarray[42].'">'.$shopstatarray[42].'</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="cutitleprice" type="text" class="post" size="10" maxlength="10" value="'.$shopstatarray[41].'"></td></tr>
<tr><td class="row2" colspan="2" align="center"><input class="liteoption" type="submit" value="Update Shop"></td></tr></form>';
	//finish template varibable
	//
	//parse template variables
	$template->assign_vars(array(
		'SHOPCONFIGINFO' => "$shopinfo",
		'SHOPTABLETITLE' => "Modify Special Shop Settings",
		'S_CONFIG_ACTION' => append_sid('admin_shop.'. $phpEx),
		'SHOPTITLE' => "Shop Editor",
		'SHOPEXPLAIN' => "This section allows you to modify the special shop settings.")
	);
}

//update special shop
elseif ($_REQUEST['action'] == "updateeffects")
{
	if (strlen($_REQUEST['shopname']) < 3) { message_die(GENERAL_MESSAGE, 'Shop name too short!'); }
	if (($_REQUEST['shopstats'] != 'disabled') && ($_REQUEST['shopstats'] != 'enabled')) { $error = 1; }
	if ((($_REQUEST['buycutitle'] != 'on') && ($_REQUEST['buycutitle'] != 'off')) || (!is_numeric($_REQUEST['cutitleprice']))) { $error = 1; }
	if ((($_REQUEST['buyctitle'] != 'on') && ($_REQUEST['buyctitle'] != 'off')) || (!is_numeric($_REQUEST['ctitleprice']))) { $error = 1; }
	if ((($_REQUEST['buynamec'] != 'on') && ($_REQUEST['buynamec'] != 'off')) || (!is_numeric($_REQUEST['namecprice']))) { $error = 1; }
	if ((($_REQUEST['tshadowbuy'] != 'on') && ($_REQUEST['tshadowbuy'] != 'off')) || (!is_numeric($_REQUEST['tshadowprice']))) { $error = 1; }
	if ((($_REQUEST['tglowbuy'] != 'on') && ($_REQUEST['tglowbuy'] != 'off')) || (!is_numeric($_REQUEST['tglowprice']))) { $error = 1; }
	if ((($_REQUEST['tcolorbuy'] != 'on') && ($_REQUEST['tcolorbuy'] != 'off')) || (!is_numeric($_REQUEST['tcolorprice']))) { $error = 1; }
	if ((($_REQUEST['shadowbuy'] != 'on') && ($_REQUEST['shadowbuy'] != 'off')) || (!is_numeric($_REQUEST['shadowprice']))) { $error = 1; }
	if ((($_REQUEST['glowbuy'] != 'on') && ($_REQUEST['glowbuy'] != 'off')) || (!is_numeric($_REQUEST['glowprice']))) { $error = 1; }
	if ((($_REQUEST['colorbuy'] != 'on') && ($_REQUEST['colorbuy'] != 'off')) || (!is_numeric($_REQUEST['colorprice']))) { $error = 1; }
	if ((($_REQUEST['titlebuy'] != 'on') && ($_REQUEST['titlebuy'] != 'off')) || (!is_numeric($_REQUEST['titleprice']))) { $error = 1; }
	if ((($_REQUEST['sigbuy'] != 'on') && ($_REQUEST['sigbuy'] != 'off')) || (!is_numeric($_REQUEST['sigprice']))) { $error = 1; }
	if ((($_REQUEST['avatarbuy'] != 'on') && ($_REQUEST['avatarbuy'] != 'off')) || (!is_numeric($_REQUEST['avatarprice']))) { $error = 1; }
	if ($error) { message_die(GENERAL_MESSAGE, 'Invalid shop settings.'); }
	$specialshop = "ßstoreÞ".$_REQUEST['shopstats']."ßnameÞ".$_REQUEST['shopname']."ß".$_REQUEST['avatarbuy']."Þ".$_REQUEST['avatarprice']."ß".$_REQUEST['sigbuy']."Þ".$_REQUEST['sigprice']."ß".$_REQUEST['titlebuy']."Þ".$_REQUEST['titleprice']."ß".$_REQUEST['colorbuy']."Þ".$_REQUEST['colorprice']."ß".$_REQUEST['glowbuy']."Þ".$_REQUEST['glowprice']."ß".$_REQUEST['shadowbuy']."Þ".$_REQUEST['shadowprice']."ß".$_REQUEST['tcolorbuy']."Þ".$_REQUEST['tcolorprice']."ß".$_REQUEST['tglowbuy']."Þ".$_REQUEST['tglowprice']."ß".$_REQUEST['tshadowbuy']."Þ".$_REQUEST['tshadowprice']."ß".$_REQUEST['buyctitle']."Þ".$_REQUEST['ctitleprice']."ß".$_REQUEST['buynamec']."Þ".$_REQUEST['namecprice']."ß".$_REQUEST['buycutitle']."Þ".$_REQUEST['cutitleprice'];
	//update special shop info
	//
	$sql = "update " . CONFIG_TABLE . " set config_value='$specialshop' where config_name='specialshop'";
	if ( !($db->sql_query($sql)) ) { message_die(GENERAL_MESSAGE, 'Fatal Error: '.mysql_error()); }
	$message = 'Special Shop Successfully Updated!<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx."?action=editspecialshop").'">Here</a> to return to Special Shop Settings<br /><br /> Click <a href="'.append_sid("admin_shop.".$phpEx).'">Here</a> to return to Main Shop Configuration<br /><br />Click <a href="'.append_sid("index.".$phpEx."?pane=right").'">Here</a> to return to Admin Index.<br /><br />';
	message_die(GENERAL_MESSAGE, $message);
}
else { message_die(GENERAL_MESSAGE, 'Invalid Action: '.$_REQUEST['action']); }

//
// Generate the page
//
$template->pparse('body');

include_once('page_footer_admin.php');


?>
