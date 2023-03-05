<?php
if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}
global $db, $prefix, $admin_file;
$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'") or die(mysqli_error($db));
list($radminsuper) = $db->sql_fetchrow($result) or die(mysqli_error($db));
if ( !$radminsuper == 1 )
{
    echo "Access Denied";
}

function Donations() 
{
    global $db, $admin, $bgcolor2, $prefix, $currentlang, $multilingual, $admin_file;
    include_once("header.php");
	include_once("modules/Donations/config.php");
	
	$currentPage = $_SERVER["PHP_SELF"];
	// Register paging
	$maxRows_Recordset1 = 10;
	$pageNum_Recordset1 = 0;
	if (isset($_POST['pageNum_Recordset1'])) {
	  $pageNum_Recordset1 = $_POST['pageNum_Recordset1'];
	}
	$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
	//$db->sql_query($dbname);
	$query_Recordset1 = "SELECT id, date, DATE_FORMAT(date, '%d-%b-%Y') as fdate, num, name, descr, amount FROM ".$prefix."_don_financial order by date DESC";
	$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
	$Recordset1 = $db->sql_query($query_limit_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	if (isset($_POST['totalRows_Recordset1'])) {
	  $totalRows_Recordset1 = $_POST['totalRows_Recordset1'];
	} else {
	  $all_Recordset1 = $db->sql_query($query_Recordset1);
	  $totalRows_Recordset1 = $db->sql_numrows($all_Recordset1);
	}
	$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
	$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d#AdminTop", $totalRows_Recordset1);
	// Collect IPN reconcile data
	// First, get the date of the last time we reconciled
	$query_Recordset2 = 'SELECT `date` as recdate'
        . ' FROM '.$prefix.'_don_financial'
        . ' WHERE name = \'PayPal IPN\''
        . ' ORDER BY date DESC '
        . ' LIMIT 1 ';
	$Recordset2 = $db->sql_query($query_Recordset2);
	$row_Recordset2 = $db->sql_fetchrow($Recordset2);
	$recdate = $row_Recordset2[recdate];
	// Get the date of the last donation
	$query_Recordset2 = 'SELECT `payment_date` as curdate'
        . ' FROM '.$prefix.'_don_transactions'
        . ' WHERE payment_status = \'Completed\' AND ( transactions.txn_type = \'send_money\' OR transactions.txn_type = \'web_accept\' )'
        . ' ORDER BY payment_date DESC '
        . ' LIMIT 1 ';
	$Recordset2 = $db->sql_query($query_Recordset2);
	$row_Recordset2 = $db->sql_fetchrow($Recordset2);
	$curdate = $row_Recordset2[curdate];
	// Collect the IPN transactions between recdate and curdate
	$query_Recordset2 = 'SELECT custom, SUM( mc_gross )  AS gross, SUM( mc_gross - mc_fee ) AS net'
		. ' FROM '.$prefix.'_don_transactions '
		. ' WHERE ( payment_Date > \'' . $recdate . '\' AND payment_date <= \'' . $curdate . '\' ) '
		. ' GROUP  BY txn_id ';
	$Recordset2 = $db->sql_query($query_Recordset2);
	// Iterate over the records skipping the ones that total out to zero(refunds)
	$ipn_tot = 0;
	$num_ipn = 0;
	while( $row_Recordset2 = $db->sql_fetchrow($Recordset2) )
	{
		if( $row_Recordset2[gross] > 0 )
		{
			$ipn_tot += $row_Recordset2[net];
			$num_ipn++;
		}
	}
	// Get the register balance
	$query_Recordset4 = "SELECT SUM(amount) as total FROM ".$prefix."_don_financial";
	$Recordset4 = $db->sql_query($query_Recordset4);
	$row_Recordset4 = $db->sql_fetchrow($Recordset4);
	$total = $row_Recordset4[total];
	// Output the page
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
	echo "<a name=\"AdminTop\"></a>";
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Administration</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"option\"><b>Donations Financial Register</b></font></center><br>";
    echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
    echo "<tr><td width=\"100%\">";
	echo "<form action=\"".$admin_file.".php?op=Config#AdminTop\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"op\" value=\"Config\"><input type=\"submit\" value=\"Config\"></form>";
	echo "</td></tr>";
    echo "<tr><td width=\"100%\">";
	echo "Number of new IPN records: $num_ipn - Totaling \$$ipn_tot";
	echo "</td></tr>";
    echo "<tr><td width=\"100%\">";
	echo "<form action=\"".$admin_file.".php?op=IpnRec#AdminTop\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"op\" value=\"IpnRec\">"
		."<input type=\"submit\" value=\"PayPal IPN reconcile\" onClick=\"return confirm('This action will total up all recent PayPal IPN" . '\n' . "transactions and post them here in the register." . '\n\n' . "Are you sure you want to do this now?')\">"
		."</form>";
	echo "</td></tr></table>";
$currentPage = "".$admin_file.".php?op=Donations";
	echo "<center><table border=\"0\"><tr>";
	if( $pageNum_Recordset1 > 0 )
	{
		echo '<td><form action="'.$admin_file.'.php#AdminTop" method=\"post\">'
		   . '<input type="hidden" name="op" value="Donations">'
		   . '<input type="hidden" name="pageNum_Recordset1" value="0">'
		   . '<input type="hidden" name="totalRows_Recordset1" value="' . $totalRows_Recordset1 . '">'
		   . '<input type="submit" name="navig" value="|&lt;" title="Current"></form></td>';
		echo '<td><form action="'.$admin_file.'.php#AdminTop" method="post">'
		   . '<input type="hidden" name="op" value="Donations">'
		   . '<input type="hidden" name="pageNum_Recordset1" value="' . max(0, $pageNum_Recordset1 - 1) . '">'
		   . '<input type="hidden" name="totalRows_Recordset1" value="' . $totalRows_Recordset1 . '">'
		   . '<input type="submit" name="navig" value="&lt;" title="Next newest"></form></td>';
	}
	if( $pageNum_Recordset1 < $totalPages_Recordset1 )
	{
		echo '<td><form action="'.$admin_file.'.php#AdminTop" method="post">'
		   . '<input type="hidden" name="op" value="Donations">'
		   . '<input type="hidden" name="pageNum_Recordset1" value="' . min($totalPages_Recordset1, $pageNum_Recordset1 + 1) . '">'
		   . '<input type="hidden" name="totalRows_Recordset1" value="' . $totalRows_Recordset1 . '">'
		   . '<input type="submit" name="navig" value="&gt;" title="Next Oldest"></form></td>';
		echo '<td><form action="'.$admin_file.'.php#AdminTop" method="post">'
		   . '<input type="hidden" name="op" value="Donations">'
		   . '<input type="hidden" name="pageNum_Recordset1" value="' . $totalPages_Recordset1 . '">'
		   . '<input type="hidden" name="totalRows_Recordset1" value="' . $totalRows_Recordset1 . '">'
		   . '<input type="submit" name="navig" value="&gt;|" title="Oldest"></form></td>';
	}
	echo "</tr></table></center>";
    echo "<table border=\"1\" width=\"100%\" align=\"center\"><tr>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\" width=\"4\"><b>&nbsp;</b></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Date</b></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Num</b></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Name</b></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Decsription</b></td>"
    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Amount</b></td></tr><tr>";
	$row=0;
do {
	$row += 1;
    echo "<tr>"
	    ."<td align=\"center\">"
		  ."<A HREF=\"javascript: void 0\" onclick=\""
		    ."document.recedit.id.value = '$row_Recordset1[id]'; "
		    ."document.recedit.Date.value = '$row_Recordset1[fdate]'; "
		    ."document.recedit.Num.value = '$row_Recordset1[num]'; "
		    ."document.recedit.Name.value = '$row_Recordset1[name]'; "
			."document.recedit.Descr.value = '$row_Recordset1[descr]'; "
		 	."document.recedit.Amount.value = '$row_Recordset1[amount]'; "
		 	."document.recedit.Submit.value = 'Modify'; "
		 	."document.recedit.op.value = 'FinRegEdit'; "
		  ."return false;\">"
  		."<img border=\"0\" width=\"12\" height=\"13\" src=\"images/admin/donations_edit.png\"></a>&nbsp;"
		."<a href=\"".$admin_file.".php?op=FinRegDel&id=$row_Recordset1[id]\">"
		."<img border=\"0\" width=\"12\" height=\"13\" src=\"images/admin/donations_drop.png\" onClick=\"return confirm('Are you sure you want to delete this record?" . '\n\n' . "Are you sure you want to do this now?')\""
		."></a></td>"
		."<td align=\"left\">$row_Recordset1[fdate]</td>"
        ."<td align=\"left\" width=\"8\">$row_Recordset1[num]</td>"
        ."<td align=\"left\">$row_Recordset1[name]</td>"
        ."<td align=\"left\">$row_Recordset1[descr]</td>"
        ."<td align=\"right\"><font ";
	$amt =  sprintf("%10.2f",$row_Recordset1[amount]);
	if( $amt < 0 )
		echo "color=\"#FF0000\"";
	echo ">\$$amt</font></td></tr>";
} while ($row_Recordset1 = $db->sql_fetchrow($Recordset1)); 
    echo "</table><table width=\"100%\"><tr><td align=\"right\"><b>Net Balance&nbsp;&nbsp;&nbsp;\$";
	echo sprintf("%0.2f", $total) . "&nbsp;</b></td>";
    echo "</tr></table>";
    echo "<table><tr>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Date</b></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Num</b></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Name</b></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Description</b></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Amount</b></td></tr><tr>"
		."<form action=\"".$admin_file.".php\" method=\"post\" name=\"recedit\">"
        ."<td align=\"left\" width=\"8\"><input name=\"id\" type=\"hidden\">"
        ."<input name=\"Date\" type=\"text\" size=\"11\" placeholder=\"01-Jan-2000\"></td>"
        ."<td align=\"left\" width=\"8\"><input name=\"Num\" type=\"text\" size=\"8\"></td>"
        ."<td align=\"left\"><input name=\"Name\" type=\"text\"></td>"
        ."<td align=\"left\"><input name=\"Descr\" type=\"text\"></td>"
        ."<td align=\"right\"><input name=\"Amount\" type=\"text\" size=\"8\"></td></tr>";
    echo "</tr>";
	echo "<tr><td align=\"right\" colspan=\"5\">"
	    ."<input name=\"\" type=\"reset\" value=\"Reset\" onclick=\""
		."document.recedit.Submit.value = 'Add'; "
		."document.recedit.op.value = 'FinRegAdd'; "
	    ."return true;\">&nbsp;"
		."<input type=\"hidden\" name=\"op\" value=\"FinRegAdd\"><input name=\"Submit\" type=\"submit\" value=\"Add\"></td></tr>"
		."</form>";
	echo "</table>";
    CloseTable();
    echo "<br>";
    include_once("footer.php");
	//mysql_free_result($Recordset1);
	$db->sql_freeresult($Recordset1);
}
function FinancialRegAdd()
{
    global $db, $admin, $bgcolor2, $admin_file, $prefix, $currentlang, $multilingual;
    include_once("header.php");
	include_once("modules/Donations/config.php");
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Record add</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
	$nTime = strtotime($_POST[Date]);
	if($nTime == -1)
		echo "Invalid Date format<br>";
	else
	if( strlen($_POST[Name]) == 0)
		echo "The Name field cannot be blank<br>";
	else
	if( !is_numeric($_POST[Amount]))
		echo "Invalid Amount field<br>";
	else
	{
		echo "Field passed validation!<br>";
	    echo strftime("%Y-%m-%d", $nTime) . " $_POST[Num] $_POST[Name] $_POST[Descr] $_POST[Amount]<br><br>";
		//$db->sql_query($dbname);
		$insert_Recordset = "INSERT INTO `".$prefix."_don_financial` VALUES "
							."(NULL, '" . strftime("%Y-%m-%d", $nTime) . "','" . $_POST[Num] . "','" . $_POST[Name]
							."','" . $_POST[Descr] . "','" . $_POST[Amount] . "')";
		echo "$insert_Recordset";
		$rvalue = $db->sql_query($insert_Recordset);
	    echo strftime("%Y-%m-%d", $nTime) . " $_POST[Num] $_POST[Name] $_POST[Descr] $_POST[Amount]<br><br>$insert_Recordset";
		CloseTable(); 
		Header("Location: ".$admin_file.".php?op=Donations#AdminTop");
	}
}	
function FinancialRegDel()
{
    global $db, $admin, $bgcolor2, $prefix, $admin_file, $currentlang, $multilingual;
    include_once("header.php");
	include_once("modules/Donations/config.php");
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Record Delete</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
	echo "Field passed validation!<br>";
	//$db->sql_query($dbname);
	if( !(is_numeric($_GET[id]) && $_GET[id]>0))
	{
		echo "<br>Invalid record id specified, operation aborted<br>";
	} else
	{
		$del_Recordset = "DELETE FROM `".$prefix."_don_financial` WHERE `id`='$_GET[id]' LIMIT 1";
		$rvalue = $db->sql_query($del_Recordset);
		CloseTable(); 
		Header("Location: ".$admin_file.".php?op=Donations#AdminTop");
	}
}
function FinancialRegEdit()
{
    global $db, $admin, $bgcolor2, $prefix, $admin_file, $currentlang, $multilingual;
    include_once("header.php");
	include_once("modules/Donations/config.php");
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Record Edit</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
//    echo "$_POST[Date] $_POST[Num] $_POST[Name] $_POST[Descr] $_POST[Amount]<br><br>";
	$nTime = strtotime($_POST[Date]);
	if($nTime == -1)
		echo "Invalid Date format<br>";
	else
	if( strlen($_POST[Name]) == 0)
		echo "The Name field cannot be blank<br>";
	else
	if( !is_numeric($_POST[Amount]))
		echo "Invalid Amount field, do not use any characters other than -.0123456789<br>";
	else
	{
		echo "Field passed validation!<br>";
	    echo strftime("%Y-%m-%d", $nTime) . " $_POST[Num] $_POST[Name] $_POST[Descr] $_POST[Amount]<br><br>";
		//$db->sql_query($dbname);
		$insert_Recordset = "UPDATE `".$prefix."_don_financial` SET date='". strftime("%Y-%m-%d", $nTime) . "', num='$_POST[Num]', Name='$_POST[Name]', "
							."descr='$_POST[Descr]', amount='$_POST[Amount]' WHERE id='$_POST[id]' LIMIT 1";
		echo "$insert_Recordset";
		$rvalue = $db->sql_query($insert_Recordset);
	    echo "$_POST[id]" . strftime("%Y-%m-%d", $nTime) . " $_POST[Num] $_POST[Name] $_POST[Descr] $_POST[Amount]<br><br>$insert_Recordset";
		CloseTable(); 
		Header("Location: ".$admin_file.".php?op=Donations#AdminTop");
	}
}	
function SelectYN($nm, $val)
{
	echo '<select size="1" name="' . $nm . '">';
	if( $val )
	{
		echo '<option selected value="1">Yes</option>'
		. '<option value="0">No</option>';
	} else {
		echo '<option value="1">Yes</option>'
		. '<option selected value="0">No</option>';
	}	
	echo '</select>';
}
function ShowYNBox($name, $desc, $tdWidth, $inpSize, $inpJava)
{
	global $db, $prefix, $bgcolor2, $admin_file;
	$query_cfg = "SELECT * FROM ".$prefix."_don_config WHERE name = '$name'";
	$cfgset = $db->sql_query($query_cfg);
	if( !$cfgset )
		return;
	$cfg = $db->sql_fetchrow($cfgset);
	$text = htmlentities($cfg[text]);
    echo "<tr>"
    ."<td title=\"$text\" bgcolor=\"$bgcolor2\" align=\"right\">$desc</td>"
    ."<td title=\"$text\" align=\"left\">";
	echo '<select size="1" name="var_' . $name . '">';
	if( $cfg[value] )
	{
		echo '<option selected value="1">Yes</option>'
		. '<option value="0">No</option>';
	} else {
		echo '<option value="1">Yes</option>'
		. '<option selected value="0">No</option>';
	}	
	echo '</select>';
//	SelectYN("var_dm_show_date", $tr_config[dm_show_date]);
}
function ShowTextBox($name, $desc, $tdWidth, $inpSize, $inpJava)
{
	global $db, $prefix, $bgcolor2, $admin_file;
	$query_cfg = "SELECT * FROM ".$prefix."_don_config WHERE name = '$name'";
	$cfgset = $db->sql_query($query_cfg);
	if( !$cfgset )
		return;
	$cfg = $db->sql_fetchrow($cfgset);
	$text = htmlentities($cfg[text]);
    echo "<tr>"
    ."<td title=\"$text\" bgcolor=\"$bgcolor2\" align=\"right\" width=\"$tdWidth\">$desc</td>"
    ."<td title=\"$text\" align=\"left\">"
	."<input size=\"$inpSize\" name=\"var_$name\" type=\"text\" value=\"$cfg[value]\"  $inpJava></td></tr>";
}
function ShowImgXYBox($xnm, $ynm, $desc, $inpSize, $inpJava)
{
	global $db, $prefix, $bgcolor2, $admin_file;
	$query_cfg = "SELECT * FROM ".$prefix."_don_config WHERE name = '$xnm'";
	$cfgset = $db->sql_query($query_cfg);
	if( $cfgset)
	{
		$cfg = $db->sql_fetchrow($cfgset);
		$text = htmlentities($cfg[text]);
		echo "<tr>"
		."<td title=\"$text\" bgcolor=\"$bgcolor2\" align=\"right\">$desc</td><td title=\"$text\" align=\"left\">";
		echo "&nbsp;Width&nbsp;"
		."<input size=\"$inpSize\" name=\"var_$cfg[name]\" type=\"text\" value=\"$cfg[value]\" $inpJava>";
		$query_cfg = "SELECT * FROM ".$prefix."_don_config WHERE name = '$ynm'";
		$cfgset = $db->sql_query($query_cfg);
		if( $cfgset)
		{
			$cfg = $db->sql_fetchrow($cfgset);
			echo "&nbsp;&nbsp;Height&nbsp;"
			."<input size=\"$inpSize\" name=\"var_$cfg[name]\" type=\"text\" value=\"$cfg[value]\" $inpJava>";
		}
		echo "</td></tr>";
	}
}
function Config()
{
    global $db, $admin, $bgcolor2, $prefix, $currentlang, $multilingual, $admin_file;
    include_once("header.php");
	include_once("modules/Donations/config.php");
?>
<script Language="JavaScript">
function isEmailAddr(email)
{
  var result = false;
  var theStr = new String(email);
  var index = theStr.indexOf("@");
  if (index > 0)
  {
    var pindex = theStr.indexOf(".",index);
    if ((pindex > index+1) && (theStr.length > pindex+1))
	result = true;
  }
  return result;
}
function validRequired(formField,fieldLabel)
{
	var result = true;
	if (formField.value == "")
	{
		alert('Please enter a value for the "' + fieldLabel +'" field.');
		formField.focus();
		result = false;
	}
	return result;
}
function allDigits(str)
{
	return inValidCharSet(str,"0123456789");
}
function inValidCharSet(str,charset)
{
	var result = true;
	// Note: doesn't use regular expressions to avoid early Mac browser bugs	
	for (var i=0;i<str.length;i++)
		if (charset.indexOf(str.substr(i,1))<0)
		{
			result = false;
			break;
		}
	return result;
}
function validInt(formField,fieldLabel,required)
{
	var result = true;
	if (required && !validRequired(formField,fieldLabel))
		result = false;
 	if (result)
 	{
// 		var num = parseInt(formField.value,10);
 		if (!allDigits(formField.value))
 		{
			if(required)
			{
	 			alert('Please enter a number for the "' + fieldLabel +'" field.');
				formField.focus();		
				result = false;
			}
			else if ( formField.value == "" )
			{
				return true;
			}
			else
	 		{
				alert('Please enter a number or a blank for the "' + fieldLabel +'" field.');
				formField.focus();		
				result = false;
			}
		}
	} 
	return result;
}
function validdateURL(formField, value, secure)
{
	var match = /https/i.test(value);
	if( value != "" && !/^http/i.test(value) ) 
	{
		alert('The URL must start with http://');
		formField.focus();		
		return false;
	}
	if( secure && value != "" && !/^https/i.test(value) ) 
	{
//		alert('This should reside on a HTTPS server.  Users will be warned about viewing secure and non-secure data on the same page');
		return confirm('This URL does not begin with https://\nThis image should reside on an HTTPS server.\nIf you use this URL, users will receive a warning\nabout viewing secure and non-secure data on the same page.\n\n  Are you sure you want to continue?');
	}
	return true;
}
function checkCancelledURL()
{
	if( document.tr_configs.var_pp_image_url.value == "")
		alert('There is no URL for a Cancelled payment.  If you do not enter\na URL for cancelled payments PayPal will also use\nthis URL for cancelled payments.');
	return true;
}
</script>
<?php
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Configuration</b></font></center>";
    CloseTable();
    echo "<br>";
	echo "<form name=\"tr_configs\" action=\"".$admin_file.".php\" method=\"post\">"
	. "<input type=\"hidden\" name=\"op\" value=\"ConfigUpdate\">";
    OpenTable();
    echo "<center><font class=\"title\"><b>Donat-o-Meter Config</b></font></center><br>";
	////$db->sql_query($dbname);
    echo "<table border=\"1\" >";
	ShowTextBox("swing_day", "<b>Swing Day</b>", "175", "4", "onChange=\"return validInt(this,'Swing Day',1);\"");
	ShowTextBox("dm_title", "<b>Donat-o-Meter Title</b>", "", "40", "");
	ShowTextBox("dm_num_don", "<b>Number of donators to list</b>", "", "4", "");
	ShowYNBox("dm_show_date", "<b>Reveal dates in DM</b>", "", "", "");
	ShowYNBox("dm_show_amt", "<b>Reveal Amounts in DM</b>", "", "", "");
	ShowTextBox("dm_button", "<b>URL for button image</b>", "", "70", "onChange=\"return validdateURL(this,this.value);\"");
	ShowImgXYBox("dm_img_width", "dm_img_height", "<b>Image dimensions</b>", "4", "onChange=\"return validInt(this,'Image Dimension',0);\"");
	echo "</table><br>";
	$query_Recordset1 = "SELECT * FROM ".$prefix."_don_config WHERE ".$prefix."_don_config.name = 'goal'  AND ".$prefix."_don_config.subtype<>'Default'";
	$Recordset1 = $db->sql_query($query_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	$totalRows_Recordset1 = $db->sql_numrows($Recordset1);
	$desc = htmlentities($row_Recordset1[text]);
	echo "Donation goals by month<br>";
    echo "<table border=\"1\" width=\"100\">";
	$row1 = '<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><b>Month</b></td>';
	$row2 = '<tr><td bgcolor=\"$bgcolor2\" align=\"center\"><b>Goal</b></td>';
	do {
		$row1 .= "<td title=\"$desc\" align=\"center\">$row_Recordset1[subtype]</td>";
		$row2 .= "<td title=\"$desc\" align=\"center\"><input size=\"4\" name=\"var_goal-$row_Recordset1[subtype]\" type=\"text\" value=\"$row_Recordset1[value]\" onChange=\"return validInt(this,'$row_Recordset1[subtype] Donation Goal',1);\"></td>";
	} while ($row_Recordset1 = $db->sql_fetchrow($Recordset1)); 
	$row1 .= '</tr>';
	$row2 .= '</tr>';
	echo "$row1 $row2";
	echo "</table><br>";
	echo "<input type=\"submit\" value=\"Submit\">";
    CloseTable();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Module Config</b></font></center><br>";
    echo "<table border=\"1\" ><tr><form action=\"".$admin_file.".php\" method=\"post\">";
	ShowTextBox("don_button_top", "<b>Donations page top button</b>", "", "70", "onChange=\"return validdateURL(this,this.value);\"");
	ShowImgXYBox("don_top_img_width", "don_top_img_height", "<b>Image dimensions</b>", "4", "onChange=\"return validInt(this,'Image Dimension',0);\"");
	ShowTextBox("don_button_submit", "<b>Donations page &quot;submit&quot; button</b>", "", "70", "onChange=\"return validdateURL(this,this.value);\"");
	ShowImgXYBox("don_sub_img_width", "don_sub_img_height", "<b>Image dimensions</b>", "4", "onChange=\"return validInt(this,'Image Dimension',0);\"");
	ShowTextBox("don_name_prompt", "<b>Prompt to use username</b>", "", "70", "");
	ShowTextBox("don_name_yes", "<b>Username request: &quot;YES&quot; Response</b>", "", "50", "");
	ShowTextBox("don_name_no", "<b>Username request: &quot;NO&quot; Response</b>", "", "50", "");
	ShowYNBox("don_show_date", "<b>Reveal dates</b>", "", "", "");
	ShowYNBox("don_show_amt", "<b>Reveal Amounts</b>", "", "", "");
	$desc = "This is where you can appeal to your
users and your community for donations.
Suggestion: Explain why you need donations, 
what you do with the money and how you
manage it. Make them comfortable that
they are not throwing their money away.";
	$sql = $sql = "SELECT * FROM ".$prefix."_don_config WHERE name = 'don_text'";
	$Recordset = $db->sql_query($sql);
	$row = $db->sql_fetchrow($Recordset);
	$DON_TEXT = $row[text];
    echo "<tr>"
    ."<td title=\"$desc\" bgcolor=\"$bgcolor2\" align=\"right\"><b>Donations page text</b></td>"
    ."<td title=\"$desc\" align=\"left\">"
	."<textarea name=\"var_don_text-rawtext-txt\" cols=\"100\" rows=\"20\">$DON_TEXT</textarea></td></tr>";
	ShowTextBox("don_amt_checked", "<b>Which donation amount below<br>is checked by default?</b>", "", "4", "onChange=\"return validInt(this,'Donation Default',1);\"");
	echo "</table><br>";
	echo "Suggested Donation amounts<br>";
	$query_Recordset1 = "SELECT * FROM ".$prefix."_don_config WHERE ".$prefix."_don_config.name = 'don_amount' ORDER BY ".$prefix."_don_config.subtype";
	$Recordset1 = $db->sql_query($query_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	$totalRows_Recordset1 = $db->sql_numrows($Recordset1);
	$desc = htmlentities($row_Recordset1[text]);
    echo "<table border=\"1\" width=\"100\">";
	$row1 = '<tr><td title="' . $desc . '" bgcolor=\"$bgcolor2\" align=\"center\"><b></b></td>';
	$row2 = '<tr><td title="' . $desc . '" bgcolor=\"$bgcolor2\" align=\"center\"><b>Amount</b></td>';
	do {
		$row1 .= "<td title=\"$desc\" align=\"center\">$row_Recordset1[subtype]</td>";
		$row2 .= "<td title=\"$desc\" align=\"center\"><input size=\"4\" name=\"var_don_amount-$row_Recordset1[subtype]\" type=\"text\" value=\"$row_Recordset1[value]\" onChange=\"return validInt(this,'Suggested Donation Amount #$row_Recordset1[subtype]',1);\"></td>";
	} while ($row_Recordset1 = $db->sql_fetchrow($Recordset1)); 
	$row1 .= '</tr>';
	$row2 .= '</tr>';
	echo "$row1 $row2";
	echo "</table><br>";
	echo "<input type=\"submit\" value=\"Submit\">";
    CloseTable();
    OpenTable();
    echo "<center><font class=\"title\"><b>PayPal Configuration</b></font></center><br>";
    echo "<table border=\"1\" ><tr><form action=\"".$admin_file.".php\" method=\"post\">";
	ShowTextBox("receiver_email", "<b>PayPal Receiver Email</b>", "", "40", "");
	ShowTextBox("ty_url", "<b>URL for Donation 'Thank You'</b>", "", "80", "onChange=\"checkCancelledURL(); return validdateURL(this,this.value);\"");
	ShowTextBox("pp_cancel_url", "<b>URL for cancelled donation</b>", "", "80", "onChange=\"return validdateURL(this,this.value);\"");
	ShowTextBox("pp_itemname", "<b>PayPal Item Name</b>", "", "20", "");
	ShowTextBox("pp_item_num", "<b>PayPal Item Number</b>", "", "20", "");
	ShowTextBox("pp_image_url", "<b>URL of image to display in PayPal</b>", "", "60", "");
	ShowYNBox("pp_get_addr", "<b>Ask user for postal address</b>", "", "", "");
	echo "</table><br>";
    echo "<br><font class=\"title\"><b>IPN Logging options</b></font>";
    echo "<table border=\"1\" ><tr><form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<tr>"
    ."<td bgcolor=\"$bgcolor2\" align=\"right\"><b>Logging level</b></td>"
    ."<td align=\"left\">"
	.'<select size="1" name="var_ipn_dbg_lvl">';
	echo '<option ' ;
	if($tr_config[ipn_dbg_lvl]==0) echo "selected ";
	echo 'value="0">Off</option>';
	echo '<option ' ;
	if($tr_config[ipn_dbg_lvl]==1) echo "selected ";
	echo 'value="1">Only log errors</option>';
	echo '<option ' ;
	if($tr_config[ipn_dbg_lvl]==2) echo "selected ";
	echo 'value="2">Log everything</option>';
	echo '</select></td></tr>';
	ShowTextBox("ipn_log_entries", "<b>Keep this many log entries</b>", "", "4", "");
	global $db, $prefix, $nukeurl, $admin_file;
	$desc = 'This box shows the link to the IPN recorder.
This link must be pasted EXACTLY as it is
into your PayPal IPN profile.  You can click
on the "test" link to the right to verify
that the IPN recorder is functioning correctly.';
$desc = htmlentities($desc);
    echo "<tr>"
     ."<td title =\"$desc\" bgcolor=\"$bgcolor2\" align=\"right\"><b>IPN link for PayPal</b></td>"
     ."<td title =\"$desc\" align=\"left\">&nbsp;$nukeurl/modules/Donations/ipn/ipnppd.php&nbsp;&nbsp;<a href=\"$nukeurl/modules/Donations/ipn/ipnppd.php?dbg=1\" target=\"_blank\"><b><i>Click here to test IPN</i></b></a></td>"
	 . "</td></tr>";
	echo "</table><br>";
	echo "<input type=\"submit\" value=\"Submit\">";
    CloseTable();
	echo "</form>";
	$db->sql_freeresult($Recordset1);
    include_once("footer.php");
}
function UpdateDb($nm, $sub, $val, $txt)
{
		global $db, $prefix, $ilog, $admin_file;
		$insert_Recordset = "UPDATE `".$prefix."_don_config` SET `value`='$val', `text`='$txt' WHERE `name`='$nm' AND `subtype`='$sub'";
		$ilog .= "$insert_Recordset<br><br>";
		echo "$insert_Recordset<br><br><font color=\"#FF0000\"><b>";
		$rvalue = $db->sql_query($insert_Recordset);
		echo "</b></font>";
}
function UpdateDbShort($nm, $sub, $val, $txt)
{
		global $db, $prefix, $ilog, $admin_file;
		$insert_Recordset = "UPDATE `".$prefix."_don_config` SET `value`='$val' WHERE `name`='$nm' AND `subtype`='$sub'";
		$ilog .= "$insert_Recordset<br><br>";
		echo "$insert_Recordset<br><br><font color=\"#FF0000\"><b>";
		$rvalue = $db->sql_query($insert_Recordset);
		echo "</b></font>";
}
function ConfigUpdate()
{
    global $db, $admin, $bgcolor2, $prefix, $currentlang, $multilingual, $admin_file;
    include_once("header.php");
	include_once("modules/Donations/config.php");
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//    //GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Configuration Error</b></font></center>";
	echo "<br><font color=\"#0000FF\"><b>If you see this screen then an SQL error was encountered</b></br>"
	   . "You shoud see a message in <font color=\"#FF0000\">RED</font> below indicating what the error is</font><br><br>";
    CloseTable();
//    echo "<br>";
    OpenTable();
	$ERR = 1;
	$ilog="";
	$ilog .= "<br>";
	foreach( $_POST as $option => $value )
	{
		/// Look for form variables
		if( preg_match("/var_/",$option))
		{ 
			$varnm = preg_replace("/var_/","",$option);
			// Check for subtype field
			if( preg_match("/-(.*)/",$varnm,$subtype) )
			{
				echo "<br>subtype = $subtype[1] <br>";
				$temp = $varnm;
				$varnm = preg_replace("/-.*/","",$temp);
				// Is this a text field?
				if( preg_match("/([^-]*)-txt/",$subtype[1], $subtype2) )
				{
					if (!get_magic_quotes_gpc()) {
					   $textarea = addslashes($value);
					} else {
					   $textarea = $value;
					}
					echo "$varnm $subtype2[1] text=> " . nl2br(htmlspecialchars($textarea)) . "<br>";
					$ERR &= UpdateDb($varnm, $subtype2[1], "0", $textarea);
				} else {
					echo "$varnm $subtype[1] => $value<br>";
					$ERR &= UpdateDbShort($varnm, $subtype[1], $value, "");
				}
			} else
			{
				echo "$varnm => $value<br>";
				$ERR &= UpdateDbShort($varnm, "", $value, "");
			}
		}
	}
	// If there were no errors
	if( $ERR == 0 )
		Header("Location: ".$admin_file.".php?op=Donations#AdminTop");
}
function IpnRec()
{
	include_once("modules/Donations/config.php");
	//$db = mysql_pconnect($hostname_ipnppd, $username_ipnppd, $password_ipnppd);
	//$db->sql_query($dbname);
	$query_Recordset1 = 'SELECT `date` as recdate'
        . ' FROM '.$prefix.'_don_financial'
        . ' WHERE name = \'PayPal IPN\''
        . ' ORDER BY date DESC '
        . ' LIMIT 1 ';
	$Recordset1 = $db->sql_query($query_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	$recdate = $row_Recordset1[recdate];
	$query_Recordset1 = 'SELECT `payment_date` as curdate'
        . ' FROM '.$prefix.'_don_transactions'
        . ' WHERE payment_status = \'Completed\' AND ( transactions.txn_type = \'send_money\' OR transactions.txn_type = \'web_accept\' )'
        . ' ORDER BY payment_date DESC '
        . ' LIMIT 1 ';
	$Recordset1 = $db->sql_query($query_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
	$curdate = $row_Recordset1[curdate];
    $query_Recordset1 = ' SELECT IF ( SUM( mc_gross - mc_fee ) , SUM( mc_gross - mc_fee ) , 0 ) AS ipn_total, COUNT( * ) AS numrecs'
        . ' FROM '.$prefix.'_don_transactions'
        . ' WHERE ( payment_Date > \'' . $recdate . '\' AND payment_date <= \'' . $curdate . '\' ) AND payment_status = \'Completed\' AND ( transactions.txn_type = \'send_money\' OR transactions.txn_type = \'web_accept\' );';
	$Recordset1 = $db->sql_query($query_Recordset1);
	$row_Recordset1 = $db->sql_fetchrow($Recordset1);
    global $db, $admin, $bgcolor2, $prefix, $currentlang, $multilingual, $admin_file;
    include_once("header.php");
Opentable();
echo "<b><center><a href='".$admin_file.".php?op=Donations#AdminTop'>Platinum Donations Administration</a></center></b>";
echo "<b><center><a href='".$admin_file.".php'>Main Administration</a></center></b>";
Closetable();
//  GraphicAdmin();
	echo '<a name="AdminTop"></a>';
    OpenTable();
    echo "<center><font class=\"title\"><b>Donations Financial</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"title\"><b>Update register with PayPal IPN</b></font></center><br><br>";
	if( $row_Recordset1['numrecs'] == 0 )
		echo "There are no new IPN records to import! ";
	else
	{
		$insert_set = "INSERT INTO `".$prefix."_don_financial` (`date`,`num`,`name`,`descr`,`amount`) VALUES ('$curdate','','PayPal IPN','Auto-Reconcile','$row_Recordset1[ipn_total]')";
		$rval = $db->sql_query($insert_set);
		if($rval)
			echo "<b>$row_Recordset1[numrecs]</b> IPN records have been imported for a total of $" . sprintf("%0.2f", $row_Recordset1[ipn_total]);
		else
			echo "<b> ERROR : There are $row_Recordset1[numrecs] to import, but there was an<br>"
				."error encoutered during db record insertion into Financial table.  Insertion<br>" 
				."FAILED";
	}
	echo "<br><br><form action=\"".$admin_file.".php?op=Donations#AdminTop\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"op\" value=\"Donations\">"
		."<input type=\"submit\" value=\"Return\"\">"
		."</form>";
	CloseTable();
    include_once("footer.php");
}
  Switch($op) 
  {
	case "FinRegAdd":
		FinancialRegAdd();
		break;
	case "FinRegEdit":
		FinancialRegEdit();
		break;
	case "FinRegDel":
		FinancialRegDel();
		break;
    case "Donations":
      Donations();
    	break;
	case "Config":
		Config();
		break;
	case "ConfigUpdate":
		ConfigUpdate();
		break;
	case "IpnRec":
		IpnRec();
		break;
  }
?>