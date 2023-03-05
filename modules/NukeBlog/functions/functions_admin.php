<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// Admin Menu. (Will add more options as the become available.						//
// ///////////////////////////////////////////////////////////////////////////////////
function admin_menu()
{
    global $self, $bgcolor2, $db, $prefix;
	$sql = "SELECT alert_id FROM " . $prefix . "_blog_alerts";
    debug($sql);
    $result = $db->sql_query($sql);
    $num_alerts = $db->sql_numrows($result);
    opentable();
	echo("<table cellpadding=\"3\" cellspacing=\"1\" border=\"0\" align=\"center\">\n");
	echo("<tr>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=settings\">" . _NB_SETTINGS . "</a></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=remove_blog\">" . _BLOG_REMOVE . "</a></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=remove_comment\">" . _COMM_REMOVE . "</a></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=author_list\">" . _AUTHOR_LIST . "</a></td>\n");
	echo("</tr>\n");
	echo("<tr>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=admin_alerts\">" . _ADMIN_ALERTS . "</a>");
	if($num_alerts != 0) {
		echo(" (".$num_alerts.")");
	}
	echo("</td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"" . $self . "&op=mood_list\">" . _MOOD_MAN . "</a></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"admin.php\">" . _NUKE_ADMIN . "</a></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\"><a href=\"http://www.trevor.net/modules.php?name=Forums&file=viewforum&f=15\" target=\"_blank\">"._NB_HOME."</a></td>\n");
	echo("</tr>\n");
	echo("</table>\n");
    closetable();
    echo("\n");
} 

function nb_news() {
	opentable();
	center("Please visit <a href=\"http://www.trevor.net\">Trevor.Net for the latest news and upgrades");
	closetable();
}

function admin_alerts() {
	global $db, $prefix, $self, $module_name, $bgcolor1, $bgcolor2, $bgcolor3;
	$status[0] = _STATUS_CLOSED;
    $status[1] = _STATUS_OPEN;
    $status[2] = _STATUS_FRIENDS;
	$sql = "SELECT alert_id FROM " . $prefix . "_blog_alerts LIMIT 1";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $alert_id = $row[alert_id];
    } 
	if ($alert_id) {
        opentable();
        center(_MESSAGE_CENTER);
        echo("<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">\n");
        echo("<tr bgcolor=\"".$bgcolor2."\">\n");
        echo("<td align=\"center\"><strong>" . _BLOG_ID . "</strong></td>\n");
        echo("<td align=\"center\" width=\"100\"><strong>" . _ALERT_USER . "</strong></td>\n");
        echo("<td align=\"center\" width=\"100\"><strong>" . _ALERT_DATE . "</strong></td>\n");
        echo("<td align=\"center\" width=\"100\"><strong>" . _ALERT_REMOVE . "</strong></td>\n");
        echo("</tr>\n");
        $sql = "SELECT alert_id,blog_id,user_id,username,alert_date,alert_body FROM " . $prefix . "_blog_alerts ORDER BY alert_id DESC";
        debug($sql);
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $alert_date = date_convert($row[alert_date]);
            $alert_body = stripslashes($row[alert_body]);
            if ($bg == $bgcolor1) {
                $bg = $bgcolor2;
            } else {
                $bg = $bgcolor1;
            } 
			$sql2 = "SELECT user_id, blog_title, blog_status FROM ".$prefix."_blog_blogs WHERE blog_id = '$row[blog_id]'";
			$result2 = $db->sql_query($sql2);
		    while ($row2 = $db->sql_fetchrow($result2)) {
				$blog_author = lookup($row2[user_id]);
				$blog_title = stripslashes($row2[blog_title]);
				$blog_status = $status[$row2[blog_status]];
				$blog_link = "<a href=\"modules.php?name=".$module_name."&file=index&op=fetch_blog&blog_id=".$row[blog_id]."\">" . $blog_title . "</a> ("._BLOG_AUTH." <a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=".$row2[user_id]."\">" . $blog_author . "</a> | ".$blog_status." | "._BLOGID." ".$row[blog_id].")";
			}
            echo("<tr bgcolor=\"" . $bg . "\">\n");
            echo("<td valign=\"top\">".$blog_link."</td>");
            echo("<td valign=\"top\" align=\"center\"><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=".$row[user_id]."\">" . $row[username] . "</a></td>");
            echo("<td valign=\"top\" align=\"center\">" . $alert_date . "</td>");
            echo("<td valign=\"top\" align=\"center\"><a href=\"".$self."&op=alert_remove&alert_id=".$row[alert_id]."\">"._ALERT_REMOVE."</a></td>"); 
            echo("</tr>\n");
            echo("<tr bgcolor=\"" . $bg . "\">\n");
            echo("<td colspan=\"4\">" . $alert_body . "</td>");
            echo("</tr>\n");
        } 
        echo("</table>\n");
        closetable();
        br();
    } 
}


