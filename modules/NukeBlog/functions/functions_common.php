<?php 
// ///////////////////////////////////////////////////////////////////////////////////
// Standard user menu.																//
// ///////////////////////////////////////////////////////////////////////////////////
function user_menu()
{
    global $module_name;
    opentable();
    echo("<div align=\"center\">");
    echo("<a href=\"modules.php?name=" . $module_name . "&file=index&op=blog_list\">" . _BROWSE_BLOGS . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"modules.php?name=" . $module_name . "&file=blog\">" . _YOUR_BLOGS . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"modules.php?name=" . $module_name . "&file=blog&op=blog_add\">" . _ADD_BLOG . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"modules.php?name=" . $module_name . "&file=blog&op=friends_list\">" . _BLOG_FRIENDS . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"modules.php?name=" . $module_name . "&file=faq\">" . _BLOG_FAQS . "</a>");
    echo("</div>");
    closetable();
    br();
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Simple comment author function.													//
// ///////////////////////////////////////////////////////////////////////////////////
function author($user_id)
{
    global $db, $user_prefix;
    $sql = "SELECT username, user_avatar FROM " . $user_prefix . "_users WHERE user_id = '$user_id'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $comm_author[user_name] = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $user_id . "\">" . $row[username] . "</a>";
        $comm_author[user_avatar] = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $user_id . "\"><img src=\"modules/Forums/images/avatars/" . $row[user_avatar] . "\" alt=\"" . $row[username] . "\" border=\"0\" /></a>";
    } 
    return($comm_author);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Return the number of comments associated with a particular blog_id.				//
// ///////////////////////////////////////////////////////////////////////////////////
function num_comms($blog_id)
{
    global $db, $prefix;
    $sql = "SELECT comm_id FROM " . $prefix . "_blog_comments WHERE blog_id = '" . $blog_id . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    $num_comms = $db->sql_numrows($result);
    return($num_comms);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Returns username and optional avatar associated with a user_id.					//
// ///////////////////////////////////////////////////////////////////////////////////
function lookup($user_id, $extended = false)
{
    global $user_prefix, $db;
    if ($extended == false) {
        $sql = "SELECT username FROM " . $user_prefix . "_users WHERE user_id = '" . $user_id . "'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            return($row[username]);
        } 
    } else if ($extended == true) {
        $sql = "SELECT username,user_avatar FROM " . $user_prefix . "_users WHERE user_id = '" . $user_id . "'";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $username = $row[username];
            $avatar = "modules/Forums/images/avatars/" . $row[user_avatar];
        } 
        $full = "<a href=\"modules.php?name=Forums&file=profile&mode=viewprofile&u=" . $user_id . "\"><img src=\"" . $avatar . "\" border=\"0\" alt=\"" . $username . "\" border=\"0\" /><br />" . $username . "</a>";
        return($full);
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Find a user_id by username lookup.												//
// ///////////////////////////////////////////////////////////////////////////////////
function uid($username)
{
    global $user_prefix, $db;
    $sql = "SELECT user_id FROM " . $user_prefix . "_users WHERE username = '" . $username . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        return($row[user_id]);
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Return configuration value from the database.									//
// ///////////////////////////////////////////////////////////////////////////////////
function get_config($key)
{
    global $db, $prefix;
    $sql = "SELECT config_value FROM " . $prefix . "_blog_config WHERE config_key =  '" . $key . "'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $key = $row[config_value];
    } 
    return($key);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Randomly placed debug function used in development. May be left in place as a 	//
// admin comfig value will shut it off.												//
// ///////////////////////////////////////////////////////////////////////////////////
function debug($sql)
{
    $sql_show = get_config("show_sql");
    if ($sql_show == 1) {
        echo("<br /><font color=\"#FF0000\">" . $sql . "</font><br />");
    } 
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Simple function to force echo an sql statement. Must be removed after use.		//
// ///////////////////////////////////////////////////////////////////////////////////
function force($sql)
{
    echo("<br /><font color=\"#FF0000\">" . $sql . "</font><br />");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Handy dandy sql insert statement to make my life 1000% easier.					//
// ///////////////////////////////////////////////////////////////////////////////////
function sql_insert($table, $data)
{
    global $db, $prefix;
    $count = 0;
    $num = count($data);
    $keys = "(";
    $values = "(";
    foreach ($data as $key => $value) {
        $value = addslashes(trim($value));
        $keys .= $key;
        $values .= "'" . $value . "'";
        $count = $count + 1;
        if ($count < $num) {
            $keys .= ", ";
            $values .= ", ";
        } 
    } 
    $keys .= ")";
    $values .= ")";
    $sql = "INSERT INTO " . $prefix . "_" . $table . " " . $keys . " VALUES " . $values;
    debug($sql);
    $db->sql_query($sql);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Similar to sql_insert, this function makes updating a database record very easy!	//
// ///////////////////////////////////////////////////////////////////////////////////
function sql_update($table, $data, $where)
{
    global $db, $prefix;
    $count = 0;
    $num = count($data);
    $sql = "UPDATE " . $prefix . "_" . $table . " SET ";
    foreach ($data as $key => $value) {
        $value = addslashes(trim($value));
        $sql .= $key . "='" . $value . "'";
        $count = $count + 1;
        if ($count < $num) {
            $sql .= ", ";
        } 
    } 
    $sql .= " WHERE " . $where . "";
    debug($sql);
    $db->sql_query($sql);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Return full value of a blog_mood.												//
// ///////////////////////////////////////////////////////////////////////////////////
function blog_mood($mood_id)
{
    global $db, $prefix , $module_name;
    $sql = "SELECT mood_title,mood_image FROM " . $prefix . "_blog_moods WHERE mood_id = '" . $mood_id . "'";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $mood[mood_title] = stripslashes($row[mood_title]);
        $mood[mood_image] = "<img src=\"modules/" . $module_name . "/images/moods/" . $row[mood_image] . "\" alt=\"" . $mood[mood_title] . "\" border=\"0\" />";
    } 
    return($mood);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// "short" EXAMPLE  : Nov. 22, 2003 (Default)										//
// "long" EXAMPLE : November 22, 2003												//
// "other" EXAMPLE : 11-22-2003														//
// ///////////////////////////////////////////////////////////////////////////////////
function date_convert($date, $output = "short")
{
    $temp = explode("-", $date);
    $temp_month = $temp[1];
    if (preg_match("#^0#", $temp_month)) {
        $temp_month = preg_replace("#0#", "", $temp_month);
    } 
    if ($output == "short") {
        $month[0] = "empty";
        $month[1] = "" . _JAN_S . "";
        $month[2] = "" . _FEB_S . "";
        $month[3] = "" . _MAR_S . "";
        $month[4] = "" . _APR_S . "";
        $month[5] = "" . _MAY_S . "";
        $month[6] = "" . _JUN_S . "";
        $month[7] = "" . _JUL_S . "";
        $month[8] = "" . _AUG_S . "";
        $month[9] = "" . _SEP_S . "";
        $month[10] = "" . _OCT_S . "";
        $month[11] = "" . _NOV_S . "";
        $month[12] = "" . _DEC_S . "";
        $new_string = $month[$temp_month] . " " . $temp[2] . ", " . $temp[0];
    } else if ($output == "long") {
        $month[0] = "empty";
        $month[1] = "" . _JAN_L . "";
        $month[2] = "" . _FEB_L . "";
        $month[3] = "" . _MAR_L . "";
        $month[4] = "" . _APR_L . "";
        $month[5] = "" . _MAY_L . "";
        $month[6] = "" . _JUN_L . "";
        $month[7] = "" . _JUL_L . "";
        $month[8] = "" . _AUG_L . "";
        $month[9] = "" . _SEP_L . "";
        $month[10] = "" . _OCT_L . "";
        $month[11] = "" . _NOV_L . "";
        $month[12] = "" . _DEC_L . "";
        $new_string = $month[$temp_month] . " " . $temp[2] . ", " . $temp[0];
    } else if ($output == "slashes") {
        $new_string = $temp[1] . "/" . $temp[2] . "/" . $temp[0];
    } else {
        $new_string = $temp[1] . "-" . $temp[2] . "-" . $temp[0];
    } 
    return($new_string);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// This function works off the bbsmiles table to add smiles into a blog post. Thus,	//
// all smiles are adminable via the forum control panel.							//
// ///////////////////////////////////////////////////////////////////////////////////
function smile_in($data)
{
    global $db, $prefix;
    $sql = "SELECT code,smile_url,emoticon FROM " . $prefix . "_bbsmilies";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $og_string = "/(?<=.\W|\W.|^\W)" . phpbb_preg_quote($row['code'], "/") . "(?=.\W|\W.|\W$)/";
        $nu_string = "<img src=\"modules/Forums/images/smiles/" . $row['smile_url'] . "\" alt=\"" . $row['emoticon'] . "\" border=\"0\" />";
        $data = preg_replace($og_string, $nu_string, ' ' . $data . ' ');
    } 
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Sister function to smile_in.														//
// ///////////////////////////////////////////////////////////////////////////////////
function phpbb_preg_quote($str, $delimiter)
{
    $text = preg_quote($str);
    $text = str_replace($delimiter, '\\' . $delimiter, $text);
    return $text;
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Pull smiles out of data.															//
// ///////////////////////////////////////////////////////////////////////////////////
function smile_out($data)
{
    global $db, $prefix;
    $data = preg_replace("#<img src=\"modules/Forums/images/smiles/#", "", $data);
    $sql = "SELECT code,smile_url,emoticon FROM " . $prefix . "_bbsmilies";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $data = preg_replace('#'.$row[smile_url].'#', $row[code], $data);
        $tail = "\" alt=\"" . $row[emoticon] . "\" border=\"0\" />";
        $data = preg_replace('#'.$tail.'#', "", $data);
    } 
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Hyperlink both web and e-mail addresses.											//
// ///////////////////////////////////////////////////////////////////////////////////
function hyperlink($data)
{
    $a = explode(" ", $data);
    for($i = 0; $i < count($a); $i++) {
        $b = str_replace("www.", "http://www.", $a[$i]);
        $b = str_replace("http://http://", "http://", $b);
        $pos = strpos($b, "http://");
        if ($pos === false) {
            $url_found = false;
        } else {
            $url_found = true;
        } 
        if ($url_found) {
            $a[$i] = "<a href='" . $b . "' target=_blank>" . $b . "</a>";
        } 
        $pos = strpos($b, "@");
        if ($pos === false) {
            $email = false;
        } else {
            $email = true;
        } 
        if ($email) {
            $a[$i] = "<a href='mailto:" . $b . "'>" . $b . "</a>";
        } 
    } 
    $data = implode(" ", $a);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Just like the name says...														//
// ///////////////////////////////////////////////////////////////////////////////////
function sterilize($data)
{
    $data = strip_tags($data);
    $data = bb_strip($data);
    $data = addslashes($data);
    $data = trim($data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// When we retrieve a piece of data, this function assists in the process of 		//
// getting it ready to display.														//
// ///////////////////////////////////////////////////////////////////////////////////
function ready($data)
{
    $bad_words = get_config("bad_words");
    while($count < 10) {
		$data = stripslashes($data);
		$count++;
	}
    if ($bad_words) {
        $data = badwords($data);
    } 
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// All purpose data scrubber with BB and Smile encode.								//
// ///////////////////////////////////////////////////////////////////////////////////
function cleanup($data)
{
    $bad_words = get_config("bad_words");
    $data = preg_replace("#                                            #", "", $data); // <-- Crazy bug?
    $data = strip_tags($data);
    $data = bb_e_code($data);
    $data = smile_in($data);
    $data = hyperlink($data);
    if ($bad_words) {
        $data = badwords($data);
    } 
    $data = nl2br($data);
    $data = addslashes($data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Attempts to revese cleanup, making content editable in a suitable format.		//
// ///////////////////////////////////////////////////////////////////////////////////
function rev_cleanup($data)
{
	while($count < 10) {
		$data = stripslashes($data);
		$count++;
	}
    $data = smile_out($data);
    $data = preg_replace("#<br />#", "", $data);
    $data = preg_replace("#                                            #", "", $data);
    $data = bb_d_code($data);
    $data = strip_tags($data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Transforms BBCode into actual HTML.												//
// ///////////////////////////////////////////////////////////////////////////////////
function bb_e_code($data)
{
    $data = strip_tags($data);
    $data = preg_replace("#\\[admin]([^\\[]*)\\[/admin\\]#", "<!--\\1-->", $data);
    $data = preg_replace("#\\[b]([^\\[]*)\\[/b\\]#", "<strong>\\1</strong>", $data);
    $data = preg_replace("#\\[i]([^\\[]*)\\[/i\\]#", "<i>\\1</i>", $data);
    $data = preg_replace("#\\[u]([^\\[]*)\\[/u\\]#", "<u>\\1</u>", $data);
    $data = preg_replace("#\\[center]([^\\[]*)\\[/center\\]#", "<center>\\1</center>", $data);
    $data = preg_replace("#\\[code]([^\\[]*)\\[/code\\]#", "<pre>\\1</pre>", $data);
    $data = preg_replace("#\\[url]http://([^\\[]*)\\[/url\\]#", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $data);
    $data = preg_replace("#\\[url]([^\\[]*)\\[/url\\]#", "<a href=\"http://\\1\" target=\"_blank\">\\1</a>", $data);
    $data = preg_replace("#\\[color=([^\\[]*)\\]([^\\[]*)\\[/color\\]#", "<font color=\"\\1\">\\2</font>", $data);
    $data = preg_replace("#\\[img]([^\\[]*)\\[/img\\]#", "<img src=\"\\1\" border=0 />", $data);
    $data = preg_replace("#quote\\]#", "quote]", $data);
    $data = preg_replace("#\[quote\]\r\n#", '<blockquote><smallfont>Quote:</smallfont><hr />', $data);
    $data = preg_replace("#\[quote\]#", '<blockquote><smallfont>Quote:</smallfont><hr />', $data);
    $data = preg_replace("#\[/quote\]\r\n#", '<hr /></blockquote>', $data);
    $data = preg_replace("#\[/quote\]#", '<hr /></blockquote>', $data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Transform HTML back into BBCode.													//
// ///////////////////////////////////////////////////////////////////////////////////
function bb_d_code($data)
{
    $data = preg_replace("#\<!--#", '[admin]', $data);
    $data = preg_replace("#\--\>#", '[/admin]', $data);
    $data = preg_replace("#\<b\>#", '[b]', $data);
    $data = preg_replace("#\</b\>#", '[/b]', $data);
    $data = preg_replace("#\<i\>#", '[i]', $data);
    $data = preg_replace("#\</i\>#", '[/i]', $data);
    $data = preg_replace("#\<u\>#", '[u]', $data);
    $data = preg_replace("#\</u\>#", '[/u]', $data);
    $data = preg_replace("#\<center\>#", '[center]', $data);
    $data = preg_replace("#\</center\>#", '[/center]', $data);
    $data = preg_replace("#\<code\>#", '[pre]', $data);
    $data = preg_replace("#\</code\>#", '[/pre]', $data);
    $data = preg_replace("#\\<font color=([^>\[]*)\\>([^<\[]*)</font>#" , "[color=\"\\1\"]\\2[/color]", $data);
    $data = preg_replace("#\\<img src=\"([^\\[]*)\"\\ border=0>([^<\[]*)#", "[img]\\1[/img]", $data);
    $data = preg_replace("#\<blockquote><smallfont>Quote:</smallfont><hr />#", '[quote]', $data);
    $data = preg_replace("#\<hr /></blockquote>#", '[/quote]', $data);
    $data = preg_replace("#\<hr /></blockquote>#", '[/quote]', $data);
    $data = preg_replace("#\<br />\n#", '/n', $data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Strip BBCode from a post.														//
// ///////////////////////////////////////////////////////////////////////////////////
function bb_strip($data)
{
    $data = preg_replace("#\[b\]#", '', $data);
    $data = preg_replace("#\[/b\]#", '', $data);
    $data = preg_replace("#\[i\]#", '', $data);
    $data = preg_replace("#\[/i\]#", '', $data);
    $data = preg_replace("#\[u\]#", '', $data);
    $data = preg_replace("#\[/u\]#", '', $data);
    $data = preg_replace("#\[center\]#", '', $data);
    $data = preg_replace("#\[/center\]#", '', $data);
    $data = preg_replace("#\[code\]#", '', $data);
    $data = preg_replace("#\[/code\]#", '', $data);
    $data = preg_replace("#\[/color\]#", '', $data);
    $data = preg_replace("#/\[color=(\S*?)\]/si#", '', $data);
    $data = preg_replace("#\[img\]#", '', $data);
    $data = preg_replace("#\[/img\]#", '', $data);
    $data = preg_replace("#\[quote\]#", '', $data);
    $data = preg_replace("#\[/quote\]#", '', $data);
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Display current BBCode.															//
// ///////////////////////////////////////////////////////////////////////////////////
function list_bb()
{
    global $bgcolor1, $bgcolor2;
    echo("<table cellpadding=\"2\" cellspacing=\"0\" border=\"0\" align=\"center\">\n");
    echo("<tr bgcolor=\"" . $bgcolor1 . "\">\n");
    echo("<td align=\"center\">[b]...[/b]</td>\n");
    echo("<td align=\"center\"><strong>Bold</strong></td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor2 . "\">\n");
    echo("<td align=\"center\">[i]...[/i]</td>\n");
    echo("<td align=\"center\"><em>Italics</em></td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor1 . "\">\n");
    echo("<td align=\"center\">[u]...[/u]</td>\n");
    echo("<td align=\"center\"><u>Underline</u></td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor2 . "\">\n");
    echo("<td align=\"center\">[center]...[/center]</td>\n");
    echo("<td align=\"center\">->Center-<</td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor1 . "\">\n");
    echo("<td align=\"center\">[color=name]...[/color]</td>\n");
    echo("<td align=\"center\">Color</td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor2 . "\">\n");
    echo("<td align=\"center\">[img]...[/img]</td>\n");
    echo("<td align=\"center\">Image</td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor1 . "\">\n");
    echo("<td align=\"center\">[code]...[/code]</td>\n");
    echo("<td align=\"center\">Code</td>\n");
    echo("</tr>\n");
    echo("<tr bgcolor=\"" . $bgcolor2 . "\">\n");
    echo("<td align=\"center\">[quote]...[/quote]</td>\n");
    echo("<td align=\"center\">Blockquote</td>\n");
    echo("</tr>\n");
    echo("</table>\n");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Return a string of the current BBCode table.										//
// ///////////////////////////////////////////////////////////////////////////////////
function list_bb_var()
{
    global $bgcolor1, $bgcolor2;
    $data = "<table cellpadding=0 cellspacing=0 border=1 width=100%>";
    $data .= "<tr bgcolor=" . $bgcolor1 . ">";
    $data .= "<td align=center>[b]...[/b]</td>";
    $data .= "<td align=center><strong>Bold</strong></td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor2 . ">";
    $data .= "<td align=center>[i]...[/i]</td>";
    $data .= "<td align=center><em>Italics</em></td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor1 . ">";
    $data .= "<td align=center>[u]...[/u]</td>";
    $data .= "<td align=center><u>Underline</u></td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor2 . ">";
    $data .= "<td align=center>[center]...[/center]</td>";
    $data .= "<td align=center>->Center-<</td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor1 . ">";
    $data .= "<td align=center>[color=name]...[/color]</td>";
    $data .= "<td align=center>Color</td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor2 . ">";
    $data .= "<td align=center>[img]...[/img]</td>";
    $data .= "<td align=center>Image</td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor1 . ">";
    $data .= "<td align=center>[code]...[/code]</td>";
    $data .= "<td align=center>Code</td>";
    $data .= "</tr>";
    $data .= "<tr bgcolor=" . $bgcolor2 . ">";
    $data .= "<td align=center>[quote]...[/quote]</td>";
    $data .= "<td align=center>Blockquote</td>";
    $data .= "</tr>";
    $data .= "</table>";
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Filter out bad words if the setting calls for it.								//
// ///////////////////////////////////////////////////////////////////////////////////
function badwords($data)
{
    global $prefix, $db;
    $sql = "SELECT word_bad,word_good FROM " . $prefix . "_blog_badwords";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
		$data = preg_replace('@'.$row[word_bad].'@i', $row[word_good], $data);

    } 
    return($data);
} 
// ///////////////////////////////////////////////////////////////////////////////////
// My lazy center string function.													//
// ///////////////////////////////////////////////////////////////////////////////////
function center($string)
{
    echo("<div align=\"center\">" . $string . "</div>\n");
} 
// ///////////////////////////////////////////////////////////////////////////////////
// Another lazy function that slamms out a number of <br /> tags.					//
// ///////////////////////////////////////////////////////////////////////////////////
function br($count = 1)
{
    $i = 1;
    while ($i <= $count) {
        echo("<br />\n");
        $i++;
    } 
} 

?>