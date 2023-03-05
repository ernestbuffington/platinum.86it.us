<?php

/**
 * Genesis Jquery Menu Module
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2 (see provided LICENSE file)
 *
 * @category    Module
 * @package     Genesis
 * @subpackage  JQMenu
 * @author      baxr6 <dfwcomputer@gmail.com>
 * @copyright   2009 by DFW Computers
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.0
 * @link        http://www.dfwcomputer.com.au
 * @since       7.6.G.1
 */

if ( !defined('ADMIN_FILE') ) {
  die( 'Illegal Access Detected!!!' );
}
global $admin_file;

$result = $db->sql_query( 'SELECT `aid`, `email`, `radminsuper` FROM `' . $prefix . '_authors` WHERE `aid`=\'' . $aid . '\'' );
list( $aname, $amail, $radminsuper ) = $db->sql_fetchrow( $result );
if ( $radminsuper == 1 ) {
  switch ( $op ) {
    case 'jqmenu':
      jqmenu();
      break;

    case 'jqmenu_add_cat':
      jqmenu_add_cat();
      break;

    case 'jqmenu_add_cat_img':
      jqmenu_add_cat_img();
      break;
    case 'jqmenu_save_cat_img':
      jqmenu_save_cat_img();
      break;

    case 'jqmenu_save_cat':
      jqmenu_save_cat();
      break;

    case 'jqmenu_add_link':
      jqmenu_add_link();
      break;

    case 'jqmenu_save_link':
      jqmenu_save_link( $cid, $title );
      break;

    case 'jqmenu_del_cat':
      jqmenu_del_cat( $cid );
      break;

    case 'jqmenu_del_link':
      jqmenu_del_link( $mid );
      break;

    case 'jqmenu_weight':
      jqmenu_weight();
      break;

  }
} else {
  echo 'Access Denied';
}


function jqmenu_header()
{
  global $admin_file;
  OpenTable();
  echo '<div align="center">' . "\n";
  echo '[ <a href="' . $admin_file . '.php?op=jqmenu">JQMenu</a> |' . "\n";
  echo ' <a href="' . $admin_file . '.php?op=jqmenu_add_cat">Add Category</a> |' . "\n";
  echo ' <a href="' . $admin_file . '.php?op=jqmenu_add_link">Add Link</a> |' . "\n";
  echo '</div>' . "\n";
  CloseTable();
}

function admin_get_subs( $catid )
{
  global $prefix, $db;
  $catid = ( int )$catid;
  $sql = $db->sql_query( 'SELECT m.title FROM ' . $prefix . '_menu m LEFT JOIN ' . $prefix . '_menu_cat c ON c.cid = m.cid WHERE c.cid=\'' . $catid . '\'' );
  while ( $row = $db->sql_fetchrow($sql) ) {
    $title = check_html( $row['title'], 'nohtml' );
    echo '<li>' . $title . '</li>' . "\n";
  }
}


function jqmenu_weight()
{
  global $prefix, $db, $admin_file;
  include_once ( 'header.php' );
  jqmenu_header();
  OpenTable();
  // handle POST
  if ( isset($_POST['New_Order']) ) {
    // use $i to increment the weight
    $i = 1;
    // loop through post array in the order it was submitted
    foreach ( $_POST['New_Order'] as $menu_id ) {
      // update the row
      $result = $db->sql_query( "UPDATE " . $prefix . "_menu SET weight=" . $i . " WHERE mid=" . $menu_id . "" );
      // increment weight to make the next fruit heavier
      $i++;
    }
  }
//  echo '<script type="text/javascript" src="includes/jquery/jquery-ui-1.7.1.min.js"></script>' . "\n";
addJSToHead('includes/jquery/lib/jquery-ui-1.7.1.min.js','file');

  echo '<form action="' . $admin_file . '.php?op=jqmenut" method="post">' . "\n";
  $sCat = $db->sql_query( "SELECT `cid`, `cat`, `weight` FROM `" . $prefix . "_menu_cat` ORDER BY `weight`" );
  while ( $sCatRow = $db->sql_fetchrow($sCat) ) {

    $sCatTitle = $sCatRow['cat'];
    $cid1 = ( int )$sCatRow['cid'];

    $sMenu = $db->sql_query( "SELECT `mid`, `cid`, `title`, `weight` FROM `" . $prefix . "_menu` WHERE `cid`=$cid1 ORDER BY `weight`" );
$inlinpjqJS ='<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#' . $sCatTitle . '\').sortable();
      });
      </script>' . "\n";
