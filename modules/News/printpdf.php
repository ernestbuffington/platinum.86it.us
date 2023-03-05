<?php
/************************************************************************/
/* Tricked Out News 2.4a                                                */ 
/* PHP-Platinum Nuke Pro: Expect to be impressed              COPYRIGHT */
/* Copyright (c) 2011 - 2017 by http://www.havocst.net                  */
/* DocHaVoC   (dochavoc(at)havocst(dot)net)                             */ 
/* This is a heavily modified version of the original Platinum Nuke     */ 
/* news module, to act and look more like a blog.                       */ 
/* Tricked Out News that was created originally for RavenNuke(tm)       */ 
/* by Nuken at http://trickedoutnews.com                                */ 
/* Converted to Platinum Nuke by DocHaVoC http://www.havocst.net        */
/************************************************************************/

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (isSet($_GET['id'])) {
	$id = intval($_GET['id']);
	require_once("mainfile.php");
	require_once('includes/fpdf/fpdf.php');
	global $db, $prefix;
	//====================
	if ($row = $db->sql_fetchrow($db->sql_query("SELECT *,DATE_FORMAT(time, '%d/%m/%Y %H:%i') as time FROM ".$prefix."_stories WHERE sid='$id'"))) {
		$row_conf = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_config"));
		$sitename = outCodeB($row_conf['sitename']);
		$siteurl = outCodeB($row_conf['nukeurl']);
		function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['G']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}			
		class PDF extends FPDF {
			//Page header
			function Header() {
				global $sitename,$siteurl;
				
				$this->SetTextColor(100,100,100);
				$this->SetFont('Arial','B',15);
				$this->Cell(0,10,$sitename,0,0);
				$this->Ln(10);
				$this->SetFont('Arial','I',10);
				$this->Cell(0,5,$siteurl,0,0);
				$this->SetDrawColor(100,100,100);
				$this->Line(11,27,199,27);
				$this->Ln(10);
			}
			
			//Page footer
			function Footer() {
				global $siteurl,$id, $sitename, $slogan;
				
				$this->SetTextColor(100,100,100);
				$this->SetY(-15);
				$this->SetDrawColor(100,100,100);
				$this->Line(11,275,199,275);
				$this->SetFont('Arial','I',8);
				$this->Cell(0,0,$siteurl.'/modules.php?name=News&file=article&sid='.urlencode($id));
				$this->Ln(5);
				$this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,1,'C');
				$this->Ln(5);
				$this->SetFont('Arial','I',7);
				$this->SetTextColor(150,150,150);
				$this->Cell(0,0,''.$sitename.'',0,0,'R',0,''.$siteurl.'');
			}
			
			//===HTML===
			var $B;
			var $I;
			var $U;
			var $HREF;
			
			function PDF($orientation='P',$unit='mm',$format='A4') {
				//Call parent constructor
				$this->FPDF($orientation,$unit,$format);
				//Initialization
				$this->B=0;
				$this->I=0;
				$this->U=0;
				$this->HREF='';
			$this->tableborder=0;
    $this->tdbegin=false;
    $this->tdwidth=0;
    $this->tdheight=0;
    $this->tdalign="L";
    $this->tdbgcolor=false;

    $this->oldx=0;
    $this->oldy=0;

    $this->fontlist=array("arial","times","courier","helvetica","symbol");
    $this->issetfont=false;
    $this->issetcolor=false;
}
			function WriteHTML($html) {
				//HTML parser
				$html=str_replace("\n",' ',$html);
				$a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
				foreach($a as $i=>$e)
				{
					if($i%2==0)
					{
						//Text
						if($this->HREF)
							$this->PutLink($this->HREF,$e);
						else
							$this->Write(5,$e);
					}
					else
					{
						//Tag
						if($e{0}=='/')
							$this->CloseTag(strtoupper(substr($e,1)));
						else
						{
							//Extract attributes
							$a2=explode(' ',$e);
							$tag=strtoupper(array_shift($a2));
							$attr=array();
							foreach($a2 as $v)
								if(preg_match('#^([^=]*)=["\']?([^"\']*)["\']?$#',$v,$a3))
									$attr[strtoupper($a3[1])]=$a3[2];
							$this->OpenTag($tag,$attr);
						}
					}
				}
			}
			

			function OpenTag($tag,$attr)
{
    //Opening tag
    switch($tag){

        case 'SUP':
            if($attr['SUP'] != '') {    
                //Set current font to: Bold, 6pt     
                $this->SetFont('','',6);
                //Start 125cm plus width of cell to the right of left margin         
                //Superscript "1" 
                $this->Cell(2,2,$attr['SUP'],0,0,'L');
            }
            break;

        case 'TABLE': // TABLE-BEGIN
            if( $attr['BORDER'] != '' ) $this->tableborder=$attr['BORDER'];
            else $this->tableborder=0;
            break;
        case 'TR': //TR-BEGIN
            break;
        case 'TD': // TD-BEGIN
            if( $attr['WIDTH'] != '' ) $this->tdwidth=($attr['WIDTH']/4);
            else $this->tdwidth=40; // SET to your own width if you need bigger fixed cells
            if( $attr['HEIGHT'] != '') $this->tdheight=($attr['HEIGHT']/6);
            else $this->tdheight=6; // SET to your own height if you need bigger fixed cells
            if( $attr['ALIGN'] != '' ) {
                $align=$attr['ALIGN'];        
                if($align=="LEFT") $this->tdalign="L";
                if($align=="CENTER") $this->tdalign="C";
                if($align=="RIGHT") $this->tdalign="R";
            }
            else $this->tdalign="L"; // SET to your own
            if( $attr['BGCOLOR'] != '' ) {
                $coul=hex2dec($attr['BGCOLOR']);
                    $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
                    $this->tdbgcolor=true;
                }
            $this->tdbegin=true;
            break;

        case 'HR':
            if( $attr['WIDTH'] != '' )
                $Width = $attr['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.2);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(1);
            break;
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
       /*case 'IMG':
           if(isset($attr['SRC']) and (isset($attr['WIDTH']) or isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
               if(!isset($attr['HEIGHT']))
                   $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
           break;*/
        case 'TR':
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) and $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) and in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            if (isset($attr['FACE']) and in_array(strtolower($attr['FACE']), $this->fontlist) and isset($attr['SIZE']) and $attr['SIZE']!='') {
                $this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='SUP') {
    }

    if($tag=='TD') { // TD-END
        $this->tdbegin=false;
        $this->tdwidth=0;
        $this->tdheight=0;
        $this->tdalign="L";
        $this->tdbgcolor=false;
    }
    if($tag=='TR') { // TR-END
        $this->Ln();
    }
    if($tag=='TABLE') { // TABLE-END
        //$this->Ln();
        $this->tableborder=0;
    }

    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' or $tag=='I' or $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}
			function SetStyle($tag,$enable)
			{
				//Modify style and select corresponding font
				$this->$tag+=($enable ? 1 : -1);
				$style='';
				foreach(array('B','I','U') as $s)
					if($this->$s>0)
						$style.=$s;
				$this->SetFont('',$style);
			}
			
			function PutLink($URL,$txt)
			{
				//Put a hyperlink
				$this->SetTextColor(0,0,255);
				$this->SetStyle('U',true);
				$this->Write(5,$txt,$URL);
				$this->SetStyle('U',false);
				$this->SetTextColor(0);
			}
		}
		
		//--------------------
		
		$nome = outCodeB($row['title']);
		$testo_home = outCodeB($row['hometext']);
		$testo = outCodeB($row['bodytext']);
		$testo_note = outCodeB($row['notes']);
		$autore = outCodeB($row['informant']);
		$data = $row['time'];
		
		$content = $testo_home."<br /><br />".$testo."<br /><br />".$testo_note;
		$info = "$data by $autore";
		
		$pdf=new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		
		//Title
		$pdf->Ln(5);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0,0,$nome,0,0);
		
		//Info
		$pdf->Ln(5);
		$pdf->SetFont('Arial','I',8);
		$pdf->Cell(0,0,$info,0,0);
		
		//Content
		$pdf->SetFont('Arial','',10);
		$pdf->WriteHTML(html_entity_decode($content));
		$pdf->Output();
		
		//--------------------
	} else {
		echo "Error: The article selected does not exist";
	}

} else {
	echo "Error: No Article Selected";
}

