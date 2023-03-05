<?php
/* Compliance fix 022511 DocHaVoC                         			    */ 
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
    global $admin_file, $admin, $user, $sitekey, $gfx_chk;
if (is_admin($admin)) {
$content  .=  "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\">";
$content  .=  "<tr><td><p align=\"center\"><strong><u>Main</strong></u></p></tr></td>";
$content  .=  "<p align=\"left\">";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php\">Admin CP [PHP-Nuke]</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=forums\">Admin CP [Forum]</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=Configure\">Site Configuration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=sommaire\">Nav Menu Admin</a><br /></td></tr>\n";
$content  .=  "</p>";
$content  .=  "<tr><td><p align=\"center\"><strong><u>Security</strong></u></p></tr></td>";
//$content  .=  "<p align=\"left\">";
//$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=Fusion\">Fusion System</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=ABMain\">Sentinel</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=Fusion&page_value=pro_hammer_fw\">Close The Site</a><br /></td></tr>\n";
$content  .=  "</p>";
$content  .=  "<tr><td><p align=\"center\"><strong><u>Content</strong></u></p></tr></td>";
$content  .=  "<p align=\"left\">";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=ns_edl_general\">Public Downloads</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=DLMain\">Private Downloads</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=content\">Content Administration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=adminStory\">News Administration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=messages\">Message Administration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=reviews\">Reviews Administration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=FaqAdmin\">FAQ Administration</a><br /></td></tr>\n";
$content  .=  "</p>";
$content  .=  "<tr><td><p align=\"center\"><strong><u>Internal</strong></u></p></tr></td>";
$content  .=  "<p align=\"left\">";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=backup\">Database Manager</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"modules.php?name=Your_Account&file=admin\">Account Admin</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=ajaxBlocksEditor\">Blocks Administration</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=modules\">Modules Admin</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=msnl_admin\">Newsletter</a><br /></td></tr>\n";
$content  .=  "</p>";
$content  .=  "<tr><td><p align=\"center\"><strong><u>Other</strong></u></p></tr></td>";
$content  .=  "<p align=\"left\">";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=adminStory\">Post New Story (News)</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=create\">Create New Survey</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=deptdefault\">ContactPlus</a><br /></td></tr>\n";
$content  .= "<tr><td class=\"row1\">&nbsp;<strong><big>·</strong></big><a href=\"".$admin_file.".php?op=logout\">Logout</a></td></tr>\n";
$content  .= "</center>";
$content .= "</table>";
} else {
$content  .=  "<center>";
$content  .= "<form action=\"".$admin_file.".php\" method=\"post\">";
$content  .= "<table border=\"0\">";
$content  .= "<td><input type=\"text\" NAME=\"aid\" VALUE=\"Admin ID\" SIZE=\"20\" MAXLENGTH=\"25\"></td></tr>";
$content  .= "<td><input type=\"password\" NAME=\"pwd\" VALUE=\"Admin PW\" SIZE=\"20\" MAXLENGTH=\"18\"></td></tr>";
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk, 'stacked');
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
$content  .= "<input type=\"hidden\" NAME=\"op\" value=\"login\">";
$content  .= "<center><input type=\"submit\" VALUE=\""._LOGIN."\"></center>";
$content  .= "</td></tr></table>";
$content  .= "</form>";
$content  .= "</center>";
}
?>
