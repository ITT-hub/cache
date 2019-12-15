# Библиотека для работы с кэш

Создать объект класса передав в качестве параметра путь до директории кэш

```php
<?php

use ITTech\Lib\Cache;

$cache = new Cache(__DIR__."/tmp/cache");

/*
 * Создать кэш
 * @param $key
 * @param $data
 * @param int $time
 * @return bool
 */
$cache->set("/controller", "Привет мир!", time() * 24);

/*
 * Выбор их кэша
 * Возвращает строку или bool в случае просрочки или ошибки
 */
$cache->get("/controller");

/*
 * Удалить кэш
 */
$cache->drop("/controller");

```