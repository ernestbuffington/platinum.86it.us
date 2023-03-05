<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for Raven's Collapsing Forums 
*             center block from http://ravenphpscripts.com.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;p=([0-9]*)#([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=search&amp;search_author=([a-zA-Z0-9_-]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewforum&amp;f=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=viewtopic&amp;t=([0-9]*)"',
'"(?<!/)modules.php\?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=([0-9]*)"',
'"(?<!/)modules.php?name=Forums&file=watched_topics([0-9]*)"'
);

$urlout = array(
'ftopicp-\\1.html#\\2',
'fsearch-author-\\1.html',
'forum-\\1.html',
'ftopict-\\1.html',
'forum-userprofile-\\1.html',
'forum-watched-\\1.html'
);

?>
