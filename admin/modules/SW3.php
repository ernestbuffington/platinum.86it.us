<?php
$sqlDebug = 0;
/************************************************************************/
/* PHP-NUKE: Ajax Modules Administration System Version v0.6Platinum    */
/* ==========================================================           */
/*                                                                      */
/* Copyright (c) 2006 by aman                                           */
/* http://www.adanstar.com/phpnuke/                                     */
/************************************************************************/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
require_once("mainfile.php");
require_once("config.php");
require_once("admin/language/lang-$currentlang.php");
global $admin, $bgcolor2, $bgcolor1, $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
function Main() {
    global $prefix,$db, $admin_file,$bgcolor1, $bgcolor2;
    $handle=opendir('modules');
    $modlist = "";
    while ($file = readdir($handle)) {
	if ( (!preg_match("#[.]#",$file)) ) {
		$modlist .= "$file ";
	}
    }
    closedir($handle);
    $modlist = explode(" ", $modlist);
    sort($modlist);
    for ($i=0; $i < sizeof($modlist); $i++) {
	if(!empty($modlist[$i])) {
	    $row = $db->sql_fetchrow($db->sql_query("SELECT mid from " . $prefix . "_modules where title='$modlist[$i]'"));
	    $mid = intval($row['mid']);
	    if (empty($mid)) {
		//$db->sql_query("insert into " . $prefix . "_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '', '1', '0')");
/*****************************************************/
/* Addon - Navigation / Module v.2.0.0         START */
/*****************************************************/
                $db->sql_query("insert into " . $prefix . "_modules values (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '', '1', '0', '1', '')");
/*****************************************************/
/* Addon - Navigation / Module v.2.0.0           END */
/*****************************************************/
	    }
	}
    }
    $result2 = $db->sql_query("SELECT title from " . $prefix . "_modules");
    while ($row2 = $db->sql_fetchrow($result2)) {
	$title = $row2['title'];
	$a = 0;
	$handle=opendir('modules');
	while ($file = readdir($handle)) {
	    if ($file == $title) {
		$a = 1;
	    }
	}
	closedir($handle);
	if ($a == 0) {
	    $db->sql_query("delete from " . $prefix . "_modules where title='$title'");
	}
    }
    $content =  "<div id=\"divTMP\"></div>";
    $content .=  "<br /><center><font class=\"option\">" . _MODULESADDONS . "</font>"
		."<address title='Help' onclick=\"expand('helptext','item2');\"  onmouseout=\"this.style.color = 'orange';\" onmouseover=\"this.style.color = 'red';this.style.cursor='pointer';\"><img id=\"item2\" src=\"images/plus.gif\" /> Help</address>"
		."<p id=\"helptext\" style=\"display:none;color:red\">"
		."<font class=\"content\">" . _MODULESACTIVATION . "</font><br /><br />"
		."" . _MODULEHOMENOTE . "<br /><br />" . _NOTINMENU . "</p>"
	."<form action=\"".$admin_file.".php\" method=\"post\" style=\"margin:0;\">"
        ."<table border=\"1\" align=\"center\"  width=\"100%\" id=\"tblBasic1b\"><tr><td align=\"center\" bgcolor=\"$bgcolor2\">"
	."<strong>"._TITLE."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._CUSTOMTITLE."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._STATUS."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._VIEW."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._GROUP."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._FUNCTIONS."</strong></td></tr>";
    $main_m = $db->sql_fetchrow($db->sql_query("SELECT main_module from " . $prefix . "_main"));
    $main_module = $main_m['main_module'];
    $result3 = $db->sql_query("SELECT mid, title, custom_title, active, view, inmenu, mod_group,mcid,groups from " . $prefix . "_modules order by title ASC");
    $tri=2;
    while ($row3 = $db->sql_fetchrow($result3)) {
	$mid = intval($row3['mid']);
	$mcid = $row3['mcid'];
	$groups = $row3['groups'];
	$title = $row3['title'];
	$custom_title = $row3['custom_title'];
	$active = intval($row3['active']);
	$view = intval($row3['view']);
	$inmenu = intval($row3['inmenu']);
	$mod_group = intval($row3['mod_group']);
	$chkhome="($mid,$active,0)";
	$homemark="($mid,$active,1)";
	$confirm2 = "" . _TO . " [ $title ] ?";
	$dataArr=htmlspecialchars("$custom_title|$active|$view|$mod_group|$inmenu|$mid|$mcid|$groups", ENT_QUOTES);
	if (empty($custom_title)) {
	    $custom_title = preg_replace("#_#"," ",$title);
	    $db->sql_query("update " . $prefix . "_modules set custom_title='$custom_title' where mid='$mid'");
	}
	if ($active == 1) {
				$active = "<img src=\"images/active.gif\" alt=\""._ACTIVE."\" title=\""._ACTIVE."\" border=\"0\" width=\"16\" height=\"16\" onclick=\"getModulesSw($mid,$active,0)\" onmouseover=\"this.style.cursor='pointer';\">";
	    $act = 0;
	} else {
				$active = "<img src=\"images/stop.gif\" alt=\""._INACTIVE."\" title=\""._INACTIVE."\" border=\"0\" width=\"16\" height=\"16\" onclick=\"getModulesSw($mid,$active,0)\" onmouseover=\"this.style.cursor='pointer';\">";
	    $act = 1;
	}
	if (empty($custom_title)) {
	    $custom_title = preg_replace("#_#", " ", $title);
	}
	if ($view == 0) {
	    $who_view = _MVALL;
	} elseif ($view == 1) {
	    $who_view = _MVUSERS;
	} elseif ($view == 2) {
	    $who_view = _MVADMIN;
	} elseif ($view == 3) {
	    $who_view = _SUBUSERS;
   } elseif ($view > 3) {
       $who_view = _MVGROUPS;
	}
	if ($title != $main_module AND $inmenu == 0) {
	    $title = "[ <big><strong>&middot;</strong></big> ] $title";
	}
	if ($title == $main_module) {
	    $old_m = "[ $title ]";
	    $title = "<strong>$title</strong>";
	    $custom_title = "<strong>$custom_title</strong>";
				$active = str_replace($chkhome,$homemark,$active)."<img src=\"images/key.gif\" alt=\""._INHOME."\" title=\""._INHOME."\" border=\"0\" width=\"17\" height=\"17\">";
				$who_view = "<strong>$who_view</strong>";
				$puthome = "<img src=\"images/key_x.gif\" alt=\""._INHOME."\" title=\""._INHOME."\" border=\"0\" width=\"17\" height=\"17\">";
	    $background = "bgcolor=\"$bgcolor2\"";
	} else {
				$confirm1 = "" . _SURETOCHANGEMOD . " ";
				$confirm = "$confirm1 $confirm2";
				$puthome = "<img src=\"images/key.gif\" alt=\""._PUTINHOME."\" title=\""._PUTINHOME."\" border=\"0\" width=\"17\" height=\"17\" onClick=\"if(confirm('$confirm ?')) getInHome($mid);\" onmouseover=\"this.style.cursor='pointer';\">";
	    $background =  "bgcolor=\"$bgcolor1\"";
	}
	if ($mod_group != 0) {
	    $grp = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_groups WHERE id='$mod_group'"));
	    $mod_group = $grp['name'];
	} else {
	    $mod_group = _NONE;
	}
			$content .=  "<tr id=\"roll{$tri}\" class=\"rollover\"><td $background>&nbsp;$title</td>
			<td align=\"center\" $background>".stripslashes($custom_title)."</td>
			<td align=\"center\" $background><div id='active{$mid}' onclick=\"insertRowSp2('$mid','$dataArr','tblBasic1b','$tri','info');\">$active </div></td>
			<td align=\"center\" $background>$who_view</td>
			<td align=\"center\" $background>$mod_group</td>
			<td align=\"center\" $background nowrap><div id='activeSw{$mid}'>&nbsp; <img title=\"Edit\" onclick=\"insertRowSp('$mid','$dataArr','tblBasic1b','$tri','info');\" height=\"17\" alt=\"Edit\" width=\"17\" border=\"0\" src=\"images/edit.gif\" onmouseover=\"this.style.cursor='pointer';\" />  $puthome &nbsp;</div></td></tr>";
			$tri ++;
    }
    $content .=  "</table></form></center>";
    $content .=  "<div align=\"right\"><a href=\"http://www.aman.38.com/phpnuke/\" target=\"_bank\"><strong>www.aman.38.com</a> &copy; ajax Modules_Administration v0.6.1 Platinum Nuke Pro</strong>  &nbsp;</div> ";
    $confirm1="" . _SURETOCHANGEMOD . "";
    $confirm_last1="" . _SURETOCHANGEMOD . " $old_m ";
    $content = str_replace($confirm1,$confirm_last1,$content);
return $content;
}
function makeCatSel() {
		global $prefix, $db;
        $content = "<form>"
            ."<font class=\"content\"><strong>"._MODCATEGORY."</strong></font><br /><br />";
        $result2=$db->sql_query("select mcid, mcname, visible from ".$prefix."_modules_categories order by mcname");
        $content .=  ""._CATEGORY.": <select name=\"cat\" id=\"selSeaShells\">>";
        $forarr = "";
        $cc = 0;
        while(list($mcid2, $mcname2,$visible) = $db->sql_fetchrow($result2)) {
             $content .= "<option value=\"$mcid2*$visible\">$mcname2</option>";
              if($cc > 0)$forarr .=  "|";
              $forarr .=  "$mcid2-$mcname2";
              $cc++;
        }
        $content .= "</select>"
            ."<input type=\"button\" value=\""._MODIFY."\" onclick=\"editSelected();\">"
            ."</form>";    
            return array($forarr,$content);          
}
function CatAdd($mcname) {
		global $prefix, $db,$sqlDebug;
		$sql = "INSERT INTO ".$prefix."_modules_categories (mcid, mcname) VALUES (NULL, '$mcname')";
		$db->sql_query($sql);
            return makeCatSel();         
}
function CatDel($data) {
		global $prefix, $db, $sqlDebug;
		$data = mkJSON($data);
		$mcid = $data->mcid;
		$sql = "DELETE FROM ".$prefix."_modules_categories WHERE mcid='$mcid'";
		$db->sql_query($sql);
            return makeCatSel();    
}
function CatUpdate($data) {
		global $prefix, $db,$sqlDebug;
		$data = mkJSON($data);
		$mcid = $data->mcid;
		$visible = $data->catvisible;
		$mcname = $data->mcname;
		$sql = "UPDATE ".$prefix."_modules_categories SET mcname='$mcname', visible='$visible' WHERE mcid='$mcid'";
		$db->sql_query($sql);
            return makeCatSel();        
}
function mkJSON($data) {
		$data = urldecode(stripslashes($data));
		if (extension_loaded('json')) $data = json_decode($data);
    else{
				require_once("includes/javascript/dd_files/JSON.php");
				$json = new Services_JSON();
				$data  = $json->decode($data);
    }
  return $data;
}
function Update($data) {
		global $prefix, $db, $admin_file, $sqlDebug;
		$data = mkJSON($data);
		$active = $data->active;
		$inmenu = $data->inmenu;
		if(isset($data->groups)) $groups = implode("-",$data->groups);
		else $groups = "";
		$mid = $data->mid;
		//$custom_title = mysql_real_escape_string($data->custom_title);
		$custom_title = htmlspecialchars($data->custom_title, ENT_QUOTES);
		$view = intval($data->view);
		$mod_group =  $data->mod_group;
		$mcat = intval($data->mcat);
/*****************************************************/
/* Addon - Navigation / Module v.2.0.0           END */
/*****************************************************/
    if($view == 4) { $ingroups = str_replace(",","-",$groups); }
    if($view < 4) { $ingroups = ""; }
    if ($view != 1) { $mod_group = 0; }
/*****************************************************/
/* Addon - Navigation / Module v.2.0.0         START */
/*****************************************************/
$sql = "update " . $prefix . "_modules set custom_title='$custom_title', view='$view', groups='$ingroups', inmenu='$inmenu', mod_group='$mod_group', mcid='$mcat',active = '$active' where mid='$mid'";
    $result = $db->sql_query($sql);
/*****************************************************/
/* Addon - Navigation / Module v.2.0.0           END */
/*****************************************************/
return $sql;
}
function ModulesSw($cat_id){
		global $prefix, $db, $admin_file;
		list($id,$active,$inhome) = explode('|',$cat_id);
			if($active > 0)$activeDB = 0;
			else $activeDB = 1;
			$sql="UPDATE " . $prefix . "_modules SET active ='$activeDB' WHERE  mid ='$id'";
			$rs = $db->sql_query($sql);
				$row = $db->sql_fetchrow($db->sql_query("SELECT active from " . $prefix . "_modules WHERE  mid ='$id'"));
				$activeSW = intval($row['active']);
			if($activeSW==0)
			{
				$title=_INACTIVE;
				$activeimg="stop.gif";
				$sw=0;
			}else
			{ 
				$title=_ACTIVE;
				$activeimg="active.gif";
				$sw=1;
			}
			$img ="<img title=\"$title\" onclick=\"getModulesSw($id,$sw,$inhome)\" height=\"16\" alt=\"$title\" width=\"16\" border=\"0\" src=\"images/$activeimg\" onmouseover=\"this.style.cursor='hand';\" />";
			if($myDebug > 0)$img .="($id,$sw,$inhome)";
			if($inhome > 0)$img .="<img src=\"images/key.gif\" alt=\""._INHOME."\" title=\""._INHOME."\" border=\"0\" width=\"17\" height=\"17\">";
		return array($id,$img,$activeSW);
}
function setModuleToHome($mid) {
		global $prefix, $db, $admin_file, $sqlDebug;
		$mid = intval($mid);
			$row = $db->sql_fetchrow($db->sql_query("SELECT * from " . $prefix . "_modules where mid='$mid'"));
			$groups = $row['groups'];
			$mcid = intval($row['mcid']);
			$title = $row['title'];
			$active = 1;
			$view = 0;
			$res = $db->sql_query("update " . $prefix . "_main set main_module='$title'");
			$res2 = $db->sql_query("update " . $prefix . "_modules set active='$active', view='$view' where mid='$mid'");
		if($sqlDebug == 1) return $sql=	"update " . $prefix . "_main set main_module='$title'"."<p>update " . $prefix . "_modules set active='$active', view='$view' where mid='$mid'";
	}
	
