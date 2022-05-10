<?php
namespace NoSQL;

// use Memcached\Client;

class Memcached implements Strategy
{
    private $client;

    public function __construct()
    {
        //$this->client = new Client();
    }
    
    public function set($key,$value,$expire): void
    {
        //..code
    }  

    public function get($key)
    {
        //..code
        return '';
    }  

    public function getAll(): array
    {
        //..code
        return [];
    }  

    public function del($key): void
    {
        //..code
    }   
}