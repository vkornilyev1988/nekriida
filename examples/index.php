<?php

use Nekrida\Core\Core;

require __DIR__ . '/vendor/aulira/nekrida/src/Core/Core.php';

$app = new Core();
$app->run(__DIR__);
