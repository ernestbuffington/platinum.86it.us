<table>
  <tr> 
    <td align="left" valign="middle" class="nav" width="100%"> 
      <span class="nav">&nbsp;&nbsp;&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a>
        </span> 
    </td> 
  </tr> 
</table> 
<hr> 

<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
  <tr> 
    <td class="mediumtext" align="center" colspan="4"> 
   <span class="mediumtext">{L_ADMIN_STATISTICS}</span> 
    </td> 
  </tr> 
  <tr>    
    <th colspan="1" class="mediumtext" align="center"><strong>{L_STATISTIC}</strong></td>    
    <th width="25%" class="mediumtext" align="center"><strong>{L_VALUE}</strong></td> 
    <th width="25%" class="mediumtext" align="center"><strong>{L_STATISTIC}</strong></td>    
    <th width="25%" class="mediumtext" align="center"><strong>{L_VALUE}</strong></td> 
  </tr> 

  <!-- BEGIN adminrow --> 
  <tr> 
   <td class="row2" align="center"><span class="mediumtext">{adminrow.STATISTIC}</span></td> 
   <td class="row1" width="25%" align="center"><span class="mediumtext">{adminrow.VALUE}</span></td> 
   <td class="row2" align="center"><span class="mediumtext">{adminrow.STATISTIC2}</span></td> 
   <td class="row1" width="25%" align="center"><span mediumtext="gen">{adminrow.VALUE2}</span></td> 
  </tr> 
  <!-- END adminrow --> 
</table> 
<br /> 
<br /> 
<table border="0" cellpadding="4" cellspacing="1" class="mediumtext" width="100%"> 
  <tr> 
    <td class="mediumtext" align="center" colspan="5"> 
   <span class="mediumtext">{L_TOP_POSTERS}</span> 
    </td> 
  </tr> 
  <tr>    
    <th colspan="1" class="mediumtext" align="center"><strong>{L_RANK}</strong></th>    
    <th colspan="1" class="mediumtext" align="center" width="10%"><strong>{L_USERNAME}</strong></th> 
    <th colspan="1" class="mediumtext" align="center" width="10%"><strong>{L_POSTS}</strong></th> 
    <th colspan="1" class="mediumtext" align="center" width="10%"><strong>{L_PERCENTAGE}</strong></th> 
    <th colspan="1" class="mediumtext" align="center" width="50%"><strong>{L_GRAPH}</strong></th> 
  </tr> 
  <!-- BEGIN users --> 
  <tr> 
    <td class="{users.CLASS}" align="left" width="10%"><span class="mediumtext">{users.RANK}</span></td> 
    <td class="{users.CLASS}" align="left" width="10%"><span class="mediumtext"><a href="{users.URL}">{users.USERNAME}</a></span></td> 
    <td class="{users.CLASS}" align="center" width="10%"><span class="mediumtext">{users.POSTS}</span></td> 
    <td class="{users.CLASS}" align="center" width="10%"><span class="mediumtext">{users.PERCENTAGE}%</span></td>    
    <td class="{users.CLASS}" align="left" width="50%"> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
       <td align="right"><img src="{LEFT_GRAPH_IMAGE}" width="4" height="12" /></td> 
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left" width="{users.BAR}%"> 
     <tr> 
       <td><img src="{GRAPH_IMAGE}" width="100%" height="12" /></td>
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
       <td align="left"><img src="{RIGHT_GRAPH_IMAGE}" width="4" height="12" /></td> 
     </tr> 
   </table> 
    </td> 
  </tr> 
  <!-- END users --> 
