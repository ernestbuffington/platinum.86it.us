<?php
/*************************************************************************** 
 *                               cash.php 
 *                            ------------------- 
 *   begin                : Wednesday, Jul 16, 2003 
 *   copyright            : (C) 2003 Xore 
 *   email                : mods@xore.ca 
 * 
 *   $Id: cash.php,v 2.0.2.1 2003/11/16 17:21:10 Xore $ 
 * 
 ***************************************************************************/ 

/*************************************************************************** 
 * 
 *   This program is free software; you can redistribute it and/or modify 
 *   it under the terms of the GNU General Public License as published by 
 *   the Free Software Foundation; either version 2 of the License, or 
 *   (at your option) any later version. 
 * 
 ***************************************************************************/ 

if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}
define('IN_PHPBB', true); 
define('IN_CASHMOD', true); 
$phpbb_root_path = 'modules/Forums/';
include_once($phpbb_root_path . 'extension.inc'); 
include_once($phpbb_root_path . 'common.'.$phpEx);
include_once ('header.php');

// 
// Start session management 
// 
$userdata = session_pagestart($user_ip, PAGE_PROFILE,$nukeuser);
init_userprefs($userdata); 
// 
// End session management
// 

if ( !$userdata['session_logged_in'] ) 
{ 

   $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid("login.$phpEx?redirect=cash.$phpEx", true));
}


$mode = isset($_POST['mode'])?$_POST['mode']:(isset($_GET['mode'])?$_GET['mode']:(""));

