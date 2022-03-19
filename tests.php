<?php

require_once 'vendor/autoload.php';

$w = new \Sunxyw\Weather\Weather();
var_dump($w->getWeather('武汉'));