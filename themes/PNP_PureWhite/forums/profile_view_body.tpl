
<table width="100%" cellpadding="2" cellspacing="2" border="0">
  <tr>
    <td class="nav"><a href="{U_INDEX}">{L_INDEX}</a> -> {L_VIEWING_PROFILE}</td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td><span class="maintitle"><strong>{USERNAME}</strong></span><span class="gensmall"><br /><a href="{U_SEARCH_USER}">{L_SEARCH_USER_POSTS}</a></span></td>
  </tr>
</table>

<table cellpadding="0" cellspacing="2" border="0" width="100%">
  <tr>
    <td width="50%" valign="top" class="forumline">
      <table cellspacing="1" cellpadding="4" width="100%">
        <tr>
          <td align="center" colspan="2" class="cat"><span class="genmed"><strong>{L_INVISION_A_STATS}</strong></span></td>
        </tr>
        <tr>
          <td width="33%" valign="top" class="row2"><strong><span class="genmed">{L_INVISION_POSTS}</span></strong></td>
          <td width="64%" class="row1"><span class="genmed"><strong>{POSTS}</strong>&nbsp;{INVISION_POST_PERCENT_STATS}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_INVISION_PPD_STATS}</span></strong></td>
          <td class="row1"><span class="genmed">{INVISION_POST_DAY_STATS}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_JOINED}</span></strong></td>
          <td class="row1"><span class="genmed">{JOINED}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_INVISION_MOST_ACTIVE}</span></strong></td>
          <td class="row1"><span class="genmed"><a href="{INVISION_MOST_ACTIVE_FORUM_URL}">{INVISION_MOST_ACTIVE_FORUM_NAME}</a><br />{L_INVISION_MOST_ACTIVE_POSTS}</span></td>
        </tr>
      <tr>
        <td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_ARCADE}:</span></td>
        <td><strong><span class="gen">{URL_STATS}</span></strong></td>
      </tr>
<!-- BEGIN switch_upload_limits -->
		<tr> 
			<td valign="top" align="right" nowrap="nowrap"><span class="gen">{L_UPLOAD_QUOTA}:</span></td>
			<td> 
				<table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
				<tr> 
					<td colspan="3" width="100%" class="row2">
						<table cellspacing="0" cellpadding="1" border="0">
						<tr> 
							<td bgcolor="{T_TD_COLOR2}"><img src="modules/Forums/templates/subSilver/images/spacer.gif" width="{UPLOAD_LIMIT_IMG_WIDTH}" height="8" alt="{UPLOAD_LIMIT_PERCENT}" /></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr> 
					<td width="33%" class="row1"><span class="gensmall">0%</span></td>
					<td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
					<td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
				</tr>
				</table>
				<strong><span class="genmed">[{UPLOADED} / {QUOTA} / {PERCENT_FULL}]</span> </strong><br />
				<span class="genmed"><a href="{U_UACP}" class="genmed">{L_UACP}</a></span></td>
			</td>
		</tr>
<!-- END switch_upload_limits -->
      </table>
    </td>
    <td width="50%" valign="top" class="forumline">
      <table cellspacing="1" cellpadding="4" width="100%">
        <tr>
          <td align="center" colspan="2" class="cat"><span class="genmed"><strong>{L_INVISION_COMMUNICATE}</strong></span></td>
        </tr>
        <tr>
          <td width="33%" valign="top" class="row2"><strong><span class="genmed">{L_EMAIL_ADDRESS}</span></strong></td>
          <td width="64%" class="row1"><span class="genmed">{EMAIL_IMG}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_AIM}</span></strong></td>
          <td class="row1"><span class="genmed">{AIM_IMG}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_ICQ_NUMBER}</span></strong></td>
          <td class="row1">
            <script language="JavaScript" type="text/javascript">
            <!-- 
              if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 && navigator.userAgent.indexOf('6.') == -1 )
                document.write(' {ICQ_IMG}');
              else
                document.write('<table cellspacing="0" cellpadding="0" border="0"><tr><td nowrap="nowrap"><div style="position:relative;height:18px"><div style="position:absolute">{ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{ICQ_STATUS_IMG}</div></div></td></tr></table>');
            //-->
            </script>
            <noscript>{ICQ_IMG}</noscript>
          </td>
        </tr>
			<tr>
		  <td valign="top" class="row2"><strong><span class="genmed">{L_BUDDY}</span></strong></td>
		  <td class="row1"><span class="genmed">{BUDDY_IMG}</span></td>
		</tr>
		<tr> 
		  <td valign="top" class="row2"><strong><span class="genmed">{L_ONLINE_STATUS}</span></strong></td>
		  <td class="row1"><span class="genmed">{ONLINE_STATUS}</span></td>
		</tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_MESSENGER}</span></strong></td>
          <td class="row1"><span class="genmed">{MSN_IMG}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_YAHOO}</span></strong></td>
          <td class="row1"><span class="genmed">{YIM_IMG}</span></td>
        </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_PM}</span></strong></td>
          <td class="row1"><span class="genmed">{PM_IMG}</span></a></td>
        </tr>
      </table>

    </td>
  </tr>
  <tr>
    <td width="50%" valign="top" class="forumline">
      <table cellspacing="1" cellpadding="4" width="100%">
        <tr>
          <td align="center" colspan="2" class="cat"><span class="genmed"><strong>{L_INVISION_INFO}</strong></span></td>
        </tr>
        <tr>
          <td width="33%" valign="top" class="row2"><strong><span class="genmed">{L_INVISION_WEBSITE}</span></strong></td>
          <td width="64%" class="row1"><span class="genmed">{WWW}</span></td>
        </tr>
