<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   set MA configuration in mapcfg table
*	  run from			      :	  admin/appsetup.php
*   file name           :   admin/maconfig.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-15A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$atxt = isset($_POST['edcfg']) ? trim($_POST['edcfg']) : '';
if (get_magic_quotes_gpc()) {
   $atxt = stripslashes($atxt);
}
// Quote if not integer
if (!is_numeric($atxt)) {
   $atxt = mysql_real_escape_string($atxt);
}
$tytxt = isset($_POST['edtytxt']) ? trim($_POST['edtytxt']) : '';
if (get_magic_quotes_gpc()) {
   $tytxt = stripslashes($tytxt);
}
// Quote if not integer
if (!is_numeric($tytxt)) {
   $tytxt = mysql_real_escape_string($tytxt);
}
$formtitle = isset($_POST['formtitle']) ? trim($_POST['formtitle']) : '';
if (get_magic_quotes_gpc()) {
   $formtitle = stripslashes($formtitle);
}
// Quote if not integer
if (!is_numeric($formtitle)) {
   $formtitle = mysql_real_escape_string($formtitle);
}
$etxt = isset($_POST['admad']) ? trim($_POST['admad']) : '';
$natxt = isset($_POST['noapptxt']) ? trim($_POST['noapptxt']) : '';
if (get_magic_quotes_gpc()) {
   $natxt = stripslashes($natxt);
}
// Quote if not integer
if (!is_numeric($natxt)) {
   $natxt = mysql_real_escape_string($natxt);
}
$apprtxt = isset($_POST['apprtxt']) ? trim($_POST['apprtxt']) : '';
if (get_magic_quotes_gpc()) {
   $apprtxt = stripslashes($apprtxt);
}
// Quote if not integer
if (!is_numeric($apprtxt)) {
   $apprtxt = mysql_real_escape_string($apprtxt);
}
$denytxt = isset($_POST['denytxt']) ? trim($_POST['denytxt']) : '';
if (get_magic_quotes_gpc()) {
   $denytxt = stripslashes($denytxt);
}
// Quote if not integer
if (!is_numeric($denytxt)) {
   $denytxt = mysql_real_escape_string($denytxt);
}
$forumno = isset($_POST['forumno']) ? trim($_POST['forumno']) : '';
$lastform = isset($_POST['lastform']) ? trim($_POST['lastform']) : '';
$revgroupno = isset($_POST['revgroupno']) ? trim($_POST['revgroupno']) : '';
$accgroupno = isset($_POST['accgroupno']) ? trim($_POST['accgroupno']) : '';

if (isset($_POST['emhtml']) ? trim($_POST['emhtml']) : '')
{
  $emhtml=1;
}
else
{
  $emhtml=0;
}

if (isset($_POST['detail']) ? trim($_POST['detail']) : '')
{
  $emd=1;
}
else
{
  $emd=0;
}
if (isset($_POST['emuser']) ? trim($_POST['emuser']) : '')
{
  $emuser=1;
}
else
{
  $emuser=0;
}


if (isset($_POST['mailgroup']) ? trim($_POST['mailgroup']) : '')
{
  $emgrp=1;
}
else
{
  $emgrp=0;
}
if (isset($_POST['watchtopic']) ? trim($_POST['watchtopic']) : '')
{
  $setwt=1;
}
else
{
  $setwt=0;
}


if (isset($_POST['grpset']) ? trim($_POST['grpset']) : '')
{
  $fpd=1;
}
else
{
  $fpd=0;
}

if (isset($_POST['appslimit']) ? trim($_POST['appslimit']) : '')
{
  $appslimit=1;
}
else
{
  $appslimit=0;
}

if (isset($_POST['blkmultiapps']) ? trim($_POST['blkmultiapps']) : '')
{
  $blkmultiapps=1;
}
else
{
  $blkmultiapps=0;
}

if (isset($_POST['emailadmin']) ? trim($_POST['emailadmin']) : '')
{
  $emailadmin=1;
}
else
{
  $emailadmin=0;
}

