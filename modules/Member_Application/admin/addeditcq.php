<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   admin input to add a child question or option
*	  run from			      :	  admin/listpq.php, insertq.php
*   file name           :   admin/addeditcq.php
*-5A
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

$fnm = isset($_POST['fnm']) ? trim($_POST['fnm']) : '';
$fnam = isset($_POST['edq']) ? trim($_POST['edq']) : '';
$fmat = isset($_POST['frmat']) ? trim($_POST['frmat']) : '';

//query here to get all answeres for this question.

$sqsql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE formno = $formno AND parent = ".$fnm." ORDER BY fldord";
if ( !($sqresult = $db->sql_query($sqsql)) )
{
  echo "ERROR - 5A1 - ".MA_UTOQTERROR."! <br>";
  exit();
}

echo "<center>$fnam<br><br></center>";

echo "<table border=\"1\" align=\"center\">";
echo "  <TR>";
/*
echo "    <TD align=\"center\">";
echo "      Record #";
echo "    </TD>";
*/
echo "    <TD align=\"center\">";
echo "      ".MA_CHOICE."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_INUSE."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_SAVE."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_ORDER."";
echo "    </TD>";
echo "  </TR>";

if ( $sqrow = $db->sql_fetchrow($sqresult) )
{
  $i=0;
  do
  {
    echo "  <TR>";
/*
    echo "    <TD align=\"center\">";
    echo $sqrow['fldnum'];
    echo "    </TD>";
*/
    echo "    <TD align=\"left\">";
    $r = $sqrow['fldord'];
    $p = $sqrow['parent'];
    echo "      <form METHOD=POST action='".$admin_file.".php?op=MAupdatecq' >";
    echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$fnam."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$sqrow['fldnum']."\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"parent\" value=\"".$p."\">";
    echo "      <INPUT NAME=\"sqtxt\" value=\"".$sqrow['fldname']."\">";
    // echo $sqrow['fldname'];
    echo "    </TD>";
    echo "    <TD align=\"center\">";
    
    if ($sqrow['inuse'])
    {
      echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\" CHECKED>";
    }
    else
    {
      echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\">";
    }

    echo "    </TD>";
    echo "    <TD align=\"center\">";
    echo "      <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"MAupdatecq\">";
    $r = $sqrow['fldord'];
    echo "      <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
    echo "      <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/madisk.gif\" ALT=\"".MA_EDIT."\" ALIGN=ABSMIDDLE NAME=\"enam".$r."\">";
    echo "      </form>";
    echo "    </TD>";
    echo "    <TD align=\"center\">";
    echo "      <table>";
    echo "        <tr>";
    echo "          <td align=\"center\">";
    echo "            <form METHOD=POST action='".$admin_file.".php?op=MAordercq' >";
    echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"sqorder\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"parent\" value=\"".$p."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"direction\" value=\"1\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$fnam."\">";
    echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/mauparrow.gif\" ALT=\"".MA_UP."\" NAME=\"enam".$r."\">";
    echo "            </form>";
    echo "          </TD>";
    echo "          <TD align=\"center\">";
    echo "            <form METHOD=POST action='".$admin_file.".php?op=MAordercq' >";
    echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"parent\" value=\"".$p."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"sqorder\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
    echo "            <INPUT TYPE=HIDDEN NAME=\"direction\" value=\"2\">";
    echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/maarrowdn.gif\" ALT=\"".MA_DOWN."\" NAME=\"enam".$r."\">";
    echo "            </form>";
    echo "          </TD>";
    echo "        </TR>";
    echo "      </TABLE>";
    echo "    </TD>";
    echo "  </TR>";

    $i++;
  } while (( $sqrow = $db->sql_fetchrow($sqresult) ) && ($i<$num_rows));
}

$r++;

echo "  <form METHOD=POST action='".$admin_file.".php?op=MAinsertq' >";
echo "  <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "  <TR>";
/*
echo "    <TD align=\"center\">";
echo "      Enter Choice";
echo "    </TD>";
*/
echo "    <TD align=\"center\">";
echo "      <INPUT NAME=\"edq\">";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"ptxt\" value=\"".$fnam."\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"parent\" value=\"".$fnm."\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"-1\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"ford\" value=\"".$r."\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"add\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"frmat\" value=\"".$fmat."\">";
echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\">";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/madisk.gif\" ALT=\"".MA_ADD."\" ALIGN=ABSMIDDLE NAME=\"Add\">";
echo "    </TD>";
echo "    </form>";
echo "    <TD align=\"center\">";
echo "      ".MA_NEW."";
echo "    </TD>";
echo "  </TR>";
echo "</table>";
echo "<table align=\"center\">";
echo "  <tr>";
echo "    <td>";
echo "<center><I>".MA_VALIDCHILDEDIT." <img src=\"modules/Member_Application/images/madisk.gif\"> .</I></center>";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td valign=\"top\">";
echo "      <form METHOD=POST action='".$admin_file.".php?op=MAlistpq' >";
echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\"><center>";
echo "      <INPUT TYPE=SUBMIT VALUE=\"".MA_RETURN."\"></center></TD><TD>";
echo "      </form>";
echo "    </td>";
echo "  </tr>";
echo "</table>";

$db->sql_freeresult($sqresult);

?>