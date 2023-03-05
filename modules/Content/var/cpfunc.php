<?php
/**********************************************/
/* Content Plus Module For PHP-Nuke 7.3 - 8.0
/* Written by: Jonathan Estrella
/* http://slaytanic.sourceforge.net
/* Copyright (c) 2004-2008 Jonathan Estrella
/**********************************************/

if(!defined('IN_CPM')) { die('You Can\'t access this file directly'); }

function cpheader() {
global $module_name, $admin, $admin_file, $pa;
	OpenTable();
	echo '<div style="text-align: center; font-size: 115%;">'.PHP_EOL;
	if (!empty($pa) && $pa!=='list_pages') {
		echo '<a href="modules.php?name='.$module_name.'">'.PHP_EOL;
	}
	echo '<img src="modules/'.$module_name.'/images/clogo.png" alt="" title="'._CP_CINDEX.'" border="0" style="margin: 6px;" /><br />'.PHP_EOL;
	if (!empty($pa) && $pa!=='list_pages') {
		echo '</a>'.PHP_EOL;
	}
	echo '<a href="modules.php?name='.$module_name.'">'._CP_CINDEX.'</a> |&nbsp;'.PHP_EOL;
	echo '<a href="modules.php?name='.$module_name.'&amp;pa=browse_tags">'._CP_TAGS.'</a> |&nbsp;'.PHP_EOL;
	echo '<a href="modules.php?name='.$module_name.'&amp;pa=add_page">'._CP_CSEND.'</a>'.PHP_EOL;
	if (is_admin($admin)) {
		echo '&nbsp;| <a href="'.$admin_file.'.php?op=ContentPlus">'._CP_CADMIN.'</a>'.PHP_EOL;
	}
	echo '</div>'.PHP_EOL;
	Closetable();
}

