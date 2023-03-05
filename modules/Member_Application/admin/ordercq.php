<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   change order of parent questions
*	  run from			      :	  admin/addeditcq.php
*   file name           :   admin/ordercq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-18A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}
	
$pnum = isset($_POST['parent']) ? trim($_POST['parent']) : '';
$pqtxt = isset($_POST['edq']) ? trim($_POST['edq']) : ''; 
$onum = isset($_POST['ect']) ? trim($_POST['ect']) : '';
$mdir = isset($_POST['direction']) ? trim($_POST['direction']) : '';

if ($mdir==1)
{
  $mydir = -1;
  $stoprow = $onum-1;
}
else
{
  $mydir = 1;
  $stoprow = $onum;
}

$sqlo = "SELECT * FROM `".$prefix."_MA_mapp` WHERE formno = $formno AND parent = ".$pnum." ORDER BY fldord ASC";
if( !($resulto = $db->sql_query($sqlo)) )
{
  echo "ERROR - 18A1 - ".MA_UTOQTERROR."! <br>";
  exit();
}

$num_rowso = $db->sql_numrows($resulto);
if ((($onum<1) && ($mydir < 0)) || (($onum >= ($num_rowso)) && ($mydir > 0)))
{
  echo "<form name='ref' method=POST action='".$admin_file.".php?op=MAaddeditcq'>";
  echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$pqtxt."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$pnum."\">";
  echo "</form>";
}  
else
{  
  while (($rowo = $db->sql_fetchrow($resulto))&&($rowo['fldord'] <> $stoprow))
  {
  }

  if ($rowo['fldord'] == $stoprow)
  {
    if ($mydir < 0)
    {
      $movrownum = $rowo['fldnum'];
      $rowo = $db->sql_fetchrow($resulto);
      $currownum = $rowo['fldnum'];
    }
    else
    {
      $currownum = $rowo['fldnum'];
      $rowo = $db->sql_fetchrow($resulto);
      $movrownum = $rowo['fldnum'];
      $stoprow++;
    }
  }   

  $dirc = $mdir;
  $curord = $onum;
  $queryo = "UPDATE ".$prefix."_MA_mapp SET fldord='$onum' WHERE formno = $formno AND fldnum='$movrownum' LIMIT 1";
  $resulto = $db->sql_query($queryo);
  if (!$resulto)
  {
    echo "ERROR - 18A2 - ".MA_UTUQTERROR."! <br>";
    exit();
  }

  $db->sql_freeresult($resulto);

  $queryou = "UPDATE ".$prefix."_MA_mapp SET fldord='$stoprow' WHERE formno = $formno AND fldnum='$currownum' LIMIT 1";
  $resultou = $db->sql_query($queryou);
  if (!$resultou)
  {
    echo "ERROR - 18A3 - ".MA_UTUQTERROR."! <br>";
    exit();
  }
	
  $db->sql_freeresult($resultou);

  echo "<form name='ref' method=POST action='".$admin_file.".php?op=MAaddeditcq'>";
  echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$pqtxt."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$pnum."\">";
  echo "</form>";
}

?>

<script type="text/javascript" language="JavaScript"><!--
document.ref.submit();
//--></script>