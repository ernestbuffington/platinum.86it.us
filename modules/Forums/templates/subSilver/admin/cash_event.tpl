{NAVBAR}
<h1>{L_CASH_EVENTS_TITLE}</h1>

<p>{L_CASH_EVENTS_EXPLAIN}</p>

<form action="{S_CASH_EVENTS_ACTION}" method="post">
<table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
	  <th class="thHead" colspan="2">{EVENT_NAME}</th>
	</tr>
<!-- BEGIN cashrow -->
	<tr>
	  <td class="{cashrow.CLASS}" width="200">{cashrow.CASH_NAME}</td><td class="{cashrow.CLASS}" width="200"><input class="post" type="text" maxlength="32" size="15" name="{cashrow.S_CASH_FIELD}" value="{cashrow.AMOUNT}" /></td>
	</tr>
<!-- END cashrow -->
	<tr>
		<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table>
</form>

<br clear="all" />
