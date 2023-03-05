<?php

if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}

$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Contact'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND $row['admins'] != "") {
        $auth_user = 1;	
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

function addressdefault() {
    global $prefix, $db, $admin_file;
    echo "<br /><br /><center><font class=\"option\"><strong><u>"._NSCURRADDRESS."</u></strong></font><br /><br />";
    $result = $db->sql_query("select address from ".$prefix."_ns_contact_add");
    list($address) = $db->sql_fetchrow($result);
    $address = FixQuotes(nl2br(filter_text($address)));
    echo "<table cellspacing=\"0\" cellpadding=\"6\" border=\"0\" align=\"center\">";
    echo "<tr><td align=\"left\">";
    echo "$address";
    echo "</td></tr></table>";
    echo "<br /><br />";
    echo "<form action='".$admin_file.".php' method='post'>";
    $result_s = $db->sql_query("select show_add from ".$prefix."_ns_contact_show");
    list($show_add) = $db->sql_fetchrow($result_s);
    echo "<center>"._NSADDSHOW." ";
    if ($show_add == 1) {
	echo "<input type='radio' name='xshow_add' value='1' checked>"._NSYES." &nbsp;
	<input type='radio' name='xshow_add' value='0'>"._NSNO."";
    } else {
	echo "<input type='radio' name='xshow_add' value='1'>"._NSYES." &nbsp;
	<input type='radio' name='xshow_add' value='0' checked>"._NSNO."";
    }
    echo "<br /><br /><input type='hidden' name='op' value='showinfo'>";
    echo "<input type='submit' name=\"submit\" value=\""._NSSAVE."\"><br /><br />";
    echo ""._NSADDSET."";
    echo "</center></form>";
}


function phonedefault() {
    global $prefix, $db, $admin_file;
    echo "<br /><br />";
    echo "<center><font class=\"option\"><strong><u>"._NSCURRENTPHONE."</u></strong></font></center><br />";
    echo "<table width=\"90%\" cellspacing=\"1\" cellpadding=\"6\" border=\"0\" align=\"center\">";
    echo "<tr>";
    echo "<td align=\"center\">&nbsp;</td>";
    echo "<td align=\"left\"><strong>"._NSPHONENAME."</strong></td>";
    echo "<td align=\"left\"><strong>"._NSPHONENUM."</strong></td>";
    echo "<td align=\"left\"><strong>"._NSFAXNUM."</strong></td>";
    echo "<td align=\"center\"><strong>"._NSCONTACTFUNC."</strong></td></tr>";
    $phone = 1;
    $result = $db->sql_query("select pid, phone_name, phone_num, fax_num from ".$prefix."_ns_contact_phone order by pid");
        while(list($pid, $phone_name, $phone_num, $fax_num) = $db->sql_fetchrow($result)) {
    $pid = intval($pid);
    $phone_name = stripslashes($phone_name);
    $phone_num  = stripslashes($phone_num);
    $fax_num    = stripslashes($fax_num);
    echo "<tr><td align=\"center\"><strong>$phone.</strong></td>";
    echo "<td align=\"left\">$phone_name</td>";
    echo "<td align=\"left\">$phone_num</td>";
    echo "<td align=\"left\">$fax_num</td>";
    echo "<td align=\"center\" valign=\"middle\">";
    echo "<input type=\"button\" value=\""._NSFEDIT."\" title=\""._NSFEDIT."\" onClick=\"window.location='".$admin_file.".php?op=phoneedit&amp;pid=$pid#Edit'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSFDELETE."\" title=\""._NSFDELETE."\" onClick=\"window.location='".$admin_file.".php?op=phonedelete&amp;pid=$pid#Delete'\">";
    echo "</td></tr>";
	$phone++;
        }
    echo "</table>";
    echo "<br /><br />";
}


