<h1>{L_TITLE}</h1>

<p>{L_EXP}</p>

<table width="95%" cellspacing="1" cellpadding="5" border="0" class="forumline" align="center">
  <tr>
  	<th class="thCornerL" nowrap="nowrap">&nbsp;#&nbsp;</th>
  	<th class="thTop" nowrap="nowrap" width="25%">&nbsp;{L_CAT}&nbsp;</th>
  	<th class="thTop" nowrap="nowrap" width="25%">&nbsp;{L_PARAM}&nbsp;</th>
  	<th class="thTop" nowrap="nowrap" width="50%">&nbsp;{L_EXPLAIN}&nbsp;</th>
  	<th class="thTop" nowrap="nowrap">&nbsp;{L_EDIT}&nbsp;</th>
  	<th class="thCornerR" nowrap="nowrap">&nbsp;{L_DELETE}?&nbsp;</th>
  </tr>
  <!-- BEGIN catrow -->
  <tr>
  	<td class="row1" nowrap="nowrap" align="center">{catrow.ID}</td>
  	<td class="row1">{catrow.NAME}</td>
  	<td class="row1" nowrap="nowrap">{catrow.PARAM}</td>
  	<td class="row1">{catrow.EXPLAIN}</td>
  	<td class="row1" nowrap="nowrap" align="center">{catrow.EDIT}</td>
  	<td class="row1" nowrap="nowrap" align="center">{catrow.DELETE}</td>
  </tr>
  <!-- END catrow -->
</table>
<br /><br />

<form action="{S_ACTION}" method="post" name="post">
{S_HIDDEN_FORM_FIELDS}
<table width="50%" cellspacing="1" cellpadding="5" border="0" class="bodyline" align="center">
  <tr>
    <th class="thHead" nowrap="nowrap" colspan="2">{L_CREATE}</th>
  </tr>
  <tr>
    <td class="row1" nowrap="nowrap" width="40%">{L_CAT}:</td>
    <td class="row1" nowrap="nowrap" width="60%"><input type="text" name="name" size="60" maxlength="80" style="width:100%" tabindex="1" class="post" value="{NAME}"/></td>
  </tr>
  <tr>
    <td class="row1" nowrap="nowrap" width="40%">{L_PARAM}:</td>
    <td class="row1" nowrap="nowrap" width="60%"><input type="text" name="param" size="60" maxlength="80" style="width:100%" tabindex="2" class="post" value="{TEXT}"/></td>
  </tr>
  <tr>
    <td class="row1" nowrap="nowrap" width="40%">{L_EXPLAIN}:</td>
    <td class="row1" nowrap="nowrap" width="60%"><textarea name="explain" rows="5" cols="35" wrap="virtual" style="width:100%" tabindex="3" class="post">{EXPLAIN}</textarea></td>
  </tr>
  <tr>
    <td class="row1" nowrap="nowrap" colspan="2" align="center"><input type="submit" accesskey="s" tabindex="4" name="submit" class="mainoption" value="{L_SUBMIT}" /></td>
  </tr>
</table>
</form>
<br />
