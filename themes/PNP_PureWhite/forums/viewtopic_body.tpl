
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
	<td align="left" valign="bottom" colspan="2"><a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
	  <span class="gensmall"><strong>{PAGINATION}</strong><br />
	  &nbsp;</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
	<td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a>

	  	  <!-- BEGIN switch_parent_link -->
 -> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
	  	  <!-- END switch_parent_link -->
 -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
<td align="right" valign="bottom"><span class="mainmenu"><a href="{U_PRINT}" title="{L_PRINT}" class="mainmenu">{L_PRINT}</a></span></td>

  </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
	<tr align="right">
		<td class="catHead" colspan="2" height="28"><span class="nav"><a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a>&nbsp;::&nbsp;<a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a>&nbsp;&nbsp;</span></td>
	</tr>
	{POLL_DISPLAY} 
	<tr>
		<th class="thLeft" width="150" height="26" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr> 
		<td width="150" align="left" valign="top" class="{postrow.ROW_CLASS}"><span class="name"><a name="{postrow.U_POST_ID}"></a>{postrow.rowtit}<strong>{postrow.POSTER_NAME}</strong></span><br /><span class="postdetails">{postrow.USER_RANK_01}{postrow.USER_RANK_01_IMG}{postrow.USER_RANK_02}{postrow.USER_RANK_02_IMG}{postrow.USER_RANK_03}{postrow.USER_RANK_03_IMG}{postrow.USER_RANK_04}{postrow.USER_RANK_04_IMG}{postrow.USER_RANK_05}{postrow.USER_RANK_05_IMG}<br />{postrow.POSTER_AVATAR}<br />{postrow.POSTER_AGE}<br />{postrow.POSTER_GENDER}<br />{postrow.POSTER_JOINED}<br /><a href="{postrow.U_SEARCH_USER_POSTS}" class="genmed"></a><a href="{postrow.U_SEARCH_USER_POSTS}" class="genmed">{postrow.POSTER_POSTS}</a><br />{postrow.POSTER_FROM}<br />{postrow.CUSTOMFIELDS}<br />{postrow.CASH}<br /><a href="{postrow.ITEMSNAME}">Items</a>{postrow.ITEMS}<br />{postrow.POSTER_ONLINE_STATUS}</span><br /><span class="postdetails">
        <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_default_style">
<a class="a2a_dd" href="http://www.addtoany.com/share_save">Share</a>
<span class="a2a_divider"></span>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_email"></a>
</div>
<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->      
		<!-- BEGIN num -->
		 <img src="modules/Forums/templates/subSilver/images/couronne.gif" />&nbsp;{postrow.num.L_WINNER}&nbsp;{postrow.num.NUM_WIN}
		<!-- END num -->
		<marquee onmouseover=this.stop() onmouseout=this.start() direction="up" height="35" width="100%" scrolldelay="250" scrollamount="2">
		<!-- BEGIN trophee -->
		 <a href={postrow.trophee.U_GAME} class="nav" title="{postrow.trophee.L_SCORE}: {postrow.trophee.GAME_SCORE}">{postrow.trophee.GAME_PIC}&nbsp;{postrow.trophee.GAME_NAME}</a><br />
		<!-- END trophee -->
		</marquee>
		</span></td>

                <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
                        <td valign="top" align="right" nowrap="nowrap">{postrow.QUOTE_IMG}&nbsp;{postrow.EDIT_IMG}&nbsp;{postrow.REPORT_IMG}&nbsp;{postrow.DELETE_IMG}&nbsp;{postrow.IP_IMG}&nbsp;{postrow.topicjump}</td></tr></table></td>
                    </tr>
                    <tr> 	
                        <td colspan="2"><hr /></td>
                    </tr>
                    <tr>
                        <td colspan="2" HEIGHT="100%" VALIGN="TOP"><span class="postbody">{postrow.MESSAGE}</span>{postrow.ATTACHMENTS}<span class="postbody"></span><BR /><SPAN CLASS="gensmall">{postrow.EDITED_MESSAGE}</SPAN></td>
                    </tr>
                    <tr>
                        <td colspan="2" VALIGN="BOTTOM"><SPAN CLASS="postbody">{postrow.SIGNATURE}</SPAN></td>
                    </tr>
                </table></td>

	</tr>
	
	<tr> 
		<td class="{postrow.ROW_CLASS}" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
		<td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
			<tr> 
				<td valign="middle" nowrap="nowrap">{postrow.THREAD_KICK_IMG}&nbsp;{postrow.PROFILE_IMG}&nbsp;{postrow.BUDDY_IMG}&nbsp;{postrow.PM_IMG}&nbsp;{postrow.EMAIL_IMG}&nbsp;{postrow.WWW_IMG}&nbsp;{postrow.AIM_IMG}&nbsp;{postrow.YIM_IMG}&nbsp;{postrow.MSN_IMG}<script language="JavaScript" type="text/javascript"><!--

	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
		document.write(' {postrow.ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
				
				//--></script><noscript>{postrow.ICQ_IMG}</noscript></td>
			</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="row1" colspan="2" height="1"><img src="themes/PNP_PureWhite/forums/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
	<tr align="center"> 
		<td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
			<tr><form method="post" action="{S_POST_DAYS_ACTION}">
				<td align="center"><span class="gensmall">{L_DISPLAY_POSTS}:&nbsp;{S_SELECT_POST_DAYS}&nbsp;{S_SELECT_POST_ORDER}&nbsp;<input type="submit" value="{L_GO}" class="liteoption" name="submit" /></span></td>
			</form></tr>
		</table></td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
	<td align="left" valign="middle" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  	  <!-- BEGIN switch_parent_link -->
	  -> <a class="nav" href="{PARENT_URL}">{PARENT_NAME}</a>
	  	  <!-- END switch_parent_link -->
	  -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
<td align="right" valign="middle"><br /><span class="mainmenu"><a href="{U_PRINT}" title="{L_PRINT}" class="mainmenu">{L_PRINT}</a></span></td>

	<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span>
	  </td>
  </tr>
  <tr>
	<td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>
<!-- BEGIN switch_quick_reply -->
	{QRBODY}
<!-- END switch_quick_reply -->
<table width="100%" cellspacing="2" border="0" align="center">
  <tr>
	<td width="40%" valign="top" nowrap="nowrap" align="left"><span class="gensmall">{S_WATCH_TOPIC}<br /><a href="{U_FAV}">{L_FAV}</a></span><br />
	  &nbsp;<br />

          {S_VIEW_KICKED}{S_TOPIC_ADMIN}</td>
	<td align="right" valign="top" nowrap="nowrap">{JUMPBOX}<span class="gensmall">{S_AUTH_LIST}</span></td>
  </tr>
</table>
{RELATED_TOPICS}

