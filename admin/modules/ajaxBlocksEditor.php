<?php
/************************************************************************/
/* ajaxBlocksEditor   v1.33-Platinum Special Edition for Platinum Nuke Pro version Nuke Pro*/
/* Module for phpnuke                                                   */
/* Copyright (C) 2006 aman                                              */
/* Web:   http://www.aman.38.com/phpnuke/                               */
/* Email: aman@aman.38.com   2006-09-23 18:23                           */
/* =====================================================================*/
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */ 
/*                                                                      */ 
/* Copyright (c) 2010-2011 by http://www.platinumnukepro.com            */
/*                                                                                           */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                 */ 
/*     Techgfx - Graeme Allan                       (goose@techgfx.com)   */ 
/*                                                                      */ 
/* Copyright (c) 2004 - 2006 by http://www.conrads-berlin.de            */ 
/*     MrFluffy - Axel Conrads                 (axel@conrads-berlin.de) */ 
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.platinumnukepro.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Refer to PlatinumNukePro.com for detailed information on PNPro*/
/*                                                                      */
/* Platinum Nuke Pro: Expect to be impressed                                */ 
/************************************************************************/
if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
global $prefix, $db, $admin_file, $bgcolor2, $textcolor1;
$StandAlone = (isset($_COOKIE['standalone']))? $_COOKIE['standalone'] : 0;
$bids = (isset($_GET['bids']))? $_GET['bids'] : "";
$ok = (isset($_GET['ok']))? $_GET['ok'] : "";
$SELF=$_SERVER['PHP_SELF']."?op=ajaxBlocksEditor";
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
		if ($StandAlone < 1){
			include_once("header.php");
			$ddpic="user.gif";
			$show=1;
			$alt=_STANDALONE;
		}else{
			echo "<head>\n";
			include_once("includes/meta.php");
			echo "<title>$sitename "._AJAXBlocksEditor."</title>\n";	
			echo "</head>\n";
			$ddpic="mem.gif";
			$show=0;
			$alt=_FULLPAGE;
		}
			echo $script = "<link rel=\"stylesheet\" href=\"includes/javascript/dd_files/lists.css\" type=\"text/css\">\n";
require_once('includes/javascript/dd_files/Sajax.php');
sajax_init();
 $sajax_debug_mode = 1;
sajax_handle_client_request();
if(isset($_POST['order']))
{
	edit_block($data);
	exit;
}
	switch($op) {
			case "ajaxBlocksAdmin":
			ajaxBlocksAdmin();
			break;
			case "ajaxBlocksEditSave":
			ajaxBlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $display);
			break;
			case "ajaxBlocksAdd":
			ajaxBlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $display);
			break;
			case "ajaxBlocksDelete":
			ajaxBlocksDelete($bids, $ok);
			break;
			default :
			ajaxmain();
			break;
	}	
if ($StandAlone < 1)include_once("footer.php");
} else {
	echo "Access Denied";
}

