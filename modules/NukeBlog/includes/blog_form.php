<form action="<?php echo($self); ?>" method="post" name="blog_form" id="blog_form">
<input type="hidden" name="op" value="blog_action" />
<?php if($blog_id) { ?>
<input type="hidden" name="blog_id" value="<?php echo($blog_id); ?>" />
<?php } ?>
<?php echo("<strong>"._BLOG_TITLE."</strong>"); ?><br />
<input type="text" name="form[blog_title]" value="<?php echo($form[blog_title]); ?>" size="70" maxlength="255" />

<br />
<br />
<?php echo("<strong>"._BLOG_BODY."</strong>"); ?><br />

<?php wysiwyg_textarea('form[blog_body]', ''.($form[blog_body]).'', 'NukeUser', '50', '12');?>
<br />
<br />
<table width="100%" cellpadding="5" cellspacing="5" border="0">
<tr>
<td valign="top" width="50%"><?php opentable(); ?>
<table>
<tr>
<td align="right"><?php echo("<strong>"._BLOG_MOOD."</strong>"); ?> : </td>
<td><select name="form[blog_mood]">
<?php if(!$form[blog_mood]) { ?>
<option value="0" SELECTED><?php echo(_NO_MOOD); ?></option>
<option value="0"><?php echo(_LINE); ?></option>
<?php } else { ?>
<option value="0"><?php echo(_NO_MOOD); ?></option>
<option value="0"><?php echo(_LINE); ?></option>
<?php } ?>
<?php
$sql = "SELECT mood_id,mood_title FROM ".$prefix."_blog_moods ORDER BY mood_title";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	$mood_title = stripslashes($row[mood_title]);
	if($form[blog_mood] == $row[mood_id]) {
		echo("<option value=\"".$row[mood_id]."\" SELECTED>".$mood_title."</option>\n");
	} else {
		echo("<option value=\"".$row[mood_id]."\">".$mood_title."</option>\n");
	}
}
?>
</select></td>
</tr>
<tr>
<td align="right"><?php echo("<strong>"._BLOG_STATUS2."</strong>"); ?> : </td>
<td><select name="form[blog_status]">
<option value="0" <?php if($form[blog_status] == 0) { echo(" SELECTED"); } ?>><?php echo(_STATUS_CLOSED2); ?></option>
<option value="1" <?php if($form[blog_status] == 1) { echo(" SELECTED"); } ?>><?php echo(_STATUS_OPEN2); ?></option>
<option value="2" <?php if($form[blog_status] == 2) { echo(" SELECTED"); } ?>><?php echo(_STATUS_FRIENDS2); ?></option>
</select></td>
</tr>
<tr>
<td align="right"><?php echo("<strong>"._ALLOW_COMMS."</strong>"); ?> : </td>
<td><select name="form[blog_comments]">
<option value="0" <?php if($form[blog_comments] == 0) { echo(" SELECTED"); } ?>><?php echo(_NO); ?></option>
<option value="1" <?php if($form[blog_comments] == 1) { echo(" SELECTED"); } ?>><?php echo(_YES); ?></option>
</select></td>
</tr>
</table><?php closetable(); ?>
</td>
<td valign="top" width="50%" align="center"><?php opentable(); ?><div align="center"><input type="submit" name="submit" value="<?php echo($button); ?>" /><br /><br /><input type="reset" name="reset" value="<?php echo(_RESET_FORM); ?>" /><br /><br /><?php echo(_CHECK_BLOG); ?></div><?php closetable(); ?></td>
</tr>
</table>
</form>
<?php center(_BLOG_FAQ1." <a href=\"modules.php?name=".$module_name."&file=faq\">"._BLOG_FAQS."</a> "._BLOG_FAQ2); ?>