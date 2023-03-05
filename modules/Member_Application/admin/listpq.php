<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   parent question list 
*	  run from			      :	  admin/main.php
*   file name           :   admin/listpq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-14A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

echo "<table border=\"1\" align=\"center\">";
echo "  <TR>";
echo "    <TD align=\"center\">";
echo "      ".MA_QUESTION."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_ORDER."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_INUSE."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_REQUIRED."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_FORMAT."";
echo "    </TD>";
echo "    <TD align=\"center\">";
echo "      ".MA_EDIT."";
echo "    </TD>";
echo "  </TR>";

if ( $row = $db->sql_fetchrow($result) )
{
  $i=0;
  do
  {
    if (($row['parent']==0) && ($row['fldnum'] >0))
    {
      echo "  <TR>";
      $crow = $row['fldnum'];
      echo "    <TD>";
      $name = $row['fldname'];
      if ($name)
      {
        echo $name;
      }
      else
      {
        echo "&nbsp";
      }
      echo "    </TD>";
      echo "    <TD align=\"center\">";
      echo "      <table>";
      echo "        <tr>";
      echo "          <td>";
      echo "            <form METHOD=POST action='".$admin_file.".php?op=MAorderpq' >";
      echo              "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"order\">";
      $r = $row['fldord'];
      echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"direction\" value=\"1\">";
      echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/mauparrow.gif\" ALT=\"Up\" NAME=\"enam".$r."\">";
      echo "            </form>";
      echo "          </TD>";
      echo "          <TD>";
      echo "            <form METHOD=POST action='".$admin_file.".php?op=MAorderpq' >";
      echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"order\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"direction\" value=\"2\">";
      echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/maarrowdn.gif\" ALT=\"Down\" NAME=\"enam".$r."\">";
      echo "            </form>";
      echo "          </TD>";
      echo "        </TR>";
      echo "      </TABLE>";
      // echo $row['fldord'];
      echo "    </TD>";
      echo "    <TD align=\"center\">";
      
      if ($row['inuse'])
      {
        echo "      <INPUT TYPE=CHECKBOX NAME=\"mllist\" CHECKED DISABLED>";
      }
      else
      {
        echo "      <INPUT TYPE=CHECKBOX NAME=\"mllist\" DISABLED>";
      }
      
      echo "    </TD>";
      echo "    <TD align=\"center\">";

      if ($row['requrd'])
      {
        echo "      <INPUT TYPE=CHECKBOX NAME=\"mllst\" CHECKED DISABLED>";
      }
      else
      {
        echo "      <INPUT TYPE=CHECKBOX NAME=\"mllst\" DISABLED>";
      }
       
      echo "    </TD>";
      echo "    <TD align=\"center\">";

      switch ($row['format'])
      {
	default  :                   

	case "L" :
	  $frmtword = MA_LABEL;
	  break;

	case "t" :
	  $frmtword = MA_ENTRY;
	  break;
					  			
	case "v" :
	  $frmtword = MA_VALIDENTRY;
	  break;
					  			
	case "T" :
	  $frmtword = MA_TEXTAREA;
	  break;
									
	case "p" :
	  $frmtword = MA_PSWORD;
	  break;
					
	case "c" :
	  $frmtword = MA_CHECKBOX;
	  break;
					
	case "b" :
	  $frmtword = MA_CKBXLIST;
	  break;
					
	case "l" :
	  $frmtword = MA_DDLIST;
	  break;
		
        case "r" :
	  $frmtword = MA_RADIOBUTTONS;
	  break;
      }
	
      echo $frmtword;
      echo "    </TD>";
      echo "    <TD align=\"left\" width=\"48\">";
      echo "      <table>";
      echo "        <tr>";
      echo "          <td align=\"center\" width=\"16\">";
      echo "            <form METHOD=POST action='".$admin_file.".php?op=MAeditpq' >";
      echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"edit\">";
      // $r = $row['fldord'];
      echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$crow."\">";
      echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/maedit.gif\" ALT=\"Edit\" ALIGN=ABSMIDDLE NAME=\"enam".$crow."\">"; //HEIGHT=20 WIDTH=16 
      echo "            </form>";
      echo "          </td>";
      echo "          <td align=\"center\" width=\"16\">";
      echo "            <form METHOD=POST action='".$admin_file.".php?op=MAdeleteq' >";
      echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
      echo "            <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"del\">";
      // $r = $row['fldord'];
      echo "            <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$crow."\">";
      echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/madelete.gif\" ALT=\"Edit\" ALIGN=ABSMIDDLE NAME=\"enam".$crow."\">"; //HEIGHT=20 WIDTH=16 
      echo "            </form>";
	
      if (($row['format'] == "l") || ($row['format'] == "r")|| ($row['format'] == "b"))
      {
	echo "          </td>";
        echo "          <td align=\"center\" width=\"16\">";
	echo "            <form METHOD=POST action='".$admin_file.".php?op=MAaddeditcq' >";
  echo "            <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
	echo "            <INPUT TYPE=HIDDEN NAME=\"edq\" value=\"".$row['fldname']."\">";
	echo "            <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$crow."\">";
	echo "            <INPUT TYPE=HIDDEN NAME=\"frmat\" value=\"".$row['format']."\">";
	echo "            <INPUT TYPE=IMAGE SRC=\"modules/Member_Application/images/malist.gif\" ALT=\"Options\" ALIGN=ABSMIDDLE NAME=\"enam".$crow."\">"; 
	echo "            </form>";
      }
	
      echo "          </TD>";
      echo "        </TR>";
      echo "      </table>";
      echo "    </TD>";
      echo "  </TR>";
    } 
    
    $i++;
  } while (( $row = $db->sql_fetchrow($result) ) && ($i<$num_rows));

  $db->sql_freeresult($result);
}

echo "</table>";

echo "<table align=\"center\" width=\"100%\">";
echo "  <tr>";
echo "    <td align=\"center\">";
echo "      <form METHOD=POST action='".$admin_file.".php?op=MAaddpq' >";
echo "      <INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"add\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$r."\">";
echo "      <INPUT TYPE=HIDDEN NAME=\"crow\" value=\"".$crow."\">";
echo "      <INPUT TYPE=SUBMIT VALUE=\"".MA_ADDQ."\"></TD><TD>";
echo "      </form>";  
echo "    </td>";
echo "  </tr>";
echo "</table>";

$db->sql_freeresult($result);

?>