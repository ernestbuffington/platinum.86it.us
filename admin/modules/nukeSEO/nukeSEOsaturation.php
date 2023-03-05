<?php
#########################################################################
# nukeSEO Copyright (c) 2005 Kevin Guske              http://nukeSEO.com
# Meta Tag function developed by Jens Hauge           http://visayas.dk
# Sitemap object approach from mSearch by David Karn  http://webdever.net
# Submit Sitemap from phpSitemapNG by Tobias Kluge    http://enarion.net
# Results originally developed by Curve2 Design       http://curve2.com
#########################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
#########################################################################

if(!defined('ADMIN_FILE')) { header("Location: ../../../index.php");  die(); }

$pagetitle = _SEO_NUKESEO.": "._SEO_MENU;
include_once("header.php");
title($pagetitle);
OpenTable();
//OpenMenu();
nukeSEOmenu();
//CloseMenu();
global $nukeurl;

require_once("admin/modules/nukeSEO/nukeSEOfunctions.php");

if($_POST[submit]) {
	$data = array();
	
	$target = trim(preg_replace('#http://#i', '', $_POST[target])); 
	
	// check Google
	$source = 'http://www.google.com/search?hl=en&lr=&q=site%3A'.$target.'&btnG=Search';
	$data['Google'] = array(fetchCount($source, 'of about', 9, 'from', 'did not match any documents'), $source);
	
	// check Yahoo!
#	$source = 'http://search.yahoo.com/search?p=site%3A'.$target.'&ei=UTF-8&fr=FP-tab-web-t&fl=0&x=wrt';
	$source = 'http://siteexplorer.search.yahoo.com/search?ei=UTF-8&p='.$target.'&bwm=p&bwmf=a&bwms=p&searchbwm=Explore+URL';
#	$data['Yahoo!'] = array(fetchCount($source, 'of about', 9, 'for', "we didn't find any web pages"), $source);
	$data['Yahoo!'] = array(fetchCount($source, 'of about', 9, '-', "we didn't find any web pages"), $source);
	
	// check MSN Search
	$source = 'http://search.msn.com/results.aspx?q=site%3A'.$target.'&FORM=QBNO';
	$data['MSN Search'] = array(fetchCount($source, 'web results1-', 18, 'results', "couldn't find any sites containing"), $source);
	
	// check AlltheWeb
	$source = 'http://www.alltheweb.com/search?cat=web&cs=utf8&q='.$target.'+domain%3A'.$target.'&rys=0&_sb_lang=any';
	$data['AlltheWeb'] = array(fetchCount($source, 'audio1 -', 14, 'results for', "no web pages found that match your query"), $source);
	
	// check HotBot
//	$source = 'http://www.hotbot.com/adv.asp?query='.$target.'&loc=searchbox&tab=web&provKey=Inktomi&prov=HotBot&dfi='.$target.'&wfc=2';
//	$data['HotBot'] = array(fetchCount($source, 'results 1 -', 17, ')', "your search had no web results"), $source);
	
	// check AltaVista
	$source = 'http://www.altavista.com/web/results?itag=wrx&q=site%3A'.$target.'&kgs=0&kls=0';
	$data['AltaVista'] = array(fetchCount($source, 'altavista found', 15, 'results', "we found 0 results"), $source);
	
//	$source = 'http://search.lycos.com/default.asp?adf=&query=site%3A'.$target.'&submit.x=0&submit.y=0&submit=image';
//	$data['Lycos'] = array(fetchCount($source, 'results 1 thru', 20, '(', "there are no web results for this search term"), $source);
} else {
	$target = $nukeurl;
}
?>

<div>
	<form action='<?php echo $_SERVER[PHP_SELF]; ?>' method='post'>
	<table width='300' border='0' cellpadding='3' cellspacing='0' align="center">
		<tr><td align='center' colspan='2'><strong><?php echo ""._SEO_SATURATION_HDR."" ?></strong></td></tr>
		<tr>
			<td>
				<label for='target'><?php echo ""._SEO_WEBURL.""; ?></label>
			</td>
			<td>
				<input type='text' name='target' id='target' value='<?php echo $target; ?>' style='width:200px;'/>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type='submit' value='Submit'/>
			</td>
		</tr>
	</table>
	<?php
	// display data summary
	if($data) {
		echo "<br/><table width='300' border='0' cellpadding='3' cellspacing='0' align=\"center\">";
		echo "<tr><td><strong>"._SEO_SEARCHENGINE."</strong></td><td align='right'><strong>"._SEO_INDEXEDPAGES."</strong></td></tr>";
		foreach($data as $engine => $result) {
			echo "<tr><td><a href='$result[1]' target='_blank'>$engine</a></td><td align='right'>";
			if($result[0])
				echo $result[0];
			else
				echo ""._SEO_NOTAVAIL."";
			echo '</td></tr>';
			$total += preg_replace("#[[:punct:]]#", '', $result[0]);
		}
		echo "<tr><td><strong>Total</strong></td><td align='right'><strong>$total</strong></td></tr>";
		echo '</table>';
	}
	?>
	<input type='hidden' name='submit' value='true'/>
	<input type='hidden' name="op" value="<?php echo $op; ?>"/>
	</form>
	<br/>
	<div align="center">Enhanced for nukeSEO from <a href='http://www.curve2.com'>Search Engine Index Report by Curve2 Design</a></div>
</div>
<?php
CloseTable();
include_once("footer.php");
?>
