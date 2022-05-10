<?php
namespace NoSQL;

use Exception;
use Predis\Client;

class Redis implements Strategy
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    
    public function set($key,$value,$expire): void
    {
        $this->client->set($key, $value); 
        $this->client->expire($key,$expire);
    }  

    public function get($key)
    {
       return $this->client->get($key);
    }  

    public function getAll(): array 
    {
        $keys = $this->client->keys('*');

        if (count($keys) == 0) {
            throw new Exception("Нет данных!. Пожалуйста добавьте данные с помощью консоли!", 1);
        }

        foreach ($keys as $value) {
            $datas[$value] = $this->client->get($value); 
        }

       return $datas;
    }  

    public function del($key): void 
    {
      $status =  $this->client->del($key);
      if ($status == 0) {
          throw new Exception("Ключ не найден для удаления!", 1);
          
      }
    }   
}