if (isset($_POST['autogroup']) ? trim($_POST['autogroup']) : '')
{
  $autogroup=1;
}
else
{
  $autogroup=0;
}

if (isset($_POST['anonappsok']) ? trim($_POST['anonappsok']) : '')
{
  $anonappsok=1;
}
else
{
  $anonappsok=0;
}

if (isset($_POST['listforms']) ? trim($_POST['listforms']) : '')
{
  $listforms=1;
}
else
{
  $listforms=0;
}

if (isset($_POST['vertalign']) ? trim($_POST['vertalign']) : '')
{
  $vertalign=1;
}
else
{
  $vertalign=0;
}

if (isset($_POST['ecompat']) ? trim($_POST['ecompat']) : '')
{
  $ecompat=1;
}
else
{
  $ecompat=0;
}

$sqlac = "SELECT DISTINCT appnum FROM `".$prefix."_MA_mappresp` WHERE formno = $formno";
$resultac = $db->sql_query($sqlac);
$ac = $db->sql_numrows($resultac);

if (isset($_POST['appslimitno']) ? trim($_POST['appslimitno']) : '')
{
  $appslimitnotxt = isset($_POST['appslimitno']) ? trim($_POST['appslimitno']) : '';
}
else
{
  $appslimitnotxt = 0;
}

if ($appslimitnotxt > $ac)
{
  $appsfull = 0;
}
else
{
  $appsfull = 1;
}
if ($formno<0)
{
   $query = "INSERT INTO ".$prefix."_MA_mapcfg ( `current`, `formno`, `formtitle`, `apptxt`, `admaddr`, `emdetail`, `fpdetail`, `group_id`, `forum_id`, `tytxt`, `noapptxt`, `appslimit`, `appslimitno`, `appsfull`, `group_add`, `block_multi_apps`, `email_admin`, `mailgroup`, `topicwatch`, `emuser`, `annon`, `VertAlign`, `auto_group`, `approvtxt`, `denytxt`, `formlist`, `compat`, `emhtml`) VALUES ('0', '$lastform', '$formtitle', '$atxt', '$etxt', '$emd', '$fpd','$revgroupno','$forumno','$tytxt','$natxt','$appslimit','$appslimitnotxt','$appsfull','$accgroupno','$blkmultiapps','$emailadmin','$emgrp','$setwt','$emuser','$anonappsok', '$vertalign','$autogroup','$apprtxt','$denytxt','$listforms','$ecompat', '$emhtml')";
}
else
{
  $query = "UPDATE ".$prefix."_MA_mapcfg SET formtitle='$formtitle', apptxt='$atxt', admaddr='$etxt', emdetail='$emd', fpdetail='$fpd', appslimit='$appslimit', appslimitno='$appslimitnotxt', tytxt='$tytxt', noapptxt='$natxt', appsfull='$appsfull', forum_id='$forumno', group_id='$revgroupno', group_add='$accgroupno', block_multi_apps='$blkmultiapps', email_admin='$emailadmin', mailgroup='$emgrp', topicwatch='$setwt', emuser='$emuser', annon='$anonappsok', VertAlign='$vertalign', auto_group='$autogroup', approvtxt='$apprtxt', denytxt='$denytxt', formlist='$listforms', compat='$ecompat', emhtml='$emhtml' WHERE formno = $formno";
}
$result = $db->sql_query($query);
if (!$result)
{
  echo "<BR>".$query."<BR>";
  echo "<BR>".mysql_error()."<BR>";
  echo "ERROR - 15A1 - ".MA_UTUCTERROR."! <br>";
  exit();
}

$db->sql_freeresult($result);

echo "<table align=\"center\">";
echo "  <tr>";
echo "    <td align=\"center\">";
echo "      <form name='ref' method=POST action='".$admin_file.".php?op=MAsetup'>";
if ($formno<0)
{
  echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$lastform."\">";
  
}
else
{
  echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
}
echo "      </form>";
echo "    </td>";
echo "  </tr>";
echo "</table>";

?>

<script type="text/javascript" language="JavaScript"><!--
document.ref.submit();
//--></script>