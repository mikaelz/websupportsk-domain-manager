<?php

if (empty($_GET['record_add']) || !filter_var(gethostbyname($_GET['record_add']), FILTER_VALIDATE_IP)) {
    echo '<div class="notice">Invalid domain. Couldn\'t resolve its IP.</div>';

    return;
}
$domain = $_GET['record_add'];
?>
<h2>Add new DNS record to <em><?php echo $domain; ?></em></h2>
<form action="record_save.php" method="post">
    <input type="hidden" name="domain" value="<?php echo $domain; ?>">
    <table class="zones" cellpadding="5" cellspacing="0" border="1">
        <tr>
            <th>Type</th>
            <td>
                <select name="record_type" onchange="showTypeRows(this)">
                    <option value="a">A</option>
                    <option value="aaaa">AAAA</option>
                    <option value="aname">ANAME</option>
                    <option value="cname">CNAME</option>
                    <option value="mx">MX</option>
                    <option value="ns">NS</option>
                    <option value="srv">SRV</option>
                    <option value="txt">TXT</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="record_name" value=""></td>
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
            <td><button type="submit">Save new record</button></td>
        </tr>
    </table>
</form>
