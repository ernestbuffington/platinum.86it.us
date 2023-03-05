<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   delete an application
*	  run from			      :	  admin/applist.php
*   file name           :   admin/delapp.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-10A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

echo "<form METHOD=POST action='".$admin_file.".php?op=MAapplist' >";
echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"\">";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";

$viewa = isset($_POST['viewa']) ? trim($_POST['viewa']) : '';
$vdate = isset($_POST['adate']) ? trim($_POST['adate']) : '';

//  ORDER by question order here and restrict by application date

$sqla = "SELECT * FROM `".$prefix."_MA_mappresp`,`".$prefix."_MA_mapp` WHERE ".$prefix."_MA_mappresp.formno = $formno AND ".$prefix."_MA_mappresp.qno = ".$prefix."_MA_mapp.fldnum AND ".$prefix."_MA_mappresp.appnum = $viewa ORDER BY ".$prefix."_MA_mapp.fldord ASC";
if ( !($resulta = $db->sql_query($sqla)) )
{
  echo "ERROR - 10A1 - ".MA_UTORTERROR."! <br>";
  exit();
}

$rowa = $db->sql_fetchrow($resulta);
$sqldel = "DELETE FROM `".$prefix."_MA_mappresp` WHERE formno = $formno AND appnum = $viewa ";
if ( !($resultdel = $db->sql_query($sqldel)) )
{
        echo "ERROR - 10A2 - ".MA_UATDAFDERR."! <br>";
  exit();
}

echo "<center>";
echo MA_APPNUMTXT." ".$rowa['appnum']." deleted.<BR>";

$db->sql_freeresult($resulta);
$db->sql_freeresult($resultdel);

echo "<INPUT TYPE=SUBMIT VALUE=\"Return\">";
echo "</form>";
echo "</center>";

?>