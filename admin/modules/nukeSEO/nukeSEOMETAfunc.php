<?
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

function read_metafile() 
{
  global $metafilename,$backupfilename, $lines, $MetaTag, $linesPRE, $linesPOST;
  
  $fp = fopen("$metafilename", "r");
  $buf = "";
  if (!$fp) 
  {	echo "Error opening META file \n";
  } else {
  	$readsize = filesize("$metafilename");
	$buf .= fread($fp, $readsize); // Reads all in one chunk
	fclose($fp);
  }
   
  $lines = explode("\n",$buf);
  unset($buf);  //free memory
   
  // find MetaData
  $no_lines = count($lines);
  $tag = 0; //tag number
  $maxtag= 0;
  for ($i=0;$i<$no_lines;$i++)
  { $temp = $lines[$i];
    $str = "%s<%s>%s";  //this finds what is between < and > and place it in match[2]
    if( preg_match( sprintf( "#$str#", '(.+)', '(.+)', '(.+)'), $temp, $match))
    { $linesPRE[$tag] = str_replace("echo","%s",$match[1]);
	  $linesPOST[$tag] = str_replace("\\n\";","%s",$match[3]);
      // $match[2] is the content between < and >
      $str = "META%s=%s CONTENT=%s";   // this finds the meta tag elements
      if( preg_match( sprintf( "#$str#", '(.+)', '(.+)', '(.+)'),$match[2] , $match))
      { // match[1] is the meta type (NAME or HTTP-EQUIV)
	  	// match[2] is the name ot the tag (redirect, keywords..)
		// match[3] is the content 
		$MetaTag[LINE][$tag] = $i; //linenumber
		$MetaTag[TYPE][$tag] = trim($match[1]);
		$match[2] = trim($match[2]);
		$match[3] = trim($match[3]);
		//$MetaTag[TYPE][$tag] = substr($match[1],2,strlen($match[1])-4);	
		$MetaTag[NAME][$tag] = substr($match[2],2,strlen($match[2])-4);	
		$MetaTag[CONTENT][$tag] = str_replace("\\\"","\"",substr($match[3],2,strlen($match[3])-4));	
		$temp = $MetaTag[NAME][$tag];
		$MetaTag[$temp] = $tag; 
        $lines[$i] = trim($match[2]);
		$lines[$i] = str_replace($MetaTag[TYPE][$tag],"%s",$lines[$i]);
		$lines[$i] = str_replace($MetaTag[NAME][$tag],"%s",$lines[$i]);
		$lines[$i] = str_replace($MetaTag[CONTENT][$tag],"%s",$lines[$i]);
		$type = trim(str_replace("\\\"","",$match[2]));
		if ((strcmp($type,"GENERATOR"))) {$maxtag = $tag;}
		$tag++;
      }
    } else {
	  $lines[$i] = htmlspecialchars($lines[$i]);
	}
  }
  $MetaTag[TAGS] = $tag; //number of found tags
  $MetaTag[MAXTAG] = $maxtag;
}

