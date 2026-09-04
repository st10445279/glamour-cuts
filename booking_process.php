<?php
require_once 'db.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

function sendConfirmationEmail($toEmail, $toName, $service, $date, $time) {
    $mailConfig = require __DIR__ . '/mail_config.php';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $mailConfig['username'];
        $mail->Password   = $mailConfig['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        $mail->setFrom('glamourcutssalon@gmail.com', 'Glamour Cuts');
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = 'Your Glamour Cuts booking is confirmed';
        $mail->Body    = "<p>Hi $toName,</p>
            <p>Your appointment is confirmed:</p>
            <ul>
              <li><strong>Service:</strong> $service</li>
              <li><strong>Date:</strong> $date</li>
              <li><strong>Time:</strong> $time</li>
            </ul>
            <p>We look forward to seeing you!<br>— Glamour Cuts</p>";
        $mail->AltBody = "Hi $toName, your booking for $service on $date at $time is confirmed. — Glamour Cuts";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email failed: " . $mail->ErrorInfo);
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fname   = htmlspecialchars(trim($_POST['fname']));
    $lname   = htmlspecialchars(trim($_POST['lname']));
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $service = trim($_POST['service']);
    $date    = htmlspecialchars(trim($_POST['date']));
    $time    = htmlspecialchars(trim($_POST['time']));

    $clientsRef = $db->collection('clients');

    // Check if client exists by phone
    $existingDocs = $clientsRef->where('Phone', '=', $phone)->limit(1)->documents();
    $clientId = null;
    foreach ($existingDocs as $doc) {
        if ($doc->exists()) {
            $clientId = $doc->id();
        }
    }

    if ($clientId) {
        // Keep email up to date in case it changed
        $clientsRef->document($clientId)->set(['Email' => $email], ['merge' => true]);
    } else {
        $newClient = $clientsRef->add([
            'FirstName' => $fname,
            'LastName'  => $lname,
            'Phone'     => $phone,
            'Email'     => $email,
        ]);
        $clientId = $newClient->id();
    }

    // Look up service
    $svcDocs = $db->collection('services')->where('ServiceName', '=', $service)->limit(1)->documents();
    $serviceId = null;
    $servicePrice = null;
    foreach ($svcDocs as $doc) {
        if ($doc->exists()) {
            $serviceId    = $doc->id();
            $servicePrice = $doc->data()['Price'];
        }
    }

    if (!$serviceId) {
        echo json_encode(['success' => false, 'message' => "Service not found: $service"]);
        exit;
    }

    // Check for double booking
    $apptRef = $db->collection('appointments');
    $clashDocs = $apptRef
        ->where('AppDate', '=', $date)
        ->where('AppTime', '=', $time)
        ->documents();

    foreach ($clashDocs as $doc) {
        if ($doc->exists() && ($doc->data()['Status'] ?? '') !== 'Cancelled') {
            echo json_encode(['success' => false, 'message' => 'That slot is already booked. Please choose another time.']);
            exit;
        }
    }

    // Insert appointment (denormalized: client + service details embedded for easy dashboard display)
    $apptRef->add([
        'ClientID'    => $clientId,
        'FirstName'   => $fname,
        'LastName'    => $lname,
        'Phone'       => $phone,
        'Email'       => $email,
        'ServiceID'   => $serviceId,
        'ServiceName' => $service,
        'Price'       => $servicePrice,
        'AppDate'     => $date,
        'AppTime'     => $time,
        'Status'      => 'Pending',
    ]);

    $emailSent = sendConfirmationEmail($email, "$fname $lname", $service, $date, $time);
    echo json_encode([
        'success' => true,
        'message' => $emailSent
            ? 'Booking confirmed! A confirmation email has been sent.'
            : 'Booking confirmed! (Could not send confirmation email.)'
    ]);
}