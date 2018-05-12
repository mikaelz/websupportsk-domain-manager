<?php

namespace Websupport;

if (empty($_GET['record_add']) || !filter_var(gethostbyname($_GET['record_add']), FILTER_VALIDATE_IP)) {
    echo '<div class="notice">Invalid domain. Couldn\'t resolve its IP.</div>';

    return;
}

if (isset($_POST['record_save'])) {
    require __DIR__.'/record_save.php';
}
$domain = $_GET['record_add'];
?>
<h2>Add new DNS record to <em><?php echo $domain; ?></em></h2>
<form action="" method="post">
    <input type="hidden" name="domain" value="<?php echo $domain; ?>">
    <table class="zones" cellpadding="5" cellspacing="0" border="1">
        <tr>
            <th>Type</th>
            <td>
                <select name="record_type" onchange="showTypeRows(this)">
                    <?php foreach (Api::RECORD_TYPES as $type) : ?>
                    <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="record_name" value="" autofocus="autofocus"></td>
        </tr>
        <tr>
            <th>Content</th>
            <td><input type="text" name="record_content" value=""></td>
        </tr>
        <tr id="prio" class="hide">
            <th>Priority</th>
            <td><input type="text" name="record_prio" value=""></td>
        </tr>
        <tr id="port" class="hide">
            <th>Port</th>
            <td><input type="text" name="record_port" value=""></td>
        </tr>
        <tr id="weight" class="hide">
            <th>Weight</th>
            <td><input type="text" name="record_weight" value=""></td>
        </tr>
        <tr>
            <th>TTL</th>
            <td><input type="text" name="record_ttl" value=""></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><button type="submit" name="record_save">Save new record</button>
                <a href="?domain=<?php echo $domain; ?>">Return to listing</a>
            </td>
        </tr>
    </table>
</form>
