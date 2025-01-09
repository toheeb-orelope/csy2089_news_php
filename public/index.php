<?php
session_start();

require_once __DIR__ . '../../functions/autoload.php';
// require_once __DIR__ . '../../functions/functions.php';

// $sidebar = newsTemplates('../newsTemplates/newssidebar.html.php', []);
$entryPoint = new \GenericClasses\EntryPoint(new \IJDB\Routes());
$entryPoint->run();