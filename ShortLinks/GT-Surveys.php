<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
//GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Original Nukecops GoogleTap done by NukeCops (http://www.nukecops.com)

$urlin = array(
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;op=results&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;pollID=([0-9]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;(tid|pid)=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;pollID=([0-9]*)&amp;tid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=Reply&amp;pid=([0-9]*)&amp;pollID=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;pollID=([0-9]*)&amp;pid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9\-]*)"',
'"(?<!/)modules.php\?name=Surveys&amp;file=comments"',
'"(?<!/)modules.php\?name=Surveys"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z]*)"'
);

$urlout = array(
'survey-results-\\1-\\2-\\3-\\4.html',
'survey-results-\\1.html',
'survey-\\1.html',
'survey-comment-\\1-\\2-\\3-\\4-\\5-\\6.html',
'survey-comment-\\1-\\2-\\3-\\4-\\5.html',
'survey-commreply-\\1-\\2-\\3-\\4-\\5.html',
'survey-showreply-\\1-\\2-\\3-\\4-\\5-\\6.html',
'survey-showreply-\\1-\\2-\\3-\\4.html',
'survey-comments.html',
'surveys.html',
'messages-post-\\1.html',
'userinfo-\\1.html',
'account-\\1.html'
);

?>