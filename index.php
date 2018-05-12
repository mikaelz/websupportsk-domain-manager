<?php

require __DIR__.'/bootstrap.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>WebSupport.sk Domain entries manager</title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
</head>
<body>
<div class="container">
    <h1>WebSupport.sk Domain entries manager</h1>

    <?php
    if (!empty($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>

    <?php if (empty($_SESSION['auth_token'])) : ?>
    <fieldset class="login">
        <legend>WebSupport account login</legend>
        <form action="<?php echo BASE_URL; ?>/login.php" method="post">
            <table>
                <tr>
                    <td><input type="text" name="ws_username" placeholder="Websupport username"></td>
                    <td><input type="password" name="ws_pass" placeholder="Websupport password"></td>
                    <td><button type="submit">Login</button></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php endif; ?>
</div>
</body>
</html>
