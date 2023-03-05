<?php

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke     		*/
/* ============================================                         		*/
/*                                                                      		*/
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                     		*/
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                		*/
/*                                                                      		*/
/* Contact author: escudero@phpnuke.org.br                              		*/
/* International Support Forum: http://ravenphpscripts.com/forum76.html 		*/
/*                                                                      		*/
/* This program is free software. You can redistribute it and/or modify 		*/
/* it under the terms of the GNU General Public License as published by 		*/
/* the Free Software Foundation; either version 2 of the License.       		*/
/*                                                                      		*/
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion	*/
/*********************************************************************************/

if (!defined('MODULE_FILE')) {
   die ('You can\'t access this file directly...');
}

if (!defined('CNBYA')) {
     echo "CNBYA protection";
     exit;
}
    include_once("header.php");
function mkrealdate($day,$month,$birth_year)
{
	// range check months
	if ($month<1 || $month>12) return "error";
	// range check days
	switch ($month)
	{
		case 1: if ($day>31) return "error";break;
		case 2: if ($day>29) return "error";
			$epoch=$epoch+31;break;
		case 3: if ($day>31) return "error";
			$epoch=$epoch+59;break;
		case 4: if ($day>30) return "error" ;
			$epoch=$epoch+90;break;
		case 5: if ($day>31) return "error";
			$epoch=$epoch+120;break;
		case 6: if ($day>30) return "error";
			$epoch=$epoch+151;break;
		case 7: if ($day>31) return "error";
			$epoch=$epoch+181;break;
		case 8: if ($day>31) return "error";
			$epoch=$epoch+212;break;
		case 9: if ($day>30) return "error";
			$epoch=$epoch+243;break;
		case 10: if ($day>31) return "error";
			$epoch=$epoch+273;break;
		case 11: if ($day>30) return "error";
			$epoch=$epoch+304;break;
		case 12: if ($day>31) return "error";
			$epoch=$epoch+334;break;
	}
	$epoch=$epoch+$day;
	$epoch_Y=sqrt(($birth_year-1970)*($birth_year-1970));
	$leapyear=round((($epoch_Y+2) / 4)-.5);
	if (($epoch_Y+2)%4==0)
	{// curent year is leapyear
		$leapyear--;
		if ($birth_year >1970 && $month>=3) $epoch=$epoch+1;
		if ($birth_year <1970 && $month<3) $epoch=$epoch-1;
	} else if ($month==2 && $day>28) return "error";//only 28 days in feb.
	//year
	if ($birth_year>1970)
		$epoch=$epoch+$epoch_Y*365-1+$leapyear;
	else
		$epoch=$epoch-$epoch_Y*365-1-$leapyear;
	return $epoch;
}
    $ya_user_email = strtolower($ya_user_email);

