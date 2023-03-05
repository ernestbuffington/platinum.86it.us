<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   view a single application 
*	  run from			      :	  admin/applist.php
*   file name           :   admin/viewapp.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-22A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$viewa = isset($_POST['viewa']) ? trim($_POST['viewa']) : '';
$vdate = isset($_POST['adate']) ? trim($_POST['adate']) : '';

//  ORDER by question order here and restrict by application date

$sqla = "SELECT * FROM `".$prefix."_MA_mappresp`,`".$prefix."_MA_mapp`,`".$prefix."_MA_mapcfg`, `".$user_prefix."_users` WHERE ".$prefix."_MA_mappresp.formno = $formno AND ".$prefix."_MA_mapcfg.formno = $formno AND ".$prefix."_MA_mappresp.qno = ".$prefix."_MA_mapp.fldnum AND ".$prefix."_MA_mapp.parent = 0 AND ".$prefix."_MA_mappresp.appnum = $viewa AND ".$prefix."_MA_mappresp.userno = ".$user_prefix."_users.user_id ORDER BY ".$prefix."_MA_mapp.fldord ASC";
if ( !($resulta = $db->sql_query($sqla)) )
{
  echo "ERROR - 22A1 - ".MA_UTORTERROR."! <br>";
  exit();
}
$rowu = $db->sql_fetchrow($resulta);
echo "<form METHOD=POST action='".$admin_file.".php?op=MAapplist' >";
echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"\">";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "<table border=\"1\" align=\"center\" width=\"100%\" cellpadding = \"5%\" frame=\"void\" rules=\"rows\">";
echo "  <TR>";
echo "    <TD align=\"center\" colspan=\"2\" width = \"100%\">";
echo "      <H4>".$rowu['formtitle']." ".MA_NUMBER." ".$viewa." From ".$rowu['username']."</H4>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD align=\"center\" width = \"30%\">";
echo "      <H4>".MA_QUESTION."</H4>";
echo "    </TD>";
echo "    <TD align=\"left\" width = \"70%\">";
echo "      <H4>".MA_RESPONSE."</H4>";
echo "    </TD>";
echo "  </TR>";
if ( !($resulta = $db->sql_query($sqla)) )
{
  echo "ERROR - 22A2 - ".MA_UTORTERROR."! <br>";
  exit();
}

while ($rowa = $db->sql_fetchrow($resulta))
{
  if ($rowa['adate'] == $vdate)
  {
    echo "  <TR>";
    echo "    <TD align=\"center\" width = \"30%\">";
    echo $rowa['fldname'];
    echo "    </TD>";
    echo "    <TD align=\"left\" HEIGHT=\"100\" width = \"70%\">";
    $uresp = $rowa['response'];

    if (strlen($uresp)>80)
    {   
      echo "      <TEXTAREA name=\"bogustext\" rows=\"20\" cols=\"110\" readonly>".$uresp."</TEXTAREA>";
    }
    else
    {
      echo $rowa['response'];
    }



    $sqlc = "SELECT * FROM `".$prefix."_MA_mappresp`,`".$prefix."_MA_mapp`,`".$prefix."_MA_mapcfg`, `".$user_prefix."_users` WHERE ".$prefix."_MA_mappresp.formno = $formno AND ".$prefix."_MA_mapcfg.formno = $formno AND ".$prefix."_MA_mappresp.qno = ".$prefix."_MA_mapp.fldnum AND ".$prefix."_MA_mapp.parent = ".$rowa['fldnum']." AND ".$prefix."_MA_mapp.parent > 0 AND ".$prefix."_MA_mappresp.appnum = $viewa AND ".$prefix."_MA_mappresp.userno = ".$user_prefix."_users.user_id ORDER BY ".$prefix."_MA_mapp.fldord ASC";
    if ( ($resultc = $db->sql_query($sqlc)) )
    {
      while ($rowc = $db->sql_fetchrow($resultc))
      {
        if ($rowa['adate'] == $vdate)
        {
          echo "<BR>";
          echo $rowc['fldname'];
          echo "   ";
          echo $rowc['response'];
          echo "<BR>";
        }
      }
    }
    echo "    </TD>";
    echo "  </TR>";

  }
}

echo "</table>";
echo "<center><br><br><INPUT TYPE=SUBMIT VALUE=\"".MA_RETURN."\"><br><br></center>";
echo "</form>";

?>