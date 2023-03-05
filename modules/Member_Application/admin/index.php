<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*
*   file name           :   admin/index.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

if (!defined('NUKE_MODULES_DIR')) {
  define('NUKE_MODULES_DIR', "modules/" );
}

include_once(NUKE_MODULES_DIR . $module_name . "/version.php");

global $admin_file, $module_name, $prefix, $user_prefix, $db, $op, $adminmail;

$module_name = basename(dirname(dirname(__FILE__)));
$page_title = $lang['Member Application'];

require_once("mainfile.php");
include_once("header.php");
get_lang($module_name);

OpenTable();

echo "<title>Member Application V ".$MA_Version."</title>\n"
    ."<center><H3>Member Application V ".$MA_Version." ".MA_ADMINPANEL."</H3></center>";

//check for setup in database
if ((! $formno) && (! ($formck = isset($_POST['formno']) ? trim($_POST['formno']) : '')) && (! ($formck = isset($_GET['formno']) ? trim($_GET['formno']) : '')))
{
  $sql1 = "SELECT * FROM `".$prefix."_MA_mapcfg` ORDER BY formno ASC";
  if ( !($result1 = $db->sql_query($sql1)) )
  {
    $formno = -1;
  }
  else
  {
    $row1 = $db->sql_fetchrow($result1);
    $formno = $row1['formno'];
  }
}
else
{
  if ($formck = isset($_POST['formno']) ? trim($_POST['formno']) : '')
  {
    $formno = $formck;
  }
}
if ($formno == NULL) $formno = -1;
if ($formno >= 0)
{
  $sql1 = "SELECT * FROM `".$prefix."_MA_mapcfg` WHERE formno = $formno";
  if ( !($result1 = $db->sql_query($sql1)) )
  {
    echo "ERROR - I1 - ".MA_UATOCTERROR."! <br>";
    CloseTable();
    include_once("footer.php");
    exit();
  }
}
$row1 = $db->sql_fetchrow($result1);

$sql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE isdel < 1 AND formno = $formno ORDER BY fldord";
if ( !($result = $db->sql_query($sql)) )
{
  echo "ERROR - I3 - ".MA_UTOQTERROR."! <br>";
  CloseTable();
  include_once("footer.php");
  exit();
}

$num_rows = $db->sql_numrows($result);

// get operation desired

$i=0;

include_once(NUKE_MODULES_DIR.$module_name."/admin/main.php");
if ($formno == -1) $op = "MAnewform";
switch ($op)
{
  case "MAapplist":
    include_once(NUKE_MODULES_DIR.$module_name."/admin/applist.php");
    break;

  case "MAappstatus" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/appstatus.php");
    break;

  case "MAsetup" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/appsetup.php");
    break;

  case "MAlistpq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/listpq.php");
    break;

  case "MAaddpq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/addpq.php");
    break;

  case "MAinsertq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/insertq.php");
    break;

  case "MAviewapp" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/viewapp.php");
    break;

  case "MAconfig" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/maconfig.php");
    break;

  case "MAnewform" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/newform.php");
    break;

  case "MAeditpq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/editpq.php");
    break;

  case "MAupdatepq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/updatepq.php");
    break;

  case "MAorderpq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/orderpq.php");
    break;

  case "MAdelapp" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/delapp.php");
    break;

  case "MAaddeditcq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/addeditcq.php");
    break;

  case "MAordercq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/ordercq.php");
    break;

  case "MAupdatecq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/updatecq.php");
    break;

  case "MAdeleteq" :
    include_once(NUKE_MODULES_DIR.$module_name."/admin/deleteq.php");
    break;

  case "error" :
    echo "<br><br><h1>";
    echo "ERROR - I4 - ".MA_AUEHOERROR."! <br>";
    echo "</h1><br><br>";
    break;

  default :
    header('Location: '.$admin_file.'.php?op=MAsetup&formno=0');
    break;

}

echo "<table align='center' width='100%'>";
echo " <tr>";
echo "  <td align='center'>";
include_once(NUKE_MODULES_DIR . $module_name . "/copyright.php");
include_once(NUKE_MODULES_DIR . $module_name . "/admin/credits.php");
echo "    </td>";
echo "  </tr>";
echo "</table>";

CloseTable();

include_once("footer.php");

?>
