<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   mark a question as deleted
*	  run from			      :	  admin/listpq.php
*   file name           :   admin/deleteq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-11A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{ 
  die ("Access Denied");
}

$fnm = isset($_POST['ect']) ? trim($_POST['ect']) : '';

$query = "UPDATE ".$prefix."_MA_mapp SET isdel=1 WHERE formno = $formno AND fldnum='$fnm'";
$result = $db->sql_query($query);
if (!$result)
{
  echo "ERROR - 11A1 - ".MA_UATDQFDERR."! <br>";
  exit();
}

echo "<form name='ref' method=POST action='".$admin_file.".php?op=MAlistpq'>";
echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$pqtxt."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$parent."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "</form>";

?>

<script type="text/javascript" language="JavaScript"><!--
document.ref.submit();
//--></script>