//     if (extension_loaded("gd") AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 1 OR $ya_config['usegfxcheck'] == 3)) {

    $user_regdate = date("M d, Y");
    if (!isset($stop)) {
        $datekey = date("F j");
        $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
        $code = substr($rcode, 2, $ya_config['codesize']);

        $new_password = md5($user_password);
        $ya_username = ya_fixtext($ya_username);
        $ya_user_email = ya_fixtext($ya_user_email);
        $realname = ya_fixtext($realname);
// menelaos: I see no use for the next line. It's better to leave it empty so we can ask users later on to fill in the field
//      if($realname == "") { $realname = $ya_username; }
        $femail = ya_fixtext($femail);
        $user_website = check_html($user_website);
        if (!eregi("http://", $user_website) AND $user_website != "") { $user_website = "http://$user_website"; }
        $bio = str_replace("<br>", "\r\n", $bio);
        $bio = ya_fixtext($bio);
        $user_sig = str_replace("<br>", "\r\n", $user_sig);
        $user_sig = ya_fixtext($user_sig);
        $user_icq = ya_fixtext($user_icq);
        $user_aim = ya_fixtext($user_aim);
        $user_yim = ya_fixtext($user_yim);
        $user_msnm = ya_fixtext($user_msnm);
        $user_occ = ya_fixtext($user_occ);
        $user_from = ya_fixtext($user_from);
// Start add - Birthday MOD
        $b_day = ya_fixtext($b_day);
        $b_md = ya_fixtext($b_md);
        $b_year = ya_fixtext($b_year);
// End add - Birthday MOD
        $user_interests = ya_fixtext($user_interests);
        $user_gender = ya_fixtext($gender);
        $user_dateformat = ya_fixtext($user_dateformat);
        $newsletter = intval($newsletter);
        $user_viewemail = intval($user_viewemail);
        $user_allow_viewonline = intval($user_allow_viewonline);
        $user_timezone = intval($user_timezone);
        list($newest_uid) = $db->sql_fetchrow($db->sql_query("SELECT max(user_id) AS newest_uid FROM ".$user_prefix."_users"));
        if ($newest_uid == "-1") { $new_uid = 1; } else { $new_uid = $newest_uid+1; }
        $lv = time();
        $result = $db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, name, username, user_email, user_avatar, user_regdate, user_viewemail, user_password, user_lang, user_lastvisit) VALUES ($new_uid, '$ya_username', '$ya_username', '$ya_user_email', 'gallery/blank.gif', '$user_regdate', '0', '$new_password', '$language', '$lv')");
       
		if ((count($nfield) > 0) AND ($result)) {
          foreach ($nfield as $key => $var) { 
  		    $db->sql_query("INSERT INTO ".$user_prefix."_cnbya_value (uid, fid, value) VALUES ('$new_uid', '$key','$nfield[$key]')");				
		  }
		}	   
// Start add - Birthday MOD
	if ($b_day || $b_md || $b_year) //if a birthday is submited, then validate it
	{
		$user_age=(date('md')>=$b_md.(($b_day <= 9) ? '0':'').$b_day) ? date('Y') - $b_year : date('Y') - $b_year - 1 ;

			$birthday = ($error) ? $birthday : mkrealdate($b_day,$b_md,$b_year);
			$next_birthday_greeting = (date('md')<$b_md.(($b_day <= 9) ? '0':'').$b_day) ? date('Y'):date('Y')+1 ;
	} else
	{
		$birthday = 999999;
	}
