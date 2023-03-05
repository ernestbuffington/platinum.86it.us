<?php
if ( !defined('MODULE_FILE') )
{
   die("You can't access this file directly...");
}
define('IN_PHPBB', true);
$phpbb_root_path = 'modules/Forums/';
include_once($phpbb_root_path . 'extension.inc');
include_once($phpbb_root_path . 'common.'.$phpEx);
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX, $nukeuser);
init_userprefs($userdata);
//
// End session management
//

$gen_simple_header = TRUE; 
$page_title = $lang['Greeting_Messaging']; 
include_once('includes/page_header.'.$phpEx); 
$year=create_date('Y', time(), $board_config['board_timezone']);
$date_today = create_date('Ymd', time(), $board_config['board_timezone']);
$user_birthday=realdate("md",$userdata['user_birthday']); 
$user_birthday2=(($year.$user_birthday<$date_today)? $year+1:$year).$user_birthday; 
$l_greeting = ($user_birthday2==$date_today) ? 
	sprintf ( $lang['Birthday_greeting_today'], date('Y')-realdate('Y',$userdata['user_birthday']) ) :
	sprintf ( $lang['Birthday_greeting_prev'],  date('Y')-realdate('Y',$userdata['user_birthday']) , realdate(str_replace('Y','',$lang['DATE_FORMAT']),$userdata['user_birthday']) ); 
$template->set_filenames(array( 
      'body' => 'greeting_popup.tpl')); 
$template->assign_vars(array( 
      'L_CLOSE_WINDOW' => $lang['Close_window'], 
      'L_MESSAGE' => $l_greeting )); 
$template->pparse('body'); 
include_once('includes/page_tail.'.$phpEx); 

?>
