<?php

namespace Websupport;

require __DIR__.'/bootstrap.php';

if (isset($_POST['record_add'])) {
    $required[] = empty($_POST['record_type']) ? 'Type' : '';
    $required[] = empty($_POST['record_name']) ? 'Name' : '';
    $required[] = empty($_POST['record_content']) ? 'Content' : '';
    $_SESSION['message'] = '<div class="error">Please provide: '.implode(', ', $required).'</div>';

    header('Location: '.BASE_URL.'/record_add.php');
    exit;

    $ws = new Api($_SESSION['auth_token']);
}

?>
