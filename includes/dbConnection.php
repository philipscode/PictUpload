<?php
$pdo = new PDO('mysql:host=localhost;dbname=PictUpload;charset=utf8', 'PictUpload', 'pupassword1996');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);