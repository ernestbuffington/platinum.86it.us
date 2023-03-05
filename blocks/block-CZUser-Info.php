<?php
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
if ( !defined('BLOCK_FILE') ) {
	die("Illegal Block File Access");
}
   // Some global definitions 
   global $user, $prefix, $db, $gfx_chk, $admin, $userinfo, $Version_Num, $admin_file, $currentlang, $Default_Theme;
   $content = "";
   getusrinfo($user);
   $imagebase = 'images/CZUser/';
/****[START]*********************************
 [Queries: Settings                         ]
*********************************************/
   $conf = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_czuser_conf")); 
   $show_ip = $conf['user_ip'];  
   $showpms = $conf['pms'];
   $showpoints = $conf['spoint'];
   $showposts = $conf['user_posts'];
   $useavatars = $conf['avatar'];
   $usebbranks = $conf['bbranks'];
   $showmost = $conf['most'];
   $pagehits = $conf['hits'];
   $mem_groups = $conf['groups'];
   $tooltip = $conf['tooltip'];
   $online_users = $conf['online'];
/****[END]***********************************
 [Queries: Settings                         ]
*********************************************/    
//Include the language
 if (file_exists("language/CZUser-Info/CZUser-Info-$currentlang.php")) {
    include_once("language/CZUser-Info/CZUser-Info-$currentlang.php");
   } else {
    include_once("language/CZUser-Info/CZUser-Info-english.php");
 }
