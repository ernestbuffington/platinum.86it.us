<?php
function faq_menu()
{
    global $self;
    opentable();
    echo("<div align=\"center\">");
    echo("<a href=\"$self&op=faqhome\">" . _FAQ_HOME . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"$self&op=bbcode\">" . _FAQ_BBCODE . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"$self&op=smilies\">" . _FAQ_SMILIES . "</a>");
    echo("&nbsp;|&nbsp;");
	echo("<a href=\"$self&op=moods\">" . _FAQ_MOODS . "</a>");
    echo("&nbsp;|&nbsp;");
    echo("<a href=\"$self&op=credits\">" . _FAQ_CREDITS . "</a>");
    echo("</div>");
    closetable();
    br();
} 

function faqhome()
{
    global $self, $prefix, $db, $module_name;
    $sql = "SELECT sitename, nukeurl FROM " . $prefix . "_config";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
        $faq_sitename = stripslashes($row[sitename]);
        $faq_nukeurl = stripslashes($row[nukeurl]);
    } 
    $blog_admin = get_config("blog_admin");
    opentable();
    if ($faq_nukeurl) {
        $blog_title = "<a href=\"" . $faq_nukeurl . "\"><span class=\"title\">" . $faq_sitename . " " . _BLOG . " " . _FAQ_HOME . "</span></a><br />" . _FAQ_BLOG_ADMIN . " " . $blog_admin;
    } else {
        $blog_title = "<span class=\"title\">" . $faq_sitename . " " . _BLOG . " " . _FAQ_HOME . "</span><br />" . _FAQ_BLOG_ADMIN . " " . $blog_admin;
    } 
    center($blog_title);
	br();
	include_once("modules/".$module_name."/includes/blogfaq.html");
    closetable();
} 

function credits() {
	global $module_name;
	opentable();
	include_once("modules/".$module_name."/includes/blogcredit.html");
	closetable();
}

function bbcode() {
	opentable();
	list_bb();
	closetable();
}

function smilies() {
	global $db, $prefix, $bgcolor1, $bgcolor2;
	opentable();
	$bg = $bgcolor2;
	echo("<table align=\"center\" cellpadding=\"2\" cellspacing=\"1\" border=\"0\">\n");
	echo("<tr bgcolor=\"".$bg."\">\n");
	echo("<td align=\"center\"><strong>"._FAQ_SMILE_CODE."</strong></td>\n");
	echo("<td align=\"center\"><strong>"._FAQ_SMILE_IMG."</strong></td>\n");
	echo("<td align=\"center\"><strong>"._FAQ_SMILE_EMOTE."</strong></td>\n");
	echo("</tr>\n");
	$sql = "SELECT code,smile_url,emoticon FROM " . $prefix . "_bbsmilies ORDER BY emoticon";
    debug($sql);
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
		if($bg == $bgcolor1) {
			$bg = $bgcolor2;
		} else {
			$bg = $bgcolor1;
		}
		echo("<tr bgcolor=\"".$bg."\">\n");
		echo("<td align=\"center\">".$row[code]."</td>\n");
		echo("<td align=\"center\"><img src=\"modules/Forums/images/smiles/".$row[smile_url]."\" alt=\"".$row[emoticon]."\" /></td>\n");
		echo("<td align=\"center\"><strong>".$row[emoticon]."</strong></td>\n");
		echo("</tr>\n");
	}
	echo("</table>\n");
	closetable();
}

function moods() {
	global $db, $prefix, $bgcolor1, $bgcolor2, $module_name;
	opentable();
	echo("<table align=\"center\" cellpadding=\"5\" cellspacing=\"2\" border=\"0\">\n");
	echo("<tr>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\" width=\"80\"><strong>"._FAQ_MOOD."</strong></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\" width=\"80\"><strong>"._FAQ_MOOD_IMG."</strong></td>\n");
	echo("<td width=\"50\">&nbsp;</td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\" width=\"80\"><strong>"._FAQ_MOOD."</strong></td>\n");
	echo("<td align=\"center\" bgcolor=\"".$bgcolor2."\" width=\"80\"><strong>"._FAQ_MOOD_IMG."</strong></td>\n");
	echo("</tr>\n");
	echo("<tr>\n");
	$sql = "SELECT mood_title,mood_image FROM " . $prefix . "_blog_moods ORDER BY mood_title";
    debug($sql);
    $result = $db->sql_query($sql);
	$count = 0;
    while ($row = $db->sql_fetchrow($result)) {
		$mood_title = stripslashes($row[mood_title]);
		echo("<td align=\"center\" bgcolor=\"".$bgcolor1."\">".$mood_title."</td>\n");
		echo("<td align=\"center\" bgcolor=\"".$bgcolor1."\"><img src=\"modules/".$module_name."/images/moods/".$row[mood_image]."\" alt=\"".$mood_title."\" /></td>\n");
		$count++;
		if($count == 1) {
			echo("<td>&nbsp;</td>\n");
		} else if ($count == 2) {
			echo("</tr>\n<tr>\n");
			$count = 0;
		}
	}
	if($count == 1) {
		echo("<td>&nbsp;</td>\n");
		echo("<td>&nbsp;</td>\n");
		echo("</tr>\n");
	}
	echo("</table>\n");
	closetable();
}
?>