function deptdefault() {
global $prefix, $db, $admin_file;
@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=deptdefault'>Contact Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    echo "<a name=\"Default\">";
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._NSCONTACTPLUS."</strong></font></center>";
    CloseTable();
    OpenTable();
    addressdefault();
    CloseTable();
    OpenTable();
    phonedefault();
    CloseTable();
    OpenTable();
    echo "<br /><br />";
    echo "<center><font class=\"option\"><strong><u>"._NSCURRENTDEPT."</u></strong></font></center><br />";
    echo "<table width=\"90%\" cellspacing=\"1\" cellpadding=\"6\" border=\"0\" align=\"center\">";
    echo "<tr>";
    echo "<td align=\"center\">&nbsp;</td>";
    echo "<td align=\"left\"><strong>"._NSDEPTNAME."</strong></td>";
    echo "<td align=\"left\"><strong>"._NSDEPTEMAIL."</strong></td>";
    echo "<td align=\"center\"><strong>"._NSCONTACTFUNC."</strong></td></tr>";
    $dept = 1;
    $result = $db->sql_query("select did, dept_name, dept_email from ".$prefix."_ns_contact_dept order by dept_name");
        while(list($did, $dept_name, $dept_email) = $db->sql_fetchrow($result)) {
    $did = intval($did);
    $dept_name  = stripslashes($dept_name);
    $dept_email = stripslashes($dept_email);
    echo "<tr><td align=\"center\"><strong>$dept.</strong></td>";
    echo "<td align=\"left\">$dept_name</td>";
    echo "<td align=\"left\">$dept_email</td>";
    echo "<td align=\"center\" valign=\"middle\">";

    echo "<input type=\"button\" value=\""._NSFEDIT."\" title=\""._NSFEDIT."\" onClick=\"window.location='".$admin_file.".php?op=deptedit&amp;did=$did#Edit'\">&nbsp;&nbsp;";

    echo "<input type=\"button\" value=\""._NSFDELETE."\" title=\""._NSFDELETE."\" onClick=\"window.location='".$admin_file.".php?op=deptdelete&amp;did=$did#Delete'\">";

//    echo "<a href=\"".$admin_file.".php?op=deptedit&amp;did=$did#Edit\">"._NSFEDIT."</a> - ";
//    echo "<a href=\"".$admin_file.".php?op=deptdelete&amp;did=$did#Delete\">"._NSFDELETE."</a>";
    echo "</td></tr>";
	$dept++;
        }
    echo "</table>";
    echo "<br /><br />";
    CloseTable();
    echo "<a name=\"Address\">";
    OpenTable();
    echo "<br /><br /><center><font class=\"option\"><strong>"._NSADDRESS."</strong></font><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<br />"._NSADDRESS2."<br />";
    $result = $db->sql_query("select address from ".$prefix."_ns_contact_add");
    list($address) = $db->sql_fetchrow($result);
    echo "<textarea name=\"address\" cols=\"60\" rows=\"10\">";
    echo "".stripslashes($address)."";
    echo "</textarea><br /><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"addressadd\">";
    echo "<input type=\"submit\" value=\""._NSSAVE."\">";
    echo "</form></center>";
    echo "<br /><br />";
    CloseTable();
    echo "<a name=\"PhoneAdd\">";
    OpenTable();
    echo "<br /><br /><center><font class=\"option\"><strong>"._NSADDPHONE."</strong></font><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo ""._NSPHONENAME.": <input type=\"text\" name=\"phone_name\" size=\"50\" maxlength=\"50\" value=\"$phone_name\"><br /><br />";
    echo ""._NSPHONENUM.": <input type=\"text\" name=\"phone_num\" size=\"50\" maxlength=\"50\" value=\"$phone_num\"><br /><br />";
    echo ""._NSFAXNUM.": <input type=\"text\" name=\"fax_num\" size=\"50\" maxlength=\"50\" value=\"$fax_num\"><br /><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"phoneadd\">";
    echo "<input type=\"submit\" value=\""._NSADD."\">";
    echo "</form></center>";
    echo "<br /><br />";
    CloseTable();
    echo "<a name=\"Add\">";
    OpenTable();
    echo "<br /><br /><center><font class=\"option\"><strong>"._NSADDDEPT."</strong></font><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo ""._NSDEPTNAME.": <input type=\"text\" name=\"dept_name\" size=\"50\" maxlength=\"50\" value=\"$dept_name\"><br /><br />";
    echo ""._NSDEPTEMAIL.": <input type=\"text\" name=\"dept_email\" size=\"50\" maxlength=\"50\" value=\"$dept_email\"><br /><br />";
    echo "<input type=\"hidden\" name=\"op\" value=\"deptadd\">";
    echo "<input type=\"submit\" value=\""._NSADD."\">";
    echo "</form></center>";
    echo "<br /><br />";
    CloseTable();
    @include_once("footer.php");
}


