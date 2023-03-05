<h1>{L_REPORTS_TITLE}</h1>

<p>{L_REPORTS_EXPLAIN}</p>

<table cellspacing="1" cellpadding="4" border="0" width="90%" class="forumline" align="center">
	<tr>
		<th class="thCornerL">&nbsp;#&nbsp;</th>
		<th class="thTop" width="25%">&nbsp;{L_CAT}&nbsp;</th>
		<th class="thTop" width="75%">&nbsp;{L_EXPLAIN}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_COUNT}&nbsp;</th>
		<th class="thTop" nowrap="nowrap">&nbsp;{L_EDIT}&nbsp;</th>
		<th class="thCornerR" nowrap="nowrap">&nbsp;{L_DELETE}?&nbsp;</th>
	</tr>
	<tr>
		<td class="cat" colspan="6"><span class="cattitle">{L_CAT_EXT}:</span></td>
	</tr>
	<!-- BEGIN extrow -->
	<tr>
		<td class="row1" valign="top" align="center">&nbsp;{extrow.ID}&nbsp;</td>
		<td class="row1" valign="top">{extrow.NAME}</td>
		<td class="row1" valign="top">{extrow.EXPLAIN}</td>
		<td class="row1" valign="top" align="center">&nbsp;{extrow.COUNT}&nbsp;</td>
		<td class="row1" valign="top" align="center">&nbsp;<a href="{extrow.U_EDIT}" class="genmed">{L_EDIT}</a>&nbsp;</td>
		<td class="row1" valign="top" align="center">&nbsp;<a href="{extrow.U_DELETE}" class="genmed">{L_DELETE}</a>&nbsp;</td>
	</tr>
	<!-- END extrow -->
	<tr>
		<td class="cat" colspan="6"><span class="cattitle">{L_CAT_STD}:</span></td>
	</tr>
	<!-- BEGIN catrow -->
	<tr>
		<td class="row1" valign="top" align="center">&nbsp;{catrow.ID}&nbsp;</td>
		<td class="row1" valign="top">{catrow.NAME}</td>
		<td class="row1" valign="top">{catrow.EXPLAIN}</td>
		<td class="row1" valign="top" align="center">&nbsp;{catrow.COUNT}&nbsp;</td>
		<td class="row1" valign="top" align="center">&nbsp;<a href="{catrow.U_EDIT}" class="genmed">{L_EDIT}</a>&nbsp;</td>
		<td class="row1" valign="top" align="center">&nbsp;<a href="{catrow.U_DELETE}" class="genmed">{L_DELETE}</a>&nbsp;</td>
	</tr>
	<!-- END catrow -->
	<tr>
		<td class="catBottom" colspan="6" align="right"><a href="{U_CREATE}" class="cattitle">{L_CREATE}</a></td>
	</tr>
</table>

<br /><br />

<form action="{S_ACTION}" method="post">
<table cellpadding="5" cellspacing="1" border="0" width="70%" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="2">{L_CONFIG}</th>
	</tr>
	<tr>
		<td class="row1">{L_COLOR_NOT_CLEARED}:</td>
		<td class="row2"><input type="text" name="report_color_not_cleared" maxlength="10" size="10" class="post" value="{COLOR_NOT_CLEARED}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COLOR_IN_PROCESS}:</td>
		<td class="row2"><input type="text" name="report_color_in_process" maxlength="10" size="10" class="post" value="{COLOR_IN_PROCESS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_COLOR_CLEARED}:</td>
		<td class="row2"><input type="text" name="report_color_cleared" maxlength="10" size="10" class="post" value="{COLOR_CLEARED}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_REPORT_LIST}:</td>
		<td class="row2">
			<input type="radio" name="report_list" value="1"{LIST_ACP} /> {L_LIST_ACP} &nbsp;
			<input type="radio" name="report_list" value="0"{LIST_EXT} /> {L_LIST_EXT}
		</td>
	</tr>
	<tr>
		<td class="row1">{L_NOTIFY}:</td>
		<td class="row2">
			<input type="radio" name="report_notify" value="0"{NOTIFY_OFF} /> {L_NOTIFY_OFF} &nbsp;
			<input type="radio" name="report_notify" value="2"{NOTIFY_ADMINS} /> {L_ADMINS} &nbsp;
			<input type="radio" name="report_notify" value="1"{NOTIFY_ADMINS_MODS} /> {L_ADMINS_MODS}
		</td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" accesskey="s" class="mainoption" value="{L_SUBMIT}" /></td>
	</tr>
</table>
</form>
