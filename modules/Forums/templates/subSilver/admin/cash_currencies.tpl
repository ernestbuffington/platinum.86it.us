{NAVBAR}
<h1>{L_CASH_CURRENCIES_TITLE}</h1>

<p>{L_CASH_CURRENCIES_EXPLAIN}</p>

<table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="1">{L_FIELD}</th><th class="thHead" colspan="1">{L_CURRENCY}</th><th class="thHead" colspan="1">{L_DEFAULT}</th><th class="thHead" colspan="1">{L_DECIMALS}</th><th class="thHead" colspan="1">{L_UPDATE}</th><th class="thHead" colspan="2">{L_ORDER}</th><th class="thHead" colspan="1">{L_DELETE_CURRENCY}</th>
	</tr>
	<!-- BEGIN cashrow -->
	<form action="{S_CASH_CURRENCIES_ACTION}" method="post"><input type="hidden" name="cid" value="{cashrow.CASH_INDEX}" />
	<tr>
	  <td class="row1" align="center"><span class="gen">{cashrow.DBFIELD}</span></td>
	  <td class="row2" align="center"><input class="post" type="text" maxlength="64" size="10" name="rename_value" value="{cashrow.CURRENCY}" /></td>
	  <td class="row1" align="center"><input class="post" type="text" maxlength="64" size="10" name="default_value" value="{cashrow.DEFAULT}" /></td>
	  <td class="row2" align="center"><input class="post" type="text" maxlength="64" size="10" name="decimal_value" value="{cashrow.DECIMALS}" /></td>
	  <td class="row1" align="center"><input type="submit" name="submit" value="{L_UPDATE}" class="mainoption" /></td>
	  <td class="row2" align="center"><span class="gen"><a href="{cashrow.U_MOVE_UP}">{L_MOVE_UP}</a></span></td>
	  <td class="row1" align="center"><span class="gen"><a href="{cashrow.U_MOVE_DOWN}">{L_MOVE_DOWN}</a></span></td>
	  <td class="row2" align="center"><input type="submit" name="submit" value="{L_DELETE}" class="liteoption" /></td>
	</tr>
	</form>
	<!-- END cashrow -->
	<tr>
		<td class="catBottom" colspan="8" align="center"></td>
	</tr>
</table>

<br />
<br />

<form action="{S_CASH_CURRENCIES_ACTION}" method="post"><input type="hidden" name="set" value="copycurrency" /><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_COPY_CURRENCY}</th>
	</tr>
	<tr>
	  <td class="row1" width="50%" align="center">{L_FROM}</td>
	  <td class="row2" width="50%" align="center"><select name="cid1" style="width:100">
		<option value="0">{L_SELECT_ONE}</option>
		<!-- BEGIN cashrow -->
		<option value="{cashrow.CASH_INDEX}">{cashrow.NAME}</option>
		<!-- END cashrow -->
		</select></td>
	</tr>
	<tr>
	  <td class="row1" width="50%" align="center">{L_TO}</td>
	  <td class="row2" width="50%" align="center"><select name="cid2" style="width:100">
		<option value="0">{L_SELECT_ONE}</option>
		<!-- BEGIN cashrow -->
		<option value="{cashrow.CASH_INDEX}">{cashrow.NAME}</option>
		<!-- END cashrow -->
		</select></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br />
<br />

<form action="{S_CASH_CURRENCIES_ACTION}" method="post"><input type="hidden" name="set" value="newcurrency" /><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_NEW_CURRENCY}</th>
	</tr>
	<tr>
	  <td class="row1">{L_CURRENCY}</td>
	  <td class="row2"><input class="post" type="text" maxlength="64" size="15" name="currency_name" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_CURRENCY_DBFIELD}</td>
	  <td class="row2"><input class="post" type="text" maxlength="64" size="15" name="currency_dbfield" value="user_" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_CURRENCY_DECIMALS}</td>
	  <td class="row2"><input class="post" type="text" maxlength="64" size="15" name="currency_decimals" value="0" /></td>
	</tr>
	<tr>
	  <td class="row1">{L_CURRENCY_DEFAULT}</td>
	  <td class="row2"><input class="post" type="text" maxlength="64" size="15" name="currency_default" value="0" /></td>
	</tr>
	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
		</td>
	</tr>
</table></form>

<br clear="all" />
