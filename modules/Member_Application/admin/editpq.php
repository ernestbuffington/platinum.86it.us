<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   admin input to edit a parent question
*	  run from			      :	  admin/listpq.php
*   file name           :   admin/editpq.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-12A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}
echo "<body onload='updFormElement1();'>";

$ecount = isset($_POST['ect']) ? trim($_POST['ect']) : '';
$sql = "SELECT * FROM `".$prefix."_MA_mapp` WHERE formno = $formno AND fldnum = ".$ecount." ORDER BY fldord";
if( !($result = $db->sql_query($sql)) )
{
  echo "ERROR - 12A1 - ".MA_UTOQTERROR."! <br>";
  exit();
}

if ( $row = $db->sql_fetchrow($result) )
{
  echo "<FORM NAME=\"frmQedit\" EDIT=\"qedit123\" METHOD=POST action='".$admin_file.".php?op=MAupdatepq' onLoad='updFormElement1();'>";
  echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"update\">";
  echo "<INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$ecount."\">";
  echo "<TABLE align=\"center\">";
  echo "  <TR>";
  echo "    <TD align=\"center\" colspan=\"2\">";
  $val = $row['fldnum'];
  echo "      ".MA_QUESTION." # $val";
  echo "      <br><br>"; 
  echo "      <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"".$row['fldnum']."\">";
  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "      ".MA_QUESTORD."";
  echo "    </TD>";
  echo "    <TD>";
  echo "      <INPUT TYPE=TEXT NAME=\"ford\" VALUE=\"".$row['fldord']."\" SIZE=2 MAXLENGTH=4 DISABLED>";
  echo "      <INPUT TYPE=HIDDEN NAME=\"ford\" value=\"".$row['fldord']."\">";
  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "      ".MA_QUESTION."";
  echo "    </TD>";
  echo "    <TD>";
  echo "      <TEXTAREA NAME=\"edq\" COLS=40 ROWS=6>".$row['fldname']."</TEXTAREA>";
  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "      ".MA_INUSE."";
  echo "    </TD>";
  echo "    <TD>";
  
  if ($row['inuse'])
  {
    echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\" CHECKED>";
  }
  else
  {
    echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\">";
  }

  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "      ".MA_REQUIRED."";
  echo "    </TD>";
  echo "    <TD>";

  if ($row['requrd'])
  {
    echo "      <INPUT TYPE=CHECKBOX NAME=\"rqrd\" id=\"rqrd\" CHECKED>";
  }
  else
  {
    echo "      <INPUT TYPE=CHECKBOX NAME=\"rqrd\" id=\"rqrd\">";
  }
  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "      ".MA_FORMAT."";
  echo "    </TD>";
  echo "    <TD>";
  
  // set selected type
  echo "      <SELECT NAME=\"frmat\" onChange='updFormElement1();'>";

  if ($row['format']=='L') 
  {
    echo "      <OPTION selected VALUE=\"L\">".MA_LABEL."";
  }
  else
  {
    echo "      <OPTION VALUE=\"L\">".MA_LABEL."";
  }

  if ($row['format']=='t') 
  {
    echo "      <OPTION selected VALUE=\"t\">".MA_ENTRY."";
  }
  else
  {
    echo "      <OPTION VALUE=\"t\">".MA_ENTRY."";
  }
  
    if ($row['format']=='v') 
  {
    echo "      <OPTION selected VALUE=\"v\">".MA_VALIDENTRY."";
  }
  else
  {
    echo "      <OPTION VALUE=\"v\">".MA_VALIDENTRY."";
  }

  if ($row['format']=='T')
  {
    echo "      <OPTION selected VALUE=\"T\">".MA_TEXTAREA."";
  }
  else
  {
    echo "      <OPTION VALUE=\"T\">".MA_TEXTAREA."";
  }
  
  if ($row['format']=='p') 
  {
    echo "      <OPTION selected VALUE=\"p\">".MA_PSWORD."";
  }
  else
  {
    echo "      <OPTION VALUE=\"p\">".MA_PSWORD."";
  }

  if ($row['format']=='c')
  {
    echo "      <OPTION selected VALUE=\"c\">".MA_CHECKBOX."";
  }
  else
  {
    echo "      <OPTION VALUE=\"c\">".MA_CHECKBOX."";
  }
	
  if ($row['format']=='b')
  {
    echo "      <OPTION selected VALUE=\"b\">".MA_CKBXLIST."";
  }
  else
  {
    echo "      <OPTION VALUE=\"b\">".MA_CKBXLIST."";
  }
	
  if ($row['format']=='l')
  {
    echo "      <OPTION selected VALUE=\"l\">".MA_DDLIST."";
  }
  else
  {
    echo "      <OPTION VALUE=\"l\">".MA_DDLIST."";
  }
	
  if ($row['format']=='r')
  {
    echo "      <OPTION selected VALUE=\"r\">".MA_RADIOBUTTONS."";
  }
  else
  {
    echo "      <OPTION VALUE=\"r\">".MA_RADIOBUTTONS."";
  }
	
  echo "      </SELECT>";
  echo "    </td>";
  echo "    <td>";
  echo "    </TD>";
  echo "  </TR>";
  echo "  <TR>";
  echo "    <TD width=\"100\">";
  echo "       <DIV name=\"regexl\" id=\"regexl\" style=\"display:none\">".MA_REGEXPRES."</DIV>";
  echo "       <DIV name=\"deftxtl\" id=\"deftxtl\" style=\"display:none\">".MA_DEFAULTTXT."</DIV>";
  echo "    </TD>";
  echo "    <TD name=\"regex\" id=\"regex\" style=\"display:none\">";
  echo "      <input type=\"text\" name=\"regextext\" id=\"regextext\" VALUE=\"".$row['rgextxt']."\" size=40 >";
  echo "    </TD>";
  echo "    <TD></TD>";
  echo "    </TR>";
  echo "</TABLE>";
  echo "<BR><BR>";
  echo "<center><INPUT TYPE=SUBMIT VALUE=\"".MA_UPDATE."\"></center>";
  echo "</form>";

  $db->sql_freeresult($result);
}

?>

<script language="javascript" type="">
function updFormElement1(){
  ElemValue = document.frmQedit.frmat.value;
  if (ElemValue == "v"){
    document.getElementById('deftxtl').style.display = "none";
    document.getElementById('regex').style.display = "";
    document.getElementById('regexl').style.display = "";
    document.getElementById('rqrd').style.display = "";
  } else {
    if (ElemValue == "t"){
      document.getElementById('regexl').style.display = "none";
      document.getElementById('regex').style.display = "";
      document.getElementById('deftxtl').style.display = "";
      document.getElementById('rqrd').style.display = "";
    } else {
      document.getElementById('regex').style.display = "none";
      document.getElementById('regexl').style.display = "none";
      document.getElementById('deftxtl').style.display = "none";
      document.getElementById('rqrd').style.display = "";
      if ((ElemValue == "L") || (ElemValue == "b")){
        document.getElementById('rqrd').style.display = "none";
        document.getElementById('rqrd').checked = false;
      } else {
        document.getElementById('rqrd').style.display = "";
      }
    }
  }
}
</script>