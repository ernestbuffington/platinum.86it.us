<?php
/******************************************************************************
* Script:     TegoNuke(tm) ShortLinks "Block Tap" for the block-Categories.php 
*             block file.
* Version:    1.0
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
******************************************************************************/

$urlin = array(
'"(?<!/)modules.php\?name=News&amp;file=categories&amp;op=newindex&amp;catid=([0-9]*)"',
'"(?<!/)modules.php\?name=News"'
);

$urlout = array(
'article-category-\\1.html',
'news.html'
);

?>