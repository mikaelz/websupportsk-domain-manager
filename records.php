<?php

namespace Websupport;

if (empty($_GET['domain']) || !filter_var(gethostbyname($_GET['domain']), FILTER_VALIDATE_IP)) {
    echo '<div class="notice">Invalid domain. Couldn\'t resolve its IP.</div>';

    return;
}
$domain = $_GET['domain'];

$ws = new Api($_SESSION['auth_token']);

if (isset($_GET['record_del'])) {
    $record_id = (int) $_GET['record_del'];
    $ws->request('/user/self/zone/'.$domain.'/record/'.$record_id, [], 'DELETE');
}

$records = $ws->request('/user/self/zone/'.$domain.'/record');

$records_html = '';
foreach ($records['items'] as $record) {
    $records_html .= '<tr>
        <td>'.$record['type'].'</td>
        <td>'.$record['name'].'</td>
        <td>'.$record['content'].'</td>
        <td>'.$record['ttl'].'</td>
        <td><a href="?record_domain='.$domain.'&record_edit='.$record['id'].'">Edit</a></td>
        <td><a href="?domain='.$domain.'&record_del='.$record['id'].'" onclick="return confirm(\'Really remove?\')">Delete</a></td>
    </tr>';
}
?>
<p>
    <a class="btn" href="?record_add=<?php echo $domain; ?>">Add new record</a>
</p>
<table class="zones" cellpadding="5" cellspacing="0" border="1">
    <tr>
        <th>Type</th>
        <th>Name</th>
        <th>Content</th>
        <th>TTL</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php echo $records_html; ?>
</table>
