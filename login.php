<?php

namespace Websupport;

require __DIR__.'/bootstrap.php';

if (empty($_POST['ws_username']) || empty($_POST['ws_pass'])) {
    $_SESSION['message'] = '<div class="error">Please provide your login credentials</div>';

    header('Location: '.BASE_URL);
    exit;
}

$auth_token = base64_encode($_POST['ws_username'].':'.$_POST['ws_pass']);
try {
    $ws = new Api($auth_token);
    $ws_user = $ws->request('/user');
    if ($ws_user['items'][0]['active']) {
        $_SESSION['auth_token'] = $auth_token;
        $_SESSION['user'] = $ws_user['items'][0];
    }
} catch (\Exception $e) {
    $_SESSION['message'] = '<div class="notice">'.$e->getMessage().'</div>';
}

header('Location: '.BASE_URL);
exit;
