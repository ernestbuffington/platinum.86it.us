
<h1>{L_DETECTOR_TITLE}</h1>

<form action="{S_ACTION}" method="post">
<p>
{L_DETECTOR_EXPLAIN}<br/>
<input type="submit" name="clear" value="{L_CLEAR}" class="mainoption" />
</p>

<!-- BEGIN page -->
<table width="90%" border="0" align="center">
<tr>
	<td class="pagination" width="30%">{page.PAGE_NUMBER}</td>
	<td align="right" class="pagination">{page.PAGINATION}</td>
</tr>
</table>
<!-- END page -->

<table width="90%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
		<th class="thHead" width="10%">{L_DETECTOR_ID}</th>
		<th class="thHead" width="30%">{L_DETECTOR_TIME}</th>
		<th class="thHead" width="">{L_DETECTOR_URL}</th>
	</tr>
	<!-- BEGIN detector -->
	<tr>
		<td class="row1" align="right">{detector.ID}</td>
		<td class="row2">{detector.TIME}</td>
		<td class="row1">{detector.URL}</td>
	</tr>
	<!-- END detector -->
	<!-- BEGIN nobot -->
	<tr>
		<td class="row1" colspan="3" align="center">{nobot.L_EXPLAIN}</td>
	</tr>
	<!-- END nobot -->
	<tr>
		<td class="catBottom" colspan="3" align="center"></td>
	</tr>
</table>
</form>

<br clear="all" />