function newcontentgraphic($date) {
    global $module_name, $datetime, $locale;
    setlocale (LC_TIME, $locale);
    preg_match ('#([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $date, $datetime);
    $datetime = strftime(_CP_CPDATESTRING, mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
    $startdate = time();
    $count = 0;
    while ($count <= 7) {
	$daysold = date('d-M-Y', $startdate);
        if ($daysold == $datetime) {
    	    if ($count<=1) {
		echo '&nbsp;<img src="modules/'.$module_name.'/images/icons/new_red.png" alt="" title="'._CP_CPNEWTODAY.'" width="32" />';
	    }
            if ($count<=3 && $count>1) {
		echo '&nbsp;<img src="modules/'.$module_name.'/images/icons/new_green.png" alt="" title="'._CP_CPNEWLAST3DAYS.'" width="32" />';
	    }
            if ($count<=7 && $count>3) {
		echo '&nbsp;<img src="modules/'.$module_name.'/images/icons/new_yellow.png" alt="" title="'._CP_CPNEWTHISWEEK.'" width="32" />';
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
	echo '&nbsp;<img src="modules/'.$module_name.'/images/icons/popular.png" alt="" title="'._CP_CPPOPULAR.'" width="32" />';
    }
}

function cp_pagination($ofsbgn, $ofsppg) {
global $prefix, $module_name, $cid, $page, $pa, $tag;
	/* New pagination class by Vecchio Joe   [ http://www.vecchiojoe.it ] */
	include_once('modules/'.$module_name.'/var/paginationSystem.class.php');
	$ps = new paginationSystem();
	$ps->items 	= $ofsppg;
	$ps->actpg 	= $page;
	if ($pa == 'browse_tag') {
		$ps->query 	= 'SELECT pid FROM '.$prefix.'_pages WHERE (tags like \'%'.$tag.'%\')';
		$ps->url	= 'modules.php?name='.$module_name.'&amp;pa='.$pa.'&amp;tag='.$tag.'&amp;page={{N}}';
	} else {
		$ps->query 	= 'SELECT pid FROM '.$prefix.'_pages WHERE cid='.$cid.'';
		$ps->url	= 'modules.php?name='.$module_name.'&amp;pa='.$pa.'&amp;cid='.$cid.'&amp;page={{N}}';
	}
	$ps->show();
}

function featured_content($cid) {
global $db, $prefix, $bgcolor4, $module_name;
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages_feat WHERE cid='.$cid.'');
	$numrows = $db->sql_numrows($result);
	if($numrows>0) {
		$row = $db->sql_fetchrow($result);
		$fpid= intval($row['pid']);
		$fresult = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$fpid.'\'');
		$frow = $db->sql_fetchrow($fresult);
		$ftitle = stripslashes(check_html($frow['title'], 'nohtml'));
		$fsubtitle = stripslashes(check_html($frow['subtitle'], 'nohtml'));
		$fheader = stripslashes(check_html($frow['page_header'], 'nohtml'));
		$fpage = stripslashes(check_html($frow['text'], 'nohtml'));
		$fhits = intval($frow['counter']);
		$headlen = strlen($fheader);
		if(!empty($fheader) && $headlen>255) {
			$fshow=substr($fheader, 0, 255);
		} else {
			$fshow=substr($fpage, 0, 255);
		}
		echo '<center><strong>'._CP_CPFEATCONTENT.'</strong></center><br />'.PHP_EOL;
		echo '<div style="background-color: '.$bgcolor4.';">'.PHP_EOL;
		echo '	<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$fpid.'"><img align="left" src="modules/'.$module_name.'/images/categories/no_icon.png" width="48" height="48" border="0" alt="" style="margin: 1em;" />';
		echo '	<span class="title">'.$ftitle.'</span></a>'.PHP_EOL;
		if($fsubtitle) {
			echo '	&nbsp;('.$fsubtitle.')';
		}
		newcontentgraphic($frow['date']);
		popgraphic($fhits);
		echo '	<br />'.PHP_EOL;
		echo '	<div style="text-align: justify;">'.$fshow.'...'.PHP_EOL;
		echo '	<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$fpid.'"><strong>'._CP_CPREADMORE.'</strong></a> ('.$fhits.' '._CP_READS.')</div>'.PHP_EOL;
		echo '</div><br /><br />'.PHP_EOL;
	}
}

function print_page($pid) {
global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\'');
	$mypage = $db->sql_fetchrow($result);
	$result = $db->sql_query('SELECT title FROM '.$prefix.'_pages_categories WHERE cid=\''.$mypage['cid'].'\'');
	$mycat = $db->sql_fetchrow($result);
	//$mypage['text'] = preg_replace("<!--pagebreak-->", "<br />", $mypage['text']);
	$mypage['text'] = str_replace('[--pagebreak--]', '<br /><br />', $mypage['text']);
	$db->sql_query('UPDATE '.$prefix.'_pages SET counter=counter+1 WHERE pid=\''.$pid.'\'');
	echo '<?xml version="1.0" encoding="'._CHARSET.'"?>'.PHP_EOL;
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'.PHP_EOL;
	echo ' "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
	echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'.PHP_EOL;
	echo '<head>'.PHP_EOL;
	echo '<title>'.$sitename.' || '.$mycat['title'].' || '.$mypage['title'].'</title>'.PHP_EOL;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='._CHARSET.'" />'.PHP_EOL;
	echo '<meta http-equiv="Content-Script-Type" content="text/javascript" />'.PHP_EOL;
	echo '<meta name="RESOURCE-TYPE" content="DOCUMENT" />'.PHP_EOL;
	echo '<meta name="DISTRIBUTION" content="GLOBAL" />'.PHP_EOL;
	echo '<meta name="RATING" content="GENERAL" />'.PHP_EOL;
	echo '</head>'.PHP_EOL;
	echo '<body onload="printit()">'.PHP_EOL;
	echo '<script type="text/javascript">'.PHP_EOL;
	echo '//<![CDATA['.PHP_EOL;
	echo '/*'.PHP_EOL;
	echo 'This script is written by Eric (Webcrawl@usa.net)'.PHP_EOL;
	echo 'For full source code, installation instructions,'.PHP_EOL;
	echo '100\'s more DHTML scripts, and Terms Of'.PHP_EOL;
	echo 'Use, visit dynamicdrive.com'.PHP_EOL;
	echo '*/'.PHP_EOL;
	echo 'function printit(){  '.PHP_EOL;
	echo 'if (window.print) {'.PHP_EOL;
	echo '    window.print() ;'.PHP_EOL;
	echo '} else {'.PHP_EOL;
	echo '    var WebBrowser = \'<object id="WebBrowser1" width=0 height=0 classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>\';'.PHP_EOL;
	echo 'document.body.insertAdjacentHTML(\'beforeEnd\', WebBrowser);'.PHP_EOL;
	echo '    WebBrowser1.ExecWB(6, 2);//Use a 1 vs. a 2 for a prompting dialog box    WebBrowser1.outerHTML = "";'.PHP_EOL;
	echo '}'.PHP_EOL;
	echo '}'.PHP_EOL;
	echo '//]]>'.PHP_EOL;
	echo '</script>'.PHP_EOL;
	echo '	<table align ="center" border="1" width="640">'.PHP_EOL;
	echo '		<tr><td>'.PHP_EOL;
	echo '			<blockquote>'.PHP_EOL;
	//echo '			<img src="images/'.$site_logo.'" border="0" alt="" /><br /><br />'.PHP_EOL;
	echo '			<h2 style="margin: 0pt;">'.$mypage['title'].'</h2>'.PHP_EOL;
	if (!empty($mypage['subtitle'])) {
		echo '			<h3 style="margin: 0pt;">'.$mypage['subtitle'].'</h3>'.PHP_EOL;
	}
	echo '<br />';
	if (!empty($mypage['page_header'])) {
		echo '			<span class="content">'.$mypage['page_header'].'<br /><br />'.PHP_EOL;
	}
	echo '			'.$mypage['text'].'<br /><br />'.PHP_EOL;
	if (!empty($mypage['page_footer'])) {
		echo '			'.$mypage['page_footer'].'<br /><br />'.PHP_EOL;
	}
	if (!empty($mypage['signature'])) {
		echo '			'.$mypage['signature'].'<br /><br />'.PHP_EOL;
	}
	echo '			</span>'.PHP_EOL;
	echo '			</blockquote>'.PHP_EOL;
	echo '		</td></tr>'.PHP_EOL;
	echo '	</table><br /><br />'.PHP_EOL;
	echo '	<center><span class="content">'._CP_COMESFROM.'<br />'.PHP_EOL;
	echo '	<strong>'.$sitename.'</strong><br />'.PHP_EOL;
	echo '	<a href="'.$nukeurl.'">'.$nukeurl.'</a><br /><br />'.PHP_EOL;
	echo '	'._CP_THEURL.'<br />'.PHP_EOL;
	echo '	<a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'</a>'.PHP_EOL;
	echo '	</span></center>'.PHP_EOL;
	echo '</body>'.PHP_EOL;
	echo '</html>'.PHP_EOL;
}

function PrintPDF($pid) {
global $site_logo, $nukeurl, $sitename, $datetime, $prefix, $db, $module_name;
	$pid = intval($pid);
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE pid=\''.$pid.'\' AND active=\'1\'');
	$mypage = $db->sql_fetchrow($result);
	$myactive = intval($mypage['active']);
	$mytitle = stripslashes(check_html($mypage['title'], 'nohtml'));
	$mysubtitle = stripslashes(check_html($mypage['subtitle'], 'nohtml'));
	$mypage_header = stripslashes($mypage['page_header']);
	$mytext = stripslashes($mypage['text']);
	//$mytext = preg_replace("<!--pagebreak-->", "<br /><br />", $mytext);
	$mytext = str_replace('[--pagebreak--]', '<br /><br />', $mytext);
	$mypage_footer = stripslashes($mypage['page_footer']);
	$mysignature = stripslashes($mypage['signature']);
	$mydate = $mypage['date'];
	$mycounter = intval($mypage['counter']);
	$myuname = $mypage['uname'];
	$db->sql_freeresult($result);
	$db->sql_query('UPDATE '.$prefix.'_pages SET counter=counter+1 WHERE pid=\''.$pid.'\'');

	$html = '<strong>'.$mytitle.'</strong><br />'.$mysubtitle.'<br /><br />';
	If (!empty($mypage_header)) {
		$html .= $mypage_header.'<br /><br />';
	}
	$html .= $mytext.'<br /><br />';
	if (!empty($mypage_footer)) {
		$html .= $mypage_footer.'<br /><br />';
	}
	if (!empty($mysignature)) {
		$html .= $mysignature.'<br /><br />';
	}
	$html.= '<strong>'._CP_COMESFROM.'</strong><br />';
	$html.= $sitename.':<br />';
	$html.= '<a href="'.$nukeurl.'">'.$nukeurl.'</a><br /><br />';
	$html.= '<strong>'._CP_THEURL.'</strong><br />';
	$html.= '<a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$nukeurl.'/modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'</a>';

	//Make it compatible with UTF-8
	if(strcasecmp(_CHARSET, 'utf-8') == 0) {
		$html=utf8_decode($html);
	}

	define('RELATIVE_PATH','modules/'.$module_name.'/var/fpdf/');
	define('FPDF_FONTPATH',RELATIVE_PATH.'font/');
	require_once(RELATIVE_PATH.'html2fpdf.php');

	//Initialize class
	$pdf=new HTML2FPDF($orientation='P',$unit='mm',$format='A4');
	$pdf->Open();
	$pdf->SetTitle($mytitle);
	$pdf->SetAuthor($myuname.' ('.$sitename.')');
	$pdf->setBasePath($nukeurl);
	/*$pdf->UseCSS($opt=TRUE);*/
	/*$pdf->ReadCSS($html);*/
	//$pdf->readInlineCSS($html);
	//$pdf->DisableTags();
	$pdf->AddPage();
	$pdf->WriteHTML($html);
	$pdf->Output('content.pdf','I');
}

function add_page() {
    global $prefix, $db, $language, $multilingual, $bgcolor2, $sitename, $admin, $module_name, $user, $anonymous, $cookie, $user_prefix, $currentlang;
	global $nukeurl,$adminmail;

	if (isset($_POST['save'])) {$save = $_POST['save'];} else {$save='';}
	if (isset($_POST['cid'])) {$cid = intval($_POST['cid']);} else {$cid='';}
    if (isset($_POST['title'])) {$title = stripslashes(FixQuotes(check_html($_POST['title'], 'nohtml')));} else {$title='';}
    if (isset($_POST['subtitle'])) {$subtitle = stripslashes(FixQuotes(check_html($_POST['subtitle'], 'nohtml')));} else {$subtitle='';}
    if (isset($_POST['tags'])) {$tags = stripslashes(FixQuotes(check_html($_POST['tags'], 'nohtml')));} else {$tags='';}
    if (isset($_POST['page_header'])) {$page_header = stripslashes(FixQuotes(check_html(urldecode($_POST['page_header']), '')));} else {$page_header='';}
    if (isset($_POST['text'])) {$text = stripslashes(FixQuotes(check_html(urldecode($_POST['text']), '')));} else {$text='';}
    if (isset($_POST['page_footer'])) {$page_footer = stripslashes(FixQuotes(check_html(urldecode($_POST['page_footer']), '')));} else {$page_footer='';}
    if (isset($_POST['signature'])) {$signature = stripslashes(FixQuotes(check_html(urldecode($_POST['signature']), '')));} else {$signature='';}
    if (isset($_POST['clanguage'])) {$clanguage = stripslashes(FixQuotes(check_html($_POST['clanguage'], 'nohtml')));} else {$clanguage='';}
    if (isset($_POST['uname'])) {$uname = stripslashes(FixQuotes(check_html($_POST['uname'], 'nohtml')));} else {$uname='';}

	if (!empty($save)) {
		$error = 0;
		if(empty($title) || empty($text)) {$error=1;}
		if($error) {
			echo '<div style="text-align: center;"><strong>ERROR</strong>: '._CP_CPADDERROR.'<br /><br />'.PHP_EOL;
			echo _CP_GOBACK.'</div><br />'.PHP_EOL;
		} else {
			$db->sql_query('INSERT INTO '.$prefix.'_newpages values(NULL, \''.$cid.'\', \''.$title.'\', \''.$subtitle.'\', \''.$tags.'\', \''.$page_header.'\', \''.$text.'\', \''.$page_footer.'\', \''.$signature.'\', \''.$uname.'\', now(), \''.$clanguage.'\')');
			$cmsg = _CP_THECUSER.' '.$uname.' ';
			$cmsg.= _CP_NEWPAGEWAITING.' ';
			$cmsg.= _CP_CTITLED.' '.$title.''.PHP_EOL;
			$cmsg.= _CP_CGOTO.' '.$nukeurl.'';
			$mailheaders  = 'From: '.$sitename.' <'.$adminmail.'>'.PHP_EOL;
			if (defined('PNM_IS_ACTIVE')) {
				phpnukemail($adminmail, $title, $cmsg, $adminmail, $sitename);
			} elseif(defined('TNML_IS_ACTIVE')) {
				tnml_fMailer($adminmail, $title, $cmsg, $adminmail, $sitename);
			} else {
				mail($adminmail, $title, $cmsg, $mailheaders);
			}
			include_once('header.php');
			cpheader();
			OpenTable();
			echo '<br /><div style="text-align: center;">'._CP_TTHANKS.' <strong>'.$uname.'</strong><br />'.PHP_EOL;
			echo _CP_EDITORWILLLOOK.'<br /><br />'.PHP_EOL;
			echo '[ <a href="modules.php?name='.$module_name.'">'._CP_CBACK.'</a> ]<br /></div>'.PHP_EOL;
			CloseTable();
			include_once('footer.php');
		}
	} elseif (is_user($user) || is_admin($admin)) {
    	include_once('header.php');
    	cpheader();
		OpenTable();
		echo '<div style="text-align: center;"><strong>'._CP_ADDNEWPAGE.'</strong></div><br />'.PHP_EOL;
		echo '<form action="modules.php?name='.$module_name.'&amp;pa=preview_page" method="post">'.PHP_EOL;
		if (is_user($user)) {
			echo '<strong>'._CP_USERNAME.':</strong>'.PHP_EOL;
			cookiedecode($user);
			echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$cookie[1].'">'.$cookie[1].'</a>&nbsp;'.PHP_EOL;
			echo '<span class="content">[ <a href="modules.php?name=Your_Account&amp;op=logout">'._CP_LOGOUT.'</a> ]</span>'.PHP_EOL;
		} /*else {
			if (!is_admin($admin)) {
				echo $anonymous.' <span class="content">[ <a href="modules.php?name=Your_Account&amp;op=new_user">'._CP_NEWUSER.'</a> ]</span>'.PHP_EOL;
			}
		}*/
		echo '<br /><br />'.PHP_EOL;
		echo '<strong>'._CP_TITLE.':</strong><br />'.PHP_EOL;
		echo '<input type="text" name="title" size="50" value="'.$title.'" /><br /><br />'.PHP_EOL;
		echo '<strong>'._CP_CSUBTITLE.':</strong><br />'.PHP_EOL;
		echo '<input type="text" name="subtitle" size="50" value="'.$subtitle.'" /><br /><br />'.PHP_EOL;
		echo '<strong>'._CP_TAGS.':</strong><br />'.PHP_EOL;
		echo '<input type="text" name="tags" size="50" value="'.$tags.'" /><br /><br />'.PHP_EOL;
		echo '<strong>'._CP_CATEGORY.':</strong> <select name="cat">'.PHP_EOL;
		echo '<option value="0" selected="selected">'._CP_NONE.'</option>'.PHP_EOL;
    	$result2 = $db->sql_query('SELECT cid, title FROM '.$prefix.'_pages_categories ORDER BY cid');
   		while ($row2 = $db->sql_fetchrow($result2)) {
			$cid2 = $row2['cid'];
			$cid2 = intval($cid2);
			$ctitle2 = $row2['title'];
			echo '<option value="'.$cid2.'">'.$ctitle2.'</option>'.PHP_EOL;
    	}
    	echo '</select><br /><br />';
		echo '<strong>'._CP_HEADERTEXT.':</strong><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('page_header', ''.$page_header.'', 'NukeUser', '75', '10');
		} else {
			echo '<textarea name="page_header" cols="75" rows="10">'.$page_header.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<strong>'._CP_PAGETEXT.':</strong><br />'.PHP_EOL;
		echo '<span class="tiny">'._CP_PAGEBREAK.'</span><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('text', ''.$text.'', 'NukeUser', '75', '20');
		} else {
			echo '<textarea name="text" cols="75" rows="20">'.$text.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<strong>'._CP_FOOTERTEXT.':</strong><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('page_footer', ''.$page_footer.'', 'NukeUser', '75', '10');
		} else {
			echo '<textarea name="page_footer" cols="75" rows="10">'.$page_footer.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		echo '<strong>'._CP_SIGNATURE.':</strong><br />'.PHP_EOL;
		if (function_exists('wysiwyg_textarea')) {
			wysiwyg_textarea('signature', ''.$signature.'', 'NukeUser', '75', '10');
		} else {
			echo '<textarea name="signature" cols="75" rows="10">'.$signature.'</textarea>'.PHP_EOL;
		}
		echo '<br /><br />'.PHP_EOL;
		if(is_user($user)) {
			echo '<input type="hidden" name="uname" value="'.$cookie[1].'" />'.PHP_EOL;
		} else {
			echo '<input type="hidden" name="uname" value="" />'.PHP_EOL;
		}
		echo '<input type="hidden" name="cid2" value="'.$cid2.'" />'.PHP_EOL;
		//echo '<input type="hidden" name="date" value="$date" />'.PHP_EOL;
		if ($multilingual == 1) {
        	echo '<strong>'._CP_LANGUAGE.': </strong><br />'.PHP_EOL;
     	  	echo '<select name="clanguage">'.PHP_EOL;
        	$handle=opendir('language');
        	$languageslist = '';
        	while ($file = readdir($handle)) {
            	if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
                	$langFound = $matches[1];
                	$languageslist.= $langFound.' ';
            	}
        	}
        	closedir($handle);
        	$languageslist = explode(' ', $languageslist);
        	sort($languageslist);
        	for ($i=0; $i < sizeof($languageslist); $i++) {
            	if(!empty($languageslist[$i])) {
            	echo '<option value="'.$languageslist[$i].'"';
           	 	if($languageslist[$i]==$currentlang) echo ' selected="selected"';
            	echo '>'.ucfirst($languageslist[$i]).'</option>'.PHP_EOL;
            	}
        	}
        	echo '</select>'.PHP_EOL;
    	} else {
			echo '<input type="hidden" name="clanguage" value="'.$language.'" />'.PHP_EOL;
   		}
    	//echo '<input type="hidden" name="pa" value="preview_page" />'.PHP_EOL;
		echo '<center><input type="submit" value="'._CP_PREVIEW.'" /></center>'.PHP_EOL;
		echo '</form><br /><br />'.PHP_EOL;
		CloseTable();
    	include_once('footer.php');
	} else {
		include_once('header.php');
		cpheader();
		OpenTable();
		echo '<div style="text-align: center;">'.PHP_EOL;
		echo _CP_CNOANONPOST.PHP_EOL;
		echo '<br /><br />'.PHP_EOL;
		echo '<a href="modules.php?name=Your_Account&amp;op=new_user">'._CP_CREGISTER.'</a>'.PHP_EOL;
		echo '</div>'.PHP_EOL;
		CloseTable();
		include_once('footer.php');
	}
}

