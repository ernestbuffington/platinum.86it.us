<?php
# $Author: ejd $
# $Date: 2004/2/7 12:25:00 $
/*******************************************************************************/
/* PHP-NUKE Addon : NukeAmazon Module                                          */
/* ==================================                                          */
/* Version: 2.7                                                                */
/* Copyright (c)2002-2004 by Edgardo J. Diaz (ejdiaz@preciogasolina.com)       */
/* http://preciogasolina.com                                                   */
/*                                                                             */
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
/*
    AmazonLiteXMLParser ver 1.0.2
    Author: Daniel Kushner
    Email: daniel@amazonlite.com
    Release: 20 July, 2002
    http://www.amazonlite.com/
    Last Update: 10 November, 2002

	Modified by Edgardo J. Diaz
	http://preciogasolina.com
	To add new fields returned by AWS
	April 20, 2003
  
*/
define('AMAZON_FIELD_TYPE_SINGLE', 1);
define('AMAZON_FIELD_TYPE_ARRAY', 2);
define('AMAZON_FIELD_TYPE_CONTAINER', 3);

class AmazonLiteXMLParser {
    
    var $parser;
    var $record;
    var $currentField = '';
    var $fieldType;
    var $endsRecord;
    var $errorRecord;
    var $errorMsg;
    var $records;
    var $wroteElementData = false;
    
    function AmazonLiteXMLParser($xml, $xml_end) {

/*
        $xml = preg_replace(array('/&amp;/',
                                  '/<p>/i', 
                                  '/<strong>/i', 
                                  '/\'/', 
                                  '/\<br\>/i', 
                                  '/&/'), 
                            array('and', 
                                  '', 
                                  '', 
                                  '', 
                                  ''), trim($xml));
*/
		$this->records = array();
        
        $this->parser = xml_parser_create();
        xml_set_object($this->parser, $this);
        xml_set_element_handler($this->parser, 'startElement', 'EndElement');
        xml_set_character_data_handler($this->parser, 'cdata');

        $this->fieldType = array('errormsg'         => AMAZON_FIELD_TYPE_SINGLE,
			'title'                    => AMAZON_FIELD_TYPE_SINGLE,
			'authors'                  => AMAZON_FIELD_TYPE_CONTAINER,
			'author'                   => AMAZON_FIELD_TYPE_ARRAY,
			'tracks'                   => AMAZON_FIELD_TYPE_CONTAINER,
			'track'                    => AMAZON_FIELD_TYPE_ARRAY,
			'asin'                     => AMAZON_FIELD_TYPE_SINGLE,
			'totalresults'             => AMAZON_FIELD_TYPE_SINGLE,
			'totalpages'               => AMAZON_FIELD_TYPE_SINGLE,
			'isbn'                     => AMAZON_FIELD_TYPE_SINGLE,
			'media'                    => AMAZON_FIELD_TYPE_SINGLE,
			'productname'              => AMAZON_FIELD_TYPE_SINGLE,
			'catalog'                  => AMAZON_FIELD_TYPE_SINGLE,
			'releasedate'              => AMAZON_FIELD_TYPE_SINGLE,
			'manufacturer'             => AMAZON_FIELD_TYPE_SINGLE,
			'imageurlsmall'            => AMAZON_FIELD_TYPE_SINGLE,
			'imageurlmedium'           => AMAZON_FIELD_TYPE_SINGLE,
			'imageurllarge'            => AMAZON_FIELD_TYPE_SINGLE,
			'listprice'                => AMAZON_FIELD_TYPE_SINGLE,
			'ourprice'                 => AMAZON_FIELD_TYPE_SINGLE,
			'usedprice'                => AMAZON_FIELD_TYPE_SINGLE,
			'thirdpartynewprice'       => AMAZON_FIELD_TYPE_SINGLE,
			'refurbishedprice'         => AMAZON_FIELD_TYPE_SINGLE,
			'mpn'                      => AMAZON_FIELD_TYPE_SINGLE,
			'upc'                      => AMAZON_FIELD_TYPE_SINGLE,
			'productdescription'       => AMAZON_FIELD_TYPE_SINGLE,
			'collectibleprice'         => AMAZON_FIELD_TYPE_SINGLE,
			'refurbishedprice'         => AMAZON_FIELD_TYPE_SINGLE,
			'salesrank'                => AMAZON_FIELD_TYPE_SINGLE,
			'media'                    => AMAZON_FIELD_TYPE_SINGLE,
			'nummedia'                 => AMAZON_FIELD_TYPE_SINGLE,
			'availability'             => AMAZON_FIELD_TYPE_SINGLE,
			'avgcustomerrating'        => AMAZON_FIELD_TYPE_SINGLE,
			'totalcustomerreviews'     => AMAZON_FIELD_TYPE_SINGLE,
			'agegroup'                 => AMAZON_FIELD_TYPE_SINGLE,
			'rating'                   => AMAZON_FIELD_TYPE_ARRAY,
			'summary'                  => AMAZON_FIELD_TYPE_ARRAY,
			'comment'                  => AMAZON_FIELD_TYPE_ARRAY,
			'product'                  => AMAZON_FIELD_TYPE_ARRAY,
			'directors'                => AMAZON_FIELD_TYPE_CONTAINER, 
			'director'                 => AMAZON_FIELD_TYPE_ARRAY,
			'starring'                 => AMAZON_FIELD_TYPE_CONTAINER, 
			'actor'                    => AMAZON_FIELD_TYPE_ARRAY,
			'mpaarating'               => AMAZON_FIELD_TYPE_SINGLE,
			'artists'                  => AMAZON_FIELD_TYPE_CONTAINER,
			'artist'                   => AMAZON_FIELD_TYPE_ARRAY,
			'platforms'                => AMAZON_FIELD_TYPE_CONTAINER, 
			'platform'                 => AMAZON_FIELD_TYPE_ARRAY,
			'esrbrating'               => AMAZON_FIELD_TYPE_SINGLE,
			'lists'                    => AMAZON_FIELD_TYPE_CONTAINER, 
			'listid'                   => AMAZON_FIELD_TYPE_ARRAY,	
			'accessories'              => AMAZON_FIELD_TYPE_CONTAINER, 
			'accessory'                => AMAZON_FIELD_TYPE_ARRAY,
			'similarproducts'          => AMAZON_FIELD_TYPE_CONTAINER, 
			'product'                  => AMAZON_FIELD_TYPE_ARRAY,	
			'browsenode'               => AMAZON_FIELD_TYPE_CONTAINER, 
			'browsename'               => AMAZON_FIELD_TYPE_ARRAY,	
			'browseid'                 => AMAZON_FIELD_TYPE_ARRAY,	
			'productline'              => AMAZON_FIELD_TYPE_CONTAINER,
			'mode'                     => AMAZON_FIELD_TYPE_ARRAY,
			'details'                  => AMAZON_FIELD_TYPE_ARRAY,
			'productinfo'              => AMAZON_FIELD_TYPE_ARRAY,
			'numberofofferings'        => AMAZON_FIELD_TYPE_SINGLE,
            'thirdpartynewcount'       => AMAZON_FIELD_TYPE_SINGLE,
            'usedcount'                => AMAZON_FIELD_TYPE_SINGLE,
            'collectiblecount'         => AMAZON_FIELD_TYPE_SINGLE,
			'thirdpartyproductinfo'    => AMAZON_FIELD_TYPE_CONTAINER,
			'thirdpartyproductdetails' => AMAZON_FIELD_TYPE_CONTAINER,
			'sellerprofiledetails'     => AMAZON_FIELD_TYPE_CONTAINER,
			'sellerid'                 => AMAZON_FIELD_TYPE_ARRAY,
			'sellernickname'           => AMAZON_FIELD_TYPE_ARRAY,
			'exchangeid'               => AMAZON_FIELD_TYPE_ARRAY,
			'offeringprice'            => AMAZON_FIELD_TYPE_ARRAY,
			'condition'                => AMAZON_FIELD_TYPE_ARRAY,
			'conditiontype'            => AMAZON_FIELD_TYPE_ARRAY,
			'exchangeavailability'     => AMAZON_FIELD_TYPE_ARRAY,
			'sellercountry'            => AMAZON_FIELD_TYPE_ARRAY,
			'sellerstate'              => AMAZON_FIELD_TYPE_ARRAY,
			'shipcomments'             => AMAZON_FIELD_TYPE_ARRAY,
			'sellerrating'             => AMAZON_FIELD_TYPE_ARRAY,
			'sellerprofiledetails'     => AMAZON_FIELD_TYPE_CONTAINER,
			'sellerfeedback'           => AMAZON_FIELD_TYPE_CONTAINER,
			'feedback'                 => AMAZON_FIELD_TYPE_CONTAINER,
			'overallfeedbackrating'    => AMAZON_FIELD_TYPE_SINGLE,
			'numberoffeedback'         => AMAZON_FIELD_TYPE_SINGLE,
			'storename'                => AMAZON_FIELD_TYPE_SINGLE,
			'storeid'                  => AMAZON_FIELD_TYPE_SINGLE,
			'feedbackrating'           => AMAZON_FIELD_TYPE_ARRAY,
			'feedbackcomments'         => AMAZON_FIELD_TYPE_ARRAY,
			'feedbackdate'             => AMAZON_FIELD_TYPE_ARRAY,
			'feedbackrater'            => AMAZON_FIELD_TYPE_ARRAY,
			'features'                 => AMAZON_FIELD_TYPE_CONTAINER, 
			'feature'                  => AMAZON_FIELD_TYPE_ARRAY);

		$this->endsRecord   = array($xml_end => true);
        $this->errorRecord  = array('errormsg' => true);
        
        xml_parse($this->parser, $xml);
        xml_parser_free($this->parser);
    }
    