addJSToBody($inlinpjqJS,'inline');
 /*   echo '<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#' . $sCatTitle . '\').sortable();
      });
      </script>' . "\n";*/
    echo '<fieldset><legend>' . $sCatTitle . '</legend>' . "\n";
    echo '<ul id="' . $sCatTitle . '" class="jqsortable jqboxy">' . "\n";
    while ( $sMenuRow = $db->sql_fetchrow($sMenu) ) {
      $sMid = ( int )$sMenuRow['mid'];
      $sTitle = $sMenuRow['title'];
      $cid3 = $sMenuRow['mid'];
      echo '<li class="jqactive">
   <input type="hidden" name="New_Order[]" value="' . $sMid . '" />';
      echo '' . $sTitle . '</li>' . "\n";
    }
    echo '</ul>' . "\n";
    echo '</fieldset><br />' . "\n";
    $db->sql_freeresult( $sMenu );
  }

  $db->sql_freeresult( $sCat );

?>
      <input type="submit" name="reorder" value="Re-Order" />
      </form>
      <?php

  CloseTable();
  include_once ( 'footer.php' );
}


function jqmenu()
{
  global $admin_file, $prefix, $db, $admin, $user;
  include_once ( 'header.php' );
  genAdminPanel( 'jqmenu', _JQMENUADMIN );
  jqmenu_header();
  OpenTable();
  // handle POST
  if ( isset($_POST['New_Order']) ) {
    // use $i to increment the weight
    $i = 1;
    // loop through post array in the order it was submitted
    foreach ( $_POST['New_Order'] as $menu_id ) {
      // update the row
      $result = $db->sql_query( "UPDATE " . $prefix . "_menu SET weight=" . $i . " WHERE mid=" . $menu_id . "" );
      // increment weight to make the next fruit heavier
      $i++;
    }
  }
//  echo '<script type="text/javascript" src="includes/jquery/jquery-ui-1.7.1.min.js"></script>' . "\n";
addJSToHead('includes/jquery/lib/jquery-ui-1.7.1.min.js','file');

  echo '<form action="' . $admin_file . '.php?op=jqmenu" method="post">' . "\n";
  $sCat = $db->sql_query( "SELECT `cid`, `cat`, `weight` FROM `" . $prefix . "_menu_cat` ORDER BY `weight`" );
  while ( $sCatRow = $db->sql_fetchrow($sCat) ) {

    $sCatTitle = $sCatRow['cat'];
    $cid1 = ( int )$sCatRow['cid'];

    $sMenu = $db->sql_query( "SELECT `mid`, `cid`, `title`, `weight` FROM `" . $prefix . "_menu` WHERE `cid`=$cid1 ORDER BY `weight`" );
$inlinpjqJS ='<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#' . $sCatTitle . '\').sortable();
      });
      </script>' . "\n";
addJSToBody($inlinpjqJS,'inline');
 /*   echo '<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#' . $sCatTitle . '\').sortable();
      });
      </script>' . "\n";*/  
    echo '<fieldset><legend>' . $sCatTitle . '</legend>' . "\n";
    echo '<ul id="' . $sCatTitle . '" class="jqsortable jqboxy">' . "\n";
    while ( $sMenuRow = $db->sql_fetchrow($sMenu) ) {
      $sMid = ( int )$sMenuRow['mid'];
      $sTitle = $sMenuRow['title'];
      $cid3 = $sMenuRow['mid'];
      echo '<li class="jqactive">
   <input type="hidden" name="New_Order[]" value="' . $sMid . '" />';
      echo '' . $sTitle . '</li>' . "\n";
    }
    echo '</ul>' . "\n";
    echo '</fieldset><br />' . "\n";
    $db->sql_freeresult( $sMenu );
  }

  $db->sql_freeresult( $sCat );

?>
      <input type="submit" name="reorder" value="Re-Order" />
      </form>
      <?php

  CloseTable();

  include_once 'footer.php';
}

function jqmenu_add_cat()
{
  global $admin_file, $prefix, $db, $admin, $user;
  include_once ( 'header.php' );
  genAdminPanel( 'jqmenu', _JQMENUADMIN );
  jqmenu_header();
  OpenTable();
  // handle POST
  if ( isset($_POST['Cat_Order']) ) {
    // use $i to increment the weight
    $i = 1;
    // loop through post array in the order it was submitted
    foreach ( $_POST['Cat_Order'] as $cat_id ) {
      // update the row
      $result = $db->sql_query( "UPDATE " . $prefix . "_menu_cat SET weight=" . $i . " WHERE cid=" . $cat_id . "" );
      // increment weight to make the next fruit heavier
      $i++;
    }
  }
//  echo '<script type="text/javascript" src="includes/jquery/jquery-ui-1.7.1.min.js"></script>' . "\n";
addJSToHead('includes/jquery/lib/jquery-ui-1.7.1.min.js','file');

  echo '<form action="' . $admin_file . '.php?op=jqmenu_add_cat" method="post">' . "\n";
$inlinpjqJS ='<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#Cat_List\').sortable();
      });
      </script>' . "\n";