function preview_page() {
global $admin, $multilingual, $module_name, $prefix, $db;

    $cat = intval($_POST['cat']);
    $title = stripslashes(FixQuotes(check_html($_POST['title'], 'nohtml')));
    $subtitle = stripslashes(FixQuotes(check_html($_POST['subtitle'], 'nohtml')));
    $tags = stripslashes(FixQuotes(check_html($_POST['tags'], 'nohtml')));
    $page_header = stripslashes(FixQuotes(check_html($_POST['page_header'], '')));
    $text = stripslashes(FixQuotes(check_html($_POST['text'], '')));
    $page_footer = stripslashes(FixQuotes(check_html($_POST['page_footer'], '')));
    $signature = stripslashes(FixQuotes(check_html($_POST['signature'], '')));
    $clanguage = stripslashes(FixQuotes(check_html($_POST['clanguage'], 'nohtml')));
    $uname = stripslashes(FixQuotes(check_html($_POST['uname'], 'nohtml')));
	$error = 0;

	if(empty($title) || empty($text)) {$error=1;}
    include_once('header.php');
    cpheader();
    OpenTable();
    $html = '<h2 style="margin: 0pt;">'.$title.'</h2>';
    $html.= '<h3 style="margin: 0pt;">'.$subtitle.'</h3><br />'.PHP_EOL;
	If (!empty($page_header)) {
		$html.= $page_header.'<br /><br />'.PHP_EOL;
	}
	if (!empty($text)) {
		$html.= $text.'<br /><br />'.PHP_EOL;
	}
	if (!empty($page_footer)) {
		$html.= $page_footer.'<br /><br />'.PHP_EOL;
	}
	if (!empty($signature)) {
		$html.= $signature.'<br /><br />'.PHP_EOL;
	}

	if($error) {
		echo '<div style="text-align: center;"><strong>ERROR</strong>: '._CP_CPADDERROR.'<br /><br />'.PHP_EOL;
		echo _CP_GOBACK.'</div><br />'.PHP_EOL;
	} else {
		echo $html;
		echo '<strong>'._CP_CPISFINE.'</strong><br /><br />'.PHP_EOL;
		echo '<form action="modules.php?name='.$module_name.'&amp;pa=add_page" method="post">'.PHP_EOL;
		echo '<input type="submit" name="save" value="'._CP_YES.'" />&nbsp;&nbsp;'.PHP_EOL;
		echo '<input type="submit" name="edit" value="'._CP_NO.'" />'.PHP_EOL;
		echo '<input type="hidden" name="title" value="'.$title.'" />'.PHP_EOL;
		echo '<input type="hidden" name="subtitle" value="'.$subtitle.'" />'.PHP_EOL;
		echo '<input type="hidden" name="tags" value="'.$tags.'" />'.PHP_EOL;
		echo '<input type="hidden" name="page_header" value="'.urlencode($page_header).'" />'.PHP_EOL;
		echo '<input type="hidden" name="text" value="'.urlencode($text).'" />'.PHP_EOL;
		echo '<input type="hidden" name="page_footer" value="'.urlencode($page_footer).'" />'.PHP_EOL;
		echo '<input type="hidden" name="signature" value="'.urlencode($signature).'" />'.PHP_EOL;
		echo '<input type="hidden" name="uname" value="'.$uname.'" />'.PHP_EOL;
		echo '<input type="hidden" name="cid" value="'.$cat.'" />'.PHP_EOL;
		echo '<input type="hidden" name="clanguage" value="'.$clanguage.'" />'.PHP_EOL;
		echo '</form>'.PHP_EOL;
	}
    CloseTable();
    include_once('footer.php');
}

