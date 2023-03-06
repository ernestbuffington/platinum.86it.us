<?php

/********************************************************/
/* NSN Work Request                                     */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
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

define_once("_WR_","");
define_once("_WR_FEATURED","Featured");
define_once("_WR_FEATUREDBLOCK","Featured in block");
define_once("_WR_VISIBLE","Visible");
define_once("_WR_VISIBLEPUBLIC","Visible to public");

define_once("_WR_ADMINEMAIL","Admin E-mail");
define_once("_WR_ADMINFUNCTIONS","Administration Functions");
define_once("_WR_ADMINMENU","Work Request Administration");
define_once("_WR_ALL","ALL");
define_once("_WR_ASC","ASC");
define_once("_WR_ASSIGNEDMEMBERS","Assigned Members");
define_once("_WR_ASSIGNMEMBERS","Assign Members");
define_once("_WR_COMMENT","Comment");
define_once("_WR_COMMENTADD","Add Comment");
define_once("_WR_COMMENTDELETE","Delete Comment");
define_once("_WR_COMMENTEDIT","Edit Comment");
define_once("_WR_COMMENTS","Comments");
define_once("_WR_COMMENTUPDATE","Update Request Comment");
define_once("_WR_CONFIG","Request Configuration");
define_once("_WR_REQUESTCONFIG","Request Configuration");
define_once("_WR_CONFIGUPDATE","Update Configuration");
define_once("_WR_CONFIRMCOMMENTDELETE","Are you sure you want to delete this comment?");
define_once("_WR_DATEFORMAT","Date Display Format");
define_once("_WR_DATENOTE","The syntax used is identical to the PHP <a href='http://www.php.net/date' target='_blank'>date()</a> function");
define_once("_WR_DELETE","Delete");
define_once("_WR_DESC","DESC");
define_once("_WR_DESCRIPTION","Description");
define_once("_WR_EDIT","Edit");
define_once("_WR_EMAILADDRESS","E-Mail Address");
define_once("_WR_ERRORINVEMAIL","<strong>ERROR: Invalid Email Address</strong>");
define_once("_WR_ERRORNOCOMM","<strong>ERROR: Missing Content</strong>");
define_once("_WR_ERRORNODESC","<strong>ERROR: Missing Description</strong>");
define_once("_WR_ERRORNOEMAIL","<strong>ERROR: Missing Email Address</strong>");
define_once("_WR_ERRORNONAME","<strong>ERROR: Missing Name</strong>");
define_once("_WR_ERRORNOSUMM","<strong>ERROR: Missing Summary</strong>");
define_once("_WR_ERRORREQUEST","There is a problem with the request you have submitted.");
define_once("_WR_ERRORREQUESTCOMMENT","There is a problem with the comment you have submitted.");
define_once("_WR_FINISHDATE","Finish Date");
define_once("_WR_FUNCTIONS","Functions");
define_once("_WR_IMPORT2TASK","Import to Task");
define_once("_WR_IMPORTASTASK","Import Request as a Task");
define_once("_WR_INPUTNOTE","ALL HTML will be rendered visible");
define_once("_WR_LASTSUBMISSION","Last Submission");
define_once("_WR_LASTSUBMISSION","Last Submission");
define_once("_WR_MEMBERADD","Add Member");
define_once("_WR_MEMBERDELETE","Delete Member");
define_once("_WR_MEMBEREDIT","Edit Member");
define_once("_WR_MEMBEREMAIL","Member's Email");
define_once("_WR_MEMBERLIST","Member List");
define_once("_WR_MEMBERNAME","Member's Name");
define_once("_WR_MEMBEROPTIONS","Member Options / Statistics");
define_once("_WR_MEMBERS","Members");
define_once("_WR_MEMBERUPDATE","Update Member");
define_once("_WR_MODIFIED","Modified");
define_once("_WR_NA","N/A");
define_once("_WR_NAME","User Name");
define_once("_WR_NEWREQUESTCOMMENT","This feature request has been commented on");
define_once("_WR_NEWREQUESTCOMMENTS","New Request Comment");
define_once("_WR_NEWREQUESTMESSAGE","A new request has been submitted at your site");
define_once("_WR_NEWREQUESTMESSAGES","New Request Submission");
define_once("_WR_NEWREQUESTSTATUS","Status for New Requests");
define_once("_WR_NEWREQUESTTYPE","Type for New Requests");
define_once("_WR_NEWREQUESTUPDATED","This feature request has been updated");
define_once("_WR_NEWREQUESTUPDATEDS","Request Submission Updated");
define_once("_WR_NO","No");
define_once("_WR_NOMEMBERS","There are no members in the database.");
define_once("_WR_NOPROJECTREQUESTS","There are no requests associated with this project.");
define_once("_WR_NOPROJECTS","There are no projects in the database.");
define_once("_WR_NOREQUESTCOMMENTS","There are no comments associated with this request.");
define_once("_WR_NOREQUESTMEMBERS","There are no members associated with this request.");
define_once("_WR_NOREQUESTS","There are no requests in the database.");
define_once("_WR_NOREQUESTSTATUSES","There are no request statuses in the database.");
define_once("_WR_NOREQUESTTYPES","There are no request types in the database.");
define_once("_WR_NOTIFYADMIN","Notify Admin of New Requests");
define_once("_WR_NOTIFYSUBMITTER","Notify Submitter of changes");
define_once("_WR_OF","of");
define_once("_WR_PAGE","Page");
define_once("_WR_PRINTERFRIENDLY","Printer Friendly Copy");
define_once("_WR_PRIORITY","Priority");
define_once("_WR_PROJECT","Project");
define_once("_WR_PROJECTADD","Add Project");
define_once("_WR_PROJECTCONFIRMDELETE","Deleting this project will delete all data associated with it.");
define_once("_WR_PROJECTDELETE","Delete Project");
define_once("_WR_PROJECTEDIT","Edit Project");
define_once("_WR_PROJECTID","Project ID");
define_once("_WR_PROJECTLIST","Project List");
define_once("_WR_PROJECTNAME","Project Name");
define_once("_WR_PROJECTOPTIONS","Project Options");
define_once("_WR_PROJECTREQUESTLIST","Project Request List");
define_once("_WR_PROJECTREQUESTS","Project Requests");
define_once("_WR_PROJECTS","Projects");
define_once("_WR_PROJECTUPDATE","Update Project");
define_once("_WR_PROJECTVIEW","View Project");
define_once("_WR_REQUESTCONFIRMDELETE","Deleting this request will delete all data associated with it.");
define_once("_WR_REQUESTDELETE","Delete Request");
define_once("_WR_REQUESTEDIT","Edit Request");
define_once("_WR_REQUESTER","Requested by");
define_once("_WR_REQUESTID","Request ID");
define_once("_WR_REQUESTINFO","Request Information");
define_once("_WR_REQUESTLIST","Request List");
define_once("_WR_REQUESTLISTVIEW","View Request List");
define_once("_WR_REQUESTMAP","Request Map");
define_once("_WR_REQUESTMEMBERS","Request Members");
define_once("_WR_REQUESTNAME","Request Name");
define_once("_WR_REQUESTOPTIONS","Request Options");
define_once("_WR_REQUESTPRINT","Print Request");
define_once("_WR_REQUESTS","Requests");
define_once("_WR_REQUESTUPDATE","Update Request");
define_once("_WR_REQUESTVIEW","View Request");
define_once("_WR_RETURN","[ <a href=\"javascript:history.go(-1)\">Return to last page</a> ]");
define_once("_WR_SORT","Sort");
define_once("_WR_STARTDATE","Start Date");
define_once("_WR_STATUS","Status");
define_once("_WR_STATUSADD","Add Status");
define_once("_WR_STATUSDELETE","Delete Status");
define_once("_WR_STATUSEDIT","Edit Status");
define_once("_WR_STATUSID","Status ID");
define_once("_WR_STATUSLIST","Status List");
define_once("_WR_STATUSOPTIONS","Status Options");
define_once("_WR_STATUSPERCENT","Status Percentage");
define_once("_WR_STATUSUPDATE","Update Status");
define_once("_WR_SUBMITAREQUEST","Submit a Request");
define_once("_WR_SUBMITREQUEST","Submit Request");
define_once("_WR_SUBMITTED","Submitted");
define_once("_WR_SUMMARY","Summary");
define_once("_WR_SWAPMEMBER","In order to delete this member, please choose a replacement for associated requests.");
define_once("_WR_SWAPSTATUS","In order to delete this status, please choose a replacement for associated requests.");
define_once("_WR_SWAPTYPE","In order to delete this type, please choose a replacement for associated requests.");
define_once("_WR_TASKADD","Add Task");
define_once("_WR_TASKNAME","Task Name");
define_once("_WR_TITLEWB","Work Board");
define_once("_WR_TITLEWP","Work Probe");
define_once("_WR_TITLEWR","Work Request");
define_once("_WR_TOTALPROJECTS","Total Projects");
define_once("_WR_TOTALREQUESTS","Total Requests");
define_once("_WR_TOTALSTATUSES","Total Statuses");
define_once("_WR_TOTALTYPES","Total Types");
define_once("_WR_TYPE","Type");
define_once("_WR_TYPEADD","Add Type");
define_once("_WR_TYPEDELETE","Delete Type");
define_once("_WR_TYPEEDIT","Edit Type");
define_once("_WR_TYPEID","Type ID");
define_once("_WR_TYPELIST","Type List");
define_once("_WR_TYPEOPTIONS","Type Options");
define_once("_WR_TYPEUPDATE","Update Type");
define_once("_WR_UPDATE","Update");
define_once("_WR_VIEWALL","View All Projects/Requests");
define_once("_WR_YES","Yes");
