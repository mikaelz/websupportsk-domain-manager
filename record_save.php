<?php

namespace Websupport;

$payload = [
    'type' => $_POST['record_type'],
    'name' => $_POST['record_name'],
    'content' => $_POST['record_content'],
    'ttl' => (int) $_POST['record_ttl'],
];

$required[] = empty($_POST['domain']) ? 'Domain' : '';
$required[] = empty($_POST['record_type']) ? 'Type' : '';
$required[] = empty($_POST['record_name']) ? 'Name' : '';
$required[] = empty($_POST['record_content']) ? 'Content' : '';

switch (strtolower($_POST['record_type'])) {
    case 'mx':
        $required[] = empty($_POST['record_prio']) ? 'Priority' : '';

        $payload['prio'] = (int) $_POST['record_prio'];
        break;
    case 'srv':
        $required[] = empty($_POST['record_prio']) ? 'Priority' : '';
        $required[] = empty($_POST['record_port']) ? 'Port' : '';
        $required[] = empty($_POST['record_weight']) ? 'Weight' : '';

        $payload['prio'] = (int) $_POST['record_prio'];
        $payload['port'] = (int) $_POST['record_port'];
        $payload['weight'] = (int) $_POST['record_weight'];
        break;
}

if (!empty($required[0])) {
    echo '<div class="error">Please provide: '.implode(', ', $required).'</div>';

    return;
}

$domain = $_POST['domain'];

$ws = new Api($_SESSION['auth_token']);
$response = $ws->request('/user/self/zone/'.$domain.'/record', $payload, 'POST');

if (isset($response['status']) && 'success' === $response['status']) {
    header('Location: '.BASE_URL.'/?domain='.$domain);
    exit;
}