//Lastuser Name
function last_user() {
    global $db, $prefix, $user_prefix;
    $sql = "SELECT username, user_color_gc FROM ".$user_prefix."_users WHERE user_active = 1 AND user_level > 0 ORDER BY user_id DESC LIMIT 1";
    $lastuser = $db->sql_fetchrow($db->sql_query($sql));
	$lastuser["color"] = UsernameColor($lastuser['user_color_gc'],$lastuser["username"]);
    return $lastuser;
}
//Total Members
function numusers() {
    global $prefix, $db;
    $sql = "SELECT COUNT(*) FROM ".$prefix."_users WHERE user_id > 1";
    list($numrows) = $db->sql_fetchrow($db->sql_query($sql));
    $numrows = number_format($numrows); 
    return $numrows;
}
//Total Waiting
function waiting_users() {
    global $prefix, $db;
    $sql = "SELECT COUNT(*) FROM ".$prefix."_users_temp";
    list($numrowswaiting) = $db->sql_fetchrow($db->sql_query($sql));
    return $numrowswaiting;
}
//New Users Today and Yesterday
function new_users() {
    global $prefix, $db;
    $sql = "SELECT COUNT(*) FROM ".$prefix."_users WHERE user_regdate='".date("M d, Y")."'";
    list($userCount[0]) = $db->sql_fetchrow($db->sql_query($sql));
    $sql = "SELECT COUNT(*) FROM ".$prefix."_users WHERE user_regdate='".date("M d, Y", time()-86400)."'";
    list($userCount[1]) = $db->sql_fetchrow($db->sql_query($sql));
    return $userCount;
}
/****[START]*********************************
 [Block: Pageview/Hits                      ]
*********************************************/
function pageview() {
	global $db, $prefix;
	list($total_hits) = $db->sql_fetchrow($db->sql_query("SELECT count FROM ".$prefix."_counter WHERE type='total' AND var='hits'"));
	list($today_hits) = $db->sql_fetchrow($db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE year='".date("Y")."' AND month='".date("n")."' AND date='".date("j")."'"));
	$y_time = time() - 86400; 
	$y_year = date("Y", $y_time); 
	$y_month = date("n", $y_time); 
	$y_date = date("j", $y_time); 
	list($yesterday) = $db->sql_fetchrow($db->sql_query("SELECT hits FROM ".$prefix."_stats_date WHERE year='$y_year' AND month='$y_month' AND date='$y_date'"));
	$pageviews = "<hr noshade><a href='modules.php?name=Statistics'><img src='images/CZUser/stats.gif' border='0'></a>&nbsp;<strong><u>Page Views:</u></strong><br />";
	$pageviews .= "<img src='images/CZUser/li.gif' align='absmiddle'> Today: <strong>$today_hits</a></strong><br />";
	$pageviews .= "<img src='images/CZUser/li.gif' align='absmiddle'> Yesterday: <strong>$yesterday</a></strong><br />";
	$pageviews .= "<img src='images/CZUser/li.gif' align='absmiddle'> Total: <strong>$total_hits</strong>";
	return $pageviews;
}
/****[END]***********************************
 [Block: Pageview/Hits                      ]
*********************************************/
if ($dopmpopup == 1) {
    if ($userinfo['user_popup_pm'] && $userinfo['user_new_privmsg']) { 
       $content .= "<script language=\"Javascript\" type=\"text/javascript\"> 	   
<!-- 
        window.open('modules.php?name=Private_Messages&file=index&mode=newpm&popup=1', '', 'HEIGHT=225,resizable=yes,WIDTH=400'); 
//--> 
</script>"; 
   } 
}  
function czuser_get_members_online () {
    global $prefix, $db, $user_prefix, $Default_Theme, $name;
	$imagebase = 'images/CZUser/';
    $usersord = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_czuser_conf"));
	if ($usersord['tooltip'] == 1){
?>
	<script language='JavaScript' src='includes/javascript/tooltip.js'></script>
<?php
	}
	if($usersord['ordermode'] == 1){
		$order = "w.uname ASC";
	}else{
		$order = "u.user_id ASC";
	}
	$i = 1;
	$tooltip_feature .= "u.user_email, u.user_regdate, u.user_posts, u.theme, u.user_id, u.user_avatar_type, u.user_avatar, u.user_gender";
	$result = $db->sql_query("SELECT w.uname, w.module, w.url, u.user_color_gc, ".$tooltip_feature." FROM ".$prefix."_session AS w LEFT JOIN ".$user_prefix."_users AS u ON u.username = w.uname WHERE w.guest = '0' OR w.guest = '2' ORDER BY ".$order."");
    $member_online_num = $db->sql_numrows($result);
    while ($session = $db->sql_fetchrow($result)) {
	if($i < 10) {
            $num = '0'.$i;
        } else {
            $num = $i;
        }
    //if (isset($session['guest']) and $session['guest'] == 0) {
    list ($pic, $king, $gname) = $db->sql_fetchrow($db->sql_query("SELECT pic, king, gname FROM ".$prefix."_czuser_info WHERE view = '".$session['uname']."'"));
    if ($king == '1') $img = "admin.png"; else $img = "msg.png";
	if($usersord['chopped'] == 1){
	if (strlen($session['uname']) > $usersord['charnum']) {
		$nameChopped = substr("$session[uname]", 0,$usersord['charnum']);
		$nameChopped .= "...";
	} else {
		$nameChopped = UsernameColor($session['user_color_gc'],$session['uname']);
	}
	}else{
		$nameChopped = UsernameColor($session['user_color_gc'],$session['uname']);
	}		
	$link_view = $session['url'];
	$font_color = $session['user_color_gc'];	
/****[START]*************************************
 [Block: Tooltip Feature                        ]
*************************************************/
	$email = $session['user_email'];
	$registered = $session['user_regdate'];
	$posts = $session['user_posts'];
	if($session['theme'] == ""){$theme = "".$Default_Theme."";}else{$theme = $session['theme'];}
	if ($session['module'] == ""){$where = "Home";}else{$where = $session['module'];}
/****[END]***************************************
 [Block: Tooltip Feature                        ]
*************************************************/   
	if($usersord['pick'] == 1){
	$out['text'] .= "<a href='".$link_view."'><img src='".$imagebase."".$img."' alt='Viewing ".$where."' title='Viewing ".$where."' border='0'></a> ";
	}else{
	$out['text'] .= "<a href='".$link_view."' title='".$where."' alt='".$where."'>$num</a>. ";
	}
	$img_u = "<img src=\'images/CZUser/overlib/memberusr.gif\' width=\'16\'>&nbsp;";
	$img_e = "<img src=\'images/CZUser/overlib/messages.gif\' width=\'16\'>&nbsp;";
	$img_r = "<img src=\'images/CZUser/overlib/regdate.gif\' width=\'16\'>&nbsp;";
	$img_z = "<img src=\'images/CZUser/overlib/membership.gif\' width=\'16\'>&nbsp;";
	$img_p = "<img src=\'images/CZUser/overlib/posts.gif\' width=\'16\'>&nbsp;";
	$img_t = "<img src=\'images/CZUser/overlib/theme.gif\' width=\'16\'>&nbsp;";
	$img_w = "<img src=\'images/CZUser/overlib/where.gif\' width=\'16\'>&nbsp;";
	$img_x = "<img src=\'images/CZUser/overlib/unknown.gif\' width=\'16\'>&nbsp;";
	$img_m = "<img src=\'images/CZUser/overlib/male.gif\' width=\'16\'>&nbsp;";
	$img_g = "<img src=\'images/CZUser/overlib/female.gif\' width=\'16\'>&nbsp;";
	if ($usersord['tooltip'] == 1){
		$out['text'] .= "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=".$session["uname"]."\" onMouseOver=\"toolTip('";
if ($usersord['davatar'] == 1){
	if ($session['user_avatar_type'] == 1){$out['text'] .= "<center><img src=\'modules/Forums/images/avatars/".$session['user_avatar']."\'></center><br />";} 	
elseif ($session['user_avatar_type'] == 2){$out['text'] .= "<center><img src=\'".$session['user_avatar']."\'></center><br />";} 
elseif ($session['user_avatar_type'] == 3){$out['text'] .= "<center><img src=\'modules/Forums/images/avatars/".$session['user_avatar']."\'></center><br />";}
elseif ($session['user_avatar'] == 'blank.gif'){$out['text'] .= "<center><img src=\'modules/Forums/images/avatars/gallery/blank.gif\'></center><br />";}
elseif ($session['user_avatar'] == ''){$out['text'] .= "<center><img src=\'modules/Forums/images/avatars/gallery/blank.gif\'></center><br />";}  
	}
	if($usersord['duser'] == 1){$out['text'] .= "".$img_u."Username: <font color=\'".$font_color."\'><strong>".$session["uname"]."</strong></font><br />";}else{$out['text'] .= "".$img_u."Username: Hidden<br />";}
	if($usersord['demail'] == 1){$out['text'] .= "".$img_e."Email: ".$email."<br />";}else{$out['text'] .= "".$img_e."Email: Hidden<br />";}
	if($usersord['dreg'] == 1){$out['text'] .= "".$img_r."Registered: ".$registered."<br />";}else{$out['text'] .= "".$img_r."Registered: Hidden<br />";}
	if ($usersord['dgender'] == 1){
	if($session['user_gender'] == 0){$out['text'] .= "".$img_x."Gender: Not Specified<br />";}
elseif($session['user_gender'] == 1){$out['text'] .= "".$img_m."Gender: Male<br />";}
elseif($session['user_gender'] == 2){$out['text'] .= "".$img_g."Gender: Female<br />";}
	}
	if($gname){$out['text'] .= "".$img_z."Memberstatus: ".$gname."<br />";}
	if($usersord['dpost'] == 1){$out['text'] .= "".$img_p."Posts: ".$posts."<br />";}else{$out['text'] .= "".$img_p."Posts: Hidden<br />";}
	if($usersord['dtheme'] == 1){$out['text'] .= "".$img_t."Theme: ".$theme."<br />";}else{$out['text'] .= "".$img_t."Theme: Hidden<br />";}
	if($usersord['dwhere'] == 1){$out['text'] .= "".$img_w."Site Location: ".$where."";}else{$out['text'] .= "".$img_w."Site Location: Hidden";}
		$out['text'] .= "', 240)\" onMouseOut=\"toolTip()\"><font color='".$font_color."'><strong>".$nameChopped."</strong></font></a>";
	}else{	
    	$out['text'] .= "<a href='modules.php?name=Your_Account&op=userinfo&username=".$session['uname']."' title=\"View ".$session['uname']."'s Profile\" alt=\"View ".$session['uname']."'s Profile\"><font color='$font_color'><strong>".$nameChopped."</strong></font></a>\n";
	}
    if (isset($pic) && $pic != '') $out['text'] .= "&nbsp;&nbsp;<img src='images/CZUser/admin/".$pic."' border='0' vspace='1' alt=''>\n";
	$out['text'] .= "<br />";
	  // }
	  $i++;
	}
	$i--;
	$out['total'] = $i;
    return $out;
}
function czuser_get_guests_online ($start) {
    global $prefix, $db;
    $result = $db->sql_query("SELECT uname, url, module FROM ".$prefix."_session WHERE guest='1' OR guest='3'");
    $out['total'] = $db->sql_numrows($result);
    $out['text'] = '';
    $i = $start;
    while ($session = $db->sql_fetchrow($result)) {
        if($i < 10) {
            $num = '0'.$i;
        } else {
            $num = $i;
        }
        $module = $session['module'];
        $url = $session['url'];
        $url = str_replace("&", "&amp;", $url);
		if($url == "/index.php"){
		$module .= "news";
		}	
		$usersord = $db->sql_fetchrow($db->sql_query("SELECT pick FROM ".$prefix."_czuser_conf"));		
		    if($usersord['pick'] == 1){
				$where = "<a href='$url' title='$module'><img src='images/CZUser/online_guest.png' border='0'></a>&nbsp;";
			} else {
				$where = "<a href=\"$url\" title=\"$module\">$num</a>.&nbsp;";
			}
            $user_agent = identify::identify_agent();
			$ip = explode('.', $session['uname']);
			if (is_admin($admin) AND is_user($user)) {
			$uname = $session['uname'];
			}else{
            $uname = $ip[0].'.'.$ip[1].'.'.preg_replace("/[0-9]/", "x", $ip[2]).'.'.preg_replace("/[0-9]/", "x", $ip[3]);}
            if($user_agent['engine'] == 'bot') {
                $out['text'] .= "<br />".$where."".$user_agent['ua']."\n";
            } else {
                $out['text'] .= "<br />".$where."".$uname."\n";
        }
        $i++;
    }
    $db->sql_freeresult($result);
    return $out;
}
function czuser_online_display ($members, $guests) {
	global $prefix, $db;
	$guest_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='1' OR guest='3'"));
	$member_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest = '0'"));
	$usersord = $db->sql_fetchrow($db->sql_query("SELECT guests FROM ".$prefix."_czuser_conf"));
    $out .= '<img src="images/CZUser/online.gif">&nbsp;<strong><u>Online:</strong></u>';
	if ($member_online_num>10) {
	$out .= '<br /><img src="images/CZUser/li.gif" align="absmiddle"> Members:&nbsp;<br />';
    $out .= '<div style="border: 0pt none; height: 100px; width: 100%; overflow: auto;">'.$members['text'].'</div>';
	}else{
	$out .= '<br /><img src="images/CZUser/li.gif" align="absmiddle"> Members:&nbsp;<br />'.$members['text'].'';
	}
	if ($usersord['guests'] == 1){
	if ($guest_online_num>10) {
	$out .= '<br /><img src="images/CZUser/li.gif" align="absmiddle"> Guests:&nbsp;<br />';
	$out .= '<div style="border: 0pt none; height: 100px; width: 100%; overflow: auto;">'.$guests['text'].'</div>';
	}else{
	$out .= '<br /><img src="images/CZUser/li.gif" align="absmiddle"> Guests:&nbsp;'.$guests['text'].'';
	}
	}
    return $out;
}
$czuser_online_members = czuser_get_members_online();
$czuser_online_guests = czuser_get_guests_online($czuser_online_members['total']+1);
/****[START]*************************************
 [Block: Online Members                         ]
*************************************************/
   $member_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest = '0'"));
   $guest_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='1'"));
   $spider_online_num = $db->sql_numrows($db->sql_query("SELECT uname FROM ".$prefix."_session WHERE guest='3'"));
   $total_online_num = ($member_online_num + $guest_online_num + $spider_online_num);
   @$m_percent=($member_online_num/$total_online_num)*100; $m_percent = number_format($m_percent, 0);
   @$g_percent=($guest_online_num/$total_online_num)*100; $g_percent = number_format($g_percent, 0);
   @$s_percent=($spider_online_num/$total_online_num)*100; $s_percent = number_format($s_percent, 0);
/****[END]***************************************
 [Block: Online Members                         ]
*************************************************/
   //Mostonline data
   $result = $db->sql_query("SELECT total, members, spiders, nonmembers FROM ".$prefix."_czuser_mostonline");
   $row = $db->sql_fetchrow($result);
   $total = intval($row['total']);
   $members = intval($row['members']);
   $spiders = intval($row['spiders']);
   $nonmembers = intval($row['nonmembers']);
   $db->sql_freeresult($result);
   //Break Mostonline Total?
   if ($total < $total_online_num) {
   $db->sql_query("DELETE FROM ".$prefix."_czuser_mostonline WHERE total='$total' LIMIT 1");
   $db->sql_query("INSERT INTO ".$prefix."_czuser_mostonline VALUES ('$total_online_num','$member_online_num', '$spider_online_num','$guest_online_num')");
   }
   if (is_user($user)) {
/****[START]*************************************
 [Block: Greet User                             ]
*************************************************/
   $urname = $userinfo["username"];
   $urname_color = UsernameColor($userinfo["user_color_gc"],$userinfo["username"]);
   $content .= "<center>";
   $content .= "<script language=\"JavaScript\">\n";
   $content .= "welcome_user();\n";
   $content .= "function welcome_user() {\n";
   $content .= "var thedate;\n";
   $content .= "var thehour;\n";
   $content .= "thedate = new Date();\n";
   $content .= "thehour = thedate.getHours();\n"; 
   $content .= "if (thehour <12)\n";
   $content .= "document.write(\""._CZ_GOODMORNINGUSER."<br />".$urname_color."\")\n";
   $content .= "else if (thehour < 17)\n";
   $content .= "document.write(\""._CZ_GOODAFTERNOONUSER."<br />".$urname_color."\")\n";
   $content .= "else\n";
   $content .= "document.write(\""._CZ_GOODEVENINGUSER."<br />".$urname_color."\")\n";
   $content .= "}\n";
   $content .= "</script>\n";
   $content .= "</center>"; 
/****[END]***************************************
 [Block: Greet User                             ]
*************************************************/
/****[START]*************************************
 [Block: User IP Display                        ]
*************************************************/
if ($show_ip == 1){$content .= "<center>IP:&nbsp;&nbsp;".getenv('REMOTE_ADDR')."</center>";}
/****[END]***************************************
 [Block: User IP Display                        ]
*************************************************/
/****[START]*************************************
 [Block: User Post Count                        ]
*************************************************/
	$sqlp = "SELECT user_posts AS posts FROM ".$prefix."_users WHERE username = '$urname'";
	$result = $db->sql_query($sqlp);
	$row = $db->sql_fetchrow($result);
	$post_count = $row['posts'];
	$uid = $row['uid'];
/****[END]***************************************
 [Block: User Post Count                        ]
*************************************************/
if ($useavatars == 1) {
   $bbconf = array();
   $result = $db->sql_query("SELECT * FROM ".$prefix."_bbconfig");
   while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
	   $bbconf[$config_name] = $config_value;
   }
  if ($userinfo['user_allowavatar']) {
  if ($userinfo['user_avatar_type'] == 1)  { 
   $content .= "<br /><center><img src=\"".$bbconf['avatar_path']."/".$userinfo['user_avatar']."\"></center><br />\n"; 
 } elseif ($userinfo['user_avatar_type'] == 2) { 
   $content .= "<br /><center><img src=\"".$userinfo['user_avatar']."\"></center><br />\n"; 
 } elseif ($userinfo['user_avatar'] == "") { 
   $content .= "<br /><center><img src=\"".$bbconf['avatar_gallery_path']."/gallery/blank.gif\"></center>\n"; 
 } else {
   $content .= "<br /><center><img src=\"".$bbconf['avatar_gallery_path']."/".$userinfo['user_avatar']."\"></center><br />\n";
   }
  }
}
if ($usebbranks == 1) 
		{
			$result_rank = $db->sql_query("SELECT * FROM `". $prefix ."_bbranks` ORDER BY `rank_special`, `rank_min`");   
   			$ranksrow = array();   
   			while($row = $db->sql_fetchrow($result_rank)) 
			{   
           		$ranksrow[] = $row;		   
   			}   
   			$db->sql_freeresult($result_rank);
			$rank_image = '';
   			$poster_rank = '';
        	if ($userinfo['user_rank']) 
			{
				for($j = 0; $j < count($ranksrow); $j++) 
				{			
              		if ($userinfo['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special']) 
					{			  
                  		$poster_rank = $ranksrow[$j]['rank_title'];				  
                  		$rank_image = ($ranksrow[$j]['rank_image']) ? '<img src="modules/Forums/'. $ranksrow[$j]['rank_image'] .'" alt="'. $poster_rank .'" title="'. $poster_rank .'" border="0"><br />' : '';				  
              		}
            	}
        	} 
			else 
			{		
           		for($j = 0; $j < count($ranksrow); $j++) 
				{		   
             		if ($userinfo['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special']) 
					{			 
                  		$poster_rank = $ranksrow[$j]['rank_title'];				  
                  		$rank_image = ($ranksrow[$j]['rank_image']) ? '<img src="modules/Forums/'. $ranksrow[$j]['rank_image'] .'" alt="'. $poster_rank .'" title="'. $poster_rank .'" border="0"><br />' : '';				  
             		}			 
           		}		   
        	}
   $content .= "<center>".$rank_image."".$poster_rank."</center>\n";  
   if($showposts == 1){$content .= "<center>".$post_count." post(s)</center>\n";}
}
   $content .= "<br />";
   $content .= "<center>[ <a title=\"LogOut\" href=\"modules.php?name=Your_Account&amp;op=logout\">LogOut</a> ]</center>\n";
   $content .= "<center>[ <a href=\"modules.php?name=Forums&file=profile&mode=editprofile\">Edit My Profile</a> ]</center>";
   $content .= "<center>[ <a href=\"modules.php?name=Your_Account\">Edit My Account</a> ]</center>";   
   $content .= "<hr noShade>";
   $content .= "<a href=\"modules.php?name=Your_Account\" title=\""._CZ_GOHOME."\"><img src=\"images/CZUser/home.gif\" border=\"0\"></a>\n";
   $content .= "<u><strong>"._CZ_ACCOUNTINFO."</u></strong><br />\n";
  if ($showpoints == 1) {
   $userpoints = number_format($userinfo[$sitepoints]);
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'>\n";
   $content .= ""._CZ_POINTS."$userpoints<br />\n";
  }
/****[START]***********************************************
 [Block: Check Private Messages                           ]
***********************************************************/
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". $userinfo['user_id'] ."' AND (privmsgs_type='5' OR privmsgs_type='1')";
  if ( !($result = $db->sql_query($sql)) ){die('error checking new pms');}
  $new_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  $sql = "SELECT privmsgs_to_userid FROM ".$prefix."_bbprivmsgs WHERE privmsgs_to_userid='". $userinfo['user_id'] ."' AND (privmsgs_type='0')";
  if ( !($result = $db->sql_query($sql)) ){die('error checking old pms');}
  $old_pms = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  if ($showpms == 1) {
  $content .= "<img src=\"images/CZUser/li.gif\" align=\"absmiddle\">\n";
  if ($new_pms>0){ 
   $content .= '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,42,0"
  id="newpm" width="0" height="0">
  <param name="movie" value="newpm.swf">
  <param name="bgcolor" value="#DDDDDD">
  <param name="quality" value="high">
  <param name="allowscriptaccess" value="samedomain">
  <embed type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="0" height="0" name="newpm" src="newpm.swf" bgcolor="#DDDDDD" quality="high" swLiveConnect="true" allowScriptAccess="samedomain" hidden="true"></embed></object>';
   $content .= ""._CZ_PRUNREAD."<strong><a title=\""._CZ_CHECKPMS."\" href=\"modules.php?name=Private_Messages\">$new_pms</a></strong><br />\n";
}else{ 
   $content .= ""._CZ_PRUNREAD."<strong><a title=\""._CZ_CHECKPMS."\" href=\"modules.php?name=Private_Messages\">$new_pms</a></strong><br />\n";
   }
   $content .= "<img src=\"images/CZUser/li.gif\" align=\"absmiddle\">\n";
   $content .= ""._CZ_PRREAD."<strong>$old_pms</strong><br />\n";
   }
/****[END]*************************************************
 [Block: Check Private Messages                           ]
***********************************************************/
   $content .= "<hr noShade>";
   } else {
   //Display LOGIN information for Guests Only 
   mt_srand ((double)microtime()*1000000);
   $maxran = 1000000;
   $random_num = mt_rand(0, $maxran);
   $content .= "<form action=\"modules.php?name=Your_Account\" method=\"post\">\n";
/****[START]*******************************************
 [Greet Guest                        Last Updated N/A ]
 ******************************************************/
   //$content .= "<img src=\"images/CZUser/user.gif\">&nbsp;\n";
   $content .= "<center>";
   $content .= "<script language=\"JavaScript\">\n";
   $content .= "welcome_guest();\n";
   $content .= "function welcome_guest() {\n";
   $content .= "var thedate;\n";
   $content .= "var thehour;\n";
   $content .= "thedate = new Date();\n";
   $content .= "thehour = thedate.getHours();\n";   
   $content .= "if (thehour <12)\n";
   $content .= "document.write(\""._CZ_GOODMORNINGGUEST."\")\n";
   $content .= "else if (thehour < 17)\n";
   $content .= "document.write(\""._CZ_GOODAFTERNOONGUEST."\")\n";
   $content .= "else\n";
   $content .= "document.write(\""._CZ_GOODEVENINGGUEST."\")\n";
   $content .= "}\n";
   $content .= "</script>\n";
   $content .= "</center>";
   $content .= "<hr noShade>";
/*****[END]********************************************
 [Greet Guest                        Last Updated N/A ]
 ******************************************************/  
/****[START]*******************************************
 [Display Guest Avatar               Last Updated N/A ]
 ******************************************************/
   $content .= "<div align=\"center\"><img src=\"modules/Forums/images/avatars/gallery/guest.gif\"></div>";
/*****[END]********************************************
 [Display Guest Avatar               Last Updated N/A ]
 ******************************************************/
   $content .= "<hr noShade>";	
/****[START]*******************************************
 [Login Box & Registration Link      Last Updated N/A ]
 ******************************************************/
   //$content .= "<img src='images/CZUser/li.gif' align='absmiddle'>\n";
   $content .= "<center>";
   $content .= "[ <a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._CZ_REGISTER."</a> ]<br />\n"; 
   //$content .= "<img src='images/CZUser/li.gif' align='absmiddle'>\n";
   $content .= "[ <a href=\"modules.php?name=Your_Account&op=pass_lost\">"._CZ_LOSTPASSWORD."</a> ]\n";
   $content .= "</center>";
   $content .= "<hr noshade>";
   $content .= "<center><table>
  <tr>
   <td>" . _NICKNAME . "</td>
   <td><input type='text' name='username' size='10' maxlength='25' /></td>
  </tr>
  <tr>
   <td>" . _PASSWORD . "</td>
   <td><input type='password' name='user_password' size='10' maxlength='20' /></td>
  </tr>
 </table></center>";
