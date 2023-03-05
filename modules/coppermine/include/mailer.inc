<?php 
/****************************************************************************/
/* Coppermine Photo Gallery 1.2.3 for CMS                                   */
/****************************************************************************/
/****************************************************************************/
/* Port Copyright (C) 2004 Coppermine for CMS Dev Team  		            */
/* http://coppermine.findhere.org/                                          */
/* Based on coppermine 1.1d by Surf  http://www.surf4all.net/               */
/****************************************************************************/
/* Updated by the Coppermine Dev Team  2003                                 */
/* (http://coppermine.sf.net/team/)                                         */
/* see /docs/credits.html for details                                       */
/****************************************************************************/
/* Copyright (C) 2002,2003  Grégory DEMAR <gdemar@wanadoo.fr>               */
/* http://www.chezgreg.net/coppermine/                                      */
/* This program is free software; you can redistribute it and/or modify     */
/* it under the terms of the GNU General Public License as published by     */
/* the Free Software Foundation; either version 2 of the License, or        */
/* (at your option) any later version.                                      */
/****************************************************************************/
/*   $Id: mailer.inc,v 1.1 2004/05/05 09:04:56 djmaze Exp $          */
/****************************************************************************/
$CONFIG['smtp_host'] = '';
$CONFIG['smtp_username'] = '';
$CONFIG['smtp_password'] = '';
// Custom mail function
function cpg_mail($to, $subject, $msg_body, $type = 'text/plain', $sender_name = '', $sender_email = '')
{
    global $CONFIG;
    if ($sender_name == '') $sender_name = $CONFIG['gallery_name'];
    if ($sender_email == '') $sender_email = $CONFIG['gallery_admin_email'];
    $charset = $CONFIG['charset'] == 'language file' ? _CHARSET : $CONFIG['charset'];
    //$extra_headers = "From: $sender_name <$sender_email>\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: $type; charset=" . $charset . "\r\n" . "Content-transfer-encoding: 8bit\r\n" . "Date: " . gmdate('D, d M Y H:i:s', time()) . " UT\r\n" . "X-Priority: 3\r\n" . "X-Mailer: Coppermine Photo Gallery\r\n"; 
    $extra_headers = "From: $sender_name <$sender_email>\n";
    $extra_headers .= "Reply-To: $sender_email\n";
	$extra_headers .= "MIME-Version: 1.0\n";
	$extra_headers .= "Content-Type: text/html; charset=$charset\n\n";
    // Fix any bare linefeeds in the message to make it RFC821 Compliant.
    $message = preg_replace("/(?<!\r)\n/si", "\r\n", $msg_body);
    if (empty($CONFIG['smtp_host'])) {
        return mail($to, $subject, $msg_body, $extra_headers);
    } else {
        return smtp_mail($to, $subject, $msg_body, $extra_headers);
    } 
} 
/**
 * smtp.php
 *                          -------------------
 *      begin                : Wed May 09 2001
 *      copyright            : (C) 2001 The phpBB Group
 *      email                : support@phpbb.com
 * 
 *      $Id: mailer.inc,v 1.1 2004/05/05 09:04:56 djmaze Exp $
 */
/**
 * This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 */
// This function has been modified as provided
// by SirSir to allow multiline responses when
// using SMTP Extensions
function server_parse($socket, $response)
{
    while (substr($server_response, 3, 1) != ' ') {
        if (!($server_response = fgets($socket, 256))) {
            cpg_die(ERROR, "Couldn't get mail server response codes", __FILE__, __LINE__);
        } 
    } 
    if (!(substr($server_response, 0, 3) == $response)) {
        cpg_die(ERROR, "Ran into problems sending Mail. Response: $server_response", "", __FILE__, __LINE__);
    } 
} 
/**
 * Function:         smtpmail
 *     Description:     This is a functional replacement for php's builtin mail
 *                         function, that uses smtp.
 *     Usage:            The usage for this function is identical to that of php's
 *                         built in mail function.
 */
