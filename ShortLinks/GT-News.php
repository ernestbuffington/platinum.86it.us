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
//modules.php?name=News&amp;file=friend

$urlin = array(
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=comments&amp;sid=([0-9]*)&amp;pid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([\-0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=comments&amp;op=Reply&amp;pid=([0-9]*)&amp;sid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([\-0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=comments&amp;op=showreply&amp;tid=([0-9]*)&amp;sid=([0-9]*)&amp;pid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([\-0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;new_topic=([0-9]*)&amp;pagenum=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)&amp;pagenum=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=print&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=friend"',
'"(?<!/)modules.php\?name=News&amp;pagenum=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;new_topic=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;file=comments"',
'"(?<!/)modules.php\?name=News"',
'"(?<!/)modules.php\?name=Private_Messages&amp;mode=post&amp;u=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Search&amp;type=comments&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;topic=([0-9]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=([a-z_]*)"',
'"(?<!/)modules.php\?name=Topics"'
);

$urlout = array(
'article-\\1-\\2-\\3-\\4.html',
'article-comments-\\1-\\2.html',
'article-reply-\\1-\\2.html',
'article-showreply-\\1-\\2-\\3.html',
'article-topic\\1-page\\2.html',
'article-category\\1-page\\2.html',
'article-category-\\1.html',
'article-print-\\1.html',
'article-friend-\\1.html',
'article-friend.html',
'article-page-\\1.html',
'article-cat-\\1.html',
'article\\1.html',
'article-topic-\\1.html',
'article-comments.html',
'news.html',
'messages-post-\\1.html',
'search-author-\\1.html',
'search-comments-\\1.html',
'search-\\1.html',
'userinfo-\\1.html',
'account-\\1.html',
'topics.html'
);

?>