require_once('includes/javascript/dd_files/Sajax.php');
    
    	$sajax_request_type = "POST";
    	sajax_init();
    	sajax_export("ModulesSw","Main","Update","setModuleToHome","CatUpdate","CatDel","CatAdd");
    	sajax_handle_client_request();
include_once("header.php");
		OpenTable();
		echo "<center><address title='Administration Center' onclick=\"expand('GraphicAdmin','item1');\"  onmouseout=\"this.style.color = 'orange';\" onmouseover=\"this.style.color = 'red';this.style.cursor='pointer';\"><img id=\"item1\" src=\"images/plus.gif\" /> Administration Center</address></center>";
		CloseTable();
echo "<div id=\"GraphicAdmin\" style=\"display:none;\">";
		//GraphicAdmin();
echo "</div>";
		OpenTable();
		echo "<center><a href=\"$admin_file.php?op=modules\"><font class=\"title\" onmouseout=\"this.style.color = 'orange';\" onmouseover=\"this.style.color = 'red';\">AJAX " . _MODULESADMIN . " v0.6Platinum</font></a></center>" 
    ."<br /><center><address title='Category Manager' onclick=\"expand('CatAdmin','item3');\"  onmouseout=\"this.style.color = 'orange';\" onmouseover=\"this.style.color = 'red';this.style.cursor='pointer';\"><img id=\"item3\" src=\"images/plus.gif\" /><strong> Category Manager</address></center>";
		CloseTable();
