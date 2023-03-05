<h1>{L_RESETUSER_TITLE}</h1> 

<p>{L_RESETUSER_EXPLAIN}</p>

<form action="{S_USER_ACTION}" method="post">
	<table width="100%" cellspacing="1" cellpadding="4" border="0" class="forumline">
		<tr>
			<th class="thHead" colspan="2">{L_RESETUSER_HEADER}</th>
		</tr>
		<tr>
			<td class="row1" align="right">{L_RESETUSER_NAME}:&nbsp;</td>
			<td class="row2"><input type="text" class="post" name="resetuser" maxlength="50" size="20" value="{RESETUSER}" /></td>
		</tr>
		<tr>
			<td colspan="2" class="catBottom" align="center">
				{S_HIDDEN_FIELDS}<input type="submit" name="reset" value="{L_RESET}" class="liteoption" />
			</td>
		</tr>
	</table>
</form>
