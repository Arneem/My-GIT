<?php
namespace RefactoringGuru\Singleton\RealWorld;


class CacheManager
{
    private static  $instance = [];
    private  $cache = [];
    private function __construct() {}
    /**
     * Метод, используемый для получения экземпляра Одиночки.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }

    public function set(string $key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->cache[$key] ?? null;
    }

    public function delete(string $key)
    {
        unset($this->cache[$key]);
    }

    public function clear()
    {
        $this->cache = [];
    }
}

// Пример использования Singleton CacheManager
$cacheManager1 = CacheManager::getInstance();
$cacheManager1->set('user:1', ['name' => 'John', 'age' => 30]);

$cacheManager2 = CacheManager::getInstance();
$userData = $cacheManager2->get('user:1');
var_dump($userData); // Должно вывести данные пользователя

$cacheManager1->delete('user:1'); // Удаление данных из кэша

$cacheManager2->clear(); // Очистка всего кэша