// ///////////////////////////////////////////////////////////////////////////////////
// Removes an admin alert message.													//
// ///////////////////////////////////////////////////////////////////////////////////
function alert_remove($alert_id)
{
    global $db, $prefix;
    $sql = "DELETE FROM " . $prefix . "_blog_alerts WHERE alert_id = '$alert_id'";
    $db->sql_query($sql);
    admin_alerts();
} 

function author_list($orderby, $direction) {
	global $prefix, $db, $bgcolor1, $bgcolor2, $module_name, $self;
	if(!$orderby) {
		$orderby = "username";
	}
	if(!$direction) {
		$direction = "ASC";
	}
	$bg = $bgcolor2;
	opentable();
	echo("<table align=\"center\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">\n");
	
	echo("<tr bgcolor=\"".$bg."\">\n");
	echo("<td align=\"center\" width=\"120\"><strong><a href=\"".$self."&op=author_list&orderby=username&direction=ASC\">"._BLOG_AUTH."</strong></td>\n");
	echo("<td align=\"center\" width=\"80\"><strong>"._PROFILE."</strong></td>\n");
	echo("<td align=\"center\" width=\"60\"><strong>"._PM."</strong></td>\n");
	echo("<td align=\"center\" width=\"120\"><a href=\"".$self."&op=author_list&orderby=user_last&direction=DESC\"><img src=\"modules/".$module_name."/images/arrow_down.gif\" width=\"11\" height=\"14\" alt=\"\" border=\"0\" /></a> <strong>"._LAST_BLOG."</strong> <a href=\"".$self."&op=author_list&orderby=user_last&direction=ASC\"><img src=\"modules/".$module_name."/images/arrow_up.gif\" width=\"11\" height=\"14\" alt=\"\" border=\"0\" /></a></td>\n");
	echo("<td align=\"center\" width=\"120\"><a href=\"".$self."&op=author_list&orderby=user_blogs&direction=DESC\"><img src=\"modules/".$module_name."/images/arrow_down.gif\" width=\"11\" height=\"14\" alt=\"\" border=\"0\" /></a> <strong>"._TOTAL_BLOGS."</strong> <a href=\"".$self."&op=author_list&orderby=user_blogs&direction=ASC\"><img src=\"modules/".$module_name."/images/arrow_up.gif\" width=\"11\" height=\"14\" alt=\"\" border=\"0\" /></a></td>\n");
	echo("<td align=\"center\" width=\"80\"><strong>"._STRIP_AUTHOR."</strong></td>\n");
	echo("</tr>\n");
	$sql = "SELECT user_id, username, user_last, user_blogs FROM ".$prefix."_blog_users ORDER BY $orderby $direction";
	$result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
		if($bg == $bgcolor1) {
			$bg = $bgcolor2;
		} else {
			$bg = $bgcolor1;
		}
		$user_last = date_convert($row[user_last]);
		
		echo("<tr bgcolor=\"".$bg."\">\n");
		echo("<td align=\"center\" width=\"120\"><a href=\"modules.php?name=$module_name&file=index&op=fetch_author&user_id=$row[user_id]\">$row[username]</a></td>\n");
		echo("<td align=\"center\" width=\"80\"><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=$row[user_id]\">"._PROFILE."</a></td>\n");
		echo("<td align=\"center\" width=\"60\"><a href=\"modules.php?name=Private_Messages&file=index&mode=post&u=$row[user_id]\">"._PM."</a></td>\n");
		echo("<td align=\"center\" width=\"120\">$user_last</td>\n");
		echo("<td align=\"center\" width=\"120\">$row[user_blogs]</td>\n");
		echo("<td align=\"center\" width=\"80\"><a href=\"$self&op=author_strip&user_id=$row[user_id]&step=1\">"._STRIP_AUTHOR."</a></td>\n");
		echo("</tr>\n");
	}
	echo("</table>\n");
	closetable();
}