function smtp_mail($mail_to, $subject, $message, $headers = "")
{ 
    // For now I'm using an array based $smtp_vars to hold the smtp server
    // info, but it should probably change to $CONFIG...
    // then the relevant info would be $CONFIG['smtp_host'] and
    // $CONFIG['smtp_port'].
    global $CONFIG; 
    // Fix any bare linefeeds in the message to make it RFC821 Compliant.
    $message = preg_replace("/(?<!\r)\n/si", "\r\n", $message);
    if ($headers != "") {
        if (is_array($headers)) {
            if (sizeof($headers) > 1) {
                $headers = join("\r\n", $headers);
            } else {
                $headers = $headers[0];
            } 
        } 
        $headers = chop($headers); 
        // Make sure there are no bare linefeeds in the headers
        $headers = preg_replace("/(?<!\r)\n/si", "\r\n", $headers); 
        // Ok this is rather confusing all things considered,
        // but we have to grab bcc and cc headers and treat them differently
        // Something we really didn't take into consideration originally
        $header_array = explode("\r\n", $headers);
        @reset($header_array);
        $headers = "";
        while (list(, $header) = each($header_array)) {
            if (preg_match("/^cc:/si", $header)) {
                $cc = preg_replace("/^cc:(.*)/si", "\\1", $header);
            } else if (preg_match("/^bcc:/si", $header)) {
                $bcc = preg_replace("/^bcc:(.*)/si", "\\1", $header);
                $header = "";
            } 
            $headers .= $header . "\r\n";
        } 
        $headers = chop($headers);
        $cc = explode(",", $cc);
        $bcc = explode(",", $bcc);
    } 
    if (trim($mail_to) == "") {
        cpg_die(ERROR, "No email address specified", __FILE__, __LINE__);
    } 
    if (trim($subject) == "") {
        cpg_die(ERROR, "No email Subject specified", __FILE__, __LINE__);
    } 
    if (trim($message) == "") {
        cpg_die(ERROR, "Email message was blank", __FILE__, __LINE__);
    } 
    $mail_to_array = explode(",", $mail_to); 
    // Ok we have error checked as much as we can to this point let's get on
    // it already.
    if (!$socket = fsockopen($CONFIG['smtp_host'], 25, $errno, $errstr, 20)) {
        cpg_die(ERROR, "Could not connect to smtp host : $errno : $errstr", __FILE__, __LINE__);
    } 
    server_parse($socket, "220");
    if (!empty($CONFIG['smtp_username']) && !empty($CONFIG['smtp_password'])) {
        // Send the RFC2554 specified EHLO.
        // This improved as provided by SirSir to accomodate
        // both SMTP AND ESMTP capable servers
        fputs($socket, "EHLO " . $CONFIG['smtp_host'] . "\r\n");
        server_parse($socket, "250");
        fputs($socket, "AUTH LOGIN\r\n");
        server_parse($socket, "334");
        fputs($socket, base64_encode($CONFIG['smtp_username']) . "\r\n");
        server_parse($socket, "334");
        fputs($socket, base64_encode($CONFIG['smtp_password']) . "\r\n");
        server_parse($socket, "235");
    } else {
        // Send the RFC821 specified HELO.
        fputs($socket, "HELO " . $CONFIG['smtp_host'] . "\r\n");
        server_parse($socket, "250");
    } 
    // From this point onward most server response codes should be 250
    // Specify who the mail is from....
    fputs($socket, "MAIL FROM: <" . $CONFIG['gallery_admin_email'] . ">\r\n");
    server_parse($socket, "250"); 
    // Specify each user to send to and build to header.
    $to_header = "To: ";
    @reset($mail_to_array);
    while (list(, $mail_to_address) = each($mail_to_array)) {
        // Add an additional bit of error checking to the To field.
        $mail_to_address = trim($mail_to_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $mail_to_address)) {
            fputs($socket, "RCPT TO: <$mail_to_address>\r\n");
            server_parse($socket, "250");
        } 
        $to_header .= (($mail_to_address != '') ? ', ' : '') . "<$mail_to_address>";
    } 
    // Ok now do the CC and BCC fields...
    @reset($bcc);
    while (list(, $bcc_address) = each($bcc)) {
        // Add an additional bit of error checking to bcc header...
        $bcc_address = trim($bcc_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $bcc_address)) {
            fputs($socket, "RCPT TO: <$bcc_address>\r\n");
            server_parse($socket, "250");
        } 
    } 
    @reset($cc);
    while (list(, $cc_address) = each($cc)) {
        // Add an additional bit of error checking to cc header
        $cc_address = trim($cc_address);
        if (preg_match('/[^ ]+\@[^ ]+/', $cc_address)) {
            fputs($socket, "RCPT TO: <$cc_address>\r\n");
            server_parse($socket, "250");
        } 
    } 
    // Ok now we tell the server we are ready to start sending data
    fputs($socket, "DATA\r\n"); 
    // This is the last response code we look for until the end of the message.
    server_parse($socket, "354"); 
    // Send the Subject Line...
    fputs($socket, "Subject: $subject\r\n"); 
    // Now the To Header.
    fputs($socket, "$to_header\r\n"); 
    // Now any custom headers....
    fputs($socket, "$headers\r\n\r\n"); 
    // Ok now we are ready for the message...
    fputs($socket, "$message\r\n"); 
    // Ok the all the ingredients are mixed in let's cook this puppy...
    fputs($socket, ".\r\n");
    server_parse($socket, "250"); 
    // Now tell the server we are done and close the socket...
    fputs($socket, "QUIT\r\n");
    fclose($socket);
    return true;
} 
?>