function ajaxmain()
{
  global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1, $admin_file,$StandAlone,$ddpic,$show,$SELF,$alt;
//FF­×¥¿ 20060923 aman
	if(preg_match("/Firefox/", $_SERVER["HTTP_USER_AGENT"])) $inline = "display:inline; position:relative;";
	else $inline = "position:relative;";
	$script = "<script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/javascript/dd_files/coordinates.js\"></script> \n";
	$script .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/javascript/dd_files/drag.js\"></script>\n";
	$script .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"includes/javascript/dd_files/dragdrop.js\"></script> \n";
	echo $script;
OpenTable();
	ajaxOpenTable();
	ajaxOpenTable();
	echo "<center><font class=\"title\"><strong>"._AJAXBlocksEditor."</strong></font></center>";
	echo "<center><font color=green>Green</font> are left blocks</center>";
	echo "<center><font color=yellow>Yellow</font> are center up blocks</center>";
	echo "<center><font color=purple>Purple</font> are center down blocks</center>";
	echo "<center><font color=red>Red</font> are right blocks</center>";
	echo "<center><font color=blue>Blue</font> are inactive blocks</center>";
	echo "<br />";
	echo "<center><img src='images/delete.gif'> clicking this image will delete block</center>";
    echo "<br /><center>"._infoblock1."</center>\n";
        echo "<br /><br /><strong><a href=\"".$admin_file.".php\"><strong><u>"._ADMLINK."</a>";
	ajaxCloseTable();
	?>
	<center>
	<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
	<TBODY>
	<TR valign="bottom">
	<TD align='center'>
	 <form name="sd" action="<?php echo "".$SELF."";?>" method="post" style="margin:0">
	   <br /> 
	   <input type="button" onclick="getSort('delete');" value="<?php echo ""._Delete."";?>">
	   <input type="hidden" name="order" id="order" />
	   <input type="hidden" name="mod">
	   <input type="button" onclick="getSort('sort');" value="<?php echo ""._Order."";?>"/> 
	   <input type="button" onclick="getSort('edit');" value="<?php echo ""._Edit."";?>"/>
	   <input type="button" onclick="chgop('<?php echo "".$_SERVER['PHP_SELF']."";?>?op=ajaxBlocksAdmin');" value="<?php echo ""._AddNewBlock."";?>"/> 
	<a href="<?php echo "".$SELF."";?>"><img src="images/im/reload.gif" border="0" align="absmiddle" alt="refresh"></a></form>
	</TD>
	</TR>
	</TBODY>
	</TABLE>
	<br />
	<FIELDSET class="note">
	<ul id="edit" class="sortable edit" TITLE="<?php echo ""._Blocks2EditOrDelete."";?>"><strong><?php echo ""._Blocks2EditOrDelete."";?></strong>
	</ul>
	<br /><br />
	</FIELDSET>
	<br />
	<ul id="l" class="sortable boxy" TITLE="<?php echo ""._LEFTBLOCK."";?>"><strong><?php echo ""._LEFTBLOCK."";?></strong>
	<?php
	$mySELECT = "SELECT CONCAT(bid,'!',bposition,'!',weight,'!',active) AS lid,CONCAT(UPPER(bposition), weight,' - ',title) AS title,bid";
	$r = $db->sql_query("$mySELECT FROM ".$prefix."_blocks WHERE bposition = 'l' AND active=1 ORDER BY weight ASC"); 
	while($rw = $db->sql_fetchrow($r))
	{
	  $bid = $rw['bid'];
	  $blist[$bid] = $rw['title'];
	  echo "<li id=\"".$rw['lid']."\"><a href='".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bid&amp;ok=1'><img src='images/delete.gif' border='0' alt='Delete 'title='Delete'></a>".$rw['title']."</li> \n";
	}
	?>
	</ul>
    <ul id="c" class="sortable boxc" TITLE="<?php echo ""._CENTERUP."";?>"><strong><?php echo ""._CENTERUP."";?></strong>
	<?php
	$r = $db->sql_query("$mySELECT FROM ".$prefix."_blocks WHERE bposition = 'c' AND active=1 ORDER BY weight ASC");
	while($rw = $db->sql_fetchrow($r)) 
	{
	  $bid = $rw['bid'];
	  $blist[$bid] = $rw['title'];
	  echo "<li id=\"".$rw['lid']."\"><a href='".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bid&amp;ok=1'><img src='images/delete.gif' border='0' alt='Delete 'title='Delete'></a>".$rw['title']."</li> \n";
	}
	?>
	</ul>
    <ul id="d" class="sortable boxd" TITLE="<?php echo ""._CENTERDOWN."";?>"><strong><?php echo ""._CENTERDOWN."";?></strong>
	<?php
	$r = $db->sql_query("$mySELECT FROM ".$prefix."_blocks WHERE bposition = 'd' AND active=1 ORDER BY weight ASC");
	while($rw = $db->sql_fetchrow($r)) 
	{
	  $bid = $rw['bid'];
	  $blist[$bid] = $rw['title'];
	  echo "<li id=\"".$rw['lid']."\"><a href='".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bid&amp;ok=1'><img src='images/delete.gif' border='0' alt='Delete 'title='Delete'></a>".$rw['title']."</li> \n";
	}
	?>
	</ul>
	<ul id="r" class="sortable boxr" TITLE="<?php echo ""._RIGHTBLOCK."";?>"><strong><?php echo ""._RIGHTBLOCK."";?></strong>
	<?php
	$r = $db->sql_query("$mySELECT FROM ".$prefix."_blocks WHERE bposition = 'r' AND active=1 ORDER BY weight ASC");
	while($rw = $db->sql_fetchrow($r))
	{
	  $bid = $rw['bid'];
	  $blist[$bid] = $rw['title'];
	  echo "<li id=\"".$rw['lid']."\"><a href='".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bid&amp;ok=1'><img src='images/delete.gif' border='0' alt='Delete 'title='Delete'></a>".$rw['title']."</a></li> \n";
	}
	?>
	</ul>
<br /><br />
	<FIELDSET name="clsblock" class="note" style="<?php echo "".$inline."";?>">
	<ul id="t" class="sortable bak" TITLE="<?php echo ""._ClosedBlocks."";?>"><strong><?php echo ""._ClosedBlocks."";?></strong>
<?php
	$r = $db->sql_query("SELECT CONCAT(bid,'!',bposition,'!',weight,'!',active) AS lid,CONCAT(UPPER(bposition),' - ',title) AS title,bid FROM ".$prefix."_blocks WHERE  active=0 ORDER BY bposition,weight ASC"); 
	while($rw = $db->sql_fetchrow($r)) 
	{
	  $bid = $rw['bid'];
	  $blist[$bid] = $rw['title'];
	  echo "<li id=\"".$rw['lid']."\"><a href='".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bid&amp;ok=1'><img src='images/delete.gif' border='0' alt='Delete 'title='Delete'></a>".$rw['title']."</li> \n";
	}
	?>
	</ul>
	</FIELDSET>
	<br /><br />
	<?php
	echo "<input type=\"hidden\" name=\"blist\" value=\"".ObjEncode($blist)."\" />
	</form>";
			echo "<table width='90%'><tr><td>\n";
			echo "<div align=\"right\"><a href=\"http://www.aman.38.com/phpnuke/\" target=\"_bank\">www.aman.38.com</a> - <a href=\"javascript:openwindow()\">ajaxBlocksEditor &copy;</a></div>";
			echo "</td></tr></table>\n\n";
			echo "<script type=\"text/javascript\">\n";
			echo "<!--\n";
			echo "function openwindow(){\n";
			echo "	window.open (\"includes/javascript/dd_files/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=450,height=220\");\n";
			echo "}\n";
			echo "//-->\n";
			echo "</script>\n\n";
	ajaxCloseTable();
CloseTable();
}
function BlocksEdit($bid) {
    global $bgcolor2, $bgcolor4, $prefix, $db, $multilingual, $admin_file, $AllowableHTML,$StandAlone;
    if ($StandAlone < 1){
    	//GraphicAdmin();
		OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">"._ADMLINK."</a> ]</div>\n";
    }
    ajaxOpenTable();
    echo "<center><font class=\"title\"><strong><a href='".$admin_file.".php?op=ajaxBlocksEditor'>"._AJAXBlocksEditor."</a> - "._EDITBLOCK."</strong></font></center>";
    ajaxCloseTable();
    echo "<br />";
    $bid = intval($bid);
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
    $row = $db->sql_fetchrow($db->sql_query("select * from ".$prefix."_blocks where bid='$bid'"));
    $groups = $row['groups'];
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
    $bkey = $row['bkey'];
    $title = $row['title'];
    $content = $row['content'];
    $url = $row['url'];
    $bposition = $row['bposition'];
    $weight = intval($row['weight']);
    $active = intval($row['active']);
    $refresh = intval($row['refresh']);
    $blanguage = $row['blanguage'];
    $blockfile = $row['blockfile'];
    $view = intval($row['view']);
    $expire = intval($row['expire']);
    $action = intval($row['action']);
    $subscription = intval($row['subscription']);
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
	$display = $row['display'];
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
    if ($url != "") {
	$type = _RSSCONTENT;
    } elseif ($blockfile != "") {
	$type = _BLOCKFILE;
    }
    ajaxOpenTable();
    echo "<center><font class=\"option\"><strong>"._BLOCK.": $title $type</strong></font></center><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<table border=\"0\" width=\"100%\">"
        ."<tr><td>"._TITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\" value=\"$title\"></td></tr>";
    if ($blockfile != "") {
	echo "<tr><td>"._FILENAME.":</td><td>"
	    ."<select name=\"blockfile\">";
	$blocksdir = dir("blocks");
	while($func=$blocksdir->read()) {
	    if(substr($func, 0, 6) == "block-") {
    		$blockslist .= "$func ";
	    }
	}
	closedir($blocksdir->handle);
	$blockslist = explode(" ", $blockslist);
	sort($blockslist);
	for ($i=0; $i < sizeof($blockslist); $i++) {
	    if($blockslist[$i]!="") {
		$bl = preg_replace("/block-/","",$blockslist[$i]);
		$bl = preg_replace("/.php/","",$bl);
		$bl = preg_replace("/_/"," ",$bl);
		echo "<option value=\"$blockslist[$i]\" ";
		if ($blockfile == $blockslist[$i]) { echo "selected"; }
		echo ">$bl</option>\n";
	    }
	}
	echo "</select>&nbsp;&nbsp;<font class=\"tiny\">"._FILEINCLUDE."</font></td></tr>";
    } else {
	if ($url != "") {
	    echo "<tr><td>"._RSSFILE.":</td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"200\" value=\"$url\">&nbsp;&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font></td></tr>";
	} else {
	    echo "<tr><td>"._CONTENT.":</td><td><textarea name=\"content\" cols=\"50\" rows=\"10\">$content</textarea></td></tr>";
	}
    }
    $oldposition = $bposition;
    echo "<input type=\"hidden\" name=\"oldposition\" value=\"$oldposition\">";
    if ($bposition == "l") {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
    } elseif ($bposition == "c") {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
    } elseif ($bposition == "r") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
    } elseif ($bposition == "d") {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
    }
    echo "<tr><td>"._POSITION.":</td><td><select name=\"bposition\">"
	."<option name=\"bposition\" value=\"l\" $sel1>"._LEFT."</option>"
	."<option name=\"bposition\" value=\"c\" $sel2>"._CENTERUP."</option>"
	."<option name=\"bposition\" value=\"d\" $sel4>"._CENTERDOWN."</option>"
	."<option name=\"bposition\" value=\"r\" $sel3>"._RIGHT."</option></select></td></tr>";
    if ($multilingual == 1) {
	echo "<tr><td>"._LANGUAGE.":</td><td>"
	    ."<select name=\"blanguage\">";
	$handle=opendir('language');
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
	        $languageslist .= "$langFound ";
	    }
	}
	closedir($handle);
	$languageslist = explode(" ", $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
		echo "<option value=\"$languageslist[$i]\" ";
		if($languageslist[$i]==$blanguage) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	if ($blanguage != "") {
	    $sel3 = "";
	} else {
	    $sel3 = "selected";
	}
	echo "<option value=\"\" $sel3>"._ALL."</option></select></td></tr>";
    } else {
	echo "<input type=\"hidden\" name=\"blanguage\" value=\"\">";
    }
    if ($active == 1) {
	$sel1 = "checked";
	$sel2 = "";
    } elseif ($active == 0) {
	$sel1 = "";
	$sel2 = "checked";
    }
    if ($expire != 0) {
        $oldexpire = $expire;
        $expire = intval(($expire - time()) / 3600);
        $exp_day = $expire / 24;
        $expire = "<input type=\"hidden\" name=\"expire\" value=\"$oldexpire\"><strong>$expire "._HOURS." (".substr($exp_day,0,5)." "._DAYS.")</strong>";
    } else {
        $expire = "<input type=\"text\" name=\"expire\" value=\"0\" size=\"4\" maxlength=\"3\"> "._DAYS."";
    }
    if ($action == "d") {
        $selact1 = "selected";
        $selact2 = "";
    } elseif ($action == "r") {
        $selact1 = "";
        $selact2 = "selected";
    }
    echo "<tr><td>"._ACTIVATE2."</td><td><input type=\"radio\" name=\"active\" value=\"1\" $sel1>"._YES." &nbsp;&nbsp;"
        ."<input type=\"radio\" name=\"active\" value=\"0\" $sel2>"._NO."</td></tr>"
        ."<tr><td>"._EXPIRATION.":</td><td>$expire</td></tr>"
        ."<tr><td>"._AFTEREXPIRATION.":</td><td><select name=\"action\">"
        ."<option name=\"action\" value=\"d\" $selact1>"._DEACTIVATE."</option>"
        ."<option name=\"action\" value=\"r\" $selact2>"._DELETE."</option></select></td></tr>";
    if ($url != "") {
    if ($refresh == 1800) {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
    } elseif ($refresh == 3600) {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
    } elseif ($refresh == 18000) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
    } elseif ($refresh == 36000) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
    } elseif ($refresh == 86400) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "selected";
    }
    echo "<tr><td>"._REFRESHTIME.":</td><td><select name=\"refresh\"><option name=\"refresh\" value=\"1800\" $sel1>1/2 "._HOUR."</option>"
        ."<option name=\"refresh\" value=\"3600\" $sel2>1 "._HOUR."</option>"
        ."<option name=\"refresh\" value=\"18000\" $sel3>5 "._HOURS."</option>"
        ."<option name=\"refresh\" value=\"36000\" $sel4>10 "._HOURS."</option>"
        ."<option name=\"refresh\" value=\"86400\" $sel5>24 "._HOURS."</option></select>&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font>";
    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
    if ($view == 0) {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
    } elseif ($view == 1) {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
	$sel4 = "";
	$sel5 = "";
    } elseif ($view == 2) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";
	$sel4 = "";
	$sel5 = "";
    } elseif ($view == 3) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "selected";
	$sel5 = "";
    } elseif ($view > 3) {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "";
	$sel4 = "";
        $sel5 = "selected";
    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
    if ($subscription == 1) {
    	$sub_c1 = "";
    	$sub_c2 = "checked";
    } else {
    	$sub_c1 = "checked";
    	$sub_c2 = "";
    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
    echo "</td></tr><tr><td>"._VIEWPRIV."</td><td><select name=\"view\">"
        ."<option value=\"0\" $sel1>"._MVALL."</option>"
        ."<option value=\"1\" $sel2>"._MVUSERS."</option>"
        ."<option value=\"2\" $sel3>"._MVADMIN."</option>"
        ."<option value=\"3\" $sel4>"._MVANON."</option>"
        ."<option value=\"4\" $sel5>"._MVGROUPS."</option>"
        ."</select></td></tr><tr><td nowrap>"
        ."<strong>"._WHATGROUPS."</strong></td><td><font class='tiny'>"._WHATGRDESC."</font><br /><select name='groups[]' multiple size='5'>";
    $ingroups = explode("-",$groups);
    $groupsResult = $db->sql_query("select gid, gname from ".$prefix."_nsngr_groups");
    while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) {
        if(in_array($gid,$ingroups)) { $sel = " selected"; } else { $sel = ""; }
        echo "<option value='$gid'$sel>$gname</option>";
    }
    echo "</select></td></tr><tr><td nowrap>"
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
		."</select>"
		."</td></tr>"
		."<tr><td>"._WHERE2."</td><td><select name=\"display\">";
	if ($display == 'All') { $sel1 = " SELECTED"; } else { $sel1 = ""; }
	echo "<option value=\"All\"$sel1>All";
	$whereResult = $db->sql_query("select title, custom_title from ".$prefix."_modules where active='1'");
	while(list($ttl, $cttl) = $db->sql_fetchrow($whereResult)) {
		if ($display == $ttl) { $sel = " SELECTED"; } else { $sel = ""; }
		echo "<option value=\"$ttl\"$sel>$cttl";
	}
	echo "</select>" ."</td></tr><tr><td>"
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
        .""._SUBVISIBLE."</td><td><input type='radio' name='subscription' value='0' $sub_c1> "._YES."&nbsp;&nbsp;<input type='radio' name='subscription' value='1' $sub_c2> "._NO.""
		."</td></tr></table><br /><br />"
		."<input type=\"hidden\" name=\"bid\" value=\"$bid\">"
		."<input type=\"hidden\" name=\"bkey\" value=\"$bkey\">"
		."<input type=\"hidden\" name=\"weight\" value=\"$weight\">"
        ."<input type=\"hidden\" name=\"op\" value=\"ajaxBlocksEditSave\">"
        ."<input type=\"submit\" value=\""._SAVEBLOCK."\"></form>";
    ajaxCloseTable();
CloseTable();
    if ($StandAlone < 1)include_once("footer.php");
}
function ajaxBlocksEditSave($bid, $bkey, $title, $content, $url, $oldposition, $bposition, $active, $refresh, $weight, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $display) {
    global $prefix, $db, $admin_file;
     $title =  daddslashes($title);
     $content = daddslashes($content);
    if($view == 4) { $ingroups = implode("-",$groups); }
    if($view < 4) { $ingroups = ""; }
    if ($url != "") {
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	$bkey = "";
	$btime = time();
	if (!preg_match("/http:///",$url)) {
	    $url = "http://$url";
	}
	$rdf = parse_url($url);
	$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
	if (!$fp) {
    	    rssfail();
    	    exit;
	}
	if ($fp) {
    	    fputs($fp, "GET " . $rdf['path'] . "?" . $rdf['query'] . " HTTP/1.0\r\n");
    	    fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
    	    $string	= "";
    	    while(!feof($fp)) {
    		$pagetext = fgets($fp,300);
		$string .= chop($pagetext);
	    }
	    fputs($fp,"Connection: close\r\n\r\n");
	    fclose($fp);
	    $items = explode("</item>",$string);
	    $content = "<font class=\"content\">";
	    for ($i=0;$i<10;$i++) {
		$link = preg_replace("/.*<link>/","",$items[$i]);
		$link = preg_replace("/</link>.*/","",$link);
		$title2 = preg_replace("/.*<title>/","",$items[$i]);
		$title2 = preg_replace("/</title>.*/","",$title2);
		if ($items[$i] == "" AND $cont != 1) {
		    $content = "";
		} else {
		    if (strcmp($link,$title2) AND $items[$i] != "") {
			$cont = 1;
			$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$link\" target=\"new\">$title2</a><br />\n";
		    }
		}
	    }
	}
	if ($oldposition != $bposition) {
	    $result = $db->sql_query("select bid from ".$prefix."_blocks where weight>='$weight' AND bposition='$bposition'");
	    $fweight = $weight;
	    $oweight = $weight;
            while ($row = $db->sql_fetchrow($result)) {
	    $nbid = intval($row['bid']);
		$weight++;
		$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$nbid'");
	    }
	    $result2 = $db->sql_query("select bid from ".$prefix."_blocks where weight>'$oweight' AND bposition='$oldposition'");
            while ($row2 = $db->sql_fetchrow($result2)) {
	    $obid = intval($row2['bid']);
		$db->sql_query("update ".$prefix."_blocks set weight='$oweight' where bid='$obid'");
		$oweight++;
	    }
	    $row3 = $db->sql_fetchrow($db->sql_query("select weight from ".$prefix."_blocks where bposition='$bposition' order by weight DESC limit 0,1"));
            $lastw = $row3['weight'];
	    if ($lastw <= $fweight) {
		$lastw++;
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
		$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', display='$display' where bid='$bid'");
	    } else {
		$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', display='$display' where bid='$bid'");
	    }
	} else {
	    $db->$result = sql_query("update ".$prefix."_blocks set bkey='$bkey', title='$title', content='$content', url='$url', bposition='$bposition', weight='$weight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', display='$display' where bid='$bid'");
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	}
	Header("Location: ".$admin_file.".php?op=BlocksAdmin");
    } else {
	$title = stripslashes(FixQuotes($title));
	$content = stripslashes(FixQuotes($content));
	if ($oldposition != $bposition) {
	    $result5 = $db->sql_query("select bid from ".$prefix."_blocks where weight>='$weight' AND bposition='$bposition'");
	    $fweight = $weight;
	    $oweight = $weight;
            while ($row5 = $db->sql_fetchrow($result5)) {
	    $nbid = intval($row5['bid']);
		$weight++;
		$db->sql_query("update ".$prefix."_blocks set weight='$weight' where bid='$nbid'");
	    }
	    $result6 = $db->sql_query("select bid from ".$prefix."_blocks where weight>'$oweight' AND bposition='$oldposition'");
                while ($row6 = $db->sql_fetchrow($result6)) {
	        $obid = intval($row6['bid']);
		$db->sql_query("update ".$prefix."_blocks set weight='$oweight' where bid='$obid'");
		$oweight++;
	    }
	    $row7 = $db->sql_fetchrow($db->sql_query("select weight from ".$prefix."_blocks where bposition='$bposition' order by weight DESC limit 0,1"));
            $lastw = $row7['weight'];
	    if ($lastw <= $fweight) {
		$lastw++;
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
		$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$lastw', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', display='$display' where bid='$bid'");
	    } else {
		$db->sql_query("update ".$prefix."_blocks set title='$title', content='$content', bposition='$bposition', weight='$fweight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', subscription='$subscription', display='$display' where bid='$bid'");
	    }
	} else {
        if ($expire == "") {
            $expire = 0;
        }
        if ($expire != 0 AND $expire <= 999) {
           $expire = time() + ($expire * 86400);
        }
	    $result8 = $db->sql_query("update ".$prefix."_blocks set bkey='$bkey', title='$title', content='$content', url='$url', bposition='$bposition', weight='$weight', active='$active', refresh='$refresh', blanguage='$blanguage', blockfile='$blockfile', view='$view', groups='$ingroups', expire='$expire', action='$action', subscription='$subscription', display='$display' where bid='$bid'");
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	}
	Header("Location: ".$admin_file.".php?op=ajaxBlocksEditor");
    }
}
function ajaxBlocksAdd($title, $content, $url, $bposition, $active, $refresh, $headline, $blanguage, $blockfile, $view, $groups, $expire, $action, $subscription, $display) {
     $title =  daddslashes($title);
     $content = daddslashes($content);
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
    global $prefix, $db, $admin_file;
    if($view == 4) { $ingroups = implode("-",$groups); }
    if($view < 4) { $ingroups = ""; }
    if ($headline != 0) {
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
	$row = $db->sql_fetchrow($db->sql_query("select sitename, headlinesurl from ".$prefix."_headlines where hid='$headline'"));
    $title = $row['sitename'];
    $url = $row['headlinesurl'];
    }
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT weight FROM ".$prefix."_blocks WHERE bposition='$bposition' ORDER BY weight DESC"));
    $weight = intval($row2['weight']);
    $weight++;
    $title = stripslashes(FixQuotes($title));
    $content = stripslashes(FixQuotes($content));
    $bkey = "";
    $btime = "";
    if ($blockfile != "") {
	$url = "";
	if ($title == "") {
	    $title = preg_replace("/block-/","",$blockfile);
	    $title = preg_replace("/.php/","",$title);
	    $title = preg_replace("/_/"," ",$title);
	}
    }
    if ($url != "") {
	$btime = time();
	if (!preg_match("/http:///",$url)) {
	    $url = "http://$url";
	}
	$rdf = parse_url($url);
	$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
	if (!$fp) {
	    rssfail();
	    exit;
	}
	if ($fp) {
	    fputs($fp, "GET " . $rdf['path'] . "?" . $rdf['query'] . " HTTP/1.0\r\n");
	    fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
	    $string = "";
	    while(!feof($fp)) {
	    	$pagetext = fgets($fp,228);
	    	$string .= chop($pagetext);
	    }
	    fputs($fp,"Connection: close\r\n\r\n");
	    fclose($fp);
	    $items = explode("</item>",$string);
	    $content = "<font class=\"content\">";
	    for ($i=0;$i<10;$i++) {
        
		$link = preg_replace("/.*<link>/","",$items[$i]);
		$link = preg_replace("/</link>.*/","",$link);
		$title2 = preg_replace("/.*<title>/","",$items[$i]);
		$title2 = preg_replace("/</title>.*/","",$title2);
		if ($items[$i] == "" AND $cont != 1) {
		    $content = "";
		} else {
		    if (strcmp($link,$title2) AND $items[$i] != "") {
			$cont = 1;
			$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$link\" target=\"new\">$title2</a><br />\n";
		    }
		}
	    }
	}
    }
    $content = FixQuotes($content);
    if (($content == "") AND ($blockfile == "")) {
	rssfail();
    } else {
    if ($expire == "") {
        $expire = 0;
    }
    if ($expire != 0) {
        $expire = time() + ($expire * 86400);
    }
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
	$db->sql_query("insert into ".$prefix."_blocks values (NULL, '$bkey', '$title', '$content', '$url', '$bposition', '$weight', '$active', '$refresh', '$btime', '$blanguage', '$blockfile', '$view', '$ingroups', '$expire', '$action', '$subscription', '$display')");
	Header("Location: ".$admin_file.".php?op=ajaxBlocksEditor");
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
    }
}
function parse_data($data)
{
  $containers = explode(":", $data);
  foreach($containers AS $container)
  {
      $container = str_replace(")", "", $container); 
      $i = 0;
      $lastly = explode("(", $container);
      $values = explode(",", $lastly[1]);
      foreach($values AS $value)
      {
        if($value == '')
        {
            continue; 
        }
        $final[$lastly[0]][] = $value;
        $i ++;
      }
  }
    return $final;
}
function edit_block($data)
{
	global $db, $prefix, $SELF, $StandAlone;
	$mod = $_POST['mod'];
	$blist = ObjDecode($_POST['blist']);
	$bids = "";
	$eids = array();
		if(isset($_POST['order']))
		{
		  $data = parse_data($_POST['order']);
		  foreach($data AS $bposition  => $item)
		  {
		     $i = 1;
		     foreach($item AS  $bid)
		     { 
				     list($bid,$oposition,$weight,$active) = explode("!", $bid);
				     if($weight!=$i || $bposition!=$oposition)$GoUpdate=1;
				     else $GoUpdate=0;
				     $sqlU="";
					switch ($bposition) {
					    case "l":
					    case "r":
					    case "c":
					    case "d":
					    	if($mod=='sort')$sqlU="UPDATE ".$prefix."_blocks SET bposition = '$bposition', weight = '$i', active = '1' WHERE bid = '$bid'";
					    break;
					    case "edit":
					    	if($mod=='edit')$eids[]= $bid;
					    	if($mod=='delete') {
					    		$bids .= " '$bid',";
					    		$blist2[] = dstripslashes($blist[$bid]);
					    	}
					    break;
					    case "t":
					    	if($mod=='sort')$sqlU="UPDATE ".$prefix."_blocks SET weight = '',active = '0' WHERE bid = '$bid'"; 
					    	$GoUpdate = $active;
					    break;
					}
			       if($mod=='sort' && $GoUpdate==1){$db->sql_query($sqlU);}
			       $i ++;
		    }
		  }
		    $bids = substr($bids,0,-1);
		    if($mod=='delete')DeleteConfirm($bids,$blist2);
		    if($mod=='edit' && is_array($eids))
		    {
				    $eid = $eids[0];
				    if($eid>0)
				    {
					    	BlocksEdit($eid);
					    	if ($StandAlone < 1)include_once("footer.php");
				    }else{
								echo "<script type=\"text/javascript\">
								history.go(-1);
								</SCRIPT>";
				    }
		    }elseif($mod=='sort') header("location: $SELF");
		}
		exit;
}
function ajaxBlocksDelete($bids, $ok=0) {
    global $prefix, $db, $admin_file;
         $bids = stripslashes($bids);
    if ($ok) $db->sql_query("DELETE FROM ".$prefix."_blocks WHERE bid IN ($bids)");
  Header("Location: ".$admin_file.".php?op=ajaxBlocksEditor");
} 
function DeleteConfirm($bids,$blist2) {
	global $admin_file,$StandAlone;
	if(count($blist2)<1)Header("Location: ".$admin_file.".php?op=ajaxBlocksEditor");
	if ($StandAlone < 1){
		//include_once("header.php");
		//GraphicAdmin();
		OpenTable();
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" ._ADMLINK. "</a> ]</div>\n";
	}
	ajaxOpenTable();
	echo "<center><font class=\"title\"><strong><a href='".$admin_file.".php?op=ajaxBlocksEditor'>"._AJAXBlocksEditor."</a></strong></font></center>";
	ajaxCloseTable();
	echo "<br />";
	ajaxOpenTable();
	echo "<center>"._ARESUREDELBLOCK." <i>$title</i>? ";
	//echo "<FIELDSET class=\"note\"><legend>"._Blocks2EditOrDelete."</legend> \n";
	echo "<table><tr><td> \n";
	echo "<ul  id=\"edit2\" class=\"sortable2 edit2\"> \n";
	foreach($blist2 AS $title)echo "<li>$title </li> \n";
	echo "</ul> \n";
	echo "</td></tr></table> \n";
  //echo "</FIELDSET> \n";
	echo "<br /><br />[ <a href=\"".$admin_file.".php?op=ajaxBlocksEditor\">"._NO."</a> | <a href=\"".$admin_file.".php?op=ajaxBlocksDelete&amp;bids=$bids&amp;ok=1\">"._YES."</a> ]</center>";
	ajaxCloseTable();
	if ($StandAlone < 1)include_once("footer.php");
}

	function ajaxBlocksAdmin() {
		global $bgcolor2, $bgcolor4, $prefix, $db, $currentlang, $multilingual, $admin_file,$StandAlone;
		ajaxOpenTable();
		echo "<center><font class=\"title\"><strong><a href='".$admin_file.".php?op=ajaxBlocksEditor'>"._AJAXBlocksEditor."</a> - "._AddNewBlock."</strong></font></center>";
		ajaxCloseTable();
		if ($StandAlone > 0){
		echo "<center><table cellSpacing=\"0\" cellPadding=\"0\" width=\"70%\" border=\"0\">
		<tbody>
		<tr>
		<td>";
		}
	ajaxOpenTable();
	echo "<center><font class=\"option\"><strong>"._ADDNEWBLOCK."</strong></font></center><br /><br />"
	    ."<form action=\"".$admin_file.".php\" method=\"post\">"
	    ."<table border=\"0\" width=\"100%\">"
	    ."<tr><td>"._TITLE.":</td><td><input type=\"text\" name=\"title\" size=\"30\" maxlength=\"60\"></td></tr>"
	    ."<tr><td>"._RSSFILE.":</td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"200\">&nbsp;&nbsp;"
	    ."<select name=\"headline\">"
	    ."<option name=\"headline\" value=\"0\" selected>"._CUSTOM."</option>";
	$res3 = $db->sql_query("select hid, sitename from ".$prefix."_headlines");
	while ($row_res3 = $db->sql_fetchrow($res3)) {
	$hid = intval($row_res3['hid']);
	$htitle = $row_res3['sitename'];
	    echo "<option name=\"headline\" value=\"$hid\">$htitle</option>";
	}
	echo "</select>&nbsp;[ <a href=\"".$admin_file.".php?op=HeadlinesAdmin\">Setup</a> ]<br /><font class=\"tiny\">";
	echo ""._SETUPHEADLINES."</font></td></tr>"
	    ."<tr><td>"._FILENAME.":</td><td>"
	    ."<select name=\"blockfile\">"
	    ."<option name=\"blockfile\" value=\"\" selected>"._NONE."</option>";
	$blocksdir = dir("blocks");
	while($func=$blocksdir->read()) {
	    if(substr($func, 0, 6) == "block-") {
    		$blockslist .= "$func ";
	    }
	}
	closedir($blocksdir->handle);
	$blockslist = explode(" ", $blockslist);
	sort($blockslist);
	for ($i=0; $i < sizeof($blockslist); $i++) {
	    if($blockslist[$i]!="") {
		$bl = preg_replace("/block-/","",$blockslist[$i]);
		$bl = preg_replace("/.php/","",$bl);
		$bl = preg_replace("/_/"," ",$bl);
		$result2 = $db->sql_query("select * from ".$prefix."_blocks where blockfile='$blockslist[$i]'");
		$numrows = $db->sql_numrows($result2);
		if ($numrows == 0) {
		    echo "<option value=\"$blockslist[$i]\">$bl</option>\n";
		}
	    }
	}
	echo "</select>&nbsp;&nbsp;<font class=\"tiny\">"._FILEINCLUDE."</font></td></tr>"
	    ."<tr><td>"._CONTENT.":</td><td><textarea name=\"content\" cols=\"50\" rows=\"10\"></textarea><br /><font class=\"tiny\">"._IFRSSWARNING."</font></td></tr>"
	    ."<tr><td>"._POSITION.":</td><td><select name=\"bposition\"><option name=\"bposition\" value=\"l\">"._LEFT."</option>"
	    ."<option name=\"bposition\" value=\"c\">"._CENTERUP."</option>"
	    ."<option name=\"bposition\" value=\"d\">"._CENTERDOWN."</option>"
	    ."<option name=\"bposition\" value=\"r\">"._RIGHT."</option></select></td></tr>";
    if ($multilingual == 1) {
	echo "<tr><td>"._LANGUAGE.":</td><td>"
	    ."<select name=\"blanguage\">";
	$handle=opendir('language');
	while ($file = readdir($handle)) {
	    if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
	        $langFound = $matches[1];
	        $languageslist .= "$langFound ";
	    }
	}
	closedir($handle);
	$languageslist = explode(" ", $languageslist);
	sort($languageslist);
	for ($i=0; $i < sizeof($languageslist); $i++) {
	    if($languageslist[$i]!="") {
	        echo "<option value=\"$languageslist[$i]\" ";
		if($languageslist[$i]==$currentlang) echo "selected";
		echo ">".ucfirst($languageslist[$i])."</option>\n";
	    }
	}
	echo "<option value=\"\">"._ALL."</option></select></td></tr>";
    } else {
	echo "<input type=\"hidden\" name=\"blanguage\" value=\"\">";
    }
	echo "<tr><td>"._ACTIVATE2."</td><td><input type=\"radio\" name=\"active\" value=\"1\" checked>"._YES." &nbsp;&nbsp;"
	    ."<input type=\"radio\" name=\"active\" value=\"0\">"._NO."</td></tr>"
        ."<tr><td>"._EXPIRATION.":</td><td><input type=\"text\" name=\"expire\" size=\"4\" maxlength=\"3\" value=\"0\"> "._DAYS."</td></tr>"
        ."<tr><td>"._AFTEREXPIRATION.":</td><td><select name=\"action\">"
        ."<option name=\"action\" value=\"d\">"._DEACTIVATE."</option>"
        ."<option name=\"action\" value=\"r\">"._DELETE."</option></select></td></tr>"
	    ."<tr><td>"._REFRESHTIME.":</td><td><select name=\"refresh\">"
	    ."<option name=\"refresh\" value=\"1800\">1/2 "._HOUR."</option>"
	    ."<option name=\"refresh\" value=\"3600\" selected>1 "._HOUR."</option>"
	    ."<option name=\"refresh\" value=\"18000\">5 "._HOURS."</option>"
	    ."<option name=\"refresh\" value=\"36000\">10 "._HOURS."</option>"
	    ."<option name=\"refresh\" value=\"86400\">24 "._HOURS."</option></select>&nbsp;<font class=\"tiny\">"._ONLYHEADLINES."</font></td></tr>"