addJSToBody($inlinpjqJS,'inline');
 /*   echo '<script type="text/javascript">
      // when the entire document has loaded, run the code inside this function
      $(document).ready(function(){
      $(\'#Cat_List\').sortable();
      });
      </script>' . "\n";*/
  echo '<fieldset ><legend style="background-color: red;border: 1px solid;padding: 3px;">Re-Order Categories</legend>' . "\n";
  echo '<ul id="Cat_List" class="jqsortable jqboxy">' . "\n";
  $sCat = $db->sql_query( "SELECT `cid`, `cat`, `weight` FROM `" . $prefix . "_menu_cat` ORDER BY `weight`" );
  while ( $sCatRow = $db->sql_fetchrow($sCat) ) {
    $iCid = ( int )$sCatRow['cid'];
    $sCatTitle = $sCatRow['cat'];
    $iWeight = ( int )$sCatRow['weight'];

    echo '<li class="jqactive">
   <input type="hidden" name="Cat_Order[]" value="' . $iCid . '" />';
    echo '' . $sCatTitle . '</li>' . "\n";
  }
  echo '</ul>' . "\n";
  echo '<br /><input type="submit" name="reorder" value="Re-Order" />' . "\n";
  echo '</form>' . "\n";

  echo '</fieldset><br />' . "\n";
  $db->sql_freeresult( $sCatRow );

  $catPath = 'images/JQMenu/categories/';

  echo '<fieldset style="padding: 15px;"><legend style="background-color: red;border: 1px solid;padding: 3px;">&nbsp;Add Category&nbsp;</legend>' . "\n";
  echo '<form id="add_cat" name="add_cat" method="post" action="' . $admin_file . '.php">' . "\n";
  echo '  <label>Category' . "\n";
  echo '    <input type="text" name="cat" id="cat" />' . "\n";
  echo '  </label>' . "\n";
  echo '   <input type="hidden" name="op" value="jqmenu_save_cat"  />' . "\n";
  echo '   <input type="submit" name="Submit" id="Submit" value="Submit" />' . "\n";
  echo '</form>' . "\n";
  echo '</fieldset>' . "\n";
  echo '<br />' . "\n";
  echo '<fieldset style="padding: 15px;"><legend style="background-color: red;border: 1px solid;padding: 3px;">&nbsp;Delete Category&nbsp;</legend>' . "\n";
  echo '<form method="post" action="' . $admin_file . '.php">' . "\n";
  echo '  <label>Category' . "\n";
  echo '<select name="delCID">' . "\n";
  echo '<option>&nbsp;</option>' . "\n";
  $delCatSql = $db->sql_query( 'SELECT * FROM ' . $prefix . '_menu_cat ORDER BY cat ASC' );
  while ( $row1 = $db->sql_fetchrow($delCatSql) ) {
    $cid = ( int )$row1['cid'];
    $cat = check_html( $row1['cat'], 'nohtml' );
    echo '<option value="' . $cid . '">' . $cat . '</option>' . "\n";
    echo '<ul>' . "\n";
  }
  echo '</select>' . "\n";
  echo '</label>' . "\n";
  echo '  </label>' . "\n";
  echo '   <input type="hidden" name="op" value="jqmenu_del_cat"  />' . "\n";
  echo '   <input type="submit" name="Submit" id="Submit" value="Submit" />' . "\n";
  echo '</form>' . "\n";
  echo '</fieldset>' . "\n";
  CloseTable();
  include_once 'footer.php';
}

function jqmenu_save_cat()
{
  global $admin_file, $prefix, $db, $admin, $user;
  if ( isset($_POST['cat']) ) {
    $cat = check_html( $_POST['cat'], 'nohtml' );
  }

  $db->sql_query( 'INSERT INTO ' . $prefix . '_menu_cat VALUES (NULL, \'' . $cat . '\', \'' . $catImage . '\')' );

  header( 'Location: ' . $admin_file . '.php?op=jqmenu_add_cat' );
}

