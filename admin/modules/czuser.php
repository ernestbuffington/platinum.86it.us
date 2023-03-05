<script type="text/javascript">
function changeMembersSize(showhide) {
document.getElementById('members_hide').style.display='none';
document.getElementById('members_show').style.display='none';
document.getElementById('members_'+showhide).style.display='block';
}
function changeMembers1Size(showhide) {
document.getElementById('members1_hide').style.display='none';
document.getElementById('members1_show').style.display='none';
document.getElementById('members1_'+showhide).style.display='block';
}
function changeMembers2Size(showhide) {
document.getElementById('members2_hide').style.display='none';
document.getElementById('members2_show').style.display='none';
document.getElementById('members2_'+showhide).style.display='block';
}
function changeMembers3Size(showhide) {
document.getElementById('members3_hide').style.display='none';
document.getElementById('members3_show').style.display='none';
document.getElementById('members3_'+showhide).style.display='block';
}
</script>
<?php
/********************************************************************
                  CZUser Info V5 Universal Block
	(c) 2002 - 2004 by Codezwiz Network - http://www.codezwiz.com		 	
	(c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
	  (c) 2007 - 2008 by PlatinumNuke - http://www.platinumnukepro.com
	 Special Thanks To Technocrat - http://www.nuke-evolution.com
		Modified For Use With Platinum Platinum Nuke Pro ONLY!!
********************************************************************/
/********************************************************************
			           Modifications Include
 [ Advanced Member Image Control              Last updated 29/07/07]  			   
 [ Enhanced Security GFX Check                Last updated 29/07/07] 
 [ Ip Display                                 Last updated 29/07/07] 
 [ Post Count Display						  Last updated 29/07/07] 
 [ Page View/Hits Display					  Last updated 29/07/07] 
 [ Guest & Bots Display						  Last updated 05/08/07]
 [ Tooltip MouseOver Feature				  Last updated 04/08/07]
 [ Advanced Username Color					  Last updated 29/07/07]
 [ Audio Private Message Alert				  Last updated 29/07/07] 
 [ BBForum group Display					  Last updated 29/07/07]
 [ Chopped Usernames                          Last updated 29/07/07]
********************************************************************/
$aid = substr("$aid", 0, 25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM ".$prefix."_authors WHERE aid = '$aid'"));
if ($row['radminsuper'] == 1) {
function main() {
	global $db, $prefix, $user_prefix, $admin_file;
	$catpath = 'images/CZUser/admin/';
	$imagepath = 'images/CZUser/';
    include_once('header.php');
    OpenTable();
	echo "
		<script language=\"javascript\" type=\"text/javascript\">
			function update_pic(newimage) {
				document.pic_image.src = '".$catpath."' + newimage;
			}
		</script>
		<center><strong><font class=\"title\"><a href='".$admin_file.".php?op=czuser'>CZUser Control Panel</a></font><br /><br />
		[ <a href='".$admin_file.".php'>Back to Site Administration</a> ]</strong><br /><br /><br />
	";
	$result = $db->sql_query("SELECT w.pic, w.view, w.king, w.gname, u.user_color_gc FROM ".$prefix."_czuser_info AS w LEFT JOIN ".$user_prefix."_users AS u ON u.username = w.view");
	echo "<table border='1' cellpadding='3' cellspacing='0' align='center'>";
	while (list($pic, $view, $king, $gname, $user_color_gc) = $db->sql_fetchrow($result)) {
	$uname_color = UsernameColor($user_color_gc,$view);
       	if ($king == '1') $img = "admin.png"; elseif ($king == '0') $img = "msg.png";
	echo "<tr><td valign='middle' align='center'>".$uname_color." <img src='".$catpath."".$pic."' border='0'></td>";
	echo "<td valign='middle' align='center'><img src='".$imagepath."".$img."' border='0'></td><td valign='middle' align='center'>";
	echo "<a href='".$admin_file.".php?op=editurstaff&amp;s=".$view."'><img src='".$imagepath."edit.gif' title='Edit' border='0'></a>";
	echo "<a href='".$admin_file.".php?op=delurstaff&amp;del_urstaff=".$view."'><img src='".$imagepath."delete.gif' title='Delete' border='0'></a></td>";
	if(!$gname){
	echo "<td valign='middle' align='center'>No group Selected</td>";
	}else{
	echo "<td valign='middle' align='center'>".$gname."</td>";
	}
	}
	echo "</tr></table><br />";
	$result = $db->sql_query("SELECT ".$user_prefix."_users.username FROM ".$user_prefix."_users LEFT JOIN ".$prefix."_czuser_info ON ".$user_prefix."_users.username=".$prefix."_czuser_info.view WHERE ".$user_prefix."_users.user_id > 1 AND ".$prefix."_czuser_info.view IS NULL ORDER BY ".$user_prefix."_users.username");
	$ut = $db->sql_numrows($result); $lista = array();
	while ($listuser = $db->sql_fetchrow($result)) array_push($lista, $listuser['username']);
	if ($ut > 500) {
		echo "
		<table border='1' cellpadding='3' cellspacing='0' align='center'>
			<tr><td align='middle' colspan='2'><strong>User Selection</strong></td><tr>
			<tr>
			  <td align='right'>List selector</td>
			  <td align='left'>
		";
	}
	echo "<form action='".$admin_file.".php?op=addurstaff' method='post'><select name='add_name'>";
	$p = $_GET['p']; if (isset($p) && (($p - 1) * 500) < $ut) $inizio = ($p - 1) * 500; else $inizio = 0;
	$fine = $inizio + 499; if ($fine > $ut - 1) $fine = $ut - 1;
	for ($u = $inizio; $u <= $fine; $u++) echo "<option value='".$lista[$u]."'>".$lista[$u]."</option>";
	echo "</select>";	
	if ($ut > 500) {
		$tp = floor($ut / 500);
		$np = $tp + (fmod($ut, 500) > 0 ? 1 : 0);
		$lp = '';
		for ($p = 1; $p < $np; $p++) $lp .= "<a href='".$admin_file.".php?op=czuser&amp;p=".$p."'>".$p."</a> | ";
		$lp .= "<a href='".$admin_file.".php?op=czuser&amp;p=".$np."'>".$np."</a>";
		echo "
			</td></tr>
			<tr>
				<td align='right'>Page select</td>
				<td align='left'>$lp</td>
			</tr>
			<tr>
				<td align='right'>Manual input</td>
				<td align='left'><input type='text' name='manual_name' value='' title='Leave empty if you want to use the above selector'></td>
			</tr>";
		echo "</td></tr></table><br />";
	} else echo "&nbsp;";
	echo "Image <select name='add_pic' onchange='update_pic(this.options[selectedIndex].value);'>";
    $handle = opendir("".$catpath."");
	$tlist = '';
	while ($file = readdir($handle)) if (preg_match("/.*\.(png|gif|jpg|jpeg)$/", $file)) $tlist .= "$file|";
	closedir($handle);
	$tlist = explode("|", $tlist);
	sort($tlist);
	for ($i = 0; $i < sizeof($tlist); $i++) if ($tlist[$i] != "") echo "<option value=\"$tlist[$i]\">$tlist[$i]</option>";
	echo "</select>&nbsp;";
	echo "<img name='pic_image' src='".$catpath."admin.gif' border='0'>";
	echo "&nbsp;<img src='".$imagepath."admin.png' border='0'>";
	echo "<input type='checkbox' name='add_king' id='add_king' value='1'><label for='add_king'>Staff</label>";
	echo "&nbsp;&nbsp;&nbsp;<SELECT NAME='gname'><OPTION VALUE=''>Select Group";
	$i=0;
    $fmsql = "SELECT * FROM ".$prefix."_bbgroups WHERE group_single_user = '0'";
    if( !($fmresult = $db->sql_query($fmsql)) ){echo "ERROR, UNABLE TO OPEN GROUPS TABLE!";exit();
    }
    while ($groups = $db->sql_fetchrow($fmresult))
    {
    $group_name = $groups['group_name'];
	echo "<OPTION VALUE='".$group_name."'>".$group_name."";
	}
	echo "</SELECT>";
	echo "		<br /><br /><input type='submit' value='Add User To Database'>";
	echo "	</form>";
	echo "	</center><br />";
	CloseTable();
	OpenTable();
	$uploaddir = 'images/CZUser/admin/';
	echo "
		<center>
		<form enctype='multipart/form-data' action='".$admin_file.".php?op=uploadcategory' method='post'>
			<input type='hidden' name='MAX_FILE_SIZE' value='30000'>
			Send this image: <input name='userfile' type='file'>
			<br /><br />
			<input type='submit' value='Upload Category Image'>
		</form>";
	echo "<div id=\"members3_hide\" style=\"display: block;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers3Size ('show'); return false;\" style=\"cursor: hand;\"><input type='button' value='Show Category Images'></font></a></span></center></div></div>";
	echo "<div id=\"members3_show\" style=\"display: none;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers3Size ('hide'); return false;\" style=\"cursor: hand;\"><input type='button' value='Show Category Images'></font></a></span></center>";
	echo "<br /><table border='1' cellpadding='3' cellspacing='0' align='center'>";
	if ($handle = opendir($catpath)) {
		while ($file = readdir($handle)) {
			if (preg_match("/.*\.(png|gif|jpg|jpeg)$/", $file)) {
				echo "<tr><td valign='middle' align='center'><img src='images/CZUser/admin/$file'></td><td valign='middle' align='center'><a href='".$admin_file.".php?op=delurcat&amp;del_urcat=$file'><img src='images/CZUser/delete.gif' title='Delete' border='0'></a><br /></td>";
			}
		}
		closedir($handle);
		echo "</tr></table>";
	}
	echo "</div></div>";
	CloseTable();
	OpenTable();
	$conf = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_czuser_conf"));	
	echo "<div id=\"members_hide\" style=\"display: block;\"><div class=\"content\"><br /><center><span onclick=\"changeMembersSize ('show'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th width='80%'>Block Configuration</th></tr></table></font></a></span></center></div></div>";
	echo "<div id=\"members_show\" style=\"display: none;\"><div class=\"content\"><br /><center><span onclick=\"changeMembersSize ('hide'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th>Block Configuration</th></tr></table></font></a></span></center>";
?>
<!--<table width='80%' border='1' align="center">
  <tr>
    <th width='80%'>Block Configuration</th>
  </tr>
</table>-->
<form action='<?php echo $admin_file ?>.php?op=ursettings' method='post' style='margin:0,0,0,0'>
<table width='80%' border='1' align="center">
  <tr>
    <td width='40%'><strong>Display IP Address:</strong></td>
<?php
	if($conf['user_ip'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='user_ip' type='radio' value='1' checked/>&nbsp;<strong>No:</strong><input name='user_ip' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='user_ip' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='user_ip' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show Private Messages:</strong></td>
<?php
	if($conf['pms'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='pms' type='radio' value='1' checked/>&nbsp;<strong>No:</strong><input name='pms' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='pms' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='pms' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show Points:</strong></td>
<?php
	if($conf['spoint'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='spoint' type='radio' value='1' checked/>&nbsp;<strong>No:</strong><input name='spoint' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='spoint' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='spoint' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show User Posts:</strong></td>
<?php
	if($conf['user_posts'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='user_posts' type='radio' value='1' checked/>&nbsp;<strong>No:</strong><input name='user_posts' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='user_posts' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='user_posts' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display User Avatars:</strong></td>
<?php
	if($conf['avatar'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='avatar' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='avatar' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='avatar' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='avatar' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
    <tr>
    <td width='40%'><strong>Display Forum BBRanks:</strong></td>
<?php
	if($conf['bbranks'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='bbranks' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='bbranks' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='bbranks' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='bbranks' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show Most Ever Online:</strong></td>
<?php
    if($conf['most'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='most' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='most' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='most' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='most' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show PageHits:</strong></td>
<?php
    if($conf['hits'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='hits' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='hits' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='hits' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='hits' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Show Group Memberships:</strong></td>
<?php
	if($conf['groups'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='groups' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='groups' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='groups' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='groups' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>ToolTip Mode:</strong></td>
<?php
    if($conf['tooltip'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='tooltip' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='tooltip' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='tooltip' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='tooltip' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display OnLine Users to Anonymous:</strong></td>
<?php
	if($conf['online'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='online' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='online' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='online' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='online' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
    <tr>
    <td width='40%'><strong>Display Guest & Bots:</strong></td>
<?php
	if($conf['guests'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='guests' type='radio' value='1' checked />&nbsp;<strong>No:</strong><input name='guests' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><strong>Yes:</strong><input name='guests' type='radio' value='1' />&nbsp;<strong>No:</strong><input name='guests' type='radio' value='0' checked /></td>";
	}
?>
  </tr>
  <tr>
    <td width='40%'><strong>Use Chopped Names:</strong></td>
<?php
    if($conf['chopped'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='chopped' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='chopped' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='chopped' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='chopped' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Use image or numbers:</strong></td>
<?php
	if($conf['pick'] == 1){
    echo "<td width='40%' align='center'><img src='".$imagepath."msg.png' border='0'><input name='pick' type='radio' value='1' checked />&nbsp;<strong>01.</strong><input name='pick' type='radio' value='0' /></td>";
	}else{
	echo "<td width='40%' align='center'><img src='".$imagepath."msg.png' border='0'><input name='pick' type='radio' value='1' />&nbsp;<strong>01.</strong><input name='pick' type='radio' value='0' checked /></td>";
	}
?>
  </tr> 
  <tr>
    <td width='40%'><strong>Order Online Users By:</strong></td>
<?php
    if($conf['ordermode'] == 1){
    echo "<td width='40%' align='center'><strong>Username:</strong><input name='ordermode' type='radio' value='1' checked>&nbsp;<strong>User ID:</strong><input name='ordermode' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Username:</strong><input name='ordermode' type='radio' value='1'>&nbsp;<strong>User ID:</strong><input name='ordermode' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
</table>
<?php
	echo"</div></div>";
//if($conf['chopped'] == 1){
	echo "<br />";
	echo "<div id=\"members1_hide\" style=\"display: block;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers1Size ('show'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th width='80%'>Chopped Name's Function</th></tr></table></font></a></span></center></div></div>";
	echo "<div id=\"members1_show\" style=\"display: none;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers1Size ('hide'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th width='80%'>Chopped Name's Function</th></tr></table></font></a></span></center>";
?>
<!--<table width='80%' border='1' align="center">
  <tr><th>Chopped Name's Function</th></tr>
</table>-->
<table width='80%' border='1' align="center">
  <tr>
    <td width='40%'><strong>Characters Before Name Is Chopped:</strong></td>
    <td width='40%'><input name='charnum' type='text' size='15' value='<?php $conf['charnum']?>'></td>
  </tr>
</table>
<?php
echo"</div></div>";
//}
?>
<!--[START] Tooltip Feature Extras-->
<?php
//if($conf['tooltip'] == 1){
	echo "<br />";
	echo "<div id=\"members2_hide\" style=\"display: block;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers2Size ('show'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th width='80%'>Tooltip Feature Extra's</th></tr></table></font></a></span></center></div></div>";
	echo "<div id=\"members2_show\" style=\"display: none;\"><div class=\"content\"><br /><center><span onclick=\"changeMembers2Size ('hide'); return false;\" style=\"cursor: hand;\"><table width='80%' border='1' align='center'><tr><th width='80%'>Tooltip Feature Extra's</th></tr></table></font></a></span></center>";
?>
<!--<table width='80%' border='1' align="center">
  <tr><th width='80%'>Tooltip Feature Extra's</th></tr>
</table>-->
<table width='80%' border='1' align="center">
  <tr>
    <td width='40%'><strong>Display Avatar:</strong></td>
<?php
    if($conf['davatar'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='davatar' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='davatar' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='davatar' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='davatar' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Username:</strong></td>
<?php
    if($conf['duser'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='duser' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='duser' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='duser' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='duser' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Email Addy:</strong></td>
<?php
    if($conf['demail'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='demail' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='demail' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='demail' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='demail' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Registration Date:</strong></td>
<?php
    if($conf['dreg'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dreg' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='dreg' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dreg' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='dreg' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
    <tr>
    <td width='40%'><strong>Display Gender:</strong></td>
<?php
    if($conf['dgender'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dgender' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='dgender' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dgender' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='dgender' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Post Count:</strong></td>
<?php
    if($conf['dpost'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dpost' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='dpost' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dpost' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='dpost' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Theme Used:</strong></td>
<?php
    if($conf['dtheme'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dtheme' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='dtheme' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dtheme' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='dtheme' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
  <tr>
    <td width='40%'><strong>Display Site Location:</strong></td>
<?php
    if($conf['dwhere'] == 1){
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dwhere' type='radio' value='1' checked>&nbsp;<strong>No:</strong><input name='dwhere' type='radio' value='0'></td>";
    }else{
    echo "<td width='40%' align='center'><strong>Yes:</strong><input name='dwhere' type='radio' value='1'>&nbsp;<strong>No:</strong><input name='dwhere' type='radio' value='0' checked></td>";
    } 
?>
  </tr>
</table>
<?php
	echo"</div></div>"; 
//} 
?>
<!--[END] Tooltip Feature Extras-->
<br /><br /><center><input type='submit' value='Save Block Settings'></center></form>
<?php
    echo "<div align='right'><a href='http://www.darkforgegfx.com'>DFG &copy;</a></div>";
	CloseTable();
	include_once('footer.php');
}
function editStaff($s) {
	global $db, $prefix, $admin_file, $user_prefix;
	$catpath = 'images/CZUser/admin/';
	$imagepath = 'images/CZUser/';
    include_once('header.php');
    OpenTable();
	echo "
		<script language='javascript' type='text/javascript'>
			function update_pic(newimage) {
				document.pic_image.src = '".$catpath."' + newimage;
			}
		</script>
		<center>";
	$result = $db->sql_query("SELECT pic, king, gname, user_color_gc FROM ".$prefix."_czuser_info AS w LEFT JOIN ".$user_prefix."_users AS u ON u.username = w.view WHERE view = '$s'");
	//$result = $db->sql_query("SELECT pic, king FROM ".$prefix."_czuser_info WHERE view = '$s'");
	echo "<table width='220' border='1' cellpadding='1' cellspacing='1' align='center'><tr>";
	list($pic, $king, $gname, $c) = $db->sql_fetchrow($result);
  	if ($king == '1') $img = "admin.png"; elseif ($king == '0') $img = "msg.png";
	echo "<strong><font class='title'>Editing ".UsernameColor($c,$s)."</font><br /><br />"._GOBACK."</strong><br /><br /><br />";
	echo "<td valign='middle' align='center'>".UsernameColor($c,$s)." <img src='".$catpath."".$pic."' name='pic_image' border='0'></td><td valign='middle' align='center'><img src='".$imagepath."".$img."' border='0'></td>";
	if(!$gname){
	echo "<td valign='middle' align='center'>No group Selected</td>";
	}else{
	echo "<td valign='middle' align='center'>".$gname."</td>";
	}
	echo "</tr></table><br /><br />";
	echo "
		<form action='".$admin_file.".php?op=updateurstaff' method='post'>
			Image <select name='pic' onchange='update_pic(this.options[selectedIndex].value);'>
	";
    $handle = opendir("".$catpath."");
	$tlist = '';
	while ($file = readdir($handle)) if (preg_match("/.*\.(png|gif|jpg|jpeg)$/", $file)) $tlist .= "$file|";
	closedir($handle);
	$tlist = explode("|", $tlist);
	sort($tlist);
	for ($i = 0; $i < sizeof($tlist); $i++) {
		if ($tlist[$i] != "") {
			if ($tlist[$i] == $pic) $sel = 'selected'; else $sel = '';
			echo "<option value='".$tlist[$i]."' ".$sel.">".$tlist[$i]."</option>";
		}
	}
	echo "</select>&nbsp;";
	echo "		<img src='".$imagepath."admin.png' border='0'>";
	echo "		<input type='checkbox' name='king' id='king' value='1'><label for='king'>Staff</label>";
	echo "&nbsp;&nbsp;&nbsp;<SELECT NAME='gname'><OPTION VALUE=''>Select Group";
	$i=0;
    $fmsql = "SELECT * FROM ".$prefix."_bbgroups WHERE group_single_user = '0'";
    if( !($fmresult = $db->sql_query($fmsql)) ){echo "ERROR, UNABLE TO OPEN GROUPS TABLE!";exit();
    }
    while ($groups = $db->sql_fetchrow($fmresult))
    {
     	$group_name = $groups['group_name'];
	if ($gname == $group_name){
    echo "<OPTION SELECTED='".$group_name."'>".$group_name.""; 
    } else {
	echo "<OPTION VALUE='".$group_name."'>".$group_name."";
	}
	}
	echo "</SELECT>";
	echo "		<br /><br /><input type='submit' value='Update User'>";
	echo "		<input type='hidden' name='urid' value='".$s."'>";
	echo "	</form>";
	echo "	</center><br />";
	echo "<div align='right'><a href='http://www.darkforgegfx.com'>DFG &copy;</a></div>";
	CloseTable();
	include_once('footer.php');
}
function errorMsg($msg) {
	include_once('header.php');
    OpenTable();
	echo "<center><strong>$msg<br /><br />
		"._GOBACK."</strong><br /><br /><br /></center>";
	CloseTable();
	include_once('footer.php');
}
function check_image_type($type) {
	switch($type) {
		case 'image/jpeg':
		case 'image/pjpeg':
		case 'image/jpg':
			return '.jpg';
			break;
		case 'image/gif':
			return '.gif';
			break;
		case 'image/png':
			return '.png';
			break;
		default:
			return false;
			break;
	}
	return false;
}
switch ($op) {
	case "addurstaff":
		if (isset($manual_name) && $manual_name != '') $add_name = $manual_name;
		$tmp = $db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username = '$add_name'");
		if ($db->sql_numrows($tmp) != 1) {
			include_once('header.php');
    		OpenTable();
			echo "<center><strong>ERROR: The user '$add_name' does not exist.<br /><br />"._GOBACK."</strong></center>";
			CloseTable();
			include_once('footer.php');
		} else {
			$db->sql_query("INSERT INTO ".$prefix."_czuser_info (pic, view, king, gname) VALUES ('$add_pic', '$add_name', '$add_king', '$gname')");
			Header("Location: $admin_file.php?op=czuser");
		}
		break;
	case "updateurstaff":
		$db->sql_query("UPDATE ".$prefix."_czuser_info SET pic = '$pic', king = '$king', gname='$gname' WHERE view = '$urid'");
		Header("Location: $admin_file.php?op=czuser");
		break;
	case "delurstaff":
		$db->sql_query("DELETE FROM ".$prefix."_czuser_info WHERE view = '$del_urstaff'");
		Header("Location: $admin_file.php?op=czuser");
		break;
	case "delurcat":
		unlink("images/CZUser/admin/$del_urcat");
		Header("Location: $admin_file.php?op=czuser");
		break;
	case "editurstaff":
		editStaff($s);
		break;
	case "ursettings":
		$db->sql_query("UPDATE ".$prefix."_czuser_conf SET user_ip='$user_ip', pms='$pms', spoint='$spoint', user_posts='$user_posts', avatar='$avatar', bbranks='$bbranks', most='$most', hits='$hits', groups='$groups', tooltip='$tooltip', online='$online', guests='$guests', chopped='$chopped', pick='$pick', ordermode='$ordermode', charnum='$charnum',davatar='$davatar', duser='$duser', demail='$demail', dreg='$dreg', dgender='$dgender', dpost='$dpost', dtheme='$dtheme', dwhere='$dwhere'");
		Header("Location: $admin_file.php?op=czuser");
		break;
	case "uploadcategory":
		// Abilita solo l'upload di immagini con altezza < 15 px
		$uploaddir = 'images/CZUser/admin/';
		if (check_image_type($_FILES['userfile']['type']) == false) errorMsg('ERROR! Unknown image format');
		list($width, $height) = @getimagesize($_FILES['userfile']['tmp_name']);
		if ($height > 15) errorMsg('ERROR! Max Height for images is set to 15 pixels');
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name'])) {
   			Header("Location: $admin_file.php?op=czuser");
		} else {
			errorMsg('ERROR uploading image. Please try again');
		}
		break;
	default: main();
}
} else {
	echo "Access Denied";
}
?>