function author_strip($user_id,$step,$method = "full") {
	global $db, $prefix, $user_prefix, $module_name, $self;
	if($step == 2) {
		if($method == "full") {
			$comments = 0;
			$blogs = 0;
			$points_blog = get_config("points_blog");
			$points_comment = get_config("points_comment");
			$sql = "SELECT comm_id FROM ".$prefix."_blog_comments WHERE user_id = '".$user_id."'";
			$result = $db->sql_query($sql);
		    while ($row = $db->sql_fetchrow($result)) {
				$comm_id = $row[comm_id];
				$sql2 = "DELETE FROM ".$prefix."_blog_comments WHERE comm_id = '".$comm_id."'";
				$db->sql_query($sql2);
				$comments = $comments + 1;
			}
			$sql = "SELECT blog_id FROM ".$prefix."_blog_blogs WHERE user_id = '".$user_id."'";
			$result = $db->sql_query($sql);
		    while ($row = $db->sql_fetchrow($result)) {
				$blog_id = $row[blog_id];
				$sql2 = "DELETE FROM ".$prefix."_blog_blogs WHERE blog_id = '".$blog_id."'";
				$db->sql_query($sql2);
				$blogs = $blogs + 1;
			}
			$sql = "DELETE FROM ".$prefix."_blog_users WHERE user_id = '".$user_id."'";
			$db->sql_query($sql);
			$sql = "DELETE FROM ".$prefix."_blog_friends WHERE friend_uid = '".$user_id."' OR user_id = '".$user_id."'";
			$db->sql_query($sql);
			if(($points_blog != 0) OR ($points_comment != 0)){
				$sql = "SELECT points FROM ".$user_prefix."_users WHERE user_id = '".$user_id."'";
				$result = $db->sql_query($sql);
			    while ($row = $db->sql_fetchrow($result)) {
					$points = $row[points];
				}
				$total_comments = $comments * $points_comment;
				$total_blogs = $blogs * $points_blog;
				$total_remove = $total_comments + $total_blogs;
				$data[points] = $points - $total_remove;
				$where = "user_id = '".$user_id."'";
				sql_update("users",$data,$where);
				opentable();
				center(_AUTH_FULLY_STRIPPED);
				closetable();
			}
		} else {
			$sql = "DELETE FROM ".$prefix."_blog_blogs WHERE user_id = '".$user_id."'";
			$db->sql_query($sql);
			$sql = "DELETE FROM ".$prefix."_blog_comments WHERE user_id = '".$user_id."'";
			$db->sql_query($sql);
			$sql = "DELETE FROM ".$prefix."_blog_users WHERE user_id = '".$user_id."'";
			$db->sql_query($sql);
			$sql = "DELETE FROM ".$prefix."_blog_friends WHERE friend_uid = '$user_id' OR user_id = '".$user_id."'";
			$db->sql_query($sql);
			opentable();
			center(_AUTH_STRIPPED);
			closetable();
		}
	} else {
		opentable();
		$points_blog = get_config("points_blog");
		$points_comment = get_config("points_comment");
		$sql = "SELECT username,points FROM ".$user_prefix."_users WHERE user_id = '".$user_id."'";
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result)) {
			$username = $row[username];
			$points = $row[points];
		}
		$sql = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $user_id . "'";
    	debug($sql);
    	$result = $db->sql_query($sql);
    	$num_blogs = $db->sql_numrows($result);
		$sql = "SELECT comm_id FROM " . $prefix . "_blog_comments WHERE user_id = '" . $user_id . "'";
    	debug($sql);
    	$result = $db->sql_query($sql);
    	$num_comments = $db->sql_numrows($result);
		$blog_points = $num_blogs * $points_blog;
		$comm_points = $num_comments * $points_comment;
		$total_points = $blog_points + $comm_points;
		$author = "<a href=\"modules.php?name=".$module_name."&file=index&op=fetch_author&user_id=".$user_id."\"><span class=\"title\">".$username."</span></a>";
		center(_REMOVE_AUTHOR);
		br();
		center($author);
		br();
		center(_REMOVE_AUTHOR2." ".$points." "._REMOVE_AUTHOR3." ".$total_points." "._REMOVE_AUTHOR4);
		br(2);
		center(_REMOVE_OPTIONS);
		br();
		$keep_link = "<a href=\"$self&op=author_list\">"._KEEP_AUTHOR."</a>";
		$stand_link = "<a href=\"$self&op=author_strip&step=2&method=standard&user_id=$user_id\">"._STANDARD_REMOVE."</a>";
		$full_link = "<a href=\"$self&op=author_strip&step=2&method=fully&user_id=$user_id\">"._FULLY_REMOVE."</a>";
		center($keep_link." | ".$stand_link." | ".$full_link);
		br(2);
		center(_LAST_WARN);
		closetable();
	}
}
// ///////////////////////////////////////////////////////////////////////////////////
// This function displays a list of the current moods enabled within the system.	//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_list()
{
    global $self, $db, $module_name, $prefix, $bgcolor1, $bgcolor2;
    $bg = $bgcolor2;
    opentable();
    center("<a href=\"" . $self . "&op=mood_add\">" . _MOOD_ADD . "</a>");
    closetable();
    br();
    opentable();
    echo("<table align=\"center\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\">\n");
    echo("<tr bgcolor=\"" . $bg . "\">\n");
    echo("<td align=\"center\" class=\"title\">" . _MOOD_TITLE . "</td>\n");
    echo("<td align=\"center\" class=\"title\">" . _MOOD_IMAGE . "</td>\n");
    echo("<td align=\"center\" class=\"title\" width=\"60\">" . _MOOD_ID . "</td>\n");
    echo("<td align=\"center\" class=\"title\" width=\"100\">" . _MOOD_EDIT . "</td>\n");
    echo("<td align=\"center\" class=\"title\" width=\"100\">" . _MOOD_REMOVE . "</td>\n");
    echo("</tr>\n");
    $sql = "SELECT mood_id, mood_title,mood_image FROM " . $prefix . "_blog_moods ORDER BY mood_title";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($bg == $bgcolor1) {
            $bg = $bgcolor2;
        } else {
            $bg = $bgcolor1;
        } 
        $mood_title = stripslashes($row[mood_title]);
        echo("<tr bgcolor=\"" . $bg . "\">\n");
        echo("<td align=\"center\">" . $mood_title . "</td>\n");
        echo("<td align=\"center\"><img src=\"modules/" . $module_name . "/images/moods/" . $row[mood_image] . "\" alt=\"" . $row[mood_title] . "\" border=\"0\" /></td>\n");
        echo("<td align=\"center\">" . $row[mood_id] . "</td>\n");
        echo("<td align=\"center\"><a href=\"" . $self . "&op=mood_edit&mood_id=" . $row[mood_id] . "\">" . _MOOD_EDIT . "</a></td>\n");
        echo("<td align=\"center\"><a href=\"" . $self . "&op=mood_remove&step=1&mood_id=" . $row[mood_id] . "\">" . _MOOD_REMOVE . "</a></td>\n");
        echo("</tr>\n");
    } 
    echo("</table>\n");
    closetable();
} 

