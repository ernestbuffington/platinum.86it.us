<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   update parent question table
*	  run from			      :	  admin/editpq.php
*   file name           :   admin/updatepq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-21A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$onum = isset($_POST['ford']) ? trim($_POST['ford']) : '';
$fnm = isset($_POST['fnm']) ? trim($_POST['fnm']) : '';
$fnam = isset($_POST['edq']) ? trim($_POST['edq']) : '';

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
$rgextext = isset($_POST['regextext']) ? trim($_POST['regextext']) : '';

$query = "UPDATE ".$prefix."_MA_mapp SET fldord='$onum', fldname='$fnam', requrd='$rqd', inuse='$iuse', format='$fcod', rgextxt='$rgextext' WHERE formno = $formno AND fldnum='$fnm'";
$result = $db->sql_query($query);
if (!$result)
{
  echo "ERROR - 21A1 - ".MA_UTUQTERROR."! <br>";
  exit();
}

$db->sql_freeresult($result);

echo "<table align=\"center\">";
echo "  <tr>";
echo "    <td align=\"center\">";
echo "      ".MA_RECUPDATEDTXT."<BR><BR>";

if (($fcod == "l") || ($fcod == "r"))
{
  // we may want to switch this to an action rather than an include.
  echo "      <form METHOD=POST action='".$admin_file.".php?op=MAaddeditcq' >";
  echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  echo "      <INPUT TYPE=HIDDEN NAME=\"ford\" value=\"".$onum."\">";
  echo "      <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$fnm."\">";
  echo "      <INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$fnam."\">";
  echo "      <INPUT TYPE=HIDDEN NAME=\"frmat\" value=\"".$fcod."\">";
  echo "      <INPUT TYPE=SUBMIT VALUE=\"".MA_EDCHOITXT."\">";
  echo "      </form>";
  echo "    </td>";
  echo "  </tr>";
  echo "  <tr>"; 
  echo "    <td align=\"center\">";
}
  
echo "      <form name='ref' METHOD=POST action='".$admin_file.".php?op=MAlistpq' >";
echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "      </form>";
echo "    </td>";
echo "  </tr>";
echo "</table>";

?>

<script type="text/javascript" language="JavaScript"><!--
document.ref.submit();
//--></script>