/*****[END]********************************************
 [Login Box & Registration Link      Last Updated N/A ]
 ******************************************************/ 
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
    $gfxchk = array(2,4,5,7);
    $content .= security_code($gfxchk, 'stacked');
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/  
   $content .= "<input type=\"hidden\" name=\"redirect\" value=$redirect>\n";
   $content .= "<input type=\"hidden\" name=\"mode\" value=$mode>\n"; 
   $content .= "<input type=\"hidden\" name=\"f\" value=$f>\n"; 
   $content .= "<input type=\"hidden\" name=\"t\" value=$t>\n"; 
   $content .= "<input type=\"hidden\" name=\"op\" value=\"login\">\n"; 
   $content .= "<center><input type=\"submit\" value=\"Login My Account\"></center>";
   $content .= "<hr noShade>"; 
   } 
/****[START]*************************************
 [Info For Members              Last Updated N/A]
*************************************************/
   $last = new_users();
   $lastuser = last_user();
   $content .= "<a href=\"modules.php?name=Members_List\" title=\""._CZ_MEMBERSLIST."\"><img src=\"images/CZUser/members.gif\" border=\"0\"></a>\n";
   $content .= "<u><strong>"._CZ_MEMBERSHIP."</u></strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_TODAY."<strong>".$last[0]."</strong><br />\n"; 
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_YESTERDAY."<strong>".$last[1]."</strong></strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_WAITING."<strong>".waiting_users()."</strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_TOTALMEMBERS."<strong>".numusers()."</strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_LATEST."\n";
   $content .= "<strong>".$lastuser["color"]."</strong><br />\n";
