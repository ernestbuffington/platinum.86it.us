<?php
/**
 *  @class: InputFilter (PHP4 & PHP5, with comments)
 * @project: PHP Input Filter
 * @date: 10-05-2005
 * @version: 1.2.2_php4/php5
 * @author: Daniel Morris
 * @contributors: Gianpaolo Racca, Ghislain Picard, Marco Wandschneider, Chris
 * Tobin and Andrew Eddie.
 * 
 * Modification by Louis Landry
 *
 * Modified by Brian Neal for GCalendar 25-Nov-2006; 
 * Started with Joomla version w/Louis Landry changes, then added:
 * 1) escapeString() does a nl2br() and removes all \n and \r from string
 * 2) removed unused $connection parameters
 * 3) tweaked the remove() function so it would call filterTags() less often
 * 4) minor code formatting / comment changes
 * 5) Renamed to GCInputFilter to avoid collisions with Nuke Evolution's class
 *    of the same name.
 * 6) Added a charset member variable and get/set functions for use when 
 *    calling html_entity_decode()
 * 
 * @copyright: Daniel Morris
 * @email: dan@rootcube.com
 * @license: GNU General Public License (GPL)
 */
class GCInputFilter
{
   var $tagsArray; // default = empty array
   var $attrArray; // default = empty array

   var $tagsMethod; // 0 - allow only user-defined; 1 - allow all but user-defined
   var $attrMethod; // 0 - allow only user-defined; 1 - allow all but user-defined

   var $xssAuto; // 0 - only auto clean essentials; 1 - allow clean of blacklisted tags/attrs
   var $tagBlacklist = array ('applet', 'body', 'bgsound', 'base', 'basefont', 'embed', 'frame', 'frameset', 
                              'head', 'html', 'id', 'iframe', 'ilayer', 'layer', 'link', 'meta', 'name', 
                              'object', 'script', 'style', 'title', 'xml');
   var $attrBlacklist = array ('action', 'background', 'codebase', 'dynsrc', 'lowsrc'); // also will strip ALL event handlers

   var $doNl2br = true;
   var $charset = 'ISO-8859-1';

   /**
    * Constructor for inputFilter class. 
    * 
    * @access  public
    * @param   array $tagsArray  list of user-defined tags
    * @param   array $attrArray  list of user-defined attributes
    * @param   int      $tagsMethod WhiteList method = 0, BlackList method = 1
    * @param   int      $attrMethod WhiteList method = 0, BlackList method = 1
    * @param   int      $xssAuto Only auto clean essentials = 0, Allow clean
    * blacklisted tags/attr = 1
    */
   function GCInputFilter($tagsArray = array (), 
                          $attrArray = array (), 
                          $tagsMethod = 0, 
                          $attrMethod = 0, 
                          $xssAuto = 1,
                          $charset = 'ISO-8859-1')
   {
      /*
       * Make sure user defined arrays are in lowercase
       */
      $tagsArray = array_map('strtolower', (array) $tagsArray);
      $attrArray = array_map('strtolower', (array) $attrArray);

      /*
       * Assign member variables
       */
      $this->tagsArray  = $tagsArray;
      $this->attrArray  = $attrArray;
      $this->tagsMethod = $tagsMethod;
      $this->attrMethod = $attrMethod;
      $this->xssAuto    = $xssAuto;
      $this->charset    = $charset;
   }

   /**
    * Method to be called by another php script. Processes for XSS and
    * specified bad code.
    * 
    * @access  public
    * @param   mixed $source  Input string/array-of-string to be 'cleaned'
    * @return mixed  $source  'cleaned' version of input parameter
    */
   function process($source)
   {
      /*
       * Are we dealing with an array?
       */
      if (is_array($source))
      {
         foreach ($source as $key => $value)
         {
            // filter element for XSS and other 'bad' code etc.
            if (is_string($value) && !empty($value))
            {
               $source[$key] = $this->remove($this->decode($value));
            }
         }
         return $source;
      } 
      else if (is_string($source) && !empty($source))
      {
         // filter source for XSS and other 'bad' code etc.
         return $this->remove($this->decode($source));
      } 
      /*
       * Not an array or string.. return the passed parameter
       */
      return $source;
   }

