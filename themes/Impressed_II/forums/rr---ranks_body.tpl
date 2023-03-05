<table>
	<tr>
		<td align="left" class="nav" valign="middle" width="60%">
			<span class="nav">
				<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
				&nbsp;->&nbsp;
				<a href="{U_RANKS}" class="nav">{L_RANKS}</a>
			</span>
		</td>
	</tr>
</table>
<hr>

<table width="90%" align="center" cellspacing="1" cellpadding="4" border="0">
	<tr>
		<td width="49%" align="center" valign="top">
			<table class="forumline" width="100%" align="center" cellspacing="1" cellpadding="4" border="0">
				<tr>
					<th class="thCornerL">{L_RANKS_IMAGE}</th>
					<th class="thCornerR">{L_RANK_TITLE}</th>
				</tr>
				<!-- BEGIN ranks_no_special -->
				<tr>
					<td class="row1" align="center" colspan="2">
						<span class="gensmall">{ranks_no_special.L_RANK_NO_NORMAL}</span>
					</td>
				</tr>
				<!-- END ranks_no_special -->
				<!-- BEGIN ranks_special -->
				<tr>
					<td class="{ranks_special.ROW_CLASS}" align="center">
						<img src="{ranks_special.IMAGE}" alt="{ranks_special.RANK}" border="0"><br />
						<span class="gensmall"><strong>{ranks_special.RANK_SPECIAL_DES}</strong></span>
					</td>
					<td class="{ranks_special.ROW_CLASS}" align="center">
						<span class="genmed"><strong>{ranks_special.RANK}</strong></span>
					</td>
				</tr>
				<!-- END ranks_special -->
				<tr>
					<td class="catBottom" align="center" colspan="2"></td>
				</tr>
			</table>
		</td>
		<td width="2%" align="center">
		</td>
		<td width="49%" align="center" valign="top">
			<table class="forumline" width="100%" align="center" cellspacing="1" cellpadding="4" border="0">
				<tr>
					<th class="thCornerL">{L_RANKS_IMAGE}</th>
					<th class="thTop">{L_RANK_TITLE}</th>
					<th class="thCornerR">{L_RANK_MIN_M}</th>
				</tr>
				<!-- BEGIN ranks_no_normal -->
				<tr>
					<td class="row1" align="center" colspan="3">
						<span class="gensmall">{ranks_no_normal.L_RANK_NO_NORMAL}</span>
					</td>
				</tr>
				<!-- END ranks_no_normal -->
				<!-- BEGIN ranks_normal -->
				<tr>
					<td class="{ranks_normal.ROW_CLASS}" align="center">
						<img src="{ranks_normal.IMAGE}" alt="{ranks_normal.RANK}" border="0"><br />
						<span class="gensmall"><strong>{ranks_normal.RANK_SPECIAL_DES}</strong></span>
					</td>
					<td class="{ranks_normal.ROW_CLASS}" align="center">
						<span class="genmed"><strong>{ranks_normal.RANK}</strong></span>
					</td>
					<td class="{ranks_normal.ROW_CLASS}" align="center">
						<span class="genmed"><strong>{ranks_normal.RANK_MIN}</strong></span>
					</td>
				</tr>
				<!-- END ranks_normal -->
				<tr>
					<td class="catBottom" align="center" colspan="3"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
