<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
        <th class="thTop">{L_USERNAME}</th>
        <th class="thTop">{L_POSTS}</th>
        <th class="thTop">{L_JOINED}</th>
        <th class="thTop">{L_EMAIL}</th>
        <th class="thTop">{L_PM}</th>
        <th class="thTop">{L_MESSENGER}</th>
        <th class="thCornerR">{L_WWW}</th>
  </tr>
<!-- BEGIN staff -->
  <tr> 
        <td valign="center" align="center" class="row1" nowrap="nowrap"><a href="{staff.U_NAME}" class="genmed">{staff.NAME}</a><br /> <span class="postdetails"><br />{staff.LEVEL}<br />{staff.RANK_IMAGE}<br />{staff.AVATAR}</span></td>
        <td valign="center" align="center" class="row1" nowrap="nowrap"><span class="gensmall">{staff.POSTS} ø&nbsp;<br />
                                                                                                   {staff.POST_PERCENT} ø&nbsp;<br />{staff.POST_DAY} ø&nbsp;
                                                                                                   <br />[{staff.LAST_POST}]</span>&nbsp;</td>
        <td valign="center" class="row2" align="center" nowrap="nowrap"><span class="gensmall">{staff.JOINED}<br />[{staff.PERIOD}]</span></td>
        <td align="center" class="row1">{staff.MAIL}</td>
        <td align="center" class="row2">{staff.PM}</td>
        <td align="center" class="row1">{staff.MSN} {staff.YIM}<br />{staff.AIM} {staff.ICQ}</td>
        <td align="center" class="row2">{staff.WWW}</td>
  </tr>
<!-- END staff -->
</table>