   /**
    * Internal method to iteratively remove all unwanted tags and attributes
    * 
    * @access  protected
    * @param   string   $source  Input string to be 'cleaned'
    * @return  string   $source  'cleaned' version of input parameter
    */
   function remove($source)
   {
      /*
       * Iteration provides nested tag protection
       */
      while ($source != ($str = $this->filterTags($source)))
      {
         $source = $str;
      }
      return $source;
   }

   /**
    * Internal method to strip a string of certain tags
    * 
    * @access  protected
    * @param   string   $source  Input string to be 'cleaned'
    * @return  string   $source  'cleaned' version of input parameter
    */
   function filterTags($source)
   {
      /*
       * In the beginning we don't really have a tag, so everything is
       * postTag
       */
      $preTag     = null;
      $postTag = $source;

      /*
       * Is there a tag? If so it will certainly start with a '<'
       */
      $tagOpen_start = strpos($source, '<');

      while ($tagOpen_start !== false)
      {

         /*
          * Get some information about the tag we are processing
          */
         $preTag        .= substr($postTag, 0, $tagOpen_start);
         $postTag    = substr($postTag, $tagOpen_start);
         $fromTagOpen   = substr($postTag, 1);
         $tagOpen_end   = strpos($fromTagOpen, '>');

         /*
          * Let's catch any non-terminated tags and skip over them
          */
         if ($tagOpen_end === false)
         {
            $postTag    = substr($postTag, $tagOpen_start +1);
            $tagOpen_start = strpos($postTag, '<');
            continue;
         }

         /*
          * Do we have a nested tag?
          */
         $tagOpen_nested = strpos($fromTagOpen, '<');
         $tagOpen_nested_end  = strpos(substr($postTag, $tagOpen_end), '>');
         if (($tagOpen_nested !== false) && ($tagOpen_nested < $tagOpen_end))
         {
            $preTag        .= substr($postTag, 0, ($tagOpen_nested +1));
            $postTag    = substr($postTag, ($tagOpen_nested +1));
            $tagOpen_start = strpos($postTag, '<');
            continue;
         }


         /*
          * Lets get some information about our tag and setup attribute pairs
          */
         $tagOpen_nested   = (strpos($fromTagOpen, '<') + $tagOpen_start +1);
         $currentTag    = substr($fromTagOpen, 0, $tagOpen_end);
         $tagLength     = strlen($currentTag);
         $tagLeft    = $currentTag;
         $attrSet    = array ();
         $currentSpace  = strpos($tagLeft, ' ');

         /*
          * Are we an open tag or a close tag?
          */
         if (substr($currentTag, 0, 1) == "/")
         {
            // Close Tag
            $isCloseTag    = true;
            list ($tagName)   = explode(' ', $currentTag);
            $tagName    = substr($tagName, 1);
         } else
         {
            // Open Tag
            $isCloseTag    = false;
            list ($tagName)   = explode(' ', $currentTag);
         }

         /*
          * Exclude all "non-regular" tagnames 
          * OR no tagname 
          * OR remove if xssauto is on and tag is blacklisted
          */
         if ((!preg_match("/^[a-z][a-z0-9]*$/i", $tagName)) || (!$tagName) || ((in_array(strtolower($tagName), $this->tagBlacklist)) && ($this->xssAuto)))
         {
            $postTag    = substr($postTag, ($tagLength +2));
            $tagOpen_start = strpos($postTag, '<');
            // Strip tag
            continue;
         }

         /*
          * Time to grab any attributes from the tag... need this section in
          * case attributes have spaces in the values.
          */
         while ($currentSpace !== false)
         {
            $fromSpace     = substr($tagLeft, ($currentSpace +1));
            $nextSpace     = strpos($fromSpace, ' ');
            $openQuotes    = strpos($fromSpace, '"');
            $closeQuotes   = strpos(substr($fromSpace, ($openQuotes +1)), '"') + $openQuotes +1;

            /*
             * Do we have an attribute to process? [check for equal sign]
             */
            if (strpos($fromSpace, '=') !== false)
            {
               /*
                * If the attribute value is wrapped in quotes we need to
                * grab the substring from the closing quote, otherwise grab
                * till the next space
                */
               if (($openQuotes !== false) && (strpos(substr($fromSpace, ($openQuotes +1)), '"') !== false))
               {
                  $attr = substr($fromSpace, 0, ($closeQuotes +1));
               } else
               {
                  $attr = substr($fromSpace, 0, $nextSpace);
               }
            } else
            {
               /*
                * No more equal signs so add any extra text in the tag into
                * the attribute array [eg. checked]
                */
               $attr = substr($fromSpace, 0, $nextSpace);
            }

            // Last Attribute Pair
            if (!$attr)
            {
               $attr = $fromSpace;
            }

            /*
             * Add attribute pair to the attribute array
             */
            $attrSet[] = $attr;

            /*
             * Move search point and continue iteration
             */
            $tagLeft    = substr($fromSpace, strlen($attr));
            $currentSpace  = strpos($tagLeft, ' ');
         }

         /*
          * Is our tag in the user input array?
          */
         $tagFound = in_array(strtolower($tagName), $this->tagsArray);

         /*
          * If the tag is allowed lets append it to the output string
          */
         if ((!$tagFound && $this->tagsMethod) || ($tagFound && !$this->tagsMethod))
         {
            /*
             * Reconstruct tag with allowed attributes
             */
            if (!$isCloseTag)
            {
               // Open or Single tag
               $attrSet = $this->filterAttr($attrSet);
               $preTag .= '<'.$tagName;
               for ($i = 0; $i < count($attrSet); $i ++)
               {
                  $preTag .= ' '.$attrSet[$i];
               }

               /*
                * Reformat single tags to XHTML
                */
               if (strpos($fromTagOpen, "</".$tagName))
               {
                  $preTag .= '>';
               } else
               {
                  $preTag .= ' />';
               }
            } else
            {
               // Closing Tag
               $preTag .= '</'.$tagName.'>';
            }
         }

         /*
          * Find next tag's start and continue iteration
          */
         $postTag    = substr($postTag, ($tagLength +2));
         $tagOpen_start = strpos($postTag, '<');
         //print "T: $preTag\n";
      }

      /*
       * Append any code after the end of tags and return
       */
      if ($postTag != '<')
      {
         $preTag .= $postTag;
      }
      return $preTag;
   }

