{NAVBAR}
<h1>{L_FORUM_SETTINGS_TITLE}</h1>

<p>{L_FORUM_SETTINGS_EXPLAIN}</p>

<form method="post" action="{S_FORUM_ACTION}"><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr>
		<th class="thHead" colspan="3">{L_FORUM_TITLE}</th>
		<!-- BEGIN cashrow -->
		<th class="thHead" colspan="2">{cashrow.CASH_NAME}</th>
		<!-- END cashrow -->
	</tr>
	<!-- BEGIN catrow -->
	<tr>
		<td class="catLeft" colspan="{NUM_ROWS}"><span class="cattitle"><strong><a href="{catrow.U_VIEWCAT}">{catrow.CAT_DESC}</a></strong></span></td>
	</tr>
	<!-- BEGIN forumrow -->
	<tr> 
		<td class="row2"><span class="gen"><a href="{catrow.forumrow.U_VIEWFORUM}" target="_new">{catrow.forumrow.FORUM_NAME}</a></span><br /><span class="gensmall">{catrow.forumrow.FORUM_DESC}</span></td>
		<td class="row1" align="center" valign="middle"><span class="gen">{catrow.forumrow.NUM_TOPICS}</span></td>
		<td class="row2" align="center" valign="middle"><span class="gen">{catrow.forumrow.NUM_POSTS}</span></td>
		<!-- BEGIN cashrow -->
		<td class="row1" align="center" valign="middle"><span class="gen"><input type="radio" name="{catrow.forumrow.cashrow.S_NAME}" value="1"{catrow.forumrow.cashrow.S_ON} />{L_ON}</span></td>
		<td class="row2" align="center" valign="middle"><span class="gen"><input type="radio" name="{catrow.forumrow.cashrow.S_NAME}" value="0"{catrow.forumrow.cashrow.S_OFF} />{L_OFF}</span></td>
		<!-- END cashrow -->
	</tr>
	<!-- END forumrow -->
	<tr>
		<td colspan="{NUM_ROWS}" height="1" class="spaceRow"><img src="../templates/subSilver/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END catrow -->
	<tr>
		<td class="catBottom" colspan="{NUM_ROWS}" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>
