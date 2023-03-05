<!-- BEGIN switch_error_msg -->
<table cellpadding="3" cellspacing="1" border="0" width="60%" class="bodyline" align="center">
	<tr>
		<td align="center" class="genmed"><span style="color: #E60000; font-weight: bold;">{switch_error_msg.ERROR_MSG}</span></td>
	</tr>
</table>
<!-- END switch_error_msg -->

<table cellpadding="3" cellspacing="1" border="0" width="60%" align="center">
	<tr>
		<td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
	</tr>
</table>

<form action="{S_ACTION}" method="post">
<table cellpadding="4" cellspacing="1" border="0" width="60%" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="2">{L_WRITE_REPORT}</th>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="genmed"><strong>{L_CAT_SELECT}:</strong></span></td>
		<td class="row2" width="100%"><span class="genmed">{S_CAT_SELECT}</span></td>
	</tr>
	<!-- BEGIN switch_cat_explain -->
	<tr>
		<td class="row1" nowrap="nowrap" valign="top"><span class="genmed"><strong>{L_CAT_EXPLAIN}:</strong></span></td>
		<td class="row2"><span class="genmed">{S_CAT_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_cat_explain -->
	<tr>
		<td class="row1" nowrap="nowrap"><span class="genmed"><strong>{L_INFO}:</strong></span></td>
		<!-- BEGIN switch_special_cat -->
		<td class="row2"><span class="genmed">{S_INFO}</span></td>
		<!-- END switch_special_cat -->
		<!-- BEGIN switch_no_special_cat -->
		<td class="row2"><input type="text" name="info" class="post" maxlength="100" size="60" value="{S_INFO}" /></td>
		<!-- END switch_no_special_cat -->
	</tr>
	<tr>
		<td class="row3" colspan="2">
			<span class="genmed"><strong>{L_TEXT}:</strong></span>
			<textarea name="text" class="post" rows="5" cols="30" style="width: 100%; margin-top: 4px">{S_TEXT}</textarea>
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center">
			{S_HIDDEN_FIELDS}<input type="submit" name="submit" class="mainoption" accesskey="s" value="{L_SUBMIT}" />
		</td>
	</tr>
</table>
</form>
