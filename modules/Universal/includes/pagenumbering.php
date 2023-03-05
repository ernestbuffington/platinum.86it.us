<?php

#####################################################
#													#
#	Universal Module 2.5							#
#	For PHP-Nuke 6.5+								#
#	By Barry Caplin - http://www.e-devstudio.com	#
#													#
#	This is software is bound by the terms of the	#
#	license distrubuted with it. 					#
#	Please read license.txt							#
/************************************************************************/
/* Platinum Nuke Pro: Expect to be impressed                  COPYRIGHT */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.techgfx.com                  */
/*     Techgfx - Graeme Allan                       (goose@techgfx.com) */
/*                                                                      */
/* Copyright (c) 2004 - 2006 by http://www.nukeplanet.com               */
/*     Loki / Teknerd - Scott Partee           (loki@nukeplanet.com)    */
/*                                                                      */
/* Copyright (c) 2007 - 2017 by http://www.platinumnukepro.com          */
/*                                                                      */
/* Refer to platinumnukepro.com for detailed information on this CMS    */
/*******************************************************************************/
/* This file is part of the PlatinumNukePro CMS - http://platinumnukepro.com   */
/*                                                                             */
/* This program is free software; you can redistribute it and/or               */
/* modify it under the terms of the GNU General Public License                 */
/* as published by the Free Software Foundation; either version 2              */
/* of the License, or any later version.                                       */
/*                                                                             */
/* This program is distributed in the hope that it will be useful,             */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of              */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               */
/* GNU General Public License for more details.                                */
/*                                                                             */
/* You should have received a copy of the GNU General Public License           */
/* along with this program; if not, write to the Free Software                 */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. */
/*******************************************************************************/

if (stristr($_SERVER['SCRIPT_NAME'], "pagenumbering.php")) {
	die("Illegal Desolate File Access");
}

// The function 'generate_pagination_phpbb' is the original pagination code from phpBB.
// All credit goes to the authors of phpBB.
// The only modification I made was to increase the outer number limits from 3 to 5.

function generate_pagination_phpbb($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE)
{
        global $lang;

        $total_pages = ceil($num_items/$per_page);

        if ( $total_pages == 1 )
        {
                return '';
        }

        $on_page = floor($start_item / $per_page) + 1;

        $page_string = '';
        if ( $total_pages > 10 )
        {
                $init_page_max = ( $total_pages > 5 ) ? 5 : $total_pages;

                for($i = 1; $i < $init_page_max + 1; $i++)
                {
                        $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                        if ( $i <  $init_page_max )
                        {
                                $page_string .= ", ";
                        }
                }

                if ( $total_pages > 5 )
                {
                        if ( $on_page > 1  && $on_page < $total_pages )
                        {
                                $page_string .= ( $on_page > 7 ) ? ' ... ' : ', ';

                                $init_page_min = ( $on_page > 6 ) ? $on_page : 7;
                                $init_page_max = ( $on_page < $total_pages - 6 ) ? $on_page : $total_pages - 6;

                                for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
                                {
                                        $page_string .= ($i == $on_page) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                                        if ( $i <  $init_page_max + 1 )
                                        {
                                                $page_string .= ', ';
                                        }
                                }

                                $page_string .= ( $on_page < $total_pages - 6 ) ? ' ... ' : ', ';
                        }
                        else
                        {
                                $page_string .= ' ... ';
                        }

                        for($i = $total_pages - 4; $i < $total_pages + 1; $i++)
                        {
                                $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>'  : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                                if( $i <  $total_pages )
                                {
                                        $page_string .= ", ";
                                }
                        }
                }
        }
        else
        {
                for($i = 1; $i < $total_pages + 1; $i++)
                {
                        $page_string .= ( $i == $on_page ) ? '<strong>' . $i . '</strong>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
                        if ( $i <  $total_pages )
                        {
                                $page_string .= ', ';
                        }
                }
        }

        if ( $add_prevnext_text )
        {
                if ( $on_page > 1 )
                {
                        $page_string = ' <strong><a href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">'._PREVPAGE.'</a></strong>&nbsp;&nbsp;' . $page_string;
                }

                if ( $on_page < $total_pages )
                {
                        $page_string .= '&nbsp;&nbsp;<strong><a href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">'._NEXTPAGE.'</a></strong>';
                }

        }

        $page_string = ''._GOTOPAGE.': ' . $page_string;

        return $page_string;
}

