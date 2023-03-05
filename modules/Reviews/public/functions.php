<?php

if (!defined('IN_RPM')) {
	die("You can't access this file directly...");
}

require_once('mainfile.php');

function heading() {
	global $module_name;
	OpenTable();
	echo "<div style=\"text-align: center;\"><a href=\"modules.php?name=$module_name\">\n";
	echo "<img src=\"modules/$module_name/images/reviews.gif\" title=\"$module_name\" alt=\"$module_name\" border=\"0\"></a><br />\n";
	if (file_exists("modules/mSearch/index.php") && is_active("mSearch")) {
		echo "<form method=\"post\" action=\"modules.php\">\n";
		echo "<input type=\"text\" name=\"query\" />\n";
		echo "<input type=\"hidden\" name=\"name\" value=\"mSearch\" />\n";
		echo "<input type=\"hidden\" name=\"what\" value=\"Reviews\" />\n";
		echo "<input type=\"hidden\" name=\"op\" value=\"search\" />\n";
		echo "<input type=\"submit\" value=\""._SEARCH."\" />\n";
		echo "</form>\n";
	} else {
		if (is_active("Search")) {
			echo "<form action=\"modules.php?name=Search&amp;type=reviews#results\" method=\"post\">\n";
			echo "<input type=\"name\" name=\"query\" size=\"30\">&nbsp;&nbsp;\n";
			echo "<input type=\"submit\" name=\"submit\" value=\""._SEARCH."\">\n";
			echo "</form>\n";
		}
	}
	echo "[&nbsp;";
	if (!defined('MAINPAGE')) {
		echo "&nbsp;<a href=\"modules.php?name=$module_name\">"._MAINPAGE."</a> |\n";
	}
	echo "&nbsp;<a href=\"modules.php?name=$module_name&amp;rop=write_review\">"._SUBMITREVIEW."</a> |\n";
	echo "&nbsp;<a href=\"modules.php?name=$module_name&amp;rop=my_reviews\">"._REVIEWSLIST."</a> |\n";
	if (file_exists("modules/mSearch/index.php") && is_active("mSearch")) {
		echo "&nbsp;<a href=\"modules.php?name=mSearch\">"._ADVANCEDSEARCH."</a>\n";
	} else {
		if (is_active("Search")) {
			echo "&nbsp;<a href=\"modules.php?name=Search&amp;type=reviews\">"._ADVANCEDSEARCH."</a>\n";
		}
	}
	echo "&nbsp;]</div>\n";
	CloseTable();
}

function alpha() {
    global $module_name, $ns_theme, $submit_button;
Opentable2();
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $num = count($alphabet) - 1;
    echo "<div align='center'>\n";
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
        echo "<a href=\"modules.php?name=$module_name&rop=$ltr\">$ltr</a>\n";
        if ( $counter == round($num/2) ) {
            echo "<br />\n";
        } elseif ( $counter != $num ) {
            echo "&nbsp;-&nbsp;";
        }
        $counter++;
    }
    echo "</span></div>\n";
Closetable2();
    echo "<br /><br />\n";
}


function display_score($score) {
	global $module_name;
    $image = "<img src=\"modules/$module_name/images/full.gif\" title=\"\">\n";
    $halfimage = "<img src=\"modules/$module_name/images/half.gif\" title=\"\">\n";
    $full = "<img src=\"modules/$module_name/images/full.gif\" title=\"\">\n";

    if ($score == 10) {
	for ($i=0; $i < 5; $i++)
	    echo "$full";
    } else if ($score % 2) {
	$score -= 1;
	$score /= 2;
	for ($i=0; $i < $score; $i++)
	    echo "$image";
	    echo "$halfimage";
    } else {
	$score /= 2;
	for ($i=0; $i < $score; $i++)
	    echo "$image";
    }
}

function newreviewgraphic($datetime, $date) {
    global $module_name, $locale;
    $date = "".$date." 00:00:00";
    setlocale (LC_TIME, $locale);
    preg_match ("#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#", $date, $datetime);
    $datetime = strftime(""._RPDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
    $startdate = time();
    $count = 0;
    while ($count <= 7) {
	$daysold = date("d-M-Y", $startdate);
        if ("$daysold" == "$datetime") {
    	    if ($count<=1) {
		echo "&nbsp;<img src=\"modules/$module_name/images/newred.png\" width=\"\" height=\"\" alt=\""._RPNEWTODAY."\" title=\""._RPNEWTODAY."\">";
	    }
            if ($count<=3 && $count>1) {
		echo "&nbsp;<img src=\"modules/$module_name/images/newgreen.png\" width=\"\" height=\"\" alt=\""._RPNEWLAST3DAYS."\" title=\""._RPNEWLAST3DAYS."\">";
	    }
            if ($count<=7 && $count>3) {
		echo "&nbsp;<img src=\"modules/$module_name/images/newyellow.png\" width=\"\" height=\"\" alt=\""._RPNEWTHISWEEK."\" title=\""._RPNEWTHISWEEK."\">";
	    }
	}
        $count++;
        $startdate = (time()-(86400 * $count));
    }
}

function popgraphic($hits) {
    global $module_name;
    $popular=500;
    if ($hits>=$popular) {
	echo "&nbsp;<img src=\"modules/$module_name/images/popular.png\" width=\"\" height=\"\" alt=\""._RPPOPULAR."\" title=\""._RPPOPULAR."\">";
    }
}

?>
