<?php
namespace NoSQL;

interface Strategy
{
    public function set($key,$value,$expire): void;

    public function get($key);

    public function getAll(): array;

    public function del($key):void;
}