// ///////////////////////////////////////////////////////////////////////////////////
// A very simple form that lets a site admin edit the title and image of a mood.	//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_edit($mood_id)
{
    global $self, $db, $module_name, $prefix;
    $sql = "SELECT mood_title,mood_image FROM " . $prefix . "_blog_moods WHERE mood_id = '$mood_id'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $mood_title = stripslashes($row[mood_title]);
        $mood_image = $row[mood_image];
    } 
    opentable();
    echo("<form action=\"$self\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"mood_update\" />\n");
    echo("<input type=\"hidden\" name=\"mood_id\" value=\"" . $mood_id . "\" />\n");
    echo("<table align=\"center\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\">\n");
    echo("<tr>\n");
    echo("<td align=\"right\">" . _MOOD_TITLE . "</td>\n");
    echo("<td><input type=\"text\" name=\"form[mood_title]\" value=\"" . $mood_title . "\" size=\"40\" maxlength=\"128\" /></td>\n");
    echo("</tr>\n");
    echo("<tr>\n");
    echo("<td align=\"right\">" . _MOOD_IMAGE . "</td>\n");
    echo("<td><select name=\"form[mood_image]\">\n");
	// ///////////////////////////////////////////////////////////////////////////////////
	// This portion of this function walks through the image/mood folder, picking up 	//
	// all .gif images and including them. Sorry only .gif supported!					//
	// ///////////////////////////////////////////////////////////////////////////////////
    $directory = "modules/" . $module_name . "/images/moods";
    $handle = opendir($directory);
    while ($file = readdir($handle)) {
        $filelist[] = $file;
    }
	while (list ($key, $file) = each ($filelist)) {
        if (preg_match("#.gif$#", $file)) {
            if ($file == "." || $file == "..") {
                $a = 1;
            } else {
                if ($mood_image == $file) {
                    echo("<option value=\"".$file."\" SELECTED>".$file."</option>\n");
                } else {
                    echo("<option value=\"".$file."\">".$file."</option>\n");
                } 
            } 
        } 
    } 
    echo("</select>\n<input type=\"submit\" name=\"submit\" value=\""._MOOD_UPDATE."\" /></td>\n");
    echo("</tr>\n");
    echo("</table>\n");
    echo("</form>\n");
    closetable();
} 

// ///////////////////////////////////////////////////////////////////////////////////
// Once a mood has been edited, this function will update the database. If the 		//
// admin did not include a title, they are sent back to the form.					//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_update($mood_id,$form) {
	if(!$form[mood_title]) {
		opentable();
		center(_MOOD_TITLE_REQ);
		closetable();
		br();
		mood_edit($mood_id);
	} else {
		$form[mood_title] = sterilize($form[mood_title]);
		$where = "mood_id = '$mood_id'";
		sql_update("blog_moods",$form,$where);
		opentable();
		center(_MOOD_UPDATED);
		closetable();
		br();
		mood_list();
	}
}

