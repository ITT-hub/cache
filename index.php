<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php";

$cache = new \ITTech\Lib\Cache(__DIR__."/tmp/cache");

// Выбор кэша
//var_dump($cache->get("/controller"));

// Создание кэша
var_dump($cache->set("/controller", "Привет мир!"));

