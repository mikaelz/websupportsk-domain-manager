<?php

date_default_timezone_set('Europe/Bratislava');
session_start();

if (is_file(__DIR__.'/config-'.$_SERVER['HTTP_HOST'].'.php')) {
    require __DIR__.'/config-'.$_SERVER['HTTP_HOST'].'.php';
}

require 'class-websupport.php';
