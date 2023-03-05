<?php
/*
 This class will grab all the possible information about the user/browser/OS
 Using as many info that the browser send to the user
 and Matching them against a list of possible values
 the function get() it will return the whole list of information

 a sample on how to use this class is at the bottom of this clas
 
 1.0.00: First release
 1.0.01: better way to discover browser
 1.1.00: more browsers added to the list, and modified the function to return if the browser is a crawler or not faster
         added a new beta function that will try to see if the user is on a i386 or amd64 platform

 TO-DO:
  - add more possible OS and browser: look at this class:
    - http://www.phpclasses.org/browse/file/6481.html
  - allow plugins
*/
class user_info {
	private $info = array();
	
	public function __construct(){
	}
	
	public function get(){
		if($this->info == array()){
			
			$return['request_uri']		= $this->request_page();
			$return['request_method']	= $this->request_method();
			$return['url']				= $this->url();

			$return['user_agent']		= $this->user_agent();
			$return['browser']			= $this->broser('all');
			$return['os']				= $this->os('all');
			$return['bits']				= $this->bits();		//beta
			$return['language']			= $this->language();
			$return['accept']			= $this->accept();
			$return['encoding']			= $this->encoding();
			$return['charset']			= $this->charset();
			$return['IP']				= $this->IP();
			$return['security']			= $this->security();
			$return['is_crawler']		= $this->is_crawler();
			//return the Country
//			$return['country'] = phpAds_geoip_getGeo($IP, dirname(__FILE__).'/files_includes/geoip/GeoIP-106_20040501.dat');
			//check if it is crawler
			$this->info = $return;
		}
		return $this->info;
	}
	public function request_page(){
		//return the REQUEST_URI
		return $_SERVER['REQUEST_URI'];
	}
	public function request_method(){
		//return the request method (get,post ...)
		return $_SERVER['REQUEST_METHOD'];
	}
	public function url(){
		//return the actual url(SCRIPT_NAME,QUERY_STRING)
		if(isset($_SERVER['HTTPS'])){
			$return = 'ssl://';
		} else {
			switch($_SERVER['SERVER_PORT']){
				case 80:
				default:
					$return = 'http://';
			}
		}
		$return .= $_SERVER['HTTP_HOST'];
		$return .= $_SERVER['SCRIPT_NAME'];
		if($_SERVER['QUERY_STRING']!=''){
			$return .= '?'.$_SERVER['QUERY_STRING'];
		}
		return $return;
	}
	public function bits(){
		//this is beta
		$return = '';
		$ua = strtolower($this->user_agent());
		if(($pos = strpos($ua,'a64')) !== false || ($pos = strpos($ua,'amd64')) !== false) {
			$return = 'amd64';
		}elseif(($pos = strpos($ua,'i386')) !== false) {
			$return = 'i386';
		}elseif(($pos = strpos($ua,'i486')) !== false) {
			$return = 'i486';
		}elseif(($pos = strpos($ua,'i586')) !== false) {
			$return = 'i586';
		}elseif(($pos = strpos($ua,'i686')) !== false) {
			$return = 'i686';
		}else{
			//is this the right assumption?
			$return = 'i386';
		}
		return $return;
	}
	public function user_agent(){
		//return the user agent
		return isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
	}
	public function security(){
		$return = 'unknown';
		$ua = $this->user_agent();
		if(($pos = strpos($ua,' N;')) !== false) {
			$return = 'no';
		}elseif(($pos = strpos($ua,' U;')) !== false) {
			$return = 'strong';
		}elseif(($pos = strpos($ua,' I;')) !== false) {
			$return = 'weak';
		}
		return $return;		
	}
	public function browser($what=''){
		//return the Browser
		$ua				= strtolower($this->user_agent());
		$Browser		= 'Not Detected';
		$BrowserVersion = '';
		$browsers['Alexa']				= array('name'=>'Alexa (IA Archive)','is_crawler'=>true, 'get_version'=>true);
		$browsers['ia_archiver']		= array('name'=>'Alexa (IA Archive)','is_crawler'=>true, 'get_version'=>true);
		$browsers['Acorn Browse']		= array('name'=>'Acorn Browse','is_crawler'=>false, 'get_version'=>true);
		$browsers['amaya']				= array('name'=>'Amaya','is_crawler'=>false, 'get_version'=>true);
		$browsers['almaden']			= array('name'=>'IBM Almaden Crawler','is_crawler'=>true, 'get_version'=>true);
		$browsers['AmigaVoyager']		= array('name'=>'Amiga Voyager','is_crawler'=>false, 'get_version'=>true);
		$browsers['amigaweb']			= array('name'=>'aweb','is_crawler'=>false, 'get_version'=>true);
		$browsers['archive']			= array('name'=>'generic (archive)','is_crawler'=>true, 'get_version'=>true);
		$browsers['askjeeves']			= array('name'=>'Ask Jeeves','is_crawler'=>true, 'get_version'=>true);
		$browsers['Avant Browser']		= array('name'=>'Avant Browser','is_crawler'=>false, 'get_version'=>true);
		$browsers['aweb']				= array('name'=>'aweb','is_crawler'=>false, 'get_version'=>true);

		$browsers['beonex']				= array('name'=>'Beonex','is_crawler'=>false, 'get_version'=>true);
		$browsers['BecomeBot']			= array('name'=>'BecomeBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['bluefish']			= array('name'=>'Bluefish','is_crawler'=>false, 'get_version'=>true);
		$browsers['bot']				= array('name'=>'generic (bot)','is_crawler'=>true, 'get_version'=>false);
		$browsers['BrowseX']			= array('name'=>'BrowseX','is_crawler'=>false, 'get_version'=>true);

		$browsers['camino']				= array('name'=>'Camino','is_crawler'=>false, 'get_version'=>true);
		$browsers['charon']				= array('name'=>'Charon','is_crawler'=>false, 'get_version'=>true);
		$browsers['Check&Get']			= array('name'=>'Check&Get','is_crawler'=>true, 'get_version'=>true);
		$browsers['chimera']			= array('name'=>'Chimera','is_crawler'=>false, 'get_version'=>true);
		$browsers['converacrawler']		= array('name'=>'ConveraCrawler','is_crawler'=>true, 'get_version'=>true);
		$browsers['Contiki']			= array('name'=>'Contiki','is_crawler'=>true, 'get_version'=>true);
		$browsers['crawl']				= array('name'=>'generic (crawl)','is_crawler'=>true, 'get_version'=>false);
		$browsers['cURL']				= array('name'=>'cURL','is_crawler'=>false, 'get_version'=>true);
		$browsers['cyberdog']			= array('name'=>'CyberDog','is_crawler'=>false, 'get_version'=>true);

		$browsers['democracy']			= array('name'=>'Democracy','is_crawler'=>false, 'get_version'=>true);
		$browsers['desktop/1x']			= array('name'=>'Lycoris Desktop/LX','is_crawler'=>false, 'get_version'=>true);
		$browsers['dillo']				= array('name'=>'Dillo','is_crawler'=>false, 'get_version'=>true);
		$browsers['doczilla']			= array('name'=>'DocZilla','is_crawler'=>false, 'get_version'=>true);
		$browsers['doris']				= array('name'=>'Doris','is_crawler'=>false, 'get_version'=>true);

		$browsers['echo!']				= array('name'=>'Echo!','is_crawler'=>true, 'get_version'=>false);
		$browsers['edbrowse']			= array('name'=>'edbrowse','is_crawler'=>true, 'get_version'=>true);
		$browsers['edintorni']			= array('name'=>'EDintorni','is_crawler'=>true, 'get_version'=>true);
		$browsers['ELinks']				= array('name'=>'ELinks','is_crawler'=>false, 'get_version'=>true);
		$browsers['emacs']				= array('name'=>'EMacs','is_crawler'=>false, 'get_version'=>true);
		$browsers['Epiphany']			= array('name'=>'Epiphany','is_crawler'=>false, 'get_version'=>true);

		$browsers['Fast Webcrawler']	= array('name'=>'Fast Webcrawler','is_crawler'=>true, 'get_version'=>true);
		$browsers['Feedfetcher']		= array('name'=>'Feedfetcher-Google','is_crawler'=>true, 'get_version'=>true);
		$browsers['Fetch']				= array('name'=>'generic (fetch)','is_crawler'=>true, 'get_version'=>false);
		$browsers['Firebird']			= array('name'=>'Mozilla Firebird','is_crawler'=>false, 'get_version'=>true);
		$browsers['FindLinks']			= array('name'=>'FindLinks','is_crawler'=>true, 'get_version'=>true);
		$browsers['Flock']				= array('name'=>'Flock','is_crawler'=>false, 'get_version'=>true);
		$browsers['frontpage']			= array('name'=>'Microsoft Frontpage','is_crawler'=>false, 'get_version'=>true);

		$browsers['galeon']				= array('name'=>'Galeon','is_crawler'=>false, 'get_version'=>true);
		$browsers['gaisbot']			= array('name'=>'GaisBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['Gigabot']			= array('name'=>'GigaBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['GirafaBot']			= array('name'=>'GirafaBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['Gnuzilla']			= array('name'=>'Gnuzilla','is_crawler'=>false, 'get_version'=>true);
		$browsers['Googlebot-Image']	= array('name'=>'Google Image','is_crawler'=>true, 'get_version'=>true);
		$browsers['Googlebot']			= array('name'=>'Google','is_crawler'=>true, 'get_version'=>true);
		$browsers['Grab']				= array('name'=>'generic (grab)','is_crawler'=>true, 'get_version'=>false);
		$browsers['GreenBrowser']		= array('name'=>'GreenBrowser','is_crawler'=>false, 'get_version'=>true);
		$browsers['grub-client']		= array('name'=>'Grub Client','is_crawler'=>true, 'get_version'=>true);

		$browsers['HTMLParser']			= array('name'=>'HTMLParser','is_crawler'=>true, 'get_version'=>true);
		$browsers['holmes']				= array('name'=>'Holmes','is_crawler'=>true, 'get_version'=>true);
		$browsers['HotJava']			= array('name'=>'HotJava','is_crawler'=>false, 'get_version'=>true);
		$browsers['HP Web PrintSmart']	= array('name'=>'HP Web PrintSmart','is_crawler'=>false, 'get_version'=>true);
		$browsers['HTTPClient']			= array('name'=>'HTTPClient','is_crawler'=>false, 'get_version'=>true);

		$browsers['IBM Web Browser']	= array('name'=>'IBM Web Browser','is_crawler'=>false, 'get_version'=>true);
		$browsers['IBrowse']			= array('name'=>'IBrowse','is_crawler'=>false, 'get_version'=>true);
		$browsers['Icab']				= array('name'=>'ICab','is_crawler'=>false, 'get_version'=>true);
		$browsers['Ice']				= array('name'=>'ICE','is_crawler'=>false, 'get_version'=>true);
		$browsers['iconsurf']			= array('name'=>'IconSurf','is_crawler'=>true, 'get_version'=>true);
		$browsers['Ichiro']				= array('name'=>'Ichiro','is_crawler'=>true, 'get_version'=>true);
		$browsers['innerprisebot']		= array('name'=>'Innerprise','is_crawler'=>true, 'get_version'=>true);
		$browsers['ipd']				= array('name'=>'AlertSite','is_crawler'=>true, 'get_version'=>false);

		$browsers['Kazehakase']			= array('name'=>'Kazehakase','is_crawler'=>false, 'get_version'=>true);
		$browsers['Kkman']				= array('name'=>'Kkman','is_crawler'=>false, 'get_version'=>true);
		$browsers['K-Meleon']			= array('name'=>'K-Meleon','is_crawler'=>false, 'get_version'=>true);
		$browsers['Konqueror']			= array('name'=>'Konqueror','is_crawler'=>false, 'get_version'=>true);

		$browsers['liberate']			= array('name'=>'Liberate','is_crawler'=>false, 'get_version'=>true);
		$browsers['Links']				= array('name'=>'Links','is_crawler'=>false, 'get_version'=>true);
		$browsers['Link-Checker-Pro']	= array('name'=>'Link Checker Pro','is_crawler'=>true, 'get_version'=>true);
		$browsers['Link Checker Pro']	= array('name'=>'Link Checker Pro','is_crawler'=>true, 'get_version'=>true);
		$browsers['linkwalker']			= array('name'=>'LinkWalker','is_crawler'=>true, 'get_version'=>true);
		$browsers['Lobo']				= array('name'=>'Lobo','is_crawler'=>false, 'get_version'=>true);
		$browsers['Lynx']				= array('name'=>'Lynx','is_crawler'=>false, 'get_version'=>true);

		$browsers['Maxthon']			= array('name'=>'Maxthon','is_crawler'=>false, 'get_version'=>true);
		$browsers['MediaPartner']		= array('name'=>'MediaPartner','is_crawler'=>true, 'get_version'=>true);
		$browsers['Midori']				= array('name'=>'Midori','is_crawler'=>false, 'get_version'=>true);
		$browsers['mirago']				= array('name'=>'Mirago','is_crawler'=>true, 'get_version'=>true);
		$browsers['moget']				= array('name'=>'Moget','is_crawler'=>true, 'get_version'=>true);
		$browsers['Mosaic']				= array('name'=>'Mosaic','is_crawler'=>false, 'get_version'=>true);
		$browsers['Mothra']				= array('name'=>'Mothra','is_crawler'=>false, 'get_version'=>true);
		$browsers['msnbot']				= array('name'=>'MSNBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['mj12bot']			= array('name'=>'MJ12Bot','is_crawler'=>true, 'get_version'=>true);

		$browsers['naverbot']			= array('name'=>'NaverBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['Netbox']				= array('name'=>'NetBox','is_crawler'=>false, 'get_version'=>true);
		$browsers['netcaptor']			= array('name'=>'NetCaptor','is_crawler'=>false, 'get_version'=>true);
		$browsers['netcraft']			= array('name'=>'NetCraft','is_crawler'=>true, 'get_version'=>true);
		$browsers['netpliance']			= array('name'=>'Netpliance','is_crawler'=>false, 'get_version'=>true);
		$browsers['netpositive']		= array('name'=>'NetPositice','is_crawler'=>false, 'get_version'=>true);
		$browsers['Netsurf']			= array('name'=>'Netsurf','is_crawler'=>false, 'get_version'=>true);
		$browsers['NewsGator']			= array('name'=>'NewsGator','is_crawler'=>true, 'get_version'=>true);
		$browsers['Nomad']				= array('name'=>'Nomad','is_crawler'=>true, 'get_version'=>true);
		$browsers['ng']					= array('name'=>'Exabot NG','is_crawler'=>true, 'get_version'=>false);
		$browsers['nextgensearchbot']	= array('name'=>'NextGenSearchBot','is_crawler'=>true, 'get_version'=>true);

		$browsers['offbyone']			= array('name'=>'OffByOne','is_crawler'=>false, 'get_version'=>true);
		$browsers['omniweb']			= array('name'=>'omniweb','is_crawler'=>false, 'get_version'=>true);
		$browsers['Opera']				= array('name'=>'Opera','is_crawler'=>false, 'get_version'=>true);
		$browsers['oracle']				= array('name'=>'Oracle PowerBrowser','is_crawler'=>false, 'get_version'=>true);
		$browsers['Oregano']			= array('name'=>'Oregano','is_crawler'=>false, 'get_version'=>true);
		$browsers['Oxygen']				= array('name'=>'Oxygen','is_crawler'=>false, 'get_version'=>true);

		$browsers['poodle predictor']	= array('name'=>'Poodle Predictor','is_crawler'=>true, 'get_version'=>true);
		$browsers['phoenix']			= array('name'=>'Phoenix','is_crawler'=>false, 'get_version'=>true);
		$browsers['PlanetWeb']			= array('name'=>'PlanetWeb','is_crawler'=>false, 'get_version'=>true);
		$browsers['Prodigy']			= array('name'=>'Prodigy','is_crawler'=>false, 'get_version'=>true);
		$browsers['PowerTV']			= array('name'=>'PowerTV','is_crawler'=>false, 'get_version'=>true);
		$browsers['psbot']				= array('name'=>'PSBot','is_crawler'=>true, 'get_version'=>true);

		$browsers['QuickTime']			= array('name'=>'QuickTime','is_crawler'=>false, 'get_version'=>true);
		$browsers['qtver']				= array('name'=>'QuickTime','is_crawler'=>false, 'get_version'=>true);

		$browsers['retawq']				= array('name'=>'Retawq','is_crawler'=>false, 'get_version'=>true);
		$browsers['robot']				= array('name'=>'generic (robot)','is_crawler'=>true, 'get_version'=>false);

		$browsers['Science Traveller International 1X']				= array('name'=>'Science Traveller International 1X','is_crawler'=>false, 'get_version'=>false);
		$browsers['sbider']				= array('name'=>'SiteSell','is_crawler'=>true, 'get_version'=>true);
		$browsers['scooter']			= array('name'=>'Scooter','is_crawler'=>true, 'get_version'=>true);
		$browsers['seekbot']			= array('name'=>'generic (seekbot)','is_crawler'=>true, 'get_version'=>false);
		$browsers['SeaMonkey']			= array('name'=>'SeaMonkey','is_crawler'=>false, 'get_version'=>true);
		$browsers['seeker']				= array('name'=>'generic (seeker)','is_crawler'=>true, 'get_version'=>false);
		$browsers['sextatnt']			= array('name'=>'Tango','is_crawler'=>false, 'get_version'=>true);
		$browsers['SharpReader']		= array('name'=>'SharpReader','is_crawler'=>false, 'get_version'=>true);
		$browsers['Shiira']				= array('name'=>'Shiira','is_crawler'=>false, 'get_version'=>true);
		$browsers['sis']				= array('name'=>'Spectrum Internet Suite','is_crawler'=>false, 'get_version'=>false);
		$browsers['Slurp']				= array('name'=>'Yahoo! Slurp','is_crawler'=>true, 'get_version'=>true);
		$browsers['Songbird']			= array('name'=>'Songbird','is_crawler'=>false, 'get_version'=>true);
		$browsers['spider']				= array('name'=>'generic (spider)','is_crawler'=>true, 'get_version'=>false);
		$browsers['survey']				= array('name'=>'generic (survey)','is_crawler'=>true, 'get_version'=>false);
		$browsers['Sylera']				= array('name'=>'Sylera','is_crawler'=>false, 'get_version'=>true);
		$browsers['SqWorm']				= array('name'=>'SqWorm','is_crawler'=>true, 'get_version'=>true);
		
		$browsers['SurveyBot']			= array('name'=>'SurveyBot - Whois Source','is_crawler'=>true, 'get_version'=>true);

		$browsers['topicspy']			= array('name'=>'Topicspy Checkbot','is_crawler'=>true, 'get_version'=>true);
		$browsers['tutorgigbot']		= array('name'=>'TutorGigBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['turnitinbot']		= array('name'=>'TurnitinBot','is_crawler'=>true, 'get_version'=>true);
		$browsers['T-H-U-N-D-E-R-S-T-O-N-E']		= array('name'=>'T-H-U-N-D-E-R-S-T-O-N-E','is_crawler'=>true, 'get_version'=>false);

		$browsers['UP.Browser']			= array('name'=>'UP Browser','is_crawler'=>false, 'get_version'=>true);

		$browsers['validator']			= array('name'=>'generic (validator)','is_crawler'=>true, 'get_version'=>false);
		$browsers['Voyager']			= array('name'=>'Voyager','is_crawler'=>false, 'get_version'=>true);

		$browsers['w3c-checklink']		= array('name'=>'W3C Checklink','is_crawler'=>true, 'get_version'=>true);
		$browsers['w3c_validator']		= array('name'=>'W3C Validator','is_crawler'=>true, 'get_version'=>true);
		$browsers['W3CLineMode']		= array('name'=>'W3C Line Mode','is_crawler'=>false, 'get_version'=>true);
		$browsers['W3M']				= array('name'=>'W3M','is_crawler'=>false, 'get_version'=>true);
		$browsers['walhello']			= array('name'=>'WalHello','is_crawler'=>true, 'get_version'=>true);
		$browsers['WebCapture']			= array('name'=>'WebCapture','is_crawler'=>false, 'get_version'=>true);
		$browsers['WebExplorer']		= array('name'=>'WebExplorer','is_crawler'=>false, 'get_version'=>true);
		$browsers['webtv']				= array('name'=>'WebTV','is_crawler'=>false, 'get_version'=>true);
		$browsers['WGet']				= array('name'=>'WGet','is_crawler'=>false, 'get_version'=>true);

		$browsers['xenu link sleuth']	= array('name'=>'Xenu\'s Link Analyser','is_crawler'=>true, 'get_version'=>true);
		$browsers['xChaos_Arachne']		= array('name'=>'Arachne','is_crawler'=>true, 'get_version'=>true);

		$browsers['Yandex']				= array('name'=>'Yandex','is_crawler'=>true, 'get_version'=>true);

		$browsers['zyborg']				= array('name'=>'ZyBorg','is_crawler'=>true, 'get_version'=>true);
		$browsers['zoe indexer']		= array('name'=>'Zoe Indexer','is_crawler'=>true, 'get_version'=>true);
		
		//those needs to be at the end, as many browser are based on those and they would be recognisex wrongly
		$browsers['aol']				= array('name'=>'AOL','is_crawler'=>false, 'get_version'=>true);
		$browsers['Bison']				= array('name'=>'Bison','is_crawler'=>false, 'get_version'=>true);
		$browsers['Firefox']			= array('name'=>'Mozilla Firefox','is_crawler'=>false, 'get_version'=>true);
		$browsers['iexplorer']			= array('name'=>'Internet Explorer','is_crawler'=>false, 'get_version'=>true);
		$browsers['Mozilla']			= array('name'=>'Mozilla','is_crawler'=>false, 'get_version'=>true);
		$browsers['MSIE']				= array('name'=>'Internet Explorer','is_crawler'=>false, 'get_version'=>true);
		$browsers['Netscape']			= array('name'=>'Netscape Navigator','is_crawler'=>false, 'get_version'=>true);
		$browsers['safari']				= array('name'=>'safari','is_crawler'=>false, 'get_version'=>true);

		foreach($browsers as $k=>$v){
			$k = strtolower($k);
			if(($pos = strpos($ua,$k)) !== false) {
				$browser	= $v['name'];
				$is_crawler	= $v['is_crawler'];
				$pos		+= strlen($k)+1;
				$endPos		= strpos($ua,' ',$pos);
				$endPos		= ($endPos===false) ? strlen($ua) : $endPos-$pos;
				$version	= substr($ua,$pos,$endPos);
			}
		}

		switch($what){
			case 'all':
				$return['browser'] = $browser.' v.'.$version;
				$return['name'] = $browser;
				$return['version'] = $version;
				$return['is_crawler'] = $is_crawler;
				break;
			case 'name':
				$return = $browser;
				break;
			case 'is_crawler':
				$return = $is_crawler;
				break;
			case 'version':
				$return	= $version;
				break;
			default:
				$return	= $browser.' v.'.$version;
				break;
		}
		return $return;
	}
	
	public function os($what=''){
		//return the OS
		$os = array();
		//amiga
		$os['amiga'] 		= array('name'=>'amiga','version'=>'');
		//commodore
		$os['Commodore 64'] 		= array('name'=>'Commodore','version'=>'64');
		$os['Commodore 128'] 		= array('name'=>'Commodore','version'=>'128');
		//dreamcast
		$os['dreamcast']	= array('name'=>'sega dreamcast','version'=>'');
		//googlebot
		$os['googlebot']	= array('name'=>'googlebot','version'=>'');
		//freebsd
		$os['freebsd']		= array('name'=>'freebsd','version'=>'');
		$os['freebsd amd64']= array('name'=>'freebsd','version'=>'amd64');
		$os['freebsd a64']	= array('name'=>'freebsd','version'=>'amd64');
		$os['freebsd i686']	= array('name'=>'freebsd','version'=>'i686');
		$os['freebsd i586']	= array('name'=>'freebsd','version'=>'i586');
		$os['freebsd i486']	= array('name'=>'freebsd','version'=>'i486');
		$os['freebsd i386']	= array('name'=>'freebsd','version'=>'i386');
		$os['freebsd 5']	= array('name'=>'freebsd','version'=>'5.x');
		$os['freebsd 6']	= array('name'=>'freebsd','version'=>'6.x');
		$os['freebsd 7']	= array('name'=>'freebsd','version'=>'7.x');
		//hp-ux
		$os['hp-ux']		= array('name'=>'hp-ux','version'=>'');
		$os['hpux']			= array('name'=>'hp-ux','version'=>'');
		//htmlparser
		$os['htmlparser']	= array('name'=>'htmlparser','version'=>'');
		//irix
		$os['irix'] 		= array('name'=>'irix','version'=>'');
		//liberate
		$os['liberate']		= array('name'=>'liberate','version'=>'');
		//lindows
		$os['lindows']		= array('name'=>'lindows os','version'=>'');
		//linux
		$os['linux']		= array('name'=>'linux','version'=>'');
		$os['linux i686']	= array('name'=>'linux','version'=>'i686');
		$os['linux i586']	= array('name'=>'linux','version'=>'i586');
		$os['linux i486']	= array('name'=>'linux','version'=>'i486');
		$os['linux i386']	= array('name'=>'linux','version'=>'i386');
		$os['linux ppc']	= array('name'=>'linux','version'=>'ppc');
		//mac
		$os['mac']			= array('name'=>'macintosh','version'=>'');
		$os['Mac OS X']		= array('name'=>'macintosh','version'=>'OS X');
		$os['Mac OS X 10_4']		= array('name'=>'macintosh','version'=>'OS X 10.4.x (Tiger)');
		$os['Mac OS X 10_5']		= array('name'=>'macintosh','version'=>'OS X 10.5.x (Leopard)');
		$os['Mac OS X 10_5_2']		= array('name'=>'macintosh','version'=>'OS X 10.5.2 (Leopard)');
		$os['Mac OS X 10_5_3']		= array('name'=>'macintosh','version'=>'OS X 10.5.3 (Leopard)');
		$os['Mac 10']		= array('name'=>'macintosh','version'=>'OS X');
		$os['PowerPC']		= array('name'=>'macintosh','version'=>'PPC');
		$os['PPC']			= array('name'=>'macintosh','version'=>'PPC');
		$os['68000']		= array('name'=>'macintosh','version'=>'68K');
		$os['68k']			= array('name'=>'macintosh','version'=>'68K');
		//netbsd
		$os['netbsd']		= array('name'=>'netbsd','version'=>'');
		$os['netbsd amd64']	= array('name'=>'netbsd','version'=>'amd64');
		$os['netbsd a64']	= array('name'=>'netbsd','version'=>'amd64');
		$os['netbsd i686']	= array('name'=>'netbsd','version'=>'i686');
		$os['netbsd i586']	= array('name'=>'netbsd','version'=>'i586');
		$os['netbsd i486']	= array('name'=>'netbsd','version'=>'i486');
		$os['netbsd i386']	= array('name'=>'netbsd','version'=>'i386');
		//netcraft
		$os['netcraft']		= array('name'=>'netcraft','version'=>'');
		//os/2
		$os['os/2']			= array('name'=>'os/2','version'=>'');
		$os['os2']			= array('name'=>'os/2','version'=>'');
		$os['Warp 4']		= array('name'=>'os/2','version'=>'Warp 4');
		$os['Warp 4.5']		= array('name'=>'os/2','version'=>'Warp 4.5');
		//osf1
		$os['osf1']			= array('name'=>'osf1','version'=>'');
		//openbsd
		$os['openbsd']		= array('name'=>'openbsd','version'=>'');
		$os['openbsd amd64']= array('name'=>'openbsd','version'=>'amd64');
		$os['openbsd a64']	= array('name'=>'openbsd','version'=>'amd64');
		$os['openbsd i686']	= array('name'=>'openbsd','version'=>'i686');
		$os['openbsd i586']	= array('name'=>'openbsd','version'=>'i586');
		$os['openbsd i486']	= array('name'=>'openbsd','version'=>'i486');
		$os['openbsd i386']	= array('name'=>'openbsd','version'=>'i386');
		//palm
		$os['palm']			= array('name'=>'palm','version'=>'');
		//PC-BSD
		$os['pcbsd 7']		= array('name'=>'pcbsd','version'=>'7');
		//power tv
		$os['powertv']		= array('name'=>'powertv','version'=>'');
		//prodigy
		$os['prodigy']		= array('name'=>'prodigy','version'=>'');
		//qnx
		$os['qnx']			= array('name'=>'qnx','version'=>'');
		$os['photon']		= array('name'=>'qnx','version'=>'photon');
		//siemens
		$os['sie-cx35']		= array('name'=>'Siemens CX35','version'=>'');
		//symbian
		$os['symbian']		= array('name'=>'symbian','version'=>'');
		$os['symbian/6.1']	= array('name'=>'symbian','version'=>'6.1');
		//sunos
		$os['sunos']		= array('name'=>'sunos','version'=>'');
		//Whois Source
		$os['surveybot']	= array('name'=>'Whois Source','version'=>'');
		//unix
		$os['unix']			= array('name'=>'unix','version'=>'');
		//Yahoo! Slurp
		$os['yahoo']		= array('name'=>'yahoo','version'=>'');
		$os['yahoo! slurp']	= array('name'=>'yahoo slurp','version'=>'');
		//web tv
		$os['web tv']		= array('name'=>'web tv','version'=>'');
		$os['webtv']		= array('name'=>'web tv','version'=>'');
		//windows
		$os['win'] 				= array('name'=>'windows','version'=>'');
		$os['windows nt']		= array('name'=>'windows','version'=>'nt');
		$os['winnt']			= array('name'=>'windows','version'=>'nt');
		$os['win3.11']			= array('name'=>'windows','version'=>'3.11');
		$os['win3.1']			= array('name'=>'windows','version'=>'3.1');
		$os['windows 95']		= array('name'=>'windows','version'=>'95');
		$os['win95']			= array('name'=>'windows','version'=>'95');
		$os['windows 98']		= array('name'=>'windows','version'=>'98');
		$os['win98']			= array('name'=>'windows','version'=>'98');
		$os['windows me']		= array('name'=>'windows','version'=>'me');
		$os['win 9x 4.90']		= array('name'=>'windows','version'=>'me');
		$os['windows nt 5.0']	= array('name'=>'windows','version'=>'2000');
		$os['winnt5.0'] 		= array('name'=>'windows','version'=>'2000');
		$os['windows 2000']		= array('name'=>'windows','version'=>'2000');
		$os['win2000']			= array('name'=>'windows','version'=>'2000');
		$os['windows nt 5.1']	= array('name'=>'windows','version'=>'xp');
		$os['winnt5.1']			= array('name'=>'windows','version'=>'xp');
		$os['windows xp']		= array('name'=>'windows','version'=>'xp');
		$os['winxp']			= array('name'=>'windows','version'=>'xp');
		$os['windows nt 5.2']	= array('name'=>'windows','version'=>'.net 2003');
		$os['winnt5.2']			= array('name'=>'windows','version'=>'.net 2003');
		$os['windows nt 6']		= array('name'=>'windows','version'=>'Codename: Longhorn');
		$os['winnt6']			= array('name'=>'windows','version'=>'Codename: Longhorn');
		$os['windows ce']		= array('name'=>'windows','version'=>'ce');


		$ua = strtolower($this->user_agent());
		$name = 'Not Detected';
		$version = '';
		if($ua!=''){
			foreach($os as $k=>$v){
				$k = strtolower($k);
				if(preg_match('#'.preg_quote($k).'#i', $ua)!==false){
					$name = $v['name'];
					$version = $v['version'];
				}
			}
		}
		switch($what){
			case 'all':
				$return['os'] = $name.' v.'.$version;
				$return['name'] = $name;
				$return['version'] = $version;
				break;
			case 'name':
				$return		= $name;
				break;
			case 'version':
				$return	= $version;
				break;
			default:
				$return	= $name.' '.$version;
				break;
		}
		return $return;
	}
	
	public function language(){
		//return the Accepted Languages
		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$lArr=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
			foreach($lArr as $k => $v) {
				$vArr=explode(';',$v);
				$vArr[1]=(!empty($vArr[1])) ? str_replace('q=','',$vArr[1]) : '1.0';
				$tmplCArr[$vArr[0]]=$vArr[1];
			}
			foreach($tmplCArr as $lC=>$qV) {
				$lC = strtolower(trim($lC));
				$langArr[]=array('code'=>$lC,'name'=>$this->_lang_details($lC),'QValue'=>$qV);
			}
		} else {
			$langArr[]=array('code'=>'*','name'=>'all languages are equally acceptable','QValue'=>'1.0');
		}
		return $langArr;
	}
	
	public function accept(){
		//return the Accepted Charset
		if(isset($_SERVER['HTTP_ACCEPT']) && !empty($_SERVER['HTTP_ACCEPT'])) {
			$cArr=explode(',',$_SERVER['HTTP_ACCEPT']);
			foreach($cArr as $k => $v) {
				$vArr=explode(';',$v);
				$vArr[1]=(!empty($vArr[1])) ? str_replace('q=','',$vArr[1]) : 1.0;
				$Arr[]=array('code'=>$vArr[0],'QValue'=>$vArr[1]);
			}
		} else {
			$Arr[]=array('code'=>'','QValue'=>1.0);
		}
		return $Arr;
	}
	public function encoding(){
		//return the Accepted Encoding
		if(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
			$eArr=explode(',',$_SERVER['HTTP_ACCEPT_ENCODING']);
			foreach($eArr as $k => $v) {
				$vArr=explode(';',$v);
				$vArr[1]=(!empty($vArr[1])) ? str_replace('q=','',$vArr[1]) : 1.0;
				$Arr[]=array('code'=>$vArr[0],'QValue'=>$vArr[1]);
			}
		} else {
			$Arr[]=array('code'=>'','QValue'=>1.0);
		}
		return $Arr;
	}
	public function charset(){
		//return the Accepted Charset
		if(isset($_SERVER['HTTP_ACCEPT_CHARSET']) && !empty($_SERVER['HTTP_ACCEPT_CHARSET'])) {
			$cArr=explode(',',$_SERVER['HTTP_ACCEPT_CHARSET']);
			foreach($cArr as $k => $v) {
				$vArr=explode(';',$v);
				$vArr[1]=(!empty($vArr[1])) ? str_replace('q=','',$vArr[1]) : 1.0;
				$Arr[]=array('code'=>$vArr[0],'QValue'=>$vArr[1]);
			}
		} else {
			$Arr[]=array('code'=>'','QValue'=>1.0);
		}
		return $Arr;
	}
	public function IP(){
		$tmp = array();
		if  (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')) {
		   $tmp += explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		   $tmp[] = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
		}elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
		   $tmp[] = trim($_SERVER['HTTP_CLIENT_IP']);
		}
		$tmp[] = trim($_SERVER['REMOTE_ADDR']);
		return trim(str_replace('unknown','',strtolower(implode("\n",$tmp))));
	}
	private function _lang_details($lang){
		$langCode['af']		= 'Afrikaans';
		$langCode['sq']		= 'Albanian';
		$langCode['ar']		= 'Arabic';
		$langCode['ar-ar']	= 'Arabic (Standard)';
		$langCode['ar-dz']	= 'Arabic (Algeria)';
		$langCode['ar-bh']	= 'Arabic (Bahrain)';
		$langCode['ar-eg']	= 'Arabic (Egypt)';
		$langCode['ar-iq']	= 'Arabic (Iraq)';
		$langCode['ar-jo']	= 'Arabic (Jordan)';
		$langCode['ar-kw']	= 'Arabic (Kuwait)';
		$langCode['ar-lb']	= 'Arabic (Lebanon)';
		$langCode['ar-ly']	= 'Arabic (Libya)';
		$langCode['ar-ma']	= 'Arabic (Morocco)';
		$langCode['ar-om']	= 'Arabic (Oman)';
		$langCode['ar-qa']	= 'Arabic (Qatar)';
		$langCode['ar-sa']	= 'Arabic (Saudi Arabia)';
		$langCode['ar-sy']	= 'Arabic (Syria)';
		$langCode['ar-tn']	= 'Arabic (Tunisia)';
		$langCode['ar-ae']	= 'Arabic (U.A.E.)';
		$langCode['ar-ye']	= 'Arabic (Yemen)';
		$langCode['eu']		= 'Basque';
		$langCode['be']		= 'Belarusian';
		$langCode['bg']		= 'Bulgarian';
		$langCode['ca']		= 'Catalan';
		$langCode['zh-hk']	= 'Chinese (Hong Kong SAR)';
		$langCode['zh-cn']	= 'Chinese (PRC)';
		$langCode['zh-sg']	= 'Chinese (Singapore)';
		$langCode['zh-tw']	= 'Chinese (Taiwan)';
		$langCode['zh-mo']	= 'Chinese (Macao)';
		$langCode['hr']		= 'Croatian';
		$langCode['cs']		= 'Czech';
		$langCode['da']		= 'Danish';
		$langCode['da-dk']	= 'Danish';
		$langCode['nl']		= 'Dutch (Standard)';
		$langCode['nl-nl']	= 'Dutch';
		$langCode['nl-be']	= 'Dutch (Belgium)';
		$langCode['en']		= 'English';
		$langCode['en-au']	= 'English (Australia)';
		$langCode['en-bz']	= 'English (Belize)';
		$langCode['en-ca']	= 'English (Canada)';
		$langCode['en']		= 'English (Caribbean)';
		$langCode['en-ie']	= 'English (Ireland)';
		$langCode['en-jm']	= 'English (Jamaica)';
		$langCode['en-nz']	= 'English (New Zealand)';
		$langCode['en-za']	= 'English (South Africa)';
		$langCode['en-tt']	= 'English (Trinidad)';
		$langCode['en-gb']	= 'English (United Kingdom)';
		$langCode['en-us']	= 'English (United States)';
		$langCode['et']		= 'Estonian';
		$langCode['fo']		= 'Faeroese';
		$langCode['fa']		= 'Farsi';
		$langCode['fi']		= 'Finnish';
		$langCode['fi-fi']	= 'Finnish (Finland)';
		$langCode['fr-be']	= 'French (Belgium)';
		$langCode['fr-ca']	= 'French (Canada)';
		$langCode['fr-lu']	= 'French (Luxembourg)';
		$langCode['fr']		= 'French (Standard)';
		$langCode['fr-fr']	= 'French (France)';
		$langCode['fr-ch']	= 'French (Switzerland)';
		$langCode['mk']		= 'FYRO Macedonian';
		$langCode['gd-ie']	= 'Gaelic (Ireland)';
		$langCode['gd']		= 'Gaelic (Scotland)';
		$langCode['de']		= 'German (Standard)';
		$langCode['de-de']	= 'German (Standard)';
		$langCode['de-at']	= 'German (Austria)';
		$langCode['de-li']	= 'German (Liechtenstein)';
		$langCode['de-lu']	= 'German (Luxembourg)';
		$langCode['de-ch']	= 'German (Switzerland)';
		$langCode['el']		= 'Greek';
		$langCode['he']		= 'Hebrew';
		$langCode['hi']		= 'Hindi';
		$langCode['hu']		= 'Hungarian';
		$langCode['hu-hu']	= 'Hungarian (Standard)';
		$langCode['is']		= 'Icelandic';
		$langCode['id']		= 'Indonesian';
		$langCode['it']		= 'Italian';
		$langCode['it-it']	= 'Italian (Standard)';
		$langCode['it-ch']	= 'Italian (Switzerland)';
		$langCode['ja']		= 'Japanese';
		$langCode['ja-jp']	= 'Japanese (Japan)';
		$langCode['ko']		= 'Korean';
		$langCode['ko-kr']	= 'Korean (Korea)';
		$langCode['ko']		= 'Korean (Johab)';
		$langCode['lv']		= 'Latvian';
		$langCode['lt']		= 'Lithuanian';
		$langCode['ms']		= 'Malaysian';
		$langCode['mt']		= 'Maltese';
		$langCode['no']		= 'Norwegian (Bokmal)';
		$langCode['no-no']	= 'Norwegian (Bokmal)';
		$langCode['nb']		= 'Norwegian (Bokmal)';
		$langCode['nn']		= 'Norwegian (Nynorsk)';
		$langCode['pl']		= 'Polish';
		$langCode['pt-br']	= 'Portuguese (Brazil)';
		$langCode['pt-pt']	= 'Portuguese (Portugal)';
		$langCode['pt']		= 'Portuguese (Standard)';
		$langCode['rm']		= 'Rhaeto-Romanic';
		$langCode['ro']		= 'Romanian';
		$langCode['ro-mo']	= 'Romanian (Moldavia)';
		$langCode['ru']		= 'Russian';
		$langCode['ru-ru']	= 'Russian (Standard)';
		$langCode['ru-mo']	= 'Russian (Moldavia)';
		$langCode['sz']		= 'Sami (Lappish)';
		$langCode['sr']		= 'Serbian (Cyrillic)';
		$langCode['sr']		= 'Serbian (Latin)';
		$langCode['sk']		= 'Slovak';
		$langCode['sl']		= 'Slovenian';
		$langCode['sb']		= 'Sorbian';
		$langCode['es-ar']	= 'Spanish (Argentina)';
		$langCode['es-bo']	= 'Spanish (Bolivia)';
		$langCode['es-cl']	= 'Spanish (Chile)';
		$langCode['es-co']	= 'Spanish (Colombia)';
		$langCode['es-cr']	= 'Spanish (Costa Rica)';
		$langCode['es-do']	= 'Spanish (Dominican Republic)';
		$langCode['es-ec']	= 'Spanish (Ecuador)';
		$langCode['es-sv']	= 'Spanish (El Salvador)';
		$langCode['es-es']	= 'Spanish (Spain)';
		$langCode['es-gt']	= 'Spanish (Guatemala)';
		$langCode['es-hn']	= 'Spanish (Honduras)';
		$langCode['es-mx']	= 'Spanish (Mexico)';
		$langCode['es-ni']	= 'Spanish (Nicaragua)';
		$langCode['es-pa']	= 'Spanish (Panama)';
		$langCode['es-py']	= 'Spanish (Paraguay)';
		$langCode['es-pe']	= 'Spanish (Peru)';
		$langCode['es-pr']	= 'Spanish (Puerto Rico)';
		$langCode['es']		= 'Spanish (Spain Modern)';
		$langCode['es']		= 'Spanish (Spain Traditional)';
		$langCode['es-uy']	= 'Spanish (Uruguay)';
		$langCode['es-us']	= 'Spanish (United States)';
		$langCode['es-ve']	= 'Spanish (Venezuela)';
		$langCode['sx']		= 'Sutu';
		$langCode['sv']		= 'Swedish';
		$langCode['sv-se']	= 'Swedish';
		$langCode['sv-fi']	= 'Swedish (Finland)';
		$langCode['th']		= 'Thai';
		$langCode['ts']		= 'Tsonga';
		$langCode['tn']		= 'Tswana';
		$langCode['tr']		= 'Turkish';
		$langCode['uk']		= 'Ukrainian';
		$langCode['ur']		= 'Urdu';
		$langCode['us']		= 'English (United States)';
		$langCode['ve']		= 'Venda';
		$langCode['vi']		= 'Vietnamese';
		$langCode['xh']		= 'Xhosa';
		$langCode['ji']		= 'Yiddish';
		$langCode['zh']		= 'Chinese Simplified';
		$langCode['zh-Hans']= 'Chinese Simplified';
		$langCode['zh-Hant']= 'Chinese Simplified';
		$langCode['zh-tw']	= 'Chinese Traditional';
		$langCode['zu']		= 'Zulu';
		$langCode['*']		= 'all languages are equally acceptable';
		
		//EXTRAS
		$langCode['ie-ee']	= 'Internet Explorer - Easter Egg';
		$lang = strtolower($lang);
		if(isset($langCode[$lang])){
			return $langCode[$lang];
		}elseif(isset($langCode[str_replace('-','_',$lang)])){
			return $langCode[str_replace('_','-',$lang)];
		} else {
			return '';
		}
	}
	public function is_crawler(){
		return $this->browser('is_crawler');
	}
}
/*
sample on how to use this class:
<?php
//sample on how o use user_info
require_once dirname(__FILE__).'/user_info.php';
$uinfo = new user_info();
?>Hello!<br />
Here a few info about you
<ul>
<li>IP: <?php $uinfo->IP();?></li>
<li>OS: <?php $uinfo->os();?>
	<ul>
		<li>name: <?php $uinfo->os('name');?></li>
		<li>version: <?php $uinfo->os('version');?></li>
	</ul>
</li>
<li>Are you a spider/robot: <?php $uinfo->is_crawler()?'Yes':'No'?></li>
<li>Browser: <?php $uinfo->browser();?>
	<ul>
		<li>name: <?php $uinfo->browser('name');?></li>
		<li>version: <?php $uinfo->browser('version');?></li>
		<li>Is Crawler: <?php $uinfo->browser('is_crawler')?'Yes':'No'?></li>
	</ul>
</li>
<li>Bits: <?php $uinfo->bits();?></li>
<li>Security: <?php $uinfo->security();?></li>
<li>Languages:
	<ul><?php
	$tmps = $uinfo->language();
	foreach($tmps as $k=>$v){
		?><li>code: <?php $v['code']?></li>
		<li>name: <?php $v['name']?></li>
		<li>QValue: <?php $v['QValue']?></li><?php
	}
	?></ul>
</li>
<li>Accept:
	<ul><?php
	$tmps = $uinfo->accept();
	foreach($tmps as $k=>$v){
		?><li>code: <?php $v['code']?></li>
		<li>QValue: <?php $v['QValue']?></li><?php
	}
	?></ul>
</li>
<li>Encodings:
	<ul><?php
	$tmps = $uinfo->encoding();
	foreach($tmps as $k=>$v){
		?><li>code: <?php $v['code']?></li>
		<li>QValue: <?php $v['QValue']?></li><?php
	}
	?></ul>
</li>
<li>Charsets:
	<ul><?php
	$tmps = $uinfo->charset();
	foreach($tmps as $k=>$v){
		?><li>code: <?php $v['code']?></li>
		<li>QValue: <?php $v['QValue']?></li><?php
	}
	?></ul>
</li>
<li>Your User Agent: <?php $uinfo->user_agent()?></li>
<li>Requested Page: <?php $uinfo->request_page()?></li>
<li>Request Method: <?php $uinfo->request_method()?></li>
<li>This URL: <?php $uinfo->url()?></li>
</ul>


*/
?>