/*****[END]********************************************
 [Info For Members                    Last Updated N/A]
 ******************************************************/
/****[START]*******************************************
 [Czuser Most Online             Last Updated 29/07/07] 
 ******************************************************/
   if ($showmost==1) {
   $content .= "<hr noShade>";
   $content .= "<a href=\"modules.php?name=Statistics\" title=\""._CZ_STATS."\"><img src=\"images/CZUser/stats.gif\" border=\"0\"></a>\n";
   $content .= "<u><strong>"._CZ_MOSTONLINE."</u></strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_MEMBERS."<strong>".number_format($members)."</strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_VISITORS."<strong>".number_format($nonmembers)."</strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> Search Bots: <strong>".number_format($spiders)."</strong><br />\n";   
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_TOTALONLINE."<strong>".number_format($total)."</strong><br />\n";
   }
/*****[END]********************************************
 [Czuser Most Online             Last Updated 29/07/07] 
 ******************************************************/
/****[START]*******************************************
 [Count Users Online             Last Updated 29/07/07] 
 ******************************************************/
   $content .= "<hr noShade>";
   $content .= "<img src=\"images/CZUser/group.gif\">\n";
   $content .= "<strong><u>"._CZ_ONLINEINFO."</u></strong><br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_MEMBERS." ". $member_online_num ."&nbsp;&nbsp;-&nbsp;&nbsp;".$m_percent."%<br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> "._CZ_VISITORS." ". $guest_online_num ."&nbsp;&nbsp;-&nbsp;&nbsp;".$g_percent."%<br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> Search Bots: ". $spider_online_num ."&nbsp;&nbsp;-&nbsp;&nbsp;".$s_percent."%<br />\n";
   $content .= "<img src='images/CZUser/li.gif' align='absmiddle'> Total Online: ". $total_online_num ."<br />\n";
   if (is_user($user) || is_admin($admin)) {
   if($pagehits ==1){$content .= pageview();}
   }
   $content .= "<hr noshade>";
