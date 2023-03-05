<?php

/************************************************************************/
/*    Pc-Nuke! Systems -  Advanced Content Management System            */
/************************************************************************/
/*    Created by Pc-Nuke! Systems -- Released: 2008                     */
/*    http://www.pcnuke.com                                             */
/*    All Rights Reserved || 2003-2008 || by Pc-Nuke!                   */
/************************************************************************/
/*         The Power of the Nuke - Without the Radiation!               */
/************************************************************************/
/************************************************************************/
/* - Copyright Notice (read and understand the GNU_GPL)                 */
/* - THIS PACKAGE IS RELEASED AS GPL/GNU SCRIPTING.                     */
/* - http://www.pcnuke.com/modules.php?name=GNU_GPL                     */
/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

if (!preg_match("#admin.php#", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

// Restrict Access to Codepage Functionality
$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
list($radminsuper) = $db->sql_fetchrow($result);
$schedinfo = "Coppermine Administration";
if ($radminsuper) {

// ######################################################################
// Coppermine Administrative Section
// ######################################################################
function coppermine() {
    global $db, $prefix;
    include_once("header.php");
    //title(""._MENU."");

OpenTable();
echo "<center>";
echo "<br>";
echo  "<h3>Coppermine Galleries Administrative</h3>";
echo "<hr width=\"75%\">";
echo "<br>";
echo "<table cellpadding=\"0\" cellspacing=\"1\">
     <tr valign=\"middle\" align=\"center\">
          <td class=\"admin_menu\">
		  <a href=\"modules.php?name=coppermine\">Frontside</a> :: 
		  <a href=\"modules.php?name=coppermine&file=config\">Configure</a> :: 
		  <a href=\"modules.php?name=coppermine&file=groupmgr\">Groups</a> :: 
          <a href=\"modules.php?name=coppermine&file=usermgr\">Users</a> :: 
          <a href=\"modules.php?name=coppermine&file=albmgr$cat_l\">Albums</a> :: 
		  <a href=\"modules.php?name=coppermine&file=editpics&mode=upload_approval\">Upload Approval</a>
		  <br>
          <a href=\"modules.php?name=coppermine&file=searchnew\">Batch Add</a> :: 
          <a href=\"modules.php?name=coppermine&file=reviewcom\">Review Comments</a> :: 
          <a href=\"modules.php?name=coppermine&file=catmgr\">Catagories</a>
          
          </td>
     </tr>
</table>";

echo "<br>";
echo "<br>&nbsp;<img src='modules/coppermine/images/cpg.gif' border='0'>";
echo "</center>";
CloseTable();

  echo "<script type=\"text/javascript\">\n";
  echo "<!--\n";
  echo "function nsnnewindow(){\n";
  echo "  window.open (\"modules/coppermine/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,height=200,width=400\");\n";
  echo "}\n";
  echo "//-->\n";
  echo "</SCRIPT>\n\n";
  echo "<div align=\"right\"><a href=\"javascript:nsnnewindow()\">coppermine &copy;</a></div>";
  include_once("footer.php");
  
}
// ######################################################################
// SWITCHBOARD
// ######################################################################
switch ($op){
    case "coppermine": coppermine(); break;
}
} else {
    echo "Access Denied";
}
?>