?>
<style type="text/css">
#header address:hover {color: white; 
background-color:#e76931; text-decoration: underline;} /* mouse over link */
	att.hover{color:Red; }
	h2.rollover {color:orange}  /* initialize properties on class */
	tr.text1 { background-color:#FFEEC8; color:#000000;  }
	tr.textb { background-color:#ffe000; color:#000000; font-weight:bold; }
</style>
<script language="JavaScript" src="includes/javascript/dd_files/json.js" type="text/javascript"></script>
        <script>
        <?php
        sajax_show_javascript();
        ?>
        function getModulesSw_cb(list) {
        	var aid = 'active'+list[0];
        	var img = list[1];
        	var activeSw = list[2];
              document.getElementById(aid).innerHTML = img;
					var swArea = 'activeSw'+list[0];
        	var strTarget = document.getElementById(swArea).innerHTML;
					var start= strTarget.indexOf("RowSp('")+7;
					var end= strTarget.indexOf("');");
					var arr = (strTarget.substring(start,end)).split("','");
					var myArr = arr[1].split("|");
					var odata = "";
					var ndata = "";
			    for(var i=0;i< myArr.length;i++){
			        var vn = myArr[i];
			        odata = odata+vn;     
			        ndata = (i == 1)?ndata+activeSw:ndata+vn;		        	
			        if(i < 8){  //此處數字 為 dataArr.length應與 function MakeForm 保持一致
			        	ndata = ndata + "|";
			        	odata = odata + "|";
			        }
			    }
					document.getElementById(swArea).innerHTML = strTarget.replace(odata,ndata );
					var rowIndex = document.getElementById("divTMP").value;
					//if(rowIndex>0){
						RowClose(rowIndex,"recall");
						ndata = ndata.replace('\\',"");
						ndata = ndata.replace("&#039;","'");
						insertRowSp(list[0],ndata,'tblBasic1b',rowIndex,'info');
				  //}
        }
        function getModulesSw(mId,active,inhome){
        	var pid=mId + '|' + active + '|' + inhome;
        	x_ModulesSw(pid, getModulesSw_cb);
        }
				function isCatExist(mcname) {
					var arrstr= document.getElementById("catData").innerHTML;
					var mcatsArray =  arrstr.split(",");
					  for (i=0; i<mcatsArray.length; i++) {
					   var OParr = mcatsArray[i].split("-");
					   if (mcname == OParr[1]) { var stophere = 1; }
					  }
					   if (stophere == 1) return true; 
					   else return false; 
				}	
				function getCatAdd() {
					var mcname = document.getElementById("mcnameAdd").value.replace(/^\s+|\s+$/g,"");
					   if (mcname.length== 0) { 
					   		alert( "You didn't enter a  category name!!"); 
					   		return false;
					   }
					   if (isCatExist(mcname) == 1) { 
					   		alert( mcname + ": This category already exist in the database."); 
					   		exit;
					   }else{
							subWinClose();
							x_CatAdd(mcname, getCatUpdate_cb);
					   }					
				}
				function CatHome() {
					document.getElementById("cat_div").style.display = "";
					document.getElementById("cat_div0").style.display = "";
					document.getElementById("cat_div2").style.display = "none";
					document.getElementById("cat_div2").innerHTML = "";
				}
				function getCatDel(FormId) {
					var fdata = getFormValues(FormId);	
					CatHome();
					subWinClose();
					x_CatDel(fdata, getCatUpdate_cb);
				}
		        function getCatUpdate_cb(arr) {
		                var newMcatsArr = arr[0].split("|");
		                newMcatsArr.sort();
		                document.getElementById("mcnameAdd").value="";
		                document.getElementById("catsel_div").innerHTML =  arr[1];
		                document.getElementById("catData").innerHTML =  newMcatsArr;
		        }
				function getCatUpdate(FormId) {
					var fdata = getFormValues(FormId);
					CatHome();
					subWinClose();
					x_CatUpdate(fdata, getCatUpdate_cb);		
				}
				function getUpdate(FormId) {
					var fdata = getFormValues(FormId);
					x_Update(fdata, getLoad);
				}
        function getInHome(mId) {
               x_setModuleToHome(mId, getLoad);
        }
        function getMain_cb(server) {
                document.getElementById("main_div").innerHTML = server;
        }
        function getLoad(sql) {
                x_Main(getMain_cb);
                //if(sql.length)document.getElementById("info").innerHTML = sql;
                var catDataStr = document.getElementById("catData");
                if(catDataStr.innerHTML.length < 1)catDataStr.innerHTML =  mcatsArray;
        }


var submitStr = '<?php echo ""._SAVECHANGES."";?>';

var labelStr = new Array();
labelStr[0] = '<?php echo ""._CUSTOMMODNAME."";?>';
labelStr[1] = '<?php echo ""._VIEWPRIV."";?>';
labelStr[2] = '<?php echo ""._WHATGROUPS."";?>';
labelStr[3] = '<?php echo ""._SHOWINMENU."";?>';
labelStr[4] = '<?php echo ""._ACTIVE."";?>';
labelStr[5] = '<?php echo "". _UGROUP."";?>';
labelStr[6] = '<?php echo "". _CATEGORY."";?>';
labelStr[7] = '';

var viewprivStr = new Array();
viewprivStr[0] = '<?php echo ""._MVALL."";?>';
viewprivStr[1] = '<?php echo ""._MVUSERS."";?>';
viewprivStr[2] = '<?php echo ""._MVADMIN."";?>';
viewprivStr[3] = '<?php echo ""._SUBUSERS."";?>';
viewprivStr[4] = '<?php echo ""._MVGROUPS."";?>';

var nsngr_groups = new Array();
<?php
        $groupsResult = $db->sql_query("select gid, gname from ".$prefix."_nsngr_groups");
        
        $cc = 0;
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
            echo "nsngr_groups[$cc] ='$gid-$gname';\n";
            $cc++;
        }
        
        echo "\n\n";
?>
var UGroup = new Array();
<?php
        $result2 = $db->sql_query("SELECT id, name FROM " . $prefix . "_groups");
        $cc = 1;
        
        echo "UGroup[0] ='0-" . _NONE . "';\n";
        while ($row2 = $db->sql_fetchrow($result2)) {

            echo "UGroup[$cc] ='$row2[id]-$row2[name]';\n";
            $cc++;
        }
        
        echo "\n\n";
?>
var mcatsArray = new Array();
<?php
       $result2=$db->sql_query("select mcid, mcname from ".$prefix."_modules_categories order by mcid ASC");
       $cc = 0;
       while(list($mcid2, $mcname2) = $db->sql_fetchrow($result2)) {

            echo "mcatsArray[$cc] ='$mcid2-$mcname2';\n";
            $cc++;
        }
        
        echo "\n\n";
?>
window.onload = getLoad;

function subWinClose() 
{
	var rowIndex = document.getElementById("divTMP").value;
	if(rowIndex > 0)RowClose(rowIndex);
}


function isArray() 
{
  if (typeof arguments[0] == 'object')
  {  
    var criterion = arguments[0].constructor.toString().match(/array/i);
   return (criterion != null);  
  }
  return false;
}

function expand(thistag,el){
   styleObj=document.getElementById(thistag).style;
   if(styleObj.display=='none'){
   	styleObj.display='';
   	imgsrc="images/minus.gif";
   }else {
   	styleObj.display='none';
   	imgsrc="images/plus.gif";
   	}
   	
  document.getElementById(el).src=imgsrc;
}
// mredkj.com
// 2005-08-15 - created
// 2006-05-14 - updated
function appendRow(tblId)
{
	var tbl = document.getElementById(tblId);
	var newRow = tbl.insertRow(tbl.rows.length);
	var newCell = newRow.insertCell(0);
	newCell.innerHTML = 'Hello World!';
}
function deleteLastRow(tblId)
{
	var tbl = document.getElementById(tblId);
	if (tbl.rows.length > 0) tbl.deleteRow(tbl.rows.length - 1);
}

function RowClose(rowIndex,recall)
{
	back(rowIndex);
	document.getElementById("tblBasic1b").deleteRow(rowIndex);
	document.getElementById("divTMP").value="";
}

function change(thistag){
   styleObj=document.getElementById('roll'+thistag).style;styleObj.color="red";
}
function back(thistag){
   styleObj=document.getElementById('roll'+thistag).style;styleObj.color="orange";
}

function insertRowSp2(mId,dataArr,tblId,rowIndex, txtError)
{
	var chk = document.getElementById('divTMP').value;
	if(chk>0)insertRowSp(mId,dataArr,tblId,rowIndex, txtError,1);
}

function insertRowSp(mId,dataArr,tblId,rowIndex, txtError,holdBox)
{
	var tbl = document.getElementById(tblId);
	var chk = document.getElementById('divTMP').value;
	
	if(chk>0){
		tbl.deleteRow(chk);
		back(chk);
		if(chk == rowIndex && holdBox != 1) { 
			document.getElementById('divTMP').value = "";
			return;
		}
	}

	document.getElementById('divTMP').value = rowIndex;
	dataArr = unescape(dataArr.replace(/\+/g, " "));
	
	change(rowIndex);
	
	var rowID = document.getElementById("divTMP").value;

	try {
		var newRow = tbl.insertRow(rowIndex);
		var newCell = newRow.insertCell(0);
		var myarr = dataArr.split("|");
		var custom_title = myarr[0];

		newCell.setAttribute('colSpan', '6');
		newCell.innerHTML ='<div id="divED" align="center"></div>';

		t = document.createElement("TABLE");
		t.setAttribute("width","100%");
		
		tbody = document.createElement("TBODY");
		t_row=document.createElement("TR");

		t_cella=document.createElement("TD");
		t_cella.setAttribute("width","30%");
		var txt=" ";
		t_cella.innerHTML = txt;
		t_row.appendChild(t_cella);
		
		t_cellb=document.createElement("TD");
		var txt="edit: <strong><font color='red'>"+ custom_title +"</font></strong>";
		t_cellb.innerHTML = txt;
		//t_cell.appendChild(txt);
		t_row.appendChild(t_cellb);

		t_cellc=document.createElement("TD");
		t_cellc.setAttribute("width","30%");
		var txt="<img title='Close this EditBox' src='images/close.gif' onclick='RowClose("+rowID+");' onmouseover=\"this.style.cursor='pointer';\">";
		t_cellc.innerHTML = txt;
		//t_cell.appendChild(txt);
		t_row.appendChild(t_cellc);
		
		tbody.appendChild(t_row);
    t.appendChild(tbody);

    document.getElementById("divED").appendChild(t);
    
		MakeForm("divED",dataArr);

	} catch (ex) {
		document.getElementById(txtError).value = ex;
	}
}

function changeContent(myTable,rowNum,cellNum,mystr)
{
var x=document.getElementById(myTable).rows[rowNum].cells
x[cellNum].innerHTML=mystr
}


function insertRow(tblId, txtIndex, txtError)
{
	var tbl = document.getElementById(tblId);
	var rowIndex = document.getElementById(txtIndex).value;
	try {
		var newRow = tbl.insertRow(rowIndex);
		var newCell = newRow.insertCell(0);
		newCell.innerHTML = 'Hello World! insert';
	} catch (ex) {
		document.getElementById(txtError).value = ex;
	}
}
function deleteRow(tblId, txtIndex, txtError)
{
	var tbl = document.getElementById(tblId);
	var rowIndex = document.getElementById(txtIndex).value;
	try {
		tbl.deleteRow(rowIndex);
	} catch (ex) {
		document.getElementById(txtError).value = ex;
	}
}

function getField (form, fieldName) {
  if (!document.all)
    return form[fieldName];
  else  // IE has a bug not adding dynamically created field 
        // as named properties so we loop through the elements array 
    for (var e = 0; e < form.elements.length; e++)
      if (form.elements[e].name == fieldName)
        return form.elements[e];
  return null;
} 
function addField (form, fieldType, fieldName, fieldValue,fldSize) {
  if (document.getElementById) {
    var input = document.createElement('INPUT');
      if (document.all) { // what follows should work 
                          // with NN6 but doesn't in M14
        input.type = fieldType;
        input.name = fieldName;
        input.value = fieldValue;
      }
      else if (document.getElementById) { // so here is the
                                          // NN6 workaround
        input.setAttribute('type', fieldType);
        input.setAttribute('name', fieldName);
        input.setAttribute('value', fieldValue);
      }

    if (fldSize > 0)input.setAttribute("size",fldSize);
    if (fldSize == "button")input.onclick = function(){getUpdate("edForm");};
    if (fldSize == "button1")input.onclick = function(){ getCatUpdate("catForm");};
    if (fldSize == "button2")input.onclick = function(){  if(confirm("Are you sure you want to delete this?  ")) { getCatDel("catForm");}else { CatHome(); } };
    form.appendChild(input);
  }
}

function getFormValues(strFormName) {
    var objForm=document.forms[strFormName];
    var result= new Object();
    var strText = "";
    if (!objForm) {
        alert("form with this name does not exist: "+strFormName);
        return result;
    }

    for (var i=0; i<objForm.elements.length; i++) {
        var element=objForm.elements[i];
        var strValue="";
        switch (element.type) {
            case "text":
            case "textarea":
                strValue = element.value;
                break;
            case "select":
            case "select-one":
                for (var j=0; j<element.options.length; j++) {
                    if (element.options[j].selected)
                        strValue += element.options[j].value+",";
                }
                if (strValue.length > 0)
                    strValue = strValue.substr(0, strValue.length-1);
                break;
            case "radio":
                var evalue = (element.checked)? '0':'1';
                strValue = evalue;
                break;
                
            case "checkbox":
                if ((result[element.name])&&(result[element.name].length > 0))
                    strValue = result[element.name]+",";
                if (element.checked) {
                    strValue += element.value;
                }
                else {
                    if ((result[element.name])&&(result[element.name].length > 0))
                        strValue = strValue.substr(0, strValue.length-1);
                }
                break;
            case "select-multiple":
                    numOptions = element.options.length;
                    valArr = new Array;
                    for (z = 0; z < numOptions; z++) {
                       if (element.options[z].selected) valArr[z] = element.options[z].value;
                    }
                    strValue = valArr;
                break; 
            default:  
            strValue = element.value;
            break;
        }
	        result[element.name] = strValue;
    }
    strText = encodeURIComponent(result.toJSONString());
    return strText;
}

function addRadioField (form, fieldType, fldID, fldValue,optchecked,FormTarget) {
  if (document.getElementById) {
			try{
					if(optchecked == "checked" ){
					var rdo = document.createElement('<input type="radio" name="' + fldID + '" value="' + fldValue + '" checked/>');
					}else{
					 var rdo = document.createElement('<input type="radio" name="' + fldID + '" value="' + fldValue + '"/>');
					 }
			}catch(err){
			var rdo = document.createElement('input');
			rdo.setAttribute('type','radio');
			rdo.setAttribute('name',fldID);

			if(optchecked == "checked" )rdo.setAttribute('checked', true);
			}

			form.appendChild(rdo);
  }
}

function changeContent()
{
var x=document.getElementById('myTable').rows[0].cells
x[0].innerHTML="NEW CONTENT"
}

function in_array(stringToSearch, arrayToSearch) {
    for (s = 0; s <arrayToSearch.length; s++) {
        thisEntry = arrayToSearch[s].toString();
        if (thisEntry == stringToSearch) {
            return true;
        }
    }
    return false;
} 

function MakeForm(myObj,dataArr) {
   var mybody=document.getElementById(myObj);
   mytable = document.createElement("TABLE");
   mytablebody = document.createElement("TBODY");

		var myarr = dataArr.split("|");
		var custom_title = myarr[0];
		var active = myarr[1];
		var view = myarr[2];
		var mod_group = myarr[3];
		var inmenu = myarr[4];
		var mid = myarr[5];
		var mcid = myarr[6];
		var arrayGroups = myarr[7].split('-');

		if(inmenu== 1){
		 menuchk1="checked";
		 menuchk0="";
		}else{
		 menuchk1="";
		 menuchk0="checked";
		}

		if(active== 1){
		 chk1="checked";
		 chk0="";
		}else{
		 chk1="";
		 chk0="checked";
		}
	
   for(j=0;j< 8;j++) { //此處數字 為 dataArr.length應與  function getModulesSw_cb 保持一致
   mycurrent_row=document.createElement("TR");
   for(i=0;i<2;i++) {
		mycurrent_cell=document.createElement("TD");
		if(i==1){ 
				if(j== 0)addField (mycurrent_cell,"text","custom_title",custom_title,"30");
				if(j== 1){
					var selstr="<select name='view'>" ;

					  for (i=0; i< viewprivStr.length; i++) {
					   if ( i == view) { var selA=" selected='selected'" }else selA="";
					    selstr +="<option value='"+ i +"'"+ selA +">"+ viewprivStr[i] +"</option>";
					  }
					mycurrent_cell.innerHTML =selstr +"</select>";
					}
					
        if(j == 2){
					var selstr="<select name='groups' id='groups' multiple = 'multiple' size='5'>" ;
					
					  for (i=0; i<nsngr_groups.length; i++) {
					   var OParr = nsngr_groups[i].split("-");
					   if (in_array(OParr[0] , arrayGroups)) { var selA=" selected='selected'" }else selA="";
					    selstr +="<option value='"+OParr[0] +"'"+ selA +">"+ OParr[1] +"</option>";

					  }
					mycurrent_cell.innerHTML =selstr +"</select>";

        }
				if(j == 3){ 
             addRadioField (mycurrent_cell, "radio", "inmenu", "1",menuchk1,"edForm");     
             apText(mycurrent_cell," Yes");
             addRadioField (mycurrent_cell, "radio", "inmenu", "0",menuchk0,"edForm");
             apText(mycurrent_cell," No");
         }
				if(j == 4){ 
             addRadioField (mycurrent_cell, "radio", "active", "1",chk1,"edForm");
             apText(mycurrent_cell," Yes");
             addRadioField (mycurrent_cell, "radio", "active", "0",chk0,"edForm");
             apText(mycurrent_cell," No");
         }


        if(j == 5){
			  var sel = document.createElement('select');
			  sel.setAttribute('name', 'mod_group'); 
		  
			  for (i=0; i<UGroup.length; i++) {
			   var OParr = UGroup[i].split("-");
				
				sel.options[i] = new Option(OParr[1], OParr[0]);
				if (OParr[0] == mod_group) { sel.options[i].setAttribute("selected"," selected"); }
			  }
			  mycurrent_cell.appendChild(sel);
			  apText(mycurrent_cell," (Valid only if Registered Users are selected above)");
        }       
        
         if(j == 6){
			  var sel = document.createElement('select');
			  sel.setAttribute('name', 'mcat'); 
			 
			 var arrstr= document.getElementById("catData").innerHTML;
			 var mcatsArray =  arrstr.split(",");

			  for (i=0; i<mcatsArray.length; i++) {
			   var OParr = mcatsArray[i].split("-");
			   sel.options[i] = new Option(OParr[1], OParr[0]);
			   if (mcid == OParr[0]) { sel.options[i].selected=true; }
			  }
			  mycurrent_cell.appendChild(sel);
        }
        if(j == 7){
        		addField (mycurrent_cell,"button","submitED",submitStr,"button"); 
        }
   }else apText(mycurrent_cell,labelStr[j]);

                // appends the cell TD into the row TR
                mycurrent_row.appendChild(mycurrent_cell);
            }
            // appends the row TR into TBODY
            mytablebody.appendChild(mycurrent_row);
        }
        // appends TBODY into TABLE
        mytable.appendChild(mytablebody);
        mytable.setAttribute("border","2");
        mytable.setAttribute("name","tblED");
        mytable.setAttribute("width","70%");

  var f=document.createElement('form');
  f.setAttribute('name','edForm');
  f.setAttribute('id','edForm');
  f.setAttribute('action','#');
  f.setAttribute('method','post');
  
  var hmid=document.createElement("input"); 
  hmid.setAttribute('type', "hidden"); 
  hmid.setAttribute('name', 'mid'); 
  hmid.setAttribute('value',mid); 
  f.appendChild(hmid); 
  
  f.appendChild(mytable); 
  mybody.appendChild(f);
 
    }
function apText(cell,myText){   
   currenttext=document.createTextNode(myText);
   cell.appendChild(currenttext);
}

function editSelected()
{

var labelCatStr = new Array();
labelCatStr[0] = '<?php _NAME ?>';
labelCatStr[1] = 'Visible?';
labelCatStr[2] = ' ';
labelCatStr[3] = ' ';

	var selObj = document.getElementById('selSeaShells');

	var selIndex = selObj.selectedIndex;
	
	var selObj_arr = selObj.options[selIndex].value.split("*");
	var visible = selObj_arr[1];
        if (visible == 1) {
		 visiblechk1="checked";
		 visiblechk0="";
		}else{
		 visiblechk1="";
		 visiblechk0="checked";
		}
		
	var mcname = selObj.options[selIndex].text;
	var mcid  = selObj_arr[0];
	document.getElementById("cat_div").style.display = "none";
	document.getElementById("cat_div0").style.display = "none";
	document.getElementById("cat_div2").style.display = "";
	document.getElementById("cat_div2").innerHTML = '<center><font class="content"><strong><?php _MODCATEGORY ?></strong></font></center><br />';

   var mybody=document.getElementById("cat_div2");
   mytable = document.createElement("TABLE");
   mytablebody = document.createElement("TBODY");
   
   // creating all cells
   for(j=0; j< 3; j++) {
   	
   mycurrent_row=document.createElement("TR");
   for(i=0; i < 2;i++) {
		mycurrent_cell=document.createElement("TD");
		if(i==1) {
				if(j== 0)addField (mycurrent_cell,"text", "mcname",mcname, 51);
				if(j== 1){
		             addRadioField (mycurrent_cell, "radio", "catvisible", "1",visiblechk1,"catForm");     
		             apText(mycurrent_cell," Yes");
		             addRadioField (mycurrent_cell, "radio", "catvisible", "0",visiblechk0,"catForm");     
		             apText(mycurrent_cell," No"); 
				}
		
		        if(j == 2){
		        		addField (mycurrent_cell,"button","","<?php _SAVECHANGES ?>","button1"); 
		        		
		        		apText(mycurrent_cell,"    ");
					var input = document.createElement("input"); 
					input.setAttribute("type", "button");
					input.setAttribute("name","test");
					input.setAttribute("value", "Go Back");
					input.onclick = function(){CatHome(); };
					mycurrent_cell.appendChild(input);
					
					apText(mycurrent_cell,"            ");
		        		addField (mycurrent_cell,"button","","<?php _DELETE ?>","button2"); 
		         }
		         
   }else apText(mycurrent_cell,labelCatStr[j]);

                mycurrent_row.appendChild(mycurrent_cell);
            }
            mytablebody.appendChild(mycurrent_row);
        }

        mytable.appendChild(mytablebody);
        mytable.setAttribute("border","2");

        mytable.setAttribute("width","70%");

  var f=document.createElement('form');
  f.setAttribute('name','catForm');
  f.setAttribute('id','catForm');
  f.setAttribute('action','');
  f.setAttribute('method','post');
  
  var hmcid=document.createElement("input"); 
  hmcid.setAttribute('type', "hidden"); 
  hmcid.setAttribute('name', 'mcid'); 
  hmcid.setAttribute('value',mcid); 

  var myactive=document.createElement("input"); 
  myactive.setAttribute('type', "hidden"); 
  myactive.setAttribute('name', 'mycatvisible'); 
  myactive.setAttribute('value',visible); 
  f.appendChild(myactive); 
  
  f.appendChild(hmcid); 
  f.appendChild(mytable); 
  mybody.appendChild(f);

}


</script>

<div id="catData" style="display:none"></div>
<div id="info"></div>
<div id="CatAdmin" style="display:none;">
<?php


		
    OpenTable();
    echo "<div id=\"cat_div0\">";
    echo "<form>"
        ."<font class=\"content\"><strong>"._ADDMAINCATEGORY."</strong><br /><br />"
        .""._NAME.": <input type=\"text\" id=\"mcnameAdd\" size=\"30\" maxlength=\"100\">"
        ."<input type=\"button\" value=\""._ADD."\" onclick=\"getCatAdd();\">"
        ."</form>";
        echo "</div>";
        echo "<div id=\"cat_div2\" style=\"display:none\"></div>";
    CloseTable();


echo "<div id=\"cat_div\">";
// Modify Category

    $result = $db->sql_query("select * from ".$prefix."_modules_categories");
    $numrows = $db->sql_numrows($result);
    if ($numrows>0) {
        OpenTable();
        echo "<div id=\"catsel_div\"><form>"
            ."<font class=\"content\"><strong>"._MODCATEGORY."</strong></font><br /><br />";
        $result2=$db->sql_query("select mcid, mcname, visible from ".$prefix."_modules_categories order by mcname");
        echo ""._CATEGORY.": <select name=\"cat\" id=\"selSeaShells\">>";
        while(list($mcid2, $mcname2,$visible) = $db->sql_fetchrow($result2)) {
             echo "<option value=\"$mcid2*$visible\">$mcname2</option>";
        }
        echo "</select>"
            ."<input type=\"button\" value=\""._MODIFY."\" onclick=\"editSelected();\">"
            ."</form></div>";
        CloseTable();
      }
        echo "</div></div>";
        
 OpenTable();
 
?>
<div id="main_div"><center><img src='images/loading.gif'> loading...</center></div>

<?php
CloseTable();
include_once("footer.php");
?>

<?php
} else {
	echo "Access Denied";
}
?>