// ///////////////////////////////////////////////////////////////////////////////////
// Perhaps the most complex mood function. Notes in function.						//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_remove($mood_id, $step, $numood = false) {
	global $db, $prefix, $module_name, $self;
	// ///////////////////////////////////////////////////////////////////////////////////
	// Step 2 occurs after the admin has approved the removal process.					//
	// ///////////////////////////////////////////////////////////////////////////////////
	if($step == 2) {
		// ///////////////////////////////////////////////////////////////////////////////////
		// We should not randomly delete moods without updating member blogs that use the	//
		// selected mood. In the first step, we are asked what alternative to subsitute. 	//
		// The following 5 lines format the numood, or set it to null.						//
		// ///////////////////////////////////////////////////////////////////////////////////
		if($numood) {
			$form[blog_mood] = $numood;
		} else {
			$form[blog_mood] = "";
		}
		// ///////////////////////////////////////////////////////////////////////////////////
		// Update blogs to numood.															//
		// ///////////////////////////////////////////////////////////////////////////////////
		$where = "blog_mood = $mood_id";
		sql_update("blog_blogs",$form,$where);
		// ///////////////////////////////////////////////////////////////////////////////////
		// Delete the mood.																	//
		// ///////////////////////////////////////////////////////////////////////////////////
		$sql = "DELETE FROM ".$prefix."_blog_moods WHERE mood_id = '$mood_id'";
		$db->sql_query($sql);
		// ///////////////////////////////////////////////////////////////////////////////////
		// Report success.																	//
		// ///////////////////////////////////////////////////////////////////////////////////
		opentable();
		center(_MOOD_REMOVED);
		closetable();
		// ///////////////////////////////////////////////////////////////////////////////////
		// Redisplay the mood list.															//
		// ///////////////////////////////////////////////////////////////////////////////////
		br();
		mood_list();
	// ///////////////////////////////////////////////////////////////////////////////////
	// Step one is the confirmation step.												//
	// ///////////////////////////////////////////////////////////////////////////////////
	} else {
		// ///////////////////////////////////////////////////////////////////////////////////
		// Fetch mood title and image for visual confirmation.								//
		// ///////////////////////////////////////////////////////////////////////////////////
		$sql = "SELECT mood_title,mood_image FROM " . $prefix . "_blog_moods WHERE mood_id = '$mood_id'";
    	$result = $db->sql_query($sql);
	    while ($row = $db->sql_fetchrow($result)) {
    	    $mood_title = stripslashes($row[mood_title]);
        	$mood_image = $row[mood_image];
	    } 
		// ///////////////////////////////////////////////////////////////////////////////////
		// Determine how many blogs are using the selected mood.							//
		// ///////////////////////////////////////////////////////////////////////////////////
		$sql = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE blog_mood = '" . $mood_id . "'";
    	debug($sql);
    	$result = $db->sql_query($sql);
    	$num_blogs = $db->sql_numrows($result);
		// ///////////////////////////////////////////////////////////////////////////////////
		// Present warning message.															//
		// ///////////////////////////////////////////////////////////////////////////////////
		center(_MOOD_REM_WARN);
		br();
		// ///////////////////////////////////////////////////////////////////////////////////
		// Display targeted mood with image to help guard against goof-ups.					//
		// ///////////////////////////////////////////////////////////////////////////////////
		center("<img src=\"modules/".$module_name."/images/moods/".$mood_image."\" alt=\"".$mood_title."\" /><strong>".$mood_title."</strong>");
		// ///////////////////////////////////////////////////////////////////////////////////
		// If there are blogs that are using this mood...									//
		// ///////////////////////////////////////////////////////////////////////////////////
		if($num_blogs != 0) {
			br();
			center(_MOOD_NUM_BLOGS1." ".$num_blogs." "._MOOD_NUM_BLOGS2);
			br();
			// ///////////////////////////////////////////////////////////////////////////////////
			// ... present a form asking for an alternative mood to switch them too.			//
			// ///////////////////////////////////////////////////////////////////////////////////
			echo("<div align=\"center\">\n");
			echo("<form action=\"".$self."\" method=\"post\">\n");
			echo("<input type=\"hidden\" name=\"op\" value=\"mood_remove\" />\n");
			echo("<input type=\"hidden\" name=\"mood_id\" value=\"".$mood_id."\" />\n");
			echo("<input type=\"hidden\" name=\"step\" value=\"2\" />\n");
			echo("<select name=\"numood\">\n");
			// ///////////////////////////////////////////////////////////////////////////////////
			// Provide no mood options.															//
			// ///////////////////////////////////////////////////////////////////////////////////
			echo("<option value=\"\">"._NO_MOOD."</option>\n");
			echo("<option value=\"\">"._LINE."</option>\n");
			// ///////////////////////////////////////////////////////////////////////////////////
			// Walk through the mood database.													//
			// ///////////////////////////////////////////////////////////////////////////////////
			$sql = "SELECT mood_id,mood_title FROM " . $prefix . "_blog_moods ORDER BY mood_title";
    		$result = $db->sql_query($sql);
	    	while ($row = $db->sql_fetchrow($result)) {
				// ///////////////////////////////////////////////////////////////////////////////////
				// So long as the mood selected to be removed is not this option, offer it.			//
				// ///////////////////////////////////////////////////////////////////////////////////
				if($row[mood_id] != $mood_id) {
					$mood_title = stripslashes($row[mood_title]);
					echo("<option value=\"".$row[mood_id]."\">".$mood_title."</option>\n");
				}
	    	} 
			echo("</select>\n");
			br(2);
			echo("<input type=\"submit\" name=\"submit\" value=\""._MOOD_CONFIRM1."\" />\n");
			echo("</form>\n");
			echo("</div>\n");
		// ///////////////////////////////////////////////////////////////////////////////////
		// No blogs use this mood, so just offer a link to keep or remove it. No numood is	//
		// required.																		//
		// ///////////////////////////////////////////////////////////////////////////////////
		} else {
			br();
			center("<a href=\"".$self."&op=mood_list\">"._MOOD_KEEP."</a> | <a href=\"".$self."&op=mood_remove&step=2&numood=0&mood_id=".$mood_id."\">"._MOOD_CONFRIM2."</a>");
		}
	}
}

