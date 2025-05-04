<?php

class FlashPointAPI
{
    private string $coreUrl;
    private string $secret;

    public function __construct(string $coreUrl, string $secret)
    {
        $this->coreUrl = rtrim($coreUrl, '/');
        $this->secret = $secret;
    }

    private function post(string $endpoint, array $data): array
    {
        $url = "{$this->coreUrl}/portal/FlashPoint/{$endpoint}";
        $data['secret'] = $this->secret;

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'code' => $httpCode,
            'body' => json_decode($response, true)
        ];
    }

    public function getAttendance(string $courseId): array
    {
        return $this->post('attendance', ['courseid' => $courseId]);
    }

    public function enrollUser(string $courseId, array $userData): array
    {
        return $this->post('enroll', [
            'courseid' => $courseId,
            'userdata' => $userData
        ]);
    }

    public function unenrollUser(string $courseId, string $fpid): array
    {
        return $this->post('unenroll', [
            'courseid' => $courseId,
            'fpid' => $fpid
        ]);
    }

    public function updateUser(array $userData): array
    {
        return $this->post('updateuser', ['userdata' => $userData]);
    }

    public function getQuizGrades(string $courseId, array $fpidList): array
    {
        return $this->post('quiz', [
            'courseid' => $courseId,
            'users' => $fpidList
        ]);
    }

    public function getUsersInClass(string $courseId): array
    {
        return $this->post('getusersinclass', ['courseid' => $courseId]);
    }
}

// Main handler
header('Content-Type: application/json');
$response = [
    'code' => 404,
    'body' => null,
];

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    if ($action == 'attendance') {
        $api = new FlashPointAPI('https://example.com', 'your_secret_key');
        $response = $api->getAttendance('COURSE123');
    }
}

echo json_encode($response);