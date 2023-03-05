<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   add parent question
*	run from		    :	admin/listpq.php
*   file name           :   admin/addpq.php
*-6A
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
$ecount = isset($_POST['ect']) ? trim($_POST['ect']) : '';
$crow = isset($_POST['crow']) ? trim($_POST['crow']) : '';
echo "<body onload='updFormElement1();'>";
echo "<form name=\"frmQedit\" METHOD=POST action='".$admin_file.".php?op=MAinsertq' >";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"amode\" value=\"insert\">";
echo "<INPUT TYPE=HIDDEN NAME=\"ect\" value=\"".$ecount."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"".$formno."\">";
echo "<TABLE align=\"center\">";
echo "  <TR>";
echo "    <TD align=\"center\" colspan=\"2\">";
$val = $crow + 1;
echo "      ".MA_QUESTION." # $val";
echo "      <br><br>";
echo "      <INPUT TYPE=HIDDEN NAME=\"fnm\" value=\"-1\">";
$rn = ($ecount+1);
echo "      <INPUT TYPE=HIDDEN NAME=\"ford\" value=\"".$rn."\">";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD width=\"100\">";
echo "      ".MA_QUESTION."";
echo "    </TD>";
echo "    <TD>";
echo "      <TEXTAREA NAME=\"edq\" COLS=40 ROWS=6></TEXTAREA>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD width=\"100\">";
echo "      ".MA_INUSE."";
echo "    </TD>";
echo "    <TD>";
echo "      <INPUT TYPE=CHECKBOX NAME=\"inuse\" CHECKED>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD width=\"100\">";
echo "      ".MA_REQUIRED."";
echo "    </TD>";
echo "    <TD>";
echo "      <INPUT TYPE=CHECKBOX NAME=\"rqrd\" id=\"rqrd\">";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD width=\"100\">";
echo "      ".MA_FORMAT."";
echo "    </TD>";
echo "    <TD>";
echo "      <SELECT NAME=\"frmat\" onchange='updFormElement1();'>";
echo "      <OPTION VALUE=\"L\">".MA_LABEL."";
echo "			<OPTION VALUE=\"t\">".MA_ENTRY."";
echo "			<OPTION VALUE=\"v\">".MA_VALIDENTRY."";
echo "			<OPTION VALUE=\"T\">".MA_TEXTAREA."";
echo "			<OPTION VALUE=\"p\">".MA_PSWORD."";
echo "			<OPTION VALUE=\"c\">".MA_CHECKBOX."";
echo "      <OPTION VALUE=\"b\">".MA_CKBXLIST."";
echo "			<OPTION VALUE=\"l\">".MA_DDLIST."";
echo "			<OPTION VALUE=\"r\">".MA_RADIOBUTTONS."";
echo "		</SELECT>";
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
echo "  <TR>";
echo "    <TD align=\"center\" colspan=\"2\">";
echo "      <BR><BR>";
echo "      <INPUT TYPE=SUBMIT VALUE=\"".MA_ADDQ."\">";
echo "    </TD>";
echo "  </TR>";
echo "</TABLE>";
echo "</form>";

$db->sql_freeresult($result);
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