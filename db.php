<?php
require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$credentialsPath = __DIR__ . '/firebase-credentials.json';

// This is the option combination that actually works with this SDK version:
// credentials via the ADC environment variable, transport forced to REST
// (gRPC can crash Apache worker processes on Windows).
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsPath);

$db = new FirestoreClient([
    'transport' => 'rest',
]);
// $db is now used everywhere instead of $conn