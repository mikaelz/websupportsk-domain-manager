<?php

namespace Websupport;

if (empty($_GET['record_edit']) || 1 > $_GET['record_edit']) {
    echo '<div class="notice">Invalid record ID.</div>';

    return;
}

if (empty($_GET['record_domain'])) {
    echo '<div class="notice">Missing domain.</div>';

    return;
}

$domain = $_GET['record_domain'];
$record_id = (int) $_GET['record_edit'];
$ws = new Api($_SESSION['auth_token']);
$record = $ws->request('/user/self/zone/'.$domain.'/record/'.$record_id);

if (empty($record['id'])) {
    echo '<div class="notice">Could not fetch record details.</div>';

    return;
}

if (isset($_POST['record_update'])) {
    require __DIR__.'/record_update.php';
}
?>
<h2>Edit DNS record for <em><?php echo $domain; ?></em></h2>
<form action="" method="post">
    <input type="hidden" name="domain" value="<?php echo $domain; ?>">
    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
    <table class="zones" cellpadding="5" cellspacing="0" border="1">
        <tr>
            <th>Type</th>
            <td>
                <select name="record_type" onchange="showTypeRows(this)">
                    <?php foreach (Api::RECORD_TYPES as $type) : ?>
                    <option value="<?php echo $type; ?>"<?php echo $type === $record['type'] ? ' selected="selected"' : ''; ?>><?php echo $type; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="record_name" value="<?php echo $record['name']; ?>" autofocus="autofocus"></td>
        </tr>
        <tr>
            <th>Content</th>
            <td><input type="text" name="record_content" value="<?php echo $record['content']; ?>"></td>
        </tr>
        <tr id="prio" class="hide">
            <th>Priority</th>
            <td><input type="text" name="record_prio" value="<?php echo $record['prio']; ?>"></td>
        </tr>
        <tr id="port" class="hide">
            <th>Port</th>
            <td><input type="text" name="record_port" value="<?php echo $record['port']; ?>"></td>
        </tr>
        <tr id="weight" class="hide">
            <th>Weight</th>
            <td><input type="text" name="record_weight" value="<?php echo $record['weight']; ?>"></td>
        </tr>
        <tr>
            <th>TTL</th>
            <td><input type="text" name="record_ttl" value="<?php echo $record['ttl']; ?>"></td>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <td><button type="submit" name="record_update">Update record</button>
                <a href="?domain=<?php echo $domain; ?>">Return to listing</a>
            </td>
        </tr>
    </table>
</form>
