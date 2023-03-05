<?php
/**************************************************************************/
/*Platinum Nuke Pro default for required jquery.***************************/                    
/* Copyright (c) 2011, Platinum Nuke Pro        ***************************/
/* Added By DocHaVoC  http://www.havocst.net    ***************************/
/* Colorbox mod for Platinum Nuke Pro           ***************************/
/* CKeditor mod for Platinum Nuke Nuke Pro      ***************************/
/* nukeSEO                                      ***************************/
/* jquery default                               ***************************/
/* This program is free software. You can redistribute it and/or modify it*/
/* under the terms of the GNU General Public License as published by the **/
/* Free Software Foundation, version 2 of the license.*********************/
/**************************************************************************/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
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
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2011, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if(!isset($_GET['op']))  $_GET['op'] = '';

	addCSSToHead('includes/jquery/css/screen.css', 'file');
	addCSSToHead('includes/jquery/css/jquery.css', 'file');
	addJSToHead('includes/jquery/lib/jquery.validate.min.js', 'file');
	addJSToHead('includes/jquery/lib/jquery.pstrength-min.1.2.js', 'file');
	
if(!isset($name))  $name = '';

// Get your account configuration to prevent overriding $ya_config used in other places
// need to get the languages - G
//  global $lang;
//  include_once('modules/Your_Account/language/lang-'.$lang.'.php');
//	get_lang('Your_Account');
get_lang('Your_Account');
require_once('modules/Your_Account/includes/constants.php');
include_once('modules/Your_Account/includes/functions.php');
$ya_config = ya_get_configs();
if ($name=='Your_Account' and $_GET['op']=='new_user') {

	global $ya_CustomFields;
	$ya_CustomFields = ya_GetCustomRegFields();
	addJSToHead('includes/jquery/lib/cmxforms.js', 'file');
	$JStoHeadHTML = '
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	// validate signup form on keyup and submit
	var validator = $("#newUser").validate({
		rules: {
			ya_username: {
				required: true,
				minlength: '.$ya_config['nick_min'].',
        remote: "rnxhr.php?name=Your_Account&file=public/userAvailability"
			},';
	if ($ya_config['userealname']==3 or $ya_config['userealname'] == '5') $JStoHeadHTML .= 'ya_realname: "required",';
		$JStoHeadHTML .= 'ya_user_email: {
				required: true,
				email: true,
				remote: "rnxhr.php?name=Your_Account&file=public/emailAvailability"
				},';
	if ($ya_config['doublecheckemail']==1)
		$JStoHeadHTML .= 'ya_user_email2: {
				required: true,
				email: true,
				equalTo: "#ya_user_email"
				},';
	if ($ya_config['usefakeemail'] == '3' or $ya_config['usefakeemail'] == '5') 
		$JStoHeadHTML .= 'femail: {	required: true },';
	if ($ya_config['usewebsite'] == '3' or $ya_config['usewebsite'] == '5') 
		$JStoHeadHTML .= 'user_website: { required: true },';
	if ($ya_config['useinstantmessaim'] == '3' or $ya_config['useinstantmessaim'] == '5')
		$JStoHeadHTML .= 'user_aim: { required: true },';
	if ($ya_config['useinstantmessicq'] == '3' or $ya_config['useinstantmessicq'] == '5')
		$JStoHeadHTML .= 'user_icq: { required: true },';
	if ($ya_config['useinstantmessmsn'] == '3' or $ya_config['useinstantmessmsn'] == '5')
		$JStoHeadHTML .= 'user_msnm: { required: true },';
	if ($ya_config['useinstantmessyim'] == '3' or $ya_config['useinstantmessyim'] == '5')
		$JStoHeadHTML .= 'user_yim: { required: true },';
	if ($ya_config['uselocation'] == '3' or $ya_config['uselocation'] == '5')
		$JStoHeadHTML .= 'user_from: { required: true },';
	if ($ya_config['useoccupation'] == '3' or $ya_config['useoccupation'] == '5')
		$JStoHeadHTML .= 'user_occ: { required: true },';
	if ($ya_config['useinterests'] == '3' or $ya_config['useinterests'] == '5')
		$JStoHeadHTML .= 'user_interests: { required: true },';
	if ($ya_config['usenewsletter'] == '3' or $ya_config['usenewsletter'] == '5')
		$JStoHeadHTML .= 'newsletter: { required: true },';
	if ($ya_config['useviewemail'] == '3' or $ya_config['useviewemail'] == '5')
		$JStoHeadHTML .= 'user_viewemail: { required: true },';
	if ($ya_config['usehideonline'] == '3' or $ya_config['usehideonline'] == '5')
		$JStoHeadHTML .= 'user_allow_viewonline: { required: true },';
	if ($ya_config['usesignature'] == '3' or $ya_config['usesignature'] == '5')
		$JStoHeadHTML .= 'user_sig: { required: true },';
	if ($ya_config['useextrainfo'] == '3' or $ya_config['useextrainfo'] == '5')
		$JStoHeadHTML .= 'bio: { required: true },';
	$JStoHeadHTML .= $ya_CustomFields['rules'].'
			user_password: {
				minlength: '.$ya_config['pass_min'].'
			},
			user_password2: {
				minlength: '.$ya_config['pass_min'].',
				equalTo: "#user_password"
			}
		},
		messages: {
			ya_username: {
				required: "'._YA_MSG_ENTERUSERNAME.'",
				minLength: "'._YA_MSG_USERNAMELENGTH.' '.$ya_config['nick_min'].' '._YA_MSG_CHARACTERS.'",
				remote: jQuery.format("{0} '._YA_MSG_USERNAME_ERROR.'")
			},';
	if ($ya_config['userealname']==3) $JStoHeadHTML .= 'ya_realname: "'._YA_MSG_ENTERREALNAME.'",';
		$JStoHeadHTML .= 'ya_user_email: {
				required: "'._YA_MSG_ENTERVALIDEMAIL.'",
				email: "'._YA_MSG_ENTERVALIDEMAIL.'",
				remote: jQuery.format("{0} '._YA_MSG_EMAIL_ERROR.'")
			},';
	if ($ya_config['doublecheckemail']==1)
		$JStoHeadHTML .= 'ya_user_email2: {
				required: "'._YA_MSG_ENTERVALIDEMAIL.'",
				email: "'._YA_MSG_ENTERVALIDEMAIL.'",
				equalTo: "'._YA_MSG_EMAIL2_MISMATCH.'"
			},';
	if ($ya_config['usefakeemail'] == '3' or $ya_config['usefakeemail'] == '5') 
		$JStoHeadHTML .= 'femail: {	required: "'._REQUIRED.'"},';
	if ($ya_config['usewebsite'] == '3' or $ya_config['usewebsite'] == '5') 
		$JStoHeadHTML .= 'user_website: { required: "'._REQUIRED.'" },';
	if ($ya_config['useinstantmessaim'] == '3' or $ya_config['useinstantmessaim'] == '5')
		$JStoHeadHTML .= 'user_aim: { required: "'._REQUIRED.'" },';
	if ($ya_config['useinstantmessicq'] == '3' or $ya_config['useinstantmessicq'] == '5')
		$JStoHeadHTML .= 'user_icq: { required: "'._REQUIRED.'" },';
	if ($ya_config['useinstantmessmsn'] == '3' or $ya_config['useinstantmessmsn'] == '5')
		$JStoHeadHTML .= 'user_msnm: { required: "'._REQUIRED.'" },';
	if ($ya_config['useinstantmessyim'] == '3' or $ya_config['useinstantmessyim'] == '5')
		$JStoHeadHTML .= 'user_yim: { required: "'._REQUIRED.'" },';
	if ($ya_config['uselocation'] == '3' or $ya_config['uselocation'] == '5')
		$JStoHeadHTML .= 'user_from: { required: "'._REQUIRED.'" },';
	if ($ya_config['useoccupation'] == '3' or $ya_config['useoccupation'] == '5')
		$JStoHeadHTML .= 'user_occ: { required: "'._REQUIRED.'" },';
	if ($ya_config['useinterests'] == '3' or $ya_config['useinterests'] == '5')
		$JStoHeadHTML .= 'user_interests: { required: "'._REQUIRED.'" },';
	if ($ya_config['usenewsletter'] == '3' or $ya_config['usenewsletter'] == '5')
		$JStoHeadHTML .= 'newsletter: { required: "'._REQUIRED.'" },';
	if ($ya_config['useviewemail'] == '3' or $ya_config['useviewemail'] == '5')
		$JStoHeadHTML .= 'user_viewemail: { required: "'._REQUIRED.'" },';
	if ($ya_config['usehideonline'] == '3' or $ya_config['usehideonline'] == '5')
		$JStoHeadHTML .= 'user_allow_viewonline: { required: "'._REQUIRED.'" },';
	if ($ya_config['usesignature'] == '3' or $ya_config['usesignature'] == '5')
		$JStoHeadHTML .= 'user_sig: { required: "'._REQUIRED.'" },';
	if ($ya_config['useextrainfo'] == '3' or $ya_config['useextrainfo'] == '5')
		$JStoHeadHTML .= 'bio: { required: "'._REQUIRED.'" },';
	$JStoHeadHTML .=  $ya_CustomFields['messages'].'
			user_password: {
				minLength: "'._YA_MSG_PASSWORDLENGTH.' '.$ya_config['pass_min'].' '._YA_MSG_CHARACTERS.'"
			},
			user_password2: {
				minLength: "'._YA_MSG_PASSWORDLENGTH.' '.$ya_config['pass_min'].' '._YA_MSG_CHARACTERS.'",
				equalTo: "'._YA_MSG_PASSWORD2_MISMATCH.'"
			}
		}
	});
});
// ]]>
</script>
';
// temp fix for user registration - disables registration field warnings
//	addJSToHead($JStoHeadHTML, 'inline');
}
?>