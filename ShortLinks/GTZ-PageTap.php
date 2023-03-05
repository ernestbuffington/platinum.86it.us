<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Page Tap" for the overall page to handle
*             header menu options and other misc "taps" (such as Messages)
*             rather than having to place these in each of the module tap files.
* Version:    1.0.1
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006-2007 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=Downloads(?!&)"',
'"(?<!/)modules.php\?name=Your_Account&amp;op=logout(?!&)"',
'"(?<!/)modules.php\?name=Forums(?!&)"',
'"(?<!/)modules.php\?name=Your_Account(?!&)"',
'"(?<!/)modules.php\?name=Content(?!&)"',
'"(?<!/)modules.php\?name=FAQ(?!&)"',
'"(?<!/)modules.php\?name=Submit_News(?!&)"',
'"(?<!/)modules.php\?name=Topics(?!&)"',
'"(?<!/)modules.php\?name=Top(?!&)"'
);

$urlout = array(
'downloads.html',
'account-logout.html',
'forums.html',
'account.html',
'content.html',
'faq.html',
'submit.html',
'topics.html',
'top.html'
);

?>