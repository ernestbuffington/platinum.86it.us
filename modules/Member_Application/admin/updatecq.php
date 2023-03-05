<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   update child question/option in table
*	  run from			      :	  admin/addeditcq.php
*   file name           :   admin/updatecq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-20A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$fnm = isset($_POST['fnm']) ? trim($_POST['fnm']) : '';
$pqtxt = isset($_POST['edq']) ? trim($_POST['edq']) : '';
$fnam = isset($_POST['sqtxt']) ? trim($_POST['sqtxt']) : '';
$parent = isset($_POST['parent']) ? trim($_POST['parent']) : '';

if (isset($_POST['inuse']) ? trim($_POST['inuse']) : '')
{
  $iuse=1;
}
else
{
  $iuse=0;
}

$query = "UPDATE ".$prefix."_MA_mapp SET fldname='$fnam', inuse='$iuse' WHERE formno = $formno AND fldnum='$fnm'";
$result = $db->sql_query($query);
if(!$result)
{
  echo "ERROR - 20A1 - ".MA_UTUQTERROR."! <br>";
  exit();
}

$db->sql_freeresult($result);

echo "<form name='ref' method=POST action='".$admin_file.".php?op=MAaddeditcq'>";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$pqtxt."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$parent."\">";
echo "</form>";

?>

<script type="text/javascript" language="JavaScript"><!--
document.ref.submit();
//--></script>