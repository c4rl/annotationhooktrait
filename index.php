<?php

require __DIR__ . '/vendor/autoload.php';

use AE\C;

$c = new C();

$c->applyHook('preprocess', 'hi');
