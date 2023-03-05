<?php 
/**********************************************************************/
/* FOR USE UPGRADING Platinum Nuke v502 to Platinum Nuke Pro v1 ONLY! */
/**********************************************************************/
//*****  check users and user groups ****//
// URL to run: (http://yoursite.com/)modules.php?name=Forums&file=UpgradeGroups
if (!preg_match("#modules.php#i", $PHP_SELF)) {
    die ("You can't access this file directly...");
}
if (!isset($popup)){
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
}

define('IN_PHPBB', true);
include_once($phpbb_root_path . 'extension.inc'); 
include_once($phpbb_root_path . 'common.'.$phpEx); 
include_once('includes/functions_search.'.$phpEx); 

// Start session management 
$userdata = session_pagestart($user_ip, PAGE_SEARCH, $nukeuser); 
init_userprefs($userdata); 
// End session management 

$sql = "SELECT user_id, username 
    FROM " . USERS_TABLE ." 
    WHERE user_id > 0"; 
if ( !($result = $db->sql_query($sql)) ) 
{ 
    message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql); 
} 

$liste =''; 
while ( $row = $db->sql_fetchrow($result) ) 
{ 
   $username = $row['username']; 
   $user_id = $row['user_id']; 
   $usergroup = ''; 
/*  start */
/*   $sql1 = "SELECT ug.group_id 
          FROM " . USER_GROUP_TABLE ." ug, ". GROUPS_TABLE. " g  
          WHERE ug.user_id = $user_id 
            AND ug.group_id = g.group_id 
            AND g.group_single_user  = 0 
            "; 
              
   if ( ($result1 = $db->sql_query($sql1)) ) 
   { 
       $row1 = $db->sql_fetchrow($result1); 
          $usergroup =( ( $row1['group_id'] != '' ) ? $row1['group_id'] : 'User has no user group'.$row1 ); 
          
   } 
/*  end  */
          if (!($row1['group_id'] != '')) 
          { 
         $sql2 = "SELECT MAX(group_id) AS total 
            FROM " . GROUPS_TABLE; 
         if ( !($result2 = $db->sql_query($sql2)) ) 
         { 
            message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sq2l); 
         } 

         if ( !($row2 = $db->sql_fetchrow($result2)) ) 
         { 
            message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql2); 
         } 
         $group_id = $row2['total'] + 1; 

         $sql3 = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator, user_id) 
            VALUES ($group_id, '', 'Personal User', 1, 2, $user_id)"; 
         if ( !($result3 = $db->sql_query($sql3, BEGIN_TRANSACTION)) ) 
         { 
            message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql3); 
         }

        $sql4 = "INSERT INTO " . USER_GROUP_TABLE . " (group_id, user_id, user_pending) 
            VALUES ($group_id, $user_id, 0)"; 
         if( !($result4 = $db->sql_query($sql4, END_TRANSACTION)) ) 
         { 
            message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql4); 
         }
      
             $usergroup = $usergroup.', adding user group '.$group_id; 
          } 


   $liste .= ( ( $liste != '' ) ? '<br> ' : '' ) . $username.' <strong>'.$usergroup.'</strong>'; 
} 

message_die(GENERAL_MESSAGE,'Users:<br>'.$liste); 

?>