<script language="javascript" type="text/javascript" src="{U_CFI_JSLIB}"></script>
<script language="javascript" type="text/javascript">
<!--

var CFIG_Version = "DHTML Collapsible Forum Index MOD v1.1.1";

var CFIG = new _CFIG('CFIG',
		['{IMG_PLUS}', '{IMG_MINUS}'],
		['{IMG_DW_ARROW}', '{IMG_UP_ARROW}'],
		['{COOKIE_PATH}', '{COOKIE_DOMAIN}', (('{COOKIE_SECURE}' == '0') ? false : true)]);
	CFIG.T['cookie'] = '{CFI_COOKIE_NAME}';
	CFIG.T['title'] = ['{L_CFI_OPTIONS}', '{L_CFI_OPTIONS_EX}'];
	CFIG.T['close'] = '{L_CFI_CLOSE}';
	CFIG.T['delete'] = '{L_CFI_DELETE}';
	CFIG.T['restore'] = '{L_CFI_RESTORE}';
	CFIG.T['save'] = '{L_CFI_SAVE}';
	CFIG.T['expand_all'] = '{L_CFI_EXPAND_ALL}';
	CFIG.T['collapse_all'] = '{L_CFI_COLLAPSE_ALL}';
	CFIG.T['u_index'] = '{U_INDEX}';
	CFIG.allowed = true;

	if( CFIG.IsEnabled() && parseInt(CFIG.getQueryVar('c')) > 0 )
	{
		window.location.replace('{U_INDEX}');
	}
// -->
</script>
<table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
   <tr>
      <td width="100%" colspan="2" valign="top">
      <!-- MOD GLANCE BEGIN -->
      {GLANCE_OUTPUT}
      <!-- MOD GLANCE END -->
   </td></tr>
</table>
<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
  <tr> 
  	<td class=rowlt align="left" valign="bottom"><span class="gensmall">
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br />
	<!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br /><br /></span><span class="nav"><script language="javascript" type="text/javascript">
<!--
	CFIG.writeButton();
// -->
</script>
<script language="javascript" type="text/javascript">
<!--
	CFIG.writePanel();

<!-- BEGIN catrow -->
CFIG.C['cat_{catrow.CAT_ID}'] = new _CFIC('{catrow.CAT_ID}', '{catrow.DISPLAY}');
<!-- BEGIN forumrow -->
if( CFIG.C['cat_{catrow.CAT_ID}'] ) CFIG.C['cat_{catrow.CAT_ID}'].add('forum_{catrow.CAT_ID}_{catrow.forumrow.FORUM_ID}');
<!-- END forumrow -->
<!-- END catrow -->

function CFIG_slideCat(cat_id, isLink)
{
	if( CFIG && CFIG.currentStep <= 0 )
	{
		if( CFIG.IsEnabled() && CFIG.C['cat_'+cat_id] )
		{
			if( isLink ) return false;
			CFIG.createQueue();
			CFIG.slideForums(cat_id);
			CFIG.execQueue();
			CFIG.saveIndexState(CFIG.T['cookie']);
			return false;	// omit the default action of the link.
		}
		if( !isLink )
		{
			var u_index = CFIG.T['u_index'];
			u_index += ( u_index.indexOf('?') > 0 ? '&' : '?' ) + 'c=' + parseInt(cat_id);
			window.location.replace(u_index);
			return false;
		}
	}
	return true;	// let the link do its job.
}
function CFIG_onLoad()
{
	if( CFIG_oldOnLoad )
	{
		CFIG_oldOnLoad();
		CFIG_oldOnLoad = null;
	}
	if( CFIG && CFIG.IsEnabled() )
	{
		CFIG.restoreIndexState(CFIG.T['cookie']);
	}
}
var CFIG_oldOnLoad = window.onload;
window.onload = CFIG_onLoad;
// -->
</script><a href="{U_INDEX}" class="nav">{L_INDEX}</a>{NAV_CAT_DESC}</span></td>
	<td align="right" valign="bottom" class="gensmall">
		<!-- BEGIN switch_user_logged_in -->
		<a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW}</a><br /><a href="{U_SEARCH_SELF}" class="gensmall">{L_SEARCH_SELF}
                </a><br /><a href="{U_SEARCH_STARTEDTOPICS}" class="gensmall">{L_SEARCH_STARTEDTOPICS}</a><br />
		<!-- END switch_user_logged_in -->
		<a href="{U_SEARCH_UNANSWERED}" class="gensmall">{L_SEARCH_UNANSWERED}</a></td>
  </tr>
</table>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr> 
	<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
	<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
	<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
	<th class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
  </tr>
  <!-- BEGIN catrow -->
 <tr onclick="CFIG_slideCat('{catrow.CAT_ID}', false);" style="cursor:pointer;cursor:hand;"  title="{catrow.CAT_DESC}">
	<td class="rowpic" colspan="2" height="28"><div align="center">&nbsp;&nbsp;<img name="icon_sign_{catrow.CAT_ID}" src="{SPACER}" border="0" />&nbsp;&nbsp;<span class="cattitle"><a href="{catrow.U_VIEWCAT}" onclick="return CFIG_slideCat('{catrow.CAT_ID}', true);" onfocus="this.blur();" class="cattitle">{catrow.CAT_DESC}</a></span></div></td>
	<td class="rowpic" colspan="3" align="right">&nbsp;</td>
  </tr>
  <!-- BEGIN forumrow -->
  <tr id="forum_{catrow.CAT_ID}_{catrow.forumrow.FORUM_ID}" style="display:{catrow.forumrow.DISPLAY};">
	<td class="row1" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
