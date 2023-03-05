<?php
/***************************************************************************
*                             Member Application
*                            -------------------
*   begin                : 13 Nov, 2005
*   copyright            : (C) 2005, 2006 Tim Leitz DBF Designs
*   email                : admin@dbfdesigns.net
*
*   Id: memberapplication v 2.1.4 Tim Leitz
*   Primary Function    :   define operations for admin menu
*	  run from			      :	  admin.php
*   file name           :   admin/case.php
*
***************************************************************************/
/***************************************************************************
*
*   This program is subject to the license agreement in the user manual.
*
***************************************************************************/

if ( !defined('ADMIN_FILE') )
{
  die ("Access Denied");
}

$module_name = "Member_Application";

switch ($op) 
{
  case "Member_Application" :
  case "MAapplist" :    // applist.php    * list applications
  case "MAappstatus" :  // appstatus.php  * change application status
  case "MAsetup" :      // appsetup.php   * admin input for MA configuration
  case "MAlistpq" :     // listpq.php     * parent question list
  case "MAaddpq" :      // addpq.php      * add parent question
  case "MAinsertq" :    // insertq.php    * insert a question into the MA_mapp table
  case "MAviewapp" :    // viewapp.php    * view a single application
  case "MAconfig" :     // maconfig.php   * set MA configuration in mapcfg table
  case "MAnewform" :    // newform.php    * edit a new form
  case "MAeditpq" :     // editpq.php     * admin input to edit a parent question
  case "MAupdatepq" :   // updatepq.php   * update parent question table
  case "MAorderpq" :    // orderpq.php    * change order of parent questions
  case "MAdelapp" :     // delapp.php     * delete user application
  case "MAaddeditcq" :  // addeditcq.php  * admin input to add a child question or option
  case "MAordercq" :   // ordercq.php    * change order of child questions
  case "MAupdatecq" :   // updatecq.php   * update child question/option in table
  case "MAdeleteq" :    // deleteq.php    * mark a question as deleted

    include_once("modules/$module_name/admin/index.php");
    break;
}

?>