//Data output function (from database)
function outCodeB($string,$html=1) {
	if ($html==1) { 
	$string = unhtmlentitiesB($string); 
	}
	return stripslashes($string);
}

function unhtmlentitiesB($string,$html=1) {
	$trans_tbl1 = get_html_translation_table(HTML_ENTITIES);
	foreach ($trans_tbl1 as $ascii => $htmlentitie) {
		$trans_tbl2[$ascii] = '&#'.ord($ascii).';';
	}
	$string = str_replace("&#039;","'",$string);
	$string = str_replace("&#39;","'",$string);
	$string = str_replace("&#8364;","€",$string);
	$string = str_replace("&euro;","€",$string);
$string = str_replace("&#36;","$",$string);
$string = str_replace("&#169;","©",$string);
$string = str_replace("&#174;","®",$string);
$string = str_replace("&#176;","°",$string);
$string = str_replace("&#224;","à",$string);
$string = str_replace("&#232;","è",$string);
$string = str_replace("&#242;","ò",$string);
$string = str_replace("&#249;","ù",$string);
$string = str_replace("&#160;"," ",$string);
$string = str_replace("&#224;","à",$string);
$string = str_replace("&#176;","°",$string);
$string = str_replace("&#38;","&",$string);
$string = str_replace("&#8212;","-",$string);
$string = str_replace("&ndash;","-",$string);
$string = str_replace("&rsquo;","'",$string);
$string = str_replace("&ldquo;","\"",$string);
$string = str_replace("&rdquo;","\"",$string);
$string = str_replace("&lsquo;","'",$string); 
	$trans_tbl1 = array_flip($trans_tbl1);
	$trans_tbl2 = array_flip($trans_tbl2);
	
	$tagstostrtip = array('iframe','script','style');
	$string = strtr(strtr($string,$trans_tbl1),$trans_tbl2);
	// Fix By Laganà Gabriele
//	if ($html==1) { $string = strip_selected_tagsB($string,$tagstostrtip); }
	return $string;
}

function strip_selected_tagsB($text, $tags = array()) {
	$args = func_get_args();
	$text = array_shift($args);
	$tags = func_num_args() > 2 ? array_diff($args,array($text))  : (array)$tags;
	foreach ($tags as $tag){
		if( preg_match_all( '/<'.$tag.'[^>]*>([^<]*)<\/'.$tag.'>/iu', $text, $found) ){
			$text = str_replace($found[0],$found[1],$text);
		}
	}
	return preg_replace( '/(<('.join('|',$tags).')(\\n|\\r|.)*\/>)/iu', '', $text);
}

?>
