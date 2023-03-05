<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Web_Links&amp;file=index&amp;l_op=AddLink"',
'"(?<!/)modules.php\?name=Reviews&amp;rop=write_review"',
'"(?<!/)modules.php\?name=Submit_News"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=userinfo&amp;username=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)"',
'"(?<!/)modules.php\?name=MetAuthors"'
);

$urlout = array(
'linkop-AddLink.html',
'reviews-new.html',
'submit.html',
'userinfo-\\1.html',
'article\\1.html',
'metauthors.html'
);

?>
