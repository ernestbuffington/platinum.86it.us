<form action="{S_THREAD_KICKER_ADMIN}" method="post">
<h1>{KICKER_HEADER}</h1>
<h1>{KICKER_TABLE}</h1>
<table width="100%" cellspacing="0" cellpadding="3" border="0"> 
	<tr> 
		<td><span class="gen">{PAGE_NUMBER}</span></td> 
		<td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" /></span></td>
		<td align="right"><span class="gen">{PAGINATION}</span></td> 
	</tr> 
</table> 
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">	
	<tr>
		<th height="25" class="thCornerL" nowrap="nowrap">{UNKICK}</th>
		<th class="thTop" nowrap="nowrap">{KICKED}</th>
		<th class="thTop" nowrap="nowrap">{THREAD}</th>
		<th class="thTop" nowrap="nowrap">{DATE}</th>
		<th class="thCornerR" nowrap="nowrap">{KICKED_BY}</th>		
	</tr>
	<!-- BEGIN kicker -->
	<tr> 
		<td class="{kicker.ROW_CLASS}" align="center" valign="middle"><span class="gen">{kicker.CHECKBOX}</span></td>
		<td class="{kicker.ROW_CLASS}" align="center" valign="middle"><span class="gen">{kicker.KICKED}</span></td>
		<td class="{kicker.ROW_CLASS}" align="center" valign="middle"><span class="gen">{kicker.THREAD}</span></td>
		<td class="{kicker.ROW_CLASS}" align="center" valign="middle"><span class="gen">{kicker.DATE}</span></td>
		<td class="{kicker.ROW_CLASS}" align="center" valign="middle"><span class="gen">{kicker.KICKED_BY}</font></span></td>
	</tr>
	<!-- END kicker -->
</table>
<br />
<table width=100% cellpading="3" cellspacing="1" border="0">
	<tr>
		<td width="50%"><div align="left"><input type="submit" name="unkick_marked" value="{KICK_MARKED}" class="mainoption" /></div></td>
		<td width="50%"><div align="right"><input type="submit" name="unkick_all" value="{UNKICK_ALL}" class="mainoption" /></div></td>
	</tr>
</table>
<br />
<h1>{KICKER_SET_HEAD}</h1>
<p>{KICKER_SET_EXPLAIN}</p>
<p>{KICKER_SET_CURRENT}</p>
<div align="left"><input type="submit" name="kicker_set_change" value="{KICKER_SET_CHANGE_BUTTON}" class="mainoption" /></div>
<br />
<h1>{VIEW_SET_HEAD}</h1>
<p>{VIEW_SET_EXPLAIN}</p>
<p>{VIEW_SET_CURRENT}</p>
<div align="left"><input type="submit" name="view_set_change" value="{VIEW_SET_CHANGE_BUTTON}" class="mainoption" /></div>
<br />
</form>
<table width="100%" cellspacing="0" cellpadding="3" border="0"> 
	<tr> 
		<td><span class="gen">{PAGE_NUMBER}</span></td> 
		<td align="right"><span class="gen">{PAGINATION}</span></td> 
	</tr> 
</table> 
<div align="center"><span class="copyright">Thread Kicker Mod 1.0.1 by Majorflam &copy 2004 <a href="http://www.majormod.com" class="copyright">Major Mod - Software Modifications For phpBB2</a></span></div>