/*****[END]********************************************
 [Count Users Online             Last Updated 29/07/07] 
 ******************************************************/  
/****[START]*******************************************
 [User Groups Integration             Last Updated N/A] 
 ******************************************************/
if($mem_groups == 1){
if (is_user($user) || is_admin($admin)) {
		$group_id = $userinfo['user_id'];
        $content .= "<img src='images/CZUser/group-2.gif'>\n";
		$content .= "<strong><u>Membership's:</u></strong><br />\n";
        $result = $db->sql_query("SELECT group_name FROM ".$prefix."_bbgroups LEFT JOIN ".$prefix."_bbuser_group on ".$prefix."_bbuser_group.group_id=".$prefix."_bbgroups.group_id WHERE ".$prefix."_bbuser_group.user_id='".$group_id."' and ".$prefix."_bbgroups.group_description != 'Personal User'");
        if ($db->sql_numrows($result) == 0) {
           $content .= "<img src='images/CZUser/li.gif' align='middle' alt=''> None<br />";
        } else {
           while(list($gname) = $db->sql_fetchrow($result, 'SQL_NUM')) {	
              $content .= "<img src='images/CZUser/li.gif' align='absmiddle' alt='$gname' title='$gname'> $gname<br />";
           }
        }
        $db->sql_freeresult($result);
		$content .= "<hr noShade>";
	 }
	 }
/*****[END]********************************************
 [User Groups Integration             Last Updated N/A] 
 ******************************************************/
   //Users Online List 
 if (is_user($user) || $online_users == 1) { 
   $content .= czuser_online_display($czuser_online_members, $czuser_online_guests);
}else{
   $content .= "<center>You must <a href='modules.php?name=Your_Account&op=new_user'>register</a> to interact with Members</center>";
 }
?>