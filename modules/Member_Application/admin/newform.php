<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   admin input for MA configuration
*   file name           :   admin/newform.php
*	  run from			      :	  admin/main.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*-17A
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}
$sqllf = "SELECT MAX(formno) AS formno FROM `".$prefix."_MA_mapcfg` ";

if ( !($resultlf = $db->sql_query($sqllf)) )
{
  echo "ERROR - 17A1 - ".MA_UTGLFNFTERROR."! <br>";
  exit();
}

if ( !($lfrow = $db->sql_fetchrow($resultlf)) )
{
  echo "ERROR - 17A2 - ".MA_UTLLFERROR."! <br>";
  exit();
}

$lastform = $lfrow['formno'];

$lastform++;
$formno = $lastform;
echo "<body onload='onloadf();'>";
echo "<form name=\"frmAppSetup\" METHOD=POST action='".$admin_file.".php?op=MAconfig'>";
echo "<INPUT TYPE=HIDDEN NAME=\"formno\" value=\"-1".$formno."\">";
echo "<INPUT TYPE=HIDDEN NAME=\"lastform\" value=\"".$lastform."\">";
echo "<table align=\"center\">";
echo "  <tr>";
echo "    <td colspan=\"3\" align=\"left\">";
echo "<H4>Form Title</H4> ";
echo "    <INPUT NAME=\"formtitle\"  VALUE=\"".MA_ETHTXT.".\" SIZE=\"70\" >";
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td valign=\"top\">";
echo "    <table align=\"left\">";
echo "  <tr>";
echo "    <TD>";
echo "      <br><H4>Application Text</H4>";
echo "      <i>".MA_APPTXTHINT.".</i><br>";
echo "    </TD>";
echo "  </tr>";
echo "  <TR>";
echo "    <TD align=\"left\">";
echo "      <TEXTAREA NAME=\"edcfg\" COLS=80 ROWS=10>".MA_EYATAHHHINT.".<BR></TEXTAREA>";
echo "      <INPUT TYPE=HIDDEN NAME=\"amode\" value=\"tedit\"><br><hr>";
echo "    </TD></TR>";
echo "  <td>";
echo "  <table align=\"left\">";
echo "  <TR>";
echo "    <TD>";
echo "      <B>".MA_UHMTXT."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";
if ($row1['emhtml'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emhtml\" CHECKED>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emhtml\">";
}
echo "    </td>";
echo "  </tr>";

echo "  <TR>";
echo "    <TD>";
echo "      <B>".MA_SNDADMINEMAIL."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";
if ($row1['email_admin'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emailadmin\" CHECKED onClick='updEmailAdmin();'>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emailadmin\" onClick='updEmailAdmin();'>";
}
echo "      <INPUT NAME=\"admad\" ID=\"admad\" VALUE=\"you@somewhere.com\" SIZE=\"20\" style=\"display:none\">";
echo "    </td>";
echo "  </tr>";


echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_SNDGRPNOTIFYEMAIL."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";
if ($row1['mailgroup'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"mailgroup\" CHECKED onClick='updMailGroup();'>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"mailgroup\" onClick='updMailGroup();'>";
}
echo "        <LABEL for=\"watchtopic\" ID=\"wtlabel\" style=\"display:none\">".MA_TOPICWATCH."</LABEL>";
if ($row1['topicwatch'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"watchtopic\" ID=\"watchtopic\" CHECKED style=\"display:none\" value=\"Topic Watch\">";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"watchtopic\" ID=\"watchtopic\" style=\"display:none\" value=\"Topic Watch\">";
}
echo "    </td>";
echo "  </tr>";
echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_DETAILON."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";

if ($row1['emdetail'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"detail\" CHECKED>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"detail\">";
}

echo "    </td>";
echo "  </tr>";

echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_SNDUSRNOTIFYEMAIL."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";
if ($row1['emuser'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emuser\" CHECKED>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"emuser\">";
}
echo "    </td>";
echo "  </tr>";

echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_FORUMPOST."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";

if ($row1['fpdetail'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"grpset\" CHECKED>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"grpset\">";
}

echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD>";
echo "      <B>".MA_REVIEWFORUM."</B>";
echo "    </TD>";
echo "    <TD>";
echo "      <SELECT NAME=\"forumno\">";
$i=0;
  $fmsql = "SELECT * FROM `".$prefix."_bbforums`";
  if( !($fmresult = $db->sql_query($fmsql)) )
  {
    echo " <br>ERROR - 17A3 ".MA_UATOFTERR."!";
    exit();
  }

while ($forumlist = $db->sql_fetchrow($fmresult))
{
  if ($row1['forum_id'] == $forumlist['forum_id'])
  {
    echo "    <OPTION selected VALUE=\"".$forumlist['forum_id']."\">".$forumlist['forum_name'];
  }
  else
  {
    echo "    <OPTION VALUE=\"".$forumlist['forum_id']."\">".$forumlist['forum_name'];
  }
}
echo "      </SELECT>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD>";
echo "      <B>".MA_REVIEWGROUP."</B>";
echo "    </TD>";
echo "    <TD>";
echo "      <SELECT NAME=\"revgroupno\">";
$i=0;
  $grsql = "SELECT * FROM `".$prefix."_bbgroups` WHERE group_description <> \"Personal User\"";
  if( !($grresult = $db->sql_query($grsql)) )
  {
    echo " ERROR - 17A4 - ".MA_UATOGTERR."!";
    exit();
  }

while ($grouplist = $db->sql_fetchrow($grresult))
{
  if ($row1['group_id'] == $grouplist['group_id'])
  {
    echo "    <OPTION selected VALUE=\"".$grouplist['group_id']."\">".$grouplist['group_name'];
  }
  else
  {
    echo "    <OPTION VALUE=\"".$grouplist['group_id']."\">".$grouplist['group_name'];
  }
}
echo "      </SELECT>";
echo "    </TD>";
echo "  </TR>";


echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_AUTOGROUP."</B>";
echo "    </TD>";
echo "    <TD align=\"left\">";
if ($row1['auto_group'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"autogroup\" CHECKED onClick='updAutoGroup();'>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"autogroup\" onClick='updAutoGroup();'>";
}
echo "        <SELECT NAME=\"accgroupno\" ID=\"accgroupno\" style=\"display:none\">";
$i=0;
$grresult = NULL;
if( !($grresult = $db->sql_query($grsql)) )
{
  echo "ERROR - 17A5 - ".MA_UATOGTERR."!";
  exit();
}
while ($grouplist = $db->sql_fetchrow($grresult))
{
  if ($row1['group_add'] == $grouplist['group_id'])
  {
    echo "    <OPTION selected VALUE=\"".$grouplist['group_id']."\">".$grouplist['group_name'];
  }
  else
  {
    echo "    <OPTION VALUE=\"".$grouplist['group_id']."\">".$grouplist['group_name'];
  }
}
echo "      </SELECT>";
echo "    </td>";
echo "  </tr>";




echo "  <TR valign=\"top\">";
echo "    <TD>";
echo "      <B>".MA_LIMITAPPCOUNT."</B>";
echo "    </TD>";
echo "    <TD align=\"left\" rowspan=\"2\">";

if ($row1['appslimit'])
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"appslimit\" CHECKED onClick='updFormElement1();'>";
}
else
{
  echo "      <INPUT TYPE=CHECKBOX NAME=\"appslimit\" onClick='updFormElement1();'>";
}
echo "      <INPUT NAME=\"appslimitno\" ID=\"appslimitno\" VALUE=\"".$row1['appslimitno']."\" SIZE=\"10\" style=\"display:none\">";
echo "    </TD>";
echo "  </TR>";
echo "  <tr valign=\"top\">";
echo "  <td>";
echo "      ".MA_SETTOZEROSTOP."<br><br>";
echo "  </td>";
echo "  <td>";
echo "  </td>";
echo "  </tr>";
echo "  <tr valign=\"top\">";
echo "  <td >";
echo "  <B>".MA_ANONOK."</B>";
echo "  </td>";
echo "  <td align=\"left\">";
if ($row1['annon'])
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"anonappsok\" NAME=\"anonappsok\" CHECKED>";
}
else
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"anonappsok\" NAME=\"anonappsok\">";
}
echo "  </td>";
echo "  </tr>";

echo "  <tr lforms=\"top\">";
echo "  <td >";
echo "  <B>".MA_SHOWFORMS."</B>";
echo "  </td>";
echo "  <td align=\"left\">";
if ($row1['formlist'])
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"listforms\" NAME=\"listforms\" CHECKED>";
}
else
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"listforms\" NAME=\"listforms\">";
}
echo "  </td>";
echo "  </tr>";

echo "  <tr valign=\"top\">";
echo "  <td >";
echo "  <B>".MA_VERTICLEALIGN."</B>";
echo "  </td>";
echo "  <td align=\"left\">";
if ($row1['VertAlign'])
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"vertalign\" NAME=\"vertalign\" CHECKED>";
}
else
{
  echo "  <INPUT TYPE=CHECKBOX ID=\"vertalign\" NAME=\"vertalign\">";
}
echo "  </td>";
echo "  </tr>";

echo "  </table>";
echo "  </td>";

echo "  <TR>";
echo "    <TD>";
echo "      <hr><H4>".MA_TYTXT."</H4>";
echo "      <i>".MA_TYTXTHINT.".</i><br>";
echo "    </TD>";
echo "  </tr>";
echo "  <TR>";
echo "    <TD align=\"left\">";
echo "      <TEXTAREA NAME=\"edtytxt\" COLS=80 ROWS=10>".MA_EYTYTXTHERE.".<BR></TEXTAREA>";
echo "    </TD>";
echo "  <TR>";
echo "    <TD>";
echo "      <br><hr><H4>".MA_NOAPPTXT."</H4>";
echo "      <i>".MA_NOAPPTXTHINT.".</i><br>";
echo "    </TD>";
echo "  </tr>";
echo "  <TR>";
echo "    <TD align=\"left\">";
echo "      <TEXTAREA NAME=\"noapptxt\" COLS=80 ROWS=10>".MA_SAANBAATTTXT.".</TEXTAREA><br>";
echo "    </TD>";
echo "  </TR>";
echo "  </table>";
echo "  </td>";

echo "  <TR>";
echo "    <TD>";
echo "      <br><hr><H4>".MA_APPAPROVTXT."</H4>";
echo "      <i>".MA_APPAPROVTXTHINT.".</i><br>";
echo "    </TD>";
echo "  </tr>";
echo "  <TR>";
echo "    <TD align=\"left\">";
echo "      <TEXTAREA NAME=\"apprtxt\" COLS=80 ROWS=10>".$row1['approvtxt']."</TEXTAREA><br>";
echo "    </TD>";
echo "  </TR>";
echo "  <TR>";
echo "    <TD>";
echo "      <br><hr><H4>".MA_APPDENYTXT."</H4>";
echo "      <i>".MA_APPDENYTXTHINT.".</i><br>";
echo "    </TD>";
echo "  </tr>";
echo "  <TR>";
echo "    <TD align=\"left\">";
echo "      <TEXTAREA NAME=\"denytxt\" COLS=80 ROWS=10>".$row1['denytxt']."</TEXTAREA><br><hr>";
echo "    </TD>";
echo "  </TR>";


echo "  </tr>";
echo "  <tr>";
echo "    <td align=\"center\" colspan=\"2\">";
echo "      <INPUT TYPE=SUBMIT VALUE=\"Save Changes\">";
echo "    </td>";
echo "  </tr>";
echo "</table>";
echo "</form>";
?>

<script language="javascript" type="">
function onloadf(){
updFormElement1();
updEmailAdmin();
updMailGroup();
updAutoGroup();
}
function updFormElement1(){
if (document.frmAppSetup.appslimit.checked == true){
document.getElementById('appslimitno').style.display = "";
} else {
document.getElementById('appslimitno').style.display = "none";
}
}
function updEmailAdmin(){
if (document.frmAppSetup.emailadmin.checked == true){
document.getElementById('admad').style.display = "";
} else {
document.getElementById('admad').style.display = "none";
}
}

function updAutoGroup(){
if (document.frmAppSetup.autogroup.checked == true){
document.getElementById('accgroupno').style.display = "";
} else {
document.getElementById('accgroupno').style.display = "none";
}
}

function updMailGroup(){
if (document.frmAppSetup.mailgroup.checked == true){
document.getElementById('wtlabel').style.display = "";
document.getElementById('watchtopic').style.display = "";
} else {
document.getElementById('wtlabel').style.display = "none";
document.getElementById('watchtopic').style.display = "none";
}
}

</script>
