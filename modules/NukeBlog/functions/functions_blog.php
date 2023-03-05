<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// This function delivers a host of information and control over a user's friends.	//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_friends()
{
    global $self, $prefix, $user_prefix, $form_data, $nb_user, $db, $bgcolor3, $bgcolor2;
    opentable();
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // This first form allows a blog owner the option of adding a single blog friend by	//
    // way of a user_id or username.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<form action=\"" . $self . "\" method=\"post\" name=\"blog_friends\" id=\"blog_friends\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"add_single\" />\n");
    echo("<div align=\"center\">");
    echo(_ADD_BY_NAME_ID . " : <input type=\"text\" name=\"form_data\" size=\"24\" maxlength=\"24\" value=\"" . $form_data . "\" /> <input type=\"submit\" name=\"submit\" value=\"" . _ADD_FRIEND . "\" />");
    echo("</div>\n");
    echo("</form>");
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // The next area presents large lists of site members in multi-select boxes. This	//
    // will allow a blog owner the option of bulk adding and removing friends in one	//
    // easy step.																		//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<table width=\"100%\" cellpadding=\"5\" cellspacing=\"5\" border=\"0\">\n");
    echo("<tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Site members not already listed in the friends list... addition form.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\" align=\"center\" width=\"50%\">");
    center("<span class=\"title\">" . _ADD_FRIENDS . "</span>"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Start form.																		//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<form action=\"" . $self . "\" method=\"post\" name=\"blog_friends\" id=\"blog_friends\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"add_bulk\" />\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Start select form field.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<SELECT NAME=\"add_uid[]\" size=\"15\" multiple>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we can not have at least $one option in the list, then this will trigger a 	//
    // message in the select box.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    $one = false; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through the user database, by username.										//
    // ///////////////////////////////////////////////////////////////////////////////////
    $result = $db->sql_query("select user_id, username from " . $user_prefix . "_users order by username");
    while (list($this_id, $this_user) = $db->sql_fetchrow($result)) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Test to see if the person is already listed as a friend.							//
        // ///////////////////////////////////////////////////////////////////////////////////
        $ingroup = $db->sql_numrows($db->sql_query("SELECT friend_id FROM " . $prefix . "_blog_friends WHERE friend_uid='$this_id'")); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If the person is not a friend, and is not the current user, or anon, add to list.//
        // ///////////////////////////////////////////////////////////////////////////////////
        if (($ingroup < 1) AND ($this_id != $nb_user[user_id]) AND ($this_id != 1)) {
            echo ("<option value=\"$this_id\">$this_user</option>\n"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // We have one option!																//
            // ///////////////////////////////////////////////////////////////////////////////////
            $one = true;
        } 
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we did not have any options, print a no options message so the user does not	//
    // think that NukeBlog is broken. Plus it looks better than an empty box.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($one == false) {
        echo ("<option value=\"\">" . _NO_OPTIONS . "</option>\n");
    } 
    echo("</SELECT>\n");
    debug($sql);
    br(2);
    echo("<input type=\"submit\" name=\"submit\" value=\"" . _ADD_FRIENDS . "\" />");
    br(2);
    echo(_SELECT_HINT);
    echo("</form>");
    echo("</td>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Begin bulk removal form.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<td bgcolor=\"" . $bgcolor3 . "\" valign=\"top\" align=\"center\" width=\"50%\">");
    center("<span class=\"title\">" . _REMOVE_FRIENDS . "</span>"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Start form.																		//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<form action=\"" . $self . "\" method=\"post\" name=\"blog_friends\" id=\"blog_friends\">\n");
    echo("<input type=\"hidden\" name=\"op\" value=\"remove_bulk\" />\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Create multi-select form field.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("<SELECT NAME=\"rem_uid[]\" size=\"15\" multiple>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Create query string that will walk through the blog owner's friends list.		//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "select friend_id, friend_username from " . $prefix . "_blog_friends WHERE user_id = '" . $nb_user[user_id] . "' order by friend_username"; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Again, set $one to false for the same reason as above.							//
    // ///////////////////////////////////////////////////////////////////////////////////
    $one = false;
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Stroll through the friends list, adding each one as a removal option.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    while (list($friend_id, $friend_username) = $db->sql_fetchrow($result)) {
        echo ("<option value=\"" . $friend_id . "\">" . $friend_username . "</option>\n");
        $one = true;
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Another no-options value.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($one == false) {
        echo ("<option value=\"\">" . _NO_OPTIONS . "</option>\n");
    } 
    echo("</SELECT>\n");
    debug($sql);
    br(2);
    echo("<input type=\"submit\" name=\"submit\" value=\"" . _REMOVE_FRIENDS . "\" />");
    br(2);
    echo(_SELECT_HINT);
    echo("</form>");
    echo("</td>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Complete the list.																//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("</tr>\n");
    echo("</table>\n");
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function takes the values from the bulk-add form and adds each user to the	//
// current person's list of friends.												//
// ///////////////////////////////////////////////////////////////////////////////////
function add_bulk($add_uid)
{
    global $db, $nb_user, $prefix, $user_prefix; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Gather common data.																//
    // ///////////////////////////////////////////////////////////////////////////////////
    $data[user_id] = $nb_user[user_id];
    $data[friend_added] = date("Y-m-d");
    $data[friend_visit] = date("Y-m-d"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // How many friends are we adding? Count them.										//
    // ///////////////////////////////////////////////////////////////////////////////////
    $j = count($add_uid); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // For each new friend_id preform an insert statement with the common data above.	//
    // ///////////////////////////////////////////////////////////////////////////////////
    for ($i = 0; $i < $j; $i++) {
        $data[friend_uid] = $add_uid[$i];
        $data[friend_username] = lookup($add_uid[$i]);
        sql_insert("blog_friends", $data);
        $count = $count + 1;
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If $count is equal to 1, then we only added one person.							//
    // ///////////////////////////////////////////////////////////////////////////////////
    opentable();
    if ($count == 1) {
        center(_SINGLE_ADDED); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If count is equal to two or more, then we added multiple persons.				//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        center(_MULTI_ADDED);
    } 
    closetable();
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Send the user back to his/her friends list.										//
    // ///////////////////////////////////////////////////////////////////////////////////
    friends_list();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Similar in purpose to add_bulk, this functio bulk removes friends.				//
// ///////////////////////////////////////////////////////////////////////////////////
function remove_bulk($rem_uid)
{
    global $db, $nb_user, $prefix;
    $j = count($rem_uid);
    for ($i = 0; $i < $j; $i++) {
        $sql = "DELETE FROM " . $prefix . "_blog_friends WHERE friend_id = '" . $rem_uid[$i] . "' AND user_id = '" . $nb_user[user_id] . "'";
        $db->sql_query($sql);
        $count = $count + 1;
    } 
    opentable();
    if ($count == 1) {
        center(_SINGLE_REMOVED);
    } else {
        center(_MULTI_REMOVED);
    } 
    closetable();
    br();
    friends_list();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Adding a single user through the add one form is a bit tricky. Keep going. :)	//
// ///////////////////////////////////////////////////////////////////////////////////
function add_single($form_data)
{
    global $user_prefix, $prefix, $nb_user, $db; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Clean up the submitted data.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    $form_data = strip_tags(trim($form_data)); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // I don't know why, but I decided to prevent a user from adding him or herself as	//
    // a friend to their own list. :) Perhaps I am just being cranky.					//
    // ///////////////////////////////////////////////////////////////////////////////////
    if (($form_data == $nb_user[user_id]) OR ($form_data == $nb_user[username])) {
        opentable();
        center(_NO_SELF_ADD);
        closetable();
        br();
        blog_friends(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // No Anonymous friends! That just doesn't work here.								//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else if (($form_data == "Anonymous") OR ($form_data == "1")) {
        opentable();
        center(_NO_ANON);
        closetable();
        br();
        blog_friends(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Associate user_id and username with the provided information.					//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        // ///////////////////////////////////////////////////////////////////////////////////
        // First, look for a username. This assumes that the data was a user_id.			//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT username FROM " . $user_prefix . "_users WHERE user_id = '" . $form_data . "'";
        debug($sql);
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $data[friend_uid] = $form_data;
            $data[friend_username] = $row[username];
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If we didn't find a username, then look for a user_id if the information given	//
        // was a username.																	//
        // ///////////////////////////////////////////////////////////////////////////////////
        if (!$data[friend_username]) {
            $sql = "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '" . $form_data . "'";
            debug($sql);
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
                $data[friend_uid] = $row[user_id];
                $data[friend_username] = $form_data;
            } 
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // NOTE : This could easily be expnaded to user e-mail addys as well, but because 	//
        // the PHPNuke system allows a user to hide/change his/her e-mail address the use	//
        // of an e-mail address is sketchy at best. So I left that out.						//
        // ///////////////////////////////////////////////////////////////////////////////////
        // ///////////////////////////////////////////////////////////////////////////////////
        // If we did not find a user_id or username, then report failure.					//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ((!$data[friend_uid]) OR (!$data[friend_username])) {
            opentable();
            center(_NO_FIND);
            closetable();
            br();
            blog_friends(); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // We found a friend! But first, we need to make sure they are not already listed 	//
            // as a friend of the current user.													//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $sql = "SELECT friend_id FROM " . $prefix . "_blog_friends WHERE friend_uid = '" . $data[friend_uid] . "'";
            debug($sql);
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
                $friend_id = $row[friend_id];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the friend is already a friend, report as such.								//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($friend_id) {
                opentable();
                $exists_string = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $data[friend_uid] . "\">" . $data[friend_username] . "</a> " . _FRIEND_EXISTS;
                center($exists_string);
                closetable();
                br();
                blog_friends(); 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Otherwise, go ahead and add the new friend record.								//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $data[friend_added] = date("Y-m-d");
                $data[friend_visit] = date("Y-m-d");
                $data[user_id] = $nb_user[user_id];
                sql_insert("blog_friends", $data);
                opentable();
                $added_string = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $data[friend_uid] . "\">" . $data[friend_username] . "</a> " . _HAS_BEEN_ADDED;
                center($added_string);
                closetable();
                br();
                friends_list();
            } 
        } 
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function allows a blog owner the option of removing a single friend one at 	//
// a time from their list.															//
// ///////////////////////////////////////////////////////////////////////////////////
function remove_single($friend_uid)
{
    global $db, $prefix, $nb_user; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Because we are using the primary id field, we need to make sure that the request	//
    // is valid by checking for a user_id and username.									//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT friend_id,friend_username FROM " . $prefix . "_blog_friends WHERE friend_uid = '" . $friend_uid . "' AND user_id = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $this_id = $row[friend_id];
        $friend_username = $row[friend_username];
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we found $this_id, then this is a legit request. Go ahead and remove the user	//
    // from the friends list.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($this_id) {
        $sql = "DELETE FROM " . $prefix . "_blog_friends WHERE friend_id = '" . $this_id . "'";
        $db->sql_query($sql);
        debug($sql);
        opentable();
        $removed_string = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $friend_uid . "\">" . $friend_username . "</a> " . _HAS_BEEN_REMOVED;
        center($removed_string);
        closetable();
        br();
        friends_list(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // This may have been a hack attempt if no $this_id was found. Report failure.		//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        opentable();
        center(_REMOVE_ERROR);
        closetable();
        br();
        friends_list();
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Common friends menu.																//
// ///////////////////////////////////////////////////////////////////////////////////
function friend_menu()
{
    global $self;
    $friends_list_links = "<a href=\"" . $self . "&op=friends_list\">" . _LIST_FRIENDS . "</a>";
    $friends_list_links .= " | ";
    $friends_list_links .= "<a href=\"" . $self . "&op=blog_friends\">" . _ADD_REM_FRIENDS . "</a>";
    opentable();
    center(_BLOG_FRIEND_INTRO);
    center($friends_list_links);
    closetable();
    br();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// When a user first lands on the friend's page, this function will show them a 	//
// list of their current friends.													//
// ///////////////////////////////////////////////////////////////////////////////////
function friends_list()
{
    global $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $nb_user, $db, $prefix, $self, $user_prefix, $module_name;
    opentable();
    center(_YOUR_FRIENDS);
    echo("<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
    echo("<tr bgcolor=\"$bgcolor3\">\n");
    echo("<td width=\"130\"><strong>" . _BLOG_FRIEND . "</strong></td>\n");
    echo("<td width=\"100\" align=\"center\"><strong>" . _BLOG_PROFILE . "</strong></td>\n");
    echo("<td width=\"100\" align=\"center\"><strong>" . _BLOG_FRIEND_ADD . "</strong></td>\n");
    echo("<td width=\"100\" align=\"center\"><strong>" . _BLOG_FRIEND_VISIT . "</strong></td>\n");
    echo("<td width=\"100\" align=\"center\"><strong>" . _BLOG_FRIEND_REMOVE . "</strong></td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Format query string.																//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT friend_id, friend_uid, friend_username, friend_added, friend_visit FROM " . $prefix . "_blog_friends WHERE user_id = '" . $nb_user[user_id] . "' ORDER BY friend_username";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Alternate table row colors.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($bg == $bgcolor1) {
            $bg = $bgcolor2;
        } else {
            $bg = $bgcolor1;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Convert the dates.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        $friend_added = date_convert($row[friend_added]);
        $friend_visit = date_convert($row[friend_visit]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Display each friend with option links.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<tr bgcolor=\"" . $bg . "\">\n");
        echo("<td><a href=\"modules.php?name=" . $module_name . "&file=index&op=fetch_author&user_id=" . $row[friend_uid] . "\">" . $row[friend_username] . "</a></td>\n");
        echo("<td align=\"center\"><a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $row[friend_uid] . "\">" . _BLOG_PROFILE . "</a></td>\n");
        echo("<td align=\"center\">" . $friend_added . "</td>\n");
        echo("<td align=\"center\">" . $friend_visit . "</td>\n");
        echo("<td align=\"center\"><a href=\"" . $self . "&op=remove_single&friend_uid=" . $row[friend_uid] . "\">" . _BLOG_FRIEND_REMOVE . "</a></td>\n");
        echo("</tr>\n");
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If $friend_added did not recieve a value, then this user has no friends. :(		//
    // ///////////////////////////////////////////////////////////////////////////////////
    if (!$friend_added) {
        echo("<tr bgcolor=\"" . $bgcolor2 . "\">\n");
        echo("<td colspan=\"5\" align=\"center\">" . _NO_BLOG_FRIEND . "</td>\n");
        echo("</tr>\n");
    } 
    echo("</table>\n");
    closetable();
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // In addition to the above links, it makes sense to show the user who's list they 	//
    // are in.																			//
    // ///////////////////////////////////////////////////////////////////////////////////
    opentable();
    echo(_FRIENDS_OF . " : ");
    $friends = ""; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through the database, grabbing each friends name.							//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT user_id FROM " . $prefix . "_blog_friends WHERE friend_uid = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through friend list and add *username* to the array.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    while ($row = $db->sql_fetchrow($result)) {
        $sql2 = "SELECT username FROM " . $user_prefix . "_users WHERE user_id = '$row[user_id]'";
        $result2 = $db->sql_query($sql2);
        while ($row2 = $db->sql_fetchrow($result2)) {
            $friend_list[] = $row2[username];
        } 
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Sort the array alphabetically. Please note case-sensitive "bug".					//
    // ///////////////////////////////////////////////////////////////////////////////////
    //sort($friend_list); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Reset the friend_list array.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    //reset($friend_list); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Pass through friend_list array as $friend, look up the user_id and add friend to	//
    // friend string. Please note : Until I find a slick way to pull both the friend	//
    // user_id and friend username from the blog_friends table, which does contain both,//
    // we'll have to preform a resource waisting double look-up. The end result needs	//
    // to be an alphabetized list of friend names. If anybody can figure this out, I'd	//
    // appreciate it! :)																//
    // ///////////////////////////////////////////////////////////////////////////////////
	// NOTE THE SORT AND RESET COMANDS ALONG WITH THE FOLLOWING CODE HAS BEEN COMMENTED OUT BECAUSE SOMETHING IS NOT WORKING.
	// THIS CODE IS SUPPOSE TO SORT THE FRIENDS LIST. FOR NOW, THE REPLACEMENT CODE WILL HELP FOR A TIME... :(
	/*
    foreach ($friend_list as $friend) {
        $sql = "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '$friend'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $user_id = $row[user_id];
        } 
        $friends .= "<a href=\"modules.php?name=" . $module_name . "&file=index&op=fetch_author&user_id=$user_id\">" . $friend . "</a>,";
    } 
	*/
// REPLACEMENT CODE BEGIN
$num = count($friend_list); 
$i = 0; 
while($i <= $num) { 
	$sql = "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '$friend_list[$i]'"; 
	$result = $db->sql_query($sql); 
	while ($row = $db->sql_fetchrow($result)) { 
		$user_id = $row[user_id]; 
	} 
	$friends .= "<a href=\"modules.php?name=" . $module_name . "&file=index&op=fetch_author&user_id=$user_id\">" . $friend_list[$i] . "</a> "; 
	$i++; 
} 
// REPLACEMENT CODE END
    // ///////////////////////////////////////////////////////////////////////////////////
    // Remove the last , (comma) from the string.										//
    // ///////////////////////////////////////////////////////////////////////////////////
    $friends = preg_replace("#,$#", "", $friends); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If friends still equals "", then this person is not listed on anybody's list.	//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($friends == "") {
        $friends = _NOT_FRIENDS;
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Echo the friends list.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo($friends);
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function simply removes a message, set by an admin, from the user's blog	//
// message center.																	//
// ///////////////////////////////////////////////////////////////////////////////////
function message_remove($mess_id)
{
    global $db, $prefix, $nb_user, $offset;
    $sql = "DELETE FROM " . $prefix . "_blog_messages WHERE mess_id = '" . $mess_id . "' AND user_id = '" . $nb_user[user_id] . "'";
    $db->sql_query($sql);
    blog_list($offset);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function presents the user a list of his/her blog enteries.					//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_list($offset = 0)
{
    global $nb_user, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $prefix, $db, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // How many blogs per page do we intend on showing?									//
    // ///////////////////////////////////////////////////////////////////////////////////
    $blog_page = get_config("blog_page"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Language format key words.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    $status[0] = _STATUS_CLOSED;
    $status[1] = _STATUS_OPEN;
    $status[2] = _STATUS_FRIENDS;
    $comments[0] = _BLOG_OFF;
    $comments[1] = _BLOG_ON; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Admins may leave blog owners messages. This is also how we tell a blog owner that//
    // one of their blogs was removed.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT mess_id FROM " . $prefix . "_blog_messages WHERE user_id = '" . $nb_user[user_id] . "' AND mess_active = '1' LIMIT 1";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $mess_id = $row[mess_id];
    } 
    // /////////////////////////////////////////////////////////////////////////////////////
    // If we have at least one message, open up a display table and echo out the messages.//
    // /////////////////////////////////////////////////////////////////////////////////////
    if ($mess_id) {
        opentable();
        center(_MESSAGE_CENTER);
        echo("<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">\n");
        echo("<tr bgcolor=\"$bgcolor1\">\n");
        echo("<td align=\"center\"><strong>" . _BLOG_TITLE . "</strong></td>\n");
        echo("<td align=\"center\"><strong>" . _BLOG_DATE . "</strong></td>\n");
        echo("<td align=\"center\"><strong>" . _B_REMOVED . "</strong></td>\n");
        echo("<td align=\"center\"><strong>" . _B_ADMIN . "</strong></td>\n");
        echo("<td align=\"center\"><strong>" . _B_REMOVE . "</strong></td>\n");
        echo("</tr>\n");
        $sql = "SELECT mess_id,blog_title,blog_date,aid,mess_date,mess_body FROM " . $prefix . "_blog_messages WHERE user_id = '" . $nb_user[user_id] . "' AND mess_active = '1' ORDER BY mess_id DESC";
        debug($sql);
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $mess_id = $row[mess_id];
            $blog_title = stripslashes($row[blog_title]);
            $blog_date = date_convert($row[blog_date]);
            $aid = $row[aid];
            $mess_date = date_convert($row[mess_date]);
            $mess_body = stripslashes($row[mess_body]);
            if ($bg == $bgcolor2) {
                $bg = $bgcolor3;
            } else {
                $bg = $bgcolor2;
            } 
            echo("<tr bgcolor=\"" . $bg . "\">\n");
            echo("<td valign=\"top\">" . $blog_title . "</td>");
            echo("<td valign=\"top\" align=\"center\">" . $blog_date . "</td>");
            echo("<td valign=\"top\" align=\"center\">" . $mess_date . "</td>");
            echo("<td valign=\"top\" align=\"center\">" . $aid . "</td>"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // This next link allows a blog owner to remove/acknowledge the message.			//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<td valign=\"top\" align=\"center\"><a href=\"" . $self . "&op=message_remove&mess_id=" . $mess_id . "\">" . _B_REMOVE . "</a></td>");
            echo("</tr>\n");
            echo("<tr bgcolor=\"" . $bg . "\">\n");
            echo("<td colspan=\"5\">" . $mess_body . "</td>");
            echo("</tr>\n");
        } 
        echo("</table>\n");
        closetable();
        br();
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Here is where we actually being to list out the blog titles.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    opentable();
    echo("<table cellpadding=\"1\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n");
    echo("<tr bgcolor=\"" . $bgcolor3 . "\">\n");
    echo("<td align=\"center\"><strong>" . _BLOG_TITLE . "</strong></td>\n");
    echo("<td align=\"center\" width=\"70\"><strong>" . _BLOG_DATE . "</strong></td>\n");
    echo("<td align=\"center\" width=\"60\"><strong>" . _BLOG_STATUS . "</strong></td>\n");
    echo("<td align=\"center\" width=\"60\"><strong>" . _BLOG_COMMENTS . "</strong></td>\n");
    echo("<td align=\"center\" width=\"50\"><strong>" . _BLOG_VIEWS . "</strong></td>\n");
    echo("<td align=\"center\" width=\"50\"><strong>" . _BLOG_ALTER . "</strong></td>\n");
    echo("</tr>\n"); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Construct blog-walk query string.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_id,blog_title,blog_date,blog_status,blog_comments,blog_views FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $nb_user[user_id] . "' ORDER BY blog_id DESC LIMIT " . $offset . " ," . $blog_page . "";
    debug($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through the current page.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Alternate table row colors for ease of viewing.									//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($bg == $bgcolor1) {
            $bg = $bgcolor2;
        } else {
            $bg = $bgcolor1;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Clean up the title, convert the date, and check for comments.					//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_title = ready($row[blog_title]);
        $blog_date = date_convert($row[blog_date], "dashed");
        $num_comms = num_comms($row[blog_id]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Show the current row's worth of data.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<tr bgcolor=\"" . $bg . "\">\n");
        echo("<td><a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row[blog_id] . "\">" . $blog_title . "</a></td>\n");
        echo("<td align=\"center\">" . $blog_date . "</td>\n");
        echo("<td align=\"center\">" . $status[$row[blog_status]] . "</td>\n");
        echo("<td align=\"center\">" . $comments[$row[blog_comments]] . ""); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If the current row has posted comments, provide an indicator.					//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($num_comms != 0) {
            echo(" (<a href=\"" . $self . "&op=fetch_blog&blog_id=" . $row[blog_id] . "#comments\">" . $num_comms . "</a>)");
        } 
        echo("</td>\n");
        echo("<td align=\"center\">" . $row[blog_views] . "</td>\n");
        echo("<td align=\"center\"><a href=\"" . $self . "&op=blog_alter&blog_id=" . $row[blog_id] . "\">" . _BLOG_ALTER . "</a></td>\n");
        echo("</tr>\n");
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Complete table display.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    echo("</table>\n");
    closetable(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Cosmetic break.																	//
    // ///////////////////////////////////////////////////////////////////////////////////
    br(); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // The next step involves displaying links to archived blogs.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_id FROM " . $prefix . "_blog_blogs WHERE user_id = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // How many blogs?																	//
    // ///////////////////////////////////////////////////////////////////////////////////
    $num_blogs = $db->sql_numrows($result); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If the number of blogs per page is larger than the number we wish to show, start	//
    // showing archive links.															//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($num_blogs >= $blog_page) {
        opentable(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Page number-ation.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        $page_num = 1; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Initialize the offset $count.													//
        // ///////////////////////////////////////////////////////////////////////////////////
        $count = 0; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // To count the number of page links per row.										//
        // ///////////////////////////////////////////////////////////////////////////////////
        $in_row = 1; 
        // ///////////////////////////////////////////////////////////////////////////////////
        // We will create a new table row when the current count reaches... see admin CP.	//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_wrap = get_config("blog_wrap"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Start link table.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table width=\"100%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">");
        echo("<tr>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // While count is less than the number of total blogs, create page links.			//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($count < $num_blogs) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Present link.																	//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<td align=\"center\"><a href=\"" . $self . "&op=blog_list&offset=" . $count . "\">" . _PAGE . " " . $page_num . "</a></td>\n"); 
            // //////////////////////////////////////////////////////////////////////////////////////
            // If $in_row is equal to the numbe of page links, wrap the next links onto a new line.//
            // //////////////////////////////////////////////////////////////////////////////////////
            if ($in_row == $blog_wrap) {
                echo("</tr>\n");
                echo("<tr>\n");
                $in_row = 1; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Otherwise advance $in_row by 1.													//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $in_row = $in_row + 1;
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Advance the page_num(ber) by one and add the number of blog(s)_(per)page.		//
            // ///////////////////////////////////////////////////////////////////////////////////
            $page_num = $page_num + 1;
            $count = $count + $blog_page;
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Complete the table will filler cells.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($in_row <= $blog_wrap) {
            $count = $count + $blog_page;
            $in_row = $in_row + 1; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Please leave this as is. :) Much appreciated!!!									//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<td><!-- http://www.trevor.net --></td>\n");
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Finish out the display.															//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("</tr>\n");
        echo("</table>");
        closetable();
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Dual purpose form function that allows an member to add or edit blogs.			//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_form($blog_id = false)
{
    global $nb_user, $prefix, $db, $self, $form, $module_name; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we have a blog_id, then this is an edit call upon an existing blog.			//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($blog_id) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Grab blog data.																	//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT user_id,blog_title,blog_body,blog_mood,blog_status,blog_comments FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "' AND user_id = '" . $nb_user[user_id] . "'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the recorded user_id does not match the current user, call the bluff.			//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($row[user_id] != $nb_user[user_id]) {
                opentable();
                center(_NOTYOURS);
                closetable();
                include_once("footer.php");
                include_once("includes/counter.php");
                die(); 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Otherwise, keep grabbing the data.												//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $form[blog_title] = ready($row[blog_title]);
                $form[blog_body] = $row[blog_body];
                $form[blog_mood] = $row[blog_mood];
                $form[blog_status] = $row[blog_status];
                $form[blog_comments] = $row[blog_comments]; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Set the button label to an update reference.										//
                // ///////////////////////////////////////////////////////////////////////////////////
                $button = _BLOG_UPDATE; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // This is where the user may choose to remove this blog.							//
                // ///////////////////////////////////////////////////////////////////////////////////
                $remove_string = "<a href=\"" . $self . "&op=blog_remove&blog_id=" . $blog_id . "&step=1\"><strong>" . _REMOVEBLOG . "</strong></a>";
                opentable();
                center($remove_string);
                closetable();
                br();
            } 
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // This is a new blog. Set default values and labels.								//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        $form[blog_status] = 1;
        $form[blog_comments] = 1;
        $button = _BLOG_SAVE;
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Place form in a display table.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    opentable();
    include_once("modules/" . $module_name . "/includes/blog_form.php");
    closetable();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Dual purpose function saves and updates user blogs.								//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_action($form, $blog_id = false)
{
    global $nb_user, $prefix, $db, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Regardless of what we are doing, we *have* to have a blog title.					//
    // ///////////////////////////////////////////////////////////////////////////////////
    if (!$form[blog_title]) {
        opentable();
        center(_BLOG_TITLE_REQ);
        closetable();
        br();
        blog_form($blog_id); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // We have a title, march on...														//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Gather standard data for both save-new and update-old opperations.				//
        // ///////////////////////////////////////////////////////////////////////////////////
        $form[blog_update] = date("Y-m-d");
        $form[blog_title] = sterilize($form[blog_title]);
        $form[blog_body] = stripslashes($form[blog_body]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If we do not have a blog_id then this is an save-new opperation.					//
        // ///////////////////////////////////////////////////////////////////////////////////
        if (!$blog_id) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Associate user_id with *this* user.												//
            // ///////////////////////////////////////////////////////////////////////////////////
            $form[user_id] = $nb_user[user_id]; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Creation date.																	//
            // ///////////////////////////////////////////////////////////////////////////////////
            $form[blog_date] = date("Y-m-d"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Insert blog data.																//
            // ///////////////////////////////////////////////////////////////////////////////////
            sql_insert("blog_blogs", $form); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Let's see if this user has an existing blog record. This will help in lists.		//
            // ///////////////////////////////////////////////////////////////////////////////////
            $sql = "SELECT user_id, user_blogs FROM " . $prefix . "_blog_users WHERE user_id = '" . $nb_user[user_id] . "'";
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
                $data[user_id] = $row[user_id];
                $data[user_blogs] = $row[user_blogs];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Check for points system compliance.												//
            // ///////////////////////////////////////////////////////////////////////////////////
            $points_blog = get_config("points_blog"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If blog_points is not set to zero, then let's add a plus+blog to user points.	//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($points_blog != 0) {
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
                $points = $points + $points_blog; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Update the database.																//
                // ///////////////////////////////////////////////////////////////////////////////////
                $sql = "UPDATE " . $user_prefix . "_users SET points = '" . $points . "'  WHERE user_id = '" . $nb_user[user_id] . "'";
                $db->sql_query($sql);
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If we could not find a user_id in the blog_users table, then this is blog #1.	//
            // ///////////////////////////////////////////////////////////////////////////////////
            if (!$data[user_id]) {
                // ///////////////////////////////////////////////////////////////////////////////////
                // Create new record.																//
                // ///////////////////////////////////////////////////////////////////////////////////
                $data[user_id] = $nb_user[user_id];
                $data[username] = $nb_user[username];
                $data[user_last] = date("Y-m-d");
                $data[user_blogs] = 1;
                sql_insert("blog_users", $data); 
                // ///////////////////////////////////////////////////////////////////////////////////
                // This user has blogged before. Let's update!										//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $data[user_last] = date("Y-m-d");
                $data[user_blogs] = $data[user_blogs] + 1;
                $where = "user_id = '$nb_user[user_id]'";
                sql_update("blog_users", $data, $where);
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Report back to the user that a new blog was added to his/her record.				//
            // ///////////////////////////////////////////////////////////////////////////////////
            opentable();
            center(_BLOG_SAVED);
            closetable(); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Refresh back to the user's interface.											//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "\">"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // This is an update. Very simple! Just add the where clause and update the db.		//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $where = "blog_id = '" . $blog_id . "' AND user_id = '" . $nb_user[user_id] . "'";
            sql_update("blog_blogs", $form, $where);
            opentable();
            center(_BLOG_UPDATED);
            closetable(); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Refresh back to the edited blog's page for user review.							//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "\">");
        } 
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This two step process allows a user the ability to remove a blog from the db.	//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_remove($blog_id, $step)
{
    global $db, $prefix, $nb_user, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Regardless of what is going to happen, we should get a blog title and date. This //
    // also helps guard against the wrong user removing someone else's blog because no	//
    // title will be returned if it is *not* their blog.								//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_title,blog_date FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "' and user_id = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $blog_title = ready($row[blog_title]);
        $blog_date = date_convert($row[blog_date], "long");
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // No blog title found? Then it's not their blog!									//
    // ///////////////////////////////////////////////////////////////////////////////////
    if (!$blog_title) {
        opentable();
        center(_NOTYOURS);
        closetable();
        include_once("footer.php");
        include_once("includes/counter.php");
        die();
    } else {
        // ///////////////////////////////////////////////////////////////////////////////////
        // If step == 2, then the user has jumped through all the loops. Let's remove their	//
        // blog along with all the user comments.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($step == 2) {
            $mass_remove = get_config("mass_remove");
            $points_blog = get_config("points_blog");
            $points_comment = get_config("points_comment"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If blog_points is not set to zero, then let's remove the blog credit points.		//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($points_blog != 0) {
                // ///////////////////////////////////////////////////////////////////////////////////
                // Fetch the user's current points number.											//
                // ///////////////////////////////////////////////////////////////////////////////////
                $sql = "SELECT points FROM " . $user_prefix . "_users WHERE user_id = '" . $nb_user[user_id] . "'";
                $result = $db->sql_query($sql);
                while ($row = $db->sql_fetchrow($result)) {
                    $points = $row[points];
                } 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Remove the comment points from the user's score.									//
                // ///////////////////////////////////////////////////////////////////////////////////
                $points = $points - $points_blog; 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Update the database.																//
                // ///////////////////////////////////////////////////////////////////////////////////
                $sql = "UPDATE " . $user_prefix . "_users SET points = '" . $points . "'  WHERE user_id = '" . $nb_user[user_id] . "'";
                $db->sql_query($sql);
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Remove the actual blog from the database.										//
            // ///////////////////////////////////////////////////////////////////////////////////
            $sql = "DELETE FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "' and user_id = '" . $nb_user[user_id] . "'";
            $db->sql_query($sql); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If the admin has mass_remove set to 1 and the user was awarded points on comment,//
            // then remove the points from the comment author upon comment removal. This is an	//
            // optional step set through the admin control panel!								//
            // ///////////////////////////////////////////////////////////////////////////////////
            if (($mass_remove) AND ($points_comment != 0)) {
                // ///////////////////////////////////////////////////////////////////////////////////
                // Initialize the comment walk query.												//
                // ///////////////////////////////////////////////////////////////////////////////////
                $sql = "SELECT comm_id,user_id FROM " . $prefix . "_blog_comms WHERE blog_id = '" . $blog_id . "'";
                $result = $db->sql_query($sql); 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Do the walk...																	//
                // ///////////////////////////////////////////////////////////////////////////////////
                while ($row = $db->sql_fetchrow($result)) {
                    $comm_id = $row[comm_id];
                    $comm_author = $row[user_id]; 
                    // ///////////////////////////////////////////////////////////////////////////////////
                    // Now that we have a comment author, grab his/her current point value.				//
                    // ///////////////////////////////////////////////////////////////////////////////////
                    $sql2 = "SELECT points FROM " . $user_prefix . "_users WHERE user_id = '" . $comm_author . "'";
                    $result2 = $db->sql_query($sql2);
                    while ($row2 = $db->sql_fetchrow($result2)) {
                        $points = $row2[points];
                    } 
                    // ///////////////////////////////////////////////////////////////////////////////////
                    // Subtract the current comment's point value.										//
                    // ///////////////////////////////////////////////////////////////////////////////////
                    $points = $points - $points_comment; 
                    // ///////////////////////////////////////////////////////////////////////////////////
                    // Update the comment author's points rating.										//
                    // ///////////////////////////////////////////////////////////////////////////////////
                    $sql3 = "UPDATE " . $user_prefix . "_users SET points = '$points'  WHERE user_id = '" . $comm_author . "'";
                    $db->sql_query($sql3); 
                    // ///////////////////////////////////////////////////////////////////////////////////
                    // Delete the current comment and start loop over until done.						//
                    // ///////////////////////////////////////////////////////////////////////////////////
                    $sql4 = "DELETE FROM " . $prefix . "_blog_comments WHERE comm_id = '" . $comm_id . "'";
                    $db->sql_query($sql4);
                } 
                // ///////////////////////////////////////////////////////////////////////////////////
                // Otherwise, if mass_remove is set to 0, or the comment points value is 0, simply	//
                // flush the database of the associated comments.									//
                // ///////////////////////////////////////////////////////////////////////////////////
            } else {
                $sql = "DELETE FROM " . $prefix . "_blog_comments WHERE blog_id = '" . $blog_id . "'";
                $db->sql_query($sql);
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Report blog removal success.														//
            // ///////////////////////////////////////////////////////////////////////////////////
            opentable();
            center(_BLOG_DELETED);
            closetable(); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Refresh user back to his/her blog list.											//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=blog_list\">"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Before step 2 can occure, we need to trigger a final confirmation.				//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Gather configuration variables.													//
            // ///////////////////////////////////////////////////////////////////////////////////
            $mass_remove = get_config("mass_remove");
            $points_blog = get_config("points_blog");
            $points_comment = get_config("points_comment"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Create display cell.																//
            // ///////////////////////////////////////////////////////////////////////////////////
            opentable();
            center(_BIGWARN);
            br(2); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Standard warning message.														//
            // ///////////////////////////////////////////////////////////////////////////////////
            center(_BLOG_DEL_CONFRIM);
            br(); 
            // ////////////////////////////////////////////////////////////////////////////////////
            // If the recieved credit for this blog, tell them that they are about to loose them.//
            // ////////////////////////////////////////////////////////////////////////////////////
            if ($points_blog != 0) {
                center(_BLOG_POINTS_WARN);
                br();
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If mass_remove is on and the comment author recieved points, then they will be	//
            // removed from the comment author's records.										//
            // ///////////////////////////////////////////////////////////////////////////////////
            if (($mass_remove) AND ($points_comment != 0)) {
                center(_BLOG_MASS_WARN);
                br();
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Present link to view blog.														//
            // ///////////////////////////////////////////////////////////////////////////////////
            $view_string = "<a href=\"" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "\"><span class=\"title\"><u>" . $blog_title . "</u></span></a><br />" . _BLOGGED_ON . " " . $blog_date;
            center($view_string);
            br(2); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Create and present keep and remove (final) links.								//
            // ///////////////////////////////////////////////////////////////////////////////////
            $rem_string = "<a href=\"" . $self . "&op=blog_list\">" . _KEEP_BLOG . "</a>&nbsp;|&nbsp;<a href=\"" . $self . "&op=blog_remove&blog_id=" . $blog_id . "&step=2\">" . _CONF_REMOVE_BLOG . "</a>";
            center($rem_string);
            closetable();
        } 
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function displays a user's blog with added option links.					//
// ///////////////////////////////////////////////////////////////////////////////////
function fetch_blog($blog_id)
{
    global $db, $prefix, $nb_user, $self, $bgcolor3; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Associate standard title texts.													//
    // ///////////////////////////////////////////////////////////////////////////////////
    $status[0] = _STATUS_CLOSED;
    $status[1] = _STATUS_OPEN;
    $status[2] = _STATUS_FRIENDS;
    $comments[0] = _BLOG_OFF;
    $comments[1] = _BLOG_ON; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Create query string for blog fetch.												//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_title,blog_body,blog_mood,blog_date,blog_update,blog_status,blog_comments,blog_views FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "' and user_id = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Walk through query results.														//
    // ///////////////////////////////////////////////////////////////////////////////////
    while ($row = $db->sql_fetchrow($result)) {
        $blog_title = ready($row[blog_title]);
      $blog_body = stripslashes($row[blog_body]);
        $mood = blog_mood($row[blog_mood]); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If blog date and blog update are the same, just grab/convert blog date.			//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($row[blog_date] == $row[blog_update]) {
            $blog_date = date_convert($row[blog_date]); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // If they are different, grab both.												//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            $blog_date = date_convert($row[blog_date]);
            $blog_update = date_convert($row[blog_update]);
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Complete data fetch.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        $blog_status = $status[$row[blog_status]];
        $blog_comments = $comments[$row[blog_comments]];
        $blog_views = $row[blog_views];
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // Again, we will use blog_title as the anti-hack measure because it is required.	//
    // ///////////////////////////////////////////////////////////////////////////////////
    if (!$blog_title) {
        opentable();
        center(_NOTYOURS);
        closetable();
        include_once("footer.php");
        include_once("includes/counter.php");
        die(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // We have all that we need, let's display this blog record.						//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        opentable(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Inital table displays blog title, date, edit link etc...							//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n");
        echo("<tr bgcolor=\"" . $bgcolor3 . "\">");
        echo("<td valign=\"top\">");
        echo("<span class=\"title\">" . $blog_title . "</span>");
        echo(" ");
		echo("( <a href=\"" . $self . "&op=blog_alter&blog_id=" . $blog_id . "\">" . _ALTER_THIS_BLOG . "</a> | " . $blog_views . " " . _BLOG_VIEWS . " | " . $blog_status . " )");
        br();
        echo("<span class=\"content\">");
        echo(_BLOGGED_ON . " " . $blog_date . " ");
        echo("</span>");
        echo("</td>");
        if ($mood) {
            echo("<td valign=\"top\" width=\"100\">" . $mood[mood_image] . "<br /><span class=\"boxtitle\">" . $mood[mood_title] . "</span></td>");
        } 
		echo("</tr>");
        echo("</table>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Blog Body. :)																	//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<span class=\"content\">" . $blog_body . "</span>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Blog footer content.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table width=\"100%\" cellpadding=\"3\" cellspacing=\"0\" border=\"0\">\n");
        echo("<tr bgcolor=\"" . $bgcolor3 . "\">");
        echo("<td align=\"center\">");
        echo(_BLOG_COMMENTS . " " . $blog_comments);
        if ($blog_update) {
            echo(" | " . _LAST_UPDATED . " " . $blog_update);
        } 
		
        echo("</td>\n");
        echo("</tr>\n");
        echo("</table>\n");
        closetable();
        br(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Now that we have displayed the blog, grab any associated comments.				//
        // ///////////////////////////////////////////////////////////////////////////////////
        blog_comments($blog_id);
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Comment looping function. See above.												//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_comments($blog_id)
{
    global $db, $prefix, $nb_user, $user_prefix, $self, $bgcolor1, $bgcolor2, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // The first thing to check for is the existance of comments.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    $num_comms = num_comms($blog_id); 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If we have comments...															//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($num_comms != 0) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Refreshing named link for meta-refresh tags-to-comments.							//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<a name=\"comments\"> </a>\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Start comment table.																//
        // ///////////////////////////////////////////////////////////////////////////////////
        echo("<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Comment query string.															//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "SELECT comm_id, user_id, comm_body, comm_date FROM " . $prefix . "_blog_comments WHERE blog_id = '" . $blog_id . "' ORDER BY comm_id DESC";
        debug($sql);
        $result = $db->sql_query($sql); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Walk through the comment query results.											//
        // ///////////////////////////////////////////////////////////////////////////////////
        while ($row = $db->sql_fetchrow($result)) {
            // ///////////////////////////////////////////////////////////////////////////////////
            // Alternate theme colors for ease of viewing.										//
            // ///////////////////////////////////////////////////////////////////////////////////
            if ($bg == $bgcolor2) {
                $bg = $bgcolor1;
            } else {
                $bg = $bgcolor2;
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Fetch comment data.																//
            // ///////////////////////////////////////////////////////////////////////////////////
            $comm_author = author($row[user_id]);
            $comm_body = ready($row[comm_body]);
            $comm_date = date_convert($row[comm_date]); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Begin table row with alternating color.											//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<tr bgcolor=\"" . $bg . "\">\n"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Comment author information.														//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<td valign=\"top\" align=\"center\" width=\"150\">");
            center($comm_author[user_avatar] . "<br />" . $comm_author[user_name] . "<br />" . $comm_date);
            br(); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Comment removal link.															//
            // ///////////////////////////////////////////////////////////////////////////////////
            center("<a href=\"" . $self . "&op=comment_remove&comm_id=" . $row[comm_id] . "\">Remove Comment</a>");
            echo("</td>\n"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Acutal comment.																	//
            // ///////////////////////////////////////////////////////////////////////////////////
            echo("<td valign=\"top\">");
            echo($comm_body);
            echo("</td>\n");
            echo("</tr>\n");
        } 
        echo("</table>\n");
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// One step process to removing comments.											//
// ///////////////////////////////////////////////////////////////////////////////////
function comment_remove($comm_id)
{
    global $db, $prefix, $nb_user, $self; 
    // ///////////////////////////////////////////////////////////////////////////////////
    // First things first, check the ownership of the parent blog.						//
    // ///////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT blog_id,user_id FROM " . $prefix . "_blog_comments WHERE comm_id = '" . $comm_id . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $blog_id = $row[blog_id];
        $comm_author = $row[user_id];
    } 
    $sql = "SELECT blog_title FROM " . $prefix . "_blog_blogs WHERE blog_id = '" . $blog_id . "' AND user_id = '" . $nb_user[user_id] . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $blog_title = $row[blog_title];
    } 
    // ///////////////////////////////////////////////////////////////////////////////////
    // If after all of that we have a blog title associated with this comment then the	//
    // person requesting the comment removal must be the owner. Proceed.				//
    // ///////////////////////////////////////////////////////////////////////////////////
    if ($blog_title) {
        // ///////////////////////////////////////////////////////////////////////////////////
        // Check for point penalty.															//
        // ///////////////////////////////////////////////////////////////////////////////////
        $points_comment = get_config("points_comment"); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If we have a point penalty...													//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($points_comment != 0) {
            $sql = "SELECT points FROM " . $user_prefix . "_users WHERE user_id = '" . $comm_author . "'";
            $result = $db->sql_query($sql);
            while ($row = $db->sql_fetchrow($result)) {
                $points = $row2[points];
            } 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Subtract the current comment's point value.										//
            // ///////////////////////////////////////////////////////////////////////////////////
            $points = $points - $points_comment; 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Update the comment author's points rating.										//
            // ///////////////////////////////////////////////////////////////////////////////////
            $sql = "UPDATE " . $user_prefix . "_users SET points = '" . $points . "'  WHERE user_id = '" . $comm_author . "'";
            $db->sql_query($sql);
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Remove the actual comment.														//
        // ///////////////////////////////////////////////////////////////////////////////////
        $sql = "DELETE FROM " . $prefix . "_blog_comments WHERE comm_id = '" . $comm_id . "'";
        debug($sql);
        $db->sql_query($sql); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Check to see if there are any comments left on this blog.						//
        // ///////////////////////////////////////////////////////////////////////////////////
        $num_comms = num_comms($blog_id); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // Report success on comment removal.												//
        // ///////////////////////////////////////////////////////////////////////////////////
        opentable();
        center(_COMM_REMOVED);
        closetable(); 
        // ///////////////////////////////////////////////////////////////////////////////////
        // If we have more comments, auto refresh to comments portion of the blog display.	//
        // ///////////////////////////////////////////////////////////////////////////////////
        if ($num_comms != 0) {
            echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "#comments\">"); 
            // ///////////////////////////////////////////////////////////////////////////////////
            // Otherwise, refresh straight back to the blog.									//
            // ///////////////////////////////////////////////////////////////////////////////////
        } else {
            echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "\">");
        } 
        // ///////////////////////////////////////////////////////////////////////////////////
        // No blog title? Not their comment. They may not remove it.						//
        // ///////////////////////////////////////////////////////////////////////////////////
    } else {
        opentable();
        center(_COMM_NOT_REMOVED);
        closetable();
        echo("<META HTTP-EQUIV=\"refresh\" content=\"3;URL=" . $self . "&op=fetch_blog&blog_id=" . $blog_id . "#comments\">");
    } 
} 

?>