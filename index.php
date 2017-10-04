<?php

require 'vendor/autoload.php';

$watchman = new Lex\Watchman();

$order = $watchman->findOrder(1);
