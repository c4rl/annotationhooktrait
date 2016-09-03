<?php

require __DIR__ . '/vendor/autoload.php';

use Aht\C;

$c = new C();

$c->applyHook('preprocess', 'hi');
