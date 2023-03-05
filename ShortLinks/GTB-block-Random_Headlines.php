<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Random_Headlines.php 
*             block file.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=News&amp;file=article&amp;sid=([0-9]*)&amp;mode=([a-z]*)&amp;order=([0-9]*)&amp;thold=([0-9]*)"',
'"(?<!/)modules.php\?name=News&amp;new_topic=([0-9]*)"',
'"(?<!/)modules.php\?name=Search&amp;topic=([0-9]*)"'
);

$urlout = array(
'article-\\1-\\2-\\3-\\4.html',
'article-topic-\\1.html',
'search-\\1.html'
);

?>