function metatag_form()
{
  GLOBAL $module_name, $MetaString, $maxpriorty, $MetaTag, $lines, $selectedWord, $prioritynumber, $linesPRE, $linesPOST, $categories, $keywords,$tagType,$tagName,$tagNameHTTP,$tags, $addtaglevel, $newContent, $currenttag, $nukeurl;

  if (isset($MetaTag[KEYWORDLIST]))
  { $keywords = $MetaTag[KEYWORDLIST];
    $selectedWord = $MetaTag[SELECTEDWORDS];
  } else {
    $tag = $MetaTag[KEYWORDS];
    $keywordstring = $MetaTag[CONTENT][$tag];
	$keywordstring = str_replace(", ",",",$keywordstring);
    $keywords = explode(",",$keywordstring);
  }
  $no_keywords = count($keywords);
  if ($maxpriorty<0) 
  {$maxpriortyForm = $no_keywords +1;} 
  $priorities = $MetaTag[KEYWORDPRIORITY];
   
  for ($i=0;$i<$no_keywords;$i++)
  { // initialize priority to the number in the sequence
    if (!(isset($priorities[$i]))) {
	  if ($i<$maxpriortyForm) {$priorities[$i] = $i;} else {$priorities[$i] = $maxpriortyForm;}
    }
  }
  
  $MetaTag[KEYWORDPRIORITY] = $priorities;  
  $MetaTag[KEYWORDLIST] = $keywords;
  $keywordstring = implode(",",$keywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode
  $MetaString = "<META NAME=\"KEYWORDS\" CONTENT=\"$keywordstring\">";
  $MetaLength = strlen(trim($MetaString));
  $MetaString = htmlspecialchars(trim($MetaString));
  $TagName_filp = array_flip($MetaTag[NAME]);
  
  OpenTable();
  echo "<form method=\"POST\" action=\"admin.php?op=nukeSEOmeta&amp;seofunc=keywordupdate\">";
  OpenTable();
  echo "<center><input type=\"submit\" value=\""._SAVE."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._RESET."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._HELP."\" name=\"submit\" onclick=\"openhelp()\"> "
	. "&nbsp;<a href='http://www.submitexpress.com/cgi-bin/analyzer/meta.pl?url=".$nukeurl."' target='nukeSEO' title='MetaTag Analysis'><img border=0 src='images/nukeSEO/submitexpress.gif' alt='Meta Tag Analysis'></a>&nbsp;"
	. "&nbsp;<a href=\"http://www.nichebot.com/\" title='Discover new keywords your future customers will find you under.'><img SRC=\"images/nukeSEO/nichebot.jpg\" alt='Discover new keywords your future customers will find you under.' BORDER=0></a>&nbsp;"
	. "&nbsp;<a href=\"http://www.submitexpress.com/\" title='Free search engine submission and placement services!'><img SRC=\"http://www.submitexpress.com/submitexpress.gif\" alt='Free search engine submission and placement services!' BORDER=0 height=31 width=88></a>&nbsp;"
  ."</center>";
  CloseTable();
  echo "<table>";
  echo "<tr><td><strong>"._COMMENTED."</strong></td><td><strong>"._TYPE."</strong></td><td><strong>"._NAME."</strong></td><td><strong>"._CONTENT."</strong></td></tr>";
 
  $anyfreetags = false;
  for($i=0 ; $i<count($tagNameHTTP); $i++)
  { // only give unused options
    if (!( array_key_exists($tagNameHTTP[$i],$TagName_filp))) { 
      $anyfreetags = true;
	}
  }
  for($i=0 ; $i<count($tagName); $i++)
  {  // only give unused options
    if (!( array_key_exists($tagName[$i],$TagName_filp))) { 
      $anyfreetags = true;
	}
  }
  
  if (($anyfreetags) & ($addtaglevel<=1))
  { echo "<tr><td><input type=\"checkbox\" name=\"newTagCom\" value=\"X\"></td>"
    ."<td></td>"
    ."<td><select name=\"newTagName\">";
    for($i=0 ; $i<count($tagNameHTTP); $i++)
    {  // only give unused options
      if (!( array_key_exists($tagNameHTTP[$i],$TagName_filp))) { 
        echo "<option value = \"$tagNameHTTP[$i]\">$tagNameHTTP[$i]</option>";
 	  }
    }
    for($i=0 ; $i<count($tagName); $i++)
    { // only give unused options
      if (!( array_key_exists($tagName[$i],$TagName_filp))) { 
        echo "<option value = $tagName[$i]>$tagName[$i]</option>";
	  }
    }
    echo "</select></td>"
    ."<td><input type=\"text\" name=\"newContent\" size=\"50\" />";
    echo "<input type=\"submit\" value=\""._ADDTAG."\" name=\"submit\">";
    echo "</td></tr>";
  }
  // either free format or free when no more known tags
  if (($addtaglevel>1) | ((!($anyfreetags)) & ($addtaglevel=1)  )) {
    echo "<tr><td><input type=\"checkbox\" name=\"newTagCom\" value=\"X\"></td>"
    ."<td><select name=\"newTagType\">";
    for($i=0 ; $i<count($tagType); $i++){
      echo "<option value =\"$tagType[$i]\">$tagType[$i]</option>";
    }
	echo "</select></td>"
    ."<td><input type=\"text\" name=\"newTagName\"></td>"
    ."<td><input type=\"text\" name=\"newContent\" size=\"50\" />";
    echo "<input type=\"submit\" value=\""._ADDTAG."\" name=\"submit\">";
    echo "</td></tr>";
  }
  for ($mkey=0;$mkey<$MetaTag[TAGS];$mkey++)
  { echo "<tr>";
    switch($MetaTag[NAME][$mkey]) {
      default: echo "<td><input type=\"checkbox\" name=\"linesCom[$mkey]]\" value=\"X\"";
	           if (strpos($linesPRE[$mkey],"//")===0) { echo " checked ";}
			   $rows = ceil((strlen($MetaTag[CONTENT][$mkey])/55));
	           echo "></td>";
	           echo "<td>".$MetaTag[TYPE][$mkey]."</td>";
	           echo "<td>".$MetaTag[NAME][$mkey]."</td>";
			   if ($rows>1) {
			     $rows = $rows + 1;
				 $areaname = $MetaTagContent[$mkey];
			   	 echo "<td><textarea rows=\"$rows\" cols=\"50\" name=\"MetaTagContent[$mkey]\">".$MetaTag[CONTENT][$mkey]."</textarea></td>";
			   } else { 
			   	 echo "<td><input type=\"text\" size=\"60\" name=\"MetaTagContent[$mkey]\" value='".$MetaTag[CONTENT][$mkey]."'></td>";
			   }
		       break;
/*      case "DESCRIPTION": echo "<td><input type=checkbox name=linesCom[$line_no] value=X";
	           if (strpos($linesPRE[$mkey],"//")===0) { echo " checked ";}
	           echo "></td>";
               echo "<td>".$MetaTag[TYPE][$mkey]."</td>";
	           echo "<td>".$MetaTag[NAME][$mkey]."</td>";
			   echo "<td><textarea rows=4 cols=50 name=\"description\">".$MetaTag[CONTENT][$mkey]."</textarea></td>";
		       break;
*/			   
	  case "KEYWORDS": 
//	           echo "<td><input type=hidden size=60 name=MetaTagContent[$mkey] value=\"".$MetaTag[CONTENT][$mkey]."\"></td>";
		       echo "<td><input type=\"checkbox\" disabled=\"disabled\" name=\"linesCom[$mkey]\" value=\"X\"></td>";
               echo "<td>".$MetaTag[TYPE][$mkey]."</td>";
	           echo "<td>".$MetaTag[NAME][$mkey]." ";
	           echo "<input type=\"hidden\" size=60 name=\"MetaTagContent[$mkey]\" value='".$MetaTag[CONTENT][$mkey]."'></td>";
			   $rows = ceil((strlen($keywordstring)/55))+1;
	           echo "<td><textarea name=\"showkeywords\" disabled=\"disabled\" rows=\"$rows\" cols=\"50\">$keywordstring</textarea></td>";
	           break;
			   
	  case "GENERATOR": // must not be changed
		       echo "<td><input type=\"checkbox\" disabled=\"disabled\" name=\"linesCom[$mkey]\" value=\"X\"></td>";
               echo "<td>".$MetaTag[TYPE][$mkey]."</td>";
	           echo "<td>".$MetaTag[NAME][$mkey]." ";
	           echo "<input type=\"hidden\" size=\"60\" name=\"MetaTagContent[$mkey]\" value='".$MetaTag[CONTENT][$mkey]."'></td>";
	           echo "<td>".$MetaTag[CONTENT][$mkey]."</td>";
	  	  	   break;  	
    }	
    echo "</tr>";  
  } 
  echo "</table><hr>";  
  echo "<center><h5>"._KEYWORDS."</h5></center>";
    
  echo"<center>"
  ."<input type=\"submit\" value=\""._SELECTALL."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._UNSELECTALL."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._SORTPRIOR."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._SORTALFA."\" name=\"submit\"><br>"
  ."<input type=\"submit\" value=\""._SETLOWERCASE."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._SETUNIQUE."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._DELETESELECTED."\" name=\"submit\">"
  ."</center><br>";
  echo "<center><strong>"._LENGTH.$MetaLength."</strong></center><br>";
  
  echo "<table>"
  ."<tr><td><strong>"._SELECT."</strong></td><td><strong>"._KEYWORD."</strong></td>"
  ."<td><strong>"._PRIORITY."</strong></td></tr>"  
  ."<tr><TD></TD><td><input type=\"text\" name=\"keyword\" maxlength=\"50\"/></td>"
  ."<td><select name=\"prioritynumber\">";
  for($i=0 ; $i<=$maxpriortyForm; $i++){
    echo "<option value = $i> $i  </option>";
  }
  $no_cat = count($categories);
  echo "</select></td>"
  ."<td><input type=\"submit\" value=\""._ADDKEYWORD."\" name=\"submit\"></td>"
  ."<td><select name=\"category\" />";
  for($j=0 ; $j<$no_cat; $j++){
    echo "<option value = $j>$categories[$j]</option>";
  }
  echo "</select></td>"
  ."<td><input type=\"submit\" value=\""._ADDCATEGORY."\" name=\"submit\"></td>"
  ."</tr>";
  if ($no_keywords>0)				
  { for ($i=0;$i<$no_keywords;$i++)
    { $word = $keywords[$i];
      echo "<TR><td><input type=\"checkbox\" name=\"selectedWord[$i]\" value=\"X\"";
	  if ($selectedWord[$i]==X){ echo " checked ";}
	  echo "></td>";
	  echo "<TD><input type=\"text\" name=\"keywords[$i]\" value=\"".$keywords[$i]."\"></Td>"
	  ."<td><select name=\"priorities[$i]\">";
	  for($j=0 ; $j<=$maxpriortyForm; $j++)
	  { echo "<option value = $j ";
		if ($j==$priorities[$i]) echo "selected";
		echo "> $j </option>";
  	  }
	  echo "</select></td><td colspan=2>";
	  echo "<a href='http://www.nichebot.com/analysis/?term=".$keywords[$i]."' target='SassaSEO' title='Keyword Analysis'><img border=0 src='images/nukeSEO/nichebot.jpg' alt='Keyword Analysis'></a>&nbsp;&nbsp;";
	  echo "<a href='http://www.nichebot.com/?term=".$keywords[$i]."' target='SassaSEO' title='Wordtracker Keywords'><img border=0 src='images/nukeSEO/wordtracker.gif' alt='Wordtracker Keywords'></a>&nbsp;&nbsp;";
	  echo "<a href='http://www.nichebot.com/o/?term=".$keywords[$i]."' target='SassaSEO' title='Overture Keywords'><img border=0 src='images/nukeSEO/overture.gif' alt='Overture Keywords'></a>&nbsp;&nbsp;";
	  echo "<a href='admin.php?op=nukeSEOkeyrank&amp;terms=".$keywords[$i]."&amp;target=$nukeurl' target='SassaSEO' title='Rank by Keyword'><img border=0 src='images/nukeSEO/rank.gif' alt='Rank by Keyword'></a>&nbsp;&nbsp;";
	  echo "</td>";
	  echo "</tr>";
	}
  }
  echo "<tr><td>";
  foreach($MetaTag as $mkey => $mval)
  { if (is_array($mval))
	{ foreach($mval as $minnerkey => $minnerval)
	  { if  (is_string($minnerval)) {
  	      echo "<input type=\"hidden\" name=\"MetaTag[$mkey][$minnerkey]\" value=\"$minnerval\" >";
		} else {
  	      echo "<input type=\"hidden\" name=\"MetaTag[$mkey][$minnerkey]\" value=$minnerval >";
		}
	  }
	} else {
      echo "<input type=\"hidden\" name=\"MetaTag[$mkey]\" value=$mval >";
	}
  }
  echo "</td><td>";
  $no_lines = count($lines);
  for ($i=0;$i<$no_lines;$i++) {
    echo "<input type=\"hidden\" name=\"lines[$i]\" value=\"".$lines[$i]."\">";
  }
  for ($i=0;$i<$MetaTag[TAGS];$i++)
  { if (isset($linesPRE[$i]))
    { echo "<input type=\"hidden\" name=\"linesPRE[$i]\" value=\"".$linesPRE[$i]."\">";
      echo "<input type=\"hidden\" name=\"linesPOST[$i]\" value=\"".$linesPOST[$i]."\">";
	}
  }
 
  echo "</td>";  

  echo "</tr></td></table>";

  OpenTable();
  echo "<center><input type=\"submit\" value=\""._SAVE."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._RESET."\" name=\"submit\"> "
  ."<input type=\"submit\" value=\""._HELP."\" name=\"submit\" onclick=\"openhelp()\"> "
  ."</center>";
  CloseTable();
  CloseTable();
  echo "</form>";
}


function update_MetaTag() {
  global $MetaTag, $keywords, $priorities, $MetaTagContent, $selectedWord, $linesPRE, $linesCom;
  $MetaTag[KEYWORDPRIORITY] = $priorities;
  $MetaTag[KEYWORDLIST] = $keywords; 
  $MetaTag[SELECTEDWORDS] = $selectedWord;
  if (get_magic_quotes_gpc()) {$stripslash = true;} else {$stripslash = false;} 

  for ($i=0;$i<$MetaTag[TAGS];$i++){
    $MetaTag[CONTENT][$i] = htmlspecialchars($MetaTagContent[$i],ENT_NOQUOTES);
    if ($stripslash) {
      $MetaTag[CONTENT][$i] = stripslashes($MetaTag[CONTENT][$i]);
    }
	if (isset($linesCom[$i]))
    { if (!(strpos($linesPRE[$i],"//")===0)) {
	    $linesPRE[$i] = "//".$linesPRE[$i];
	  }
	} else {
      if (strpos($linesPRE[$i],"//")===0) {
	    $linesPRE[$i] = str_replace("//","",$linesPRE[$i]);
	  }
	}
  }
  $keywordstring = implode(",",$keywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode 
  $tag = $MetaTag[KEYWORDS];
  $MetaTag[CONTENT][$tag] = $keywordstring;
}


function update_hidden() {
  global $lines;
  $no_lines = count($lines);
  for ($i=0;$i<$no_lines;$i++){
    $lines[$i] = htmlspecialchars($lines[$i]);
  }
}


function delete_selected_keyword()
{
  global $MetaTag;
  $selectedWord = $MetaTag[SELECTEDWORDS];
  $priorities = $MetaTag[KEYWORDPRIORITY];
  $keywords = $MetaTag[KEYWORDLIST];
  if (count($selectedWord)>0)
  { foreach($selectedWord as $mkey => $mval)
    { unset($priorities[$mkey]);
	  unset($keywords[$mkey]);
    }
  }
  unset($selectedWord);
  //reset index
  foreach($keywords as $i => $word) {
    $newkeywords[] = $keywords[$i];
	$newpriorities[] = $priorities[$i];  
  }
  $MetaTag[KEYWORDPRIORITY] = $newpriorities; 
  $MetaTag[KEYWORDLIST] = $newkeywords; 
  $MetaTag[SELECTEDWORDS] = $selectedWord;
}  

  
function add_new_keyword($newkeyword)
{  
  GLOBAL $MetaTag, $prioritynumber, $maxtaglength, $tag_keyword_fill, $error_html;
  if($newkeyword)
  {	$keywords = $MetaTag[KEYWORDLIST];
    $priorities = $MetaTag[KEYWORDPRIORITY]; 
    $keywordstring = implode(",",$keywords);
    $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode

    // Validate the keyword - may not exist already - the errortext is set in the languagefile
    $error = array();
	if (is_string($newkeyword)){
	  $keyword[] = $newkeyword;
	} else {
	  $keyword = $newkeyword;
	}
	$no_key = count($keyword);
	$new_length = 0;
	for ($i=0; $i<$no_key; $i++) 
	{ if (in_array($keyword[$i],$keywords)) {
	    $error[] = $keyword[$i].": ".$error_html[1];
	  }
	  $new_length = $new_length + 1 + strlen($keyword[$i]);
	}
    if ((strlen($keywordstring)+$tag_keyword_fill+$new_length) > $maxtaglength){
	   $error[] = $error_html[2].$maxtaglength;
	}
	
    $no_error = count($error);
 	if($no_error>0)
	{ opentable();echo "<br><strong>"._KEYERR."</strong>";
   	  echo "<blockquote><strong>";
	  for ($i=0;$i<$no_error;$i++){
 	    echo "".$error[$i]."<br>";
	  }
	  echo "</strong></blockquote>";
 	  echo "<a href=\"javascript:history.go(-1)\">"._TRYAGAIN."</a> ";
	  closetable();
 	} else {   
      for ($i=0; $i<$no_key; $i++) { 
        $newpriorities[] = $prioritynumber; // all new get same priority
	  }
      $MetaTag[KEYWORDPRIORITY] = array_merge($newpriorities,$priorities);  
      $MetaTag[KEYWORDLIST] = array_merge($keyword,$keywords);
	}
	unset($error);
  }
}
  

function validate()
{
  GLOBAL $MetaTag, $maxtaglength, $tag_keyword_fill, $warning, $maxdescription, $linesPRE ;

  $error = array();
  $warning = array();
  $keywords = $MetaTag[KEYWORDLIST];
  $priorities = $MetaTag[KEYWORDPRIORITY]; 
  $keywordstring = implode(",",$keywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode

  // length of all Tags less than $maxtaglength+$tag_keyword_fill
  for ($tag=0;$tag<$MetaTag[TAGS];$tag++)
  {	$str = "META %s=\\\"%s\\\" CONTENT=\\\"%s\\\"";
	$text1 = sprintf($linesPRE[$tag],"echo");
	$text2 = sprintf($str,$MetaTag[TYPE][$tag],$MetaTag[NAME][$tag],$MetaTag[CONTENT][$tag]);
	$text3 = sprintf($linesPOST[$tag],"\\n\";");
	$text = $text1."\"<".$text2.">".$text3."";
	if (strlen($text)>($maxtaglength+$tag_keyword_fill)) {
	  // Tag too long!!
	  $error[] = $MetaTag[NAME][$tag]."(".strlen($text).")"._ERROR3.$maxtaglength;
	}
	$MetaName = strtoupper($MetaTag[NAME][$tag]);
	if (!(strpos($linesPRE[$tag],"//")===0)) {$comment = true;} else {$comment= false;}
	switch($MetaName)
	{ default: // no validation coded here!
		   $warning[] = $MetaTag[NAME][$tag]._ERROR13;
	       break;  
	    case "REFRESH": 
		   $content = $MetaTag[CONTENT][$tag];
		   $str = "%s;URL=%s";   // this finds the timedelay and url
           if( preg_match( sprintf( "#$str#", '(.+)', '(.+)'),$content , $match))
		   { $url = $match[2];
		     $delay = $match[1];
             if (!($infile=@fopen($url, "r"))) 
			 { $warning[] = $url._ERROR5;
			   $linesPRE[$tag] = "//".$linesPRE[$tag];
			 }
		     if (!(is_numeric($delay))) {
		       $error[] = _ERROR6.$delay;
		     }
		   } else {
		     $error[] = $MetaTag[NAME][$tag]._ERROR4;
		   }
	       break;
		case "DESCRIPTION":
		   if ((strlen($MetaTag[CONTENT][$tag])) > $maxdescription ) {
	         $error[] = $maxdescription._ERROR7.strlen($MetaTag[CONTENT][$tag]);
		   } 
		   $text = htmlspecialchars($MetaTag[CONTENT][$tag]);
		   $strip = strip_tags($text);
		   if (!(strcmp($MetaTag[CONTENT][$tag],$strip)==0)) {
		     $error[] = _ERROR8;
		   }
		   break;
		case "WINDOW-TARGET":
		   if (!(strcasecmp("_top",$MetaTag[CONTENT][$tag])==0))
		   { $error[] = _ERROR10;
		   }
		   break;
		case "PRAGMA":
		   if (!(strcasecmp("no-cache",$MetaTag[CONTENT][$tag])==0))
		   { $error[] = _ERROR9;
		   }
		   break;
		case "ROBOTS":
		   $temp = strtoupper($MetaTag[CONTENT][$tag]);
		   $content = array();
		   $content = explode(",",$temp);
		   $valid = array("ALL","NONE","INDEX","NOINDEX","FOLLOW","NOFOLLOW");
		   $error_found = false;
		   foreach($content as $i => $word) {
		     if (!(in_array(trim($word),$valid))) 
			 { $error[] = $word._ERROR11;
			   $error_found = true;
			 }
		   }
		   if ($error_found) {
		     $error[] = _ERROR12;
		   }
		   unset($content);
		   break;
		   
	}
  }
	
	
  // STOP in case errors was found
  $no_error = count($error);
  if($no_error>0)
  { opentable();
    echo "<center><strong><h5>"._METAERR."</h5></strong></center>";
    echo "<table bgcolor=#FF8080>";
	for ($i=0;$i<$no_error;$i++){
 	  echo "<tr><td>".$error[$i]."</td>";
	}
	echo "</table>";
	closetable();
  } 
  
  $no_warn = count($warning);
  if($no_warn>0)
  { opentable();
    echo "<center><strong><h5>"._METAWARN."</h5></strong></center>";
	for ($i=0;$i<$no_warn;$i++){
 	  echo "<br>".$warning[$i];
	}
	closetable();
  }

  unset($warning);
  unset($error);
  if ($no_error > 0) {return false;} else {return true;}
}


function sort_keywords_name()
{
  GLOBAL $MetaTag;
  $keywords = $MetaTag[KEYWORDLIST];
  $priorities = $MetaTag[KEYWORDPRIORITY]; 
  asort($keywords);

  foreach($keywords as $i => $word) {
    $newkeywords[] = $keywords[$i];
	$newpriorities[] = $priorities[$i];  
  }
  $MetaTag[KEYWORDLIST] = $newkeywords;
  $MetaTag[KEYWORDPRIORITY] = $newpriorities;
  $keywordstring = implode(",",$newkeywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode 
  $tag = $MetaTag[KEYWORDS];
  $MetaTag[CONTENT][$tag] = $keywordstring;
}  
  

function sort_keywords_priority()
{
  GLOBAL $MetaTag;
  $keywords = $MetaTag[KEYWORDLIST];
  $priorities = $MetaTag[KEYWORDPRIORITY]; 
  asort($priorities);
  //reorder the keywords in same order as priority
  foreach($priorities as $i => $prior) {
    $newkeywords[] = $keywords[$i];
	$newpriorities[] = $priorities[$i];   // or $prior;  
  }
  $MetaTag[KEYWORDLIST] = $newkeywords;
  $MetaTag[KEYWORDPRIORITY] = $newpriorities;
  $keywordstring = implode(",",$newkeywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode 
  $tag = $MetaTag[KEYWORDS];
  $MetaTag[CONTENT][$tag] = $keywordstring;
}  


function lowercase_keywords()
{ // selected keywords are transformed into lowercase
  GLOBAL $MetaTag;
  $selectedWord = $MetaTag[SELECTEDWORDS];
  $keywords = $MetaTag[KEYWORDLIST];
  if (count($selectedWord)>0)
  { foreach($selectedWord as $mkey => $mval)
	{ $word = $keywords[$mkey];
	  $word = strtolower($word);
      $keywords[$mkey] = $word; 
    }
  }

  unset($selectedWord);
  $MetaTag[SELECTEDWORDS] = $selectedWord;
  $MetaTag[KEYWORDLIST] = $keywords;
}  


function unique_keywords()
{
  GLOBAL $MetaTag;
  $keywords = array_unique($MetaTag[KEYWORDLIST]);
  $priorities = $MetaTag[KEYWORDPRIORITY]; 
  // reset index
  foreach($keywords as $i => $word) {
    $newkeywords[] = $keywords[$i];
	$newpriorities[] = $priorities[$i];
  }
 
  $MetaTag[KEYWORDLIST] = $newkeywords;
  $MetaTag[KEYWORDPRIORITY] = $newpriorities;
  $keywordstring = implode(",",$newkeywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode 
  $tag = $MetaTag[KEYWORDS];
  $MetaTag[CONTENT][$tag] = $keywordstring;
}  

function unique_case_keywords()
{
  GLOBAL $MetaTag;

  $keywordstemp = $MetaTag[KEYWORDLIST];
  $keywords = $MetaTag[KEYWORDLIST];
  foreach($keywordstemp as $i => $word) {
    $keywordstemp[$i] = strtolower($word);
  }
  $keywordstemp = array_unique($keywordstemp);
  $priorities = $MetaTag[KEYWORDPRIORITY]; 
  // reset index
  foreach($keywordstemp as $i => $word) {
    $newkeywords[] = $keywords[$i];
	$newpriorities[] = $priorities[$i];
  }
 
  $MetaTag[KEYWORDLIST] = $newkeywords;
  $MetaTag[KEYWORDPRIORITY] = $newpriorities;
  $keywordstring = implode(",",$newkeywords);
  $keywordstring = str_replace(", ",",",$keywordstring); // remove spaces added by implode 
  $tag = $MetaTag[KEYWORDS];
  $MetaTag[CONTENT][$tag] = $keywordstring;
}  


function select_all()
{
  GLOBAL $MetaTag;
  $keywords = $MetaTag[KEYWORDLIST];
  foreach($keywords as $mkey => $word) {
    $selectedWord[$mkey] = "X"; 
  }
  $MetaTag[SELECTEDWORDS] = $selectedWord; 
}


function deselect_all()
{
  GLOBAL $MetaTag;
  unset($MetaTag[SELECTEDWORDS]); 
}


function save_file()
{
  global $MetaTag, $lines, $metafilename, $backupfilename, $linesPRE, $linesPOST;
  if (!(copy($metafilename,$backupfilename) ))
  {	opentable();
    echo "<br><strong>"._SAVEERR."</strong>";
    echo "<blockquote><strong>";
 	echo _BACKUPFAILED."<br>";
	echo "</strong></blockquote>";
    echo "<a href=\"javascript:history.go(-1)\">"._TRYAGAIN."</a> ";
	closetable();
  } else {
    $buf = implode("",$lines);
	// check if  _METATAGCOPYRIGHT exist
	if (!(strpos($buf,_METATAGCOPYRIGHT)===false)) {
	  $MetaTagCop = true;
	} else {
	  $MetaTagCop = false;
	}
	$attime = date("d-M-y H:i:s");
	
    $no_lines = count($lines);
    $tagLines = array_flip($MetaTag[LINE]);
	$linesout = array();
    for ($i=0;$i<$no_lines;$i++)
	{ $tag = $tagLines[$i];
	  if (isset($linesPRE[$tag]))
	  {	$str = "META %s=\\\"%s\\\" CONTENT=\\\"%s\\\"";
		$text1 = sprintf($linesPRE[$tag],"echo");
		// For CONTENT there are
		// two situations to take care of: 1: a variable is concatenated ".variable."
		//                                 2: " are used around text
		$temp = addslashes($MetaTag[CONTENT][$tag]);
		$temp = str_replace("\\\".","\".",$temp);
		$temp = str_replace(".\\\"",".\"",$temp);
		$text2 = sprintf($str,$MetaTag[TYPE][$tag],$MetaTag[NAME][$tag],$temp);
		$text3 = sprintf($linesPOST[$tag],"\\n\";");
		if (!($MetaTag[CONTENT][$tag]=="")){
		  $linesout[] = $text1."\"<".$text2.">".$text3."";
		}
	  } else {
		// make sure _METATAGCOPYRIGHT get in
		if ($MetaTagCop)
		{ if (!(strpos($lines[$i],""._METATAGCOPYRIGHT."")===false)) 
		  { // modify line
			$linesout[] = "/*"._METATAGCOPYRIGHT." at ".$attime."*/";
		  } else {
		  	$linesout[] = str_replace("\\","",$lines[$i]);
		  }
		} else {
		  $linesout[] = str_replace("\\","",$lines[$i]);
	      if (!(strpos($lines[$i],"<?")===false)) 
		  {	// ADD LINE
			$linesout[] = "/*"._METATAGCOPYRIGHT." at ".$attime."*/\n";
		  }
		}
	  }
	}
	$buf = implode("\n",$linesout);
	
	$fb = fopen("$metafilename","w");
    if (!$fb)
	{ opentable();
      echo "<br><strong>"._SAVEERR."</strong>";
      echo "<blockquote><strong>". _METAOPEN.$backupfilename."<br>";
	  echo "</strong></blockquote>";
      echo "<a href=\"javascript:history.go(-1)\">"._TRYAGAIN."</a> ";
	  closetable();
    } else {	 
      fwrite($fb, $buf, strlen($buf));
      fclose($fb);
 	}
	unset($linesout);
  }
}


function get_categories()
{ 
  global $categoriesTables, $categoriesColName, $categoriesWhere, $category, $db, $prefix;
  if (strcmp("",$categoriesWhere[$category])) {
    $sqlWhere = " Where ".$categoriesWhere[$category];
  } else {
    $sqlWhere = "";
  }
  
  $colname = $categoriesColName[$category];
  $sql = "Select ".$colname." from ".$prefix."_".$categoriesTables[$category].$sqlWhere;  
  $keywordsNew = array();
  
  if ($result = $db->sql_query($sql))
  { while ($row = $db->sql_fetchrow($result)) {
	  $newword = $row[$colname];
      $keywordsNew[] = str_replace(","," &",$newword); // comma not allowed in keyword
	}
    add_new_keyword($keywordsNew);
  } else {
    // handle db-error
	opentable();
    $error = $db->sql_error();
	$errorstring = $error[message]." : ".$error[code];
    echo "<br><strong>"._DBERR."</strong>";
    echo "<blockquote><strong>".$errorstring."<br>";
	echo _DBERRWHAT."<br>";
	echo "</strong></blockquote>";
    echo "<a href=\"javascript:history.go(-1)\">"._GOBACK."</a> ";
	closetable();

  }   
}
  
  
function add_new_tag()
{
  global $MetaTag, $newTagCom, $newTagName, $newTagType, $newContent, $tagType, $tagNameHTTP, $tagName, $lines, $linesPRE, $linesPOST;
  
  $maxtag = $MetaTag[MAXTAG];
  $newline = $MetaTag[LINE][$maxtag] + 1;

  // move following lines
  $no_lines = count($lines);
  for ($i=$no_lines;$i>$newline; $i--){
    $lines[$i] = $lines[$i-1];
  }
  //move the following tags
  for ($tag=$MetaTag[TAGS];$tag>$maxtag; $tag--)
  { $MetaTag[LINE][$tag] = $MetaTag[LINE][$tag-1] + 1;
    $MetaTag[TYPE][$tag] = $MetaTag[TYPE][$tag-1];
    $MetaTag[NAME][$tag] = $MetaTag[NAME][$tag-1];
    $MetaTag[CONTENT][$tag] = $MetaTag[CONTENT][$tag-1];
	$linesPRE[$tag] = $linesPRE[$tag-1];
	$linesPOST[$tag] = $linesPOST[$tag-1];
  }
  $tag = $MetaTag[MAXTAG] +1;
  if (isset($newTagType)){
    $MetaTag[TYPE][$tag] = $newTagType;
  } else {  
    if (array_key_exists($newTagName,array_flip($tagNameHTTP))) {
      $MetaTag[TYPE][$tag] = $tagType[0];
    } else {
      $MetaTag[TYPE][$tag] = $tagType[1];
	}
  }
	

  $MetaTag[LINE][$tag] = $newline; //linenumber
  $lines[$newline] = "? "; // just need to be set
  
  $newContent = htmlspecialchars($newContent,ENT_NOQUOTES);
  if (get_magic_quotes_gpc()) 
  { $newContent = stripslashes($newContent);
  } 

  $MetaTag[NAME][$tag] = trim(str_replace("\\\"","",$newTagName));
  $MetaTag[CONTENT][$tag] = $newContent;
  $MetaTag[$newContent] = $tag; 
  $MetaTag[TAGS] = $MetaTag[TAGS] + 1;
  if (isset($newTagCom)) {
    $linesPRE[$tag] = "//%s \"";
  } else {
    $linesPRE[$tag] = "%s \"";
  }
  $linesPOST[$tag] = "%s \n";
  $MetaTag[MAXTAG] = $maxtag + 1;
}  
  
function reset_metadata()
{
    unset($MetaTag);
	unset($lines);
	unset($MetaTagWord);
    $MetaTag = array();  
	$lines = array();
	$MetaTagWord = array();
}  

function mt_footer()
{
  global $script_version, $module_name;
#  if (file_exists("modules/$module_name/copyright.php")) {
#  cpname = preg_replace("#_#", " ", $module_name);
#  echo "<div align=\"right\"><a href=\"javascript:openwindow()\">$cpname &copy;</a></div>";
#  }
  Opentable();
# echo "<br>";
  echo "	<center>Enhanced for nukeSEO from the <strong>MetaTags</strong> module developed by <a href=\"http://visayas.dk\">Visayas.dk</a></center>" ;
  CloseTable();
}

?>