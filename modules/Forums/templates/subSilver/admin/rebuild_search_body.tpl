<h1 align="center">{L_REBUILD_SEARCH_TITLE}</h1>
<center>This mod rebuilds the two tables search_wordlist and search_wordmatch.<br> These tables are used for the search function.<br>These tables will need to be rebuilt periodically if you delete users,<br> delete posts, or move posts around.  This will resync them.

<form method="post" action="{S_FORM_ACTION}"><table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr> 
		<th class="thHead" colspan="2">{L_REBUILD_SEARCH_TITLE}</th>
	</tr>
	<tr> 
		<td class="row2" align="center"><input type="submit" name="rebuild" value="{L_REBUILD_SEARCH_SUBMIT}" class="mainoption" /></td>
	</tr>

</table></form>
