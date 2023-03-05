<h1>{L_REPORTS_TITLE}</h1>

<p>{L_REPORTS_EXPLAIN}</p>

<!-- BEGIN switch_error_msg -->
<table cellpadding="3" cellspacing="1" border="0" width="60%" class="bodyline" align="center">
	<tr>
		<td align="center" class="genmed"><span style="color: #E60000; font-weight: bold;">{switch_error_msg.ERROR_MSG}</span></td>
	</tr>
</table>
<br />
<!-- END switch_error_msg -->

<form action="{S_ACTION}" method="post">
<table cellpadding="5" cellspacing="1" border="0" width="60%" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="2">{L_EDIT_CREATE}</th>
	</tr>
	<tr>
		<td class="row1" width="40%">{L_CAT}:</td>
		<td class="row2" width="60%"><input type="text" name="name" maxlength="100" size="60" style="width: 100%" class="post" value="{NAME}"/></td>
	</tr>
	<tr>
		<td class="row1">{L_TYPE}:</td>
		<td class="row2">
			<input type="radio" name="type" value="0"{TYPE_NORMAL} /> {L_TYPE_NORMAL} &nbsp;
			<input type="radio" name="type" value="1"{TYPE_EXT} /> {L_TYPE_EXT}
		</td>
	</tr>
	<tr>
		<td class="row1" valign="top">{L_AUTH}:</td>
		<td class="row2">
			<input type="radio" name="auth" value="0"{AUTH_ADMINS_MODS} /> {L_ADMINS_MODS}<br />
			<input type="radio" name="auth" value="1"{AUTH_ADMINS} /> {L_ADMINS}</td>
	</tr>
	<tr>
		<td class="row1" valign="top">{L_EXPLAIN}:</td>
		<td class="row2"><textarea name="explain" class="post" rows="5" cols="35" style="width: 100%">{EXPLAIN}</textarea></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" accesskey="s" class="mainoption" value="{L_SUBMIT}" /></td>
	</tr>
</table>
{S_HIDDEN_FIELDS}
</form>
<br />
