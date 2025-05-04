<?php
    
    $secret = 'your_api_secret_here'; // Replace with your real secret key
    $coreURL = 'https://example.com'; // Replace with your actual coreURL

    function executeAPI ($url, $payload) {
        $payload = json_encode($payload);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload),
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => $httpCode,
            'response' => json_decode($response, true),
        ]);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if ($_POST['action'] == 'attendance') {
            // Read parameter
            $courseid = $_POST['courseid'] ?? '';
            // Prepare payload
            $payload = json_encode([
                'courseid' => $courseid,
                'secret' => $secret,
            ]);
            // Execute payload
            executeAPI("$coreURL/portal/FlashPoint/attendance", $payload);
        }
    }
