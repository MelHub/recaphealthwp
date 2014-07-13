<?php

/* doMail - Send an HTML email out
 *
 * @return null
 *
 * @author Don Burks <don@lighthouselabs.ca>
 */
function doMail($from, $message) {
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= "From: $from\r\n";

    // Mail it
    mail('kaitlyn@recaphealthventures.com', 'Website Contact', $message, $headers);
}

/* validateEmail - Validate email addresses. Must have an '@' sign, domain must have at least domain and tld, and must have an accessible MX record
 *
 * @param $email    - (string) E-mail address to test
 *
 * @return (bool) - Is E-mail valid?
 *
 * @author Don Burks <don@lighthouselabs.ca>
 */
function validateEmail($email = '') {
    if (empty($email) || !strstr($email, '@')) {
        return false;
    }

    list($username, $domain) = explode('@', $email);

    $parts = explode('.', $domain);
    if (count($parts) < 2) {
        return false;
    }

    if (!getmxrr($domain, $results)) {
        return false;
    }

    return true;
}

if (!$_REQUEST['email']) {
	exit;
}

//For later JSON-encoding
$data = array('result' => true);

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

if (!validateEmail($email)) {
	exit;
}

$message = 'At '.date('M d, Y h:i:s').', '.$name . " wrote: \n".$message;

doMail($email, $message);

echo json_encode($data);
