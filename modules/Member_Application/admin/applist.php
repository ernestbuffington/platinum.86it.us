<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   list applications
*	  run from			      :	  admin/main.php
*   file name           :   admin/applist.php
*-7A
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

$sqla = "SELECT * FROM `".$prefix."_MA_mappresp`,`".$user_prefix."_users` WHERE formno = $formno AND ".$prefix."_MA_mappresp.userno = ".$user_prefix."_users.user_id ORDER BY ".$prefix."_MA_mappresp.appnum DESC, ".$prefix."_MA_mappresp.adate DESC";

if ( !($resulta = $db->sql_query($sqla)) )
{
  echo "ERROR - 7A1 - ".MA_UTORTERROR."! <br>";
  exit();
}

echo "<table border=\"1\" align=\"center\">";
echo "  <TR>";
echo "    <TD colspan=\"6\" align=\"center\">";
echo "      <H3>".MA_APPLIST."</H3>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD align=\"center\">";
echo "      ".MA_APPNUM."";
echo "    </TD>";
echo "    <TD align=\"center\">";            
echo "      ".MA_APPLICANT."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_DATE."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_VIEW."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_STATUS."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_DELETE."";
echo "    </TD>";
echo "  </TR>";

$rowa = $db->sql_fetchrow($resulta);
if ($rowa)
{
  while ($rowa)
  {
    $capp = $rowa['appnum'];
    echo "  <TR>";
    echo "    <TD align=\"center\">";
    echo $rowa['appnum'];
    echo "    </TD>";
    echo "    <TD align=\"left\">";                
    echo $rowa['username'];
    echo "    </TD>";
    echo "    <TD align=\"center\">";
    echo $rowa['adate'];
    $cadate = $rowa['adate'];
    echo "    </TD>";
    echo "    <TD align=\"center\">";
    echo "      <form METHOD=POST action='".$admin_file.".php?op=MAviewapp' >";
    echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"adate\" value=\"".$cadate."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"viewa\" value=\"".$rowa['appnum']."\">";
    echo "      <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/mafile.gif\" ALT=\"".MA_VIEW."\" ALIGN=\"ABSMIDDLE\" NAME=\"enam\">";
    echo "    </TD>";
    echo "      </form>";

    echo "    <TD align=\"center\">";
    echo "      <form METHOD=POST action='".$admin_file.".php?op=MAappstatus' >";
    echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"adate\" value=\"".$cadate."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"viewa\" value=\"".$rowa['appnum']."\">";

    $apst = $rowa['appstatus'];
    echo "      <table align=\"center\">";
    echo "        <TR>";
    echo "          <TD align=\"center\">";
    if ($apst==0)
    {
      echo "          R<INPUT type=\"radio\" name=\"apstat\" CHECKED value=\"0\">";
    }
    else
    {
      echo "          R<INPUT type=\"radio\" name=\"apstat\" value=\"0\">";    
    }
    echo "          </TD>";
    echo "          <TD align=\"center\">";
    if ($apst==1)
    {
      echo "          D<INPUT type=\"radio\" name=\"apstat\" CHECKED value=\"1\">";
    }
    else
    {
      echo "          D<INPUT type=\"radio\" name=\"apstat\" value=\"1\">";    
    }
    echo "          </TD>";
    echo "          <TD align=\"center\">";
    if ($apst==2)
    {
      echo "          A<INPUT type=\"radio\" name=\"apstat\" CHECKED value=\"2\">";
    }
    else
    {
      echo "          A<INPUT type=\"radio\" name=\"apstat\" value=\"2\">";    
    }
    echo "          </TD>";
    echo "          <TD>";
    echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/madisk.gif\" ALT=\"".MA_UPDATE."\">";
    echo "          </TD>";
    echo "        </TR>";
    echo "      </table>";


/*
    switch ($rowa['appstatus'])
    {
      case 0 :  echo "<INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/maplus.gif\" ALT=\"Waiting\" NAME=\"enam\">";
                break;
                
      case 1 :  echo "<INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/maarrowdn.gif\" ALT=\"Decline\" NAME=\"enam\">";
                break;

      case 2 :  echo "<INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/mauparrow.gif\" ALT=\"Accept\" NAME=\"enam\">";
                break;
    }
*/
    echo "    </TD>";
    echo "      </form>";
    
    echo "    <TD align=\"center\">";
    echo "      <form METHOD=POST action='".$admin_file.".php?op=MAdelapp' >";
    echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"adate\" value=\"".$cadate."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"viewa\" value=\"".$rowa['appnum']."\">";
    echo "      <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/madelete.gif\" ALT=\"".MA_DELETE."\" ALIGN=\"ABSMIDDLE\" NAME=\"enam\">";
    echo "      </form>";
    echo "    </TD>";
    echo "  </TR>";
    while ($rowa['appnum'] == $capp)
    {
      $rowa = $db->sql_fetchrow($resulta);
    }
  }
}
else
{
  echo "  <TR>";
  echo "    <TD colspan=\"5\"align=\"center\">";
  echo "      ".MA_NOAPPSONFILE."";
  echo "    </TD>";
  echo "  </tr>";
}
 
echo "</table>";
echo "<BR /><BR />";

?>