function show_info($xshow_add) {
global $prefix, $db, $admin_file;
$db->sql_query("update ".$prefix."_ns_contact_show set show_add='$xshow_add'");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function phoneedit($pid) {
global $prefix, $db, $admin_file;
@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=deptdefault'>Contact Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    echo "<a name=\"Edit\">";
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._NSCONTACTPLUS."</strong></font></center>";
    CloseTable();
    OpenTable();
    $result = $db->sql_query("select pid, phone_name, phone_num, fax_num  from ".$prefix."_ns_contact_phone where pid='$pid'");
    $pid        = intval($pid);
    $phone_name = stripslashes($phone_name);
    $phone_num  = stripslashes($phone_num); 
    $fax_num    = stripslashes($fax_num);
    list($pid, $phone_name, $phone_num, $fax_num) = $db->sql_fetchrow($result);
    echo "<br /><br /><center><font class=\"option\"><strong>"._NSEDITPHONE."</strong></font><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo ""._NSPHONENAME.": <input type=\"text\" name=\"phone_name\" size=\"50\" maxlength=\"50\" value=\"$phone_name\"><br /><br />";
    echo ""._NSPHONENUM.": <input type=\"text\" name=\"phone_num\" size=\"50\" maxlength=\"50\" value=\"$phone_num\"><br /><br />";
    echo ""._NSFAXNUM.": <input type=\"text\" name=\"fax_num\" size=\"50\" maxlength=\"50\" value=\"$fax_num\"><br /><br />";
    echo "<input type=\"hidden\" name=\"pid\" value=\"$pid\">";
    echo "<input type=\"hidden\" name=\"op\" value=\"phonemodify\">";
    echo "<input type=\"submit\" value=\""._NSEDITPHONE2."\">";
    echo "</form></center>";
    echo "<br /><br />";
    CloseTable();
    @include_once("footer.php");
}


function deptedit($did) {
global $prefix, $db, $admin_file;
@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=deptdefault'>Contact Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
    echo "<a name=\"Edit\">";
    OpenTable();
    echo "<center><font class=\"title\"><strong>"._NSCONTACTPLUS."</strong></font></center>";
    CloseTable();
    OpenTable();
    $result = $db->sql_query("select did, dept_name, dept_email from ".$prefix."_ns_contact_dept where did='$did'");
    $did        = intval($did);
    $dept_name  = stripslashes($dept_name);
    $dept_email = stripslashes($dept_email);
    list($did, $dept_name, $dept_email) = $db->sql_fetchrow($result);
    echo "<br /><br /><center><font class=\"option\"><strong>"._NSEDITDEPT."</strong></font><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo ""._NSDEPTNAME.": <input type=\"text\" name=\"dept_name\" size=\"50\" maxlength=\"50\" value=\"$dept_name\"><br /><br />";
    echo ""._NSDEPTEMAIL.": <input type=\"text\" name=\"dept_email\" size=\"50\" maxlength=\"50\" value=\"$dept_email\"><br /><br />";
    echo "<input type=\"hidden\" name=\"did\" value=\"$did\">";
    echo "<input type=\"hidden\" name=\"op\" value=\"deptmodify\">";
    echo "<input type=\"submit\" value=\""._NSEDITDEPT."\">";
    echo "</form></center>";
    echo "<br /><br />";
    CloseTable();
    @include_once("footer.php");
}


function deptmodify($did, $dept_name, $dept_email) {
global $prefix, $db, $admin_file;
$dept_name = stripslashes(FixQuotes($dept_name));
    $dept_email = stripslashes(FixQuotes($dept_email));
    $db->sql_query("update ".$prefix."_ns_contact_dept set dept_name='$dept_name', dept_email='$dept_email' where did='$did'");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function phonemodify($pid, $phone_name, $phone_num, $fax_num) {
global $prefix, $db, $admin_file;
$phone_name = stripslashes(FixQuotes($phone_name));
    $phone_num  = stripslashes(FixQuotes($phone_num));
    $fax_num    = stripslashes(FixQuotes($fax_num));
    $db->sql_query("update ".$prefix."_ns_contact_phone set phone_name='$phone_name', phone_num='$phone_num', fax_num='$fax_num'  where pid='$pid'");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function deptadd($dept_name, $dept_email) {
global $prefix, $db, $admin_file;
$dept_name = stripslashes(FixQuotes($dept_name));
    $dept_email = stripslashes(FixQuotes($dept_email));
    $db->sql_query("insert into ".$prefix."_ns_contact_dept values (NULL,'$dept_name','$dept_email')");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function phoneadd($phone_name, $phone_num, $fax_num) {
global $prefix, $db, $admin_file;
$phone_name = stripslashes(FixQuotes($phone_name));
    $phone_num  = stripslashes(FixQuotes($phone_num));
    $fax_num    = stripslashes(FixQuotes($fax_num));
    $db->sql_query("insert into ".$prefix."_ns_contact_phone values (NULL,'$phone_name','$phone_num', '$fax_num')");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function addressadd($address) {
global $prefix, $db, $admin_file;
$address = stripslashes($address);
    $db->sql_query("update ".$prefix."_ns_contact_add set address='$address'");
    Header("Location: ".$admin_file.".php?op=deptdefault#Default");
}


function phonedelete($pid, $confirm = 0) {
global $prefix, $db, $admin_file;
if ($confirm == 1) {
	$db->sql_query("delete from ".$prefix."_ns_contact_phone where pid='$pid'");
	Header("Location: ".$admin_file.".php?op=deptdefault#Default");
    } else {
	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=deptdefault'>Contact Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
        echo "<a name=\"Delete\">";
        OpenTable();
    
	echo "<center><font class=\"title\"><strong>"._NSCONTACTPLUS."</strong></font></center>";
	CloseTable();
	OpenTable();
        $result = $db->sql_query("select pid, phone_name from ".$prefix."_ns_contact_phone where pid='$pid'");
        $pid        = intval($pid);
        $phone_name = stripslashes($phone_name);
	list($pid, $phone_name) = $db->sql_fetchrow($result);
	echo "<center><br /><br />";
	echo "<strong>"._NSDELETEPHONE."</strong><br /><br />";
	echo ""._NSPHONEDELSURE." <strong>$phone_name</strong><br />";
	echo "<br /><br />";
    echo "<input type=\"button\" value=\""._NSYES."\" title=\""._NSYES."\" onClick=\"window.location='".$admin_file.".php?op=phonedelete&amp;pid=$pid&amp;confirm=1'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSNO."\" title=\""._NSNO."\" onClick=\"window.location='".$admin_file.".php?op=deptdefault#Default'\">";
	echo "</center><br /><br />";
	CloseTable();
	@include_once("footer.php");
    }
}


function deptdelete($did, $confirm = 0) {
global $prefix, $db, $admin_file;
if ($confirm == 1) {
	$db->sql_query("delete from ".$prefix."_ns_contact_dept where did='$did'");
	Header("Location: ".$admin_file.".php?op=deptdefault#Default");
    } else {
	@include_once("header.php");
Opentable();
echo "<strong><center><a href='".$admin_file.".php?op=deptdefault'>Contact Administration</a></center></strong>";
echo "<strong><center><a href='".$admin_file.".php'>Main Administration</a></center></strong>";
Closetable();
//    //GraphicAdmin();
        echo "<a name=\"Delete\">";
        OpenTable();
	echo "<center><font class=\"title\"><strong>"._NSCONTACTPLUS."</strong></font></center>";
	CloseTable();
	OpenTable();
        $result = $db->sql_query("select did, dept_name from ".$prefix."_ns_contact_dept where did='$did'");
        $did       = intval($did);
        $dept_name = stripslashes($dept_name);
	list($did, $dept_name) = $db->sql_fetchrow($result);
	echo "<center><br /><br />";
	echo "<strong>"._NSDELETEDEPT."</strong><br /><br />";
	echo ""._NSDEPTDELSURE." <strong>$dept_name</strong><br />";
	echo "<br /><br />";
    echo "<input type=\"button\" value=\""._NSYES."\" title=\""._NSYES."\" onClick=\"window.location='".$admin_file.".php?op=deptdelete&amp;did=$did&amp;confirm=1'\">&nbsp;&nbsp;";
    echo "<input type=\"button\" value=\""._NSNO."\" title=\""._NSNO."\" onClick=\"window.location='".$admin_file.".php?op=deptdefault#Default'\">";
	echo "</center><br /><br />";
	CloseTable();
	@include_once("footer.php");
    }
}

switch ($op) {

    case "deptdefault":
    deptdefault();
    break;

    case "showinfo":
    show_info($xshow_add);
    break;

    case "phoneedit":
    phoneedit($pid);
    break;

    case "deptedit":
    deptedit($did);
    break;

    case "phonemodify":
    phonemodify($pid, $phone_name, $phone_num, $fax_num);
    break;

    case "deptmodify":
    deptmodify($did, $dept_name, $dept_email);
    break;

    case "addressadd":
    addressadd($address);
    break;

    case "phoneadd":
    phoneadd($phone_name, $phone_num, $fax_num);
    break;

    case "deptadd":
    deptadd($dept_name, $dept_email);
    break;

    case "phonedelete":
    phonedelete($pid, $confirm);
    break;

    case "deptdelete":
    deptdelete($did, $confirm);
    break;

}



} else {
    echo "Access Denied";
}

?>
