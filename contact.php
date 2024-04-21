<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace contact@example.com with your real receiving email address
    $receiving_email_address = 'rsproperty@gmail.com';

    // Check if the PHP Email Form library file exists
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }

    // Create a new instance of PHP_Email_Form
    $contact = new PHP_Email_Form;
    $contact->ajax = true;

    // Set email details
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
    /*
    $contact->smtp = array(
        'host' => 'example.com',
        'username' => 'example',
        'password' => 'pass',
        'port' => '587'
    );
    */

    // Add message content
    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    // Send the email
    echo $contact->send();
} else {
    // If the request method is not POST, send a 405 Method Not Allowed response
    //http_response_code(405);
    echo "Massage send";
}
?>
