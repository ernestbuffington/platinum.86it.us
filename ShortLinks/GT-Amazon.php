<?php
/************************************************************************
* Script:     TegoNuke(tm) ShortLinks
* Version:    1.0.2
* Author:     Rob Herder (aka: montego) of http://montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

$urlin = array(
"'(?<!/)modules.php\?name=Amazon&amp;op=(KeywordSearch|MarketPlaceSearch|BrowseNodeSearch|AuthorSearch|ArtistSearch|ActorSearch|DirectorSearch|ManufacturerSearch)&amp;keyword=([[:punct:](){}a-zA-Z0-9]*)&amp;mode=([a-zA-Z0-9+-]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;op=(KeywordSearch|MarketPlaceSearch|BrowseNodeSearch|AuthorSearch|ArtistSearch|ActorSearch|DirectorSearch|ManufacturerSearch)&amp;keyword=([[:punct:](){}a-zA-Z0-9]*)&amp;mode=([a-zA-Z0-9+-]*)&amp;AMZpage=([0-9]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;asin=([A-Z0-9]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;op=AsinSearch&amp;keyword=([a-zA-Z0-9]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;op=ShowFI&amp;catalog=([a-zA-Z0-9+]*)&amp;AMZpage=([0-9]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;op=ShowFI&amp;catalog=([a-zA-Z0-9+]*)'",
"'(?<!/)modules.php\?name=Amazon&amp;op=(ShowCart|home)'"
);

$urlout = array(
"amazon-search_\\1_\\2_\\3.html",
"amazon-search_\\1_\\2_\\3_\\4.html",
"amazon-buy-\\1.html",
"asin-search-\\1.html",
"amazon-\\1-\\2.html",
"amazon-\\1.html",
"amazon-to-\\1.html"
);

?>
