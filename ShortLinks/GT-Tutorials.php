<?php

if (stristr($_SERVER['SCRIPT_NAME'], "GT-Tutorials.php")) {
    Header("Location: ../index.html");
    die();
}

$urlin = array(
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=(RemoveList|RemoveTop5)&amp;fav_id=([0-9]*)&amp;ok=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=(ratetutorial|viewtutorialcomments)&amp;lid=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=(AddList|FullProfile)&amp;t_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=showtutorial&amp;pid=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=(PopularTutorials|TopTutorials)&amp;ratenum=([0-9]*)&amp;ratetype=(num|percent)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=viewtutorial&amp;tc_id=([0-9]*)&amp;min=([0-9]*)&amp;orderby=(dateA|dateD|hitsA|hitsD|ratingA|ratingD|titleA|titleD)&amp;show=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=viewtutorial&amp;tc_id=([0-9]*)&amp;orderby=(dateA|dateD|hitsA|hitsD|ratingA|ratingD|titleA|titleD)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=viewtutorial&amp;tc_id=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=NewTutorialsDate&amp;selectdate=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=NewTutorials&amp;newtutorialshowdays=([0-9]*)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=search&amp;query=Buttons&amp;orderby=(dateA|dateD|hitsA|hitsD|ratingA|ratingD|titleA|titleD)'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=search'",
"'(?<!/)modules.php\?name=Tutorials&amp;file=submit'",
"'(?<!/)modules.php\?name=Tutorials&amp;t_op=(FavoriteTutorials|NewTutorials|PopularTutorials|TopTutorials)'",
"'(?<!/)modules.php\?name=Tutorials'"
);

$urlout = array(
"tutorials-\\1-\\2-\\3.html",
"tutorials-\\1-\\2.html",
"tutorials-\\1-\\2.html",
"tutorials-show-\\1.html",
"tutorials-\\1-\\2-\\3.html",
"tutorials-view-\\1-\\2-\\3-\\4.html",
"tutorials-view-\\1-\\2.html",
"tutorials-view-\\1.html",
"tutorials-NewTutorialsDate-selectdate-\\1.html",
"tutorials-NewTutorials-showdays-\\1.html",
"tutorials-search-\\1.html",
"tutorials-search.html",
"tutorials-submit.html",
"tutorials-\\1.html",
"tutorials.html"
);

?>