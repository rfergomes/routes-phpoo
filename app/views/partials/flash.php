<?php
foreach (['success', 'danger', 'warning', 'info'] as $type) {
    echo flash($type, 'alert');
}
?>