// ///////////////////////////////////////////////////////////////////////////////////
// Simple form to add a new mood. NOTE : Reads in moods directory. Must upload image//
// to the modules/THIS_MODULE/images/moods folder prior to using.					//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_add()
{
    global $self, $db, $module_name, $prefix, $form;
    opentable();
    echo("<form action=\"$self\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"mood_save\" />\n");
    echo("<table align=\"center\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\">\n");
    echo("<tr>\n");
    echo("<td align=\"right\">" . _MOOD_TITLE . "</td>\n");
    echo("<td><input type=\"text\" name=\"form[mood_title]\" size=\"40\" maxlength=\"128\" /></td>\n");
    echo("</tr>\n");
    echo("<tr>\n");
    echo("<td align=\"right\">" . _MOOD_IMAGE . "</td>\n");
    echo("<td><select name=\"form[mood_image]\">\n");
    $directory = "modules/" . $module_name . "/images/moods";
    $handle = opendir($directory);
    while ($file = readdir($handle)) {
        $filelist[] = $file;
    }
	while (list ($key, $file) = each ($filelist)) {
        if (preg_match("#.gif$#", $file)) {
            if ($file == "." || $file == "..") {
                $a = 1;
            } else {
                echo("<option value=\"".$file."\">".$file."</option>\n");
            } 
        } 
    } 
    echo("</select>\n<input type=\"submit\" name=\"submit\" value=\""._MOOD_SAVE."\" /></td>\n");
    echo("</tr>\n");
    echo("</table>\n");
    echo("</form>\n");
    closetable();
} 

// ///////////////////////////////////////////////////////////////////////////////////
// Easy~Simple function that checks for a mood title and adds the new mood to the db//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_save($form) {
	if(!$form[mood_title]) {
		opentable();
		center(_MOOD_TITLE_REQ);
		closetable();
		br();
		mood_save;
	} else {
		$form[mood_title] = sterilize($form[mood_title]);
		sql_insert("blog_moods",$form);
		opentable();
		center(_MOOD_SAVED);
		closetable();
		br();
		mood_list();
	}
}

