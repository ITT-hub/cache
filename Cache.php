<?php
/*
 * Created 15.12.2019 18:14
 */

namespace ITTech\Lib;

/**
 * Class Cache
 * @package ITTech\Lib
 * @author Alexandr Pokatskiy
 * @copyright ITTechnology
 */
class Cache
{
    /**
     * Путь к директории с кэш
     * @var string|null
     */
    private $path = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Выбор из кэша
     * @param $key
     * @return bool
     */
    public function get($key)
    {
        $file = $this->path."/".md5($key);

        if(!file_exists($file))
        {
            return false;
        }

        ob_start();
        include $file;
        $str = ob_get_contents();
        ob_end_clean();

        $unser = unserialize($str);

        if($unser["time"] <= time())
        {
            unlink($file);
            return false;
        }

        return $unser["data"];
    }

    /**
     * Создать кэш
     * @param $key
     * @param $data
     * @param int $time
     * @return bool
     */
    public function set($key, $data, $time = 3600): bool
    {
        $content["data"] = $data;
        $content["time"] = time() + $time;

        if(!is_writable($this->path))
        {
            echo $this->path." не доступен для записи";
        }

        if(file_put_contents($this->path."/".md5($key), serialize($content)))
        {
            return true;
        }

        return false;
    }

    /**
     * Удалить кэш
     * @param string $key
     * @return bool
     */
    public function drop(string $key)
    {
        if(file_exists($this->path."/".md5($key)))
        {
            unlink($this->path."/".md5($key));
            return true;
        }

        return false;
    }
}