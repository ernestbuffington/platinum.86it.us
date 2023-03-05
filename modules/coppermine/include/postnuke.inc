<?php
if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');
define('IN_POSTNUKE', true);
define('LOGOUT_URL', "user.php?module=NS-User&op=logout");
define('LOGIN_URL', "user.php?module=NS-User&op=loginscreen");
define('NEWUSER_URL', "user.php?op=check_age&module=NS-NewUser");
define('ADDUSER_URL', "admin.php?module=NS-User&op=main");
define('USERPROF_URL', "user.php?op=edituser");
define('_HOME', "Home");
$ModName = $name;
//modules_get_language();
/* this is the postnuke function for getting language and it sucks
   function modules_get_language($script = 'global')
   {
      $currentlang = pnSessionGetVar('lang');
      $language = pnConfigGetVar('language');
      if (file_exists("modules/".pnVarPrepForOS($GLOBALS['ModName'])."/lang/".pnVarPrepForOS($currentlang)."/$script.php")) {
         @include "modules/".pnVarPrepForOS($GLOBALS['ModName'])."/lang/".pnVarPrepForOS($currentlang)."/$script.php";
      }
      elseif (!empty($language)) {
         if (file_exists("modules/".pnVarPrepForOS($GLOBALS['ModName'])."/lang/".pnVarPrepForOS($language)."/$script.php")) {
            @include "modules/".pnVarPrepForOS($GLOBALS['ModName'])."/lang/".pnVarPrepForOS($language)."/$script.php";
         }
      } else {
         @include "modules/".pnVarPrepForOS($GLOBALS['ModName'])."/lang/eng/$script.php";
      }
      return;
   }
*/
$field_user_id = "pn_uid";
$field_user_name = "pn_uname";
$field_user_pass = "pn_pass";
$field_user_email = "pn_email";
$field_user_from = "pn_user_from";
$field_user_avatar = "pn_user_avatar";
$field_user_regdate = "pn_user_regdate";
$user_prefix = $pnconfig['prefix'];
function title($title)
{
    OpenTable();
    echo "<center><font class=\"pn-pagetitle\">".$title."</font></center>";
    CloseTable();
}
class sql_db
{
    var $dbconn;
    var $query_result;
    //
    // Constructor
    //
    function sql_db() {
        list($this->dbconn) = pnDBGetConn();
    }
    function sql_query($query = "", $transaction = FALSE) {
        // Remove any pre-existing queries
        unset($this->query_result);
        if($query != "") {
            $this->query_result = $this->dbconn->Execute($query);
        }
        if($this->query_result) {
            return $this->query_result;
        }
        else {
            return ( $transaction == END_TRANSACTION ) ? true : false;
        }
    }
    function sql_fetchrow($query_id = 0)
    {
        if(!$query_id) {
            $query_id = $this->query_result;
        }
        if($query_id) {
            return $query_id->fields;
        }
        else {
            return false;
        }
    }
}
$db = new sql_db();
?>