switch( $mode ) 
{
//
//========================================[ Donate Code ]=========================== 
// 
   case "donate": 
      $ref = isset($_GET['ref'])?$_GET['ref']:'index'; 
      $target = ( isset($_GET[POST_USERS_URL]) )?intval($_GET[POST_USERS_URL]):(( isset($_GET['u']) )?intval($_GET['u']):0); 
      $post = ( isset($_GET[POST_POST_URL]) )?intval($_GET[POST_POST_URL]):(( isset($_GET['p']) )?intval($_GET['p']):0);
      if ( ($target == ANONYMOUS) || ($target == $userdata['user_id']) ) 
      { 
         if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit; 
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      $profiledata = get_userdata($target); 
      // 
      // Load templates
      // 
      $template->set_filenames(array( 
         'body' => 'cash_donate.tpl') 
      ); 

      // 
      // Output page header 
      // 
      $page_title = $lang['Donate']; 
      include_once('includes/page_header.'.$phpEx); 

      $hidden = '<input type="hidden" name="ref" value="' . $ref . '" />'; 
      $hidden .= '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $target . '" />'; 
      if ( $ref == 'viewtopic' ) 
      { 
         $hidden .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post . '" />'; 
      } 

      $template->assign_vars(array( 
         'S_DONATE_ACTION' => append_sid("cash.$phpEx?mode=donated"),
         'S_HIDDEN_FIELDS' => $hidden, 
         'L_DONATE' => $lang['Donate'], 
         'L_FROM' => $lang['From'],
         'L_TO' => $lang['To'], 
         'L_CONVERT' => $lang['Convert'], 
         'L_SELECT_ONE' => $lang['Select_one'], 

         'L_SUBMIT' => $lang['Submit'], 
         'L_RESET' => $lang['Reset'], 

         'L_AMOUNT' => $lang['Amount'], 
         'L_DONATE_TO' => sprintf($lang['Donate_to'],$profiledata['username']), 
         'L_MESSAGE' => $lang['Message'], 

         'TARGET' => $profiledata['username'], 
         'DONATER' => $userdata['username']) 
         ); 

      while ( $c_cur = &$cash->currency_next($cm_i,CURRENCY_ENABLED | CURRENCY_DONATE) ) 
      { 
         $template->assign_block_vars('cashrow',array(   'CASH_NAME' => $c_cur->name(), 
                                             'RECEIVER_AMOUNT' => $profiledata[$c_cur->db()], 
                                             'DONATER_AMOUNT' => $userdata[$c_cur->db()], 
                                             'S_DONATE_FIELD' => 'cash[' . $c_cur->id() . ']')
         ); 
      } 

      $template->pparse('body'); 

      include_once('includes/page_tail.'.$phpEx); 

      break; 
// 
//========================================[ Donated Code ]=========================== 
// 
   case "donated": 
      $ref = isset($_POST['ref'])?$_POST['ref']:'index'; 
      $target = ( isset($_POST[POST_USERS_URL]) )?intval($_POST[POST_USERS_URL]):(( isset($_POST['u']) )?intval($_POST['u']):0); 
      $post = ( isset($_POST[POST_POST_URL]) )?intval($_POST[POST_POST_URL]):(( isset($_POST['p']) )?intval($_POST['p']):0); 
      if ( ($target == ANONYMOUS) || ($target == $userdata['user_id']) ) 
      { 
         if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit;
         }
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      $profiledata = get_userdata($target); 
      $target = new cash_user($target,$profiledata); 
      $donater = new cash_user($userdata['user_id'],$userdata); 
      if ( ($target->id() != $donater->id()) && isset($_POST['cash']) && is_array($_POST['cash']) )
      { 
         $donate_array = array(); 
         $donate = false; 
         while ( $c_cur = &$cash->currency_next($cm_i,CURRENCY_ENABLED | CURRENCY_DONATE) ) 
         { 
            if ( isset($_POST['cash'][$c_cur->id()]) && 
                is_numeric($_POST['cash'][$c_cur->id()]) ) 
            { 
               $amount = cash_floatval($_POST['cash'][$c_cur->id()]); 
               if ( $amount > 0 ) 
               { 
                  $amount = ( $donater->has($c_cur->id(),$amount) ) ? $amount : $donater->amount($c_cur->id());
                  $donate_array[$c_cur->id()] = $amount; 
                  $message_clause[] = $c_cur->display($amount,true); 
                  $donate = true; 
               } 
            } 
         } 
         if ( $donate ) 
         {
            $donater->remove_by_id_array($donate_array); 
            $target->give_by_id_array($donate_array); 

            $action = array($donater->id(), 
                        $donater->name(), 
                        implode('</strong>, <strong>',$message_clause), 
                        $target->id(), 
                        $target->name()); 
            $message = ( isset($_POST['message']) )?str_replace("\'","''",$_POST['message']):''; 
            cash_create_log(CASH_LOG_DONATE,$action,$message); 
                         
            if ( ($message != '') && $userdata['user_allow_pm'] ) 
            {
               $privmsg_subject = sprintf($lang['Donation_recieved'],$userdata['username']);

               $preamble = sprintf($lang['Has_donated'],$userdata['username'],implode('[/b], [b]',$message_clause),$userdata['username']); 
               $message = str_replace("'","''",$preamble) . $message; 

               cash_pm($profiledata,$privmsg_subject,$message); 
            } 
         } 
         if ( $ref == 'viewprofile' ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $target->id(), true));
            exit; 
         } 
         else if ( ($ref == 'viewtopic') && ($post != 0) ) 
         {
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit;
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      break; 
// 
//========================================[ Modedit Code ]=========================== 
// 
   case "modedit": 
      $ref = isset($_GET['ref'])?$_GET['ref']:'index'; 
      $target = ( isset($_GET[POST_USERS_URL]) )?intval($_GET[POST_USERS_URL]):(( isset($_GET['u']) )?intval($_GET['u']):0); 
      $post = ( isset($_GET[POST_POST_URL]) )?intval($_GET[POST_POST_URL]):(( isset($_GET['p']) )?intval($_GET['p']):0); 
      if ( $target == ANONYMOUS ) 
      { 
         if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true)); 
            exit; 
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      if ( ($userdata['user_level'] != ADMIN) && ($userdata['user_level'] != MOD)) 
      { 
         if ( $ref == 'viewprofile' ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $target, true));
            exit;
         } 
         else if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit; 
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      $profiledata = get_userdata($target); 
      // 
      // Load templates 
      // 
      $template->set_filenames(array( 
         'body' => 'cash_modedit.tpl') 
      ); 

      // 
      // Output page header 
      // 
      $page_title = sprintf($lang['Mod_usercash'],$profiledata['username']); 
      include_once('includes/page_header.'.$phpEx); 


      $hidden = '<input type="hidden" name="ref" value="' . $ref . '" />'; 
      $hidden .= '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $target . '" />'; 
      if ( $ref == 'viewtopic' ) 
      { 
         $hidden .= '<input type="hidden" name="' . POST_POST_URL . '" value="' . $post . '" />'; 
      } 

      $template->assign_vars(array( 
         'S_MODEDIT_ACTION' => append_sid("cash.$phpEx?mode=modedited"),
         'S_HIDDEN_FIELDS' => $hidden, 
         'L_DONATE' => $lang['Donate'], 
         'L_FROM' => $lang['From'], 
         'L_TO' => $lang['To'], 
         'L_CONVERT' => $lang['Convert'], 
         'L_SELECT_ONE' => $lang['Select_one'], 

         'L_SUBMIT' => $lang['Submit'], 
         'L_RESET' => $lang['Reset'], 

         'L_AMOUNT' => $lang['Amount'], 
         'L_DONATE_TO' => sprintf($lang['Donate_to'],$profiledata['username']), 
         'L_MESSAGE' => $lang['Message'], 

         'L_OMIT' => $lang['Omit'], 
         'L_ADD' => $lang['Add'], 
         'L_REMOVE' => $lang['Remove'], 
         'L_SET' => $lang['Set'], 

         'TITLE' => sprintf($lang['Mod_usercash'],$profiledata['username']), 

         'TARGET' => $profiledata['username'], 
         'DONATER' => $userdata['username']) 
          ); 

      $mask = false; 
      if ( $userdata['user_level'] == MOD ) 
      { 
         $mask = (CURRENCY_ENABLED | CURRENCY_MODEDIT); 
      } 
      while ( $c_cur = &$cash->currency_next($cm_i,$mask) ) 
      { 
         $template->assign_block_vars('cashrow',array(   'CASH_NAME' => $c_cur->name(), 
                                             'RECEIVER_AMOUNT' => $profiledata[$c_cur->db()], 
                                             'DONATER_AMOUNT' => $userdata[$c_cur->db()], 
                                             'S_TYPE_FIELD' => 'cashtype[' . $c_cur->id() . ']', 
                                             'S_CHANGE_FIELD' => 'cashchange[' . $c_cur->id() . ']') 
            ); 
      } 

      $template->pparse('body'); 

      include_once('includes/page_tail.'.$phpEx); 

      break; 