/*****************************************************/
/* Module - NSN Groups v.1.7.1                 START */
/*****************************************************/
	    ."<tr><td>"._VIEWPRIV."</td><td><select name=\"view\">"
	    ."<option value=\"0\">"._MVALL."</option>"
	    ."<option value=\"1\">"._MVUSERS."</option>"
	    ."<option value=\"2\">"._MVADMIN."</option>"
	    ."<option value=\"3\">"._MVANON."</option>"
	    ."<option value=\"4\">"._MVGROUPS."</option>"
	    ."</select></td></tr><tr><td nowrap>"
	    ."<strong>"._WHATGROUPS."</strong></td><td><font class='tiny'>"._WHATGRDESC."</font><br /><select name='groups[]' multiple size='5'>\n";
        $groupsResult = $db->sql_query("select gid, gname from ".$prefix."_nsngr_groups");
        while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) { echo "<OPTION VALUE='$gid'>$gname</option>\n"; }
	echo "</select></td></tr><tr><td nowrap>\n"
/*****************************************************/
/* Module - NSN Groups v.1.7.1                   END */
/*****************************************************/
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1          START */
/*****************************************************/
		."<tr><td>"._WHERE2."</td><td><select name=\"display\">"
		."<option value=\"All\">All";
	$whereResult = $db->sql_query("select title, custom_title from ".$prefix."_modules where active='1'");
	while(list($ttl, $cttl) = $db->sql_fetchrow($whereResult)) {
		echo "<option value=\"$ttl\">$cttl";
	}
	echo "</select></td></tr><tr><td nowrap>"
