<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   set application status
*	  run from			      :	  admin/applist.php
*   file name           :   admin/appstatus.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-9A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$appnum = isset($_POST['viewa']) ? trim($_POST['viewa']) : '';
$appstat = isset($_POST['apstat']) ? trim($_POST['apstat']) : '';
$sqla = "SELECT * FROM `".$prefix."_MA_mappresp` WHERE appnum = $appnum ORDER BY recno ASC";
if ( !($resulta = $db->sql_query($sqla)) )
{
  echo "ERROR - 9A1 - ".MA_UTORTERROR."! <br>";
  exit();
}
$rowa = $db->sql_fetchrow($resulta);
switch ($appstat)
{
  default : $appstatus = 0;
            break;
            
  case 0 :  $appstatus = 0;
            break;
            
  case 1 :  $appstatus = 1;
            break;
            
  case 2 :  $appstatus = 2;
            break;
}

$query = "UPDATE ".$prefix."_MA_mappresp SET appstatus='$appstatus' WHERE appnum = $appnum";
$result = $db->sql_query($query);
if (!$result)
{
  echo "ERROR - 9A2 - ".MA_UTURTERROR."! <br>";
  exit();
}
$sqlg1 = "SELECT * FROM `".$prefix."_MA_mapcfg` WHERE formno = $formno";
if ( !($resultg1 = $db->sql_query($sqlg1)) )
{
  echo "ERROR - 9A3 - ".MA_UTUCTERROR."! <br>";
  exit();
}
$rowg1 = $db->sql_fetchrow($resultg1);
$nug = $rowg1['group_add'];
$htmlmail = $rowg1['emhtml'];
$sqluid = "SELECT * FROM `".$prefix."_MA_mappresp` WHERE appnum = $appnum";
if ( !($resultuid = $db->sql_query($sqluid)) )
{
  echo "ERROR - 9A4 - ".MA_UTORTERROR."! <br>";
  exit();
}
$rowuid = $db->sql_fetchrow($resultuid);
$suid = $rowuid['userno'];
  
if (($rowg1['emuser']) && ($appstatus > 0))
{
  $sqluem = "SELECT * FROM `".$user_prefix."_users` WHERE user_id = $suid";
  if ( !($resultuem = $db->sql_query($sqluem)) )
  {
    echo "ERROR - 9A5 - ".MA_UATOUTERR."! <br>";
    exit();
  }
  $rowuem = $db->sql_fetchrow($resultuem);
  $suem = $rowuem['user_email'];
  $frmusr = $rowuem['username'];
  if ($appstatus == 1)
  {
    $emresp = $rowg1['denytxt'];
  }
  else
  {
    $emresp = $rowg1['approvtxt'];
  }
  $admin_email = $rowg1['admaddr'];

  $sject = $rowg1['formtitle']." for ".$frmusr." ".MA_RESPONSE;
  $from  = "From: $adminmail\r\n";
  $from .= "Reply-To: $adminmail\r\n";
  $from .= "Return-Path: $adminmail\r\n";
  if ($htmlmail) {
    $encode = 1;
    $from .= "Content-Type: text/html; charset=iso-8859-1\r\n";
    $message = str_replace("\n\r", "<br>", $message);
    $message = str_replace("\r\n", "<br>", $message);
    $message = str_replace("\n", "<br>", $message);
    $message = str_replace("&middot;", "*", $message);
  } else {
    $encode = 0;
    $from .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
    $message = str_replace("<br>", "\n\r", $message);
  }
  if (defined('PNM_IS_ACTIVE')) {
    phpnukemail($suem, $sject, $emresp, $adminmail, $adminmail, $encode);
  } else {
    mail($suem, $sject, $emresp, $from);
  }
}

if (($appstatus == 2) && ($rowg1['auto_group']))
{
  //** change user group here if they aren't already a member
  
  $sqlckg = "SELECT * FROM `".$prefix."_bbuser_group` WHERE group_id = $nug AND user_id = $suid";
  if ( !($resultckg = $db->sql_query($sqlckg)) )
  {
    echo "ERROR - 9A6 - ".MA_UATOGTERR."! <br>";
    exit();
  }
  echo mysql_error();
  $chkrws = $db->sql_numrows($resultckg);
  if (($chkrws<1) && (!($rowg1['annon'])))
  {
    $sqlsg = "INSERT INTO `".$prefix."_bbuser_group` (group_id,user_id,user_pending) VALUES ($nug,$suid,0)";
    if ( !($resultuid = $db->sql_query($sqlsg)) )
    {
      echo "ERROR - 9A7 - ".MA_UATAGRERR."! <br>";
      exit();
    }
    $rowuid = $db->sql_fetchrow($resultuid);
  }
}

echo "<form name='ref' METHOD=POST action='".$admin_file.".php?op=MAapplist' >";
echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"\">";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";

echo "</form>";
?>

<script type="text/javascript" language="JavaScript"><!--  
document.ref.submit();
//--></script>
