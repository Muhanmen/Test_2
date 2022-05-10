<?php
namespace NoSQL;

require __DIR__ .'/../vendor/autoload.php';
require __DIR__ .'/strategy.php';
require __DIR__ .'/redis.php';
require __DIR__ .'/memcached.php';


class Cach
{
    private $strategy;

    public function __construct(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function set($key,$value,$expire)
    {
        $this->strategy->set($key, $value, $expire);
    }  

    public function get($key)
    {
       return $this->strategy->get($key);
    }  

    public function getAll()
    {
       return $this->strategy->getAll();
    }  

    public function del($key)
    {
       $this->strategy->del($key);
    }   
}