/*****************************************************/
/* Addon - Conditional Blocks v.1.1.1            END */
/*****************************************************/
	    .""._SUBVISIBLE."</td><td><input type=\"radio\" name=\"subscription\" value=\"0\" checked>"._YES." &nbsp;&nbsp;<input type=\"radio\" name=\"subscription\" value=\"1\">"._NO.""
	    ."</td></tr></table><br /><br />"
	    ."<input type=\"hidden\" name=\"op\" value=\"ajaxBlocksAdd\">"
	    ."<input type=\"submit\" value=\""._CREATEBLOCK."\"></form>";
	ajaxCloseTable();
		if ($StandAlone > 0)
		{
				echo "
				</td>
				</tr>
				</table>";
		}else include_once("footer.php");
}
function daddslashes(&$string) {
	if(!$GLOBALS['magic_quotes_gpc']) {
			$string = addslashes($string);
	}
	return $string;
}
function dstripslashes(&$string) {
	if(!$GLOBALS['magic_quotes_gpc']) {
			$string = stripslashes($string);
	}
	return $string;
}
function ObjDecode($obj){
   Return unserialize(base64_decode($obj));  
} 
function ObjEncode($obj){
   Return base64_encode(Serialize($obj));
}
function ajaxOpenTable() {
    ?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td>
<table width="100%"  border="0" cellpadding="1" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td>
<?php
}
function ajaxCloseTable() {
    ?>
</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr>
</table>
<?php
}
?>