function Tag2Link($tags, $mod) {
	$tags = explode(',', $tags);
	$link = '';
	$count = 0;
	$tagcount = count($tags);

	foreach($tags as $taglink) {
		$count++;
		$taglink = trim($taglink);
		$link.= '<a href="modules.php?name='.$mod.'&amp;pa=browse_tag&amp;tag='.urlencode($taglink).'">'.ucwords($taglink).'</a>';
		if ($count==$tagcount) {$link.= PHP_EOL;} else {$link.= ', '.PHP_EOL;}
	}

	return $link;
}

function BrowseTags() {
global $db, $prefix, $module_name;
	include_once('header.php');
	cpheader();
	OpenTable();
	echo '<blockquote style="text-align: center;">'.PHP_EOL;

	include_once('modules/'.$module_name.'/var/wordcloud.class.php');

	$cloud = new wordCloud();
	$result = $db->sql_query('SELECT tags FROM '.$prefix.'_pages');
	if ($result) {
		while ($row = $db->sql_fetchrow($result)) {
			$getTags = explode(',', $row['tags']);
			foreach ($getTags as $key => $value) {
				$value = trim($value);
				$cloud->addWord($value);
			}
		}
	}
	$myCloud = $cloud->showCloud('array');
	asort($myCloud);
	if (is_array($myCloud)) {
		foreach ($myCloud as $key => $value) {
			echo ' <a href="modules.php?name='.$module_name.'&amp;pa=browse_tag&amp;tag='.urlencode($value['word']).'" style="font-size: 1.'.$value['range'].'em">'.ucwords($value['word']).'</a> &nbsp;'.PHP_EOL;
		}
	}
	echo '</blockquote>'.PHP_EOL;
	CloseTable();
	include_once('footer.php');
}

