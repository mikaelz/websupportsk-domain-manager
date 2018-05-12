<?php

namespace Websupport;

require __DIR__.'/bootstrap.php';

if (empty($_POST['ws_username']) || empty($_POST['ws_pass'])) {
    $_SESSION['message'] = '<div class="error">Please provide your login credentials</div>';
}

$auth_token = '';
try {
    $ws = new Api($auth_token);
} catch (\Exception $e) {
    $_SESSION['message'] = '<div class="notice">'.$e->getMessage().'</div>';
}

header('Location: '.BASE_URL);
exit;