   /**
    * Internal method to strip a tag of certain attributes
    * 
    * @access  protected
    * @param   array $attrSet Array of attribute pairs to filter
    * @return  array $newSet     Filtered array of attribute pairs
    */
   function filterAttr($attrSet)
   {
      /*
       * Initialize variables
       */
      $newSet = array ();

      /*
       * Iterate through attribute pairs
       */
      for ($i = 0; $i < count($attrSet); $i ++)
      {
         /*
          * Skip blank spaces
          */
         if (!$attrSet[$i])
         {
            continue;
         }

         /*
          * Split into name/value pairs
          */
         $attrSubSet = explode('=', trim($attrSet[$i]), 2);
         list ($attrSubSet[0]) = explode(' ', $attrSubSet[0]);

         /*
          * Remove all "non-regular" attribute names
          * AND blacklisted attributes
          */
         if ((!eregi("^[a-z]*$", $attrSubSet[0])) || (($this->xssAuto) && ((in_array(strtolower($attrSubSet[0]), $this->attrBlacklist)) || (substr($attrSubSet[0], 0, 2) == 'on'))))
         {
            continue;
         }

         /*
          * XSS attribute value filtering
          */
         if ($attrSubSet[1])
         {
            // strips unicode, hex, etc
            $attrSubSet[1] = str_replace('&#', '', $attrSubSet[1]);
            // strip normal newline within attr value
            $attrSubSet[1] = preg_replace('/\s+/', '', $attrSubSet[1]);
            // strip double quotes
            $attrSubSet[1] = str_replace('"', '', $attrSubSet[1]);
            // [requested feature] convert single quotes from either side to doubles (Single quotes shouldn't be used to pad attr value)
            if ((substr($attrSubSet[1], 0, 1) == "'") && (substr($attrSubSet[1], (strlen($attrSubSet[1]) - 1), 1) == "'"))
            {
               $attrSubSet[1] = substr($attrSubSet[1], 1, (strlen($attrSubSet[1]) - 2));
            }
            // strip slashes
            $attrSubSet[1] = stripslashes($attrSubSet[1]);
         }

         /*
          * Autostrip script tags
          */
         if (GCInputFilter::badAttributeValue($attrSubSet))
         {
            continue;
         }

         /*
          * Is our attribute in the user input array?
          */
         $attrFound = in_array(strtolower($attrSubSet[0]), $this->attrArray);

         /*
          * If the tag is allowed lets keep it
          */
         if ((!$attrFound && $this->attrMethod) || ($attrFound && !$this->attrMethod))
         {
            /*
             * Does the attribute have a value?
             */
            if ($attrSubSet[1])
            {
               $newSet[] = $attrSubSet[0].'="'.$attrSubSet[1].'"';
            }
            elseif ($attrSubSet[1] == "0")
            {
               /*
                * Special Case
                * Is the value 0?
                */
               $newSet[] = $attrSubSet[0].'="0"';
            } else
            {
               $newSet[] = $attrSubSet[0].'="'.$attrSubSet[0].'"';
            }
         }
      }
      return $newSet;
   }