// ///////////////////////////////////////////////////////////////////////////////////
// This function presents a form of the current config values, thus allowing an 	//
// admin to change settings.														//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_settings()
{
    global $bgcolor2, $bgcolor3, $self, $db, $prefix;
    $show_sql = get_config("show_sql");
    $bad_words = get_config("bad_words");
    $blog_page = get_config("blog_page");
    $blog_wrap = get_config("blog_wrap");
    $blog_admin = get_config("blog_admin");
    $right_blocks = get_config("right_blocks");
    $points_blog = get_config("points_blog");
    $points_comment = get_config("points_comment");
    $mass_remove = get_config("mass_remove");
    opentable();
    echo("<center><span class=\"title\"><strong>" . _BLOG_SETTINGS . "</strong></span></center>");
    closetable();
    echo("\n");
    opentable();
    echo("<form action=\"" . $self . "\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"blog_settings_update\" />\n");
    echo("<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"100%\">\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Primary blog admin (future use.)													//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\" width=\"120\">" . _BLOG_ADMIN . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\" width=\"160\"><select name=\"blog_admin\">\n");
    $sql = "SELECT aid FROM " . $prefix . "_authors WHERE radminsuper = '1' ORDER BY aid";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        if ($blog_admin == $row[aid]) {
            echo("<option value=\"" . $row[aid] . "\" SELECTED>" . $row[aid] . "</option>\n");
        } else {
            echo("<option value=\"" . $row[aid] . "\">" . $row[aid] . "</option>\n");
        } 
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _ADMIN_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Number of blogs per page.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BLOG_LISTINGS . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"blog_page\">\n");
    $total = 10;
    while ($total <= 100) {
        if ($blog_page == $total) {
            echo("<option value=\"" . $total . "\" SELECTED>" . $total . " " . _BLOGS . "</option>\n");
        } else {
            echo("<option value=\"" . $total . "\">" . $total . " " . _BLOGS . "</option>\n");
        } 
        $total = $total + 10;
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _LISTINGS_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Number of page links per line.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _PAGE_WRAP . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"blog_wrap\">\n");
    $total = 5;
    while ($total <= 25) {
        if ($blog_wrap == $total) {
            echo("<option value=\"" . $total . "\" SELECTED>" . $total . " " . _PAGES . "</option>\n");
        } else {
            echo("<option value=\"" . $total . "\">" . $total . " " . _PAGES . "</option>\n");
        } 
        $total = $total + 5;
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _PAGES_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Badword filter option.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BAD_WORDS . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"bad_words\">\n");
    if ($bad_words == 1) {
        echo("<option value=\"1\" SELECTED>" . _FILTER_ON . "</option>\n");
    } else {
        echo("<option value=\"1\">" . _FILTER_ON . "</option>\n");
    } 
    if ($bad_words == 0) {
        echo("<option value=\"0\" SELECTED>" . _FILTER_OFF . "</option>\n");
    } else {
        echo("<option value=\"0\">" . _FILTER_OFF . "</option>\n");
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BAD_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Display right side blocks in NukeBlog.											//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _RIGHT_BLOCKS . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"right_blocks\">\n");
    if ($right_blocks == 1) {
        echo("<option value=\"1\" SELECTED>" . _RIGHT_ON . "</option>\n");
    } else {
        echo("<option value=\"1\">" . _RIGHT_ON . "</option>\n");
    } 
    if ($right_blocks == 0) {
        echo("<option value=\"0\" SELECTED>" . _RIGHT_OFF . "</option>\n");
    } else {
        echo("<option value=\"0\">" . _RIGHT_OFF . "</option>\n");
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _RIGHT_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Points per blog posting.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BLOG_POINTS . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"points_blog\">\n");
    $total = 0;
    while ($total <= 10) {
        if ($points_blog == $total) {
            echo("<option value=\"" . $total . "\" SELECTED>" . $total . " " . _POINTS . "</option>\n");
        } else {
            echo("<option value=\"" . $total . "\">" . $total . " " . _POINTS . "</option>\n");
        } 
        $total = $total + 1;
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BLOG_POINTS_HINTS . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Points per comment posting.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _COMMENT_POINTS . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"points_comment\">\n");
    $total = 0;
    while ($total <= 10) {
        if ($points_comment == $total) {
            echo("<option value=\"" . $total . "\" SELECTED>" . $total . " " . _POINTS . "</option>\n");
        } else {
            echo("<option value=\"" . $total . "\">" . $total . " " . _POINTS . "</option>\n");
        } 
        $total = $total + 1;
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _COMMENT_POINTS_HINTS . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Mass Remove Points Options														//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _MASS_REMOVE . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"mass_remove\">\n");
    if ($mass_remove == 1) {
        echo("<option value=\"1\" SELECTED>" . _YES . "</option>\n");
    } else {
        echo("<option value=\"1\">" . _YES . "</option>\n");
    } 
    if ($mass_remove == 0) {
        echo("<option value=\"0\" SELECTED>" . _NO . "</option>\n");
    } else {
        echo("<option value=\"0\">" . _NO . "</option>\n");
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _MASS_REMOVE_HINT . "</td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Turn debugging on and off.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<tr>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _BLOG_DEBUG . "</td>\n");
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\"><select name=\"show_sql\">\n");
    if ($show_sql == 1) {
        echo("<option value=\"1\" SELECTED>" . _DEBUG_ON . "</option>\n");
    } else {
        echo("<option value=\"1\">" . _DEBUG_ON . "</option>\n");
    } 
    if ($show_sql == 0) {
        echo("<option value=\"0\" SELECTED>" . _DEBUG_OFF . "</option>\n");
    } else {
        echo("<option value=\"0\">" . _DEBUG_OFF . "</option>\n");
    } 
    echo("</select></td>\n");
    echo("<td bgcolor=\"" . $bgcolor2 . "\" valign=\"top\">" . _DEBUG_HINT . "</td>\n");
    echo("</tr>\n");

    echo("</table>\n");
    echo("<div align=\"right\"><input type=\"submit\" name=\"submit\" value=\"" . _UPDATE_SETTINGS . "\" /></div>\n");
    echo("</form>\n");
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Update settings.																	//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_settings_update($blog_page, $blog_wrap, $bad_words, $show_sql, $blog_admin, $right_blocks, $points_blog, $points_comment, $mass_remove)
{
    global $prefix, $db;
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$blog_page' WHERE config_key = 'blog_page'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$blog_wrap' WHERE config_key = 'blog_wrap'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$bad_words' WHERE config_key = 'bad_words'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$show_sql' WHERE config_key = 'show_sql'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$blog_admin' WHERE config_key = 'blog_admin'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$right_blocks' WHERE config_key = 'right_blocks'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$points_blog' WHERE config_key = 'points_blog'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$points_comment' WHERE config_key = 'points_comment'";
    debug($sql);
    $db->sql_query($sql);
    $sql = "UPDATE " . $prefix . "_blog_config SET config_value = '$mass_remove' WHERE config_key = 'mass_remove'";
    debug($sql);
    $db->sql_query($sql);
    blog_settings();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function allows an admin to remove a user blog with a comment being sent to	//
// the blog author.																	//
// ///////////////////////////////////////////////////////////////////////////////////
function remove_blog()
{
    opentable();
    echo("<center><span class=\"title\"><strong>" . _BLOG_REMOVE . "</strong></span></center>");
    closetable();
    echo("\n");
    opentable();
    echo("<form action=\"" . $self . "\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"blog_do_remove\" />\n");
    echo("<table align=\"center\">\n");
    echo("<tr>\n");
    echo("<td align=\"right\">Blog Id : </td>");
    echo("<td><input type=\"text\" name=\"blog_id\" size=\"10\" maxlength=\"14\" /></td>");
    echo("</tr>\n");
    echo("<tr>\n");
    echo("<td align=\"right\">Reason : </td>");
    echo("<td><textarea cols=\"50\" rows=\"10\" name=\"mess_body\"></textarea></td>");
    echo("</tr>\n");
    echo("<tr>\n");
    echo("<td align=\"right\">&nbsp;</td>");
    echo("<td><input type=\"submit\" name=\"submit\" value=\"" . _BLOG_REMOVE . "\" /></td>");
    echo("</tr>\n");
    echo("</table>\n");
    echo("</form>\n");
    center(_REM_COMMENTS);
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Actually remove a blog.															//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_do_remove($blog_id, $mess_body)
{
    global $prefix, $db, $aid;
    $sql = "SELECT user_id,blog_title,blog_date FROM " . $prefix . "_blog_blogs WHERE blog_id =  '" . $blog_id . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $data[user_id] = $row[user_id];
        $data[blog_title] = $row[blog_title];
        $data[blog_date] = $row[blog_date];
    } 
    if ($data[user_id]) {
        $data[blog_id] = $blog_id;
        $data[aid] = $aid;
        $data[mess_date] = date("Y-m-d");
        $data[mess_body] = addslashes($mess_body);
        sql_insert("blog_messages", $data);
        $sql = "DELETE FROM " . $prefix . "_blog_blogs WHERE blog_id =  '" . $blog_id . "'";
        $db->sql_query($sql);
        $sql = "DELETE FROM " . $prefix . "_blog_comments WHERE blog_id =  '" . $blog_id . "'";
        $db->sql_query($sql);
        opentable();
        center(_REM_DONE);
        closetable();
        br();
        remove_blog();
    } else {
        opentable();
        center(_BLOG_NO_EXIST);
        closetable();
        br();
        remove_blog();
    } 
} 

function remove_comment()
{
    opentable();
    echo("<center><span class=\"title\"><strong>" . _COMM_REMOVE . "</strong></span></center>");
    closetable();
    echo("\n");
    opentable();
    echo("<form action=\"" . $self . "\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"blog_do_comment\" />\n");
    echo("<table align=\"center\">\n");
    echo("<tr>\n");
    echo("<td align=\"right\">Comment Id : </td>");
    echo("<td><input type=\"text\" name=\"comm_id\" size=\"10\" maxlength=\"14\" /></td>");
    echo("<td><input type=\"submit\" name=\"submit\" value=\"" . _COMM_REMOVE . "\" /></td>");
    echo("</tr>\n");
    echo("</table>\n");
    echo("</form>\n");
    closetable();
} 

function blog_do_comment($comm_id)
{
    global $prefix, $db;
    $sql = "DELETE FROM " . $prefix . "_blog_comments WHERE comm_id =  '" . $comm_id . "'";
    $db->sql_query($sql);
    opentable();
    center(_COMM_REMOVE);
    closetable();
} 

?>