<td class="row1" width="100%" a href="{topicrow.U_VIEW_TOPIC}"><span class="forumlink"> <a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a>{catrow.forumrow.FORUM_EDIT_IMG}<br />

	  </span> <span class="genmed">{catrow.forumrow.FORUM_DESC}<br />
	  </span><span class="gensmall">{catrow.forumrow.L_MODERATOR}&nbsp;{catrow.forumrow.MODERATORS}</span>
	  <!-- BEGIN switch_attached_forums -->
	  <!-- BEGIN br -->
	  <br />
	  <!-- END br -->
	  <span class="genmed">{catrow.forumrow.switch_attached_forums.L_ATTACHED_FORUMS}:
	       <!-- BEGIN attached_forums -->
	        <a class="nav" href="{catrow.forumrow.switch_attached_forums.attached_forums.U_VIEWFORUM}"><img alt="{catrow.forumrow.switch_attached_forums.attached_forums.L_FORUM_IMAGE}" border="0" src="{catrow.forumrow.switch_attached_forums.attached_forums.FORUM_IMAGE}" title="{catrow.forumrow.switch_attached_forums.attached_forums.L_FORUM_IMAGE}" />{catrow.forumrow.switch_attached_forums.attached_forums.FORUM_NAME}</a>
	       <!-- END attached_forums -->
	  <span class="genmed">
	  <!-- END switch_attached_forums -->
</span></span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
	<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
	<td class="row2" align="center" valign="middle" height="50" nowrap="nowrap"> <span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
  </tr>
  <!-- END forumrow -->
  <!-- END catrow -->
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="2">
  <tr> 
	<td align="left"><span class="gensmall"><a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a></span></td>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
	<td class="catHead" colspan="2" height="28"><span class="cattitle"><a href="{U_VIEWONLINE}" class="cattitle">{L_WHO_IS_ONLINE}</a></span></td>
  </tr>
  <tr> 
	<td class="row1" align="center" valign="middle" rowspan="4"><img src="themes/BB_CFiber/forums/images/whosonline.gif" alt="{L_WHO_IS_ONLINE}" /></td>
	<td class="row1" align="left" width="100%"><span class="gensmall">{TOTAL_POSTS}<br />{TOTAL_USERS}<br />{NEWEST_USER}</span>
	</td>
  </tr>
  <tr> 
	<td class="row1" align="left"><span class="gensmall">{TOTAL_USERS_ONLINE}
	<!-- BEGIN colors -->
	{colors.GROUPS}
	<!-- END colors -->
	<br />{RECORD_USERS}<br />{LOGGED_IN_USER_LIST}</span></td>
  </tr>
<!-- Start add - Birthday MOD -->
  <tr>
	<td class="row1" align="left"><span class="gensmall">{L_WHOSBIRTHDAY_TODAY}<br />{L_WHOSBIRTHDAY_WEEK}</span></td>
  </tr>
<!-- End add - Birthday MOD -->
  <tr> 
	<td class="row1" align="left"><span class="gensmall">{USERS_OF_THE_DAY_LIST}</span></td>	
  </tr>
</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0">
	<td align="left" valign="top"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</table>

<!-- BEGIN switch_user_logged_out -->
<form method="post" action="{S_LOGIN_ACTION}">
  <table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
	<tr> 
	  <td class="catHead" height="28"><a name="login"></a><span class="cattitle">{L_LOGIN_LOGOUT}</span></td>
	</tr>
	<tr> 
	  <td class="row1" align="center" valign="middle" height="28"><span class="gensmall">{L_USERNAME}:
		<input class="post" type="text" name="username" size="10" />
		   {L_PASSWORD}: 
		<input class="post" type="password" name="password" size="10" />
		     {L_AUTO_LOGIN} 
		<input class="text" type="checkbox" name="autologin" />
		    
		<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
		</span> </td>
	</tr>
  </table>
</form>
<!-- END switch_user_logged_out -->

<br clear="all" />

<table cellspacing="3" border="0" align="center" cellpadding="0">
  <tr> 
	<td width="20" align="center"><img src="themes/BB_CFiber/forums/images/folder_new.gif" alt="{L_NEW_POSTS}"/></td>
	<td><span class="gensmall">{L_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="themes/BB_CFiber/forums/images/folder.gif" alt="{L_NO_NEW_POSTS}" /></td>
	<td><span class="gensmall">{L_NO_NEW_POSTS}</span></td>
	<td>&nbsp;&nbsp;</td>
	<td width="20" align="center"><img src="themes/BB_CFiber/forums/images/folder_lock.gif" alt="{L_FORUM_LOCKED}" /></td>
	<td><span class="gensmall">{L_FORUM_LOCKED}</span></td>
  </tr>
</table>
