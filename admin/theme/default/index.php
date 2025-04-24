<?php
$content = $page.'/index.php';
$contentView = '';

if (file_exists($content)) {
    include $content;
}

include_once 'theme/default/view.php';
?>