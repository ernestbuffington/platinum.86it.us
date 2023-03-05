<?php
/**
*
* @package quick title edition
* @version $Id: lang_extend_attributes.php,v 1.1.3 2007/11/21 12:06 ABDev Exp $
* @copyright (c) 2007 ABDev, OxyGen Powered
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* Original author : Xavier Olive, xavier@2037.biz, 2003
*/
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}
/**
* description
*/
$lang['mod_qte_title'] = 'Quick Title Edition';
$lang['mod_qte_explain'] = 'Allows to apply an attribute, like <span style="color:#006600">[Solved]</span>, to the topics titles. According to the administrator choice during the creation, the attribute can be applied by the administrator, the moderator or the topic poster.';
/**
* admin part
*/
if ( $lang_extend_admin )
{
	$lang['Attributes'] = 'Quick Title Attributes';
	$lang['Attributes_System'] = 'Quick Title Attributes Management';
	$lang['Attributes_System_Explain'] = 'Here you can edit, delete and create quick title attributes.';
	// list
	$lang['Attribute_Color'] = 'Attribute color';
	$lang['Attribute_None'] = '<em>N/A</em>';
	// permissions
	$lang['Attribute_Permissions'] = 'Permissions';
		$lang['Administrator'] = 'Administrator';
		$lang['Moderator'] = 'Moderator';
		$lang['Author'] = 'Author';
	// editor
	$lang['New_Attribute'] = 'Add a new attribute';
	$lang['Attribute_Edit'] = 'Edit <span style="color:%s">%s</span> attribute';
	$lang['Attribute_Type'] = 'Attribute type';
		$lang['Text'] = 'Text';
		$lang['Image'] = 'Image';
	$lang['Attribute_Image'] = 'Image';
	$lang['Attribute_Image_Explain'] = 'You can use too an image entry key, or seize the relative path of the image';
	// position
	$lang['Attribute_Position'] = 'Position';
		$lang['Left'] = 'Left';
		$lang['Right'] = 'Right';
	// messages
	$lang['Click_Return_Attributes_Management'] = 'Click %shere%s to return to the attributes management';
	$lang['Attribute_Added'] = 'Attribute added';
	$lang['Attribute_Updated'] = 'Attribute updated';
	$lang['Attribute_Removed'] = 'Attribute removed';
	$lang['Attribute_Order_Updated'] = 'Attribute order updated.';
	$lang['Attribute_Confirm_Delete'] = 'Are you sure you want to delete this attribute ?';
	// explanations
	$lang['Attribute_Explain'] = '- You can use too a lang entry key, or enter directly the attribute name<br />- Insert <strong>%mod%</strong> will display the user name who applied the attribute<br />- Insert <strong>%date%</strong> will display the day date when the attribute was applied<br /><br />- Example : <strong>[Solved by %mod%]</strong> will display <strong>[Solved by ModeratorName</strong>]';
	$lang['New_Attribute_Explain'] = 'You can create short bits of text wich you will be able to add to the title of a topic, by pushing a single button.';
	$lang['Attribute_Edit_Explain'] = 'Here, you can modify the fields of the selected attribute.';
	$lang['Attribute_Permissions_Explain'] = 'Users with these levels will be able to apply attributes';
	$lang['Attribute_Color_Explain'] = 'Select a value from the <em>color picker</em> or enter manually it (without #).<br />Leave blank to use a CSS class named like the rank.';
	$lang['Attribute_Position_Explain'] = 'Choose if the attribute has to be placed on the left or on the right from the topic title';
	// error messages
	$lang['Attr_Error_Message_01'] = 'Could not obtain attribute data';
	$lang['Attr_Error_Message_02'] = 'Could not select attribute fields';
	$lang['Attr_Error_Message_03'] = 'Could not update/insert into attributes table';
	$lang['Attr_Error_Message_04'] = 'Could not select id field';
	$lang['Attr_Error_Message_05'] = 'Could not update order fields';
	$lang['Attr_Error_Message_06'] = 'Could not delete attribute data';
	$lang['Attr_Error_Message_07'] = 'Error getting total informations for attribute';
	$lang['Attr_Error_Message_08'] = 'Invalid entry on the field: ';
	$lang['Attr_Error_Message_13'] = 'You have to define an image link';
	$lang['Attr_Error_Message_14'] = 'You have to seize an attribute';
}
// moderation part
$lang['No_Attribute'] = 'None';
$lang['Attribute_apply'] = 'Apply';
$lang['Attribute_Edited'] = 'The attribute has been added/modified.';
// posting part
$lang['Attribute'] = 'Quick Title Attribute';
// error messages
$lang['Attr_Error_Message_09'] = 'Could not query attribute table';
$lang['Attr_Error_Message_10'] = 'Could not query users table';
$lang['Attr_Error_Message_11'] = 'This attribute doesn\'t exist';
$lang['Attr_Error_Message_12'] = 'Could not update topics table';
// attributes examples
$lang['QTE_Solved'] = 'Solved';
$lang['QTE_Cancelled'] = 'Cancelled';
?>