   /**
    * Function to determine if contents of an attribute is safe
    * 
    * @access  protected
    * @param   array $attrSubSet A 2 element array for attributes name,value
    * @return  boolean True if bad code is detected
    */
   function badAttributeValue($attrSubSet)
   {
      $attrSubSet[0] = strtolower($attrSubSet[0]);
      $attrSubSet[1] = strtolower($attrSubSet[1]);
      return (((strpos($attrSubSet[1], 'expression') !== false) && ($attrSubSet[0]) == 'style') || (strpos($attrSubSet[1], 'javascript:') !== false) || (strpos($attrSubSet[1], 'behaviour:') !== false) || (strpos($attrSubSet[1], 'vbscript:') !== false) || (strpos($attrSubSet[1], 'mocha:') !== false) || (strpos($attrSubSet[1], 'livescript:') !== false));
   }

   /**
    * Try to convert to plaintext
    * 
    * @access  protected
    * @param   string   $source
    * @return  string   Plaintext string
    */
   function decode($source)
   {
      // url decode
      $source = html_entity_decode($source, ENT_QUOTES, $this->charset);
      // convert decimal
      $source = preg_replace('/&#(\d+);/me', "chr(\\1)", $source); // decimal notation
      // convert hex
      $source = preg_replace('/&#x([a-f0-9]+);/mei', "chr(0x\\1)", $source); // hex notation
      return $source;
   }

   /**
    * Method to configure nl2br() behavior when processing text for saving in the database.
    *
    * @access public
    * @param to - true when nl2br() and removal of \n and \r should be performed; false otherwise
    */
   function nl2br($to)
   {
      $this->doNl2br = $to;
   }

   /**
    * Set the charset
    * @access public
    * @param string charset as per htmlentities() charset argument; e.g. 'ISO-8859-1'
    */
   function setCharset($to)
   {
      $this->charset = $to;
   }

   /**
    * Get the charset
    * @access public
    * @return string charset as per htmlentities() charset argument; e.g. 'ISO-8859-1'
    */
   function getCharset()
   {
      return $this->charset;
   }

   /**
    * Method to be called by another php script. Processes for SQL injection
    * 
    * @access  public
    * @param   mixed    $source  input string/array-of-string to be 'cleaned'
    * @return  string      'cleaned' version of input parameter
    */
   function safeSQL($source)
   {
      // clean all elements in this array
      if (is_array($source))
      {
         foreach ($source as $key => $value)
         {
            // filter element for SQL injection
            if (is_string($value))
            {
               $source[$key] = $this->quoteSmart($this->decode($value));
            }
         }
         return $source;
         // clean this string
      } 
      else if (is_string($source))
      {
         return $this->quoteSmart($this->decode($source));
      }

      // return parameter as given
      return $source;
   }

   /**
    * Method to escape a string
    * 
    * @author  Chris Tobin
    * @author  Daniel Morris
    * 
    * @access  protected
    * @param   string      $source
    * @return  string      Escaped string
    */
   function quoteSmart($source)
   {
      /*
       * Strip escaping slashes if necessary
       */
      if (get_magic_quotes_gpc())
      {
         $source = stripslashes($source);
      }

      /*
       * Escape numeric and text values
       */
      $source = $this->escapeString($source);
      return $source;
   }

   /**
    * @author  Chris Tobin
    * @author  Daniel Morris
    * 
    * @access  protected
    * @param   string      $source
    * @return  string      Escaped string
    */
   function escapeString($string) 
   {
      if ($this->doNl2br)
      {
         $string = nl2br($string);

         // get rid of \n and \r

         $string = str_replace(array("\n", "\r"), '', $string);
      }

      /*
       * Use the appropriate escape string depending upon which version of php
       * you are running
       */
      if (version_compare(phpversion(), '4.3.0', '<')) 
      {
         $string = mysql_escape_string($string);
      } 
      else 
      {
         $string = mysql_real_escape_string($string);
      }
      
      return $string;
   }
}
?>