function jqmenu_add_link()
{
  global $admin_file, $prefix, $db, $admin, $user;
  include_once ( 'header.php' );
  genAdminPanel( 'jqmenu', _JQMENUADMIN );
  jqmenu_header();
  OpenTable();

  echo '<fieldset style="padding: 15px;"><legend style="background-color: red;border: 1px solid;padding: 3px;">&nbsp;Add Link&nbsp;</legend>' . "\n";
  echo '<form method="post" action="' . $admin_file . '.php">' . "\n";
  echo '<label>Module:&nbsp;' . "\n";
  echo '<select name="title">' . "\n";
  echo '<option>&nbsp;</option>' . "\n";
  $result3 = $db->sql_query( 'SELECT * FROM ' . $prefix . '_modules WHERE active=1 AND inmenu=1 ORDER BY custom_title ASC' );
  while ( $row3 = $db->sql_fetchrow($result3) ) {
    $groups = $row3['groups'];
    $m_title = check_html( $row3['title'], 'nohtml' );
    $custom_title = check_html( $row3['custom_title'], 'nohtml' );
    $view = ( int )$row3['view'];
    $m_title2 = preg_replace( '#_#', ' ', $m_title );
    if ( !empty($custom_title) ) {
      $m_title2 = $custom_title;
    }
    echo '<option value="' . $m_title . '">' . $m_title2 . '</option>' . "\n";
  }
  echo '</select>' . "\n";
  echo '</label>' . "\n";
  echo '<br /><label>Category:&nbsp;' . "\n";
  echo '<select name="cid">' . "\n";
  echo '<option>&nbsp;</option>' . "\n";
  $result4 = $db->sql_query( 'SELECT * FROM ' . $prefix . '_menu_cat ORDER BY cat ASC' );
  while ( $row4 = $db->sql_fetchrow($result4) ) {
    $cid = ( int )$row4['cid'];
    $cat = check_html( $row4['cat'], 'nohtml' );
    echo '<option value="' . $cid . '">' . $cat . '</option>' . "\n";
  }
  echo '</select>' . "\n";
  echo '</label>' . "\n";
  echo '   <input type="hidden" name="op" value="jqmenu_save_link"  />' . "\n";
  echo '   <input type="submit" name="Submit" id="Submit" value="Submit" />' . "\n";
  echo '</form>' . "\n";
  echo '</fieldset>' . "\n";
  echo '<br /><fieldset style="padding: 15px;"><legend style="background-color: red;border: 1px solid;padding: 3px;">&nbsp;Delete Link&nbsp;</legend>' . "\n";
  echo '<form method="post" action="' . $admin_file . '.php">' . "\n";
  echo '  <label>Category' . "\n";
  echo '<select name="delMID">' . "\n";
  echo '<option>&nbsp;</option>' . "\n";
  $delCatSql = $db->sql_query( 'SELECT * FROM ' . $prefix . '_menu ORDER BY title ASC' );
  while ( $row1 = $db->sql_fetchrow($delCatSql) ) {
    $mid = stripslashes( intval($row1['mid']) );
    $title = stripslashes( check_html($row1['title'], 'nohtml') );
    echo '<option value="' . $mid . '">' . $title . '</option>' . "\n";
    echo '<ul>' . "\n";
  }
  echo '</select>' . "\n";
  echo '</label>' . "\n";
  echo '  </label>' . "\n";
  echo '   <input type="hidden" name="op" value="jqmenu_del_link"  />' . "\n";
  echo '   <input type="submit" name="Submit" id="Submit" value="Submit" />' . "\n";
  echo '</form>' . "\n";
  echo '</fieldset>' . "\n";

  CloseTable();
  include_once 'footer.php';
}

function jqmenu_save_link( $cid, $title )
{
  global $admin_file, $prefix, $db, $admin, $user;
  if ( isset($_POST['cid']) ) {
    $cid = ( int )$_POST['cid'];
  }
  if ( isset($_POST['title']) ) {
    $title = check_html( $_POST['title'], 'nohtml' );
  }
  $row = $db->sql_fetchrow( $db->sql_query('SELECT weight FROM ' . $prefix . '_menu WHERE cid=\'' . $cid . '\' ORDER BY weight DESC') );
  $weight = intval( $row['weight'] );
  $weight++;
  $db->sql_query( 'INSERT INTO ' . $prefix . '_menu VALUES (NULL, \'' . $cid . '\', \'' . $title . '\', \'' . $weight . '\')' );

  header( 'Location: ' . $admin_file . '.php?op=jqmenu' );
}

function jqmenu_del_cat( $cid )
{
  global $admin_file, $prefix, $db, $admin, $user;
  if ( isset($_POST['delCID']) ) {
    $cid = ( int )$_POST['delCID'];
  }

  $db->sql_query( 'DELETE FROM ' . $prefix . '_menu_cat WHERE cid = \'' . $cid . '\' LIMIT 1' );
  $db->sql_query( 'DELETE FROM ' . $prefix . '_menu WHERE cid = \'' . $cid . '\'' );
  header( 'Location: ' . $admin_file . '.php?op=jqmenu_add_cat' );
}

function jqmenu_del_link()
{
  global $admin_file, $prefix, $db, $admin, $user;
  if ( isset($_POST['delMID']) ) {
    $mid = ( int )$_POST['delMID'];
  }

  $db->sql_query( 'DELETE FROM ' . $prefix . '_menu WHERE mid = \'' . $mid . '\' LIMIT 1' );
  header( 'Location: ' . $admin_file . '.php?op=jqmenu_add_link' );
}

?>