function append_sid($url) {
	return $url;
}

function generate_pagination_pages() {	
	global $prefix, $db, $mainprefix, $where;
		    // Calculate Page Numbering
    $mwpages=40;
    if (isset($where)) {
    	$result = $db->sql_query("SELECT count(*) FROM ".$prefix."_".$mainprefix."_items $where");
    } else {
    	$result = $db->sql_query("SELECT count(*) FROM ".$prefix."_".$mainprefix."_items");
    }
		list($total) =  $db->sql_fetchrow($result);
		if ($total>$mwpages) {
    			$pages=ceil($total/$mwpages);
    	if ($page > $pages) { $page = $pages; }
    	if (!$page) { $page=1; }
    			$offset=($page-1)*$mwpages;
			} else {
    		$offset=0;
    		$pages=1;
    		$page=1;
		}
	// End Page Numbering
	return array ($offset, $pages, $page, $mwpages);
}

function generate_pagination_old($page, $pages, $modulename) {
	global $function, $nquery2, $lquery2;
	
	if (isset($function)) {
		$function = $function;
	} else {
		$function = "item_list";	
	}

	if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=$function$nquery2$lquery2&amp;page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=$function$nquery2$lquery2&amp;page=$pcnt\">$pcnt</a> ]</strong> ";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&file=admin&op=$function$nquery2$lquery2&amp;page=$pcnt\">$pcnt</a> ]</strong>";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&file=admin&op=$function$nquery2$lquery2&amp;page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />";
	}	
}

function generate_pagination_old_catindex($pages, $page, $modulename, $letter, $sortletter) {
		if ($letter == 1) {
		if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&sortletter=$sortletter&amp;orderby=$orderby2&amp;page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&sortletter=$sortletter&amp;orderby=$orderby2&amp;page=$pcnt\">$pcnt</a> ]</strong> ";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&sortletter=$sortletter&amp;orderby=$orderby2&amp;page=$pcnt\">$pcnt</a> ]</strong>";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&sortletter=$sortletter&amp;orderby=$orderby2&amp;page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />";
	}
	} else {
		if ($pages > 1) {
			echo "<center>\n";
    $pcnt=1;
		    echo "<br /><center>";
    		echo "<table cellpadding=5 cellspacing=0 border=0><tr>";
    if ($page > 1) {
        	echo "<td align=center valign=middle><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2&amp;page=" . ($page-1) . "\"><img src=\"modules/$modulename/images/left.gif\" Alt=\""._PREVPAGE."\" border=0></a></td><td align=center valign=middle>";
    } else {
    	    echo "<td align=center valign=middle><img src=\"modules/$modulename/images/left-no.gif\" Alt=\""._PREVPAGENO."\" border=0></td><td align=center valign=middle>";
    }
    while($pcnt < $page) {
    		echo "<strong>[ <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby&amp;page=$pcnt\">$pcnt</a> ]</strong> ";
        $pcnt++;
    }
    		echo "<strong>[ $page ]</strong>";
    $pcnt++;
    while($pcnt <= $pages) {
    	    echo " <strong>[ <a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2&amp;page=$pcnt\">$pcnt</a> ]</strong>";
        $pcnt++;
    }
    if ($page < $pages) {
    	    echo "</td><td align=center valign=middle><a href=\"modules.php?name=$modulename&op=CatIndex&cid=$cid&amp;orderby=$orderby2&amp;page=" . ($page+1) . "\"><img src=\"modules/$modulename/images/right.gif\" Alt=\""._NEXTPAGE."\" border=0></a></td>\n";
    } else {
    	    echo "</td><td align=center valign=middle><img src=\"modules/$modulename/images/right-no.gif\" Alt=\""._NEXTPAGENO."\" border=0></td>\n";
	    }
    		echo "</tr></table><br />";
	}
	}
}

?>