function BrowseTag($tag, $order, $ofsbgn, $ofsppg) {
global $db, $prefix, $module_name, $bgcolor4, $multilingual, $admin_file, $admin;

	for($i=0; $i<=6; $i++) {
		$selected[$i]='';
	}

	if(!empty($order)) {
		if($order=='1') {$orderby='date DESC'; $selected[1]='selected="selected"';}
		if($order=='2') {$orderby='date ASC'; $selected[2]='selected="selected"';}
		if($order=='3') {$orderby='title ASC'; $selected[3]='selected="selected"';}
		if($order=='4') {$orderby='title DESC'; $selected[4]='selected="selected"';}
		if($order=='5') {$orderby='counter DESC'; $selected[5]='selected="selected"';}
		if($order=='6') {$orderby='counter ASC'; $selected[6]='selected="selected"';}
	} else {$orderby='title ASC';}

	include_once('header.php');
	cpheader();
	OpenTable();
	echo '<h2 style="text-align: center;">'.$tag.'</h2>'.PHP_EOL;
	echo '<script type="text/javascript" language="javascript">'.PHP_EOL;
	echo '	function cp_GoTo(url){location.href = url;}'.PHP_EOL;
	echo '</script>'.PHP_EOL;
	echo '<table width="100%" align="center" cellpadding="4" cellspacing="1" border="0">'.PHP_EOL;
	echo '	<tr>'.PHP_EOL;
	echo '		<td width="80%" align="right" colspan="2"><strong>'._CP_SORTBY.'</strong>'.PHP_EOL;
	echo '			<form action="" style="display: inline;"><select onchange="cp_GoTo(this.value)">'.PHP_EOL;
	echo '				<option value="#" >'._CP_SELECT.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=1" '.$selected[1].'>'._CP_DATEDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=2" '.$selected[2].'>'._CP_DATEASC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=3" '.$selected[3].'>'._CP_TITLEASC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=4" '.$selected[4].'>'._CP_TITLEDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=5" '.$selected[5].'>'._CP_COUNTERDESC.'</option>'.PHP_EOL;
	echo '				<option value="modules.php?name='.$module_name.'&amp;pa=BrowseTag&amp;tag='.$tag.'&amp;order=6" '.$selected[6].'>'._CP_COUNTERASC.'</option>'.PHP_EOL;
	echo '			</select></form>'.PHP_EOL;
	echo '		</td>'.PHP_EOL;
	echo '	</tr>'.PHP_EOL;

	$result = $db->sql_query('SELECT * FROM '.$prefix.'_pages WHERE (tags like \'%'.$tag.'%\') ORDER BY '.$orderby.' LIMIT '.$ofsbgn.','.$ofsppg.'');
	while($row = $db->sql_fetchrow($result)) {
		$pid = intval($row['pid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$subtitle = stripslashes(check_html($row['subtitle'], 'nohtml'));
		$clanguage = $row['clanguage'];
		$counter = $row['counter'];
		$date = $row['date'];
		if ($multilingual == 1) {
			$the_lang = '<img src="images/language/flag-'.$clanguage.'.png" hspace="3" border="0" height="10" width="20" alt="" />';
		} else {
			$the_lang = '';
		}
		if (!empty($subtitle)) {
			$subtitle = ' ('.$subtitle.')';
		} else {
    	    $subtitle = '';
		}
		if (is_admin($admin)) {
			echo '<tr bgcolor="'.$bgcolor4.'">'.PHP_EOL;
			echo '<td width="80%"><strong><big>&middot;</big></strong> '.$the_lang.'&nbsp;'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.''.PHP_EOL;
			newcontentgraphic($date);
			popgraphic($counter);
			echo '</td>'.PHP_EOL;
			echo '<td><center><a href="'.$admin_file.'.php?op=CPEdit&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/paper&amp;pencil_48.png" width="24" height="24" alt="'._CP_EDIT.'" title="'._CP_EDIT.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="'.$admin_file.'.php?op=CPChangeStatus&amp;pid='.$pid.'&amp;active=1">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/gtk-preferences.png" width="24" height="24" alt="'._CP_DEACTIVATE.'" title="'._CP_DEACTIVATE.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="'.$admin_file.'.php?op=CPDelete&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/cancel_48.png" width="24" height="24" alt="'._CP_DELETE.'" title="'._CP_DELETE.'" border="0" /></a></center></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
		} else {
			echo '<tr bgcolor="'.$bgcolor4.'">'.PHP_EOL;
			echo '<td width="85%"><big><strong>&middot;</strong></big> '.$the_lang.'&nbsp;'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=showpage&amp;pid='.$pid.'">'.$title.'</a> '.$subtitle.PHP_EOL;
			newcontentgraphic($date);
			popgraphic($counter);
			echo '</td>'.PHP_EOL;
			echo '<td width="15%"><center><a href="modules.php?name='.$module_name.'&amp;pa=print_page&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/printer_48.png" width="24" height="24" alt="'._CP_PRINTER.'" title="'._CP_PRINTER.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=print_pdf&amp;pid='.$pid.'" target="_blank">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/application-pdf.png" width="24" height="24" alt="'._CP_PRINTPDF.'" title="'._CP_PRINTPDF.'" border="0" /></a>'.PHP_EOL;
			echo '<a href="modules.php?name='.$module_name.'&amp;pa=share_page&amp;op=FriendSend&amp;pid='.$pid.'">'.PHP_EOL;
			echo '<img src="modules/'.$module_name.'/images/icons/mail_48.png" width="24" height="24" alt="'._CP_SHARE.'" title="'._CP_SHARE.'" border="0" /></a></center></td>'.PHP_EOL;
			echo '</tr>'.PHP_EOL;
		}
    }
    echo '</table>'.PHP_EOL;

	cp_pagination($ofsbgn, $ofsppg);
	CloseTable();
	include_once('footer.php');
}
?>