<!-- Start add - Birthday MOD -->
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_BIRTHDAY}</span></td>
          <td class="row1"><span class="genmed"><strong>{BIRTHDAY}</strong></span></td>
        </tr>
<!-- End add - Birthday MOD -->
<!-- Start add - Gender MOD -->
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_GENDER}</span></strong></td>
          <td class="row1"><strong><span class="genmed">{GENDER}</span></td>
        </tr>
<!-- End add - Gender MOD -->
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_LOCATION}</span></strong></td>
          <td class="row1"><span class="genmed">{LOCATION}</span></td>
        </tr>

         <tr>
	  {CUSTOMFIELDS}
         </tr>
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_INTERESTS}</span></strong></td>
          <td class="row1"><span class="genmed">{INTERESTS}</span></td>
        </tr>
		<tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_OCCUPATION}</span></strong></td>
          <td class="row1"><span class="genmed">{OCCUPATION}</span></td>
		</tr>
   <!-- BEGIN switch_groups_on -->  
       <tr>  
         <td width="33%" valign="top" class="row2"><strong><span class="genmed">{L_INVISION_MEMBER_GROUP}</span></strong></td>  
         <td width="64%" class="row1"><span class="genmed">  
   <!-- END switch_groups_on -->  
   <!-- BEGIN groups -->        
     <a href="{groups.U_GROUP_NAME}" class="gentbl"><strong>{groups.L_GROUP_NAME}</strong></a>:&nbsp;{groups.L_GROUP_DESC}<br />
   <!-- END groups -->  
   <!-- BEGIN switch_groups_on -->  
     </span></td>  
       </tr>  
   <!-- END switch_groups_on --> 
      </table>
    </td>
    <td width="50%" valign="top" class="forumline">
      <table cellspacing="1" cellpadding="4" width="100%">
        <tr>
          <td align="center" colspan="2" class="cat"><span class="genmed"><strong>{L_INVISION_P_DETAILS}</strong></span></td>
        </tr>

        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{L_AVATAR}</span></strong></td>
          <td class="row1"><span class="genmed">{INVISION_AVATAR_IMG}</span></td>
        </tr>

      </table>
<table cellpadding="0" cellspacing="2" border="0" width="100%">
  <tr>
    <td width="50%" valign="top" class="forumline">
      <table cellspacing="1" cellpadding="4" width="100%">


<!-- Start ROW - SHOP -->   
        <tr> 
          <td valign="top" class="row2"><strong><span class="genmed">{INVENTORYLINK}</strong></span></th>       
          <td class="row1"><span class="genmed">{INVENTORYPICS}</span></td>
        </tr>
<!-- End ROW - SHOP -->
<!-- BEGIN cashrow -->
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed">{cashrow.CASH_NAME}</span></td>
          <td class="row1"><span class="genmed"><strong>{cashrow.CASH_AMOUNT}</strong></span></td>
        </tr>
<!-- END cashrow -->
<!-- BEGIN switch_cashlinkson -->
        <tr>
          <td valign="top" class="row2"><strong><span class="genmed"></span>
          <td><span class="gen">
<!-- BEGIN cashlinks -->
   [ <a href="{switch_cashlinkson.cashlinks.U_LINK}" class="genmed">{switch_cashlinkson.cashlinks.L_NAME}</a> ]
<!-- END cashlinks -->
  </span></td>
        </tr>
<!-- END switch_cashlinkson -->
    </table>
        <tr>
          <td align="center" colspan="2" class="cat"><span class="genmed"><strong>{L_INVISION_SIGNATURE}</strong></span></td>
        </tr>
        <tr>
          <td class="row1"><span class="genmed">{INVISION_USER_SIG}</span></td>
        </tr>

</table>
    </td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
	<td align="right" class="nav"><br />{JUMPBOX}</td>
  </tr>
</table>
