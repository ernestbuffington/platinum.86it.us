<span class="maintitle">{L_REPORT_LIST_TITLE}</span><br />
<span class="genmed">{L_REPORT_LIST_EXPLAIN}</span><br /><br />



<table cellpadding="3" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="200" valign="top">
			<table cellpadding="2" cellspacing="1" border="0" width="100%" class="forumline">
				<tr>
					<td class="catHead" align="center"><span class="cattitle">{L_CATEGORIES}</span></td>
				</tr>
				<!-- BEGIN menu -->
				<tr>
					<td class="{menu.ROW_CLASS}">
						<a href="{menu.LINK}" class="gen">{menu.NAME}</a><br />
						<span class="genmed">{menu.COUNT} [<span style="color:{T_NOT_CLEARED}">{menu.COUNT_NOT_CLEARED}</span>|<span style="color:{T_IN_PROCESS}">{menu.COUNT_IN_PROCESS}</span>|<span style="color:{T_CLEARED}">{menu.COUNT_CLEARED}</span>]</span>
					</td>
				</tr>
				<!-- END menu -->
			</table>
		</td>
		<td valign="top">
			<!-- BEGIN catrow -->
			<table cellpadding="3" cellspacing="1" border="0" width="100%" class="forumline">
				<tr>
					<td class="catHead" colspan="4" align="center"><a href="{catrow.LINK}" class="cattitle">{catrow.NAME}</a></td>
				</tr>
				<tr>
					<td class="row2" colspan="4"><span class="genmed">{catrow.EXPLAIN}</span></td>
				</tr>
				<tr>
					<th class="thLeft">&nbsp;#&nbsp;</th>
					<th width="15%">{L_DATE}</th>
					<th width="20%">{L_USERNAME}</th>
					<th class="thRight" width="65%">{L_INFO}</th>
				</tr>
				<!-- BEGIN reportrow -->
				<!-- BEGIN switch_spacer -->
				<tr>
					<td class="spaceRow" colspan="4"><div style="height: 3px"></div></td>
				</tr>
				<!-- END switch_spacer -->
				<tr>
					<td class="row1" align="center"><span class="genmed">&nbsp;{catrow.reportrow.SHOW_ID}&nbsp;</span></td>
					<td class="row1" align="center"><span class="genmed">{catrow.reportrow.DATE}</span></td>
					<td class="row1" align="center"><a href="{catrow.reportrow.U_USER}" class="genmed">{catrow.reportrow.USER}</a></td>
					<td class="row1"><span class="genmed">{catrow.reportrow.INFO}</span></td>
				</tr>
				<tr>
					<td class="row2" colspan="4"><span class="gen">{catrow.reportrow.TEXT}</span></td>
				</tr>
				<tr>
					<td class="row1" colspan="4">
						<div class="genmed" style="float: left">
							<a href="{catrow.reportrow.U_PRIVMSG}" class="genmed">{L_PRIVMSG}</a> | <a href="{catrow.reportrow.U_DELETE}" class="genmed">{L_DELETE}</a> | {catrow.reportrow.STATUS_NOT_CLEARED} | {catrow.reportrow.STATUS_IN_PROCESS} | {catrow.reportrow.STATUS_CLEARED}
						</div>
						<div class="genmed" style="text-align: right">
							{catrow.reportrow.LAST_CHANGED}
						</div>
						<div style="clear: left"></div>
					</td>
				</tr>
				<!-- END reportrow -->
				<!-- BEGIN switch_no_result -->
				<tr>
					<td class="row1" colspan="4" align="center" style="padding: 5px"><span class="gen">{L_NO_RESULT}</span></td>
				</tr>
				<!-- END switch_no_result -->
				<tr>
					<td class="catBottom" colspan="4" align="right"><a href="{catrow.U_DELETE_ALL}" class="cattitle">{L_DELETE_ALL}</a></td>
				</tr>
			</table>
			<br />
			<!-- END catrow -->
		</td>
	</tr>
</table>