    function startElement($p, $element, &$attributes) {
        $element =strtolower($element);

        if(isset($attributes['URL'])) {
            $this->record['url'] = $attributes['URL'];   
        }
            
        if(isset($this->fieldType[$element])) {
            $this->currentField = $element;
            
        } else {
            $this->currentField = '';
        }
        
        $this->wroteElementData = false;
    }
    
    function endElement($p, $element) {
        $element =strtolower($element);
        if(isset($this->endsRecord[$element])) {
            $this->records[] = $this->record;
            $this->record = array();
        }
        $this->currentField = '';
    }
    
    function cdata($p, $text) {
        $text = preg_replace('/lt;([a-z]+\>)/i', '<\\1', $text);
        
        if(isset($this->errorRecord[$this->currentField])) {
            $this->errorMsg = $text;
        }
        
        if(@$this->fieldType[$this->currentField] === AMAZON_FIELD_TYPE_CONTAINER) {
            
        } elseif(@$this->fieldType[$this->currentField] === AMAZON_FIELD_TYPE_ARRAY) {
            $lastIndex = @count($this->record[$this->currentField]) - 1;
            $this->wroteElementData ? 
                @$this->record[$this->currentField][$lastIndex] .= $text :
                @$this->record[$this->currentField][$lastIndex+1] = $text ;
        } elseif(@$this->fieldType[$this->currentField] === AMAZON_FIELD_TYPE_SINGLE) {
            @$this->record[$this->currentField] .= $text;
        }
        $this->wroteElementData = true;
    }
}
?>