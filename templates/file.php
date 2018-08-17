<?php
$mime_type = mime_content_type(__DIR__ . "/../uploads/{$_GET['file']}");
header('Content-type: '.$mime_type);
readfile(__DIR__ . "/../uploads/{$_GET['file']}");