// 
//========================================[ Modedited Code ]=========================== 
// 
   case "modedited": 
      $ref = isset($_POST['ref'])?$_POST['ref']:'index'; 
      $target = ( isset($_POST[POST_USERS_URL]) )?intval($_POST[POST_USERS_URL]):(( isset($_POST['u']) )?intval($_POST['u']):0); 
      $post = ( isset($_POST[POST_POST_URL]) )?intval($_POST[POST_POST_URL]):(( isset($_POST['p']) )?intval($_POST['p']):0); 
      if ( $target == 0 ) 
      { 
         if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit; 
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      if ( ($userdata['user_level'] != ADMIN) && ($userdata['user_level'] != MOD)) 
      { 
         if ( $ref == 'viewprofile' ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $target, true));
            exit; 
         } 
         else if ( ($ref == 'viewtopic') && ($post != 0) ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true)); 
            exit; 
         } 
         else 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true)); 
            exit; 
         } 
      } 
      $profiledata = get_userdata($target); 
      $target = new cash_user($target,$profiledata); 
      if ( isset($_POST['cashtype']) && is_array($_POST['cashtype']) && isset($_POST['cashchange']) && is_array($_POST['cashchange']) ) 
      { 
         $mask = false; 
         if ( $userdata['user_level'] == MOD ) 
         { 
            $mask = (CURRENCY_ENABLED | CURRENCY_MODEDIT); 
         } 
         $moderate_array = array('1' => array(),'2' => array(),'3' => array()); 
         $moderate_clause = array('1' => array(),'2' => array(),'3' => array()); 
         $modedit = array('1'=>false,'2'=>false,'3'=>false); 
         $editlist = array(); 
         while ( $c_cur = &$cash->currency_next($cm_i,$mask) ) 
         { 
            if ( isset($_POST['cashtype'][$c_cur->id()]) && 
                is_numeric($_POST['cashtype'][$c_cur->id()]) && 
                ($_POST['cashtype'][$c_cur->id()] != 0) && 
                isset($_POST['cashchange'][$c_cur->id()]) && 
                is_numeric($_POST['cashchange'][$c_cur->id()]) ) 
            { 
               $amount = cash_floatval($_POST['cashchange'][$c_cur->id()]); 
               $allow_neg = $c_cur->mask(CURRENCY_ALLOWNEG); 
               $type = intval($_POST['cashtype'][$c_cur->id()]); 
               if ( (($type == 1) || ($type == 2)) && $amount < 0 ) 
               { 
                  $amount = -$amount; 
                  $type = 3 - $type; 
               } 
               switch ( $type ) 
               { 
                  case 1: // add 
                     $moderate_array[1][$c_cur->id()] = $amount; 
                     $modedit[1] = true; 
                     $moderate_clause[1][] = $c_cur->display($amount,true); 
                     $editlist[] = $c_cur->name(true); 
                     break; 
                  case 2: // remove 
                     if ( $allow_neg || $target->has($c_cur->id(),$amount) ) 
                     { 
                        $moderate_array[2][$c_cur->id()] = $amount; 
                        $modedit[2] = true; 
                        $moderate_clause[2][] = $c_cur->display($amount,true); 
                        $editlist[] = $c_cur->name(true); 
                     } 
                     break; 
                  case 3: // set 
                     if ( ($amount >= 0) || $allow_neg ) 
                     { 
                        $moderate_array[3][$c_cur->id()] = $amount; 
                        $modedit[3] = true; 
                        $moderate_clause[3][] = $c_cur->display($amount,true); 
                        $editlist[] = $c_cur->name(true); 
                     } 
                     break; 
               } 
            } 
         } 

         if ( $modedit[1] || $modedit[2] || $modedit[3] ) 
         { 
            $message = ( isset($_POST['message']) )?str_replace("\'","''",$_POST['message']):''; 
            $action = array($userdata['user_id'], 
                        $userdata['username'], 
                        $target->id(), 
                        $target->name(), 
                        implode('</strong>, <strong>',$moderate_clause[1]), 
                        implode('</strong>, <strong>',$moderate_clause[2]), 
                        implode('</strong>, <strong>',$moderate_clause[3])); 
            cash_create_log(CASH_LOG_ADMIN_MODEDIT,$action,$message); 
            if ( $modedit[1] ) 
            { 
               $target->give_by_id_array($moderate_array[1]); 
            } 
            if ( $modedit[2] ) 
            { 
               $target->remove_by_id_array($moderate_array[2]); 
            } 
            if ( $modedit[3] ) 
            { 
               $target->set_by_id_array($moderate_array[3]); 
            } 

            if ( ($message != '') && $userdata['user_allow_pm'] ) 
            { 
               $privmsg_subject = sprintf($lang['Has_moderated'],$userdata['username'],implode(", ",$editlist)); 

               $preamble = $privmsg_subject . ":\n[list]"; 
               if ( $modedit[1] ) 
               { 
                  $preamble .= sprintf($lang['Has_added'],implode('[/b], [b]',$moderate_clause[1]));
               } 
               if ( $modedit[2] ) 
               { 
                  $preamble .= sprintf($lang['Has_removed'],implode('[/b], [b]',$moderate_clause[2])); 
               } 
               if ( $modedit[3] ) 
               { 
                  $preamble .= sprintf($lang['Has_set'],implode('[/b], [b]',$moderate_clause[3])); 
               } 

               $message = str_replace("'","''",$preamble) . "[/list]\n" . $message; 

               cash_pm($profiledata,str_replace("'","''",$privmsg_subject),$message); 
            } 
         } 
         if ( $ref == 'viewprofile' ) 
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=" . $target->id(), true));
            exit; 
         } 
         else if ( ($ref == 'viewtopic') && ($post != 0) ) 
         {
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: ';
            header($header_location . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post#$post", true));
            exit;
         } 
         else
         { 
            $header_location = ( @preg_match('/Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ) ? 'Refresh: 0; URL=' : 'Location: '; 
            header($header_location . append_sid('index.' . $phpEx, true));
            exit; 
         } 
      } 
      break; 

//
//========================================[ Exchange Code ]===========================
//
	case "exchange":
	default:
		//
		// Load templates
		//
		$template->set_filenames(array(
			'body' => 'cash_exchange.tpl')
		);

		//
		// Output page header
		//
		$page_title = $lang['Exchange'];
		include_once('includes/page_header.'.$phpEx);

		$sql = "SELECT * FROM " . CASH_EXCHANGE_TABLE;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain exchange information", '', __LINE__, __FILE__, $sql);
		}
		if ( !($row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_MESSAGE, $lang['Exchange_lack_of_currencies']);
		}
		$exchange_data = array();
		do
		{
			$exchange_data[$row['ex_cash_id1']][$row['ex_cash_id2']] = 1;
		}
		while ( $row = $db->sql_fetchrow($result) );

		if ( isset($_POST['exchange']) &&
			 isset($_POST['from_id']) &&
			 is_numeric($_POST['from_id']) &&
			 isset($_POST['to_id']) &&
			 is_numeric($_POST['to_id']) &&
			 isset($_POST['convert_amount']) &&
			 is_numeric($_POST['convert_amount']) )
		{
			$from_id = intval($_POST['from_id']);
			$to_id = intval($_POST['to_id']);
			$convert_amount = cash_floatval($_POST['convert_amount']);
			if ( ($to_id != $from_id) && $cash->currency_exists($to_id) && $cash->currency_exists($from_id) && isset($exchange_data[$from_id]) && is_array($exchange_data[$from_id]) && isset($exchange_data[$from_id][$to_id]) && $cash->currencies[$from_id]->mask(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) && $cash->currencies[$to_id]->mask(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) )
			{
				if ( $convert_amount < 0 )
				{
					qs($from_id,$to_id);
					$convert_amount = -$convert_amount;
				}
				$c_cur_from = $cash->currency($from_id);
				$c_cur_to = $cash->currency($to_id);

				$exchanger = new cash_user($userdata['user_id'],$userdata);
				if ( $exchanger->has($c_cur_from->id(),$convert_amount) )
				{
					$converted_amount = (($convert_amount/$c_cur_from->data('cash_exchange'))*$c_cur_to->data('cash_exchange'));
					$exchanger->remove_by_id_array(array($c_cur_from->id() => $convert_amount));
					$exchanger->give_by_id_array(array($c_cur_to->id() => $converted_amount));
				}
			}
		}

		$template->assign_vars(array(
			'S_EXCHANGE_ACTION' => append_sid("cash.$phpEx?mode=exchange"),
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="exchange" value="1" />',
			'L_EXCHANGE' => $lang['Exchange'],
			'L_FROM' => $lang['From'],
			'L_TO' => $lang['To'],
			'L_CONVERT' => $lang['Convert'],
			'L_SELECT_ONE' => $lang['Select_one'],

			'L_SUBMIT' => $lang['Submit'],
			'L_RESET' => $lang['Reset'])
		    );

		$max_columns_per_row = 3;
		$columnwidth = intval(floor(100/$max_columns_per_row));
		$bresenham = 0;
		$numrows = intval(ceil(count($indices)/$max_columns_per_row));
		$i = 0;
		while ( $c_cur = &$cash->currency_next($cm_i,CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) )
		{
			$template->assign_block_vars("cashrow",array(
				'CASH_ID' => $c_cur->id(),
				'CASH_NAME' => $c_cur->name(true))
			    );
			if ( (($i * $numrows) / $cash->currency_count(CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE)) >= $bresenham )
			{
				$bresenham++;
				$template->assign_block_vars("rowrow",array());
			}
			$headercash = $c_cur->display($userdata[$c_cur->db()]);
			$template->assign_block_vars("rowrow.cashtable",array(	'CASH_ID' => $c_cur->id(),
																	'CASH_NAME' => $c_cur->name(),
																	'HEADER' => $lang['You_have'] . " " . $headercash,
																	'ONE_WORTH' => sprintf($lang['One_worth'],$c_cur->name()),
																	'NO_EXCHANGE' => sprintf($lang['Cannot_exchange'],$c_cur->name()))
										);
			$exchangecount = 0;
			if ( isset($exchange_data[$c_cur->id()]) && count($exchange_data[$c_cur->id()]) )
			{
				$template->assign_block_vars("rowrow.cashtable.switch_exon",array());
				while ( $c_cur_j = &$cash->currency_next($cm_j,CURRENCY_ENABLED | CURRENCY_EXCHANGEABLE) )
				{
					if ( ($c_cur->id() != $c_cur_j->id()) && isset($exchange_data[$c_cur->id()]) && isset($exchange_data[$c_cur->id()][$c_cur_j->id()]) )
					{
						$ratio = floor(($c_cur_j->data('cash_exchange')/$c_cur->data('cash_exchange'))*1000)/1000;
						$template->assign_block_vars("rowrow.cashtable.switch_exon.exchangeitem",array(	'EXCHANGE' => $c_cur_j->display($ratio)));
					}
				}
			}
			else
			{
				$template->assign_block_vars("rowrow.cashtable.switch_exoff",array());
			}
			$i++;
		}

		$template->pparse('body');

		include_once('includes/page_tail.'.$phpEx);
		
		break;
	}

	

?>
