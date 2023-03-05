<h1>{L_TITLE}</h1>

<p>{L_TITLE_EXPLAIN}</p>


<form action="{S_ACTION}" method="post">
<table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" class="forumline">
<tr>
	<th colspan="2">{L_MOD_NAME}</th>
</tr>
<tr>
	<td valign="top" class="row3">
		<table cellpadding="10" cellspacing="1" border="0" class="bodyline">
		<!-- BEGIN mod -->
		<tr>
			<td class="{mod.CLASS}" align="center" nowrap="nowrap"><a href="{mod.U_MOD}" class="gen">{mod.L_MOD}</a></td>
		</tr>
		<!-- END mod -->
		</table>
	</td>
	<td width="100%" valign="top" class="row3">
		<table cellpadding="5" cellspacing="1" border="0" width="100%" class="bodyline">
		<!-- BEGIN field -->
		<tr>
			<td class="row1" width="50%"><span class="gen">{field.L_NAME}</span><span class="gensmall">{field.L_EXPLAIN}</span></td>
			<td class="row2" width="50%" nowrap="nowrap"><span class="gen">{field.INPUT}</span><span class="gensmall">{field.OVERRIDE}</span></td>
		</tr>
		<!-- END field -->
		</table>
	</td>
</tr>
<tr>
	<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;
		<input type="reset" value="{L_RESET}" class="liteoption" />
	</td>
</tr>
</table></form>