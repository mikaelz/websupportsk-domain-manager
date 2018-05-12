<?php

namespace Websupport;

$ws = new Api($_SESSION['auth_token']);
$zones = $ws->request('/user/self/zone');

$zones_html = '';
foreach ($zones['items'] as $zone) {
    $zones_html .= '<tr>
        <td>'.$zone['id'].'</td>
        <td><a href="?domain='.$zone['name'].'">'.$zone['name'].'</a></td>
    </tr>';
}
?>
<table class="zones" cellpadding="5" cellspacing="0" border="1">
    <tr>
        <th>ID</th>
        <th>Domain</th>
    </tr>
    <?php echo $zones_html; ?>
</table>
