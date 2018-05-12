
function showTypeRows(el) {
    document.getElementById('prio').style.display = 'none';
    document.getElementById('port').style.display = 'none';
    document.getElementById('weight').style.display = 'none';

    switch (el.value) {
        case 'mx':
            document.getElementById('prio').style.display = 'table-row';
            break;
        case 'srv':
            document.getElementById('prio').style.display = 'table-row';
            document.getElementById('port').style.display = 'table-row';
            document.getElementById('weight').style.display = 'table-row';
            break;
    }
}