</table> 
<br /> 
<br /> 
<table width="100%" border="0" cellspacing="5" cellpadding="0"> 
  <tr> 
    <td valign="top" width="50%"> 
      <table border="0" cellpadding="4" cellspacing="1" class="mediumtext" width="100%"> 
        <tr> 
          <td class="catHead" align="center" colspan="3"><span class="mediumtext">{L_MOST_VIEWED}</span></td> 
        </tr> 
        <tr> 
          <th colspan="1" class="mediumtext" align="left"><strong>{L_RANK}</strong></th> 
          <th class="mediumtext" align="center"><strong>{L_VIEWS}</strong></th> 
          <th class="mediumtext" align="center"><strong>{L_TOPIC}</strong></th> 
          <!-- BEGIN topicviews --> 
        <tr> 
          <td class="{topicviews.CLASS}" align="left" width="5%"><span class="mediumtext">{topicviews.RANK}</span></td> 
          <td class="{topicviews.CLASS}" align="center" width="20%"><span class="mediumtext">{topicviews.VIEWS}</span></td> 
          <td class="{topicviews.CLASS}" align="left"><span class="mediumtext"><a href="{topicviews.URL}">{topicviews.TITLE}</a></span></td> 
        </tr> 
        <!-- END topicviews --> 
      </table> 
    </td> 
    <td valign="top" width="50%"> 
      <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
        <tr> 
          <td class="catHead" align="center" colspan="3" height="28"> <span class="cattitle">{L_MOST_ACTIVE}</span> 
          </td> 
        </tr> 
        <tr> 
          <th colspan="1" class="thCornerL" align="left"><strong>{L_RANK}</strong></th> 
          <th class="thTop" align="center"><strong>{L_REPLIES}</strong></th> 
          <th class="thCornerR" align="center"><strong>{L_TOPIC}</strong></th> 
        </tr> 
        <!-- BEGIN topicreplies --> 
        <tr> 
          <td class="{topicreplies.CLASS}" align="left" width="5%"><span class="gen">{topicreplies.RANK}</span></td> 
          <td class="{topicreplies.CLASS}" align="center" width="20%"><span class="gen">{topicreplies.REPLIES}</span></td> 
          <td class="{topicreplies.CLASS}" align="left"><span class="gen"><a href="{topicreplies.URL}">{topicreplies.TITLE}</a></span></td> 
        </tr> 
        <!-- END topicreplies --> 
      </table> 
    </td> 
  </tr> 
</table> 
<br /> 
<br /> 
<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
  <tr> 
    <td class="catHead" align="center" colspan="6"> 
      <span class="cattitle">{L_TOP_SMILIES}</span> 
    </td> 
  </tr> 
  <tr>    
    <th colspan="1" class="thCornerL" align="left"><strong>{L_RANK}</strong></th> 
    <th class="thTop" align="center"><strong>{L_USES}</strong></th> 
    <th class="thTop" align="center"><strong>{L_IMAGE}</strong></th> 
    <th class="thTop" align="center"><strong>{L_CODE}</strong></th> 
    <th class="thTop" align="center"><strong>{L_PERCENTAGE}</strong></th> 
    <th class="thCornerR" align="center"><strong>{L_GRAPH}</strong></th> 
  </tr> 

  <!-- BEGIN topsmilies --> 
  <tr> 
    <td class="{topsmilies.CLASS}" align="left" width="5%"><span class="gen">{topsmilies.RANK}</span></td> 
    <td class="{topsmilies.CLASS}" align="center" width="5%"><span class="gen">{topsmilies.USES}</span></td> 
    <td class="{topsmilies.CLASS}" align="center" width="15%"><span class="gen">{topsmilies.URL}</span></td> 
    <td class="{topsmilies.CLASS}" align="center" width="15%"><span class="gen">{topsmilies.CODE}</span></td> 
    <td class="{topsmilies.CLASS}" align="center" width="10%"><span class="gen">{topsmilies.PERCENTAGE}%</span></td> 
    <td class="{topsmilies.CLASS}" width="50%" align="left"> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
        <td align="right"><img src="{LEFT_GRAPH_IMAGE}" width="4" height="12" /></td> 
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left" width="{topsmilies.BAR}%"> 
     <tr> 
        <td><img src="{GRAPH_IMAGE}" width="100%" height="12" /></td> 
     </tr> 
   </table> 
   <table cellspacing="0" cellpadding="0" border="0" align="left"> 
     <tr> 
       <td align="left"><img src="{RIGHT_GRAPH_IMAGE}" width="4" height="12" /></td>
     </tr> 
   </table> 
    </td> 
  </tr> 
  <!-- END topsmilies --> 
</table> 
