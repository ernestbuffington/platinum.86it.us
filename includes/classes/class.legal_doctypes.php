<?php

/**
 * RavenNuke(tm) Legal Document Types: Used to Present Menu List of Documents
 *
 * This script was created for the re-write of the Legal module for RavenNuke(tm) only.
 * This script can be used within block, theme, or other module / script to show the
 * active legal documents links wherever is desired. As of this release, there really
 * is no control over the formatting of the menu HTML, but the html() method was written
 * to only produce the anchors, so one could wrap the html within a DIV tag and format as
 * one pleases.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     RavenNuke(tm)
 * @subpackage  Legal Documents
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://ravenphpscripts.com
 * @link        http://montegoscripts.com
 * @since       2.30.00
 */
/**
 * Define key constants and variables for the entire package
 */
if (!defined('LGL_MID_TYPE')) define('LGL_MID_TYPE', 2);
if (!isset($lgl_lang['LGL_COM_CONTACTMENU'])) {
	global $currentlang, $language;
	$lgl_modPath = INCLUDE_PATH . 'modules/Legal/';
	$lgl_langS = 'english';
	if (file_exists($lgl_modPath . 'language/lang-' . $currentlang . '.php')) {
		include_once $lgl_modPath . 'language/lang-' . $currentlang . '.php';
		$lgl_langS = $currentlang;
	} elseif (file_exists($lgl_modPath . 'language/lang-' . $language . '.php')) {
		include_once $lgl_modPath . 'language/lang-' . $language . '.php';
		$lgl_langS = $language;
	} elseif (file_exists($lgl_modPath . 'language/lang-english.php')) { // Default module lang
		include_once $lgl_modPath . 'language/lang-english.php';
	}
}
if (!defined('_LGL_COM_CONTACTMENU')) define('_LGL_COM_CONTACTMENU', $lgl_lang['LGL_COM_CONTACTMENU']);
if (!defined('_LGL_COM_ADMINMENU')) define('_LGL_COM_ADMINMENU', $lgl_lang['LGL_COM_ADMINMENU']);
/**
 * Legal Document Types
 */
class Legal_DocTypes
{
	/**
	 * List of document names (types)
	 *
	 * @var array
	 */
	var $docTypes = array();
	/**
	 * List of document titles associated with the type
	 *
	 * @var array
	 */
	var $docTypeText = array();
	/**
	 * Various variables needed for normal operations - yes, I am lazy
	 *
	 * @var mixed
	 */
	var $numTypes = 0;
	var $showContact = false;
	var $lang = 'english';
	var $modName = 'Legal';
	var $labContact = 'Comments';

	/**
	 * Class constructor
	 *
	 * Retrieves the values for document names and associated titles.
	 *
	 * @param  string  $modName is the Module name this object request is for
	 * @param  string  $lang is the user's current language, otherwise will default to 'english'
	 * @global string  $prefix is the table prefix set in config.php
	 * @global integer $db is the object handle for the SQL layer class
	 */
	function Legal_DocTypes($modName='', $lang='')
	{
		global $prefix, $db;
		if (isset($modName) && !empty($modName)) $this->modName = $modName;
		if (isset($lang) && !empty($lang)) $this->lang = $lang;
		$sql = 'SELECT a.`did`, `doc_name`, `doc_text` FROM `' . $prefix . '_legal_docs` a, `'
			. $prefix . '_legal_text_map` b, `'
			. $prefix.'_legal_text` c WHERE a.`did` = b.`did` AND b.`tid` = c.`tid` AND b.`mid` = '
			. LGL_MID_TYPE . ' AND `doc_status` = \'1\' AND `language` = \'' . addslashes($this->lang) . '\'';
		$result = $db->sql_query($sql);
		if ($db->sql_numrows($result) == 0) { // Could not find doc types so try the default language
			$sql = 'SELECT a.`did`, `doc_name`, `doc_text` FROM `' . $prefix . '_legal_docs` a, `'
				. $prefix . '_legal_text_map` b, `'
				. $prefix.'_legal_text` c WHERE a.`did` = b.`did` AND b.`tid` = c.`tid` AND b.`mid` = '
				. LGL_MID_TYPE . ' AND `doc_status` = \'1\' AND `language` = \'english\'';
			$result = $db->sql_query($sql);
		}
		while (list($did, $docTyp, $docTypTxt) = $db->sql_fetchrow($result))
		{
			$this->docTypes[(int)$did] = $docTyp;
			$this->docTypeText[(int)$did] = $docTypTxt;
		}
		$this->numTypes = count($this->docTypes);
	}

	/**
	 * Sets the state of the object to add the "Contact" menu option for Legal Inquiries
	 *
	 * @global array $lgl_lang is the language array for this module
	 */
	function setShowContact()
	{
		global $lgl_lang;
		$this->showContact = true;
		if (isset($labContact)) $this->labContact = _LGL_COM_CONTACTMENU;
	}

	/**
	 * Returns the HTML for the menu of links
	 *
	 * @global string $admin_file is the name of the admin file, default in config.php is "admin".
	 * @global array  $admin is the admin cookie, if the admin is logged in
	 * @global array  $lgl_lang is the language array for this module
	 */
	function html()
	{
		global $admin_file, $admin, $lgl_lang;
		$s = '[&nbsp;';
		$i = 0;
		$j = $this->numTypes;
		foreach ($this->docTypes as $key => $value)
		{
			$s .= '<a href="modules.php?name='.$this->modName.'&amp;op=' . $value . '">'
				. str_replace(' ', '&nbsp;', $this->docTypeText[$key]) . '</a>';
			if ($j == ++$i) {
				if ($this->showContact) {
					$s .= ' | <a href="modules.php?name='.$this->modName.'&amp;op=lgl_contact">'
						. $this->labContact . '</a>';
				}
			} else {
				$s .= '&nbsp;| ';
			}
		}
		if (is_admin($admin)) {
			$s .= '&nbsp;| <a href="' . $admin_file . '.php?op=legal">' . _LGL_COM_ADMINMENU . '</a>';
		}
		$s .= '&nbsp;]';
		return $s;
	}

	/**
	 * Is used to validate a provided document name (type)
	 *
	 * Not only does this method validate against the list of types from the database, if it is
	 * invalid or not provided, then the first type retrieved from the database is returned.
	 *
	 * @param   string $docType is the name of the document such as "terms", "privacy", etc.
	 * @returns string the validated document name (type) and if
	 */
	function validateDocType($docType='')
	{
		if (in_array($docType, $this->docTypes)) {
			return $docType;
		}
		reset($this->docTypes);
		return current($this->docTypes);
	}

	/**
	 * Retrives the `did` value for the provided document name (type)
	 *
	 * @param   string $docType is the name of the document such as "terms", "privacy", etc.
	 * @returns integer the `did` of the document
	 */
	function getDocID($docType='')
	{
		$key = array_search($docType, $this->docTypes);
		if (empty($docType) || $key === false) {
			reset($this->docTypes);
			return (int)key($this->docTypes);
		}
		return (int)$key;
	}

}

?>