// End add - Birthday MOD
	$db->sql_query("LOCK TABLES ".$user_prefix."_users WRITE");
	$db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, user_avatar, user_avatar_type, user_lang, user_lastvisit, umode) VALUES ($new_uid, 'gallery/blank.gif', '3', '$language', '$lv', 'nested')");

	$db->sql_query("UPDATE ".$user_prefix."_users SET username='$ya_username', name='$realname', user_email='$ya_user_email', femail='$femail', user_website='$user_website', user_icq='$user_icq', user_aim='$user_aim', user_yim='$user_yim', user_msnm='$user_msnm', user_from='$user_from', user_occ='$user_occ', user_interests='$user_interests', newsletter='$newsletter', user_viewemail='$user_viewemail', user_allow_viewonline='$user_allow_viewonline', user_timezone='$user_timezone', user_dateformat='$user_dateformat', user_sig='$user_sig', bio='$bio', user_password='$new_password', user_regdate='$user_regdate',user_gender='$user_gender',user_birthday='$birthday', user_next_birthday_greeting='$next_birthday_greeting' WHERE user_id='$new_uid'");

	$db->sql_query("UNLOCK TABLES");

	if(!$result) {
		OpenTable();
		echo ""._ADDERROR."<br>CODE: 03";
		CloseTable();
	} else {
/*****[BEGIN]************** Initial Usergroup - sgtmudd ********************************/
				// get initial user group id
	            $result = $db->sql_query("SELECT config_value FROM ".$user_prefix."_bbconfig WHERE config_name='initial_group_id'");
                $row = $db->sql_fetchrow($result);
                $initialusergroup = $row[0];
				if ($initialusergroup == NULL)
         	   (
     	       		die("GENERAL_ERROR, 'Error getting initial group information. Are you SURE you have an initial user group defined?', '', __LINE__, __FILE__, $sql")
//     	       message_die(GENERAL_ERROR, 'Error getting initial group information. Are you SURE you have an initial user group defined?', '', __LINE__, __FILE__, $sql)
     	       );
                if ($initialusergroup != 0)
				// insert user into bbuser_group table
                $db->sql_query("INSERT INTO ".$user_prefix."_bbuser_group (group_id, user_id, user_pending) VALUES ('$initialusergroup', $new_uid, '0')");
/*****[END]**************** Initial Usergroup - sgtmudd ********************************/
/*****[BEGIN]*********** Personal User Usergroup - sgtmudd *****************************/
          { 
         $sql2 = "SELECT MAX(group_id) AS total 
            FROM ".$user_prefix."_bbgroups"; 
         if ( !($result2 = $db->sql_query($sql2)) ) 
         { 
            die('Could not obtain next group_id information'); 
         } 

         if ( !($row2 = $db->sql_fetchrow($result2)) ) 
         { 
            die('Could not obtain next group_id information'); 
         } 
         $group_id = $row2['total'] + 1; 

         $sql3 = "INSERT INTO ".$prefix."_bbgroups (group_id, group_name, group_description, group_single_user, group_moderator, user_id) 
            VALUES ($group_id, '', 'Personal User', 1, 2, $new_uid)"; 
         if ( !($result3 = $db->sql_query($sql3, BEGIN_TRANSACTION)) ) 
         { 
            die('Could not insert data into groups table'); 
         }

        $sql4 = "INSERT INTO ".$user_prefix."_bbuser_group (group_id, user_id, user_pending) 
            VALUES ($group_id, $new_uid, 0)"; 
         if( !($result4 = $db->sql_query($sql4, END_TRANSACTION)) ) 
         { 
            die('Could not insert data into user_group table'); 
         }
		 }
/*****[END]************* Personal User Usergroup - sgtmudd *****************************/
		if ($ya_config['servermail'] == 0) {
                $message = _WELCOMETO." $sitename ($nukeurl)!\r\n\r\n";
                $message .= _YOUUSEDEMAIL." $ya_user_email "._TOREGISTER." $sitename.\r\n\r\n";
                $message .= _FOLLOWINGMEM."\r\n"._UNICKNAME." $ya_username\r\n"._UPASSWORD." $user_password";
                $subject = _REGISTRATIONSUB;
                $from  = "From: $adminmail\r\n";
                $from .= "Reply-To: $adminmail\r\n";
                $from .= "Return-Path: $adminmail\r\n";
                mail($ya_user_email, $subject, $message, $from);
            }
            title(_USERREGLOGIN);
            OpenTable();
            $result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$ya_username' AND user_password='$new_password'");
            if ($db->sql_numrows($result) == 1) {
                $userinfo = $db->sql_fetchrow($result);
                yacookie($userinfo[user_id],$userinfo[username],$userinfo[user_password],$userinfo[storynum],$userinfo[umode],$userinfo[uorder],$userinfo[thold],$userinfo[noscore],$userinfo[ublockon],$userinfo[theme],$userinfo[commentmax]);
// menelaos: i wonder if this cookie is set correctly
// menelaos: refresh of location? The next line causes multiple accounts to be loaded into the database, this has to be fixed
//              echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=/modules.php?name=$module_name\">";
                echo "<center>"._ACTMSG2."</center>";
            } else {
                echo "<center>"._SOMETHINGWRONG."</center><br>";
            }
            CloseTable();
            if ($ya_config['sendaddmail'] == 1 AND $ya_config['servermail'] == 0) {
                $from  = "From: $ya_user_email\r\n";
                $from .= "Reply-To: $ya_user_email\r\n";
                $from .= "Return-Path: $ya_user_email\r\n";
                $subject = "$sitename - "._MEMADD;
                $from_ip = $nsnst_const['remote_ip'];
                $message = "$ya_username has been added to $sitename. from $from_ip\r\n";
                $message .= "-----------------------------------------------------------\r\n";
                $message .= _YA_NOREPLY;
                mail($adminmail, $subject, $message, $from);
            }
        }
    } else {
        echo "$stop";
    }
    header("Refresh: 3; URL=index.php");
    include_once("footer.php");

?>
