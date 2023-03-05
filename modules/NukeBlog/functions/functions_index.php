<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// This is the master list for each blog user.										//
// ///////////////////////////////////////////////////////////////////////////////////
function fetch_author($user_id, $offset = 0)
{
    global $nb_user, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $prefix, $user_prefix, $db, $self, $module_name; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Is the current user a friend of this blog owner?									//
    // ///////////////////////////////////////////////////////////////////////////////////
    $friend = friend($user_id); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // How many records do we grab each time?											//
    // ///////////////////////////////////////////////////////////////////////////////////
    $blog_page = get_config("blog_page"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Grab selected user's username and avatar.										//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT username,user_avatar FROM " . $user_prefix . "_users WHERE user_id = '$user_id'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $username = $row[username];
        $useravatar = $row[user_avatar];
    } 
    center("<a href=\"" . $self . "&op=fetch_author&user_id=" . $user_id . "\"><span class=\"title\">" . $username . "</span></a>"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Only show the avatar if one is present in the database. Prevents red x's.		//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($useravatar) {
        center("<img src=\"modules/Forums/images/avatars/" . $useravatar . "\" alt=\"" . $username . "\" />");
    } 
    br(2);
    $bg = $bgcolor2; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Create display table.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    opentable();
    echo("<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n");
    echo("<tr bgcolor=\"" . $bg . "\">\n");
    echo("<td><strong>" . _BLOG_TITLE . "</strong></td>\n");
    echo("<td align=\"center\" width=\"120\"><strong>" . _BLOG_MOOD . "</strong></td>\n");
    echo("<td align=\"center\" width=\"100\"><strong>" . _BLOG_DATE . "</strong></td>\n");
    echo("<td align=\"center\" width=\"40\"><strong>" . _BLOG_VIEWS . "</strong></td>\n");
    echo("<td align=\"center\" width=\"70\"><strong>" . _BLOG_COMMENTS . "</strong></td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Construct query statement to paginate through the user's blog listings.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_id,user_id,blog_title,blog_mood,blog_date,blog_status,blog_comments,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '$user_id' ORDER BY blog_id DESC LIMIT " . $offset . " ," . $blog_page . "";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through the results.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    while ($row = $db->sql_fetchrow($result)) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // ALternate table row colors.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($bg == $bgcolor1) {
            $bg = $bgcolor2;
        } else {
            $bg = $bgcolor1;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // What blog_id are we dealing with?												//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_id = $row[blog_id]; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If blog status is set to 0 then this blog is intended for the owner only.		//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($row[user_id] == $nb_user[user_id]) {
            $blog_name = stripslashes($row[blog_title]);
            $blog_title = "<a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row[blog_id] . "\">" . $blog_name . "</a> " . _YOURS; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Friends Only No																	//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else if (($row[blog_status] == 2) AND ($friend == false)) {
            $blog_title = _BLOG_PRIVATE; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Friends Only Yes																	//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else if (($row[blog_status] == 2) AND ($friend == true)) {
            $blog_name = stripslashes($row[blog_title]);
            $blog_title = "<a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row[blog_id] . "\">" . $blog_name . "</a> (" . _FRIEND . ")"; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If blog status is 0, then this is a closed blog entry.							//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else if (($row[blog_status] == 0) AND ($row[user_id] != $nb_user[user_id])) {
            $blog_title = _BLOG_PRIVATE; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Allow blog owners to view thier own listings.									//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $blog_name = stripslashes($row[blog_title]);
            $blog_title = "<a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row[blog_id] . "\">" . $blog_name . "</a>";
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Fetch Mood Title																	//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($row[blog_mood] != 0) {
            $sql2 = "SELECT mood_title FROM " . $prefix . "_blog_moods WHERE mood_id = '$row[blog_mood]'";
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $mood_title = stripslashes($row2[mood_title]);
            } 
        } else {
            $mood_title = false;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Convert the date for this blog.													//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_date = date_convert($row[blog_date]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Blog comments on? If so, how many comments?										//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_comments = $row[blog_comments];
        if ($blog_comments == 1) {
            $num_comms = num_comms($blog_id);
        } else {
            $num_comms = _BLOG_OFF;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Display results.																	//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<tr bgcolor=\"" . $bg . "\">\n");
        echo("<td>" . $blog_title . "</td>\n");
        echo("<td align=\"center\">" . $mood_title . "</td>\n");
        echo("<td align=\"center\">" . $blog_date . "</td>\n");
        echo("<td align=\"center\">" . $row[blog_views] . "</td>\n");
        echo("<td align=\"center\">" . $num_comms . "</td>\n");
        echo("</tr>\n");
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Close the initial table.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("</table>\n");
    closetable(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // NOTE : Everything from here down is experimental as there is no way for me to 	//
    // test it without users. What it *SHOULD* do is drop in a table that lets the user	//
    // walk through the database backwards. Will have to find a well used site to test.	//
    // My limited testing showed it working 100%. :)									//
    // ///////////////////////////////////////////////////////////////////////////////////
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Test to see how many blogs we have.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $user_id . "' AND blog_status != '0'";
    debug($sql);
    $result = $db->sql_query($sql);
    $num_blogs = $db->sql_numrows($result); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If the number of total blogs is greater than the number alloted to each page,	//
    // open up the pagination table and proceed to offer archival links.				//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($num_blogs >= $blog_page) {
        opentable(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Set initial counting values.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        $page_num = 1;
        $count = 0;
        $in_row = 1; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // How many page links per line?													//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_wrap = get_config("blog_wrap"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Begin the pagination table.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">");
        echo("<tr>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Walk through the database until we have reached the desired number of page links.//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($count < $num_blogs) {
            echo("<td align=\"center\"><a href=\"" . $self . "&op=fetch_author&offset=" . $count . "&user_id=" . $user_id . "\">" . _PAGE . " " . $page_num . "</a></td>\n");
            if ($in_row == $blog_wrap) {
                echo("</tr>\n");
                echo("<tr>\n");
                $in_row = 0;
            } else {
                $in_row++;
            } 
            $page_num++;
            $count = $count + $blog_page; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Complete the table for old browser compatability.								//
            // ///////////////////////////////////////////////////////////////////////////////////
        } while (($in_row < $blog_wrap) AND ($num_blogs <= $count)) {
            echo("<td><!--Trevor Was Here--></td>\n");
            $in_row++;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Finish and close the table.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("</tr>\n");
        echo("</table>");
        closetable();
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Test for friend status with the current user.									//
// ///////////////////////////////////////////////////////////////////////////////////
function friend($this_id)
{
    global $prefix, $db, $nb_user;
    $sql = "SELECT friend_id FROM " . $prefix . "_blog_friends WHERE user_id = '$this_id' AND friend_uid = '$nb_user[user_id]'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $friend_id = $row[friend_id];
    } 
    if ($friend_id) {
        return(true);
    } else {
        return(false);
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Transitional function to help pull mood_images while I figure out what it wrong	//
// with the function I *want* to use.												//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_image($mood_id)
{
    global $db, $prefix;
    $sql = "SELECT mood_image FROM " . $prefix . "_blog_moods WHERE mood_id = '" . $mood_id . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $mood_image = $row[mood_image];
    } 
    return($mood_image);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Another transitional function.													//
// ///////////////////////////////////////////////////////////////////////////////////
function mood_title($mood_id)
{
    global $db, $prefix;
    $sql = "SELECT mood_title FROM " . $prefix . "_blog_moods WHERE mood_id = '" . $mood_id . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $mood_title = stripslashes($row[mood_title]);
    } 
    return($mood_title);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function pulls individual blogs and displays them for the common visitor.	//
// ///////////////////////////////////////////////////////////////////////////////////
function fetch_blog($blog_id)
{
    global $db, $prefix, $nb_user, $self, $bgcolor3, $module_name, $user_prefix; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Query the database on the selected blog.											//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT user_id, blog_title, blog_body, blog_mood, blog_date, blog_status, blog_comments, blog_views FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "'";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Grab the data.																	//
    // ///////////////////////////////////////////////////////////////////////////////////
    while ($row = $db->sql_fetchrow($result)) {
        $auth_id = $row[user_id];
        $blog_title = stripslashes(ready($row[blog_title]));
        $blog_body = stripslashes(ready($row[blog_body]));
        $mood_image = mood_image($row[blog_mood]);
        $mood_title = mood_title($row[blog_mood]);
        $blog_date = date_convert($row[blog_date]);
        $blog_status = $row[blog_status];
        $blog_comments = $row[blog_comments];
        $blog_views = $row[blog_views];
        $sql2 = "SELECT username FROM " . $user_prefix . "_users WHERE user_id = '$auth_id'";
        $result2 = $db->sql_query($sql2);
        while ($row2 = $db->sql_fetchrow($result2)) {
            $username = $row2[username];
        } 
        center("<a href=\"" . $self . "&op=fetch_author&user_id=" . $auth_id . "\"><span class=\"title\">" . $username . "</span></a>");
        br(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If blog status is 0 for this blog, then it is private.							//
        // ///////////////////////////////////////////////////////////////////////////////////
        if (($blog_status == 0) AND ($auth_id != $nb_user[user_id])) {
            $deny = true;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If blog_status is 2, then it is reseved for friends. Test for friend status.		//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($blog_status == 2) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Allow users to view their own "friends only" blog.								//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($nb_user[user_id] == $auth_id) {
                $deny = false; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Test for friend status.															//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $sql = "SELECT friend_id FROM " . $prefix . "_blog_friends WHERE user_id = '" . $auth_id . "' AND friend_uid = '" . $nb_user[user_id] . "'";
                debug($sql);
                $result = $db->sql_query($sql);
                while ($row = $db->sql_fetchrow($result)) {
                    $friend_id = $row[friend_id];
                } 
                if (!$friend_id) {
                    $deny = true;
                } 
            } 
        } 
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If the blog is private, or the user is not a friend, then deny them access.		//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($deny) {
        opentable();
        center(_NO_ACCESS);
        closetable();
        include_once("footer.php");
        include_once("includes/counter.php");
        die(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Otherwise display the blog.														//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        opentable();
        echo("<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n");
        echo("<tr bgcolor=\"" . $bgcolor3 . "\">");
        echo("<td valign=\"top\">"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Display blog title.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<span class=\"title\">" . $blog_title . "</span>");
        br(); 
		
        // ///////////////////////////////////////////////////////////////////////////////////
        // Display blog data with the total number of reads.								//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<span class=\"content\">");
        echo(_BLOGGED_ON . " " . $blog_date . " " . _WITH . " " . $blog_views . " " . _BLOG_VIEWS);
        echo("</span>");
        echo("</td>"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If blog mood is not 0, then do a lookup on it.									//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($mood_title) {
            echo("<td valign=\"top\" width=\"100\"><img src=\"modules/" . $module_name . "/images/moods/" . $mood_image . "\" border=\"0\" alt=\"" . $mood_title . "\" /><br /><span class=\"boxtitle\">" . $mood_title . "</span></td>");
        } 
		echo("</tr>");
            echo("<tr bgcolor=\"" . $bgcolor3 . "\">");
            echo("<td align=\"right\">");
            echo"<a class=\"a2a_dd\" href=\"http://www.addtoany.com/share_save\"><img src=\"http://static.addtoany.com/buttons/share_save_171_16.png\" width=\"171\" height=\"16\" border=\"0\" alt=\"Share/Bookmark\"/></a><script type=\"text/javascript\">a2a_linkname=document.title;a2a_linkurl=location.href;</script><script type=\"text/javascript\" src=\"http://static.addtoany.com/menu/page.js\"></script>\n";
            echo("</td>\n");
            echo("</tr>\n");		
        echo("</table>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Display the blog body.															//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<span class=\"content\">" . $blog_body . "</span>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Test for blog comments.															//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($blog_comments == 1) {
            echo("<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n");
            echo("<tr bgcolor=\"" . $bgcolor3 . "\">");
            echo("<td align=\"center\">");
            echo("<a href=\"" . $self . "&op=comment_add&blog_id=" . $blog_id . "\"title=\"header=['Add your comments']body=['Click Here to Add your comments']\">" . _ADD_COMMENT . "</a>");
            echo("</td>\n");
            echo("</tr>\n");
            echo("</table>\n");
        } 
        closetable();
        br();
        $alert_string = "&gt;&gt;&gt; <a href=\"" . $self . "&op=admin_blog_alert&blog_id=" . $blog_id . "\">" . _BLOG_ALERT . "</a> &lt;&lt;&lt;";
        center($alert_string);
        br(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If comments are enabled, rip through the comment database.						//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($blog_comments == 1) {
            blog_comments($blog_id);
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Update the views record if viewer is not the author.								//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($nb_user[user_id] != $auth_id) {
            $where = "blog_id = '" . $blog_id . "'";
            $views[blog_views] = $blog_views + 1;
            sql_update("blog_blogs", $views, $where);
        } 
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// We need to have a way to notify admins of a blog that is in violation of the TOS.//
// This function presents the form nessecary to do so.								//
// ///////////////////////////////////////////////////////////////////////////////////
function admin_blog_alert($blog_id)
{
    global $self, $nb_user;
    $alert_rules = _ALERT_RULES;
    opentable();
    echo("<div align=\"center\">");
    echo("<span class=\"title\">" . _BLOG_ALERT . "</span>\n");
    echo("<form action=\"" . $self . "\" method=\"POST\">\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Include easy to identify variables.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<input type=\"hidden\" name=\"op\" value=\"blog_alert_save\" />\n");
    echo("<input type=\"hidden\" name=\"form[blog_id]\" value=\"" . $blog_id . "\" />\n");
    echo("<input type=\"hidden\" name=\"form[user_id]\" value=\"" . $nb_user[user_id] . "\" />\n");
    echo("<input type=\"hidden\" name=\"form[username]\" value=\"" . $nb_user[username] . "\" />\n");
    echo("<textarea cols=\"80\" rows=\"15\" name=\"form[alert_body]\" wrap=\"virtual\"></textarea><br /><br />\n");
    echo("<input type=\"submit\" name=\"submit\" value=\"" . _ALERT_ADMIN . "\" />\n");
    echo("</form>\n");
    echo($alert_rules);
    echo("</div>\n");
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Once a user submits an alert on a blog, this function will save that information	//
// and return the user to the referencing blog entry.								//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_alert_save($form)
{
    global $self;
    $form[alert_body] = cleanup($form[alert_body]);
    $form[alert_date] = date("Y-m-d");
    sql_insert("blog_alerts", $form);
    opentable();
    center(_ALERT_SENT);
    closetable();
    echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $form[blog_id] . "\">");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Comment pulling function.														//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_comments($blog_id)
{
    global $db, $prefix, $nb_user, $user_prefix, $self, $bgcolor1, $bgcolor2, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // We do not want to make the comment table if no comments exist.					//
    // ///////////////////////////////////////////////////////////////////////////////////
    $num_comms = num_comms($blog_id); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we do have comments...														//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($num_comms != 0) {
        echo("<a name=\"comments\"> </a>\n");
        echo("<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Construct comment query string.													//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT comm_id, user_id, comm_body, comm_date FROM " . $prefix . "_blog_comments WHERE blog_id = '" . $blog_id . "' ORDER BY comm_id DESC";
        debug($sql);
        $result = $db->sql_query($sql); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Walk through associated comments.												//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($row = $db->sql_fetchrow($result)) {
            if ($bg == $bgcolor2) {
                $bg = $bgcolor1;
            } else {
                $bg = $bgcolor2;
            } 
            $comm_author = lookup($row[user_id], true);
            $comm_body = stripslashes(ready($row[comm_body]));
            $comm_date = date_convert($row[comm_date]);
            echo("<tr bgcolor=\"" . $bg . "\">\n");
            echo("<td valign=\"top\" align=\"center\" width=\"150\">");
            center($comm_author . "<br />" . $comm_date);
            echo("</td>\n");
            echo("<td valign=\"top\">");
            echo($comm_body);
            echo("</td>\n");
            echo("</tr>\n");
        } 
        echo("</table>\n");
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Simple add comment function.														//
// ///////////////////////////////////////////////////////////////////////////////////
function comment_add($blog_id)
{
    global $self;
    opentable();
    echo("<div align=\"center\">");
    echo("<span class=\"title\">" . _ADD_COMMENT . "</span>\n");
    echo("<form action=\"" . $self . "\" method=\"POST\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"comment_save\" />\n");
    echo("<input type=\"hidden\" name=\"blog_id\" value=\"" . $blog_id . "\" />\n");
	wysiwyg_textarea('comm_body', '', 'Basic', '50', '12');
    //echo("<textarea cols=\"80\" rows=\"15\" name=\"comm_body\" wrap=\"virtual\"></textarea><br /><br />\n");
    echo("<input type=\"submit\" name=\"submit\" value=\"" . _ADD_COMMENT . "\" />\n");
    echo("</form>\n");
    echo("</div>\n");
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Simple save comment function.													//
// ///////////////////////////////////////////////////////////////////////////////////
function comment_save($blog_id, $comm_body)
{
    global $nb_user, $db, $prefix, $self, $user_prefix; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Condition the comment and blog data for database insertion.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    $data[blog_id] = $blog_id;
    $data[user_id] = $nb_user[user_id];
    $data[comm_body] = stripslashes($comm_body);
    $data[comm_date] = date("Y-m-d"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Insert dataset into the database.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    sql_insert("blog_comments", $data); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // NukeBlog takes advantage of PHPNuke's 7+'s points system. If you use an older	//
    // version of PHPNuke, set the points_comment value to 0. I also guard against 		//
    // users abusing the system by commenting on their own blogs. :)					//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT user_id FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $blog_author = $row[user_id];
    } 
    $points_comment = get_config("points_comment");
    if (($points_comment != 0) AND ($blog_author != $nb_user[user_id])) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Fetch the user's current points number.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT points FROM " . $user_prefix . "_users WHERE user_id = '" . $nb_user[user_id] . "'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $points = $row[points];
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Add the comment points value to original points.									//
        // ///////////////////////////////////////////////////////////////////////////////////
        $points = $points + $points_comment; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Update the database.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "UPDATE " . $user_prefix . "_users SET points = '" . $points . "'  WHERE user_id = '" . $nb_user[user_id] . "'";
        $db->sql_query($sql);
    } 
    opentable();
    center(_COMMENT_SAVED);
    closetable();
    echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "\">");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Default function is to walk through the blog authors, spinning out their a link	//
// to their most recent blog, showing the number of views, and the total number of	//
// blogs under them.																//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_list($offset = 0)
{
    global $nb_user, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $prefix, $db, $self, $module_name; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // How many records do we grab each time?											//
    // ///////////////////////////////////////////////////////////////////////////////////
    $blog_page = get_config("blog_page"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Create display table.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    $bg = $bgcolor2;
    opentable();
    echo("<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n");
    echo("<tr bgcolor=\"" . $bg . "\">\n");
    echo("<td width=\"100\">&nbsp;<strong>" . _BLOG_AUTH . "</strong></td>\n");
    echo("<td><strong>" . _LAST_BLOG . "</strong></td>\n");
    echo("<td align=\"center\" width=\"90\"><strong>" . _BLOG_DATE . "</strong></td>\n");
    echo("<td align=\"center\" width=\"40\"><strong>" . _BLOG_VIEWS . "</strong></td>\n");
    echo("<td align=\"center\" width=\"70\"><strong>" . _TOTAL_BLOGS . "</strong></td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Construct query statement to paginate through the blog user listings.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT user_id,username,user_blogs FROM " . $prefix . "_blog_users ORDER BY user_last DESC LIMIT " . $offset . " ," . $blog_page . "";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through the results.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    while ($row = $db->sql_fetchrow($result)) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // ALternate table row colors.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($bg == $bgcolor1) {
            $bg = $bgcolor2;
        } else {
            $bg = $bgcolor1;
        } 
        echo("<tr bgcolor=\"" . $bg . "\">\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Added extra space so that username is not slammed against the left.				//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<td>&nbsp;<a href=\"modules.php?name=" . $module_name . "&file=index&op=fetch_author&user_id=" . $row[user_id] . "\">" . $row[username] . "</a></td>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Check to see if current user is a friend. If they are, then allow for friend only//
        // blogs in most recent query.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        $is_friend = friend($row[user_id]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If the user is looking at his/her own system, grab the last one regardless.		//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($row[user_id] == $nb_user[user_id]) {
            $sql2 = "SELECT blog_id,blog_title,blog_date,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' ORDER BY blog_id DESC LIMIT 1";
            debug($sql2);
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $blog_title = stripslashes($row2[blog_title]);
                $blog_string = "<td><a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row2[blog_id] . "\">" . $blog_title . "</a> " . _YOURS . "</td>\n";
                $blog_date = date_convert($row2[blog_date]);
                $blog_views = $row2[blog_views];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the person is a friend, grab the most recent friend or open blog title.		//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else if (($is_friend) AND ($row[user_id] != $nb_user[user_id])) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Grab the most recent friend blog_id.												//
            // ///////////////////////////////////////////////////////////////////////////////////
            $sql2 = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' AND blog_status = '2' ORDER BY blog_id DESC LIMIT 1";
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $friend_blog_id = $row2[blog_id];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Grab the most recent open blog_id.												//
            // ///////////////////////////////////////////////////////////////////////////////////
            $sql2 = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' AND blog_status = '1' ORDER BY blog_id DESC LIMIT 1";
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $open_blog_id = $row2[blog_id];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the friend blog_id is greater than the open blog_id, fetch the friend blog_id.//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($friend_blog_id > $open_blog_id) {
                $sql2 = "SELECT blog_id,blog_title,blog_date,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' AND blog_status = '2' ORDER BY blog_id DESC LIMIT 1"; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Otherwise, fetch the most recent open blog_id.									//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $sql2 = "SELECT blog_id,blog_title,blog_date,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' AND blog_status = '1' ORDER BY blog_id DESC LIMIT 1";
            } 
            debug($sql2);
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $blog_title = stripslashes($row2[blog_title]);
                $blog_string = "<td><a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row2[blog_id] . "\">" . $blog_title . "</a> (" . _FRIEND . ")</td>\n";
                $blog_date = date_convert($row2[blog_date]);
                $blog_views = $row2[blog_views];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the current user is not a friend, grab the latest open blog title.			//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $sql2 = "SELECT blog_id,blog_title,blog_date,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "' AND blog_status = '1' ORDER BY blog_id DESC LIMIT 1";
            debug($sql2);
            $result2 = $db->sql_query($sql2);
            while ($row2 = $db->sql_fetchrow($result2)) {
                $blog_title = stripslashes($row2[blog_title]);
                $blog_string = "<td><a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row2[blog_id] . "\">" . $blog_title . "</a></td>\n";
                $blog_date = date_convert($row2[blog_date]);
                $blog_views = $row2[blog_views];
            } 
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Echo the blog_string (title hyper-link if we have it.							//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($blog_string) {
            echo($blog_string); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If we have no results, then the most recent entry is private. In order to keep	//
            // everything cool, let's place a private link and fetch the blog_date anyway.		//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $sql3 = "SELECT blog_date FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $row[user_id] . "'ORDER BY blog_id DESC LIMIT 1";
            debug($sql3);
            $result3 = $db->sql_query($sql3);
            while ($row3 = $db->sql_fetchrow($result3)) {
                $blog_date = date_convert($row3[blog_date]);
                $blog_views = _NA;
            } 
            echo("<td>" . _BLOG_PRIVATE . "</td>\n");
        } 
        echo("<td align=\"center\">" . $blog_date . "</td>\n");
        echo("<td align=\"center\">" . $blog_views . "</td>\n");
        echo("<td align=\"center\">" . $row[user_blogs] . "</td>\n");
        echo("</tr>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // In order to keep everything clean, we need to unset some variables.				//
        // ///////////////////////////////////////////////////////////////////////////////////
        unset($blog_date, $blog_string, $blog_views, $blog_title);
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Close the initial table.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("</table>\n");
    closetable(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // NOTE : Everything from here down is experimental as there is no way for me to 	//
    // test it without users. What it *SHOULD* do is drop in a table that lets the user	//
    // walk through the database backwards. Will have to find a well used site to test.	//
    // My limited testing showed it working 100%. :)									//
    // ///////////////////////////////////////////////////////////////////////////////////
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Test to see how many blogs we have.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT user_id FROM " . $prefix . "_blog_users";
    debug($sql);
    $result = $db->sql_query($sql);
    $num_blogs = $db->sql_numrows($result); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If the number of total blogs is greater than the number alloted to each page,	//
    // open up the pagination table and proceed to offer archival links.				//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($num_blogs >= $blog_page) {
        opentable(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Set initial counting values.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        $page_num = 1;
        $count = 0;
        $in_row = 1; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // How many page links per line?													//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_wrap = get_config("blog_wrap"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Begin the pagination table.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">");
        echo("<tr>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Walk through the database until we have reached the desired number of page links.//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($count < $num_blogs) {
            echo("<td align=\"center\"><a href=\"" . $self . "&op=blog_list&offset=" . $count . "\">" . _PAGE . " " . $page_num . "</a></td>\n");
            if ($in_row == $blog_wrap) {
                echo("</tr>\n");
                echo("<tr>\n");
                $in_row = 0;
            } else {
                $in_row++;
            } 
            $page_num++;
            $count = $count + $blog_page; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Complete the table for old browser compatability.								//
            // ///////////////////////////////////////////////////////////////////////////////////
        } while (($in_row < $blog_wrap) AND ($num_blogs <= $count)) {
            echo("<td><!-- Trevor.Net Was Here --></td>\n");
            $in_row++;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Finish and close the table.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("</tr>\n");
        echo("</table>");
        closetable();
    } 
} 

?>