<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   insert a question into the MA_mapp table
*	  run from			      :	  admin/addpq.php, admin/addeditcq.php
*   file name           :   admin/insertq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-13A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$parent = 0;
$ptxt = isset($_POST['ptxt']) ? trim($_POST['ptxt']) : '';
$parent = isset($_POST['parent']) ? trim($_POST['parent']) : '';
$onum = isset($_POST['ford']) ? trim($_POST['ford']) : '';
$fnm = isset($_POST['fnm']) ? trim($_POST['fnm']) : '';
$fnam = isset($_POST['edq']) ? trim($_POST['edq']) : '';
$rgextext = isset($_POST['regextext']) ? trim($_POST['regextext']) : '';

if (isset($_POST['rqrd']) ? trim($_POST['rqrd']) : '')
{
  $rqd=1;
}
else
{
  $rqd=0;
}

if (isset($_POST['inuse']) ? trim($_POST['inuse']) : '')
{
  $iuse=1;
}
else
{
  $iuse=0;
}

$fcod = isset($_POST['frmat']) ? trim($_POST['frmat']) : '';
$query = "INSERT INTO ".$prefix."_MA_mapp (`fldnum`, `formno`, `fldord`, `fldname`, `requrd`, `inuse`, `format`, `parent`, `rgextxt`) VALUES ('','$formno', '$onum', '$fnam', '$rqd', '$iuse', '$fcod', '$parent','$rgextext')";
$result = $db->sql_query($query);
if (!$result)
{
  echo "ERROR - 13A1 - ".MA_UTOQTERROR."! <br>";
  exit();
}

$db->sql_freeresult($result);
$query = "SELECT * FROM `".$prefix."_MA_mapp` WHERE fldnum = LAST_INSERT_ID()";
$result = $db->sql_query($query);
if (!$result)
{
  echo "ERROR - 13A2 - ".MA_UTOQTERROR."! <br>";
  exit();
}

if ( $gprow = $db->sql_fetchrow($result) )
{
  $parentgp = $gprow['fldnum'];
}

//	get last question inserted number here

$db->sql_freeresult($result);

if ($parent>0)
{
  echo "<form name='ref' method=POST action='".$admin_file.".php?op=MAaddeditcq'>";
  echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$ptxt."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$parent."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"frmat\" value=\"".$fcod."\">";
}
else
{
  if (($fcod == "l") || ($fcod == "r") || ($fcod == "b"))
  {
    echo "<form name='newopt' METHOD=POST action='".$admin_file.".php?op=MAaddeditcq' >";
    echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$fnam."\">";
    echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$parentgp."\">";
    echo "<INPUT TYPE=HIDDEN NAME=\"frmat\" value=\"".$fcod."\">";
  }
  else
  {
    echo "<form name='ref' METHOD=POST action='".$admin_file.".php?op=MAlistpq' >";
    echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"\">";
    echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  }
}

echo "</form>";
?>

<script type="text/javascript" language="JavaScript"><!--  
document.ref.submit();
//--></script>
<script type="text/javascript" language="JavaScript"><!--
document.newopt.submit();
//--></script>