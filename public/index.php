<?php
try {
    include __DIR__.'/../includes/autoload.php';
    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    $entryPoint = new \General\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Specific\Routes());
    $entryPoint->run();
} catch (PDOException $error) {
    $title = 'Database Error';
    $output = 'Connection failed: ' . $error->getMessage() . ' in ' . $error->getFile() . ':' . $error->getLine();
    include __DIR__.'/../templates/layout.html.php';
}
